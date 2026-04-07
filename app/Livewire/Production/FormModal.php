<?php

namespace App\Livewire\Production;

use App\Models\Company;
use App\Models\Departement;
use App\Models\Production;
use App\Models\User;
use App\Models\Warehouse;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;

class FormModal extends Component
{
    public $productionId;

    public $production_number;

    public $id_warehouse;

    public $id_departement;

    public $id_company;

    public $production_date;

    public $description;

    public $id_requestor;

    public $isEdit = false;

    #[On('open-production-form')]
    public function openModal($id = null)
    {
        $this->resetValidation();
        $this->reset(['productionId', 'production_number', 'id_warehouse', 'id_departement', 'id_company', 'production_date', 'description', 'isEdit', 'id_requestor']);

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
            $this->id_requestor = $production->id_requestor;
        } else {
            $user = Auth::user();
            $this->id_warehouse = $user->id_warehouse;
            $this->id_departement = $user->id_departement;
            $this->id_company = $user->id_company;
            $this->id_requestor = $user->id_user;
            $this->production_date = date('Y-m-d');
        }

        $this->dispatch('show-modal', id: 'productionFormModal');
    }

    public function save()
    {
        $this->validate([
            'id_requestor' => 'required',
            'id_warehouse' => 'required',
            'id_departement' => 'required',
            'id_company' => 'required',
            'description' => 'required',
        ]);

        if ($this->isEdit) {
            $production = Production::findOrFail($this->productionId);
            $production->update([
                'id_requestor' => $this->id_requestor,
                'id_warehouse' => $this->id_warehouse,
                'id_departement' => $this->id_departement,
                'id_company' => $this->id_company,
                'description' => $this->description,
            ]);

            $this->dispatch('alert', [
                'type' => 'success',
                'title' => 'Sukses!',
                'message' => 'Data Production berhasil diubah.',
            ]);
        } else {
            // Generate Production Number
            $warehouseCode = Warehouse::find($this->id_warehouse)->warehouse_code ?? 'WH';
            $companyCode = Company::find($this->id_company)->kd_company ?? 'COMP';
            $yearMonth = date('ym');

            if ($this->production_number) {
                // Manual input by user
                $this->validate([
                    'production_number' => 'unique:tbl_productions,production_number',
                ]);
                $finalNumber = $this->production_number;
            } else {
                // Auto generate
                $lastRecord = Production::withTrashed()
                    ->whereMonth('created_at', date('m'))
                    ->whereYear('created_at', date('Y'))
                    ->orderBy('id_production', 'desc')
                    ->first();

                $last = 1;
                if ($lastRecord && preg_match('/\/(\d{4})$/', $lastRecord->production_number, $matches)) {
                    $last = (int) $matches[1] + 1;
                } elseif ($lastRecord) {
                    $last = Production::withTrashed()
                        ->whereMonth('created_at', date('m'))
                        ->whereYear('created_at', date('Y'))
                        ->count() + 1;
                }

                $finalNumber = "PROD/{$companyCode}/{$warehouseCode}/{$yearMonth}/".str_pad($last, 4, '0', STR_PAD_LEFT);
            }

            Production::create([
                'production_number' => $finalNumber,
                'id_user' => Auth::id(),
                'id_requestor' => $this->id_requestor,
                'id_warehouse' => $this->id_warehouse,
                'id_departement' => $this->id_departement,
                'id_company' => $this->id_company,
                'production_date' => null, // Diisi saat processed
                'status' => 0,
                'description' => $this->description,
            ]);

            $this->dispatch('alert', [
                'type' => 'success',
                'title' => 'Sukses!',
                'message' => 'Data Production berhasil dibuat.',
            ]);
        }

        $this->dispatch('refreshProductionIndex');
        $this->dispatch('close-production-modal');
    }

    public function render()
    {
        return view('livewire.production.form-modal', [
            'warehouses' => Warehouse::all(),
            'departements' => Departement::all(),
            'companies' => Company::all(),
            'users' => User::select('id_user', 'name')->orderBy('name')->get(),
        ]);
    }
}
