# Dokumentasi Fitur: IKB (Instruksi Keluar Barang)

**Modul**: IKB (Instruksi Keluar Barang)  
**Route Prefix**: `/ikb`  
**Livewire Components**:
- `App\Livewire\Ikb\Index` — Daftar IKB
- `App\Livewire\Ikb\Show` — Detail IKB + Aksi Approval
- `App\Livewire\Ikb\FormModal` — Form Buat/Edit IKB
- `App\Livewire\Ikb\FormDetailModal` — Form Item Detail IKB

---

## 1. Deskripsi Umum

IKB (Instruksi Keluar Barang) adalah modul untuk mengajukan permintaan pengeluaran barang dari gudang. Setiap IKB melewati alur **multi-step approval** dengan 9 langkah tanda tangan digital. Setelah approval final (Step 9), sistem secara otomatis melakukan **pengurangan stok** (stock deduction) dari `tbl_item_transactions`.

IKB menggunakan **Doc Type = 4** pada semua tanda tangan (`tbl_sign_transaction`).

---

## 2. Routes

| Method | URI | Name | Keterangan |
|--------|-----|------|-----------|
| GET | `/ikb` | `ikb.index` | Daftar semua IKB |
| GET | `/ikb/{hash}` | `ikb.show` | Detail IKB (ID di-hash) |

> ID IKB di-obfuscate menggunakan `hashid_encode($id, 'ikb')` di URL.

---

## 3. Status IKB (Alur Lengkap)

| Status | Label | Keterangan |
|--------|-------|-----------|
| `0` | **Draft** | IKB baru dibuat, belum disubmit |
| `1` | **Pending SPV/Manager** | Sudah disubmit, menunggu SPV/Manager |
| `2` | **Pending Director Logistik** | SPV approve, menunggu Director |
| `3` | **Pending PPIC** | Director approve, menunggu PPIC |
| `4` | **Pending Inventory Control** | PPIC approve, menunggu Inventory Control |
| `5` | **Pending Logistic Coordinator** | Inventory Control approve |
| `6` | **Pending Warehouse Staff** | Logistic Coord approve, perlu Stuffing Date |
| `7` | **Pending Warehouse SPV** | Warehouse Staff approve |
| `8` | **Pending Security Officer** | Warehouse SPV approve, perlu Delivery Date + Upload Dokumen |
| `9` | **Pending Log Coord Final** | Security Officer approve |
| `10` | **Selesai / Approved** | Approval final selesai, stok sudah dikurangi |
| `11` | **Revision** | Dikembalikan untuk revisi |
| `12` | **Rejected** | Ditolak permanen |

---

## 4. Alur Approval IKB

```
[Creator buat IKB → status: 0 Draft]
        │
        ▼ submitIkb() — permission: ikb.submit (Sales/Requestor)
          Syarat: minimal 1 item detail
[status: 1 → Pending SPV/Manager]
        │
        ▼ approve(1) — permission: ikb.approve.step1
          Syarat: Sales IKB adalah bawahan langsung approver
[status: 2 → Pending Director Logistik]
        │
        ▼ approve(2) — permission: ikb.approve.step2
[status: 3 → Pending PPIC]
        │
        ▼ approve(3) — permission: ikb.approve.step3
[status: 4 → Pending Inventory Control]
        │  ← Validasi stok dilakukan di sini
        │  ← Inventory Control bisa edit qty detail
        ▼ approve(4) — permission: ikb.approve.step4
[status: 5 → Pending Logistic Coordinator]
        │
        ▼ approve(5) — permission: ikb.approve.step5
[status: 6 → Pending Warehouse Staff]
        │ ← Wajib input Stuffing Date sebelum approve
        ▼ approve(6) — permission: ikb.approve.step6
[status: 7 → Pending Warehouse SPV]
        │
        ▼ approve(7) — permission: ikb.approve.step7
[status: 8 → Pending Security Officer]
        │ ← Wajib input Delivery Date sebelum approve
        │ ← Wajib upload dokumen/foto setelah Step 7
        ▼ approve(8) — permission: ikb.approve.step8
[status: 9 → Pending Log Coord Final]
        │ ← Validasi: dokumen Security Officer harus ada
        ▼ approve(9) — permission: ikb.approve.step9
[status: 10 → SELESAI]
  → Stok otomatis dikurangi (ItemTransaction outcome)
```

