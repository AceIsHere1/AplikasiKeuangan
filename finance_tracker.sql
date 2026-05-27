-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 27, 2026 at 04:50 PM
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
-- Database: `finance_tracker`
--

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `type` enum('income','expense') NOT NULL,
  `amount` decimal(15,2) NOT NULL,
  `category` varchar(50) DEFAULT NULL,
  `transaction_date` date NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `user_id`, `type`, `amount`, `category`, `transaction_date`, `description`, `created_at`) VALUES
(2, 2, 'income', 1000000.00, 'Hasil Jual Ikan', '2026-05-27', NULL, '2026-05-27 14:05:28'),
(3, 2, 'income', 10000.00, 'Beli Charger', '2026-05-28', NULL, '2026-05-27 14:05:48'),
(4, 2, 'income', 2000000.00, 'Gajian', '2026-06-04', NULL, '2026-05-27 14:07:50'),
(6, 2, 'expense', 1500000.00, 'Kalah Judi', '2026-06-06', NULL, '2026-05-27 14:08:50'),
(7, 3, 'income', 100000.00, 'Uang Saku Kuliah', '2026-05-29', NULL, '2026-05-27 14:24:03'),
(8, 3, 'expense', 50000.00, 'Buat beli jajan', '2026-05-30', NULL, '2026-05-27 14:24:39'),
(9, 3, 'income', 100000.00, 'dapat hasil jualan gelang', '2026-05-31', NULL, '2026-05-27 14:25:22');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `created_at`) VALUES
(1, 'hamba penat', '$2y$10$QcPLvVfZXJYnT8XCgdIlduGJQSnHswu17VgIX2DoNpAg0tC6BO3ea', '2026-05-27 14:01:13'),
(2, 'Abdul', '$2y$10$m6PNlRvEx/qyO8mqV/ilD.YoNQj8mHwNufLX6LrVv8AjmzHUoG3G.', '2026-05-27 14:03:43'),
(3, 'Yosephin Sheila ', '$2y$10$Ae4FekliGaEu.VFlFiYdxOwuUNjIF3FDH9jHB863iWtZhUriyUUKq', '2026-05-27 14:23:17');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
