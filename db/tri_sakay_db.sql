-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 30, 2022 at 04:44 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tri_sakay_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_transactions`
--

CREATE TABLE `tbl_transactions` (
  `transaction_id` int(11) NOT NULL,
  `ref_number` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `driver_id` int(11) DEFAULT NULL,
  `starting_point` varchar(50) DEFAULT NULL,
  `end_point` varchar(50) DEFAULT NULL,
  `amount` float DEFAULT NULL,
  `status` varchar(1) DEFAULT NULL,
  `remarks` varchar(50) DEFAULT NULL,
  `date_added` datetime DEFAULT NULL,
  `date_last_modified` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_transactions`
--

INSERT INTO `tbl_transactions` (`transaction_id`, `ref_number`, `user_id`, `driver_id`, `starting_point`, `end_point`, `amount`, `status`, `remarks`, `date_added`, `date_last_modified`) VALUES
(1, 23123123, 4, 0, NULL, NULL, NULL, 'P', '', NULL, '2022-06-29 15:42:50');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `user_id` int(11) NOT NULL,
  `user_fname` varchar(50) DEFAULT NULL,
  `user_mname` varchar(50) DEFAULT NULL,
  `user_lname` varchar(50) DEFAULT NULL,
  `address` varchar(50) DEFAULT NULL,
  `contact_number` varchar(11) DEFAULT NULL,
  `category` varchar(1) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT '0',
  `id_token` text,
  `date_added` datetime DEFAULT NULL,
  `date_last_modified` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`user_id`, `user_fname`, `user_mname`, `user_lname`, `address`, `contact_number`, `category`, `username`, `password`, `status`, `id_token`, `date_added`, `date_last_modified`) VALUES
(1, 'Juan', '', 'Dela Cruz', NULL, NULL, 'A', 'admin', '0cc175b9c0f1b6a831c399e269772661', 0, NULL, '2022-06-29 14:25:26', '2022-06-29 14:25:27'),
(3, 'driver', '', 'driver', NULL, NULL, 'D', 'driver', 'b148e7f41fdc3be4b14e8d17e068bbad', 1, NULL, '2022-06-29 14:31:31', '2022-06-29 14:31:31'),
(4, 'Pepe', '', 'Smith', NULL, NULL, 'U', 'user', 'b148e7f41fdc3be4b14e8d17e068bbad', 0, NULL, '2022-06-30 09:48:40', '2022-06-30 09:48:40');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_transactions`
--
ALTER TABLE `tbl_transactions`
  ADD PRIMARY KEY (`transaction_id`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_transactions`
--
ALTER TABLE `tbl_transactions`
  MODIFY `transaction_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
