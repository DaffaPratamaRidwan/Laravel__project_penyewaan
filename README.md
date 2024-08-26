## setup

1. install vscode
2. install composer from getcomposer.org
3. install xampp
4. isntall mysql
5. buat db pada mysql dengan nama "dbalatberat"
6. pada file .env DB_USERNAME dan DB_PASSWORDnya sesuaikan
7. composer require laravel/breeze --dev
8. php artisan breeze:install
9. npm install && npm run dev
10. composer require laravel/ui
11. php artisan ui vue --auth
12. npm install && npm run dev
13. php artisan config:clear

** tambah pengembalian_diterima di table sewa
** tambah nilai default '2' di table user role_id

## Setup and Install google client

1. https://gist.github.com/sergomet/f234cc7a8351352170eb547cccd65011
2. composer require google/apiclient:^2.0
3. composer require masbug/flysystem-google-drive-ext
4. composer require modernmcguire/flysystem-google-drive:~1.1

## run program

1. php artisan migrate // php artisan migrate:refresh --path=
2. php artisan db:seed // php artisan db:seed --class=AlatBeratSeeder
3. npm run dev
4. php artisan serve
5. akses http://127.0.0.1:8000/

## akun

# penyewa

email: penyewa@example.com
password: password

# admin

email: admin@example.com
password: password
