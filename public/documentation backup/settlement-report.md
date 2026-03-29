# Dokumentasi Fitur: Settlement Report (SR)

**Modul**: Settlement Report  
**Route Prefix**: `/settlement-reports`  
**Livewire Components**:
- `App\Livewire\SettlementReports\Index` — Daftar SR
- `App\Livewire\SettlementReports\Show` — Detail SR + Aksi Approval
- `App\Livewire\SettlementReports\FormModal` — Form Buat/Edit SR
- `App\Livewire\SettlementReports\FormDetailModal` — Form Item Detail SR
- `App\Livewire\SettlementReports\PaymentModal` — Form Input Pembayaran SR
- `App\Livewire\SettlementReports\PaymentShow` — Halaman Detail Pembayaran SR

---

## 1. Deskripsi Umum

Settlement Report (SR) adalah modul untuk pelaporan dan pertanggungjawaban penggunaan dana yang telah dibayarkan melalui **Payment Request (PR)**. SR selalu terhubung dengan PR induknya (melalui `id_pr`). SR biasanya dibuat dari halaman Show PR Advance (Doc Type 2), sehingga **tidak ada tombol "New SR" di halaman index SR**.

SR menggunakan **Doc Type 3 (Settlement)** secara default dan melewati alur **multi-step approval** yang serupa dengan PR, namun dengan perbedaan pada koneksi ke advance PR.

**Tipe Doc Type yang relevan di konteks SR Index:**

| Doc Type ID | Nama | Keterangan |
|-------------|------|------------|
| 1 | Payment | PR tipe pembayaran biasa |
| 2 | Advance | PR tipe uang muka (advance), yang memiliki SR terkait |
| 3 | Settlement | SR itu sendiri |
| 4 | IKB | Item Knowledge Base |

---

## 2. Routes

| Method | URI | Name | Keterangan |
|--------|-----|------|-----------|
| GET | `/settlement-reports` | `settlement-reports.index` | Daftar semua SR |
| GET | `/settlement-reports/{hash}` | `settlement-reports.show` | Detail SR |
| GET | `/settlement-reports/{hash}/payment` | `settlement-reports.payment` | Halaman pembayaran SR |
| GET | `/settlement-reports/{hash}/edit` | `settlement-reports.edit` | Edit SR (status Draft) |
| POST | `/settlement-reports/{hash}/attachment` | `settlement-reports.attachment.store` | Upload dokumen pendukung SR |
| POST | `/settlement-reports/attachment/{hash}` | `settlement-reports.attachment.update` | Update dokumen pendukung SR |
| DELETE | `/settlement-reports/attachment/{hash}` | `settlement-reports.attachment.delete` | Hapus dokumen pendukung SR |
| POST | `/settlement-reports/{hash}/payment/store` | `settlement-reports.payment.store` | Simpan payment SR |
| POST | `/settlement-reports/payment/{hash}/update` | `settlement-reports.payment.update` | Update payment SR |
| GET | `/settlement-reports/payment/{hash}/delete` | `settlement-reports.payment.delete` | Hapus payment SR |
| POST | `/settlement-reports/{hash}/att-payment/store` | `settlement-reports.attachment-payment.store` | Upload bukti transfer payment |
| POST | `/settlement-reports/att-payment/{id}/update` | `settlement-reports.attachment-payment.update` | Update bukti transfer |
| GET | `/settlement-reports/att-payment/{id}/delete` | `settlement-reports.attachment-payment.delete` | Hapus bukti transfer |
| GET | `/settlement-reports/payment/{hash}/print` | `settlement-reports.payment.print` | Print struk payment |
| GET | `/settlement-reports/payment/{hash}/download` | `settlement-reports.payment.download` | Download struk payment |

> ID SR di-obfuscate menggunakan `hashid_encode($id_pr, 'pr')` di URL.

---

## 3. Status SR (Alur Lengkap)

