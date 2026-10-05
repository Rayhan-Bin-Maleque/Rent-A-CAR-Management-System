# 🚗 Rent A CAR Management System (PHP + MySQL MVC)

A complete web-based **Rent A CAR Management System** developed using **Core PHP, MySQL, HTML, CSS, and JavaScript** following the **MVC (Model-View-Controller) architecture**.

This system helps car rental businesses manage vehicles, customers, bookings, payments, rental operations, maintenance, and system activities efficiently.

Customers can browse and book available cars, managers can manage vehicles and approve bookings, staff can handle pickup/return operations and maintenance, and administrators can control the complete system.

The project is developed using plain PHP with procedural MySQLi. No framework, Composer, or build tools are required.

## 🏗️ Project Architecture

<p align="center">
  <img src="diagram.png" alt="Rent A CAR Management System" width="100%">
</p>

---

# 1. Installation (XAMPP)

## Requirements

* XAMPP
* PHP 8+
* MySQL
* phpMyAdmin
* Web Browser
* VS Code

## Setup Instructions

### Step 1: Copy Project

Copy the project folder into:

```text
C:\xampp\htdocs\
```

Example:

```text
htdocs/Rent_A_CAR_Management_System/
```

### Step 2: Start XAMPP

Start:

```text
Apache
MySQL
```

from the XAMPP Control Panel.

### Step 3: Import Database

Open:

```text
http://localhost/phpmyadmin
```

Create a database named:

```text
rent_a_car_management
```

Import:

```text
rent_a_car_management.sql
```

### Step 4: Configure Database

Open:

```text
config/config.php
```

Update the database credentials if required.

Example:

```php
$host = "localhost";
$username = "root";
$password = "";
$database = "rent_a_car_management";
```

### Step 5: Run Project

Open:

```text
http://localhost/Rent_A_CAR_Management_System/
```

---

# 2. Project Folder Structure

```text
Rent_A_CAR_Management_System/

│
├── index.php
│   Main router and application entry point
│
├── rent_a_car_management.sql
│
├── README.md
│
├── config/
│   └── config.php
│
├── controllers/
│   ├── auth_controller.php
│   ├── admin_controller.php
│   ├── manager_controller.php
│   ├── staff_controller.php
│   ├── customer_controller.php
│   └── ajax_controller.php
│
├── helpers/
│   └── functions.php
│
├── models/
│   ├── user_model.php
│   ├── car_model.php
│   ├── booking_model.php
│   ├── payment_model.php
│   ├── maintenance_model.php
│   └── log_model.php
│
├── views/
│   │
│   ├── partials/
│   │   ├── header.php
│   │   └── footer.php
│   │
│   ├── auth/
│   │
│   ├── admin/
│   │
│   ├── manager/
│   │
│   ├── staff/
│   │
│   └── customer/
│
├── assets/
│   ├── css/
│   │   └── style.css
│   │
│   └── js/
│       └── app.js
│
└── docs/
```

---

# 3. MVC Architecture

The project follows the **MVC (Model-View-Controller) architecture**.

## Model

The Model handles:

* Database connection
* SQL queries
* Data processing
* CRUD operations
* Car information
* Booking information
* Payment information
* Maintenance records

Location:

```text
models/
```

Examples:

```text
user_model.php
car_model.php
booking_model.php
payment_model.php
maintenance_model.php
log_model.php
```

---

## View

The View handles:

* HTML pages
* User interface
* Forms
* Tables
* Dashboards
* Data presentation

Location:

```text
views/
```

Views are separated according to user roles:

```text
views/admin/
views/manager/
views/staff/
views/customer/
views/auth/
```

---

## Controller

The Controller handles:

* User requests
* Input validation
* Business logic
* Calling models
* Loading views
* Role-based operations

Location:

```text
controllers/
```

MVC Flow:

```text
User Request

        ↓

index.php Router

        ↓

Controller

        ↓

Model

        ↓

Database

        ↓

View
```

---

# 4. Router System

The project uses a centralized router through:

```text
index.php
```

Pages follow the structure:

```text
index.php?page=<role>&action=<function>
```

Examples:

| URL                                          | Function           |
| -------------------------------------------- | ------------------ |
| `index.php?page=admin`                       | Admin Dashboard    |
| `index.php?page=manager`                     | Manager Dashboard  |
| `index.php?page=staff`                       | Staff Dashboard    |
| `index.php?page=customer`                    | Customer Dashboard |
| `index.php?page=manager&action=add_car`      | Add Car            |
| `index.php?page=manager&action=bookings`     | Manage Bookings    |
| `index.php?page=staff&action=verify_booking` | Verify Booking     |
| `index.php?page=customer&action=cars`        | Browse Cars        |
| `index.php?page=ajax&action=search_cars`     | AJAX Car Search    |

