<?php

namespace App\Livewire\SettlementReports;

use Livewire\Component;
use App\Models\Sr;
use App\Models\Payment;
use App\Models\Attachment;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]
class PaymentShow extends Component
{
    public $srId;
    public $prHash;

    public function mount($hash)
    {
        $id = hashid_decode($hash, 'pr');
        if (!$id) abort(404);

        // SR diakses melalui id_pr (sama dengan sistem CI4)
        $sr   = Sr::where('id_pr', $id)->firstOrFail();
        $user = Auth::user();

        $canAccess = $user->level === 1
            || $user->id_user == $sr->id_user
            || $user->hasPermission('sr.payment')
            || $user->hasPermission('sr_payment.view')
            || $user->hasPermission('sr_payment.create');

        if (!$canAccess) abort(403, 'Anda tidak memiliki akses ke halaman payment SR.');

        $this->srId   = $sr->id_sr; // simpan id_sr (primary key)
        $this->prHash = $hash;
    }

    public function getSrProperty()
    {
        return Sr::with([
            'user',
            'departement',
            'company',
            'vendor',
            'details.uom',
            'currency',
            'docType',
            'costCategory',
            'costType',
            'norekVendor',
            'attachments.attachment',
        ])->findOrFail($this->srId);
    }

    public function getPaymentsProperty()
    {
        return Payment::with(['user', 'attachments'])
            ->where('id_pr', $this->sr->id_pr) // Link payment by id_pr
            ->where('id_doc_type', 3) // Hardcode to 3 (Settlement)
            ->orderBy('id_payment', 'ASC')
            ->get();
    }

    public function getGrandTotalProperty()
    {
        // AMOUNT DUE: hanya SUM ammount (additional_discount tidak masuk kalkulasi payment SR)
        return $this->sr->details->sum('ammount');
    }

    public function getReceiptProperty()
    {
        // Total payment dari PR asli (id_doc_type 1 atau 2)
        return Payment::where('id_pr', $this->sr->id_pr)
            ->whereIn('id_doc_type', [1, 2])
            ->sum('grand_total');
    }

    public function getRefundProperty()
    {
        // Total payment/refund dari SR ini (id_doc_type 3)
        return $this->payments->sum('grand_total');
    }

    public function getTotalPaidProperty()
    {
        // TOTAL PAYMENT (includes additional) - alias untuk view
        return $this->refund;
    }

    public function getBalanceProperty()
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

    public function getAttachmentTypesProperty()
    {
        return Attachment::orderBy('attachment')->get();
    }

    public function canCreatePayment(int $type = 2): bool
    {
        $user = Auth::user();
        $sr   = $this->sr;

        // Cegah tambah payment jika SR sudah Paid (status 11)
        if (intval($sr->status) === 11) return false;

        // Kalkulasi balance utk menentukan jenis selisih
        // receipt = total payment dari PR (yg dibayar ke vendor)
        // grandTotal = SUM ammount dari detail SR
        $receipt    = Payment::where('id_pr', $sr->id_pr)->whereIn('id_doc_type', [1, 2])->sum('grand_total');
        $grandTotal = $sr->details->sum('ammount');
        $srPaid     = $this->totalPaid;
        $balance    = $grandTotal - $receipt; // >0 = kurang bayar (perusahaan bayar ke karyawan), <0 = lebih bayar (karyawan kembalikan)

        if ($user->level === 1) return true; // Admin selalu bisa

        if ($user->hasPermission('sr_payment.create')) return true; // Finance/permission sr_payment.create selalu bisa

        // Lebih Bayar (balance < 0): Karyawan harus kembalikan sisa ke perusahaan
        // Yang boleh input: Admin (sudah above) + sr_payment.create (sudah above) + Creator/Owner SR
        if ($balance < 0 && $user->id_user == $sr->id_user) {
            return true;
        }

        // Kurang Bayar (balance > 0): Perusahaan bayar sisa ke karyawan
        // Yang boleh input: HANYA Admin + sr_payment.create (sudah di atas)
        // Creator TIDAK boleh input di skenario ini
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

        if ($user->level === 1 || $user->hasPermission('sr_payment.create')) {
            return true;
        }

        // Owner SR boleh
        if ($user->id_user == $this->sr->id_user) {
            return true;
        }
        return false;
    }

    public function render()
    {
        return view('livewire.settlement-reports.payment-show', [
            'sr'              => $this->sr,
            'payments'        => $this->payments,
            'grandTotal'      => $this->grandTotal,
            'totalPaid'       => $this->totalPaid,
            'balance'         => $this->balance,
            'attachmentTypes' => $this->attachmentTypes,
        ]);
    }
}
