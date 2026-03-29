<?php

namespace App\Livewire\SettlementReports;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Sr;
use App\Models\Payment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PaymentModal extends Component
{
    use WithFileUploads;

    public $srId;
    public $paymentId = null;

    // Form fields
    public $payment_description = '';
    public $payment_type        = '';  // 1=Parsial, 2=Full
    public $payment_method      = '';  // 1=Transfer, 2=Cash
    public $nama_bank           = '';
    public $nama_penerima       = '';
    public $norek               = '';
    public $payment_date        = '';
    public $ammount             = '';
    public $additional          = '';
    public $grand_total         = '';
    public $file                = null;

    // Info
    public $maxAmount = 0;
    public $srGrandTotal = 0;

    protected $listeners = [
        'openPaymentModal'     => 'loadSr',
        'openEditPaymentModal' => 'loadPayment',
    ];

    public function rules()
    {
        return [
            'payment_description' => 'required|string',
            'payment_type'        => 'required|in:1,2',
            'payment_method'      => 'required|in:1,2',
            'payment_date'        => 'required|date',
            'ammount'             => 'required|numeric|min:1',
            'additional'          => 'nullable|numeric',
            'grand_total'         => 'nullable|numeric',
            'nama_bank'           => 'nullable|string|max:150',
            'nama_penerima'       => 'nullable|string|max:150',
            'norek'               => 'nullable|string|max:50',
            'file'                => 'nullable|file|max:5120',
        ];
    }

    public function loadSr($srId)
    {
        $this->reset();
        $this->srId      = $srId;
        $this->paymentId = null;

        $sr = Sr::with('details', 'payments', 'norek_vendor', 'vendor')->find($srId);

        $grandTotal        = $sr->details->sum('ammount') - floatval($sr->additional_discount ?? 0);
        $totalPaid         = Payment::where('id_pr', $sr->id_pr)->where('id_doc_type', 3)->sum('grand_total');
        $this->maxAmount   = $grandTotal - $totalPaid;
        $this->srGrandTotal = $grandTotal;

        $this->payment_date   = date('Y-m-d');
        $this->ammount        = $this->maxAmount;
        $this->grand_total    = $this->maxAmount;

        if ($sr->norek_vendor) {
            $this->nama_bank     = $sr->norek_vendor->bank_name ?? '';
            $this->nama_penerima = $sr->norek_vendor->account_name ?? '';
            $this->norek         = $sr->norek_vendor->norek ?? '';
        } else {
            $this->nama_bank     = $sr->nama_bank ?? '';
            $this->nama_penerima = $sr->nama_penerima ?? '';
            $this->norek         = $sr->norek ?? '';
        }

        $this->dispatch('show-sr-payment-modal');
    }

    public function loadPayment($paymentId)
    {
        $this->reset();
        $payment = Payment::with('pr.details', 'pr.payments')->findOrFail($paymentId);

        // SR is retrieved based on payment's id_pr
        $sr = Sr::where('id_pr', $payment->id_pr)->firstOrFail();
        $this->srId       = $sr->id_sr;
        $this->paymentId  = $paymentId;

        $this->payment_description = $payment->payment_description ?? '';
        $this->payment_type        = $payment->payment_type ?? '';
        $this->payment_method      = $payment->payment_method ?? '';
        $this->nama_bank           = $payment->nama_bank ?? '';
        $this->nama_penerima       = $payment->nama_penerima ?? '';
        $this->norek               = $payment->norek ?? '';
        $this->payment_date        = $payment->payment_date ? date('Y-m-d', strtotime($payment->payment_date)) : '';
        $this->ammount             = $payment->ammount ?? 0;
        $this->additional          = $payment->additional ?? 0;
        $this->grand_total         = $payment->grand_total ?? 0;

        // Uses SR payments, not PR payments
        // We ensure to filter SR payments by id_doc_type = 3
        $grandTotal       = $sr->details->sum('ammount') - floatval($sr->additional_discount ?? 0);
        $totalPaid        = Payment::where('id_pr', $sr->id_pr)
                                   ->where('id_doc_type', 3)
                                   ->whereNotIn('id_payment', [$paymentId])
                                   ->sum('grand_total');
        $this->maxAmount  = $grandTotal - $totalPaid;
        $this->srGrandTotal = $grandTotal;

        $this->dispatch('show-sr-payment-modal');
    }

    public function savePayment()
    {
        $this->validate();

        if (floatval($this->ammount) > $this->maxAmount) {
            $this->addError('ammount', 'Nominal melebihi sisa tagihan (' . number_format($this->maxAmount, 0, ',', '.') . ').');
            return;
        }

        DB::beginTransaction();
        try {
            $sr       = Sr::findOrFail($this->srId);
            $filename = null;

            if ($this->file) {
                $filename = $this->file->store('payments', 'public');
            }

            $amount    = $this->parseNumber($this->ammount);
            $add       = $this->parseNumber($this->additional ?? 0);
            $grandTotal = $amount + $add;

            $data = [
                'id_pr'               => $sr->id_pr, // Payment record always links via id_pr
                'id_user'             => Auth::id(),
                'id_doc_type'         => 3, // 3 for SR Settlement
                'id_cost_type'        => $sr->id_cost_type,
                'id_cost_category'    => $sr->id_cost_category,
                'id_departement'      => $sr->id_departement,
                'id_company'          => $sr->id_company,
                'id_vendor'           => $sr->id_vendor,
                'payment_type'        => $this->payment_type,
                'payment_method'      => $this->payment_method,
                'payment_description' => $this->payment_description,
                'nama_bank'           => $this->nama_bank,
                'nama_penerima'       => $this->nama_penerima,
                'norek'               => $this->norek,
                'ammount'             => $amount,
                'additional'          => $add,
                'grand_total'         => $grandTotal,
                'payment_date'        => $this->payment_date,
                'status'              => 1,
            ];

            if ($filename) {
                $data['filename'] = $filename;
            }

            if ($this->paymentId) {
                Payment::where('id_payment', $this->paymentId)->update($data);
                $msg = 'Payment berhasil diperbarui.';
            } else {
                Payment::create($data);
                $msg = 'Payment berhasil ditambahkan.';
            }

            DB::commit();
            $this->reset();
            $this->dispatch('hide-sr-payment-modal');
            $this->dispatch('swal-alert', ['type' => 'success', 'message' => $msg]);
            return redirect()->route('settlement-reports.payment', hashid_encode($sr->id_pr, 'pr'));
        } catch (\Exception $e) {
            DB::rollBack();
            $this->addError('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    private function parseNumber($val): float
    {
        if (!$val) return 0;
        return (float) str_replace(',', '.', str_replace('.', '', str_replace(',', '.', (string)$val)));
    }

    public function render()
    {
        return view('livewire.settlement-reports.payment-modal');
    }
}
