# 📦 Reference Data: Branch, Warehouse, UOM, Package, Departemen

## 1. Fungsi Modul

Kelima modul ini adalah **master data referensial** yang digunakan sebagai lookup oleh modul-modul lain. Semuanya memiliki pola identik: satu halaman index + modal CRUD + proteksi relasi sebelum hapus + auto-refresh 5 detik.

---

## 2. Cara Kerja

### 2.1 Pola Umum

| Aspek         | Detail                                      |
| ------------- | ------------------------------------------- |
| Tampilan      | 1 halaman index + 1 modal (Create/Edit)     |
| Filter        | Search live + Per Page selector             |
| Auto-refresh  | `wire:poll.5s`                              |
| Query String  | `search` dan `perPage` tersimpan di URL     |
| Modal trigger | Livewire dispatch event → `bootstrap.Modal` |

### 2.2 Cek Relasi Sebelum Hapus

| Modul       | Relasi yang Dicek                                        | Jumlah Cek |
| ----------- | -------------------------------------------------------- | ---------- |
| Branch      | User                                                     | 1          |
| Warehouse   | User, PR, SR, IKB, ItemTrans, SrItemTrans, PrItemTrans   | 7          |
| UOM         | SrDetail, IkbDetail, ItemTrans, SrItemTrans, PrItemTrans | 5          |
| Package     | ItemTrans, SrItemTrans, PrItemTrans, IkbDetail           | 4          |
| Departement | User, PR, SR, IKB, ItemTrans, Payment                    | 6          |

> Semua menolak penghapusan jika ada relasi aktif.

### 2.3 Field per Modul

**Branch:**

| Field       | Required | Validasi                                      |
| ----------- | -------- | --------------------------------------------- |
| Branch Name | ✅       | `required\|max:255\|unique:tbl_branch,branch` |
| Address     | ✅       | `required\|string`                            |

**Warehouse:**

| Field          | Required | Validasi                             |
| -------------- | -------- | ------------------------------------ |
| Warehouse Name | ✅       | `required\|max:255\|unique`          |
| Address        | ❌       | `nullable\|max:500`                  |
| Status         | ✅       | `required\|in:0,1` (Active/Inactive) |

**UOM:**

| Field      | Required | Validasi                                 |
| ---------- | -------- | ---------------------------------------- |
| UOM Name   | ✅       | `required\|max:255\|unique:tbl_uoms,uom` |
| Netto (KG) | ❌       | `nullable\|numeric` (konversi berat)     |

**Package:**

| Field        | Required | Validasi                                             |
| ------------ | -------- | ---------------------------------------------------- |
| Package Name | ✅       | `required\|max:255\|unique:tbl_packagings,packaging` |
| Department   | ✅       | `required\|exists:tbl_departement`                   |

**Departement:**

| Field           | Required | Validasi                                                |
| --------------- | -------- | ------------------------------------------------------- |
| Department Name | ✅       | `required\|max:255\|unique:tbl_departement,departement` |

---

## 3. Permission

| Modul       | View             | Create             | Edit             | Delete             |
| ----------- | ---------------- | ------------------ | ---------------- | ------------------ |
| Branch      | `branch.view`    | `branch.create`    | `branch.edit`    | `branch.delete`    |
| Warehouse   | `warehouse.view` | `warehouse.create` | `warehouse.edit` | `warehouse.delete` |
| UOM         | `uom.view`       | `uom.create`       | `uom.edit`       | `uom.delete`       |
| Package     | `package.view`   | `package.create`   | `package.edit`   | `package.delete`   |
| Departement | `dept.view`      | `dept.create`      | `dept.edit`      | `dept.delete`      |

> Semua aksi juga bisa dilakukan oleh **level 1 (Super Admin)** tanpa permission eksplisit.

---

## 4. Langkah CRUD

> Langkah berikut berlaku untuk semua 5 modul (pola identik):

### Tambah (Create)

1. Klik tombol **Add [Nama Modul]** di header (perlu permission `*.create`)
2. Modal terbuka — isi field yang tersedia
3. Klik **Save** → validasi → insert ke database

### Edit

1. Klik ✏️ di baris data (perlu permission `*.edit`)
2. Modal terbuka dengan data terisi
3. Edit field → klik **Update Data** → validasi (dengan `unique` exclude ID sendiri) → update database

### Hapus

1. Klik 🗑️ di baris data (perlu permission `*.delete`)
2. Dialog konfirmasi muncul
3. Sistem cek relasi (lihat tabel 2.2)
4. Jika ada relasi → tolak dengan pesan error
5. Jika aman → hapus data

### Error Relasi

| Modul       | Pesan Tolak Hapus                                                             |
| ----------- | ----------------------------------------------------------------------------- |
| Branch      | "Cabang ini tidak dapat dihapus karena masih memiliki User yang terdaftar."   |
| Warehouse   | "Gudang tidak dapat dihapus karena masih digunakan pada data lain."           |
| UOM         | "UOM ini tidak dapat dihapus karena sudah digunakan pada data transaksi."     |
| Package     | "Package ini tidak dapat dihapus karena sudah digunakan pada data transaksi." |
| Departement | "Departemen tidak dapat dihapus karena masih digunakan pada data lain."       |

---

_Terakhir diperbarui: 24 Maret 2026_
