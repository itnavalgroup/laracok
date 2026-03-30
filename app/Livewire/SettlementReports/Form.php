<?php

namespace App\Livewire\SettlementReports;

use Livewire\Component;
use App\Models\Pr;
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

class Form extends Component
{
    public $prHash;
    public $srId;
    public $initialData = [];

    public function mount($prHash = null, $id = null)
    {
        $this->prHash = $prHash;
        $this->srId = $id;

        if ($this->srId) {
            // Edit Mode
            $sr = Sr::findOrFail($this->srId);

            abort_if(
                Auth::user()->level !== 1
                    && !Auth::user()->hasPermission('sr.edit')
                    && Auth::user()->id_user !== $sr->id_user,
                403
            );

            if (!in_array($sr->status, [null, 0, 12])) {
                abort(403, 'SR yang sedang diproses tidak dapat diedit.');
            }

            $this->initialData = $sr->toArray();
            $this->initialData['is_edit'] = true;
            $this->initialData['id_pr_origin'] = $sr->id_pr;
        } elseif ($this->prHash) {
            // Create Mode from PR
            $prId = hashid_decode($this->prHash, 'pr');
            abort_if(!$prId, 404);

            $pr = Pr::findOrFail($prId);

            // PR must be of doc_type 2 (Advance) to create SR
            abort_if($pr->id_doc_type != 2, 403, 'Hanya Payment Request (Advance) yang dapat dibuat Settlement.');

            // Cek apakah SR sudah ada untuk PR ini
            $existingSr = Sr::where('id_pr', $prId)->first();
            if ($existingSr) {
                $srHash = hashid_encode($existingSr->id_pr, 'pr');
                session()->flash('error', 'Settlement Report untuk PR ini sudah ada (No. ' . ($existingSr->pr_number ?? $existingSr->id_pr) . '). Anda tidak bisa membuat SR baru.');
                redirect()->route('settlement-reports.show', $srHash)->send();
                return;
            }

            // Pre-fill data from PR
            $this->initialData = [
                'id_doc_type' => 3, // Settlement
                'id_departement' => $pr->id_departement,
                'id_company' => $pr->id_company,
                'id_branch' => $pr->id_branch,
                'subject' => 'Settlement: ' . $pr->subject,
                'id_cost_category' => $pr->id_cost_category,
                'id_cost_type' => $pr->id_cost_type,
                'id_currency' => $pr->id_currency,
                'payment_type_pr' => $pr->payment_type_pr,
                'payment_method' => $pr->payment_method,
                'payment_due_date' => $pr->payment_due_date,
                'id_vendor' => $pr->id_vendor,
                'id_email_vendor' => $pr->id_email_vendor,
                'id_norek_vendor' => $pr->id_norek_vendor,
                'id_email_user' => $pr->id_email_user,
                'no_invoice' => $pr->no_invoice,
                'additional_discount' => 0, // Reset
                'nama_bank' => $pr->nama_bank,
                'nama_penerima' => $pr->nama_penerima,
                'norek' => $pr->norek,
                'po_number' => $pr->po_number,
                // store original PR relation inside SR creation logic
                'id_pr' => $pr->id_pr,
                'is_edit' => false
            ];
        } else {
            // New SR directly without PR? Not allowed based on requirements, but just in case
            abort(403, 'Settlement Report harus dibuat dari Payment Request (Advance).');
        }
    }

    public function saveFromJs(array $formData, $srId = null)
    {
        $rules = [
            'subject'          => 'required',
            'payment_method'   => 'required',
            'id_vendor'        => 'required',
        ];

        $messages = [
            'subject.required'          => 'Subject wajib diisi.',
            'payment_method.required'   => 'Payment Method wajib diisi.',
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
            $data['id_norek_vendor']    = !empty($data['id_norek_vendor'])    ? $data['id_norek_vendor']    : null;
            $data['id_email_vendor']    = !empty($data['id_email_vendor'])    ? $data['id_email_vendor']    : null;
            $data['id_pr']              = !empty($data['id_pr'])              ? $data['id_pr']              : null; // important reference to original PR

            if ($srId) {
                // Edit existing SR
                $sr = Sr::findOrFail($srId);
                $sr->update($data);
            } else {
                // Create new SR
                $prSource = Pr::find($data['id_pr']);
                if (!$prSource) {
                    throw new \Exception('Referensi Payment Request (PR) tidak ditemukan.');
                }

                $data['id_user'] = Auth::id();
                $data['status']  = 0;
                $data['id_doc_type'] = 3;

                // Warisi dari PR
                $data['id_departement'] = $prSource->id_departement;
                $data['id_company'] = $prSource->id_company;
                $data['id_branch'] = $prSource->id_branch;
                $data['id_cost_category'] = $prSource->id_cost_category;
                $data['id_cost_type'] = $prSource->id_cost_type;
                $data['id_email_user'] = $prSource->id_email_user;
                $data['id_loan'] = $prSource->id_loan;

                $sr = Sr::create($data);

                // Fetch PR details and copy to SR details automatically since it's a settlement
                // Diubah: tidak lagi menyalin detail otomatis, agar user mengisi manual

            }

            DB::commit();
            return ['success' => true, 'redirect' => route('settlement-reports.show', hashid_encode($sr->id_pr, 'pr'))];
        } catch (\Exception $e) {
            DB::rollBack();
            return ['error' => 'Terjadi kesalahan: ' . $e->getMessage()];
        }
    }

    public function render()
    {
        $ttl = 7200;

        $docTypes = Cache::remember('pr_doc_types_all', $ttl, fn() => DocType::whereIn('id_doc_type', [1, 2, 3])->get());

        $filteredDocTypes = $docTypes->filter(function ($doc) {
            return $doc->id_doc_type == 3; // SR form only uses doc type 3
        });

        return view('livewire.settlement-reports.form', [
            'docTypes'       => $filteredDocTypes,
            'departements'   => Cache::remember('pr_departements',    $ttl, fn() => Departement::orderBy('departement')->get()),
            'costCategories' => Cache::remember('pr_cost_categories', $ttl, fn() => CostCategory::all()),
            'branches'       => Cache::remember('pr_branches',        $ttl, fn() => Branch::all()),
            'companies'      => Cache::remember('pr_companies',       $ttl, fn() => Company::all()),
            'vendors'        => Cache::remember('pr_vendors',         $ttl, fn() => Vendor::where('is_active', 1)->get()),
            'currencies'     => Cache::remember('pr_currencies',      $ttl, fn() => Currency::all()),
            'loans'          => Cache::remember('pr_loans',           $ttl, fn() => \App\Models\Loan::all()),
            'userEmails'     => \App\Models\UserEmail::where('id_user', Auth::id())->get(),
        ])->layout('layouts.app');
    }
}
