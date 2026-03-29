# Dokumentasi Fitur: Vendor Management

**Modul**: Vendors  
**File Utama**:
- View: `resources/views/livewire/vendors/index.blade.php`
- Livewire Component: `app/Livewire/Vendors/Index.php`
- Route: `routes/web.php` → `GET /vendors` (name: `vendors.index`)
- Navbar: Tampil jika `level === 1` atau permission `vendor.view`

---

## 1. Deskripsi Umum

Modul Vendor Management digunakan untuk mengelola data mitra/vendor perusahaan. Fitur mencakup CRUD vendor lengkap dengan email kontak dan rekening bank, serta kemampuan **Import/Export Excel**. Semua operasi dilakukan melalui **modal tunggal** (`#vendorModal`) yang bersifat dinamis (Create / Edit / View). Data di-refresh otomatis setiap **5 detik** (`wire:poll.5s`).

---

## 2. Route & Akses

| Method | URI | Name | Middleware |
|--------|-----|------|------------|
| `GET` | `/vendors` | `vendors.index` | `auth` |

**Akses Halaman (mount)**: `abort(403)` jika user tidak memiliki `level === 1` **dan** tidak memiliki permission `vendor.view`.

---

## 3. Summary Cards

| Kartu | Warna | Isi |
|-------|-------|-----|
| Total Vendors | Biru | Total semua vendor di sistem |
| My Vendors | Hijau | Vendor yang dibuat oleh user saat ini (`id_user = auth()->id()`) |

---

## 4. Filter & Pencarian

| Filter | Binding | Keterangan |
|--------|---------|-----------|
| Search | `wire:model.live.debounce.300ms="search"` | Cari berdasarkan nama vendor atau ID vendor |
| Department | `wire:model.live="departmentFilter"` | Filter berdasarkan departemen vendor |
| Per Page | `wire:model.live="perPage"` | Pilihan: 10, 25, 50 |

> Saat search berubah → halaman di-reset ke 1 (`updatingSearch()`).

---

## 5. Tabel Vendor

### Kolom Tabel

