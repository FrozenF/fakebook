To Run This Project

Server Requirement:
1. PHP v7.2 or newer
2. Compose
3. MySQL Server

Setup :
1. Create Empty Database
2. run composer install in this project root directory
3. copy .env.example as .env
4. edit .env file  DB_DATABASE with name of database that you created
5. do command "php artisan key:generate"
6. Then migrate the database table "php artisan migrate"
7. Then run server "php artisan serve"
8. Open Browser "http://localhost:8000"

If you have any trouble, contact me.

