# Dokumentasi Fitur: Payment Request (PR)

**Modul**: Payment Request  
**Route Prefix**: `/payment-requests`  
**Livewire Components**:
- `App\Livewire\PaymentRequests\Index` — Daftar PR
- `App\Livewire\PaymentRequests\Show` — Detail PR + Aksi Approval
- `App\Livewire\PaymentRequests\FormModal` — Form Buat/Edit PR
- `App\Livewire\PaymentRequests\FormDetailModal` — Form Item Detail PR
- `App\Livewire\PaymentRequests\PaymentModal` — Form Input Pembayaran
- `App\Livewire\PaymentRequests\PaymentShow` — Halaman Detail Pembayaran PR
- `App\Livewire\PaymentRequests\InvoiceModal` — Form Input Invoice
- `App\Livewire\PaymentRequests\LoanModal` — Form Pilih Sumber Dana
- `App\Livewire\PaymentRequests\InvoiceShow` — Detail Invoice PR

---

## 1. Deskripsi Umum

Payment Request (PR) adalah modul utama untuk pengajuan permintaan pembayaran dari departemen ke bagian keuangan. Setiap PR melewati alur **multi-step approval** dengan tanda tangan digital, setelah itu dilanjutkan ke proses **pembayaran** dan **settlement**. PR memiliki 2 tipe utama berdasarkan Doc Type:

| Doc Type ID | Jenis | Keterangan |
|-------------|-------|-----------|
| 1 | Regular Purchase | Alur standar: Dept → Director → Accounting → Finance → SPV Finance → CFO |
| 2 | Settlement/Service | Skip step Accounting; khusus SR (Settlement Report) |
| 3 | Lainnya | Sama seperti Doc Type 1 |

---

## 2. Routes

| Method | URI | Name | Keterangan |
|--------|-----|------|-----------|
| GET | `/payment-requests` | `payment-requests.index` | Daftar semua PR |
| GET | `/payment-requests/{hash}` | `payment-requests.show` | Detail PR (ID di-hash) |
| GET | `/payment-requests/{hash}/payment` | `payment-requests.payment` | Halaman pembayaran PR |

> ID PR di-obfuscate menggunakan `hashid_encode($id, 'pr')` di URL.

---

## 3. Status PR (Alur Lengkap)

| Status | Label | Keterangan |
|--------|-------|-----------|
| `0` / `null` | **Draft** | PR baru dibuat, belum disubmit |
| `1` | **Pending Dept Review** | Sudah disubmit, menunggu persetujuan Dept/Atasan |
| `2` | **Pending Director** | Dept approve, menunggu Director |
| `3` | **Pending Accounting** | Director approve (khusus Doc Type 1 & 3) |
| `4` | **Pending Finance** | Accounting approve (atau Director approve untuk Doc Type 2) |
| `5` | **Pending SPV Finance** | Finance approve |
| `6` | **Pending CFO** | SPV Finance approve |
| `7` | **Fully Approved** | CFO approve, siap dibayar |
| `8` | **Payment in Progress (Parsial)** | Sebagian dibayar |
| `9` | **Partially Paid** | Bayar parsial selesai |
| `10` | **Pending Final Pay** | Menunggu pembayaran akhir |
| `11` | **Selesai / Paid** | Lunas terbayar penuh |
| `12` | **Revision** | Dikembalikan untuk revisi oleh approver |
| `13` | **Rejected** | Ditolak permanen |
| `14` | **Payment Review (Dept)** | Menunggu approval pembayaran step 1 (Dept) |
| `15` | **Payment Review (Director)** | Menunggu approval pembayaran step 2 (Director) |

---

## 4. Alur Approval PR

```
[Creator buat PR → status: 0 Draft]
        │
        ▼ submitPr() — permission: pr.submit
[status: 1 → Pending Dept Review]
        │
        ▼ approve() — permission: pr.approve.step1
        │   Syarat: supervisor PR atau dept sama + bukan creator
[status: 2 → Pending Director]
        │
        ▼ approve() — permission: pr.approve.step2 + bukan creator
[status: 3 → Pending Accounting]  ← hanya Doc Type 1 & 3
[status: 4 → Pending Finance]     ← Doc Type 2 skip ke sini
        │
        ▼ approve() — permission: pr.approve.step3
[status: 4 → Pending Finance]
        │
        ▼ approve() — permission: pr.approve.step4
[status: 5 → Pending SPV Finance]
        │
        ▼ approve() — permission: pr.approve.step5
[status: 6 → Pending CFO]
        │
        ▼ approve() — permission: pr.approve.step6
[status: 7 → Fully Approved → siap diproses ke pembayaran]
```

