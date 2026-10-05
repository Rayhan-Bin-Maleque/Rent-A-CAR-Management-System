CREATE DATABASE IF NOT EXISTS rent_a_car_management
CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;

USE rent_a_car_management;

SET FOREIGN_KEY_CHECKS=0;

DROP TABLE IF EXISTS activity_logs;
DROP TABLE IF EXISTS maintenance;
DROP TABLE IF EXISTS payments;
DROP TABLE IF EXISTS bookings;
DROP TABLE IF EXISTS cars;
DROP TABLE IF EXISTS users;

SET FOREIGN_KEY_CHECKS=1;

CREATE TABLE users(
    id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    phone VARCHAR(30),
    password_hash VARCHAR(255) NOT NULL,
    role ENUM('customer','manager','staff','admin') NOT NULL,
    status ENUM('active','inactive') DEFAULT 'active',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

CREATE TABLE cars(
    id INT AUTO_INCREMENT PRIMARY KEY,
    manager_id INT DEFAULT NULL,
    brand VARCHAR(80) NOT NULL,
    model VARCHAR(80) NOT NULL,
    car_year INT NOT NULL,
    plate_number VARCHAR(50) NOT NULL UNIQUE,
    car_type VARCHAR(50) NOT NULL,
    seats INT NOT NULL,
    daily_rate DECIMAL(10,2) NOT NULL,
    description TEXT,
    status ENUM('available','rented','inactive') DEFAULT 'available',
    maintenance_status ENUM('ready','service_required') DEFAULT 'ready',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY(manager_id) REFERENCES users(id) ON DELETE SET NULL
) ENGINE=InnoDB;

CREATE TABLE bookings(
    id INT AUTO_INCREMENT PRIMARY KEY,
    customer_id INT NOT NULL,
    car_id INT NOT NULL,
    pickup_date DATE NOT NULL,
    return_date DATE NOT NULL,
    pickup_location VARCHAR(150) NOT NULL,
    rental_days INT NOT NULL,
    total_amount DECIMAL(10,2) NOT NULL,
    booking_code VARCHAR(50) NOT NULL UNIQUE,
    status ENUM('pending','approved','rejected','picked_up','returned','cancelled') DEFAULT 'pending',
    pickup_verified TINYINT(1) DEFAULT 0,
    return_verified TINYINT(1) DEFAULT 0,
    staff_note TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY(customer_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY(car_id) REFERENCES cars(id) ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE payments(
    id INT AUTO_INCREMENT PRIMARY KEY,
    booking_id INT NOT NULL,
    customer_id INT NOT NULL,
    amount DECIMAL(10,2) NOT NULL,
    payment_method VARCHAR(50) NOT NULL,
    transaction_id VARCHAR(100) NOT NULL,
    payment_status ENUM('pending','paid','rejected') DEFAULT 'pending',
    receipt_code VARCHAR(100) UNIQUE,
    payment_date DATETIME DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY(booking_id) REFERENCES bookings(id) ON DELETE CASCADE,
    FOREIGN KEY(customer_id) REFERENCES users(id) ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE maintenance(
    id INT AUTO_INCREMENT PRIMARY KEY,
    car_id INT NOT NULL,
    staff_id INT NOT NULL,
    maintenance_type VARCHAR(100) NOT NULL,
    description TEXT,
    cost DECIMAL(10,2) DEFAULT 0,
    status VARCHAR(50) DEFAULT 'completed',
    maintenance_date DATE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY(car_id) REFERENCES cars(id) ON DELETE CASCADE,
    FOREIGN KEY(staff_id) REFERENCES users(id) ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE activity_logs(
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    role VARCHAR(30) NOT NULL,
    action VARCHAR(255) NOT NULL,
    ip_address VARCHAR(100),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY(user_id) REFERENCES users(id) ON DELETE CASCADE
) ENGINE=InnoDB;

-- Password for all demo accounts: password
INSERT INTO users(full_name,email,phone,password_hash,role,status) VALUES
('System Admin','admin@rentacar.com','01700000000',
'$2y$12$KDgWkhOQ42xB4ryTjR.SLu1SVwidAzBWv/3a3PxV5ZSMXnXEpqigS','admin','active'),
('Rental Manager','manager@rentacar.com','01800000000',
'$2y$12$KDgWkhOQ42xB4ryTjR.SLu1SVwidAzBWv/3a3PxV5ZSMXnXEpqigS','manager','active'),
('Rental Staff','staff@rentacar.com','01900000000',
'$2y$12$KDgWkhOQ42xB4ryTjR.SLu1SVwidAzBWv/3a3PxV5ZSMXnXEpqigS','staff','active'),
('Demo Customer','customer@gmail.com','01600000000',
'$2y$12$KDgWkhOQ42xB4ryTjR.SLu1SVwidAzBWv/3a3PxV5ZSMXnXEpqigS','customer','active');

INSERT INTO cars(manager_id,brand,model,car_year,plate_number,car_type,seats,daily_rate,description,status,maintenance_status) VALUES
(2,'Toyota','Axio',2022,'DHAKA-GA-11-1234','Sedan',5,3500.00,'Comfortable fuel-efficient sedan.','available','ready'),
(2,'Toyota','Premio',2021,'DHAKA-GHA-12-5678','Sedan',5,4200.00,'Premium family sedan.','available','ready'),
(2,'Honda','Vezel',2023,'DHAKA-GHA-13-9012','SUV',5,5500.00,'Modern compact SUV.','available','ready'),
(2,'Mitsubishi','Outlander',2022,'DHAKA-GHA-14-3456','SUV',7,6500.00,'Seven-seat SUV for family trips.','available','ready'),
(2,'Toyota','Hiace',2020,'DHAKA-GHA-15-7890','Microbus',12,8000.00,'Spacious microbus for group travel.','available','ready');

INSERT INTO activity_logs(user_id,role,action,ip_address) VALUES
(1,'admin','System initialized','127.0.0.1');
