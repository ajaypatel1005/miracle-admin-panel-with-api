steps

Install all the dependencies using composer 
composer install

Install all node module packages npm install npm run dev

Generate a new application key if required php artisan key:generate

Make sure you set the correct database connection information before running the migrations php artisan migrate php artisan serve

Run the database seeder and you're done
php artisan db:seed


Postman API URL By Admin

http://127.0.0.1:8000/api/admin/login
Login
email:admin@gmail.com
Password:12345678
Get Users list
http://127.0.0.1:8000/api/admin/users
set authorization Bearer token in headers and hit the URL so we getting all users list

Postman URL By User
http://127.0.0.1:8000/api/user/login
Login
email:abc@gmail.com
Password:12345678

Get Profile
http://127.0.0.1:8000/api/user/profile
set authorization Bearer token in headers and hit the URL so we getting current user profile details
