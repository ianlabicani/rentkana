# InstaStay

**InstaStay** is a platform connecting landlords and renters (students and workers), enabling landlords to list available rooms and renters to search and inquire about them.

---

## ✨ Features

-   🏠 **Property Listings**: Homeowners can list their properties with descriptions, images, and pricing.
-   🔍 **Search & Filters**: Renters can search for properties based on location, price, and amenities.
-   📅 **Booking System**: Secure booking process with date selection and confirmation.
-   🔑 **User Authentication**: Secure login and registration for both renters and homeowners.
-   💳 **Payment Integration**: Seamless payment processing for bookings.
-   ⭐ **Reviews & Ratings**: Users can leave feedback and ratings for properties.
-   🛠 **Admin Dashboard**: Manage listings, users, and transactions.

---

## 🛠 Tech Stack

-   **Frontend**: Laravel Blade, Bootstrap, (UI Framework)
-   **Backend**: Laravel (PHP)
-   **Database**: MySQL
-   **Hosting**: Cloud-based hosting Heroku

---

<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## How to Set Up the Project

After cloning the repository, follow these steps to set up the Laravel application:

1. **Install Dependencies**:
   Install PHP dependencies using Composer:

    ```bash
    composer install
    ```

    Install Node.js dependencies:

    ```bash
    npm install
    ```

2. **Create and Configure the `.env` File**:
   Copy the example `.env` file and configure the environment variables:

    ```bash
    cp .env.example .env
    ```

    Update the `.env` file with your database credentials and other configurations.

3. **Generate Application Key**:
   Generate a new application key:

    ```bash
    php artisan key:generate
    ```

4. **Run Database Migrations**:
   Migrate the database to create the required tables:

    ```bash
    php artisan migrate
    ```

5. **Create Storage Link**:
   If the application stores uploaded files (e.g., images), run the following command to create a symbolic link between the `storage/app/public` directory and `public/storage`:

    ```bash
    php artisan storage:link
    ```

    This allows publicly accessible files to be served from the `storage` directory.

6. **Serve the Application**:
   Start the development server:

    ```bash
    composer run dev
    ```

    Your application will be available at `http://127.0.0.1:8000`.

---

## 🤝 Developer

[To be added]

---

## 📬 Contact

For any inquiries, reach out to [your email or contact link].