| Status | Label | Keterangan |
|--------|-------|-----------| 
| `0` / `null` | **Draft** | SR baru dibuat, belum disubmit |
| `1` | **Pending Dept Sign** | Sudah disubmit, menunggu persetujuan Dept/Atasan |
| `2` | **Pending Director Sign** | Dept approve, menunggu Director |
| `3` | **Pending Accounting Sign** | Director approve (khusus Doc Type 1 & 3) |
| `4` | **Pending Finance Sign** | Accounting approve (atau Director approve to jika Doc Type 2) |
| `5` | **Pending SPV Finance Sign** | Finance approve |
| `6` | **Pending CFO Sign** | SPV Finance approve |
| `7` | **Pending Payment** | CFO approve, siap diproses pembayaran |
| `8` | **Payment Parsial** | Sebagian dibayar |
| `9` | **Pending Receipt Parsial** | Parsial dalam proses penerimaan receipt |
| `10` | **Pending Receipt** | Menunggu penerimaan receipt |
| `11` | **Paid / Balance Settled** | Lunas/terbayar penuh atau balance sudah settled |
| `12` | **Revision** | Dikembalikan untuk revisi oleh approver |
| `13` | **Rejected** | Ditolak permanen |
| `14` | **Pending Director Sign Payment** | Menunggu approval pembayaran step 1 (Director) |
| `15` | **Pending Manager Sign Payment** | Menunggu approval pembayaran step 2 (Manager) |

---

## 4. Alur Approval SR

```
[Creator/System buat SR → status: 0 Draft]
        │
        ▼ submitSr() — permission: sr.submit
[status: 1 → Pending Dept Sign]
        │
        ▼ approve() — permission: sr.approve.step1 + dept sama / supervisor
[status: 2 → Pending Director Sign]
        │
        ▼ approve() — permission: sr.approve.step2
[status: 3 → Pending Accounting Sign]  ← hanya Doc Type 1 & 3
[status: 4 → Pending Finance Sign]     ← Doc Type 2 skip ke sini
        │
        ▼ approve() — permission: sr.approve.step3
[status: 4 → Pending Finance Sign]
        │
        ▼ approve() — permission: sr.approve.step4
[status: 5 → Pending SPV Finance Sign]
        │
        ▼ approve() — permission: sr.approve.step5
[status: 6 → Pending CFO Sign]
        │
        ▼ approve() — permission: sr.approve.step6
[status: 7 → Siap diproses ke pembayaran]
```

### Panel Tanda Tangan (Signature Steps)

| Sign Step (status value) | Label Kolom | Role |
|--------------------------|-------------|------|
| 1 | Requested By | Submitter / Creator |
| 2 | Verified By | Department Head |
| 3 atau 4 (tergantung Doc Type) | Approved By | Director |
| 4 (untuk Doc Type 1 & 3) | Checked By | Accounting |
| 5 | Prepared By | Finance Staff |
| 6 | Verified By | Finance Supervisor |
| 7 | Authorized By | Chief Finance Officer (CFO) |

> QR Code digital otomatis di-generate untuk setiap tanda tangan via `getQr()` menggunakan library `endroid/qr-code`.

---

## 5. Halaman Index (Daftar SR)

**Route**: `GET /settlement-reports`  
**Poll**: Auto-refresh setiap 10 detik (`wire:poll.10s`)

### Scope Data

Index SR menampilkan dokumen yang merupakan Settlement Report atau PR Advance yang memiliki SR, sesuai visibilitas user.

### Filter Tersedia

| Filter | Binding | Keterangan |
|--------|---------|-----------|
| Search | `wire:model.live.debounce.300ms="search"` | Cari SR/PR No atau Subject |
| Departement | `filterDepartement` | Filter by departemen (hanya level 1 atau `sr.view.all`) |
| Company | `filterCompany` | Filter by perusahaan |
| Status PR | `filterStatus` | Filter by status PR yang terkait |
| Status SR | `filterSrStatus` | Filter by status SR itu sendiri |
| Date From | `dateFrom` | Filter tanggal mulai |
| Date To | `dateTo` | Filter tanggal akhir |
| Per Page | `perPage` | 10 / 25 / 50 item per halaman |

Semua filter tersimpan di query string URL.

### Kolom Tabel Index

