<?php

namespace App\Livewire\PaymentRequests;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\Pr;
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
    // Tidak ada wire:model – seluruh state form dikelola Alpine.js di client-side

    #[On('open-pr-form')]
    public function openModal($id = null)
    {
        if ($id) {
            $pr = Pr::findOrFail($id);

            // Hanya creator, admin, atau yang punya permission pr.edit yang boleh akses
            abort_if(
                Auth::user()->level !== 1
                    && !Auth::user()->hasPermission('pr.edit')
                    && Auth::user()->id_user !== $pr->id_user,
                403
            );

            // Hanya boleh edit saat status 0 (draft) atau 12 (revisi)
            // Status lain = sedang dalam proses approval / sudah selesai
            if (!in_array($pr->status, [null, 0, 12])) {
                $this->dispatch('alert', ['type' => 'error', 'message' => 'PR yang sedang diproses tidak dapat diedit. Hanya PR Draft atau Revisi yang bisa diedit.']);
                return;
            }
            $this->dispatch('open-pr-form-js', ['pr' => $pr->toArray()]);
        } else {
            $this->dispatch('open-pr-form-js', []);
        }
    }

    /**
     * Dipanggil dari Alpine.js via @this.saveFromJs(form, prId)
     * Hanya sekali request ke server saat simpan.
     */
    public function saveFromJs(array $formData, $prId = null)
    {
        $rules = [
            'id_doc_type'      => 'required',
            'id_company'       => 'required',
            'id_branch'        => 'required',
            'subject'          => 'required',
            'id_cost_category' => 'required',
            'id_cost_type'     => 'required',
            'id_currency'      => 'required',
            'payment_type_pr'  => 'required',
            'payment_method'   => 'required',
            'payment_due_date' => 'required|date',
            'id_vendor'        => 'required',
            'id_email_vendor'  => 'nullable',
            'id_email_user'    => 'required',
            'no_invoice'       => 'required',
            'est_settlement_date' => ($formData['id_doc_type'] ?? null) == 2 ? 'required|date' : 'nullable|date',
            'nama_bank'    => !($formData['id_norek_vendor'] ?? null) ? 'required' : 'nullable',
            'norek'        => !($formData['id_norek_vendor'] ?? null) ? 'required' : 'nullable',
            'nama_penerima' => !($formData['id_norek_vendor'] ?? null) ? 'required' : 'nullable',
        ];

        $messages = [
            'id_doc_type.required'      => 'Tipe Dokumen wajib diisi.',
            'id_company.required'       => 'Company wajib diisi.',
            'id_branch.required'        => 'Branch wajib diisi.',
            'subject.required'          => 'Subject wajib diisi.',
            'id_cost_category.required' => 'Cost Category wajib diisi.',
            'id_cost_type.required'     => 'Cost Type wajib diisi.',
            'id_currency.required'      => 'Currency wajib diisi.',
            'payment_type_pr.required'  => 'Payment Type wajib diisi.',
            'payment_method.required'   => 'Payment Method wajib diisi.',
            'payment_due_date.required' => 'Payment Due Date wajib diisi.',
            'id_vendor.required'        => 'Vendor wajib diisi.',
            'id_email_user.required'    => 'User Email wajib diisi.',
            'no_invoice.required'       => 'No Invoice wajib diisi.',
            'nama_bank.required'        => 'Nama Bank wajib diisi.',
            'norek.required'            => 'Nomor Rekening wajib diisi.',
            'nama_penerima.required'    => 'Nama Penerima wajib diisi.',
        ];

        $validator = Validator::make($formData, $rules, $messages);
        if ($validator->fails()) {
            return ['errors' => $validator->errors()->toArray()];
        }

        DB::beginTransaction();
        try {
            $allowed = [
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
                'id_currency',
                'subject',
                'no_invoice',
                'additional_discount',
                'nama_bank',
                'nama_penerima',
                'norek',
                'payment_type_pr',
                'po_number',
                'payment_method',
                'payment_due_date',
                'est_settlement_date',
            ];
            $data = array_intersect_key($formData, array_flip($allowed));
            $data['additional_discount'] = $data['additional_discount'] ?? 0;
            $data['est_settlement_date'] = !empty($data['est_settlement_date']) ? $data['est_settlement_date'] : null;
            $data['id_loan']    = !empty($data['id_loan'])    ? $data['id_loan']    : null;
            $data['id_norek_vendor']    = !empty($data['id_norek_vendor'])    ? $data['id_norek_vendor']    : null;
            $data['id_email_vendor']    = !empty($data['id_email_vendor'])    ? $data['id_email_vendor']    : null;

            if ($prId) {
                $pr = Pr::findOrFail($prId);
                $pr->update($data);
            } else {
                $data['id_user'] = Auth::id();
                $data['status']  = 0;

                $currentYear = date('Y');

                if (!empty($formData['number'])) {
                    // Nomor manual — cek apakah sudah terpakai di dept yang sama pada tahun ini
                    $exists = Pr::where('id_departement', $data['id_departement'])
                        ->whereYear('created_at', $currentYear)
                        ->where('number', $formData['number'])
                        ->exists();
                    if ($exists) {
                        return ['errors' => ['number' => ['Nomor dokumen ' . $formData['number'] . ' sudah digunakan di departemen ini tahun ini.']]];
                    }
                    $useNumber = $formData['number'];
                } else {
                    // Auto-generate: ambil max lalu +1
                    $lastnumber = Pr::where('id_departement', $data['id_departement'])
                        ->whereYear('created_at', $currentYear)
                        ->max('number');
                    $useNumber = ($lastnumber ?? 0) + 1;
                }

                $data['number'] = $useNumber;

                $dept     = Departement::find($data['id_departement']);
                $comp     = Company::find($data['id_company']);
                $deptAbbr = $dept ? $dept->departement : 'DEP';
                $compAbbr = $comp ? $comp->company     : 'COMP';

                $year   = substr(date('Y'), -2);
                $month  = str_pad(date('m'), 2, '0', STR_PAD_LEFT);
                $numPad = str_pad($useNumber, 3, '0', STR_PAD_LEFT);

                $prNumber = "PR.{$compAbbr}.{$deptAbbr}.{$year}{$month}.{$numPad}";

                // Pastikan pr_number juga unik
                $prNumExists = Pr::where('pr_number', $prNumber)->exists();
                if ($prNumExists) {
                    return ['errors' => ['number' => ['PR Number ' . $prNumber . ' sudah ada. Gunakan nomor lain atau kosongkan untuk auto-generate.']]];
                }

                $data['pr_number'] = $prNumber;
                $pr = Pr::create($data);
            }

            DB::commit();
            $this->dispatch('refreshPrIndex');
            return ['success' => true, 'redirect' => route('payment-requests.show', hashid_encode($pr->id_pr, 'pr'))];
        } catch (\Exception $e) {
            DB::rollBack();
            return ['error' => 'Terjadi kesalahan: ' . $e->getMessage()];
        }
    }

    public function render()
    {
        $ttl = 7200; // 120 menit dalam detik

        $docTypes = Cache::remember('pr_doc_types_all', $ttl, fn() => DocType::whereIn('id_doc_type', [1, 2])->get());

        $filteredDocTypes = $docTypes->filter(function ($doc) {
            if ($doc->id_doc_type == 2) {
                return Auth::user()->level === 1 || Auth::user()->hasPermission('sr.create');
            }
            return true;
        });

        return view('livewire.payment-requests.form-modal', [
            'docTypes'       => $filteredDocTypes,
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
