<p align="center">
  <img src="https://img.shields.io/badge/Laravel-12-FF2D20?style=for-the-badge&logo=laravel&logoColor=white" />
  <img src="https://img.shields.io/badge/Tailwind_CSS-CDN-06B6D4?style=for-the-badge&logo=tailwindcss&logoColor=white" />
  <img src="https://img.shields.io/badge/Alpine.js-3.x-8BC0D0?style=for-the-badge&logo=alpinedotjs&logoColor=white" />
  <img src="https://img.shields.io/badge/MySQL-8.0-4479A1?style=for-the-badge&logo=mysql&logoColor=white" />
  <img src="https://img.shields.io/badge/Sanctum-Auth-FF2D20?style=for-the-badge&logo=laravel&logoColor=white" />
</p>

#  SaranaKu — School Aspiration Platform

**SaranaKu** adalah platform aspirasi sekolah yang memungkinkan siswa menyampaikan ide, saran, dan kritik kepada pihak sekolah secara terstruktur. Admin dapat mengelola, menanggapi, dan memperbarui status setiap aspirasi secara real-time.
*

---

##  Fitur Utama

###  Siswa (Student)
- **Dashboard** — Statistik aspirasi pribadi & trending aspirasi komunitas
- **Submit Aspirasi** — Form lengkap dengan kategori, lampiran file, dan opsi anonim
- **My Aspirations** — Daftar semua aspirasi dengan status badge dan pagination
- **Detail Aspirasi** — Timeline aktivitas, lampiran, dan tanggapan admin
- **Voting System** — Like/Unlike aspirasi dengan feedback visual instan (Alpine.js)

###  Admin
- **Analytics Dashboard** — Total submissions, pending review, approved, returned + category breakdown
- **Manage Aspirations** — Tabel data dengan filter status, kategori, dan pencarian
- **Response Page** — Form tanggapan resmi dengan update status, prioritas, dan opsi internal note
- **Manage Students (CRUD)** — Kelola akun siswa (tambah, edit, ganti kata sandi, dan hapus) secara penuh
- **Notification System** — Notifikasi otomatis ke siswa saat ada tanggapan

###  Atasan (Supervisor)
- **Dashboard** — Ringkasan jumlah persetujuan tertunda dan riwayat tindakan
- **Persetujuan Aspirasi** — Tabel data aspirasi yang didelegasikan oleh Admin dengan opsi pencarian
- **Keputusan & Tanggapan** — Halaman peninjauan detail aspirasi, penyuntingan estimasi penyelesaian, dan pemberian keputusan akhir (diterima/ditolak)

###  Teknis
- **Role-based Access** — Middleware `role:murid`, `role:admin`, dan `role:atasan`
- **Soft Deletes** — Aspirasi yang dihapus tidak hilang permanen
- **File Upload** — Multi-file upload dengan validasi tipe & ukuran
- **Responsive** — Mobile bottom navigation + sidebar desktop
- **Material Design 3** — Color palette konsisten di seluruh halaman

---

##  Tech Stack

| Layer | Teknologi |
|-------|-----------|
| **Backend** | Laravel 12 (PHP 8.2+) |
| **Frontend** | Blade Templates + Tailwind CSS (CDN) |
| **Interactivity** | Alpine.js 3.x |
| **Database** | MySQL 8.0 |
| **Authentication** | Laravel Sanctum (cookie-based) |
| **Build Tool** | Vite (untuk Alpine.js) |
| **Icons** | Google Material Symbols |
| **Fonts** | Manrope (headings) + Inter (body) |

---

## 📁 Struktur Project

