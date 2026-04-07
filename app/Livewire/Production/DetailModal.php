<?php

namespace App\Livewire\Production;

use App\Models\Item;
use App\Models\ItemTransaction;
use App\Models\Production;
use App\Models\ProductionMaterial;
use App\Models\ProductionResult;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;
use Livewire\Component;

class DetailModal extends Component
{
    public $productionId;

    public $production;

    // form for material
    public $mat_id_item;

    public $mat_qty;

    // form for result
    public $res_id_item;

    public $res_qty;

    public $items = [];

    #[On('open-production-detail')]
    public function openModal($id)
    {
        $this->productionId = $id;
        $this->loadData();
        $this->items = Item::where('is_active', 1)->get();
        $this->resetMaterialForm();
        $this->resetResultForm();

        $this->dispatch('show-modal', id: 'productionDetailModal');
    }

    public function loadData()
    {
        $this->production = Production::with(['materials.item', 'results.item', 'materials.uom', 'results.uom', 'user', 'warehouse', 'departement', 'company'])->find($this->productionId);
    }

    public function resetMaterialForm()
    {
        $this->mat_id_item = '';
        $this->mat_qty = '';
    }

    public function resetResultForm()
    {
        $this->res_id_item = '';
        $this->res_qty = '';
    }

    public function addMaterial()
    {
        if ($this->production->status > 0) {
            return;
        }

        $this->validate([
            'mat_id_item' => 'required',
            'mat_qty' => 'required|numeric|min:0.01',
        ]);

        $item = Item::find($this->mat_id_item);

        ProductionMaterial::create([
            'id_production' => $this->productionId,
            'id_item' => $this->mat_id_item,
            'id_item_category' => $item->id_item_category,
            'id_uom' => $item->id_uom,
            'id_packaging' => $item->id_packaging,
            'qty' => $this->mat_qty,
        ]);

        $this->resetMaterialForm();
        $this->loadData();
        $this->dispatch('refreshProductionIndex');
    }

    public function deleteMaterial($id)
    {
        if ($this->production->status > 0) {
            return;
        }
        ProductionMaterial::find($id)->delete();
        $this->loadData();
        $this->dispatch('refreshProductionIndex');
    }

    public function addResult()
    {
        if ($this->production->status > 0) {
            return;
        }

        $this->validate([
            'res_id_item' => 'required',
            'res_qty' => 'required|numeric|min:0.01',
        ]);

        $item = Item::find($this->res_id_item);

        ProductionResult::create([
            'id_production' => $this->productionId,
            'id_item' => $this->res_id_item,
            'id_item_category' => $item->id_item_category,
            'id_uom' => $item->id_uom,
            'id_packaging' => $item->id_packaging,
            'qty' => $this->res_qty,
        ]);

        $this->resetResultForm();
        $this->loadData();
        $this->dispatch('refreshProductionIndex');
    }

    public function deleteResult($id)
    {
        if ($this->production->status > 0) {
            return;
        }
        ProductionResult::find($id)->delete();
        $this->loadData();
        $this->dispatch('refreshProductionIndex');
    }

    public function processProduction()
    {
        if ($this->production->status != 0) {
            return;
        }

        if ($this->production->materials->isEmpty() || $this->production->results->isEmpty()) {
            $this->dispatch('alert', [
                'type' => 'danger',
                'title' => 'Gagal',
                'message' => 'Material dan Result tidak boleh kosong!',
            ]);

            return;
        }

        $this->production->update([
            'status' => 1,
            'processed_by' => Auth::id(),
        ]);
        $this->loadData();
        $this->dispatch('refreshProductionIndex');
    }

    public function cancelProduction()
    {
        if ($this->production->status >= 2) {
            return;
        }
        $this->production->update([
            'status' => 3, // Canceled
            'canceled_by' => Auth::id(),
        ]);
        $this->loadData();
        $this->dispatch('refreshProductionIndex');
    }

    public function finishProduction()
    {
        // Must be in Processed (1) status
        if ($this->production->status != 1) {
            return;
        }

        try {
            DB::beginTransaction();

            $docTypeProd = \App\Models\DocType::firstOrCreate(
                ['doc_type' => 'Production_Transactions'], // using clear name
            );

            foreach ($this->production->materials as $mat) {
                ItemTransaction::create([
                    'id_item' => $mat->id_item,
                    'id_item_category' => $mat->id_item_category,
                    'id_warehouse' => $this->production->id_warehouse,
                    'id_company' => $this->production->id_company,
                    'id_user' => Auth::id(),
                    'id_departement' => $this->production->id_departement,
                    'id_uom' => $mat->id_uom,
                    'id_packaging' => $mat->id_packaging,
                    'id_doc_type' => $docTypeProd->id_doc_type,
                    'transaction_code' => $this->production->production_number,
                    'income' => 0,
                    'outcome' => $mat->qty,
                    'transaction_date' => $this->production->production_date,
                    'description' => 'Usage for Production '.$this->production->production_number,
                ]);
            }

            foreach ($this->production->results as $res) {
                ItemTransaction::create([
                    'id_item' => $res->id_item,
                    'id_item_category' => $res->id_item_category,
                    'id_warehouse' => $this->production->id_warehouse,
                    'id_company' => $this->production->id_company,
                    'id_user' => Auth::id(),
                    'id_departement' => $this->production->id_departement,
                    'id_uom' => $res->id_uom,
                    'id_packaging' => $res->id_packaging,
                    'id_doc_type' => $docTypeProd->id_doc_type,
                    'transaction_code' => $this->production->production_number,
                    'income' => $res->qty,
                    'outcome' => 0,
                    'transaction_date' => $this->production->production_date,
                    'description' => 'Result from Production '.$this->production->production_number,
                ]);
            }

            $this->production->update([
                'status' => 2, // Finished
                'finished_by' => Auth::id(),
            ]);

            DB::commit();

            $this->dispatch('alert', [
                'type' => 'success',
                'title' => 'Sukses!',
                'message' => 'Production berhasil difinish dan inventory telah diupdate.',
            ]);

            $this->loadData();
            $this->dispatch('refreshProductionIndex');

        } catch (\Exception $e) {
            DB::rollBack();
            $this->dispatch('alert', [
                'type' => 'danger',
                'title' => 'Error',
                'message' => 'Gagal memproses inventory: '.$e->getMessage(),
            ]);
        }
    }

    public function render()
    {
        return view('livewire.production.detail-modal');
    }
}
