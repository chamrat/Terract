## Terract Application

This application is developed to manage properties and tenants by landlords or brokers.
Below are the steps to set up it in a new environment.

- Clone the code from GitHub.
- Run **composer install** command to pull core laravel code.
- Create a database in MySQL server and do the configuration in **.env** file in the source root.
- Run **php artisan migrate --seed** command to install the database.
- Configure Hosting stuff and you are good to load the new app from browser now.
- If you have not setup Hosting and need to load the app on local, run **php artisan serve** command and then you can load the site on [http://localhost:8000](http://localhost:8000) Url.

## Troubleshoot

- If **php artisan db:seed** seems not working, please run **composer dump-autoload** and re-run the seed command
