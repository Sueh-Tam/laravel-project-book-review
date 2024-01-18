About the project:
<br>
<br>
My web application, built with Laravel, PHP, and MySQL, serves as an interactive platform for book enthusiasts. It’s a comprehensive book review system where users can explore a vast library of books, each detailed with the book’s title and author information. This data is efficiently populated using Laravel’s seeder functionality.<br>

The application offers a unique feature where users can view reviews for a specific book, providing them with diverse perspectives before they dive into reading. Each review is a thoughtful critique, with a minimum character limit of 15 to ensure quality and meaningful feedback. If a review doesn’t meet this requirement, the application smartly triggers an error message, guiding users to enrich their reviews.<br>

Moreover, users can contribute to the community by creating new reviews. They can share their insights and rate the books on a scale<br>

How to build the project:<br>

To build this project, you will need to have PHP and MySQL installed on your machine.;<br>
Copy the file named **.env.example** and paste it, rename the file to **.env**, and make this changes:<br>
1º - put the name of the database in the DB_DATABASE=<br>
2º - put the username in the DB_USERNAME=<br>
3º - put the password of the database in the DB_PASSWORD=<br>
<br>
After that, run the commands bellow in the main project: <br>
1º **composer install**<br>
2º **composer dump-autoload**<br>
3º **php artisan config:clear**<br>
4º **php artisan cache:clear**<br>
5º **php artisan migrate**<br>
6º **php artisan db:seed**<br>
7º **php artisan serve**<br>
