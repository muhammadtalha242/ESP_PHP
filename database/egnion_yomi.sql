-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 02, 2021 at 02:12 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `egnion_yomi`
--

-- --------------------------------------------------------

--
-- Table structure for table `connected_sensors`
--

CREATE TABLE `connected_sensors` (
  `ID` int(11) NOT NULL,
  `label` varchar(500) NOT NULL,
  `esp_id` int(11) NOT NULL,
  `sensor_id` int(11) NOT NULL,
  `pin` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `connected_sensors`
--

INSERT INTO `connected_sensors` (`ID`, `label`, `esp_id`, `sensor_id`, `pin`) VALUES
(1, 'Home-1', 5, 1, '2'),
(2, 'Home-2', 5, 2, '3'),
(3, 'Home-3', 5, 3, '4'),
(4, 'Home-4', 5, 9, '5'),
(5, 'Home-5', 5, 8, '6'),
(6, 'Home-6', 9, 1, '2'),
(7, 'Home-7', 9, 10, '7'),
(8, 'Home-8', 10, 4, '2'),
(9, 'Home-9', 11, 5, '1'),
(10, 'Home-10', 10, 6, '4'),
(11, 'Home-11', 10, 7, '5'),
(12, 'Home-12', 10, 8, '6'),
(13, 'Home-13', 10, 9, '7'),
(14, 'Home-14', 10, 1, '8'),
(15, 'Home-15', 11, 1, '2'),
(16, 'Home-16', 5, 11, '13'),
(17, 'Test esp5 sensor 5', 5, 5, '1');

-- --------------------------------------------------------

--
-- Table structure for table `di_pins`
--

CREATE TABLE `di_pins` (
  `ID` int(11) NOT NULL,
  `connected_sensor_ID` int(11) NOT NULL,
  `GPIO-2-DI` tinyint(1) NOT NULL,
  `GPIO-13-DI` tinyint(1) NOT NULL,
  `GPIO-18-DI` tinyint(1) NOT NULL,
  `GPIO-19-DI` tinyint(1) NOT NULL,
  `GPIO-23-DI` tinyint(1) NOT NULL,
  `GPIO-25-DI` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `esp32`
--

CREATE TABLE `esp32` (
  `id` int(11) NOT NULL,
  `eps_id` int(11) NOT NULL,
  `esp_name` varchar(500) DEFAULT NULL,
  `connected` tinyint(1) NOT NULL,
  `delete_status` enum('0','1') DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `esp32`
--

INSERT INTO `esp32` (`id`, `eps_id`, `esp_name`, `connected`, `delete_status`) VALUES
(1, 0, 'g3', 0, '1'),
(5, 1, 'Esp 1', 0, '0'),
(7, 2, 'g3', 0, '1'),
(9, 2, 'Esp 2', 0, '0'),
(10, 2, 'Esp 3', 0, '0'),
(11, 2, 'Esp 4', 0, '0'),
(12, 2, 'Esp 6', 0, '0'),
(13, 2, 'Esp 32', 0, '0');

-- --------------------------------------------------------

--
-- Table structure for table `sensors`
--

CREATE TABLE `sensors` (
  `ID` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `type` tinyint(1) NOT NULL,
  `pins_required` int(11) NOT NULL,
  `iomode` tinyint(1) NOT NULL,
  `delete_status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sensors`
--

INSERT INTO `sensors` (`ID`, `name`, `type`, `pins_required`, `iomode`, `delete_status`) VALUES
(1, 'Door Contact', 1, 1, 1, 0),
(2, 'Smoke Detector', 1, 1, 1, 0),
(3, 'Status Indicator', 1, 1, 1, 0),
(4, 'Other Contacts', 1, 1, 1, 0),
(5, 'AC Measurements', 0, 1, 1, 0),
(6, 'DC Measurements', 0, 1, 1, 0),
(7, 'Volume Temperature', 0, 1, 1, 0),
(8, 'Other Level Indicators', 0, 1, 1, 0),
(9, 'Gen Start Relay', 1, 1, 0, 0),
(10, 'Remote Activator', 1, 1, 0, 0),
(11, 'Switch Control', 1, 1, 0, 0),
(12, 'Other Contacts', 1, 1, 0, 0),
(13, 'Serial Interface Meter', -1, 2, -1, 0),
(15, 'New', 1, 2, 1, 1),
(36, 'Test2', 0, 2, 0, 1),
(37, 'TEST1', -1, 2, -1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `sensors_data`
--

CREATE TABLE `sensors_data` (
  `ID` int(11) NOT NULL,
  `connected_sersor_id` int(11) NOT NULL,
  `esp_id` int(11) NOT NULL,
  `sensor_id` int(11) NOT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `value` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sensors_data`
--

INSERT INTO `sensors_data` (`ID`, `connected_sersor_id`, `esp_id`, `sensor_id`, `time`, `value`) VALUES
(3, 1, 5, 1, '2021-05-01 21:51:34', '0'),
(4, 2, 5, 2, '2021-05-01 21:51:54', '1'),
(19, 5, 5, 8, '2021-05-01 21:52:47', '23'),
(20, 5, 5, 8, '2021-05-01 21:53:31', '24'),
(21, 5, 5, 8, '2021-05-01 21:53:31', '25'),
(25, 13, 10, 9, '2021-05-01 21:57:53', '321'),
(26, 14, 10, 1, '2021-05-01 21:58:11', '321'),
(27, 13, 10, 9, '2021-05-01 21:56:46', '123'),
(28, 14, 10, 1, '2021-05-01 21:58:33', '123'),
(29, 15, 11, 1, '2021-05-01 21:58:43', '123'),
(34, 1, 1, 1, '2021-05-02 00:39:07', '1'),
(35, 1, 1, 1, '2021-05-02 00:42:32', '1'),
(36, 1, 1, 2, '2021-05-02 00:42:32', '2'),
(37, 1, 1, 3, '2021-05-02 00:42:32', '3'),
(38, 1, 1, 4, '2021-05-02 00:42:32', '4'),
(39, 1, 1, 5, '2021-05-02 00:42:32', '5'),
(40, 1, 1, 6, '2021-05-02 00:42:32', '6'),
(41, 1, 1, 7, '2021-05-02 00:42:32', '7'),
(42, 1, 1, 8, '2021-05-02 00:42:32', '1'),
(43, 1, 1, 9, '2021-05-02 00:42:32', '1'),
(44, 1, 1, 10, '2021-05-02 00:42:32', '1'),
(45, 1, 1, 11, '2021-05-02 00:42:32', '1'),
(46, 1, 1, 12, '2021-05-02 00:42:32', '1'),
(47, 1, 1, 14, '2021-05-02 00:42:32', '1'),
(48, 1, 1, 15, '2021-05-02 00:42:32', '1'),
(49, 1, 1, 17, '2021-05-02 00:42:32', '1'),
(50, 1, 1, 16, '2021-05-02 00:42:32', '1'),
(51, 1, 1, 18, '2021-05-02 00:42:32', '1'),
(52, 1, 1, 1, '2021-05-02 01:17:02', '1'),
(53, 1, 1, 2, '2021-05-02 01:17:02', '2'),
(54, 1, 1, 3, '2021-05-02 01:17:02', '3'),
(55, 1, 1, 4, '2021-05-02 01:17:02', '4'),
(56, 1, 1, 5, '2021-05-02 01:17:02', '5'),
(57, 1, 1, 6, '2021-05-02 01:17:02', '6'),
(58, 1, 1, 7, '2021-05-02 01:17:02', '7'),
(59, 1, 1, 8, '2021-05-02 01:17:02', '1'),
(60, 1, 1, 9, '2021-05-02 01:17:03', '1'),
(61, 1, 1, 10, '2021-05-02 01:17:03', '1'),
(62, 1, 1, 11, '2021-05-02 01:17:03', '1'),
(63, 1, 1, 12, '2021-05-02 01:17:03', '1'),
(64, 1, 1, 14, '2021-05-02 01:17:03', '1'),
(65, 1, 1, 15, '2021-05-02 01:17:03', '1'),
(66, 1, 1, 17, '2021-05-02 01:17:03', '1'),
(67, 1, 1, 16, '2021-05-02 01:17:03', '1'),
(68, 1, 1, 18, '2021-05-02 01:17:03', '1'),
(69, 1, 1, 1, '2021-05-02 01:17:14', '1'),
(70, 1, 1, 2, '2021-05-02 01:17:15', '2'),
(71, 1, 1, 3, '2021-05-02 01:17:15', '3'),
(72, 1, 1, 4, '2021-05-02 01:17:15', '4'),
(73, 1, 1, 5, '2021-05-02 01:17:15', '5'),
(74, 1, 1, 6, '2021-05-02 01:17:15', '6'),
(75, 1, 1, 7, '2021-05-02 01:17:15', '7'),
(76, 1, 1, 8, '2021-05-02 01:17:15', '1'),
(77, 1, 1, 9, '2021-05-02 01:17:15', '1'),
(78, 1, 1, 10, '2021-05-02 01:17:15', '1'),
(79, 1, 1, 11, '2021-05-02 01:17:15', '1'),
(80, 1, 1, 12, '2021-05-02 01:17:15', '1'),
(81, 1, 1, 14, '2021-05-02 01:17:15', '1'),
(82, 1, 1, 15, '2021-05-02 01:17:15', '1'),
(83, 1, 1, 17, '2021-05-02 01:17:15', '1'),
(84, 1, 1, 16, '2021-05-02 01:17:15', '1'),
(85, 1, 1, 18, '2021-05-02 01:17:15', '1'),
(86, 1, 1, 1, '2021-05-02 01:19:01', '1'),
(87, 1, 1, 2, '2021-05-02 01:19:01', '2'),
(88, 1, 1, 3, '2021-05-02 01:19:01', '3'),
(89, 1, 1, 4, '2021-05-02 01:19:01', '4'),
(90, 1, 1, 5, '2021-05-02 01:19:01', '5'),
(91, 1, 1, 6, '2021-05-02 01:19:01', '6'),
(92, 1, 1, 7, '2021-05-02 01:19:01', '7'),
(93, 1, 1, 8, '2021-05-02 01:19:01', '1'),
(94, 1, 1, 9, '2021-05-02 01:19:01', '1'),
(95, 1, 1, 10, '2021-05-02 01:19:01', '1'),
(96, 1, 1, 11, '2021-05-02 01:19:01', '1'),
(97, 1, 1, 12, '2021-05-02 01:19:01', '1'),
(98, 1, 1, 14, '2021-05-02 01:19:01', '1'),
(99, 1, 1, 15, '2021-05-02 01:19:01', '1'),
(100, 1, 1, 17, '2021-05-02 01:19:01', '1'),
(101, 1, 1, 16, '2021-05-02 01:19:01', '1'),
(102, 1, 1, 18, '2021-05-02 01:19:01', '1'),
(103, 1, 1, 1, '2021-05-02 01:20:14', '1'),
(104, 1, 1, 2, '2021-05-02 01:20:14', '2'),
(105, 1, 1, 3, '2021-05-02 01:20:15', '3'),
(106, 1, 1, 4, '2021-05-02 01:20:15', '4'),
(107, 1, 1, 5, '2021-05-02 01:20:15', '5'),
(108, 1, 1, 6, '2021-05-02 01:20:15', '6'),
(109, 1, 1, 7, '2021-05-02 01:20:15', '7'),
(110, 1, 1, 8, '2021-05-02 01:20:15', '1'),
(111, 1, 1, 9, '2021-05-02 01:20:15', '1'),
(112, 1, 1, 10, '2021-05-02 01:20:15', '1'),
(113, 1, 1, 11, '2021-05-02 01:20:15', '1'),
(114, 1, 1, 12, '2021-05-02 01:20:15', '1'),
(115, 1, 1, 14, '2021-05-02 01:20:15', '1'),
(116, 1, 1, 15, '2021-05-02 01:20:15', '1'),
(117, 1, 1, 17, '2021-05-02 01:20:15', '1'),
(118, 1, 1, 16, '2021-05-02 01:20:15', '1'),
(119, 1, 1, 18, '2021-05-02 01:20:15', '1'),
(120, 1, 1, 1, '2021-05-02 01:22:21', '1'),
(121, 1, 1, 2, '2021-05-02 01:22:21', '2'),
(122, 1, 1, 3, '2021-05-02 01:22:21', '3'),
(123, 1, 1, 4, '2021-05-02 01:22:21', '4'),
(124, 1, 1, 5, '2021-05-02 01:22:21', '5'),
(125, 1, 1, 6, '2021-05-02 01:22:21', '6'),
(126, 1, 1, 7, '2021-05-02 01:22:21', '7'),
(127, 1, 1, 8, '2021-05-02 01:22:21', '1'),
(128, 1, 1, 9, '2021-05-02 01:22:21', '1'),
(129, 1, 1, 10, '2021-05-02 01:22:21', '1'),
(130, 1, 1, 11, '2021-05-02 01:22:21', '1'),
(131, 1, 1, 12, '2021-05-02 01:22:21', '1'),
(132, 1, 1, 14, '2021-05-02 01:22:21', '1'),
(133, 1, 1, 15, '2021-05-02 01:22:21', '1'),
(134, 1, 1, 17, '2021-05-02 01:22:21', '1'),
(135, 1, 1, 16, '2021-05-02 01:22:22', '1'),
(136, 1, 1, 18, '2021-05-02 01:22:22', '1'),
(137, 1, 1, 1, '2021-05-02 01:22:40', '1'),
(138, 1, 1, 2, '2021-05-02 01:22:40', '2'),
(139, 1, 1, 3, '2021-05-02 01:22:40', '3'),
(140, 1, 1, 4, '2021-05-02 01:22:40', '4'),
(141, 1, 1, 5, '2021-05-02 01:22:40', '5'),
(142, 1, 1, 6, '2021-05-02 01:22:41', '6'),
(143, 1, 1, 7, '2021-05-02 01:22:41', '7'),
(144, 1, 1, 8, '2021-05-02 01:22:41', '1'),
(145, 1, 1, 9, '2021-05-02 01:22:41', '1'),
(146, 1, 1, 10, '2021-05-02 01:22:41', '1'),
(147, 1, 1, 11, '2021-05-02 01:22:41', '1'),
(148, 1, 1, 12, '2021-05-02 01:22:41', '1'),
(149, 1, 1, 14, '2021-05-02 01:22:41', '1'),
(150, 1, 1, 15, '2021-05-02 01:22:41', '1'),
(151, 1, 1, 17, '2021-05-02 01:22:41', '1'),
(152, 1, 1, 16, '2021-05-02 01:22:41', '1'),
(153, 1, 1, 18, '2021-05-02 01:22:41', '1'),
(154, 1, 1, 1, '2021-05-02 01:23:35', '1'),
(155, 1, 1, 2, '2021-05-02 01:23:36', '2'),
(156, 1, 1, 3, '2021-05-02 01:23:36', '3'),
(157, 1, 1, 4, '2021-05-02 01:23:36', '4'),
(158, 1, 1, 5, '2021-05-02 01:23:36', '5'),
(159, 1, 1, 6, '2021-05-02 01:23:36', '6'),
(160, 1, 1, 7, '2021-05-02 01:23:36', '7'),
(161, 1, 1, 8, '2021-05-02 01:23:36', '1'),
(162, 1, 1, 9, '2021-05-02 01:23:36', '1'),
(163, 1, 1, 10, '2021-05-02 01:23:36', '1'),
(164, 1, 1, 11, '2021-05-02 01:23:36', '1'),
(165, 1, 1, 12, '2021-05-02 01:23:36', '1'),
(166, 1, 1, 14, '2021-05-02 01:23:36', '1'),
(167, 1, 1, 15, '2021-05-02 01:23:36', '1'),
(168, 1, 1, 17, '2021-05-02 01:23:36', '1'),
(169, 1, 1, 16, '2021-05-02 01:23:36', '1'),
(170, 1, 1, 18, '2021-05-02 01:23:36', '1'),
(171, 1, 1, 1, '2021-05-02 01:23:55', '1'),
(172, 1, 1, 2, '2021-05-02 01:23:55', '2'),
(173, 1, 1, 3, '2021-05-02 01:23:55', '3'),
(174, 1, 1, 4, '2021-05-02 01:23:55', '4'),
(175, 1, 1, 5, '2021-05-02 01:23:55', '5'),
(176, 1, 1, 6, '2021-05-02 01:23:55', '6'),
(177, 1, 1, 7, '2021-05-02 01:23:55', '7'),
(178, 1, 1, 8, '2021-05-02 01:23:55', '1'),
(179, 1, 1, 9, '2021-05-02 01:23:55', '1'),
(180, 1, 1, 10, '2021-05-02 01:23:56', '1'),
(181, 1, 1, 11, '2021-05-02 01:23:56', '1'),
(182, 1, 1, 12, '2021-05-02 01:23:56', '1'),
(183, 1, 1, 14, '2021-05-02 01:23:56', '1'),
(184, 1, 1, 15, '2021-05-02 01:23:56', '1'),
(185, 1, 1, 17, '2021-05-02 01:23:56', '1'),
(186, 1, 1, 16, '2021-05-02 01:23:56', '1'),
(187, 1, 1, 18, '2021-05-02 01:23:56', '1');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `emailid` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `lastlogin` datetime NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `emailid`, `password`, `username`, `lastlogin`, `name`) VALUES
(1, 'shahab6674@gmail.com', '21232f297a57a5a743894a0e4a801fc3', 'admin', '2021-04-28 17:10:31', 'egnion');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `connected_sensors`
--
ALTER TABLE `connected_sensors`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `di_pins`
--
ALTER TABLE `di_pins`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `esp32`
--
ALTER TABLE `esp32`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sensors`
--
ALTER TABLE `sensors`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `sensors_data`
--
ALTER TABLE `sensors_data`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `connected_sensors`
--
ALTER TABLE `connected_sensors`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `di_pins`
--
ALTER TABLE `di_pins`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `esp32`
--
ALTER TABLE `esp32`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `sensors`
--
ALTER TABLE `sensors`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `sensors_data`
--
ALTER TABLE `sensors_data`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=188;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
