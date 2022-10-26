## Installation
1. git clone https://github.com/aannn123/FarhanMustaqim-wings.git
2. composer install
3. copy file .env.example dan hapus .example menjadi .env
4. masukkan 
    DB_DATABASE=
    DB_USERNAME=
    DB_PASSWORD=
5. jalankan php artisan migrate
6. jalankan php artisan db:seed --class=UserSeeder dan php artisan db:seed --class=ProductSeeder
7. jalankan php artisan serve
8. untuk login
    <br>
        user
        - username : john
        - password: john123
    <br>
        admin
        - username : admin
        - password : admin123
        