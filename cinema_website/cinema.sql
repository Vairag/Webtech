-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 24, 2014 at 09:36 PM
-- Server version: 5.5.27
-- PHP Version: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `cinema`
--

-- --------------------------------------------------------

--
-- Table structure for table `box_office_employees`
--

CREATE TABLE IF NOT EXISTS `box_office_employees` (
  `box_office_employees_id` varchar(30) COLLATE latin1_general_ci NOT NULL,
  `box_office_employees_pwd` varchar(30) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`box_office_employees_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `box_office_employees`
--

INSERT INTO `box_office_employees` (`box_office_employees_id`, `box_office_employees_pwd`) VALUES
('employee1', 'boxoffice'),
('raja', 'raja'),
('test', 'test');

-- --------------------------------------------------------

--
-- Table structure for table `reservation`
--

CREATE TABLE IF NOT EXISTS `reservation` (
  `reservation_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(30) COLLATE latin1_general_ci NOT NULL,
  `user_email` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `cinema_name` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `movie_name` varchar(60) COLLATE latin1_general_ci NOT NULL,
  `seats` varchar(100) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`reservation_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=27 ;

--
-- Dumping data for table `reservation`
--

INSERT INTO `reservation` (`reservation_id`, `user_name`, `user_email`, `cinema_name`, `movie_name`, `seats`) VALUES
(23, 'Alex', 'alex@gmail.com', 'Technische Hochschule Aachen', 'Agent Ranjid rettet die Welt', '60,70,80,90,100,110,113'),
(20, 'Mohamad', 'Mohamad@gmail.com', 'Filmstudio an der RWTH Aachen e.V.', '96 Hours - Taken 2', '82,85,25'),
(22, 'Arkadi', 'arkadi@gmail.com', 'Smoky Sex + Gay Discount & Kino', 'Hotel Trasilvanien', '57,67,77,87'),
(15, 'Tobias', 'tobi@gmail.com', 'Apollo Kino', 'Madagascar 3: Flucht nach Europa', '76,99,68'),
(1, 'Vairag', 'viru@gmail.com', 'Capitol', 'Skyfall', '57,,59,118,119'),
(24, 'Mahan', 'gvairagk@gmail.com', 'Capitol', 'Twilight: Breaking Dawn-Part 2', '24,34'),
(25, 'Ramesh', 'ramesh@gmail.con', 'Filmstudio an der RWTH Aachen e.V.', 'Hotel Transylvania', '112');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
