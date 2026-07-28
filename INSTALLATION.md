# MRH License — Complete Installation Guide

**For installers with beginner-level Laravel knowledge.**

This guide installs the MRH License package into an **existing** Laravel 12
project. It is designed to be **100% conflict-free**: the package never
overwrites any file you already have. Every resource it creates uses an
`mrh` / `mrh-license` / `mrh_license` prefix.

> **Golden rule:** You will only ever *add* small snippets to a few files, or
> *create* brand-new files. You will **never** replace or delete an existing
> file. If a step ever tells you a file "already exists and has content," you
> only add lines — you do not clear it.

---

## What the package will and will not touch

| Resource | Name it uses | Conflicts with your app? |
|---|---|---|
| PHP namespace | `Mrh\License\...` | No — unique vendor namespace |
| Config file | `config/mrh-license.php` | No — new file |
| Database tables | `mrh_license_settings`, `mrh_license_activations`, `mrh_license_verifications`, `mrh_license_logs` | No — `mrh_` prefix |
| Migrations | `..._create_mrh_license_*_table.php` | No — new files |
| Artisan commands | `mrh-license:activate`, `mrh-license:verify`, `mrh-license:status`, `mrh-license:reset` | No — `mrh-license:` prefix |
| Routes (URI) | `/mrh-license/...` | No — `mrh-license` prefix |
| Route names | `mrh.license.*` | No — `mrh.license` prefix |
| Middleware alias | `mrh.license` | No — `mrh.license` prefix |
| Cache keys | `mrh_license:*` | No — `mrh_license` prefix |
| Published views | `resources/views/vendor/mrh-license/` | No — vendor sub-folder |
| Published key | `storage/mrh-license/public.pem` | No — new sub-folder |

Everything else (the actual PHP classes) lives inside `vendor/mrh/license/`
and is autoloaded — nothing is copied into your app.

---

## STEP 0 — Before you begin

**Exact file path:** *(none — terminal only)*
**Existing or new:** N/A

Open a terminal in your project's root folder (the folder that contains
`artisan`, `composer.json`, and the `app/` directory).

**Screenshot-style explanation:**

```
your-laravel-project/         ← you must be HERE
├── app/
├── artisan                   ← if you see this file, you're in the right place
├── composer.json
├── config/
├── database/
└── routes/
```

Verify with:

```bash
php artisan --version
```

You should see something like `Laravel Framework 12.x.x`. If you get
"command not found," you are in the wrong folder — `cd` into your project root.

---

## STEP 1 — Install the package with Composer

**Exact file path:** `composer.json` (and `composer.lock`)
**Existing or new:** Existing — **Composer edits it for you. Do not edit by hand.**
**Where to insert:** Nowhere manually. Run the command below.

```bash
composer require mrh/license
```

**Screenshot-style explanation:**

```
$ composer require mrh/license
Using version ^1.0 for mrh/license
./composer.json has been updated                ← Composer added the line, not you
Running composer update mrh/license
  - Installing mrh/license (v1.0.0): Extracting archive
Package manifest generated successfully.        ← auto-discovery registered the provider
```

