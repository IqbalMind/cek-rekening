# Cek Rekening Bank / E-Wallet
Aplikasi web untuk memeriksa detail rekening bank dan E-Wallet, menggunakan PHP Native, Bootstrap, dan SweetAlert untuk notifikasi dan peringatan yang menarik secara visual. Proyek ini terintegrasi dengan API untuk mengambil informasi bank dan dompet elektronik, serta menyediakan antarmuka pengguna yang ramah untuk verifikasi akun.

## Features
- **Bank/E-Wallet Selection:** Muat bank atau E-Wallet yang tersedia secara dinamis berdasarkan jenis akun yang dipilih.
- **Account Verification:** Validasi detail akun dengan memasukkan nomor akun.
- **SweetAlert Integration:** Provides user-friendly alerts for loading, success, and error states.
- **Credit Attribution:** Acknowledgement for the API provider with a link in the footer.

## Penggunaan
- Pilih Jenis Akun - pilih antara "Bank" atau "E-Wallet".
- Berdasarkan jenis akun yang dipilih, daftar dropdown dari bank atau e-wallet yang tersedia akan dimuat secara otomatis.
- Masukkan Nomor Rekening dan klik Cek Rekening untuk memverifikasi akun.
- Hasil akan ditampilkan menggunakan notifikasi SweetAlert, menunjukkan detail akun atau pesan kesalahan jika akun tidak valid.

## Dependensi
- **jQuery** - Untuk interaksi JavaScript yang lebih mudah.
- **SweetAlert2** - Untuk pop-up peringatan yang dapat disesuaikan.

## Kredit
Terima kasih kepada [Pilarxyz](https://github.com/pilarxyz/cek-rekening) yang menyediakan API.
