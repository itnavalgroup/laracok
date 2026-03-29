# 💳 Payment Request (PR)

## 1. Fungsi Modul

Payment Request adalah modul utama pengajuan permintaan pembayaran dari departemen ke keuangan. Setiap PR melewati **multi-step approval** (hingga 6 tanda tangan digital), dilanjutkan ke proses **pembayaran** dan rekening settlement. PR memiliki 2 tipe pembayaran: **Parsial (termin)** dan **Full (lunas)**.

**File Utama:**
- Routes: `GET /payment-requests`, `/payment-requests/{hash}`, `/payment-requests/{hash}/payment`
- Components: `app/Livewire/PaymentRequests/` (Index, Show, FormModal, FormDetailModal, PaymentModal, PaymentShow, InvoiceModal, LoanModal, InvoiceShow)

---

## 2. Cara Kerja

### 2.1 Tipe Dokumen (Doc Type)

| Doc Type | Nama | Alur |
|----------|------|------|
| 1 | Regular Purchase | Dept → Director → Accounting → Finance → SPV Finance → CFO |
| 2 | Settlement/Advance | Skip Accounting → Dept → Director → Finance → SPV Finance → CFO |
| 3 | Lainnya | Sama dengan Doc Type 1 |

### 2.2 Status PR

| Status | Label | Keterangan |
|--------|-------|-----------|
| 0 | Draft | Baru dibuat, belum disubmit |
| 1 | Pending Dept Review | Menunggu persetujuan Dept |
| 2 | Pending Director | Menunggu Director |
| 3 | Pending Accounting | Menunggu Accounting (Doc Type 1 & 3) |
| 4 | Pending Finance | Menunggu Finance |
| 5 | Pending SPV Finance | Menunggu SPV Finance |
| 6 | Pending CFO | Menunggu CFO |
| 7 | Fully Approved | Siap dibayar |
| 8 | Payment Parsial | Sebagian sudah dibayar |
| 9 | Partially Paid | Pembayaran parsial selesai |
| 10 | Pending Final Pay | Menunggu pembayaran akhir |
| 11 | Paid / Selesai | Lunas |
| 12 | Revision | Dikembalikan untuk revisi |
| 13 | Rejected | Ditolak permanen |
| 14 | Pending Director Sign Payment | Menunggu approval bayar step 1 |
| 15 | Pending Manager Sign Payment | Menunggu approval bayar step 2 |

### 2.3 Alur Approval PR

```
[Buat PR → status: 0 Draft]
        ▼ submitPr() — pr.submit + Creator + minimal 1 detail
[status: 1 → Pending Dept Review]
        ▼ approve() — pr.approve.step1 + dept sama/supervisor + bukan creator
[status: 2 → Pending Director]
        ▼ approve() — pr.approve.step2 + bukan creator
[status: 3 → Pending Accounting]  ← hanya Doc Type 1 & 3
[status: 4 → Pending Finance]     ← Doc Type 2 langsung ke sini
        ▼ approve() — pr.approve.step3/4/5/6
[status: 7 → Fully Approved]
        ▼ Input Payment — pr_payment.create
[status: 14 → Pending Dept Payment Approval]
        ▼ pr_payment.approve.step1
[status: 15 → Pending Director Payment Approval]
        ▼ pr_payment.approve.step2
[status: 8/9/10/11 → sesuai tipe bayar]
```

### 2.4 Logika `canUserApproveCurrentStep()`

| Step | Syarat |
|------|--------|
| 1 (Dept) | `pr.approve.step1` + dept sama ATAU supervisor + bukan creator |
| 2 (Director) | `pr.approve.step2` + bukan creator |
| 3 (Accounting) | `pr.approve.step3` — hanya Doc Type 1 & 3 |
| 4 (Finance) | `pr.approve.step4` |
| 5 (SPV Finance) | `pr.approve.step5` |
| 6 (CFO) | `pr.approve.step6` |

### 2.5 Logika `canUserCancelApproval()`

Membatalkan approval (reversi status -1): Admin ATAU `pr.cancel_approve.step{status-1}` ATAU user yang menandatangani step itu. Creator dilarang cancel di status 2 & 3. Doc Type 2 status 4 → revert ke 2 (bukan 3).

### 2.6 Scope Data Index

| Permission | Data Ditampilkan |
|-----------|-----------------|
| `level === 1` / `pr.view.all` | Semua PR |
| `pr.view.dept` | PR se-departemen |
| `pr.view.subordinate` | PR bawahan langsung |
| Tidak ada | PR milik sendiri |

---

## 3. Permission

### Akses & CRUD PR

| Aksi | Permission |
|------|-----------|
| Akses daftar (semua) | `pr.view.all` |
| Akses daftar (dept) | `pr.view.dept` |
| Akses daftar (bawahan) | `pr.view.subordinate` |
| Lihat detail | `pr_detail.view` |
| Edit PR | `pr.edit` |
| Submit PR | `pr.submit` |
| Batalkan submit | `pr.cancel_submit` |
| Hapus PR | Creator/Admin saja |

