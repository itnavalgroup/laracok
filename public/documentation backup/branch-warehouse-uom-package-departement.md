# Dokumentasi Fitur: Reference Data Master

Dokumentasi ini mencakup 5 modul master data yang bersifat referensial:
**Branch**, **Warehouse**, **UOM (Unit of Measure)**, **Package (Kemasan)**, dan **Departement**.

Semua modul ini memiliki pola yang **identik**: satu halaman index dengan tabel, modal CRUD, filter, dan proteksi relasi sebelum hapus. Data di-refresh otomatis setiap **5 detik** (`wire:poll.5s`).

---

## Pola Umum Semua Modul Reference Data

| Aspek | Detail |
|-------|--------|
| Tampilan | 1 halaman index + 1 modal (Create/Edit) |
| Filter | Search (live) + Per Page selector |
| Auto-refresh | `wire:poll.5s` |
| Query String | `search` dan `perPage` tersimpan di URL |
| Permission approach | `abort(403)` jika tidak punya akses |
| Modal trigger | Livewire dispatch event → JS `bootstrap.Modal` |

---

## 1. Modul Branch (Cabang)

**Route**: `GET /branches` | **Navbar**: tampil jika `level === 1` atau `branch.view`  
**Component**: `App\Livewire\Branches\Index`  
**View**: `resources/views/livewire/branches/index.blade.php`

### Deskripsi
Mengelola data lokasi fisik/cabang perusahaan. Digunakan sebagai referensi pada data User.

### Summary Card
| Kartu | Isi |
|-------|-----|
| Total Branches (biru) | Count semua branch |
| Header dengan tombol Add Branch | (di kartu kanan) |

### Tabel
| Kolom | Isi |
|-------|-----|
| # | Nomor urut |
| Branch Name | Nama cabang |
| Address | Alamat lengkap cabang |
| Actions | Edit / Delete |

### Field Modal

| Field | Required | Validasi |
|-------|----------|---------|
| Branch Name | ✅ | `required|max:255|unique:tbl_branch,branch` (exclude self saat edit) |
| Address | ✅ | `required|string` (textarea) |

### Relasi Cek Hapus
- Ada User yang terdaftar di branch ini → **tolak**: "Cabang ini tidak dapat dihapus karena masih memiliki User yang terdaftar."

### Permission
| Aksi | Permission |
|------|-----------|
| View | `branch.view` |
| Create | `branch.create` |
| Edit | `branch.edit` |
| Delete | `branch.delete` |

---

## 2. Modul Warehouse (Gudang)

**Route**: `GET /warehouses` | **Navbar**: tampil jika `level === 1` atau `warehouse.view`  
**Component**: `App\Livewire\Warehouses\Index`  
**View**: `resources/views/livewire/warehouses/index.blade.php`

### Deskripsi
Mengelola data lokasi gudang/penyimpanan. Digunakan pada User, PR, SR, IKB, dan Item Transaction.

### Summary Card
| Kartu | Isi |
|-------|-----|
| Total Warehouses (biru) | Count semua warehouse |
| Header + tombol Add Warehouse | (di kartu kanan) |

### Tabel
| Kolom | Isi |
|-------|-----|
| # | Nomor urut |
| Warehouse Name | Nama gudang (bold biru) |
| Address | Alamat gudang |
| Status | Badge **ACTIVE** (hijau) / **INACTIVE** (merah) |
| Actions | Edit / Delete |

### Field Modal

| Field | Required | Validasi | Keterangan |
|-------|----------|---------|-----------|
| Warehouse Name | ✅ | `required|max:255|unique:tbl_warehouse,warehouse_name` | |
| Address | ❌ | `nullable|max:500` | Textarea |
| Status | ✅ | `required|in:0,1` | Radio: Active / Inactive |

> Saat create, `id_user` (pembuat) otomatis disimpan ke `tbl_warehouse`.

