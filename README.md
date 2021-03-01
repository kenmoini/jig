# Jig - Workshop Service Worker

![Deploy to DigitalOcean Kubernetes](https://github.com/kenmoini/jig/workflows/Deploy%20to%20DigitalOcean%20Kubernetes/badge.svg?branch=main)

This is a PHP application built to provide advanced functionality to Red Hat workshops.

By default when run locally it operates via a SQLite database stored locally.  The database can easily be switched to any other relational database with the setting of a few variables.  When operating on Kubernetes/OpenShift, there are assets and the default configuration to support a MySQL database.

Cache and sessions are also stored in the associated database.

Does not require but is enhanced by mail functionality, default provider is set to SendGrid - many other options such as SMTP are available.

Email verifications for account registrations are disabled as a default because Red Hat spam filters are mean...can be enabled by setting a `SEND_USER_REGISTRATION_CONFIRMATION` configuration variable.

## What is Jig?

Jig is the back-end service that allows workshop proctors to easily set up and provide seamless workshop student experiences.

A Workshop Proctor will log into Jig and create an Event.  That Event has all the needed student workshop details such as what Domain, Workshop ID, and Student User ID Numbers are auto-assigned and monitored as they progress through the workshops.Those 3 details (Domain, Workshop ID, pointing and numbering workshop participants with a User ID usually would take a substantial amount of time and cause a lot of confusion.

Monitoring student activity is based on the front-end workshop curriculum, like that found at https://redhatgov.io - no special work is required on the curriculum authors or the workshop architects.

## Why Jig?

The name Jig came from well, wood jigs where one could take a template and an uncut medium, and punch in holes at the right places at the right angles with the right tools.  So, Jig helps take the uncut curriculum, and punches in the bits with the right domain, workshop ID, and user ID...whatever, names are dumb.

## Functions

- Provides metadata and operations around Red Hat workshops via a RESTful API - info on workshops, deployment, procturing, etc
- Allows students to "log in" and access workshops assets without being assigned numbers or passing of complicated details - automatically configures workshop curriculum with just a Name, Email, and Workshop Event ID.
- Gather metadata around student interactions on the workshop platform (which pages, time, etc) [on page load track UA, referer, page, time, user ID, etc]
- Domain validation only allows panel user registration from redhat.com and polyglot.ventures (found in the Validation Rule `app-src/app/Rules/IsAllowedDomain.php`)

## How to use

### Deploy Natively

To deploy locally on your own development machine, you need:

- PHP 7.3+
- Composer
- Node/NPM

To start from a fresh Fedora machine:

```bash
dnf update -y
dnf install -y httpd php php-zip php-mysqlnd php-mcrypt php-xml php-mbstring php-gd php-json php-bcmath php-cli php-sodium mariadb-server composer unzip nodejs git firewalld fail2ban certbot certbot-apache
systemctl start mariadb.service
systemctl enable mariadb.service
mysql -u root
mysql> CREATE DATABASE jigdb; exit
mysql_secure_installation

systemctl start httpd
systemctl enable httpd

systemctl start firewalld
systemctl enable firewalld

firewall-cmd --permanent --add-service=http
firewall-cmd --permanent --add-service=https
firewall-cmd --permanent --add-service=ssh
firewall-cmd --reload

cd /var/www

git clone https://github.com/kenmoini/jig
mv jig jig.polyglot.academy

chown apache:apache -R jig.polyglot.academy
chmod 775 -R jig.polyglot.academy/app-src/storage

setsebool -P httpd_can_network_connect 1
semanage fcontext -a -t httpd_sys_rw_content_t "/var/www/jig.polyglot.academy(/.*)?"
chcon -t httpd_sys_rw_content_t -R /var/www/jig.polyglot.academy
restorecon -R -v /var/www/jig.polyglot.academy

rm /etc/httpd/conf.d/ssl.conf

certbot --apache
echo "0 0,12 * * * root python -c 'import random; import time; time.sleep(random.random() * 3600)' && certbot renew -q" | sudo tee -a /etc/crontab > /dev/null

cd jig.polyglot.academy

```

```bash
cd app-src/
composer install
npm install
npm run dev
cp .env.example .env # Modify to suit your needs
touch db.sqlite # or use the MariaDB as done in a fresh set up
php artisan key:generate
composer dump-autoload
php artisan initial-setup:run
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

#### Initial Setup

When deployed as a container, the `/opt/start.sh` file which executes the container-bound process will call `php artisan initial-setup:run` and will handle Migrations, Initial Admin User Generation, and Database Seeding gracefully.

#### Configuring the Container

There are a number of environmental variable that can be set on container start:

| Variable [optional]          | Default                | Description                                                                                                                                                                          |
|------------------------------|------------------------|--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|
| COPY_ENV_FILE                | true                   | Copies the `.env.example` file to `.env`                                                                                                                                             |
| COPY_ENV_FILE_FROM_CONFIGMAP | false                  | Copies the `/var/html/data/.env` file provided by a ConfigMap to `.env`                                                                                                              |
| GENERATE_ENV_KEY             | true                   | Generates a new application key in the .env file                                                                                                                                     |
| GENERATE_SHOW_NEW_ENV_KEY    | false                  | Generates a new application key and prints without setting                                                                                                                           |
| GENERATE_SQLITE_DB           | true                   | Generates a SQLite DB File to use                                                                                                                                                    |
| [ADMIN_USER_NAME]            | 'Administrator'        | Initial Admin User's Name                                                                                                                                                            |
| [ADMIN_USER_EMAIL]           | 'admin@admin.com'      | Initial Admin User's Email                                                                                                                                                           |
| [ADMIN_USER_PASSWORD]        | Random or 'Passw0rd1!' | Initial Admin User's Password, if not set then password will be randomly generated and saved to app-src/storage/app/generated_admin_password if path is writable, defaults otherwise |

Augment the deployment of the container as such:

```bash
podman run -e SEED_INITIAL_ADMIN=false -e SEED_DATABASE=false -p 8080:8080 jig
```

### Deploy to Kubernetes

Located in the `kubernetes/` directory, you'll find a number of manifests.  The first set will create the needed resources to deploy Jig, another set will deploy a single instance stateful mySQL instance to use with Jig.

By default, deploying to Kubernetes means Jig does not use the SQLite Database file in the container and instead needs a persistent database store.  You ***can*** use a PV for the SQLite DB, but I'd recommend just using a normal relational DB.  Thankfully, the manifests for deploying mySQL for Jig are also provided!

***Note:*** I would suggest modifying the manifest files and setting a more secure DB Pasword...

```bash
## Create namespace
kubectl apply -f kubernetes/01-namespace.yaml
## Deploy mySQL (optional, skip if you are using another DB)
kubectl apply -f kubernetes/02-mysql-pv.yaml
kubectl apply -f kubernetes/03-mysql-deployment.yaml
kubectl apply -f kubernetes/04-mysql-services.yaml
## Modify this before proceeding - such as rotating the application key!
kubectl apply -f kubernetes/05-configmap.yaml
## Modify the ENV variables on the container to meet your needs - on first deployment, change the migration and seeds to "true" then reapply the deployment with it set to "false".
### Maybe even set GENERATE_SHOW_NEW_ENV_KEY to "true" on first deployment to generate a new Application Key, look in your logs on container start for the new key, then replace in your ConfigMap...
kubectl apply -f kubernetes/06-deployment.yaml
kubectl apply -f kubernetes/07-service.yaml
## Modify to meet your domain that will serve the application externally.  Assumes there is an Ingress Controller and cert-manager for SSL.
kubectl apply -f kubernetes/08-ingress.yaml
```

## Deploy using kustomize 
**Validate**
```
kustomize build deploy/overlay/kubernetes/ | more
```

### Deploy to kubernetes

**Deploy**
```
kustomize build deploy/overlay/kubernetes/ | kubectl create -f -
```

### Deploy to OpenShift
**Validate**
```
kustomize build deploy/overlay/openshift/ | more
```

**Deploy**
```
kustomize build deploy/overlay/openshift/ | oc create -f -
```