### Skip Accounting untuk Doc Type 2

Ketika PR dengan `id_doc_type = 2` di-approve oleh Director (status 2 → next):
- Normal `getNextStatus()`: status + 1 = 3
- **Khusus Doc Type 2**: langsung ke 4 (Finance), melewati Accounting

---

## 5. Halaman Index (Daftar PR)

**Route**: `GET /payment-requests`  
**Access**: `abort(403)` jika tidak punya satupun dari: `pr.view.all`, `pr.view.dept`, `pr.view.subordinate`, atau `level === 1`

### Scope Data (`visibleTo` scope di model Pr)

| Permission | Data yang Ditampilkan |
|-----------|----------------------|
| `level === 1` | Semua PR dari semua user |
| `pr.view.all` | Semua PR di sistem |
| `pr.view.dept` | PR milik departemen yang sama |
| `pr.view.subordinate` | PR milik bawahan langsung |
| Tidak ada | Hanya PR milik sendiri |

### Filter Tersedia

| Filter | Binding | Keterangan |
|--------|---------|-----------|
| Search | `wire:model.live="search"` | Cari `pr_number` atau `subject` |
| Departement | `filterDepartement` | Filter by departemen |
| Company | `filterCompany` | Filter by perusahaan |
| Status PR | `filterStatus` | Filter by status PR |
| Status SR | `filterSrStatus` | Filter by status SR yang terkait |
| Date From | `dateFrom` | Filter tanggal mulai |
| Date To | `dateTo` | Filter tanggal akhir |

Semua filter tersimpan di query string URL.

### Smart Sorting (CASE WHEN)

Index secara otomatis mem-prioritaskan PR yang **butuh tindakan user saat ini**:

| Prioritas | Kondisi |
|-----------|---------|
| 0 | PR/SR milik user saat ini dengan status Draft (0) atau Revision (12) |
| 1 | PR/SR milik subordinate dengan status perlu persetujuan Dept |
| 2 | Status menunggu persetujuan Dept (pr.approve.step1) |
| 3+ | Status menunggu persetujuan Director, Accounting, Finance, dst. (sesuai permission user) |
| 99 | PR yang tidak butuh tindakan user |

### Tombol Aksi di Index

| Tombol | Kondisi | Aksi |
|--------|---------|------|
| 🗑️ Hapus | Admin atau Creator, status = 0 (belum submit) | `delete($id)` — hapus PR + details |
| Lihat detail | Selalu tampil | Link ke `payment-requests.show` |

---

## 6. Halaman Detail PR (`show.blade.php`)

**Route**: `GET /payment-requests/{hash}`  
**Access**: Redirect jika tidak punya akses  
**Dapat melihat** jika: `level === 1`, creator, atau memiliki salah satu dari:  
`pr_detail.view`, `pr.approve.step1`–`step6`, `pr.payment`, `pr_invoice.view`

### Informasi Header PR

| Field | Sumber |
|-------|--------|
| PR Number | `pr_number` (format: `PR.{COMP}.{DEPT}.{YYMM}.{NNN}`) |
| Subject | `subject` |
| Doc Type | `docType.doc_type` |
| Cost Category / Type | `costCategory`, `costType` |
| Company / Branch | `company`, `branch` |
| Vendor | `vendor.vendor` |
| Currency | `currency.code` |
| Payment Type | Parsial (1) / Full (2) |
| Payment Method | Transfer (1) / Cash (2) |
| Due Date | `payment_due_date` |
| Rekening | `norek_vendor` atau manual (`nama_bank`, `nama_penerima`, `norek`) |

### Signature Steps (Panel Tanda Tangan)

| Step | Label | Kondisi `canSign` |
|------|-------|-----------------|
| 0 | Prepared By (Creator) | Selalu false (tidak bisa sign sendiri) |
| 1 | Review Dept | `canUserApproveCurrentStep()` dan status === 1 |
| 2 | Review Director | status === 2 |
| 3 | Review Accounting | status === 3, **hanya Doc Type 1 & 3** |
| 4 | Review Finance | status === 4 |
| 5 | Review SPV Finance | status === 5 |
| 6 | Review CFO | status === 6 |

