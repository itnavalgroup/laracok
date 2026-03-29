<?php

namespace App\Livewire\CostCategories;

use App\Models\CostCategory;
use App\Models\CostType;
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
    public $id_cost_category;
    public $cost_category;

    public $isEditing = false;

    protected $queryString = [
        'search' => ['except' => ''],
        'perPage' => ['except' => 10],
    ];

    public function mount()
    {
        abort_if(Auth::user()->level !== 1 && !Auth::user()->hasPermission('cost_category.view'), 403);
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function create()
    {
        abort_if(Auth::user()->level !== 1 && !Auth::user()->hasPermission('cost_category.create'), 403);
        $this->resetForm();
        $this->isEditing = false;
        $this->dispatch('openCostCatModal');
    }

    public function edit($id)
    {
        abort_if(Auth::user()->level !== 1 && !Auth::user()->hasPermission('cost_category.edit'), 403);
        $this->resetForm();
        $item = CostCategory::findOrFail($id);
        $this->id_cost_category = $item->id_cost_category;
        $this->cost_category = $item->cost_category;
        $this->isEditing = true;
        $this->dispatch('openCostCatModal');
    }

    public function resetForm()
    {
        $this->id_cost_category = null;
        $this->cost_category = '';
        $this->resetErrorBag();
    }

    public function save()
    {
        $permission = $this->isEditing ? 'cost_category.edit' : 'cost_category.create';
        abort_if(Auth::user()->level !== 1 && !Auth::user()->hasPermission($permission), 403);

        $rules = [
            'cost_category' => 'required|string|max:255|unique:tbl_cost_categories,cost_category,' . ($this->id_cost_category ?? 'NULL') . ',id_cost_category',
        ];

        $this->validate($rules);

        $data = [
            'cost_category' => $this->cost_category,
            'id_user' => Auth::id(),
        ];

        if ($this->isEditing) {
            CostCategory::find($this->id_cost_category)->update($data);
            $message = 'Kategori biaya berhasil diperbarui.';
        } else {
            CostCategory::create($data);
            $message = 'Kategori biaya baru berhasil ditambahkan.';
        }

        $this->dispatch('closeCostCatModal');
        $this->dispatch('alert', [
            'type' => 'success',
            'title' => $this->isEditing ? 'Berhasil' : 'Tersimpan',
            'message' => $message,
        ]);

        $this->resetForm();
    }

    public function delete($id)
    {
        abort_if(Auth::user()->level !== 1 && !Auth::user()->hasPermission('cost_category.delete'), 403);

        $item = CostCategory::findOrFail($id);

        // Deletion Restriction: Check if used by CostType
        $isUsed = CostType::where('id_cost_category', $id)->exists();

        if ($isUsed) {
            $this->dispatch('alert', [
                'type' => 'danger',
                'title' => 'Gagal',
                'message' => 'Kategori biaya tidak dapat dihapus karena sedang digunakan oleh Tipe Biaya.',
            ]);
            return;
        }

        $item->delete();

        $this->dispatch('alert', [
            'type' => 'success',
            'title' => 'Dihapus',
            'message' => 'Kategori biaya telah dihapus.',
        ]);
    }

    public function render()
    {
        $query = CostCategory::query();

        if ($this->search) {
            $query->where('cost_category', 'like', '%' . $this->search . '%');
        }

        $categories = $query->orderBy('id_cost_category', 'desc')->paginate($this->perPage);

        return view('livewire.cost-categories.index', [
            'categories' => $categories,
            'totalCategories' => CostCategory::count(),
        ]);
    }
}
