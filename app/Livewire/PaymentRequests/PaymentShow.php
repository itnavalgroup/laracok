<?php

namespace App\Livewire\PaymentRequests;

use Livewire\Component;
use App\Models\Pr;
use App\Models\Payment;
use App\Models\PaymentAttachment;
use App\Models\SignTransaction;
use App\Models\Attachment;
use Illuminate\Support\Facades\Auth;

class PaymentShow extends Component
{
    public $prId;
    public $prHash;

    public function mount($hash)
    {
        $id = hashid_decode($hash, 'pr');
        if (!$id) abort(404);

        $pr   = Pr::findOrFail($id);
        $user = Auth::user();

        $canAccess = $user->level === 1
            || $user->id_user == $pr->id_user
            || $user->hasPermission('pr.payment')
            || $user->hasPermission('pr_payment.view')
            || $user->hasPermission('pr_payment.create');

        if (!$canAccess) abort(403, 'Anda tidak memiliki akses ke halaman payment.');

        $this->prId   = $id;
        $this->prHash = $hash;
    }

    public function getPrProperty()
    {
        return Pr::with([
            'user',
            'departement',
            'company',
            'vendor',
            'details.uom',
            'currency',
            'docType',
            'costCategory',
            'costType',
            'norek_vendor',
            'invoices',
            'attachmentPrs.attachment',
        ])->findOrFail($this->prId);
    }

    public function getPaymentsProperty()
    {
        return Payment::with(['user', 'attachments'])
            ->where('id_pr', $this->prId)
            ->where('id_doc_type', $this->pr->id_doc_type)
            ->orderBy('id_payment', 'ASC')
            ->get();
    }

    public function getGrandTotalProperty()
    {
        // AMOUNT DUE
        $total = $this->pr->details->sum('ammount');
        return $total - floatval($this->pr->additional_discount ?? 0);
    }

    public function getTotalPaidProperty()
    {
        // TOTAL PAYMENT (includes additional)
        return $this->payments->sum('grand_total');
    }

    public function getBalanceProperty()
    {
        // BALANCE
        return $this->grandTotal - $this->totalPaid;
    }

    public function getAttachmentTypesProperty()
    {
        return Attachment::orderBy('attachment')->get();
    }
    public function canCreatePayment(int $type = 2): bool
    {
        $user = Auth::user();
        if ($user->level === 1 || $user->hasPermission('pr_payment.create')) {
            return true;
        }
        // Owner PR selalu bisa tambah payment jika payment_type_pr == 1
        if ($this->pr->payment_type_pr == 1 && $user->id_user == $this->pr->id_user) {
            return true;
        }
        return false;
    }

    public function canEditPayment($id_user): bool
    {
        $user = Auth::user();
        return $user->level === 1 || $user->id_user == $id_user;
    }

    public function canDeletePayment($id_user): bool
    {
        return $this->canEditPayment($id_user);
    }

    public function canAddAttachment(int $type): bool
    {
        $user = Auth::user();
        $prStatus = intval($this->pr->status);

        // Jika sedang dalam proses approval payment, jangan boleh upload dulu
        if (in_array($prStatus, [14, 15])) {
            return false;
        }

        if ($user->level === 1 || $user->hasPermission('pr_payment.create')) {
            return true;
        }

        // Owner PR selalu boleh kelola attachment jika payment_type_pr == 1
        if ($this->pr->payment_type_pr == 1 && $user->id_user == $this->pr->id_user) {
            return true;
        }
        return false;
    }

    public function canApproveStep1(): bool
    {
        $pr   = $this->pr;
        $user = Auth::user();

        // Manager Dept atau Admin
        $canApprove = $user->level === 1 || (
            $user->hasPermission('pr_payment.approve.step1') &&
            $user->id_departement == $pr->user->id_departement
        );
        return $canApprove && $pr->status == 15;
    }

    public function canCancelApproveStep1(): bool
    {
        $pr   = $this->pr;
        $user = Auth::user();
        $canCancel = $user->level === 1 || (
            $user->hasPermission('pr_payment.cancel_approve.step1') &&
            $user->id_departement == $pr->user->id_departement
        );

        // Bisa cancel jika baru approve step 1 (status 14) dan Director belum approve
        // Cek apakah payment terakhir sudah diapprove director (berdasarkan string filename)
        $payment = $this->payments->last();
        $hasApprovalDirector = $payment && str_contains($payment->filename ?? '', 'approved_director');

        return $canCancel && $pr->status == 14 && !$hasApprovalDirector;
    }

    public function canApprovePaymentDirector(): bool
    {
        $pr   = $this->pr;
        $user = Auth::user();
        $canApprove = $user->level === 1 || $user->hasPermission('pr_payment.approve.step2');
        return $canApprove && $pr->status == 14;
    }

    public function canCancelApprovePaymentDirector(): bool
    {
        $user = Auth::user();
        $pr   = $this->pr;

        // Cek apakah payment terakhir sudah ada tanda tangannya director
        $lastPayment = $this->payments->last();
        $hasApprovalDirector = $lastPayment && str_contains($lastPayment->filename ?? '', 'approved_director');

        $canCancel = $user->level === 1 || ($user->hasPermission('pr_payment.cancel_approve.step2'));

        // Bisa cancel jika director sudah approve (status PR bisa 8, 9, 10, 11)
        return $canCancel && $hasApprovalDirector && in_array($pr->status, [8, 9, 10, 11]);
    }

    public function canRevision(): bool
    {
        $pr   = $this->pr;
        $user = Auth::user();
        $isApprover = $user->level === 1
            || $user->hasPermission('pr_payment.approve.step1')
            || $user->hasPermission('pr_payment.approve.step2');

        return $isApprover && in_array($pr->status, [14, 15]);
    }

    public function render()
    {
        return view('livewire.payment-requests.payment-show', [
            'pr'              => $this->pr,
            'payments'        => $this->payments,
            'grandTotal'      => $this->grandTotal,
            'totalPaid'       => $this->totalPaid,
            'balance'         => $this->balance,
            'attachmentTypes' => $this->attachmentTypes,
        ])->layout('layouts.app');
    }
}
