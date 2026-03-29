# Dokumentasi Fitur: Login

**Modul**: Autentikasi  
**File Utama**:
- View: `resources/views/livewire/auth/login.blade.php`
- Livewire Component: `app/Livewire/Auth/Login.php`
- Model: `app/Models/User.php`
- Route: `routes/web.php`
- Middleware: `app/Http/Middleware/IsAuthenticated.php`, `CheckLevel.php`

---

## 1. Deskripsi Umum

Halaman login adalah pintu masuk utama sistem EPR (Enterprise Purchase Request) Naval Group. Sistem menggunakan autentikasi berbasis **Employee ID** (bukan email) yang dipadukan dengan password. Halaman ini dibangun menggunakan **Laravel Livewire** untuk interaksi real-time tanpa full-page reload.

---

## 2. Route

| Method | URI | Name | Middleware | Keterangan |
|--------|-----|------|------------|-----------|
| `GET` | `/login` | `login` | `guest` | Menampilkan halaman login |
| `POST` | `/logout` | `logout` | `auth` | Proses logout user |

> **Catatan**: Route `/login` dilindungi middleware `guest` sehingga user yang sudah login akan langsung diarahkan ke halaman sebelumnya atau dashboard dan **tidak bisa mengakses halaman login kembali**.

---

## 3. Tampilan (UI)

Halaman login terdiri dari **dua kolom**:

| Kolom Kiri (Desktop Only) | Kolom Kanan (Form Login) |
|---------------------------|--------------------------|
| Panel ilustrasi dengan gradient ungu-biru | Form input Employee ID & Password |
| Ikon gembok besar (`ti-lock-access`) | Logo sistem (dashboard) |
| Teks "Welcome Back!" | Heading "Login to Account" |
| Teks "Secure & Reliable Platform" | Checkbox "Remember me" |
| — | Tombol "Sign In" |
| — | Link "Chat with Support" (WhatsApp) |
| — | Footer copyright Naval Group |

> **Responsive**: Kolom kiri disembunyikan di layar < 992px (mobile/tablet). Lebar maksimum container: 1000px (desktop), 500px (mobile).

---

## 4. Elemen & Fungsi Komponen UI

### 4.1 Input Fields

| Field | Type | Livewire Binding | Validasi | Keterangan |
|-------|------|-----------------|----------|-----------|
| Employee ID | `text` | `wire:model="id_employee"` | `required` | ID karyawan unik, bukan email |
| Password | `password` | `wire:model="password"` | `required` | Password akun |

### 4.2 Checkbox "Remember Me"

| Atribut | Nilai |
|---------|-------|
| Binding | `wire:model="remember"` |
| Fungsi | Menyimpan sesi login lebih lama |
| Default | Tidak dicentang |

> **Catatan Implementasi**: Properti `$remember` didefinisikan di Livewire component namun belum dipass ke `Auth::login($user, $remember)`. Saat ini sesi menggunakan durasi default session Laravel.

### 4.3 Tombol "Sign In"

| Atribut | Detail |
|---------|--------|
| Type | `submit` |
| Event | `wire:submit.prevent="login"` (pada `<form>`) |
| Loading state | `wire:loading.attr="disabled"` — tombol nonaktif saat proses |
| Teks loading | "Processing..." dengan ikon spinner animasi |
| Teks normal | "Sign In" dengan ikon `ti-login` |
| Style | Full-width, gradient ungu-biru, shadow, hover naik 2px |

### 4.4 Tombol "Chat with Support"

| Atribut | Detail |
|---------|--------|
| Fungsi | Membuka WhatsApp ke nomor support |
| Link | `https://wa.me/6282199005570` |
| Target | `_blank` (tab baru) |
| Kapan digunakan | Ketika user lupa password atau ada masalah akses |

---

## 5. Flow Proses Login

