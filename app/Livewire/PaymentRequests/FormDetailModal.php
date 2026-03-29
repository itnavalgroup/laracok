<?php

namespace App\Livewire\PaymentRequests;

use Livewire\Component;
use App\Models\PrDetail;
use App\Models\Uom;
use App\Models\TaxType;
use App\Models\Tax;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;

class FormDetailModal extends Component
{
    public $prId;
    public $detailId = null;
    public $isOpen = false;
    public $isViewOnly = false; // mode hanya lihat

    // Form fields
    public $detail = '';
    public $bl_number = '';
    public $id_uom = '';
    public $qty = '';
    public $price = '';
    public $discount = '0';
    public $dpp_pph = '';
    public $id_tax_type1 = '';
    public $id_tax1 = '';
    public $tax1 = '';
    public $id_tax_type2 = '';
    public $id_tax2 = '';
    public $tax2 = '';
    public $ammount = '';
    public $gross = 2;
    public $progresif = 2;

    public function rules()
    {
        return [
            'detail' => 'required|string|min:2',
            'id_uom' => 'required|integer',
            'qty' => 'required|numeric|min:0.0001',
            'price' => 'required|numeric|min:0',
        ];
    }

    #[On('openModal')]
    public function openModal(...$args)
    {
        $id = null;
        $this->isViewOnly = false;

        if (!empty($args)) {
            $first = $args[0];
            if (is_array($first)) {
                $id = $first['id'] ?? null;
                $this->isViewOnly = $first['viewOnly'] ?? false;
            } else {
                $id = $first;
                $this->isViewOnly = $args[1] ?? false;
            }
        }

        $this->resetErrorBag();
        $this->reset([
            'detail',
            'bl_number',
            'id_uom',
            'qty',
            'price',
            'discount',
            'dpp_pph',
            'id_tax_type1',
            'id_tax1',
            'tax1',
            'id_tax_type2',
            'id_tax2',
            'tax2',
            'ammount',
            'gross',
            'progresif',
            'detailId'
        ]);
        $this->gross = 2;
        $this->progresif = 2;

        if ($id) {
            $detail = \App\Models\PrDetail::findOrFail($id);
            // Hanya bisa edit detail milik PR saat ini
            if ($detail->id_pr != $this->prId) {
                return;
            }
            $this->detailId = $id;
            $this->detail = $detail->detail;
            $this->bl_number = $detail->bl_number ?? '';
            $this->id_uom = $detail->id_uom;
            $this->qty = $detail->qty;
            $this->price = $detail->price;
            $this->discount = $detail->discount ?? 0;
            $this->dpp_pph = $detail->dpp_pph ?? '';
            $this->id_tax_type1 = $detail->id_tax_type1 ?? '';
            $this->id_tax1 = $detail->id_tax1 ?? '';
            $this->tax1 = $detail->tax1 ?? '';
            $this->id_tax_type2 = $detail->id_tax_type2 ?? '';
            $this->id_tax2 = $detail->id_tax2 ?? '';
            $this->tax2 = $detail->tax2 ?? '';
            $this->ammount = $detail->ammount ?? '';
            $this->gross = $detail->gross ?? 2;
            $this->progresif = $detail->progresif ?? 2;
        }

        $this->isOpen = true;
        $this->dispatch('open-detail-form');
    }

    public function closeModal()
    {
        $this->isOpen = false;
        $this->resetValidation();
    }

    public function syncAndSave(
        $qty = null,
        $price = null,
        $discount = null,
        $dpp_pph = null,
        $id_tax_type1 = null,
        $id_tax1 = null,
        $tax1 = null,
        $id_tax_type2 = null,
        $id_tax2 = null,
        $tax2 = null,
        $ammount = null,
        $gross = 2,
        $progresif = 2
    ) {
        if ($this->isViewOnly) {
            return;
        }

        // Directly cast JS float values (JS numbers are guaranteed parsed format)
        if ($qty !== null)          $this->qty          = (float) $qty;
        if ($price !== null)        $this->price        = (float) $price;
        if ($discount !== null)     $this->discount     = (float) $discount;
        if ($dpp_pph !== null)      $this->dpp_pph      = (float) $dpp_pph;
        if ($id_tax_type1 !== null) $this->id_tax_type1 = $id_tax_type1;
        if ($id_tax1 !== null)      $this->id_tax1      = $id_tax1;
        if ($tax1 !== null)         $this->tax1         = (float) $tax1;
        if ($id_tax_type2 !== null) $this->id_tax_type2 = $id_tax_type2;
        if ($id_tax2 !== null)      $this->id_tax2      = $id_tax2;
        if ($tax2 !== null)         $this->tax2         = (float) $tax2;
        if ($ammount !== null)      $this->ammount      = (float) $ammount;
        
        $this->gross     = (int) $gross;
        $this->progresif = (int) $progresif;

        $this->save();
    }

