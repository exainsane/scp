-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 06, 2017 at 04:09 PM
-- Server version: 5.5.16
-- PHP Version: 5.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `marva_securitycheckpoint`
--

-- --------------------------------------------------------

--
-- Table structure for table `m_user`
--

CREATE TABLE IF NOT EXISTS `m_user` (
  `id` bigint(255) NOT NULL AUTO_INCREMENT,
  `_enable` tinyint(1) NOT NULL DEFAULT '1',
  `user_activated` tinyint(1) NOT NULL DEFAULT '1',
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `phone` varchar(16) NOT NULL,
  `email` varchar(255) NOT NULL,
  `shift` int(255) NOT NULL,
  `user_level` smallint(2) NOT NULL,
  `device_key` varchar(255) NOT NULL,
  `company_id` bigint(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `company_id` (`company_id`),
  KEY `shift` (`shift`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `m_user`
--

INSERT INTO `m_user` (`id`, `_enable`, `user_activated`, `username`, `password`, `firstname`, `lastname`, `address`, `phone`, `email`, `shift`, `user_level`, `device_key`, `company_id`) VALUES
(4, 1, 1, 'exainsane2', 'd0e0dc6c50861bb6199eb3482c8e3a95', 'Ridwan Nugroho', '', 'Bogor', '', '', 1, 0, '', 0);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `m_user`
--
ALTER TABLE `m_user`
  ADD CONSTRAINT `m_user_ibfk_1` FOREIGN KEY (`shift`) REFERENCES `m_shift` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