| Kolom | Isi |
|-------|-----|
| # | No. urut |
| DOC TYPE | Badge doc type (Payment/Advance/Settlement/IKB) + Payment Type (Parsial/Full) |
| PR NUMBER | Nomor PR + BL Number + PO Number |
| SUBJECT & USER | Subject, departemen, nama user pembuat |
| BANK & VENDOR | Nama vendor, nama bank, no rekening, nama penerima |
| AMOUNT | Total amount, discount, total, settlement/pending (untuk non-Advance) atau SR Amount & Balance (untuk Doc Type 2 Advance) |
| DATES | Payment Due Date & Est. Settlement Date |
| STATUS | Badge status SR saat ini |
| ACTIONS | Tombol View, Edit, Delete |

### Kalkulasi Amount di Index

**Untuk Doc Type bukan 2 (bukan Advance):**
- Amount = `total_amount`
- Discount = `additional_discount`  
- Total = Amount − Discount
- Settlement = sum `grand_total` semua payments
- Pending = Total − Settlement

**Untuk Doc Type 2 (Advance) dengan SR terkait:**
- Total advance (PR) = Amount − Discount
- SR Amount = sum detail ammont SR − additional_discount SR
- Balance = SR Amount − Advance given
  - > 0 = Kurang Bayar
  - < 0 = Lebih Bayar / Refund
  - = 0 = Settled

### Tombol Aksi di Index

| Tombol | Kondisi | Aksi |
|--------|---------|------|
| 👁️ View | Selalu tampil | Link ke `settlement-reports.show` |
| ✏️ Edit | Status = 0 DAN (Admin ATAU `sr.delete` ATAU Creator) | Link ke `settlement-reports.edit` |
| 🗑️ Delete | Status = 0 DAN (Admin ATAU `sr.delete` ATAU Creator) | `delete($id)` via Livewire confirm |

---

## 6. Halaman Detail SR (`show.blade.php`)

**Route**: `GET /settlement-reports/{hash}`

### Informasi Header SR

| Field | Sumber |
|-------|--------|
| Subject | `sr.subject` |
| SR Category | Selalu "Settlement" |
| Cost Category | `sr.costCategory` atau `sr.pr.costCategory` |
| Expense (Cost Type) | `sr.costType` atau `sr.pr.costType` |
| Loan | `sr.loan` — bisa di-manage jika Admin/`loan.view` dan status bukan 11 |
| Settlement Date | `sr.created_at` |
| Payment Due Date | `sr.pr.payment_due_date` |
| Est. Settlement Date | `sr.pr.est_settlement_date` (jika doc_type 2 atau 3) |
| PR Number | `sr.pr.pr_number` |
| Branch | `sr.branch` atau `sr.pr.branch` |
| Departement | `sr.departement` atau `sr.pr.departement` |
| Vendor | `sr.vendor` atau `sr.pr.vendor` |
| No. Invoice | `sr.no_invoice` atau `sr.pr.no_invoice` |
| PO Number | `sr.pr.po_number` |
| Email | Email vendor + email user (dari SR atau PR) |
| NPWP/NIK | Dari data vendor (di-decrypt) |
| Payment Method | Transfer (1) / Cash (2) |
| Payment Type | Parsial (1) / Full Payment (2) dari `sr.pr.payment_type_pr` |
| Bank Name | Cascade: SR → norekVendor SR → PR → norekVendor PR |
| Account Name | Cascade: SR → norekVendor SR → PR → norekVendor PR |
| Account Number | Cascade: SR → norekVendor SR → PR → norekVendor PR |

### Kalkulasi Ringkasan Keuangan

| Field | Kalkulasi |
|-------|-----------|
| Grand Total | `sum(details.ammount)` − `additional_discount` |
| Total Receipts | Sum `grand_total` semua payment SR |
| Refund | Ditampilkan jika Total Receipts ≠ Grand Total |
| Balance | Grand Total − Total Receipts |

### Tombol Aksi di Detail SR

