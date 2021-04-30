-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 30, 2021 at 05:53 PM
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
(16, 'Home-16', 5, 11, '13');

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
  `time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `value` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sensors_data`
--

INSERT INTO `sensors_data` (`ID`, `connected_sersor_id`, `time`, `value`) VALUES
(3, 1, '2021-04-29 16:16:41', '0'),
(4, 2, '2021-04-29 16:16:41', '1'),
(5, 3, '2021-04-29 16:16:41', '2'),
(6, 4, '2021-04-29 16:16:42', '0'),
(7, 5, '2021-04-29 16:16:42', '0'),
(8, 6, '2021-04-29 16:16:42', '0'),
(9, 7, '2021-04-29 16:16:42', '32'),
(10, 8, '2021-04-29 16:16:42', '0'),
(11, 9, '2021-04-29 16:16:42', '0'),
(12, 10, '2021-04-29 16:16:42', '2'),
(13, 11, '2021-04-29 16:16:42', '0'),
(14, 12, '2021-04-29 16:16:42', '1'),
(15, 13, '2021-04-29 16:16:42', '0'),
(16, 14, '2021-04-29 16:16:42', '1'),
(17, 15, '2021-04-29 16:16:42', '0'),
(18, 16, '2021-04-29 16:16:42', '0');

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
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

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
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
