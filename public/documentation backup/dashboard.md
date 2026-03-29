# Dokumentasi Fitur: Dashboard

**Modul**: Dashboard  
**File Utama**:
- View: `resources/views/livewire/dashboard.blade.php`
- Livewire Component: `app/Livewire/Dashboard.php`
- Route: `routes/web.php` → `GET /dashboard` (name: `dashboard`)
- Navbar: `resources/views/layouts/navbar.blade.php`

---

## 1. Deskripsi Umum

Dashboard adalah halaman utama setelah login. Menyajikan ringkasan monitoring keuangan (PR & SR) dan dokumen yang **perlu ditindaklanjuti** oleh user saat ini. Data di-refresh otomatis setiap **30 detik** (`wire:poll.30s`).

---

## 2. Route & Akses

| Method | URI | Name | Middleware |
|--------|-----|------|------------|
| `GET` | `/dashboard` | `dashboard` | `auth` |
| `GET` | `/` | — | `auth` | Redirect ke `/dashboard` |

### Akses Menu Navbar (Sidebar)

Menu Dashboard tampil di sidebar hanya jika user memiliki salah satu kondisi berikut:

| Kondisi | Permission |
|---------|-----------|
| `level === 1` | Super Admin |
| — | `dashboard.view` |
| — | `dashboard.view.dept` |
| — | `dashboard.view.subordinate` |

---

## 3. Scope Data Berdasarkan Permission

Seluruh data di dashboard (stats + tabel) difilter berdasarkan ruang lingkup akses user:

| Permission | Data yang Dihitung |
|-----------|-------------------|
| `level === 1` atau `dashboard.view` | Semua data di sistem (`hasDashAll`) |
| `dashboard.view.dept` | Data departemen user + bawahan langsung |
| `dashboard.view.subordinate` | Data user sendiri + bawahan langsung (`myIds`) |
| Tidak ada ketiganya | Data milik user sendiri saja |

---

## 4. Layout Halaman

```
┌─────────────────────────────────────────────────────────┐
│ Welcome Header (nama user, tanggal, jabatan/level)      │
├─────────────────────────────────────────────────────────┤
│ PR MONITORING (4 kartu besar)                           │
│ [Pending Persetujuan] [Pending Pembayaran] [Selesai]    │
│ [Bayar Sebagian]                                        │
├─────────────────────────────────────────────────────────┤
│ SR MONITORING (4 kartu besar)                           │
│ [Pending Persetujuan] [Pending Settlement] [Selesai]    │
│ [Dana Settlement]                                       │
├─────────────────────────────────────────────────────────┤
│ SUMMARY MINI CARDS (6 kartu kecil)                      │
│ Total PR | PR Pending | Total SR | SR Pending           │
│ Nilai PR | Transaksi Bulan Ini                          │
├─────────────────────────────────────────────────────────┤
│ TABEL PENDING APPROVAL (dengan Tab Navigation)          │
│ [SEMUA] [PR] [SR] [IKB] | [PR Lunas] [PR Parsial]      │
│                          | [SR Settlement]              │
└─────────────────────────────────────────────────────────┘
```

---

## 5. Welcome Header

| Elemen | Isi |
|--------|-----|
| Salam | "Selamat datang, {nama user}!" |
| Tanggal | Hari, tanggal bulan tahun (format Indonesia, via Carbon) |
| Badge jabatan | Jika `level === 1`: "Administrator" — Jika bukan: nama jabatan (position) |

---

## 6. Stat Cards — PR Monitoring (Baris 1 — 4 Kartu Besar)

### Kartu 1: PR Pending Persetujuan 🟠
- **Status yang dihitung**: 1–6 (dalam proses tanda tangan)
- **Menampilkan**: Jumlah PR + Total Nilai (Rp)
- **Keterangan**: "Dalam proses tanda tangan"

### Kartu 2: PR Pending Pembayaran 🟣
- **Status yang dihitung**: 7, 8, 9, 10, 14, 15 (PR dengan `payment_type_pr` tidak null)
- **Menampilkan**: Jumlah PR + **Sisa Tagihan Belum Dibayar** (total tagihan – sudah terbayar)
- **Logika**: `nilaiPrPendingPayment = total_ammount – sum(tbl_payment)`

### Kartu 3: PR Selesai / Lunas 🔵
- **Status yang dihitung**: 11 (Paid)
- **Menampilkan**: Jumlah PR + Total Nilai + Lebih Bayar + Kurang Bayar
- **Lebih Bayar**: `dibayar > tagihan` → selisih dikumpulkan
- **Kurang Bayar**: `tagihan > dibayar` → selisih dikumpulkan

