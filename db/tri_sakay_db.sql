-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.4.24-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for tri_sakay_db
CREATE DATABASE IF NOT EXISTS `tri_sakay_db` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `tri_sakay_db`;

-- Dumping structure for table tri_sakay_db.tbl_fare_matrix
CREATE TABLE IF NOT EXISTS `tbl_fare_matrix` (
  `fare_matrix_id` int(11) NOT NULL AUTO_INCREMENT,
  `start_distance` int(11) NOT NULL,
  `end_distance` int(11) NOT NULL,
  `fare_amount` decimal(12,2) NOT NULL,
  `date_added` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`fare_matrix_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table tri_sakay_db.tbl_fare_matrix: ~1 rows (approximately)
INSERT INTO `tbl_fare_matrix` (`fare_matrix_id`, `start_distance`, `end_distance`, `fare_amount`, `date_added`) VALUES
	(5, 1, 10, 2.00, '2023-02-03 15:37:55');

-- Dumping structure for table tri_sakay_db.tbl_ratings
CREATE TABLE IF NOT EXISTS `tbl_ratings` (
  `rating_id` int(11) NOT NULL AUTO_INCREMENT,
  `transaction_id` int(11) NOT NULL,
  `rating` int(1) NOT NULL,
  `remarks` text NOT NULL,
  `date_last_modified` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`rating_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table tri_sakay_db.tbl_ratings: ~0 rows (approximately)

-- Dumping structure for table tri_sakay_db.tbl_transactions
CREATE TABLE IF NOT EXISTS `tbl_transactions` (
  `transaction_id` int(11) NOT NULL AUTO_INCREMENT,
  `ref_number` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `driver_id` int(11) DEFAULT NULL,
  `starting_point` varchar(50) DEFAULT NULL,
  `end_point` varchar(50) DEFAULT NULL,
  `amount` float DEFAULT NULL,
  `status` varchar(1) DEFAULT NULL,
  `remarks` varchar(50) DEFAULT NULL,
  `date_added` datetime DEFAULT NULL,
  `date_last_modified` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`transaction_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- Dumping data for table tri_sakay_db.tbl_transactions: ~6 rows (approximately)
INSERT INTO `tbl_transactions` (`transaction_id`, `ref_number`, `user_id`, `driver_id`, `starting_point`, `end_point`, `amount`, `status`, `remarks`, `date_added`, `date_last_modified`) VALUES
	(1, 23123123, 4, 3, NULL, NULL, NULL, 'C', '', NULL, '2022-06-29 15:42:50'),
	(2, 0, 8, 7, '10.642689467111994', '122.93964028358461', NULL, 'S', NULL, NULL, '2022-09-29 03:12:16'),
	(3, 0, 8, 7, '10.647297941144842', '122.93573901057242', NULL, 'S', NULL, NULL, '2022-09-29 04:32:58'),
	(4, 0, 8, 7, '10.668030928264013', '122.94968213886023', NULL, 'S', NULL, NULL, '2022-09-29 05:27:55'),
	(5, 0, 11, 7, 'undefined', 'undefined', NULL, 'S', NULL, NULL, '2022-09-29 07:49:11'),
	(6, 0, 13, 7, '10.648028120540097', '122.93584931641819', NULL, 'S', NULL, NULL, '2022-09-29 07:50:03');

-- Dumping structure for table tri_sakay_db.tbl_users
CREATE TABLE IF NOT EXISTS `tbl_users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_fname` varchar(50) DEFAULT NULL,
  `user_mname` varchar(50) DEFAULT NULL,
  `user_lname` varchar(50) DEFAULT NULL,
  `address` varchar(50) DEFAULT NULL,
  `contact_number` varchar(11) DEFAULT NULL,
  `category` varchar(1) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT 0,
  `id_token` text DEFAULT NULL,
  `date_added` datetime DEFAULT NULL,
  `date_last_modified` datetime DEFAULT current_timestamp(),
  `latitude` text NOT NULL DEFAULT '0',
  `longitude` text NOT NULL DEFAULT '0',
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

-- Dumping data for table tri_sakay_db.tbl_users: ~10 rows (approximately)
INSERT INTO `tbl_users` (`user_id`, `user_fname`, `user_mname`, `user_lname`, `address`, `contact_number`, `category`, `username`, `password`, `status`, `id_token`, `date_added`, `date_last_modified`, `latitude`, `longitude`) VALUES
	(1, 'Juan', 'Dela ', 'Cruz', NULL, '', 'A', 'admin', '0cc175b9c0f1b6a831c399e269772661', 1, NULL, '2022-06-29 14:25:26', '2022-06-29 14:25:27', '0', '0'),
	(3, 'driver', '', 'driver', NULL, NULL, 'D', 'driver', '0cc175b9c0f1b6a831c399e269772661', 1, NULL, '2022-06-29 14:31:31', '2022-06-29 14:31:31', '10.6473706', '122.9419145'),
	(4, 'Pepe', '', 'Smith', NULL, NULL, 'U', 'user', '0cc175b9c0f1b6a831c399e269772661', 0, 'cQp7zotzQXC6vdp8I80_Fm:APA91bFr4osBAiRr2cM7GryP2hqbfC7UU1WYtm7xgjlbYBddPHQsLNyUntvY4pfGXd3--nqC4_y6p1mIFfgN0mu4NOuNAZ-8JDBC-_FsbPgifHeeFI8-WSToVuNiClZOVE6f0NIx-sxT', '2022-06-30 09:48:40', '2022-06-30 09:48:40', '0', '0'),
	(7, 'test', 'test', 'asf', NULL, NULL, 'D', 'test', '202cb962ac59075b964b07152d234b70', 0, NULL, '2022-09-28 14:22:35', '2022-09-28 06:22:35', '10.6423965', '122.9175736'),
	(8, 'Anna', 'Cabil', 'Jaen', 'Bacolod City', '09454407991', 'U', 'Anna', '202cb962ac59075b964b07152d234b70', 0, '', '2022-09-29 08:52:37', '2022-09-29 00:52:37', '0', '0'),
	(9, 'J', 'J', 'J', 'H', 'N', 'U', 'Sample', '0cc175b9c0f1b6a831c399e269772661', 0, '', '2022-09-29 09:00:14', '2022-09-29 01:00:14', '0', '0'),
	(10, 'Rachel', 'Cath', 'Jaen', NULL, NULL, 'U', 'rcj', 'b148e7f41fdc3be4b14e8d17e068bbad', 0, NULL, '2022-09-29 11:01:25', '2022-09-29 03:01:25', '0', '0'),
	(11, 'Jj', 'Jj', 'Jj', 'Bacolod', '09123456789', 'U', 'aa', '4124bc0a9335c27f086f24ba207a4912', 0, 'ewTZDFiuSZ2OOm7jMCgMR4:APA91bGsQLIB8dGlFIKyzEdfF2ahJEOID8KeBbiSYiUxTHooGFGhVxLMKRZhJ2bgaglTasStGSpY6DpnEfDG8L83PIl19ppOZNgsw52n5DIOInxznExnbN8qI0VEeu9EzCB0uzJUYFT8', '2022-09-29 15:45:04', '2022-09-29 07:45:04', '0', '0'),
	(12, 'Aa', 'Aa', 'Aa', 'Aaa', 'Nsjsjs', 'U', 'Aa', '4124bc0a9335c27f086f24ba207a4912', 0, NULL, '2022-09-29 15:47:14', '2022-09-29 07:47:14', '0', '0'),
	(13, 'Jho', 'Jho', 'Jho', 'Talisay', '09772588024', 'U', 'Jho', '1427e904d3da3b984e2cd6e82d97d631', 0, 'eVArehkWRsWlBkq_szoFsz:APA91bFJkZpAyw7TOt9o5Gb-OqB5mohVmduxl_aqLibVVuo7j0lR9bxN8sI5C_CQBIu8YVdclDsY6LhOrL_jSXpNOGfMwip2tqO8mvygpKJ3wpHwmu2_tAkumu54t3i71ZOvQJ9HeOXz', '2022-09-29 15:48:16', '2022-09-29 07:48:16', '0', '0');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
