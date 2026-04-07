<?php

namespace App\Livewire\Production;

use App\Models\Item;
use App\Models\ItemCategory;
use App\Models\ItemTransaction;
use App\Models\Packaging;
use App\Models\Production;
use App\Models\ProductionMaterial;
use App\Models\ProductionResult;
use App\Models\Uom;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Livewire\Attributes\On;
use Livewire\Component;

class FormDetailModal extends Component
{
    public $productionId;

    public $type; // 'material' or 'result'

    public function mount($productionId = null)
    {
        $this->productionId = $productionId;
    }

    #[On('openModal')]
    public function openModal($type = 'material', $id = null)
    {
        $this->type = $type;
        if ($id) {
            if ($type == 'material') {
                $detail = ProductionMaterial::findOrFail($id);
            } else {
                $detail = ProductionResult::findOrFail($id);
            }
            $detailArray = $detail->toArray();
            $detailArray['id_detail'] = $id;
            $this->dispatch('open-production-detail-form-js', ['detail' => $detailArray, 'type' => $type]);
        } else {
            $this->dispatch('open-production-detail-form-js', ['type' => $type]);
        }
    }

    public function saveFromJs(array $formData, $detailId = null)
    {
        if (isset($formData['qty'])) {
            $formData['qty'] = str_replace(',', '', $formData['qty']);
        }

        $rules = [
            'id_item_category' => 'required',
            'id_item' => 'required',
            'qty' => 'required|numeric|min:0.01',
            'id_uom' => 'nullable',
            'id_packaging' => 'nullable',
        ];

        $validator = Validator::make($formData, $rules);
        if ($validator->fails()) {
            return ['errors' => $validator->errors()->toArray()];
        }

        $production = Production::findOrFail($this->productionId);

        if ($formData['type'] == 'material' && $production->status != 0) {
            return ['error' => 'Material hanya bisa diubah saat DRAFT.'];
        }

        if ($formData['type'] == 'result' && $production->status > 2) {
            return ['error' => 'Result hanya bisa ditambahkan saat tahap PROSES atau VERIFY.'];
        }

        $qtyInput = (float) $formData['qty'];
        $itemIdInput = $formData['id_item'];

        if ($formData['type'] == 'material') {
            $actualStock = ItemTransaction::where('id_item', '=', $itemIdInput)
                ->where('id_warehouse', '=', $production->id_warehouse)
                ->where('id_company', '=', $production->id_company)
                ->sum('income') - ItemTransaction::where('id_item', '=', $itemIdInput)
                ->where('id_warehouse', '=', $production->id_warehouse)
                ->where('id_company', '=', $production->id_company)
                ->sum('outcome');

            $availableStock = $actualStock;

            $reservedQty = ProductionMaterial::where('id_production', $this->productionId)
                ->where('id_item', $itemIdInput);
            if ($detailId) {
                $reservedQty->where('id_production_material', '!=', $detailId);
            }
            $reservedQty = $reservedQty->sum('qty');

            if (($availableStock - $reservedQty) < $qtyInput) {
                $itemName = Item::find($itemIdInput)->item_name ?? 'Item';

                return ['error' => "Stok untuk {$itemName} tidak mencukupi (Tersedia: ".($availableStock - $reservedQty).').'];
            }
        }

        DB::beginTransaction();
        try {
            $data = [
                'id_production' => $this->productionId,
                'id_item' => $formData['id_item'],
                'id_item_category' => $formData['id_item_category'],
                'qty' => $formData['qty'],
                'id_uom' => $formData['id_uom'] ?: null,
                'id_packaging' => $formData['id_packaging'] ?: null,
            ];

            if ($formData['type'] == 'material') {
                if ($detailId) {
                    ProductionMaterial::findOrFail($detailId)->update($data);
                } else {
                    ProductionMaterial::create($data);
                }
            } else {
                if ($detailId) {
                    ProductionResult::findOrFail($detailId)->update($data);
                } else {
                    ProductionResult::create($data);
                }
            }

            DB::commit();
            $this->dispatch('production-refresh');

            return ['success' => true];
        } catch (\Exception $e) {
            DB::rollBack();

            return ['error' => 'Gagal menyimpan: '.$e->getMessage()];
        }
    }

    public function render()
    {
        $production = Production::find($this->productionId);

        $matItems = collect();
        $resItems = collect();

        if ($production) {
            $idWarehouse = $production->id_warehouse;
            $idCompany = $production->id_company;

            $incomeSub = DB::table('tbl_item_transactions')
                ->select('id_item', DB::raw('SUM(income) as total_income'))
                ->where('id_warehouse', $idWarehouse)
                ->where('id_company', $idCompany)
                ->whereNull('deleted_at')
                ->groupBy('id_item');

            $outcomeSub = DB::table('tbl_item_transactions')
                ->select('id_item', DB::raw('SUM(outcome) as total_outcome'))
                ->where('id_warehouse', $idWarehouse)
                ->where('id_company', $idCompany)
                ->whereNull('deleted_at')
                ->groupBy('id_item');

            $reservedSub = DB::table('tbl_production_materials')
                ->select('id_item', DB::raw('SUM(qty) as total_reserved'))
                ->where('id_production', $this->productionId)
                ->whereNull('deleted_at')
                ->groupBy('id_item');

            $matItems = Item::where('is_active', 1)
                ->leftJoinSub($incomeSub, 'income', 'tbl_items.id_item', '=', 'income.id_item')
                ->leftJoinSub($outcomeSub, 'outcome', 'tbl_items.id_item', '=', 'outcome.id_item')
                ->leftJoinSub($reservedSub, 'reserved', 'tbl_items.id_item', '=', 'reserved.id_item')
                ->select(
                    'tbl_items.id_item',
                    'tbl_items.item_code',
                    'tbl_items.item_name',
                    'tbl_items.id_item_category',
                    DB::raw('COALESCE(income.total_income, 0) - COALESCE(outcome.total_outcome, 0) - COALESCE(reserved.total_reserved, 0) as available_stock')
                )
                ->having('available_stock', '>', 0)
                ->get();

            $resItems = Item::where('is_active', 1)
                ->select('tbl_items.id_item', 'tbl_items.item_code', 'tbl_items.item_name', 'tbl_items.id_item_category', DB::raw('0 as available_stock'))
                ->get();
        }

        return view('livewire.production.form-detail-modal', [
            'uoms' => Uom::all(),
            'categories' => ItemCategory::where('is_active', 1)->get(),
            'packagings' => Packaging::all(),
            'matItems' => $matItems,
            'resItems' => $resItems,
        ]);
    }
}
