# Dokumentasi Fitur: Item Category (Kategori Barang)

**Modul**: Item Category  
**Route Prefix**: `/item-categories`  
**Livewire Components**:
- `App\Livewire\ItemCategories\Index` — Daftar & CRUD Kategori Barang

---

## 1. Deskripsi Umum

Modul Item Category adalah halaman **Master Data** untuk mengelola kategori barang yang digunakan pada transaksi inventaris, PR, dan SR. Setiap kategori memiliki kode unik dan nama kategori, serta bisa diaktifkan/dinonaktifkan.

Data kategori digunakan sebagai referensi saat membuat Master Barang (`items`) dan dapat dikelola melalui antarmuka CRUD maupun impor bulk dari Excel.

---

## 2. Routes

| Method | URI | Name | Keterangan |
|--------|-----|------|-----------|
| GET | `/item-categories` | `item-categories.index` | Halaman daftar kategori barang |

---

## 3. Halaman Index

**Route**: `GET /item-categories`  
**Poll**: Auto-refresh setiap 5 detik (`wire:poll.5s`)

### Summary Card

| Card | Isi |
|------|-----|
| Total Item Categories | Jumlah total seluruh kategori barang |

### Filter & Pencarian

| Filter | Binding | Keterangan |
|--------|---------|-----------|
| Search | `wire:model.live.debounce.300ms="search"` | Cari berdasarkan nama atau kode kategori |
| Per Page | `wire:model.live="perPage"` | 10 / 25 / 50 item per halaman |

### Kolom Tabel

| Kolom | Isi |
|-------|-----|
| # | Nomor urut |
| CODE | Badge kode kategori (`item_category_code`) |
| CATEGORY NAME | Nama kategori (`item_category`) |
| STATUS | Badge ACTIVE / INACTIVE berdasarkan `is_active` |
| CREATED BY | Nama pembuat + tanggal/waktu buat |
| ACTIONS | Tombol Edit dan Delete (sesuai permission) |

### Tombol Aksi di Header

| Tombol | Kondisi | Aksi |
|--------|---------|------|
| **Export** | Admin atau `item_category.download` | `wire:click="export"` — Export data ke file (Excel/CSV) |
| **Import** | Admin atau `item_category.upload` | Buka modal `#importModal` |
| **Add Category** | Admin atau `item_category.create` | `wire:click="create"` — Buka modal form tambah |

### Tombol Aksi per Baris

| Tombol | Kondisi | Aksi |
|--------|---------|------|
| ✏️ Edit | Admin atau `item_category.edit` | `wire:click="edit($id)"` — Buka modal edit |
| 🗑️ Delete | Admin atau `item_category.delete` | `delete($id)` via konfirmasi |

---

## 4. Form Tambah / Edit Kategori (`categoryModal`)

**Trigger**: Event `openCategoryModal` dari Livewire (setelah `create()` atau `edit($id)`)  
**Modal ID**: `categoryModal`

| Field | Required | Keterangan |
|-------|----------|-----------|
| Category Code (`item_category_code`) | ✅ | Kode unik kategori, contoh: `CAT001` |
| Category Name (`item_category`) | ✅ | Nama kategori, contoh: `ELECTRONIC`, `STATIONARY` |
| Status (`is_active`) | ✅ | ACTIVE (1) / INACTIVE (0) |

**Tombol Submit**:
- Mode Tambah: "Simpan Kategori"
- Mode Edit: "Update Data"

Setelah simpan berhasil, modal otomatis tertutup (`closeCategoryModal` event).

---

## 5. Import dari Excel (`importModal`)

**Trigger**: Tombol "Import" di header  
**Modal ID**: `importModal`

### Alur Import

1. **Download Template** — Klik tombol "Download Template" untuk mendapatkan format Excel yang benar (`wireclick="downloadTemplate"`)
2. **Upload File** — Pilih file Excel yang sudah diisi (`wire:model="file_excel"`)
3. **Proses Import** — Klik "Proses Import" (`wire:submit.prevent="import"`)

### Validasi File Excel

| Field | Keterangan |
|-------|-----------|
| File (`file_excel`) | Wajib diisi; harus berformat Excel yang valid |

> Gunakan template yang disediakan untuk menghindari kesalahan format.

Setelah import berhasil, modal otomatis tertutup (`closeImportModal` event).

---

## 6. Ringkasan Permission

| Aksi | Permission Slug |
|------|----------------|
| Lihat daftar kategori | Tidak ada permission khusus (semua user yang login dapat melihat) |
| Tambah kategori | `item_category.create` |
| Edit kategori | `item_category.edit` |
| Hapus kategori | `item_category.delete` |
| Export data | `item_category.download` |
| Import dari Excel | `item_category.upload` |

> **Admin** (level 1) dapat melakukan semua aksi tanpa permission khusus.

---

## 7. Validasi & Error

| Kondisi | Pesan |
|---------|-------|
| Category Code kosong | Validasi required |
| Category Name kosong | Validasi required |
| Status kosong | Validasi required |
| File Excel tidak valid | Validasi format file |
| Hapus kategori yang masih digunakan | Error (FK constraint) |

---

*Dokumentasi dibuat dari: `resources/views/livewire/item-categories/` (1 komponen)*  
*Terakhir diperbarui: 23 Maret 2026*