    public function save()
    {
        $this->validate();

        $user  = Auth::user();
        $pr    = \App\Models\Pr::findOrFail($this->prId);

        // Strict Permission Check: Admin or Creator with specific permission
        $isAdmin = $user->level === 1;
        $isCreator = $user->id_user === $pr->id_user;

        if ($this->detailId) {
            // Edit check: Admin bisa, Creator selalu bisa edit PRnya sendiri, user lain butuh permission pr_detail.edit
            if (!$isAdmin && !$isCreator && !$user->hasPermission('pr_detail.edit')) {
                $this->dispatch('alert', ['type' => 'danger', 'message' => 'Anda tidak memiliki hak akses untuk mengedit item ini.']);
                return;
            }
        } else {
            // Create check: Admin bisa, Creator selalu bisa tambah detail di PRnya sendiri, user lain butuh permission pr_detail.create
            if (!$isAdmin && !$isCreator && !$user->hasPermission('pr_detail.create')) {
                $this->dispatch('alert', ['type' => 'danger', 'message' => 'Anda tidak memiliki hak akses untuk menambah item.']);
                return;
            }
        }

        // Pastikan PR dalam status bisadiedit (Draft, Revision)
        if (!in_array($pr->status, [null, 0, 12])) {
            $this->dispatch('alert', ['type' => 'danger', 'message' => 'PR sedang dalam proses dan tidak bisa diedit.']);
            return;
        }

        $data = [
            'id_pr'         => $this->prId,
            'id_user'       => $user->id_user,
            'id_departement' => $user->id_departement,
            'id_uom'        => $this->id_uom,
            'id_tax_type1'  => $this->id_tax_type1 ?: null,
            'id_tax1'       => $this->id_tax1 ?: null,
            'id_tax_type2'  => $this->id_tax_type2 ?: null,
            'id_tax2'       => $this->id_tax2 ?: null,
            'detail'        => $this->detail,
            'bl_number'     => $this->bl_number ?: null,
            'qty'           => $this->qty,
            'price'         => $this->price,
            'discount'      => $this->discount,
            'dpp_pph'       => $this->dpp_pph ?: null,
            'tax1'          => $this->tax1 ?: 0,
            'tax2'          => $this->tax2 ?: 0,
            'ammount'       => $this->ammount ?: 0,
            'gross'         => $this->gross,
            'progresif'     => $this->progresif,
        ];

        if ($this->detailId) {
            \App\Models\PrDetail::where('id_detail_pr', '=', $this->detailId)->update($data);
            $msg = 'Item berhasil diperbarui.';
        } else {
            \App\Models\PrDetail::create($data);
            $msg = 'Item berhasil ditambahkan.';
        }

        $this->closeModal();
        $this->dispatch('alert', ['type' => 'success', 'message' => $msg]);
        $this->dispatch('pr-refresh');
    }

    #[On('delete-detail')]
    public function deleteDetail(...$args)
    {
        $id = null;
        if (!empty($args)) {
            $first = $args[0];
            $id = is_array($first) ? ($first['id'] ?? null) : $first;
        }
        if (!$id) return;

        $detail = \App\Models\PrDetail::findOrFail($id);

        if ($detail->id_pr != $this->prId) {
            return;
        }

        $user = Auth::user();
        $pr   = \App\Models\Pr::findOrFail($this->prId);

        // Strict Permission Check for delete: Admin bisa, Creator selalu bisa hapus PRnya sendiri, user lain butuh permission pr_detail.edit
        $isAdmin = $user->level === 1;
        $isCreator = $user->id_user === $pr->id_user;

        if (!$isAdmin && !$isCreator && !$user->hasPermission('pr_detail.edit')) {
            $this->dispatch('alert', ['type' => 'danger', 'message' => 'Anda tidak memiliki hak akses untuk menghapus item ini.']);
            return;
        }

        if (!in_array($pr->status, [null, 0, 12])) {
            $this->dispatch('alert', ['type' => 'danger', 'message' => 'Item tidak dapat dihapus karena PR sedang dalam proses.']);
            return;
        }

        $detail->delete();
        $this->dispatch('alert', ['type' => 'success', 'message' => 'Item berhasil dihapus.']);
        $this->dispatch('pr-refresh');
    }

    // =====================================================================
    // AJAX: Get Taxes by Type (for JS fetch)
    // =====================================================================

    public function getTaxesByType($typeId)
    {
        if (!$typeId) {
            return $this->dispatch('taxes-loaded', ['target' => 'ppn', 'data' => []]);
        }
        $taxes = Tax::where('id_tax_type', $typeId)->where('status', 1)->get([
            'id_tax',
            'tax',
            'tax_persen'
        ]);
        return $taxes->toArray();
    }

    private function parseNumber($val): float
    {
        if ($val === null || $val === '') return 0;
        // Remove thousand separators (dots) and replace decimal comma with dot
        return (float) str_replace(',', '.', str_replace('.', '', str_replace(',', '.', $val)));
    }

    public function getUomsProperty()
    {
        return Uom::orderBy('uom')->get();
    }

    public function getTaxTypesProperty()
    {
        return TaxType::orderBy('tax_type')->get();
    }

    public function render()
    {
        return view('livewire.payment-requests.form-detail-modal', [
            'uoms' => $this->uoms,
            'taxTypes' => $this->taxTypes,
        ]);
    }
}
