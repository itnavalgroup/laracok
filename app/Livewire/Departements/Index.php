<?php

namespace App\Livewire\Departements;

use App\Models\Departement;
use App\Models\User;
use App\Models\Pr;
use App\Models\Sr;
use App\Models\Ikb;
use App\Models\ItemTransaction;
use App\Models\Payment;
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
    public $id_departement;
    public $departement;

    public $isEditing = false;

    protected $queryString = [
        'search' => ['except' => ''],
        'perPage' => ['except' => 10],
    ];

    public function mount()
    {
        abort_if(Auth::user()->level !== 1 && !Auth::user()->hasPermission('dept.view'), 403);
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function create()
    {
        abort_if(Auth::user()->level !== 1 && !Auth::user()->hasPermission('dept.create'), 403);
        $this->resetForm();
        $this->isEditing = false;
        $this->dispatch('openDeptModal');
    }

    public function edit($id)
    {
        abort_if(Auth::user()->level !== 1 && !Auth::user()->hasPermission('dept.edit'), 403);
        $this->resetForm();
        $item = Departement::findOrFail($id);
        $this->id_departement = $item->id_departement;
        $this->departement = $item->departement;
        $this->isEditing = true;
        $this->dispatch('openDeptModal');
    }

    public function resetForm()
    {
        $this->id_departement = null;
        $this->departement = '';
        $this->resetErrorBag();
    }

    public function save()
    {
        $permission = $this->isEditing ? 'dept.edit' : 'dept.create';
        abort_if(Auth::user()->level !== 1 && !Auth::user()->hasPermission($permission), 403);

        $rules = [
            'departement' => 'required|string|max:255|unique:tbl_departement,departement,' . ($this->id_departement ?? 'NULL') . ',id_departement',
        ];

        $this->validate($rules);

        $data = [
            'departement' => $this->departement,
        ];

        if ($this->isEditing) {
            Departement::find($this->id_departement)->update($data);
            $message = 'Data departemen berhasil diperbarui.';
        } else {
            Departement::create($data);
            $message = 'Departemen baru berhasil ditambahkan.';
        }

        $this->dispatch('closeDeptModal');
        $this->dispatch('alert', [
            'type' => 'success',
            'title' => $this->isEditing ? 'Berhasil' : 'Tersimpan',
            'message' => $message,
        ]);

        $this->resetForm();
    }

    public function delete($id)
    {
        abort_if(Auth::user()->level !== 1 && !Auth::user()->hasPermission('dept.delete'), 403);

        $item = Departement::findOrFail($id);

        // Deletion Restriction: Check usage across multiple tables
        $hasUsers = User::where('id_departement', $id)->exists();
        $hasPr = Pr::where('id_departement', $id)->exists();
        $hasSr = Sr::where('id_departement', $id)->exists();
        $hasIkb = Ikb::where('id_departement', $id)->exists();
        $hasTrans = ItemTransaction::where('id_departement', $id)->exists();
        $hasPayment = Payment::where('id_departement', $id)->exists();

        if ($hasUsers || $hasPr || $hasSr || $hasIkb || $hasTrans || $hasPayment) {
            $this->dispatch('alert', [
                'type' => 'danger',
                'title' => 'Gagal',
                'message' => 'Departemen tidak dapat dihapus karena masih digunakan pada data lain (User/Transaksi).',
            ]);
            return;
        }

        $item->delete();

        $this->dispatch('alert', [
            'type' => 'success',
            'title' => 'Dihapus',
            'message' => 'Data departemen telah dihapus.',
        ]);
    }

    public function render()
    {
        $query = Departement::query();

        if ($this->search) {
            $query->where('departement', 'like', '%' . $this->search . '%');
        }

        $depts = $query->orderBy('id_departement', 'desc')->paginate($this->perPage);

        return view('livewire.departements.index', [
            'depts' => $depts,
            'totalDepts' => Departement::count(),
        ]);
    }
}
