# 🤖 TEROBOS - Platform Pembelajaran Robotika Interaktif

<p align="center">
  <img alt="TEROBOS Logo" src="https://img.shields.io/badge/TEROBOS-Learning-blue?style=for-the-badge">
  <img alt="Laravel" src="https://img.shields.io/badge/Laravel-11-red?style=for-the-badge">
  <img alt="License" src="https://img.shields.io/badge/License-MIT-green?style=for-the-badge">
</p>

---

## 📌 Tentang TEROBOS

**TEROBOS** adalah platform pembelajaran robotika interaktif yang dirancang untuk mendukung siswa, mahasiswa, dan profesional dalam mempelajari robotika modern. Platform ini menyediakan:

✅ **Materi Pembelajaran Komprehensif** - Dari dasar hingga tingkat lanjut  
✅ **Remote Testing** - Uji coba robot asli dari jarak jauh  
✅ **Real-Time Coding** - Editor dengan simulasi 3D  
✅ **Daur Ulang Pendukung** - Perangkat ramah lingkungan  
✅ **Sertifikasi Resmi** - Validasi kompetensi Anda  
✅ **Komunitas Aktif** - Dukungan dan kolaborasi  

---

## 🚀 Fitur Utama

### 1. **Platform Pembelajaran**
- 📚 Paket pembelajaran dengan konten berkualitas
- 🎯 Learning outcomes yang jelas
- 📖 Modul terstruktur dengan teori dan praktik
- 🏆 Sistem sertifikasi terintegrasi

### 2. **Manajemen Paket Pembelajaran**
- ✏️ Admin panel untuk mengelola paket
- 📸 Upload gambar dan media pembelajaran
- 💰 Fleksibel: berbayar atau gratis
- 📄 Download materi dalam format PDF

### 3. **Halaman Detail Paket**
- 📋 Informasi lengkap setiap paket
- 🔧 Spesifikasi teknologi dan perangkat
- 📊 Learning outcomes yang terukur
- 🎁 Benefit dan keuntungan paket

### 4. **Berita & Update**
- 📰 Informasi terkini tentang robotika
- 🎓 Tips dan trik pembelajaran
- 🏅 Pencapaian dan event komunitas

### 5. **Admin Dashboard (Filament)**
- 🔐 Akses aman dengan autentikasi
- 📝 Kelola berita dan paket pembelajaran
- 🖼️ Upload media langsung dari form
- ⚙️ Pengaturan konten yang mudah

---

## 🛠️ Stack Teknologi

| Layer | Teknologi |
|-------|-----------|
| **Backend** | Laravel 11 |
| **Frontend** | Blade Template, Tailwind CSS |
| **Admin Panel** | Filament |
| **Database** | MySQL/MariaDB |
| **Storage** | File system (storage/app/public) |
| **Authentication** | Laravel Auth + Firebase |

---

## 📦 Instalasi & Setup

### Prerequisites
- PHP 8.3+
- Composer
- Node.js & NPM
- MySQL/MariaDB

### Langkah-Langkah Instalasi

1. **Clone Repository**
```bash
git clone https://github.com/???
cd terobos
```

2. **Install Dependencies**
```bash
composer install
npm install
```

3. **Setup Environment**
```bash
cp .env.example .env
php artisan key:generate
```

4. **Database Setup**
```bash
php artisan migrate:fresh --seed
```

5. **Create Storage Link** ⚠️ **WAJIB**
```bash
php artisan storage:link
```
> ℹ️ Perintah ini membuat symlink `/public/storage` → `/storage/app/public`  
> **Fungsi:** Mengakses file upload (PDF, gambar, dll) melalui URL web  
> **Catatan:** Harus dijalankan di setiap environment (local, staging, production)

6. **Run Development Server**
```bash
php artisan serve
```

7. **Build Frontend Assets**
```bash
npm run dev
```

---

## 🔐 Akun Admin

### Login Admin Panel
**URL:** `http://your-domain/admin`

**Credential:**
| Item | Value |
|------|-------|
| **Email** | `admin@terobos.com` |
| **Password** | *[Check AKUN_ADMIN.md]* |

> ⚠️ **PENTING:** Ubah password setelah login pertama kali!

---

## 📂 Struktur Folder Penting