```
[User membuka /login]
        │
        ▼
[Cek Middleware 'guest']
        │
   ┌────┴────┐
   │ Sudah   │
   │ Login?  │
   └────┬────┘
        │ YA ──────────────────────────► Redirect ke /dashboard
        │ TIDAK
        ▼
[Tampilkan Halaman Login]
        │
        ▼
[User isi Employee ID & Password → Klik "Sign In"]
        │
        ▼
[Livewire memanggil method login()]
        │
        ▼
[1. Validasi Input]
   - id_employee: required
   - password: required
        │
   Gagal ─────────────────────────► Tampilkan error validasi di field
        │ Lolos
        ▼
[2. Cari User di database tbl_user]
   WHERE id_employee = {input}
        │
   Tidak ditemukan atau password salah
        └────────────────────────────► Alert Error: "Employee ID atau Password salah."
        │ Ditemukan & password cocok (bcrypt check)
        ▼
[3. Cek Status Aktif]
   is_active == 0?
        └── YA ─────────────────────► Alert Error: "Akun Anda tidak aktif."
        │ TIDAK
        ▼
[4. Validasi Level]
   level user ada di tbl_level?
        └── TIDAK ──────────────────► Alert Error: "User Level tidak terdaftar di sistem."
        │ ADA
        ▼
[5. Validasi Position]
   id_position ada di tbl_position?
        └── TIDAK ──────────────────► Alert Error: "Position ID tidak terdaftar di sistem."
        │ ADA
        ▼
[6. Validasi Supervisor (jika ada)]
   supervisor diisi? → cek id_user-nya valid?
        └── TIDAK VALID ────────────► Alert Error: "Data Supervisor tidak valid."
        │ VALID atau tidak ada supervisor
        ▼
[7. Login Berhasil]
   Auth::login($user)
   session()->regenerate()
        │
        ▼
[Redirect ke /dashboard]
```

---

## 6. Validasi & Error Handling

### 6.1 Validasi Server-Side (Livewire)

| Field | Rule | Pesan Error |
|-------|------|-------------|
| `id_employee` | `required` | "The id employee field is required." |
| `password` | `required` | "The password field is required." |

### 6.2 Kondisi Error Bisnis

| Kondisi | Pesan Alert | Tipe Alert |
|---------|-------------|------------|
| Employee ID tidak ditemukan | "Employee ID atau Password salah." | `error` |
| Password tidak cocok | "Employee ID atau Password salah." | `error` |
| User tidak aktif (`is_active = 0`) | "Akun Anda tidak aktif." | `error` |
| Level tidak terdaftar di sistem | "User Level (X) tidak terdaftar di sistem. Silakan hubungi admin." | `error` |
| Position tidak terdaftar | "Position ID (X) tidak terdaftar di sistem. Silakan hubungi admin." | `error` |
| Supervisor ID tidak valid | "Data Supervisor tidak valid. Silakan hubungi admin." | `error` |

> Alert ditampilkan via Livewire event `dispatch('alert', type: 'error', title: '...', message: '...')` yang ditangkap oleh listener di layout global.

---

## 7. Autentikasi & Session

| Aspek | Detail |
|-------|--------|
| Driver Auth | Laravel default (`auth` guard, driver `session`) |
| Field identifier | `id_employee` (custom, bukan `email`) |
| Hashing password | `bcrypt` via Laravel Hash facade |
| Session | Di-regenerate setelah login untuk mencegah **session fixation attack** |
| Redirect setelah login | `/dashboard` (atau URL yang sebelumnya diakses via `intended()`) |
| Logout | `Auth::logout()` + invalidate session + regenerate CSRF token |

---

## 8. Model User (tbl_user)

Tabel database: **`tbl_user`** | Primary Key: **`id_user`**

### 8.1 Field yang Relevan untuk Login

| Field | Tipe | Keterangan |
|-------|------|-----------|
| `id_user` | int/PK | Primary key |
| `id_employee` | string | Username unik untuk login |
| `password` | string | Hash bcrypt |
| `is_active` | tinyint | `1` = aktif, `0` = nonaktif → login ditolak |
| `level` | int | Level akses user (FK ke tbl_level) |
| `id_position` | int | Jabatan user (FK ke tbl_position) |
| `supervisor` | int | ID supervisor (nullable, FK ke tbl_user.id_user) |

