<?php

namespace App\Livewire\DocTypes;

use App\Models\DocType;
use App\Models\Pr;
use App\Models\Sr;
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
    public $id_doc_type;
    public $doc_type;

    public $isEditing = false;

    protected $queryString = [
        'search' => ['except' => ''],
        'perPage' => ['except' => 10],
    ];

    public function mount()
    {
        abort_if(Auth::user()->level !== 1 && !Auth::user()->hasPermission('doc_type.view'), 403);
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function create()
    {
        abort_if(Auth::user()->level !== 1 && !Auth::user()->hasPermission('doc_type.create'), 403);
        $this->resetForm();
        $this->isEditing = false;
        $this->dispatch('openDocTypeModal');
    }

    public function edit($id)
    {
        abort_if(Auth::user()->level !== 1 && !Auth::user()->hasPermission('doc_type.edit'), 403);
        $this->resetForm();
        $item = DocType::findOrFail($id);
        $this->id_doc_type = $item->id_doc_type;
        $this->doc_type = $item->doc_type;
        $this->isEditing = true;
        $this->dispatch('openDocTypeModal');
    }

    public function resetForm()
    {
        $this->id_doc_type = null;
        $this->doc_type = '';
        $this->resetErrorBag();
    }

    public function save()
    {
        $permission = $this->isEditing ? 'doc_type.edit' : 'doc_type.create';
        abort_if(Auth::user()->level !== 1 && !Auth::user()->hasPermission($permission), 403);

        $rules = [
            'doc_type' => 'required|string|max:255|unique:tbl_doc_types,doc_type,' . ($this->id_doc_type ?? 'NULL') . ',id_doc_type',
        ];

        $this->validate($rules);

        $data = [
            'doc_type' => $this->doc_type,
        ];

        if ($this->isEditing) {
            DocType::find($this->id_doc_type)->update($data);
            $message = 'Tipe dokumen berhasil diperbarui.';
        } else {
            DocType::create($data);
            $message = 'Tipe dokumen baru berhasil ditambahkan.';
        }

        $this->dispatch('closeDocTypeModal');
        $this->dispatch('alert', [
            'type' => 'success',
            'title' => $this->isEditing ? 'Berhasil' : 'Tersimpan',
            'message' => $message,
        ]);

        $this->resetForm();
    }

    public function delete($id)
    {
        abort_if(Auth::user()->level !== 1 && !Auth::user()->hasPermission('doc_type.delete'), 403);

        $item = DocType::findOrFail($id);

        // Deletion Restriction: Check if used by PR or SR
        $isUsedInPr = Pr::where('id_doc_type', $id)->exists();
        $isUsedInSr = Sr::where('id_doc_type', $id)->exists();

        if ($isUsedInPr || $isUsedInSr) {
            $this->dispatch('alert', [
                'type' => 'danger',
                'title' => 'Gagal',
                'message' => 'Tipe dokumen tidak dapat dihapus karena sudah digunakan dalam transaksi PR atau SR.',
            ]);
            return;
        }

        $item->delete();

        $this->dispatch('alert', [
            'type' => 'success',
            'title' => 'Dihapus',
            'message' => 'Tipe dokumen telah dihapus.',
        ]);
    }

    public function render()
    {
        $query = DocType::query();

        if ($this->search) {
            $query->where('doc_type', 'like', '%' . $this->search . '%');
        }

        $docTypes = $query->orderBy('id_doc_type', 'desc')->paginate($this->perPage);

        return view('livewire.doc-types.index', [
            'docTypes' => $docTypes,
            'totalDocTypes' => DocType::count(),
        ]);
    }
}
