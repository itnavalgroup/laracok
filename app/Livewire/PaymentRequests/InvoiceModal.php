<?php

namespace App\Livewire\PaymentRequests;

use Livewire\Component;
use App\Models\Pr;
use App\Models\Invoice;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\WithFileUploads;

class InvoiceModal extends Component
{
    use WithFileUploads;

    public $prId;
    public $invoice_date;
    public $invoice_number;
    public $delivery_date;
    public $truck;
    public $file;

    // View-only properties
    public $pr;
    public $grandTotal = 0;

    protected $listeners = ['openInvoiceModal' => 'loadPr'];

    protected $rules = [
        'invoice_number' => 'required|string|max:100',
        'invoice_date' => 'required|date',
        'file' => 'nullable|file|max:5120|mimes:pdf,jpg,jpeg,png', // 5MB max, common document types
    ];

    public function loadPr($prId)
    {
        $this->prId = $prId;
        $this->pr = Pr::with('details')->find($this->prId);
        
        $this->grandTotal = $this->pr->details->sum('ammount') - floatval($this->pr->additional_discount ?? 0);
        $this->invoice_date = date('Y-m-d');
        
        $this->dispatch('show-invoice-modal');
    }

    public function saveInvoice()
    {
        $this->validate();

        DB::beginTransaction();
        try {
            $pr = $this->pr;
            
            $filename = null;
            if ($this->file) {
                $filename = $this->file->store('invoices', 'public');
            }

            Invoice::create([
                'id_user' => Auth::id(),
                'id_departement' => $pr->id_departement,
                'id_company' => $pr->id_company,
                'id_vendor' => $pr->id_vendor,
                'id_doc_type' => $pr->id_doc_type,
                'id_pr' => $pr->id_pr,
                'id_norek_vendor' => $pr->id_norek_vendor,
                'nama_bank' => $pr->nama_bank,
                'nama_penerima' => $pr->nama_penerima,
                'norek' => $pr->norek,
                'truck' => $this->truck,
                'invoice_date' => $this->invoice_date,
                'invoice_number' => $this->invoice_number,
                'delivery_date' => $this->delivery_date,
                'file_name' => $filename,
            ]);

            DB::commit();

            $this->reset(['invoice_date', 'invoice_number', 'delivery_date', 'truck', 'file']);
            $this->dispatch('hide-invoice-modal');
            session()->flash('success', 'Invoice / Laporan Settlement berhasil ditambahkan.');
            
            return redirect()->route('payment-requests.show', $this->prId);

        } catch (\Exception $e) {
            DB::rollBack();
            $this->addError('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.payment-requests.invoice-modal');
    }
}