### 8.2 Field Organisasi User

| Field | Keterangan |
|-------|-----------|
| `name` | Nama lengkap |
| `nik` | Nomor Induk Karyawan |
| `id_company` | Perusahaan |
| `id_branch` | Cabang |
| `id_departement` | Departemen |
| `id_warehouse` | Gudang |
| `photo` | Foto profil |
| `phone` | Nomor telepon |

---

## 9. Sistem Level & Permission

Setelah login, akses ke fitur ditentukan oleh **level** dan **permission** user.

### 9.1 Level User

| Level | Keterangan |
|-------|-----------|
| `1` | **Super Admin** — memiliki semua permission secara otomatis (`hasPermission()` selalu `true`) |
| `2+` | User biasa — akses berdasarkan permission yang ditetapkan |

### 9.2 Cara Kerja Permission

```php
// User model - hasPermission()
public function hasPermission(string $permission): bool
{
    if ($this->level == 1) {
        return true; // Super Admin bypass semua cek
    }
    return $this->permissions()->where('permission_name', $permission)->exists();
}
```

Permission disimpan di tabel `tbl_user_permissions` (relasi many-to-many antara `tbl_user` dan tabel permissions).

### 9.3 Middleware Terkait Auth

| Middleware | Fungsi |
|-----------|--------|
| `guest` | Redirect user yang sudah login ke dashboard; hanya guest yang bisa akses `/login` |
| `auth` | Hanya user yang login yang bisa akses halaman protected |
| `IsAuthenticated` | Custom middleware — redirect ke `/login` jika belum autentikasi |
| `CheckLevel` | Cek apakah level user sesuai dengan yang diizinkan |
| `CheckPermission` | Cek permission spesifik user |

---

## 10. Livewire Component: `App\Livewire\Auth\Login`

### 10.1 Properties (Reactive)

| Property | Tipe | Keterangan |
|----------|------|-----------|
| `$id_employee` | `string` | Binding dengan input Employee ID |
| `$password` | `string` | Binding dengan input Password |

*(Catatan: `$remember` ada di view tapi tidak dideklarasikan eksplisit di component)*

### 10.2 Methods

| Method | Dipanggil Oleh | Deskripsi |
|--------|---------------|-----------|
| `login()` | `wire:submit.prevent` pada form | Proses autentikasi penuh |
| `render()` | Livewire internal | Merender view `livewire.auth.login` dengan layout `layouts.app` |

### 10.3 Events yang Didispatch

| Event | Kapan | Data |
|-------|-------|------|
| `alert` | Login gagal | `type: 'error'`, `title: '...'`, `message: '...'` |

---

## 11. Layout

Komponen ini menggunakan layout `layouts.app` yang merupakan template dasar tanpa sidebar/navbar (karena halaman login adalah halaman publik). Layout ini mengandung:
- Tag HTML dasar
- Script Livewire
- Listener event `alert` untuk menampilkan notifikasi SweetAlert/Toast

---

## 12. Keamanan

| Aspek | Implementasi |
|-------|-------------|
| CSRF Protection | Laravel built-in (Livewire menangani otomatis) |
| Password hashing | `bcrypt` via `Hash::check()` |
| Session fixation | `session()->regenerate()` setelah login berhasil |
| Screen guest | Middleware `guest` mencegah akses `/login` bagi yang sudah login |
| Brute force | Belum ada implementasi rate limiting/lockout |
| HTTPS | Tergantung konfigurasi server (belum enforce di kode) |

---

## 13. Halaman Terkait Setelah Login

| Halaman | URL | Keterangan |
|---------|-----|-----------|
| Dashboard | `/dashboard` | Redirect pertama setelah login |
| Profile | `/profile` | Kelola profil user |
| Semua modul | Sesuai route | Akses sesuai level & permission |

---

*Dokumentasi ini dibuat berdasarkan kode pada: `app/Livewire/Auth/Login.php`, `resources/views/livewire/auth/login.blade.php`, `app/Models/User.php`, `routes/web.php`*  
*Terakhir diperbarui: 23 Maret 2026*
