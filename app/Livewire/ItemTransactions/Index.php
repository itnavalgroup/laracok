<?php

namespace App\Livewire\ItemTransactions;

use App\Models\ItemTransaction;
use App\Models\ItemCategory;
use App\Models\Item;
use App\Models\Warehouse;
use App\Models\Company;
use App\Models\Uom;
use App\Models\Packaging;
use App\Models\User;
use App\Models\Vendor;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithoutUrlPagination;
use Livewire\WithFileUploads;
use App\Exports\ItemTransactionTemplateExport;
use App\Exports\GenericExport;
use Maatwebsite\Excel\Facades\Excel;

class Index extends Component
{
    use WithPagination, WithoutUrlPagination, WithFileUploads;

    protected $paginationTheme = 'bootstrap';

    public $search = '';
    public $perPage = 10;
    public $filterWarehouse = '';
    public $filterCategory = '';
    public $filterDate = 'all'; // all, today, this_week, this_month, custom
    public $filterStartDate;
    public $filterEndDate;
    public $filterItem = '';
    public $filterCompany = '';

    // Form fields
    public $id_item_transaction;
    public $id_item;
    public $id_item_category;
    public $id_warehouse;
    public $id_company;
    public $id_uom;
    public $id_packaging;
    public $income = 0;
    public $outcome = 0;
    public $transaction_date;
    public $description;
    public $id_vendor;
    public $police_number;
    public $driver_name;
    public $so_number;
    public $invoice_number;
    public $po_number;
    public $fob;
    public $filename;

    public $uploaded_file;
    public $captured_photo;
    public $upload_mode = 'upload'; // 'upload' or 'camera'

    public $isEditing = false;
    public $file_excel;

    public $items = []; // Items based on selected category

    // Report Visualization Filters
    public $reportDateFilter = 'all'; // all, today, this_week, this_month, custom
    public $reportStartDate;
    public $reportEndDate;
    public $reportCategory = '';
    public $reportItem = '';
    public $reportWarehouse = '';
    public $reportCompany = '';

    protected $queryString = [
        'search' => ['except' => ''],
        'perPage' => ['except' => 10],
        'filterWarehouse' => ['except' => ''],
        'filterCategory' => ['except' => ''],
        'filterDate' => ['except' => 'all'],
        'reportDateFilter' => ['except' => 'all'],
    ];

