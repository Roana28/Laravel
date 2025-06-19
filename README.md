# PROJECT 
### ROANA | MAGANG | FULLSTACK DEVELOPER |
![banner-logo](https://github.com/user-attachments/assets/01523f1d-d02d-460a-b457-73f7eaeaa5c0)



# | SISTEM INFORMASI ABSENSI KARYAWAN BERBASIS WEB FRAMEWORK LARAVEL DI PT WINNICODE GARUDA TEKNOLOGI |

## Absensi karyawan merupakan bagian krusial dalam pengelolaan sumber daya manusia (SDM) di sebuah perusahaan. Kedisiplinan karyawan dalam hal kehadiran sangat berpengaruh terhadap produktivitas dan performa kerja perusahaan secara keseluruhan. Namun, dalam banyak kasus, proses absensi yang masih dilakukan secara manual sering kali menimbulkan berbagai permasalahan, seperti ketidakakuratan data, manipulasi kehadiran, serta sulitnya melakukan rekapitulasi data untuk kebutuhan pelaporan.Absensi manual yang bergantung pada tanda tangan atau mesin fingerprint konvensional memiliki beberapa kelemahan utama:

### Human Error Kesalahan pencatatan akibat kelalaian atau kekeliruan manusia.
### Data Tidak Real-Time – Data kehadiran biasanya diproses secara berkala, sehingga informasi yang dihasilkan tidak selalu up-to-date.
### Sulit Dilakukan Evaluasi – Dalam jangka panjang, sulit untuk melakukan evaluasi terhadap kinerja dan kedisiplinan karyawan karena data tidak terorganisir dengan baik.
### Manipulasi Data – Potensi terjadinya kecurangan seperti titip absen atau pengeditan data absensi.

Dalam menghadapi tantangan tersebut, perusahaan membutuhkan solusi berbasis teknologi yang mampu meningkatkan efisiensi dan akurasi dalam pengelolaan kehadiran karyawan. Oleh karena itu, pengembangan Sistem Informasi Absensi Karyawan Berbasis Web menjadi salah satu solusi efektif untuk menjawab permasalahan tersebut. Sistem ini memungkinkan pencatatan absensi secara otomatis, real-time, dan aman. Dengan menggunakan sistem berbasis web, proses pencatatan kehadiran dapat diakses kapan saja dan di mana saja, sehingga mempermudah pengelolaan dan pengawasan kinerja karyawan.


## INSTALASI LARAVEL
## 🛠️ 1. Instalasi Laravel

Proyek dimulai dengan menginstal Laravel menggunakan Composer:

```
composer create-project laravel/laravel presensiApp
```

Selanjutnya dilakukan:
- Konfigurasi `.env` (nama database, user, password, timezone, dsb).
- Instalasi dependensi tambahan (`composer install`).
- Migrasi database awal (`php artisan migrate`).
- Pembuatan symbolic link untuk menyimpan foto (`php artisan storage:link`).
- Menjalankan server lokal menggunakan `php artisan serve`.

![instalasi laravel 10](https://github.com/user-attachments/assets/9abe20bc-0198-4d03-bd2a-a686603383c9)
## MEMBUAT UI UNTUK USER
Antarmuka pengguna dibuat dengan Blade Template Laravel yang dirancang agar:
- Responsive dan mobile-friendly.
- Sederhana serta mudah digunakan.
- Menggunakan ikon dan warna yang informatif untuk menunjukkan status absensi.

Halaman yang dibuat meliputi:
- Login & dashboard
- Profil, histori, dan menu izin
- Halaman absensi
![dashboard](https://github.com/user-attachments/assets/559f985b-5412-4d78-b2e1-b7ce208ac8c5)
## MEMBUAT DATABESE ABSENSI

Beberapa tabel penting yang dibuat:
- `karyawan` – Menyimpan data pengguna.
- `absensi` – Menyimpan presensi harian (tanggal, waktu, lokasi, foto).
- `profil`, `izin`, dan `histori` – Untuk rekap bulanan.
![data karyawan](https://github.com/user-attachments/assets/34cb31e5-1fc7-43fd-bf82-c6cc218508ca)
## MEMBUAT PROSES LOGIN UNTUK USER
Autentikasi dibangun menggunakan guard khusus `karyawan`:

- Menggunakan NIK dan password.
- Password di-hash menggunakan bcrypt.
- Validasi login dan redirect otomatis ke dashboard.
- Disediakan halaman untuk update password secara aman.
![tampilan login](https://github.com/user-attachments/assets/be9be09c-ad02-4e72-b8d3-4bfac5b5508d)
## MEMBUAT DESIGN HALAMAN ABSENSI GPS DAN FOTO SELFIE

Halaman absensi menyediakan tombol:
- `Masuk` dan `Pulang`
- Mengaktifkan kamera untuk mengambil **foto selfie**
- Mengambil data **lokasi GPS** menggunakan JavaScript (`navigator.geolocation`)

UI didesain dengan waktu real-time, status absensi hari ini, dan notifikasi aksi yang jelas.
![absen out](https://github.com/user-attachments/assets/64789ea7-ca15-4f27-953a-ef9d367dd114)
![absen in](https://github.com/user-attachments/assets/5f8d47ab-a35b-43bd-a3c8-a3bdf91bca49)
## MENAMPILKAN PETA GOOGLE MAPS USER

Dengan menggunakan Google Maps API, sistem menampilkan:
- Lokasi user saat ini (ditandai dengan marker).
- Area radius absensi (misalnya 200 meter).
- Titik pusat kantor sebagai acuan validasi lokasi.
![dashboard after absen](https://github.com/user-attachments/assets/ae49c9ee-a2b3-4fc7-b2fb-6f6ae5bd63a1)
## MENYIMPAN DATA ABSENSI KE DATABESE
Setelah tombol absensi ditekan, sistem:
- Menyimpan tanggal, waktu, status (masuk/pulang).
- Menyimpan foto ke server.
- Menyimpan koordinat GPS (latitude & longitude).
- Menolak absensi jika sudah dilakukan sebelumnya.

![tabel absensi](https://github.com/user-attachments/assets/7232d4dc-9772-4428-8c3e-6600a5e71c77)
![dashboard after absen](https://github.com/user-attachments/assets/ae49c9ee-a2b3-4fc7-b2fb-6f6ae5bd63a1)

## MEMBUAT NOTIFIKASI AUDIO
Ditambahkan feedback suara agar pengguna tahu hasil aksi:

- Suara “absensi berhasil” saat sukses.
- Suara “absensi gagal” saat di luar radius.

Diputar otomatis dengan JavaScript ketika aksi berhasil/gagal.

https://github.com/user-attachments/assets/21fdb370-cfaf-42b6-b4be-a92c424bb1fe

## MEMBUAT VALIDASI RADIUS KANTOR
Menggunakan rumus Haversine untuk:
- Menghitung jarak antara posisi user dan kantor.
- Menentukan apakah pengguna berada dalam **radius aman**.
- Jika di luar radius, absensi akan **ditolak**.

Contoh radius: 100–300 meter.
![klik absen pulang](https://github.com/user-attachments/assets/84f187fc-371e-453f-b676-9bc487b8664c)
![klik absen masuk](https://github.com/user-attachments/assets/bd654569-2da5-40ea-9962-f6d218d27743)
https://github.com/user-attachments/assets/5b29d18f-09d9-45f2-b108-f828f49ebdb7
## MENAMPILKAN DATA ABSENSI DI DASHBOARD
Data rekap ditampilkan dalam bentuk **card**:
- Jumlah Hadir
- Izin
- Profil
- Histori
Filter berdasarkan bulan aktif dan ditarik dari tabel `absensi`.
![admin](https://github.com/user-attachments/assets/15d71827-0a95-49b0-8fd6-ad41a5229b5c)
## MENAMBAHKAN LEADERBOARD ABSENSI DI HALAMAN DASHBOARD

Leaderboard menunjukkan peringkat kehadiran:
- Berdasarkan skor hadir/telat.
- Menggunakan query untuk menghitung poin.
- Disajikan di dashboard untuk mendorong disiplin dan kompetisi positif antar karyawan.

![admin](https://github.com/user-attachments/assets/15d71827-0a95-49b0-8fd6-ad41a5229b5c)
![absen out](https://github.com/user-attachments/assets/64789ea7-ca15-4f27-953a-ef9d367dd114)
![absen in](https://github.com/user-attachments/assets/5f8d47ab-a35b-43bd-a3c8-a3bdf91bca49)
## EDIT PROFILE | UPDATE PASSWORD | UPDATE FOTO PROFIL

Pengguna bisa:
- Mengubah data diri.
- Mengganti password lama (dengan konfirmasi).
- Mengunggah ulang foto profil.

Semua perubahan disimpan dan divalidasi untuk keamanan.
![halaman edit profil](https://github.com/user-attachments/assets/3111b08b-c235-42a1-8eea-f09748840388)
## MEMBUAT HISTORI ABSENSI

Menampilkan histori presensi dengan informasi:
- Tanggal absen
- Waktu masuk/pulang
- Foto selfie
- Lokasi & keterangan

Fitur filter berdasarkan bulan dan pencarian juga tersedia.
![histori tahun absensi](https://github.com/user-attachments/assets/61d9c3cf-29d7-4e78-9064-47bcb1f0ee13)
![histori bulan absensi](https://github.com/user-attachments/assets/6dad452f-1321-44f5-aa14-f00bf14f8cc4)
![data absensi hari kehari](https://github.com/user-attachments/assets/975f8149-bb50-4675-91ec-a45715543916)
![data histori absensi](https://github.com/user-attachments/assets/284393dd-dc18-48b6-a9b3-bb57d1962bc3)
![halaman manager melihat user](https://github.com/user-attachments/assets/94bc0175-ab62-4e88-bbd6-98f01cb50222)

## 📦 Catatan Tambahan

- File laporan pengembangan minggu per minggu tersedia di folder `/laporan`.
- Dokumentasi tambahan dapat ditemukan di folder `/docs`.
- Data demo tersimpan secara lokal pada SQLite/MySQL dan bisa dimodifikasi sesuai kebutuhan.







