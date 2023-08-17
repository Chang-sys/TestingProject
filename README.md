The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

# Delele Data All Table
php artisan migrate:refresh
# Delete Data One Table
php artisan migrate:refresh --path=/database/migrations/2023_06_14_134249_create_student_table.php
php artisan passport:install

cd storage/
mkdir -p framework/{sessions,views,cache}
chmod -R 775 framework

Controller & Model
php artisan make:controller DashboardController --resource --model=Terms

Table
php artisan make:migration create_privacy_table
php artisan make:migration create_terms_table

Mac OS
brew link --overwrite php@7.4
ubuntu
sudo update-alternatives --config php

php artisan cache:clear
php artisan route:clear
php artisan config:clear
php artisan view:clear

php artisan db:seed --class=PermissionTableSeeder
php artisan db:seed --class=CreateAdminUserSeeder

// To add a define your own fuction at app with laravel project app\helpers.php
composer dump-autoload

// After create storage/app/public/images
php artisan storage:link