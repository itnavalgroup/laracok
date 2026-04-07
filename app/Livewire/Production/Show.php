<?php

namespace App\Livewire\Production;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\Production;
use App\Models\ProductionMaterial;
use App\Models\ProductionResult;
use App\Models\Item;
use App\Models\ItemTransaction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;
use Endroid\QrCode\ErrorCorrectionLevel;

class Show extends Component
{
    public $productionId;
    public $cancel_reason;

    // form for material
    public $mat_id_item;
    public $mat_qty;

    // form for result
    public $res_id_item;
    public $res_qty;

    // approval dates
    public $process_date;
    public $finish_date;

    public function mount($hash)
    {
        $id = hashid_decode($hash, 'production');
        abort_if(!$id, 404);

        $this->productionId = $id;

        $production = Production::findOrFail($id);
        $user = Auth::user();

        $this->process_date = $production->production_date ? \Carbon\Carbon::parse($production->production_date)->format('Y-m-d') : date('Y-m-d');
        $this->finish_date = $production->finished_date ? \Carbon\Carbon::parse($production->finished_date)->format('Y-m-d') : date('Y-m-d');

        // Check Permissions
        $canView = $user->level === 1
            || $user->id_user == $production->id_user
            || $user->hasPermission('production.view.all')
            || ($user->hasPermission('production.view.dept') && $user->id_departement == $production->id_departement)
            || ($user->hasPermission('production.view.warehouse') && $user->id_warehouse == $production->id_warehouse);

        abort_if(!$canView, 403);
    }

    public function getQr($text)
    {
        try {
            $qr = new QrCode(
                data: $text,
                errorCorrectionLevel: ErrorCorrectionLevel::Low,
                size: 200,
                margin: 10
            );

            $writer = new PngWriter();
            $result = $writer->write($qr);

            return $result->getDataUri();
        } catch (\Throwable $e) {
            return '';
        }
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
        $production = Production::findOrFail($this->productionId);
        if ($production->status > 0) return;

        $this->validate([
            'mat_id_item' => 'required',
            'mat_qty' => 'required|numeric|min:0.01',
        ]);

        $item = Item::find($this->mat_id_item);

        $actualStock = ItemTransaction::where('id_item', $this->mat_id_item)
            ->where('id_warehouse', $production->id_warehouse)
            ->where('id_company', $production->id_company)
            ->sum('income') - ItemTransaction::where('id_item', $this->mat_id_item)
            ->where('id_warehouse', $production->id_warehouse)
            ->where('id_company', $production->id_company)
            ->sum('outcome');

        $reservedInThisForm = \App\Models\ProductionMaterial::where('id_production', $this->productionId)
            ->where('id_item', $this->mat_id_item)
            ->sum('qty');
            
        $availableStock = $actualStock - $reservedInThisForm;

        if ($this->mat_qty > $availableStock) {
            $this->addError('mat_qty', "Stok maksimal yang tersedia adalah {$availableStock}");
            $this->dispatch('alert', [
                'type' => 'error',
                'title' => 'Stok Tidak Cukup',
                'message' => "Stok {$item->item_name} yang tersedia hanya {$availableStock}."
            ]);
            return;
        }

        ProductionMaterial::create([
            'id_production' => $this->productionId,
            'id_item' => $this->mat_id_item,
            'id_item_category' => $item->id_item_category,
            'id_uom' => $item->id_uom,
            'id_packaging' => $item->id_packaging,
            'qty' => $this->mat_qty,
        ]);

        $this->resetMaterialForm();
    }

    public function deleteMaterial($id)
    {
        $production = Production::findOrFail($this->productionId);
        if ($production->status > 0) return;
        
        ProductionMaterial::find($id)->delete();
    }

    public function addResult()
    {
        $production = Production::findOrFail($this->productionId);
        if ($production->status > 0) return;

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
    }

    public function deleteResult($id)
    {
        $production = Production::findOrFail($this->productionId);
        if ($production->status > 0) return;

        ProductionResult::find($id)->delete();
    }

    public function submitProduction()
    {
        $production = Production::findOrFail($this->productionId);
        if ($production->status != 0) return;

        if ($production->materials->isEmpty()) {
            $this->dispatch('alert', [
                'type' => 'error',
                'title' => 'Gagal',
                'message' => 'Material tidak boleh kosong!'
            ]);
            return;
        }

        $production->update([
            'status' => 1
        ]);
        
        $this->dispatch('alert', ['type' => 'success', 'message' => 'Production has been submitted.']);
    }

    public function processProduction()
    {
        $this->validate([
            'process_date' => 'required|date'
        ]);

        $production = Production::findOrFail($this->productionId);
        if ($production->status != 1) return;

        $production->update([
            'status' => 2,
            'processed_by' => Auth::id(),
            'production_date' => $this->process_date
        ]);
        
        $this->dispatch('alert', ['type' => 'success', 'message' => 'Production has been processed.']);
    }

    public function cancelProduction()
    {
        $this->validate([
            'cancel_reason' => 'required|string|max:255'
        ], [
            'cancel_reason.required' => 'Mohon isi alasan penolakan/pembatalan.'
        ]);

        $production = Production::findOrFail($this->productionId);

        if ($production->status == 1 && (Auth::user()->hasPermission('production.process') || Auth::user()->level == 1)) {
            // Process Rejecting -> Back to Draft
            $production->update([
                'status' => 0,
                'cancel_reason' => $this->cancel_reason,
                'canceled_by' => Auth::user()->id_user
            ]);
            $this->dispatch('alert', ['type' => 'success', 'message' => 'Form ditolak, dikembalikan ke Requestor.']);
        } elseif ($production->status == 2 && (Auth::user()->hasPermission('production.verify') || Auth::user()->level == 1)) {
            // Verify Rejecting -> Back to Processed
            $production->update([
                'status' => 1, 
                'processed_by' => null,
                'cancel_reason' => $this->cancel_reason,
                'canceled_by' => Auth::user()->id_user
            ]);
            $this->dispatch('alert', ['type' => 'success', 'message' => 'Form ditolak, dikembalikan ke Processor.']);
        }
        
    }

