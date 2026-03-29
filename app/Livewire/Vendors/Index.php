<?php

namespace App\Livewire\Vendors;

use App\Models\Vendor;
use App\Models\VendorEmail;
use App\Models\VendorBankAccount;
use App\Models\Departement;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\VendorsExport;
use App\Imports\VendorsImport;
use Maatwebsite\Excel\Excel as ExcelType;

class Index extends Component
{
    use WithPagination, WithFileUploads;

    protected $paginationTheme = 'bootstrap';

    // Search and Filters
    public $search = '';
    public $departmentFilter = '';
    public $perPage = 10;

    // Vendor Properties
    public $id_vendor, $vendor, $npwp, $nik, $id_departement;
    public $is_active = true;
    public $emails = [];
    public $bankAccounts = [];

    // Import
    public $file_excel;

    // View States
    public $isEditing = false;
    public $isShowOnly = false;
    public $canEditMainData = true;

    public function mount()
    {
        abort_if(auth()->user()->level !== 1 && !auth()->user()->hasPermission('vendor.view'), 403);
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function resetFields()
    {
        $this->id_vendor = null;
        $this->vendor = '';
        $this->npwp = '';
        $this->nik = '';
        $this->id_departement = null;
        $this->emails = [['email' => '']];
        $this->bankAccounts = [['nama_bank' => '', 'nama_penerima' => '', 'norek' => '']];
        $this->isEditing = false;
        $this->isShowOnly = false;
        $this->is_active = true;
        $this->resetErrorBag();
    }

    // Dynamic Emails
    public function addEmail()
    {
        $this->emails[] = ['email' => ''];
    }

    public function removeEmail($index)
    {
        if (isset($this->emails[$index]['is_used']) && $this->emails[$index]['is_used']) {
            $this->dispatch('alert', type: 'error', message: 'Email tidak bisa dihapus karena sudah digunakan dalam transaksi.');
            return;
        }
        unset($this->emails[$index]);
        $this->emails = array_values($this->emails);
    }

    // Dynamic Bank Accounts
    public function addBankAccount()
    {
        $this->bankAccounts[] = ['nama_bank' => '', 'nama_penerima' => '', 'norek' => ''];
    }

    public function removeBankAccount($index)
    {
        if (isset($this->bankAccounts[$index]['is_used']) && $this->bankAccounts[$index]['is_used']) {
            $this->dispatch('alert', type: 'error', message: 'Rekening tidak bisa dihapus karena sudah digunakan dalam transaksi.');
            return;
        }
        unset($this->bankAccounts[$index]);
        $this->bankAccounts = array_values($this->bankAccounts);
    }

    public function create()
    {
        abort_if(auth()->user()->level !== 1 && !auth()->user()->hasPermission('vendor.create'), 403);
        $this->resetFields();
        $this->dispatch('showModal', id: 'vendorModal');
    }

    public function store()
    {
        abort_if(auth()->user()->level !== 1 && !auth()->user()->hasPermission('vendor.create'), 403);
        $this->validate([
            'vendor' => 'required|string|max:255',
            'npwp' => 'nullable|string|max:50',
            'nik' => 'nullable|string|max:50',
            'emails.*.email' => 'nullable|email',
            'bankAccounts.*.norek' => 'nullable|string',
        ]);

        // Manual uniqueness check for encrypted fields
        if ($this->npwp) {
            $encryptedNpwp = encrypt_legacy(trim($this->npwp));
            if (Vendor::where('npwp', $encryptedNpwp)->exists()) {
                $this->addError('npwp', 'NPWP sudah terdaftar.');
                $this->dispatch('alert', type: 'error', message: 'NPWP sudah terdaftar.');
                return;
            }
        }

        if ($this->nik) {
            $encryptedNik = encrypt_legacy(trim($this->nik));
            if (Vendor::where('nik', $encryptedNik)->exists()) {
                $this->addError('nik', 'NIK sudah terdaftar.');
                $this->dispatch('alert', type: 'error', message: 'NIK sudah terdaftar.');
                return;
            }
        }

        DB::beginTransaction();
        try {
            $deptId = (auth()->user()->level == 1) ? null : auth()->user()->id_departement;

            $vendor = Vendor::create([
                'vendor' => $this->vendor,
                'npwp' => $this->npwp ? encrypt_legacy($this->npwp) : null,
                'nik' => $this->nik ? encrypt_legacy($this->nik) : null,
                'id_user' => auth()->id(),
                'id_departement' => $deptId,
                'is_active' => $this->is_active,
            ]);

            foreach ($this->emails as $emailData) {
                if (!empty($emailData['email'])) {
                    VendorEmail::create([
                        'id_vendor' => $vendor->id_vendor,
                        'email' => $emailData['email'],
                    ]);
                }
            }

            foreach ($this->bankAccounts as $bankData) {
                if (!empty($bankData['norek'])) {
                    VendorBankAccount::create([
                        'id_vendor' => $vendor->id_vendor,
                        'nama_bank' => $bankData['nama_bank'],
                        'nama_penerima' => $bankData['nama_penerima'],
                        'norek' => $bankData['norek'],
                    ]);
                }
            }

            DB::commit();
            $this->dispatch('hideModal', id: 'vendorModal');
            $this->dispatch('alert', type: 'success', message: 'Vendor berhasil ditambahkan!');
            $this->resetFields();
        } catch (\Exception $e) {
            DB::rollBack();
            $this->dispatch('alert', type: 'error', message: 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function show($id)
    {
        abort_if(auth()->user()->level !== 1 && !auth()->user()->hasPermission('vendor.view'), 403);
        $this->loadVendor($id);
        $this->isShowOnly = true;
        $this->dispatch('showModal', id: 'vendorModal');
    }

    public function edit($id)
    {
        abort_if(auth()->user()->level !== 1 && !auth()->user()->hasPermission('vendor.edit'), 403);
        $this->loadVendor($id);
        $this->isEditing = true;

        // Ownership Check for sensitive fields
        $original = Vendor::find($id);
        $this->canEditMainData = (auth()->user()->level == 1 || auth()->id() == $original->id_user);

        $this->dispatch('showModal', id: 'vendorModal');
    }

    private function loadVendor($id)
    {
        $vendor = Vendor::with(['emails', 'bankAccounts'])->findOrFail($id);
        $this->id_vendor = $vendor->id_vendor;
        $this->vendor = $vendor->vendor;
        $this->npwp = $vendor->npwp ? decrypt_legacy($vendor->npwp) : '';
        $this->nik = $vendor->nik ? decrypt_legacy($vendor->nik) : '';
        $this->id_departement = $vendor->id_departement;
        $this->is_active = $vendor->is_active;

        $this->emails = $vendor->emails->map(function ($email) {
            $data = $email->toArray();
            $data['is_used'] = $email->isUsed();
            return $data;
        })->toArray();
        if (empty($this->emails)) $this->emails = [['email' => '', 'is_used' => false]];

        $this->bankAccounts = $vendor->bankAccounts->map(function ($bank) {
            $data = $bank->toArray();
            $data['is_used'] = $bank->isUsed();
            return $data;
        })->toArray();
        if (empty($this->bankAccounts)) $this->bankAccounts = [['nama_bank' => '', 'nama_penerima' => '', 'norek' => '', 'is_used' => false]];
    }

    public function update()
    {
        abort_if(auth()->user()->level !== 1 && !auth()->user()->hasPermission('vendor.edit'), 403);
        $this->validate([
            'vendor' => 'required|string|max:255',
            'npwp' => 'nullable|string|max:50',
            'nik' => 'nullable|string|max:50',
            'emails.*.email' => 'nullable|email',
        ]);

        // Manual uniqueness check for encrypted fields
        if ($this->npwp) {
            $encryptedNpwp = encrypt_legacy(trim($this->npwp));
            if (Vendor::where('npwp', $encryptedNpwp)->where('id_vendor', '!=', $this->id_vendor)->exists()) {
                $this->addError('npwp', 'NPWP sudah terdaftar pada vendor lain.');
                $this->dispatch('alert', type: 'error', message: 'NPWP sudah terdaftar pada vendor lain.');
                return;
            }
        }

        if ($this->nik) {
            $encryptedNik = encrypt_legacy(trim($this->nik));
            if (Vendor::where('nik', $encryptedNik)->where('id_vendor', '!=', $this->id_vendor)->exists()) {
                $this->addError('nik', 'NIK sudah terdaftar pada vendor lain.');
                $this->dispatch('alert', type: 'error', message: 'NIK sudah terdaftar pada vendor lain.');
                return;
            }
        }

        DB::beginTransaction();
        try {
            $vendor = Vendor::findOrFail($this->id_vendor);
            $canActivate = (auth()->user()->level == 1 || auth()->user()->hasPermission('vendor.activate'));

            $updateData = [];

            // Case 1: Edit Main Data (Owner/Admin)
            if (auth()->user()->level == 1 || auth()->id() == $vendor->id_user) {
                $updateData['vendor'] = $this->vendor;
                $updateData['npwp'] = $this->npwp ? encrypt_legacy($this->npwp) : null;
                $updateData['nik'] = $this->nik ? encrypt_legacy($this->nik) : null;
            }

            // Case 2: Edit Status (Authorized/Admin)
            if ($canActivate) {
                $updateData['is_active'] = $this->is_active;
            }

            if (!empty($updateData)) {
                $vendor->update($updateData);
            }

            // Sync Emails (Preserve IDs)
            $processedEmailIds = [];
            foreach ($this->emails as $emailData) {
                if (!empty($emailData['email'])) {
                    if (isset($emailData['id_email_vendor'])) {
                        VendorEmail::where('id_email_vendor', $emailData['id_email_vendor'])->update([
                            'email' => $emailData['email']
                        ]);
                        $processedEmailIds[] = $emailData['id_email_vendor'];
                    } else {
                        $newEmail = VendorEmail::create([
                            'id_vendor' => $vendor->id_vendor,
                            'email' => $emailData['email'],
                        ]);
                        $processedEmailIds[] = $newEmail->id_email_vendor;
                    }
                }
            }
            $vendor->emails()->whereNotIn('id_email_vendor', $processedEmailIds)->delete();

            // Sync Bank Accounts (Preserve IDs)
            $processedBankIds = [];
            foreach ($this->bankAccounts as $bankData) {
                if (!empty($bankData['norek'])) {
                    if (isset($bankData['id_norek_vendor'])) {
                        VendorBankAccount::where('id_norek_vendor', $bankData['id_norek_vendor'])->update([
                            'nama_bank' => $bankData['nama_bank'],
                            'nama_penerima' => $bankData['nama_penerima'],
                            'norek' => $bankData['norek'],
                        ]);
                        $processedBankIds[] = $bankData['id_norek_vendor'];
                    } else {
                        $newAcc = VendorBankAccount::create([
                            'id_vendor' => $vendor->id_vendor,
                            'nama_bank' => $bankData['nama_bank'],
                            'nama_penerima' => $bankData['nama_penerima'],
                            'norek' => $bankData['norek'],
                        ]);
                        $processedBankIds[] = $newAcc->id_norek_vendor;
                    }
                }
            }
            $vendor->bankAccounts()->whereNotIn('id_norek_vendor', $processedBankIds)->delete();

            DB::commit();
            $this->dispatch('hideModal', id: 'vendorModal');
            $this->dispatch('alert', type: 'success', message: 'Vendor berhasil diperbarui!');
            $this->resetFields();
        } catch (\Exception $e) {
            DB::rollBack();
            $this->dispatch('alert', type: 'error', message: 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function delete($id)
    {
        abort_if(auth()->user()->level !== 1 && !auth()->user()->hasPermission('vendor.delete'), 403);

        $vendor = Vendor::findOrFail($id);
        if (auth()->user()->level != 1 && auth()->id() != $vendor->id_user) {
            $this->dispatch('alert', [
                'type' => 'danger',
                'title' => 'Gagal',
                'message' => 'Hanya Admin atau Pembuat Vendor yang bisa menghapus.',
            ]);
            return;
        }

        // Check Relations
        if ($vendor->prs()->count() > 0) {
            $this->dispatch('alert', [
                'type' => 'danger',
                'title' => 'Gagal',
                'message' => 'Vendor tidak bisa dihapus karena masih terhubung dengan PR.',
            ]);
            return;
        }

        $vendor->delete();
        $this->dispatch('alert', [
            'type' => 'success',
            'title' => 'Dihapus',
            'message' => 'Vendor berhasil dihapus!',
        ]);
    }

    public function export()
    {
        abort_if(auth()->user()->level !== 1 && !auth()->user()->hasPermission('vendor.download'), 403);
        return Excel::download(new VendorsExport, 'Data_Vendor_' . date('Ymd_His') . '.xlsx');
    }

    // Download Template
    public function downloadTemplate()
    {
        if (auth()->user()->level !== 1 && !auth()->user()->hasPermission('vendor.download')) {
            $this->dispatch('alert', type: 'error', message: 'Anda tidak memiliki akses untuk download.');
            return;
        }

        $headers = ['vendor', 'npwp', 'nik', 'email', 'nama_bank', 'nama_penerima', 'norek'];
        $data = [
            ['Vendor ABC', '123456789', '987654321', 'contact@vendor.com', 'BCA', 'Owner Name', '0123456789']
        ];

        return Excel::download(new \App\Exports\GenericExport($headers, $data), 'template_vendor.xlsx');
    }

    // Import Excel
    public function import()
    {
        if (auth()->user()->level !== 1 && !auth()->user()->hasPermission('vendor.upload')) {
            $this->dispatch('alert', type: 'error', message: 'Anda tidak memiliki akses untuk upload.');
            return;
        }

        $this->validate([
            'file_excel' => 'required|mimes:xlsx,xls|max:5120',
        ]);

        try {
            Excel::import(new VendorsImport, $this->file_excel->getRealPath());
            $this->dispatch('hideModal', id: 'importModal');
            $this->dispatch('alert', type: 'success', message: 'Data vendor berhasil diimport!');
        } catch (\Exception $e) {
            $this->dispatch('alert', type: 'error', message: 'Gagal mengimport data: ' . $e->getMessage());
        }
    }

    public function render()
    {
        $query = Vendor::with(['departement', 'creator'])
            ->when($this->search, function ($q) {
                $q->where('vendor', 'like', '%' . $this->search . '%')
                    ->orWhere('id_vendor', 'like', '%' . $this->search . '%');
            })
            ->when($this->departmentFilter, function ($q) {
                $q->where('id_departement', $this->departmentFilter);
            });

        $vendors = $query->orderBy('created_at', 'desc')->paginate($this->perPage);

        return view('livewire.vendors.index', [
            'vendors' => $vendors,
            'departments' => Departement::orderBy('departement')->get(),
            'totalVendors' => Vendor::count(),
            'myVendors' => Vendor::where('id_user', auth()->id())->count(),
        ])->layout('layouts.app');
    }
}
