# LORY - Platform Tryout CPNS Online

LORY adalah aplikasi berbasis web untuk simulasi ujian CPNS yang fokus pada kemudahan akses melalui perangkat mobile.

## Fitur Utama
- Simulasi ujian dengan waktu real-time.
- Dashboard hasil ujian.
- Manajemen soal (Admin Panel).
- Desain Mobile-First (Responsive).

## Teknologi yang Digunakan
- Frontend:Tailwind CSS / Blade Templates
- Database: MySQL
- Deployment: InfinityFree

## Cara Instalasi Lokal
1. Clone repository ini: `git clone https://github.com/username/lory.git`
2. Jalankan `composer install`
3. Jalankan `npm install && npm run dev`
4. Copy `.env.example` ke `.env` dan sesuaikan database lo.
5. Jalankan `php artisan migrate --seed`
6. Jalankan `php artisan serve`

## Dokumentasi Deployment
Project ini dioptimasi untuk berjalan di Shared Hosting (seperti InfinityFree). 
Pindahkan isi folder `public` atau gunakan `.htaccess` di root directory untuk routing.

Jika ingin mencoba akses websitenya silahkan ke
<h1>lory-app.infinityfreeapp.com</h1>
