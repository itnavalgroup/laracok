# Dokumentasi Fitur: Item Transaction (Transaksi Barang)

**Modul**: Item Transaction  
**Route Prefix**: `/item-transactions`  
**Livewire Components**:
- `App\Livewire\ItemTransactions\Index` — Daftar transaksi + chart + CRUD
- `App\Livewire\ItemTransactions\Show` — Detail transaksi

---

## 1. Deskripsi Umum

Modul Item Transaction adalah sistem pencatatan **mutasi barang (stok)** di gudang — baik pemasukan (income) maupun pengeluaran (outcome). Setiap transaksi memiliki kode unik, tercatat berdasarkan user, dan dilengkapi informasi logistik (vendor, kendaraan, dokumen SO/PO/invoice).

Transaksi dapat dibuat secara manual melalui form, diimpor dari Excel, atau **otomatis terbentuk dari modul IKB** dengan kode berpola `IKB-xxx-{nomor}`. Transaksi yang berasal dari IKB tidak bisa diedit/dihapus secara langsung dari menu ini.

---

## 2. Routes

| Method | URI | Name | Keterangan |
|--------|-----|------|-----------|
| GET | `/item-transactions` | `item-transactions.index` | Daftar transaksi |
| GET | `/item-transactions/{hash}` | `item-transactions.show` | Detail transaksi |

> ID transaksi di-obfuscate menggunakan `hashid_encode($id_item_transaction)`.

---

## 3. Halaman Index

**Route**: `GET /item-transactions`  
**Poll**: Auto-refresh setiap 5 detik (`wire:poll.5s`)

### Summary Card

| Card | Isi |
|------|-----|
| Total Transaksi | Jumlah total seluruh transaksi barang |

### Tombol Aksi di Header

| Tombol | Kondisi | Aksi |
|--------|---------|------|
| **Export** | Admin atau `item_transaction.download` | `wire:click="export"` — Export data ke Excel |
| **Import** | Admin atau `item_transaction.upload` | Buka modal `#importModal` |
| **Buat Transaksi** | Admin atau `item_transaction.create` | `wire:click="create"` — Buka modal form baru |

---

## 4. Ringkasan Transaksi (Chart & Report)

> Bagian ini hanya tampil untuk Admin atau user dengan permission **`item_transaction.view.report`**.

### Filter Chart (Collapsible)

| Filter | Binding | Keterangan |
|--------|---------|-----------|
| Periode | `wire:model.live="reportDateFilter"` | Semua / Hari Ini / Minggu Ini / Bulan Ini / Custom |
| Custom Range | `reportStartDate` & `reportEndDate` | Tampil jika Periode = "Custom" |
| Kategori | `wire:model.live="reportCategory"` | Filter chart by kategori barang |
| Barang | `wire:model.live="reportItem"` | Filter by nama barang (aktif setelah pilih kategori) |
| Perusahaan | `wire:model.live="reportCompany"` | Filter by perusahaan |
| Gudang | `wire:model.live="reportWarehouse"` | Hanya Admin atau `item_transaction.view.all` |

### Summary Number Cards di Chart

| Card | Warna | Isi |
|------|-------|-----|
| Total Income | Hijau | Jumlah barang masuk (sesuai filter) |
| Total Outcome | Merah | Jumlah barang keluar (sesuai filter) |
| Net (Sisa) | Biru | Income − Outcome |

Chart divisualisasikan menggunakan **ApexCharts** di elemen `#itemTransactionChart`.

---

## 5. Filter Tabel (Advanced Filters)

| Filter | Binding | Keterangan |
|--------|---------|-----------|
| Search | `wire:model.live.debounce.300ms="search"` | Cari kode transaksi atau nama barang |
| Kategori | `wire:model.live="filterCategory"` | Filter by kategori |
| Barang | `wire:model.live="filterItem"` | Filter by barang (aktif setelah pilih kategori) |
| Periode | `wire:model.live="filterDate"` | Semua / Hari Ini / Minggu Ini / Bulan Ini / Custom |
| Custom Date | `filterStartDate` & `filterEndDate` | Tampil jika Periode = "Custom" |
| Perusahaan | `wire:model.live="filterCompany"` | Filter by perusahaan |
| Gudang | `wire:model.live="filterWarehouse"` | Hanya Admin atau `item_transaction.view.all` |
| Per Page | `wire:model.live="perPage"` | 10 / 25 / 50 |

---

## 6. Kolom Tabel

