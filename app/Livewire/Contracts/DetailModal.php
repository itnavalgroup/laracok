<?php

namespace App\Livewire\Contracts;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\Contract;
use App\Models\ContractDetail;
use App\Models\Item;
use App\Models\ItemCategory;
use App\Models\IkbDetail;
use Illuminate\Support\Facades\Auth;

class DetailModal extends Component
{
    public $contractId;
    public $detailId = null;
    public $isOpen   = false;

    // Form fields
    public $id_item_category = '';
    public $id_item          = '';
    public $qty              = '';

    public function rules(): array
    {
        return [
            'id_item_category' => 'required|integer',
            'id_item'          => 'required|integer',
            'qty'              => 'required|numeric|min:0.0001',
        ];
    }

    #[On('openContractDetailModal')]
    public function openModal($id = null)
    {
        $this->resetErrorBag();
        $this->reset(['id_item_category', 'id_item', 'qty', 'detailId']);

        if ($id) {
            $detail = ContractDetail::findOrFail($id);
            if ($detail->id_contract != $this->contractId) return;

            $this->detailId          = $id;
            $this->id_item_category  = $detail->id_item_category;
            $this->id_item           = $detail->id_item;
            $this->qty               = $detail->qty;
        }

        $this->isOpen = true;
        $this->dispatch('open-contract-detail-modal');
    }

    public function closeModal()
    {
        $this->isOpen = false;
        $this->resetValidation();
    }

    public function save()
    {
        $this->validate();

        $user     = Auth::user();
        $contract = Contract::findOrFail($this->contractId);
        $isAdmin  = $user->level === 1;
        $isOwner  = $user->id_user == $contract->id_user;

        if ($this->detailId) {
            if (!$isAdmin && !($isOwner && $user->hasPermission('contract_detail.edit'))) {
                $this->dispatch('alert', ['type' => 'danger', 'message' => 'Anda tidak memiliki akses untuk mengedit item ini.']);
                return;
            }
        } else {
            if (!$isAdmin && !($isOwner && $user->hasPermission('contract_detail.create'))) {
                $this->dispatch('alert', ['type' => 'danger', 'message' => 'Anda tidak memiliki akses untuk menambah item.']);
                return;
            }
        }

        $data = [
            'id_contract'      => $this->contractId,
            'id_item_category' => $this->id_item_category,
            'id_item'          => $this->id_item,
            'qty'              => $this->qty,
        ];

        if ($this->detailId) {
            ContractDetail::where('id_contract_detail', $this->detailId)->update($data);
            $msg = 'Item berhasil diperbarui.';
        } else {
            ContractDetail::create($data);
            $msg = 'Item berhasil ditambahkan.';
        }

        $this->closeModal();
        $this->dispatch('alert', ['type' => 'success', 'message' => $msg]);
        $this->dispatch('close-contract-detail-modal');
        $this->dispatch('contract-refresh');
    }

    #[On('delete-contract-detail')]
    public function deleteDetail($id)
    {
        $detail   = ContractDetail::findOrFail($id);
        if ($detail->id_contract != $this->contractId) return;

        $user    = Auth::user();
        $contract = Contract::findOrFail($this->contractId);
        $isAdmin = $user->level === 1;
        $isOwner = $user->id_user == $contract->id_user;

        if (!$isAdmin && !($isOwner && $user->hasPermission('contract_detail.delete'))) {
            $this->dispatch('alert', ['type' => 'danger', 'message' => 'Anda tidak memiliki akses untuk menghapus item ini.']);
            return;
        }

        // Block if referenced in IKB (by id_contract AND id_item)
        $usedInIkb = IkbDetail::where('id_contract', $this->contractId)
            ->where('id_item', $detail->id_item)
            ->whereNull('deleted_at')
            ->exists();

        if ($usedInIkb) {
            $this->dispatch('alert', ['type' => 'danger', 'message' => 'Item tidak dapat dihapus karena sudah digunakan pada data IKB.']);
            return;
        }

        $detail->delete();
        $this->dispatch('alert', ['type' => 'success', 'message' => 'Item berhasil dihapus.']);
        $this->dispatch('contract-refresh');
    }

    public function getItemsByCategoryProperty()
    {
        if (!$this->id_item_category) return collect();
        return Item::where('id_item_category', $this->id_item_category)
            ->where('is_active', 1)
            ->orderBy('item_name')
            ->get();
    }

    public function render()
    {
        return view('livewire.contracts.detail-modal', [
            'itemCategories' => ItemCategory::orderBy('item_category')->get(),
            'items'          => $this->itemsByCategory,
        ]);
    }
}