| Kolom | Isi |
|-------|-----|
| ID | ID Vendor (#nomor) |
| Vendor Name | Nama vendor + tanggal dibuat |
| Department | Departemen pemilik vendor (atau "Global" jika Admin yang buat) |
| Creator | Inisial + nama pembuat vendor |
| Status | Badge: **Active** (hijau) / **Inactive** (kuning) / **Deleted** (merah, soft-delete) |
| Actions | Tombol View / Edit / Delete |

### Tombol Aksi di Tabel

| Tombol | Icon | Permission | Aksi |
|--------|------|-----------|------|
| View (👁️) | `ti-eye` | `vendor.view` (semua yang bisa akses halaman) | Buka modal detail (read-only) |
| Edit (✏️) | `ti-edit` | `level === 1` atau `vendor.edit` | Buka modal edit |
| Delete (🗑️) | `ti-trash` | `level === 1` atau `vendor.delete` | Dialog konfirmasi → `delete($id)` |

---

## 6. Tombol Header (Action Bar)

| Tombol | Permission | Aksi |
|--------|-----------|------|
| Export | `level === 1` atau `vendor.download` | `wire:click="export"` → download Excel `Data_Vendor_YYYYMMDD_HHMMSS.xlsx` |
| Import | `level === 1` atau `vendor.upload` | Buka modal `#importModal` |
| Add Vendor | `level === 1` atau `vendor.create` | `wire:click="create"` → buka modal tambah vendor |

---

## 7. Modal Vendor (`#vendorModal`)

Modal ini digunakan untuk **3 mode**: Create, Edit, dan View. Judul dan perilaku berubah sesuai state.

| State | Judul Modal | Form |
|-------|-------------|------|
| `$isShowOnly = true` | "Vendor Details" | Semua field disabled (read-only) |
| `$isEditing = true` | "Edit Vendor" | Field aktif tergantung permission |
| Default | "Add New Vendor" | Semua field aktif |

### 7.1 Section: Basic Information

| Field | Required | Disabled Jika | Keterangan |
|-------|----------|--------------|-----------|
| Vendor Name | ✅ | Show-only | Nama resmi vendor |
| NPWP | ❌ | Show-only atau `!canEditMainData` | Disimpan terenkripsi. Hanya Admin/Creator yang bisa edit |
| NIK | ❌ | Show-only atau `!canEditMainData` | Disimpan terenkripsi. Hanya Admin/Creator yang bisa edit |
| Status (Toggle Active) | — | Show-only atau `!vendor.activate` | Vendor Inactive tidak bisa digunakan di transaksi baru |

> **`canEditMainData`**: `true` jika `level === 1` ATAU user adalah creator vendor tersebut (`auth()->id() == vendor->id_user`).

### 7.2 Section: Contact Emails

| Elemen | Kondisi Tampil | Aksi |
|--------|---------------|------|
| Add Email | `!isShowOnly` | `wire:click="addEmail"` — tambah baris email baru |
| Input email | Aktif | `wire:model="emails.{i}.email"` |
| 🗑️ Hapus email | `!isShowOnly` dan tidak `is_used` dan minimal 2 email | `wire:click="removeEmail($i)"` |
| 🔒 Ikon gembok | `is_used = true` | Email dipakai di transaksi → tidak bisa dihapus/diubah |

### 7.3 Section: Bank Accounts

| Elemen | Kondisi Tampil | Aksi |
|--------|---------------|------|
| Add Account | `!isShowOnly` | `wire:click="addBankAccount"` — tambah rekening baru |
| Input Bank Name, Holder, Account No. | Aktif | Binding ke `bankAccounts.{i}.*` |
| 🗑️ Hapus rekening | `!isShowOnly` dan tidak `is_used` | `wire:click="removeBankAccount($i)"` |
| 🔒 Ikon gembok pada label | `is_used = true` | Rekening dipakai di transaksi → locked |

### 7.4 Tombol Footer Modal

| Tombol | Kondisi | Aksi |
|--------|---------|------|
| Close / Cancel | Selalu | `data-bs-dismiss="modal"` + `wire:click="resetFields"` |
| Save Vendor | `!isShowOnly` dan mode Create | `wire:click="store"` |
| Update Data | `!isShowOnly` dan mode Edit | `wire:click="update"` |

---

## 8. Flow Proses

### 8.1 Tambah Vendor Baru

```
[Klik "Add Vendor"]
        │ Cek permission: vendor.create
        ▼
[resetFields() → Modal #vendorModal terbuka (mode Create)]
        │
[Isi: Nama, NPWP, NIK, Status, Email(s), Rekening]
        │
[Klik "Save Vendor" → store()]
        │
        ▼
[Validasi:]
   - vendor: required, max 255
   - npwp: nullable
   - nik: nullable
   - emails.*.email: nullable|email
   - bankAccounts.*.norek: nullable
        │
[Cek uniqueness NPWP (jika diisi) → cegah duplikasi]
[Cek uniqueness NIK (jika diisi) → cegah duplikasi]
        │
[DB Transaction:]
   1. Insert tbl_vendor
      - id_departement: null (Admin) atau departemen user (non-Admin)
      - id_user: auth user (pembuat)
   2. Insert tbl_email_vendor (untuk tiap email tidak kosong)
   3. Insert tbl_norek_vendor (untuk tiap rekening tidak kosong)
        │
   Sukses → hideModal + alert sukses + resetFields
   Gagal  → rollback + alert error
```

### 8.2 Edit Vendor

```
[Klik ✏️ Edit]
        │ Cek permission: vendor.edit
        ▼
[loadVendor($id):
   - Decrypt NPWP & NIK
   - Load emails + flag is_used (dari isUsed())
   - Load bank accounts + flag is_used]
[Cek canEditMainData: level === 1 OR creator?]
        │
[Modal #vendorModal terbuka (mode Edit)]
        │
[Edit data → update()]
        │
        ▼
[Validasi (sama dengan store, tapi NPWP/NIK exclude ID sendiri)]
        │
[Update berdasarkan permission:]
   Case 1 (Admin/Creator): Update nama, NPWP, NIK (re-encrypted)
   Case 2 (canActivate): Update is_active
[Sync Emails: update existing, insert new, delete removed (kecuali is_used)]
[Sync Bank Accounts: update existing, insert new, delete removed (kecuali is_used)]
        │
   Sukses → hideModal + alert sukses
```

### 8.3 Hapus Vendor

```
[Klik 🗑️ → Dialog konfirmasi]
        │ Klik "Ya, Hapus"
        ▼
[delete($id)]
   Cek permission: vendor.delete
   Cek ownership: level === 1 OR pembuat vendor
   Cek relasi: ada PR terhubung? → tolak hapus
        │
   Aman → vendor->delete() (soft delete jika pakai SoftDeletes)
   Alert sukses
```

---

## 9. Import Vendor dari Excel (`#importModal`)

### Flow Import

```
[Klik "Import" → Modal #importModal terbuka]
        │
[Download Template (opsional)]
   wire:click="downloadTemplate"
   Permission: vendor.download
   Output: template_vendor.xlsx
   Kolom: vendor, npwp, nik, email, nama_bank, nama_penerima, norek
        │
[Upload file .xlsx atau .xls (max 5MB)]
   wire:model="file_excel"
        │
[Klik "Upload & Import" → import()]
   Permission: vendor.upload
   Validasi: file required, mimes xlsx/xls, max 5120KB
   Proses: Excel::import(VendorsImport, file)
        │
   Sukses → hideModal + alert sukses
   Gagal  → alert error
```

### Template File Excel

| Kolom | Keterangan |
|-------|-----------|
| `vendor` | Nama vendor |
| `npwp` | NPWP (plaintext, akan disimpan terenkripsi) |
| `nik` | NIK (plaintext, akan disimpan terenkripsi) |
| `email` | Email kontak |
| `nama_bank` | Nama bank |
| `nama_penerima` | Nama pemilik rekening |
| `norek` | Nomor rekening |

---

## 10. Export Vendor ke Excel

- **Permission**: `level === 1` atau `vendor.download`
- **Method**: `export()` → `Excel::download(VendorsExport)`
- **Nama file**: `Data_Vendor_YYYYMMDD_HHMMSS.xlsx`

---

## 11. Validasi & Error

### Validasi Server-side

| Field | Rule | Error |
|-------|------|-------|
| `vendor` | `required|string|max:255` | "The vendor field is required." |
| `npwp` | `nullable|string|max:50` | — |
| `nik` | `nullable|string|max:50` | — |
| `emails.*.email` | `nullable|email` | "Email tidak valid." |
| `bankAccounts.*.norek` | `nullable|string` | — |
| `file_excel` (import) | `required|mimes:xlsx,xls|max:5120` | — |

### Error Bisnis

| Kondisi | Pesan |
|---------|-------|
| NPWP sudah terdaftar di vendor lain | "NPWP sudah terdaftar." |
| NIK sudah terdaftar di vendor lain | "NIK sudah terdaftar." |
| Hapus email yang `is_used` | "Email tidak bisa dihapus karena sudah digunakan dalam transaksi." |
| Hapus rekening yang `is_used` | "Rekening tidak bisa dihapus karena sudah digunakan dalam transaksi." |
| Hapus vendor yang terhubung ke PR | "Vendor tidak bisa dihapus karena masih terhubung dengan PR." |
| Delete oleh bukan Admin dan bukan creator | "Hanya Admin atau Pembuat Vendor yang bisa menghapus." |

---

## 12. Logic Khusus

### Departemen Vendor
- **Admin (level 1)**: `id_departement = null` → vendor bersifat **Global** (bisa dipakai semua departemen)
- **Non-Admin**: `id_departement = departemen user` → vendor terikat ke departemen pembuat

### Enkripsi Data Sensitif
| Data | Enkripsi |
|------|---------|
| NPWP | `encrypt_legacy()` saat simpan, `decrypt_legacy()` saat load |
| NIK | `encrypt_legacy()` saat simpan, `decrypt_legacy()` saat load |

Uniqueness check dilakukan secara **manual** dengan membandingkan nilai terenkripsi di database karena Laravel tidak bisa langsung query kolom terenkripsi.

### `is_used` Detection (Email & Rekening)
- Email dideteksi via method `isUsed()` di model `VendorEmail`
- Rekening dideteksi via method `isUsed()` di model `VendorBankAccount`
- Jika `is_used = true` → field menjadi disabled di modal, tombol hapus disembunyikan

---

## 13. Livewire Component: `App\Livewire\Vendors\Index`

### Properties

| Property | Default | Keterangan |
|----------|---------|-----------|
| `$search` | `''` | Kata kunci pencarian |
| `$departmentFilter` | `''` | Filter departemen |
| `$perPage` | `10` | Record per halaman |
| `$id_vendor` | null | ID vendor yang sedang aktif di modal |
| `$vendor` | — | Nama vendor |
| `$npwp` | — | NPWP (plaintext) |
| `$nik` | — | NIK (plaintext) |
| `$id_departement` | null | Departemen vendor |
| `$is_active` | `true` | Status aktif |
| `$emails` | `[]` | Array email vendor |
| `$bankAccounts` | `[]` | Array rekening bank |
| `$file_excel` | null | File upload untuk import |
| `$isEditing` | `false` | Mode edit aktif |
| `$isShowOnly` | `false` | Mode view-only aktif |
| `$canEditMainData` | `true` | Boleh edit nama/NPWP/NIK |

### Methods

| Method | Permission | Deskripsi |
|--------|-----------|-----------|
| `mount()` | `vendor.view` | Guard akses halaman |
| `resetFields()` | — | Reset semua field + state modal |
| `addEmail()` | — | Tambah baris email kosong |
| `removeEmail($i)` | — | Hapus email (jika tidak is_used) |
| `addBankAccount()` | — | Tambah rekening kosong |
| `removeBankAccount($i)` | — | Hapus rekening (jika tidak is_used) |
| `create()` | `vendor.create` | Reset fields + buka modal create |
| `store()` | `vendor.create` | Validasi + simpan vendor baru |
| `show($id)` | `vendor.view` | Load data + buka modal view-only |
| `edit($id)` | `vendor.edit` | Load data + set canEditMainData + buka modal edit |
| `update()` | `vendor.edit` | Validasi + update vendor |
| `delete($id)` | `vendor.delete` | Cek relasi + hapus vendor |
| `export()` | `vendor.download` | Download Excel semua vendor |
| `downloadTemplate()` | `vendor.download` | Download template Excel untuk import |
| `import()` | `vendor.upload` | Validasi + proses import Excel |
| `render()` | — | Query vendor dengan filter, kirim ke view |

### Events

| Event | Kapan | Data |
|-------|-------|------|
| `showModal` | Saat buka modal | `{id: 'vendorModal'}` |
| `hideModal` | Setelah store/update/import | `{id: 'vendorModal'}` atau `{id: 'importModal'}` |
| `alert` | Setelah setiap aksi | `type: 'success'/'error'`, `message: '...'` |

---

## 14. Permission Summary

| Aksi | Level 1 | Permission |
|------|---------|-----------|
| Akses halaman `/vendors` | ✅ | `vendor.view` |
| Melihat detail vendor | ✅ | `vendor.view` |
| Tambah vendor baru | ✅ | `vendor.create` |
| Edit vendor | ✅ | `vendor.edit` |
| Edit NPWP & NIK (data sensitif) | ✅ | Creator vendor (ownership) |
| Ubah status Active/Inactive | ✅ | `vendor.activate` |
| Hapus vendor | ✅ | `vendor.delete` + harus Admin atau Creator |
| Export ke Excel | ✅ | `vendor.download` |
| Download template import | ✅ | `vendor.download` |
| Import dari Excel | ✅ | `vendor.upload` |

---

*Dokumentasi dibuat dari: `app/Livewire/Vendors/Index.php`, `resources/views/livewire/vendors/index.blade.php`*  
*Terakhir diperbarui: 23 Maret 2026*