| Kolom | Isi |
|-------|-----|
| # | Nomor urut |
| TRX CODE | Kode transaksi (badge) + nama user pembuat |
| TANGGAL | Tanggal transaksi |
| BARANG | Nama barang + perusahaan + UOM |
| KATEGORI | Nama kategori barang |
| WAREHOUSE | Nama gudang |
| IN/OUT | Nilai income (hijau +) atau outcome (merah −) |
| ACTIONS | Tombol View, Edit, Delete (kondisional) |

---

## 7. Logika Tombol Aksi per Baris

### Tombol View

| Kondisi | Aksi |
|---------|------|
| Transaksi berasal dari IKB (`transaction_code` diawali `IKB-`) DAN user bisa melihat IKB tersebut (`ikbMap[$num]['can_show'] = true`) | Link ke `ikb.show` (halaman IKB terkait) |
| Transaksi biasa DAN Admin atau `item_transaction.detail` | Link ke `item-transactions.show` |

### Tombol Edit

| Kondisi | Aksi |
|---------|------|
| Transaksi **bukan** dari IKB (`transaction_code` tidak diawali `IKB-`) | |
| DAN (Admin atau `item_transaction.edit.all`) | `wire:click="edit($id)"` |
| ATAU (`item_transaction.edit` DAN `id_user` sama dengan user login) | `wire:click="edit($id)"` |

### Tombol Delete

| Kondisi | Aksi |
|---------|------|
| Transaksi **bukan** dari IKB | |
| DAN (Admin atau `item_transaction.delete.all`) | `delete($id)` via konfirmasi |
| ATAU (`item_transaction.delete` DAN `id_user` sama dengan user login) | `delete($id)` via konfirmasi |

> **Transaksi dari IKB tidak bisa diedit maupun dihapus** dari halaman ini, hanya bisa dilihat melalui redirect ke IKB.

---

## 8. Form Buat / Edit Transaksi (`transactionModal`)

**Trigger**: Event `openTransactionModal` dari Livewire  
**Modal ID**: `transactionModal`

### Field Form

| Field | Required | Kondisi | Keterangan |
|-------|----------|---------|-----------|
| Kategori Barang (`id_item_category`) | ✅ | — | Dropdown semua kategori aktif; memicu load daftar barang |
| Barang (`id_item`) | ✅ | Di-disable jika kategori belum dipilih | Dropdown barang aktif di kategori yang dipilih |
| Gudang (`id_warehouse`) | ✅ | Jika user punya `id_warehouse` default & mode Create → otomatis terisi & di-lock | Admin atau tanpa default warehouse: dropdown pilih manual |
| Company (`id_company`) | ✅ | — | Dropdown perusahaan |
| UOM (`id_uom`) | ✅ | — | Dropdown satuan ukuran |
| Packaging (`id_packaging`) | ✅ | — | Dropdown tipe packaging |
| Income / Masuk | ✅ | Hanya Admin atau `item_transaction.create` | Jumlah barang masuk (format number dengan titik ribuan) |
| Outcome / Keluar | ✅ | Hanya Admin atau `item_transaction.out` | Jumlah barang keluar (format number dengan titik ribuan) |
| Tanggal Transaksi | ✅ | — | Datetime local (`datetime-local`) |
| Vendor (`id_vendor`) | ❌ | — | Dropdown vendor (opsional) |
| Police Number | ❌ | — | Nomor polisi kendaraan |
| Driver Name | ❌ | — | Nama sopir |
| SO Number | ❌ | — | Nomor Sales Order |
| Invoice Number | ❌ | — | Nomor Invoice |
| PO Number | ❌ | — | Nomor Purchase Order |
| FOB | ❌ | — | Free On Board |
| Keterangan / Description | ❌ | — | Catatan tambahan (textarea) |
| **Dokumen Pendukung** | ✅ | Mode upload atau kamera | File lampiran transaksi |

### Mode Upload Dokumen

| Mode | Keterangan |
|------|-----------|
| **Upload File** | Pilih file dari perangkat (JPG, PNG, PDF, maks 5MB) |
| **Ambil Foto** | Aktifkan kamera → ambil foto → preview → simpan |

Saat **Edit**, jika tidak mengganti file, file lama tetap dipertahankan dan ditampilkan sebagai link.

**Penempatan File**: `assets/attachmenttransaction/{filename}`

### Logika Gudang

- Jika user memiliki `id_warehouse` (default warehouse) dan mode **Create**: field Gudang otomatis terisi dan di-disable (read-only), tidak bisa diganti.
- Jika Admin atau user tanpa default warehouse, atau mode **Edit**: tampil dropdown pilih manual.

---

## 9. Import dari Excel (`importModal`)

**Trigger**: Tombol "Import" di header  
**Modal ID**: `importModal`

