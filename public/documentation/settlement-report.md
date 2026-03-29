# 📑 Settlement Report (SR)

## 1. Fungsi Modul

Settlement Report adalah modul **pertanggungjawaban penggunaan dana** yang sudah dibayarkan via Payment Request (PR) tipe Advance (Doc Type 2). SR selalu terhubung ke PR induknya. SR menggunakan **Doc Type 3 (Settlement)** dan melewati alur **multi-step approval** yang serupa dengan PR.

**File Utama:**
- Routes: `GET /settlement-reports`, `/settlement-reports/{hash}`, `/settlement-reports/{hash}/payment`
- Components: `app/Livewire/SettlementReports/` (Index, Show, FormModal, FormDetailModal, PaymentModal, PaymentShow)

> **Catatan:** SR tidak punya tombol "New SR" di index — SR dibuat dari halaman **Show PR Advance**.

---

## 2. Cara Kerja

### 2.1 Status SR

| Status | Label | Keterangan |
|--------|-------|-----------|
| 0 | Draft | SR dibuat, belum disubmit |
| 1 | Pending Dept Sign | Menunggu persetujuan Dept |
| 2 | Pending Director Sign | Menunggu Director |
| 3 | Pending Accounting Sign | Menunggu Accounting (hanya Doc Type 1 & 3) |
| 4 | Pending Finance Sign | Menunggu Finance |
| 5 | Pending SPV Finance Sign | Menunggu SPV Finance |
| 6 | Pending CFO Sign | Menunggu CFO |
| 7 | Pending Payment | Siap diproses pembayaran |
| 8 | Payment Parsial | Sebagian dibayar |
| 11 | Paid / Balance Settled | Lunas |
| 12 | Revision | Dikembalikan revisi |
| 13 | Rejected | Ditolak permanen |
| 14 | Pending Director Payment | Menunggu approval bayar step 1 |
| 15 | Pending Manager Payment | Menunggu approval bayar step 2 |

### 2.2 Alur Approval SR

```
[Buat SR dari halaman Show PR Advance → status: 0]
        ▼ submitSr() — sr.submit + Creator
[status: 1 → Pending Dept]
        ▼ approve() — sr.approve.step1 + dept sama/supervisor + bukan creator
[status: 2 → Pending Director]
        ▼ approve() — sr.approve.step2 + bukan creator
[status: 3 → Pending Accounting]  ← hanya Doc Type 1 & 3
[status: 4 → Pending Finance]     ← Doc Type 2 skip ke sini
        ▼ step3 / step4 / step5 / step6
[status: 7 → Pending Payment]
        ▼ Input Payment SR — pr_payment.create
[status: 7–11 sesuai tipe bayar]
```

### 2.3 Kalkulasi Keuangan SR

| Kondisi | Rumus |
|---------|-------|
| **SR Normal (bukan Advance)** | Grand Total = sum(detail.amount) − additional_discount |
| **SR dari PR Advance** | Balance = SR Amount − Advance Given<br>+Balance = Kurang Bayar, −Balance = Lebih Bayar / Refund |

### 2.4 Kalkulasi Item Detail SR

```
bruto = qty × price − discount
vatAmount = bruto × ppnPercent

Jika Gross Up:
  dpp = bruto / (1 − pphPercent)
  PPh = dpp × pphPercent
  amount = bruto + vatAmount

Jika Normal:
  amount = bruto + vatAmount − PPh

Jika Progresif (PPh21):
  PPh dihitung dengan tarif berlapis 5%, 15%, 25%, 30%, 35%
```

### 2.5 Scope Data Index

| Permission | Data Ditampilkan |
|-----------|-----------------|
| `level 1` / `sr.view.all` | Semua SR |
| `sr.view.dept` | SR se-departemen |
| `sr.view.subordinate` | SR bawahan langsung |

---

## 3. Permission

### Akses & CRUD SR

| Aksi | Permission |
|------|-----------|
| Akses daftar (semua) | `sr.view.all` |
| Akses daftar (dept) | `sr.view.dept` |
| Akses daftar (bawahan) | `sr.view.subordinate` |
| Lihat detail | `sr_detail.view` |
| Edit SR | `sr.edit` |
| Submit SR | `sr.submit` |
| Batalkan submit | `sr.cancel_submit` |
| Hapus SR | Creator/Admin (tidak ada slug) |
| Print / Download | `sr.print` |

