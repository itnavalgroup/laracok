# Dokumentasi Fitur: Company Management

**Modul**: Companies  
**File Utama**:
- View: `resources/views/livewire/companies/index.blade.php`
- Livewire Component: `app/Livewire/Companies/Index.php`
- Route: `routes/web.php` → `GET /companies` (name: `companies.index`)

---

## 1. Deskripsi Umum

Modul Company Management digunakan untuk mengelola data perusahaan yang terdaftar di sistem (misalnya entitas grup perusahaan). Data perusahaan ini digunakan sebagai referensi utama untuk user, PR, SR, IKB, dan Invoice. Fitur mencakup CRUD perusahaan dengan upload logo. Data di-refresh otomatis setiap **5 detik** (`wire:poll.5s`).

> Modul ini bersifat **administratif** dan umumnya hanya diakses oleh Super Admin atau user dengan permission khusus.

---

## 2. Route & Akses

| Method | URI | Name | Middleware |
|--------|-----|------|------------|
| `GET` | `/companies` | `companies.index` | `auth` |

**Akses Halaman (mount)**: Jika user tidak memiliki `level === 1` **dan** tidak memiliki `company.view` → redirect ke halaman sebelumnya, atau dashboard, atau profil.

---

## 3. Summary Cards

| Kartu | Warna | Isi |
|-------|-------|-----|
| Total Companies | Biru | Total semua perusahaan yang cocok dengan filter |
| Per Page | Cyan | Jumlah record per halaman |
| Current Page | Hijau | Halaman yang sedang aktif |
| Total Pages | Kuning | Total halaman dari hasil query |

---

## 4. Filter & Pencarian

| Filter | Binding | Keterangan |
|--------|---------|-----------|
| Search | `wire:model.live="search"` | Cari berdasarkan `company_name` atau `company` (alias/kode) |
| Per Page | `wire:model.live="perPage"` | Pilihan: 10, 25, 50, 100 |

> Saat search berubah → halaman di-reset ke 1 (`updatedSearch()`).

---

## 5. Tabel Company

### Kolom Tabel

| Kolom | Isi |
|-------|-----|
| No | Nomor urut (berdasarkan pagination) |
| Logo | Logo perusahaan (gambar 45x45px) atau ikon default jika tidak ada |
| Company Name | Nama lengkap perusahaan |
| Alias / Code | Kode singkat perusahaan (badge biru) |
| Created At | Tanggal dibuat (format: dd MMM YYYY) |
| Actions | Tombol Edit dan Delete |

### Tombol Aksi di Tabel

| Tombol | Icon | Permission | Aksi |
|--------|------|-----------|------|
| Edit (✏️) | `ti-edit` | `level === 1` atau `company.edit` | `wire:click="edit($id)"` → buka modal edit |
| Delete (🗑️) | `ti-trash` | `level === 1` atau `company.delete` | Dialog konfirmasi → `delete($id)` |

### Tombol Header

| Tombol | Permission | Aksi |
|--------|-----------|------|
| Add Company | `level === 1` atau `company.create` | `wire:click="create"` → buka modal tambah |

---

## 6. Modal Company (`#companyModal`)

Modal ini digunakan untuk mode **Create** dan **Edit** (tidak ada mode view-only).

| State | Judul Modal | Submit Method |
|-------|-------------|---------------|
| `$isEditing = false` | "Add New Company" | `save()` → Create |
| `$isEditing = true` | "Edit Company" | `save()` → Update |

### Field Form

| Field | Required | Validasi | Keterangan |
|-------|----------|---------|-----------|
| Company Name | ✅ | `required|string|max:255` | Nama lengkap perusahaan |
| Alias / Code | ✅ | `required|string|max:50|unique:tbl_company,company` | Kode unik internal (exclude ID sendiri saat edit) |
| Logo | ❌ | `nullable|image|max:5024` (5MB) | File gambar JPG/PNG/WEBP, preview tampil saat dipilih |

### Preview Logo di Modal

| Kondisi | Tampilan |
|---------|---------|
| `$logo` ada (file baru dipilih) | Preview dari `temporaryUrl()` + tombol ✕ untuk hapus |
| `$existingLogo` ada (edit, belum ganti logo) | Gambar logo lama dari `assets/companies/logos/` |
| Tidak ada keduanya | Ikon upload placeholder |

### Tombol Footer Modal

| Tombol | Aksi |
|--------|------|
| Cancel | `data-bs-dismiss="modal"` — tutup modal |
| Save Company / Update Data | `wire:submit.prevent="save"` |

---

## 7. Flow Proses

### 7.1 Tambah Company Baru

```
[Klik "Add Company"]
   Cek permission: company.create
        │
        ▼
[resetForm() → dispatch 'openCompanyModal']
        │
[Isi: Company Name, Alias/Code, Logo (opsional)]
        │
[Submit form → save()]
   Cek permission: company.create
        │
        ▼
[Validasi:]
   - company_name: required, max 255
   - company: required, max 50, unique
   - logo: nullable, image, max 5MB
        │
[Jika ada logo baru:]
   Simpan ke: public/assets/companies/logos/{filename}_{timestamp}.ext
        │
[Company::create($data)]
        │
   Sukses → closeCompanyModal + alert sukses
   Gagal  → error ditampilkan di field
```

### 7.2 Edit Company

