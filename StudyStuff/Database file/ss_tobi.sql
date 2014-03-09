-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 19, 2013 at 12:29 AM
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
-- Table structure for table `attachments`
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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=28 ;

--
-- Dumping data for table `attachments`
--

INSERT INTO `attachments` (`id`, `name`, `comment`, `date`, `path`, `course_id`, `username`, `downloads`) VALUES
(13, 'Webtech PPT schedule', 'This is a Powerpoint of the schedule for the webtech course...<br>\r\nLorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea tak.\r\n', '2013-01-08 12:00:00', './attachments/course19/WebTech-Presentations-Schedule.pdf', 18, 'vruta', 0),
(14, 'further literature', '', '2013-01-17 23:00:00', './attachments/course19/further literature.txt', 21, 'alex', 0),
(15, 'short summary', '', '2013-01-17 23:27:00', './attachments/course19/short summary of Further literature.docx', 22, 'alex', 0),
(16, 'Student talk', '', '2013-01-15 23:42:00', './attachments/course19/Student-talk-WebTech-Presentations-Schedule.pdf', 25, 'tobias', 0),
(26, 'Awards', '', '2013-01-18 22:49:05', './attachments/course18/awards.png', 18, 'vruta', 0),
(21, 'km', '', '2013-01-15 23:46:39', './attachments/course19/2012-12-07 11.53.56.jpg', 18, 'alex', 0),
(22, 'anyfile', '', '2013-01-14 15:00:00', './attachments/course19/avformat-54.dll', 18, 'tobias', 0),
(24, 'Mailing list', '', '2013-01-15 14:34:00', './attachments/course19/mailinglist.txt', 22, 'vruta', 0),
(27, 'Liferay', '', '2013-01-18 23:13:11', './attachments/course18/1.jpg', 18, 'vruta', 0);

-- --------------------------------------------------------

--
-- Table structure for table `courses`
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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=27 ;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`course_id`, `uni_name`, `uni_id`, `course_image`, `field_of_study`, `course_type`, `course_name`, `source_link`, `description`, `related_links`) VALUES
(18, 'University of  Bonn', 5, 'upload/uni_bonn.png', 'Engineering', 'Masters', 'Computer Science', 'http://www.informatik.uni-bonn.de/for-students/master-of-science-in-computer-science/', 'The expression is considered simplified when all like terms have been combined, and all terms present are unlike. In this case, all terms now have different unknown factors, and are thus unlike, and so the expression is completely simplified.', 'http://www.informatik.uni-bonn.de/for-students/master-of-science-in-computer-science/'),
(21, 'University of Berlin', 6, 'upload/free_university_berlin_de.jpg', 'Arts', 'Bachelors', 'literature', 'http://www.w3schools.com/html/html_entities.asp', 'Question: Is there an HTML space tag?\nIt can be very frustrating to add a bunch of spaces to your HTML only to have them disappear because of how HTML handles spaces. An HTML space tag would be very convenient for creating spaces.\n\nAnswer:\nThere is no such thing as an HTML space tag. This is unfortunate, as HTML compresses all space characters (tabs, spaces, even carriage returns) down to one character. This means that if youâ€™re going to indent your paragraphs.', 'http://www.w3schools.com/html/html_entities.asp'),
(22, 'RWTH Aachen University', 4, 'upload/rwth.jpg', 'Engineering', 'Masters', 'Media Informatics', 'http://mi.b-it-center.de/', 'Programme Overview\n\nIn Media Informatics you will have courses from the following areas:\n- Computer and Communication Technology\n- Multimedia Technology\n- Multimedia Use and Impact\n- Lab work\n- Communication Skills', 'http://www.rwth-aachen.de/'),
(25, 'Dharmsigh Desai University', 1, 'upload/ddu.jpg', 'Engineering', 'Bachelors', 'Electrical Engineering', 'www.ddu.ac.in', 'Very nice course.', 'www.ddu.ac.in'),
(26, 'University of Berlin', 6, 'upload/free_university_berlin_de.jpg', 'Others', 'Masters', 'Dance Studies', 'http://www.fu-berlin.de/en/studium/studienangebot/master/tanzwissenschaft/index.html', 'Dance lover should choose this nice course.', 'http://www.fu-berlin.de');

-- --------------------------------------------------------

--
-- Table structure for table `ratings`
--

CREATE TABLE IF NOT EXISTS `ratings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `attachment_id` int(11) DEFAULT NULL,
  `course_id` int(11) DEFAULT NULL,
  `rating` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_german2_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `ratings`
--

INSERT INTO `ratings` (`id`, `attachment_id`, `course_id`, `rating`) VALUES
(1, 13, NULL, 3);

-- --------------------------------------------------------

--
-- Table structure for table `universities`
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `universities`
--

INSERT INTO `universities` (`uni_id`, `uni_name`, `uni_image`, `uni_src_link`, `uni_description`, `uni_city`, `uni_country`) VALUES
(1, 'Dharmsigh Desai University', 'upload/ddu.jpg', 'http://www.ddu.ac.in/', 'Hello DDITians....', 'Nadiad', 'India'),
(2, 'Nirma University', 'upload/nirma.jpg', 'http://www.nirmauni.ac.in/', 'Best University for All Engineering courses.', 'Ahmedabad', 'India'),
(3, 'L D engineetring College', 'upload/L.D.-College.jpg', 'http://www.ldceahd.org/', 'Lalbhai Dalpatbhai College of Engineering, located in Ahmedabad, India. It was established in 1948 by Kasturbhai Lalbhai, and is named after his father.', 'Ahmedabad', 'India'),
(4, 'RWTH Aachen University', 'upload/rwth.jpg', 'http://www.rwth-aachen.de/', 'With 260 institutes, RWTH Aachen University is one of Europe''s premier educational and research institutions. The Universityâ€™s nine faculties offer a wide range of academic subjects, including most traditional academic disciplines. Around 480 professors and almost 4,000 staff are working in research, teaching, and administration.', 'Aachen', 'Germany'),
(5, 'University of  Bonn', 'upload/univ_bonn.png', 'http://www3.uni-bonn.de/', 'Very good and reputed University of Germany.', 'Bonn', 'Germany'),
(6, 'University of Berlin', 'upload/free_university_berlin.jpg', 'http://www.fu-berlin.de/en/', 'Nice university.', 'Berlin', 'Germany'),
(7, 'UniversitÃ¤t zu KÃ¶ln', 'upload/uni_cologne.jpg', 'http://www.uni-koeln.de/', 'Very good University in NRW !!', 'Cologne', 'Germany');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `username` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `email`, `password`) VALUES
('alex', 'faedas@gmail.com', 'alex'),
('pappu', 'gvairagk@gmail.com', 'pappu'),
('Vairag', 'g.vairag@yahoo.com', 'viru'),
('vruta', 'gvairagk@gmail.com', 'vruta'),
('tobias', 'liebeisttobi@gmail.com', 'foobar');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
