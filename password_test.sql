-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 25, 2018 at 04:39 PM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `password_test`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `created_at`) VALUES
(1, 'Rik', '$2y$10$CXSKIOVFeG4msQeVcQfZr.Z8r1Cmxiz9SjBBx/Bawy3EImO2770Tq', '2018-10-22 16:22:17'),
(2, 'RikvanS', '$2y$10$.4mjPpjLI0R/72M5gFcbpuOyxhjSeP6pmXEDZPLRR/y4DJ/7oHpuG', '2018-10-22 16:28:18'),
(3, 'testrik', '$2y$10$gZBfQ7y4MLhF7x/k7N.EieaBXQGMkZQwookz0iY35njWnn7KnF5iq', '2018-10-23 09:13:14'),
(4, 'tester', '$2y$10$ImM5M2dwESJRDv3cbdT2pOxdl4DB19k4His6mRNf9YwGd/WLrogI6', '2018-10-23 11:26:39'),
(5, 'Anna', '$2y$10$72P///vO69AKESsx7pTRIOfVSsUy1jlzMbHyIsZ3q7mC74SsRlBOq', '2018-10-23 11:34:34'),
(6, 'testgebruiker', '$2y$10$9wt/ahhpTcpUFr053ZaSjuHEuWxXYBACBIlrV00bKgzPxxBxlbwIG', '2018-10-23 11:36:19'),
(7, 'testtest', '$2y$10$f1rLfkah4tHxiTk.OxSWBeilSUGt2U10tQFpbdBVzfT/TJ7HcS.k6', '2018-10-23 13:09:46'),
(8, 'mike', '$2y$10$pEAW9lEQhZoVeYROsvbrPeCW4b8kjwK3crCPodgu75Bx9gh2OfwSe', '2018-10-23 13:50:32'),
(9, 'rik2', '$2y$10$ttjTJ78z09oz6Ff8FhbmtejXqo4R8z6R9737a8PatfrDNRFQF4Lw.', '2018-10-23 13:51:08'),
(10, 'testtestest', '$2y$10$6FuuYgnWIsQpA6VoqKaKTOmjBPP1pO79MbGCnStlQIcHKd4.LofYa', '2018-10-23 13:54:01'),
(11, 'rita', '$2y$10$6Dv9H0TIAm3dKnHxO/BcPur7bNWlvp.Nz6jOtG1QXy8vQj6QohDx6', '2018-10-23 14:13:14'),
(12, 'sven', '$2y$10$v2/kL97R8J4ioIbLDHKrm.BHCC8q3as.Qh7/U9rXmg9n9yQu.E0/q', '2018-10-24 12:08:10');

--
-- Indexes for dumped tables
--

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
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
