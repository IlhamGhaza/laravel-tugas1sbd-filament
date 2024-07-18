# Laravel-tugas1sbd-filament

## Table of Contents

- [Laravel-tugas1sbd-filament](#laravel-tugas1sbd-filament)
  - [Table of Contents](#table-of-contents)
  - [Description](#description)
  - [Database Schema](#database-schema)
  - [About Laravel](#about-laravel)
  - [Installation](#installation)
  - [Filament Admin Template](#filament-admin-template)
  - [Features](#features)
  - [ScreenShoot](#screenshoot)
  - [Contact](#contact)
  - [Contribution](#contribution)
  - [License](#license)
  
## Description

Proyek ini adalah implementasi dari tugas pertama Sistem Basis Data (SBD) menggunakan Laravel. Untuk detail lebih lanjut tentang kasus yang diangkat dalam tugas ini, silakan lihat [contoh kasus](contohkasus.md).

This project is an implementation of the first Database Systems (SBD) assignment using Laravel. For more details about the case study, please refer to [case example](contohkasus.md).

## Database Schema

The database schema for this project is visualized in the following diagram:
![Database Schema](public/image.png)
For a detailed view and interaction with the schema, please refer to the [DrawSQL diagram](https://drawsql.app/teams/dreamer-3/diagrams/tugas-sbd2).

## About Laravel

Laravel is a PHP framework that is elegant and expressive, designed to make web development a joyful and creative experience for developers. For more information about Laravel, visit [About Laravel](laravel.md).

## Installation

1. Clone this repository to your local machine.

    ```bash
    git clone https://github.com/IlhamGhaza/laravel-tugas1sbd-filament.git
    ```

2. Navigate to the project directory.

    ```bash
    cd laravel-tugas1sbd-filament
    ```

3. Install dependencies using Composer.

    ```bash
    composer install
    ```

4. Copy the `.env.example` file to `.env`.

    ```bash
    cp .env.example .env
    ```

5. Generate the application key.

    ```bash
    php artisan key:generate
    ```

6. Configure your database in the `.env` file.

7. Run migrations to create the database tables.

    ```bash
    php artisan migrate
    ```

8. Run the application.

    ```bash
    php artisan serve
    ```

9. Visit

   ```bash
    http://127.0.0.1:8000/admin
    ```

10. Use the following credentials to log in:
    - Email: `ilham@admin.com`
    - Password: `SecretPass`

Note : You can edit in

  ```bash
  database\seeders\DatabaseSeeder.php
  ```

  if composer trouble run this command
  
  ```bash
    composer update
    composer dump-autoload
   ```
  
## Filament Admin Template

This project utilizes the Filament admin template for creating an intuitive and user-friendly admin panel. Filament is a powerful tool for quickly generating administrative interfaces. For more information about Filament, visit the [Filament documentation](https://filamentphp.com/docs).

To install Filament, follow these steps:

1. Install Filament using Composer:

    ```bash
    composer require filament/filament="3.2.57" -W
    ```

2. Publish the Filament configuration:

    ```bash
    php artisan vendor:publish --tag=filament-config
    ```

3. Configure Filament by editing the `config/filament.php` file as needed.

4. Create Filament resources and pages using Artisan commands. For instance, to generate resources like a Post resource (assuming Post is your model):

    ```bash
     php artisan make:filament-resource Post <!--//(from your model) -->
    ```

   For beginners looking for a step-by-step guide, check out this [tutorial video for beginner](https://youtube.com/playlist?list=PLqDySLfPKRn6fgrrdg4_SmsSxWzVlUQJo&si=GhXQaFVjgIB1pSbu)

## Features

- CRUD (Create, Read, Update, Delete) operations for the main entity.
- User input validation.
- Middleware for user authentication.
- Admin panel using Filament template.
- Database seeder for initial admin user.
- API with laravel-orion

## ScreenShoot

![ScreenShoot](public/screen.png)

## Contact

For any questions or issues, please open an issue on this repository or contact the project maintainer directly.

## Contribution

If you wish to contribute to this project, please fork this repository and submit a pull request with your changes.

## License

This project is licensed under the Creative Commons Attribution-NonCommercial 4.0 International License. You may not use this project for commercial purposes. See the [LICENSE](LICENSE) file for more details.