```
laravel/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Auth/
│   │   │   │   ├── LoginController.php
│   │   │   │   └── RegisterController.php
│   │   │   ├── Admin/
│   │   │   │   ├── DashboardController.php
│   │   │   │   ├── AspirasiController.php
│   │   │   │   └── StudentController.php
│   │   │   ├── Student/
│   │   │   │   ├── DashboardController.php
│   │   │   │   └── AspirasiController.php
│   │   │   ├── NotifikasiController.php
│   │   │   ├── VoteController.php
│   │   │   └── WelcomeController.php
│   │   ├── Middleware/
│   │   │   └── RoleMiddleware.php
│   │   └── Requests/
│   │       ├── LoginRequest.php
│   │       ├── RegisterRequest.php
│   │       ├── StoreAspirasiRequest.php
│   │       └── StoreResponseRequest.php
│   └── Models/
│       ├── User.php
│       ├── Aspirasi.php
│       ├── Kategori.php
│       ├── Tanggapan.php
│       ├── Vote.php
│       ├── Lampiran.php
│       ├── Notifikasi.php
│       └── ActivityLog.php
├── database/
│   ├── migrations/         # 8 migration files
│   └── seeders/
│       ├── DatabaseSeeder.php
│       ├── KategoriSeeder.php
│       ├── UserSeeder.php
│       └── AspirasiSeeder.php
├── resources/views/
│   ├── layouts/
│   │   ├── app.blade.php       # Main layout (sidebar + navbar)
│   │   └── auth.blade.php      # Auth layout (centered, no sidebar)
│   ├── components/
│   │   ├── navbar.blade.php
│   │   ├── sidebar.blade.php
│   │   ├── sidebar-item.blade.php
│   │   ├── footer.blade.php
│   │   ├── stat-card.blade.php
│   │   ├── status-badge.blade.php
│   │   └── mobile-nav.blade.php
│   ├── auth/
│   │   ├── login.blade.php
│   │   └── register.blade.php
│   ├── student/
│   │   ├── dashboard.blade.php
│   │   └── aspirasi/
│   │       ├── index.blade.php
│   │       ├── create.blade.php
│   │       └── show.blade.php
│   └── admin/
│       ├── dashboard.blade.php
│       ├── aspirasi/
│       │   ├── index.blade.php
│       │   └── response.blade.php
│       └── students/
│           ├── index.blade.php
│           ├── create.blade.php
│           └── edit.blade.php
├── routes/
│   └── web.php
└── design/                 # Original HTML design files (reference)
```

---

## 🗄️ Database Schema

```
┌──────────┐     ┌──────────┐     ┌───────────┐
│  users   │────<│ aspirasi │>────│ kategori  │
│──────────│     │──────────│     │───────────│
│ id       │     │ id       │     │ id        │
│ name     │     │ user_id  │     │ nama      │
│ email    │     │ kategori_│     │ deskripsi │
│ password │     │ judul    │     │ icon      │
│ role     │     │ isi      │     └───────────┘
│ kelas    │     │ status   │
│ jurusan  │     │ is_anonim│     ┌───────────┐
└──────────┘     │ prioritas│────<│ tanggapan │
                 │ views    │     │───────────│
                 └──────────┘     │ admin_id  │
                      │           │ isi       │
                 ┌────┴────┐      │ is_interna│
                 │         │      └───────────┘
            ┌────┴───┐ ┌───┴─────┐
            │ votes  │ │lampiran │
            │────────│ │─────────│
            │user_id │ │nama_file│
            │type    │ │path     │
            │(unique)│ │tipe     │
            └────────┘ │ukuran   │
                       └─────────┘
```

| Tabel | Deskripsi |
|-------|-----------|
| `users` | Data pengguna (murid & admin) |
| `kategori` | Kategori aspirasi (Akademik, Fasilitas, dll) |
| `aspirasi` | Aspirasi utama dengan soft deletes |
| `tanggapan` | Tanggapan admin terhadap aspirasi |
| `votes` | Like/dislike (unique per user per aspirasi) |
| `lampiran` | File attachment yang diupload |
| `notifikasi` | Notifikasi in-app untuk user |
| `activity_logs` | Log aktivitas untuk audit trail |

---

## 🚀 Instalasi & Setup

### Prasyarat
- PHP >= 8.2
- Composer
- Node.js >= 18
- MySQL 8.0
- Git

### Langkah Instalasi

```bash
# 1. Clone repository
git clone https://github.com/your-username/saranaku.git
cd saranaku/laravel

# 2. Install PHP dependencies
composer install

# 3. Install Node.js dependencies
npm install

# 4. Setup environment
cp .env.example .env
php artisan key:generate
```

### Konfigurasi Database

Edit file `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=saranaku
DB_USERNAME=root
DB_PASSWORD=
```

Pastikan database `saranaku` sudah dibuat di MySQL:

