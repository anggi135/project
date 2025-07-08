# 🛡️ Cyber Threats & Defense

Sebuah website edukasi interaktif yang dibangun untuk mengenalkan berbagai **ancaman siber**, cara **mendeteksi**, dan **melindungi** sistem dari serangan digital yang umum terjadi seperti Phishing, SQL Injection, dan DoS attack.

## 📌 Deskripsi Proyek

Proyek ini merupakan hasil kolaborasi dan penelitian oleh mahasiswa STTI NIIT I-TECH yang bertujuan untuk meningkatkan kesadaran keamanan siber melalui pendekatan edukatif berbasis web. Website ini dirancang menggunakan Laravel Framework dengan antarmuka sederhana dan modern agar mudah diakses oleh masyarakat umum.

## 🧩 Fitur Utama

- Halaman utama berisi edukasi umum tentang keamanan siber
- Registrasi dan login pengguna
- Sistem komentar (hanya untuk pengguna yang login)
- Daftar dan detail artikel terkait cyber threat dan defense
- Implementasi keamanan dasar (validasi input, laravel auth)
- Responsif dan user-friendly UI

## 🛠️ Teknologi yang Digunakan

- **Framework**: Laravel 12
- **Bahasa Pemrograman**: PHP, HTML, CSS, JavaScript
- **Frontend**: Blade Template, Bootstrap
- **Database**: MySQL
- **Tool Tambahan**: jQuery, Composer, XAMPP/Laragon

## 📋 Kebutuhan Sistem

### Software
- OS: Windows/Linux/macOS
- Laravel 12 & Composer
- XAMPP / Laragon
- Visual Studio Code
- Browser modern (Chrome/Firefox)

### Hardware
- RAM: Minimal 4 GB
- Storage: Minimal 20 GB
- Prosesor: Intel i3 atau setara

## 🏗️ Arsitektur Sistem

- **Model-View-Controller (MVC)**
- **Entity Relationship Diagram (ERD)**:
  - `users` ↔ `comments` (One to Many)
  - `posts` ↔ `comments` (One to Many)
- **Diagram UML**: Use Case, Activity, Sequence Diagram digunakan sebagai dokumentasi sistem

## 🧪 Pengujian

Pengujian dilakukan dengan metode **Black Box Testing** terhadap fitur:
- Registrasi
- Login
- Baca artikel
- Komentar (login/logout)
- Logout

✅ Semua fungsi berjalan sesuai harapan.

## 🧠 Cara Menjalankan Proyek

1. Clone repository:
   ```bash
   git clone 
