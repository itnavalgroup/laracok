# Dokumentasi Fitur: Reference Data Master (Lanjutan)

Dokumentasi ini mencakup 9 modul master data lanjutan:
**Position**, **Document Type**, **Currency**, **Cost Category**, **Cost Type**, **Attachment**, **Loan**, **Tax Type**, dan **Tax (Tarif Pajak)**.

Semua modul mengikuti pola umum yang sama: satu halaman index + modal CRUD + filter search + proteksi relasi hapus + auto-refresh `wire:poll.5s`.

---

## 1. Modul Position (Jabatan)

**Route**: `GET /positions` | **Navbar**: tampil jika `level === 1` atau `position.view`  
**Component**: `App\Livewire\Positions\Index`  
**View**: `resources/views/livewire/positions/index.blade.php`

### Deskripsi
Mengelola daftar jabatan/posisi karyawan. Digunakan sebagai referensi saat membuat atau mengedit data user.

### Field Modal

| Field | Required | Validasi |
|-------|----------|---------|
| Position Name | ✅ | `required|string|max:255|unique:tbl_position,position` (exclude self saat edit) |

### Tabel

| Kolom | Isi |
|-------|-----|
| # | Nomor urut |
| Position Name | Nama jabatan |
| Actions | Edit / Delete |

### Cek Relasi Hapus
- Ada User yang menggunakan jabatan ini → **tolak**: "Posisi ini tidak dapat dihapus karena masih ada user yang menggunakannya."

### Permission Summary

| Aksi | Permission Slug |
|------|----------------|
| Akses halaman | `position.view` |
| Tambah jabatan | `position.create` |
| Edit jabatan | `position.edit` |
| Hapus jabatan | `position.delete` |

---

## 2. Modul Document Type (Tipe Dokumen)

**Route**: `GET /doc-types` | **Navbar**: tampil jika `level === 1` atau `doc_type.view`  
**Component**: `App\Livewire\DocTypes\Index`  
**View**: `resources/views/livewire/doc-types/index.blade.php`

### Deskripsi
Mengelola jenis dokumen yang berlaku dalam sistem (contoh: Faktur, Kwitansi, Invoice, dsb.). Digunakan sebagai referensi pada transaksi PR dan SR.

### Field Modal

| Field | Required | Validasi |
|-------|----------|---------|
| Document Type Name | ✅ | `required|string|max:255|unique:tbl_doc_types,doc_type` (exclude self saat edit) |

### Tabel

| Kolom | Isi |
|-------|-----|
| # | Nomor urut |
| Document Type Name | Nama tipe dokumen |
| Actions | Edit / Delete |

### Cek Relasi Hapus
Tidak bisa dihapus jika sudah digunakan di: **PR** atau **SR**  
→ Pesan: "Tipe dokumen tidak dapat dihapus karena sudah digunakan dalam transaksi PR atau SR."

### Permission Summary

| Aksi | Permission Slug |
|------|----------------|
| Akses halaman | `doc_type.view` |
| Tambah tipe dokumen | `doc_type.create` |
| Edit tipe dokumen | `doc_type.edit` |
| Hapus tipe dokumen | `doc_type.delete` |

---

## 3. Modul Currency (Mata Uang)

**Route**: `GET /currencies` | **Navbar**: tampil jika `level === 1` atau `currency.view`  
**Component**: `App\Livewire\Currencies\Index`  
**View**: `resources/views/livewire/currencies/index.blade.php`

### Deskripsi
Mengelola daftar mata uang yang digunakan dalam transaksi PR. Setiap mata uang memiliki kode ISO (max 3 karakter) dan simbol.

### Field Modal

| Field | Required | Validasi | Keterangan |
|-------|----------|---------|-----------|
| Country | ✅ | `required|string|max:100` | Nama negara (contoh: Indonesia) |
| Code | ✅ | `required|string|max:3|unique:tbl_currency,code` | Kode ISO (contoh: IDR, USD) |
| Symbol | ✅ | `required|string|max:10` | Simbol mata uang (contoh: Rp, $) |

### Tabel

| Kolom | Isi |
|-------|-----|
| # | Nomor urut |
| Country | Nama negara |
| Code | Kode ISO |
| Symbol | Simbol mata uang |
| Actions | Edit / Delete |

