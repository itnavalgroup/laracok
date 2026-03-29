# 🚚 IKB (Instruksi Keluar Barang)

## 1. Fungsi Modul

IKB adalah modul pengajuan **pengeluaran barang dari gudang**. Setiap IKB melewati **9 step approval** dengan tanda tangan digital. Setelah approval final (Step 9), sistem otomatis melakukan **pengurangan stok** di `tbl_item_transactions`. IKB menggunakan Doc Type = 4.

**File Utama:**
- Routes: `GET /ikb`, `/ikb/{hash}`
- Components: `app/Livewire/Ikb/` (Index, Show, FormModal, FormDetailModal)

---

## 2. Cara Kerja

### 2.1 Status IKB

| Status | Label | Approver |
|--------|-------|---------|
| 0 | Draft | — |
| 1 | Pending SPV/Manager | SPV / Manager |
| 2 | Pending Director Logistik | Director Logistik |
| 3 | Pending PPIC | PPIC |
| 4 | Pending Inventory Control | Inventory Control |
| 5 | Pending Logistic Coordinator | Logistic Coordinator |
| 6 | Pending Warehouse Staff | Warehouse Staff |
| 7 | Pending Warehouse SPV | Warehouse SPV |
| 8 | Pending Security Officer | Security Officer |
| 9 | Pending Log Coord Final | Log Coord Final |
| 10 | Selesai / Approved | — (stok sudah dikurangi) |
| 11 | Revision | Dikembalikan ke creator |
| 12 | Rejected | Ditolak permanen |

### 2.2 Alur Approval IKB (9 Step)

```
[Creator buat IKB → status: 0 Draft]
        ▼ submitIkb() — ikb.submit + Sales + minimal 1 item
[status: 1 → Pending SPV/Manager]
        ▼ ikb.approve.step1 + Sales adalah bawahan approver
[status: 2 → Pending Director Logistik]
        ▼ ikb.approve.step2
[status: 3 → Pending PPIC]
        ▼ ikb.approve.step3
[status: 4 → Pending Inventory Control]
   ← Validasi stok di sini: Available Stock ≥ Qty diminta
   ← Inventory Control bisa edit Qty detail
        ▼ ikb.approve.step4
[status: 5 → Pending Logistic Coordinator]
        ▼ ikb.approve.step5
[status: 6 → Pending Warehouse Staff]
   ← Wajib set Stuffing Date terlebih dahulu
        ▼ ikb.approve.step6
[status: 7 → Pending Warehouse SPV]
        ▼ ikb.approve.step7
[status: 8 → Pending Security Officer]
   ← Wajib set Delivery Date + upload dokumen/foto
        ▼ ikb.approve.step8
[status: 9 → Pending Log Coord Final]
   ← Validasi: dokumen Step 8 harus ada
        ▼ ikb.approve.step9
[status: 10 → SELESAI]
   → Stok otomatis dikurangi (tbl_item_transactions)
```

### 2.3 Validasi Stok (Step 4)

```
Available Stock = (Total Income − Total Outcome)
                − Reserved Qty dari IKB lain
                  (status ≥ 4 dan < 10, warehouse & company sama)

Jika Available Stock < Qty IKB → Tolak Otomatis
  Pesan: "Stok untuk {item} tidak mencukupi (Available: X, Requested: Y)"
```

### 2.4 Cancel Approval

```
Status antara 2–10
Bisa cancel jika: Admin ATAU user yang menandatangani step itu

Side effect:
  Status −1 (5 → 4)
  stuffing_date dihapus jika cancel step 6
  delivery_date dihapus jika cancel step 8
  Attachment Step 8 dihapus jika cancel step 7 atau 8
  ItemTransactions dihapus jika cancel step 9 (status 10 → 9)
```

### 2.5 Revisi

```
Oleh approver step saat ini, alasan wajib
IKB → status: 11 (Revision)
stuffing_date & delivery_date di-reset
Semua tanda tangan dihapus
Jika dari step ≥ 8: attachment Step 8 dihapus
```

### 2.6 Scope Data Index

| Permission | Data Ditampilkan |
|-----------|-----------------|
| `level 1` / `ikb.view.all` | Semua IKB |
| `ikb.view.dept` | IKB se-departemen |
| `ikb.view.warehouse` | IKB se-gudang |
| `ikb.view.subordinate` | IKB bawahan (creator/sales) |
| Tidak ada | IKB sendiri sebagai creator/sales |

### 2.7 Format Nomor IKB (Auto-Generate)

```
IKB.{COMP}.{DEP}.{YYMM}.{NNN}
Contoh: IKB.AGID.LOG.2603.001
```

---

## 3. Permission

### Akses & CRUD IKB

| Aksi | Permission |
|------|-----------|
| Lihat daftar (semua) | `ikb.view.all` |
| Lihat daftar (dept) | `ikb.view.dept` |
| Lihat daftar (warehouse) | `ikb.view.warehouse` |
| Lihat daftar (bawahan) | `ikb.view.subordinate` |
| Buat IKB | Semua user login (tidak ada slug khusus) |
| Edit IKB | `ikb.edit` + Creator/Admin |
| Submit IKB | `ikb.submit` + Sales/Requestor |
| Cancel Submit | `ikb.cancel_submit` + Sales/Requestor |
| Hapus IKB | Creator/Admin, status harus 0 |

### Approval IKB

