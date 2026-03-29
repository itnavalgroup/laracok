# Dokumentasi Fitur: Profile

**Modul**: Profile  
**File Utama**:
- View: `resources/views/livewire/profile/edit.blade.php`
- Livewire Component: `app/Livewire/Profile/Edit.php`
- Route: `routes/web.php` → `/profile`

---

## 1. Deskripsi Umum

Halaman Profile memungkinkan user yang sedang login untuk melihat dan mengedit data pribadinya sendiri. Tidak ada batasan permission khusus — **semua user yang sudah login** dapat mengakses halaman profil mereka. Data yang bisa diedit mencakup informasi pribadi, foto profil (dengan cropping), alamat email, rekening bank, dan password.

---

## 2. Route

| Method | URI | Name | Middleware |
|--------|-----|------|------------|
| `GET` | `/profile` | `profile.edit` | `auth` |

---

## 3. Tampilan (UI)

Halaman profile terdiri dari **satu kartu utama** dengan beberapa section:

| Section | Isi |
|---------|-----|
| Header Kartu | Nama user, Employee ID, Level — dengan tombol "Edit Profile" dan "Change Password" |
| Profile Photo | Foto profil + nama + jabatan + badge aktif/nonaktif |
| Personal Information | Employee ID, Nama, Email (bisa multiple), NIK, NPWP, Phone |
| Company Information | Level, Departemen, Warehouse, Jabatan, Supervisor |
| Banking Information | Daftar rekening bank (nama bank, pemilik, nomor rekening) |

### Modal yang Tersedia

| Modal | ID | Trigger |
|-------|----|---------|
| Edit Profile | `#editProfileModal` | Tombol "Edit Profile" |
| Change Password | `#editPasswordModal` | Tombol "Change Password" |
| Crop Photo | `#croppingModalProfile` | Otomatis saat pilih foto |

---

## 4. Tombol & Fungsi

### 4.1 Tombol Utama

| Tombol | Tipe | Aksi | Siapa saja |
|--------|------|------|-----------|
| Edit Profile | `button` (Bootstrap Modal) | Buka modal edit profil | Semua user |
| Change Password | `button` (Bootstrap Modal) | Buka modal ganti password | Semua user |

### 4.2 Tombol di Modal Edit Profile

| Tombol | Aksi | Kondisi Tampil |
|--------|------|---------------|
| ✏️ (ikon pensil di foto) | Buka file picker untuk upload foto | Selalu |
| Add Email | `wire:click="addEmail"` — tambah baris email baru | Selalu |
| 🗑️ Hapus Email | `wire:click="removeEmail($i)"` — hapus baris email | Hanya jika `!isUsed` dan lebih dari 1 email |
| 🔒 (ikon gembok di email) | Tidak bisa dihapus | Hanya jika `isUsed = true` (dipakai di transaksi PR/SR) |
| Add Account | `wire:click="addBankAccount"` — tambah rekening bank | Selalu |
| Remove (rekening) | `wire:click="removeBankAccount($i)"` | Hanya jika `!isUsed` |
| 🔒 Used in Transaction (rekening) | Tidak bisa dihapus | Hanya jika `isUsed = true` |
| Batal | `data-bs-dismiss="modal"` — tutup modal | Selalu |
| Save Profile | `wire:submit.prevent="updateProfile"` | Selalu |

### 4.3 Tombol di Modal Change Password

| Tombol | Aksi |
|--------|------|
| Batal | Tutup modal |
| Update Password | `wire:submit.prevent="updatePassword"` |

### 4.4 Tombol di Modal Crop Photo

| Tombol | Aksi |
|--------|------|
| Cancel | Tutup modal crop, reset file picker |
| Crop & Use | Crop gambar → simpan ke `croppedPhoto` (base64) → tutup modal crop |

---

## 5. Flow Proses

### 5.1 Edit Profile

```
[User klik "Edit Profile"]
        │
        ▼
[Modal editProfileModal terbuka]
   (data sudah diisi dari mount())
        │
        ▼
[User ubah data: nama, telepon, NIK, NPWP, email, rekening, foto]
        │
[Jika ganti foto:]
   Pilih file → Modal crop terbuka
   User crop → Klik "Crop & Use"
   → croppedPhoto (base64) tersimpan di state
        │
        ▼
[Klik "Save Profile"]
        │
        ▼
[Validasi server-side]
   - name: required, max 255
   - phone: nullable, max 20
   - emails.0.email: required, valid email
   - emails.*.email: nullable, valid email
        │
   Gagal ──────────────────────► Tampilkan error di field
        │ Lolos
        ▼
[DB Transaction:]
   1. Update tbl_user (name, phone, NIK (encrypted), NPWP (encrypted))
   2. Jika ada foto: simpan ke storage/public/image/
   3. Sync email: hapus yang dihapus, update yang ada, insert baru
   4. Sync rekening: hapus yang dihapus, update yang ada, insert baru
        │
   DB Commit ──────────────────► Alert sukses + tutup modal
   DB Rollback (error) ────────► Alert error
```

### 5.2 Change Password

```
[User klik "Change Password"]
        │
        ▼
[Modal editPasswordModal terbuka]
        │
[Isi current_password, new_password, new_password_confirmation]
        │
        ▼
[Klik "Update Password"]
        │
        ▼
[Validasi:]
   - current_password: required, harus cocok dengan password saat ini
   - new_password: required, min 8 karakter, confirmed (cocok dengan konfirmasi)
        │
   Gagal ──────────────────────► Tampilkan error di field
        │ Lolos
        ▼
[Update password user di database]
        │
        ▼
[Alert sukses + tutup modal + reset field password]
```

---

## 6. Validasi & Error

