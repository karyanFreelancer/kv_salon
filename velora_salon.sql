-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 01, 2026 at 09:42 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `velora_salon`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(120) NOT NULL,
  `phone` varchar(30) NOT NULL,
  `service_id` int(11) DEFAULT NULL,
  `service_name` varchar(120) NOT NULL,
  `appointment_date` date NOT NULL,
  `appointment_time` time NOT NULL,
  `notes` text DEFAULT NULL,
  `status` enum('Pending','Confirmed','Completed','Cancelled') DEFAULT 'Pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`id`, `user_id`, `name`, `phone`, `service_id`, `service_name`, `appointment_date`, `appointment_time`, `notes`, `status`, `created_at`) VALUES
(1, NULL, 'Aryan Kumar', 'aryan@100%', 1, 'Haircut & Styling', '2026-09-02', '02:15:00', 'rrrrrrrrrrrrr', 'Confirmed', '2026-09-11 20:42:30'),
(2, 1, 'Aryan Kumar', '7564954095', 5, 'Beard Styling', '2026-09-09', '18:17:00', 'hhhh', 'Confirmed', '2026-09-24 12:48:41'),
(3, NULL, 'Aryan Kumar', '1223345567', 3, 'Facial & Glow', '2026-09-09', '19:29:00', 'hii', 'Confirmed', '2026-09-25 13:56:40'),
(4, 1, 'Kumar', '1223345567', 3, 'Facial & Glow', '2026-10-03', '08:07:00', 'hii', 'Completed', '2026-09-25 14:33:29'),
(5, 1, 'Kumar', '1223345567', 3, 'Facial & Glow', '2026-10-03', '08:07:00', 'hii', 'Pending', '2026-09-25 14:38:42'),
(6, NULL, 'sonu', '1223345567', 5, 'Beard Styling', '2026-09-29', '09:01:00', 'hiii', 'Pending', '2026-09-27 04:29:57'),
(7, NULL, 'Aryan Kumar', '7564954095', 5, 'Beard Styling', '2026-09-30', '23:16:00', 'hiii', 'Pending', '2026-09-27 17:41:14');

-- --------------------------------------------------------

--
-- Table structure for table `contact_messages`
--

CREATE TABLE `contact_messages` (
  `id` int(11) NOT NULL,
  `name` varchar(120) DEFAULT NULL,
  `email` varchar(160) DEFAULT NULL,
  `phone` varchar(30) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `status` enum('New','Read','Closed') DEFAULT 'New',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` int(11) NOT NULL,
  `name` varchar(120) NOT NULL,
  `category` varchar(80) DEFAULT 'General',
  `price` decimal(10,2) NOT NULL DEFAULT 0.00,
  `duration` int(11) DEFAULT 60,
  `description` text DEFAULT NULL,
  `active` tinyint(1) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `name`, `category`, `price`, `duration`, `description`, `active`, `created_at`) VALUES
(1, 'Haircut & Styling', 'Hair', 499.00, 45, 'Professional haircut and styling.', 1, '2026-09-11 20:39:08'),
(2, 'Hair Color', 'Hair', 1499.00, 120, 'Premium hair coloring service.', 1, '2026-09-11 20:39:08'),
(3, 'Facial & Glow', 'Skin', 799.00, 60, 'Relaxing facial and skin treatment.', 1, '2026-09-11 20:39:08'),
(4, 'Bridal Makeup', 'Bridal', 4999.00, 180, 'Complete bridal makeup package.', 1, '2026-09-11 20:39:08'),
(5, 'Beard Styling', 'Grooming', 299.00, 30, 'Precision beard styling.', 1, '2026-09-11 20:39:08'),
(6, 'Manicure & Pedicure', 'Nails', 699.00, 60, 'Complete hand and foot care.', 1, '2026-09-11 20:39:08');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(120) NOT NULL,
  `email` varchar(160) NOT NULL,
  `phone` varchar(30) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('customer','admin') DEFAULT 'customer',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `password`, `role`, `created_at`) VALUES
(1, 'Administrator', 'admin@velora.local', '9999999999', '240be518fabd2724ddb6f04eeb1da5967448d7e831c08c8fa822809f74c720a9', 'admin', '2026-09-11 20:39:08'),
(7, 'Aryan Kumar', 'karyan4537@gmail.com', 'karyan4537@gmail.com', '2c3640b421a20b64764c2151f5893bf838e45f39f4cde94fc3709dc3cac2d058', 'customer', '2026-09-28 03:19:27');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `service_id` (`service_id`);

--
-- Indexes for table `contact_messages`
--
ALTER TABLE `contact_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `contact_messages`
--
ALTER TABLE `contact_messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointments`
--
ALTER TABLE `appointments`
  ADD CONSTRAINT `appointments_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `appointments_ibfk_2` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
