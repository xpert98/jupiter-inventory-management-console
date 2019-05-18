# Jupiter Inventory Management Console
The Jupiter Inventory Management Console is a client for instances of the Jupiter Collector Service and the Jupiter Curated Inventory Service.

## Prerequisites
* PHP 7 or greater
* PostgreSQL 10 or greater
* nginx or Apache web server
* Running instances of the Jupiter Collector Service and the Jupiter Curated Inventory Service

## Database Setup
SQL commands necessary to set up tables in the schema are included in db.sql.  The script assumes the database user name to be "jupiter" so change that to suit the authentication set up for your database.

## Running the Inventory Management Console
First, set environment variables for the following:

* JUPITER_DB_HOST
* JUPITER_DB_SCHEMA
* JUPITER_DB_USER
* JUPITER_DB_PASSWORD
* SECRET_KEY
* SECRET_IV

For example:

```
JUPITER_DB_HOST=localhost

JUPITER_DB_SCHEMA=jupiter

JUPITER_DB_USER=postgresqluser

JUPITER_DB_PASSWORD=Password123!

SECRET_KEY='l33ts3cr3tk3yl33ts3cr3tk3yl33ts3cr3tk3yl33ts3cr3tk3yl33ts3cr3tk3yl33ts3cr3tk3y'

SECRET_IV='l33ts3cr3tiv'

```

Next, Copy files from the src directory to the web server document root.

Once everything is in place, simply start the web server.