> QR Code digital otomatis di-generate untuk setiap tanda tangan via `getQr()` menggunakan library `endroid/qr-code`.

### Tombol Aksi di Detail PR

| Tombol | Kondisi Tampil | Permission / Kondisi |
|--------|---------------|---------------------|
| **Submit PR** | Status 0, 12 | Admin atau Creator + `pr.submit` + minimal 1 detail |
| **Cancel Submit** | Status 1 | Admin, Creator, atau `pr.cancel_submit` (+ supervisor) |
| **Approve** | Status 1–6 | `canUserApproveCurrentStep()` — lihat logika di bawah |
| **Cancel Approval** | Status 2–7 | `canUserCancelApproval()` — lihat logika di bawah |
| **Revisi** | Status 1–6 | Admin, `pr.revision`, atau approver saat ini (bukan creator di step 1 & 2) |
| **Tolak** | Status 1–6 | Admin, `pr.reject`, atau approver saat ini (bukan creator di step 1 & 2) |
| **Edit PR** | Status 0, 12 | Admin, Creator, atau `pr.edit` |
| **Hapus PR** | Status 0, 13 | Admin atau Creator |
| **Bayar** | Status 7–10 | Link ke payment-show |
| **Edit Loan** | Tidak status 11 | Admin atau `loan.view` |
| **Add Invoice** | Setelah approved | `pr_invoice.view` |

---

## 7. Logika Approval Detail

### `canUserApproveCurrentStep()`

```
Status harus antara 1–6

Step 1 (Status 1 — Dept Review):
  - TIDAK BOLEH approve milik sendiri (creator)
  - Admin → bisa
  - Memiliki pr.approve.step1 DAN dept sama ATAU adalah supervisor PR

Step 2 (Status 2 — Director):
  - Creator dilarang approve PR sendiri (kecuali Admin)
  - Admin atau pr.approve.step2

Step 3 (Status 3 — Accounting):
  - Hanya Doc Type 1 & 3 (Doc Type 2 skip)
  - Admin atau pr.approve.step3

Step 4 (Status 4 — Finance):
  - Admin atau pr.approve.step4

Step 5 (Status 5 — SPV Finance):
  - Admin atau pr.approve.step5

Step 6 (Status 6 — CFO):
  - Admin atau pr.approve.step6
```

### `canUserCancelApproval()`

Membatalkan approval yang sudah diberikan (reversi ke status sebelumnya):

```
Status harus antara 2–7

Creator dilarang cancel approval di status 2 & 3 (cancel step 1 & 2)

Bisa cancel jika:
  - Admin
  - Memiliki permission pr.cancel_approve.step{status-1}
  - Atau: user yang menandatangani step saat ini (sign record ditemukan)

Doc Type 2, status 4: revert ke 2 (bukan 3, karena step 3 di-skip)
```

---

## 8. Form Buat / Edit PR (`FormModal`)

**Trigger**: Event `open-pr-form` dari Livewire

Form sepenuhnya dikelola oleh **Alpine.js** di client-side, validasi server-side dilakukan saat simpan (`saveFromJs()`).

### Field Wajib

| Field | Validasi | Keterangan |
|-------|---------|-----------|
| Doc Type | required | Pilihan: ID 1 (Regular), 2 (Settlement) — Doc Type 2 hanya tampil jika punya `sr.create` |
| Company | required | Perusahaan |
| Branch | required | Cabang |
| Subject | required | Judul/perihal PR |
| Cost Category | required | Kategori biaya |
| Cost Type | required | Tipe biaya |
| Currency | required | Mata uang |
| Payment Type PR | required | Parsial (1) / Full (2) |
| Payment Method | required | Transfer (1) / Cash (2) |
| Payment Due Date | required|date | Jatuh tempo pembayaran |
| Vendor | required | Mitra/vendor |
| User Email | required | Email user untuk notifikasi |
| No Invoice | required | Nomor invoice dari vendor |
| Rekening (jika tanpa norek_vendor) | required | Bank, Penerima, Nomor Rek |

### Field Opsional

