<?php

namespace App\Livewire\SettlementReports;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\Sr;
use App\Models\DocType;
use App\Models\Departement;
use App\Models\CostType;
use App\Models\CostCategory;
use App\Models\Branch;
use App\Models\Company;
use App\Models\Vendor;
use App\Models\Currency;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Cache;

class FormModal extends Component
{
    // SR State form dikelola oleh Alpine.js

    #[On('open-sr-form')]
    public function openModal($id = null)
    {
        if ($id) {
            // Dalam konteks ini, ID yang dikirim dari tombol Create Settlement 
            // di PR Show = id_pr. SR Form akan membukanya sebagai data awal,
            // ATAU edit jika sudah ada draft SR untuk PR tersebut.

            // Cek apakah SR sudah ada
            $sr = Sr::where('id_pr', $id)->first();

            if ($sr) {
                // Mode Edit SR
                abort_if(
                    Auth::user()->level !== 1
                        && !Auth::user()->hasPermission('sr.edit')
                        && Auth::user()->id_user !== $sr->id_user,
                    403
                );

                if (!in_array($sr->status, [null, 0, 12])) {
                    $this->dispatch('alert', ['type' => 'error', 'message' => 'SR yang sedang diproses tidak dapat diedit. Hanya SR Draft atau Revisi yang bisa diedit.']);
                    return;
                }
                $this->dispatch('open-sr-form-js', ['sr' => $sr->toArray()]);
            } else {
                // Mode Buat Baru SR dari PR
                // Ambil data PR untuk prefill
                $pr = \App\Models\Pr::findOrFail($id);
                $this->dispatch('open-sr-form-js', ['sr' => $pr->toArray(), 'is_new_from_pr' => true]);
            }
        } else {
            $this->dispatch('open-sr-form-js', []);
        }
    }

    public function saveFromJs(array $formData, $srId = null)
    {
        // Validation rules adapted for SR
        $rules = [
            'subject'          => 'required',
            'payment_method'   => 'required',
            'payment_due_date' => 'required|date',
            'id_vendor'        => 'required',
            // No invoice is not required for SR usually, but keeping adapted logic if necessary
        ];

        $messages = [
            'subject.required'          => 'Subject wajib diisi.',
            'payment_method.required'   => 'Payment Method wajib diisi.',
            'payment_due_date.required' => 'Payment Due Date wajib diisi.',
            'id_vendor.required'        => 'Vendor wajib diisi.',
        ];

        $validator = Validator::make($formData, $rules, $messages);
        if ($validator->fails()) {
            return ['errors' => $validator->errors()->toArray()];
        }

        DB::beginTransaction();
        try {
            $allowed = [
                'id_pr',
                'id_doc_type',
                'id_departement',
                'id_cost_type',
                'id_cost_category',
                'id_branch',
                'id_loan',
                'id_company',
                'id_vendor',
                'id_email_vendor',
                'id_norek_vendor',
                'id_email_user',
                'subject',
                'no_invoice',
                'additional_discount',
                'nama_bank',
                'nama_penerima',
                'norek',
                'payment_method',
            ];
            $data = array_intersect_key($formData, array_flip($allowed));
            $data['additional_discount'] = $data['additional_discount'] ?? 0;
            $data['id_loan']    = !empty($data['id_loan'])    ? $data['id_loan']    : null;
            $data['id_norek_vendor']    = !empty($data['id_norek_vendor'])    ? $data['id_norek_vendor']    : null;
            $data['id_email_vendor']    = !empty($data['id_email_vendor'])    ? $data['id_email_vendor']    : null;

            if ($srId) {
                $sr = Sr::findOrFail($srId);
                $sr->update($data);
            } else {
                $prSource = \App\Models\Pr::findOrFail($formData['id_pr']);

                $data['id_user'] = Auth::id();
                $data['status']  = 0;
                $data['id_doc_type'] = 3; // Settlement Doc Type

                // Warisi dari PR
                $data['id_departement'] = $prSource->id_departement;
                $data['id_company'] = $prSource->id_company;
                $data['id_branch'] = $prSource->id_branch;
                $data['id_cost_category'] = $prSource->id_cost_category;
                $data['id_cost_type'] = $prSource->id_cost_type;
                $data['id_email_user'] = $prSource->id_email_user;
                $data['id_loan'] = $prSource->id_loan;

                $sr = Sr::create($data);

                // Tidak lagi menyalin otomatis dari PR, user akan mengisi manual

            }

            DB::commit();
            $this->dispatch('refreshSrIndex');
            return ['success' => true, 'redirect' => route('settlement-reports.show', hashid_encode($data['id_pr'] ?? $sr->id_pr, 'pr'))];
        } catch (\Exception $e) {
            DB::rollBack();
            return ['error' => 'Terjadi kesalahan: ' . $e->getMessage()];
        }
    }

    public function render()
    {
        $ttl = 7200;

        // Untuk form SR, DocType umumnya 3 (Settlement Report)
        $docTypes = Cache::remember('sr_doc_types', $ttl, fn() => DocType::where('id_doc_type', 3)->get());

        return view('livewire.settlement-reports.form-modal', [
            'docTypes'       => $docTypes,
            'departements'   => Cache::remember('pr_departements',    $ttl, fn() => Departement::orderBy('departement')->get()),
            'costCategories' => Cache::remember('pr_cost_categories', $ttl, fn() => CostCategory::all()),
            'branches'       => Cache::remember('pr_branches',        $ttl, fn() => Branch::all()),
            'companies'      => Cache::remember('pr_companies',       $ttl, fn() => Company::all()),
            'vendors'        => Vendor::all(),
            'currencies'     => Cache::remember('pr_currencies',      $ttl, fn() => Currency::all()),
            'loans'          => Cache::remember('pr_loans',           $ttl, fn() => \App\Models\Loan::all()),
            'userEmails'     => \App\Models\UserEmail::where('id_user', Auth::id())->get(),
        ]);
    }
}
