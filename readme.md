# Attendance Manager

Application to manage employee's attendance using Laravel framework.

## Requirement
- PHP 5.3.2+
- MySQL/MariaDB
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

In case `php artisan migrate` load `Cannot declare class <class name>, because the name is already in use`:
- `cd database\migrations`
- Here, migration models are named based on creation date. Make sure there are only
  - 2 models created in 2014
  - 2 models created in 2017
  - 1 file created in 2018 named `2018_**_create_absence_table.php`. If there are more than one file, preserve only the newest one and delete the rest.
  - 1 file created in 2018 named `2018_**_create_summaries_table.php`. If there are more than one file, preserve only the newest one and delete the rest.
- For further questions, please contact [William Citralin](mailto:tyrand3@gmail.com).