### Approval SR

| Aksi | Permission |
|------|-----------|
| Approve Step 1 (Dept) | `sr.approve.step1` + dept sama |
| Approve Step 2 (Director) | `sr.approve.step2` |
| Approve Step 3 (Accounting) | `sr.approve.step3` |
| Approve Step 4 (Finance) | `sr.approve.step4` |
| Approve Step 5 (SPV Finance) | `sr.approve.step5` |
| Approve Step 6 (CFO) | `sr.approve.step6` |
| Revisi SR | `sr.revision` |
| Tolak SR | `sr.reject` |
| Cancel Approval Step N | `sr.cancel_approve.stepN` |

### Detail Item & Attachment SR

| Aksi | Permission |
|------|-----------|
| Tambah item | `sr_detail.create` + Creator |
| Edit item | `sr_detail.edit` + Creator |
| Lihat item | `sr_detail.view` |
| Lihat attachment | `sr_attachment.view` |
| Tambah attachment | `sr_attachment.create` + Creator |

### Pembayaran SR

| Aksi | Permission |
|------|-----------|
| Akses halaman payment | `pr_payment.view` / `pr_payment.create` |
| Input payment SR | `pr_payment.create` |
| Print struk | `sr_payment.print` |
| Download struk | `sr_payment.download` |
| Kelola Loan | `loan.view` |

---

## 4. Langkah CRUD

### Buat SR (Create)

1. Buka halaman **Detail PR Advance** (Doc Type 2)
2. Klik **Create SR** (tombol khusus di show PR)
3. Isi FormModal SR:

| Field | Required | Keterangan |
|-------|----------|-----------|
| Subject | ✅ | Keperluan SR |
| Payment Method | ✅ | Transfer / Cash — di-disable jika dari PR |
| Settlement Date | ✅ | Tanggal aktual |
| Vendor | ✅ | Auto-fill dari PR, tidak bisa diubah |
| Additional Discount | ❌ | Potongan header |
| Loan | ❌ | Sumber dana (jika `loan.view`) |

4. Simpan → SR dibuat dengan `id_doc_type = 3`, status: **0 (Draft)**

### Tambah Item Detail

1. Di halaman Detail SR, klik **Add Item** (status 0/12, perlu `sr_detail.create` + Creator)
2. Isi: Description, BL Number, Qty, UOM, Price, Discount, Pajak PPN/PPh, Gross Up, Progresif
3. Kalkulasi real-time di JavaScript → `syncAndSave()`

### Submit SR

1. Klik **Submit SR** (status 0/12, perlu `sr.submit`, minimal 1 item)
2. Status → **1 (Pending Dept)**

### Approve SR

1. Approver klik **Approve** → cek `canUserApproveCurrentStep()`
2. Creator dilarang approve step milik sendiri (kecuali Admin)
3. Status naik → tanda tangan tersimpan di `tbl_sign_transaction`

### Upload Attachment

| Kondisi | Tindakan |
|---------|---------|
| Status 0, 8, 12, 14 | Bisa upload |
| Format | JPG, JPEG, PNG, PDF (max 5MB) |
| Multi-foto | Otomatis digabung jadi 1 PDF |
| Kamera | Mode kamera didukung |

### Input Pembayaran SR

1. SR status 7 → buka halaman Payment
2. Isi form: tipe, tanggal, metode, amount, bukti transfer
3. Upload bukti (JPG/PNG/PDF max 5MB)
4. Approval 2 step Director & Manager

### Error Bisnis

| Kondisi | Pesan |
|---------|-------|
| Submit tanpa detail | "SR tidak dapat diajukan karena belum ada item." |
| Upload saat status 14 | "Upload tidak diperbolehkan pada status ini." |
| File melebihi 5MB | "Ukuran maksimal file adalah 5MB." |
| Format file salah | "Hanya file JPG, JPEG, PNG, dan PDF yang diperbolehkan." |
| SR sudah Paid (status 11) | Loan tidak bisa diubah |

---

*Terakhir diperbarui: 24 Maret 2026*
