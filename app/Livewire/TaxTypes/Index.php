<?php

namespace App\Livewire\TaxTypes;

use App\Models\Tax;
use App\Models\TaxType;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $search = '';
    public $perPage = 10;

    // Form fields
    public $id_tax_type;
    public $tax_type;
    public $tax_type_description;

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
        $this->dispatch('openTaxTypeModal');
    }

    public function edit($id)
    {
        abort_if(Auth::user()->level !== 1 && !Auth::user()->hasPermission('tax.edit'), 403);
        $this->resetForm();
        $item = TaxType::findOrFail($id);
        $this->id_tax_type = $item->id_tax_type;
        $this->tax_type = $item->tax_type;
        $this->tax_type_description = $item->tax_type_description;
        $this->isEditing = true;
        $this->dispatch('openTaxTypeModal');
    }

    public function resetForm()
    {
        $this->id_tax_type = null;
        $this->tax_type = '';
        $this->tax_type_description = '';
        $this->resetErrorBag();
    }

    public function save()
    {
        $permission = $this->isEditing ? 'tax.edit' : 'tax.create';
        abort_if(Auth::user()->level !== 1 && !Auth::user()->hasPermission($permission), 403);

        $rules = [
            'tax_type' => 'required|string|max:100',
            'tax_type_description' => 'required|string',
        ];

        $this->validate($rules);

        $data = [
            'tax_type' => $this->tax_type,
            'tax_type_description' => $this->tax_type_description,
        ];

        if ($this->isEditing) {
            TaxType::find($this->id_tax_type)->update($data);
            $message = 'Jenis pajak berhasil diperbarui.';
        } else {
            TaxType::create($data);
            $message = 'Jenis pajak baru berhasil ditambahkan.';
        }

        $this->dispatch('closeTaxTypeModal');
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

        $item = TaxType::findOrFail($id);

        // Deletion Restriction: Check if used by Tax
        $isUsedInTax = Tax::where('id_tax_type', $id)->exists();

        if ($isUsedInTax) {
            $this->dispatch('alert', [
                'type' => 'danger',
                'title' => 'Gagal',
                'message' => 'Jenis pajak tidak dapat dihapus karena masih digunakan oleh data tarif pajak.',
            ]);
            return;
        }

        $item->delete();

        $this->dispatch('alert', [
            'type' => 'success',
            'title' => 'Dihapus',
            'message' => 'Jenis pajak telah dihapus.',
        ]);
    }

    public function render()
    {
        $query = TaxType::query();

        if ($this->search) {
            $query->where('tax_type', 'like', '%' . $this->search . '%')
                ->orWhere('tax_type_description', 'like', '%' . $this->search . '%');
        }

        $taxTypes = $query->orderBy('id_tax_type', 'desc')->paginate($this->perPage);

        return view('livewire.tax-types.index', [
            'taxTypes' => $taxTypes,
            'totalTaxTypes' => TaxType::count(),
        ]);
    }
}
