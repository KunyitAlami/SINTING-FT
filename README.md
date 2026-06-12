# 🗳️ SINTING-FT (Sistem Informasi E-Voting Blockchain)

SINTING-FT adalah sebuah Decentralized Application (DApp) yang dibangun khusus untuk memfasilitasi pemilihan ketua himpunan dan kegiatan *e-voting* di Fakultas Teknik Universitas Lambung Mangkurat.

Sistem ini menjembatani keamanan portal akademik (Web2) dengan transparansi jaringan *blockchain* Ethereum (Web3), memastikan setiap suara yang masuk bersifat rahasia, aman, transparan, dan *immutable* (tidak dapat diubah/dimanipulasi).

---

# Fitur Utama

## 1. Integrasi Web2 & Web3 (Hybrid System)

### Gerbang Web2

* Autentikasi mahasiswa menggunakan NIM dan Password (simulasi portal SIMARI) via sistem *session* Laravel.

### Bilik Suara Web3

* Validasi hak pilih dan proses *voting* murni menggunakan *Smart Contract* melalui MetaMask.

---

## 2. Panel Admin KPU (Panitia)

* Mendaftarkan alamat *wallet* mahasiswa ke dalam Daftar Pemilih Tetap (DPT) ke *blockchain*.
* Menambahkan kandidat baru beserta rincian **Visi dan Misi**.
* Melihat status dompet pemilih (Sudah/Belum terdaftar & Sudah/Belum memilih).
* Melihat hasil perolehan suara secara *real-time* langsung dari jaringan Sepolia.

---

## 3. Panel Pemilih (Mahasiswa)

* *Login* menggunakan data mahasiswa.
* *Connect Wallet* menggunakan ekstensi MetaMask.
* Melihat daftar kandidat beserta pop-up detail visi dan misinya.
* Mencoblos kandidat pilihan (1 Wallet = 1 Suara).
* **Session Log:** Perekaman jejak aktivitas *on-chain* secara *real-time* di UI.

---

# Teknologi yang Digunakan

## Frontend & Backend (Web2)

* Laravel (PHP Framework)
* Tailwind CSS (UI/UX Styling)
* MySQL (Database Akun Mahasiswa)

## Blockchain (Web3)

* Solidity (Smart Contract)
* Ethers.js v6 (Web3 Provider Interactor)
* Jaringan **Sepolia Testnet**

---

# Prasyarat Instalasi

Sebelum menjalankan proyek ini di mesin lokal, pastikan kamu sudah menginstal:

1. **PHP** (Minimal versi 8.1) & **Composer**
2. **Node.js** & **NPM**
3. **MySQL** (XAMPP / Laragon)
4. Ekstensi *browser* **MetaMask** (Sudah diset ke jaringan Sepolia Testnet dan memiliki saldo *Sepolia ETH*)

---

# Cara Menjalankan Proyek (Setup Lokal)

## 1. Clone Repositori

```bash
git clone https://github.com/KunyitAlami/SINTING-FT
cd SINTING-FT
```

---

## 2. Install Dependensi PHP & JavaScript

```bash
composer install
npm install
```

---

## 3. Konfigurasi Environment (.env)

Salin file konfigurasi contoh dan buat file `.env` baru:

```bash
cp .env.example .env
```

Buka file `.env` menggunakan teks editor, kemudian sesuaikan baris Database MySQL lokal:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=sinting_ft
DB_USERNAME=root
DB_PASSWORD=
```

---

## 4. Generate Application Key & Migrasi Tabel

```bash
php artisan key:generate
php artisan migrate
```

---

## 5. Eksekusi Database Seeder

Langkah ini untuk memasukkan data mahasiswa simulasi (NIM 2310817120005 dst.) beserta akun Admin KPU ke dalam database MySQL.

```bash
php artisan db:seed --class=UserSeeder
```

---

## 6. Jalankan Server Lokal Laravel

```bash
php artisan serve
```

Buka peramban browser Anda lalu akses rute utama:

```text
http://127.0.0.1:8000
```

---

# ⛓️ Informasi Deployment Smart Contract

Smart Contract proyek SINTING-FT telah diverifikasi dan berjalan aktif pada testnet global:

### Contract Address

```text
0x427dC08BA46192024ceAdeD224f3251bFB8c3fBB
```

### Network Explorer

Sepolia Etherscan

---

# ⚠️ Catatan Penting Panitia (KPU)

Untuk mengoperasikan fitur **"Tambah Kandidat"** dan **"Daftarkan DPT"**, akun MetaMask yang Anda hubungkan ke dashboard admin haruslah alamat wallet pengunggah (Deployer/Committee) dari contract tersebut.

Jika tidak, transaksi tulis (*write method*) otomatis akan di-*revert* oleh mesin EVM.

---

# 🧑‍💻 Tim Pengembang

## Randy Febrian

**Smart Contract & Sepolia**

* Solidity
* Deploy Contract
* Aturan 1 Wallet 1 Vote
* Hitung Hasil Voting

## Ghani Mudzakir

**Backend Laravel 11**

* Database
* Autentikasi
* CRUD Kandidat dan Pemilih
* API
* Dashboard Admin

## Noviana Nur Aisyah

**Web3 Integration**

* Ethers.js
* Connect Wallet
* Kirim Transaksi Voting
* Baca Data Contract

## Siti Ratna Dwinta Sari

**Frontend & QA**

* UI Halaman Voting
* Hasil & Verifikasi
* Pengujian Sistem
* Dokumentasi
