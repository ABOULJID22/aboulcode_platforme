# PHP 8.3 Migration Plan

## Goal
Move the Windows/XAMPP stack to PHP 8.3 for both CLI and Apache, then restore `laravel/ai` without breaking the current Laravel application.

## Current State
- CLI PHP is currently 8.2.12.
- `composer.json` is still pinned to `php: ^8.2`.
- `laravel/ai` is not installed right now because it requires PHP 8.3+.
- The app boots successfully on the current runtime.

## Safe Order
1. Install PHP 8.3 alongside the existing XAMPP PHP 8.2.
2. Switch CLI to PHP 8.3 and verify `php --version`.
3. Switch Apache to PHP 8.3 and verify a browser `phpinfo()` page.
4. Confirm required extensions are enabled.
5. Update `composer.json` back to PHP 8.3 and reinstall dependencies.
6. Re-add `laravel/ai` and run Composer update.
7. Clear Laravel caches and run the test suite.

## Windows/XAMPP Checklist

### 1. Prepare PHP 8.3
- Keep the current XAMPP PHP 8.2 install untouched as rollback.
- Install or extract PHP 8.3 in a separate folder.
- Make sure `php.ini` includes the extensions used by Laravel:
  - `curl`
  - `mbstring`
  - `openssl`
  - `pdo_mysql`
  - `xml`
  - `zip`
  - `gd`
  - `intl`

### 2. Switch CLI
- Update Windows `PATH` so the PHP 8.3 folder comes before the PHP 8.2 folder.
- Reopen the terminal.
- Confirm:
  - `php --version`
  - `php --ini`

### 3. Switch Apache
- Update the XAMPP Apache/PHP wiring to point to PHP 8.3.
- Restart Apache.
- Verify the served PHP version from the browser.

### 4. Update Project Dependencies
- Change `composer.json`:
  - `php` from `^8.2` to `^8.3`
  - add `laravel/ai` back to `require`
- Run:
  - `composer update`
  - `composer dump-autoload`
  - `php artisan optimize:clear`

### 5. Validation
- Run:
  - `php artisan about`
  - `php artisan test --compact`
  - `composer validate --no-check-publish`
- Open the app and confirm the AI-backed orientation page still renders.

## Rollback Plan
- If anything breaks, restore Apache/CLI to PHP 8.2.
- Keep the old `composer.lock` only if the PHP 8.3 migration is abandoned.
- Do not mix PHP 8.2 runtime with a lock file that requires PHP 8.3.

## Recommended Next Action
First verify the PHP 8.3 binaries and Apache wiring, then update Composer only after both runtimes are confirmed.