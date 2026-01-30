<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# artolog
Collective Archive for Art Documentation

## Technology

- Laravel Framework 9.0
- PHP 8.0

### Laravel packages added

- [`spatie/laravel-permission`](https://github.com/spatie/laravel-permission) This package allows you to manage user permissions and roles in a database.

- [`spatie/laravel-activitylog`](https://github.com/spatie/laravel-activitylog) The `spatie/laravel-activitylog` package provides easy to use functions to log the activities of the users of your app. It can also automatically log model events.
The Package stores all activity in the `activity_log` table.

- [`spatie/laravel-medialibrary`](https://spatie.be/docs/laravel-medialibrary) This package can associate all sorts of files with Eloquent models. It provides a
simple API to work with. To learn all about it, head over to [the extensive documentation](https://spatie.be/docs/laravel-medialibrary).


## First Installation

- composer install
- Si c'est l'environnement Local changer le fichier .env.local pour .env
- Si c'est l'environnement Staging changer le fichier .env.staging pour .env
- Si c'est l'environnement Production changer le fichier .env.production pour .env
- php artisan migrate
- php artisan permission:update
- php artisan db:seed
- php artisan optimize:clear


## Update project

- composer update
- php artisan migrate
- php artisan permission:update
- php artisan db:seed --class=CreateSuperAdminSeeder
- php artisan optimize:clear


## Commands list of system | Cron job


## Other Commands list of system

- php artisan test:send-email
- php artisan admin:create-user
- php artisan db:cleanup

## Unit/Feature Tests

### First Installation

- Create a database named `artolog_testing` locally

### Run Tests
- php artisan optimize:clear
- php artisan test