```
terobos/
├── app/
│   ├── Http/Controllers/
│   │   ├── KursusController.php       (Pembelajaran)
│   │   ├── NewsController.php         (Berita)
│   │   └── ...
│   ├── Models/
│   │   ├── TopikPembelajaran.php      (Paket Pembelajaran)
│   │   ├── News.php
│   │   └── User.php
│   └── Filament/
│       └── Resources/                 (Admin Panel Resources)
│
├── resources/
│   └── views/
│       ├── pembelajaran/
│       │   ├── pembelajaran-info.blade.php     (List Paket)
│       │   ├── topik-detail.blade.php          (Detail Paket)
│       │   └── kursus.blade.php
│       ├── news/
│       └── layouts/
│
├── routes/
│   └── web.php                        (URL Routes)
│
├── storage/
│   └── app/public/
│       ├── thumbnails/                (Gambar Paket)
│       ├── pdf/                       (File PDF)
│       └── news-thumbnails/           (Gambar Berita)
│
└── database/
    ├── migrations/
    └── seeders/
```

---

## 🌐 Routes Utama

| URL | Deskripsi |
|-----|-----------|
| `/` | Halaman Utama |
| `/pembelajaran` | Daftar Paket Pembelajaran |
| `/pembelajaran/{slug}` | Detail Paket Pembelajaran |
| `/pembelajaran/{slug}/download-pdf` | Download PDF Paket |
| `/news` | Berita & Artikel |
| `/admin` | Admin Panel (Filament) |

---

## 💾 Storage & File Management

### Arsitektur Penyimpanan File
TEROBOS menggunakan sistem dual-layer untuk file management:

**Real Files** (Tracked di Git):
```
storage/app/public/
├── pdf/                    → PDF materi pembelajaran
├── thumbnails/             → Gambar cover paket
└── news-thumbnails/        → Gambar berita
```

**Web Accessible** (Via Symlink):
```
public/storage/            → Symlink ke storage/app/public
                             Dibuat dengan: php artisan storage:link
```

### Cara Kerja Symlink

1. **File Upload** → Disimpan di `/storage/app/public/` (aman, tidak public)
2. **Symlink** → `/public/storage/` menunjuk ke `/storage/app/public/`
3. **Web Access** → URL `http://domain/storage/pdf/file.pdf` dapat diakses

### Troubleshooting Storage

Jika file tidak bisa diakses via browser:
```bash
# 1. Cek apakah symlink sudah dibuat
ls -l public/storage

# 2. Jika belum, buat symlink
php artisan storage:link

# 3. Jika sudah ada tapi error, hapus dan buat ulang
rm public/storage
php artisan storage:link
```

---

## 💾 Database Schema

### Tabel: `topik_pembelajaran`
| Column | Type | Keterangan |
|--------|------|-----------|
| id | INT | Primary Key |
| title | VARCHAR | Judul paket |
| slug | VARCHAR | URL-friendly identifier |
| description | TEXT | Deskripsi lengkap (HTML) |
| image | VARCHAR | Path gambar paket |
| icon | VARCHAR | Font Awesome icon class |
| teknologi | VARCHAR | Teknologi yang digunakan |
| learning_outcomes | VARCHAR | Hasil pembelajaran |
| untuk | VARCHAR | Target audience |
| modul | VARCHAR | Modul pembelajaran |
| perangkat | VARCHAR | Perangkat yang digunakan |
| harga | INT | Harga dalam Rupiah (0 = gratis) |
| order | INT | Urutan tampilan |

### Tabel: `news`
| Column | Type | Keterangan |
|--------|------|-----------|
| id | INT | Primary Key |
| customer_id | INT | Penulis (FK) |
| title | VARCHAR | Judul berita |
| slug | VARCHAR | URL-friendly |
| kategory | VARCHAR | Kategori |
| description | TEXT | Isi artikel |
| thumbnail | VARCHAR | Gambar thumbnail |
| tanggal | DATETIME | Tanggal publikasi |

---

## 🎨 Desain & UI/UX

- **Responsive Design** - Optimal di mobile, tablet, desktop
- **Modern Styling** - Tailwind CSS dengan color scheme biru-cyan
- **Smooth Animations** - AOS (Animate On Scroll) untuk visual menarik
- **Interactive Elements** - Hover effects dan smooth transitions
- **Accessible** - WCAG standards compliance

---

## 📱 Halaman Utama

### 1. **Homepage** (`/`)
- Hero section dengan CTA
- Fitur unggulan
- Testimonial
- Call-to-action

### 2. **Pembelajaran** (`/pembelajaran`)
- Grid paket pembelajaran
- Filter dan sorting (optional)
- Link ke detail paket
- Tombol daftar/beli

