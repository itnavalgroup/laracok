<?php

namespace App\Livewire\PaymentRequests;

use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\Attributes\Computed;
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
    public $prId;
    public $rejectReason;
    public $revisionReason;
    public $note;
    public $id_loan;

    public function mount($hash)
    {
        $id = hashid_decode($hash, 'pr');
        if (!$id) abort(404);

        $this->prId = $id;

        $pr   = Pr::findOrFail($this->prId);
        $user = Auth::user();

        $canView = $user->level === 1
            || $user->id_user == $pr->id_user
            || $user->hasPermission('pr_detail.view')
            || $user->hasPermission('pr.approve.step1')
            || $user->hasPermission('pr.approve.step2')
            || $user->hasPermission('pr.approve.step3')
            || $user->hasPermission('pr.approve.step4')
            || $user->hasPermission('pr.approve.step5')
            || $user->hasPermission('pr.approve.step6')
            || $user->hasPermission('pr.payment')
            || $user->hasPermission('pr_invoice.view');

        if (!$canView) {
            session()->flash('error', 'Anda tidak memiliki akses untuk melihat Payment Request ini.');
            return redirect()->route('payment-requests.index');
        }
    }

    // =========================================================================
    // COMPUTED PROPERTIES
    // =========================================================================

    #[On('pr-refresh')]
    public function refresh()
    {
        unset($this->pr);
        unset($this->grandTotal);
        unset($this->prHash);
    }

    #[Computed]
    public function pr()
    {
        return Pr::with([
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
            'invoices.user',
            'currency',
            'docType',
            'costCategory',
            'costType',
            'loan',
            'norek_vendor',
            'emailUser',
            'emailVendor',
            'attachmentPrs.user',
            'attachmentPrs.attachment',
        ])->findOrFail($this->prId);
    }

    #[Computed]
    public function grandTotal()
    {
        $total = $this->pr->details->sum('ammount');
        return $total - floatval($this->pr->additional_discount ?? 0);
    }

    #[Computed]
    public function prHash()
    {
        return hashid_encode($this->prId, 'pr');
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

    private function isCreator(Pr $pr): bool
    {
        return $this->user()->id_user == $pr->id_user;
    }

    private function isSupervisor(Pr $pr): bool
    {
        $creatorSupervisorId = $pr->user?->supervisor ?? null;
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

    /**
     * Hapus semua signature record untuk PR ini (per doc_type)
     * Digunakan saat revision/reject
     */
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
            1 => 'pr.approve.step1',
            2 => 'pr.approve.step2',
            3 => 'pr.approve.step3',
            4 => 'pr.approve.step4',
            5 => 'pr.approve.step5',
            6 => 'pr.approve.step6',
            default => null,
        };
    }

    public function getSignForStep(int $stepStatus): ?SignTransaction
    {
        return $this->pr->signTransactions
            ->where('status', $stepStatus)
            ->first();
    }

    public function getSignStepsProperty(): array
    {
        $pr      = $this->pr;
        $status  = intval($pr->status);
        $docType = intval($pr->id_doc_type);

        $steps = [
            [
                'label'   => 'Prepared By',
                'step'    => 0,
                'signed'  => $status >= 1,
                'name'    => $pr->user->name ?? '-',
                'sign'    => $this->getSignForStep(1),
                'canSign' => false,
                'img'     => $pr->user->signature ?? null,
                'date'    => $pr->created_at,
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
                'signed'  => $status >= 3 || ($docType == 2 && $status >= 4),
                'sign'    => $this->getSignForStep(3),
                'canSign' => $this->canUserApproveCurrentStep() && $status === 2,
                'img'     => null,
            ],
        ];

        // Accounting: hanya doc_type 1 & 3
        if ($docType != 2) {
            $steps[] = [
                'label'   => 'Review Accounting',
                'step'    => 3,
                'signed'  => $status >= 4,
                'sign'    => $this->getSignForStep(4),
                'canSign' => $this->canUserApproveCurrentStep() && $status === 3,
                'img'     => null,
            ];
        }

        $steps[] = [
            'label'   => 'Review Finance',
            'step'    => 4,
            'signed'  => $status >= 5,
            'sign'    => $this->getSignForStep(5),
            'canSign' => $this->canUserApproveCurrentStep() && $status === 4,
            'img'     => null,
        ];

        $steps[] = [
            'label'   => 'Review SPV Finance',
            'step'    => 5,
            'signed'  => $status >= 6,
            'sign'    => $this->getSignForStep(6),
            'canSign' => $this->canUserApproveCurrentStep() && $status === 5,
            'img'     => null,
        ];

        $steps[] = [
            'label'   => 'Review CFO',
            'step'    => 6,
            'signed'  => $status >= 7,
            'sign'    => $this->getSignForStep(7),
            'canSign' => $this->canUserApproveCurrentStep() && $status === 6,
            'img'     => null,
        ];

        return $steps;
    }

    private function getNextStatus(int $status, int $docType): int
    {
        if ($status === 2) {
            // Director approve: doc_type 2 skip accounting → finance (4)
            return ($docType === 2) ? 4 : 3;
        }
        return $status + 1;
    }

    public function canUserApproveCurrentStep(): bool
    {
        $pr     = $this->pr;
        $status = intval($pr->status);

        if ($status < 1 || $status > 6) return false;

        $permission = $this->getApprovalPermissionForStatus($status);
        if (!$permission) return false;

        $user = $this->user();

        // Admin Bypass All
        if ($this->isAdmin()) return true;

        // Step 1 (Dept/Supervisor): harus dept sama & dilarang approve milik sendiri
        if ($status === 1) {
            if ($this->isCreator($pr)) return false;

            return $this->isSupervisor($pr)
                || ($user->hasPermission('pr.approve.step1') && $user->id_departement == $pr->id_departement);
        }

        // Director tidak boleh approve PR milik sendiri (kecuali Admin)
        if ($status === 2 && $this->isCreator($pr)) {
            return false;
        }

        // Accounting: hanya doc_type 1 & 3
        if ($status === 3 && !in_array($pr->id_doc_type, [1, 3])) {
            return false;
        }

        return $this->isAdmin() || $user->hasPermission($permission);
    }

    public function canUserCancelApproval(): bool
    {
        $pr     = $this->pr;
        $status = intval($pr->status);

        // Status yang bisa di-cancel: Approval terbaru (status PR saat ini)
        // Kita tidak bisa cancel status < 2 (Submit) atau status penutup (11 Paid, 13 Rejected)
        if ($status < 2 || $status > 7) return false;

        $user = $this->user();
        if ($this->isAdmin()) return true;

        // Step 1 & 2 tidak boleh di-cancel oleh owner data
        // status 2 = cancel step 1, status 3 = cancel step 2
        if (in_array($status, [2, 3]) && $this->isCreator($pr)) {
            return false;
        }

        // Cek permission spesifik: pr.cancel_approve.stepX
        // StepX di sini adalah step status yang akan dibatalkan (PR status saat ini)
        // Contoh: PR status 2 (Pending Director), maka cancel_approve.step1 (Dept)
        // Tapi di logic kita, cancel approval status 2 berarti mendelete sign di status 2
        // dan mengembalikan PR ke status 1.
        $permission = "pr.cancel_approve.step" . ($status - 1);
        if ($user->hasPermission($permission)) return true;

        // Fallback: Hanya yang menandatangani (approve) yang boleh cancel
        $sign = SignTransaction::where('id_pr', $pr->id_pr)
            ->where('id_doc_type', $pr->id_doc_type)
            ->where('status', $status)
            ->where('id_user', Auth::id())
            ->first();

        return ($sign !== null);
    }

    // =========================================================================
    // ACTIONS: SUBMIT PR
    // =========================================================================

    public function submitPr($note = null)
    {
        if ($note) $this->note = $note;
        $pr = $this->pr;

        if (!in_array($pr->status, [null, 0, 12])) {
            $this->dispatch('alert', ['type' => 'danger', 'message' => 'PR tidak dapat disubmit pada status ini.']);
            return;
        }

        if (!$this->isAdmin() && !$this->isCreator($pr)) {
            $this->dispatch('alert', ['type' => 'danger', 'message' => 'Hanya pembuat PR atau admin yang dapat mengsubmit.']);
            return;
        }

        if (!$this->isAdmin() && !$this->user()->hasPermission('pr.submit')) {
            $this->dispatch('alert', ['type' => 'danger', 'message' => 'Anda tidak memiliki izin (pr.submit) untuk melakukan submit.']);
            return;
        }

        if ($pr->details->count() === 0) {
            $this->dispatch('alert', ['type' => 'danger', 'message' => 'Tambahkan minimal 1 item detail sebelum submit.']);
            return;
        }

        DB::beginTransaction();
        try {
            $pr->update(['status' => 1]);

            SignTransaction::create([
                'id_pr'          => $pr->id_pr,
                'id_user'        => Auth::id(),
                'id_doc_type'    => $pr->id_doc_type,
                'status'         => 1,
                'signature_file' => null,
                'director_reason' => empty(trim($this->note)) ? null : trim($this->note),
            ]);

            // Hapus riwayat revisi
            SignTransaction::where('id_pr', $pr->id_pr)
                ->where('id_doc_type', $pr->id_doc_type)
                ->where('status', 12)
                ->delete();

            DB::commit();
            unset($this->pr);
            $this->dispatch('alert', ['type' => 'success', 'message' => 'PR berhasil disubmit, menunggu persetujuan Dept.']);
            $this->dispatch('pr-refresh');
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
        $pr = $this->pr;

        if ($pr->status != 1) {
            $this->dispatch('alert', ['type' => 'danger', 'message' => 'PR tidak dapat dibatalkan pada status ini.']);
            return;
        }

        $canCancelSubmit = $this->isAdmin()
            || $this->isCreator($pr)
            || ($this->isSupervisor($pr) && $this->user()->hasPermission('pr.cancel_submit'))
            || $this->user()->hasPermission('pr.cancel_submit');

        if (!$canCancelSubmit) {
            $this->dispatch('alert', ['type' => 'danger', 'message' => 'Anda tidak memiliki akses untuk membatalkan submit PR ini.']);
            return;
        }

        DB::beginTransaction();
        try {
            $pr->update(['status' => 0]);

            // Hapus sign submit
            SignTransaction::where('id_pr', $pr->id_pr)
                ->where('id_doc_type', $pr->id_doc_type)
                ->where('status', 1)
                ->delete();

            DB::commit();
            unset($this->pr);
            $this->dispatch('alert', ['type' => 'success', 'message' => 'Submit PR berhasil dibatalkan.']);
            $this->dispatch('pr-refresh');
            return;
        } catch (\Exception $e) {
            DB::rollBack();
            $this->dispatch('alert', ['type' => 'danger', 'message' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }

    // =========================================================================
    // ACTIONS: APPROVE (per-step, generate QR per step)
    // =========================================================================

    public function approve()
    {
        if (!$this->canUserApproveCurrentStep()) {
            $this->dispatch('alert', ['type' => 'danger', 'message' => 'Anda tidak memiliki izin untuk melakukan approval ini.']);
            return;
        }

        $pr         = $this->pr;
        $status     = intval($pr->status);
        $nextStatus = $this->getNextStatus($status, $pr->id_doc_type);

        DB::beginTransaction();
        try {
            $pr->update(['status' => $nextStatus]);

            SignTransaction::create([
                'id_pr'           => $pr->id_pr,
                'id_user'         => Auth::id(),
                'id_doc_type'     => $pr->id_doc_type,
                'status'          => $nextStatus,
                'signature_file'  => null,
                'director_reason' => empty(trim($this->note)) ? null : trim($this->note),
            ]);

            DB::commit();
            session()->flash('success', 'PR berhasil disetujui.');
            return $this->redirect(route('payment-requests.index'), navigate: true);
        } catch (\Exception $e) {
            DB::rollBack();
            $this->dispatch('alert', ['type' => 'danger', 'message' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }

    /**
     * Listener unified dari modal JS
     */
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
            default    => null,
        };
    }

    // =========================================================================
    // ACTIONS: REVISION (revisi ke pembuat)
    // =========================================================================

    public function revision()
    {
        $this->validate(
            ['revisionReason' => 'required|string|min:3'],
            ['revisionReason.required' => 'Alasan revisi wajib diisi.']
        );

        if (!$this->isAdmin() && !$this->user()->hasPermission('pr.revision') && !$this->canUserApproveCurrentStep()) {
            $this->dispatch('alert', ['type' => 'danger', 'message' => 'Anda tidak memiliki izin untuk melakukan revisi ini.']);
            return;
        }

        $pr = $this->pr;

        // Restriction: Owner dilarang revisi pada Step 1 & 2 (Status 1 & 2)
        if (!$this->isAdmin() && in_array($pr->status, [1, 2]) && $this->isCreator($pr)) {
            $this->dispatch('alert', ['type' => 'danger', 'message' => 'Pemilik data dilarang melakukan revisi pada tahap ini.']);
            return;
        }

        DB::beginTransaction();
        try {
            $pr->update(['status' => 12]);

            // Hapus semua signature files (seperti deleteSignaturesAll CI4)
            $this->deleteSignaturesAll($pr->id_pr, $pr->id_doc_type);

            // Simpan catatan revisi
            SignTransaction::create([
                'id_pr'         => $pr->id_pr,
                'id_user'       => Auth::id(),
                'id_doc_type'   => $pr->id_doc_type,
                'status'        => 12,
                'reject_reason' => $this->revisionReason,
            ]);

            DB::commit();
            unset($this->pr);
            $this->revisionReason = null;
            $this->dispatch('alert', ['type' => 'success', 'message' => 'PR dikembalikan untuk revisi.']);
            $this->dispatch('pr-refresh');
            return;
        } catch (\Exception $e) {
            DB::rollBack();
            $this->dispatch('alert', ['type' => 'danger', 'message' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }

    // =========================================================================
    // ACTIONS: REJECT (tolak permanen)
    // =========================================================================

    public function reject()
    {
        $this->validate(
            ['rejectReason' => 'required|string|min:3'],
            ['rejectReason.required' => 'Alasan penolakan wajib diisi.']
        );

        if (!$this->isAdmin() && !$this->user()->hasPermission('pr.reject') && !$this->canUserApproveCurrentStep()) {
            $this->dispatch('alert', ['type' => 'danger', 'message' => 'Anda tidak memiliki izin untuk menolak PR ini.']);
            return;
        }

        $pr = $this->pr;

        // Restriction: Owner dilarang reject pada Step 1 & 2 (Status 1 & 2)
        if (!$this->isAdmin() && in_array($pr->status, [1, 2]) && $this->isCreator($pr)) {
            $this->dispatch('alert', ['type' => 'danger', 'message' => 'Pemilik data dilarang melakukan penolakan pada tahap ini.']);
            return;
        }

        DB::beginTransaction();
        try {
            $pr->update(['status' => 13]);

            // Hapus semua signature files
            $this->deleteSignaturesAll($pr->id_pr, $pr->id_doc_type);

            SignTransaction::create([
                'id_pr'         => $pr->id_pr,
                'id_user'       => Auth::id(),
                'id_doc_type'   => $pr->id_doc_type,
                'status'        => 13,
                'reject_reason' => $this->rejectReason,
            ]);

            DB::commit();
            unset($this->pr);
            $this->rejectReason = null;
            $this->dispatch('alert', ['type' => 'success', 'message' => 'PR berhasil ditolak.']);
            $this->dispatch('pr-refresh');
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

        $pr         = $this->pr;
        $status     = intval($pr->status);
        $revertTo   = $status - 1;

        // Untuk doc_type 2 saat status 4 (Finance), revert ke 2 (Director)
        if ($status === 4 && $pr->id_doc_type == 2) {
            $revertTo = 2;
        }

        DB::beginTransaction();
        try {
            $pr->update(['status' => $revertTo]);

            // Hapus sign record status tersebut (siapapun yang tanda tangan)
            SignTransaction::where('id_pr', $pr->id_pr)
                ->where('id_doc_type', $pr->id_doc_type)
                ->where('status', $status)
                ->delete();

            DB::commit();
            unset($this->pr);
            $this->dispatch('alert', ['type' => 'success', 'message' => 'Approval berhasil dibatalkan.']);
            $this->dispatch('pr-refresh');
            return;
        } catch (\Exception $e) {
            DB::rollBack();
            $this->dispatch('alert', ['type' => 'danger', 'message' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }

    // =========================================================================
    // ACTIONS: DELETE PR
    // =========================================================================

    public function deletePr()
    {
        $pr = $this->pr;

        if (!in_array($pr->status, [null, 0, 13])) {
            $this->dispatch('alert', ['type' => 'danger', 'message' => 'PR hanya bisa dihapus saat Draft atau Rejected.']);
            return;
        }

        if (!$this->isAdmin() && !$this->isCreator($pr)) {
            $this->dispatch('alert', ['type' => 'danger', 'message' => 'Anda tidak memiliki izin menghapus PR ini.']);
            return;
        }

        DB::beginTransaction();
        try {
            SignTransaction::where('id_pr', $pr->id_pr)->delete();

            // Hapus attachment PR dari /attachmentpr/
            foreach ($pr->attachmentPrs as $att) {
                if ($att->filename) {
                    $f = public_path('assets/attachmentpr') . DIRECTORY_SEPARATOR . $att->filename;
                    if (is_file($f)) unlink($f);
                }
            }

            $pr->delete();
            DB::commit();

            session()->flash('success', 'PR berhasil dihapus.');
            return redirect()->route('payment-requests.index');
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
        $pr = $this->pr;

        // Cek izin (hanya Admin atau yang punya permission 'loan.view')
        if (!$this->isAdmin() && !$this->user()->hasPermission('loan.view')) {
            $this->dispatch('alert', ['type' => 'danger', 'message' => 'Anda tidak memiliki akses untuk mengatur Loan.']);
            return;
        }

        // Cek status PR (tidak bisa diubah jika sudah full approve / paid -> status 11)
        if (in_array($pr->status, [11])) {
            $this->dispatch('alert', ['type' => 'danger', 'message' => 'Loan tidak bisa diubah karena PR sudah berstatus Paid/Selesai.']);
            return;
        }

        DB::beginTransaction();
        try {
            $pr->update(['id_loan' => $this->id_loan ?: null]);

            DB::commit();
            unset($this->pr);
            $this->dispatch('alert', ['type' => 'success', 'message' => 'Data Loan berhasil disimpan.']);
            $this->dispatch('pr-refresh');
            $this->dispatch('close-modal-loan'); // Tutup modal via dispatch event
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
        $existingSr = \App\Models\Sr::where('id_pr', $this->prId)->first();
        return view('livewire.payment-requests.show', compact('loans', 'existingSr'))->layout('layouts.app');
    }
}
