<?php

namespace App\Livewire\PaymentRequests;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Pr;
use App\Models\Payment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PaymentModal extends Component
{
    use WithFileUploads;

    public $prId;
    public $paymentId = null; // null = create, set = edit

    // Form fields (sesuai CI4 tambahpayment.php & editpayment.php)
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
    public $prGrandTotal = 0;

    protected $listeners = [
        'openPaymentModal'     => 'loadPr',
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

    // =====================================================================
    // LOAD: Create
    // =====================================================================

    public function loadPr($prId)
    {
        $this->reset();
        $this->prId      = $prId;
        $this->paymentId = null;

        $pr = Pr::with('details', 'payments', 'norek_vendor', 'vendor')->find($prId);

        $grandTotal        = $pr->details->sum('ammount') - floatval($pr->additional_discount ?? 0);
        $totalPaid         = $pr->payments->sum('grand_total');
        $this->maxAmount   = $grandTotal - $totalPaid;
        $this->prGrandTotal = $grandTotal;

        // Pre-fill bank info from PR
        $this->payment_date   = date('Y-m-d');
        $this->ammount        = $this->maxAmount;
        $this->grand_total    = $this->maxAmount;

        if ($pr->norek_vendor) {
            $this->nama_bank     = $pr->norek_vendor->bank_name ?? '';
            $this->nama_penerima = $pr->norek_vendor->account_name ?? '';
            $this->norek         = $pr->norek_vendor->norek ?? '';
        } else {
            $this->nama_bank     = $pr->nama_bank ?? '';
            $this->nama_penerima = $pr->nama_penerima ?? '';
            $this->norek         = $pr->norek ?? '';
        }

        $this->dispatch('show-payment-modal');
    }

    // =====================================================================
    // LOAD: Edit
    // =====================================================================

    public function loadPayment($paymentId)
    {
        $this->reset();
        $payment = Payment::with('pr.details', 'pr.payments')->findOrFail($paymentId);

        $this->prId       = $payment->id_pr;
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

        $pr = $payment->pr;
        $grandTotal       = $pr->details->sum('ammount') - floatval($pr->additional_discount ?? 0);
        $totalPaid        = $pr->payments->whereNotIn('id_payment', [$paymentId])->sum('grand_total');
        $this->maxAmount  = $grandTotal - $totalPaid;
        $this->prGrandTotal = $grandTotal;

        $this->dispatch('show-payment-modal');
    }

    // =====================================================================
    // SAVE
    // =====================================================================

    public function savePayment()
    {
        $this->validate();

        // Amount validation
        if (floatval($this->ammount) > $this->maxAmount) {
            $this->addError('ammount', 'Nominal melebihi sisa tagihan (' . number_format($this->maxAmount, 0, ',', '.') . ').');
            return;
        }

        DB::beginTransaction();
        try {
            $pr       = Pr::findOrFail($this->prId);
            $filename = null;

            if ($this->file) {
                $filename = $this->file->store('payments', 'public');
            }

            $amount    = $this->parseNumber($this->ammount);
            $add       = $this->parseNumber($this->additional ?? 0);
            $grandTotal = $amount + $add;

            $data = [
                'id_pr'               => $pr->id_pr,
                'id_user'             => Auth::id(),
                'id_doc_type'         => $pr->id_doc_type,
                'id_cost_type'        => $pr->id_cost_type,
                'id_cost_category'    => $pr->id_cost_category,
                'id_departement'      => $pr->id_departement,
                'id_company'          => $pr->id_company,
                'id_vendor'           => $pr->id_vendor,
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
            $this->dispatch('hide-payment-modal');
            $this->dispatch('swal-alert', ['type' => 'success', 'message' => $msg]);
            return redirect()->route('payment-requests.show', hashid_encode($pr->id_pr, 'pr'));
        } catch (\Exception $e) {
            DB::rollBack();
            $this->addError('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    // =====================================================================
    // HELPER
    // =====================================================================

    private function parseNumber($val): float
    {
        if (!$val) return 0;
        return (float) str_replace(',', '.', str_replace('.', '', str_replace(',', '.', (string)$val)));
    }

    public function render()
    {
        return view('livewire.payment-requests.payment-modal');
    }
}