```sql
CREATE DATABASE saranaku;
```

### Migrasi & Seeding

```bash
# 5. Jalankan migrasi dan seeder
php artisan migrate:fresh --seed

# 6. Buat symlink storage
php artisan storage:link
```

### Jalankan Aplikasi

```bash
# Terminal 1: Laravel server
php artisan serve

# Terminal 2: Vite dev server (untuk Alpine.js)
npm run dev
```

Buka browser: **http://localhost:8000**

---

## 🔐 Akun Demo

Seeder otomatis membuat akun berikut:

| Role | Email | Password |
|------|-------|----------|
| **Admin** | `admin@saranaku.com` | `password` |
| **Atasan** | `atasan@saranaku.com` | `password` |
| **Student** | `alex@student.com` | `password` |
| **Student** | `elena@student.com` | `password` |
| **Student** | `budi@student.com` | `password` |

> ⚠️ Saat login, pilih role yang sesuai (Student / Admin / Atasan) di halaman login.

---

## 🛣️ Routes

### Guest
| Method | URI | Deskripsi |
|--------|-----|-----------|
| `GET` | `/` | Halaman utama / landing page (statistik & aspirasi terbaru) |
| `GET` | `/login` | Halaman login |
| `POST` | `/login` | Proses login |
| `GET` | `/register` | Halaman register |
| `POST` | `/register` | Proses register |

### Student (`auth + role:murid`)
| Method | URI | Deskripsi |
|--------|-----|-----------|
| `GET` | `/dashboard` | Dashboard siswa |
| `GET` | `/aspirasi` | Daftar aspirasi saya |
| `GET` | `/aspirasi/create` | Form submit aspirasi |
| `POST` | `/aspirasi` | Simpan aspirasi baru |
| `GET` | `/aspirasi/{id}` | Detail aspirasi |

### Admin (`auth + role:admin`)
| Method | URI | Deskripsi |
|--------|-----|-----------|
| `GET` | `/admin/dashboard` | Dashboard admin |
| `GET` | `/admin/aspirasi` | Kelola semua aspirasi |
| `GET` | `/admin/aspirasi/{id}/response` | Form tanggapan / Teruskan ke Atasan |
| `POST` | `/admin/aspirasi/{id}/response` | Kirim tanggapan |
| `PATCH` | `/admin/aspirasi/{id}/status` | Update status (AJAX) |
| `GET` | `/admin/students` | Halaman daftar akun murid |
| `GET` | `/admin/students/create` | Form tambah akun murid |
| `POST` | `/admin/students` | Simpan akun murid baru |
| `GET` | `/admin/students/{id}/edit` | Form edit akun murid |
| `PUT` | `/admin/students/{id}` | Update data akun murid |
| `DELETE` | `/admin/students/{id}` | Hapus akun murid |

### Atasan (`auth + role:atasan`)
| Method | URI | Deskripsi |
|--------|-----|-----------|
| `GET` | `/atasan/dashboard` | Dashboard atasan |
| `GET` | `/atasan/aspirasi` | Daftar persetujuan aspirasi |
| `GET` | `/atasan/aspirasi/{id}` | Detail aspirasi & form keputusan |
| `PATCH` | `/atasan/aspirasi/{id}/status` | Proses keputusan (setujui/tolak) |

### Shared (`auth`)
| Method | URI | Deskripsi |
|--------|-----|-----------|
| `POST` | `/vote/{id}` | Toggle vote (AJAX) |
| `POST` | `/logout` | Logout |

---

## 🗳️ Voting System

Sistem voting menggunakan **Alpine.js** untuk interaksi real-time tanpa reload:

```
Klik Upvote → Jika belum vote    → Tambah upvote (tombol aktif biru)
             → Jika sudah upvote → Hapus vote (toggle off)
             → Jika sudah downv  → Switch ke upvote

Klik Downvote → Jika belum vote    → Tambah downvote (tombol aktif merah)
              → Jika sudah downv   → Hapus vote (toggle off)
              → Jika sudah upvote  → Switch ke downvote
```

**Visual feedback:**
- ✅ Tombol berubah warna saat aktif (biru untuk like, merah untuk dislike)
- ✅ Ikon berubah menjadi filled saat aktif
- ✅ Loading state (opacity + cursor wait)
- ✅ Score terupdate secara instan