| Field | Keterangan |
|-------|-----------|
| PO Number | Nomor PO jika ada |
| Loan | Sumber dana |
| Email Vendor | Notifikasi ke vendor |
| Norek Vendor | Pilih dari data rekening vendor |
| Additional Discount | Diskon tambahan (potong dari grand total) |
| Est. Settlement Date | **Required jika Doc Type 2** |

### Pembangkitan Nomor PR

Format: `PR.{COMP}.{DEPT}.{YYMM}.{NNN}`

| Mode | Logika |
|------|--------|
| Auto | `MAX(number)` di departemen + tahun yang sama + 1 |
| Manual | User isi nomor sendiri, dicek keunikannya per departemen + tahun |

> Contoh: `PR.AGID.TI.2603.001`

### Kondisi Edit

- Hanya status **Draft (0)** atau **Revisi (12)** yang bisa diedit
- Harus Admin, Creator, atau `pr.edit`

### Data Dropdown yang Di-cache (2 jam)

`doc_types`, `departements`, `cost_categories`, `branches`, `companies`, `currencies`, `loans`

---

## 9. Form Item Detail PR (`FormDetailModal`)

**Trigger**: Event `openModal` dari Livewire

### Field

| Field | Required | Validasi | Keterangan |
|-------|----------|---------|-----------|
| Description (detail) | ✅ | `required|min:2` | Keterangan item |
| UOM | ✅ | `required|integer` | Satuan ukuran |
| Quantity | ✅ | `required|numeric|min:0.0001` | Jumlah |
| Price | ✅ | `required|numeric|min:0` | Harga satuan |
| Discount | ❌ | — | Potongan harga |
| DPP PPh | ❌ | — | Dasar Pengenaan Pajak PPh |
| Tax Type 1 + Tax 1 | ❌ | — | Pajak 1 (biasanya PPN) |
| Tax Type 2 + Tax 2 | ❌ | — | Pajak 2 (biasanya PPh) |
| Amount | — | — | Dihitung otomatis di JS |
| BL Number | ❌ | — | Nomor Bill of Lading |
| Gross / Progresif | — | — | Flag kalkulasi pajak |

> Semua kalkulasi (amount, pajak) dilakukan di **JavaScript** client-side secara real-time, lalu dikirim ke server via `syncAndSave()`.

### Permission untuk Detail Item

| Aksi | Kondisi |
|------|---------|
| Tambah item | Admin ATAU (Creator + `pr_detail.create`) |
| Edit item | Admin ATAU (Creator + `pr_detail.edit`) |
| Hapus item | Admin ATAU (Creator + `pr_detail.edit`) |

> PR harus berstatus **Draft (0) atau Revisi (12)** untuk bisa ubah detail item.

---

## 10. Proses Pembayaran PR (`PaymentModal` + `PaymentShow`)

### Akses Halaman Payment Show

`level === 1`, Creator, atau: `pr.payment`, `pr_payment.view`, `pr_payment.create`

### Informasi yang Ditampilkan

| Info | Keterangan |
|------|-----------|
| Grand Total | Sum detail - additional_discount |
| Total Paid | Sum `grand_total` semua payment |
| Balance | Grand Total - Total Paid |
| Daftar payment | Dengan status, tipe, metode, tanggal |

### Form Input Payment (`PaymentModal`)

| Field | Required | Validasi | Keterangan |
|-------|----------|---------|-----------|
| Payment Description | ✅ | `required|string` | Keterangan pembayaran |
| Payment Type | ✅ | `required|in:1,2` | Parsial (1) / Full (2) |
| Payment Method | ✅ | `required|in:1,2` | Transfer (1) / Cash (2) |
| Payment Date | ✅ | `required|date` | Tanggal pembayaran |
| Amount | ✅ | `required|numeric|min:1` | ≤ sisa tagihan (`maxAmount`) |
| Additional | ❌ | nullable|numeric | Biaya tambahan (admin bank, etc.) |
| Grand Total | — | — | amount + additional |
| Nama Bank | ❌ | max:150 | Auto-fill dari vendor/PR |
| Nama Penerima | ❌ | max:150 | Auto-fill dari vendor/PR |
| No Rekening | ❌ | max:50 | Auto-fill dari vendor/PR |
| File Bukti | ❌ | file|max:5MB | Bukti transfer/kwitansi |

> `maxAmount` = Grand Total - total payment sebelumnya  
> Validasi: `amount > maxAmount` → error

### Permission Payment

