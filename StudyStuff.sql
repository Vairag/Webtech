-- phpMyAdmin SQL Dump
-- version 3.3.7deb7
-- http://www.phpmyadmin.net
--
-- Host: wp287.webpack.hosteurope.de
-- Erstellungszeit: 22. Januar 2013 um 11:05
-- Server Version: 5.5.28
-- PHP-Version: 5.3.3-7+squeeze14

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Datenbank: `db11005921-gallery`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `attachments`
--

CREATE TABLE IF NOT EXISTS `attachments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `comment` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `path` varchar(200) NOT NULL,
  `course_id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `downloads` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=31 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `comment` varchar(1000) NOT NULL,
  `username` varchar(20) NOT NULL,
  `course_id` int(11) DEFAULT NULL,
  `attachment_id` int(11) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `courses`
--

CREATE TABLE IF NOT EXISTS `courses` (
  `course_id` int(11) NOT NULL AUTO_INCREMENT,
  `uni_name` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `uni_id` int(11) NOT NULL,
  `course_image` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `field_of_study` varchar(30) COLLATE latin1_general_ci NOT NULL,
  `course_type` varchar(30) COLLATE latin1_general_ci NOT NULL,
  `course_name` varchar(40) COLLATE latin1_general_ci NOT NULL,
  `source_link` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `description` varchar(500) COLLATE latin1_general_ci NOT NULL,
  `related_links` varchar(200) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`course_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=30 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `ratings`
--

CREATE TABLE IF NOT EXISTS `ratings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `attachment_id` int(11) DEFAULT NULL,
  `course_id` int(11) DEFAULT NULL,
  `rating` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_german2_ci AUTO_INCREMENT=38 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `universities`
--

CREATE TABLE IF NOT EXISTS `universities` (
  `uni_id` int(11) NOT NULL AUTO_INCREMENT,
  `uni_name` varchar(50) NOT NULL,
  `uni_image` varchar(100) NOT NULL,
  `uni_src_link` varchar(100) NOT NULL,
  `uni_description` varchar(500) NOT NULL,
  `uni_city` varchar(30) NOT NULL,
  `uni_country` varchar(30) NOT NULL,
  PRIMARY KEY (`uni_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `username` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
