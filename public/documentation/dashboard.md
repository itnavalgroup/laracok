# 📊 Dashboard

## 1. Fungsi Modul

Dashboard adalah halaman utama setelah login. Menyajikan **monitoring keuangan real-time** (PR & SR) dan daftar **dokumen yang perlu ditindaklanjuti** oleh user saat ini. Data di-refresh otomatis setiap **30 detik** (`wire:poll.30s`).

**File Utama:**
- Livewire Component: `app/Livewire/Dashboard.php`
- View: `resources/views/livewire/dashboard.blade.php`
- Route: `GET /dashboard` (middleware: `auth`)

---

## 2. Cara Kerja

### 2.1 Scope Data Berdasarkan Permission

| Permission | Data yang Dihitung |
|-----------|-------------------|
| `level === 1` atau `dashboard.view` | Semua data di sistem |
| `dashboard.view.dept` | Data departemen user + bawahan |
| `dashboard.view.subordinate` | Data user sendiri + bawahan langsung |
| Tidak ada ketiganya | Data milik user sendiri saja |

### 2.2 Layout Halaman

```
┌──────────────────────────────────────────────────────┐
│  Welcome Header (nama, tanggal, jabatan)             │
├──────────────────────────────────────────────────────┤
│  PR MONITORING — 4 Kartu Besar                       │
│  [Pending Approval] [Pending Bayar] [Selesai] [Parsial]│
├──────────────────────────────────────────────────────┤
│  SR MONITORING — 4 Kartu Besar                       │
│  [Pending Approval] [Pending Settlement] [Selesai] [Dana]│
├──────────────────────────────────────────────────────┤
│  SUMMARY — 6 Kartu Kecil                             │
│  Total PR | PR Pending | Total SR | SR Pending       │
│  Nilai PR | Transaksi Bulan Ini                      │
├──────────────────────────────────────────────────────┤
│  TABEL PENDING APPROVAL (Tab Navigation)             │
│  [SEMUA] [PR] [SR] [IKB] | [PR Lunas] [PR Parsial]  │
│                            [SR Settlement]           │
└──────────────────────────────────────────────────────┘
```

### 2.3 Stat Cards PR Monitoring

| Kartu | Status Dihitung | Isi |
|-------|----------------|-----|
| PR Pending Persetujuan 🟠 | Status 1–6 | Jumlah PR + Total Nilai |
| PR Pending Pembayaran 🟣 | Status 7,8,9,10,14,15 | Jumlah + Sisa belum dibayar |
| PR Selesai/Lunas 🔵 | Status 11 | Jumlah + Lebih/Kurang Bayar |
| PR Parsial 🔵 | payment_type=1, exclude 0/12/13 | Jumlah + Total + Sudah Bayar + Sisa |

### 2.4 Stat Cards SR Monitoring

| Kartu | Status Dihitung | Isi |
|-------|----------------|-----|
| SR Pending Persetujuan 🟠 | Status 1–6 | Jumlah + Total Nilai Realisasi |
| SR Pending Settlement 🟣 | Status 7,8,9 | Jumlah + Nilai |
| SR Selesai 🟢 | Status 10,11 | Jumlah + Total Nilai |
| Dana Settlement SR 🟢 | id_doc_type=3 | Kembalian + Tambahan Perusahaan |

### 2.5 Tab "Perlu Tindakan Saya" — Dokumen yang Masuk

**PR masuk berdasarkan permission:**

| Kondisi | Status PR |
|---------|-----------|
| Milik sendiri | 0 (Draft), 12 (Revisi) |
| `pr.approve.step1` | Status 1 |
| `pr.approve.step2` | Status 2 |
| `pr.approve.step3` | Status 3 |
| `pr.approve.step4` | Status 4 |
| `pr.approve.step5` | Status 5 |
| `pr.approve.step6` | Status 6 |
| `pr.payment` atau `pr_payment.create` | Status 7, 8 |
| `pr_payment.approve.step1` | Status 15 |
| `pr_payment.approve.step2` | Status 14 |

**SR masuk berdasarkan permission:**

| Kondisi | Status SR |
|---------|-----------|
| Milik sendiri | 0 (Draft), 12 (Revisi) |
| `sr.approve.step1`–`step6` | Status 1–6 |
| `sr_payment.create` | Status 7 |
| `sr_payment.approve` | Status 8, 9 |

**IKB masuk berdasarkan permission:**

| Kondisi | Status IKB |
|---------|-----------|
| Milik sendiri | 0 (Draft), 11 (Revision) |
| `ikb.approve.step1`–`step9` | Status 1–9 |

### 2.6 Status Label

**PR Status:**

| Kode | Label |
|------|-------|
| 0 | Draft |
| 1 | Pending Dept Review |
| 2 | Pending Director |
| 3 | Pending Accounting |
| 4 | Pending Finance |
| 5 | Pending SPV Finance |
| 6 | Pending CFO |
| 7 | Fully Approved / Pending Payment |
| 8 | Payment Parsial |
| 9 | Partially Paid |
| 10 | Pending Final Pay |
| 11 | Paid / Selesai |
| 12 | Revision |
| 13 | Rejected |
| 14 | Pending Director Sign Payment |
| 15 | Pending Manager Sign Payment |

**SR Status:** sama dengan PR kecuali 10 = "Paid / Balance Settled", tidak ada status 14/15.

**IKB Status:** 0=Draft, 1–9=Pending Step 1–9, 10=Approved/Done, 11=Revision, 12=Rejected.

---

## 3. Permission

| Fitur | Permission |
|-------|-----------|
| Lihat menu Dashboard di sidebar | `level 1` / `dashboard.view` / `dashboard.view.dept` / `dashboard.view.subordinate` |
| Stats semua user | `level 1` / `dashboard.view` |
| Stats dept + bawahan | `dashboard.view.dept` |
| Stats bawahan saja | `dashboard.view.subordinate` |
| Tampil di tab "Perlu Tindakan" | Sesuai permission approve masing-masing modul |
| Lihat semua tab PR Lunas/Parsial | `pr.payment` / `pr_payment.view` / `pr_payment.create` |
| Lihat semua tab SR Settlement | `sr_detail.view` / `sr_payment.view` / `sr.approve.step1–6` |

---

## 4. Langkah CRUD

Dashboard bersifat **read-only** (tidak ada CRUD). Semua data dihitung otomatis di `render()`:

1. Tentukan scope (hasDashAll / dept / subordinate / sendiri)
2. Hitung stats PR (4 kartu monitoring + 6 kartu summary)
3. Hitung stats SR (4 kartu monitoring)
4. Build daftar pending items berdasarkan permission
5. Paginate (10 item/halaman)
6. Kirim ke view → di-refresh setiap 30 detik

### Navigasi Tab

| Tab | `activeTab` | Badge |
|-----|-------------|-------|
| SEMUA | `all` | PR + SR + IKB |
| PR | `PR` | countPR |
| SR | `SR` | countSR |
| IKB | `IKB` | countIKB |
| PR Lunas | `pr_payment_full` | countPrFullPayment |
| PR Parsial | `pr_partial_payment` | countPrPartialPayment |
| SR Settlement | `sr_pending_settlement` | countSrPendingSettlement |

> Saat tab berganti, pagination di-reset ke halaman 1 via `updatedActiveTab()`.

---

*Terakhir diperbarui: 24 Maret 2026*