| Aksi | Permission | Syarat Tambahan |
|------|-----------|----------------|
| Approve Step 1 (SPV) | `ikb.approve.step1` | Sales adalah bawahan |
| Approve Step 2 (Director) | `ikb.approve.step2` | — |
| Approve Step 3 (PPIC) | `ikb.approve.step3` | — |
| Approve Step 4 (Inv.Control) | `ikb.approve.step4` | Stok harus cukup |
| Approve Step 5 (Log.Coord) | `ikb.approve.step5` | — |
| Approve Step 6 (WH Staff) | `ikb.approve.step6` | Stuffing Date wajib |
| Approve Step 7 (WH SPV) | `ikb.approve.step7` | — |
| Approve Step 8 (Security) | `ikb.approve.step8` | Delivery Date + dokumen wajib |
| Approve Step 9 (Log Final) | `ikb.approve.step9` | Dokumen Step 8 harus ada |
| Set Stuffing Date | `ikb.approve.step6` | Status = 6 |
| Set Delivery Date | `ikb.approve.step8` | Status = 8 |
| Cancel Approval | Admin / Signer step sebelumnya | Status 2–10 |
| Revisi IKB | Approver step saat ini | Alasan wajib |
| Tolak IKB | Approver step saat ini | Alasan wajib |

### Detail Item IKB

| Aksi | Permission |
|------|-----------|
| Tambah item | `ikb_detail.create` + Creator |
| Edit item (full) | `ikb_detail.edit` + Creator |
| Edit item (qty saja oleh Inv.Control) | `ikb.approve.step4` saat status 4 |
| Hapus item | `ikb_detail.delete` + Creator |
| Lihat kontrak dalam dropdown | `contract.view.all` / `contract.view.departement` / `contract.view.subordinate` |

---

## 4. Langkah CRUD

### Buat IKB (Create)

1. Klik **New IKB** (semua user yang login bisa buat)
2. Isi FormModal:

| Field | Required | Keterangan |
|-------|----------|-----------|
| Doc Type | ✅ | Hanya Doc Type 4 tersedia |
| Company | ✅ | — |
| Departement | ✅ | — |
| Warehouse | ✅ | Gudang asal barang |
| Sales/Requestor | ✅ | User pengaju IKB |
| Transaction Type | ✅ | Jenis transaksi |
| Booking Date | ✅ | Tanggal booking |
| Destination | ✅ | Tujuan pengiriman |
| Vendor | ❌ | Opsional |
| PO / SO / RI / SK / DO / Batch | ❌ | Nomor referensi opsional |

3. Nomor IKB di-generate otomatis → status: **0 (Draft)**

### Tambah Item Detail IKB

1. Di halaman Detail, klik **Add Item** (status 0/11, perlu `ikb_detail.create` + Creator)
2. Isi modal:

| Field | Required | Validasi |
|-------|----------|---------|
| Item Category | ✅ | Hanya kategori dengan stok tersedia |
| Item | ✅ | Hanya item dengan `available_stock > 0` |
| Quantity | ✅ | Harus ≤ available stock |
| UOM | ✅ | — |
| Packaging | ✅ | — |
| Contract | ❌ | Jika punya permission lihat contract |

3. Simpan → cek stok ulang di server

### Submit IKB

1. Klik **Submit IKB** (perlu `ikb.submit`, status 0/11, minimal 1 item)
2. Status → **1 (Pending SPV/Manager)**

### Approve Step 4 — Inventory Control

1. Cek stok selihat per item
2. Bisa edit **Qty saja** (tidak bisa ganti item/kategori)
3. Jika stok cukup → approve → status: **5**

### Step 6 — Set Stuffing Date

1. Klik tombol **Set Stuffing Date** (perlu `ikb.approve.step6`, status = 6)
2. Pilih tanggal → simpan → lanjutkan approve

### Step 8 — Upload Dokumen + Set Delivery Date

1. Set **Delivery Date** via tombol khusus
2. Upload minimal 1 dokumen/foto (attachment setelah Step 7)
3. Baru bisa approve → status: **9**

### Step 9 → Selesai (Stok Dikurangi Otomatis)

1. Log Coord Final approve
2. Validasi dokumen Step 8 ada
3. Sistem auto-insert `tbl_item_transactions`:
   - `outcome = qty` per item detail
   - `transaction_code = IKB-{ikb_number}-{index}`
4. IKB → status **10 (Selesai)**

### Error Bisnis

| Kondisi | Pesan |
|---------|-------|
| Submit tanpa detail | "IKB tidak dapat diajukan karena belum ada item detail!" |
| Step 1: Sales bukan bawahan | Tombol Approve tidak tampil |
| Step 4: Stok tidak cukup | "Stok untuk {item} tidak mencukupi (Available: X, Requested: Y)" |
| Step 6 tanpa Stuffing Date | "Stuffing Date wajib diisi sebelum approve Step 6." |
| Step 8 tanpa Delivery Date | "Delivery Date wajib diisi sebelum approve Step 8." |
| Step 8 tanpa dokumen | "Anda wajib mengunggah dokumen/foto (Step 8)." |
| Step 9 tanpa dokumen Step 8 | "Dokumen/foto security (Step 8) belum diunggah." |
| Revisi/Tolak tanpa alasan | "Alasan revisi/penolakan wajib diisi." |
| IKB Number duplikat | "IKB Number {X} sudah ada. Coba ulangi." |

---

*Terakhir diperbarui: 24 Maret 2026*
