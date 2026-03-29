<?php

namespace App\Livewire\SettlementReports;

use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\Attributes\Computed;
use App\Models\Sr;
use App\Models\Pr;
use App\Models\Payment;
use App\Models\SignTransaction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;
use Endroid\QrCode\ErrorCorrectionLevel;

class Show extends Component
{
    public $srId;
    public $rejectReason;
    public $revisionReason;
    public $note;
    public $id_loan;

    public function mount($hash)
    {
        $idPr = is_numeric($hash) ? $hash : hashid_decode($hash, 'pr');
        if (!$idPr) abort(404);

        // SR diakses melalui id_pr (bukan id_sr), sama persis dengan sistem CI4
        $sr = Sr::where('id_pr', $idPr)->firstOrFail();

        $this->srId = $sr->id_sr;

        $user = Auth::user();

        $canView = $user->level === 1
            || $user->id_user == $sr->id_user
            || $user->hasPermission('sr_detail.view')
            || $user->hasPermission('sr.approve.step1')
            || $user->hasPermission('sr.approve.step2')
            || $user->hasPermission('sr.approve.step3')
            || $user->hasPermission('sr.approve.step4')
            || $user->hasPermission('sr.approve.step5')
            || $user->hasPermission('sr.approve.step6')
            || $user->hasPermission('sr_payment.view');

        if (!$canView) {
            session()->flash('error', 'Anda tidak memiliki akses untuk melihat Settlement Report ini.');
            return redirect()->route('settlement-reports.index');
        }
    }

    // =========================================================================
    // COMPUTED PROPERTIES
    // =========================================================================

    #[On('sr-refresh')]
    public function refresh()
    {
        unset($this->sr);
        unset($this->grandTotal);
        unset($this->srHash);
    }

    #[Computed]
    public function sr()
    {
        return Sr::with([
            'user',
            'departement',
            'company',
            'branch',
            'vendor',
            'details.uom',
            'details.item',
            'details.itemCategory',
            'details.taxSatu',
            'details.taxDua',
            'signTransactions.user',
            'payments.user',
            'payments.attachments',
            'docType',
            'costCategory',
            'costType',
            'loan',
            'norekVendor',
            'emailUser',
            'emailVendor',
            'attachments.user',
            'attachments.attachment',
            'pr',
        ])->findOrFail($this->srId);
    }

    #[Computed]
    public function grandTotal()
    {
        $total = $this->sr->details->sum('ammount');
        return $total - floatval($this->sr->additional_discount ?? 0);
    }

    #[Computed]
    public function srHash()
    {
        return hashid_encode($this->srId, 'sr');
    }

    #[Computed]
    public function receipt()
    {
        // Total payment dari PR asli (id_doc_type 1 atau 2)
        return Payment::where('id_pr', $this->sr->id_pr)
            ->whereIn('id_doc_type', [1, 2])
            ->sum('grand_total');
    }

    #[Computed]
    public function refund()
    {
        // Total payment/refund dari SR ini (id_doc_type 3)
        return $this->sr->payments->sum('grand_total');
    }

    #[Computed]
    public function balance()
    {
        $outstanding = $this->grandTotal - $this->receipt;

        if ($outstanding < 0) {
            // Jika PR bayar lebih banyak dari realisasi SR (Refund)
            return $outstanding + $this->refund;
        } elseif ($outstanding > 0) {
            // Jika SR lebih besar dari PR (Kurang bayar)
            return $outstanding - $this->refund;
        }

        return 0;
    }

    // =========================================================================
    // HELPERS
    // =========================================================================

    private function user()
    {
        return Auth::user();
    }

    private function isAdmin(): bool
    {
        return $this->user()->level === 1;
    }

    private function isCreator(Sr $sr): bool
    {
        return $this->user()->id_user == $sr->id_user;
    }

    private function isSupervisor(Sr $sr): bool
    {
        $creatorSupervisorId = $sr->user?->supervisor ?? null;
        return $this->user()->id_user == $creatorSupervisorId;
    }

    public function getQr($text)
    {
        try {
            $qr = new QrCode(
                data: $text,
                errorCorrectionLevel: ErrorCorrectionLevel::Low,
                size: 200,
                margin: 10
            );
            $writer = new PngWriter();
            $result = $writer->write($qr);
            return $result->getDataUri();
        } catch (\Throwable $e) {
            return '';
        }
    }