### Relasi Cek Hapus (7 pengecekan)
Tidak bisa dihapus jika terhubung ke: **User**, **PR**, **SR**, **IKB**, **ItemTransaction**, **SrItemTransaction**, **PrItemTransaction**  
→ Pesan: "Gudang tidak dapat dihapus karena masih digunakan pada data lain."

### Permission
| Aksi | Permission |
|------|-----------|
| View | `warehouse.view` |
| Create | `warehouse.create` |
| Edit | `warehouse.edit` |
| Delete | `warehouse.delete` |

---

## 3. Modul UOM (Unit of Measure)

**Route**: `GET /uoms` | **Navbar**: tampil jika `level === 1` atau `uom.view`  
**Component**: `App\Livewire\Uoms\Index`  
**View**: `resources/views/livewire/uoms/index.blade.php`

### Deskripsi
Mengelola satuan ukuran (misal: PCS, BOX, KG, LITER). Setiap UOM bisa memiliki **konversi berat ke kilogram** (`qty_kg`) untuk keperluan logistik dan IKB.

### Summary Card
| Kartu | Isi |
|-------|-----|
| Total UOMs (biru) | Count semua UOM |

### Tabel
| Kolom | Isi |
|-------|-----|
| # | Nomor urut |
| UOM Name | Nama satuan (bold uppercase) |
| Netto (KG) | Bobot dalam KG jika diisi (badge biru), atau `-` |
| Actions | Edit / Delete |

### Field Modal

| Field | Required | Validasi | Keterangan |
|-------|----------|---------|-----------|
| UOM Name | ✅ | `required|max:255|unique:tbl_uoms,uom` | Contoh: PCS, BOX, KG |
| Netto (KG) | ❌ | `nullable|numeric` | Bisa dikosongkan jika tidak ada konversi KG |

### Relasi Cek Hapus (5 pengecekan)
Tidak bisa dihapus jika dipakai di: **SrDetail**, **IkbDetail**, **ItemTransaction**, **SrItemTransaction**, **PrItemTransaction**  
→ Pesan: "UOM ini tidak dapat dihapus karena sudah digunakan pada data transaksi."

### Search Filter
Cari berdasarkan nama UOM saja (`uom LIKE %search%`).

### Permission
| Aksi | Permission |
|------|-----------|
| View | `uom.view` |
| Create | `uom.create` |
| Edit | `uom.edit` |
| Delete | `uom.delete` |

---

## 4. Modul Package (Kemasan)

**Route**: `GET /packages` | **Navbar**: tampil jika `level === 1` atau `package.view`  
**Component**: `App\Livewire\Packages\Index`  
**View**: `resources/views/livewire/packages/index.blade.php`

### Deskripsi
Mengelola jenis kemasan barang (misal: Karton, Plastik, Botol). Setiap package **terhubung ke satu departemen** yang bertanggung jawab. Digunakan pada Item Transaction, SR, PR, dan IKB.

### Field Modal

| Field | Required | Validasi | Keterangan |
|-------|----------|---------|-----------|
| Package Name | ✅ | `required|max:255|unique:tbl_packagings,packaging` | |
| Department | ✅ | `required|exists:tbl_departement,id_departement` | Dropdown semua departemen |

> Saat **Create**, `id_departement` otomatis diisi dengan departemen user yang login sebagai default.  
> Saat **Save**, `id_user` (pembuat/modifier terakhir) selalu disimpan.

### Tabel (berdasarkan view yang dirender)
| Kolom | Isi |
|-------|-----|
| # | Nomor urut |
| Package Name | Nama kemasan |
| Department | Departemen terkait |
| Creator | Pembuat/modifier terakhir |
| Actions | Edit / Delete |

### Relasi Cek Hapus (4 pengecekan)
Tidak bisa dihapus jika dipakai di: **ItemTransaction**, **SrItemTransaction**, **PrItemTransaction**, **IkbDetail**  
→ Pesan: "Package ini tidak dapat dihapus karena sudah digunakan pada data transaksi."

### Search Filter
Cari berdasarkan nama package (`packaging LIKE %search%`).

