# 📦 Item Category

## 1. Fungsi Modul

Modul Item Category adalah **master kategori barang** yang digunakan untuk mengelompokkan item inventory. Category menjadi referensi saat membuat Item, IKB Detail, dan Contract Detail. Akses terbatas ketat hanya untuk Super Admin dan user dengan permission eksplisit.

**File Utama:**
- Component: `app/Livewire/Items/CategoryIndex.php`
- Route: `GET /items/categories`

---

## 2. Cara Kerja

### 2.1 Aturan Akses

```
level === 1 (Super Admin)   → akses penuh
permission item_category.*  → akses sesuai permission
Tidak ada                   → abort(403)
```

### 2.2 Pengelompokan Category

| Field | Keterangan |
|-------|-----------|
| Category Name | Nama unik kategori |
| Department | Kategori bisa terikat ke departemen atau global |

### 2.3 Proteksi Hapus

Category tidak bisa dihapus jika masih ada **Item** aktif yang menggunakan category tersebut di `tbl_item`.

---

## 3. Permission

| Aksi | Level 1 | Permission |
|------|---------|-----------|
| Lihat daftar | ✅ | `item_category.view` |
| Tambah kategori | ✅ | `item_category.create` |
| Edit kategori | ✅ | `item_category.edit` |
| Hapus kategori | ✅ | `item_category.delete` |

---

## 4. Langkah CRUD

### Tambah Kategori

1. Klik **Add Category** (perlu `item_category.create`)
2. Isi modal: **Category Name** ✅ (unique), Department ❌
3. Klik **Save**

### Edit Kategori

1. Klik ✏️ (perlu `item_category.edit`)
2. Edit nama → klik **Update** (unique exclude self)

### Hapus Kategori

1. Klik 🗑️ (perlu `item_category.delete`)
2. Cek: ada Item yang pakai kategori ini → tolak hapus
3. Aman → hapus

---

*Terakhir diperbarui: 24 Maret 2026*
