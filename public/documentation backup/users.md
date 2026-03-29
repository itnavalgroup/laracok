# Dokumentasi Fitur: User Management

**Modul**: Users  
**File Utama**:
- Views: `resources/views/livewire/users/` (index, create, edit, show)
- Livewire Components: `app/Livewire/Users/` (Index, Create, Edit, Show)
- Route: `routes/web.php` → prefix `/users`
- Navbar: `resources/views/layouts/navbar.blade.php`

---

## 1. Deskripsi Umum

Modul User Management digunakan untuk mengelola data user/karyawan sistem. Mencakup daftar user, tambah user baru, edit data user, hapus user, dan melihat detail user. Akses ke modul ini dikontrol ketat berdasarkan **level** dan **permission** user.

---

## 2. Routes

| Method | URI | Name | Middleware | Keterangan |
|--------|-----|------|------------|-----------|
| `GET` | `/users` | `users.index` | `auth` | Daftar semua user |
| `GET` | `/users/create` | `users.create` | `auth` | Form tambah user baru |
| `GET` | `/users/edit/{hash}` | `users.edit` | `auth` | Form edit user |
| `GET` | `/users/{hash}` | `users.show` | `auth` | Detail user |

> **Hash**: ID user di-encode menggunakan `hashid_encode()` / `hashid_decode()` untuk menyembunyikan ID asli di URL.

---

## 3. Akses ke Menu Navbar

Menu **User** di sidebar hanya tampil jika user memiliki salah satu permission berikut:

| Kondisi | Keterangan |
|---------|-----------|
| `level === 1` | Super Admin — akses penuh |
| `user.view.all` | Melihat semua user |
| `user.view.dept` | Melihat user se-departemen |
| `user.view.subordinate` | Melihat user bawahan langsung |

---

## 4. Halaman Index (`/users`)

### 4.1 Access Control

Saat `mount()` dijalankan, sistem memeriksa apakah user memiliki akses:

```
Cek: level === 1 ATAU user.view.all ATAU user.view.dept ATAU user.view.subordinate
    └── Tidak ada ──► Redirect ke halaman sebelumnya / dashboard (dengan flash error)
    └── Hanya subordinate + tidak punya bawahan ──► Redirect ke profil sendiri (users.show)
```

### 4.2 Filter Data Berdasarkan Permission

| Permission | Data yang Ditampilkan |
|-----------|----------------------|
| `level === 1` atau `user.view.all` | Semua user di sistem |
| `user.view.dept` | Hanya user di departemen yang sama |
| `user.view.subordinate` | Hanya user yang supervisornya adalah user saat ini |

### 4.3 Summary Cards

| Kartu | Warna | Isi |
|-------|-------|-----|
| Total Users | Biru | Jumlah user sesuai filter akses |
| Per Page | Cyan | Jumlah record per halaman |
| Current Page | Hijau | Halaman saat ini |
| Pages | Kuning | Total halaman |

### 4.4 Filter & Pencarian (Real-time)

| Filter | Binding | Cara Kerja |
|--------|---------|-----------|
| Search | `wire:model.live="search"` | Cari berdasarkan nama atau Employee ID (LIKE) |
| Level Access | `wire:model.live="levelFilter"` | Filter berdasarkan level user |
| Department | `wire:model.live="departmentFilter"` | Filter berdasarkan departemen |
| Per Page | `wire:model.live="perPage"` | Ganti jumlah record: 10, 25, 50, 100 |

> Filter tersimpan di **query string URL** sehingga bisa di-bookmark/share.  
> Halaman di-reset ke halaman 1 setiap kali filter berubah.  
> Data di-refresh otomatis setiap **5 detik** (`wire:poll.5s`).

### 4.5 Kolom Tabel

| Kolom | Keterangan |
|-------|-----------|
| No | Nomor urut sesuai pagination |
| Photo | Foto profil (atau inisial nama jika tidak ada foto) |
| User Info | Nama, Employee ID, badge Level |
| Position | Jabatan |
| Department | Departemen |
| Contact | Nomor telepon |
| Email | Email utama (dipotong jika terlalu panjang) |
| Status | Badge Active (hijau) / Inactive (merah) |
| Actions | Tombol View, Edit, Delete |

### 4.6 Tombol Aksi pada Tabel

