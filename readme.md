# Attendance Manager

Application to manage employee's attendance using Laravel framework.

## Requirement
- PHP 7.0+
- MySQL/MariaDB/PostgreSQL
- Composer ([download here](https://getcomposer.org/download/))

## Installation
- Clone this repo in the server directory
- Rename or copy `.env.example` file into `.env`.
- When necessary, customize the `.env` file.
- Create database based on settings in `.env`.
- Open console and move to project directory.
- Run `composer install`.
- Run `php artisan key:generate`.
- Run `php artisan migrate`.
- Run `php artisan serve`. Now the project is accessible.

## Troubleshoot
In case the project is not working, do this in the project environment:
- Run `composer update`.
- Run `composer install`.
- Run `php artisan migrate`.

To seed the table, don't forget to run `php artisan db:seed`