### Permission
| Aksi | Permission |
|------|-----------|
| View | `package.view` |
| Create | `package.create` |
| Edit | `package.edit` |
| Delete | `package.delete` |

---

## 5. Modul Departement (Departemen)

**Route**: `GET /departements` | **Navbar**: tampil jika `level === 1` atau `dept.view`  
**Component**: `App\Livewire\Departements\Index`  
**View**: `resources/views/livewire/departements/index.blade.php`

### Deskripsi
Mengelola data departemen/divisi perusahaan. Departemen adalah **data master paling kritis** — digunakan di hampir semua modul: User, PR, SR, IKB, ItemTransaction, Payment, Package, Vendor.

### Field Modal

| Field | Required | Validasi |
|-------|----------|---------|
| Department Name | ✅ | `required|max:255|unique:tbl_departement,departement` (exclude self saat edit) |

### Tabel
| Kolom | Isi |
|-------|-----|
| # | Nomor urut |
| Department Name | Nama departemen |
| Actions | Edit / Delete |

### Relasi Cek Hapus (6 pengecekan — paling ketat)
Tidak bisa dihapus jika dipakai di: **User**, **PR**, **SR**, **IKB**, **ItemTransaction**, **Payment**  
→ Pesan: "Departemen tidak dapat dihapus karena masih digunakan pada data lain (User/Transaksi)."

### Search Filter
Cari berdasarkan nama departemen (`departement LIKE %search%`).

### Permission
| Aksi | Permission |
|------|-----------|
| View | `dept.view` |
| Create | `dept.create` |
| Edit | `dept.edit` |
| Delete | `dept.delete` |

---

## Perbandingan Cek Relasi Sebelum Hapus

| Modul | Relasi yang Dicek | Jumlah Cek |
|-------|-------------------|-----------|
| Branch | User | 1 |
| Warehouse | User, PR, SR, IKB, ItemTrans, SrItemTrans, PrItemTrans | 7 |
| UOM | SrDetail, IkbDetail, ItemTrans, SrItemTrans, PrItemTrans | 5 |
| Package | ItemTrans, SrItemTrans, PrItemTrans, IkbDetail | 4 |
| Departement | User, PR, SR, IKB, ItemTrans, Payment | 6 |

---

## Ringkasan Permission Semua Modul

| Modul | View | Create | Edit | Delete |
|-------|------|--------|------|--------|
| Branch | `branch.view` | `branch.create` | `branch.edit` | `branch.delete` |
| Warehouse | `warehouse.view` | `warehouse.create` | `warehouse.edit` | `warehouse.delete` |
| UOM | `uom.view` | `uom.create` | `uom.edit` | `uom.delete` |
| Package | `package.view` | `package.create` | `package.edit` | `package.delete` |
| Departement | `dept.view` | `dept.create` | `dept.edit` | `dept.delete` |

> Semua modul di atas juga dapat diakses oleh **`level === 1` (Super Admin)** untuk semua aksi tanpa perlu permission eksplisit.

---

## Akses via Navbar

Berdasarkan `navbar.blade.php`, kelima modul ini tampil di sidebar di bawah kelompok **"Master Data"** atau **"Settings"**, dengan kondisi:

| Modul | Tampil di Navbar Jika |
|-------|----------------------|
| Branch | `level === 1` atau `branch.view` |
| Warehouse | `level === 1` atau `warehouse.view` |
| UOM | `level === 1` atau `uom.view` |
| Package | `level === 1` atau `package.view` |
| Departement | `level === 1` atau `dept.view` |

---

*Dokumentasi dibuat dari: `app/Livewire/Branches/Index.php`, `app/Livewire/Warehouses/Index.php`, `app/Livewire/Uoms/Index.php`, `app/Livewire/Packages/Index.php`, `app/Livewire/Departements/Index.php` beserta view masing-masing dan `navbar.blade.php`*  
*Terakhir diperbarui: 23 Maret 2026*