| Tombol | Kondisi Tampil | Permission / Kondisi |
|--------|---------------|---------------------|
| **Submit SR** | Status 0 atau 12 | (Admin atau Creator) + `sr.submit` |
| **Cancel Submit** | Status 1 | Admin, Creator, supervisor + `sr.cancel_submit`, atau `sr.cancel_submit` |
| **Approve** | Status 1–6 | `canUserApproveCurrentStep()` |
| **Revision** | Status 1–6 (saat approve tersedia) | Admin atau `sr.revision` |
| **Reject** | Status 1–6 (saat approve tersedia) | Admin atau `sr.reject` |
| **Cancel Approval** | Status 2–7 | `canUserCancelApproval()` |
| **Payment** | Status 7,8,9,10,11,14,15 | Admin, `sr_payment.view`, atau Creator |
| **Download PDF** | Status 3–11 | Admin, Creator, atau `sr.print` |
| **Print** | Status 3–11 | Admin, Creator, atau `sr.print` |
| **Edit** | Status 0, 12 | Admin, Creator, atau `sr.edit` |
| **Delete** | Status 0, 13 | Admin atau Creator |
| **ADD (item detail)** | Status null/0/12 | Admin atau (Creator + `sr_detail.create`) |

---

## 7. Logika Approval Detail

### `canUserApproveCurrentStep()`

```
Status harus antara 1–6

Step 1 (Status 1 — Dept Review):
  - TIDAK BOLEH approve milik sendiri (creator), kecuali Admin
  - Admin → bisa
  - Memiliki sr.approve.step1 DAN dept sama ATAU adalah supervisor SR

Step 2 (Status 2 — Director):
  - Creator dilarang approve SR sendiri (kecuali Admin)
  - Admin atau sr.approve.step2

Step 3 (Status 3 — Accounting):
  - Hanya Doc Type 1 & 3 (Doc Type 2 skip)
  - Admin atau sr.approve.step3

Step 4 (Status 4 — Finance):
  - Admin atau sr.approve.step4

Step 5 (Status 5 — SPV Finance):
  - Admin atau sr.approve.step5

Step 6 (Status 6 — CFO):
  - Admin atau sr.approve.step6
```

### `canUserCancelApproval()`

Membatalkan approval yang sudah diberikan (reversi ke status sebelumnya):

```
Status harus antara 2–7

Bisa cancel jika:
  - Admin
  - Memiliki permission sr.cancel_approve.step{status-1}
  - Atau: user yang menandatangani step saat ini (sign record ditemukan)

Doc Type 2, status 4: revert ke 2 (bukan 3, karena step 3 di-skip)
```

---

## 8. Form Buat / Edit SR (`FormModal`)

**Trigger**: Event `open-sr-form-js` dari Livewire  
**Modal ID**: `srFormModal`

Form dikelola oleh **Alpine.js** di client-side, validasi server-side dilakukan saat simpan (`saveFromJs()`).

### Mode Form

| Mode | Kondisi |
|------|---------|
| **Create baru** | `isEditing = false`, `isNewFromPr = false` |
| **Create dari PR** | `isNewFromPr = true` — field vendor, bank, payment method, norek di-disable |
| **Edit SR** | `isEditing = true`, `srId = id_sr` |

### Field Form SR

| Field | Required | Kondisi | Keterangan |
|-------|----------|---------|-----------|
| Subject | ✅ | — | Keperluan/perihal SR |
| Payment Method | ✅ | Di-disable jika `isNewFromPr` | Cash (1) / Bank Transfer (2) |
| Settlement Date (`payment_due_date`) | ✅ | — | Tanggal aktual settlement |
| Vendor | ✅ | Di-disable jika `isNewFromPr` | Pilih dari daftar vendor aktif |
| Vendor Email | ❌ | Di-disable jika vendor belum dipilih | Email vendor (load via API) |
| Vendor Bank (`id_norek_vendor`) | ❌ | Di-disable jika vendor belum dipilih | Rekening terdaftar vendor (load via API) |
| No Invoice / Ref | ❌ | Di-disable jika `isNewFromPr` | Nomor invoice |
| Additional Discount | ❌ | — | Potongan header (dari grand total SR) |
| **Target Pembayaran Manual** (tampil jika tidak ada `id_norek_vendor`) | | | |
| — Nama Bank | ✅* | *Required jika tidak ada norek vendor | Nama bank penerima |
| — Nomor Rekening | ✅* | *Required jika tidak ada norek vendor | No rekening penerima |
| — Nama Penerima | ✅* | *Required jika tidak ada norek vendor | Nama pemilik rekening |
| **Loan Information** (hanya Admin atau `loan.view`) | | | |
| — Tipe Loan | ❌ | Di-disable jika `isNewFromPr` | Pilih sumber dana dari `tbl_loans` |

