<?php

namespace App\Livewire\PaymentRequests;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\Pr;
use App\Models\Loan;

class LoanModal extends Component
{
    public $prId;
    public $id_loan;
    public $pr;

    protected $listeners = ['open-loan-modal' => 'loadPr'];

    #[On('open-loan-modal')]
    public function loadPr($data = [])
    {
        // Support both array payload and direct value
        $this->prId = is_array($data) ? ($data['prId'] ?? null) : $data;
        
        if ($this->prId) {
            $this->pr = Pr::find($this->prId);
            $this->id_loan = $this->pr->id_loan;
            
            $this->dispatch('show-loan-modal');
        }
    }

    public function saveLoan()
    {
        if ($this->pr) {
            $this->pr->update(['id_loan' => $this->id_loan ?: null]);
            $this->dispatch('hide-loan-modal');
            session()->flash('success', 'Data loan berhasil diperbarui.');
            
            // Redirect to refresh the page as we update relationships
            return redirect(request()->header('Referer') ?: route('payment-requests.show', hashid_encode($this->prId, 'pr')));
        }
    }

    public function render()
    {
        $loans = Loan::all();
        return view('livewire.payment-requests.loan-modal', compact('loans'));
    }
}
