# Laravel-tugas1sbd-filament

## Table of Contents

- [Laravel-tugas1sbd-filament](#laravel-tugas1sbd-filament)
  - [Table of Contents](#table-of-contents)
  - [Description](#description)
  - [Database Schema](#database-schema)
  - [About Laravel](#about-laravel)
  - [Installation](#installation)
  - [Features](#features)
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
    cd laravel-tugas1sbd-filamen
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

## Features

- CRUD (Create, Read, Update, Delete) operations for the main entity.
- User input validation.
- Middleware for user authentication.

## Contribution

If you wish to contribute to this project, please fork this repository and submit a pull request with your changes.

## License

This project is licensed under the MIT License. See the [LICENSE](LICENSE) file for details
![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)
