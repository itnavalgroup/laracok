<?php

namespace App\Livewire\Ikb;

use App\Models\Company;
use App\Models\Departement;
use App\Models\DocType;
use App\Models\Ikb;
use App\Models\IkbTransactionType;
use App\Models\User;
use App\Models\Vendor;
use App\Models\Warehouse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Livewire\Attributes\On;
use Livewire\Component;

class FormModal extends Component
{
    #[On('open-ikb-form')]
    public function openModal($id = null)
    {
        if ($id) {
            $ikb = Ikb::findOrFail($id);

            abort_if(
                Auth::user()->level !== 1
                    && ! (Auth::user()->id_user == $ikb->id_user && Auth::user()->hasPermission('ikb.edit')),
                403
            );

            if (! in_array($ikb->status, [null, 0, 11])) { // 0 = draft, 11 = revision
                $this->dispatch('alert', ['type' => 'error', 'message' => 'IKB yang sedang diproses tidak dapat diedit.']);

                return;
            }
            $this->dispatch('open-ikb-form-js', ['ikb' => $ikb->toArray()]);
        } else {
            $this->dispatch('open-ikb-form-js', []);
        }
    }

    public function saveFromJs(array $formData, $ikbId = null)
    {
        $rules = [
            'id_doc_type' => 'required',
            'id_company' => 'required',
            'id_departement' => 'required',
            'id_warehouse' => 'required',
            'sales' => 'required', // Sales/Requestor User ID
            'id_vendor' => 'required',
            'id_ikb_transaction_type' => 'required',
            'booking_date' => 'required|date',
            'destination' => 'required',
        ];

        $messages = [
            'id_doc_type.required' => 'Dokumen Type wajib diisi.',
            'id_company.required' => 'Company wajib diisi.',
            'id_departement.required' => 'Departement wajib diisi.',
            'id_warehouse.required' => 'Warehouse wajib diisi.',
            'sales.required' => 'Sales (Requestor) wajib dipilih.',
            'id_vendor.required' => 'Vendor wajib dipilih.',
            'id_ikb_transaction_type.required' => 'Transaction Type wajib diisi.',
            'booking_date.required' => 'Booking Date wajib diisi.',
            'destination.required' => 'Destination wajib diisi.',
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
                'id_company',
                'id_warehouse',
                'id_vendor',
                'id_ikb_transaction_type',
                'sales',
                'destination',
                'po_number',
                'so_number',
                'ri_number',
                'sk_number',
                'do_number',
                'batch_number',
                'booking_date',
                'stuffing_date',
                'delivery_date',
            ];

            $data = array_intersect_key($formData, array_flip($allowed));

            $data['id_vendor'] = ! empty($data['id_vendor']) ? $data['id_vendor'] : null;
            $data['stuffing_date'] = ! empty($data['stuffing_date']) ? $data['stuffing_date'] : null;
            $data['delivery_date'] = ! empty($data['delivery_date']) ? $data['delivery_date'] : null;

            if ($ikbId) {
                $ikb = Ikb::findOrFail($ikbId);
                if ($ikb->status == 11) {
                    $data['status'] = 0;
                }
                $ikb->update($data);
            } else {
                $data['id_user'] = Auth::id(); // User yang create
                $data['status'] = 0;

                $currentYear = date('Y');

                $lastnumber = Ikb::where('id_departement', $data['id_departement'])
                    ->whereYear('created_at', $currentYear)
                    ->max('number');
                $useNumber = ($lastnumber ?? 0) + 1;
                $data['number'] = $useNumber;

                $dept = Departement::find($data['id_departement']);
                $comp = Company::find($data['id_company']);
                $deptAbbr = $dept ? $dept->departement : 'DEP';
                $compAbbr = $comp ? $comp->company : 'COMP';

                $year = substr(date('Y'), -2);
                $month = str_pad(date('m'), 2, '0', STR_PAD_LEFT);
                $numPad = str_pad($useNumber, 3, '0', STR_PAD_LEFT);

                // IKB Format: IKB.COMP.DEP.YYMM.001
                $ikbNumber = "IKB.{$compAbbr}.{$deptAbbr}.{$year}{$month}.{$numPad}";

                $ikbNumExists = Ikb::where('ikb_number', $ikbNumber)->exists();
                if ($ikbNumExists) {
                    return ['error' => 'IKB Number '.$ikbNumber.' sudah ada. Coba ulangi.'];
                }

                $data['ikb_number'] = $ikbNumber;
                $ikb = Ikb::create($data);
            }

            DB::commit();
            $this->dispatch('refreshIkbIndex');

            return ['success' => true, 'redirect' => route('ikb.show', hashid_encode($ikb->id_ikb, 'ikb'))];
        } catch (\Exception $e) {
            DB::rollBack();

            return ['error' => 'Terjadi kesalahan: '.$e->getMessage()];
        }
    }

    public function render()
    {
        $ttl = 7200;

        $users = User::select('id_user', 'name')
            ->where('is_active', 1)
            ->orderBy('name')
            ->get();
        $doctypes = DocType::where('id_doc_type', 4)->get();

        return view('livewire.ikb.form-modal', [
            'docTypes' => $doctypes,
            'departements' => Departement::orderBy('departement')->get(),
            'companies' => Company::all(),
            'warehouses' => Warehouse::where('is_active', 1)->get(),
            'vendors' => Vendor::where('is_active', 1)->get(),
            'transactionTypes' => IkbTransactionType::where('is_active', 1)->orderBy('transaction_type')->get(),
            'users' => $users,
        ]);
    }
}
