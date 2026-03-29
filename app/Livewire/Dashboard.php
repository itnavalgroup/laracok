<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Pr;
use App\Models\Sr;
use App\Models\Ikb;
use App\Models\ItemTransaction;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;

class Dashboard extends Component
{
    use WithPagination;

    public $activeTab = 'all'; // all, PR, SR, IKB
    public $monitorPage = 1;  // pagination for the 3 monitoring tabs

    protected $paginationTheme = 'bootstrap';

    public function updatedActiveTab()
    {
        $this->resetPage();
        $this->monitorPage = 1;
    }

    public function render()
    {
        $user = Auth::user();
        $isAdmin = $user->level === 1;

        // =====================================================================
        // SCOPE HELPER
        // =====================================================================
        $hasDashAll   = $isAdmin || $user->hasPermission('dashboard.view');
        $hasDashDept  = $user->hasPermission('dashboard.view.dept');
        $hasDashSub   = $user->hasPermission('dashboard.view.subordinate');

        $subordinateIds = $user->subordinates()->pluck('id_user')->toArray();
        $deptSubIds = array_unique(array_merge([$user->id_user], $subordinateIds));
        $myIds = array_unique(array_merge([$user->id_user], $subordinateIds));

        // =====================================================================
        // STATS
        // =====================================================================

        // --- PR Stats ---
        $prQuery = Pr::query();
        if (!$hasDashAll) {
            if ($hasDashDept && $user->id_departement) {
                // Dept + subordinates
                $prQuery->where(function ($q) use ($user, $deptSubIds) {
                    $q->where('tbl_pr.id_departement', $user->id_departement)
                        ->orWhereIn('tbl_pr.id_user', $deptSubIds);
                });
            } elseif ($hasDashSub) {
                $prQuery->whereIn('tbl_pr.id_user', $myIds);
            } else {
                $prQuery->where('tbl_pr.id_user', $user->id_user);
            }
        }

        $totalPr = (clone $prQuery)->count();
        // Pending PR -> Exclude Paid (11) and Rejected (13) and Draft/Revisi (0, 12)? 
        // User map says 0=Draft, 12=Revision. Usually pending means action is needed.
        // Let's exclude Paid (11) and Rejected (13).
        $pendingPr = (clone $prQuery)->whereNotIn('status', [0, 11, 13])->count();
        $totalPrValue = (clone $prQuery)
            ->whereNotIn('tbl_pr.status', [0, 12, 13])
            ->join('tbl_detail_pr', 'tbl_pr.id_pr', '=', 'tbl_detail_pr.id_pr')
            ->sum('tbl_detail_pr.ammount');

        // =====================================================================
        // PR STATS — PR adalah Permintaan Pembayaran
        // =====================================================================

        // 1. PR Pending Approval (sedang dalam proses tanda tangan, status 1-6)
        $prPendingApprovalBase = (clone $prQuery)->whereBetween('tbl_pr.status', [1, 6]);
        $prPendingApprovalCount = (clone $prPendingApprovalBase)->count();
        $nilaiPrPendingApproval = (clone $prPendingApprovalBase)
            ->join('tbl_detail_pr', 'tbl_pr.id_pr', '=', 'tbl_detail_pr.id_pr')
            ->sum('tbl_detail_pr.ammount');

        // 2. PR Pending Pembayaran (siap dibayar / sebagian terbayar)
        //    Status 7=Pending Payment, 8=Payment Parsial, 9=Pending Receipt Parsial,
        //    10=Pending Receipt, 14=Pending Dir Sign Payment, 15=Pending Mgr Sign Payment
        //    Hanya hitung yang payment_type_pr tidak null (hindari data yang tidak terkategori)
        $prPendingPaymentBase = (clone $prQuery)->whereIn('tbl_pr.status', [7, 8, 9, 10, 14, 15])
            ->whereNotNull('tbl_pr.payment_type_pr');
        $prPendingPaymentCount = (clone $prPendingPaymentBase)->count();

        $totalAmountPrPendingPayment = (clone $prPendingPaymentBase)
            ->join('tbl_detail_pr', 'tbl_pr.id_pr', '=', 'tbl_detail_pr.id_pr')
            ->sum('tbl_detail_pr.ammount');

        $paidSisa = \App\Models\Payment::query()
            ->whereIn('id_doc_type', [1, 2])
            ->whereIn('id_pr', (clone $prPendingPaymentBase)->pluck('tbl_pr.id_pr'))
            ->sum('ammount');

        $nilaiPrPendingPayment = $totalAmountPrPendingPayment - $paidSisa; // Murni sisa yang belum dibayar

        // 3. PR Selesai / Paid (status 11)
        $prSelesaiBase = (clone $prQuery)->where('tbl_pr.status', 11);
        $prSelesaiCount = (clone $prSelesaiBase)->count();
        $nilaiPrSelesai = (clone $prSelesaiBase)
            ->join('tbl_detail_pr', 'tbl_pr.id_pr', '=', 'tbl_detail_pr.id_pr')
            ->sum('tbl_detail_pr.ammount');

        // Menghitung selisih (Lebih Bayar / Kurang Bayar) pada PR Selesai secara efisien menggunakan subquery
        $prSelesaiSubquery = (clone $prSelesaiBase)->select(
            'tbl_pr.id_pr',
            \DB::raw('COALESCE((SELECT SUM(ammount) FROM tbl_detail_pr WHERE id_pr = tbl_pr.id_pr), 0) as tagihan'),
            \DB::raw('COALESCE((SELECT SUM(ammount) FROM tbl_payment WHERE id_pr = tbl_pr.id_pr AND id_doc_type IN (1,2)), 0) as dibayar')
        );

        $selesaiVariance = \DB::table(\DB::raw("({$prSelesaiSubquery->toSql()}) as pr_summary"))
            ->mergeBindings($prSelesaiSubquery->getQuery())
            ->select(
                \DB::raw('SUM(CASE WHEN dibayar > tagihan THEN dibayar - tagihan ELSE 0 END) as overpaid'),
                \DB::raw('SUM(CASE WHEN tagihan > dibayar THEN tagihan - dibayar ELSE 0 END) as underpaid')
            )->first();

        $prSelesaiOverpaid = $selesaiVariance->overpaid ?? 0;
        $prSelesaiUnderpaid = $selesaiVariance->underpaid ?? 0;

        // 4. Detail PR Bayar Sebagian (Berdasarkan payment_type_pr = 1)
        //    Menghitung total tagihan, sudah dibayar, dan sisa belum dibayar khusus untuk PR yg diset sbg pembayaran parsial
        $prParsialBase = (clone $prQuery)
            ->where('tbl_pr.payment_type_pr', 1)
            ->whereNotIn('tbl_pr.status', [0, 12, 13]); // Exclude draft, revisi, reject

        $prParsialCount = (clone $prParsialBase)->count();

        $totalTagihanParsial = (clone $prParsialBase)
            ->join('tbl_detail_pr', 'tbl_pr.id_pr', '=', 'tbl_detail_pr.id_pr')
            ->sum('tbl_detail_pr.ammount');

        $totalTerbayarParsial = \App\Models\Payment::query()
            ->whereIn('id_doc_type', [1, 2])
            ->whereIn('id_pr', (clone $prParsialBase)->pluck('tbl_pr.id_pr'))
            ->sum('ammount');

        $sisaTagihanParsial = $totalTagihanParsial - $totalTerbayarParsial;

        // --- SR Stats ---
        $srQuery = Sr::query();
        if (!$hasDashAll) {
            if ($hasDashDept && $user->id_departement) {
                $srQuery->where(function ($q) use ($user, $deptSubIds) {
                    $q->where('tbl_sr.id_departement', $user->id_departement)
                        ->orWhereIn('tbl_sr.id_user', $deptSubIds);
                });
            } elseif ($hasDashSub) {
                $srQuery->whereIn('tbl_sr.id_user', $myIds);
            } else {
                $srQuery->where('tbl_sr.id_user', $user->id_user);
            }
        }

        $totalSr = (clone $srQuery)->count();
        // Pending SR -> Exclude Paid (10,11) and Rejected (13) and Draft/Revision (0, 12)
        $pendingSr = (clone $srQuery)->whereNotIn('status', [0, 10, 11, 12, 13])->count();

        // =====================================================================
        // SR STATS — SR adalah Laporan Pertanggungjawaban Anggaran
        // =====================================================================

        // 1. SR Pending Approval (status 1-6): count + nilai realisasi
        $srPendingApprovalBase = (clone $srQuery)->whereBetween('tbl_sr.status', [1, 6]);
        $srPendingApprovalCount = (clone $srPendingApprovalBase)->count();
        $nilaiSrPendingApproval = (clone $srPendingApprovalBase)
            ->join('tbl_detail_sr', 'tbl_sr.id_sr', '=', 'tbl_detail_sr.id_sr')
            ->sum('tbl_detail_sr.ammount');

        // 2. SR Pending Settlement (status 7,8,9): count + nilai realisasi
        //    Status 7=Pending Payment, 8=Payment Parsial, 9=Pending Receipt Parsial
        $srPendingSettlementBase = (clone $srQuery)->whereIn('tbl_sr.status', [7, 8, 9]);
        $srPendingSettlementCount = (clone $srPendingSettlementBase)->count();
        $nilaiSrPendingSettlement = (clone $srPendingSettlementBase)
            ->join('tbl_detail_sr', 'tbl_sr.id_sr', '=', 'tbl_detail_sr.id_sr')
            ->sum('tbl_detail_sr.ammount');

        // 3. SR Selesai (status 10,11): count + nilai realisasi
        $srSelesaiBase = (clone $srQuery)->whereIn('tbl_sr.status', [10, 11]);
        $srSelesaiCount = (clone $srSelesaiBase)->count();
        $nilaiSrSelesai = (clone $srSelesaiBase)
            ->join('tbl_detail_sr', 'tbl_sr.id_sr', '=', 'tbl_detail_sr.id_sr')
            ->sum('tbl_detail_sr.ammount');

        // 4. Pisahkan settlement SR berdasarkan arah selisih:
        //    outstanding = SUM(tbl_detail_sr) - SUM(PR payment doc_type 1,2)
        //    outstanding < 0 -> karyawan kembalikan sisa (lebih bayar dari PR)
        //    outstanding > 0 -> perusahaan tambah kekurangan (kurang bayar dari PR)
        //    Gunakan subquery SELECT agar efisien (tidak N+1)
        $allSrClassified = (clone $srQuery)
            ->select('tbl_sr.id_sr', 'tbl_sr.id_pr')
            ->selectRaw('COALESCE((SELECT SUM(d.ammount) FROM tbl_detail_sr d WHERE d.id_sr = tbl_sr.id_sr AND d.deleted_at IS NULL), 0) as realisasi')
            ->selectRaw('COALESCE((SELECT SUM(p.grand_total) FROM tbl_payment p WHERE p.id_pr = tbl_sr.id_pr AND p.id_doc_type IN (1,2) AND p.deleted_at IS NULL), 0) as receipt')
            ->get();

        $lebihBayarPrIds = $allSrClassified
            ->filter(fn($s) => (floatval($s->realisasi) - floatval($s->receipt)) < 0)
            ->pluck('id_pr')->toArray();

        $kurangBayarPrIds = $allSrClassified
            ->filter(fn($s) => (floatval($s->realisasi) - floatval($s->receipt)) > 0)
            ->pluck('id_pr')->toArray();

        $totalKembalianKaryawan = empty($lebihBayarPrIds) ? 0
            : \App\Models\Payment::where('id_doc_type', 3)
            ->whereIn('id_pr', $lebihBayarPrIds)
            ->sum('ammount');

        $totalTambahanPerusahaan = empty($kurangBayarPrIds) ? 0
            : \App\Models\Payment::where('id_doc_type', 3)
            ->whereIn('id_pr', $kurangBayarPrIds)
            ->sum('ammount');

        // --- Item Transaction Stats (this month) ---
        $itQuery = ItemTransaction::query()->whereMonth('transaction_date', now()->month)->whereYear('transaction_date', now()->year);
        if (!$hasDashAll) {
            if ($hasDashDept && $user->id_departement) {
                $itQuery->where(function ($q) use ($user, $deptSubIds) {
                    $q->where('id_departement', $user->id_departement)
                        ->orWhereIn('id_user', $deptSubIds);
                });
            } elseif ($hasDashSub) {
                $itQuery->whereIn('id_user', $myIds);
            } else {
                $itQuery->where('id_user', $user->id_user);
            }
        }
        $totalItThisMonth = $itQuery->count();

        $stats = compact(
            'totalPr',
            'pendingPr',
            'totalSr',
            'pendingSr',
            'totalPrValue',
            'totalItThisMonth',
            'prPendingApprovalCount',
            'nilaiPrPendingApproval',
            'prPendingPaymentCount',
            'nilaiPrPendingPayment',
            'prSelesaiCount',
            'nilaiPrSelesai',
            'prSelesaiOverpaid',
            'prSelesaiUnderpaid',
            'prParsialCount',
            'totalTagihanParsial',
            'totalTerbayarParsial',
            'sisaTagihanParsial',
            'srPendingApprovalCount',
            'nilaiSrPendingApproval',
            'srPendingSettlementCount',
            'nilaiSrPendingSettlement',
            'srSelesaiCount',
            'nilaiSrSelesai',
            'totalKembalianKaryawan',
            'totalTambahanPerusahaan'
        );

        // =====================================================================
        // "PERLU TINDAKAN SAYA" — Pending Approval Items
        // =====================================================================
        $pendingItemsRaw = collect();

        // --- PR Query ---
        $prApprovalBase = Pr::with(['user', 'departement'])
            ->where(function ($q) use ($user, $deptSubIds, $isAdmin) {
                $q->where(function ($inner) use ($user) {
                    // Draft/Revisi milik sendiri
                    $inner->whereIn('status', [0, 12])->where('id_user', $user->id_user);
                });

                if ($isAdmin) {
                    $q->orWhereIn('status', [1, 2, 3, 4, 5, 6, 7, 8, 14, 15]);
                } else {
                    // Step 1: Dept Head sign (Filter Dept/Subordinate)
                    if ($user->hasPermission('pr.approve.step1')) {
                        $q->orWhere(function ($inner) use ($user, $deptSubIds) {
                            $inner->where('status', 1)
                                ->where(function ($q2) use ($user, $deptSubIds) {
                                    $q2->where('id_departement', $user->id_departement)
                                        ->orWhereIn('id_user', $deptSubIds);
                                });
                        });
                    }
                    // Step 2–6 (Global, no filter)
                    if ($user->hasPermission('pr.approve.step2')) $q->orWhere('status', 2);
                    if ($user->hasPermission('pr.approve.step3')) $q->orWhere('status', 3);
                    if ($user->hasPermission('pr.approve.step4')) $q->orWhere('status', 4);
                    if ($user->hasPermission('pr.approve.step5')) $q->orWhere('status', 5);
                    if ($user->hasPermission('pr.approve.step6')) $q->orWhere('status', 6);

                    // Payment input (status 7 or 8)
                    if ($user->hasPermission('pr.payment') || $user->hasPermission('pr_payment.create')) {
                        $q->orWhereIn('status', [7, 8]);
                    }
                    // Payment approval: Manager (15), Director (14)
                    if ($user->hasPermission('pr_payment.approve.step1')) $q->orWhere('status', 15);
                    if ($user->hasPermission('pr_payment.approve.step2')) $q->orWhere('status', 14);
                }
            });

        $countPr = $prApprovalBase->count();

        // --- SR Query ---
        $srApprovalBase = Sr::with(['user'])
            ->where(function ($q) use ($user, $deptSubIds, $isAdmin) {
                $q->where(function ($inner) use ($user) {
                    $inner->whereIn('status', [0, 12])->where('id_user', $user->id_user);
                });

                if ($isAdmin) {
                    $q->orWhereIn('status', [1, 2, 3, 4, 5, 6, 7, 8, 9]);
                } else {
                    // Step 1: Dept Head sign (Filter Dept/Subordinate)
                    if ($user->hasPermission('sr.approve.step1')) {
                        $q->orWhere(function ($inner) use ($user, $deptSubIds) {
                            $inner->where('status', 1)
                                ->where(function ($q2) use ($user, $deptSubIds) {
                                    $q2->where('id_departement', $user->id_departement)
                                        ->orWhereIn('id_user', $deptSubIds);
                                });
                        });
                    }
                    
                    // Step 2-6 (Global, no filter)
                    if ($user->hasPermission('sr.approve.step2')) $q->orWhere('status', 2);
                    if ($user->hasPermission('sr.approve.step3')) $q->orWhere('status', 3);
                    if ($user->hasPermission('sr.approve.step4')) $q->orWhere('status', 4);
                    if ($user->hasPermission('sr.approve.step5')) $q->orWhere('status', 5);
                    if ($user->hasPermission('sr.approve.step6')) $q->orWhere('status', 6);

                    // Payment input (status 7)
                    if ($user->hasPermission('sr_payment.create')) $q->orWhere('status', 7);
                    // Payment approval
                    if ($user->hasPermission('sr_payment.approve')) $q->orWhereIn('status', [8, 9]);
                }
            });

        $countSr = $srApprovalBase->count();

        // --- IKB Query ---
        $ikbApprovalBase = Ikb::with(['user'])
            ->where(function ($q) use ($user, $isAdmin) {
                $q->where(function ($inner) use ($user) {
                    $inner->whereIn('status', [0, 11])->where('id_user', $user->id_user); // 0=Draft, 11=Revision
                });

                if ($isAdmin || $user->hasPermission('ikb.approve.step1')) $q->orWhere('status', 1);
                if ($isAdmin || $user->hasPermission('ikb.approve.step2')) $q->orWhere('status', 2);
                if ($isAdmin || $user->hasPermission('ikb.approve.step3')) $q->orWhere('status', 3);
                if ($isAdmin || $user->hasPermission('ikb.approve.step4')) $q->orWhere('status', 4);
                if ($isAdmin || $user->hasPermission('ikb.approve.step5')) $q->orWhere('status', 5);
                if ($isAdmin || $user->hasPermission('ikb.approve.step6')) $q->orWhere('status', 6);
                if ($isAdmin || $user->hasPermission('ikb.approve.step7')) $q->orWhere('status', 7);
                if ($isAdmin || $user->hasPermission('ikb.approve.step8')) $q->orWhere('status', 8);
                if ($isAdmin || $user->hasPermission('ikb.approve.step9')) $q->orWhere('status', 9);
            });

        $countIkb = $ikbApprovalBase->count();

        // Only fetch data if needed for active tab
        if ($this->activeTab === 'all' || $this->activeTab === 'PR') {
            foreach ($prApprovalBase->orderBy('id_pr', 'desc')->get() as $pr) {
                $pendingItemsRaw->push([
                    'type'    => 'PR',
                    'color'   => 'primary',
                    'icon'    => 'ti-file-description',
                    'number'  => $pr->pr_number ?? 'Draft',
                    'subject' => $pr->subject,
                    'date'    => $pr->created_at,
                    'status'  => $pr->status,
                    'hash'    => hashid_encode($pr->id_pr, 'pr'),
                    'route'   => 'payment-requests.show',
                    'timestamp' => $pr->created_at ? $pr->created_at->timestamp : 0,
                ]);
            }
        }

        if ($this->activeTab === 'all' || $this->activeTab === 'SR') {
            foreach ($srApprovalBase->orderBy('id_sr', 'desc')->get() as $sr) {
                $pendingItemsRaw->push([
                    'type'    => 'SR',
                    'color'   => 'success',
                    'icon'    => 'ti-file-analytics',
                    'number'  => $sr->pr_number ?? 'SR-' . $sr->id_sr,
                    'subject' => $sr->subject,
                    'date'    => $sr->created_at,
                    'status'  => $sr->status,
                    'hash'    => hashid_encode($sr->id_pr, 'pr'),
                    'route'   => 'settlement-reports.show',
                    'timestamp' => $sr->created_at ? $sr->created_at->timestamp : 0,
                ]);
            }
        }

        if ($this->activeTab === 'all' || $this->activeTab === 'IKB') {
            foreach ($ikbApprovalBase->orderBy('id_ikb', 'desc')->get() as $ikb) {
                $pendingItemsRaw->push([
                    'type'    => 'IKB',
                    'color'   => 'warning',
                    'icon'    => 'ti-box',
                    'number'  => $ikb->ikb_number ?? 'IKB-' . $ikb->id_ikb,
                    'subject' => $ikb->destination ?? '-',
                    'date'    => $ikb->created_at,
                    'status'  => $ikb->status,
                    'hash'    => hashid_encode($ikb->id_ikb, 'ikb'),
                    'route'   => 'ikb.show',
                    'timestamp' => $ikb->created_at ? $ikb->created_at->timestamp : 0,
                ]);
            }
        }

        // Sort by timestamp desc and handle pagination manually
        $sortedItems = $pendingItemsRaw->sortByDesc('timestamp')->values();

        $perPage = 10;
        $currentPage = Paginator::resolveCurrentPage();
        $items = $sortedItems->forPage($currentPage, $perPage);

        $pendingItems = new LengthAwarePaginator(
            $items,
            $sortedItems->count(),
            $perPage,
            $currentPage,
            ['path' => Paginator::resolveCurrentPath()]
        );

        // =====================================================================
        // MONITORING TABS: PR Full Payment, PR Partial, SR Pending Settlement
        // =====================================================================

        // Permission guard untuk tab monitoring:
        // PR Payment page: Admin | PR owner | pr.payment | pr_payment.view | pr_payment.create
        // SR Settlement page: Admin | SR owner | sr_detail.view | sr.approve.step1-6 | sr_payment.view
        $canSeeAllPrPayment = $isAdmin
            || $user->hasPermission('pr.payment')
            || $user->hasPermission('pr_payment.view')
            || $user->hasPermission('pr_payment.create');

        $canSeeAllSrSettlement = $isAdmin
            || $user->hasPermission('sr_detail.view')
            || $user->hasPermission('sr_payment.view')
            || $user->hasPermission('sr.approve.step1')
            || $user->hasPermission('sr.approve.step2')
            || $user->hasPermission('sr.approve.step3')
            || $user->hasPermission('sr.approve.step4')
            || $user->hasPermission('sr.approve.step5')
            || $user->hasPermission('sr.approve.step6');

        // Base PR query dengan permission scope (reuse $prQuery yang sudah ada)
        $prMonitorBase = (clone $prQuery);

        // Tab: PR Pending Payment (Full)
        $monitorPerPage = 15;
        $monitorCurrentPage = $this->monitorPage;

        // Tab: PR Pending Payment (Full)
        $prFullPaymentItems = collect();
        if (in_array($this->activeTab, ['pr_payment_full'])) {
            $prFullAll = $prMonitorBase
                ->where('tbl_pr.payment_type_pr', 2)
                ->where('tbl_pr.status', '>=', 7)
                ->whereNotIn('tbl_pr.status', [11, 12, 13])
                ->with(['user', 'vendor'])
                ->select(
                    'tbl_pr.id_pr',
                    'tbl_pr.pr_number',
                    'tbl_pr.subject',
                    'tbl_pr.status',
                    'tbl_pr.id_user',
                    'tbl_pr.id_vendor',
                    DB::raw('(SELECT SUM(ammount) FROM tbl_detail_pr WHERE id_pr = tbl_pr.id_pr) as total_tagihan'),
                    DB::raw('(SELECT SUM(ammount) FROM tbl_payment WHERE id_pr = tbl_pr.id_pr AND id_doc_type IN (1,2)) as total_dibayar')
                )
                ->orderByDesc('tbl_pr.id_pr')
                ->get();
            $prFullPaymentItems = new LengthAwarePaginator(
                $prFullAll->forPage($monitorCurrentPage, $monitorPerPage),
                $prFullAll->count(),
                $monitorPerPage,
                $monitorCurrentPage,
                ['path' => Paginator::resolveCurrentPath()]
            );
        }
        $countPrFullPayment = $prMonitorBase->where('tbl_pr.payment_type_pr', 2)
            ->where('tbl_pr.status', '>=', 7)->whereNotIn('tbl_pr.status', [11, 12, 13])->count();

        // Tab: PR Partial Payment (yang masih aktif, sudah lewat approval)
        $prPartialPaymentItems = collect();
        $prMonitorBase2 = (clone $prQuery);
        if (in_array($this->activeTab, ['pr_partial_payment'])) {
            $prPartialAll = $prMonitorBase2
                ->where('tbl_pr.payment_type_pr', 1)
                ->where('tbl_pr.status', '>=', 7)
                ->whereNotIn('tbl_pr.status', [11, 12, 13])
                ->with(['user', 'vendor'])
                ->select(
                    'tbl_pr.id_pr',
                    'tbl_pr.pr_number',
                    'tbl_pr.subject',
                    'tbl_pr.status',
                    'tbl_pr.id_user',
                    'tbl_pr.id_vendor',
                    DB::raw('(SELECT SUM(ammount) FROM tbl_detail_pr WHERE id_pr = tbl_pr.id_pr) as total_tagihan'),
                    DB::raw('(SELECT SUM(ammount) FROM tbl_payment WHERE id_pr = tbl_pr.id_pr AND id_doc_type IN (1,2)) as total_dibayar')
                )
                ->orderByDesc('tbl_pr.id_pr')
                ->get();
            $prPartialPaymentItems = new LengthAwarePaginator(
                $prPartialAll->forPage($monitorCurrentPage, $monitorPerPage),
                $prPartialAll->count(),
                $monitorPerPage,
                $monitorCurrentPage,
                ['path' => Paginator::resolveCurrentPath()]
            );
        }
        $countPrPartialPayment = $prMonitorBase2->where('tbl_pr.payment_type_pr', 1)
            ->where('tbl_pr.status', '>=', 7)->whereNotIn('tbl_pr.status', [11, 12, 13])->count();

        // Tab: SR Pending Settlement (status 7, 8, 9)
        $srSettlementItems = collect();
        $srMonitorBase = (clone $srQuery);
        if (in_array($this->activeTab, ['sr_pending_settlement'])) {
            $srAll = $srMonitorBase
                ->whereIn('tbl_sr.status', [7, 8, 9])
                ->leftJoin('tbl_pr', 'tbl_sr.id_pr', '=', 'tbl_pr.id_pr')
                ->with(['user'])
                ->select(
                    'tbl_sr.id_sr',
                    'tbl_sr.id_pr',
                    'tbl_sr.subject',
                    'tbl_sr.status',
                    'tbl_sr.id_user',
                    'tbl_pr.pr_number',
                    DB::raw('(SELECT SUM(ammount) FROM tbl_detail_sr WHERE id_sr = tbl_sr.id_sr) as total_dilaporkan'),
                    DB::raw('COALESCE((SELECT SUM(ammount) FROM tbl_payment WHERE id_pr = tbl_sr.id_pr AND id_doc_type IN (1,2)), 0) as total_penerimaan')
                )
                ->orderByDesc('tbl_sr.id_sr')
                ->get();
            $srSettlementItems = new LengthAwarePaginator(
                $srAll->forPage($monitorCurrentPage, $monitorPerPage),
                $srAll->count(),
                $monitorPerPage,
                $monitorCurrentPage,
                ['path' => Paginator::resolveCurrentPath()]
            );
        }
        $countSrPendingSettlement = $srMonitorBase->whereIn('tbl_sr.status', [7, 8, 9])->count();

        $tabCounts = [
            'all'                   => $countPr + $countSr + $countIkb,
            'PR'                    => $countPr,
            'SR'                    => $countSr,
            'IKB'                   => $countIkb,
            'pr_payment_full'       => $countPrFullPayment,
            'pr_partial_payment'    => $countPrPartialPayment,
            'sr_pending_settlement' => $countSrPendingSettlement,
        ];

        return view('livewire.dashboard', compact('stats', 'pendingItems', 'user', 'tabCounts'))
            ->layout('layouts.app')
            ->with([
                'title'                  => 'Dashboard',
                'prFullPaymentItems'     => $prFullPaymentItems,
                'prPartialPaymentItems'  => $prPartialPaymentItems,
                'srSettlementItems'      => $srSettlementItems,
            ]);
    }

