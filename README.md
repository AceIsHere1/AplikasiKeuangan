# Finance OS

Aplikasi web manajemen keuangan pribadi (Personal Finance Tracker) yang dibangun dengan **PHP** dan **MySQL**. Proyek ini bertujuan untuk memudahkan pencatatan pemasukan dan pengeluaran harian dengan antarmuka yang modern dan responsif.

## Fitur Utama
- **Sistem Autentikasi**: Fitur Login & Registrasi yang aman dengan password hashing.
- **Dashboard Keuangan**: Ringkasan saldo total, pemasukan, dan pengeluaran secara real-time.
- **CRUD Transaksi**: Tambahkan, lihat, dan hapus riwayat transaksi dengan mudah.
- **Visualisasi Data**: Grafik interaktif menggunakan **Chart.js** untuk memantau arus keuangan.
- **Modern UI**: Desain *glassmorphism* dengan *dark mode* yang nyaman di mata.

## Teknologi yang Digunakan
- **Backend**: PHP (Native)
- **Database**: MySQL
- **Frontend**: HTML5, CSS3, JavaScript
- **Library**: Chart.js (untuk grafik)

## Cara Menjalankan Proyek
Pastikan kamu sudah menginstall **XAMPP** atau server lokal serupa di komputermu.

1. **Clone/Download** repository ini dan letakkan di dalam folder `htdocs` XAMPP kamu (contoh: `C:\xampp\htdocs\AplikasiKeuangan`).
2. **Database Setup**:
   - Buka `http://localhost/phpmyadmin/`.
   - Buat database baru dengan nama `finance_tracker`.
   - Import file SQL yang ada di dalam repository (jika sudah ada).
3. **Konfigurasi Koneksi**:
   - Buka file `db.php`.
   - Sesuaikan konfigurasi database dengan milikmu (username/password XAMPP biasanya `root` dan kosong).
4. **Jalankan**:
   - Aktifkan **Apache** dan **MySQL** di XAMPP Control Panel.
   - Buka browser dan akses `http://localhost/AplikasiKeuangan/login.php`.

## Tampilan Aplikasi
*(Tambahkan screenshot dashboard kamu di sini)*
<img width="1920" height="1080" alt="image" src="https://github.com/user-attachments/assets/4d960d96-6794-4e65-9dbd-cf8bbf483580" />



---
*Proyek ini dikembangkan oleh Almer sebagai sarana belajar pengembangan web full-stack.*
