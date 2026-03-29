<?php

namespace App\Livewire\Packages;

use App\Models\Packaging;
use App\Models\Departement;
use App\Models\ItemTransaction;
use App\Models\SrItemTransaction;
use App\Models\PrItemTransaction;
use App\Models\IkbDetail;
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
    public $id_packaging;
    public $packaging;
    public $id_departement;

    public $isEditing = false;

    protected $queryString = [
        'search' => ['except' => ''],
        'perPage' => ['except' => 10],
    ];

    public function mount()
    {
        abort_if(Auth::user()->level !== 1 && !Auth::user()->hasPermission('package.view'), 403);
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function create()
    {
        abort_if(Auth::user()->level !== 1 && !Auth::user()->hasPermission('package.create'), 403);
        $this->resetForm();
        $this->isEditing = false;
        $this->id_departement = Auth::user()->id_departement; // Default to user's dept
        $this->dispatch('openPackageModal');
    }

    public function edit($id)
    {
        abort_if(Auth::user()->level !== 1 && !Auth::user()->hasPermission('package.edit'), 403);
        $this->resetForm();
        $item = Packaging::findOrFail($id);
        $this->id_packaging = $item->id_packaging;
        $this->packaging = $item->packaging;
        $this->id_departement = $item->id_departement;
        $this->isEditing = true;
        $this->dispatch('openPackageModal');
    }

    public function resetForm()
    {
        $this->id_packaging = null;
        $this->packaging = '';
        $this->id_departement = null;
        $this->resetErrorBag();
    }

    public function save()
    {
        $permission = $this->isEditing ? 'package.edit' : 'package.create';
        abort_if(Auth::user()->level !== 1 && !Auth::user()->hasPermission($permission), 403);

        $rules = [
            'packaging' => 'required|string|max:255|unique:tbl_packagings,packaging,' . ($this->id_packaging ?? 'NULL') . ',id_packaging',
            'id_departement' => 'required|exists:tbl_departement,id_departement',
        ];

        $this->validate($rules);

        $data = [
            'packaging' => $this->packaging,
            'id_departement' => $this->id_departement,
            'id_user' => Auth::id(), // Always track the last modifier/creator
        ];

        if ($this->isEditing) {
            Packaging::find($this->id_packaging)->update($data);
            $message = 'Data package berhasil diperbarui.';
        } else {
            Packaging::create($data);
            $message = 'Package baru berhasil ditambahkan.';
        }

        $this->dispatch('closePackageModal');
        $this->dispatch('alert', [
            'type' => 'success',
            'title' => $this->isEditing ? 'Berhasil' : 'Tersimpan',
            'message' => $message,
        ]);

        $this->resetForm();
    }

    public function delete($id)
    {
        abort_if(Auth::user()->level !== 1 && !Auth::user()->hasPermission('package.delete'), 403);

        $item = Packaging::findOrFail($id);

        // Deletion Restriction: Check usage in transaction details
        $inItemTrans = ItemTransaction::where('id_packaging', $id)->exists();
        $inSrTrans = SrItemTransaction::where('id_packaging', $id)->exists();
        $inPrTrans = PrItemTransaction::where('id_packaging', $id)->exists();
        $inIkb = IkbDetail::where('id_packaging', $id)->exists();

        if ($inItemTrans || $inSrTrans || $inPrTrans || $inIkb) {
            $this->dispatch('alert', [
                'type' => 'danger',
                'title' => 'Gagal',
                'message' => 'Package ini tidak dapat dihapus karena sudah digunakan pada data transaksi.',
            ]);
            return;
        }

        $item->delete();

        $this->dispatch('alert', [
            'type' => 'success',
            'title' => 'Dihapus',
            'message' => 'Data package telah dihapus.',
        ]);
    }

    public function render()
    {
        $query = Packaging::with(['user', 'departement']);

        if ($this->search) {
            $query->where('packaging', 'like', '%' . $this->search . '%');
        }

        $packagings = $query->orderBy('id_packaging', 'desc')->paginate($this->perPage);

        return view('livewire.packages.index', [
            'packagings' => $packagings,
            'totalPackages' => Packaging::count(),
            'departements' => Departement::orderBy('departement', 'asc')->get(),
        ]);
    }
}
