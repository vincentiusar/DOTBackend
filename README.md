# DOTBackend
Backend Laravel Hotel App <br>
NOTE: dimulai dari route '/login'

## Deskripsi Project
Project ini adalah project membentuk suatu aplikasi dengan pattern MVC menggunakan framework Laravel. Pada aplikasi, admin dapat login dan melihat list hotel yang tersedia. Kemudian untuk semua hotel memiliki banyak ruangan. Aplikasi web ini akan digunakan oleh admin hotel yang bisa digunakan untuk memasukan, mengubah, membaca, dan menghapus data hotel yang ingin dimasukan. Aplikasi ini akan terhubung ke basis data Postgresql.

## DB Relation
![Untitled](https://user-images.githubusercontent.com/58662886/179771153-7863d80c-37a8-4b48-ac36-102df245af0b.png)

## Screenshot
![image](https://user-images.githubusercontent.com/58662886/179771301-29e0d68c-4225-43f7-be2d-c71d7d042413.png)
![image](https://user-images.githubusercontent.com/58662886/179771451-8d6fd58f-7aea-423b-b5da-bc38170a2c5e.png)

## Depedencies
Main Depedencies
Auth Sanctum -> Pembuat token login (seperti JWT)
Facades DB -> Query builder yang digunakan untuk berkomunikasi dengan database
Eloquent -> ORM yang digunakan pada project ini
Facades Validator -> Digunakan untuk melakukan validasi data

Other
Tailwind css -> Framework yang digunakan untuk styling blade
daisyui -> Penyedia Color theme untuk blade
concurrently -> Menjalankan 2 command secara bersamaan (php artisan serv dan vite)

## More info
deployment link : -- soon --

Berpindah ke /login untuk melakukan login dan mencoba aplikasi.

Sebelum run pastikan sudah melakukan hal berikut:

- Membuat database postgresql dengan nama dan password yang disesuaikan dan diletakan dalam .env
- Menginstall semua depedencies laravel (composer install)
- Menginstall semua depedencies npm (npm install)

Run command -> npm run dev
