-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 04, 2021 at 01:34 PM
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
  `sensor_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `connected_sensors`
--

INSERT INTO `connected_sensors` (`ID`, `label`, `esp_id`, `sensor_id`) VALUES
(83, 'Door-1', 15, 1),
(84, 'Temp-1', 15, 7),
(86, 'Switch-1', 15, 11),
(87, 'Vol-1', 15, 7),
(88, 'Fire-1', 15, 3),
(89, 'Door-2', 15, 1),
(90, 'Alarm-1', 15, 3),
(91, 'Smoke-1', 15, 2),
(92, 'Fire-3', 15, 3),
(93, 'AC-1', 15, 5),
(94, 'Comm-1', 15, 13),
(95, 'Switch-2', 15, 11),
(96, 'Switch-3', 15, 11),
(97, 'Relay-1', 15, 9),
(98, 'Remote-1', 15, 10),
(99, 'Relay-2', 15, 9),
(100, '0', 15, 0),
(101, '0', 15, 0),
(102, '0', 15, 0);

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
(15, 2, 'Test Esp', 0, '0'),
(16, 2, 'Test Esp-2', 0, '0');

-- --------------------------------------------------------

--
-- Table structure for table `output_controls`
--

CREATE TABLE `output_controls` (
  `ID` int(11) NOT NULL,
  `esp_id` int(11) NOT NULL,
  `output1` int(11) NOT NULL DEFAULT 2,
  `output2` int(11) NOT NULL DEFAULT 2,
  `output3` int(11) NOT NULL DEFAULT 2,
  `output4` int(11) NOT NULL DEFAULT 2,
  `output5` int(11) NOT NULL DEFAULT 2,
  `output6` int(11) NOT NULL DEFAULT 2
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `output_controls`
--

INSERT INTO `output_controls` (`ID`, `esp_id`, `output1`, `output2`, `output3`, `output4`, `output5`, `output6`) VALUES
(3, 15, 0, 0, 1, 0, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `pins`
--

CREATE TABLE `pins` (
  `ID` int(11) NOT NULL,
  `type` tinyint(1) NOT NULL,
  `pin_name` varchar(20) NOT NULL,
  `iomode` tinyint(1) NOT NULL,
  `pin_number` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pins`
--

INSERT INTO `pins` (`ID`, `type`, `pin_name`, `iomode`, `pin_number`) VALUES
(1, 1, 'GPIO13', 1, 13),
(2, 1, 'GPIO18', 1, 18),
(3, 1, 'GPIO19', 1, 19),
(4, 1, 'GPIO2', 1, 2),
(5, 1, 'GPIO23', 1, 23),
(6, 1, 'GPIO25', 1, 25),
(7, 1, 'GPIO26', 0, 26),
(8, 1, 'GPIO5', 0, 5),
(9, 1, 'GPIO27', 0, 27),
(10, 1, 'GPIO12', 0, 12),
(11, 1, 'GPIO14', 0, 14),
(12, 1, 'GPIO15', 0, 15),
(13, 0, 'GPIO34', 1, 34),
(14, 0, 'GPIO35', 1, 35),
(15, 0, 'GPIO36', 1, 36),
(16, 0, 'GPIO39', 1, 39),
(17, 0, 'GPIO32', 1, 32),
(18, 0, 'GPIO33', 1, 33),
(19, -1, 'RX-TX', -1, 40);

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
(13, 'Serial Interface Meter', -1, 2, -1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `sensors_data`
--

CREATE TABLE `sensors_data` (
  `ID` int(11) NOT NULL,
  `connected_sersor_id` int(11) NOT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `value` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sensors_data`
--

INSERT INTO `sensors_data` (`ID`, `connected_sersor_id`, `time`, `value`) VALUES
(188, 83, '2021-05-04 11:11:15', '0'),
(189, 88, '2021-05-04 11:28:58', '0'),
(190, 89, '2021-05-04 01:18:43', '1'),
(191, 90, '2021-05-04 11:28:53', '1'),
(192, 91, '2021-05-04 11:29:12', '0'),
(193, 92, '2021-05-04 01:18:54', '1');

-- --------------------------------------------------------

--
-- Table structure for table `used_pins`
--

CREATE TABLE `used_pins` (
  `ID` int(11) NOT NULL,
  `connected_sersor_id` int(11) NOT NULL,
  `pin_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `used_pins`
--

INSERT INTO `used_pins` (`ID`, `connected_sersor_id`, `pin_id`) VALUES
(70, 83, 1),
(71, 84, 13),
(72, 86, 7),
(73, 87, 14),
(74, 88, 2),
(75, 89, 3),
(76, 90, 4),
(77, 91, 5),
(78, 92, 6),
(79, 93, 15),
(80, 94, 19),
(81, 95, 8),
(82, 96, 9),
(83, 97, 10),
(84, 98, 11),
(85, 99, 12);

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
(1, 'shahab6674@gmail.com', 'a60d3e842fa9ab490e39460aa6e446b1', 'admin', '2021-04-28 17:10:31', 'egnion');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `connected_sensors`
--
ALTER TABLE `connected_sensors`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `esp32`
--
ALTER TABLE `esp32`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `output_controls`
--
ALTER TABLE `output_controls`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `pins`
--
ALTER TABLE `pins`
  ADD PRIMARY KEY (`ID`);

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
-- Indexes for table `used_pins`
--
ALTER TABLE `used_pins`
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
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- AUTO_INCREMENT for table `esp32`
--
ALTER TABLE `esp32`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `output_controls`
--
ALTER TABLE `output_controls`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `pins`
--
ALTER TABLE `pins`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `sensors`
--
ALTER TABLE `sensors`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `sensors_data`
--
ALTER TABLE `sensors_data`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=194;

--
-- AUTO_INCREMENT for table `used_pins`
--
ALTER TABLE `used_pins`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
