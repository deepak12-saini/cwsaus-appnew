# CakePHP 2 to 4 Migration Guide - CWS Australia

This document describes the upgraded CakePHP 4 structure and steps to run the project.

## What Was Done

1. **New CakePHP 4 structure** (alongside or replacing the old app):
   - `config/` – app.php, bootstrap.php, routes.php, app_local.php
   - `src/` – Application.php, Controller/, Model/Entity/, Model/Table/, Model/Behavior/
   - `templates/` – Layout/, Element/, and controller action views
   - `webroot/` – index.php and .htaccess (public entry point)

2. **Controllers** – Converted to namespaced CakePHP 4 style:
   - `App\Controller\AppController` (with callConstants, checkAdminSession, sendEmail)
   - `App\Controller\FrontsController` – front actions (index, about, contact, calculator, etc.)
   - `App\Controller\Admin\UsersController` – admin login, dashboard, profile, CRUD
   - `App\Controller\BlogsController`, `PagesController`, `ErrorsController`, `QuicksController`

3. **Models** – Replaced with ORM Table + Entity:
   - Tables: UsersTable, BlogsTable, CategoriesTable, ConfigsTable, ContactsTable, GalleriesTable, MenuPagesTable, QuoteComericalsTable, QuoteRequestsTable, QuickQuotesTable, StatesTable, StatePricesTable, SubsubsidiesTable
   - Entities: User, Blog, Category, Config, Contact, Gallery, MenuPage, QuoteComerical, QuoteRequest, QuickQuote, State, StatePrice, Subsubsidy
   - Slug behavior: `App\Model\Behavior\SlugBehavior` (replaces Slugomatic plugin) on Blogs and Categories

4. **Routes** – `config/routes.php`:
   - `/admin` → Admin\UsersController::login
   - `/` → Fronts::index, `/about`, `/contact-us`, `/blog`, `/solar-calculator`, etc.
   - Admin prefix: `/admin/users/dashboard`, `/admin/users/profile`, etc.

5. **Config**
   - Database: `config/app_local.php` (Datasources) – uses env vars or defaults (admin_cws2022, root, no password).
   - Copy `.env.example` to `.env` and set DB_*, SECURITY_SALT, FULL_BASE_URL if needed.

6. **Components**
   - Stripe: `App\Controller\Component\StripeComponent` (uses `stripe/stripe-php` from Composer; set STRIPE_SECRET_KEY in .env).

7. **PHP 8.1**
   - Code uses PHP 8.1-compatible syntax (e.g. no `$str{0}`, use `$str[0]`).

## How to Run

1. **Install dependencies**
   ```bash
   cd c:\xampp74\htdocs\cwsaus
   composer install
   ```

2. **Database**
   - Ensure MySQL has database `admin_cws2022` (or set DB_DATABASE in .env).
   - No schema changes required; existing tables (users, blogs, categories, configs, etc.) are used as-is.

3. **Config**
   - Copy `.env.example` to `.env` and adjust (DB_*, SECURITY_SALT, FULL_BASE_URL).
   - Ensure `config/app_local.php` exists (it’s in the repo; do not commit real credentials).

4. **Web server**
   - **Option A (recommended):** Set document root to `cwsaus/webroot`. Then URLs are e.g. `http://localhost/` (or `http://localhost/cwsaus/webroot/` if under htdocs).
   - **Option B:** Keep document root as `cwsaus`. The root `index.php` forwards to `webroot/index.php`.

5. **Static assets**
   - Copy from old app so CSS/JS work:
     - Copy `app/webroot/front_theme` to `webroot/front_theme`
     - Copy `app/webroot/theme` to `webroot/theme`
   - Or symlink: from `webroot/`: `mklink /D front_theme ..\app\webroot\front_theme`

6. **Directories**
   - Create and make writable: `tmp/`, `tmp/cache/`, `tmp/cache/models/`, `tmp/cache/persistent/`, `logs/`.

## Remaining / Optional

- **Views** – Only a subset of templates were added (Fronts/index, Admin/Users/login, dashboard). Copy and convert remaining views from `app/View/` to `templates/` (e.g. `app/View/Fronts/contact.ctp` → `templates/Fronts/contact.php`), replacing `$this->Html`, `$this->Form` where needed (same in Cake 4).
- **Admin controllers** – Galleries, Menus, Categories, States, Quicks admin CRUD were not fully ported. Add under `src/Controller/Admin/` following the same pattern as Admin\UsersController.
- **CategoriesController** – Old app referenced an “Article” model that didn’t exist; removed in this migration.
- **Email templates** – Old app used `Layouts/Emails/html/` and view files; in Cake 4 use `templates/Email/html/` and Mailer templates.
- **PayPal / Importexcel** – Not ported; replace with Composer packages and services as needed.

## File Map (Old → New)

| CakePHP 2              | CakePHP 4                    |
|------------------------|------------------------------|
| app/Controller/        | src/Controller/              |
| app/Controller/Component/ | src/Controller/Component/ |
| app/Model/             | src/Model/Table/ + Entity/   |
| app/View/              | templates/                   |
| app/Config/routes.php  | config/routes.php            |
| app/Config/database.php| config/app_local.php (Datasources) |
| app/webroot/           | webroot/ (and copy assets)   |

Your existing database structure is unchanged; the new code uses the same table and column names.