    public function mount()
    {
        $user = Auth::user();
        $hasPermission = $user->level === 1 ||
            $user->hasPermission('item_transaction.view.all') ||
            $user->hasPermission('item_transaction.view.warehouse') ||
            $user->hasPermission('item_transaction.view.subordinate');

        abort_if(!$hasPermission, 403);
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function updatedFilterWarehouse()
    {
        $this->resetPage();
    }

    public function updatedFilterCategory()
    {
        $this->filterItem = '';
        $this->resetPage();
    }

    public function updatedFilterDate()
    {
        $this->resetPage();
    }
    public function updatedFilterStartDate()
    {
        $this->resetPage();
    }
    public function updatedFilterEndDate()
    {
        $this->resetPage();
    }
    public function updatedFilterItem()
    {
        $this->resetPage();
    }
    public function updatedFilterCompany()
    {
        $this->resetPage();
    }

    public function updatedIdItemCategory($value)
    {
        if ($value) {
            $this->items = Item::where('id_item_category', $value)->where('is_active', 1)->get();
        } else {
            $this->items = [];
        }
        $this->id_item = null;
    }

    public function updatedReportCategory($value)
    {
        // When report category changes, reset report item
        $this->reportItem = '';
        $this->updateChart();
    }

    public function updatedReportDateFilter()
    {
        $this->updateChart();
    }
    public function updatedReportStartDate()
    {
        $this->updateChart();
    }
    public function updatedReportEndDate()
    {
        $this->updateChart();
    }
    public function updatedReportItem()
    {
        $this->updateChart();
    }
    public function updatedReportWarehouse()
    {
        $this->updateChart();
    }
    public function updatedReportCompany()
    {
        $this->updateChart();
    }

    public function updateChart()
    {
        $this->dispatch('update-report-chart', data: $this->getReportDataProperty());
    }

    public function create()
    {
        abort_if(Auth::user()->level !== 1 && !Auth::user()->hasPermission('item_transaction.create'), 403);
        $this->resetForm();

        // Auto assign warehouse if user has one
        if (Auth::user()->id_warehouse) {
            $this->id_warehouse = Auth::user()->id_warehouse;
        }

        $this->transaction_date = now()->format('Y-m-d\TH:i');

        $this->isEditing = false;
        $this->dispatch('openTransactionModal');
    }

    public function edit($id)
    {
        abort_if(Auth::user()->level !== 1 && !Auth::user()->hasPermission('item_transaction.edit') && !Auth::user()->hasPermission('item_transaction.edit.all'), 403);

        $transaction = ItemTransaction::findOrFail($id);

        $this->checkEditDeletePermission($transaction, 'edit');

        $this->resetForm();
        $this->id_item_transaction = $transaction->id_item_transaction;
        $this->id_item_category = $transaction->id_item_category;

        $this->updatedIdItemCategory($this->id_item_category); // populate items dropdown

        $this->id_item = $transaction->id_item;
        $this->id_warehouse = $transaction->id_warehouse;
        $this->id_company = $transaction->id_company;
        $this->id_uom = $transaction->id_uom;
        $this->id_packaging = $transaction->id_packaging;
        $this->income = (float) $transaction->income;
        $this->outcome = (float) $transaction->outcome;
        $this->transaction_date = \Carbon\Carbon::parse($transaction->transaction_date)->format('Y-m-d\TH:i');
        $this->description = $transaction->description;
        $this->id_vendor = $transaction->id_vendor;
        $this->police_number = $transaction->police_number;
        $this->driver_name = $transaction->driver_name;
        $this->so_number = $transaction->so_number;
        $this->invoice_number = $transaction->invoice_number;
        $this->po_number = $transaction->po_number;
        $this->fob = $transaction->fob;
        $this->filename = $transaction->filename;

        $this->isEditing = true;
        $this->dispatch('openTransactionModal');
    }

    private function checkEditDeletePermission($transaction, $action = 'edit')
    {
        // Strictly block editing/deleting of IKB-generated transactions
        if (str_starts_with($transaction->transaction_code, 'IKB-')) {
            abort(403, "Transaksi yang dihasilkan dari IKB tidak dapat diubah atau dihapus secara manual.");
        }

        $user = Auth::user();
        if ($user->level === 1) return true;

        $hasAllPermission = $user->hasPermission("item_transaction.{$action}.all");
        $hasBasePermission = $user->hasPermission("item_transaction.{$action}");

        if ($hasAllPermission) {
            return true;
        }

        if ($hasBasePermission) {
            if ($transaction->id_user == $user->id_user) {
                return true;
            }
        }

        abort(403, "Anda tidak memiliki akses untuk melakukan {$action} pada transaksi ini.");
    }

    public function resetForm()
    {
        $this->id_item_transaction = null;
        $this->id_item = null;
        $this->id_item_category = null;
        $this->id_warehouse = null;
        $this->id_company = null;
        $this->id_uom = null;
        $this->id_packaging = null;
        $this->income = 0;
        $this->outcome = 0;
        $this->transaction_date = null;
        $this->description = null;
        $this->id_vendor = null;
        $this->police_number = null;
        $this->driver_name = null;
        $this->so_number = null;
        $this->invoice_number = null;
        $this->po_number = null;
        $this->fob = null;
        $this->filename = null;
        $this->uploaded_file = null;
        $this->captured_photo = null;
        $this->upload_mode = 'upload';
        $this->items = [];
        $this->resetErrorBag();
    }

    private function generateTransactionCode()
    {
        $prefix = 'TRX';
        $date = now()->format('Ymd');
        $lastRecord = ItemTransaction::withTrashed()
            ->where('transaction_code', 'like', $prefix . $date . '%')
            ->orderBy('id_item_transaction', 'desc')
            ->first();

        if ($lastRecord) {
            $lastNumber = (int) substr($lastRecord->transaction_code, -4);
            $newNumber = str_pad($lastNumber + 1, 4, '0', STR_PAD_LEFT);
        } else {
            $newNumber = '0001';
        }

        return $prefix . $date . $newNumber;
    }

    public function save()
    {
        if ($this->isEditing) {
            $permission = Auth::user()->hasPermission('item_transaction.edit.all') ? 'item_transaction.edit.all' : 'item_transaction.edit';
        } else {
            $permission = 'item_transaction.create';
        }

        abort_if(Auth::user()->level !== 1 && !Auth::user()->hasPermission($permission), 403);

        // Remove JS-added thousand separators for validation
        if (is_string($this->income)) $this->income = str_replace(',', '', $this->income);
        if (is_string($this->outcome)) $this->outcome = str_replace(',', '', $this->outcome);

        $rules = [
            'id_item_category' => 'required',
            'id_item' => 'required',
            'id_warehouse' => 'required',
            'id_company' => 'required',
            'id_uom' => 'required',
            'id_packaging' => 'required',
            'income' => 'required|numeric|min:0',
            'transaction_date' => 'required|date',
            'id_vendor' => 'nullable',
            'description' => 'nullable',
            'police_number' => 'nullable',
            'driver_name' => 'nullable',
            'so_number' => 'nullable',
            'invoice_number' => 'nullable',
            'po_number' => 'nullable',
            'fob' => 'nullable',
        ];

        // Ensure users with the out roles have standard validation for it
        if (Auth::user()->level === 1 || Auth::user()->hasPermission('item_transaction.out')) {
            $rules['outcome'] = 'required|numeric|min:0';
        }

        // Filename validation
        if (!$this->isEditing) {
            if ($this->upload_mode === 'upload') {
                $rules['uploaded_file'] = 'required|mimes:jpg,jpeg,png,pdf|max:5120';
            } else {
                $rules['captured_photo'] = 'required';
            }
        } else {
            if ($this->uploaded_file) {
                $rules['uploaded_file'] = 'mimes:jpg,jpeg,png,pdf|max:5120';
            } elseif ($this->captured_photo) {
                // captured_photo is base64, usually no mime validation needed here as it's from JS
            }
        }

        $this->validate($rules);

        $data = [
            'id_item' => $this->id_item,
            'id_item_category' => $this->id_item_category,
            'id_warehouse' => $this->id_warehouse,
            'id_company' => $this->id_company,
            'id_uom' => $this->id_uom,
            'id_packaging' => $this->id_packaging,
            'income' => $this->income,
            'transaction_date' => $this->transaction_date,
            'description' => $this->description,
            'id_vendor' => $this->id_vendor,
            'police_number' => $this->police_number,
            'driver_name' => $this->driver_name,
            'so_number' => $this->so_number,
            'invoice_number' => $this->invoice_number,
            'po_number' => $this->po_number,
            'fob' => $this->fob,
        ];

        // Handle File Upload or Camera Capture
        $storagePath = public_path('assets/attachmenttransaction');
        if (!file_exists($storagePath)) {
            mkdir($storagePath, 0755, true);
        }

        if ($this->upload_mode === 'upload' && $this->uploaded_file) {
            $fileName = time() . '_' . $this->uploaded_file->getClientOriginalName();

            // Use copy then manual cleanup for better reliability on some Windows environments
            $sourcePath = $this->uploaded_file->getRealPath();
            $targetPath = $storagePath . DIRECTORY_SEPARATOR . $fileName;

            if (copy($sourcePath, $targetPath)) {
                $data['filename'] = $fileName;
            } else {
                throw new \Exception("Gagal menyalin file ke direktori tujuan.");
            }
        } elseif ($this->upload_mode === 'camera' && $this->captured_photo) {
            $fileName = time() . '_capture.png';
            $imageData = str_replace('data:image/png;base64,', '', $this->captured_photo);
            $imageData = str_replace(' ', '+', $imageData);
            file_put_contents($storagePath . '/' . $fileName, base64_decode($imageData));
            $data['filename'] = $fileName;
        }

        // Populate outcome if privileged
        if (Auth::user()->level === 1 || Auth::user()->hasPermission('item_transaction.out')) {
            $data['outcome'] = $this->outcome;
        }

        if ($this->isEditing) {
            $transaction = ItemTransaction::findOrFail($this->id_item_transaction);
            $this->checkEditDeletePermission($transaction, 'edit');

            // Delete old file if new one is uploaded
            if (isset($data['filename']) && $transaction->filename) {
                $oldFilePath = $storagePath . '/' . $transaction->filename;
                if (file_exists($oldFilePath)) {
                    unlink($oldFilePath);
                }
            }

            $transaction->update($data);
            $message = 'Transaksi berhasil diperbarui.';
        } else {
            $data['transaction_code'] = $this->generateTransactionCode();
            if (!isset($data['outcome'])) {
                $data['outcome'] = 0;
            }
            $data['id_user'] = Auth::id();
            $data['id_departement'] = Auth::user()->id_departement;

            ItemTransaction::create($data);
            $message = 'Transaksi baru berhasil ditambahkan.';
        }

        $this->dispatch('closeTransactionModal');
        $this->dispatch('alert', [
            'type' => 'success',
            'title' => $this->isEditing ? 'Berhasil' : 'Tersimpan',
            'message' => $message,
        ]);

        $this->resetForm();
    }

    public function delete($id)
    {
        abort_if(Auth::user()->level !== 1 && !Auth::user()->hasPermission('item_transaction.delete') && !Auth::user()->hasPermission('item_transaction.delete.all'), 403);

        $transaction = ItemTransaction::findOrFail($id);

        $this->checkEditDeletePermission($transaction, 'delete');

        // Deletion Restrictions could be added here if transaction acts as parent

        $transaction->delete();

        $this->dispatch('alert', [
            'type' => 'success',
            'title' => 'Dihapus',
            'message' => 'Transaksi telah dihapus.',
        ]);
    }

    public function downloadTemplate()
    {
        abort_if(Auth::user()->level !== 1 && !Auth::user()->hasPermission('item_transaction.upload'), 403);
        $isAdmin = Auth::user()->level === 1;
        return Excel::download(new ItemTransactionTemplateExport($isAdmin), 'template_import_transaksi_barang.xlsx');
    }

    public function import()
    {
        abort_if(Auth::user()->level !== 1 && !Auth::user()->hasPermission('item_transaction.upload'), 403);

        $this->validate([
            'file_excel' => 'required|mimes:xlsx,xls|max:5120',
        ]);

        try {
            $data = Excel::toArray([], $this->file_excel->getRealPath());
            $rows = $data[0] ?? [];
            $count = 0;
            $skipped = 0;

            $isAdmin = Auth::user()->level === 1;
            // Allow manual outcomes flag
            $canOutcome = $isAdmin || Auth::user()->hasPermission('item_transaction.out');

            if (count($rows) > 1) {
                // Loop backward if required, or straight mapping mapping
                foreach ($rows as $index => $row) {
                    if ($index === 0) continue; // Skip header

                    $cat_code = trim($row[0] ?? '');
                    $item_code = trim($row[1] ?? '');
                    $warehouse_name = trim($row[2] ?? '');
                    $company_name = trim($row[3] ?? '');
                    $uom_name = trim($row[4] ?? '');
                    $packaging_name = trim($row[5] ?? '');

                    $income_val = trim($row[6] ?? 0);
                    $outcome_val = trim($row[7] ?? 0);
                    $date_raw = trim($row[8] ?? '');
                    $user_name = trim($row[9] ?? '');
                    $vendor_raw = trim($row[10] ?? '');
                    $police_number = trim($row[11] ?? '');
                    $driver_name = trim($row[12] ?? '');
                    $so_number = trim($row[13] ?? '');
                    $invoice_number = trim($row[14] ?? '');
                    $po_number = trim($row[15] ?? '');
                    $fob = trim($row[16] ?? '');
                    $filename = trim($row[17] ?? '');
                    $description = trim($row[18] ?? '');

                    // Ensure minimum data requirements
                    if ($item_code === '' || $warehouse_name === '' || $company_name === '') continue;

                    // Resolve Foreign Keys
                    $category = ItemCategory::where('item_category_code', $cat_code)->first();
                    $item = Item::where('item_code', $item_code)->first();
                    $warehouse = Warehouse::where('warehouse_name', $warehouse_name)->first();
                    $company = Company::where('company_name', $company_name)->first();
                    $uom = Uom::where('uom', $uom_name)->first();
                    $packaging = Packaging::where('packaging', $packaging_name)->first();

                    // Vendor Resolution using ID from format [#ID] Name
                    $vendor = null;
                    if ($vendor_raw !== '') {
                        if (preg_match('/\[#(\d+)\]/', $vendor_raw, $matches)) {
                            $vendor = Vendor::find($matches[1]);
                        } else {
                            // Fallback to name search if ID not found
                            $vendor = Vendor::where('vendor', $vendor_raw)->first();
                        }
                    }

                    if (!$item || !$warehouse || !$company || !$uom || !$packaging || !$category || ($vendor_raw !== '' && !$vendor)) {
                        $skipped++;
                        continue;
                    }

                    // Strict warehouse bypass validation for non-admins
                    if (!$isAdmin && !empty(Auth::user()->id_warehouse)) {
                        if ($warehouse->id_warehouse != Auth::user()->id_warehouse) {
                            $skipped++;
                            continue;
                        }
                    }

                    $id_user = Auth::id();
                    $id_departement = Auth::user()->id_departement;

                    // Support User Overrides for Admins
                    if ($isAdmin && $user_name !== '') {
                        $selectedUser = User::where('name', $user_name)->where('is_active', 1)->first();
                        if ($selectedUser) {
                            $id_user = $selectedUser->id_user;
                            $id_departement = $selectedUser->id_departement;
                        } else {
                            $skipped++;
                            continue; // Skip if admin provided an invalid user name
                        }
                    }

                    // Sanitize numbers (Dot for decimal, comma for thousand separators)
                    $income_val = (float) str_replace(',', '', $income_val);
                    $outcome_val = $canOutcome ? (float) str_replace(',', '', $outcome_val) : 0;

                    // Parse Date safely (handles Excel serial numbers and string dates)
                    try {
                        if (is_numeric($date_raw)) {
                            $parsedDate = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($date_raw)->format('Y-m-d H:i:s');
                        } else {
                            $parsedDate = \Carbon\Carbon::parse($date_raw)->format('Y-m-d H:i:s');
                        }
                    } catch (\Exception $e) {
                        $parsedDate = now()->format('Y-m-d H:i:s');
                    }

                    ItemTransaction::create([
                        'transaction_code' => $this->generateTransactionCode(),
                        'id_item' => $item->id_item,
                        'id_item_category' => $category->id_item_category,
                        'id_warehouse' => $warehouse->id_warehouse,
                        'id_company' => $company->id_company,
                        'id_uom' => $uom->id_uom,
                        'id_packaging' => $packaging->id_packaging,
                        'income' => $income_val,
                        'outcome' => $outcome_val,
                        'transaction_date' => $parsedDate,
                        'id_user' => $id_user,
                        'id_departement' => $id_departement,
                        'id_vendor' => $vendor ? $vendor->id_vendor : null,
                        'police_number' => $police_number,
                        'driver_name' => $driver_name,
                        'so_number' => $so_number,
                        'invoice_number' => $invoice_number,
                        'po_number' => $po_number,
                        'fob' => $fob,
                        'filename' => $filename !== '' ? $filename : null,
                        'description' => $description,
                    ]);
                    $count++;
                }
            }

            $this->dispatch('closeImportModal');

            $msg = "$count data transaksi berhasil diimport.";
            if ($skipped > 0) {
                $msg .= " $skipped data dilewati karena referensi kolom yang dipilih (Barang/Gudang/etc) tidak valid autau Anda tidak memiliki izin untuk menginput ke gudang tersebut.";
            }

            $this->dispatch('alert', [
                'type' => $skipped > 0 ? 'warning' : 'success',
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
        abort_if(Auth::user()->level !== 1 && !Auth::user()->hasPermission('item_transaction.download'), 403);

        $query = ItemTransaction::with(['item', 'category', 'warehouse', 'company', 'uom', 'packaging', 'user']);


        // Scope exactly as render does
        $user = Auth::user();
        if ($user->level !== 1 && !$user->hasPermission('item_transaction.view.all')) {
            if ($user->hasPermission('item_transaction.view.warehouse')) {
                if ($user->id_warehouse) {
                    $query->where('id_warehouse', $user->id_warehouse);
                } else {
                    $query->whereRaw('1 = 0');
                }
            } elseif ($user->hasPermission('item_transaction.view.subordinate')) {
                $subordinateIds = User::where('supervisor', $user->id_user)->pluck('id_user')->toArray();
                $allowIds = array_merge([$user->id_user], $subordinateIds);
                $query->whereIn('id_user', $allowIds);
            } else {
                $query->where('id_user', $user->id_user);
            }
        }

        $transactions = $query->orderBy('id_item_transaction', 'desc')->get();

        $headers = ['Transaction Code', 'Date', 'Category', 'Item Code', 'Item Name', 'Warehouse', 'Company', 'UOM', 'Packaging', 'Income', 'Outcome', 'Creator', 'Vendor', 'Police Number', 'Driver Name', 'SO Number', 'Invoice Number', 'PO Number', 'FOB'];
        $data = $transactions->map(fn($t) => [
            $t->transaction_code,
            \Carbon\Carbon::parse($t->transaction_date)->format('Y-m-d'),
            $t->category->item_category ?? '-',
            $t->item->item_code ?? '-',
            $t->item->item_name ?? '-',
            $t->warehouse->warehouse_name ?? '-',
            $t->company->company ?? '-',
            $t->uom->uom ?? '-',
            $t->packaging->packaging ?? '-',
            $t->income,
            $t->outcome,
            $t->user->name ?? '-',
            $t->vendor->vendor ?? '-',
            $t->police_number ?? '-',
            $t->driver_name ?? '-',
            $t->so_number ?? '-',
            $t->invoice_number ?? '-',
            $t->po_number ?? '-',
            $t->fob ?? '-',
        ])->toArray();

        return Excel::download(new GenericExport($headers, $data), 'Data_Transaksi_Barang_' . date('Ymd_His') . '.xlsx');
    }

    public function render()
    {
        $query = ItemTransaction::query();
        $user = Auth::user();

        // Roles check logic
        if ($user->level !== 1 && !$user->hasPermission('item_transaction.view.all')) {
            if ($user->hasPermission('item_transaction.view.warehouse')) {
                // View within own warehouse
                if ($user->id_warehouse) {
                    $query->where('id_warehouse', $user->id_warehouse);
                } else {
                    $query->whereRaw('1 = 0');
                }
            } elseif ($user->hasPermission('item_transaction.view.subordinate')) {
                // View own and subordinates' transactions
                $subordinateIds = User::where('supervisor', $user->id_user)->pluck('id_user')->toArray();
                $allowIds = array_merge([$user->id_user], $subordinateIds);
                $query->whereIn('id_user', $allowIds);
            } else {
                $query->where('id_user', $user->id_user); // Fallback to own only if no specific view permission
            }
        }

        if ($this->search) {
            $query->where(function ($q) {
                $q->where('transaction_code', 'like', '%' . $this->search . '%')
                    ->orWhereHas('item', function ($qItem) {
                        $qItem->where('item_name', 'like', '%' . $this->search . '%');
                    });
            });
        }

        if ($this->filterWarehouse) {
            $query->where('id_warehouse', $this->filterWarehouse);
        }

        if ($this->filterCategory) {
            $query->where('id_item_category', $this->filterCategory);
        }

        if ($this->filterItem) {
            $query->where('id_item', $this->filterItem);
        }

        if ($this->filterCompany) {
            $query->where('id_company', $this->filterCompany);
        }

        if ($this->filterDate !== 'all') {
            $now = \Carbon\Carbon::now();
            if ($this->filterDate === 'today') {
                $query->whereDate('transaction_date', $now->toDateString());
            } elseif ($this->filterDate === 'this_week') {
                $query->whereBetween('transaction_date', [$now->startOfWeek()->toDateString(), $now->endOfWeek()->toDateString()]);
            } elseif ($this->filterDate === 'this_month') {
                $query->whereMonth('transaction_date', $now->month)
                    ->whereYear('transaction_date', $now->year);
            } elseif ($this->filterDate === 'custom') {
                if ($this->filterStartDate && $this->filterEndDate) {
                    $query->whereBetween('transaction_date', [$this->filterStartDate, $this->filterEndDate]);
                } else {
                    $query->whereRaw('1 = 0');
                }
            }
        }

        $transactions = $query->orderBy('transaction_date', 'desc')->paginate($this->perPage);

        // Pre-fetch IKB mapping to avoid N+1 and handle permissions
        $ikbMap = [];
        $ikbNumbers = [];
        foreach ($transactions as $trx) {
            if (str_starts_with($trx->transaction_code, 'IKB-')) {
                if (preg_match('/^IKB-(.+)-(\d+)$/', $trx->transaction_code, $matches)) {
                    $ikbNumbers[] = $matches[1];
                }
            }
        }

        if (!empty($ikbNumbers)) {
            $ikbs = \App\Models\Ikb::whereIn('ikb_number', array_unique($ikbNumbers))->get();
            $subordinateIds = $user->subordinates()->pluck('id_user')->toArray();
            $hasItDetail = $user->hasPermission('item_transaction.detail');

            foreach ($ikbs as $ikb) {
                // Replicate IKB visibility logic (Owner, Sales, Dept, Warehouse, Subordinate, or Approver)
                $canViewIkb = $user->level === 1
                    || $user->id_user == $ikb->id_user
                    || $user->id_user == $ikb->sales
                    || $user->hasPermission('ikb.view.all')
                    || ($user->hasPermission('ikb.view.dept') && $user->id_departement == $ikb->id_departement)
                    || ($user->hasPermission('ikb.view.warehouse') && $user->id_warehouse == $ikb->id_warehouse)
                    || ($user->hasPermission('ikb.view.subordinate') && (in_array($ikb->sales, $subordinateIds) || in_array($ikb->id_user, $subordinateIds)))
                    || $user->hasPermission('ikb.approve.step1')
                    || $user->hasPermission('ikb.approve.step2')
                    || $user->hasPermission('ikb.approve.step3')
                    || $user->hasPermission('ikb.approve.step4')
                    || $user->hasPermission('ikb.approve.step5')
                    || $user->hasPermission('ikb.approve.step6')
                    || $user->hasPermission('ikb.approve.step7')
                    || $user->hasPermission('ikb.approve.step8')
                    || $user->hasPermission('ikb.approve.step9');

                $ikbMap[$ikb->ikb_number] = [
                    'hashid' => hashid_encode($ikb->id_ikb, 'ikb'),
                    'can_show' => $hasItDetail && $canViewIkb
                ];
            }
        }

        $categories = ItemCategory::where('is_active', 1)->get();
        // Base warehouses query
        $warehousesQuery = Warehouse::query();

        if ($user->level !== 1 && !$user->hasPermission('item_transaction.view.all') && $user->id_warehouse) {
            $warehousesQuery->where('id_warehouse', $user->id_warehouse);
        }

        $warehouses = $warehousesQuery->get();
        $companies = Company::all();
        $uoms = Uom::all();
        $packagings = Packaging::all();

        // Report Items dropdown
        $reportItemsDropdown = [];
        if ($this->reportCategory) {
            $reportItemsDropdown = Item::where('id_item_category', $this->reportCategory)->where('is_active', 1)->get();
        }

        // Table Items dropdown
        $filterItemsDropdown = [];
        if ($this->filterCategory) {
            $filterItemsDropdown = Item::where('id_item_category', $this->filterCategory)->where('is_active', 1)->get();
        }

        return view('livewire.item-transactions.index', [
            'transactions' => $transactions,
            'ikbMap' => $ikbMap,
            'categories' => $categories,
            'warehouses' => $warehouses,
            'companies' => $companies,
            'uoms' => $uoms,
            'packagings' => $packagings,
            'vendors' => \App\Models\Vendor::all(),
            'totalTransactions' => ItemTransaction::count(),
            'reportItemsDropdown' => $reportItemsDropdown,
            'filterItemsDropdown' => $filterItemsDropdown,
            'reportData' => $this->reportData // Accessing the computed property
        ])->layout('layouts.app');
    }
    public function getReportDataProperty()
    {
        $user = Auth::user();
        if ($user->level !== 1 && !$user->hasPermission('item_transaction.view.report')) {
            return null; // Don't compute if user doesn't have permission
        }

        $query = clone ItemTransaction::query();

        // Respect granular view scope
        if ($user->level !== 1 && !$user->hasPermission('item_transaction.view.all')) {
            if ($user->hasPermission('item_transaction.view.warehouse')) {
                if ($user->id_warehouse) {
                    $query->where('id_warehouse', $user->id_warehouse);
                } else {
                    $query->whereRaw('1 = 0');
                }
            } elseif ($user->hasPermission('item_transaction.view.subordinate')) {
                $subordinateIds = User::where('supervisor', $user->id_user)->pluck('id_user')->toArray();
                $allowIds = array_merge([$user->id_user], $subordinateIds);
                $query->whereIn('id_user', $allowIds);
            } else {
                $query->where('id_user', $user->id_user);
            }
        } else {
            if ($this->reportWarehouse) {
                $query->where('id_warehouse', $this->reportWarehouse);
            }
        }

        // Apply Report Filters
        if ($this->reportCategory) {
            $query->where('id_item_category', $this->reportCategory);
        }
        if ($this->reportItem) {
            $query->where('id_item', $this->reportItem);
        }
        if ($this->reportCompany) {
            $query->where('id_company', $this->reportCompany);
        }

        // Date Filter
        $dateFilter = $this->reportDateFilter;
        if ($dateFilter === 'today') {
            $query->whereDate('transaction_date', now()->format('Y-m-d'));
        } elseif ($dateFilter === 'this_week') {
            $query->whereBetween('transaction_date', [now()->startOfWeek()->format('Y-m-d'), now()->endOfWeek()->format('Y-m-d')]);
        } elseif ($dateFilter === 'this_month') {
            $query->whereBetween('transaction_date', [now()->startOfMonth()->format('Y-m-d'), now()->endOfMonth()->format('Y-m-d')]);
        } elseif ($dateFilter === 'custom' && $this->reportStartDate && $this->reportEndDate) {
            $query->whereBetween('transaction_date', [$this->reportStartDate, $this->reportEndDate]);
        }

        // Group by Date to form the series
        $transactions = $query->selectRaw('DATE(transaction_date) as t_date, SUM(income) as total_income, SUM(outcome) as total_outcome')
            ->groupBy('t_date')
            ->orderBy('t_date')
            ->get();

        $categories = [];
        $incomeSeries = [];
        $outcomeSeries = [];
        $netSeries = [];

        foreach ($transactions as $t) {
            $categories[] = \Carbon\Carbon::parse($t->t_date)->format('d M');
            $incomeSeries[] = (float) $t->total_income;
            $outcomeSeries[] = (float) $t->total_outcome;
            $netSeries[] = (float) ($t->total_income - $t->total_outcome);
        }

        $totalIncome = array_sum($incomeSeries);
        $totalOutcome = array_sum($outcomeSeries);
        $totalNet = array_sum($netSeries);

        return [
            'categories' => $categories,
            'income' => $incomeSeries,
            'outcome' => $outcomeSeries,
            'net' => $netSeries,
            'total_income' => $totalIncome,
            'total_outcome' => $totalOutcome,
            'total_net' => $totalNet,
        ];
    }
}
