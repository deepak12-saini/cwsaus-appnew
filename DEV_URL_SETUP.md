# Dev URL: http://dev.cwsaus.com.au

## Setup (one-time)

### 1. Hosts file

Open **Notepad as Administrator** and edit:
```
C:\Windows\System32\drivers\etc\hosts
```

Add this line:
```
127.0.0.1 dev.cwsaus.com.au
```

Save and close.

### 2. Restart Apache

XAMPP Control Panel → Stop Apache → Start Apache

### 3. Access

Open: **http://dev.cwsaus.com.au/**

---

## Switch back to localhost/cwsaus

In `.env`:
```env
APP_BASE=/cwsaus
# FULL_BASE_URL=   (comment out or remove)
```

Then use: http://localhost/cwsaus/
