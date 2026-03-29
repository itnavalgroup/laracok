# 🔄 Item Transactions (Transaksi Barang)

## 1. Fungsi Modul

Modul Item Transactions mencatat semua **pergerakan stok barang** (masuk dan keluar) di setiap gudang. Transaksi income di-input manual oleh petugas gudang; transaksi outcome di-generate otomatis sistem saat IKB selesai (status 10). Modul ini adalah **sumber kebenaran tunggal** stok item.

**File Utama:**
- Routes: `GET /item-transactions`, `/item-transactions/{hash}`
- Components: `app/Livewire/ItemTransactions/` (Index, Show, FormModal)

---

## 2. Cara Kerja

### 2.1 Tipe Transaksi

| Tipe | `income` | `outcome` | Dibuat Oleh |
|------|----------|-----------|------------|
| **Income (Masuk)** | `> 0` | `0` | Manual oleh user yang punya permission |
| **Outcome (Keluar)** | `0` | `> 0` | Otomatis saat IKB Step 9 di-approve |

### 2.2 Format Kode Transaksi

| Jenis | Format |
|-------|--------|
| Income manual | Bebas tapi unique (input user) |
| Outcome dari IKB | `IKB-{ikb_number}-{item_index}` |

### 2.3 Implikasi ke Stok

```
Stok per Item per Warehouse:
  = SUM(income) − SUM(outcome) dari tbl_item_transactions

Reserved Qty (untuk kalkulasi saat IKB):
  = SUM(qty) dari IKB Detail dengan status ≥ 5 dan < 10
    di warehouse & company yang sama

Available Stock = Stok − Reserved Qty
```

### 2.4 Halaman Detail Transaksi

Menampilkan:
- **Info Transaksi**: kode, tanggal, item, warehouse, UOM, package
- **Kuantitas**: income / outcome
- **Deskripsi**: isi informasi dari IKB (RI, SK, DO, Batch, Destination, Delivery Date)
- **Link ke IKB**: tombol menuju IKB asal jika transaksi berasal dari IKB

### 2.5 Filter Index

| Filter | Keterangan |
|--------|-----------|
| Search | Kode transaksi, nama item |
| Warehouse | Filter berdasarkan gudang |
| Tipe | Income / Outcome |
| Tanggal | Rentang tanggal transaksi |
| Per Page | 10 / 25 / 50 |

---

## 3. Permission

| Aksi | Level 1 | Permission |
|------|---------|-----------|
| Lihat daftar (semua) | ✅ | `item_transaction.view.all` |
| Lihat daftar (warehouse) | ✅ | `item_transaction.view.warehouse` |
| Lihat daftar (dept) | ✅ | `item_transaction.view.dept` |
| Input transaksi masuk (Income) | ✅ | `item_transaction.create` |
| Edit transaksi income | ✅ | `item_transaction.edit` + Creator |
| Hapus transaksi income | ✅ | `item_transaction.delete` + Creator |

> ⚠️ Transaksi **Outcome** yang otomatis dari IKB **tidak bisa diedit/dihapus** secara manual. Hanya bisa dihapus lewat Cancel Approval IKB dari Step 9 (yang otomatis menghapus ItemTransaction terkait).

---

## 4. Langkah CRUD

### Input Transaksi Masuk (Create Income)

1. Klik **Add Transaction** (perlu `item_transaction.create`)
2. Isi FormModal:

| Field | Required | Keterangan |
|-------|----------|-----------|
| Transaction Code | ✅ | Unik, identifier transaksi |
| Warehouse | ✅ | Gudang tujuan |
| Item | ✅ | Dari master item |
| Category | ✅ | Auto-fill dari item yang dipilih |
| UOM | ✅ | Satuan ukur |
| Package | ✅ | Jenis kemasan |
| Income Qty | ✅ | Jumlah masuk (min 0.001) |
| Tanggal | ✅ | Tanggal transaksi |
| Deskripsi | ❌ | Keterangan tambahan |

3. Klik **Save** → insert `tbl_item_transactions`

### Edit Transaksi Income

1. Klik ✏️ pada transaksi income milik sendiri (perlu `item_transaction.edit`)
2. Edit qty, tanggal, deskripsi
3. Klik **Update**

### Hapus Transaksi Income

1. Klik 🗑️ (perlu `item_transaction.delete` + Creator)
2. Konfirmasi → hapus (stok otomatis berkurang)
3. ⚠️ Tidak bisa hapus jika ada IKB yang membutuhkan stok tersebut

### Transaksi Outcome dari IKB (Otomatis)

1. IKB Step 9 di-approve oleh Log Coord Final
2. Sistem auto-insert `tbl_item_transactions` untuk setiap item detail IKB:
   - `outcome = qty`
   - `income = 0`
   - `transaction_code = IKB-{ikb_number}-{index}`
3. Jika approval Step 9 di-cancel → semua ItemTransaction IKB tersebut dihapus otomatis

---

*Terakhir diperbarui: 24 Maret 2026*