### Doc Type SR

SR selalu menggunakan `id_doc_type = 3` (Settlement), di-force saat form dibuka.

### API Dinamis

| Endpoint | Trigger | Hasil |
|----------|---------|-------|
| `/api/vendors/{id}/details` | Pilih vendor | Mengisi `vendorEmails` dan `vendorBanks` |
| `/api/cost-categories/{id}/types` | Pilih cost category | Mengisi `costTypes` |

---

## 9. Form Item Detail SR (`FormDetailModal`)

**Trigger**: `$dispatchTo('settlement-reports.form-detail-modal', 'openModal', { id, viewOnly })`

### Field

| Field | Required | Validasi | Keterangan |
|-------|----------|---------|-----------| 
| Deskripsi (detail) | ✅ | `required|min:2` | Keterangan item |
| BL Number | ❌ | — | Nomor Bill of Lading |
| Qty | ✅ | `required|numeric|min:0.0001` | Jumlah |
| UOM | ✅ | `required|integer` | Satuan ukuran |
| Harga Satuan (Price) | ✅ | `required|numeric|min:0` | Harga per unit |
| Discount | ❌ | — | Potongan item |
| Tipe PPN + PPN | ❌ | — | Pajak 1 (PPN) |
| Tipe PPh + PPh | ❌ | — | Pajak 2 (PPh) |
| DPP PPh | ❌ | — | Dasar Pengenaan Pajak PPh |
| Gross Up | ❌ | — | Toggle: perusahaan menanggung PPh |
| Progresif | ❌ | — | Toggle: PPh21 tarif progresif 5%–35% |
| Total Amount | — | — | Dihitung otomatis di JavaScript |

> Kalkulasi (amount, pajak) dilakukan di **JavaScript** client-side secara real-time, lalu dikirim ke server via `syncAndSave()`.

### Kalkulasi Otomatis

```
bruto = qty × price − discount
vatAmount = bruto × ppnPercent

Jika Progresif:
  dpp = bruto × 50%
  PPh dihitung dengan tarif berlapis (5%, 15%, 25%, 30%, 35%)

Jika Gross Up:
  dpp = bruto / (1 − pphPercent)
  PPh = dpp × pphPercent
  amount = bruto + vatAmount

Jika Normal:
  dpp = bruto
  PPh = dpp × pphPercent
  amount = bruto + vatAmount − PPh
```

### Permission untuk Detail Item

| Aksi | Kondisi |
|------|---------|
| Tambah item | Admin ATAU (Creator + `sr_detail.create`) dan SR status null/0/12 |
| Edit item (tombol + klik baris) | Admin ATAU (Creator + `sr_detail.edit`) dan SR status null/0/12 |
| Hapus item | Admin ATAU (Creator + `sr_detail.edit`) dan SR status null/0/12 |
| View only (klik baris) | Admin, Creator, atau `sr_detail.view` |

---

## 10. Dokumen Pendukung (Attachments SR)

Diakses dari halaman `show.blade.php`, bagian **SUPPORTING DOCUMENT**.

### Permission Attachment SR

| Aksi | Kondisi |
|------|---------|
| Lihat (view) | Admin, Creator, atau `sr_attachment.view` |
| Tambah | (Admin ATAU Creator + `sr_attachment.create`) DAN status in [0, 8, 12, 14] |
| Edit/Hapus | Sama seperti Tambah; **khusus status 8**: hanya file yang dibuat **setelah** tanggal SR masuk status 8 |

### Upload Attachment

- Format: JPG, JPEG, PNG, PDF
- Ukuran Maksimal: 5MB
- Mendukung mode **Upload File** langsung atau **Camera** (ambil foto)
- Bisa tambah banyak foto sekaligus (jika multi-foto, otomatis digabung menjadi 1 PDF)

---

## 11. Proses Pembayaran SR (`PaymentShow`)

