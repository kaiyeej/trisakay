-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Feb 28, 2023 at 08:38 AM
-- Server version: 10.5.12-MariaDB-cll-lve
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u981310152_trisakay_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_fare_matrix`
--

CREATE TABLE `tbl_fare_matrix` (
  `fare_matrix_id` int(11) NOT NULL,
  `start_distance` int(11) NOT NULL,
  `end_distance` int(11) NOT NULL,
  `fare_amount` decimal(12,2) NOT NULL,
  `date_added` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_fare_matrix`
--

INSERT INTO `tbl_fare_matrix` (`fare_matrix_id`, `start_distance`, `end_distance`, `fare_amount`, `date_added`) VALUES
(5, 1, 100, '15.00', '2023-02-03 15:37:55'),
(7, 101, 999, '25.00', '2023-02-26 10:02:39'),
(8, 1000, 1999, '40.00', '2023-02-26 10:02:50'),
(9, 2000, 2999, '55.00', '2023-02-26 10:03:03'),
(10, 3000, 3999, '80.00', '2023-02-26 10:03:19');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_ratings`
--

CREATE TABLE `tbl_ratings` (
  `rating_id` int(11) NOT NULL,
  `transaction_id` int(11) NOT NULL,
  `rating` int(1) NOT NULL,
  `remarks` text NOT NULL,
  `date_last_modified` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_ratings`
--

INSERT INTO `tbl_ratings` (`rating_id`, `transaction_id`, `rating`, `remarks`, `date_last_modified`) VALUES
(4, 30, 5, 'K', '2023-02-27 09:28:36');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_transactions`
--

CREATE TABLE `tbl_transactions` (
  `transaction_id` int(11) NOT NULL,
  `ref_number` varchar(50) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `driver_id` int(11) DEFAULT NULL,
  `starting_point` varchar(50) DEFAULT NULL,
  `end_point` varchar(50) DEFAULT NULL,
  `amount` float DEFAULT NULL,
  `status` varchar(1) DEFAULT NULL,
  `remarks` varchar(50) DEFAULT NULL,
  `date_added` datetime DEFAULT current_timestamp(),
  `date_last_modified` datetime DEFAULT current_timestamp(),
  `driver_remarks` text DEFAULT NULL,
  `total_distance` varchar(50) DEFAULT NULL,
  `fuel_consumption` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_transactions`
--

