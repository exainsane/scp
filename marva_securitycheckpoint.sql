-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 11, 2017 at 05:29 PM
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
CREATE DATABASE IF NOT EXISTS `marva_securitycheckpoint` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `marva_securitycheckpoint`;

-- --------------------------------------------------------

--
-- Table structure for table `m_company`
--

CREATE TABLE IF NOT EXISTS `m_company` (
  `id` bigint(255) NOT NULL AUTO_INCREMENT,
  `_enable` tinyint(1) NOT NULL DEFAULT '1',
  `company_name` varchar(255) NOT NULL,
  `company_address` text NOT NULL,
  `company_phone` varchar(16) NOT NULL,
  `company_email` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `m_company`
--

INSERT INTO `m_company` (`id`, `_enable`, `company_name`, `company_address`, `company_phone`, `company_email`) VALUES
(1, 1, 'exatcmpn', '', '', ''),
(2, 1, 'exatcmpn2', '', '', ''),
(3, 1, 'exatcmpn23', '', '', ''),
(4, 1, 'exatcmpn23', '', '', ''),
(5, 1, 'exatcmpn23', '', '', ''),
(6, 1, 'exatcmpn23', '', '', ''),
(7, 1, 'exatcmpn23', '', '', ''),
(8, 1, 'exatcmpn23', '', '', ''),
(9, 1, 'exatcmpn23', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `m_device_key`
--

CREATE TABLE IF NOT EXISTS `m_device_key` (
  `id` bigint(255) NOT NULL AUTO_INCREMENT,
  `_enable` tinyint(1) NOT NULL DEFAULT '1',
  `used_by` bigint(255) NOT NULL,
  `for_company` bigint(255) NOT NULL,
  `device_key` varchar(255) NOT NULL,
  `verified` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `used_by` (`used_by`),
  KEY `for_company` (`for_company`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `m_device_key`
--

INSERT INTO `m_device_key` (`id`, `_enable`, `used_by`, `for_company`, `device_key`, `verified`) VALUES
(1, 1, 4, 0, '000101011010100101001010010101', 0);

-- --------------------------------------------------------

--
-- Table structure for table `m_point`
--

CREATE TABLE IF NOT EXISTS `m_point` (
  `id` bigint(255) NOT NULL AUTO_INCREMENT,
  `_enable` tinyint(1) NOT NULL DEFAULT '1',
  `point_name` varchar(255) NOT NULL,
  `point_lat` decimal(18,4) NOT NULL,
  `point_long` decimal(18,4) NOT NULL,
  `point_key` varchar(255) DEFAULT NULL,
  `point_code` varchar(255) NOT NULL,
  `company_id` bigint(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `company_id` (`company_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `m_point`
--

INSERT INTO `m_point` (`id`, `_enable`, `point_name`, `point_lat`, `point_long`, `point_key`, `point_code`, `company_id`) VALUES
(1, 1, 'Pos A1', '0.0000', '0.0000', '-', '', 0),
(2, 1, 'Pos B1', '0.0000', '0.0000', '-', '', 0),
(3, 1, 'Pos C1', '0.0000', '0.0000', '-', '', 0),
(4, 1, 'Pos D1', '0.0000', '0.0000', '-', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `m_point_key`
--

CREATE TABLE IF NOT EXISTS `m_point_key` (
  `id` bigint(255) NOT NULL AUTO_INCREMENT,
  `_enable` tinyint(1) NOT NULL DEFAULT '1',
  `used_by` bigint(255) DEFAULT NULL,
  `for_company` bigint(255) NOT NULL,
  `point_key` varchar(255) NOT NULL,
  `verified` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `used_by` (`used_by`),
  KEY `for_company` (`for_company`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `m_schedule`
--

CREATE TABLE IF NOT EXISTS `m_schedule` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `_enable` tinyint(1) NOT NULL DEFAULT '1',
  `shift_id` int(255) NOT NULL,
  `point_id` bigint(255) NOT NULL,
  `schedule_base` varchar(8) NOT NULL DEFAULT '00:00:00',
  `after` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `shift_id` (`shift_id`),
  KEY `point_id` (`point_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `m_schedule`
--

INSERT INTO `m_schedule` (`id`, `_enable`, `shift_id`, `point_id`, `schedule_base`, `after`) VALUES
(7, 1, 1, 1, '12:00:00', 0),
(8, 1, 1, 2, '-', 60),
(9, 1, 1, 3, '-', 120),
(10, 1, 1, 4, '-', 240),
(11, 1, 2, 1, '18:00:00', 0),
(12, 1, 2, 2, '-', 120),
(13, 1, 2, 3, '-', 180),
(14, 1, 2, 4, '-', 240);

-- --------------------------------------------------------

--
-- Table structure for table `m_shift`
--

CREATE TABLE IF NOT EXISTS `m_shift` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `_enable` tinyint(1) NOT NULL DEFAULT '1',
  `title` text NOT NULL,
  `company_id` bigint(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `company_id` (`company_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `m_shift`
--

INSERT INTO `m_shift` (`id`, `_enable`, `title`, `company_id`) VALUES
(1, 1, 'Shift 1 : Siang', 0),
(2, 1, 'Shift 2 : Malam', 0),
(3, 1, 'Shift 3 : Pagi', 0),
(4, 0, 'Shift 3', 0),
(5, 0, 'Shift 3', 0),
(6, 0, 'Shift 3', 0),
(7, 0, 'Shift 3', 0),
(8, 0, 'Shift 3', 0),
(9, 0, 'Shift 3', 0);

-- --------------------------------------------------------

--
-- Table structure for table `m_token`
--

CREATE TABLE IF NOT EXISTS `m_token` (
  `id` bigint(255) NOT NULL AUTO_INCREMENT,
  `id_user` bigint(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_user_2` (`id_user`),
  KEY `id_user` (`id_user`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=115 ;

--
-- Dumping data for table `m_token`
--

INSERT INTO `m_token` (`id`, `id_user`, `token`) VALUES
(106, 8, 'KT6hrcKp3TcDEgfURXfIKf42WO1jvUXw3eg8E1I8VWHWX'),
(110, 4, 'epeum7XA5BdW6fqHCSzroQ8fBZ4HYFOUKHptCsguPKmw5'),
(114, 7, 'w313oq7ejgoMShbbeFlnUadR3ZDAeRW2w11ay89soseRE');

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
  `last_active` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `company_id` (`company_id`),
  KEY `shift` (`shift`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `m_user`
--

INSERT INTO `m_user` (`id`, `_enable`, `user_activated`, `username`, `password`, `firstname`, `lastname`, `address`, `phone`, `email`, `shift`, `user_level`, `device_key`, `company_id`, `last_active`) VALUES
(4, 1, 1, 'exainsane22', 'd0e0dc6c50861bb6199eb3482c8e3a95', 'Ridwan', 'Nugroho', 'Nanggewer RT 01 RW 07', '+6287870980562', 'rnugraha305@gmail.com', 1, 10, '', 0, '2017-02-11 08:11:20'),
(7, 1, 1, 'exainsane', 'd0e0dc6c50861bb6199eb3482c8e3a95', 'Ridwan', 'Nugroho', 'Nanggewer RT 01 RW 07, Kp Tarikolot No 56', '87870980562', 'rnugraha305@gmail.com', 1, 9, '', 0, '2017-02-11 10:36:06'),
(8, 1, 1, 'exairie', 'd0e0dc6c50861bb6199eb3482c8e3a95', 'Ridwan', 'Nugroho', 'Nanggewer RT 01 RW 07 No 56 Babakan Tarikolot, Cibinong', '087870980562', 'user@exainsane.com', 2, 0, '', 0, '2017-02-11 08:00:20'),
(9, 1, 1, 'administrator', '0192023a7bbd73250516f069df18b500', 'Marva Cipta', 'Admin', '-', '-', 'admin@exairie.net', 3, 999, '', 0, '2017-02-11 09:34:53');

-- --------------------------------------------------------

--
-- Table structure for table `m_user_level`
--

CREATE TABLE IF NOT EXISTS `m_user_level` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `_enable` tinyint(1) NOT NULL DEFAULT '1',
  `level_name` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `t_checkout`
--

CREATE TABLE IF NOT EXISTS `t_checkout` (
  `id` bigint(255) NOT NULL AUTO_INCREMENT,
  `_enable` tinyint(1) NOT NULL DEFAULT '1',
  `point_id` bigint(255) NOT NULL,
  `user_id` bigint(255) NOT NULL,
  `checkout_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `schedule_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `point_name` varchar(255) NOT NULL,
  `point_lat` decimal(18,4) NOT NULL,
  `point_long` decimal(18,4) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `point_id` (`point_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `t_device_key_request`
--

CREATE TABLE IF NOT EXISTS `t_device_key_request` (
  `id` bigint(255) NOT NULL AUTO_INCREMENT,
  `_enable` tinyint(1) NOT NULL DEFAULT '1',
  `request_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user_id` bigint(255) NOT NULL,
  `request_by` int(255) NOT NULL,
  `approved` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `t_device_key_request`
--

INSERT INTO `t_device_key_request` (`id`, `_enable`, `request_time`, `user_id`, `request_by`, `approved`) VALUES
(1, 1, '2017-02-11 15:38:13', 4, 9999, 0);

-- --------------------------------------------------------

--
-- Table structure for table `t_event_report`
--

CREATE TABLE IF NOT EXISTS `t_event_report` (
  `id` bigint(255) NOT NULL AUTO_INCREMENT,
  `_enable` tinyint(1) NOT NULL DEFAULT '1',
  `user_id` bigint(255) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `point_name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `point_lat` decimal(18,4) NOT NULL,
  `point_long` decimal(18,4) NOT NULL,
  `img` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `t_point_key_request`
--

CREATE TABLE IF NOT EXISTS `t_point_key_request` (
  `id` bigint(255) NOT NULL AUTO_INCREMENT,
  `_enable` tinyint(1) NOT NULL DEFAULT '1',
  `request_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `point_id` bigint(255) NOT NULL,
  `request_by` bigint(255) NOT NULL,
  `approved` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `point_id` (`point_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `t_point_key_request`
--

INSERT INTO `t_point_key_request` (`id`, `_enable`, `request_time`, `point_id`, `request_by`, `approved`) VALUES
(1, 1, '2017-02-11 15:45:33', 1, 9999, 0),
(2, 1, '2017-02-11 15:46:23', 4, 9999, 0),
(3, 1, '2017-02-11 16:18:14', 2, 9999, 0),
(4, 1, '2017-02-11 16:20:35', 3, 9999, 0);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `m_device_key`
--
ALTER TABLE `m_device_key`
  ADD CONSTRAINT `m_device_key_ibfk_1` FOREIGN KEY (`used_by`) REFERENCES `m_user` (`id`);

--
-- Constraints for table `m_point_key`
--
ALTER TABLE `m_point_key`
  ADD CONSTRAINT `m_point_key_ibfk_1` FOREIGN KEY (`used_by`) REFERENCES `m_point` (`id`);

--
-- Constraints for table `m_schedule`
--
ALTER TABLE `m_schedule`
  ADD CONSTRAINT `m_schedule_ibfk_1` FOREIGN KEY (`shift_id`) REFERENCES `m_shift` (`id`),
  ADD CONSTRAINT `m_schedule_ibfk_2` FOREIGN KEY (`point_id`) REFERENCES `m_point` (`id`);

--
-- Constraints for table `m_token`
--
ALTER TABLE `m_token`
  ADD CONSTRAINT `m_token_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `m_user` (`id`);

--
-- Constraints for table `m_user`
--
ALTER TABLE `m_user`
  ADD CONSTRAINT `m_user_ibfk_1` FOREIGN KEY (`shift`) REFERENCES `m_shift` (`id`);

--
-- Constraints for table `t_checkout`
--
ALTER TABLE `t_checkout`
  ADD CONSTRAINT `t_checkout_ibfk_1` FOREIGN KEY (`point_id`) REFERENCES `m_point` (`id`),
  ADD CONSTRAINT `t_checkout_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `m_user` (`id`);

--
-- Constraints for table `t_event_report`
--
ALTER TABLE `t_event_report`
  ADD CONSTRAINT `t_event_report_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `m_user` (`id`);

--
-- Constraints for table `t_point_key_request`
--
ALTER TABLE `t_point_key_request`
  ADD CONSTRAINT `t_point_key_request_ibfk_1` FOREIGN KEY (`point_id`) REFERENCES `m_point` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