### Search Filter
Cari berdasarkan `country`, `code`, atau `symbol`.

### Cek Relasi Hapus
- Digunakan di PR → **tolak**: "Mata uang tidak dapat dihapus karena masih digunakan pada data lain (Transaksi)."

### Permission Summary

| Aksi | Permission Slug |
|------|----------------|
| Akses halaman | `currency.view` |
| Tambah mata uang | `currency.create` |
| Edit mata uang | `currency.edit` |
| Hapus mata uang | `currency.delete` |

---

## 4. Modul Cost Category (Kategori Biaya)

**Route**: `GET /cost-categories` | **Navbar**: tampil jika `level === 1` atau `cost_category.view`  
**Component**: `App\Livewire\CostCategories\Index`  
**View**: `resources/views/livewire/cost-categories/index.blade.php`

### Deskripsi
Mengelola kategori biaya sebagai pengelompokan Cost Type. Contoh: Biaya Operasional, Biaya Produksi, dsb. Merupakan **parent** dari Cost Type dalam hierarki biaya.

> `id_user` pembuat/modifier otomatis disimpan setiap kali create/edit.

### Field Modal

| Field | Required | Validasi |
|-------|----------|---------|
| Cost Category Name | ✅ | `required|string|max:255|unique:tbl_cost_categories,cost_category` (exclude self saat edit) |

### Tabel

| Kolom | Isi |
|-------|-----|
| # | Nomor urut |
| Category Name | Nama kategori biaya |
| Actions | Edit / Delete |

### Hierarki Biaya
```
Cost Category (Parent)
    └── Cost Type (Child) → digunakan di PR
```

### Cek Relasi Hapus
- Ada Cost Type yang menggunakan kategori ini → **tolak**: "Kategori biaya tidak dapat dihapus karena sedang digunakan oleh Tipe Biaya."

### Permission Summary

| Aksi | Permission Slug |
|------|----------------|
| Akses halaman | `cost_category.view` |
| Tambah kategori | `cost_category.create` |
| Edit kategori | `cost_category.edit` |
| Hapus kategori | `cost_category.delete` |

---

## 5. Modul Cost Type (Tipe Biaya)

**Route**: `GET /cost-types` | **Navbar**: tampil jika `level === 1` atau `cost_type.view`  
**Component**: `App\Livewire\CostTypes\Index`  
**View**: `resources/views/livewire/cost-types/index.blade.php`

### Deskripsi
Mengelola jenis/tipe biaya yang bisa dipilih saat membuat PR. Setiap Cost Type wajib terhubung ke satu **Cost Category** dan dapat memiliki keterangan dokumen pendukung (`cost_document`).

> `id_user` pembuat/modifier otomatis disimpan setiap kali create/edit.

### Field Modal

| Field | Required | Validasi | Keterangan |
|-------|----------|---------|-----------|
| Cost Category | ✅ | `required|exists:tbl_cost_categories,id_cost_category` | Dropdown semua cost category |
| Cost Type Name | ✅ | `required|string|max:255|unique:tbl_cost_types,cost_type` (exclude self) | Nama tipe biaya |
| Cost Document | ❌ | `nullable|string` | Keterangan dokumen pendukung yang diperlukan |

### Tabel

| Kolom | Isi |
|-------|-----|
| # | Nomor urut |
| Cost Type Name | Nama tipe biaya |
| Category | Kategori biaya terkait |
| Cost Document | Dokumen pendukung |
| Actions | Edit / Delete |

### Search Filter
Cari berdasarkan nama cost type **atau** nama cost category (`whereHas`).

### Cek Relasi Hapus
- Digunakan di PR → **tolak**: "Tipe biaya tidak dapat dihapus karena sudah digunakan dalam transaksi."

### Permission Summary

| Aksi | Permission Slug |
|------|----------------|
| Akses halaman | `cost_type.view` |
| Tambah tipe biaya | `cost_type.create` |
| Edit tipe biaya | `cost_type.edit` |
| Hapus tipe biaya | `cost_type.delete` |

---

## 6. Modul Attachment (Jenis Lampiran)

