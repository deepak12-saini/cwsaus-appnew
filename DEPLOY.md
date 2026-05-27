# Deploy cwsaus (CakePHP 4)

**Before every production release, follow [DEPLOY_CHECKLIST.md](DEPLOY_CHECKLIST.md)** — it prevents partial deploys (e.g. menu shows Suppliers on live but Services on local).

## GitHub: `cwsaus-appnew`

Remote: `https://github.com/deepak12-saini/cwsaus-appnew.git`

## Push code from your PC

```powershell
cd c:\xampp74\htdocs\cwsaus
git add .
git commit -m "CakePHP 4 updates: routes, bootstrap, local fixes"
git remote add appnew https://github.com/deepak12-saini/cwsaus-appnew.git
git push -u appnew main
```

If GitHub already has only a README and push is rejected:

```powershell
git push -u appnew main --force
```

Use a **GitHub Personal Access Token** as the password (not your GitHub login password if 2FA is on).

## Plesk Git extension

1. **Repositories** → Create → **Remote repository**
2. URL: `https://github.com/deepak12-saini/cwsaus-appnew.git`
3. Username: `deepak12-saini` | Password: PAT token
4. If path exists error: rename/delete old folder under `/var/www/vhosts/cwsaus.com.au/git/` or use a **new repository name** in Plesk
5. **Deploy** to site directory (e.g. `httpdocs` or domain root)
6. Enable **Pull** on deploy or webhook

## On the server after pull

```bash
cd /path/to/site
composer install --no-dev --optimize-autoloader
# Keep existing .env — do not overwrite from Git
chmod -R 775 tmp logs
rm -rf tmp/cache/*
```

## Production `.env` (on server only)

- `DEBUG=false`
- `FULL_BASE_URL=https://cwsaus.com.au`
- `APP_BASE=/`
- No `DB_PORT` (unless host uses non-default port)
- Real `SECURITY_SALT` and `EMAIL_PASSWORD`

See `.env.example` for all keys.

## About page — production database (optional)

After deploying the About template update, run in phpMyAdmin or MySQL:

```sql
-- See config/queries/update_about_menu_page.sql
UPDATE menu_pages SET
  banner_sub_text = 'Professional waterproofing contracting & installation across Australia',
  main_title = 'About Us',
  content = 'CWS Australia is a professional waterproofing contracting and installation company. With over 100 years of combined experience across our national team, we are a preferred choice for domestic and national builders, constructors, and commercial clients.',
  updated_at = NOW()
WHERE id = 1;
```

Main About copy is in `templates/Fronts/about.php`; this SQL updates the banner subtitle only.
