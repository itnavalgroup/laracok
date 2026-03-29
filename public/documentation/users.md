# 👤 User Management

## 1. Fungsi Modul

Modul User Management digunakan untuk mengelola data karyawan/user sistem. Mencakup daftar user, tambah, edit, reset password, dan detail user. Akses dikontrol ketat berdasarkan level dan permission.

**File Utama:**
- Components: `app/Livewire/Users/` (Index, Create, Edit, Show)
- Views: `resources/views/livewire/users/`
- Routes: `GET /users`, `/users/create`, `/users/edit/{hash}`, `/users/{hash}`

---

## 2. Cara Kerja

### 2.1 Scope Data di Index

| Permission | Data Ditampilkan |
|-----------|-----------------|
| `level === 1` atau `user.view.all` | Semua user |
| `user.view.dept` | User se-departemen |
| `user.view.subordinate` | Bawahan langsung (supervisor = auth user) |

> Jika hanya punya `user.view.subordinate` dan tidak punya bawahan → redirect ke profil sendiri.

### 2.2 Logic `canEditUser()`

```
level === 1                              → edit semua user
user.edit + user.view.all               → edit semua user
user.edit + user.view.dept              → edit user se-departemen
user.edit + user.view.subordinate       → edit bawahan langsung saja
Tidak ada                               → tidak bisa edit
```

### 2.3 `canEditSecurity` Flag

Edit **Employee ID** dan **Level** hanya bisa dilakukan oleh:
- `level === 1`, ATAU
- User dengan permission `user.permissions`

Tanpa flag ini → field Employee ID & Level menjadi read-only saat edit.

### 2.4 Filter Index (Real-time)

| Filter | Keterangan |
|--------|-----------|
| Search | Nama atau Employee ID (LIKE) |
| Level Access | Filter berdasarkan level |
| Department | Filter berdasarkan departemen |
| Per Page | 10 / 25 / 50 / 100 |

> Auto-refresh setiap 5 detik (`wire:poll.5s`). Filter tersimpan di URL.

---

## 3. Permission

| Aksi | Level 1 | Permission |
|------|---------|-----------|
| Lihat menu User di sidebar | ✅ | `user.view.all` / `user.view.dept` / `user.view.subordinate` |
| Akses index `/users` | ✅ | Salah satu dari atas |
| Lihat semua user | ✅ | `user.view.all` |
| Lihat user se-departemen | ✅ | `user.view.dept` |
| Lihat bawahan saja | ✅ | `user.view.subordinate` |
| Tambah user baru | ✅ | — (tombol hanya untuk level 1) |
| Edit user | ✅ | Bergantung `canEditUser()` |
| Edit Employee ID & Level | ✅ | `user.permissions` |
| Reset password user | ✅ | `user.reset_password` |
| Hapus user | ✅ | — (hanya level 1) |
| Lihat detail user | ✅ | — (semua user yang login) |

---

## 4. Langkah CRUD

### Tambah User (Create)

1. Klik **Add User** (hanya Level 1)
2. Isi form `/users/create`:

| Field | Required | Validasi |
|-------|----------|---------|
| Employee ID | ✅ | `required\|unique:tbl_user,id_employee` |
| Full Name | ✅ | `required\|max:255` |
| Email ke-1 | ✅ | `required\|email\|unique:tbl_email_user,email` |
| Email tambahan | ❌ | `nullable\|email\|unique` |
| NIK | ❌ | Disimpan terenkripsi |
| NPWP | ❌ | Disimpan terenkripsi |
| Phone | ❌ | `nullable\|max:20` |
| Level | ✅ | `required\|exists:tbl_levels,level` |
| Department | ✅ | `required` |
| Position | ✅ | `required` |
| Warehouse | ❌ | `nullable` |
| Supervisor | ❌ | Dropdown semua user |
| Bank Accounts | ❌ | Nama bank + pemilik + nomor rekening |
| Foto | ❌ | Dengan cropping, simpan ke `storage/public/image/` |

3. Klik **Save** → validasi → DB Transaction (insert user + email + rekening)
4. Default password: `12345678`, `id_company = 1`, `is_active = 1`

### Edit User

1. Klik ✏️ pada baris user → `/users/edit/{hash}`
2. Cek `canEditUser()` → `abort(403)` jika tidak bisa
3. Edit field yang diperbolehkan
4. Tombol **Reset Password** (jika `level 1` atau `user.reset_password`) → reset ke `12345678`
5. Klik **Save** → validasi + update user + sync email + sync rekening

> Email atau rekening yang sudah dipakai di transaksi tidak bisa dihapus (🔒 lock).

### Hapus User

1. Hanya **Level 1** yang bisa hapus
2. Klik 🗑️ → dialog konfirmasi → `@this.delete($id)`
3. Hard delete (permanen)

---

*Terakhir diperbarui: 24 Maret 2026*