The router loads the appropriate controller and function according to the requested page and user role.

---

# 5. User Roles and Features

## 👨‍💼 Admin

Admin manages the complete rental management system.

Features:

* Admin dashboard
* View system statistics
* Manage all users
* Manage customer accounts
* Manage cars
* View all bookings
* View payment records
* Monitor rental activities
* View activity logs
* Manage system operations

---

## 👨‍💻 Manager

Manager handles the main rental operations.

Features:

* Manager dashboard
* Add cars
* Edit car information
* Delete cars
* Manage vehicle availability
* View bookings
* Approve bookings
* Reject bookings
* View rental finance
* View booking statistics
* Monitor rental operations

Manager Workflow:

```text
Car Management

        ↓

Customer Booking

        ↓

Booking Review

        ↓

Approve / Reject

        ↓

Rental Operation
```

---

## 👨‍🔧 Staff

Staff handles day-to-day rental operations.

Features:

* Staff dashboard
* View assigned rental operations
* View approved bookings
* Verify pickup
* Verify return
* Verify booking code
* Record vehicle maintenance
* Update vehicle status
* View payment records
* Maintain rental operation records

Staff Workflow:

```text
Approved Booking

        ↓

Booking Code Verification

        ↓

Vehicle Pickup

        ↓

Rental Period

        ↓

Vehicle Return

        ↓

Return Verification
```

---

## 👤 Customer

Customers can browse and rent available vehicles.

Features:

* Customer dashboard
* Browse available cars
* Search cars
* View car details
* Book a car
* Submit rental information
* Pay rental charges
* View booking status
* View booking history
* View payment records
* Generate digital rental receipt

Customer Workflow:

```text
Browse Cars

        ↓

Select Car

        ↓

Make Booking

        ↓

Payment

        ↓

Booking Approval

        ↓

Vehicle Pickup

        ↓

Vehicle Return
```

---

# 6. Car Management System

The system allows managers and administrators to manage rental vehicles.

Car information may include:

* Car ID
* Car name
* Brand
* Model
* Registration number
* Car type
* Rental price
* Availability status
* Description
* Vehicle information

Vehicle statuses can include:

```text
Available
Booked
Rented
Maintenance
Unavailable
```

Car management operations include:

* Add car
* Edit car
* Delete car
* View car
* Update availability
* Search cars

---

# 7. Booking Management System

Customers can make rental bookings for available vehicles.

Booking information includes:

* Customer
* Car
* Pickup date
* Return date
* Rental duration
* Rental charge
* Booking status
* Booking code
* Payment status

Booking statuses can include:

```text
Pending
Approved
Rejected
Active
Completed
Cancelled
```

Booking Workflow:

```text
Customer Selects Car

        ↓

Select Pickup Date

        ↓

Select Return Date

        ↓

Calculate Rental Charge

        ↓

Submit Booking

        ↓

Manager Approval

        ↓

Booking Confirmed
```

---

# 8. Payment System

The system manages rental payment information.

Customers can:

* View rental charges
* Submit payment information
* View payment status
* View payment history
* Generate rental receipts

Payment information can include:

* Customer
* Booking
* Amount
* Payment method
* Transaction ID
* Payment status
* Payment date

Example payment methods:

```text
Cash
bKash
Nagad
Card
```

Payment Workflow:

```text
Booking

        ↓

Rental Charge

        ↓

Payment

        ↓

Payment Verification

        ↓

Booking Confirmation
```

---

# 9. Rental Pickup and Return System

Staff manages vehicle pickup and return operations.

### Pickup

```text
Approved Booking

        ↓

Enter Booking Code

        ↓

Verify Customer

        ↓

Verify Vehicle

        ↓

Confirm Pickup

        ↓

Rental Started
```

### Return

```text
Active Rental

        ↓

Customer Returns Vehicle

        ↓

Booking Verification

        ↓

Check Vehicle

        ↓

Confirm Return

        ↓

Vehicle Available
```

This helps maintain accurate rental operation records.

---

# 10. Vehicle Maintenance System

Staff can record vehicle maintenance activities.

Maintenance records can include:

* Vehicle
* Maintenance type
* Maintenance description
* Maintenance date
* Maintenance cost
* Maintenance status
* Staff information

Vehicle workflow:

```text
Vehicle Issue

        ↓

Maintenance Record

        ↓

Vehicle Status = Maintenance

        ↓

Repair Completed

        ↓

Vehicle Status = Available
```

This prevents vehicles under maintenance from being rented.