**Route**: `GET /attachments` | **Navbar**: tampil jika `level === 1` atau `attachment.view`  
**Component**: `App\Livewire\Attachments\Index`  
**View**: `resources/views/livewire/attachments/index.blade.php`

### Deskripsi
Mengelola jenis/tipe lampiran dokumen yang digunakan saat membuat PR, SR, dan Payment (contoh: KTP, NPWP, SIUP, Kontrak). Modul ini lebih lengkap dari modul master lainnya karena mendukung **Import Excel** dan **Export Excel**.

### Filter Tabel

| Filter | Binding | Keterangan |
|--------|---------|-----------|
| Search | `wire:model.live="search"` | Cari berdasarkan nama lampiran |
| Department | `wire:model.live="departmentFilter"` | Filter berdasarkan departemen |
| Per Page | `wire:model.live="perPage"` | Pilihan: 10, 25, 50 |

Ketiga filter juga tersimpan di **query string URL**.

### Field Modal

| Field | Required | Validasi | Keterangan |
|-------|----------|---------|-----------|
| Attachment Name | ✅ | `required|string|max:255` | Nama jenis lampiran |
| Department | ✅ | `required|integer` | Dropdown departemen. Default: departemen user sendiri (non-Admin) atau 0 (Admin / Global) |

> `id_user` pembuat otomatis disimpan saat create/edit.

> **Default Departemen**: Saat `resetForm()`, Admin (`level === 1`) mendapat `id_departement = 0` (Global), non-Admin mendapat departemen sendiri.

### Tabel

| Kolom | Isi |
|-------|-----|
| # | Nomor urut |
| Attachment Name | Nama jenis lampiran |
| Department | Departemen terkait (atau "Global") |
| Creator | Pembuat lampiran |
| Actions | Edit / Delete |

### Fitur Tambahan: Import Excel

| Aspek | Detail |
|-------|--------|
| Permission | `attachment.upload` |
| Download template | `downloadTemplate()` — file: `template_import_attachment.xlsx`, kolom: `attachment_name` |
| Upload | File `.xlsx`/`.xls`, max 5MB |
| Logika import | `updateOrCreate` berdasarkan nama + departemen (tidak duplikasi) |
| Skip header | Baris pertama (index 0) dilewati |

### Fitur Tambahan: Export Excel

| Aspek | Detail |
|-------|--------|
| Permission | `attachment.download` |
| Method | `export()` |
| Scope export | Mengikuti filter `departmentFilter` aktif |
| Nama file | `Data_Lampiran_YYYYMMDD_HHMMSS.xlsx` |
| Kolom output | ID, Nama Lampiran, Departement, Dibuat Oleh, Tgl Dibuat |

### Cek Relasi Hapus (3 tabel pivot)
Menggunakan `DB::table()` langsung:
- `tbl_attachment_pr` → PR
- `tbl_attachment_sr` → SR
- `tbl_attachment_payment` → Payment

→ Pesan: "Lampiran tidak dapat dihapus karena masih digunakan dalam dokumen transaksi."

### Permission Summary

| Aksi | Permission Slug |
|------|----------------|
| Akses halaman | `attachment.view` |
| Tambah lampiran | `attachment.create` |
| Edit lampiran | `attachment.edit` |
| Hapus lampiran | `attachment.delete` |
| Import dari Excel | `attachment.upload` |
| Download template | `attachment.upload` |
| Export ke Excel | `attachment.download` |

---

## 7. Modul Loan (Pinjaman / Sumber Dana)

**Route**: `GET /loans` | **Navbar**: tampil jika `level === 1` atau `loan.view`  
**Component**: `App\Livewire\Loans\Index`  
**View**: `resources/views/livewire/loans/index.blade.php`

### Deskripsi
Mengelola daftar sumber dana / jenis pinjaman yang bisa dipilih saat membuat PR atau SR (contoh: Dana Kas, Kredit Bank, Pinjaman Internal). Setiap loan mencatat pembuat (`id_user`).

### Field Modal

| Field | Required | Validasi |
|-------|----------|---------|
| Loan Name | ✅ | `required|string|max:255|unique:tbl_loans,loan` (exclude self saat edit) |

### Tabel

