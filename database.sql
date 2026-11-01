CREATE DATABASE IF NOT EXISTS velora_salon CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE velora_salon;

CREATE TABLE users(
 id INT AUTO_INCREMENT PRIMARY KEY,
 name VARCHAR(120) NOT NULL,
 email VARCHAR(160) NOT NULL UNIQUE,
 phone VARCHAR(30),
 password VARCHAR(255) NOT NULL,
 role ENUM('customer','admin') DEFAULT 'customer',
 created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE services(
 id INT AUTO_INCREMENT PRIMARY KEY,
 name VARCHAR(120) NOT NULL,
 category VARCHAR(80) DEFAULT 'General',
 price DECIMAL(10,2) NOT NULL DEFAULT 0,
 duration INT DEFAULT 60,
 description TEXT,
 active TINYINT(1) DEFAULT 1,
 created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE appointments(
 id INT AUTO_INCREMENT PRIMARY KEY,
 user_id INT NULL,
 name VARCHAR(120) NOT NULL,
 phone VARCHAR(30) NOT NULL,
 service_id INT NULL,
 service_name VARCHAR(120) NOT NULL,
 appointment_date DATE NOT NULL,
 appointment_time TIME NOT NULL,
 notes TEXT,
 status ENUM('Pending','Confirmed','Completed','Cancelled') DEFAULT 'Pending',
 created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
 FOREIGN KEY(user_id) REFERENCES users(id) ON DELETE SET NULL,
 FOREIGN KEY(service_id) REFERENCES services(id) ON DELETE SET NULL
);

CREATE TABLE contact_messages(
 id INT AUTO_INCREMENT PRIMARY KEY,
 name VARCHAR(120), email VARCHAR(160), phone VARCHAR(30), message TEXT,
 status ENUM('New','Read','Closed') DEFAULT 'New',
 created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO users(name,email,phone,password,role) VALUES
('Administrator','admin@velora.local','9999999999',SHA2('admin123',256),'admin');

INSERT INTO services(name,category,price,duration,description) VALUES
('Haircut & Styling','Hair',499,45,'Professional haircut and styling.'),
('Hair Color','Hair',1499,120,'Premium hair coloring service.'),
('Facial & Glow','Skin',799,60,'Relaxing facial and skin treatment.'),
('Bridal Makeup','Bridal',4999,180,'Complete bridal makeup package.'),
('Beard Styling','Grooming',299,30,'Precision beard styling.'),
('Manicure & Pedicure','Nails',699,60,'Complete hand and foot care.');