### Kartu 4: PR Bayar Sebagian (Parsial) 🔵 Muda
- **Data**: PR dengan `payment_type_pr = 1` (termin), exclude status 0/12/13
- **Menampilkan**: Jumlah PR + Total Tagihan + Sudah Dibayar + **Sisa Tagihan**
- **Logika**: `sisa = totalTagihan – totalTerbayar`

---

## 7. Stat Cards — SR Monitoring (Baris 2 — 4 Kartu Besar)

### Kartu 1: SR Pending Persetujuan 🟠
- **Status**: 1–6
- **Menampilkan**: Jumlah SR + Total Nilai Realisasi

### Kartu 2: SR Pending Settlement 🟣
- **Status**: 7, 8, 9
- **Keterangan**: "Menunggu kembalian / tambahan dana"

### Kartu 3: SR Selesai 🟢
- **Status**: 10, 11
- **Menampilkan**: Jumlah SR + Total Nilai Realisasi

### Kartu 4: Dana Settlement SR 🟢 Tua
- **Kembalian Karyawan**: SR di mana `realisasi < penerimaan PR` → karyawan wajib kembalikan sisa
  - Dihitung dari `tbl_payment.id_doc_type = 3` (payment type kembalian)
- **Tambahan Perusahaan**: SR di mana `realisasi > penerimaan PR` → perusahaan tambah kekurangan
  - Dihitung dari `tbl_payment.id_doc_type = 3`
- **Total**: Kembalian + Tambahan

---

## 8. Summary Mini Cards (6 Kartu Kecil)

| Kartu | Data | Keterangan |
|-------|------|-----------|
| Total PR | Count semua PR dalam scope | — |
| PR Pending | PR dengan status selain 0, 11, 13 | Exclude draft, paid, rejected |
| Total SR | Count semua SR dalam scope | — |
| SR Pending | SR dengan status selain 0, 10, 11, 12, 13 | Exclude selesai & draft |
| Nilai PR | Total ammount PR (exclude status 0, 12, 13) | Nilai agregat |
| Transaksi Bulan Ini | Count `ItemTransaction` bulan & tahun ini | Sesuai scope akses |

---

## 9. Tabel Pending Approval — Tab Navigation

### 9.1 Daftar Tab

| Tab | Nilai `activeTab` | Badge Count | Isi |
|-----|------------------|-------------|-----|
| SEMUA | `all` | `countPR + countSR + countIKB` | Gabungan semua |
| PR | `PR` | `countPR` | Hanya dokumen PR |
| SR | `SR` | `countSR` | Hanya dokumen SR |
| IKB | `IKB` | `countIKB` | Hanya dokumen IKB |
| *(separator)* | — | — | Pemisah visual |
| PR Lunas | `pr_payment_full` | `countPrFullPayment` | PR `payment_type = 2`, status ≥ 7 |
| PR Parsial | `pr_partial_payment` | `countPrPartialPayment` | PR `payment_type = 1`, status ≥ 7 |
| SR Settlement | `sr_pending_settlement` | `countSrPendingSettlement` | SR status 7, 8, 9 |

> Saat tab berganti, halaman pagination di-reset ke halaman 1 (`updatedActiveTab()`).

### 9.2 Logika Tab SEMUA / PR / SR / IKB — "Perlu Tindakan Saya"

Dokumen yang tampil di tabs ini adalah dokumen yang **memerlukan tindakan dari user saat ini**, berdasarkan permission:

#### PR — Dokumen yang Masuk

| Kondisi | Status PR yang Masuk |
|---------|---------------------|
| Milik sendiri (semua user) | 0 (Draft), 12 (Revisi) → hanya punya sendiri |
| `pr.approve.step1` | Status 1 |
| `pr.approve.step2` | Status 2 |
| `pr.approve.step3` | Status 3 |
| `pr.approve.step4` | Status 4 |
| `pr.approve.step5` | Status 5 |
| `pr.approve.step6` | Status 6 |
| `pr.payment` atau `pr_payment.create` | Status 7, 8 |
| `pr_payment.approve.step1` | Status 15 (Manager Sign Payment) |
| `pr_payment.approve.step2` | Status 14 (Director Sign Payment) |

#### SR — Dokumen yang Masuk

