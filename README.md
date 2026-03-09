# CWS Australia

CakePHP 4 web application for CWS Australia - construction chemical solutions, waterproofing, and solar services.

## Requirements

- PHP 7.4+
- MySQL/MariaDB
- Composer

## Installation

1. Clone the repository
2. Run `composer install`
3. Copy `config/app_local.example.php` to `config/app_local.php` and configure database
4. Run migrations: `bin/cake migrations migrate`
5. Seed admin user: `bin/cake migrations seed`

## Admin Access

- URL: `/admin` or `/cwsaus/admin`
- Default: admin@admin.com / admin

## License

Proprietary
