<?php

namespace App\Livewire\Contracts;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\Contract;
use App\Models\Company;
use App\Models\Departement;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class FormModal extends Component
{
    #[On('open-contract-form')]
    public function openModal($id = null)
    {
        if ($id) {
            $contract = Contract::findOrFail($id);
            $user     = Auth::user();

            // Only owner or admin can edit
            if ($user->level !== 1 && $user->id_user !== $contract->id_user) {
                $this->dispatch('alert', ['type' => 'error', 'message' => 'Anda tidak memiliki hak untuk mengedit kontrak ini.']);
                return;
            }

            $this->dispatch('open-contract-form-js', ['contract' => $contract->toArray()]);
        } else {
            // Requires contract.create permission
            $user = Auth::user();
            if ($user->level !== 1 && !$user->hasPermission('contract.create')) {
                $this->dispatch('alert', ['type' => 'error', 'message' => 'Anda tidak memiliki izin membuat kontrak.']);
                return;
            }
            $this->dispatch('open-contract-form-js', []);
        }
    }

    /**
     * Called from Alpine.js
     */
    public function saveFromJs(array $formData, $contractId = null)
    {
        $rules = [
            'id_company'     => 'required|integer',
            'id_departement' => 'required|integer',
            'description'    => 'nullable|string',
            'start_date'     => 'nullable|date',
            'end_date'       => 'nullable|date|after_or_equal:start_date',
        ];

        $messages = [
            'id_company.required'     => 'Company wajib diisi.',
            'id_departement.required' => 'Departemen wajib diisi.',
            'end_date.after_or_equal' => 'Tanggal selesai harus setelah atau sama dengan tanggal mulai.',
        ];

        $validator = Validator::make($formData, $rules, $messages);
        if ($validator->fails()) {
            return ['errors' => $validator->errors()->toArray()];
        }

        DB::beginTransaction();
        try {
            $allowed = ['id_company', 'id_departement', 'description', 'start_date', 'end_date'];
            $data    = array_intersect_key($formData, array_flip($allowed));

            $data['start_date'] = !empty($data['start_date']) ? $data['start_date'] : null;
            $data['end_date']   = !empty($data['end_date'])   ? $data['end_date']   : null;

            if ($contractId) {
                $contract = Contract::findOrFail($contractId);
                $contract->update($data);
            } else {
                $data['id_user']      = Auth::id();
                $currentYear          = date('Y');

                // Auto-generate number
                $lastNumber = Contract::where('id_departement', $data['id_departement'])
                    ->whereYear('created_at', $currentYear)
                    ->max(DB::raw('CAST(SUBSTRING_INDEX(contract_number, ".", -1) AS UNSIGNED)'));

                $useNumber  = ($lastNumber ?? 0) + 1;

                $dept        = \App\Models\Departement::find($data['id_departement']);
                $comp        = \App\Models\Company::find($data['id_company']);
                $deptAbbr    = $dept ? strtoupper(substr($dept->departement, 0, 4)) : 'DEP';
                $compAbbr    = $comp ? strtoupper(substr($comp->company, 0, 4))     : 'COMP';
                $year        = substr(date('Y'), -2);
                $month       = str_pad(date('m'), 2, '0', STR_PAD_LEFT);
                $numPad      = str_pad($useNumber, 3, '0', STR_PAD_LEFT);

                $data['contract_number'] = "CTR.{$compAbbr}.{$deptAbbr}.{$year}{$month}.{$numPad}";

                $contract = Contract::create($data);
            }

            DB::commit();
            $this->dispatch('refreshContractIndex');
            return ['success' => true, 'redirect' => route('contracts.show', hashid_encode($contract->id_contract, 'pr'))];
        } catch (\Exception $e) {
            DB::rollBack();
            return ['error' => 'Terjadi kesalahan: ' . $e->getMessage()];
        }
    }

    public function render()
    {
        return view('livewire.contracts.form-modal', [
            'companies'    => Company::orderBy('company_name')->get(),
            'departements' => Departement::orderBy('departement')->get(),
        ]);
    }
}