---

# 11. AJAX Features

The project uses AJAX for dynamic operations and searching.

Backend:

```text
controllers/ajax_controller.php
```

Frontend:

```text
assets/js/app.js
```

Possible AJAX features include:

* Car search
* Customer search
* Booking search
* Payment search
* Activity log search
* Dynamic availability checking

Benefits:

* No full page reload
* Faster searching
* Dynamic table updates
* Better user experience

---

# 12. Security Implementation

| Security                 | Implementation         |
| ------------------------ | ---------------------- |
| SQL Injection Protection | Prepared Statements    |
| Password Security        | `password_hash()`      |
| XSS Protection           | `htmlspecialchars()`   |
| Session Security         | Session Authentication |
| Role Protection          | Role-based Access      |
| Input Validation         | PHP Validation         |
| Input Cleaning           | Helper Functions       |
| Unauthorized Access      | Role Checking          |

---

# 13. Activity Logging System

The system records important activities performed by users.

Examples:

* User login
* User logout
* Car creation
* Car update
* Car deletion
* Booking creation
* Booking approval
* Booking rejection
* Payment completion
* Vehicle pickup
* Vehicle return
* Maintenance record creation

Administrators can monitor system activities through activity logs.

---

# 14. Database Relationship

Main database entities:

```text
Users

 |

 |---- Cars

 |

 |---- Bookings

 |

 |---- Payments

 |

 |---- Maintenance

 |

 |---- Activity Logs
```

Relationships:

* One customer can make many bookings
* One car can have many bookings
* One booking belongs to one customer
* One booking belongs to one car
* One booking can have payment information
* Staff manages pickup and return operations
* Staff records vehicle maintenance
* Admin monitors system activities
* Managers manage vehicles and bookings

---

# 15. Rental Receipt System

After completing a rental transaction, customers can view their rental information through a digital rental receipt.

Receipt information may include:

* Customer name
* Booking code
* Vehicle information
* Pickup date
* Return date
* Rental duration
* Rental amount
* Payment method
* Transaction ID
* Booking status

Receipt Flow:

```text
Booking

        ↓

Payment

        ↓

Booking Confirmation

        ↓

Rental Receipt

        ↓

Customer Views Receipt
```

---

# 16. Technologies Used

## Frontend

* HTML5
* CSS3
* JavaScript
* AJAX

## Backend

* PHP 8+
* Procedural MySQLi

## Database

* MySQL
* phpMyAdmin

## Server

* XAMPP

## Development

* Visual Studio Code

## Architecture

* MVC Pattern

---

# 17. Requirement Checklist

| Requirement       | Implementation                         |
| ----------------- | -------------------------------------- |
| MVC Architecture  | Models, Controllers, Views             |
| Database          | MySQL with MySQLi                      |
| Authentication    | Session-based Login                    |
| Authorization     | Role-based Access                      |
| CRUD Operations   | User, Car, Booking Management          |
| Booking System    | Car Rental Booking                     |
| Payment System    | Rental Payment Records                 |
| Maintenance       | Vehicle Maintenance Management         |
| AJAX              | Dynamic Search System                  |
| Validation        | PHP and JavaScript Validation          |
| Security          | Prepared Statements and XSS Protection |
| Activity Logging  | System Activity Records                |
| Rental Operations | Pickup and Return Management           |

---

# 18. Test Accounts

Example demo accounts:

| Role     | Email                  | Password   |
| -------- | ---------------------- | ---------- |
| Admin    | `admin@rentacar.com`   | `password` |
| Manager  | `manager@rentacar.com` | `password` |
| Staff    | `staff@rentacar.com`   | `password` |
| Customer | `customer@gmail.com`   | `password` |

> These accounts are intended for testing the application after importing the provided database.

---

# 19. Future Improvements

Possible future upgrades:

* Online payment gateway integration
* Real-time vehicle availability
* Email notifications
* SMS notifications
* GPS vehicle tracking
* Mobile application
* Online document verification
* Digital driving license verification
* Advanced rental analytics
* Automated invoice generation
* Cloud deployment
* Customer rating and review system
* Real-time booking notifications

---

# 20. Project Information

**Project Name:**

```text
Rent A CAR Management System
```

**Technology:**

```text
PHP + MySQL
```

**Architecture:**

```text
MVC (Model-View-Controller)
```

**Server:**

```text
XAMPP
```

**Database:**

```text
rent_a_car_management
```

**Project URL:**

```text
http://localhost/Rent_A_CAR_Management_System/
```

---

# Copyright

**Rent A CAR Management System**

Developed as an academic web application project using PHP, MySQL, HTML, CSS, and JavaScript.