| Aksi | Kondisi |
|------|---------|
| Buat payment baru | Admin atau `pr_payment.create` (atau Owner jika parsial) |
| Edit payment | Admin atau Creator payment itu sendiri |
| Hapus payment | Admin atau Creator payment itu sendiri |
| Upload attachment pembayaran | Admin, `pr_payment.create`, atau Owner (hanya parsial) — **tidak bisa saat status 14 atau 15** |

### Alur Approval Payment (2 Step)

Setelah payment diinput, PR perlu approval tambahan untuk pembayaran:

```
[Payment input → status PR: 14 (Pending Dept Payment Approval)]
        │
        ▼ Approval Step 1 (Dept Manager)
        │   Permission: pr_payment.approve.step1
        │   Syarat: dept sama dengan creator PR, status 15
[status PR: 15 (Pending Director Payment Approval)]
        │
        ▼ Approval Step 2 (Director)
        │   Permission: pr_payment.approve.step2
        │   Status PR: 14
[status PR: 8/9/10/11 → tergantung tipe bayar]
```

| Method | Permission | Kondisi Status |
|--------|-----------|---------------|
| `canApproveStep1()` | `pr_payment.approve.step1` (+ dept sama) | PR status = 15 |
| `canCancelApproveStep1()` | `pr_payment.cancel_approve.step1` | PR status = 14, Director belum sign |
| `canApprovePaymentDirector()` | `pr_payment.approve.step2` | PR status = 14 |
| `canCancelApprovePaymentDirector()` | `pr_payment.cancel_approve.step2` | Director sudah sign, PR sts 8–11 |
| `canRevision()` | `pr_payment.approve.step1` atau `step2` | Status 14 atau 15 |

---

## 11. Invoice PR (`InvoiceModal`)

**Trigger**: Event `openInvoiceModal`  
**Permission tampil**: `pr_invoice.view`

### Field Input Invoice

| Field | Required | Validasi | Keterangan |
|-------|----------|---------|-----------|
| Invoice Number | ✅ | `required|string|max:100` | |
| Invoice Date | ✅ | `required|date` | Default: hari ini |
| Delivery Date | ❌ | — | Tanggal pengiriman barang |
| Truck | ❌ | — | Nomor/info kendaraan pengiriman |
| File | ❌ | file|max:5MB|mimes:pdf,jpg,jpeg,png | Scan invoice |

> Data invoice otomatis mewarisi info PR: company, dept, vendor, bank, dll.

---

## 12. Loan (Sumber Dana) `LoanModal`

**Trigger**: Event `open-loan-modal`  
**Permission**: Admin atau `loan.view`

Field: dropdown pilihan Loan dari `tbl_loans`. Bisa dikosongkan. Tidak bisa diubah jika PR sudah Paid (status 11).

---

## 13. Validasi & Error Penting

| Kondisi | Pesan / Aksi |
|---------|-------------|
| Submit tanpa minimal 1 detail | "Tambahkan minimal 1 item detail sebelum submit." |
| Submit PR yang bukan draft | "PR tidak dapat disubmit pada status ini." |
| Submit tanpa `pr.submit` | 403 |
| Approve tanpa permission | "Anda tidak memiliki izin untuk melakukan approval ini." |
| Creator approve step 1 milik diri sendiri | Tolak |
| Creator revisi/reject step 1 & 2 | Tolak |
| Edit PR yang sudah diproses | "PR yang sedang diproses tidak dapat diedit." |
| Hapus PR yang sudah disubmit | "PR yang sudah diajukan tidak dapat dihapus." |
| Hapus PR selain Draft & Rejected | "PR hanya bisa dihapus saat Draft atau Rejected." |
| Payment melebihi sisa tagihan | "Nominal melebihi sisa tagihan (Rp X)." |
| Nomor PR sudah digunakan | Error validasi `number` |
| Loan diubah saat status Paid | "Loan tidak bisa diubah karena PR sudah berstatus Paid/Selesai." |
| Upload attachment saat status 14/15 | Ditolak |

---

## 14. Ringkasan Permission Lengkap

### Akses & CRUD PR

| Aksi | Permission Slug |
|------|----------------|
| Akses daftar PR (semua) | `pr.view.all` |
| Akses daftar PR (satu dept) | `pr.view.dept` |
| Akses daftar PR (bawahan) | `pr.view.subordinate` |
| Akses detail PR | `pr_detail.view` |
| Buat PR baru | `pr.create` |
| Edit PR | `pr.edit` |
| Submit PR | `pr.submit` |
| Batalkan submit | `pr.cancel_submit` |
| Hapus PR | Hanya Creator/Admin |

