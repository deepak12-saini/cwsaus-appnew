# Database migrations (no backup – create tables from scratch)

Migrations create all tables required by the app. Run them from the project root.

## 1. Create database

Create a MySQL database (e.g. `admin_cws2022`) and set credentials in `config/app_local.php` or `.env`:

- `DB_DATABASE=admin_cws2022`
- `DB_USERNAME=root`
- `DB_PASSWORD=`

## 2. Run migrations

From the project root (e.g. `c:\xampp74\htdocs\cwsaus`) use one of:

**Windows (Command Prompt or PowerShell):**
```bat
php bin\cake.php migrations migrate
```
or:
```bat
bin\cake.bat migrations migrate
```

**Linux/Mac:**
```bash
bin/cake migrations migrate
```

This creates:

- users  
- categories  
- blogs  
- configs  
- contacts  
- galleries  
- menu_pages  
- quote_requests  
- quote_comericals  
- quick_quotes  
- states  
- state_prices  
- subsubsidies  

## 3. (Optional) Seed initial data

To insert default config (id=1), menu pages (1–5), and one subsubsidy row:

**Windows:**
```bat
php bin\cake.php migrations seed --seed InitialSeed
```
or:
```bat
bin\cake.bat migrations seed --seed InitialSeed
```

**Linux/Mac:**
```bash
bin/cake migrations seed --seed InitialSeed
```

## 4. Admin user

Create at least one admin user in `users` (e.g. via a small script or MySQL):

- `user_type` = 2 (admin)  
- `status` = 1  
- Set `username`, `password`, `name`, `email`, `role` (e.g. 'A') as needed.

After that, open the home page and admin login (`/cwsaus/`, `/cwsaus/admin`) and fix any missing data as required.
