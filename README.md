# Ci4 Blog

This is simple blog app, made with [CodeIgniter4](http://codeigniter.com) framework and bootstrap5 html theme [Clean Blog](https://startbootstrap.com/theme/clean-blog). It has authentication, posts crud, pagination, server side datatables, email sending, populating fake data and admin dashboard etc., new features will be implemented soon.

More information about [CodeIgniter 4](http://codeigniter.com) framework can be found [here](https://codeigniter4.github.io/userguide/).

## Server Requirements

PHP version 7.3 or higher is required, with the following extensions installed:

- [intl](http://php.net/manual/en/intl.requirements.php)
- [libcurl](http://php.net/manual/en/curl.requirements.php) if you plan to use the HTTP\CURLRequest library

Additionally, make sure that the following extensions are enabled in your PHP:

- json (enabled by default - don't turn it off)
- [mbstring](http://php.net/manual/en/mbstring.installation.php)
- [mysqlnd](http://php.net/manual/en/mysqlnd.install.php)
- xml (enabled by default - don't turn it off)

If any issues in installation visit this page 
- Make sure you have met all the server requirements mentioned [here](https://codeigniter.com/user_guide/intro/requirements.html).

## Installation instructions

- Clone the repository with, `$ git clone https://github.com/HariK77/ci4-blog.git`.
- run `$ cd ci-4-blog`. 
- run `$ composer install`.
- run `$ sudo chmod -R 0777 writable/` (no need for windows xampp). 
- run `$ cp .env.example .env` (In windows just rename the file manually).
- configure db connections and base url in .env (change base url to `http://localhost/ci4-blog/public` in App.php also).
- configure mail configuration in .env file, I'm using [maitrap](https://mailtrap.io) it provides free service for sending emails from localhost, login and get SMTP Settings and set `app.mail.smtpUser`, `app.mail.smtpPass`.
- Note: even if you don't set `app.mail.smtpUser`, `app.mail.smtpPass`, app will work, but u won't be able to check some email related functionalities.
- set database configurations in .env and create a db named `ci4_blog`.
- create database and run `$ php spark migrate`.
- create dummy data in user table with `$ php spark db:seed UserSeeder`.
- create dummy data in category table with `$ php spark db:seed CategorySeeder`.
- create dummy data in posts table with `$ php spark db:seed PostSeeder`.
- Open `http://localhost/ci4-blog/public` to make sure, whether it is working.

## How to use the application

- Admin User Credentials: <br>
    Username: `admin@admin.com`<br>
    Password: `admin@123`