---

## 5. Halaman Index (Daftar IKB)

**Route**: `GET /ikb`  
**Access**: `abort(403)` jika tidak punya satupun dari: `ikb.view.all`, `ikb.view.dept`, `ikb.view.warehouse`, `ikb.view.subordinate`, atau `level === 1`

### Scope Data (`visibleTo` scope di model Ikb)

| Permission | Data yang Ditampilkan |
|-----------|----------------------|
| `level === 1` | Semua IKB dari semua user |
| `ikb.view.all` | Semua IKB di sistem |
| `ikb.view.dept` | IKB milik departemen yang sama |
| `ikb.view.warehouse` | IKB milik warehouse yang sama |
| `ikb.view.subordinate` | IKB milik bawahan langsung (creator/sales) |
| Tidak ada special permission | IKB milik sendiri (sebagai creator atau sales) |

### Filter Tersedia

| Filter | Binding | Keterangan |
|--------|---------|-----------| 
| Search | `wire:model.live="search"` | Cari `ikb_number`, `so_number`, `po_number`, `do_number` |
| Warehouse | `filterWarehouse` | Filter by gudang |
| Departement | `filterDepartement` | Filter by departemen |
| Company | `filterCompany` | Filter by perusahaan |
| Status | `filterStatus` | Filter by status IKB |
| Date From | `dateFrom` | Filter tanggal mulai (created_at) |
| Date To | `dateTo` | Filter tanggal akhir (created_at) |

Semua filter tersimpan di query string URL.

### Smart Sorting (CASE WHEN)

Index secara otomatis mem-prioritaskan IKB yang **butuh tindakan user saat ini**:

| Prioritas | Kondisi |
|-----------|---------|
| 0 | IKB milik user saat ini dengan status Draft (0) atau Revision (11) |
| 1 | IKB milik subordinate dengan status 0 atau 1 (menunggu step1) |
| 2 | IKB status menunggu persetujuan Step 1 (ikb.approve.step1) |
| 3+ | Status menunggu persetujuan Step 2–9 (sesuai permission user) |
| 99 | IKB yang tidak butuh tindakan user |

### Tombol Aksi di Index

| Tombol | Kondisi | Aksi |
|--------|---------|------|
| 🗑️ Hapus | Admin ATAU Creator, status = 0 (belum submit) | `delete($id)` — hapus IKB + details + attachments + signTransactions |
| Lihat detail | Selalu tampil | Link ke `ikb.show` |

---

## 6. Halaman Detail IKB (`show.blade.php`)

**Route**: `GET /ikb/{hash}`  
**Access**: `abort(403)` jika tidak memenuhi syarat view  

### Kondisi Dapat Melihat Detail IKB

User dapat melihat detail IKB jika memenuhi **salah satu** dari:

| Kondisi |
|---------|
| `level === 1` (Admin) |
| Creator IKB (`id_user`) |
| Sales/Requestor IKB (`sales`) |
| `ikb.view.all` |
| `ikb.view.dept` + departemen sama |
| `ikb.view.warehouse` + warehouse sama |
| `ikb.view.subordinate` + sales/creator adalah bawahan |
| Memiliki permission `ikb.approve.step1` s/d `step9` |

### Informasi Header IKB

| Field | Sumber |
|-------|--------|
| IKB Number | `ikb_number` (format: `IKB.{COMP}.{DEP}.{YYMM}.{NNN}`) |
| Doc Type | `docType.doc_type` |
| Transaction Type | `transactionType.transaction_type` |
| Company | `company.company_name` |
| Departement | `departement.departement` |
| Warehouse | `warehouse.warehouse_name` |
| Vendor | `vendor.vendor` (opsional) |
| Sales/Requestor | `salesUser.name` |
| Creator | `user.name` |
| Booking Date | `booking_date` |
| Stuffing Date | `stuffing_date` (diisi saat Step 6) |
| Delivery Date | `delivery_date` (diisi saat Step 8) |
| Destination | `destination` |
| PO Number | `po_number` (opsional) |
| SO Number | `so_number` (opsional) |
| RI Number | `ri_number` (opsional) |
| SK Number | `sk_number` (opsional) |
| DO Number | `do_number` (opsional) |
| Batch Number | `batch_number` (opsional) |

