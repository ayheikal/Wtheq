

-------------------------------------------------------------------------



# Laravel Project

This project is a web application built with Laravel framework v9. It utilizes XAMPP as the local development environment and incorporates APIs for data retrieval.

## Prerequisites

Before getting started, make sure you have the following installed on your machine:

- XAMPP: [Download and Install XAMPP]install XAMPP for Windows 8.0.28 (https://www.apachefriends.org/index.html)
- Composer: [Download and Install Composer](https://getcomposer.org/download/)

## Installation

1. Clone the repository to your local machine:
   ````bash
   git clone https://github.com/your-username/your-project.git
   ```

2. Navigate to the project directory:
   ````bash
   cd your-project
   ```

3. Install the project dependencies using Composer:
   ````bash
   composer install
   ```

4. Create a copy of the `.env.example` file and rename it to `.env`:
   ````bash
   cp .env.example .env
   ```
change .env variables 

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=task // the database u created on phpmyadmin
DB_USERNAME=root // the database user name and default is root
DB_PASSWORD= // the data baseuser password and default is empty


5. Generate the application key:
   ````bash
   php artisan key:generate
   ```

6. Configure the database settings in the `.env` file according to your local setup.

7. Run the database migrations to create the required tables:
   ````bash
   php artisan migrate
   php artisan optimize 
   composer dump-autoload

   ```

-- php artisan jwt:secret

for more info visit https://jwt-auth.readthedocs.io/en/develop/laravel-installation


8. Start the local server using the XAMPP control panel or by running the following command:
   ````bash
   php artisan serve
   ```

9. Access the application in your web browser at `http://localhost:8000`.

## APIs

This project integrates external APIs for data retrieval. To use these APIs, follow these steps:

1. Obtain API credentials from the respective service providers.

2.open routes/api.php file and pickup ebdpoint example : 
http://127.0.0.1:8000/api/v1.0/products
http://127.0.0.1:8000/api/v1.0/users


