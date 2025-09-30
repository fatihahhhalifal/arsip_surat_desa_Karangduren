# 📄 Aplikasi Arsip Surat Desa Karangduren

## 🎯 Tujuan
Aplikasi ini dibuat untuk membantu perangkat desa Karangduren dalam mengarsipkan surat-surat resmi yang pernah dibuat.  
Dengan adanya aplikasi ini, surat dapat dikelola dengan lebih rapi, mudah dicari, dan terdokumentasi dengan baik.

---

## ✨ Fitur
- CRUD *Kategori Surat* (Tambah, Edit, Hapus, Lihat)  
- CRUD *Arsip Surat* (Tambah, Edit, Hapus, Lihat)  
- Unggah file *PDF* untuk setiap surat  
---

## 🚀 Cara Menjalankan

### 1. Clone / Download Project
- *Clone via Git*
  bash
  git clone https://github.com/fatihahhhalifal/arsip_surat_desa_Karangduren
  cd arsip_surat_desa_Karangduren
  
- *Atau Download ZIP*
  - Download file ZIP dari repository.
  - Extract file hasil download.

### 2. Konfigurasi Database
- Import file lsp.sql langsung ke MySQL/MariaDB:
  bash
  mysql -u root -p < lsp.sql
- Atau gunakan aplikasi seperti SQLyog

### 3. Setup Environment
- Ubah nama file **.env.example** menjadi **.env**  
  (bisa menggunakan perintah berikut di terminal:)
  bash
  cp .env.example .env
- Ubah konfigurasi database di file .env sesuai pengaturan lokal:
  env
  DB_CONNECTION=mysql
  DB_HOST=127.0.0.1
  DB_PORT=3306
  DB_DATABASE=laravel
  DB_USERNAME=root
  DB_PASSWORD=
  

### 4. Install Dependency
Jalankan perintah:
bash
composer install


### 5. Storage & Key
bash
php artisan storage:link
php artisan key:generate

Jika storage:link error, jalankan ulang:
bash
composer install
php artisan storage:link


### 6. Menjalankan Aplikasi
bash
php artisan serve


Akses aplikasi di browser:  
👉 http://127.0.0.1:8000/arsip

---
## 📸 Screenshot Aplikasi

### Arsip Surat
- *Halaman Arsip*
<img width="959" height="503" alt="Screenshot 2025-09-30 153702" src="https://github.com/user-attachments/assets/b588cb96-3eb9-4b92-9540-3ce4fbd50040" />

- *Tambah Arsip*
<img width="959" height="471" alt="Screenshot 2025-09-30 153752" src="https://github.com/user-attachments/assets/d2746436-654c-4a0c-b66d-156438d9af4e" />

- *Lihat Arsip*
<img width="959" height="468" alt="Screenshot 2025-09-30 153811" src="https://github.com/user-attachments/assets/83c7c219-6748-4aec-b111-5fde0ebd0081" />

- *Hapus Arsip*
<img width="959" height="470" alt="Screenshot 2025-09-30 153842" src="https://github.com/user-attachments/assets/dd25a05c-8894-4277-a40b-03dceaaf7fa4" />

---

### Kategori Surat
- *Halaman Kategori*
<img width="959" height="500" alt="Screenshot 2025-09-30 154006" src="https://github.com/user-attachments/assets/1ad280ca-2ea5-40e1-a98a-29b3840ac791" />

- *Tambah Kategori*
<img width="959" height="475" alt="Screenshot 2025-09-30 154017" src="https://github.com/user-attachments/assets/578c19dd-ebce-4bcf-9d5f-53c892bde7db" />

- *Edit Kategori*
<img width="959" height="472" alt="Screenshot 2025-09-30 154031" src="https://github.com/user-attachments/assets/68918e4b-504a-4bdb-957b-6240f586c989" />

- *Hapus Kategori*
<img width="959" height="474" alt="Screenshot 2025-09-30 154042" src="https://github.com/user-attachments/assets/9d1105e9-9ea5-4a96-8479-a19e50d6cc42" />

---

### About
- *Halaman About*
  <img width="959" height="500" alt="Screenshot 2025-09-30 154054" src="https://github.com/user-attachments/assets/f86bf439-7bba-4906-9e30-91cd20f262eb" />
