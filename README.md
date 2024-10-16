# Dently App - Backend RESTful API

## Introduction
This repository contains the back-end RESTful API for the **Dently App**, a mobile application that facilitates communication between dentists and labs. Dentists can use the app to request tools, crowns, and other dental materials from labs. The back-end is developed using **PHP Laravel** with **MySQL** as the database.

This project was developed as part of a graduation project, and I received an A+ for this work. The front-end of the application was built using **Dart Flutter** by my team members.

## Technologies
- **PHP**: ^7.3|^8.0
- **Laravel**: ^8.75
- **MySQL**: 8.x.x
- **Dart Flutter** (for mobile app, handled by the front-end team)
- **Composer**: Dependency management for PHP

## Features
- **API for Dentist Requests**: Dentists can submit requests for dental tools, crowns, and other materials.
- **Request Tracking**: Each request has a status (e.g., pending, approved, rejected, delivered).
- **Lab Response Management**: Labs can view and respond to requests from dentists.
- **User Authentication**: Secure authentication for both dentists and lab personnel.
- **Role-based Access**: Different permissions for dentists and labs.
- **Error Handling**: Proper validation and error messages for API requests.

## Setup

### 1. Clone the Repository
To start, clone this repository to your local machine:
```bash
git clone https://github.com/Ahmedmaghrapy11/dently_backend.git
cd dently_backend
```

### 2. Install Dependencies
```bash
composer install
```

### 3. Set Up Environment Variables
- Create a .env file by copying .env.example:
```bash
cp .env.example .env
```
- Update the following database-related settings in the .env file to match your MySQL setup:
```code
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=dently_db
DB_USERNAME=your_mysql_username
DB_PASSWORD=your_mysql_password
```

### 4. Set Up Environment Variables
```sql 
Create Database in MySQL
```

### 5. Generate Application Key
```bash 
php artisan key:generate
```

### 6. Run Migrations
```bash 
php artisan migrate
```

### 7. Run the Development Server
```bash 
php artisan serve
```
## Future Features
- **Real-time Notifications**: Notify dentists and labs when a request status changes.
- **Payment Integration**: Enable payments for dental tools directly through the app.
- **Analytics Dashboard**: Provide a dashboard for labs to analyze requests and deliveries.
