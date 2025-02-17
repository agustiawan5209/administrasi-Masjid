---

## 🕌 Administrasi Masjid  

Sistem informasi untuk pengelolaan administrasi masjid, mencakup pencatatan data keuangan, kegiatan, dan jamaah. Dibangun menggunakan **Laravel, Vue.js, dan Inertia.js**.  

### 🚀 Fitur Utama  
- **Manajemen Keuangan**: Pencatatan pemasukan dan pengeluaran masjid.  
- **Manajemen Kegiatan**: Jadwal dan dokumentasi kegiatan masjid.  
- **Manajemen Jamaah**: Data jamaah dan kehadiran dalam kegiatan.  
- **Autentikasi & Hak Akses**: Sistem login dan peran pengguna.  

### 🛠️ Teknologi yang Digunakan  
- **Backend**: Laravel  
- **Frontend**: Vue.js dengan Inertia.js  
- **Database**: MySQL / PostgreSQL  
- **Lainnya**: Tailwind CSS  

### ⚙️ Cara Instalasi  

1. **Clone repository ini**  
   ```sh
   git clone https://github.com/agustiawan5209/administrasi-Masjid.git
   cd administrasi-Masjid
   ```

2. **Instal dependensi backend**  
   ```sh
   composer install
   cp .env.example .env
   php artisan key:generate
   ```

3. **Instal dependensi frontend**  
   ```sh
   npm install
   npm run dev
   ```

4. **Migrasi database**  
   ```sh
   php artisan migrate --seed
   ```

5. **Jalankan server**  
   ```sh
   php artisan serve
   ```

6. **Akses aplikasi**  
   Buka browser dan masuk ke `http://localhost:8000`.  

### 📜 Lisensi  
Proyek ini menggunakan lisensi **MIT**.  

---
😊
