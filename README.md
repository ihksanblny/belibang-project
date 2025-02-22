# Panduan Install Belibang-Project Laptop Lain

Berikut adalah langkah-langkah untuk mentransfer proyek Laravel ke perangkat lain:

## 1. Salin Proyek Laravel
Salin seluruh folder proyek Laravel ke laptop tujuan. Anda dapat menggunakan USB, layanan cloud, atau Git untuk memindahkannya.

## 2. Instal Dependensi Composer
Pastikan Anda sudah menginstal [Composer](https://getcomposer.org/) di perangkat baru. Kemudian jalankan perintah berikut di direktori proyek:

```sh
composer install
```

## 3. Konfigurasi File `.env`
Salin atau buat file `.env` di root proyek Anda. Jika belum ada, Anda dapat menggandakan file `.env.example`:

```sh
cp .env.example .env
```

Kemudian sesuaikan pengaturan database, kunci aplikasi, dan konfigurasi lainnya.

## 4. Generate Application Key
Jalankan perintah berikut untuk menghasilkan application key:

```sh
php artisan key:generate
```

## 5. Konfigurasi Database
- Pastikan MySQL atau database lain yang digunakan telah berjalan.
- Buat database baru yang sesuai dengan nama di `.env`.
- Jalankan migrasi database:

```sh
php artisan migrate
```

Jika Anda memiliki data awal yang perlu dimasukkan, gunakan perintah:

```sh
php artisan db:seed
```

Atau jika ingin menjalankan migrasi dan seeding sekaligus:

```sh
php artisan migrate --seed
```

## 6. Jalankan Server Laravel
Setelah semua selesai, jalankan aplikasi dengan perintah:

```sh
php artisan serve
```

Akses aplikasi melalui browser di `http://127.0.0.1:8000`.

## 7. (Opsional) Konfigurasi Storage dan Cache
Jika proyek Anda menggunakan storage, jalankan perintah berikut untuk membuat symbolic link:

```sh
php artisan storage:link
```

Untuk membersihkan cache:

```sh
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear
```

## 8. Selesai 🎉
Sekarang proyek Laravel Anda telah berhasil dipindahkan dan dijalankan di perangkat baru!