| Kolom | Isi |
|-------|-----|
| # | Nomor urut |
| Loan Name | Nama sumber dana |
| Creator | Pembuat data |
| Actions | Edit / Delete |

### Cek Relasi Hapus
Tidak bisa dihapus jika digunakan di: **PR** atau **SR**  
→ Pesan: "Loan tidak dapat dihapus karena sudah digunakan dalam transaksi PR atau SR."

### Permission Summary

| Aksi | Permission Slug |
|------|----------------|
| Akses halaman | `loan.view` |
| Tambah loan | `loan.create` |
| Edit loan | `loan.edit` |
| Hapus loan | `loan.delete` |

---

## 8. Modul Tax Type (Jenis Pajak)

**Route**: `GET /tax-types` | **Navbar**: tampil jika `level === 1` atau `tax.view`  
**Component**: `App\Livewire\TaxTypes\Index`  
**View**: `resources/views/livewire/tax-types/index.blade.php`

### Deskripsi
Mengelola jenis/kategori pajak sebagai **parent** dari Tax (tarif pajak). Contoh: PPN, PPh 21, PPh 23. Setiap Tax Type memiliki nama dan deskripsi.

> **Catatan Permission**: `mount()`, `create()`, `edit()`, `save()`, dan `delete()` semuanya menggunakan permission slug **`tax.view`**, **`tax.create`**, **`tax.edit`**, **`tax.delete`** — sama dengan modul Tax. Artinya satu set permission mengontrol kedua modul Tax Type dan Tax.

### Field Modal

| Field | Required | Validasi |
|-------|----------|---------|
| Tax Type Name | ✅ | `required|string|max:100` |
| Description | ✅ | `required|string` |

### Tabel

| Kolom | Isi |
|-------|-----|
| # | Nomor urut |
| Tax Type Name | Nama jenis pajak |
| Description | Deskripsi jenis pajak |
| Actions | Edit / Delete |

### Search Filter
Cari berdasarkan `tax_type` atau `tax_type_description`.

### Hierarki Pajak
```
Tax Type (Jenis Pajak — Parent)
    └── Tax (Tarif Pajak — Child) → digunakan di PR / SR
```

### Cek Relasi Hapus
- Ada Tax (tarif) yang menggunakan jenis ini → **tolak**: "Jenis pajak tidak dapat dihapus karena masih digunakan oleh data tarif pajak."

### Permission Summary

| Aksi | Permission Slug |
|------|----------------|
| Akses halaman | `tax.view` |
| Tambah jenis pajak | `tax.create` |
| Edit jenis pajak | `tax.edit` |
| Hapus jenis pajak | `tax.delete` |

---

## 9. Modul Tax (Tarif Pajak)

**Route**: `GET /taxes` | **Navbar**: tampil jika `level === 1` atau `tax.view`  
**Component**: `App\Livewire\Taxes\Index`  
**View**: `resources/views/livewire/taxes/index.blade.php`

### Deskripsi
Mengelola tarif pajak spesifik yang bisa dipilih pada detail transaksi PR dan SR. Setiap tarif terhubung ke **Tax Type** dan menyimpan persentase pajak. Sistem menyimpan nilai dalam format desimal (misal: `0.11` untuk 11%), tetapi form menampilkan nilai dalam persen (11%) dengan konversi otomatis.

### Field Modal

| Field | Required | Validasi | Keterangan |
|-------|----------|---------|-----------|
| Tax Type | ✅ | `required|exists:tbl_tax_types,id_tax_type` | Dropdown semua Tax Type |
| Tax Name | ✅ | `required|string|max:100` | Contoh: PPN 11%, PPh 23 2% |
| Tax Percentage | ✅ | `required|numeric|min:0|max:100` | Diinput dalam persen (11), disimpan desimal (0.11) |
| Description | ✅ | `required|string` | Keterangan tarif pajak |
| Status | ✅ | `required|integer` | Aktif/Tidak aktif |

> **Konversi otomatis**:
> - Saat **load** untuk edit: `tax_persen * 100` (0.11 → 11)
> - Saat **save**: `floatval(tax_persen) / 100` (11 → 0.11)

### Tabel

