# Fix: vendor/autoload.php missing

The error **"failed to open stream: No such file or directory ... vendor/autoload.php"** means Composer dependencies are not installed.

## Steps (PHP 7.4, XAMPP)

1. **Install Composer** (if you don’t have it):
   - Download: https://getcomposer.org/Composer-Setup.exe  
   - Run it and choose your PHP 7.4 (e.g. `C:\xampp74\php\php.exe`).

2. **Open Command Prompt or PowerShell** and go to the project folder:
   ```bat
   cd C:\xampp74\htdocs\cwsaus
   ```

3. **Reduce file locking (recommended):**
   - Close Cursor/VS Code (or any editor) that has this folder open.
   - Temporarily disable real-time antivirus scanning for `C:\xampp74\htdocs\cwsaus`, or add that folder as an exclusion.
   - Or run the command below **after a fresh restart** so nothing is locking the folder.

4. **Install dependencies:**
   ```bat
   composer install
   ```
   - If it asks to allow plugins, type `y` and press Enter.
   - Wait until it finishes (it may take a few minutes).

5. **If you see “Could not delete … file is locked”:**
   - Close all programs using the project (browser, editor, Explorer window in that folder).
   - Delete the `vendor` folder manually (if some files won’t delete, restart Windows and delete again).
   - Run `composer install` again.

6. **Reload the site** in the browser (e.g. `http://localhost/cwsaus/`).

After a successful `composer install`, `vendor/autoload.php` and the rest of `vendor/` will be created and the site should load.

---

**If you see "Missing Controller" or a TypeError about `camelize(null)`:**  
The app is probably running from a subdirectory (e.g. `http://localhost/cwsaus/`). Create a `.env` file (copy from `.env.example`) and add:

```ini
APP_BASE=/cwsaus
```

Then reload the site. The home page should load correctly.