INSERT INTO `tbl_transactions` (`transaction_id`, `ref_number`, `user_id`, `driver_id`, `starting_point`, `end_point`, `amount`, `status`, `remarks`, `date_added`, `date_last_modified`, `driver_remarks`, `total_distance`, `fuel_consumption`) VALUES
(26, 'TR-022623060055', 41, 40, '10.68213800154999', '122.95090556144714', 0, 'F', NULL, '2023-02-26 18:00:55', '2023-02-26 10:00:55', 'Salawayon ang user.', '1.m', 1),
(27, 'TR-022623070856', 41, 40, 'undefined', 'undefined', NULL, 'C', NULL, '2023-02-26 19:08:56', '2023-02-26 11:08:56', NULL, NULL, NULL),
(28, 'TR-022623071153', 41, 40, 'undefined', 'undefined', NULL, 'S', NULL, '2023-02-26 19:11:53', '2023-02-26 11:11:53', NULL, NULL, NULL),
(29, 'TR-022723092103', 48, 47, '10.643223600268588', '122.94016130268574', NULL, 'F', NULL, '2023-02-27 09:21:03', '2023-02-27 01:21:03', NULL, NULL, NULL),
(30, 'TR-022723092544', 48, 47, '10.643075980587854', '122.94015426188706', 0, 'F', NULL, '2023-02-27 09:25:44', '2023-02-27 01:25:44', NULL, '1.m', 1),
(31, 'TR-022723113605', 48, 44, 'undefined', 'undefined', NULL, 'F', NULL, '2023-02-27 11:36:05', '2023-02-27 03:36:05', NULL, NULL, NULL),
(32, 'TR-022723114549', 48, 44, 'undefined', 'undefined', NULL, 'F', NULL, '2023-02-27 11:45:49', '2023-02-27 03:45:49', NULL, NULL, NULL),
(33, 'TR-022723011124', 39, 40, '10.664454387787185', '122.94252265244721', NULL, 'S', NULL, '2023-02-27 13:11:24', '2023-02-27 05:11:24', NULL, NULL, NULL),
(34, 'TR-022723011145', 48, 44, '10.643215362565082', '122.94004965573549', NULL, 'F', NULL, '2023-02-27 13:11:45', '2023-02-27 05:11:45', NULL, NULL, NULL),
(35, 'TR-022723020522', 48, 44, '10.644488249872248', '122.94012643396854', NULL, 'F', NULL, '2023-02-27 14:05:22', '2023-02-27 06:05:22', NULL, NULL, NULL),
(36, 'TR-022723025957', 48, 44, 'undefined', 'undefined', NULL, 'F', NULL, '2023-02-27 14:59:57', '2023-02-27 06:59:57', NULL, NULL, NULL),
(37, 'TR-022723034505', 48, 44, 'undefined', 'undefined', NULL, 'F', NULL, '2023-02-27 15:45:05', '2023-02-27 07:45:05', NULL, NULL, NULL),
(38, 'TR-022723055231', 48, 44, 'undefined', 'undefined', NULL, 'C', NULL, '2023-02-27 17:52:31', '2023-02-27 09:52:31', NULL, NULL, NULL),
(39, 'TR-022723055940', 46, 44, 'undefined', 'undefined', NULL, 'C', NULL, '2023-02-27 17:59:40', '2023-02-27 09:59:40', NULL, NULL, NULL),
(40, 'TR-022823024558', 46, 44, 'undefined', 'undefined', NULL, 'F', NULL, '2023-02-28 14:45:58', '2023-02-28 06:45:58', NULL, NULL, NULL);

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
  `status` int(1) NOT NULL DEFAULT 0,
  `id_token` text DEFAULT NULL,
  `date_added` datetime DEFAULT NULL,
  `date_last_modified` datetime DEFAULT current_timestamp(),
  `latitude` text NULL DEFAULT '',
  `longitude` text  NULL DEFAULT '',
  `user_img` text NOT NULL,
  `license_number` text DEFAULT NULL,
  `toda_id` text DEFAULT NULL,
  `franchise_permit` text DEFAULT NULL,
  `or_img` text DEFAULT NULL,
  `cr_img` text DEFAULT NULL,
  `total_distance` text DEFAULT NULL,
  `fuel_consumption` float DEFAULT NULL,
  `vehicle_img` text NOT NULL,
  `plate_number` varchar(30) NOT NULL,
  `manufacturer` varchar(50) NOT NULL,
  `model` varchar(10) NOT NULL,
  `year` int(4) NOT NULL,
  `color` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`user_id`, `user_fname`, `user_mname`, `user_lname`, `address`, `contact_number`, `category`, `username`, `password`, `status`, `id_token`, `date_added`, `date_last_modified`, `latitude`, `longitude`, `user_img`, `license_number`, `toda_id`, `franchise_permit`, `or_img`, `cr_img`, `total_distance`, `fuel_consumption`, `vehicle_img`, `plate_number`, `manufacturer`, `model`, `year`, `color`) VALUES