### Signature Steps (Panel Tanda Tangan)

| Step | Status IKB | Label Approver | Permission Approve |
|------|-----------|---------------|-------------------|
| 0 | — | Sales/Requestor (Box Pengaju) | Diisi saat submitIkb() |
| 1 | `1` | SPV / Manager | `ikb.approve.step1` + sales adalah bawahan |
| 2 | `2` | Director Logistik | `ikb.approve.step2` |
| 3 | `3` | PPIC | `ikb.approve.step3` |
| 4 | `4` | Inventory Control | `ikb.approve.step4` |
| 5 | `5` | Logistic Coordinator | `ikb.approve.step5` |
| 6 | `6` | Warehouse Staff | `ikb.approve.step6` |
| 7 | `7` | Warehouse SPV | `ikb.approve.step7` |
| 8 | `8` | Security Officer | `ikb.approve.step8` |
| 9 | `9` | Log Coord Final | `ikb.approve.step9` |

> QR Code digital otomatis di-generate untuk setiap tanda tangan via `getQr()` menggunakan library `endroid/qr-code`.

### Tombol Aksi di Detail IKB

| Tombol | Kondisi Tampil | Permission / Syarat |
|--------|---------------|---------------------|
| **Submit IKB** | Status 0 atau 11 | Admin ATAU (Sales + `ikb.submit`) + minimal 1 item detail |
| **Cancel Submit** | Status 1 | Admin ATAU (Sales + `ikb.cancel_submit`) |
| **Approve Step N** | Status = N (1–9) | Lihat tabel Signature Steps — `canApproveStepN` |
| **Cancel Approval** | Status 2–10 | Admin ATAU user yang menandatangani step sebelumnya |
| **Revisi** | Status 1–9 | Setiap approver yang punya akses step tersebut; alasan wajib |
| **Tolak** | Status 1–9 | Setiap approver yang punya akses step tersebut; alasan wajib |
| **Edit IKB** | Status 0 atau 11 | Admin ATAU (Creator + `ikb.edit`) |
| **Hapus IKB** | Status 0 | Admin ATAU Creator |
| **Set Stuffing Date** | Status 6 | Admin ATAU `ikb.approve.step6` |
| **Set Delivery Date** | Status 8 | Admin ATAU `ikb.approve.step8` |
| **Tambah/Edit Item** | Status 0, 11, atau 4* | Lihat seksi FormDetailModal |
| **Upload Dokumen** | Status 8 | Untuk keperluan dokumen Security Officer |

---

## 7. Logika Approval Detail

### `canApproveStep1` — SPV/Manager
```
Status IKB harus = 1
Admin → bisa
Memiliki ikb.approve.step1 DAN Sales IKB adalah bawahan langsung user
```

### `canApproveStep2` s/d `canApproveStep9`
```
Status IKB harus = N (sesuai step)
Admin → bisa
Memiliki ikb.approve.stepN
```

### Validasi Khusus Per Step

| Step | Validasi Wajib Sebelum Approve |
|------|-------------------------------|
| Step 4 (Inventory Control) | Stok gudang mencukupi untuk semua item (aktual - reserved) |
| Step 6 (Warehouse Staff) | `stuffing_date` wajib sudah diisi |
| Step 8 (Security Officer) | `delivery_date` wajib + minimal 1 attachment diupload setelah Step 7 |
| Step 9 (Log Coord Final) | Attachment dari Step 8 harus ada |

### Validasi Stok (Step 4)

Sistem menghitung stok tersedia dengan formula:

```
Available Stock = (Total Income - Total Outcome) - Reserved Qty

Reserved Qty = qty dari IKB lain yang status >= 4 dan < 10
               di warehouse & company yang sama
```

