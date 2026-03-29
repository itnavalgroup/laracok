<?php

namespace App\Livewire\Contracts;

use Livewire\Component;
use Livewire\Attributes\Computed;
use App\Models\Contract;
use Illuminate\Support\Facades\Auth;

class Show extends Component
{
    public $contractId;
    public $contractHash;

    public function mount($hash)
    {
        $id = hashid_decode($hash, 'pr');
        if (!$id) abort(404);

        $contract = Contract::findOrFail($id);
        $user     = Auth::user();

        $canView = $user->level === 1
            || $user->id_user == $contract->id_user
            || $user->hasPermission('contract.view')
            || $user->hasPermission('contract.view.dept')
            || $user->hasPermission('contract.view.subordinate');

        if (!$canView) {
            session()->flash('error', 'Anda tidak memiliki akses untuk melihat kontrak ini.');
            return redirect()->route('contracts.index');
        }

        $this->contractId   = $id;
        $this->contractHash = $hash;
    }

    #[Computed]
    public function contract()
    {
        return Contract::with([
            'user',
            'company',
            'departement',
            'details.item.category',
            'details.itemCategory',
        ])->findOrFail($this->contractId);
    }

    public function canEdit(): bool
    {
        $user = Auth::user();
        return $user->level === 1 || $user->id_user == $this->contract->id_user;
    }

    public function render()
    {
        return view('livewire.contracts.show')->layout('layouts.app');
    }
}