    // =====================================================================
    // STATUS LABELS (BASED ON USER SPECIFICATION)
    // =====================================================================
    public static function prStatusLabel(int|null $status): array
    {
        return match ((int)$status) {
            0  => ['Draft', 'secondary'],
            1  => ['Pending Dept Sign', 'warning'],
            2  => ['Pending Director Sign', 'warning'],
            3  => ['Pending Accounting Sign', 'warning'],
            4  => ['Pending Finance Sign', 'warning'],
            5  => ['Pending SPV Finance Sign', 'warning'],
            6  => ['Pending CFO Sign', 'warning'],
            7  => ['Pending Payment', 'warning'],
            8  => ['Payment Parsial', 'info'],
            9  => ['Pending Receipt Parsial', 'info'],
            10 => ['Pending Receipt', 'info'],
            11 => ['Paid', 'success'],
            12 => ['Revision', 'primary'],
            13 => ['Rejected', 'danger'],
            14 => ['Pending Director Sign Payment', 'danger'],
            15 => ['Pending Manager Sign Payment', 'danger'],
            default => ['Unknown', 'dark'],
        };
    }

    public static function srStatusLabel(int|null $status): array
    {
        return match ((int)$status) {
            0  => ['Draft', 'secondary'],
            1  => ['Pending Dept Sign', 'warning'],
            2  => ['Pending Director Sign', 'warning'],
            3  => ['Pending Accounting Sign', 'warning'],
            4  => ['Pending Finance Sign', 'warning'],
            5  => ['Pending SPV Finance Sign', 'warning'],
            6  => ['Pending CFO Sign', 'warning'],
            7  => ['Pending Payment', 'warning'],
            8  => ['Payment Parsial', 'info'],
            9  => ['Pending Receipt Parsial', 'info'],
            10 => ['Paid / Balance Settled', 'success'],
            12 => ['Revision', 'primary'],
            13 => ['Rejected', 'danger'],
            14 => ['Pending Director Sign Payment', 'danger'],
            15 => ['Pending Manager Sign Payment', 'danger'],
            default => ['Unknown', 'dark'],
        };
    }

    public static function ikbStatusLabel(int|null $status): array
    {
        return match ((int)$status) {
            0  => ['DRAFT', 'secondary'],
            1  => ['PENDING SPV/MGR SIGN', 'warning'],
            2  => ['PENDING DIR LOG SIGN', 'warning'],
            3  => ['PENDING PPIC SIGN', 'warning'],
            4  => ['PENDING INV CTRL SIGN', 'warning'],
            5  => ['PENDING LOG COORD SIGN', 'warning'],
            6  => ['PENDING WH STAFF SIGN', 'warning'],
            7  => ['PENDING WH SPV SIGN', 'warning'],
            8  => ['PENDING SECURITY SIGN', 'warning'],
            9  => ['PENDING FINAL LOG COORD', 'warning'],
            10 => ['APPROVED / DONE', 'success'],
            11 => ['REVISION', 'primary'],
            12 => ['REJECTED', 'danger'],
            default => ['UNKNOWN', 'dark'],
        };
    }
}
