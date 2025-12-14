# Panduan Deploy Laravel SweetCake ke Hosting

## Masalah 404 Not Found

Jika Anda mengalami error 404 saat hosting, ikuti langkah-langkah berikut:

## Solusi 1: Set Document Root ke Folder `public`

**PENTING:** Document root harus diarahkan ke folder `public`, bukan ke root project.

1. Login ke cPanel atau panel hosting Anda
2. Cari menu **File Manager** atau **Document Root**
3. Set document root ke: `/public_html/SweetCake/public` (atau sesuai struktur folder Anda)
4. Atau jika menggunakan subdomain: `/public_html/Sweetcake/public`

## Solusi 2: Menggunakan URL dengan `/public`

Jika tidak bisa mengubah document root, akses langsung ke:
```
https://bitubi.my.id/Sweetcake/public/
```

## Solusi 3: Konfigurasi .htaccess

File `.htaccess` sudah dibuat di root project untuk redirect ke `public`. Pastikan:

1. File `.htaccess` ada di root project
2. File `.htaccess` di folder `public` juga ada dan benar
3. Server mendukung mod_rewrite

## Konfigurasi yang Diperlukan

### 1. File .env

Buat file `.env` di root project dengan konfigurasi:

```env
APP_NAME=SweetCake
APP_ENV=production
APP_KEY=base64:YOUR_APP_KEY_HERE
APP_DEBUG=false
APP_URL=https://bitubi.my.id/Sweetcake/public

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nama_database
DB_USERNAME=username_database
DB_PASSWORD=password_database
```

**Cara generate APP_KEY:**
```bash
php artisan key:generate
```

### 2. Set Permission Folder

Pastikan folder berikut memiliki permission 755 atau 775:
- `storage/`
- `bootstrap/cache/`

```bash
chmod -R 755 storage
chmod -R 755 bootstrap/cache
```

### 3. Run Migration

Jalankan migration untuk membuat tabel:
```bash
php artisan migrate
```

### 4. Link Storage

Link storage untuk file upload:
```bash
php artisan storage:link
```

## Checklist Deploy

- [ ] Upload semua file ke hosting
- [ ] Set document root ke folder `public`
- [ ] Buat file `.env` dan konfigurasi
- [ ] Generate APP_KEY dengan `php artisan key:generate`
- [ ] Set permission folder `storage` dan `bootstrap/cache`
- [ ] Import database atau run migration
- [ ] Run `php artisan storage:link`
- [ ] Set `APP_DEBUG=false` di production
- [ ] Test akses website

## Troubleshooting

### Error 500 Internal Server Error
- Cek file `.env` sudah benar
- Cek permission folder `storage` dan `bootstrap/cache`
- Cek error log di `storage/logs/laravel.log`

### Error 404 Not Found
- Pastikan document root mengarah ke folder `public`
- Cek file `.htaccess` ada dan benar
- Pastikan mod_rewrite aktif di server

### Error Database Connection
- Cek konfigurasi database di `.env`
- Pastikan database sudah dibuat
- Cek username dan password database

## Catatan Penting

1. **Jangan upload folder `vendor/`** jika hosting sudah punya Composer, lebih baik install via SSH:
   ```bash
   composer install --no-dev --optimize-autoloader
   ```

2. **Jangan upload file `.env`** ke Git, buat manual di hosting

3. **Case Sensitivity**: Pastikan nama folder sesuai (SweetCake vs Sweetcake)

4. **URL**: Jika document root sudah di-set ke `public`, akses langsung:
   ```
   https://bitubi.my.id/Sweetcake/
   ```
   Tanpa perlu `/public` di akhir URL

