# Eventeny Assessment

## About the project
<p>
PHP Vanilla project with JQuery to create application for a event.
</p>

## Getting Started

### Prerequisites

1. Docker
2. PHP 8.2
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

1. Run in your terminal `docker-compose up --build --watch`
2. Go to your browser: `localhost:8001` and login to your DB
3. Go to enventeny's squema -> SQL. copy and paste `app/db/sql.sql` and run clicking `Go` Button
