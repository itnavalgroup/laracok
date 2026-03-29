<?php

namespace App\Livewire\Items;

use App\Models\Item;
use App\Models\ItemCategory;
use App\Exports\ItemTemplateExport;
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
    public $filterCategory = '';

    // Form fields
    public $id_item;
    public $item_code;
    public $item_name;
    public $description;
    public $id_item_category;
    public $is_active = 1;

    public $isEditing = false;
    public $file_excel;

    protected $queryString = [
        'search' => ['except' => ''],
        'perPage' => ['except' => 10],
        'filterCategory' => ['except' => ''],
    ];

    public function mount()
    {
        abort_if(Auth::user()->level !== 1 && !Auth::user()->hasPermission('item.view.all') && !Auth::user()->hasPermission('item.view.warehouse') && !Auth::user()->hasPermission('item.view.subordinate'), 403);
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function updatedFilterCategory()
    {
        $this->resetPage();
    }

    public function create()
    {
        // Based on user role/permission
        abort_if(Auth::user()->level !== 1 && !Auth::user()->hasPermission('item.create'), 403);
        $this->resetForm();
        $this->isEditing = false;
        $this->dispatch('openItemModal');
    }

    public function edit($id)
    {
        abort_if(Auth::user()->level !== 1 && !Auth::user()->hasPermission('item.edit'), 403);
        $this->resetForm();
        $item = Item::findOrFail($id);
        $this->id_item = $item->id_item;
        $this->item_code = $item->item_code;
        $this->item_name = $item->item_name;
        $this->description = $item->description;
        $this->id_item_category = $item->id_item_category;
        $this->is_active = $item->is_active;
        $this->isEditing = true;
        $this->dispatch('openItemModal');
    }

    public function resetForm()
    {
        $this->id_item = null;
        $this->item_code = '';
        $this->item_name = '';
        $this->description = '';
        $this->id_item_category = null;
        $this->is_active = 1;
        $this->resetErrorBag();
    }

    public function save()
    {
        $permission = $this->isEditing ? 'item.edit' : 'item.create';
        abort_if(Auth::user()->level !== 1 && !Auth::user()->hasPermission($permission), 403);

        $rules = [
            'item_code' => 'required|string|max:50|unique:tbl_items,item_code,' . $this->id_item . ',id_item',
            'item_name' => 'required|string|max:255',
            'id_item_category' => 'required|exists:tbl_item_categories,id_item_category',
            'is_active' => 'required|in:0,1',
            'description' => 'nullable|string',
        ];

        $this->validate($rules);

        $data = [
            'item_code' => $this->item_code,
            'item_name' => $this->item_name,
            'description' => $this->description,
            'id_item_category' => $this->id_item_category,
            'is_active' => $this->is_active,
            'id_user' => Auth::id(),
        ];

        if ($this->isEditing) {
            Item::find($this->id_item)->update($data);
            $message = 'Data barang berhasil diperbarui.';
        } else {
            Item::create($data);
            $message = 'Barang baru berhasil ditambahkan.';
        }

        $this->dispatch('closeItemModal');
        $this->dispatch('alert', [
            'type' => 'success',
            'title' => $this->isEditing ? 'Berhasil' : 'Tersimpan',
            'message' => $message,
        ]);

        $this->resetForm();
    }

    public function delete($id)
    {
        abort_if(Auth::user()->level !== 1 && !Auth::user()->hasPermission('item.delete'), 403);

        $item = Item::findOrFail($id);

        // Deletion Restriction
        $isUsedInIkb = DB::table('tbl_ikb_details')->where('id_item', $id)->exists();
        $isUsedInTrans = DB::table('tbl_item_transactions')->where('id_item', $id)->exists();
        $isUsedInPr = DB::table('tbl_detail_pr')->where('id_item', $id)->exists();
        $isUsedInSr = DB::table('tbl_detail_sr')->where('id_item', $id)->exists();

        if ($isUsedInIkb || $isUsedInTrans || $isUsedInPr || $isUsedInSr) {
            $this->dispatch('alert', [
                'type' => 'danger',
                'title' => 'Gagal',
                'message' => 'Barang tidak dapat dihapus karena masih digunakan dalam transaksi/data lain.',
            ]);
            return;
        }

        $item->delete();

        $this->dispatch('alert', [
            'type' => 'success',
            'title' => 'Dihapus',
            'message' => 'Barang telah dihapus.',
        ]);
    }

    public function downloadTemplate()
    {
        abort_if(Auth::user()->level !== 1 && !Auth::user()->hasPermission('item.upload'), 403);

        return Excel::download(new ItemTemplateExport(), 'template_import_item.xlsx');
    }

    public function import()
    {
        abort_if(Auth::user()->level !== 1 && !Auth::user()->hasPermission('item.upload'), 403);

        $this->validate([
            'file_excel' => 'required|mimes:xlsx,xls|max:5120',
        ]);

        try {
            $data = Excel::toArray([], $this->file_excel->getRealPath());
            $rows = $data[0] ?? [];
            $count = 0;
            $skipped = 0;
            $duplicates = [];

            if (count($rows) > 1) {
                foreach ($rows as $index => $row) {
                    if ($index === 0) continue; // Skip header

                    $code = trim($row[0] ?? '');
                    $name = trim($row[1] ?? '');
                    $cat_code = trim($row[2] ?? '');
                    $desc = trim($row[3] ?? '');

                    if ($code === '' || $name === '' || $cat_code === '') continue;

                    // Check for duplicate code in DB
                    if (Item::where('item_code', $code)->exists()) {
                        $duplicates[] = $code;
                        continue;
                    }

                    // Find category
                    $category = ItemCategory::where('item_category_code', $cat_code)->first();
                    if (!$category) {
                        $skipped++;
                        continue;
                    }

                    Item::create([
                        'item_code' => $code,
                        'item_name' => $name,
                        'id_item_category' => $category->id_item_category,
                        'description' => $desc,
                        'id_user' => Auth::id(),
                        'is_active' => 1
                    ]);
                    $count++;
                }
            }

            $this->dispatch('closeImportModal');

            $msg = "$count data barang berhasil diimport.";
            if (count($duplicates) > 0) {
                $msg .= " " . count($duplicates) . " data dilewati karena kode duplikat.";
            }
            if ($skipped > 0) {
                $msg .= " $skipped data dilewati karena kategori tidak ditemukan.";
            }

            $this->dispatch('alert', [
                'type' => count($duplicates) > 0 || $skipped > 0 ? 'warning' : 'success',
                'title' => 'Selesai',
                'message' => $msg,
            ]);
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
        abort_if(Auth::user()->level !== 1 && !Auth::user()->hasPermission('item.download'), 403);

        $items = Item::with(['category'])->get();

        $headers = ['ID', 'Kode Barang', 'Nama Barang', 'Kategori', 'Status', 'Deskripsi'];
        $data = $items->map(fn($item) => [
            $item->id_item,
            $item->item_code,
            $item->item_name,
            $item->category->item_category ?? '-',
            $item->is_active ? 'Active' : 'Inactive',
            $item->description
        ])->toArray();

        return Excel::download(new \App\Exports\GenericExport($headers, $data), 'Data_Master_Barang_' . date('Ymd_His') . '.xlsx');
    }

    public function render()
    {
        $userWarehouseId = Auth::user()->id_warehouse;

        $query = Item::with(['category'])
            ->withSum(['transactions as total_income' => function ($q) use ($userWarehouseId) {
                $q->when($userWarehouseId, fn($w) => $w->where('id_warehouse', $userWarehouseId));
            }], 'income')
            ->withSum(['transactions as total_outcome' => function ($q) use ($userWarehouseId) {
                $q->when($userWarehouseId, fn($w) => $w->where('id_warehouse', $userWarehouseId));
            }], 'outcome');

        if ($this->search) {
            $query->where(function ($q) {
                $q->where('item_name', 'like', '%' . $this->search . '%')
                    ->orWhere('item_code', 'like', '%' . $this->search . '%');
            });
        }

        if ($this->filterCategory) {
            $query->where('id_item_category', $this->filterCategory);
        }

        $items = $query->orderBy('id_item', 'desc')->paginate($this->perPage);

        return view('livewire.items.index', [
            'items' => $items,
            'categories' => ItemCategory::where('is_active', 1)->get(),
            'totalItems' => Item::count(),
        ]);
    }
}