### Alur Import

1. **Download Template** — Klik "Download Excel Template" (`wire:click="downloadTemplate"`)
2. **Upload File** — Pilih file `.xlsx` atau `.xls` (maks 5MB)
3. **Proses Import** — Klik "Mulai Import Data" (`wire:submit.prevent="import"`)

### Panduan Penting

- Format: `.xlsx` atau `.xls`
- Maksimal ukuran: **5MB**
- Jangan ubah judul kolom pertama di template
- Baris dengan nilai teks akan dikonversi ke ID referensi yang ada di sistem

---

## 10. Halaman Detail Transaksi (`show.blade.php`)

**Route**: `GET /item-transactions/{hash}`  
**Access**: Admin atau `item_transaction.detail`

### Seksi Informasi

| Seksi | Field yang Ditampilkan |
|-------|----------------------|
| **Item Information** | Item Name, Item Code, Category, UOM, Packaging, Income (+), Outcome (−) |
| **Organization & Warehouse** | Company, Warehouse, Department |
| **Logistics & Documentation** | Vendor, Police Number, Driver Name, SO Number, Invoice Number, PO Number, FOB, Keterangan |
| **Attachment / Dokumen Pendukung** | Preview gambar (inline), PDF (iframe embed) atau link download |

### Preview Attachment

| Tipe File | Tampilan |
|-----------|---------|
| JPG / PNG / GIF / WebP | Preview gambar inline + tombol View |
| PDF | Embed iframe 16:9 + tombol View & Download PDF |
| File lain | Card dengan nama file + tombol Buka & Download |

---

## 11. Ringkasan Permission

### Akses & Visibilitas

| Aksi | Permission Slug |
|------|----------------|
| Lihat semua transaksi (semua gudang) | `item_transaction.view.all` |
| Lihat daftar transaksi sendiri | Tidak ada permission khusus (semua user login) |
| Lihat chart/report ringkasan | `item_transaction.view.report` |
| Lihat detail transaksi | `item_transaction.detail` |

### CRUD Transaksi

| Aksi | Permission Slug |
|------|----------------|
| Buat transaksi baru (input income) | `item_transaction.create` |
| Input outcome / barang keluar | `item_transaction.out` |
| Edit transaksi sendiri | `item_transaction.edit` |
| Edit semua transaksi | `item_transaction.edit.all` |
| Hapus transaksi sendiri | `item_transaction.delete` |
| Hapus semua transaksi | `item_transaction.delete.all` |

### Import & Export

| Aksi | Permission Slug |
|------|----------------|
| Export data transaksi | `item_transaction.download` |
| Import dari Excel | `item_transaction.upload` |

> **Admin** (level 1) dapat melakukan semua aksi tanpa permission khusus.  
> **Transaksi dari IKB** (`transaction_code` berawalan `IKB-`) tidak bisa diedit atau dihapus dari modul ini — harus dikelola melalui modul IKB.

---

## 12. Validasi & Error

| Kondisi | Keterangan |
|---------|-----------|
| Kategori tidak dipilih | Validasi required `id_item_category` |
| Barang tidak dipilih | Validasi required `id_item` |
| Gudang tidak dipilih | Validasi required `id_warehouse` |
| Company tidak dipilih | Validasi required `id_company` |
| UOM tidak dipilih | Validasi required `id_uom` |
| Packaging tidak dipilih | Validasi required `id_packaging` |
| Income/Outcome kosong | Validasi required |
| Tanggal transaksi kosong | Validasi required `transaction_date` |
| File melebihi 5MB | Alert warning client-side; upload dicegah sebelum ke Livewire |
| File Excel tidak valid | Validasi format |
| Tidak ada barang aktif di kategori | Pesan info: "Tidak ada barang aktif di kategori ini." |

---

## 13. Hubungan dengan Modul Lain

| Modul | Hubungan |
|-------|---------|
| **Items** | `total_income` dan `total_outcome` di master barang diakumulasi dari transaksi ini |
| **Item Categories** | Setiap transaksi mengacu pada kategori via `id_item_category` |
| **IKB** | Transaksi dengan kode `IKB-xxx-{nomor}` dibuat otomatis oleh sistem saat IKB diproses |
| **Warehouses** | Setiap transaksi terkait satu gudang (`id_warehouse`); user dapat terkunci ke gudang default |
| **Vendors** | Vendor opsional dicatat untuk traceability pengadaan |

---

*Dokumentasi dibuat dari: `resources/views/livewire/item-transactions/` (2 komponen: index, show)*  
*Terakhir diperbarui: 23 Maret 2026*