    private function deleteSignaturesAll(int $idPr, int $docType): void
    {
        SignTransaction::where('id_pr', $idPr)
            ->where('id_doc_type', $docType)
            ->whereNotIn('status', [12, 13])
            ->delete();
    }

    private function getApprovalPermissionForStatus(int $status): ?string
    {
        return match ($status) {
            1 => 'sr.approve.step1',
            2 => 'sr.approve.step2',
            3 => 'sr.approve.step3',
            4 => 'sr.approve.step4',
            5 => 'sr.approve.step5',
            6 => 'sr.approve.step6',
            default => null,
        };
    }

    public function getSignForStep(int $stepStatus): ?SignTransaction
    {
        return $this->sr->signTransactions
            ->where('status', $stepStatus)
            ->first();
    }

    public function getSignStepsProperty(): array
    {
        $sr     = $this->sr;
        $status = intval($sr->status);

        $steps = [
            [
                'label'   => 'Prepared By',
                'step'    => 0,
                'signed'  => $status >= 1,
                'name'    => $sr->user->name ?? '-',
                'sign'    => $this->getSignForStep(1),
                'canSign' => false,
                'img'     => $sr->user->signature ?? null,
                'date'    => $sr->created_at,
            ],
            [
                'label'   => 'Review Dept',
                'step'    => 1,
                'signed'  => $status >= 2,
                'sign'    => $this->getSignForStep(2),
                'canSign' => $this->canUserApproveCurrentStep() && $status === 1,
                'img'     => null,
            ],
            [
                'label'   => 'Review Director',
                'step'    => 2,
                'signed'  => $status >= 3,
                'sign'    => $this->getSignForStep(3),
                'canSign' => $this->canUserApproveCurrentStep() && $status === 2,
                'img'     => null,
            ],
            [
                'label'   => 'Review Accounting',
                'step'    => 3,
                'signed'  => $status >= 4,
                'sign'    => $this->getSignForStep(4),
                'canSign' => $this->canUserApproveCurrentStep() && $status === 3,
                'img'     => null,
            ],
            [
                'label'   => 'Review Finance',
                'step'    => 4,
                'signed'  => $status >= 5,
                'sign'    => $this->getSignForStep(5),
                'canSign' => $this->canUserApproveCurrentStep() && $status === 4,
                'img'     => null,
            ],
            [
                'label'   => 'Review SPV Finance',
                'step'    => 5,
                'signed'  => $status >= 6,
                'sign'    => $this->getSignForStep(6),
                'canSign' => $this->canUserApproveCurrentStep() && $status === 5,
                'img'     => null,
            ],
            [
                'label'   => 'Review CFO',
                'step'    => 6,
                'signed'  => $status >= 7,
                'sign'    => $this->getSignForStep(7),
                'canSign' => $this->canUserApproveCurrentStep() && $status === 6,
                'img'     => null,
            ],
        ];

        return $steps;
    }

    private function getNextStatus(int $status): int
    {
        // SR goes sequentially 1→2→3→4→5→6→7 (all 6 steps)
        return $status + 1;
    }

    public function canUserApproveCurrentStep(): bool
    {
        $sr     = $this->sr;
        $status = intval($sr->status);

        if ($status < 1 || $status > 6) return false;

        $permission = $this->getApprovalPermissionForStatus($status);
        if (!$permission) return false;

        $user = $this->user();

        if ($this->isAdmin()) return true;

        // Step 1 (Dept/Supervisor): harus dept sama & tidak boleh approve milik sendiri
        if ($status === 1) {
            if ($this->isCreator($sr)) return false;
            return $this->isSupervisor($sr)
                || ($user->hasPermission('sr.approve.step1') && $user->id_departement == $sr->id_departement);
        }

        // Director tidak boleh approve SR milik sendiri
        if ($status === 2 && $this->isCreator($sr)) {
            return false;
        }

        return $this->isAdmin() || $user->hasPermission($permission);
    }

    public function canUserCancelApproval(): bool
    {
        $sr     = $this->sr;
        $status = intval($sr->status);

        // Bisa cancel dari status 2-7 dan juga dari 11 (Balance/Paid yang skip dari step6)
        $validCancelStatuses = [2, 3, 4, 5, 6, 7, 11];
        if (!in_array($status, $validCancelStatuses)) return false;

        $user = $this->user();
        if ($this->isAdmin()) return true;

        // Creator tidak boleh cancel di status 2 dan 3
        if (in_array($status, [2, 3]) && $this->isCreator($sr)) {
            return false;
        }

        // Status 11 (Balance/Paid) cancel approval pake izin khusus step6
        if ($status === 11) {
            return $user->hasPermission('sr.cancel_approve.step6');
        }

        $permission = "sr.cancel_approve.step" . ($status - 1);
        if ($user->hasPermission($permission)) return true;

        $sign = SignTransaction::where('id_pr', $sr->id_pr)
            ->where('id_doc_type', $sr->id_doc_type)
            ->where('status', $status)
            ->where('id_user', Auth::id())
            ->first();

        return ($sign !== null);
    }

