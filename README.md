# Eventeny Assessment

## About the project
<p>
PHP Vanilla project with JQuery to create application for a event.
</p>

## Getting Started

### Prerequisites

1. Docker
3. composer
4. Rename `app/web.env.example` to `app/web.env`. Enter your API and db credentials in `app/web.env`
   ```web.env
    APP_ENCRYPTION_KEY=xz9KI60xQWvppyBG0j8Zs6xxjOF3OVYw0s1WsoAJJeN6xwzjbRUc

    MYSQL_HOST=eventenyMysql
    MYSQL_PORT=3306
    MYSQL_USER=root
    MYSQL_ROOT_PASSWORD=password
    MYSQL_DATABASE=eventeny

   ``` 

5. Rename `app/db.env.example` to `app/db.env`. Enter your Database credential in `app/db.env`
   ```db.env
    MYSQL_HOST=localhost
    MYSQL_USER=root
    MYSQL_ROOT_PASSWORD=password
    MYSQL_DATABASE=eventeny
   ``` 

## Usage

1. In your temrminal go to the project folder then go app folder and run `composer install`
2. Run in your terminal `docker-compose up --build --watch`
3. Go to your browser: `http://localhost:8001/` and login to your DB
4. Go to enventeny's squema -> SQL. copy and paste `app/db/sql.sql` and run clicking `Go` Button
5. Go to your browser: `http://localhost1/` and login with:
   ### Organizer
   - email: neil_saenz@yahoo.com
   - password: password
   ### Vendor
   - email: neil_saenz@vendor.com
   - password: password
