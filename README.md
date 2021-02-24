## Introduction

Tek Tonik is a fictional, technology based e-commerce site built using Laravel on the back end and VueJs on the front. A live demo can be found [here](https://tek-tonik.dependabledev.com/products). The visitor can browse a range of products, create an account and checkout using the Stripe api. They will then receive an email notification of their purchase and a dashboard is provided to keep track of orders in addition to other user information.

### Database

The database used was mysql and a 'Enhanced Entity Relational' diagram was created in Mysql Workbench to ensure the application was built on a strong foundation from the outset. You will find a png file of the diagram and the file itself (.mwb) in the top level directory.

## Installation

To use your own version of the application you will need to have some kind of LAMP stack environment. It just so happens you can find one here [Obeedock](https://github.com/SteveObee/obeedock) ;). Once you have that setup you can clone or download this repository then change directory into it.

### .env file

To get the application working you will need to change the name of env-example to .env:

```bash
mv env-example .env # linux command line example
```

Afterwards you'll need to first generate an application key using:

```bash
php artisan key:generate
```

then add your own values to the following variables in the .env file:

```bash
DB_DATABASE=
DB_USERNAME=
DB_PASSWORD=

MAIL_HOST=
MAIL_USERNAME=
MAIL_PASSWORD=
MAIL_FROM_ADDRESS=
MAIL_FROM_NAME=
MAIL_ADMIN_ADDRESS=

STRIPE_KEY=
STRIPE_SECRET=

MASTER_EMAIL=
MASTER_PASSWORD=
```

The database values will be environment specific and the mail values can be populated with those from your own mail server solution. Stripe API values will need to be obtained from their site after registration and I recommend reading the documentation to understand what's going on. Finally the master email and password variables will create a user for the application upon seeding, which can be initiated with this command:

```bash
php artisan migrate:fresh --seed
```

### Sanctum

Sanctum is fully implemented but if your having trouble when serving the site you may need to add your domain to the following variable after a comma:

```bash
SANCTUM_STATEFUL_DOMAINS: localhost:3000
```

I have provided localhost:3000 as I use browsersync when developing.
