<?php

namespace App\Livewire\PaymentRequests;

use App\Models\Departement;
use App\Models\Pr;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    #[On('refreshPrIndex')]
    public function refreshPrIndex()
    {
        $this->resetPage();
    }

    public $search = '';

    public $perPage = 10;

    public $filterDepartement = '';

    public $filterCompany = '';

    public $filterStatus = [];

    public $filterSrStatus = [];

    public $dateFromCreated = '';

    public $dateToCreated = '';

    public $dateFromDueDate = '';

    public $dateToDueDate = '';

    const SESSION_KEY = 'pr_index_filters';

    public function mount()
    {
        abort_if(
            Auth::user()->level !== 1
                && ! Auth::user()->hasPermission('pr.view.all')
                && ! Auth::user()->hasPermission('pr.view.dept')
                && ! Auth::user()->hasPermission('pr.view.subordinate'),
            403
        );

        // Restore filters from PHP session if exist
        $saved = session(self::SESSION_KEY, []);
        if (! empty($saved)) {
            $this->search = $saved['search'] ?? '';
            $this->perPage = $saved['perPage'] ?? 10;
            $this->filterDepartement = $saved['filterDepartement'] ?? '';
            $this->filterCompany = $saved['filterCompany'] ?? '';
            $this->filterStatus = is_array($saved['filterStatus'] ?? null) ? $saved['filterStatus'] : [];
            $this->filterSrStatus = is_array($saved['filterSrStatus'] ?? null) ? $saved['filterSrStatus'] : [];
            $this->dateFromCreated = $saved['dateFromCreated'] ?? '';
            $this->dateToCreated = $saved['dateToCreated'] ?? '';
            $this->dateFromDueDate = $saved['dateFromDueDate'] ?? '';
            $this->dateToDueDate = $saved['dateToDueDate'] ?? '';
        }
    }

    private function saveFiltersToSession(): void
    {
        session([self::SESSION_KEY => [
            'search' => $this->search,
            'perPage' => $this->perPage,
            'filterDepartement' => $this->filterDepartement,
            'filterCompany' => $this->filterCompany,
            'filterStatus' => $this->filterStatus,
            'filterSrStatus' => $this->filterSrStatus,
            'dateFromCreated' => $this->dateFromCreated,
            'dateToCreated' => $this->dateToCreated,
            'dateFromDueDate' => $this->dateFromDueDate,
            'dateToDueDate' => $this->dateToDueDate,
        ]]);
    }

    public function updatedSearch()
    {
        $this->resetPage();
        $this->saveFiltersToSession();
    }

    public function updatedPerPage()
    {
        $this->resetPage();
        $this->saveFiltersToSession();
    }

    public function updatedFilterDepartement()
    {
        $this->resetPage();
        $this->saveFiltersToSession();
    }

    public function updatedFilterCompany()
    {
        $this->resetPage();
        $this->saveFiltersToSession();
    }

    public function updatedFilterStatus()
    {
        $this->resetPage();
        $this->saveFiltersToSession();
    }

    public function updatedFilterSrStatus()
    {
        $this->resetPage();
        $this->saveFiltersToSession();
    }

    public function updatedDateFromCreated()
    {
        $this->resetPage();
        $this->saveFiltersToSession();
    }

    public function updatedDateToCreated()
    {
        $this->resetPage();
        $this->saveFiltersToSession();
    }

    public function updatedDateFromDueDate()
    {
        $this->resetPage();
        $this->saveFiltersToSession();
    }

    public function updatedDateToDueDate()
    {
        $this->resetPage();
        $this->saveFiltersToSession();
    }

    public function resetFilters()
    {
        $this->search = '';
        $this->filterDepartement = '';
        $this->filterCompany = '';
        $this->filterStatus = [];
        $this->filterSrStatus = [];
        $this->dateFromCreated = '';
        $this->dateToCreated = '';
        $this->dateFromDueDate = '';
        $this->dateToDueDate = '';
        session()->forget(self::SESSION_KEY);
        $this->resetPage();
    }

    public function delete($id)
    {
        $pr = Pr::findOrFail($id);
        $user = Auth::user();

        // Restricted to Admin, Owner, or users with pr.delete permission
        abort_if(
            $user->level !== 1
            && $user->id_user !== $pr->id_user
            && ! $user->hasPermission('pr.delete'),
            403
        );

        if (! in_array($pr->status, [0, null, 13])) {
            $this->dispatch('alert', [
                'type' => 'danger',
                'title' => 'Gagal',
                'message' => 'Payment Request yang sedang atau sudah diproses tidak dapat dihapus.',
            ]);

            return;
        }

        $pr->attachmentPrs()->delete();
        $pr->signTransactions()->forceDelete();
        $pr->details()->delete();
        $pr->invoices()->forceDelete();
        $pr->payments()->forceDelete();
        $pr->srs()->forceDelete();
        $pr->delete();

        $this->dispatch('alert', [
            'type' => 'success',
            'title' => 'Dihapus',
            'message' => 'Payment Request berhasil dihapus.',
        ]);
    }

    public function getFilteredQuery()
    {
        $query = Pr::with(['user', 'departement', 'company', 'vendor', 'docType', 'norek_vendor', 'details', 'payments', 'srs.details', 'srs.payments'])
            ->withSum('details as total_amount', 'ammount')
            ->visibleTo(Auth::user());

        if ($this->search) {
            $s = '%'.$this->search.'%';
            $query->where(function ($q) use ($s) {
                $q->where('pr_number', 'like', $s)
                    ->orWhere('subject', 'like', $s)
                    ->orWhereHas('vendor', fn ($vq) => $vq->where('vendor', 'like', $s))
                    ->orWhereHas('user', fn ($uq) => $uq->where('name', 'like', $s));
            });
        }

        if ($this->filterDepartement) {
            $query->where('id_departement', $this->filterDepartement);
        }

        if ($this->filterCompany) {
            $query->where('id_company', $this->filterCompany);
        }

        if (! empty($this->filterStatus) || ! empty($this->filterSrStatus)) {
            $query->where(function ($q) {
                if (! empty($this->filterStatus)) {
                    $q->where(function ($fq) {
                        $fq->whereIn('status', $this->filterStatus);
                        if (in_array('0', $this->filterStatus)) {
                            $fq->orWhereNull('status');
                        }
                    });
                }

                if (! empty($this->filterSrStatus)) {
                    $orTag = ! empty($this->filterStatus) ? 'orWhereHas' : 'whereHas';
                    $q->$orTag('srs', function ($sq) {
                        $sq->where(function ($fsq) {
                            $fsq->whereIn('status', $this->filterSrStatus);
                            if (in_array('0', $this->filterSrStatus)) {
                                $fsq->orWhereNull('status');
                            }
                        });
                    });
                }
            });
        }

        if ($this->dateFromCreated) {
            $query->whereDate('created_at', '>=', $this->dateFromCreated);
        }

        if ($this->dateToCreated) {
            $query->whereDate('created_at', '<=', $this->dateToCreated);
        }

        if ($this->dateFromDueDate) {
            $query->whereDate('payment_due_date', '>=', $this->dateFromDueDate);
        }

        if ($this->dateToDueDate) {
            $query->whereDate('payment_due_date', '<=', $this->dateToDueDate);
        }

        // Advanced Sorting: Prioritize PRs/SRs that need the current user's approval
        $user = Auth::user();
        $isLevel1 = $user->level === 1;

        // Determine ordering using MySQL CASE WHEN
        $caseStatements = [];

        // 0. Prioritize PRs/SRs that need Action from the creator themselves (Draft: 0, Revision: 12)
        $userId = $user->id_user;
        $caseStatements[] = "WHEN tbl_pr.status IN (0, 12) AND tbl_pr.id_user = $userId THEN 0";
        $caseStatements[] = "WHEN EXISTS (SELECT 1 FROM tbl_sr WHERE tbl_sr.id_pr = tbl_pr.id_pr AND tbl_sr.status IN (0, 12) AND tbl_sr.id_user = $userId) THEN 0";

        // 1. If user is a Department Head / Spv, prioritize their subordinates' Draft (0) or Pending Dept Sign (1)
        if ($isLevel1 || $user->hasPermission('pr.approve.step1')) {
            $subordinateIds = $user->subordinates()->pluck('id_user')->toArray();
            if (! empty($subordinateIds)) {
                $subIdsStr = implode(',', $subordinateIds);
                // Subordinate draft/revised might need attention but the main step is status 1 (Pending Dept Sign).
                // We'll prioritize Pending Dept Sign (1) for subordinates. Drafts (0) are primarily for creator, but we can include them if wanted.
                $caseStatements[] = "WHEN tbl_pr.status IN (0, 1) AND tbl_pr.id_user IN ($subIdsStr) THEN 1";
                $caseStatements[] = "WHEN EXISTS (SELECT 1 FROM tbl_sr WHERE tbl_sr.id_pr = tbl_pr.id_pr AND tbl_sr.status IN (0, 1) AND tbl_sr.id_user IN ($subIdsStr)) THEN 1";
            }
            $caseStatements[] = 'WHEN tbl_pr.status = 1 THEN 2'; // General Dept Sign
            $caseStatements[] = 'WHEN EXISTS (SELECT 1 FROM tbl_sr WHERE tbl_sr.id_pr = tbl_pr.id_pr AND tbl_sr.status = 1) THEN 2';
        }

        // 2. Map other approval steps priorities for PR and SR
        $priorityLevel = 3;

        $prStepPermissions = [
            2 => 'pr.approve.step2',
            3 => 'pr.approve.step3',
            4 => 'pr.approve.step4',
            5 => 'pr.approve.step5',
            6 => 'pr.approve.step6',
            7 => 'pr.create',
            9 => 'pr.create',
            10 => 'pr.create',
            14 => 'pr.approve.step2',
        ];

        $srStepPermissions = [
            2 => 'sr.approve.step2',
            3 => 'sr.approve.step3',
            4 => 'sr.approve.step4',
            5 => 'sr.approve.step5',
            6 => 'sr.approve.step6',
            7 => 'sr.create',
            9 => 'sr.create',
            10 => 'sr.create',
        ];

        // We interleave PR and SR priorities so they appear together logically
        foreach (range(2, 14) as $statusLevel) {
            $hasPriority = false;

            // Check PR Permission for this level
            if (isset($prStepPermissions[$statusLevel]) && ($isLevel1 || $user->hasPermission($prStepPermissions[$statusLevel]))) {
                $caseStatements[] = "WHEN tbl_pr.status = $statusLevel THEN $priorityLevel";
                $hasPriority = true;
            }

            // Check SR Permission for this level
            if (isset($srStepPermissions[$statusLevel]) && ($isLevel1 || $user->hasPermission($srStepPermissions[$statusLevel]))) {
                $caseStatements[] = "WHEN EXISTS (SELECT 1 FROM tbl_sr WHERE tbl_sr.id_pr = tbl_pr.id_pr AND tbl_sr.status = $statusLevel) THEN $priorityLevel";
                $hasPriority = true;
            }

            if ($hasPriority) {
                $priorityLevel++;
            }
        }

        // Apply Custom Ordering if any rules match
        if (! empty($caseStatements)) {
            $caseClause = implode(' ', $caseStatements);
            $query->orderByRaw("
                CASE 
                    $caseClause
                    ELSE 99 
                END ASC
            ");
        }

        return $query->orderBy('tbl_pr.id_pr', 'desc');
    }

    public function export()
    {
        ini_set('max_execution_time', 0); // 0 = Bebas waktu (tanpa batas)
        ini_set('memory_limit', '1024M'); // Menaikkan RAM sementara khusus untuk method ini

        $prs = $this->getFilteredQuery()->get();

        return \Maatwebsite\Excel\Facades\Excel::download(new \App\Exports\PaymentRequestExport($prs), 'Payment_Requests_'.date('Ymd_His').'.xlsx');
    }

    public function render()
    {
        $prs = $this->getFilteredQuery()->paginate($this->perPage);

        return view('livewire.payment-requests.index', [
            'prs' => $prs,
            'departements' => Departement::orderBy('departement')->get(),
            'companies' => \App\Models\Company::orderBy('company_name')->get(),
        ])->layout('layouts.app');
    }
}
