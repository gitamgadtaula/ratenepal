<p align="center"><img src="https://res.cloudinary.com/dtfbvvkyp/image/upload/v1566331377/laravel-logolockup-cmyk-red.svg" width="400"></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

## About this project 
This project uses the modular approach of "nwidart/laravel-modules". <a href="https://nwidart.com/laravel-modules/v1/introduction"> Please follow this documentation. </a>

## About Authentication guard and User Model

Since we have used modular approach using laravel Module package, our User authentication model lives inside User module. So, we need to make change the users model of providers inside 'app/auth.php'

     'guards' => [
       ...,
        'api' => [
            'driver' => 'jwt',
            'provider' => 'users',
            'hash' => false,
        ],   
    ],
    
    'providers' => [
    'users' => [
            'driver' => 'eloquent',
            'model' => App\User::class,
        ],

## Migrate all the Modules 

        php artisan module:migrate User
        php artisan module:migrate Shop
        php artisan module:migrate Feedback

## Seed the tables

        php artisan module:seed User
        php artisan module:seed Shop