| Kondisi | Status SR yang Masuk |
|---------|---------------------|
| Milik sendiri | 0 (Draft), 12 (Revisi) |
| `sr.approve.step1` | Status 1 |
| `sr.approve.step2` | Status 2 |
| `sr.approve.step3` | Status 3 |
| `sr.approve.step4` | Status 4 |
| `sr.approve.step5` | Status 5 |
| `sr.approve.step6` | Status 6 |
| `sr_payment.create` | Status 7 |
| `sr_payment.approve` | Status 8, 9 |

#### IKB — Dokumen yang Masuk

| Kondisi | Status IKB yang Masuk |
|---------|----------------------|
| Milik sendiri | 0 (Draft), 11 (Revision) |
| `ikb.approve.step1` | Status 1 |
| `ikb.approve.step2` | Status 2 |
| `ikb.approve.step3` | Status 3 |
| `ikb.approve.step4` | Status 4 |
| `ikb.approve.step5` | Status 5 |
| `ikb.approve.step6` | Status 6 |
| `ikb.approve.step7` | Status 7 |
| `ikb.approve.step8` | Status 8 |
| `ikb.approve.step9` | Status 9 |

### 9.3 Kolom Tabel (Tab SEMUA / PR / SR / IKB)

| Kolom | Isi |
|-------|-----|
| Tipe | Badge berwarna (PR / SR / IKB) |
| Nomor | Nomor dokumen (pr_number, sr number, ikb_number) |
| Subject / Keperluan | Keperluan atau tujuan dokumen |
| Tanggal | Tanggal created (format: dd MMM YYYY) |
| Status | Badge status dokumen |
| Aksi | Tombol "Detail" → link ke halaman detail |

> Setiap baris bisa diklik (seluruh baris clickable via `onclick`).  
> Pagination 10 item per halaman, diurutkan dari terbaru (desc timestamp).

### 9.4 Tab PR Lunas (`pr_payment_full`)

Menampilkan PR dengan `payment_type_pr = 2` (full/lunas), status ≥ 7, belum paid/rejected.

| Kolom | Isi |
|-------|-----|
| PR Number | Nomor PR + subject |
| Vendor | Nama vendor |
| User | Nama pembuat PR |
| Jumlah Tagihan | Total dari `tbl_detail_pr` |
| Aksi | Tombol "Bayar" → ke `payment-requests.show` |

**Siapa yang melihat semua PR?** → `pr.payment` atau `pr_payment.view` atau `pr_payment.create`  
**Jika tidak punya permission di atas** → hanya PR milik sendiri yang tampil.

### 9.5 Tab PR Parsial (`pr_partial_payment`)

Menampilkan PR dengan `payment_type_pr = 1` (termin/parsial), status ≥ 7.

| Kolom | Isi |
|-------|-----|
| PR Number | Nomor PR + subject |
| Vendor | Nama vendor |
| User | Nama pembuat |
| Total Tagihan | Sum tbl_detail_pr |
| Sudah Dibayar | Sum tbl_payment (doc_type 1 & 2) |
| Sisa Tagihan | Tagihan – Dibayar |
| Aksi | Tombol "Detail" |

### 9.6 Tab SR Settlement (`sr_pending_settlement`)

Menampilkan SR dengan status 7, 8, 9.

| Kolom | Isi |
|-------|-----|
| PR Number (Referensi) | Nomor PR referensi + subject SR |
| User | Nama pembuat SR |
| Total Penerimaan | Dana yang diterima dari PR |
| Total Dilaporkan | Realisasi dari tbl_detail_sr |
| Selisih | Label: **Nombok** (dilaporkan > diterima) / **Kembalian** (diterima > dilaporkan) / **Balance** |
| Aksi | Tombol "Detail SR" → `settlement-reports.show` |

**Siapa yang melihat?** → `sr_detail.view`, `sr_payment.view`, atau `sr.approve.step1–6`  
**Tanpa permission di atas** → hanya SR milik sendiri.

---

## 10. Status Label Referensi

### PR Status

| Kode | Label | Warna |
|------|-------|-------|
| 0 | Draft | Abu-abu |
| 1 | Pending Dept Sign | Kuning |
| 2 | Pending Director Sign | Kuning |
| 3 | Pending Accounting Sign | Kuning |
| 4 | Pending Finance Sign | Kuning |
| 5 | Pending SPV Finance Sign | Kuning |
| 6 | Pending CFO Sign | Kuning |
| 7 | Pending Payment | Kuning |
| 8 | Payment Parsial | Biru |
| 9 | Pending Receipt Parsial | Biru |
| 10 | Pending Receipt | Biru |
| 11 | Paid | Hijau |
| 12 | Revision | Biru tua |
| 13 | Rejected | Merah |
| 14 | Pending Director Sign Payment | Merah |
| 15 | Pending Manager Sign Payment | Merah |

