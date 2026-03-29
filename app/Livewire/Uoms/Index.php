<?php

namespace App\Livewire\Uoms;

use App\Models\Uom;
use App\Models\SrDetail;
use App\Models\IkbDetail;
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
    public $id_uom;
    public $uom;
    public $qty_kg;

    public $isEditing = false;

    protected $queryString = [
        'search' => ['except' => ''],
        'perPage' => ['except' => 10],
    ];

    public function mount()
    {
        abort_if(Auth::user()->level !== 1 && !Auth::user()->hasPermission('uom.view'), 403);
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function create()
    {
        abort_if(Auth::user()->level !== 1 && !Auth::user()->hasPermission('uom.create'), 403);
        $this->resetForm();
        $this->isEditing = false;
        $this->dispatch('openUomModal');
    }

    public function edit($id)
    {
        abort_if(Auth::user()->level !== 1 && !Auth::user()->hasPermission('uom.edit'), 403);
        $this->resetForm();
        $item = Uom::findOrFail($id);
        $this->id_uom = $item->id_uom;
        $this->uom = $item->uom;
        $this->qty_kg = $item->qty_kg;
        $this->isEditing = true;
        $this->dispatch('openUomModal');
    }

    public function resetForm()
    {
        $this->id_uom = null;
        $this->uom = '';
        $this->qty_kg = '';
        $this->resetErrorBag();
    }

    public function save()
    {
        $permission = $this->isEditing ? 'uom.edit' : 'uom.create';
        abort_if(Auth::user()->level !== 1 && !Auth::user()->hasPermission($permission), 403);

        $rules = [
            'uom' => 'required|string|max:255|unique:tbl_uoms,uom,' . ($this->id_uom ?? 'NULL') . ',id_uom',
            'qty_kg' => 'nullable|numeric',
        ];

        $this->validate($rules);

        $data = [
            'uom' => $this->uom,
            'qty_kg' => $this->qty_kg ?: null,
        ];

        if ($this->isEditing) {
            Uom::find($this->id_uom)->update($data);
            $message = 'Data UOM berhasil diperbarui.';
        } else {
            Uom::create($data);
            $message = 'UOM baru berhasil ditambahkan.';
        }

        $this->dispatch('closeUomModal');
        $this->dispatch('alert', [
            'type' => 'success',
            'title' => $this->isEditing ? 'Berhasil' : 'Tersimpan',
            'message' => $message,
        ]);

        $this->resetForm();
    }

    public function delete($id)
    {
        abort_if(Auth::user()->level !== 1 && !Auth::user()->hasPermission('uom.delete'), 403);

        $item = Uom::findOrFail($id);

        // Deletion Restriction: Check usage in transaction details
        $inSr = SrDetail::where('id_uom', $id)->exists();
        $inIkb = IkbDetail::where('id_uom', $id)->exists();
        $inItemTrans = ItemTransaction::where('id_uom', $id)->exists();
        $inSrTrans = SrItemTransaction::where('id_uom', $id)->exists();
        $inPrTrans = PrItemTransaction::where('id_uom', $id)->exists();

        if ($inSr || $inIkb || $inItemTrans || $inSrTrans || $inPrTrans) {
            $this->dispatch('alert', [
                'type' => 'danger',
                'title' => 'Gagal',
                'message' => 'UOM ini tidak dapat dihapus karena sudah digunakan pada data transaksi.',
            ]);
            return;
        }

        $item->delete();

        $this->dispatch('alert', [
            'type' => 'success',
            'title' => 'Dihapus',
            'message' => 'Data UOM telah dihapus.',
        ]);
    }

    public function render()
    {
        $query = Uom::query();

        if ($this->search) {
            $query->where('uom', 'like', '%' . $this->search . '%');
        }

        $uoms = $query->orderBy('id_uom', 'desc')->paginate($this->perPage);

        return view('livewire.uoms.index', [
            'uoms' => $uoms,
            'totalUoms' => Uom::count(),
        ]);
    }
}