**Route**: `GET /settlement-reports/{hash}/payment`  
**Access**: Admin, `pr_payment.create`, atau Creator

### Informasi yang Ditampilkan

| Info | Keterangan |
|------|-----------|
| SR Realization (Grand Total) | Sum detail ammount − additional_discount |
| Advance / Receipt | Total receipt dari PR advance terkait |
| Settlement Paid | Sum `grand_total` semua payment SR |
| Balance | Grand Total − Settlement Paid |
| Daftar Payment | Dengan status, tipe, metode, tanggal, dan bukti transfer |

### Kondisi Tambah Payment

Payment baru hanya bisa ditambah jika:
- User memiliki `pr_payment.create` atau Admin
- Status SR = **7** (Pending Payment) atau **8** (Payment Parsial)
- Tidak ada payment yang memiliki `reason` (catatan revisi)

### Form Input Payment

| Field | Required | Keterangan |
|-------|---------|-----------|
| Tipe Payment | ✅ | Parsial (1) / Full (2) |
| Tanggal Payment | ✅ | Date |
| Metode Pembayaran | ❌ | Transfer (1) / Tunai (2) |
| Nama Bank | ❌ | Auto-fill dari SR/norek_vendor |
| Nama Penerima | ❌ | Auto-fill dari SR/norek_vendor |
| No Rekening | ❌ | Auto-fill dari SR/norek_vendor |
| Amount | ✅ | Nilai pembayaran |
| Additional (PPh/Pajak) | ❌ | Biaya tambahan |
| Grand Total | — | Dihitung otomatis (amount + additional) |
| Keterangan/Deskripsi | ❌ | Catatan pembayaran |
| Bukti Transfer / File | ❌ | Maks 5MB (JPG, PNG, PDF) |

### Permission Payment di PaymentShow

| Aksi | Kondisi |
|------|---------|
| Tambah payment | Admin atau `pr_payment.create` + status 7/8 + tidak ada revisi payment |
| Edit payment | (Admin atau Creator payment) + payment adalah yang **terakhir** + status bukan 11 |
| Hapus payment | Sama seperti Edit |
| Upload bukti transfer | (Admin atau Creator payment) + `canAddAttachment()` + payment terakhir |
| Edit/Hapus bukti transfer | Sama seperti Upload + `canAddAttachment()` |
| Print struk payment | Admin, Creator, atau `sr_payment.print` |
| Download struk payment | Admin, Creator, atau `sr_payment.download` |

### `canAddAttachment(payment_type)`

Attachment **tidak bisa** diupload jika:
- SR status = **14** (Pending Director Payment Approval)

Attachment **bisa** diupload untuk:
- Payment type Parsial (1) atau Full (2), selama status SR bukan 14

---

## 12. Loan (Sumber Dana)

**Akses**: Admin atau `loan.view`  
**Modal**: `#modalLoan` di `show.blade.php`

- Dropdown pilihan Loan dari `tbl_loans`
- Bisa dikosongkan
- **Tidak bisa** diubah jika SR sudah Paid (status 11)
- Disimpan via `saveLoan()` di Livewire

---

## 13. Validasi & Error Penting

| Kondisi | Pesan / Aksi |
|---------|-------------|
| Submit SR tanpa minimal 1 detail | Ditolak — tidak ada item |
| Submit SR yang bukan Draft/Revision | Ditolak — status tidak valid |
| Submit tanpa `sr.submit` | 403 |
| Approve tanpa permission | "Anda tidak memiliki izin untuk melakukan approval ini." |
| Creator approve step sendiri | Tolak |
| Edit SR yang sudah diproses | Ditolak — status tidak 0 atau 12 |
| Hapus SR yang bukan Draft/Rejected | Ditolak |
| Upload attachment saat status 14 | Ditolak |
| Upload file melebihi 5MB | "Ukuran maksimal file adalah 5MB." |
| Upload file format tidak valid | "Hanya file JPG, JPEG, PNG, dan PDF yang diperbolehkan." |
| Tambah payment saat ada revision payment | Ditolak — ada catatan revisi aktif |

---

## 14. Ringkasan Permission Lengkap

### Akses & CRUD SR

