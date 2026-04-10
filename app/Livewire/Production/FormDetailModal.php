<?php

namespace App\Livewire\Production;

use App\Models\IkbDetail;
use App\Models\Item;
use App\Models\ItemCategory;
use App\Models\ItemTransaction;
use App\Models\Packaging;
use App\Models\Production;
use App\Models\ProductionMaterial;
use App\Models\ProductionResult;
use App\Models\Uom;
use Illuminate\Support\Facades\Auth;
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

    #[On('openProductionDetailModal')]
    public function openProductionDetailModal($type = 'material', $id = null)
    {
        if (is_array($type)) {
            if (isset($type['type'])) {
                $id = $type['id'] ?? $id;
                $type = $type['type'];
            } elseif (isset($type[0])) {
                $type = $type[0];
                if (isset($type[1])) {
                    $id = $type[1] ?? $id;
                }
            } else {
                $type = 'material';
            }
        }
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
            'id_uom' => 'required',
            'id_packaging' => 'required',
        ];

        $validator = Validator::make($formData, $rules);
        if ($validator->fails()) {
            return ['errors' => $validator->errors()->toArray()];
        }

        $production = Production::findOrFail($this->productionId);

        if ($formData['type'] == 'material' && $production->status != 0) {
            return ['error' => 'Material hanya bisa diubah saat DRAFT.'];
        }

        if ($formData['type'] == 'result' && $production->status > 3) {
            return ['error' => 'Result hanya bisa ditambahkan saat tahap PROSES atau VERIFY.'];
        }

        $qtyInput = (float) $formData['qty'];
        $itemIdInput = $formData['id_item'];

        if ($formData['type'] == 'material') {
            // 1. Actual Stock (Income - Outcome)
            $totalIn = ItemTransaction::where('id_item', '=', $itemIdInput)
                ->where('id_warehouse', '=', $production->id_warehouse)
                ->where('id_company', '=', $production->id_company)
                ->sum('income');
            $totalOut = ItemTransaction::where('id_item', '=', $itemIdInput)
                ->where('id_warehouse', '=', $production->id_warehouse)
                ->where('id_company', '=', $production->id_company)
                ->sum('outcome');
            $actualStock = $totalIn - $totalOut;

            // 2. Reserved by active IKBs (status 5-9: Inventory Control Approved)
            $reservedByIkb = IkbDetail::whereHas('ikb', function ($q) use ($production) {
                $q->where('status', '>=', 5)
                    ->where('status', '<', 10)
                    ->where('id_warehouse', '=', $production->id_warehouse)
                    ->where('id_company', '=', $production->id_company);
            })->where('id_item', '=', $itemIdInput)->sum('qty');

            // 3. Reserved by other Productions (status 1-2: Submitted/Processed)
            $reservedByOtherProductions = ProductionMaterial::whereHas('production', function ($q) use ($production) {
                $q->whereIn('status', [1, 2])
                    ->where('id_warehouse', '=', $production->id_warehouse)
                    ->where('id_company', '=', $production->id_company)
                    ->where('id_production', '!=', $this->productionId);
            })->where('id_item', '=', $itemIdInput)->sum('qty');

            // 4. Already reserved in THIS production (excluding current detail if editing)
            $reservedInThisForm = ProductionMaterial::where('id_production', $this->productionId)
                ->where('id_item', $itemIdInput);
            if ($detailId) {
                $reservedInThisForm->where('id_production_material', '!=', $detailId);
            }
            $reservedInThisForm = $reservedInThisForm->sum('qty');

            $availableStock = $actualStock - $reservedByIkb - $reservedByOtherProductions - $reservedInThisForm;

            if ($availableStock < $qtyInput) {
                $itemName = Item::find($itemIdInput)->item_name ?? 'Item';

                return ['error' => "Stok untuk {$itemName} tidak mencukupi (Available: {$availableStock}, Requested: {$qtyInput})."];
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
                    $resultRow = ProductionResult::findOrFail($detailId);
                    $oldItem = $resultRow->id_item;
                    $resultRow->update($data);

                    if ($production->status >= 3) {
                        $trx = ItemTransaction::where('transaction_code', $production->production_number.'-PROD')
                            ->where('id_item', $oldItem)
                            ->where('income', '>', 0)
                            ->first();
                        if ($trx) {
                            $trx->update([
                                'id_item' => $formData['id_item'],
                                'id_item_category' => $formData['id_item_category'],
                                'id_uom' => $formData['id_uom'] ?: null,
                                'id_packaging' => $formData['id_packaging'] ?: null,
                                'income' => $formData['qty'],
                            ]);
                        }
                    }
                } else {
                    ProductionResult::create($data);

                    if ($production->status >= 3) {
                        $docTypeProd = \App\Models\DocType::firstOrCreate(
                            ['doc_type' => 'Production_Transactions'],
                            ['created_at' => now(), 'updated_at' => now()]
                        );
                        ItemTransaction::create([
                            'id_item' => $formData['id_item'],
                            'id_item_category' => $formData['id_item_category'],
                            'id_warehouse' => $production->id_warehouse,
                            'id_company' => $production->id_company,
                            'id_user' => Auth::id(),
                            'id_departement' => $production->id_departement,
                            'id_uom' => $formData['id_uom'] ?: null,
                            'id_packaging' => $formData['id_packaging'] ?: null,
                            'id_doc_type' => $docTypeProd->id_doc_type,
                            'transaction_code' => $production->production_number.'-PROD',
                            'income' => $formData['qty'],
                            'outcome' => 0,
                            'transaction_date' => $production->production_date ?? now(),
                            'description' => 'Result from Production '.$production->production_number,
                        ]);
                    }
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

            // Reserved in THIS production (materials already added to current production)
            $reservedThisProdSub = DB::table('tbl_production_materials')
                ->select('id_item', DB::raw('SUM(qty) as total_reserved_this'))
                ->where('id_production', $this->productionId)
                ->whereNull('deleted_at')
                ->groupBy('id_item');

            // Reserved by active IKBs (status 5-9: Inventory Control Approved)
            $reservedIkbSub = DB::table('tbl_ikb_details')
                ->join('tbl_ikb', 'tbl_ikb_details.id_ikb', '=', 'tbl_ikb.id_ikb')
                ->select('tbl_ikb_details.id_item', DB::raw('SUM(tbl_ikb_details.qty) as total_reserved_ikb'))
                ->where('tbl_ikb.id_warehouse', $idWarehouse)
                ->where('tbl_ikb.id_company', $idCompany)
                ->where('tbl_ikb.status', '>=', 5)
                ->where('tbl_ikb.status', '<', 10)
                ->whereNull('tbl_ikb_details.deleted_at')
                ->groupBy('tbl_ikb_details.id_item');

            // Reserved by other Productions (status 1-2: Submitted/Processed)
            $reservedOtherProdSub = DB::table('tbl_production_materials')
                ->join('tbl_productions', 'tbl_production_materials.id_production', '=', 'tbl_productions.id_production')
                ->select('tbl_production_materials.id_item', DB::raw('SUM(tbl_production_materials.qty) as total_reserved_prod'))
                ->where('tbl_productions.id_warehouse', $idWarehouse)
                ->where('tbl_productions.id_company', $idCompany)
                ->whereIn('tbl_productions.status', [1, 2])
                ->where('tbl_productions.id_production', '!=', $this->productionId)
                ->whereNull('tbl_production_materials.deleted_at')
                ->whereNull('tbl_productions.deleted_at')
                ->groupBy('tbl_production_materials.id_item');

            $matItems = Item::where('is_active', 1)
                ->leftJoinSub($incomeSub, 'income', 'tbl_items.id_item', '=', 'income.id_item')
                ->leftJoinSub($outcomeSub, 'outcome', 'tbl_items.id_item', '=', 'outcome.id_item')
                ->leftJoinSub($reservedThisProdSub, 'reserved_this', 'tbl_items.id_item', '=', 'reserved_this.id_item')
                ->leftJoinSub($reservedIkbSub, 'reserved_ikb', 'tbl_items.id_item', '=', 'reserved_ikb.id_item')
                ->leftJoinSub($reservedOtherProdSub, 'reserved_prod', 'tbl_items.id_item', '=', 'reserved_prod.id_item')
                ->select(
                    'tbl_items.id_item',
                    'tbl_items.item_code',
                    'tbl_items.item_name',
                    'tbl_items.id_item_category',
                    DB::raw('COALESCE(income.total_income, 0) - COALESCE(outcome.total_outcome, 0) - COALESCE(reserved_this.total_reserved_this, 0) - COALESCE(reserved_ikb.total_reserved_ikb, 0) - COALESCE(reserved_prod.total_reserved_prod, 0) as available_stock')
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
