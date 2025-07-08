# 🛡️ Cyber Threats & Defense

Sebuah website edukasi interaktif yang dibangun untuk mengenalkan berbagai **ancaman siber**, cara **mendeteksi**, dan **melindungi** sistem dari serangan digital seperti **Phishing**, **SQL Injection**, dan **DoS Attack**.

## 📌 Deskripsi Proyek

Proyek ini merupakan hasil kolaborasi mahasiswa STTI NIIT I-TECH yang bertujuan untuk meningkatkan kesadaran keamanan siber melalui pendekatan edukatif berbasis web. Website dikembangkan menggunakan Laravel Framework dengan antarmuka modern yang responsif dan mudah digunakan.

## 🧩 Fitur Utama

- Halaman utama berisi informasi edukatif tentang keamanan siber
- Fitur registrasi dan login pengguna
- Sistem komentar (hanya untuk pengguna yang telah login)
- Daftar dan detail artikel mengenai ancaman dan pertahanan siber
- Validasi input & autentikasi Laravel
- Desain UI yang responsif dan ramah pengguna

## 🛠️ Teknologi yang Digunakan

- **Framework**: Laravel 12
- **Bahasa Pemrograman**: PHP, HTML, CSS, JavaScript
- **Frontend**: Blade Template + Bootstrap
- **Database**: MySQL
- **Tools Tambahan**: jQuery, Composer, XAMPP / Laragon

## 📋 Kebutuhan Sistem

### Software
- OS: Windows / Linux / macOS
- Laravel 12 & Composer
- XAMPP atau Laragon (Apache, MySQL, PHP)
- Visual Studio Code
- Browser modern: Chrome / Firefox

### Hardware
- Prosesor: Intel Core i3 atau setara
- RAM: Minimal 4 GB
- Penyimpanan: Minimal 20 GB
- Resolusi layar: 1366x768 atau lebih
- Koneksi internet untuk instalasi dependency

## 🏗️ Arsitektur Sistem

- **Arsitektur**: Model-View-Controller (MVC)
- **ERD (Entity Relationship Diagram)**:
  - `users` ➝ `comments` (One to Many)
  - `posts` ➝ `comments` (One to Many)
- **UML**: Use Case Diagram, Activity Diagram, Sequence Diagram

## 🧪 Pengujian

Pengujian dilakukan menggunakan pendekatan **Black Box Testing** untuk fitur:
- Registrasi & Login
- Baca artikel
- Komentar (dengan dan tanpa login)
- Logout

✅ Semua fungsi berjalan dengan baik dan sesuai harapan.

## 🧠 Cara Menjalankan Proyek

```bash
git clone https://github.com/anggi135/project.git
cd project

# Salin file .env
cp .env.example .env

# Buka dan edit file .env
nano .env

# Ubah bagian konfigurasi database:
DB_DATABASE=cyber_defense
DB_USERNAME=root
DB_PASSWORD=

# Generate application key
php artisan key:generate

# Jalankan migrasi database
php artisan migrate

# Jalankan server lokal
php artisan serve