Jika `Available Stock < qty yang diminta`, approval **ditolak otomatis**.

### `cancelApproval()`

Membatalkan approval langkah sebelumnya (reversi status):

```
Status harus antara 2–10

Bisa cancel jika:
  - Admin (level === 1)
  - User yang menandatangani step saat ini (sign record ditemukan)

Side effect saat cancel:
  - Status dikurangi 1 (misal status 5 → kembali ke 4)
  - stuffing_date dihapus jika membatalkan step 6
  - delivery_date dihapus jika membatalkan step 8
  - Attachment Step 8 dihapus jika membatalkan step 7 atau 8
  - ItemTransactions (stok) dihapus permanen jika membatalkan step 9 (status 10 → 9)
```

### `revision($step)`

Dikembalikan ke Sales/Requestor untuk revisi:

```
Alasan revisi wajib diisi
IKB → status: 11 (Revision)
stuffing_date dan delivery_date direset ke null
Semua tanda tangan sebelumnya dihapus
Jika revision dari step >= 8: attachment Step 8 juga dihapus
```

### `reject($step)`

Penolakan permanen:

```
Alasan penolakan wajib diisi
IKB → status: 12 (Rejected)
stuffing_date dan delivery_date direset ke null
Jika reject dari step >= 8: attachment Step 8 dihapus
```

### Approval Final (Step 9) — Stock Deduction

Ketika Step 9 di-approve, sistem **otomatis**:
1. IKB → status `10` (Selesai)
2. Hapus semua `ItemTransaction` lama dengan prefix `IKB-{ikb_number}` (untuk mencegah duplikasi)
3. Buat `ItemTransaction` baru untuk setiap item detail:
   - `outcome = qty` (pengeluaran stok)
   - `income = 0`
   - `transaction_code = IKB-{ikb_number}-{index}`
   - `id_doc_type = 4`
   - `description` berisi: RI, SK, DO, Batch, Destination, Delivery Date

---

## 8. Form Buat / Edit IKB (`FormModal`)

**Trigger**: Event `open-ikb-form` dari Livewire

Form dikelola oleh **Alpine.js** di client-side, validasi server-side dilakukan saat simpan (`saveFromJs()`).

### Field Wajib

| Field | Validasi | Keterangan |
|-------|---------|-----------|
| Doc Type | `required` | Hanya Doc Type ID 4 tersedia |
| Company | `required` | Perusahaan |
| Departement | `required` | Departemen |
| Warehouse | `required` | Gudang asal barang |
| Sales/Requestor | `required` | User sebagai pengaju IKB |
| Transaction Type | `required` | Jenis transaksi IKB |
| Booking Date | `required\|date` | Tanggal pemesanan |
| Destination | `required` | Tujuan pengiriman |

### Field Opsional

| Field | Keterangan |
|-------|-----------|
| Vendor | Vendor/supplier (nullable) |
| PO Number | Nomor Purchase Order |
| SO Number | Nomor Sales Order |
| RI Number | Nomor Receiving Inspection |
| SK Number | Nomor Surat Keputusan |
| DO Number | Nomor Delivery Order |
| Batch Number | Nomor batch produksi |
| Stuffing Date | Tanggal stuffing (bisa diisi saat buat/edit, tapi juga bisa diisi via button terpisah di Step 6) |
| Delivery Date | Tanggal pengiriman (bisa diisi saat buat/edit, juga via button di Step 8) |

### Pembangkitan Nomor IKB

Format: `IKB.{COMP}.{DEP}.{YYMM}.{NNN}`

| Komponen | Cara Pengambilan |
|----------|-----------------|
| COMP | Nama perusahaan (`company.company`) |
| DEP | Nama departemen (`departement.departement`) |
| YY | 2 digit tahun terakhir |
| MM | 2 digit bulan |
| NNN | Nomor urut 3 digit, dari `MAX(number)` di dept + tahun yang sama |

> Contoh: `IKB.AGID.LOG.2603.001`

Sistem cek keunikan `ikb_number` sebelum simpan. Jika sudah ada → error dikembalikan.

