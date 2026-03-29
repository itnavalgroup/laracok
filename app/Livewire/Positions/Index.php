<?php

namespace App\Livewire\Positions;

use App\Models\Position;
use App\Models\User;
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
    public $id_position;
    public $position;

    public $isEditing = false;

    protected $queryString = [
        'search' => ['except' => ''],
        'perPage' => ['except' => 10],
    ];

    public function mount()
    {
        abort_if(Auth::user()->level !== 1 && !Auth::user()->hasPermission('position.view'), 403);
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function create()
    {
        abort_if(Auth::user()->level !== 1 && !Auth::user()->hasPermission('position.create'), 403);
        $this->resetForm();
        $this->isEditing = false;
        $this->dispatch('openPositionModal');
    }

    public function edit($id)
    {
        abort_if(Auth::user()->level !== 1 && !Auth::user()->hasPermission('position.edit'), 403);
        $this->resetForm();
        $item = Position::findOrFail($id);
        $this->id_position = $item->id_position;
        $this->position = $item->position;
        $this->isEditing = true;
        $this->dispatch('openPositionModal');
    }

    public function resetForm()
    {
        $this->id_position = null;
        $this->position = '';
        $this->resetErrorBag();
    }

    public function save()
    {
        $permission = $this->isEditing ? 'position.edit' : 'position.create';
        abort_if(Auth::user()->level !== 1 && !Auth::user()->hasPermission($permission), 403);

        $rules = [
            'position' => 'required|string|max:255|unique:tbl_position,position,' . ($this->id_position ?? 'NULL') . ',id_position',
        ];

        $this->validate($rules);

        $data = [
            'position' => $this->position,
        ];

        if ($this->isEditing) {
            Position::find($this->id_position)->update($data);
            $message = 'Data posisi berhasil diperbarui.';
        } else {
            Position::create($data);
            $message = 'Posisi baru berhasil ditambahkan.';
        }

        $this->dispatch('closePositionModal');
        $this->dispatch('alert', [
            'type' => 'success',
            'title' => $this->isEditing ? 'Berhasil' : 'Tersimpan',
            'message' => $message,
        ]);

        $this->resetForm();
    }

    public function delete($id)
    {
        abort_if(Auth::user()->level !== 1 && !Auth::user()->hasPermission('position.delete'), 403);

        $item = Position::findOrFail($id);

        // Deletion Restriction: Check usage in users
        $inUsers = User::where('id_position', $id)->exists();

        if ($inUsers) {
            $this->dispatch('alert', [
                'type' => 'danger',
                'title' => 'Gagal',
                'message' => 'Posisi ini tidak dapat dihapus karena masih ada user yang menggunakannya.',
            ]);
            return;
        }

        $item->delete();

        $this->dispatch('alert', [
            'type' => 'success',
            'title' => 'Dihapus',
            'message' => 'Data posisi telah dihapus.',
        ]);
    }

    public function render()
    {
        $query = Position::query();

        if ($this->search) {
            $query->where('position', 'like', '%' . $this->search . '%');
        }

        $positions = $query->orderBy('id_position', 'desc')->paginate($this->perPage);

        return view('livewire.positions.index', [
            'positions' => $positions,
            'totalPositions' => Position::count(),
        ]);
    }
}