```
[Klik ✏️ Edit]
   Cek permission: company.edit
        │
        ▼
[Load data company → isi form → isEditing = true]
[dispatch 'openCompanyModal']
        │
[Edit data → Submit → save()]
   Cek permission: company.edit
        │
        ▼
[Validasi (alias/code exclude ID sendiri)]
        │
[Jika ganti logo:]
   Hapus logo lama dari folder
   Simpan logo baru
        │
[Company::find($id)->update($data)]
        │
   Sukses → closeCompanyModal + alert sukses
```

### 7.3 Hapus Company

```
[Klik 🗑️ → Dialog konfirmasi muncul]
        │ Klik "Hapus"
        ▼
[delete($id)]
   Cek permission: company.delete
        │
[Cek relasi aktif:]
   - Ada User yang terhubung?    → Tolak: "masih digunakan pada data User"
   - Ada PR yang terhubung?      → Tolak: "masih digunakan pada data Purchase Request (PR)"
   - Ada SR yang terhubung?      → Tolak: "masih digunakan pada data Service Request (SR)"
   - Ada IKB yang terhubung?     → Tolak: "masih digunakan pada data IKB"
   - Ada Invoice yang terhubung? → Tolak: "masih digunakan pada data Invoice"
        │
[Aman → company->delete() (soft delete)]
   Alert sukses
```

---

## 8. Validasi & Error

### Server-side

| Field | Rule | Error |
|-------|------|-------|
| `company_name` | `required|string|max:255` | "The company name field is required." |
| `company` | `required|string|max:50|unique` | "The company has already been taken." |
| `logo` | `nullable|image|max:5024` | "The logo must be an image. / Max 5MB." |

### Error Bisnis (Hapus)

| Kondisi | Pesan |
|---------|-------|
| Ada User terhubung | "Perusahaan tidak dapat dihapus karena masih digunakan pada data User." |
| Ada PR terhubung | "...Purchase Request (PR)." |
| Ada SR terhubung | "...Service Request (SR)." |
| Ada IKB terhubung | "...IKB." |
| Ada Invoice terhubung | "...Invoice." |

---

## 9. Logo Perusahaan

| Aspek | Detail |
|-------|--------|
| Lokasi penyimpanan | `public/assets/companies/logos/` |
| Format nama file | `{original_name}_{timestamp}.{ext}` (spasi diganti `_`) |
| Tipe file yang diizinkan | JPG, PNG, WEBP (image) |
| Ukuran maksimal | 5MB |
| Hapus logo lama | Otomatis saat ganti logo baru (hard delete file lama dengan `unlink()`) |
| Ditampilkan di | Tabel kolom Logo, modal preview |

---

## 10. Livewire Component: `App\Livewire\Companies\Index`

### Properties

| Property | Default | Keterangan |
|----------|---------|-----------|
| `$search` | `''` | Kata kunci pencarian |
| `$perPage` | `10` | Record per halaman |
| `$id_company` | null | ID company yang sedang diedit |
| `$company_name` | — | Nama perusahaan |
| `$company` | — | Alias/kode unik |
| `$logo` | null | File upload baru (Livewire `WithFileUploads`) |
| `$existingLogo` | null | Nama file logo lama |
| `$isEditing` | `false` | Flag mode edit |

### Methods

| Method | Permission | Deskripsi |
|--------|-----------|-----------|
| `mount()` | `company.view` | Guard akses halaman, redirect jika unauthorized |
| `handleUnauthorized()` | — | Redirect ke halaman sebelumnya/dashboard/profil |
| `updatedSearch()` | — | Reset pagination ke halaman 1 |
| `resetForm()` | — | Reset semua field + error bag |
| `create()` | `company.create` | Reset form + buka modal create |
| `edit($id)` | `company.edit` | Load data + buka modal edit |
| `save()` | `company.create` atau `company.edit` | Validasi + create/update company + handle logo |
| `delete($id)` | `company.delete` | Cek relasi + soft delete |
| `render()` | — | Query company dengan search, paginate, kirim ke view |

### Events

| Event | Kapan | Keterangan |
|-------|-------|-----------|
| `openCompanyModal` | Saat create/edit | Buka modal Bootstrap |
| `closeCompanyModal` | Setelah save berhasil | Tutup modal Bootstrap |
| `alert` | Setelah setiap aksi | `type: 'success'/'danger'`, `message: '...'` |

---

## 11. Permission Summary

| Aksi | Level 1 | Permission |
|------|---------|-----------|
| Akses halaman `/companies` | ✅ | `company.view` |
| Tambah perusahaan | ✅ | `company.create` |
| Edit perusahaan (nama, alias, logo) | ✅ | `company.edit` |
| Hapus perusahaan | ✅ | `company.delete` |

> **Tidak ada** permission untuk view-only karena tidak ada tombol "View" di tabel (hanya Edit dan Delete).

---

## 12. Catatan Penting

- **Soft Delete**: Penghapusan perusahaan menggunakan soft delete (`deleted_at`), sehingga data tidak benar-benar hilang dari database.
- **Relasi**: Company digunakan di `tbl_user`, `tbl_pr`, `tbl_sr`, `tbl_ikb`, dan `tbl_invoice` — semua harus bebas relasi sebelum bisa dihapus.
- **Default Company**: Berdasarkan kode `Create.php` di modul Users, user baru otomatis mendapat `id_company = 1` sebagai perusahaan default.

---

*Dokumentasi dibuat dari: `app/Livewire/Companies/Index.php`, `resources/views/livewire/companies/index.blade.php`*  
*Terakhir diperbarui: 23 Maret 2026*
