# 📸 Fix Profile Photo Deploy Issue

## Masalah Yang Diperbaiki

Ketika website di-deploy, **foto profil dan gambar lainnya hilang semua**. 

### Akar Penyebab
1. Foto disimpan di folder `storage/app/public/` yang tidak tercakup dalam repository
2. Folder `public/storage` adalah symlink yang tidak otomatis terbentuk saat deploy
3. Symlink hilang → foto tidak bisa diakses publik

## Solusi Yang Diterapkan

### 1. **StorageServiceProvider** (`app/Providers/StorageServiceProvider.php`)
- Berjalan saat aplikasi bootstrap
- Memastikan folder `storage/app/public/` selalu ada
- Membuat symlink `public/storage` → `storage/app/public/` secara otomatis
- Support untuk Windows (menggunakan junction) dan Linux/Mac (symlink)

### 2. **EnsureStorageSymlinkExists Middleware** (`app/Http/Middleware/EnsureStorageSymlinkExists.php`)
- Middleware yang berjalan di setiap request
- Backup untuk memastikan symlink tetap ada
- Jika symlink rusak, akan otomatis diperbaiki
- Support Windows junction dan Unix symlink

### 3. **File `.gitkeep`** (`storage/app/public/.gitkeep`)
- Memastikan folder `storage/app/public/` tetap tracked di git
- Folder akan terbuat saat clone/pull repository

### 4. **Configuration Updates**
- `bootstrap/providers.php` - Terdaftar `StorageServiceProvider`
- `bootstrap/app.php` - Middleware ditambahkan dengan `prepend()`

## Cara Deploy

### Di Server/Local Saat Deploy:
```bash
# 1. Pull latest code
git pull origin main

# 2. Install dependencies
composer install

# 3. Run migrations (jika ada)
php artisan migrate

# 4. Clear cache
php artisan cache:clear
php artisan config:clear

# 5. Selesai! Symlink akan otomatis terbuat
```

**Tidak perlu** menjalankan `php artisan storage:link` lagi karena sudah otomatis.

## Kapan Solusi Ini Bekerja

✅ **ServiceProvider Boot** - Saat aplikasi pertama kali startup  
✅ **Setiap HTTP Request** - Middleware memastikan symlink tetap valid  
✅ **Windows & Linux** - Support kedua platform  
✅ **Automatic Recovery** - Jika symlink rusak, akan otomatis diperbaiki  

## Testing Lokal

```bash
# Upload foto dari dashboard
# Foto akan disimpan ke: storage/app/public/profile/[filename]
# Akses via: /storage/profile/[filename]

# Simulasi deployment
rm public/storage  # Hapus symlink
# Reload page - middleware akan otomatis buat ulang symlink
```

## File Yang Ditambahkan/Dimodifikasi

```
✓ app/Providers/StorageServiceProvider.php (BARU)
✓ app/Http/Middleware/EnsureStorageSymlinkExists.php (BARU)
✓ storage/app/public/.gitkeep (BARU)
✓ bootstrap/providers.php (DIMODIFIKASI)
✓ bootstrap/app.php (DIMODIFIKASI)
```

## Troubleshooting

### Foto Masih Hilang?
1. Pastikan folder `storage/app/public/` ada dan writable
   ```bash
   ls -la storage/app/public/
   chmod 755 storage/app/public/
   ```

2. Pastikan symlink terbentuk
   ```bash
   ls -la public/ | grep storage
   # Harus ada: storage -> /path/to/storage/app/public
   ```

3. Check Laravel logs
   ```bash
   tail -f storage/logs/laravel.log
   ```

### Windows: Symlink Permission Denied?
- Jalankan command prompt sebagai Administrator
- Atau gunakan Windows junction (sudah built-in di solusi ini)

## Catatan Penting

- Folder `storage/` aman disimpan git sekarang (file `.gitkeep` memastikan tracking)
- Symlink akan otomatis terbuat tanpa perlu command manual
- Support kedua platform: Windows dan Linux/Unix
