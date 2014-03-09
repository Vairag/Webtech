-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 20, 2013 at 02:03 AM
-- Server version: 5.5.27
-- PHP Version: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ss_tobi`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `comment` varchar(1000) NOT NULL,
  `username` varchar(20) NOT NULL,
  `course_id` int(11) DEFAULT NULL,
  `attachment_id` int(11) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `comment`, `username`, `course_id`, `attachment_id`, `date`) VALUES
(1, 'hello', 'raja', NULL, 27, '0000-00-00 00:00:00'),
(2, 'like it', 'raja', NULL, 27, '0000-00-00 00:00:00'),
(3, 'loved it', 'raja', NULL, 27, '2013-01-19 22:33:59'),
(4, 'hello', 'raja', 18, NULL, '2013-01-20 00:43:40'),
(5, 'hi\r\n', 'raja', 18, NULL, '2013-01-20 00:45:33');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
