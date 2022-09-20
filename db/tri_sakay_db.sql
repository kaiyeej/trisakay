-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.1.38-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             11.3.0.6295
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for tri_sakay_db
CREATE DATABASE IF NOT EXISTS `tri_sakay_db` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `tri_sakay_db`;

-- Dumping structure for table tri_sakay_db.tbl_ratings
CREATE TABLE IF NOT EXISTS `tbl_ratings` (
  `rating_id` int(11) NOT NULL AUTO_INCREMENT,
  `transaction_id` int(11) NOT NULL,
  `rating` int(1) NOT NULL,
  `remarks` text NOT NULL,
  `date_last_modified` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`rating_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table tri_sakay_db.tbl_ratings: ~0 rows (approximately)
/*!40000 ALTER TABLE `tbl_ratings` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_ratings` ENABLE KEYS */;

-- Dumping structure for table tri_sakay_db.tbl_transactions
CREATE TABLE IF NOT EXISTS `tbl_transactions` (
  `transaction_id` int(11) NOT NULL AUTO_INCREMENT,
  `ref_number` varchar(50) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `driver_id` int(11) DEFAULT NULL,
  `starting_point` varchar(50) DEFAULT NULL,
  `end_point` varchar(50) DEFAULT NULL,
  `amount` float DEFAULT NULL,
  `status` varchar(1) DEFAULT NULL,
  `remarks` varchar(50) DEFAULT NULL,
  `date_added` datetime DEFAULT NULL,
  `date_last_modified` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`transaction_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table tri_sakay_db.tbl_transactions: ~0 rows (approximately)
/*!40000 ALTER TABLE `tbl_transactions` DISABLE KEYS */;
INSERT INTO `tbl_transactions` (`transaction_id`, `ref_number`, `user_id`, `driver_id`, `starting_point`, `end_point`, `amount`, `status`, `remarks`, `date_added`, `date_last_modified`) VALUES
	(1, 'TR-09009090', 4, 3, NULL, NULL, NULL, 'C', '', NULL, '2022-06-29 15:42:50');
/*!40000 ALTER TABLE `tbl_transactions` ENABLE KEYS */;

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
  `status` int(1) NOT NULL DEFAULT '0',
  `id_token` text,
  `date_added` datetime DEFAULT NULL,
  `date_last_modified` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Dumping data for table tri_sakay_db.tbl_users: ~3 rows (approximately)
/*!40000 ALTER TABLE `tbl_users` DISABLE KEYS */;
INSERT INTO `tbl_users` (`user_id`, `user_fname`, `user_mname`, `user_lname`, `address`, `contact_number`, `category`, `username`, `password`, `status`, `id_token`, `date_added`, `date_last_modified`) VALUES
	(1, 'Juan', '', 'Dela Cruz', NULL, NULL, 'A', 'admin', '0cc175b9c0f1b6a831c399e269772661', 0, NULL, '2022-06-29 14:25:26', '2022-06-29 14:25:27'),
	(3, 'driver', '', 'driver', NULL, NULL, 'D', 'driver', 'b148e7f41fdc3be4b14e8d17e068bbad', 1, NULL, '2022-06-29 14:31:31', '2022-06-29 14:31:31'),
	(4, 'Pepe', '', 'Smith', NULL, NULL, 'U', 'user', 'b148e7f41fdc3be4b14e8d17e068bbad', 0, NULL, '2022-06-30 09:48:40', '2022-06-30 09:48:40');
/*!40000 ALTER TABLE `tbl_users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
