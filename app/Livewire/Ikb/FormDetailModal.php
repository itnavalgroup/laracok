<?php

namespace App\Livewire\Ikb;

use App\Models\Contract;
use App\Models\Ikb;
use App\Models\IkbDetail;
use App\Models\Item;
use App\Models\ItemCategory;
use App\Models\Packaging;
use App\Models\Uom;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Livewire\Attributes\On;
use Livewire\Component;

class FormDetailModal extends Component
{
    public $ikbId;

    public function mount($ikbId = null)
    {
        $this->ikbId = $ikbId;
    }

    #[On('openModal')]
    public function openModal($id = null)
    {
        if ($id) {
            $detail = IkbDetail::findOrFail($id);
            $this->dispatch('open-ikb-detail-form-js', ['detail' => $detail->toArray()]);
        } else {
            $this->dispatch('open-ikb-detail-form-js', []);
        }
    }

    public function saveFromJs(array $formData, $detailId = null)
    {
        // 0. Sanitize Qty Input (Strip commas/thousand separators) before validation
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

        $messages = [
            'id_item_category.required' => 'Category wajib dipilih.',
            'id_item.required' => 'Item wajib dipilih.',
            'qty.required' => 'Quantity wajib diisi.',
            'qty.min' => 'Quantity harus lebih besar dari 0.',
            'id_uom.required' => 'UOM wajib dipilih.',
            'id_packaging.required' => 'Packaging wajib dipilih.',
        ];

        $validator = Validator::make($formData, $rules, $messages);
        if ($validator->fails()) {
            return ['errors' => $validator->errors()->toArray()];
        }

        $user = Auth::user();
        $ikb = Ikb::findOrFail($this->ikbId);

        // Check if this is Inventory Control edit mode (status 4-9, approver editing qty only)
        $isInvCtrlEdit = ($ikb->status >= 4 && $ikb->status <= 9)
            && $detailId
            && ($user->level === 1 || $user->hasPermission('ikb.approve.step4'));

        if ($detailId) {
            // Edit permission: Admin OR (Owner AND ikb_detail.edit) OR (InvCtrl in status 4)
            $isOwnerEditor = $user->id_user == $ikb->id_user && $user->hasPermission('ikb_detail.edit');
            if ($user->level !== 1 && ! $isOwnerEditor && ! $isInvCtrlEdit) {
                return ['error' => 'Anda tidak memiliki hak akses untuk mengedit item.'];
            }
        } else {
            // Create permission: Admin OR (Owner AND ikb_detail.create)
            if ($user->level !== 1 && ! ($user->id_user == $ikb->id_user && $user->hasPermission('ikb_detail.create'))) {
                return ['error' => 'Anda tidak memiliki hak akses untuk menambah item.'];
            }
        }

        if (! in_array($ikb->status, [0, 11]) && ! $isInvCtrlEdit) {
            return ['error' => 'Item tidak dapat dimodifikasi saat IKB sedang diproses.'];
        }

        // --- PRE-EMPTIVE STOCK VALIDATION ---
        $qtyInput = (float) $formData['qty'];
        $itemIdInput = $formData['id_item'];

        // 1. Calculate Actual Stock (Income - Outcome)
        $totalIn = \App\Models\ItemTransaction::where('id_item', '=', $itemIdInput)
            ->where('id_warehouse', '=', $ikb->id_warehouse)
            ->where('id_company', '=', $ikb->id_company)
            ->sum('income');
        $totalOut = \App\Models\ItemTransaction::where('id_item', '=', $itemIdInput)
            ->where('id_warehouse', '=', $ikb->id_warehouse)
            ->where('id_company', '=', $ikb->id_company)
            ->sum('outcome');
        $actualStock = $totalIn - $totalOut;

        // 2. Calculate Reserved Stock from other IKBs (status 5-9: Step 4 / Inventory Control Approved)
        $reservedQty = \App\Models\IkbDetail::whereHas('ikb', function ($q) use ($ikb) {
            $q->where('status', '>=', 5)
                ->where('status', '<', 10)
                ->where('id_warehouse', '=', $ikb->id_warehouse)
                ->where('id_company', '=', $ikb->id_company)
                ->where('id_ikb', '!=', $ikb->id_ikb);
        })
            ->where('id_item', '=', $itemIdInput)
            ->sum('qty');

        $availableStock = $actualStock - $reservedQty;

        if ($availableStock < $qtyInput) {
            $item = Item::find($itemIdInput);
            $itemName = $item->item_name ?? 'Item selected';

            return ['error' => "Stok untuk {$itemName} tidak mencukupi untuk Company ini. (Available: {$availableStock}, Requested: {$qtyInput})"];
        }

        DB::beginTransaction();
        try {
            if ($isInvCtrlEdit) {
                // Inventory Control mode: only qty is updated
                $data = ['qty' => $formData['qty']];
            } else {
                $data = [
                    'id_item_category' => $formData['id_item_category'],
                    'description' => $formData['description'],
                    'id_item' => $formData['id_item'],
                    'qty' => $formData['qty'],
                    'id_uom' => $formData['id_uom'],
                    'id_packaging' => $formData['id_packaging'],
                    'id_contract' => ! empty($formData['id_contract']) ? $formData['id_contract'] : null,
                ];
            }

            if ($detailId) {
                // Edit
                $detail = IkbDetail::findOrFail($detailId);
                $detail->update($data);
            } else {
                // Create
                $data['id_ikb'] = $this->ikbId;
                IkbDetail::create($data);
            }

            if ($ikb->status == 11) {
                $ikb->status = 0;
                $ikb->save();
            }

            DB::commit();
            $this->dispatch('ikb-refresh');

            return ['success' => true];
        } catch (\Exception $e) {
            DB::rollBack();

            return ['error' => 'Gagal menyimpan detail: '.$e->getMessage()];
        }
    }

