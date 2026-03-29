# 🏢 Vendor Management

## 1. Fungsi Modul

Modul Vendor digunakan untuk mengelola data mitra/vendor perusahaan. Mencakup CRUD vendor lengkap dengan email kontak, rekening bank, serta kemampuan **Import/Export Excel**. Data di-refresh setiap **5 detik**.

**File Utama:**
- Component: `app/Livewire/Vendors/Index.php`
- View: `resources/views/livewire/vendors/index.blade.php`
- Route: `GET /vendors` (middleware: `auth`)

---

## 2. Cara Kerja

### 2.1 Aturan Departemen Vendor

| Pembuat | `id_departement` | Keterangan |
|---------|-----------------|-----------|
| Admin (level 1) | `null` | Vendor **Global** — bisa dipakai semua dept |
| Non-Admin | `departement user` | Vendor terikat ke departemen pembuat |

### 2.2 Mode Modal

Modal tunggal `#vendorModal` berfungsi untuk 3 mode:

| State | Mode | Form |
|-------|------|------|
| `isShowOnly = true` | View | Semua field disabled (read-only) |
| `isEditing = true` | Edit | Field aktif sesuai permission |
| Default | Create | Semua field aktif |

### 2.3 Enkripsi Data Sensitif

| Data | Proses |
|------|--------|
| NPWP | `encrypt_legacy()` saat simpan, `decrypt_legacy()` saat load |
| NIK | `encrypt_legacy()` saat simpan, `decrypt_legacy()` saat load |

### 2.4 `canEditMainData` Flag

Edit nama, NPWP, NIK hanya bisa jika: `level === 1` ATAU user adalah **creator** vendor tersebut.

### 2.5 Lock Email & Rekening (`is_used`)

Email / rekening yang sudah dipakai di transaksi PR/SR akan muncul dengan ikon 🔒:
- Field menjadi disabled
- Tombol hapus disembunyikan
- Tidak bisa dihapus meski di-request

### 2.6 Filter Index

| Filter | Keterangan |
|--------|-----------|
| Search | Nama vendor atau ID (debounce 300ms) |
| Department | Filter berdasarkan departemen |
| Per Page | 10 / 25 / 50 |

---

## 3. Permission

| Aksi | Level 1 | Permission |
|------|---------|-----------|
| Akses halaman `/vendors` | ✅ | `vendor.view` |
| Lihat detail vendor | ✅ | `vendor.view` |
| Tambah vendor baru | ✅ | `vendor.create` |
| Edit vendor | ✅ | `vendor.edit` |
| Edit NPWP & NIK | ✅ | Creator vendor (ownership) |
| Ubah status Active/Inactive | ✅ | `vendor.activate` |
| Hapus vendor | ✅ | `vendor.delete` + harus Admin atau Creator |
| Export ke Excel | ✅ | `vendor.download` |
| Download template import | ✅ | `vendor.download` |
| Import dari Excel | ✅ | `vendor.upload` |

---

## 4. Langkah CRUD

### Tambah Vendor (Create)

1. Klik **Add Vendor** (perlu `vendor.create`)
2. Modal terbuka — isi:
   - **Vendor Name** ✅ `required|max:255`
   - **NPWP** ❌ (opsional, cek uniqueness)
   - **NIK** ❌ (opsional, cek uniqueness)
   - **Status Active** (toggle)
   - **Email(s)** — minimal bisa kosong
   - **Bank Account(s)** — nama bank, pemilik, nomor rekening
3. Klik **Save Vendor** → `store()`
4. Validasi uniqueness NPWP & NIK secara manual (karena kolom terenkripsi)
5. DB Transaction: insert `tbl_vendor` → insert `tbl_email_vendor` → insert `tbl_norek_vendor`

### Edit Vendor

1. Klik ✏️ (perlu `vendor.edit`)
2. `loadVendor($id)`: decrypt NPWP/NIK, load email + rekening + flag `is_used`
3. Cek `canEditMainData` — jika false → nama/NPWP/NIK di-disable
4. Edit data → klik **Update Data** → `update()`
5. Sync email & rekening: update existing, insert baru, delete yang dihapus (kecuali `is_used`)

### Hapus Vendor

1. Klik 🗑️ (perlu `vendor.delete`)
2. Cek ownership: Level 1 atau creator
3. Cek relasi: ada PR terhubung? → **tolak** hapus
4. Jika aman → `vendor->delete()` (soft delete)

### View Detail

1. Klik 👁️ (perlu `vendor.view`)
2. Load data → buka modal dengan `isShowOnly = true`
3. Semua field read-only

### Import dari Excel

1. Klik **Import** (perlu `vendor.upload`)
2. Download template opsional: kolom `vendor, npwp, nik, email, nama_bank, nama_penerima, norek`
3. Upload file `.xlsx`/`.xls` (max 5MB)
4. Klik **Upload & Import** → `import()` → `Excel::import(VendorsImport, file)`

### Export ke Excel

1. Klik **Export** (perlu `vendor.download`)
2. `export()` → download `Data_Vendor_YYYYMMDD_HHMMSS.xlsx`

### Error Bisnis

| Kondisi | Pesan |
|---------|-------|
| NPWP sudah terdaftar | "NPWP sudah terdaftar." |
| NIK sudah terdaftar | "NIK sudah terdaftar." |
| Hapus vendor yang punya PR | "Vendor tidak bisa dihapus karena masih terhubung dengan PR." |
| Delete oleh non-Admin/non-creator | "Hanya Admin atau Pembuat Vendor yang bisa menghapus." |

---

*Terakhir diperbarui: 24 Maret 2026*
