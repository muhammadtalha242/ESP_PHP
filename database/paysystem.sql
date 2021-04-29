-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 26, 2020 at 02:40 PM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.2.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `paysystem`
--

-- --------------------------------------------------------

--
-- Table structure for table `branch`
--

CREATE TABLE `branch` (
  `id` int(255) NOT NULL,
  `branch` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `detail` text NOT NULL,
  `delete_status` enum('0','1') NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `branch`
--

INSERT INTO `branch` (`id`, `branch`, `address`, `detail`, `delete_status`) VALUES
(1, 'Swindon Branch', '1788 Traction Street', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', '0'),
(2, 'Bristol Bedminster', '4705 School Street', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', '0'),
(3, 'Kingswood School', '3386 Rebecca Street', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', '0'),
(4, 'Marion Cross School', '22 Church St, Norwich', 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.', '0'),
(5, 'Birmingham', '22nd St S, Birmingham', 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.', '0');

-- --------------------------------------------------------

--
-- Table structure for table `fees_transaction`
--

CREATE TABLE `fees_transaction` (
  `id` int(255) NOT NULL,
  `stdid` varchar(255) NOT NULL,
  `paid` int(255) NOT NULL,
  `submitdate` datetime NOT NULL,
  `transcation_remark` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fees_transaction`
--

INSERT INTO `fees_transaction` (`id`, `stdid`, `paid`, `submitdate`, `transcation_remark`) VALUES
(1, '1', 100, '2017-11-01 00:00:00', ''),
(2, '2', 150, '2017-10-05 00:00:00', ''),
(3, '3', 900, '2017-04-13 00:00:00', 'monthly'),
(4, '3', 1000, '2018-04-01 00:00:00', 'lklk'),
(5, '4', 500, '2018-07-02 00:00:00', 'TEST'),
(6, '5', 1500, '2018-06-02 00:00:00', 'DEMO'),
(7, '6', 200, '2018-07-03 00:00:00', 'DEMO'),
(8, '7', 200, '2018-03-02 00:00:00', 'DEMO'),
(9, '8', 5000, '2017-01-03 00:00:00', 'DEMO'),
(10, '9', 2500, '2018-03-02 00:00:00', 'DEMO'),
(11, '10', 121, '2020-07-22 00:00:00', '12331'),
(12, '11', 12, '2020-07-14 00:00:00', ''),
(13, '12', 121, '2020-07-06 00:00:00', 'asasfs'),
(14, '13', 121, '2020-07-14 00:00:00', 'adfsd'),
(15, '14', 123, '2020-07-01 00:00:00', 'asd'),
(16, '0', 0, '2020-07-26 00:00:00', ''),
(17, '0', 0, '2020-07-14 00:00:00', ''),
(18, '0', 0, '2020-07-27 00:00:00', ''),
(19, '0', 0, '2020-07-13 00:00:00', ''),
(20, '0', 0, '2020-07-27 00:00:00', ''),
(21, '0', 0, '2020-07-28 00:00:00', ''),
(22, '0', 0, '2020-07-26 00:00:00', '');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `id` int(255) NOT NULL,
  `emailid` varchar(255) NOT NULL,
  `sname` varchar(255) NOT NULL,
  `joindate` datetime NOT NULL,
  `about` text NOT NULL,
  `contact` varchar(255) NOT NULL,
  `fees` varchar(255) NOT NULL,
  `branch` varchar(255) NOT NULL,
  `balance` int(255) NOT NULL,
  `delete_status` enum('0','1') NOT NULL DEFAULT '0',
  `wname` varchar(255) NOT NULL,
  `wpass` varchar(255) NOT NULL,
  `pcontact` varchar(255) NOT NULL,
  `pname` varchar(255) NOT NULL,
  `nosim` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`id`, `emailid`, `sname`, `joindate`, `about`, `contact`, `fees`, `branch`, `balance`, `delete_status`, `wname`, `wpass`, `pcontact`, `pname`, `nosim`) VALUES
(1, 'PaigeDoherty@gmail.com', 'Paige Doherty', '2017-11-01 00:00:00', 'Loreim Ipsum', '07785383', '100', 'asafdfsdsdfsdf', 0, '0', 'asdas', 'asdwdads', '023423', 'asdasd', '243242'),
(2, '1231231@gma.com', 'sada', '2020-07-22 00:00:00', '123', '3213231', '12312', '2', 12191, '0', 'abccs', 'asdasd', '023423', 'asdasd', '1232143');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `emailid` varchar(255) NOT NULL,
  `lastlogin` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `name`, `emailid`, `lastlogin`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'egnion', 'shahab6674@gmail.com', '0000-00-00 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `branch`
--
ALTER TABLE `branch`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fees_transaction`
--
ALTER TABLE `fees_transaction`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `branch`
--
ALTER TABLE `branch`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `fees_transaction`
--
ALTER TABLE `fees_transaction`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