    public function render()
    {
        $ikb = Ikb::find($this->ikbId);
        $items = collect();

        if ($ikb) {
            $idWarehouse = $ikb->id_warehouse;
            $idCompany = $ikb->id_company;

            // Subquery for Income
            $incomeSub = DB::table('tbl_item_transactions')
                ->select('id_item', DB::raw('SUM(income) as total_income'))
                ->where('id_warehouse', $idWarehouse)
                ->where('id_company', $idCompany)
                ->whereNull('deleted_at')
                ->groupBy('id_item');

            // Subquery for Outcome
            $outcomeSub = DB::table('tbl_item_transactions')
                ->select('id_item', DB::raw('SUM(outcome) as total_outcome'))
                ->where('id_warehouse', $idWarehouse)
                ->where('id_company', $idCompany)
                ->whereNull('deleted_at')
                ->groupBy('id_item');

            // Subquery for Reserved from other IKBs (status >= 5 and < 10)
            $reservedSub = DB::table('tbl_ikb_details')
                ->join('tbl_ikb', 'tbl_ikb_details.id_ikb', '=', 'tbl_ikb.id_ikb')
                ->select('tbl_ikb_details.id_item', DB::raw('SUM(tbl_ikb_details.qty) as total_reserved'))
                ->where('tbl_ikb.id_warehouse', $idWarehouse)
                ->where('tbl_ikb.id_company', $idCompany)
                ->where('tbl_ikb.status', '>=', 5)
                ->where('tbl_ikb.status', '<', 10)
                ->where('tbl_ikb.id_ikb', '!=', $this->ikbId)
                ->whereNull('tbl_ikb_details.deleted_at')
                ->groupBy('tbl_ikb_details.id_item');

            $items = Item::where('is_active', 1)
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
        }

        // Filter categories: only show those that have at least one item with available stock
        // (available_stock already accounts for reserved bookings from other active IKBs)
        $availableCategoryIds = $items->pluck('id_item_category')->unique()->toArray();
        $categories = ItemCategory::where('is_active', 1)
            ->whereIn('id_item_category', $availableCategoryIds)
            ->get();

        // Contract permission gating
        $user = Auth::user();
        $canViewContract = $user->level == 1
            || $user->hasPermission('contract.view.all')
            || $user->hasPermission('contract.view.departement')
            || $user->hasPermission('contract.view.subordinate');

        $contracts = collect();
        if ($canViewContract && $ikb) {
            $itemIds = $items->pluck('id_item')->toArray();
            $contractQuery = Contract::orderByDesc('id_contract');

            // Filter contracts that have items matching those available in this IKB
            if (! empty($itemIds)) {
                $contractQuery->whereHas('details', fn ($q) => $q->whereIn('id_item', $itemIds));
            }

            // Scope by permission level
            if ($user->level != 1 && ! $user->hasPermission('contract.view.all')) {
                $contractQuery->where(function ($q) use ($user, $ikb) {
                    if ($user->hasPermission('contract.view.departement')) {
                        $q->orWhere('id_departement', $ikb->id_departement);
                    }
                    if ($user->hasPermission('contract.view.subordinate')) {
                        $subordinateIds = $user->subordinates()->pluck('id_user')->toArray();
                        $q->orWhereIn('id_user', $subordinateIds);
                    }
                });
            }

            $contracts = $contractQuery->get();
        }

        // Determine if user is inventory control in edit mode
        $isInvCtrlEditMode = false;
        if ($ikb && ($ikb->status >= 4 && $ikb->status <= 9)) {
            $isOwnerEditor = $user->id_user == $ikb->id_user && $user->hasPermission('ikb_detail.edit');
            $isInvCtrlApprover = ! $user->level == 1 && $user->hasPermission('ikb.approve.step4');
            $isInvCtrlEditMode = $isInvCtrlApprover && ! $isOwnerEditor;
        }

        return view('livewire.ikb.form-detail-modal', [
            'uoms' => Uom::all(),
            'categories' => $categories,
            'packagings' => Packaging::all(),
            'items' => $items,
            'contracts' => $contracts,
            'canViewContract' => $canViewContract,
            'isInvCtrlEditMode' => $isInvCtrlEditMode,
        ]);
    }
}