| Aksi | Permission Slug |
|------|----------------|
| Akses daftar SR (semua dept) | `sr.view.all` |
| Akses daftar SR (dept sendiri) | `sr.view.dept` |
| Akses daftar SR (bawahan) | `sr.view.subordinate` |
| Akses detail SR | `sr_detail.view` |
| Edit SR | `sr.edit` |
| Submit SR | `sr.submit` |
| Batalkan submit | `sr.cancel_submit` |
| Hapus SR | Hanya Creator/Admin (tidak ada permission slug khusus) |
| Delete dari index | `sr.delete` (atau Creator/Admin) |
| Download / Print SR | `sr.print` |

### Proses Approval SR

| Aksi | Permission Slug |
|------|----------------|
| Approve Step 1 (Dept) | `sr.approve.step1` + dept sama |
| Approve Step 2 (Director) | `sr.approve.step2` |
| Approve Step 3 (Accounting) | `sr.approve.step3` |
| Approve Step 4 (Finance) | `sr.approve.step4` |
| Approve Step 5 (SPV Finance) | `sr.approve.step5` |
| Approve Step 6 (CFO) | `sr.approve.step6` |
| Cancel Approval Step 1 | `sr.cancel_approve.step1` |
| Cancel Approval Step 2 | `sr.cancel_approve.step2` |
| Cancel Approval Step 3 | `sr.cancel_approve.step3` |
| Cancel Approval Step 4 | `sr.cancel_approve.step4` |
| Cancel Approval Step 5 | `sr.cancel_approve.step5` |
| Revisi SR | `sr.revision` |
| Tolak SR | `sr.reject` |

### Detail Item SR

| Aksi | Permission Slug |
|------|----------------|
| Tambah item detail | `sr_detail.create` (+ harus Creator) |
| Edit item detail | `sr_detail.edit` (+ harus Creator) |
| Hapus item detail | `sr_detail.edit` (+ harus Creator) |
| View detail (read-only) | `sr_detail.view` |

### Dokumen Pendukung SR

| Aksi | Permission Slug |
|------|----------------|
| Lihat attachment SR | `sr_attachment.view` |
| Tambah attachment SR | `sr_attachment.create` (+ harus Creator) |

### Pembayaran SR

| Aksi | Permission Slug |
|------|----------------|
| Akses halaman pembayaran | `pr_payment.view` atau `pr_payment.create` |
| Input payment SR | `pr_payment.create` |
| Print struk payment | `sr_payment.print` |
| Download struk payment | `sr_payment.download` |

### Loan

| Aksi | Permission Slug |
|------|----------------|
| Kelola loan di SR | `loan.view` |

---

## 15. Diagram Alur Lengkap SR

```
SR DIBUAT dari PR Advance Show Page
  └→ status: 0 (Draft)
       │
  ┌────┤ Edit SR (sr.edit atau creator) — hanya status 0, 12
  └────┤ Tambah detail (sr_detail.create + creator)
       │
       ▼ submitSr (sr.submit + creator) — minimal 1 detail
  status: 1 (Pending Dept)
       │
  ┌────┤ cancelSubmit (creator/atasan/sr.cancel_submit) → kembali ke 0
  └────┤ approve step1 (sr.approve.step1 + dept sama, bukan creator)
       │
  status: 2 (Pending Director)
       │
  ┌────┤ cancelApproval — kembali ke 1
  └────┤ approve step2 (sr.approve.step2, bukan creator)
       │
  ─── Doc Type 1/3: status 3 (Accounting)
  ─── Doc Type 2:   status 4 (Finance) [SKIP ACCOUNTING]
       │
  (step3 → step4 → step5 → step6)
       │
  status: 7 (Pending Payment)
       │
       ▼ Input Payment (pr_payment.create, status 7 atau 8)
  status: 8 (Payment Parsial) atau langsung 10/11

─── Di mana saja selama status 1–6: ───
  Revision (sr.revision) → status: 12 + semua sign dihapus
  Reject (sr.reject)    → status: 13 + semua sign dihapus
```

---

*Dokumentasi dibuat dari: `resources/views/livewire/settlement-reports/` (6 komponen)*  
*Terakhir diperbarui: 23 Maret 2026*
