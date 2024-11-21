# PRMS (Patient Record Management System)

## System Description
[pending description of PRMS]

---

## Project Setup
### Step 1: Clone the Repository
- To begin, clone the PRMS repository from GitHub:
    ```bash
    git clone https://github.com/AltheaEHEM1/COMMITS-RDT.git
    ```

### Step 2: Configure the Environment
- Rename the `.env.example` file to `.env` by simply right-click and rename or by running the following command in Terminal:
    ```cmd
    ren .env.example .env
    ```
- Uncomment and update the following database settings in the `.env` file to match your environment:
    ```bash
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=prms
    DB_USERNAME=root
    DB_PASSWORD=
    ```
    *Note: The default `DB_PORT` is `3306`. Adjust it if your setup uses a different port. Same goes for `DB_USERNAME` and `DB_PASSWORD`.*

### Step 3: Install Dependencies
- Install the required Laravel dependencies using Composer:
    ```bash
    composer install
    ```

### Step 4: Generate the Application Key
- Generate a new application key to secure your installation:
    ```bash
    php artisan key:generate
    ```

### Step 5: Set Up the Database
- Run the migrations to create the necessary database tables:
    ```bash
    php artisan migrate
    ```
- (Optional) Seed the database with initial data:
    ```bash
    php artisan db:seed
    ```

### Step 6: Start the Development Server
- Start the Laravel development server:
    ```bash
    php artisan serve
    ```

---

### Access the Application
- Once the server is running, open your browser and navigate to:
    ```bash
    http://127.0.0.1:8000
    ```

---

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
