<?php

namespace App\Livewire\CostTypes;

use App\Models\CostCategory;
use App\Models\CostType;
use App\Models\Pr;
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
    public $id_cost_type;
    public $id_cost_category;
    public $cost_type;
    public $cost_document;

    public $isEditing = false;

    protected $queryString = [
        'search' => ['except' => ''],
        'perPage' => ['except' => 10],
    ];

    public function mount()
    {
        abort_if(Auth::user()->level !== 1 && !Auth::user()->hasPermission('cost_type.view'), 403);
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function create()
    {
        abort_if(Auth::user()->level !== 1 && !Auth::user()->hasPermission('cost_type.create'), 403);
        $this->resetForm();
        $this->isEditing = false;
        $this->dispatch('openCostTypeModal');
    }

    public function edit($id)
    {
        abort_if(Auth::user()->level !== 1 && !Auth::user()->hasPermission('cost_type.edit'), 403);
        $this->resetForm();
        $item = CostType::findOrFail($id);
        $this->id_cost_type = $item->id_cost_type;
        $this->id_cost_category = $item->id_cost_category;
        $this->cost_type = $item->cost_type;
        $this->cost_document = $item->cost_document;
        $this->isEditing = true;
        $this->dispatch('openCostTypeModal');
    }

    public function resetForm()
    {
        $this->id_cost_type = null;
        $this->id_cost_category = null;
        $this->cost_type = '';
        $this->cost_document = '';
        $this->resetErrorBag();
    }

    public function save()
    {
        $permission = $this->isEditing ? 'cost_type.edit' : 'cost_type.create';
        abort_if(Auth::user()->level !== 1 && !Auth::user()->hasPermission($permission), 403);

        $rules = [
            'id_cost_category' => 'required|exists:tbl_cost_categories,id_cost_category',
            'cost_type' => 'required|string|max:255|unique:tbl_cost_types,cost_type,' . ($this->id_cost_type ?? 'NULL') . ',id_cost_type',
            'cost_document' => 'nullable|string',
        ];

        $this->validate($rules);

        $data = [
            'id_cost_category' => $this->id_cost_category,
            'cost_type' => $this->cost_type,
            'cost_document' => $this->cost_document,
            'id_user' => Auth::id(),
        ];

        if ($this->isEditing) {
            CostType::find($this->id_cost_type)->update($data);
            $message = 'Tipe biaya berhasil diperbarui.';
        } else {
            CostType::create($data);
            $message = 'Tipe biaya baru berhasil ditambahkan.';
        }

        $this->dispatch('closeCostTypeModal');
        $this->dispatch('alert', [
            'type' => 'success',
            'title' => $this->isEditing ? 'Berhasil' : 'Tersimpan',
            'message' => $message,
        ]);

        $this->resetForm();
    }

    public function delete($id)
    {
        abort_if(Auth::user()->level !== 1 && !Auth::user()->hasPermission('cost_type.delete'), 403);

        $item = CostType::findOrFail($id);

        // Deletion Restriction: Check if used by PR
        $isUsedInPr = Pr::where('id_cost_type', $id)->exists();
        // and potentially SR if it exists
        // $isUsedInSr = Sr::where('id_cost_type', $id)->exists();

        if ($isUsedInPr) {
            $this->dispatch('alert', [
                'type' => 'danger',
                'title' => 'Gagal',
                'message' => 'Tipe biaya tidak dapat dihapus karena sudah digunakan dalam transaksi.',
            ]);
            return;
        }

        $item->delete();

        $this->dispatch('alert', [
            'type' => 'success',
            'title' => 'Dihapus',
            'message' => 'Tipe biaya telah dihapus.',
        ]);
    }

    public function render()
    {
        $query = CostType::with('category');

        if ($this->search) {
            $query->where('cost_type', 'like', '%' . $this->search . '%')
                ->orWhereHas('category', function ($q) {
                    $q->where('cost_category', 'like', '%' . $this->search . '%');
                });
        }

        $types = $query->orderBy('id_cost_type', 'desc')->paginate($this->perPage);

        return view('livewire.cost-types.index', [
            'types' => $types,
            'categories' => CostCategory::orderBy('cost_category')->get(),
            'totalTypes' => CostType::count(),
        ]);
    }
}
