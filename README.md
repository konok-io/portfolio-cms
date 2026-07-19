# MRH License (Laravel 12 Client Package)

Reusable licensing client for the **MRH / Saudi License Server**. Drop it into
any Laravel 12 project to add activation, signed daily verification, domain &
installation binding, a 7-day grace period, and a global route-independent
guard with Bootstrap 5 state pages — without wiring anything into the host
app's routes.

---

## How it works

The client never validates a license itself. It calls your license server and
**verifies the RSA-4096 signature** on every response with a bundled public
key, so a spoofed network or tampered cache cannot forge a valid verdict.

```
Request → EnsureLicenseValid → local status
   ├─ active / grace          → continue
   ├─ pending (not activated)  → redirect to license/activate
   ├─ expired                  → Expired page (403)
   ├─ suspended (blocked)      → Suspended page (403)
   └─ verification_failed      → Verification-Failed page (403)
```

- **24-hour verification cache** — a signed verdict is trusted for a day;
  within the window the server is not contacted.
- **7-day grace period** — if the server is unreachable, the app keeps running
  for 7 days, then locks with `verification_failed`.
- **Fail-open on transport, fail-closed on signed denial** — an unsigned 403 is
  ignored; a *signed* kill/expire/deny is obeyed at once.

---

## Configuration file

> **Note on naming.** The package config is **`config/mrh-license.php`**, not
> `config/license.php`. This is deliberate: the license *server* already ships
> a `config/license.php`, and a client installed alongside server code (or any
> app with its own `license.php`) must not collide. All keys are documented
> inside the published file. Set values via the `MRH_LICENSE_*` env vars below.

Publish it with:

```bash
php artisan vendor:publish --tag=mrh-license-config
```

### Environment variables

| Variable | Default | Purpose |
|---|---|---|
| `MRH_LICENSE_KEY` | — | License key for this installation |
| `MRH_LICENSE_SERVER_URL` | — | Base URL of the license server |
| `MRH_LICENSE_PUBLIC_KEY` | published path | Path to the RSA public key |
| `MRH_LICENSE_CACHE_TTL` | `24` | Verification window (hours) |
| `MRH_LICENSE_GRACE_DAYS` | `7` | Grace period (days) |
| `MRH_LICENSE_GUARD` | `true` | Master switch for the global guard |
| `MRH_LICENSE_SCHEDULE` | `true` | Auto-schedule `license:verify` |
| `MRH_LICENSE_SCHEDULE_CRON` | hourly | Optional custom cron expression |
| `MRH_LICENSE_EXPIRED_POLICY` | `block` | Behaviour past grace |
| `MRH_LICENSE_WIZARD` | `false` | Enable optional wizard extras |

---

## Installation steps

```bash
# 1. Require the package
composer require mrh/license

# 2. Publish config + public key
php artisan vendor:publish --tag=mrh-license-config
php artisan vendor:publish --tag=mrh-license-key

# 3. (optional) publish the Bootstrap 5 views to customise them
php artisan vendor:publish --tag=mrh-license-views

# 4. Run migrations (creates license_settings, activations, verifications, logs)
php artisan migrate

# 5. Configure .env
#    MRH_LICENSE_KEY=...
#    MRH_LICENSE_SERVER_URL=https://license.example.com

# 6. Activate this installation
php artisan license:activate
#    ...or visit /license/activate in the browser
```

The global guard auto-registers on the `web` middleware group — no route
changes needed. Login, password-reset, asset, and `license/*` URIs are
excluded so users are never locked out of activating or signing in.

---

## Endpoints & commands

| Route | Purpose |
|---|---|
| `GET  /license/activate` | Bootstrap 5 activation page |
| `POST /license/activate` | Submit a license key |
| `GET  /license/api/status` | JSON status snapshot |
| `POST /license/api/verify` | Trigger a verification (JSON) |
| `POST /license/api/reset` | Release this installation's binding (JSON) |

| Command | Purpose |
|---|---|
| `license:activate` | Bind this installation |
| `license:verify [--force]` | Signed heartbeat (auto-scheduled) |
| `license:status` | Show local status |
| `license:reset` | Release binding + clear local state |

---

## Deployment guide

The package supports three environments. The difference is only in **how
verification is triggered**; the licensing logic is identical.

### Localhost setup

For local development the server type is auto-detected as `localhost`.

```bash
php artisan migrate
php artisan license:activate       # dev activation, no domain slot consumed
```

No cron is needed: verification runs lazily through the guard on the 24-hour
cadence whenever you hit the app. The installation ID and license state persist
in `storage/app/mrh-license.dat`, so they survive `php artisan migrate:fresh`.

### Shared hosting setup

Shared hosts often lack a real scheduler and reset `storage/` on deploy. The
package is built for this:

1. Upload the project; point the domain's document root at `public/`.
2. Set `MRH_LICENSE_*` values in `.env`.
3. Run `php artisan migrate` (via SSH or the host's terminal).
4. Activate at `https://yourdomain.com/license/activate`.

**Verification** happens lazily via the guard (every 24h on a real request),
so a cron entry is optional. If your host *does* offer cron, add:

```
* * * * * cd /home/USER/app && php artisan schedule:run >> /dev/null 2>&1
```

The installation ID is mirrored to a file **outside** `storage/` as well, so it
survives storage resets and keeps the same binding across deploys.

### VPS setup

Full control — use the scheduler as the primary heartbeat.

```bash
git clone ... && cd app
composer install --no-dev --optimize-autoloader
php artisan migrate --force
php artisan license:activate
```

Add the single Laravel scheduler cron (once):

```
* * * * * cd /var/www/app && php artisan schedule:run >> /dev/null 2>&1
```

`license:verify` is auto-scheduled hourly (it self-skips inside the 24h
window), with `withoutOverlapping()` and `onOneServer()` for multi-node setups.
The license state is not hardware-derived, so it survives instance resizing;
to move hosts, run `php artisan license:reset` first to release the binding.

---

## Security notes

- Only the **public** key ships with the client. Never commit the server's
  private key.
- The generated installation ID and `mrh-license.dat` are git-ignored; do not
  commit them or the same binding will be shared across installs.
- Local endpoints authorize to `true` by default — protect `license/api/*`
  (especially `reset`) behind your admin middleware in production.
