# Dokumentasi Modul Contract

## 1. Deskripsi Umum
Modul **Contract** digunakan untuk mencatat dan mengelola kesepakatan / kontrak pengadaan barang antara perusahaan (Company/Departement internal) dengan pengguna/vendor tertentu. Modul ini menjadi fondasi awal sebelum instruksi pengiriman barang aktual (IKB) dibuat.

Setiap kontrak berisi:
- Informasi dasar (nomor kontrak, deskripsi, tanggal berlaku)
- Rincian item yang disepakati beserta kuantitas kontrak
- File lampiran kontrak fisik/dokumen kesepakatan
- Monitoring realisasi pengiriman (Tracking Qty Kontrak vs Sudah Kirim vs Dalam Proses)

---

## 2. Struktur Modul & URL
Modul ini diakses melalui URL berikut:
- **Daftar Kontrak:** `/contracts` (Membuka halaman Index)
- **Detail Kontrak:** `/contracts/{hash}` (Membuka detail spesifik kontrak, URL terinkripsi menggunakan Hashids Laravel dengan salt `pr`).

Namespace Livewire yang digunakan: `App\Livewire\Contracts\`

---

## 3. Halaman Daftar Kontrak (Index)

Halaman utama yang menampilkan semua daftar kontrak yang dapat diakses oleh user yang sedang login.
(Komponen: `Index.php` & `index.blade.php`)

### 3.1. Visibilitas (Scope) Data
Data yang muncul di tabel bergantung pada `level` dan `permission` user (dijabarkan di dalam model `Contract::scopeVisibleTo`):
1. **Admin (Level 1) / Permission `contract.view`**: Bisa melihat SEMUA kontrak.
2. **Permission `contract.view.dept`**: Bisa melihat kontrak yang ada di dalam Departemennya sendiri ATAU yang dibuat oleh Subordinatenya.
3. **Permission `contract.view.subordinate`**: Hanya bisa melihat kontrak yang dibuat oleh Subordinatenya.
4. **Default (Tidak punya permission di atas)**: Hanya bisa melihat kontrak yang dia buat sendiri (`id_user` sama dengan user login).

*Beban Halaman: Jika user biasa yang tidak memiliki satupun permission view mencoba membuka halaman index, mereka otomatis terkena Error 403 (Forbidden).*

### 3.2. Fitur Pencarian & Filter
- **Global Search:** Bisa mencari berdasarkan Nomor Kontrak (`contract_number`) atau Deskripsi (`description`).
- **Filter Company:** Memfilter kontrak untuk Perusahaan tertentu.
- **Filter Departement:** Memfilter berdasarkan Departemen.
- **Filter Tanggal:** Memfilter berdasarkan rentang masa berlaku kontrak (`start_date` dan `end_date`).
- Semua filter menggunakan Livewire `wire:model.live` dengan auto-debounce 300ms.
- **Pagination:** Bootstrap pagination bawaan (default 10 baris per halaman, bisa diubah ke 25 / 50).

### 3.3. Informasi Baris Tabel
Tabel menampilkan ringkasan data penting:
- **Contract Number & Tanggal Dibuat**
- **Company / Dept / User Pembuat**
- **Deskripsi**
- **Periode Berlaku** (Start Date - End Date)
- **Items:** Cuplikan Item Contract Detail yang langsung menampilkan badge Qty Kontrak (K), Sudah Kirim (S), dan Sisa (R). Ini berguna untuk memantau tanpa harus masuk ke halaman detail. Qty "Sudah Kirim" dihitung berdasarkan total Qty di `IkbDetail` (semua IKB valid, tanpa filter status).

### 3.4. Aksi (Tombol pada baris Data)
- **Lihat / Detail (Eye Icon):** Membuka halaman `/contracts/{hash}`.
- **Edit (Edit Icon):** Membuka Form Modal edit. Hanya tampil jika User adalah Admin atau Pembuat Kontrak (`$contract->id_user`).
- **Hapus (Trash Icon):** Menghapus seluruh kontrak beserta itemnya.
  - **Validasi Akses:** Sama seperti tombol Edit.
  - **Validasi Dependensi IKB (PENTING):** Kontrak TIDAK BISA dihapus jika `id_contract` tersebut sudah pernah digunakan/di-binding di sebuah IKB Detail (meskipun IKB tsb masih berstatus Draft).
  - Jika lulus validasi, file attachment fisik (jika ada) akan dihapus secara permanen via fitur `unlink` PHP, kemudian tabel database `ContractDetail` di-cascade hard-delete, dan header `Contract` di *Soft Delete*.

---

## 4. Halaman Detail Kontrak (Show)

Halaman rincian mendalam mengenai satu kontrak.
(Komponen: `Show.php` & `show.blade.php`)

### 4.1. Kondisi Akses
Sama persis mengikuti standar visibilitas scope di atas. Apabila user mencoba "menembak" direct URL `/contracts/{hash}` milik departemen lain tanpa permission `contract.view.*`, sistem otomatis melempar flash pesan error *"Anda tidak memiliki akses"* lalu me-redirect-nya kembali ke Index.

### 4.2. Layout Ringkasan Info (Header Panel)
Menampilkan rangkuman Detail Kontrak (No, Tanggal buat, Perusahaan, Departemen, Start/End date, Deskripsi).
- Di sisi kanan header card terdapat tombol "Edit" untuk mengubah informasi dasar kontrak.
- Di bagian bawah panel Info terdapat seksi manajemen File Attachment. 

### 4.3. Monitor Realisasi Item Pengiriman (Item Kontrak Panel)
Menampilkan daftar rincian barang yang disepakati dalam kontrak ini.

Tabel item memiliki kolom cerdas penghitungan (LIVE calculation berdasarkan relasinya terhadap tabel instruksi pengiriman `IkbDetail`):
- **Qty Kontrak:** Total yang dijanjikan.
- **Sudah Kirim:** Jumlah qty barang yang instruksinya SUDAH FINAL APPROVED (status IKB = 9 / Log Coord final approval).
- **Dalam Proses:** Jumlah qty barang yang masih nyangkut di dalam proses izin approval (IKB berjalan di rantai status 1 hingga 8).
- **Sisa:** Rumus kalkulasi `[Qty Kontrak] - [Sudah Kirim] - [Dalam Proses]`. Angka ini berwarna kuning / warning jika > 0, dan berubah hijau / success jika sudah lunas terkirim.

---

## 5. Modal Tambah / Edit Kontrak Utama (FormModal)
(Komponen: `FormModal.php`)

Modal yang di-trigger dari tombol "New Contract" di *Index* atau tombol "Edit" di *Show*. Form ini di-*hook* dengan Alpine.js untuk validasi interaktif.

### 5.1. Logika Pembuatan Nomor Kontrak (`contract_number`)
Sistem mengenerate nomor ini SECARA OTOMATIS jika Kontrak baru dibuat dengan format dinamis:
**`CTR.{COMP-ABBR}.{DEPT-ABBR}.{YYMM}.{INCREMENTAL-3-DIGIT}`**
- `COMP-ABBR`: 4 huruf pertama dari nama perusahaan dicapitalize (misal: NAVA)
- `DEPT-ABBR`: 4 huruf pertama singkatan departemen (misal: FINA)
- `YYMM`: Tahun 2 digit dan Bulan 2 digit (misal: 2503)
- `INCREMENTAL`: Counter 3 digit (auto generate berdasarkan nomor urut tertinggi milik *departemen yang sama di tahun yang sama*).
- Contoh Result: `CTR.NAVA.FINA.2503.001`

### 5.2. Validasi Input
- **Company & Departement:** Wajib diisi.
- **Description:** Opsional.
- **Start Date & End Date:** Tanggal wajib masuk akal (`end_date` harus sesudah atau sama dengan `start_date`). Exception ini di-validate secara live sebelum menembak `save()`.

---

## 6. Modal Tambah / Edit Item (DetailModal)
(Komponen: `DetailModal.php`)

Digunakan pada halaman Show Kontrak untuk menambahkan list SKU item yang dijanjikan.

### 6.1. Logika Keamanan Tambah/Edit/Hapus
Berbeda dengan Edit Kontrak Utama, pengeditan ITEM detail memiliki permission tersendiri:
- User Admin (Level 1): *Akses bebas*.
- User Pembuat Kontrak: Bisa menambah/mengubah hanya jika memiliki permission CRUD spesifik tambahan (`contract_detail.create`, `contract_detail.edit`, `contract_detail.delete`).

### 6.2. Fields Form & Dependency
Form Item terdiri dari 3 blok isian utama:
1. **Kategori Item** (Dropdown langsung query semua master Kategori Aktif).
2. **Item Produk** (Dropdown *dependent*, jika Kategori belum dipilih maka kolom ini otomatis disabled/terserak). Setelah Kategori diselect, Livewire memanggil `getItemsByCategoryProperty` array dan memunculkan List Nama Item + Kode.
3. **Qty** Nominal jumlah yang disepakati (Bisa desimal minimal 0.0001).

### 6.3. Keamanan Penghapusan Detail Item
Tombol *Hapus* (Tong sampah merah) di samping sebuah Item memicu action validasi ketat:
- **Block jika nyangkut di IKB:** Jika kombinasi ID Kontrak ini dan ID Item baris ini **Telah Terdaftar** sebagai anak baris di dalam IKB mana saja (Draft sekalipun), item kontrak tidak bisa di hapus dengan pop up alert bahaya. Alasan ini untuk mencegah integritas cacat data di mana IKB mencoba mengakses qty relasi parent Contract Detail yang sudah *gone*.

---

## 7. Modal File Upload Lampiran (AttachmentModal)
(Komponen: `AttachmentModal.php`)

### 7.1. File Security Validation (Server & Client Side)
Demi menanggulangi limit *PHP post_max_size* error yang menyebabkan *Infinite Loading Screen (stuck)* jika ukuran melebihi limit, ada kombinasi pertahanan ganda:
- **Client Side (Alpine JS):** Saat `<input type="file" @change="validateFile">` dipilih, JS di browser langsung mem-veto ukuran (Maksimal 5 MB) dan men-check `file.type` / `file.name` MIME Types. Jika gagal, input dihapus dan layar merah memunculkan komplain ke user, payload batal dikirim ke Livewire PHP.
- **Server Side (PHP Livewire Rules):** Atribut `mimes:pdf,jpg,jpeg,png` memastikan bahwa jika lolos dari JS, backend tetap menolak file berbahaya seperti exe atau php. Sama halnya memvalidasi size `max:5120` (5120 KB = 5 MB).
- **Livewire Exception Hooks:** Menambahkan listener event global JS `$wire.on('livewire-upload-error')` guna menangani *uncaught request failed timeout* yang biasanya terlempar tak kasat mata jika request Payload File tertolak total oleh firewall PHP host apache/nginx nginx `client_max_body_size`.

### 7.2. Algoritme Simpan Fisik File
1. Sebelum menyimpan file upload terbaru, sistem akan memeriksa secara hardisk apakah Kontrak ini membawa Attachment lama.
2. Jika Iya, file fisik attachment lama di directory `public\assets\contract\` akan DIPERCEKIK DAN DI HAPUS via fungsi `unlink()`.
3. File terbaru yang temporer bertengger di Livewire-TMP storage akan dipindah menggunakan native `copy($this->file->getRealPath(), ...)` untuk bypass masalah privilege / permission akses folder temporary di Windows server yang kerap dihadapkan oleh default helper `->move()`.
4. URL Download: Melambatkan href ke direct URL `asset('assets/contract/')`.

---

## 8. Ringkasan Database & Soft Deletes

Modul kontrak direpresentasikan dengan relasi parent-child standar. Keduanya (`Contract` dan `ContractDetail`) di-set secara *Soft Deletes*.

- `tbl_contract`: Parent kontrak.
- `tbl_contract_detail`: List item.

Penting untuk disoroti bahwa di dalam kode backend seperti `Index.php` function `delete($id)`, Cascade Soft Deletes dilakukan secara *imperative / manual*:
```php
$contract->details()->delete(); // soft delete semua children itemnya dulu
$contract->delete();            // baru soft delete header parentnya
```
Ini membantu relasi historis riwayat file tersebut meskipun dokumen dihapus dari layar user, data aslinya masih terlacak di DB.

---

## 9. Tabel Permission Terkait Contract

| Fitur / Tindakan | Role Admin (Level 1) | Permission Dibutuhkan (Non-Admin) | Deskripsi Detail |
| :--- | :--- | :--- | :--- |
| **Melihat Menu Daftar** | By Default Bisa | `contract.view`, `contract.view.dept`, atau `contract.view.subordinate` | Menentukan kumpulan baris Kontrak apa saja yang tembus ke scope tabel miliknya (Pribadi / Dept / Bawahan / All) |
| **View Halaman Detail** | By Default Bisa | Permission Sama Dengan Tabel Atas | Menjaga Direct Link / Router `show/{hash}` terhadap cross-view dari user usil |
| **Buat Kontrak Baru** | By Default Bisa | `contract.create` | Izinkan memanggil New Form di Index |
| **Edit Info Kontrak** | By Default Bisa | Hanya User yang terdaftar SEBAGAI PEMBUAT KONTRAK itu sendiri *(id_user)*. | Tidak ada pemisahan extra permission form. |
| **Hapus Kontrak** | By Default Bisa | Sama Dengan Kondisi Edit di-atas | Tunduk pada Constraint `IkbDetail` blokir. |
| **Tambah Item ke Kontrak**| By Default Bisa | Diperbolehkan bagi *Pembuat Kontrak* **JIKA** user tsb memiliki permission `contract_detail.create` ekstensi | Item tidak bisa auto ditambah walau dia yang buat headernya |
| **Edit Item Kontrak** | By Default Bisa | Diperbolehkan bagi *Pembuat Kontrak* **JIKA** ada permission `contract_detail.edit` | Mengubah nominal harga/qty. |
| **Hapus Item Kontrak**| By Default Bisa | Diperbolehkan bagi *Pembuat Kontrak* **JIKA** ada permission `contract_detail.delete` | Tunduk pada Constraint `IkbDetail` baris blokir. |