    // =========================================================================
    // ACTIONS: SUBMIT SR
    // =========================================================================

    public function submitSr($note = null)
    {
        if ($note) $this->note = $note;
        $sr = $this->sr;

        if (!in_array($sr->status, [null, 0, 12])) {
            $this->dispatch('alert', ['type' => 'danger', 'message' => 'SR tidak dapat disubmit pada status ini.']);
            return;
        }

        $canSubmit = $this->isAdmin() || ($this->isCreator($sr) && $this->user()->hasPermission('sr.submit'));
        if (!$canSubmit) {
            $this->dispatch('alert', ['type' => 'danger', 'message' => 'Anda tidak memiliki izin untuk melakukan submit SR ini.']);
            return;
        }

        if ($sr->details->count() === 0) {
            $this->dispatch('alert', ['type' => 'danger', 'message' => 'Tambahkan minimal 1 item detail sebelum submit.']);
            return;
        }

        // Validasi wajib attachment di tbl_attachment_sr
        $attachmentCount = \App\Models\SrAttachment::where('id_sr', $sr->id_sr)->count();
        if ($attachmentCount === 0) {
            $this->dispatch('alert', ['type' => 'danger', 'message' => 'Attachment wajib dilampirkan sebelum submit SR.']);
            return;
        }

        DB::beginTransaction();
        try {
            $sr->update(['status' => 1]);

            SignTransaction::create([
                'id_pr'           => $sr->id_pr,
                'id_user'         => Auth::id(),
                'id_doc_type'     => $sr->id_doc_type,
                'status'          => 1,
                'signature_file'  => null,
                'director_reason' => empty(trim($this->note)) ? null : trim($this->note),
            ]);

            // Hapus riwayat revisi sebelumnya
            SignTransaction::where('id_pr', $sr->id_pr)
                ->where('id_doc_type', $sr->id_doc_type)
                ->where('status', 12)
                ->delete();

            DB::commit();
            unset($this->sr);
            $this->dispatch('alert', ['type' => 'success', 'message' => 'SR berhasil disubmit, menunggu persetujuan Dept.']);
            $this->dispatch('sr-refresh');
            return;
        } catch (\Exception $e) {
            DB::rollBack();
            $this->dispatch('alert', ['type' => 'danger', 'message' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }

    // =========================================================================
    // ACTIONS: CANCEL SUBMIT
    // =========================================================================

    public function cancelSubmit()
    {
        $sr = $this->sr;

        if ($sr->status != 1) {
            $this->dispatch('alert', ['type' => 'danger', 'message' => 'SR tidak dapat dibatalkan pada status ini.']);
            return;
        }

        $canCancelSubmit = $this->isAdmin()
            || (($this->isCreator($sr) || $this->isSupervisor($sr)) && $this->user()->hasPermission('sr.cancel_submit'));

        if (!$canCancelSubmit) {
            $this->dispatch('alert', ['type' => 'danger', 'message' => 'Anda tidak memiliki akses untuk membatalkan submit SR ini.']);
            return;
        }

        DB::beginTransaction();
        try {
            $sr->update(['status' => 0]);

            SignTransaction::where('id_pr', $sr->id_pr)
                ->where('id_doc_type', $sr->id_doc_type)
                ->where('status', 1)
                ->delete();

            DB::commit();
            unset($this->sr);
            $this->dispatch('alert', ['type' => 'success', 'message' => 'Submit SR berhasil dibatalkan.']);
            $this->dispatch('sr-refresh');
            return;
        } catch (\Exception $e) {
            DB::rollBack();
            $this->dispatch('alert', ['type' => 'danger', 'message' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }

    // =========================================================================
    // ACTIONS: APPROVE
    // =========================================================================

    public function approve()
    {
        if (!$this->canUserApproveCurrentStep()) {
            $this->dispatch('alert', ['type' => 'danger', 'message' => 'Anda tidak memiliki izin untuk melakukan approval ini.']);
            return;
        }

        $sr     = $this->sr;
        $status = intval($sr->status);

        // Untuk Step 6 (CFO), cek balance setelah approve
        // Jika balance = 0, langsung ke status 11 (Balance/Paid)
        // Jika masih ada selisih, ke status 7 (Pending Payment)
        if ($status === 6) {
            $balance    = $this->balance;
            $nextStatus = ($balance == 0) ? 11 : 7;
        } else {
            $nextStatus = $this->getNextStatus($status);
        }

        DB::beginTransaction();
        try {
            $sr->update(['status' => $nextStatus]);

            SignTransaction::create([
                'id_pr'           => $sr->id_pr,
                'id_user'         => Auth::id(),
                'id_doc_type'     => $sr->id_doc_type,
                'status'          => $nextStatus,
                'signature_file'  => null,
                'director_reason' => empty(trim($this->note)) ? null : trim($this->note),
            ]);

            DB::commit();
            session()->flash('success', 'SR berhasil disetujui.');
            return $this->redirect(route('settlement-reports.index'), navigate: true);
        } catch (\Exception $e) {
            DB::rollBack();
            $this->dispatch('alert', ['type' => 'danger', 'message' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }

    #[\Livewire\Attributes\On('processSign')]
    public function processSign(string $action, string $role, string $note = '')
    {
        $this->note           = $note;
        $this->revisionReason = $note;
        $this->rejectReason   = $note;

        match ($action) {
            'approve'  => $this->approve(),
            'revision' => $this->revision(),
            'reject'   => $this->reject(),
            'submit'   => $this->submitSr($note),
            'cancelSubmit' => $this->cancelSubmit(),
            'cancelApproval' => $this->cancelApproval(),
            default    => null,
        };
    }

    // =========================================================================
    // ACTIONS: REVISION
    // =========================================================================

    public function revision()
    {
        $this->validate(
            ['revisionReason' => 'required|string|min:3'],
            ['revisionReason.required' => 'Alasan revisi wajib diisi.']
        );

        if (!$this->isAdmin() && !$this->user()->hasPermission('sr.revision') && !$this->canUserApproveCurrentStep()) {
            $this->dispatch('alert', ['type' => 'danger', 'message' => 'Anda tidak memiliki izin untuk melakukan revisi ini.']);
            return;
        }

        $sr = $this->sr;

        if (!$this->isAdmin() && in_array($sr->status, [1, 2]) && $this->isCreator($sr)) {
            $this->dispatch('alert', ['type' => 'danger', 'message' => 'Pemilik data dilarang melakukan revisi pada tahap ini.']);
            return;
        }

        DB::beginTransaction();
        try {
            $sr->update(['status' => 12]);

            $this->deleteSignaturesAll($sr->id_pr, $sr->id_doc_type);

            SignTransaction::create([
                'id_pr'         => $sr->id_pr,
                'id_user'       => Auth::id(),
                'id_doc_type'   => $sr->id_doc_type,
                'status'        => 12,
                'reject_reason' => $this->revisionReason,
            ]);

            DB::commit();
            unset($this->sr);
            $this->revisionReason = null;
            $this->dispatch('alert', ['type' => 'success', 'message' => 'SR dikembalikan untuk revisi.']);
            $this->dispatch('sr-refresh');
            return;
        } catch (\Exception $e) {
            DB::rollBack();
            $this->dispatch('alert', ['type' => 'danger', 'message' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }

    // =========================================================================
    // ACTIONS: REJECT
    // =========================================================================

    public function reject()
    {
        $this->validate(
            ['rejectReason' => 'required|string|min:3'],
            ['rejectReason.required' => 'Alasan penolakan wajib diisi.']
        );

        if (!$this->isAdmin() && !$this->user()->hasPermission('sr.reject') && !$this->canUserApproveCurrentStep()) {
            $this->dispatch('alert', ['type' => 'danger', 'message' => 'Anda tidak memiliki izin untuk menolak SR ini.']);
            return;
        }

        $sr = $this->sr;

        if (!$this->isAdmin() && in_array($sr->status, [1, 2]) && $this->isCreator($sr)) {
            $this->dispatch('alert', ['type' => 'danger', 'message' => 'Pemilik data dilarang melakukan penolakan pada tahap ini.']);
            return;
        }

        DB::beginTransaction();
        try {
            $sr->update(['status' => 13]);

            $this->deleteSignaturesAll($sr->id_pr, $sr->id_doc_type);

            SignTransaction::create([
                'id_pr'         => $sr->id_pr,
                'id_user'       => Auth::id(),
                'id_doc_type'   => $sr->id_doc_type,
                'status'        => 13,
                'reject_reason' => $this->rejectReason,
            ]);

            DB::commit();
            unset($this->sr);
            $this->rejectReason = null;
            $this->dispatch('alert', ['type' => 'success', 'message' => 'SR berhasil ditolak.']);
            $this->dispatch('sr-refresh');
            return;
        } catch (\Exception $e) {
            DB::rollBack();
            $this->dispatch('alert', ['type' => 'danger', 'message' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }

    // =========================================================================
    // ACTIONS: CANCEL APPROVAL
    // =========================================================================

    public function cancelApproval()
    {
        if (!$this->canUserCancelApproval()) {
            $this->dispatch('alert', ['type' => 'danger', 'message' => 'Anda tidak memiliki izin untuk membatalkan approval ini.']);
            return;
        }

        $sr       = $this->sr;
        $status   = intval($sr->status);
        // Jika cancel dari status 11 (Balance/Paid), kembalikan ke 6 (Pending CFO)
        $revertTo = ($status === 11) ? 6 : ($status - 1);

        DB::beginTransaction();
        try {
            $sr->update(['status' => $revertTo]);

            SignTransaction::where('id_pr', $sr->id_pr)
                ->where('id_doc_type', $sr->id_doc_type)
                ->where('status', $status)
                ->delete();

            DB::commit();
            unset($this->sr);
            $this->dispatch('alert', ['type' => 'success', 'message' => 'Approval SR berhasil dibatalkan.']);
            $this->dispatch('sr-refresh');
            return;
        } catch (\Exception $e) {
            DB::rollBack();
            $this->dispatch('alert', ['type' => 'danger', 'message' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }

    // =========================================================================
    // ACTIONS: DELETE SR
    // =========================================================================

    public function deleteSr()
    {
        $sr = $this->sr;

        if (!in_array($sr->status, [null, 0, 13])) {
            $this->dispatch('alert', ['type' => 'danger', 'message' => 'SR hanya bisa dihapus saat Draft atau Rejected.']);
            return;
        }

        if (!$this->isAdmin() && !$this->isCreator($sr)) {
            $this->dispatch('alert', ['type' => 'danger', 'message' => 'Anda tidak memiliki izin menghapus SR ini.']);
            return;
        }

        DB::beginTransaction();
        try {
            SignTransaction::where('id_pr', $sr->id_pr)
                ->where('id_doc_type', $sr->id_doc_type)
                ->delete();

            foreach ($sr->attachments as $att) {
                if ($att->filename) {
                    $f = public_path('assets/attachmentsr') . DIRECTORY_SEPARATOR . $att->filename;
                    if (is_file($f)) unlink($f);
                }
            }

            $sr->details()->forceDelete();
            $sr->attachments()->forceDelete();
            $sr->delete();
            DB::commit();

            session()->flash('success', 'SR berhasil dihapus.');
            return redirect()->route('settlement-reports.index');
        } catch (\Exception $e) {
            DB::rollBack();
            $this->dispatch('alert', ['type' => 'danger', 'message' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }

    // =========================================================================
    // ACTIONS: SAVE LOAN
    // =========================================================================

    public function saveLoan()
    {
        $sr = $this->sr;

        if (!$this->isAdmin() && !$this->user()->hasPermission('loan.view')) {
            $this->dispatch('alert', ['type' => 'danger', 'message' => 'Anda tidak memiliki akses untuk mengatur Loan.']);
            return;
        }

        if (in_array($sr->status, [11])) {
            $this->dispatch('alert', ['type' => 'danger', 'message' => 'Loan tidak bisa diubah karena SR sudah berstatus Paid/Selesai.']);
            return;
        }

        DB::beginTransaction();
        try {
            $sr->update(['id_loan' => $this->id_loan ?: null]);
            DB::commit();
            unset($this->sr);
            $this->dispatch('alert', ['type' => 'success', 'message' => 'Data Loan berhasil disimpan.']);
            $this->dispatch('sr-refresh');
            $this->dispatch('close-modal-loan');
        } catch (\Exception $e) {
            DB::rollBack();
            $this->dispatch('alert', ['type' => 'danger', 'message' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }

    // =========================================================================
    // RENDER
    // =========================================================================

    public function render()
    {
        $loans = \App\Models\Loan::all();
        return view('livewire.settlement-reports.show', compact('loans'))->layout('layouts.app');
    }
}
