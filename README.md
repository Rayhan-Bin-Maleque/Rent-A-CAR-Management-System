# Rent A CAR Management System

A PHP + MySQL car rental management system built using the same MVC-style project structure as the Campus Event Management System.

## Technology
- HTML5, CSS3, JavaScript
- PHP 8+
- MySQL
- XAMPP / phpMyAdmin
- VS Code

## Roles
### Admin
- Dashboard and system statistics
- Manage all users
- Manage cars
- View all bookings and payments
- View activity logs

### Manager
- Dashboard
- Add, edit and manage cars
- Approve/reject bookings
- View rental finance
- View booking statistics

### Staff
- Dashboard
- View assigned rental operations
- Verify pickup/return using booking code
- Record vehicle maintenance
- View payment records

### Customer
- Dashboard
- Browse available cars
- Search cars
- Book a car
- Pay rental charges
- View booking history
- View digital rental receipt

## Installation
1. Copy the project folder into `xampp/htdocs/`.
2. Start Apache and MySQL.
3. Open phpMyAdmin.
4. Create a database named `rent_a_car_management`.
5. Import `rent_a_car_management.sql`.
6. Update database credentials in `config/config.php` if needed.
7. Open:
   `http://localhost/Rent_A_CAR_Management_System/`

## Demo accounts
- Admin: `admin@rentacar.com` / `password`
- Manager: `manager@rentacar.com` / `password`
- Staff: `staff@rentacar.com` / `password`
- Customer: `customer@gmail.com` / `password`

## Structure
```text
Rent_A_CAR_Management_System/
├── assets/
│   ├── css/style.css
│   └── js/app.js
├── config/
├── controllers/
├── helpers/
├── models/
├── views/
│   ├── admin/
│   ├── auth/
│   ├── customer/
│   ├── manager/
│   ├── partials/
│   └── staff/
├── docs/
├── index.php
└── rent_a_car_management.sql
```