You do **not** need to register the service provider manually — Laravel's
package auto-discovery does it. The line Composer adds looks like this inside
`composer.json` (shown for reference only — **you don't type it**):

```json
"require": {
    "php": "^8.2",
    "laravel/framework": "^12.0",
    "mrh/license": "^1.0"          ← Composer adds this line automatically
}
```

> If you are installing from a local folder or private repo instead of
> Packagist, add the repository first (ask your provider for the exact URL),
> then run the same `composer require`.

---

## STEP 2 — Publish the configuration file

**Exact file path created:** `config/mrh-license.php`
**Existing or new:** **New file** (the package copies it in; it cannot clash
because your app has no file by this name).

```bash
php artisan vendor:publish --tag=mrh-license-config
```

**Screenshot-style explanation:**

```
$ php artisan vendor:publish --tag=mrh-license-config
Copying file [vendor/mrh/license/config/mrh-license.php]
   to [config/mrh-license.php] ..................... DONE
```

After this, your `config/` folder gains ONE new file:

```
config/
├── app.php                ← your existing files, untouched
├── database.php
├── ...
└── mrh-license.php        ← NEW (only file added)
```

---

## STEP 3 — Publish the license server's public key

**Exact file path created:** `storage/mrh-license/public.pem`
**Existing or new:** **New file** in a **new** `storage/mrh-license/` folder.

```bash
php artisan vendor:publish --tag=mrh-license-key
```

**Screenshot-style explanation:**

```
$ php artisan vendor:publish --tag=mrh-license-key
Copying file [vendor/mrh/license/resources/keys/public.pem]
   to [storage/mrh-license/public.pem] ............ DONE
```

> **Important:** Replace the placeholder file with the **real** public key you
> received from your license provider. Open
> `storage/mrh-license/public.pem` in an editor and paste the key between the
> `-----BEGIN PUBLIC KEY-----` / `-----END PUBLIC KEY-----` lines. This is the
> only key the client needs — never place a *private* key here.

---

## STEP 4 — Add your license settings to `.env`

**Exact file path:** `.env`
**Existing or new:** **Existing** — you ADD lines to the bottom. Never delete
existing lines.

**Where to insert:** At the very end of the file, after the last existing line.

**After which line:** After your last variable (commonly the mail or queue
block — it doesn't matter, just append at the end).
**Before which line:** There is nothing after it; it becomes the new last block.

**Code to add:**

```dotenv

# --- MRH License (added by installer) ---
MRH_LICENSE_KEY=PASTE-YOUR-LICENSE-KEY-HERE
MRH_LICENSE_SERVER_URL=https://license.your-provider.com
```

**Screenshot-style explanation** — your `.env` before and after:

```
BEFORE (last lines of your existing .env):
    MAIL_MAILER=smtp
    MAIL_HOST=127.0.0.1
    MAIL_PORT=2525
    ← file ends here

AFTER (you appended the block):
    MAIL_MAILER=smtp
    MAIL_HOST=127.0.0.1
    MAIL_PORT=2525
                                          ← blank line (keep it)
    # --- MRH License (added by installer) ---
    MRH_LICENSE_KEY=PASTE-YOUR-LICENSE-KEY-HERE
    MRH_LICENSE_SERVER_URL=https://license.your-provider.com
```

Then refresh the config cache so Laravel picks up the new values:

```bash
php artisan config:clear
```

> Also add the same two keys (without values) to `.env.example` so teammates
> know they exist. That file is safe to edit the same way — append at the end.

---

## STEP 5 — Run the migrations (create the 4 database tables)

**Exact file path:** *(none — terminal only; tables are created in your DB)*
**Existing or new:** The package's migration files live in
`vendor/mrh/license/database/migrations/` and are loaded automatically. You do
**not** copy them into your `database/migrations/` folder.

```bash
php artisan migrate
```

**Screenshot-style explanation:**

```
$ php artisan migrate
INFO  Running migrations.
  2025_01_01_000001_create_mrh_license_settings_table ......... DONE
  2025_01_01_000002_create_mrh_license_activations_table ...... DONE
  2025_01_01_000003_create_mrh_license_verifications_table .... DONE
  2025_01_01_000004_create_mrh_license_logs_table ............. DONE
```

Only tables starting with `mrh_license_` are created. Your existing tables are
never modified. If you list your tables you will see the four new ones
alongside your own:

```
users
password_reset_tokens
... (your tables) ...
mrh_license_settings          ← new
mrh_license_activations       ← new
mrh_license_verifications     ← new
mrh_license_logs              ← new
```

---

## STEP 6 — (Automatic) The global guard registers itself

**Exact file path:** *(none you edit)*
**Existing or new:** Nothing to edit.

The package automatically adds its guard middleware to your `web` group when it
boots. **You do not touch `bootstrap/app.php` or any Kernel file.**

**Screenshot-style explanation of what happens internally** (for your
understanding only — no action needed):

```
Every web request
      │
      ▼
[ your middleware ] → ... → [ mrh.license guard ]   ← auto-appended to 'web'
      │
      ├─ URI is login / password / assets / mrh-license/*  → allowed through
      ├─ not activated        → redirect to /mrh-license/activate
      ├─ expired / suspended / verification-failed → 403 page
      └─ active / grace       → request continues to your app
```

### Optional: turn the guard OFF while you finish setup

If you want to browse your app before activating (so you're not redirected),
temporarily add this to `.env` (Step 4's file), then `php artisan config:clear`:

```dotenv
MRH_LICENSE_GUARD=false
```

Set it back to `true` (or remove the line) when you're ready to enforce
licensing.

### Optional: apply the guard to specific routes instead of globally

**Exact file path:** `routes/web.php`
**Existing or new:** Existing — you only ADD a wrapper around routes you choose.
**Where to insert:** Around an existing route group of your choosing.

Only do this if you set `MRH_LICENSE_GUARD=false` and want manual control.

**Code to add** (wrap your protected routes):

```php
// After your `use` statements, anywhere in routes/web.php:
Route::middleware('mrh.license')->group(function () {
    // move the routes you want protected inside here
    Route::get('/dashboard', [DashboardController::class, 'index']);
});
```

**Before which line / after which line:** This is a new block you place around
routes you already have. Nothing existing is removed — you move chosen routes
inside the `group(function () { ... })` braces.

---

## STEP 7 — Activate this installation

**Exact file path:** *(none — terminal or browser)*
**Existing or new:** N/A

**Option A — Command line (works everywhere, including servers with SSH):**

```bash
php artisan mrh-license:activate
```

**Screenshot-style explanation:**

```
$ php artisan mrh-license:activate
MRH License: activating installation...
  Installation ID : mrh_9f8c2a1b...             ← generated + stored once
  Server type     : vps
  Domain          : yourdomain.com
  Result          : ACTIVATED                    ← bound to your license
```

**Option B — Browser:** visit

```
https://yourdomain.com/mrh-license/activate
```

You'll see a Bootstrap 5 page. Paste your license key and press
**Activate License**.

**Screenshot-style explanation:**

```
┌───────────────────────────────────────────┐
│               🔑                            │
│        Activate Your License                │
│  This installation is not yet activated.    │
│                                             │
│  License Key                                │
│  ┌───────────────────────────────────────┐ │
│  │ XXXX-XXXX-XXXX-XXXX                    │ │
│  └───────────────────────────────────────┘ │
│  Server type detected: [ vps ]              │
│                                             │
│  [        Activate License        ]         │
└───────────────────────────────────────────┘
```

After success you are redirected to your app's homepage and the guard lets
you through.

---

## STEP 8 — Set up automatic daily verification

The package auto-schedules `mrh-license:verify` to run hourly (it skips itself
when the last check is under 24 hours old). For that schedule to actually fire,
Laravel's scheduler must run. How you do that depends on your hosting — see the
three setups below.

You can always run a check manually:

```bash
php artisan mrh-license:verify          # respects the 24h window
php artisan mrh-license:verify --force  # verify right now
```

**Screenshot-style explanation:**

```
$ php artisan mrh-license:verify
MRH License: verifying...
Verdict: continue — operational.        ← exit code 0
```

---

# Deployment setups

## Localhost setup

**Goal:** develop without any cron.

```bash
php artisan migrate
php artisan mrh-license:activate
```

- Server type auto-detects as `localhost`.
- No scheduler needed — verification runs lazily through the guard on the 24h
  cadence whenever you load a page.
- The installation ID + license state are saved to
  `storage/app/mrh-license.dat` and survive `php artisan migrate:fresh`.

**No files to edit beyond Steps 2–5.**

---

## Shared hosting setup (cPanel / Plesk, no root)

**Goal:** install where you may not have SSH or a real cron.

1. Upload the project (or `git pull`) so the domain's document root points at
   the `public/` folder.
2. Do Steps 2–5 (publish config, publish key, edit `.env`, migrate). If you
   have no SSH, most shared hosts provide a "Terminal" or a way to run
   `php artisan migrate` from the control panel.
3. Activate in the browser: `https://yourdomain.com/mrh-license/activate`.

**Verification without cron:** it runs automatically via the guard every 24
hours on normal traffic — nothing to configure.

**If your host DOES offer cron**, add ONE cron job in the control panel:

**Exact "file":** the host's *Cron Jobs* screen (not a project file).
**Code to add** (the command field):

```
* * * * * cd /home/YOURUSER/yourapp && php artisan schedule:run >> /dev/null 2>&1
```

Replace `/home/YOURUSER/yourapp` with your real path (the control panel usually
shows it). This one line lets the auto-scheduled verification run.

> The installation ID is also mirrored **outside** `storage/`, so it survives
> the storage resets some shared hosts perform on deploy — your binding stays
> stable.

---

## VPS setup (root / full control)

**Goal:** use the scheduler as the primary heartbeat.

```bash
cd /var/www/yourapp
composer install --no-dev --optimize-autoloader
php artisan migrate --force
php artisan mrh-license:activate
```

**Add the Laravel scheduler cron ONCE.**

**Exact file path:** the server's crontab (open with `crontab -e`).
**Existing or new:** Existing system file — you ADD one line at the bottom.
**Where to insert:** On a new line at the end of the crontab.

**Code to add:**

```
* * * * * cd /var/www/yourapp && php artisan schedule:run >> /dev/null 2>&1
```

**Screenshot-style explanation:**

```
$ crontab -e
# (existing cron lines, if any, stay above)
* * * * * cd /var/www/yourapp && php artisan schedule:run >> /dev/null 2>&1
# save and exit (in nano: Ctrl+O, Enter, Ctrl+X)
```

- `mrh-license:verify` then runs hourly, self-skipping inside the 24h window,
  with `withoutOverlapping()` and `onOneServer()` for multi-server setups.
- License state is not hardware-derived, so it survives resizing the VPS.
- To move to a new server, run `php artisan mrh-license:reset` on the old one
  first to release the binding.

---

# Verifying the installation worked

Run:

```bash
php artisan mrh-license:status
```

**Screenshot-style explanation:**

```
$ php artisan mrh-license:status
Status           : active
Activated        : yes
Installation ID  : mrh_9f8c2a1b...
Server type      : vps
Domain           : yourdomain.com
Expires at       : 2027-01-01T00:00:00+00:00
Last verified at : 2026-07-09T10:00:00+00:00
```

Or open the JSON endpoint in a browser / with curl:

```bash
curl https://yourdomain.com/mrh-license/api/status
```

---

# Uninstalling cleanly (if ever needed)

Because everything is prefixed, removal is clean and leaves your app intact:

```bash
# 1. Release the license binding
php artisan mrh-license:reset

# 2. Remove the package
composer remove mrh/license

# 3. (optional) drop the 4 tables and delete the published files
#    - config/mrh-license.php
#    - storage/mrh-license/
#    - resources/views/vendor/mrh-license/  (only if you published views)
#    - the two .env lines
```

No existing file of yours was ever modified by the package itself (only the
small snippets **you** added in Steps 4 and, optionally, 6).

---

# Quick reference — everything the package names

| Thing | Value |
|---|---|
| Composer package | `mrh/license` |
| Namespace | `Mrh\License\` |
| Config | `config/mrh-license.php` |
| Tables | `mrh_license_settings`, `mrh_license_activations`, `mrh_license_verifications`, `mrh_license_logs` |
| Commands | `mrh-license:activate`, `mrh-license:verify`, `mrh-license:status`, `mrh-license:reset` |
| Route prefix | `/mrh-license` (names `mrh.license.*`) |
| Middleware alias | `mrh.license` |
| Cache keys | `mrh_license:*` |
| Published key | `storage/mrh-license/public.pem` |
| Published views | `resources/views/vendor/mrh-license/` |
| Env vars | `MRH_LICENSE_KEY`, `MRH_LICENSE_SERVER_URL`, `MRH_LICENSE_GUARD`, … |
