# Jig - Workshop Service Worker

This is a PHP application built to provide advanced functionality to Red Hat workshops.

By default it operates via a SQLite database stored locally.  The database can easily be switched to any other relational database with the setting of a few variables.

Cache and sessions are also stored in the associated database.

Requires mail functionality, default provider is set to SendGrid - many other options such as SMTP are available.

## Functions

- Provides metadata and operations around Red Hat workshops - info on workshops, deployment, procturing, etc
- Allows students to "log in" and access workshops assets without being assigned numbers or passing of complicated details - automatically configures workshop curriculum with just a Name, Email, and Workshop Event ID.
- Gather metadata around student interactions on the workshop platform (which pages, time, etc) [on page load track UA, referer, page, time, user ID, etc]
- Domain validation only allows panel user registration from redhat.com and polyglot.ventures

## How to use


### Deploy Natively

```bash
cd app-src/
composer install
npm install
npm run dev
cp .env.example .env
touch db.sqlite
php artisan key:generate
php artisan migrate
composer dump-autoload
php artisan db:seed --class=WorkshopSeeder
php artisan db:seed --class=AssetSeeder
```

Set your HTTP server root to the `public/` sub-directory.  Oe run `php artisan serve`


### Deploy as a Container

### Deploy to Kubernetes

### Deploy to OpenShift