(1, 'Marie', 'Chan', 'Jaen', NULL, '09454407991', 'A', 'admin', '0cc175b9c0f1b6a831c399e269772661', 1, NULL, '2022-06-29 14:25:26', '2022-06-29 14:25:27', '0', '0', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', 0, ''),
(39, 'John', 'Smith', 'Doe', 'Brgy. 100', '09554335248', 'U', 'Ginx', '0cc175b9c0f1b6a831c399e269772661', 1, 'c3vRrZxIQhKK8AmW22sjKy:APA91bHaBmktUL8Yvg6s6qOWYD7WVIgC05tQJIW5Zf8ZRTudEinlQcjIjxxNVWxSYsfFKT5Tn-pR5K8CM0Fd1ci_adxLEk4vGVWTwxhEBQlaVke-CawL-fYte5WNg4IOOszxVMrb8MXW', '2023-02-26 17:43:35', '2023-02-26 09:43:35', '10.6826713', '122.9436709', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', 0, ''),
(40, 'Katy', 'Jean', 'Perry', 'New york', '0956325663', 'D', 'Katy', '0cc175b9c0f1b6a831c399e269772661', 1, 'dKE-JWcOQfKM6WlfpijWp5:APA91bEFiYBrUSXQJ0xN19km6He-8IcXUdQKlsdiV8Tt5aUapicO6eevV_UCZDNOXmtLJhUW-gpyXrTDfjZ4cJ-1m_Ca58RT4nyRINOYsgtVsQ9H7shaXSp1s45k0nzeRave-6l-n1Nm', '2023-02-26 17:52:49', '2023-02-26 09:52:49', '10.682745', '122.943845', '', '12344', 'rn_image_picker_lib_temp_de1b7a3f-795b-479b-b30b-ba1d82086d47.jpg', 'rn_image_picker_lib_temp_eb5773d1-d2cb-493a-9af6-3e61c6298b8f.jpg', ' ', 'rn_image_picker_lib_temp_85317da8-5a86-47e4-b51a-7609e38efc1a.jpg', NULL, NULL, '', '', '', '', 0, ''),
(41, 'Queen', 'Taylor', 'Swift', 'Bgry. Granada, Bacolod City', '092630002', 'U', 'taylor', '0cc175b9c0f1b6a831c399e269772661', 1, 'cafnxiUsT8udRUW2oUeo_h:APA91bFxXlxGq8MsYy4viGil9ssttLw5oITA0CzksxFePJPnMocsOcAOJrYTgL8hJu0BBps2WxRpM7EoRw2yGbQLHzfnj8B7aHseissMVehuDxUmL0urUJd8WTvXr458XgtVkKAmOQaV', '2023-02-26 17:55:22', '2023-02-26 09:55:22', '10.6791834', '122.9503059', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', 0, ''),
(42, 'James', 'Taylor', 'Taylor', 'Bgry. Granada, Bacolod City', '092630002', 'U', 'james', '0cc175b9c0f1b6a831c399e269772661', 1, 'cafnxiUsT8udRUW2oUeo_h:APA91bFxXlxGq8MsYy4viGil9ssttLw5oITA0CzksxFePJPnMocsOcAOJrYTgL8hJu0BBps2WxRpM7EoRw2yGbQLHzfnj8B7aHseissMVehuDxUmL0urUJd8WTvXr458XgtVkKAmOQaV', '2023-02-26 17:56:52', '2023-02-26 09:56:52', '10.68072', '122.95236', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', 0, ''),
(43, 'Cath', 'Cath', 'Cath', 'Bgry. Singcang Airport ', '09463512784', 'U', 'Cathhhxie01', 'a73bf16ff02ac0de4c08fdb5188560a6', 1, 'dhYJPkiQT0G4bn_CcLM7wl:APA91bEeu1hTV_7_3JEsWiDRV9Z6Cfo68lU28zP2sqTUkPJyQaYLCWCW5oXgl5VaEgSjbhC9d2K-1tDl6W_q24bKQEpGM1dR3mZ42m4nBfgARsNqV--mF4PJvuHoL673D6uNeSLmhEgl', '2023-02-26 19:32:02', '2023-02-26 11:32:02', '10.6444661', '122.9272027', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', 0, ''),
(44, 'Rachel', 'Mapa', 'Tiongco', 'Bacolod City', '09784576425', 'D', 'RachelT', 'e807f1fcf82d132f9bb018ca6738a19f', 1, 'dM6mnXyVTEWsq1WOTPajXE:APA91bG2j8NEBG1rZlOCBDo7Ok2MxjF4tZgNBE2IyhjHAyxDm67z9bJEYeROtupP067Vzo_9FPdTBnmJuWZlwyZ3xiL-cvXjsGPUgrZ2QgacyYd3kxmj8qgm4ylnKtGsYT7sUgqyf8kP', '2023-02-26 19:35:19', '2023-02-26 11:35:19', '10.6424599', '122.9387614', '', 'Vaj628181725', 'rn_image_picker_lib_temp_e33ab42c-0d5a-4c8f-9885-40755369867b.jpg', 'rn_image_picker_lib_temp_1da0500d-d701-4b2c-9b87-27203595c279.jpg', 'rn_image_picker_lib_temp_5322b0dc-789d-43d7-8cd2-857f75ed3e09.jpg ', 'rn_image_picker_lib_temp_f064a2e5-0467-4058-a571-d1b003d0354a.jpg', NULL, NULL, '', '', '', '', 0, ''),
(45, 'Anna', 'Marie', 'Jaen', 'Bacolod City', '09454407991', 'D', 'Anna', '0cc175b9c0f1b6a831c399e269772661', 1, 'd739G7LWRnurycqlLtQB-V:APA91bEoEbEPeR95mM-s0cJH0sHQCI_T7uEA_wqAiRBIvpQfJRwPhkwkMYgWBxrXYmzuCprPaz6tbyuipIfXfgfW5qfdCir-n_gMU6xl01ZJ3Xr0t0Gr_Gg8dgcfk1LRSE5ndroDWWp_', '2023-02-26 20:30:31', '2023-02-26 12:30:31', '10.6638983', '122.95277', '', '123456', 'rn_image_picker_lib_temp_2135bef2-d85c-48f4-bc13-caf5094f30dd.jpg', 'rn_image_picker_lib_temp_9cee1288-3119-4dbe-8075-c47edea8ef09.jpg', 'rn_image_picker_lib_temp_d551bde2-be01-4c75-abc4-a4544345984f.jpg ', 'rn_image_picker_lib_temp_865ddcca-16d8-433f-b6ef-18e262e046eb.jpg', NULL, NULL, '', '', '', '', 0, ''),
(46, 'Samantha ', 'Lauren', 'Reifler ', 'Bgry. Singcang Airport, Bacolod City ', '0978*******', 'U', 'Sammy_01', 'a73bf16ff02ac0de4c08fdb5188560a6', 1, 'dhYJPkiQT0G4bn_CcLM7wl:APA91bEeu1hTV_7_3JEsWiDRV9Z6Cfo68lU28zP2sqTUkPJyQaYLCWCW5oXgl5VaEgSjbhC9d2K-1tDl6W_q24bKQEpGM1dR3mZ42m4nBfgARsNqV--mF4PJvuHoL673D6uNeSLmhEgl', '2023-02-27 03:25:09', '2023-02-26 19:25:09', '10.6426101', '122.9385417', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', 0, ''),
(47, 'j', 'j', 'j', NULL, NULL, 'D', 'j', '202cb962ac59075b964b07152d234b70', 1, 'dM6mnXyVTEWsq1WOTPajXE:APA91bG2j8NEBG1rZlOCBDo7Ok2MxjF4tZgNBE2IyhjHAyxDm67z9bJEYeROtupP067Vzo_9FPdTBnmJuWZlwyZ3xiL-cvXjsGPUgrZ2QgacyYd3kxmj8qgm4ylnKtGsYT7sUgqyf8kP', '2023-02-27 09:18:17', '2023-02-27 01:18:17', '10.6426773', '122.9399421', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', 0, ''),
(48, 'x', 'x', 'x', NULL, NULL, 'U', 'x', '202cb962ac59075b964b07152d234b70', 1, 'dhYJPkiQT0G4bn_CcLM7wl:APA91bEeu1hTV_7_3JEsWiDRV9Z6Cfo68lU28zP2sqTUkPJyQaYLCWCW5oXgl5VaEgSjbhC9d2K-1tDl6W_q24bKQEpGM1dR3mZ42m4nBfgARsNqV--mF4PJvuHoL673D6uNeSLmhEgl', '2023-02-27 09:19:18', '2023-02-27 01:19:18', '10.6444423', '122.9272159', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', 0, ''),
(49, 'kk', 'kk', 'kk', NULL, NULL, 'D', 'k', '202cb962ac59075b964b07152d234b70', 1, NULL, '2023-02-27 09:36:57', '2023-02-27 01:36:57', '0', '0', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', 0, ''),
(50, 'Roger', 'Alarcon', 'de Ramos', 'Prk talaba magsungay Brgy. Singcang Airport Bacolo', '09070865162', 'U', 'Regor', '90e725f333a3159bdac6b82d40914ce1', 1, 'd739G7LWRnurycqlLtQB-V:APA91bEoEbEPeR95mM-s0cJH0sHQCI_T7uEA_wqAiRBIvpQfJRwPhkwkMYgWBxrXYmzuCprPaz6tbyuipIfXfgfW5qfdCir-n_gMU6xl01ZJ3Xr0t0Gr_Gg8dgcfk1LRSE5ndroDWWp_', '2023-02-28 13:41:42', '2023-02-28 05:41:42', '10.6426207', '122.9384854', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', 0, ''),
(51, 'Nash', 'M', 'Tiongco', 'Bacolod City', '09457618452', 'U', 'Nash', 'e1e1d3d40573127e9ee0480caf1283d6', 1, 'dM6mnXyVTEWsq1WOTPajXE:APA91bG2j8NEBG1rZlOCBDo7Ok2MxjF4tZgNBE2IyhjHAyxDm67z9bJEYeROtupP067Vzo_9FPdTBnmJuWZlwyZ3xiL-cvXjsGPUgrZ2QgacyYd3kxmj8qgm4ylnKtGsYT7sUgqyf8kP', '2023-02-28 15:57:10', '2023-02-28 07:57:10', '10.642519', '122.9387042', 'rn_image_picker_lib_temp_55685277-b5dc-42df-b57e-ea44aa68a2c0.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', 0, '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_fare_matrix`
--
ALTER TABLE `tbl_fare_matrix`
  ADD PRIMARY KEY (`fare_matrix_id`);

--
-- Indexes for table `tbl_ratings`
--
ALTER TABLE `tbl_ratings`
  ADD PRIMARY KEY (`rating_id`);

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
-- AUTO_INCREMENT for table `tbl_fare_matrix`
--
ALTER TABLE `tbl_fare_matrix`
  MODIFY `fare_matrix_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tbl_ratings`
--
ALTER TABLE `tbl_ratings`
  MODIFY `rating_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_transactions`
--
ALTER TABLE `tbl_transactions`
  MODIFY `transaction_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
