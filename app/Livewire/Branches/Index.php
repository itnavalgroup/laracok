<?php

namespace App\Livewire\Branches;

use App\Models\Branch;
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
    public $id_branch;
    public $branch;
    public $branch_address;

    public $isEditing = false;

    protected $queryString = [
        'search' => ['except' => ''],
        'perPage' => ['except' => 10],
    ];

    public function mount()
    {
        abort_if(Auth::user()->level !== 1 && !Auth::user()->hasPermission('branch.view'), 403);
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function create()
    {
        abort_if(Auth::user()->level !== 1 && !Auth::user()->hasPermission('branch.create'), 403);
        $this->resetForm();
        $this->isEditing = false;
        $this->dispatch('openBranchModal');
    }

    public function edit($id)
    {
        abort_if(Auth::user()->level !== 1 && !Auth::user()->hasPermission('branch.edit'), 403);
        $this->resetForm();
        $item = Branch::findOrFail($id);
        $this->id_branch = $item->id_branch;
        $this->branch = $item->branch;
        $this->branch_address = $item->branch_address;
        $this->isEditing = true;
        $this->dispatch('openBranchModal');
    }

    public function resetForm()
    {
        $this->id_branch = null;
        $this->branch = '';
        $this->branch_address = '';
        $this->resetErrorBag();
    }

    public function save()
    {
        $permission = $this->isEditing ? 'branch.edit' : 'branch.create';
        abort_if(Auth::user()->level !== 1 && !Auth::user()->hasPermission($permission), 403);

        $rules = [
            'branch' => 'required|string|max:255|unique:tbl_branch,branch,' . ($this->id_branch ?? 'NULL') . ',id_branch',
            'branch_address' => 'required|string',
        ];

        $this->validate($rules);

        $data = [
            'branch' => $this->branch,
            'branch_address' => $this->branch_address,
        ];

        if ($this->isEditing) {
            Branch::find($this->id_branch)->update($data);
            $message = 'Data cabang berhasil diperbarui.';
        } else {
            Branch::create($data);
            $message = 'Cabang baru berhasil ditambahkan.';
        }

        $this->dispatch('closeBranchModal');
        $this->dispatch('alert', [
            'type' => 'success',
            'title' => $this->isEditing ? 'Berhasil' : 'Tersimpan',
            'message' => $message,
        ]);

        $this->resetForm();
    }

    public function delete($id)
    {
        abort_if(Auth::user()->level !== 1 && !Auth::user()->hasPermission('branch.delete'), 403);

        $item = Branch::findOrFail($id);

        // Deletion Restriction: Check if branch has users
        if ($item->users()->count() > 0) {
            $this->dispatch('alert', [
                'type' => 'danger',
                'title' => 'Gagal',
                'message' => 'Cabang ini tidak dapat dihapus karena masih memiliki User yang terdaftar.',
            ]);
            return;
        }

        $item->delete();

        $this->dispatch('alert', [
            'type' => 'success',
            'title' => 'Dihapus',
            'message' => 'Data cabang telah dihapus.',
        ]);
    }

    public function render()
    {
        $query = Branch::query();

        if ($this->search) {
            $query->where(function ($q) {
                $q->where('branch', 'like', '%' . $this->search . '%')
                    ->orWhere('branch_address', 'like', '%' . $this->search . '%');
            });
        }

        $branches = $query->orderBy('id_branch', 'desc')->paginate($this->perPage);

        return view('livewire.branches.index', [
            'branches' => $branches,
            'totalBranches' => Branch::count(),
        ]);
    }
}
