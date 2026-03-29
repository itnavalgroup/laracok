# ⚙️ Reference Data Lanjutan

Dokumentasi ini mencakup 9 modul master data: **Position, Document Type, Currency, Cost Category, Cost Type, Attachment, Loan, Tax Type, Tax**. Semua mengikuti pola identik: index + modal CRUD + search + proteksi relasi + `wire:poll.5s`.

---

## 1. Fungsi Modul

| Modul | Fungsi |
|-------|--------|
| Position | Master jabatan/posisi karyawan — referensi saat buat/edit user |
| Document Type | Jenis dokumen (Faktur, Kwitansi, dll.) — dipakai di PR & SR |
| Currency | Mata uang transaksi PR (IDR, USD, dll.) |
| Cost Category | Pengelompokan biaya — **parent** dari Cost Type |
| Cost Type | Jenis biaya yang dipilih saat buat PR — **child** dari Cost Category |
| Attachment | Jenis lampiran (KTP, NPWP, Kontrak, dll.) — dipakai di PR, SR, Payment |
| Loan | Sumber dana PR dan SR (Dana Kas, Kredit Bank, dll.) |
| Tax Type | Jenis pajak (PPN, PPh 21, PPh 23) — **parent** dari Tax |
| Tax | Tarif pajak spesifik (%); dipakai di detail PR dan SR |

---

## 2. Cara Kerja

### 2.1 Hierarki

```
Cost Category (parent)
    └── Cost Type (child) → dipilih saat buat PR

Tax Type (parent)
    └── Tax / Tarif Pajak (child) → dipilih di detail item PR/SR
```

### 2.2 Field per Modul

| Modul | Field Wajib | Catatan |
|-------|-------------|---------|
| Position | Position Name (unique) | — |
| Document Type | Doc Type Name (unique) | — |
| Currency | Country, Code (max 3, unique), Symbol | — |
| Cost Category | Category Name (unique) | — |
| Cost Type | Cost Category (FK), Cost Type Name (unique), Cost Document | — |
| Attachment | Name, Department | Default dept: dept user (non-Admin) / Global (Admin) |
| Loan | Loan Name (unique) | — |
| Tax Type | Tax Type Name, Description | Permission pakai slug `tax.*` (sama dengan Tax) |
| Tax | Tax Type (FK), Tax Name, Percentage, Description, Status | Input %, disimpan desimal (`11 → 0.11`) |

### 2.3 Cek Relasi Sebelum Hapus

| Modul | Relasi yang Dicek |
|-------|------------------|
| Position | `tbl_user` |
| Document Type | `tbl_pr`, `tbl_sr` |
| Currency | `tbl_pr` |
| Cost Category | `tbl_cost_types` (anak Cost Type) |
| Cost Type | `tbl_pr` |
| Attachment | `tbl_attachment_pr`, `tbl_attachment_sr`, `tbl_attachment_payment` |
| Loan | `tbl_pr`, `tbl_sr` |
| Tax Type | `tbl_taxes` (anak Tax) |
| Tax | `tbl_detail_pr.id_tax1`, `tbl_detail_sr.id_tax1` |

### 2.4 Fitur Khusus Attachment

| Fitur | Permission |
|-------|-----------|
| Import Excel | `attachment.upload` |
| Export Excel | `attachment.download` |
| Download template | `attachment.upload` |

> Import memakai logika `updateOrCreate` — tidak duplikasi. Filter export mengikuti `departmentFilter` aktif.

---

## 3. Permission

| Modul | View | Create | Edit | Delete | Extra |
|-------|------|--------|------|--------|-------|
| Position | `position.view` | `position.create` | `position.edit` | `position.delete` | — |
| Document Type | `doc_type.view` | `doc_type.create` | `doc_type.edit` | `doc_type.delete` | — |
| Currency | `currency.view` | `currency.create` | `currency.edit` | `currency.delete` | — |
| Cost Category | `cost_category.view` | `cost_category.create` | `cost_category.edit` | `cost_category.delete` | — |
| Cost Type | `cost_type.view` | `cost_type.create` | `cost_type.edit` | `cost_type.delete` | — |
| Attachment | `attachment.view` | `attachment.create` | `attachment.edit` | `attachment.delete` | `attachment.upload`, `attachment.download` |
| Loan | `loan.view` | `loan.create` | `loan.edit` | `loan.delete` | — |
| Tax Type | `tax.view` | `tax.create` | `tax.edit` | `tax.delete` | ⚠️ Sama dengan Tax |
| Tax | `tax.view` | `tax.create` | `tax.edit` | `tax.delete` | ⚠️ Sama dengan Tax Type |

> ⚠️ **Tax Type dan Tax berbagi satu set permission** (`tax.*`). Satu permission untuk keduanya.
> ✅ Semua aksi bisa dilakukan oleh **level 1 (Super Admin)** tanpa permission eksplisit.

---

## 4. Langkah CRUD

> Pola identik untuk semua 9 modul:

### Tambah (Create)

1. Klik **Add [Nama]** (perlu `*.create`)
2. Modal terbuka — isi field
3. Klik **Save** → validasi → insert ke database

### Edit

1. Klik ✏️ (perlu `*.edit`)
2. Modal terisi data lama
3. Edit field → klik **Update** → validasi (unique exclude self) → update

### Hapus

1. Klik 🗑️ (perlu `*.delete`)
2. Cek relasi (lihat tabel 2.3)
3. Ada relasi → tolak dengan pesan error
4. Aman → hapus data

### Import Attachment dari Excel

1. Klik **Import** (perlu `attachment.upload`)
2. (Opsional) Download template — kolom: `attachment_name`
3. Upload `.xlsx`/`.xls` max 5MB
4. Klik **Upload & Import** → proses `updateOrCreate` per baris

### Export Attachment ke Excel

1. Klik **Export** (perlu `attachment.download`)
2. Download `Data_Lampiran_YYYYMMDD_HHMMSS.xlsx`
3. Kolom: ID, Nama Lampiran, Departement, Dibuat Oleh, Tgl Dibuat

---

*Terakhir diperbarui: 24 Maret 2026*
