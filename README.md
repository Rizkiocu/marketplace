# Laravel Marketplace API API 
ini dikembangkan menggunakan framework Laravel untuk mendukung registrasi pengguna, login, dan akses ke produk-produk di toko online. Silakan ikuti petunjuk di bawah ini untuk menggunakan API ini. 
## Prasyarat Pastikan sistem Anda memenuhi prasyarat berikut sebelum menggunakan API ini: 
- (Composer)(https://getcomposer.org/) 
- (Xampp terbaru) 
- (Laravel)(https://laravel.com/) versi 10 keatas
- Database (misalnya, MySQL)

 Instalasi 
1.	Clone Repositori
2.	Instal Dependensi:
composer install atau composer update
3.	Salin File Konfigurasi: Salin file .env.example menjadi .env dan sesuaikan konfigurasi database:
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nama_database
DB_USERNAME=username_database
DB_PASSWORD=
4.	Jalankan Migrasi Database:
php artisan migrate
5.	Jalankan Server:
php artisan serve