# Aplikasi Kas RW

Aplikasi pengelolaan kas RT/RW berbasis Laravel + MySQL.

Fitur utama:
- Dashboard kas
- Data warga
- Data iuran warga
- Transaksi pemasukan dan pengeluaran
- Laporan kas
- CRUD dasar untuk data utama

## Struktur project
- app/Models: model data
- app/Http/Controllers: controller logika aplikasi
- database/migrations: migrasi database
- resources/views: template Blade
- routes/web.php: route aplikasi

## Langkah install
1. composer install
2. cp .env.example .env
3. php artisan key:generate
4. sesuaikan DB di .env
5. php artisan migrate
6. php artisan serve

## Default login
Setelah menjalankan scaffolding Laravel standard, login bisa dibuat dengan `php artisan make:auth` atau Laravel Breeze/Jetstream.

## Catatan
Project ini adalah versi MVP (minimum viable product) yang bisa dikembangkan lebih lanjut dengan:
- login multi role
- export PDF/Excel
- chart dashboard
- filter laporan bulanan
- otorisasi per user
