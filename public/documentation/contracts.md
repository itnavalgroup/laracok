# 📄 Contract

## 1. Fungsi Modul

Modul Contract mencatat **kesepakatan pengadaan barang** antara perusahaan dengan vendor/user tertentu. Contract menjadi fondasi untuk membuat **IKB** (Instruksi Keluar Barang) — tanpa contract, IKB tidak bisa menunjuk relasi barang secara terstruktur.

**File Utama:**
- Routes: `GET /contracts`, `/contracts/{hash}`
- Components: `app/Livewire/Contracts/` (Index, Show, FormModal, DetailModal, AttachmentModal)

---

## 2. Cara Kerja

### 2.1 Scope Data Index

| Permission | Data Ditampilkan |
|-----------|-----------------|
| `level 1` / `contract.view` | Semua kontrak |
| `contract.view.dept` | Kontrak departemen sendiri + bawahan |
| `contract.view.subordinate` | Kontrak bawahan langsung |
| Tidak ada ketiganya | Kontrak milik sendiri |

### 2.2 Format Nomor Kontrak (Auto-Generate)

```
CTR.{COMP}.{DEPT}.{YYMM}.{NNN}

Contoh: CTR.NAVA.FINA.2503.001

Keterangan:
COMP = 4 huruf pertama nama perusahaan
DEPT = 4 huruf pertama nama departemen
YYMM = tahun 2 digit + bulan 2 digit
NNN  = counter 3 digit berdasarkan dept + tahun yang sama
```

### 2.3 Monitor Realisasi Item Kontrak

Di halaman detail kontrak, setiap item menampilkan 4 angka:

| Kolom | Sumber | Penjelasan |
|-------|--------|-----------|
| **Qty Kontrak** | `contract_detail.qty` | Total yang dijanjikan |
| **Sudah Kirim** | IKB status = 10 (final) | Qty yang sudah selesai penuh |
| **Dalam Proses** | IKB status 1–8 | Qty yang masih dalam approval |
| **Sisa** | Kontrak − Kirim − Proses | Sisa qty belum terpakai |

> Sisa **kuning** = belum lunas, **hijau** = semua terpenuhi.

### 2.4 Proteksi Hapus Contract

- **Header Contract**: tidak bisa dihapus jika ada IKB manapun (bahkan Draft) yang mengunakan `id_contract`
- **Detail Item**: tidak bisa dihapus jika `id_contract + id_item` sudah terdaftar di baris IKB Detail manapun

### 2.5 Upload Lampiran (Attachment)

| Aspek | Detail |
|-------|--------|
| Lokasi file | `public/assets/contract/` |
| Format | JPG, JPEG, PNG, PDF — max 5MB |
| Ganti file | File lama dihapus via `unlink()` sebelum simpan baru |
| Simpan file | `copy()` (bukan `->move()` untuk menghindari masalah permission Windows) |

---

## 3. Permission

| Aksi | Level 1 | Permission |
|------|---------|-----------|
| Lihat daftar (semua) | ✅ | `contract.view` |
| Lihat daftar (dept) | ✅ | `contract.view.dept` |
| Lihat daftar (bawahan) | ✅ | `contract.view.subordinate` |
| Lihat detail kontrak | ✅ | Sama dengan akses index |
| Tambah kontrak baru | ✅ | `contract.create` |
| Edit info kontrak | ✅ | Creator kontrak (ownership, tidak ada slug terpisah) |
| Hapus kontrak | ✅ | Creator kontrak (ownership) |
| Tambah item detail | ✅ | Creator + `contract_detail.create` |
| Edit item detail | ✅ | Creator + `contract_detail.edit` |
| Hapus item detail | ✅ | Creator + `contract_detail.delete` |

---

## 4. Langkah CRUD

### Tambah Kontrak (Create)

1. Klik **New Contract** di index (perlu `contract.create`)
2. Isi FormModal:

| Field | Required | Validasi |
|-------|----------|---------|
| Company | ✅ | `required` |
| Departement | ✅ | `required` |
| Start Date | ✅ | `required\|date` |
| End Date | ✅ | `required\|date\|after_or_equal:start_date` |
| Description | ❌ | Opsional |

3. Nomor kontrak di-generate otomatis (format CTR…)
4. Klik **Save** → contract tersimpan, status aktif

### Edit Kontrak

1. Klik ✏️ (hanya Level 1 atau Creator)
2. Bisa dari index atau di pojok kanan halaman Detail
3. Edit field → validasi tanggal → klik **Update**

### Hapus Kontrak

1. Klik 🗑️ (hanya Level 1 atau Creator)
2. Cek relasi ke IKB Detail
3. Ada IKB yang pakai kontrak ini → tolak hapus
4. Aman → hapus file attachment + soft delete semua item → soft delete header

### Tambah Item ke Kontrak

1. Di halaman Detail, klik **Add Item** (perlu `contract_detail.create` + Creator / Admin)
2. Isi modal:
   - **Kategori Item** (dropdown semua kategori aktif)
   - **Item Produk** (dropdown tergantung kategori — muncul setelah kategori dipilih)
   - **Qty** (min 0.0001, desimal)
3. Klik **Save** → insert `tbl_contract_detail`

### Edit Item Kontrak

1. Klik ✏️ di baris item (perlu `contract_detail.edit` + Creator / Admin)
2. Edit Qty (item/kategori tidak bisa diubah — harus hapus & tambah baru)
3. Simpan → update DB

### Hapus Item Kontrak

1. Klik 🗑️ di baris item (perlu `contract_detail.delete` + Creator / Admin)
2. Cek: `id_contract + id_item` ada di IKB DetailModal → **tolak**
3. Aman → hapus `tbl_contract_detail`

### Upload Lampiran Kontrak

1. Di halaman Detail, klik area attachment
2. Pilih file (max 5MB, JPG/PNG/PDF)
3. Klik **Upload** → file lama dihapus → file baru tersimpan

### Error Bisnis

| Kondisi | Pesan |
|---------|-------|
| Hapus kontrak yang punya IKB | "Kontrak tidak dapat dihapus karena sudah digunakan di IKB." |
| Hapus item yang ada di IKB | "Item ini tidak dapat dihapus karena sudah terdaftar di IKB Detail." |
| End Date sebelum Start Date | Validasi client-side ditolak sebelum submit |
| File > 5MB | Error client-side Alpine.js + server-side Livewire |

---

*Terakhir diperbarui: 24 Maret 2026*
