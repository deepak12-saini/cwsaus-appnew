# Production Deploy Checklist (cwsaus.com.au)

Use this **every time** after pushing to GitHub. Skipping steps causes “localhost works, production shows old menu/text” issues.

Repo: `https://github.com/deepak12-saini/cwsaus-appnew.git`  
Branch: `main`  
Plesk deploy target: `/httpdocs`

---

## 1. On your PC (before Plesk)

- [ ] Commit only the files you intend to deploy
- [ ] Push to the correct remote:
  ```powershell
  cd c:\xampp74\htdocs\cwsaus
  git push appnew main
  ```
- [ ] Confirm push succeeded: `git status` shows `main...appnew/main` with no “ahead”
- [ ] Ignore `custom/customcws/app/webroot/dompdf` in status (untracked submodule noise — do not commit unless needed)

---

## 2. In Plesk Git

- [ ] Open repository **cwsaus-appnew** → branch **main**
- [ ] Click **Pull now** (wait until finished)
- [ ] Confirm latest commit message appears in the list (e.g. menu, SEO, LinkedIn)
- [ ] Click **Deploy now** (deploy to `/httpdocs`)
- [ ] Wait for deploy to complete without errors

---

## 3. On the server (after deploy)

- [ ] Clear CakePHP cache:
  ```bash
  cd /var/www/vhosts/cwsaus.com.au/httpdocs
  rm -rf tmp/cache/*
  ```
- [ ] Do **not** overwrite production `.env` from Git (keep server DB/email settings)
- [ ] If `composer.json` changed, run:
  ```bash
  composer install --no-dev --optimize-autoloader
  ```

---

## 4. Legacy files (removed from repo)

The old CakePHP 2 folders **`app/`** and **`lib/`** are no longer in Git. Production must run CakePHP 4 only (`webroot/index.php` → `templates/`).

**Linux case sensitivity:** Template folders must be lowercase:
- `templates/element/` (not `Element/`)
- `templates/layout/` (not `Layout/`)

If production menu is old but localhost is correct, the server may still be reading `templates/element/front_header.php` (old) while Git updated `templates/Element/` (unused on Linux).

After deploy, **manually delete on server** if they still exist:

- [ ] `httpdocs/app/` (entire folder — legacy CakePHP 2)
- [ ] `httpdocs/lib/` (legacy CakePHP 2 core)
- [ ] `httpdocs/templates/Element/` (wrong case — duplicate old copy)
- [ ] `httpdocs/templates/Layout/` (wrong case)

Then clear cache again.

---

## 5. Verify live site (hard refresh)

Use **Ctrl + F5** (or incognito window).

| Check | URL | Expected |
|-------|-----|----------|
| Home | https://cwsaus.com.au/ | Loads, slider works |
| Menu | Any page | **Services** (not Suppliers, not “Our Service”) |
| Services page | https://cwsaus.com.au/services | Services content + cards |
| Old URL | https://cwsaus.com.au/suppliers | Opens Services (redirect), menu still says **Services** |
| Projects | https://cwsaus.com.au/projects | Projects page |
| Tab title | Home | **CWS Australia** (not “Fronts”) |
| LinkedIn | Footer icon | Opens LinkedIn company page (not `#`) |
| SEO files | https://cwsaus.com.au/robots.txt | Shows sitemap URL |
| | https://cwsaus.com.au/sitemap.xml | Lists main pages |

---

## 6. Production `.env` reminders (server only)

- [ ] `DEBUG=false`
- [ ] `FULL_BASE_URL=https://cwsaus.com.au`
- [ ] `APP_BASE=/`
- [ ] Optional social URLs (if set, footer uses these instead of defaults):
  ```
  LINKEDIN_URL=https://www.linkedin.com/company/construction-waterproofing-solutoins/people/
  ```

---

## 7. Common problems

| Symptom | Cause | Fix |
|---------|--------|-----|
| Menu shows Suppliers / Our Service | Old `templates/element/` on Linux OR old `app/` folder | Deploy lowercase `templates/element/`, delete `app/` and wrong-case `Element/` folder + clear cache |
| Page shows Services but menu is old | Routes updated, templates not | Full Deploy + verify `templates/Element/front_header.php` |
| Tab title “Fronts” | Old `front_layout.php` on server | Pull + Deploy latest `templates/Layout/front_layout.php` |
| LinkedIn goes to `#` | `LINKEDIN_URL=#` in production `.env` | Set correct URL in server `.env` or deploy latest footer |
| Changes on GitHub but not on site | Pull without Deploy | **Deploy now** after every Pull |
| Plesk shows old commit | Push to wrong remote/branch | `git push appnew main` only |

---

## Quick command summary

**PC:**
```powershell
git push appnew main
```

**Plesk:** Pull now → Deploy now

**Server:**
```bash
rm -rf tmp/cache/*
```

**Browser:** Ctrl + F5