| Tombol | Icon | Permission/Kondisi | Aksi |
|--------|------|--------------------|------|
| Add User | `ti-plus` | `level === 1` saja | Redirect ke `/users/create` |
| View (👁️) | `ti-eye` | Semua yang bisa mengakses index | Redirect ke `/users/{hash}` |
| Edit (✏️) | `ti-edit` | `canEditUser($user)` = true | Redirect ke `/users/edit/{hash}` |
| Delete (🗑️) | `ti-trash` | `level === 1` saja | Konfirmasi → `delete($id)` |

### 4.7 Logic `canEditUser()` (dari User Model)

```
IF level === 1 → bisa edit semua user
ELSE IF user.edit + user.view.all → bisa edit semua user
ELSE IF user.edit + user.view.dept → bisa edit user se-departemen
ELSE IF user.edit + user.view.subordinate → bisa edit bawahan langsung saja
ELSE → tidak bisa edit
```

### 4.8 Delete User

- Hanya `level === 1` yang bisa menghapus user
- Menampilkan dialog konfirmasi via `showConfirm()` sebelum eksekusi
- Setelah konfirmasi: `@this.delete($id)` → `Index.php::delete()`
- Hard delete (permanen)

---

## 5. Halaman Create (`/users/create`)

### 5.1 Access Control

Tidak ada pengecekan permission di `mount()`. Namun tombol "Add User" di index hanya tampil untuk `level === 1`. Akses langsung via URL oleh non-admin akan berhasil secara teknis (belum ada guard di `mount()`).

### 5.2 Field Form

| Field | Required | Validasi | Keterangan |
|-------|----------|---------|-----------|
| Employee ID | ✅ | `required|unique:tbl_user,id_employee` | Harus unik |
| Full Name | ✅ | `required|string|max:255` | |
| Email (ke-1) | ✅ | `required|email|unique:tbl_email_user,email` | |
| Email (selanjutnya) | ❌ | `nullable|email|unique:tbl_email_user,email` | |
| NIK | ❌ | — | Disimpan terenkripsi |
| NPWP | ❌ | — | Disimpan terenkripsi |
| Phone | ❌ | `nullable|string|max:20` | |
| Level | ✅ | `required|exists:tbl_levels,level` | |
| Department | ✅ | `required|exists:tbl_departement,id_departement` | |
| Position | ✅ | `required|exists:tbl_position,id_position` | |
| Warehouse | ❌ | `nullable|exists:tbl_warehouse,id_warehouse` | |
| Supervisor | ❌ | — | Pilih dari dropdown semua user |
| Status | — | — | Default: `is_active = 1` |
| Foto | ❌ | — | Dengan cropping, simpan ke `storage/public/image/` |
| Bank Accounts | ❌ | — | Nama bank + pemilik + nomor rekening |

### 5.3 Default Saat User Dibuat

| Data | Default |
|------|---------|
| Password | `12345678` (harus segera diganti user) |
| Company | `id_company = 1` |
| Status | `is_active = 1` (aktif) |

### 5.4 Tombol di Halaman Create

| Tombol | Aksi |
|--------|------|
| Add Email | `wire:click="addEmail"` — tambah baris email |
| Hapus Email | `wire:click="removeEmail($i)"` — hapus baris (min. 1 email wajib ada) |
| Add Account | `wire:click="addBankAccount"` — tambah rekening |
| Hapus Rekening | `wire:click="removeBankAccount($i)"` |
| Save / Submit | `wire:click="save"` — validasi + simpan + redirect ke index |

---

## 6. Halaman Edit (`/users/edit/{hash}`)

### 6.1 Access Control

```
mount():
   Decode hash → cari user
   Cek canEditUser(user) → TIDAK bisa? abort(403)
```

### 6.2 Perbedaan Edit vs Create

| Aspek | Create | Edit |
|-------|--------|------|
| Employee ID | Wajib isi, unik | Hanya bisa diubah oleh `canEditSecurity` |
| Level | Wajib pilih | Hanya bisa diubah oleh `canEditSecurity` |
| Password | Default 12345678 | Via tombol "Reset Password" |
| Status aktif | Default aktif | Bisa ubah |
| Foto lama | — | Foto lama dihapus jika diganti |

### 6.3 `canEditSecurity` Flag

