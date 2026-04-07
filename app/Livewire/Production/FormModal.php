<?php

namespace App\Livewire\Production;

use App\Models\Production;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\On;

class FormModal extends Component
{
    public $productionId;
    public $production_number;
    public $id_warehouse;
    public $id_departement;
    public $id_company;
    public $production_date;
    public $description;

    public $isEdit = false;

    #[On('open-production-form')]
    public function openModal($id = null)
    {
        $this->resetValidation();
        $this->reset(['productionId', 'production_number', 'id_warehouse', 'id_departement', 'id_company', 'production_date', 'description', 'isEdit']);

        if ($id) {
            $this->isEdit = true;
            $this->productionId = $id;
            $production = Production::findOrFail($id);

            $this->production_number = $production->production_number;
            $this->id_warehouse = $production->id_warehouse;
            $this->id_departement = $production->id_departement;
            $this->id_company = $production->id_company;
            $this->production_date = $production->production_date ? \Carbon\Carbon::parse($production->production_date)->format('Y-m-d') : '';
            $this->description = $production->description;
        } else {
            $user = Auth::user();
            $this->id_warehouse = $user->id_warehouse;
            $this->id_departement = $user->id_departement;
            $this->id_company = $user->id_company;
            $this->production_date = date('Y-m-d');
        }

        $this->dispatch('show-modal', id: 'productionFormModal');
    }

    public function save()
    {
        $this->validate([
            'id_warehouse' => 'required',
            'id_departement' => 'required',
            'id_company' => 'required',
            'production_date' => 'required|date',
            'description' => 'required',
        ]);

        if ($this->isEdit) {
            $production = Production::findOrFail($this->productionId);
            $production->update([
                'id_warehouse' => $this->id_warehouse,
                'id_departement' => $this->id_departement,
                'id_company' => $this->id_company,
                'production_date' => $this->production_date,
                'description' => $this->description,
            ]);

            $this->dispatch('alert', [
                'type' => 'success',
                'title' => 'Sukses!',
                'message' => 'Data Production berhasil diubah.'
            ]);
        } else {
            // Generate Production Number
            $warehouseCode = \App\Models\Warehouse::find($this->id_warehouse)->warehouse_code ?? 'WH';
            $companyCode = \App\Models\Company::find($this->id_company)->kd_company ?? 'COMP';
            $yearMonth = date('ym', strtotime($this->production_date));
            
            if ($this->production_number) {
                // Manual input by user
                $this->validate([
                    'production_number' => 'unique:tbl_productions,production_number'
                ]);
                $finalNumber = $this->production_number;
            } else {
                // Auto generate
                $lastRecord = Production::withTrashed()
                    ->whereMonth('production_date', date('m', strtotime($this->production_date)))
                    ->whereYear('production_date', date('Y', strtotime($this->production_date)))
                    ->orderBy('id_production', 'desc')
                    ->first();
                
                $last = 1;
                if ($lastRecord && preg_match('/\/(\d{4})$/', $lastRecord->production_number, $matches)) {
                    $last = (int)$matches[1] + 1;
                } elseif ($lastRecord) {
                    $last = Production::withTrashed()
                        ->whereMonth('production_date', date('m', strtotime($this->production_date)))
                        ->whereYear('production_date', date('Y', strtotime($this->production_date)))
                        ->count() + 1;
                }
                
                $finalNumber = "PROD/{$companyCode}/{$warehouseCode}/{$yearMonth}/" . str_pad($last, 4, '0', STR_PAD_LEFT);
            }

            Production::create([
                'production_number' => $finalNumber,
                'id_user' => Auth::id(),
                'id_warehouse' => $this->id_warehouse,
                'id_departement' => $this->id_departement,
                'id_company' => $this->id_company,
                'production_date' => $this->production_date,
                'status' => 0,
                'description' => $this->description,
            ]);

            $this->dispatch('alert', [
                'type' => 'success',
                'title' => 'Sukses!',
                'message' => 'Data Production berhasil dibuat.'
            ]);
        }

        $this->dispatch('refreshProductionIndex');
        $this->dispatch('close-production-modal');
    }

    public function render()
    {
        return view('livewire.production.form-modal', [
            'warehouses' => \App\Models\Warehouse::all(),
            'departements' => \App\Models\Departement::all(),
            'companies' => \App\Models\Company::all(),
        ]);
    }
}
