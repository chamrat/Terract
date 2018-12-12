## Terract Application

This application is developed to manage properties and tenants by landlords or brokers.
Below are the steps to set up it in a new environment.

- Clone the code from GitHub.
- Run **composer install** command to pull core laravel code.
- Create a database in MySQL server and do the configuration in **.env** file in the source root.
- Run **php artisan migrate --seed** command to initialize the database.
- Configure your local server using Apache or your preferred web server and you should be ready to load this Laravel based application.
- Run **php artisan serve** command, then load the site on your local host which in most cases is [http://localhost:8000](http://localhost:8000) URL.

## Troubleshoot

- If **php artisan db:seed** seems not working, please run **composer dump-autoload** and re-run the seed command
