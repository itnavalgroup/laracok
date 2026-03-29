<?php

namespace App\Livewire\PaymentRequests;

use Livewire\Component;
use App\Models\Pr;
use App\Models\Invoice;
use App\Models\PrDetail;
use Illuminate\Support\Facades\Auth;

class InvoiceShow extends Component
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
            || $user->hasPermission('pr_invoice.view')
            || $user->hasPermission('pr_invoice.create');

        if (!$canAccess) {
            session()->flash('error', 'Anda tidak memiliki akses ke halaman invoice.');
            $this->redirect(route('payment-requests.show', $hash));
            return;
        }

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
            'norek_vendor',
            'signTransactions.user',
        ])->findOrFail($this->prId);
    }

    public function getInvoiceProperty()
    {
        return Invoice::where('id_pr', $this->prId)
            ->where('id_doc_type', $this->pr->id_doc_type)
            ->first();
    }

    public function getDetailsProperty()
    {
        return PrDetail::with('uom')->where('id_pr', $this->prId)->get();
    }

    public function getGrandTotalProperty()
    {
        $total = $this->details->sum('ammount');
        return $total - floatval($this->pr->additional_discount ?? 0);
    }

    public function isOwner(): bool
    {
        $user = Auth::user();
        return $user !== null && $user->id_user == $this->pr->id_user;
    }

    public function isAdmin(): bool
    {
        return Auth::user()->level === 1;
    }

    public function canCreate(): bool
    {
        $user = Auth::user();
        if ($user->level === 1) return true;

        return $this->isOwner() && $user->hasPermission('pr_invoice.create');
    }

    public function canEdit(): bool
    {
        return $this->isAdmin() || $this->isOwner();
    }

    public function canDelete(): bool
    {
        return $this->isAdmin() || $this->isOwner();
    }

    public function canPrint(): bool
    {
        $user = Auth::user();
        return $this->isOwner()
            || $this->isAdmin()
            || $user->hasPermission('pr_invoice.print');
    }

    public function canDownload(): bool
    {
        $user = Auth::user();
        return $this->isOwner()
            || $this->isAdmin()
            || $user->hasPermission('pr_invoice.download');
    }

    public function canView(): bool
    {
        $user = Auth::user();
        return $this->isOwner()
            || $this->isAdmin()
            || $user->hasPermission('pr_invoice.view');
    }

    public function canUploadAttachment(): bool
    {
        $user = Auth::user();
        return $this->isOwner()
            || $this->isAdmin()
            || $user->hasPermission('pr_invoice.edit');
    }

    public function render()
    {
        $pr        = $this->pr;
        $invoice   = $this->invoice;
        $details   = $this->details;
        $grandTotal = $this->grandTotal;

        $canCreate           = $this->canCreate();
        $canEdit             = $this->canEdit();
        $canDelete           = $this->canDelete();
        $canPrint            = $this->canPrint();
        $canDownload         = $this->canDownload();
        $canUploadAttachment = $this->canUploadAttachment();

        return view('livewire.payment-requests.invoice-show', compact(
            'pr',
            'invoice',
            'details',
            'grandTotal',
            'canCreate',
            'canEdit',
            'canDelete',
            'canPrint',
            'canDownload',
            'canUploadAttachment'
        ))->layout('layouts.app');
    }
}
