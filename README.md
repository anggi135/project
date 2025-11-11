# Cyber Threats & Defense

[![Laravel](https://img.shields.io/badge/Laravel-12.x-red?logo=laravel)]()
[![PHP](https://img.shields.io/badge/PHP-8.2-blue?logo=php)]()
[![License](https://img.shields.io/badge/License-MIT-green.svg)]()
[![Status](https://img.shields.io/badge/Status-Active-success.svg)]()
[![Author 1](https://img.shields.io/badge/Author-Anggi%20Prayitno-orange.svg)](https://github.com/anggi135)
[![Author 2](https://img.shields.io/badge/Author-Captain%20Alfi-teal.svg)](https://github.com/captainalfi)


Sebuah **website edukasi interaktif** yang dibangun untuk mengenalkan berbagai **ancaman siber**, cara **mendeteksi**, dan **melindungi sistem** dari serangan digital seperti **Phishing**, **SQL Injection**, dan **DoS Attack**.  
Kini dilengkapi dengan fitur **Api testing, Url Fuzzing dan Url Checker** untuk eksplorasi *ethical hacking* secara edukatif.

## Deskripsi Proyek
Proyek ini merupakan hasil kolaborasi mahasiswa **STTI NIIT I-TECH** yang bertujuan meningkatkan kesadaran keamanan siber melalui pendekatan edukatif berbasis web.  
Dikembangkan menggunakan **Laravel Framework**, dengan tampilan modern, responsif, dan mudah digunakan.

## Fitur Utama

### Edukatif
- Informasi dasar dan lanjutan mengenai **ancaman siber** & **strategi pertahanan**.  
- Fitur **registrasi, login, dan komentar** untuk interaksi antar pengguna.  
- Artikel Pembelajaran berbasis kasus nyata.

### Fitur Teknis (API Tools)
Tersedia pada menu **Tools Keamanan**:
- **API Pentesting** — endpoint simulasi serangan umum (SQL Injection, XSS, dll) untuk pembelajaran.  
- **URL Fuzzing** — mencari *hidden endpoints* atau *directory listing* pada website.  
- **Website Checker** — menganalisis status domain dan potensi infeksi malware.

## Pengaturan Tambahan PHP (Wajib untuk SSL)

Buka file `php.ini`, pastikan ekstensi berikut **aktif** (hapus tanda `;` di depannya):

```ini
extension=openssl
extension=curl
extension=php_openssl.dll
curl.cainfo = "arahkan-ke \\app\\ssl\\cacert.pem"
openssl.cafile = "arahkan-ke \\app\\ssl\\cacert.pem"
````

Setelah mengubah `php.ini`, **restart Apache atau server lokal** agar perubahan berlaku.

> Lokasi umum file `php.ini`:
>
> * **Windows (XAMPP):** `C:\xampp\php\php.ini`
> * **Laragon:** `C:\laragon\bin\php\php-x.x.x\php.ini`
> * **Linux (Apache):** `/etc/php/8.x/apache2/php.ini`

Pastikan server dapat melakukan koneksi keluar (outbound) pada port **443** agar SSL Scanner berfungsi dengan benar.


## Teknologi yang Digunakan

| Komponen               | Teknologi                         |
| ---------------------- | --------------------------------- |
| **Framework**          | Laravel 12                        |
| **Bahasa Pemrograman** | PHP, HTML, CSS, JavaScript        |
| **Frontend**           | Blade Template + Bootstrap        |
| **Database**           | MySQL                             |
| **Tools Tambahan**     | jQuery, Composer, XAMPP / Laragon |


## Kebutuhan Sistem

### Software

* OS: Windows / Linux / macOS
* Laravel 12 & Composer
* XAMPP / Laragon (Apache, MySQL, PHP)
* Visual Studio Code (atau editor sejenis)
* Browser modern: Chrome / Firefox

### Hardware

* Prosesor: Intel Core i3 atau setara
* RAM: Minimal 4 GB
* Penyimpanan: Minimal 20 GB
* Resolusi layar: 1366×768 atau lebih


## Cara Menjalankan Proyek

```bash
git clone https://github.com/anggi135/project.git
cd project

# Salin file .env
cp .env.example .env

# Edit konfigurasi database sesuai lingkungan lokal
DB_DATABASE=cyber_defense
DB_USERNAME=root
DB_PASSWORD=

# Install dependency
composer install
npm install     # jika ada asset frontend
npm run dev     # atau npm run build

# Generate application key
php artisan key:generate

# Jalankan migrasi database
php artisan migrate

# Jalankan server
php artisan queue:work
php artisan serve
```

Akses aplikasi di browser:

**[http://localhost:8000](http://localhost:8000)**


## Catatan Khusus

* Folder `app/proxy/` berisi **sertifikat SSL** untuk scanner.
* Pastikan konfigurasi SSL telah diatur agar fitur url fuzzing berfungsi dengan baik.


## Etika & Legal

Proyek ini **hanya untuk tujuan edukasi**.
Dilarang keras menggunakan fitur pentesting, fuzzing, atau scanner untuk **serangan atau akses tanpa izin**.
Segala penyalahgunaan bukan tanggung jawab pengembang.

## Lisensi

Proyek ini dikembangkan untuk keperluan edukasi oleh mahasiswa **STTI NIIT I-TECH**.
Dilarang menggunakan untuk aktivitas ilegal, eksploitasi, atau komersialisasi tanpa izin.

## Kontak Developer

**Anggi Prayitno**
🔗 [https://github.com/anggi135](https://github.com/anggi135)

