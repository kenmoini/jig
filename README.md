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
php artisan db:seed --class=AdminUserSeeder #optional, or create a user before seeding
php artisan db:seed
```

Set your HTTP server root to the `public/` sub-directory.  Oe run `php artisan serve`


### Deploy as a Container

The included Dockerfile builds in a Red Hat Universal Basic Image that includes Apache, PHP, and NodeJS.

You can build the container locally:

```bash
podman build -t jig .
podman run -p 8080:8080 jig
```

Alternatively, you could also just use the pre-build image:

```bash
podman pull kenmoini/jig:latest
podman run -p 8080:8080 jig
```

Navigate to `http://localhost:8080` to view the site.

#### Configuring the Container

There are a number of environmental variable that can be set on container start:

| Variable           | Default | Description                                                               |
|--------------------|---------|---------------------------------------------------------------------------|
| COPY_ENV_FILE      | true    | Copies the `.env.example` file to `.env`                                  |
| GENERATE_ENV_KEY   | true    | Generates a new application key in the .env file                          |
| GENERATE_SQLITE_DB | true    | Generates a SQLite DB File to use                                         |
| MIGRATE_DATABASE   | true    | Runs Database Migrations                                                  |
| SEED_INITIAL_ADMIN | true    | Seeds the database with initial Admin user (admin@admin.com / Passw0rd1!) |
| SEED_DATABASE      | true    | Seeds the database with Workshops and their needed Assets                 |

Augment the deployment of the container as such:

```bash
podman run -e SEED_INITIAL_ADMIN=false -e SEED_DATABASE=false -p 8080:8080 jig
```

### Deploy to Kubernetes

### Deploy to OpenShift