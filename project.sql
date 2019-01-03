-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 23, 2018 at 01:29 PM
-- Server version: 10.1.32-MariaDB
-- PHP Version: 5.6.36

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project`
--

-- --------------------------------------------------------

--
-- Table structure for table `asset`
--

CREATE TABLE `asset` (
  `SERIALNO` varchar(40) NOT NULL,
  `DETAIL` varchar(30) NOT NULL,
  `MACADD` varchar(20) NOT NULL,
  `IPADD` varchar(20) DEFAULT NULL,
  `HOSTNAME` varchar(30) DEFAULT NULL,
  `STATUS` char(20) NOT NULL,
  `VEN_NAME` char(40) DEFAULT NULL,
  `VEN_CONTACT` varchar(20) DEFAULT NULL,
  `LOCATIONID` int(30) NOT NULL,
  `CATEGORYID` int(30) NOT NULL,
  `TRANSFERID` int(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `asset`
--

INSERT INTO `asset` (`SERIALNO`, `DETAIL`, `MACADD`, `IPADD`, `HOSTNAME`, `STATUS`, `VEN_NAME`, `VEN_CONTACT`, `LOCATIONID`, `CATEGORYID`, `TRANSFERID`) VALUES
('FOC1648D0BR', 'DEPLOYED', '24:01:C3:F1:05:85', '', 'NA', 'IN USE', 'ABCDE', '12345678', 1, 1, 1),
('FOC1648L0BS', 'DEPLOYED', '24:01:C4:F9:05:84', '', 'NA', 'IN USE', '', '', 2, 8, NULL),
('FOC1648P0B3', 'IN', '24:01:C7:F6:04:83', '', 'NA', 'NOT IN USE', 'QWET', '123456789', 1, 5, 1),
('FOC1648S0BT', 'DEPLOYED', '24:01:C2:F6:05:87', '', 'PQR', 'IN USE', 'POI', '', 1, 6, NULL),
('FOC1648X0BP', 'DEPLOYED', '24:01:C7:F8:05:80', '192.168.2.5', 'NA', 'IN USE', '', '', 1, 2, NULL),
('FOC1648X0BS', 'DEPLOYED', '24:01:C7:F8:04:81', '', 'ABC', 'IN USE', '', '', 1, 3, NULL),
('FOC1648X0CQ', 'DEPLOYED', '24:01:B7:S8:05:82', '192.167.5.5', 'XYZ', 'IN USE', '', '', 2, 4, NULL),
('FOC1648X4BA', 'IN STORE', '24:01:C7:F5:01:80', '', 'NA', 'NOT IN USE', '', '', 1, 1, 1),
('FOC1648Y1BP', 'IN STORE', '24:01:C8:F7:05:80', '', 'NA', 'NOT IN USE', '', '', 2, 3, 1),
('FOC2648Z1BP', 'IN STORE', '24:05:C3:F8:05:87', '', 'NA', 'NOT IN USE', '', '', 2, 5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `CAT_ID` int(25) NOT NULL,
  `CAT` varchar(50) NOT NULL,
  `MODEL` varchar(50) NOT NULL,
  `MAKE` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`CAT_ID`, `CAT`, `MODEL`, `MAKE`) VALUES
(1, 'SWITCH', '2960', 'CISCO'),
(2, 'SWITCH', '2960POE', 'CISCO'),
(3, 'PRINTER', '4231', 'CANNON'),
(4, 'PRINTER', 'M725N', 'HP'),
(5, 'PRINTER', 'M775C', 'HP'),
(6, 'PRINTER', '2520', 'CANNON'),
(7, 'ACCESS POINT', '3500', 'CISCO'),
(8, 'ACCESS POINT', 'M001', 'CISCO');

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE `location` (
  `LOC_ID` int(25) NOT NULL,
  `OFFICETYPE` varchar(50) NOT NULL,
  `CITY` varchar(50) NOT NULL,
  `STATE` varchar(50) NOT NULL,
  `OFFICELOC` varchar(100) NOT NULL,
  `OFFICEADD` varchar(800) NOT NULL,
  `NAME` varchar(50) NOT NULL,
  `CONTACT` int(20) NOT NULL,
  `EMAIL` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`LOC_ID`, `OFFICETYPE`, `CITY`, `STATE`, `OFFICELOC`, `OFFICEADD`, `NAME`, `CONTACT`, `EMAIL`) VALUES
(1, 'STATE OFFICE', 'GURGAON', 'DELHI', 'R K FOUR SQUARE', 'LOCATION 1', 'ABC', 1234567890, 'ABC@RIL.COM'),
(2, 'JIO CENTER', 'GURGAON', 'DELHI', 'R K FOUR SQUARE', 'LOCATION 2', 'ABC', 1234567890, 'ABC@RIL.COM'),
(3, 'WARE HOUSE', 'MUMBAI', 'MUMBAI', 'R K FOUR SQUARE', 'LOCATION 2', 'ABC', 1234567890, 'ABC@RIL.COM');

-- --------------------------------------------------------

--
-- Table structure for table `transfer`
--

CREATE TABLE `transfer` (
  `TRA_ID` int(30) NOT NULL,
  `STN` varchar(30) NOT NULL,
  `STNDATE` date NOT NULL,
  `GRN` varchar(30) DEFAULT NULL,
  `GRNDATE` date DEFAULT NULL,
  `GATEPASS` varchar(30) DEFAULT NULL,
  `STO` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transfer`
--

INSERT INTO `transfer` (`TRA_ID`, `STN`, `STNDATE`, `GRN`, `GRNDATE`, `GATEPASS`, `STO`) VALUES
(1, '3118427230001620', '2043-02-01', '5000386747', '0000-00-00', '372171', '600179456'),

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` varchar(25) NOT NULL,
  `user_pwd` varchar(25) NOT NULL,
  `user_type` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_pwd`, `user_type`) VALUES
('admin', 'test123', 2),
('super', 'test123', 3),
('user', 'test123', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `asset`
--
ALTER TABLE `asset`
  ADD PRIMARY KEY (`SERIALNO`),
  ADD KEY `LOCATIONID` (`LOCATIONID`),
  ADD KEY `CATEGORYID` (`CATEGORYID`),
  ADD KEY `TRANSFERID` (`TRANSFERID`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`CAT_ID`);

--
-- Indexes for table `location`
--
ALTER TABLE `location`
  ADD PRIMARY KEY (`LOC_ID`);

--
-- Indexes for table `transfer`
--
ALTER TABLE `transfer`
  ADD PRIMARY KEY (`TRA_ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `CAT_ID` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `location`
--
ALTER TABLE `location`
  MODIFY `LOC_ID` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `transfer`
--
ALTER TABLE `transfer`
  MODIFY `TRA_ID` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `asset`
--
ALTER TABLE `asset`
  ADD CONSTRAINT `asset_ibfk_1` FOREIGN KEY (`LOCATIONID`) REFERENCES `location` (`LOC_ID`),
  ADD CONSTRAINT `asset_ibfk_2` FOREIGN KEY (`CATEGORYID`) REFERENCES `category` (`CAT_ID`),
  ADD CONSTRAINT `asset_ibfk_3` FOREIGN KEY (`TRANSFERID`) REFERENCES `transfer` (`TRA_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
