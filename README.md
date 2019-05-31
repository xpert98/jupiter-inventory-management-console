# Jupiter Inventory Management Console
The Jupiter Inventory Management Console is a client for instances of the Jupiter Collector Service and the Jupiter Curated Inventory Service.

## Prerequisites
* PHP 7 or greater
* PostgreSQL 10 or greater
* nginx or Apache web server
* Running instances of the Jupiter Collector Service and the Jupiter Curated Inventory Service

## Database Setup
SQL commands necessary to set up tables in the schema are included in jmc.sql.  The script assumes the database user name to be "jupiter" so change that to suit the authentication set up for your database.

## Configuring the Inventory Management Console
First, copy all files from the src directory to the web server document root and then start the web server.

Next, navigate to http(s)://<host>/setup.php.  There, you will be provided with a randomly generated secret key and initialization vector that is used by the application to encrypt some data fields in its database.  
  
This is where you can also create a new user.
  
NOTE: Once you save the encryption key and initialization vector for the next step and create a new user, it is best to remove the setup.php file from the web server's document root.

## Running the Inventory Management Console
Set environment variables for the following:

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

For more information about setting Apache environment variables:
https://medium.com/@william.b/setting-dynamic-environmental-variables-in-apache-from-the-os-1d5c1e2e9e6c

Once everything is in place, simply restart the web server and navigate to http(s)://<host>/index.php