    public function verifyProduction()
    {
        $this->validate([
            'finish_date' => 'required|date'
        ]);

        $production = Production::findOrFail($this->productionId);
        // Must be in Processed (2) status
        if ($production->status != 2) return;

        if ($production->results->isEmpty()) {
            $this->dispatch('alert', [
                'type' => 'error',
                'title' => 'Gagal',
                'message' => 'Result (Output) belum ditambahkan. Silakan tambahkan hasil produksi terlebih dahulu!'
            ]);
            return;
        }

        try {
            DB::beginTransaction();

            $docTypeProd = \App\Models\DocType::firstOrCreate(
                ['doc_type' => 'Production_Transactions'],
                ['created_at' => now(), 'updated_at' => now()]
            );

            foreach ($production->materials as $mat) {
                ItemTransaction::create([
                    'id_item' => $mat->id_item,
                    'id_item_category' => $mat->id_item_category,
                    'id_warehouse' => $production->id_warehouse,
                    'id_company' => $production->id_company,
                    'id_user' => Auth::id(),
                    'id_departement' => $production->id_departement,
                    'id_uom' => $mat->id_uom,
                    'id_packaging' => $mat->id_packaging,
                    'id_doc_type' => $docTypeProd->id_doc_type,
                    'transaction_code' => $production->production_number,
                    'income' => 0,
                    'outcome' => $mat->qty,
                    'transaction_date' => $production->production_date,
                    'description' => 'Usage for Production ' . $production->production_number,
                ]);
            }

            foreach ($production->results as $res) {
                ItemTransaction::create([
                    'id_item' => $res->id_item,
                    'id_item_category' => $res->id_item_category,
                    'id_warehouse' => $production->id_warehouse,
                    'id_company' => $production->id_company,
                    'id_user' => Auth::id(),
                    'id_departement' => $production->id_departement,
                    'id_uom' => $res->id_uom,
                    'id_packaging' => $res->id_packaging,
                    'id_doc_type' => $docTypeProd->id_doc_type,
                    'transaction_code' => $production->production_number,
                    'income' => $res->qty,
                    'outcome' => 0,
                    'transaction_date' => $production->production_date,
                    'description' => 'Result from Production ' . $production->production_number,
                ]);
            }

            $production->update([
                'status' => 3, // Verified
                'finished_by' => Auth::id(),
                'finished_date' => $this->finish_date
            ]);

            DB::commit();

            $this->dispatch('alert', [
                'type' => 'success',
                'message' => 'Production berhasil difinish dan inventory telah diupdate.'
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            $this->dispatch('alert', [
                'type' => 'error',
                'message' => 'Gagal memproses inventory: ' . $e->getMessage()
            ]);
        }
    }

    #[On('production-refresh')]
    public function refreshComponent() {}

    public function render()
    {
        $production = Production::with([
            'materials.item', 'results.item', 
            'materials.uom', 'results.uom', 
            'user', 'warehouse', 'departement', 'company',
            'processedBy', 'finishedBy', 'canceledBy'
        ])->find($this->productionId);

        // Query exclusively for Raw Materials with stock checking
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

        $matItems = Item::where('is_active', 1)
            ->leftJoinSub($incomeSub, 'income', 'tbl_items.id_item', '=', 'income.id_item')
            ->leftJoinSub($outcomeSub, 'outcome', 'tbl_items.id_item', '=', 'outcome.id_item')
            ->select(
                'tbl_items.id_item',
                'tbl_items.item_code',
                'tbl_items.item_name',
                'tbl_items.id_item_category',
                DB::raw('COALESCE(income.total_income, 0) - COALESCE(outcome.total_outcome, 0) as available_stock')
            )
            ->having('available_stock', '>', 0)
            ->get();

        $resItems = Item::where('is_active', 1)->get();
        
        $approverSigns = [];

        // Box 1 - Requestor (Creator)
        if ($production->status >= 1) {
            $approverSigns[0] = [
                'step_name' => 'Requested By',
                'user_name' => $production->user->name,
                'date'      => $production->created_at->format('d/m/Y H:i'),
                'qr'        => $this->getQr($production->user->name . ' - ' . $production->created_at->format('Y-m-d H:i')),
            ];
        }

        // Box 2 - Processed
        if ($production->status >= 2 && $production->processedBy) {
            $approverSigns[1] = [
                'step_name' => 'Processed By',
                'user_name' => $production->processedBy->name,
                'date'      => $production->updated_at->format('d/m/Y H:i'),
                'qr'        => $this->getQr($production->processedBy->name . ' - Processed'),
            ];
        }

        // Box 3 - Verified By
        if ($production->status == 3 && $production->finishedBy) {
            $approverSigns[2] = [
                'step_name' => 'Verified By',
                'user_name' => $production->finishedBy->name,
                'date'      => $production->updated_at->format('d/m/Y H:i'),
                'qr'        => $this->getQr($production->finishedBy->name . ' - Verified'),
            ];
        }

        return view('livewire.production.show', [
            'production' => $production,
            'matItems' => $matItems,
            'resItems' => $resItems,
            'approverSigns' => $approverSigns
        ])->layout('layouts.app');
    }
}