### 3. **Detail Paket** (`/pembelajaran/{slug}`)
- Informasi lengkap
- Sidebar dengan harga & tombol
- Content area dengan spesifikasi
- Download PDF (jika tersedia)
- CTA untuk daftar/beli

### 4. **Berita** (`/news`)
- List artikel terbaru
- Kategori berita
- Search functionality
- Detail artikel lengkap

### 5. **Admin Panel** (`/admin`)
- Dashboard overview
- Kelola paket pembelajaran
- Kelola berita
- Upload media
- Pengaturan sistem

---

## 🔄 Workflow Paket Pembelajaran

```
1. ADMIN MEMBUAT PAKET
   ↓
   - Login ke /admin
   - Klik "Topik Pembelajaran"
   - Klik "Create"
   - Isi form lengkap
   - Upload gambar
   - Set harga (atau 0 untuk gratis)
   - Klik "Save"
   
2. PAKET MUNCUL DI FRONTEND
   ↓
   - Tampil di halaman /pembelajaran
   - User bisa klik "Pelajari Lanjut"
   - Menuju halaman detail
   
3. USER BISA DOWNLOAD PDF (jika ada)
   ↓
   - Klik tombol "Download PDF"
   - File otomatis terdownload
   
4. USER BISA DAFTAR/BELI
   ↓
   - Klik tombol "Daftar Paket Ini"
   - Proses enroll/pembayaran
```

---

## 📝 Cara Menambah Paket Pembelajaran

1. **Login ke Admin Panel**
   - URL: `/admin`
   - Email: `admin@terobos.com`

2. **Buka Menu "Topik Pembelajaran"**

3. **Klik Tombol "Create"**

4. **Isi Form:**
   - **Judul:** Nama paket (auto-generate slug)
   - **Deskripsi:** Penjelasan paket (bisa format)
   - **Icon:** Font Awesome icon (misal: `fas fa-robot`)
   - **Teknologi:** Spesifikasi teknis
   - **Learning Outcomes:** Hasil yang didapat
   - **Untuk:** Target learner
   - **Modul:** Daftar modul pembelajaran
   - **Perangkat:** Equipment yang dibutuhkan
   - **Harga:** Dalam Rupiah (0 = gratis)
   - **Gambar:** Upload file
   - **Order:** Urutan tampilan

5. **Klik "Save"**
   - ✅ Paket otomatis muncul di halaman `/pembelajaran`

---

## 📄 Cara Upload PDF Paket

1. **Siapkan File PDF**
   - Format: `.pdf`
   - Nama: `{slug}.pdf` (misal: `iot-stasiun-mini.pdf`)

2. **Upload ke Folder**
   ```
   storage/app/public/pdf/{slug}.pdf
   ```

3. **Tombol Download Otomatis Aktif**
   - User bisa download dari halaman detail

---

## 🔒 Keamanan

- **Authentication:** Laravel Auth + Firebase
- **Authorization:** Role-based access control
- **Validation:** Server-side & client-side
- **CSRF Protection:** Laravel built-in
- **SQL Injection:** Eloquent ORM protection
- **XSS Prevention:** Blade auto-escaping

---

## 📊 Analytics & Monitoring

- Logging system untuk troubleshooting
- Database monitoring
- File storage management
- User activity tracking (optional)

---

## 🐛 Troubleshooting

### Gambar Tidak Muncul?
```bash
# Buat symlink storage
php artisan storage:link
```

### Database Error?
```bash
# Fresh migration
php artisan migrate:fresh --seed
```

### Admin Panel Tidak Bisa Diakses?
```bash
# Publish Filament assets
php artisan filament:install
```

---

## 📚 Dokumentasi Lengkap

- **AKUN_ADMIN.md** - Credential dan cara login
- **Laravel Docs** - https://laravel.com/docs
- **Filament Docs** - https://filamentphp.com/docs

---

## 🤝 Kontribusi

Untuk kontribusi atau laporan bug, silakan buat issue atau pull request.

---

## 📞 Support

Untuk pertanyaan atau dukungan teknis, silakan hubungi tim development.

---

## 📄 License

MIT License - lihat file LICENSE untuk detail.

---

## ✨ Credits

- **Framework:** Laravel
- **Admin Panel:** Filament
- **Frontend:** Tailwind CSS
- **Icons:** Font Awesome
- **Animations:** AOS (Animate On Scroll)

---

**Made with ❤️ by TEROBOS Team**

Last Updated: November 25, 2025