User bisa mengubah **Employee ID** dan **Level** hanya jika:
- `level === 1` (Super Admin), ATAU
- Memiliki permission `user.permissions`

Jika tidak, field Employee ID dan Level ditampilkan sebagai read-only.

### 6.4 Reset Password

| Tombol | Permission | Aksi |
|--------|-----------|------|
| Reset Password | `level === 1` ATAU `user.reset_password` | Set password → `12345678`, alert sukses |

### 6.5 Tombol di Halaman Edit

| Tombol | Aksi | Permission |
|--------|------|-----------|
| Add Email | Tambah baris email | — |
| Hapus Email | Hapus email (jika tidak dipakai di transaksi) | — |
| Add Account | Tambah rekening | — |
| Hapus Rekening | Hapus rekening (jika tidak dipakai) | — |
| Reset Password | Reset ke `12345678` | `level === 1` atau `user.reset_password` |
| Save | Validasi + simpan + redirect index | `canEditUser` |

### 6.6 Error Bisnis (Sama dengan Profile)

- Email yang dipakai di PR/SR tidak bisa dihapus
- Rekening yang dipakai di PR/SR tidak bisa dihapus

---

## 7. Halaman Show (`/users/{hash}`)

### 7.1 Access Control

Tidak ada pengecekan permission di `mount()` Show.php. Semua user yang login bisa mengakses dengan mengetahui hash-nya. (Akses dikontrol lebih lanjut oleh siapa yang ditampilkan tombol View-nya di tabel index.)

### 7.2 Data yang Ditampilkan

- Data user lengkap: nama, employee ID, NIK (didekripsi), NPWP (didekripsi), telepon
- Departemen, jabatan, warehouse, supervisor, level
- Daftar email
- Daftar rekening bank
- Status aktif

---

## 8. Permission Summary (Menyeluruh)

| Aksi | Level 1 | Permission |
|------|---------|-----------|
| Lihat menu User di sidebar | ✅ | `user.view.all` / `user.view.dept` / `user.view.subordinate` |
| Akses `/users` (index) | ✅ | Salah satu dari atas |
| Lihat semua user | ✅ | `user.view.all` |
| Lihat user se-departemen | ✅ | `user.view.dept` |
| Lihat bawahan saja | ✅ | `user.view.subordinate` |
| Tambah user baru | ✅ | — (tombol hanya untuk level 1) |
| Edit user | ✅ | Bergantung `canEditUser()` |
| Edit Employee ID & Level | ✅ | `user.permissions` |
| Reset password user | ✅ | `user.reset_password` |
| Hapus user | ✅ | — (hanya level 1) |
| Lihat detail user | ✅ | — (semua yang bisa login) |

---

## 9. Livewire Components Summary

### 9.1 `Index.php`

| Item | Detail |
|------|--------|
| Trait | `WithPagination` |
| Poll | `wire:poll.5s` (auto-refresh 5 detik) |
| Query String | `search`, `levelFilter`, `departmentFilter`, `perPage` |
| Method `delete()` | Hard delete, hanya level 1 |
| Method `render()` | Query user berdasarkan permission, paginate, pass ke view |

### 9.2 `Create.php`

| Item | Detail |
|------|--------|
| Trait | `WithFileUploads` |
| Method `save()` | Validasi → DB Transaction → Create user + email + rekening |
| Default password | `12345678` |
| Foto | Upload via Cropper.js atau file langsung |

### 9.3 `Edit.php`

| Item | Detail |
|------|--------|
| Trait | `WithFileUploads` |
| Method `save()` | Validasi → DB Transaction → Update user + sync email + sync rekening |
| Method `resetPassword()` | Reset ke `12345678`, dicek permission |
| Flag `canEditSecurity` | Kontrol editabilitas Employee ID & Level |

### 9.4 `Show.php`

| Item | Detail |
|------|--------|
| Properties | `$user`, `$nik`, `$npwp` |
| `mount()` | Load user + relasi, dekripsi NIK/NPWP |
| Layout | Tidak pakai layout (render view saja tanpa `->layout()`) |

---

*Dokumentasi dibuat dari: `app/Livewire/Users/`, `resources/views/livewire/users/`, `resources/views/layouts/navbar.blade.php`*  
*Terakhir diperbarui: 23 Maret 2026*