---

## 📊 Status Aspirasi

| Status | Badge | Deskripsi |
|--------|-------|-----------|
| `pending` | 🟡 Amber | Baru disubmit, menunggu review |
| `diproses` | 🔵 Blue | Sedang ditinjau admin |
| `menunggu_persetujuan_atasan` | 🟣 Purple | Diteruskan oleh admin ke atasan untuk persetujuan |
| `diterima` | 🟢 Green | Disetujui dan diterima |
| `ditolak` | 🔴 Rose | Dikembalikan / ditolak |

---

## 🧩 Blade Components

| Component | Props | Kegunaan |
|-----------|-------|----------|
| `<x-sidebar>` | `active` | Navigasi samping (role-aware) |
| `<x-sidebar-item>` | `href, icon, label, active` | Item navigasi sidebar |
| `<x-navbar>` | — | Top bar dengan notifikasi & avatar |
| `<x-footer>` | — | Footer halaman |
| `<x-stat-card>` | `icon, label, value, badge, color` | Kartu statistik bento grid |
| `<x-status-badge>` | `status` | Badge status aspirasi |
| `<x-mobile-nav>` | `active` | Bottom navigation mobile |

---

## 📂 Kategori Default

| Kategori | Icon | Deskripsi |
|----------|------|-----------|
| Akademik | `school` | Kurikulum dan pembelajaran |
| Fasilitas | `apartment` | Infrastruktur sekolah |
| Olahraga | `sports_soccer` | Kegiatan olahraga |
| Kesejahteraan | `favorite` | Kesejahteraan siswa |
| Teknologi | `computer` | Inovasi teknologi |
| Lingkungan | `eco` | Lingkungan sekolah |

---

## 🎨 Design System

Aplikasi menggunakan **Material Design 3** color palette:

| Token | Hex | Kegunaan |
|-------|-----|----------|
| `primary` | `#0058be` | Warna utama (tombol, link) |
| `primary-container` | `#2170e4` | Background elemen utama |
| `surface` | `#f7f9fb` | Background halaman |
| `surface-container-lowest` | `#ffffff` | Background kartu |
| `on-surface` | `#191c1e` | Teks utama |
| `on-surface-variant` | `#424754` | Teks sekunder |
| `error` | `#ba1a1a` | Warna error |
| `tertiary` | `#924700` | Warna aksen ketiga |

### Custom CSS Classes
- `.editorial-gradient` — Gradient biru untuk hero sections
- `.soft-elevation` — Shadow halus untuk kartu besar
- `.glass-effect` — Glassmorphism dengan backdrop blur
- `.editorial-shadow` — Shadow biru halus
- `.paper-shadow` — Shadow minimal untuk tabel

---

## 📝 Validasi Form

### Submit Aspirasi
| Field | Rules |
|-------|-------|
| `judul` | Wajib, maks 255 karakter |
| `isi` | Wajib, min 20 karakter |
| `kategori_id` | Wajib, harus ada di tabel kategori |
| `is_anonim` | Opsional, boolean |
| `lampiran.*` | Opsional, file, maks 10MB, format: pdf/jpg/png/doc/docx |

### Admin Response
| Field | Rules |
|-------|-------|
| `isi` | Wajib, min 10 karakter |
| `status` | Wajib, salah satu: pending/diproses/menunggu_persetujuan_atasan/diterima/ditolak |
| `prioritas` | Opsional: rendah/sedang/tinggi |
| `is_internal` | Opsional, boolean (catatan internal admin) |

### Atasan Response
| Field | Rules |
|-------|-------|
| `status` | Wajib, salah satu: diterima/ditolak/diproses |
| `estimasi_waktu` | Opsional, format tanggal/date |

---

## 🤝 Kontribusi

1. Fork repository
2. Buat branch fitur (`git checkout -b fitur/nama-fitur`)
3. Commit perubahan (`git commit -m 'Tambah fitur X'`)
4. Push ke branch (`git push origin fitur/nama-fitur`)
5. Buat Pull Request

---

## 📄 Lisensi

Proyek ini menggunakan lisensi [MIT](LICENSE).

---