### Approval PR

| Aksi | Permission |
|------|-----------|
| Approve Step 1 (Dept) | `pr.approve.step1` + dept sama |
| Approve Step 2 (Director) | `pr.approve.step2` |
| Approve Step 3 (Accounting) | `pr.approve.step3` |
| Approve Step 4 (Finance) | `pr.approve.step4` |
| Approve Step 5 (SPV Finance) | `pr.approve.step5` |
| Approve Step 6 (CFO) | `pr.approve.step6` |
| Revisi PR | `pr.revision` |
| Tolak PR | `pr.reject` |

### Detail Item PR

| Aksi | Permission |
|------|-----------|
| Tambah item | `pr_detail.create` + Creator |
| Edit item | `pr_detail.edit` + Creator |
| Hapus item | `pr_detail.edit` + Creator |
| Lihat item (read-only) | `pr_detail.view` |

### Pembayaran PR

| Aksi | Permission |
|------|-----------|
| Akses halaman pembayaran | `pr.payment` / `pr_payment.view` |
| Input pembayaran | `pr_payment.create` |
| Approval bayar Step 1 | `pr_payment.approve.step1` + dept sama |
| Approval bayar Step 2 | `pr_payment.approve.step2` |
| Upload bukti bayar | `pr_payment.create` |

### Invoice & Loan

| Aksi | Permission |
|------|-----------|
| Lihat & input invoice | `pr_invoice.view` |
| Kelola Loan | `loan.view` |

---

## 4. Langkah CRUD

### Buat PR (Create)

1. Klik **New PR** (perlu `pr.create` atau akses halaman index)
2. Isi FormModal:

| Field | Required | Validasi |
|-------|----------|---------|
| Doc Type | ✅ | `required` |
| Company | ✅ | `required` |
| Branch | ✅ | `required` |
| Subject | ✅ | `required` |
| Cost Category / Type | ✅ | `required` |
| Currency | ✅ | `required` |
| Payment Type PR | ✅ | Parsial (1) / Full (2) |
| Payment Method | ✅ | Transfer (1) / Cash (2) |
| Payment Due Date | ✅ | `required\|date` |
| Vendor | ✅ | `required` |
| No Invoice | ✅ | `required` |
| Est. Settlement Date | ✅ | Hanya jika Doc Type 2 |

3. Nomor PR di-generate otomatis: `PR.{COMP}.{DEPT}.{YYMM}.{NNN}`
4. Simpan → status: **0 (Draft)**

### Tambah Detail Item

1. Di halaman Detail PR, klik **Add Item** (status harus 0/12, perlu `pr_detail.create`)
2. Isi FormDetailModal: Description, UOM, Qty, Price, Discount, Pajak, BL Number
3. Kalkulasi otomatis di JavaScript (qty × price − discount ± pajak = amount)
4. `syncAndSave()` → simpan ke `tbl_detail_pr`

### Submit PR

1. Di halaman Detail, klik **Submit PR** (perlu `pr.submit`, status 0/12, minimal 1 detail)
2. Status → **1 (Pending Dept Review)**

### Approve PR

1. Approver yang berhak melihat tombol **Approve**
2. Klik **Approve** → `approve()` → cek `canUserApproveCurrentStep()`
3. Insert ke `tbl_sign_transaction`, status → naik ke langkah berikutnya
4. QR Code digital di-generate untuk setiap tanda tangan

### Revisi / Tolak

- **Revisi**: status → 12, semua tanda tangan dihapus, kembali ke creator
- **Tolak**: status → 13 (permanen), semua tanda tangan dihapus

### Input Pembayaran (Payment)

1. PR status 7 → buka halaman Payment
2. Isi PaymentModal: deskripsi, tipe, metode, tanggal, amount (≤ sisa tagihan), bukti file
3. `payment.store` → `$maxAmount = GrandTotal − totalPaidSebelumnya`
4. PR → status 14 (Pending Dept Payment Approval)
5. Approval 2 step → status akhir 8/9/10/11

### Error Bisnis

| Kondisi | Pesan |
|---------|-------|
| Submit tanpa detail | "Tambahkan minimal 1 item detail sebelum submit." |
| Approve tanpa permission | "Anda tidak memiliki izin untuk melakukan approval ini." |
| Payment melebihi sisa | "Nominal melebihi sisa tagihan (Rp X)." |
| Hapus PR yang sudah diajukan | "PR yang sudah diajukan tidak dapat dihapus." |
| Edit PR yang sudah diproses | "PR yang sedang diproses tidak dapat diedit." |

---

*Terakhir diperbarui: 24 Maret 2026*
