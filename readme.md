# Angular - Laravel Contacts App

### Download instructions:

1. git clone https://github.com/msalom28/contactsapp.git projectname
2. composer install
3. npm install
4. Go inside root folder and rename the .env.example file to .env 
5. run php artisan key:generate
6. create a database for the app using mysql called contactapp
5. Update .env variables:

DB_DATABASE=contactapp		
DB_USERNAME=root
DB_PASSWORD=yourpassword

6.run php artisan migrate --seed
7.Run php artisan serve
8.You are good to go!

## Instructions for testing

You must truncate your tables before running tests. 

1.run php artisan migrate:refresh
2.run phpunit
