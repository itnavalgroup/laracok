<?php

namespace App\Livewire\Warehouses;

use App\Models\Warehouse;
use App\Models\User;
use App\Models\Pr;
use App\Models\Sr;
use App\Models\Ikb;
use App\Models\ItemTransaction;
use App\Models\SrItemTransaction;
use App\Models\PrItemTransaction;
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
    public $id_warehouse;
    public $warehouse_name;
    public $address;
    public $is_active = 1;

    public $isEditing = false;

    protected $queryString = [
        'search' => ['except' => ''],
        'perPage' => ['except' => 10],
    ];

    public function mount()
    {
        abort_if(Auth::user()->level !== 1 && !Auth::user()->hasPermission('warehouse.view'), 403);
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function create()
    {
        abort_if(Auth::user()->level !== 1 && !Auth::user()->hasPermission('warehouse.create'), 403);
        $this->resetForm();
        $this->isEditing = false;
        $this->is_active = 1;
        $this->dispatch('openWarehouseModal');
    }

    public function edit($id)
    {
        abort_if(Auth::user()->level !== 1 && !Auth::user()->hasPermission('warehouse.edit'), 403);
        $this->resetForm();
        $item = Warehouse::findOrFail($id);
        $this->id_warehouse = $item->id_warehouse;
        $this->warehouse_name = $item->warehouse_name;
        $this->address = $item->address;
        $this->is_active = $item->is_active;
        $this->isEditing = true;
        $this->dispatch('openWarehouseModal');
    }

    public function resetForm()
    {
        $this->id_warehouse = null;
        $this->warehouse_name = '';
        $this->address = '';
        $this->is_active = 1;
        $this->resetErrorBag();
    }

    public function save()
    {
        $permission = $this->isEditing ? 'warehouse.edit' : 'warehouse.create';
        abort_if(Auth::user()->level !== 1 && !Auth::user()->hasPermission($permission), 403);

        $rules = [
            'warehouse_name' => 'required|string|max:255|unique:tbl_warehouse,warehouse_name,' . ($this->id_warehouse ?? 'NULL') . ',id_warehouse',
            'address' => 'nullable|string|max:500',
            'is_active' => 'required|in:0,1',
        ];

        $this->validate($rules);

        $data = [
            'warehouse_name' => $this->warehouse_name,
            'address' => $this->address,
            'is_active' => $this->is_active,
            'id_user' => Auth::id(),
        ];

        if ($this->isEditing) {
            Warehouse::find($this->id_warehouse)->update($data);
            $message = 'Data gudang berhasil diperbarui.';
        } else {
            Warehouse::create($data);
            $message = 'Gudang baru berhasil ditambahkan.';
        }

        $this->dispatch('closeWarehouseModal');
        $this->dispatch('alert', [
            'type' => 'success',
            'title' => $this->isEditing ? 'Berhasil' : 'Tersimpan',
            'message' => $message,
        ]);

        $this->resetForm();
    }

    public function delete($id)
    {
        abort_if(Auth::user()->level !== 1 && !Auth::user()->hasPermission('warehouse.delete'), 403);

        $item = Warehouse::findOrFail($id);

        // Deletion Restriction
        $hasUsers = User::where('id_warehouse', $id)->exists();
        $hasPr = Pr::where('id_warehouse', $id)->exists();
        $hasSr = Sr::where('id_warehouse', $id)->exists();
        $hasIkb = Ikb::where('id_warehouse', $id)->exists();
        $hasTrans = ItemTransaction::where('id_warehouse', $id)->exists();
        $hasSrTrans = SrItemTransaction::where('id_warehouse', $id)->exists();
        $hasPrTrans = PrItemTransaction::where('id_warehouse', $id)->exists();

        if ($hasUsers || $hasPr || $hasSr || $hasIkb || $hasTrans || $hasSrTrans || $hasPrTrans) {
            $this->dispatch('alert', [
                'type' => 'danger',
                'title' => 'Gagal',
                'message' => 'Gudang tidak dapat dihapus karena masih digunakan pada data lain.',
            ]);
            return;
        }

        $item->delete();

        $this->dispatch('alert', [
            'type' => 'success',
            'title' => 'Dihapus',
            'message' => 'Data gudang telah dihapus.',
        ]);
    }

    public function render()
    {
        $query = Warehouse::with('owner');

        if ($this->search) {
            $query->where('warehouse_name', 'like', '%' . $this->search . '%')
                ->orWhere('address', 'like', '%' . $this->search . '%');
        }

        $warehouses = $query->orderBy('id_warehouse', 'desc')->paginate($this->perPage);

        return view('livewire.warehouses.index', [
            'warehouses' => $warehouses,
            'totalWarehouses' => Warehouse::count(),
        ]);
    }
}
