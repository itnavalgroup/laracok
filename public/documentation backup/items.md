# Dokumentasi Fitur: Item (Master Barang)

**Modul**: Items / Master Barang  
**Route Prefix**: `/items`  
**Livewire Components**:
- `App\Livewire\Items\Index` — Daftar & CRUD Master Barang

---

## 1. Deskripsi Umum

Modul Items adalah halaman **Master Data** untuk mengelola data barang yang digunakan dalam transaksi inventaris, PR (Payment Request), dan SR (Settlement Report). Setiap barang memiliki kode unik, nama, kategori, dan deskripsi, serta menampilkan **saldo stok bersih** (NET = total_income − total_outcome).

Data barang dapat dikelola secara manual melalui form CRUD maupun secara bulk melalui impor Excel.

---

## 2. Routes

| Method | URI | Name | Keterangan |
|--------|-----|------|-----------|
| GET | `/items` | `items.index` | Halaman daftar master barang |

---

## 3. Halaman Index

**Route**: `GET /items`  
**Poll**: Auto-refresh setiap 5 detik (`wire:poll.5s`)

### Summary Card

| Card | Isi |
|------|-----|
| Total Master Barang | Jumlah total seluruh data barang |

### Filter & Pencarian

| Filter | Binding | Keterangan |
|--------|---------|-----------|
| Search | `wire:model.live.debounce.300ms="search"` | Cari berdasarkan nama atau kode barang |
| Filter Kategori | `wire:model.live="filterCategory"` | Filter by kategori barang (`id_item_category`) |
| Per Page | `wire:model.live="perPage"` | 10 / 25 / 50 item per halaman |

### Kolom Tabel

| Kolom | Isi |
|-------|-----|
| # | Nomor urut |
| KODE | Badge kode barang (`item_code`) |
| NAMA BARANG | Nama barang + deskripsi singkat (50 karakter) |
| KATEGORI | Nama kategori barang |
| NET (SISA) | Saldo bersih: `total_income − total_outcome` — hijau (+), merah (−), abu (0) |
| STATUS | Badge ACTIVE / INACTIVE berdasarkan `is_active` |
| ACTIONS | Tombol Edit dan Delete (sesuai permission) |

### Kalkulasi NET (Sisa Stok)

```
NET = total_income - total_outcome
```

| Nilai NET | Tampilan |
|-----------|---------|
| > 0 | Teks hijau dengan prefix `+` |
| < 0 | Teks merah (stok defisit) |
| = 0 | Teks abu-abu |

### Tombol Aksi di Header

| Tombol | Kondisi | Aksi |
|--------|---------|------|
| **Export** | Admin atau `item.download` | `wire:click="export"` — Export data ke file (Excel/CSV) |
| **Import** | Admin atau `item.upload` | Buka modal `#importModal` |
| **Add Item** | Admin atau `item.create` | `wire:click="create"` — Buka modal form tambah |

### Tombol Aksi per Baris

| Tombol | Kondisi | Aksi |
|--------|---------|------|
| ✏️ Edit | Admin atau `item.edit` | `wire:click="edit($id)"` — Buka modal edit |
| 🗑️ Delete | Admin atau `item.delete` | `delete($id)` via konfirmasi |

---

## 4. Form Tambah / Edit Barang (`itemModal`)

**Trigger**: Event `openItemModal` dari Livewire (setelah `create()` atau `edit($id)`)  
**Modal ID**: `itemModal`

| Field | Required | Keterangan |
|-------|----------|-----------|
| Kategori (`id_item_category`) | ✅ | Dropdown dari daftar kategori barang aktif |
| Kode Barang (`item_code`) | ✅ | Kode unik barang, contoh: `ITEM001` |
| Nama Barang (`item_name`) | ✅ | Nama barang, contoh: `Gumrosin` |
| Deskripsi (`description`) | ❌ | Keterangan tambahan tentang barang (textarea) |
| Status (`is_active`) | ✅ | ACTIVE (1) / INACTIVE (0) |

**Tombol Submit**:
- Mode Tambah: "Simpan Barang"
- Mode Edit: "Update Data"

Setelah simpan berhasil, modal otomatis tertutup (`closeItemModal` event).

---

## 5. Import dari Excel (`importModal`)

**Trigger**: Tombol "Import" di header  
**Modal ID**: `importModal`

### Alur Import

1. **Download Template** — Klik "Download Template" untuk mendapatkan format Excel yang benar (`wire:click="downloadTemplate"`)
2. **Upload File** — Pilih file Excel yang sudah diisi (`wire:model="file_excel"`)
3. **Proses Import** — Klik "Proses Import" (`wire:submit.prevent="import"`)

### Catatan Penting Import

> Pastikan kolom **`category_code`** pada file Excel sudah terdaftar di sistem sebelum melakukan import. Jika kode kategori tidak ditemukan, baris tersebut akan gagal diimpor.

### Validasi File Excel

| Field | Keterangan |
|-------|-----------|
| File (`file_excel`) | Wajib diisi; harus berformat Excel yang valid |

Setelah import berhasil, modal otomatis tertutup (`closeImportModal` event).

---

## 6. Ringkasan Permission

| Aksi | Permission Slug |
|------|----------------|
| Lihat daftar barang | Tidak ada permission khusus (semua user yang login dapat melihat) |
| Tambah barang | `item.create` |
| Edit barang | `item.edit` |
| Hapus barang | `item.delete` |
| Export data | `item.download` |
| Import dari Excel | `item.upload` |

> **Admin** (level 1) dapat melakukan semua aksi tanpa permission khusus.

---

## 7. Validasi & Error

| Kondisi | Pesan |
|---------|-------|
| Kategori tidak dipilih | Validasi required pada `id_item_category` |
| Kode Barang kosong | Validasi required |
| Nama Barang kosong | Validasi required |
| Status kosong | Validasi required |
| File Excel tidak valid | Validasi format file |
| `category_code` pada Excel tidak ditemukan | Baris gagal diimpor |
| Hapus barang yang masih digunakan dalam transaksi | Error (FK constraint) |

---

## 8. Hubungan dengan Modul Lain

| Modul | Hubungan |
|-------|---------|
| **Item Categories** | Setiap barang wajib memiliki kategori (`id_item_category`) |
| **PR / SR Detail** | Barang digunakan sebagai referensi dalam detail item transaksi |
| **Inventaris** | `total_income` dan `total_outcome` terakumulasi dari transaksi inventaris |

---

*Dokumentasi dibuat dari: `resources/views/livewire/items/` (1 komponen)*  
*Terakhir diperbarui: 23 Maret 2026*