### Kondisi Edit

- Hanya status **Draft (0)** atau **Revision (11)** yang bisa diedit
- Harus Admin, Creator, atau `ikb.edit`
- Jika IKB berstatus Revision (11) dan diedit → status otomatis direset ke 0 (Draft)

### Data Dropdown yang Di-cache (2 jam)

`departements`, `companies`, `warehouses`, `vendors`

> `Doc Types` tidak di-cache (query langsung, filter `id_doc_type = 4`)  
> `Transaction Types` tidak di-cache (filter `is_active = 1`)

---

## 9. Form Item Detail IKB (`FormDetailModal`)

**Trigger**: Event `openModal` dari Livewire

### Field

| Field | Required | Validasi | Keterangan |
|-------|----------|---------|-----------| 
| Item Category | ✅ | `required` | Kategori barang (hanya tampil kategori yg ada stoknya) |
| Item | ✅ | `required` | Barang yang diminta (hanya item dengan stok tersedia) |
| Quantity | ✅ | `required\|numeric\|min:0.01` | Jumlah — divalidasi vs stok tersedia |
| UOM | ✅ | `required` | Satuan ukuran |
| Packaging | ✅ | `required` | Kemasan |
| Contract | ❌ | — | Kontrak terkait (jika user punya permission view contract) |

> Dropdown **Item** hanya menampilkan item dengan `available_stock > 0`.  
> Stok sudah dikurangi reservasi dari IKB lain yang status ≥ 5 dan < 10.

### Mode Edit Inventory Control (Status 4)

Ketika IKB berstatus 4 (Pending Inventory Control) dan user memiliki `ikb.approve.step4` **tanpa** `ikb_detail.edit`:
- Mode edit **terbatas**: hanya kolom `qty` yang bisa diubah
- Kolom category, item, UOM, packaging **tidak bisa diubah** (`isInvCtrlEditMode = true`)

### Validasi Stok Pre-emptive (Saat Tambah/Edit Item)

Sebelum menyimpan, sistem memvalidasi stok:

```
Available Stock = (Total Income - Total Outcome dari tbl_item_transactions)
                - Reserved Qty dari IKB lain (status >= 5 dan < 10)

Jika Available Stock < Qty yang diminta → Error dikembalikan
```

### Permission untuk Detail Item

| Aksi | Kondisi |
|------|---------|
| Tambah item | Admin ATAU (Creator + `ikb_detail.create`) |
| Edit item (full) | Admin ATAU (Creator + `ikb_detail.edit`) |
| Edit item (qty only) | `ikb.approve.step4` + IKB status 4 (Inventory Control mode) |
| Hapus item | Admin ATAU (Creator + `ikb_detail.delete`) |

> IKB harus berstatus **Draft (0) atau Revision (11)** untuk tambah/edit/hapus oleh Creator.  
> Inventory Control hanya bisa edit saat status **4**.

### Delete Detail — Side Effect

Jika detail dihapus saat IKB berstatus **11 (Revision)**, IKB otomatis dikembalikan ke status **0 (Draft)**.

### Data Dropdown Kontrak (`Contract`)

Kontrak ditampilkan jika user memiliki permission view contract:

| Permission | Kontrak yang Ditampilkan |
|-----------|------------------------|
| `level === 1` | Semua kontrak |
| `contract.view.all` | Semua kontrak |
| `contract.view.departement` | Kontrak departemen IKB ini |
| `contract.view.subordinate` | Kontrak milik bawahan |

---

## 10. Manajemen Attachment

IKB mendukung upload dokumen/foto via `AttachmentIkb`. Attachment sangat penting di **Step 8** (Security Officer).

### Mekanisme Attachment Step 8

- Attachment yang dianggap "milik Step 8" adalah attachment yang diunggah **setelah** timestamp approval Step 7
- Jika revision/reject dari step ≥ 8, semua attachment Step 8 **dihapus otomatis** (file fisik + record DB via `forceDelete()`)
- File disimpan di: `public/assets/attachmentikb/`

### Validasi Attachment

