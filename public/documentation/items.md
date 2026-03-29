# 📦 Items (Barang Inventory)

## 1. Fungsi Modul

Modul Items adalah **master barang** yang dikelola dalam sistem inventory. Setiap item memiliki stok yang dihitung real-time dari transaksi masuk (income) dan keluar (outcome) di `tbl_item_transactions`. Item digunakan sebagai referensi di IKB Detail dan Contract Detail.

**File Utama:**
- Routes: `GET /items`, `/items/{hash}`
- Components: `app/Livewire/Items/` (Index, Show, FormModal)

---

## 2. Cara Kerja

### 2.1 Kalkulasi Stok Real-time

```
Stok Tersedia = Total Income − Total Outcome
                − Reserved Qty (dari IKB lain yang status ≥ 5 dan < 10
                  di warehouse & company yang sama)
```

> Stok tidak disimpan sebagai field tetap — selalu dihitung dari tabel transaksi.

### 2.2 Scope Data Index

| Permission | Data Ditampilkan |
|-----------|-----------------|
| `level 1` / `item.view.all` | Semua item |
| `item.view.warehouse` | Item di warehouse user |
| `item.view.dept` | Item yang relevan dengan departemen |
| Tidak ada | Item yang dibuat sendiri |

### 2.3 Halaman Detail Item

Halaman show item menampilkan:
- **Info dasar**: nama, kode, kategori, satuan (UOM), kemasan (Package)
- **Stok per Warehouse**: tabel breakout stok per gudang
- **Riwayat Transaksi**: semua transaksi income dan outcome dengan filter

### 2.4 Filter Index

| Filter | Keterangan |
|--------|-----------|
| Search | Nama item, kode item |
| Category | Filter berdasarkan kategori |
| Warehouse | Filter berdasarkan gudang |
| Per Page | 10 / 25 / 50 |

---

## 3. Permission

| Aksi | Level 1 | Permission |
|------|---------|-----------|
| Lihat daftar (semua) | ✅ | `item.view.all` |
| Lihat daftar (warehouse) | ✅ | `item.view.warehouse` |
| Lihat daftar (dept) | ✅ | `item.view.dept` |
| Tambah item baru | ✅ | `item.create` |
| Edit item | ✅ | `item.edit` |
| Hapus item | ✅ | `item.delete` |

---

## 4. Langkah CRUD

### Tambah Item (Create)

1. Klik **Add Item** (perlu `item.create`)
2. Isi FormModal:

| Field | Required | Keterangan |
|-------|----------|-----------|
| Item Code | ✅ | Unik, identifier barang |
| Item Name | ✅ | Nama barang |
| Category | ✅ | Dari master kategori |
| UOM | ✅ | Satuan ukur |
| Package | ✅ | Jenis kemasan |
| Deskripsi/Keterangan | ❌ | Opsional |

3. Klik **Save** → insert `tbl_item`

### Edit Item

1. Klik ✏️ (perlu `item.edit`)
2. Edit nama, kategori, UOM, Package
3. Item Code tidak disarankan diubah jika sudah punya transaksi
4. Klik **Update**

### Hapus Item

1. Klik 🗑️ (perlu `item.delete`)
2. Cek: ada transaksi terkait / dipakai di IKB / Contract → tolak
3. Aman → hapus

### Lihat Detail & Riwayat Stok

1. Klik nama item → halaman `/items/{hash}`
2. Tampil stok per gudang + semua riwayat transaksi income/outcome
3. Filter transaksi: tanggal, warehouse, tipe transaksi

---

*Terakhir diperbarui: 24 Maret 2026*