| Kolom | Isi |
|-------|-----|
| # | Nomor urut |
| Tax Name | Nama tarif pajak |
| Tax Type | Jenis pajak terkait |
| Percentage | Persentase pajak |
| Description | Deskripsi tarif |
| Status | Aktif / Tidak aktif |
| Actions | Edit / Delete |

### Search Filter
Cari berdasarkan `tax` (nama), `tax_description`, atau nama `tax_type` (via `whereHas`).

### Cek Relasi Hapus
Menggunakan `DB::table()` langsung untuk mengecek kolom `id_tax1` di:
- `tbl_detail_pr`
- `tbl_detail_sr`

→ Pesan: "Tarif pajak tidak dapat dihapus karena masih terhubung dengan transaksi PR atau SR."

### Permission Summary

| Aksi | Permission Slug |
|------|----------------|
| Akses halaman | `tax.view` |
| Tambah tarif pajak | `tax.create` |
| Edit tarif pajak | `tax.edit` |
| Hapus tarif pajak | `tax.delete` |

---

## Ringkasan Permission Master Data Lanjutan

| Modul | View | Create | Edit | Delete | Extra |
|-------|------|--------|------|--------|-------|
| Position | `position.view` | `position.create` | `position.edit` | `position.delete` | — |
| Document Type | `doc_type.view` | `doc_type.create` | `doc_type.edit` | `doc_type.delete` | — |
| Currency | `currency.view` | `currency.create` | `currency.edit` | `currency.delete` | — |
| Cost Category | `cost_category.view` | `cost_category.create` | `cost_category.edit` | `cost_category.delete` | — |
| Cost Type | `cost_type.view` | `cost_type.create` | `cost_type.edit` | `cost_type.delete` | — |
| Attachment | `attachment.view` | `attachment.create` | `attachment.edit` | `attachment.delete` | `attachment.upload`, `attachment.download` |
| Loan | `loan.view` | `loan.create` | `loan.edit` | `loan.delete` | — |
| Tax Type | `tax.view` | `tax.create` | `tax.edit` | `tax.delete` | — |
| Tax | `tax.view` | `tax.create` | `tax.edit` | `tax.delete` | — |

> ⚠️ **Tax Type dan Tax berbagi permission yang sama** (`tax.*`). Satu set permission mengontrol akses ke kedua modul sekaligus.

> ✅ Semua modul di atas dapat diakses sepenuhnya oleh **`level === 1` (Super Admin)** tanpa perlu permission eksplisit.

---

## Ringkasan Cek Relasi Hapus

| Modul | Tabel/Relasi yang Dicek |
|-------|------------------------|
| Position | `tbl_user` (User) |
| Document Type | `tbl_pr` (PR), `tbl_sr` (SR) |
| Currency | `tbl_pr` (PR) |
| Cost Category | `tbl_cost_types` (CostType) |
| Cost Type | `tbl_pr` (PR) |
| Attachment | `tbl_attachment_pr`, `tbl_attachment_sr`, `tbl_attachment_payment` |
| Loan | `tbl_pr` (PR), `tbl_sr` (SR) |
| Tax Type | `tbl_taxes` (Tax children) |
| Tax | `tbl_detail_pr.id_tax1`, `tbl_detail_sr.id_tax1` |

---

## Akses via Navbar

| Modul | Tampil di Navbar Jika |
|-------|----------------------|
| Position | `level === 1` atau `position.view` |
| Document Type | `level === 1` atau `doc_type.view` |
| Currency | `level === 1` atau `currency.view` |
| Cost Category | `level === 1` atau `cost_category.view` |
| Cost Type | `level === 1` atau `cost_type.view` |
| Attachment | `level === 1` atau `attachment.view` |
| Loan | `level === 1` atau `loan.view` |
| Tax Type | `level === 1` atau `tax.view` |
| Tax | `level === 1` atau `tax.view` |

---

*Dokumentasi dibuat dari: `app/Livewire/Positions/`, `app/Livewire/DocTypes/`, `app/Livewire/Currencies/`, `app/Livewire/CostCategories/`, `app/Livewire/CostTypes/`, `app/Livewire/Attachments/`, `app/Livewire/Loans/`, `app/Livewire/TaxTypes/`, `app/Livewire/Taxes/Index.php`*  
*Terakhir diperbarui: 23 Maret 2026*