| Kondisi | Aksi |
|---------|------|
| Approval Step 8 tanpa attachment | Error: "Anda wajib mengunggah dokumen/foto" |
| Approval Step 9 tanpa attachment Step 8 | Error: "dokumen/foto security belum diunggah" |

---

## 11. Validasi & Error Penting

| Kondisi | Pesan / Aksi |
|---------|-------------|
| Submit tanpa minimal 1 item detail | "IKB tidak dapat diajukan karena belum ada item detail!" |
| Submit bukan oleh Sales + `ikb.submit` | 403 |
| Cancel submit bukan oleh Sales + `ikb.cancel_submit` | "Harus Sales tertunjuk dengan izin cancel_submit" |
| Approve Step 1: Sales bukan bawahan approver | Tidak bisa approve (`canApproveStep1 = false`) |
| Approve tanpa permission | `canApproveStepN = false` (tombol tidak tampil) |
| Approve Step 4: stok tidak mencukupi | "Stok untuk {item} tidak mencukupi (Available: X, Requested: Y)" |
| Approve Step 6 tanpa Stuffing Date | "Stuffing Date wajib diisi sebelum melakukan approval Step 6" |
| Approve Step 8 tanpa Delivery Date | "Delivery Date wajib diisi sebelum melakukan approval Step 8" |
| Approve Step 8 tanpa upload dokumen | "Anda wajib mengunggah dokumen/foto (Step 8)" |
| Approve Step 9 tanpa dokumen Step 8 | "dokumen/foto security (Step 8) belum diunggah" |
| Revisi tanpa alasan | "Alasan revisi wajib diisi." |
| Tolak tanpa alasan | "Alasan penolakan wajib diisi." |
| Tambah item: stok tidak cukup | "Stok untuk {item} tidak mencukupi (Available: X, Requested: Y)" |
| Edit IKB yang sedang diproses | "IKB yang sedang diproses tidak dapat diedit." |
| Hapus IKB: status > 0 | "IKB yang sudah diajukan tidak dapat dihapus." |
| Cancel approval tanpa menjadi signer | "Anda tidak memiliki hak akses untuk membatalkan approval ini." |
| IKB Number sudah ada | "IKB Number {number} sudah ada. Coba ulangi." |

---

## 12. Ringkasan Permission Lengkap

### Akses & CRUD IKB

| Aksi | Permission Slug |
|------|----------------|
| Akses daftar IKB (semua) | `ikb.view.all` |
| Akses daftar IKB (satu dept) | `ikb.view.dept` |
| Akses daftar IKB (satu warehouse) | `ikb.view.warehouse` |
| Akses daftar IKB (bawahan) | `ikb.view.subordinate` |
| Buat IKB baru | Semua user yang login (tidak ada permission khusus buat) |
| Edit IKB | `ikb.edit` (+ harus Creator/Admin) |
| Submit IKB | `ikb.submit` (+ harus Sales/Requestor) |
| Batalkan submit IKB | `ikb.cancel_submit` (+ harus Sales/Requestor) |
| Hapus IKB | Hanya Creator/Admin, status harus 0 |

### Proses Approval IKB

| Aksi | Permission Slug | Syarat Tambahan |
|------|----------------|----------------|
| Approve Step 1 (SPV/Manager) | `ikb.approve.step1` | Sales IKB adalah bawahan |
| Approve Step 2 (Director) | `ikb.approve.step2` | — |
| Approve Step 3 (PPIC) | `ikb.approve.step3` | — |
| Approve Step 4 (Inventory Control) | `ikb.approve.step4` | Stok harus cukup |
| Approve Step 5 (Logistic Coord) | `ikb.approve.step5` | — |
| Approve Step 6 (Warehouse Staff) | `ikb.approve.step6` | Stuffing Date wajib diisi |
| Approve Step 7 (Warehouse SPV) | `ikb.approve.step7` | — |
| Approve Step 8 (Security Officer) | `ikb.approve.step8` | Delivery Date + dokumen upload |
| Approve Step 9 (Log Coord Final) | `ikb.approve.step9` | Dokumen Step 8 harus ada |
| Set Stuffing Date | `ikb.approve.step6` | Status IKB = 6 |
| Set Delivery Date | `ikb.approve.step8` | Status IKB = 8 |
| Cancel Approval | Admin atau signer step sebelumnya | Status antara 2–10 |
| Revisi IKB | Approver step saat ini | Alasan wajib |
| Tolak IKB | Approver step saat ini | Alasan wajib |