### Proses Approval PR

| Aksi | Permission Slug |
|------|----------------|
| Approve Step 1 (Dept) | `pr.approve.step1` + dept sama |
| Approve Step 2 (Director) | `pr.approve.step2` |
| Approve Step 3 (Accounting) | `pr.approve.step3` |
| Approve Step 4 (Finance) | `pr.approve.step4` |
| Approve Step 5 (SPV Finance) | `pr.approve.step5` |
| Approve Step 6 (CFO) | `pr.approve.step6` |
| Cancel Approval Step 1 | `pr.cancel_approve.step1` |
| Cancel Approval Step 2 | `pr.cancel_approve.step2` |
| Cancel Approval Step 3 | `pr.cancel_approve.step3` |
| Cancel Approval Step 4 | `pr.cancel_approve.step4` |
| Cancel Approval Step 5 | `pr.cancel_approve.step5` |
| Revisi PR | `pr.revision` |
| Tolak PR | `pr.reject` |

### Detail Item PR

| Aksi | Permission Slug |
|------|----------------|
| Tambah item detail | `pr_detail.create` (+ harus Creator) |
| Edit item detail | `pr_detail.edit` (+ harus Creator) |
| Hapus item detail | `pr_detail.edit` (+ harus Creator) |
| View detail (read-only) | `pr_detail.view` |

### Pembayaran PR

| Aksi | Permission Slug |
|------|----------------|
| Akses halaman pembayaran | `pr.payment` atau `pr_payment.view` |
| Input pembayaran | `pr_payment.create` |
| View pembayaran | `pr_payment.view` |
| Approval pembayaran Step 1 (Dept) | `pr_payment.approve.step1` + dept sama |
| Approval pembayaran Step 2 (Director) | `pr_payment.approve.step2` |
| Cancel Approval bayar Step 1 | `pr_payment.cancel_approve.step1` |
| Cancel Approval bayar Step 2 | `pr_payment.cancel_approve.step2` |
| Upload attachment pembayaran | `pr_payment.create` |

### Invoice & Loan

| Aksi | Permission Slug |
|------|----------------|
| Lihat invoice PR | `pr_invoice.view` |
| Input invoice | `pr_invoice.view` (tampilan tombol) |
| Edit Loan di PR | `loan.view` |

---

## 15. Diagram Alur Lengkap PR

```
CREATE PR (pr.create)
  └→ status: 0 (Draft)
       │
  ┌────┤ Edit PR (pr.edit atau creator) — hanya status 0, 12
  └────┤ Tambah detail (pr_detail.create + creator)
       │
       ▼ submitPr (pr.submit + creator) — minimal 1 detail
  status: 1 (Pending Dept)
       │
  ┌────┤ cancelSubmit (creator/atasan/pr.cancel_submit) → kembali ke 0
  └────┤ approve step1 (pr.approve.step1 + dept sama, bukan creator)
       │
  status: 2 (Pending Director)
       │
  ┌────┤ cancelApproval — kembali ke 1
  └────┤ approve step2 (pr.approve.step2, bukan creator)
       │
  ─── Doc Type 1/3: status 3 (Accounting)
  ─── Doc Type 2:   status 4 (Finance) [SKIP ACCOUNTING]
       │
  (step3 → step4 → step5 → step6)
       │
  status: 7 (Fully Approved)
       │
       ▼ Input Payment (pr_payment.create)
  status: 14 (Pending Dept Payment Approval)
       │
  ┌────┤ Approval Step1 (pr_payment.approve.step1)
  └→ status: 15 (Pending Director Payment Approval)
       │
       ▼ Approval Step2 (pr_payment.approve.step2)
  status: 8 (Parsial) / 9 / 10 / 11 (LUNAS PAID)

─── Di mana saja selama status 1–6: ───
  Revision (pr.revision) → status: 12 + semua sign dihapus
  Reject (pr.reject) → status: 13 + semua sign dihapus
```

---

*Dokumentasi dibuat dari: `app/Livewire/PaymentRequests/` (9 komponen)*  
*Terakhir diperbarui: 23 Maret 2026*
