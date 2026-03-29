<?php

namespace App\Livewire\ItemCategories;

use App\Models\ItemCategory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;

class Index extends Component
{
    use WithPagination, WithFileUploads;

    protected $paginationTheme = 'bootstrap';

    public $search = '';
    public $perPage = 10;

    // Form fields
    public $id_item_category;
    public $item_category_code;
    public $item_category;
    public $is_active = 1;

    public $isEditing = false;
    public $file_excel;

    protected $queryString = [
        'search' => ['except' => ''],
        'perPage' => ['except' => 10],
    ];

    public function mount()
    {
        abort_if(Auth::user()->level !== 1 && !Auth::user()->hasPermission('item_category.view'), 403);
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function create()
    {
        abort_if(Auth::user()->level !== 1 && !Auth::user()->hasPermission('item_category.create'), 403);
        $this->resetForm();
        $this->isEditing = false;
        $this->dispatch('openCategoryModal');
    }

    public function edit($id)
    {
        abort_if(Auth::user()->level !== 1 && !Auth::user()->hasPermission('item_category.edit'), 403);
        $this->resetForm();
        $item = ItemCategory::findOrFail($id);
        $this->id_item_category = $item->id_item_category;
        $this->item_category_code = $item->item_category_code;
        $this->item_category = $item->item_category;
        $this->is_active = $item->is_active;
        $this->isEditing = true;
        $this->dispatch('openCategoryModal');
    }

    public function resetForm()
    {
        $this->id_item_category = null;
        $this->item_category_code = '';
        $this->item_category = '';
        $this->is_active = 1;
        $this->resetErrorBag();
    }

    public function save()
    {
        $permission = $this->isEditing ? 'item_category.edit' : 'item_category.create';
        abort_if(Auth::user()->level !== 1 && !Auth::user()->hasPermission($permission), 403);

        $rules = [
            'item_category_code' => 'required|string|max:50|unique:tbl_item_categories,item_category_code,' . $this->id_item_category . ',id_item_category',
            'item_category' => 'required|string|max:255',
            'is_active' => 'required|in:0,1',
        ];

        $this->validate($rules);

        $data = [
            'item_category_code' => $this->item_category_code,
            'item_category' => $this->item_category,
            'is_active' => $this->is_active,
            'id_user' => Auth::id(),
        ];

        if ($this->isEditing) {
            ItemCategory::find($this->id_item_category)->update($data);
            $message = 'Kategori barang berhasil diperbarui.';
        } else {
            ItemCategory::create($data);
            $message = 'Kategori barang baru berhasil ditambahkan.';
        }

        $this->dispatch('closeCategoryModal');
        $this->dispatch('alert', [
            'type' => 'success',
            'title' => $this->isEditing ? 'Berhasil' : 'Tersimpan',
            'message' => $message,
        ]);

        $this->resetForm();
    }

    public function delete($id)
    {
        abort_if(Auth::user()->level !== 1 && !Auth::user()->hasPermission('item_category.delete'), 403);

        $item = ItemCategory::findOrFail($id);

        // Deletion Restriction
        $isUsedInIkb = DB::table('tbl_ikb_details')->where('id_item_category', $id)->exists();
        $isUsedInTrans = DB::table('tbl_item_transactions')->where('id_item_category', $id)->exists();
        $isUsedInPr = DB::table('tbl_detail_pr')->where('id_item_category', $id)->exists();
        $isUsedInSr = DB::table('tbl_detail_sr')->where('id_item_category', $id)->exists();
        $isUsedInItems = DB::table('tbl_items')->where('id_item_category', $id)->exists();

        if ($isUsedInIkb || $isUsedInTrans || $isUsedInPr || $isUsedInSr || $isUsedInItems) {
            $this->dispatch('alert', [
                'type' => 'danger',
                'title' => 'Gagal',
                'message' => 'Kategori tidak dapat dihapus karena masih digunakan dalam data lain.',
            ]);
            return;
        }

        $item->delete();

        $this->dispatch('alert', [
            'type' => 'success',
            'title' => 'Dihapus',
            'message' => 'Kategori barang telah dihapus.',
        ]);
    }

    public function downloadTemplate()
    {
        abort_if(Auth::user()->level !== 1 && !Auth::user()->hasPermission('item_category.upload'), 403);

        $headers = ['category_code', 'category_name'];
        $data = [['CAT001', 'Contoh Nama Kategori']];

        return Excel::download(new \App\Exports\GenericExport($headers, $data), 'template_import_item_category.xlsx');
    }

    public function import()
    {
        abort_if(Auth::user()->level !== 1 && !Auth::user()->hasPermission('item_category.upload'), 403);

        $this->validate([
            'file_excel' => 'required|mimes:xlsx,xls|max:5120',
        ]);

        try {
            $data = Excel::toArray([], $this->file_excel->getRealPath());
            $rows = $data[0] ?? [];
            $count = 0;

            if (count($rows) > 1) {
                $duplicates = [];
                foreach ($rows as $index => $row) {
                    if ($index === 0) continue; // Skip header

                    $code = trim($row[0] ?? '');
                    $name = trim($row[1] ?? '');

                    if ($code === '' || $name === '') continue;

                    // Validation: Check if code already exists
                    if (ItemCategory::where('item_category_code', $code)->exists()) {
                        $duplicates[] = $code;
                        continue;
                    }

                    ItemCategory::create([
                        'item_category_code' => $code,
                        'item_category' => $name,
                        'id_user' => Auth::id(),
                        'is_active' => 1
                    ]);
                    $count++;
                }
            }

            $this->dispatch('closeImportModal');

            if (count($duplicates) > 0) {
                $duplicateList = implode(', ', $duplicates);
                $this->dispatch('alert', [
                    'type' => 'warning',
                    'title' => 'Selesai dengan Peringatan',
                    'message' => "$count data berhasil diimport. Kode berikut dilewati karena duplikat: $duplicateList",
                ]);
            } else {
                $this->dispatch('alert', [
                    'type' => 'success',
                    'title' => 'Berhasil',
                    'message' => "$count data kategori berhasil diimport.",
                ]);
            }
            $this->file_excel = null;
        } catch (\Exception $e) {
            $this->dispatch('alert', [
                'type' => 'danger',
                'title' => 'Gagal',
                'message' => 'Terjadi kesalahan saat mengimport data: ' . $e->getMessage(),
            ]);
        }
    }

    public function export()
    {
        abort_if(Auth::user()->level !== 1 && !Auth::user()->hasPermission('item_category.download'), 403);

        $categories = ItemCategory::with(['creator'])->get();

        $headers = ['ID', 'Kode Kategori', 'Nama Kategori', 'Status', 'Dibuat Oleh', 'Tgl Dibuat'];
        $data = $categories->map(fn($item) => [
            $item->id_item_category,
            $item->item_category_code,
            $item->item_category,
            $item->is_active ? 'Active' : 'Inactive',
            $item->creator->name ?? 'System',
            $item->created_at->format('d/m/Y H:i')
        ])->toArray();

        return Excel::download(new \App\Exports\GenericExport($headers, $data), 'Data_Kategori_Barang_' . date('Ymd_His') . '.xlsx');
    }

    public function render()
    {
        $query = ItemCategory::with(['creator']);

        if ($this->search) {
            $query->where('item_category', 'like', '%' . $this->search . '%')
                ->orWhere('item_category_code', 'like', '%' . $this->search . '%');
        }

        $categories = $query->orderBy('id_item_category', 'desc')->paginate($this->perPage);

        return view('livewire.item-categories.index', [
            'categories' => $categories,
            'totalCategories' => ItemCategory::count(),
            'activeCategories' => ItemCategory::where('is_active', 1)->count(),
        ]);
    }
}
