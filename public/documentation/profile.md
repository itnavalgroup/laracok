# 👤 Profile

## 1. Fungsi Modul

Modul Profile memungkinkan setiap user untuk **melihat dan mengedit data pribadi** mereka sendiri, termasuk informasi dasar, password, foto profil, email, rekening bank, dan data sensitif (NPWP/NIK terenkripsi).

**File Utama:**
- Routes: `GET /profile`, `GET /profile/edit`
- Components: `app/Livewire/Profile/` (Show, Edit)

---

## 2. Cara Kerja

### 2.1 Halaman Profil (Show)

Menampilkan data user yang sedang login:
- Foto profil, nama, Employee ID, email, posisi, departemen
- Data rekening bank (hanya tampil, tidak bisa edit di sini)
- Link ke halaman edit

### 2.2 Halaman Edit Profil

User hanya bisa edit **data milik sendiri**. Field yang bisa diubah:

| Field | Bisa Diedit | Catatan |
|-------|------------|---------|
| Nama Lengkap | ✅ | — |
| Nomor HP | ✅ | — |
| Foto Profil | ✅ | Dengan cropping, simpan ke `storage/public/image/` |
| NIK | ✅ | Disimpan terenkripsi |
| NPWP | ✅ | Disimpan terenkripsi |
| Email | ✅ | Perlu cek uniqueness |
| Rekening Bank | ✅ | Tambah/edit/hapus (kecuali `is_used`) |
| Employee ID | ❌ | Tidak bisa diubah |
| Level | ❌ | Tidak bisa diubah |
| Departemen | ❌ | Tidak bisa diubah |
| Posisi | ❌ | Tidak bisa diubah |

### 2.3 Reset Password (oleh user sendiri)

User bisa reset password dari halaman edit profil:
1. Isi **Password Lama** (verifikasi dengan `Hash::check()`)
2. Isi **Password Baru** (min 8 karakter)
3. Konfirmasi password baru
4. Simpan → password di-hash ulang dengan `bcrypt`

---

## 3. Permission

Modul Profile **tidak memerlukan permission khusus** — setiap user yang login otomatis bisa mengakses dan mengedit profilnya sendiri.

| Aksi | Syarat |
|------|--------|
| Lihat profil | Login |
| Edit profil | Login (hanya milik sendiri) |
| Reset password | Login (hanya password sendiri) |
| Upload foto | Login |

---

## 4. Langkah CRUD

### Lihat Profil

1. Klik nama / foto di header atau menu **Profile**
2. Halaman `/profile` terbuka — data read-only

### Edit Profil

1. Klik **Edit Profile** → halaman `/profile/edit`
2. Edit field yang tersedia (nama, HP, NPWP, NIK, foto, email, rekening)
3. Klik **Save Changes** → validasi → update `tbl_user`

### Upload Foto Profil

1. Di halaman Edit, klik area foto
2. Pilih file gambar
3. Crop foto (modal cropper)
4. Konfirmasi → foto tersimpan

### Ubah Password

1. Di halaman Edit, scroll ke seksi **Change Password**
2. Isi: Password Lama, Password Baru, Konfirmasi
3. Klik **Update Password**
4. Sistem cek password lama → jika salah → error
5. Berhasil → password di-hash dengan `bcrypt`

### Kelola Rekening Bank

1. Di halaman Edit, section **Bank Accounts**
2. Tambah rekening: Nama Bank, Nomor Rekening, Nama Pemilik
3. Hapus rekening (hanya jika `is_used = 0`, artinya belum pernah dipakai di transaksi)
4. Rekening dengan 🔒 tidak bisa dihapus

### Error Bisnis

| Kondisi | Pesan |
|---------|-------|
| Password lama salah | "Password lama tidak sesuai." |
| Password baru < 8 karakter | Validasi form |
| Email sudah dipakai user lain | "Email sudah digunakan." |

---

*Terakhir diperbarui: 24 Maret 2026*
