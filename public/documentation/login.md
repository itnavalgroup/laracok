# 📋 Login & Autentikasi

## 1. Fungsi Modul

Modul Login adalah pintu masuk utama sistem EPR Naval Group. Menggunakan **Employee ID** (bukan email) sebagai identifier unik, dipadukan dengan password yang di-hash bcrypt. Dibangun dengan **Laravel Livewire** untuk interaksi real-time tanpa full-page reload.

**File Utama:**
- Livewire Component: `app/Livewire/Auth/Login.php`
- View: `resources/views/livewire/auth/login.blade.php`
- Model: `app/Models/User.php`
- Route: `GET /login` (middleware: `guest`)

---

## 2. Cara Kerja

### 2.1 Alur Login

```
[User buka /login]
        │
        ▼ Middleware 'guest' → jika sudah login, redirect ke /dashboard
        │
[Tampilkan form: Employee ID + Password]
        │
        ▼ wire:submit.prevent="login()"
        │
[1. Validasi Input]
   - id_employee: required
   - password: required
   Gagal → tampilkan error field

[2. Cari User di tbl_user WHERE id_employee = {input}]
   Tidak ditemukan atau password salah → Alert: "Employee ID atau Password salah."

[3. Cek is_active]
   is_active = 0 → Alert: "Akun Anda tidak aktif."

[4. Cek Level valid di tbl_levels]
   Tidak ada → Alert: "User Level tidak terdaftar di sistem."

[5. Cek Position valid di tbl_position]
   Tidak ada → Alert: "Position ID tidak terdaftar di sistem."

[6. Cek Supervisor (jika ada)]
   ID tidak valid → Alert: "Data Supervisor tidak valid."

[7. Login Berhasil]
   Auth::login($user)
   session()->regenerate()
   Redirect → /dashboard
```

### 2.2 Sistem Level & Permission

| Level | Keterangan |
|-------|-----------|
| `1` | **Super Admin** — `hasPermission()` selalu `true` |
| `2+` | User biasa — akses berdasarkan permission di `tbl_user_permissions` |

### 2.3 Tombol & Elemen UI

| Elemen | Fungsi |
|--------|--------|
| Input Employee ID | `wire:model="id_employee"`, required |
| Input Password | `wire:model="password"`, required |
| Checkbox Remember Me | `wire:model="remember"` |
| Tombol Sign In | `wire:submit.prevent="login"`, disabled saat loading |
| Tombol Lihat Dokumentasi | Link ke `/documentation/index.html` |
| Chat with Support | WhatsApp ke `+6282199005570` |

### 2.4 Keamanan

| Aspek | Implementasi |
|-------|-------------|
| CSRF | Laravel Livewire (otomatis) |
| Password | `bcrypt` via `Hash::check()` |
| Session Fixation | `session()->regenerate()` setelah login |
| Guest Guard | Middleware `guest` di route `/login` |

---

## 3. Permission

Tidak ada permission khusus untuk akses halaman login. Akses di-handle via middleware:

| Middleware | Fungsi |
|-----------|--------|
| `guest` | Redirect user yang sudah login ke `/dashboard` |
| `auth` | Hanya user yang login yang bisa akses halaman protected |
| `IsAuthenticated` | Custom — redirect ke `/login` jika belum autentikasi |

---

## 4. Langkah CRUD

### Login (Sign In)

1. Buka `/login`
2. Isi **Employee ID** dan **Password**
3. (Opsional) centang **Remember Me**
4. Klik **Sign In**
5. Sistem validasi → jika berhasil → redirect ke `/dashboard`
6. Jika gagal → tampilkan pesan error spesifik

### Logout

1. Klik menu logout (di header/profil)
2. POST ke `/logout` (method: `auth`)
3. `Auth::logout()` + `session()->invalidate()` + `regenerateToken()`
4. Redirect ke `/login`

### Error Handling

| Kondisi | Pesan |
|---------|-------|
| Employee ID / Password salah | "Employee ID atau Password salah." |
| Akun tidak aktif | "Akun Anda tidak aktif." |
| Level tidak terdaftar | "User Level (X) tidak terdaftar di sistem." |
| Position tidak terdaftar | "Position ID (X) tidak terdaftar di sistem." |
| Supervisor tidak valid | "Data Supervisor tidak valid." |

---

*Terakhir diperbarui: 24 Maret 2026*
