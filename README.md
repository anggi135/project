Cyber Threats & Defense

Sebuah website edukasi interaktif yang dibangun untuk mengenalkan berbagai **ancaman siber**, cara **mendeteksi**, dan **melindungi** sistem dari serangan digital seperti **Phishing**, **SQL Injection**, dan **DoS Attack**.  
Kini dilengkapi dengan fitur **API keamanan siber praktis** untuk eksplorasi *ethical hacking* secara edukatif.

Deskripsi Proyek

Proyek ini merupakan hasil kolaborasi mahasiswa **STTI NIIT I-TECH** yang bertujuan meningkatkan kesadaran keamanan siber melalui pendekatan edukatif berbasis web.  
Dikembangkan menggunakan **Laravel Framework**, dengan tampilan modern, responsif, dan mudah digunakan.

Fitur Utama

Edukatif
- Informasi dasar dan lanjutan mengenai **ancaman siber** & **strategi pertahanan**.  
- Fitur **registrasi, login, dan komentar** untuk interaksi antar pengguna.  
- Artikel dan pembelajaran berbasis kasus nyata.

Fitur Teknis (API Tools)
> Dapat diakses di bagian **Tools Keamanan** / **Cyber API** pada aplikasi:
- **API Pentesting** — endpoint yang mensimulasikan serangan umum (SQL Injection, XSS, dll) untuk pembelajaran.
- **URL Fuzzing** — fitur untuk menemukan *hidden endpoints* atau *directory listing* dari sebuah website.
- **Website Checker** — alat analisis dasar untuk mengecek status domain website apakah pernah digunakan untuk menginfeksi.


Pengaturan Tambahan PHP (Wajib untuk SSL)

Buka file `php.ini` kamu, lalu pastikan ekstensi berikut **sudah aktif** (hapus tanda `;` jika ada):

```ini
extension=openssl
extension=curl
extension=php_openssl.dll
curl.cainfo = "arahkan-ke \\app\\ssl\\cacert.pem"
openssl.cafile = "arahkan-ke \\app\\ssl\\cacert.pem"
````

Setelah mengubah `php.ini`, **restart Apache / server lokal** agar perubahan berlaku.

> 💡 Letak file `php.ini` umum:
>
> * Windows (XAMPP): `C:\xampp\php\php.ini`
> * Laragon: `C:\laragon\bin\php\php-x.x.x\php.ini`
> * Linux (Apache): `/etc/php/8.x/apache2/php.ini`

Untuk memastikan SSL Scanner berfungsi, pastikan juga server dapat melakukan koneksi keluar (outbound) pada port 443.

Teknologi yang Digunakan

* **Framework:** Laravel 12
* **Bahasa Pemrograman:** PHP, HTML, CSS, JavaScript
* **Frontend:** Blade Template + Bootstrap
* **Database:** MySQL
* **Tools Tambahan:** jQuery, Composer, XAMPP / Laragon

Kebutuhan Sistem

### Software

* OS: Windows / Linux / macOS
* Laravel 12 & Composer
* XAMPP / Laragon (Apache, MySQL, PHP)
* Visual Studio Code atau editor lain
* Browser modern: Chrome / Firefox

### Hardware

* Prosesor: Intel Core i3 atau setara
* RAM: Minimal 4 GB
* Penyimpanan: Minimal 20 GB
* Resolusi layar: 1366x768 atau lebih

Cara Menjalankan Proyek

```bash
git clone https://github.com/anggi135/project.git
cd project

# Salin file .env
cp .env.example .env

# Buka dan edit file .env sesuai konfigurasi lokal
# Contoh:
DB_DATABASE=cyber_defense
DB_USERNAME=root
DB_PASSWORD=

# Install dependency
composer install
npm install   # jika ada asset frontend yg perlu di-build
npm run dev   # atau npm run build

# Generate application key
php artisan key:generate

# Jalankan migrasi database
php artisan migrate

# Jalankan server lokal
php artisan queue:work
php artisan serve
```

Akses aplikasi di browser:

```
http://localhost:8000
```

Catatan Khusus (app/proxy/ & SSL)

* Folder `app/proxy/` berisi sertifikat SSL

Etika & Legal

Proyek ini **hanya untuk tujuan edukasi**.
Dilarang keras menggunakan fitur pentesting, fuzzing, atau scanner untuk serangan atau akses tanpa izin. Penggunaan ilegal bukan tanggung jawab pengembang.

 Lisensi

Proyek ini dikembangkan untuk keperluan edukasi oleh mahasiswa **STTI NIIT I-TECH**.
Dilarang menggunakan untuk aktivitas ilegal, eksploitasi, atau komersialisasi tanpa izin.

**Kontak Developer:**
Anggi Prayitno — [https://github.com/anggi135](https://github.com/anggi135)
