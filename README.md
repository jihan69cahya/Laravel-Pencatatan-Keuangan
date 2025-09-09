<p align="center">
    <a href="https://laravel.com" target="_blank">
        <img src="https://laravel.com/img/logomark.min.svg" width="150" alt="Laravel Logo">
    </a>
</p>

<h2 align="center">📌 Aplikasi Pencatatan Keuangan</h2>

<p align="center">
    Aplikasi ini dibuat menggunakan <b>Laravel</b> dan <b>MySQL</b> untuk membantu mencatat uang masuk dan keluar, serta memantau saldo dan riwayat transaksi.
</p>

---

## 🚀 Tentang Aplikasi

Aplikasi ini berfungsi sebagai pencatat keuangan sederhana dengan fitur utama:

- Mencatat **uang masuk**.
- Mencatat **uang keluar**.
- Mengetahui **riwayat transaksi**.
- Melihat **saldo terbaru** secara realtime .

---

## 🛠️ Tech Stack

- [Laravel](https://laravel.com) - Framework PHP
- [PHP](https://www.php.net/) - Bahasa Pemrograman Backend
- [MySQL](https://www.mysql.com/) - Database Relasional
- [Bootstrap](https://getbootstrap.com/) 
- [Composer](https://getcomposer.org/) - Dependency Manager

---

## ⚙️ Instalasi

Ikuti langkah berikut untuk menjalankan project di lokal:

```bash
# Clone repository
git clone https://github.com/username/nama-repo.git

cd nama-repo

# Install dependency PHP
composer install

# Copy file .env
cp .env.example .env

# Generate key
php artisan key:generate

# Sesuaikan database di .env lalu jalankan migration
php artisan migrate

# Install dependency frontend (opsional, jika perlu)
npm install && npm run dev

# Jalankan server
php artisan serve