### Detail Item IKB

| Aksi | Permission Slug |
|------|----------------|
| Tambah item detail | `ikb_detail.create` (+ harus Creator) |
| Edit item detail (full) | `ikb_detail.edit` (+ harus Creator) |
| Edit item detail (qty only) | `ikb.approve.step4` saat status 4 |
| Hapus item detail | `ikb_detail.delete` (+ harus Creator) |

### Kontrak di Detail

| Aksi | Permission Slug |
|------|----------------|
| Lihat & pilih kontrak di form detail | `contract.view.all` ATAU `contract.view.departement` ATAU `contract.view.subordinate` |

---

## 13. Diagram Alur Lengkap IKB

```
CREATE IKB (user mana saja)
  └→ status: 0 (Draft)
       │
  ┌────┤ Edit IKB (ikb.edit atau creator) — hanya status 0, 11
  └────┤ Tambah detail (ikb_detail.create + creator) + Validasi Stok Awal
       │
       ▼ submitIkb (ikb.submit + sales) — minimal 1 detail
  status: 1 (Pending SPV/Manager)
       │
  ┌────┤ cancelSubmit (sales + ikb.cancel_submit) → kembali ke 0
  └────┤ approve step1 (ikb.approve.step1 + sales adalah bawahan)
       │
  status: 2 (Pending Director Logistik)
       │
  ┌────┤ cancelApproval → kembali ke 1
  └────┤ approve step2 (ikb.approve.step2)
       │
  status: 3 (Pending PPIC)
       │
  └────┤ approve step3 (ikb.approve.step3)
       │
  status: 4 (Pending Inventory Control)
  ─── Validasi stok penuh di sini ───
  ─── Inventory Control bisa edit qty detail ───
       │
  └────┤ approve step4 (ikb.approve.step4) → jika stok cukup
       │
  status: 5 (Pending Logistic Coordinator)
       │
  └────┤ approve step5 (ikb.approve.step5)
       │
  status: 6 (Pending Warehouse Staff)
  ─── Set Stuffing Date wajib sebelum approve ───
       │
  └────┤ approve step6 (ikb.approve.step6)
       │
  status: 7 (Pending Warehouse SPV)
       │
  └────┤ approve step7 (ikb.approve.step7)
       │
  status: 8 (Pending Security Officer)
  ─── Set Delivery Date wajib ───
  ─── Upload dokumen/foto wajib ───
       │
  └────┤ approve step8 (ikb.approve.step8)
       │
  status: 9 (Pending Log Coord Final)
  ─── Validasi dokumen Step 8 ───
       │
       ▼ approve step9 (ikb.approve.step9)
  status: 10 (SELESAI)
  ─── Stock Deduction otomatis ke tbl_item_transactions ───

─── Di mana saja selama status 1–9: ───
  Revision (oleh approver step saat ini) → status: 11 + semua sign dihapus
                                         → stuffing_date & delivery_date direset
                                         → jika dari step >= 8: attachment Step 8 dihapus
  Reject (oleh approver step saat ini)   → status: 12
                                         → stuffing_date & delivery_date direset
                                         → jika dari step >= 8: attachment Step 8 dihapus

─── Cancel Approval (Admin/Signer terakhir): ───
  Reversi status -1 (misal 5 → 4)
  Jika cancel step 9 (status 10 → 9): ItemTransaction stok dihapus permanent
```

---

*Dokumentasi dibuat dari: `app/Livewire/Ikb/` (4 komponen), `app/Models/Ikb.php`, `app/Models/IkbDetail.php`, `app/Models/SignTransaction.php`, `app/Models/AttachmentIkb.php`*  
*Terakhir diperbarui: 23 Maret 2026*