### SR Status

| Kode | Label | Warna |
|------|-------|-------|
| 0 | Draft | Abu-abu |
| 1–6 | (sama dengan PR) | Kuning |
| 7 | Pending Payment | Kuning |
| 8 | Payment Parsial | Biru |
| 9 | Pending Receipt Parsial | Biru |
| 10 | Paid / Balance Settled | Hijau |
| 12 | Revision | Biru tua |
| 13 | Rejected | Merah |

### IKB Status

| Kode | Label |
|------|-------|
| 0 | DRAFT |
| 1 | PENDING SPV/MGR SIGN |
| 2 | PENDING DIR LOG SIGN |
| 3 | PENDING PPIC SIGN |
| 4 | PENDING INV CTRL SIGN |
| 5 | PENDING LOG COORD SIGN |
| 6 | PENDING WH STAFF SIGN |
| 7 | PENDING WH SPV SIGN |
| 8 | PENDING SECURITY SIGN |
| 9 | PENDING FINAL LOG COORD |
| 10 | APPROVED / DONE |
| 11 | REVISION |
| 12 | REJECTED |

---

## 11. Livewire Component: `App\Livewire\Dashboard`

### 11.1 Properties

| Property | Default | Keterangan |
|----------|---------|-----------|
| `$activeTab` | `'all'` | Tab yang sedang aktif di tabel bawah |
| `$monitorPage` | `1` | Halaman untuk tab monitoring (PR Lunas, PR Parsial, SR Settlement) |

### 11.2 Methods

| Method | Keterangan |
|--------|-----------|
| `updatedActiveTab()` | Reset pagination ke halaman 1 saat tab berubah |
| `render()` | Hitung semua stats + build pending items + paginate + pass ke view |
| `static prStatusLabel($status)` | Return `[label, color]` untuk status PR |
| `static srStatusLabel($status)` | Return `[label, color]` untuk status SR |
| `static ikbStatusLabel($status)` | Return `[label, color]` untuk status IKB |

### 11.3 Traits

| Trait | Fungsi |
|-------|--------|
| `WithPagination` | Mengelola pagination tabel pending items |

### 11.4 Data yang Dikirim ke View

| Variabel | Tipe | Isi |
|----------|------|-----|
| `$stats` | array | 25+ nilai agregat untuk stat cards |
| `$pendingItems` | `LengthAwarePaginator` | Items pending approval (10/halaman) |
| `$user` | `User` | User yang sedang login |
| `$tabCounts` | array | Count per tab untuk badge |
| `$prFullPaymentItems` | `LengthAwarePaginator` | PR Lunas untuk tab monitoring |
| `$prPartialPaymentItems` | `LengthAwarePaginator` | PR Parsial untuk tab monitoring |
| `$srSettlementItems` | `LengthAwarePaginator` | SR Settlement untuk tab monitoring |

---

## 12. Auto-Refresh

Dashboard menggunakan `wire:poll.30s` — seluruh komponen di-render ulang setiap 30 detik untuk memperbarui data secara otomatis tanpa perlu reload halaman.

---

## 13. Permission Summary

| Fitur | Permission |
|-------|-----------|
| Melihat dashboard (menu sidebar) | `level 1` / `dashboard.view` / `dashboard.view.dept` / `dashboard.view.subordinate` |
| Stats & data semua user | `level 1` / `dashboard.view` |
| Stats dept + bawahan | `dashboard.view.dept` |
| Stats bawahan saja | `dashboard.view.subordinate` |
| Tampil di tab "Perlu Tindakan" | Sesuai permission approve masing-masing modul |
| Lihat semua di tab PR Lunas/Parsial | `pr.payment` / `pr_payment.view` / `pr_payment.create` |
| Lihat semua di tab SR Settlement | `sr_detail.view` / `sr_payment.view` / `sr.approve.step1-6` |

---

*Dokumentasi dibuat dari: `app/Livewire/Dashboard.php`, `resources/views/livewire/dashboard.blade.php`, `resources/views/layouts/navbar.blade.php`*  
*Terakhir diperbarui: 23 Maret 2026*
