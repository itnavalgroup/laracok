<?php

namespace App\Livewire\Taxes;

use App\Models\Tax;
use App\Models\TaxType;
use App\Models\Pr;
use App\Models\Sr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $search = '';
    public $perPage = 10;

    // Form fields
    public $id_tax;
    public $id_tax_type;
    public $tax;
    public $tax_persen;
    public $tax_description;
    public $status = 1;

    public $isEditing = false;

    protected $queryString = [
        'search' => ['except' => ''],
        'perPage' => ['except' => 10],
    ];

    public function mount()
    {
        abort_if(Auth::user()->level !== 1 && !Auth::user()->hasPermission('tax.view'), 403);
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function create()
    {
        abort_if(Auth::user()->level !== 1 && !Auth::user()->hasPermission('tax.create'), 403);
        $this->resetForm();
        $this->isEditing = false;
        $this->dispatch('openTaxModal');
    }

    public function edit($id)
    {
        abort_if(Auth::user()->level !== 1 && !Auth::user()->hasPermission('tax.edit'), 403);
        $this->resetForm();
        $item = Tax::findOrFail($id);
        $this->id_tax = $item->id_tax;
        $this->id_tax_type = $item->id_tax_type;
        $this->tax = $item->tax;
        $this->tax_persen = $item->tax_persen * 100; // Convert 0.11 to 11
        $this->tax_description = $item->tax_description;
        $this->status = $item->status;
        $this->isEditing = true;
        $this->dispatch('openTaxModal');
    }

    public function resetForm()
    {
        $this->id_tax = null;
        $this->id_tax_type = '';
        $this->tax = '';
        $this->tax_persen = '';
        $this->tax_description = '';
        $this->status = 1;
        $this->resetErrorBag();
    }

    public function save()
    {
        $permission = $this->isEditing ? 'tax.edit' : 'tax.create';
        abort_if(Auth::user()->level !== 1 && !Auth::user()->hasPermission($permission), 403);

        $rules = [
            'id_tax_type' => 'required|exists:tbl_tax_types,id_tax_type',
            'tax' => 'required|string|max:100',
            'tax_persen' => 'required|numeric|min:0|max:100',
            'tax_description' => 'required|string',
            'status' => 'required|integer',
        ];

        $this->validate($rules);

        $data = [
            'id_tax_type' => $this->id_tax_type,
            'tax' => $this->tax,
            'tax_persen' => floatval($this->tax_persen) / 100, // Convert 11 to 0.11
            'tax_description' => $this->tax_description,
            'status' => $this->status,
        ];

        if ($this->isEditing) {
            Tax::find($this->id_tax)->update($data);
            $message = 'Tarif pajak berhasil diperbarui.';
        } else {
            Tax::create($data);
            $message = 'Tarif pajak baru berhasil ditambahkan.';
        }

        $this->dispatch('closeTaxModal');
        $this->dispatch('alert', [
            'type' => 'success',
            'title' => $this->isEditing ? 'Berhasil' : 'Tersimpan',
            'message' => $message,
        ]);

        $this->resetForm();
    }

    public function delete($id)
    {
        abort_if(Auth::user()->level !== 1 && !Auth::user()->hasPermission('tax.delete'), 403);

        $item = Tax::findOrFail($id);

        // Deletion Restriction: Check relation using raw DB for thorough check (based on CI4 logic)
        // CI4 checks id_tax1 in tbl_detail_pr and tbl_detail_sr
        $isUsedInPr = DB::table('tbl_detail_pr')->where('id_tax1', $id)->exists();
        $isUsedInSr = DB::table('tbl_detail_sr')->where('id_tax1', $id)->exists();

        if ($isUsedInPr || $isUsedInSr) {
            $this->dispatch('alert', [
                'type' => 'danger',
                'title' => 'Gagal',
                'message' => 'Tarif pajak tidak dapat dihapus karena masih terhubung dengan transaksi PR atau SR.',
            ]);
            return;
        }

        $item->delete();

        $this->dispatch('alert', [
            'type' => 'success',
            'title' => 'Dihapus',
            'message' => 'Tarif pajak telah dihapus.',
        ]);
    }

    public function render()
    {
        $query = Tax::query()->with('taxType');

        if ($this->search) {
            $query->where(function ($q) {
                $q->where('tax', 'like', '%' . $this->search . '%')
                    ->orWhere('tax_description', 'like', '%' . $this->search . '%')
                    ->orWhereHas('taxType', function ($sq) {
                        $sq->where('tax_type', 'like', '%' . $this->search . '%');
                    });
            });
        }

        $taxes = $query->orderBy('id_tax', 'desc')->paginate($this->perPage);
        $taxTypes = TaxType::all();

        return view('livewire.taxes.index', [
            'taxes' => $taxes,
            'taxTypes' => $taxTypes,
            'totalTaxes' => Tax::count(),
        ]);
    }
}
