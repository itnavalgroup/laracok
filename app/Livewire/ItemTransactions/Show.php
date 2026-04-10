<?php

namespace App\Livewire\ItemTransactions;

use App\Models\ItemTransaction;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Show extends Component
{
    public $transaction;

    public function mount($hash)
    {
        $id = hashid_decode($hash);
        abort_if(!$id, 404);

        $this->transaction = ItemTransaction::with([
            'item', 'category', 'warehouse', 'company', 'uom', 'packaging', 'user', 'vendor'
        ])->findOrFail($id);

        $user = Auth::user();
        
        // Base Detail Permission Check
        abort_if($user->level !== 1 && !$user->hasPermission('item_transaction.detail'), 403);

        // Granular Visibility Check
        if ($user->level !== 1 && !$user->hasPermission('item_transaction.view.all')) {
            if ($user->hasPermission('item_transaction.view.warehouse')) {
                abort_if($this->transaction->id_warehouse !== $user->id_warehouse, 403);
            } elseif ($user->hasPermission('item_transaction.view.subordinate')) {
                $subordinateIds = \App\Models\User::where('supervisor', $user->id_user)->pluck('id_user')->toArray();
                $allowIds = array_merge([$user->id_user], $subordinateIds);
                abort_if(!in_array($this->transaction->id_user, $allowIds), 403);
            } else {
                // Fallback: only own transactions if no specific view scope defined
                abort_if($this->transaction->id_user !== $user->id_user, 403);
            }
        }
    }

    public function render()
    {
        $baseTransactionCode = preg_replace('/-(RAW|PROD)$/', '', $this->transaction->transaction_code);
        $relatedProduction = \App\Models\Production::where('production_number', $baseTransactionCode)->first();

        return view('livewire.item-transactions.show', [
            'relatedProduction' => $relatedProduction,
        ])->layout('layouts.app');
    }
}
