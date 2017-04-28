-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 22, 2016 at 01:51 AM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 7.0.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `carPool`
--

-- --------------------------------------------------------

--
-- Table structure for table `rideTable`
--

CREATE TABLE `rideTable` (
  `Ride_id` varchar(255) NOT NULL,
  `Member_id` varchar(255) NOT NULL,
  `SourceLat` varchar(255) NOT NULL,
  `SourceLong` varchar(255) NOT NULL,
  `DestinationLat` varchar(255) NOT NULL,
  `DestinationLong` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `Seats` int(255) NOT NULL,
  `Luggage` varchar(255) NOT NULL,
  `Weekly` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rideTable`
--

INSERT INTO `rideTable` (`Ride_id`, `Member_id`, `SourceLat`, `SourceLong`, `DestinationLat`, `DestinationLong`, `date`, `Seats`, `Luggage`, `Weekly`) VALUES
('2SLP7GWG', '5TWC15', '40.7405811', '-74.0614867', '40.7109684', '-74.0047403', '2016-12-22', 2, 'Yes', 'Yes'),
('UTLZ34IR', '5TWC15', '40.7345715', '-74.0631544', 'NaN', 'undefined', '2016-12-23', 3, 'Yes', 'Yes'),
('IK0JLT3O', '5TWC15', '40.7345715', '-74.0631544', '40.7109684', '-74.0047403', '2016-12-23', 4, 'Yes', 'Yes'),
('9BCVJZUQ', '5TWC15', '40.7405811', '-74.0614867', '40.7109684', '-74.0047403', '2016-12-22', 2, 'Yes', 'Yes'),
('18LJWCHC', '5TWC15', '40.7428013', '-74.0618286', '40.7118011', '-74.0131196', '2016-12-22', 3, 'Yes', 'Yes'),
('4I00O5B1', '5TWC15', '40.6639916', '-74.2107006', '40.7109684', '-74.0047403', '2016-12-22', 2, 'Yes', 'Yes'),
('B4MZS5GL', 'U0MNRD', '40.7828647', '-73.9653551', '40.7109684', '-74.0047403', '2016-12-30', 2, 'Yes', 'No'),
('FIHKGI69', '5TWC15', '40.7405811', '-74.0614867', '40.7089834', '-73.9643758', '2016-12-22', 2, 'No', 'No'),
('GWVRA07F', '5TWC15', '40.7405811', '-74.0614867', '40.7109684', '-74.0047403', '2016-12-22', 4, 'Yes', 'Yes'),
('O5IYGLWG', '5TWC15', '40.7334745', '-73.995068', '40.7519523', '-73.9903018', '2016-12-24', 4, 'Yes', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `userProfile`
--

CREATE TABLE `userProfile` (
  `Member_id` varchar(255) NOT NULL,
  `Email_id` varchar(255) NOT NULL,
  `First_name` varchar(255) NOT NULL,
  `Last_name` varchar(255) NOT NULL,
  `Phone_number` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Driver` tinyint(1) NOT NULL DEFAULT '0',
  `Rider` tinyint(1) NOT NULL DEFAULT '1',
  `Active` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `userProfile`
--

INSERT INTO `userProfile` (`Member_id`, `Email_id`, `First_name`, `Last_name`, `Phone_number`, `Password`, `Driver`, `Rider`, `Active`) VALUES
('5TWC15', 'samps01@gmail.com', 'samson', 'pallivathukkal', '5512270034', 'samps01', 1, 1, 1),
('2CM4EY', 'sa@gm.cm', 'samson', 'pallivathukkal', '5512270034', 'sa', 0, 1, 1),
('U11NWH', 'samps01@yahoo.com', 'samson', 'pallivathukkal', '5512270034', 'samos01', 1, 1, 1),
('6WQ06N', 'sp03075n@pace.edu', 'samson', 'pallivathukkal', '5512270034', 'samps01', 0, 1, 1),
('WS8TCP', 'rocky@gmail.com', 'rocky', 'ps', '1231241251', 'samps01', 0, 1, 1),
('U0MNRD', 'rocky@yahoo.com', 'rock', 'sp', '124151351', 'samps01', 1, 1, 1),
('E6VBAR', 'user@hotmail.com', 'user', 'sample', '5512249901', 'samps01', 1, 1, 1),
('ST59ZM', 'test@ebay.com', 'samson', 'pallivathukkal', '5512270034', 'samps01', 0, 1, 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