### 6.1 Modal Edit Profile

| Field | Rule | Error |
|-------|------|-------|
| `name` | `required|string|max:255` | "The name field is required." |
| `phone` | `nullable|string|max:20` | — |
| `emails.0.email` | `required|email` | "The emails.0.email field must be a valid email address." |
| `emails.*.email` | `nullable|email` | — |

**Error Bisnis:**
- Email yang sudah dipakai di PR/SR tidak bisa dihapus → Alert: *"Email ini tidak dapat dihapus karena sudah digunakan dalam transaksi."*
- Rekening yang sudah dipakai di PR/SR tidak bisa dihapus → Alert: *"Rekening ini tidak dapat dihapus karena sudah digunakan dalam transaksi."*

### 6.2 Modal Change Password

| Field | Rule | Error |
|-------|------|-------|
| `current_password` | `required|current_password` | "The current password is incorrect." |
| `new_password` | `required|min:8|confirmed` | "The new password must be at least 8 characters." |

---

## 7. Logic Khusus

### 7.1 Deteksi Penggunaan Email & Rekening

Sebelum menampilkan tombol hapus, sistem memeriksa apakah data tersebut sudah dipakai di transaksi:

| Data | Dicek ke tabel |
|------|---------------|
| Email (`id_email_user`) | `tbl_pr.id_email_user`, `tbl_sr.id_email_user` |
| Rekening (`norek`) | `tbl_pr.norek`, `tbl_sr.norek` |

Jika sudah dipakai → tombol hapus diganti ikon gembok (🔒), tidak bisa dihapus.

### 7.2 Enkripsi Data Sensitif

| Data | Enkripsi |
|------|---------|
| NIK | `encrypt_legacy()` saat simpan, `decrypt_legacy()` saat load |
| NPWP | `encrypt_legacy()` saat simpan, `decrypt_legacy()` saat load |

### 7.3 Foto Profil dengan Cropping

- Library: **Cropper.js**
- Aspect ratio: `1:1` (persegi)
- Output: PNG 400×400px dalam format Base64
- Disimpan ke: `storage/app/public/image/{timestamp}_profile.png`
- Diakses via: `asset('storage/image/{filename}')`

---

## 8. Livewire Component: `App\Livewire\Profile\Edit`

### 8.1 Properties

| Property | Tipe | Keterangan |
|----------|------|-----------|
| `$userId` | int | ID user yang login |
| `$id_employee` | string | Employee ID (read-only di view) |
| `$name` | string | Nama lengkap |
| `$nik` | string | NIK (didekripsi) |
| `$npwp` | string | NPWP (didekripsi) |
| `$phone` | string | Nomor telepon |
| `$photo` | string | Nama file foto saat ini |
| `$newPhoto` | TemporaryUploadedFile | File foto baru (Livewire upload) |
| `$croppedPhoto` | string | Base64 foto yang sudah di-crop |
| `$emails` | array | Array email dengan flag `isUsed` |
| `$bankAccounts` | array | Array rekening dengan flag `isUsed` |
| `$current_password` | string | Password saat ini (untuk ganti) |
| `$new_password` | string | Password baru |
| `$new_password_confirmation` | string | Konfirmasi password baru |

### 8.2 Methods

| Method | Dipanggil | Deskripsi |
|--------|-----------|-----------|
| `mount()` | Inisialisasi | Load data user login + dekripsi NIK/NPWP + load email & rekening |
| `checkEmailUsage($id)` | Private | Cek apakah email dipakai di PR/SR |
| `checkBankUsage($norek)` | Private | Cek apakah rekening dipakai di PR/SR |
| `addEmail()` | `wire:click` | Tambah baris email kosong |
| `removeEmail($index)` | `wire:click` | Hapus email (jika tidak dipakai) |
| `addBankAccount()` | `wire:click` | Tambah rekening kosong |
| `removeBankAccount($index)` | `wire:click` | Hapus rekening (jika tidak dipakai) |
| `updateProfile()` | `wire:submit` | Validasi + simpan profil ke DB |
| `updatePassword()` | `wire:submit` | Validasi + update password |
| `render()` | Livewire internal | Render view dengan layout `layouts.app` |

### 8.3 Events Dispatched

| Event | Kapan | Data |
|-------|-------|------|
| `alert` | Setelah save profil berhasil | `type: 'success'`, `message: 'Profil berhasil diperbarui.'` |
| `alert` | Setelah save profil gagal | `type: 'error'`, `message: '...'` |
| `alert` | Setelah ganti password berhasil | `type: 'success'`, `message: 'Password berhasil diperbarui.'` |
| `closeProfileModal` | Setelah save berhasil | — |
| `closePasswordModal` | Setelah ganti password berhasil | — |

---

## 9. Permission

Halaman ini **tidak memerlukan permission khusus**. Semua user yang telah login (`auth` middleware) dapat mengakses `/profile`.

| Aksi | Permission Diperlukan |
|------|--------------------|
| Melihat profil sendiri | ❌ Tidak ada (semua user) |
| Edit nama, phone, NIK, NPWP | ❌ Tidak ada |
| Edit foto profil | ❌ Tidak ada |
| Edit email | ❌ Tidak ada |
| Edit rekening bank | ❌ Tidak ada |
| Ganti password sendiri | ❌ Tidak ada |

---

## 10. Menu Navbar

Halaman profil dapat diakses melalui **dropdown user di header/navbar**. Link profil tidak tampil di sidebar utama karena berlaku untuk semua user.

---

*Dokumentasi dibuat dari: `app/Livewire/Profile/Edit.php`, `resources/views/livewire/profile/edit.blade.php`*  
*Terakhir diperbarui: 23 Maret 2026*
