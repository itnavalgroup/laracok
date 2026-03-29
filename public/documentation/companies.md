# 🏛️ Company Management

## 1. Fungsi Modul

Modul Company digunakan untuk mengelola data perusahaan yang terdaftar dalam sistem (entitas grup). Data perusahaan menjadi **referensi utama** untuk User, PR, SR, IKB, dan Invoice. Bersifat administratif, umumnya hanya diakses Super Admin.

**File Utama:**
- Component: `app/Livewire/Companies/Index.php`
- View: `resources/views/livewire/companies/index.blade.php`
- Route: `GET /companies` (middleware: `auth`)

---

## 2. Cara Kerja

### 2.1 Mode Modal

Modal `#companyModal` berfungsi untuk Create dan Edit (tidak ada mode view-only):

| `$isEditing` | Judul Modal | Method |
|-------------|-------------|--------|
| `false` | Add New Company | `save()` → Create |
| `true` | Edit Company | `save()` → Update |

### 2.2 Upload Logo

| Aspek | Detail |
|-------|--------|
| Lokasi | `public/assets/companies/logos/` |
| Format nama | `{nama}_{timestamp}.{ext}` |
| Tipe file | JPG, PNG, WEBP |
| Max ukuran | 5 MB |
| Saat edit | File lama dihapus otomatis (`unlink()`) sebelum simpan baru |

### 2.3 Cek Relasi Sebelum Hapus

Company tidak bisa dihapus jika masih dipakai oleh: **User**, **PR**, **SR**, **IKB**, atau **Invoice**.

### 2.4 Filter

| Filter | Keterangan |
|--------|-----------|
| Search | `company_name` atau `company` (alias) |
| Per Page | 10 / 25 / 50 / 100 |

> Auto-refresh setiap 5 detik. Soft delete — data tidak benar-benar hilang dari database.

---

## 3. Permission

| Aksi | Level 1 | Permission |
|------|---------|-----------|
| Akses halaman `/companies` | ✅ | `company.view` |
| Tambah perusahaan | ✅ | `company.create` |
| Edit perusahaan | ✅ | `company.edit` |
| Hapus perusahaan | ✅ | `company.delete` |

> Tidak ada permission view-only terpisah karena tabel tidak punya tombol "View".

---

## 4. Langkah CRUD

### Tambah Company (Create)

1. Klik **Add Company** (perlu `company.create`)
2. Isi modal:
   - **Company Name** ✅ `required|max:255`
   - **Alias / Code** ✅ `required|max:50|unique:tbl_company,company`
   - **Logo** ❌ gambar opsional (max 5MB, preview real-time)
3. Klik **Save Company** → `save()` → `Company::create($data)`

### Edit Company

1. Klik ✏️ (perlu `company.edit`)
2. Form terisi data lama, logo lama ditampilkan sebagai preview
3. Ubah data → klik **Update Data** → validasi (alias exclude ID sendiri)
4. Jika ganti logo → hapus file lama → simpan file baru
5. `Company::find($id)->update($data)`

### Hapus Company

1. Klik 🗑️ (perlu `company.delete`)
2. Cek relasi ke User, PR, SR, IKB, Invoice
3. Jika ada relasi → tolak dengan pesan spesifik
4. Jika aman → soft delete (`deleted_at` diisi)

### Error Hapus

| Relasi yang Ada | Pesan Error |
|-----------------|-------------|
| Ada User | "...masih digunakan pada data User." |
| Ada PR | "...Purchase Request (PR)." |
| Ada SR | "...Service Request (SR)." |
| Ada IKB | "...IKB." |
| Ada Invoice | "...Invoice." |

---

*Terakhir diperbarui: 24 Maret 2026*
