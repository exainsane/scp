-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 24, 2017 at 04:36 AM
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
-- Table structure for table `log`
--

CREATE TABLE IF NOT EXISTS `log` (
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `msg` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `log`
--

INSERT INTO `log` (`timestamp`, `msg`) VALUES
('2017-02-12 11:13:31', 'SELECT *\nFROM `m_point_key`\nWHERE `_enable` = 1\nAND `point_key` = ''12345678912345678911'''),
('2017-02-12 11:13:31', 'SELECT *\nFROM `m_point`\nWHERE `_enable` = 1'),
('2017-02-14 10:51:09', 'INSERT INTO `m_token` (`id_user`, `token`) VALUES (''7'', ''kJpsqQNtrXrOR8wlFXMojyqNLvbUvSgAtjo9bQLsy89Q6'')'),
('2017-02-14 10:55:32', 'INSERT INTO `m_token` (`id_user`, `token`) VALUES (''7'', ''ytITOmFXb663JTN95vbHj82GZuIAgM5mGLttnDISU6b6o'')'),
('2017-02-14 11:03:48', 'INSERT INTO `m_token` (`id_user`, `token`) VALUES (''7'', ''JGjrAfA6dUSnrCM1DSmfDCfKMluMUYI3o21K2sYDdJGTJ'')'),
('2017-02-14 11:04:42', 'INSERT INTO `t_event_report` (`user_id`, `point_name`, `description`, `img`) VALUES (''7'', ''vsgs'', ''hshs'', ''assets/images/uploads/uploadimg.jpg'')'),
('2017-02-14 11:05:11', 'INSERT INTO `t_event_report` (`user_id`, `point_name`, `description`, `img`) VALUES (''7'', ''vsgs'', ''hshs'', ''assets/images/uploads/uploadimg.jpg'')'),
('2017-02-14 11:07:14', 'INSERT INTO `t_event_report` (`user_id`, `point_name`, `description`, `img`) VALUES (''7'', ''tttt'', ''t'', ''assets/images/uploads/SCPEVENTREPORT-1487070414635.jpg'')'),
('2017-02-14 11:09:34', 'UPLOADING form-img'),
('2017-02-14 11:09:34', 'INSERT INTO `t_event_report` (`user_id`, `point_name`, `description`, `img`) VALUES (''7'', ''. ndhd'', ''jfjr'', ''assets/images/uploads/SCPEVENTREPORT-1487070554043.jpg'')'),
('2017-02-14 11:11:32', 'INSERT INTO `t_event_report` (`user_id`, `img`) VALUES (''7'', ''assets/images/uploads/SCPEVENTREPORT-1487070674787.jpg'')'),
('2017-02-14 11:16:52', 'INSERT INTO `t_event_report` (`user_id`, `img`) VALUES (''7'', ''assets/images/uploads/14870710126jpg.jpg'')'),
('2017-02-14 11:17:41', 'INSERT INTO `t_event_report` (`user_id`, `img`) VALUES (''7'', ''assets/images/uploads/14870710616jpg.jpg'')'),
('2017-02-14 11:51:56', 'INSERT INTO `t_checkout` (`point_id`, `user_id`, `checkout_time`, `schedule_time`, `point_name`, `img`) VALUES (''1'', ''7'', ''1487072425970'', ''1487048415235'', ''Pos A1'', ''assets/images/uploads/148707311631jpg.jpg'')'),
('2017-02-14 11:52:25', 'INSERT INTO `t_checkout` (`point_id`, `user_id`, `checkout_time`, `schedule_time`, `point_name`, `img`) VALUES (''1'', ''7'', ''1487073139427'', ''1487048412597'', ''Pos A1'', ''assets/images/uploads/148707314587725jpg.jpg'')'),
('2017-02-14 13:18:42', 'INSERT INTO `t_event_report` (`user_id`, `point_name`, `description`, `img`) VALUES (''7'', ''hajaj'', ''detil'', ''assets/images/uploads/1487078322529853jpg.jpg'')'),
('2017-02-14 13:20:07', 'INSERT INTO `t_event_report` (`user_id`, `title`, `point_name`, `description`) VALUES (''7'', ''ywihs72hz'', ''vshusb'', ''vshsu'')'),
('2017-02-15 02:03:51', 'INSERT INTO `m_token` (`id_user`, `token`) VALUES (''7'', ''AEuQQZRv7heoHWEJuZJfMTz8rBL8NzotIN4PxKRt6oo6K'')'),
('2017-02-15 02:04:43', 'INSERT INTO `m_token` (`id_user`, `token`) VALUES (''7'', ''EySeXHWmYO5DP8a36nv4QKWCIZRdLj6NBqWQkxjlwouKi'')'),
('2017-02-15 02:05:38', 'INSERT INTO `t_checkout` (`point_id`, `user_id`, `checkout_time`, `schedule_time`, `point_name`, `img`) VALUES (''1'', ''7'', ''1487124329633'', ''1487134823920'', ''Pos A1'', ''assets/images/uploads/14871243386241jpg.jpg'')'),
('2017-02-15 02:06:25', 'INSERT INTO `t_checkout` (`point_id`, `user_id`, `checkout_time`, `schedule_time`, `point_name`, `img`) VALUES (''2'', ''7'', ''1487124367482'', ''1487138400672'', ''Pos B1'', ''assets/images/uploads/148712438545269jpg.jpg'')'),
('2017-02-20 13:47:07', 'INSERT INTO `t_message_broadcast` (`user_id`) VALUES (''9'')'),
('2017-02-20 13:47:44', 'INSERT INTO `t_message_broadcast` (`user_id`) VALUES (''9'')'),
('2017-02-20 13:48:58', 'INSERT INTO `t_message_broadcast` (`user_id`) VALUES (''9'')'),
('2017-02-20 13:49:22', 'INSERT INTO `t_message_broadcast` (`user_id`) VALUES (''9'')'),
('2017-02-20 13:49:35', 'INSERT INTO `t_message_broadcast` (`user_id`) VALUES (''9'')'),
('2017-02-20 13:49:59', 'INSERT INTO `t_message_broadcast` (`user_id`) VALUES (''9'')'),
('2017-02-20 13:50:09', 'INSERT INTO `t_message_broadcast` (`user_id`) VALUES (''9'')'),
('2017-02-20 13:50:37', 'INSERT INTO `t_message_broadcast` (`user_id`) VALUES (''9'')'),
('2017-02-20 13:50:46', 'INSERT INTO `t_message_broadcast` (`user_id`) VALUES (''9'')'),
('2017-02-20 13:52:22', 'INSERT INTO `t_message_broadcast` (`user_id`) VALUES (''9'')'),
('2017-02-20 13:53:08', 'INSERT INTO `t_message_broadcast` (`user_id`) VALUES (''9'')'),
('2017-02-20 13:56:15', 'INSERT INTO `t_message_broadcast` (`user_id`) VALUES (''9'')'),
('2017-02-20 13:59:40', 'INSERT INTO `t_message_broadcast` (`user_id`) VALUES (''9'')'),
('2017-02-20 14:02:38', 'INSERT INTO `t_message_broadcast` (`user_id`) VALUES (''9'')'),
('2017-02-20 14:03:13', 'INSERT INTO `t_message_broadcast` (`user_id`) VALUES (''9'')'),
('2017-02-20 14:05:40', 'INSERT INTO `t_message_broadcast` (`user_id`) VALUES (''9'')'),
('2017-02-20 14:07:46', 'INSERT INTO `t_message_broadcast` (`user_id`, `time`, `message`) VALUES (''4'', ''2981329821'', ''testmsgawdawd'')'),
('2017-02-20 14:08:45', 'INSERT INTO `t_message_broadcast` (`user_id`, `time`, `message`) VALUES (''4'', ''2981329821'', ''testmsgawdawd'')'),
('2017-02-20 14:09:12', 'INSERT INTO `t_message_broadcast` (`user_id`, `time`, `message`) VALUES (''4'', ''2981329821'', ''testmsgawdawd'')'),
('2017-02-20 14:13:26', 'INSERT INTO `t_message_broadcast` (`user_id`, `time`, `message`) VALUES (''4'', ''2981329821'', ''testmsgawdawd'')'),
('2017-02-20 14:13:37', 'INSERT INTO `t_message_broadcast` (`user_id`, `time`, `message`) VALUES (''4'', ''2981329821'', ''testmsgawdawd'')'),
('2017-02-20 14:15:36', 'INSERT INTO `t_message_broadcast` (`user_id`, `time`, `message`) VALUES (''4'', ''2981329821'', ''testmsgawdawd'')'),
('2017-02-20 14:30:07', 'INSERT INTO `t_message_broadcast` (`user_id`, `time`, `message`) VALUES (''4'', ''2981329821'', ''testmsgawdawd'')'),
('2017-02-20 14:42:03', 'INSERT INTO `m_token` (`id_user`, `token`) VALUES (''7'', ''XnSQY4CrK9IPSlwusQSp4p83Nf8ng3dQy3drfYuDr3SnJ'')'),
('2017-02-22 07:29:36', 'INSERT INTO `m_token` (`id_user`, `token`) VALUES (''7'', ''L4gg1ujGTQLRRcRFTakqsNmYwJGGx4wovlAqRH7DBJOmb'')'),
('2017-02-22 07:30:49', 'INSERT INTO `m_token` (`id_user`, `token`) VALUES (''7'', ''Oj3bO4VGXLbI7qpYztHGeTFzoanQVfrebBWVXduFEwbG6'')'),
('2017-02-22 07:31:09', 'INSERT INTO `m_token` (`id_user`, `token`) VALUES (''7'', ''xzGBHNS4YqZLRyfBiNmTLeyuerxIaxwsw7g1NgWgWyiwq'')'),
('2017-02-22 07:32:30', 'INSERT INTO `m_token` (`id_user`, `token`) VALUES (''7'', ''VElowtrmKSAWkhhdussMVNBIT7HD6LcCKB3hzXKFMGhq6'')'),
('2017-02-22 07:45:58', 'INSERT INTO `m_token` (`id_user`, `token`) VALUES (''9'', ''vTszD5hfdBCaOaSNyYS71NXAiNXcZJfncND8uIuUYIEGg'')'),
('2017-02-22 07:46:17', 'INSERT INTO `m_token` (`id_user`, `token`) VALUES (''9'', ''wsVqkJB4RRcgmFECwusfAcyIf6r8I355KoVFyYYtO9FBN'')'),
('2017-02-22 13:07:17', 'INSERT INTO `m_token` (`id_user`, `token`) VALUES (''9'', ''S4YOHxmRmDWGXzAg62C4RgT2RYKFbo3Uoe7gDHMFsxpBY'')'),
('2017-02-22 13:08:41', 'INSERT INTO `m_token` (`id_user`, `token`) VALUES (''9'', ''qyQBMD9HkWUnvzotk7ilfEPPdMIhHCcwHKXUFgfjyJK2R'')'),
('2017-02-22 13:09:22', 'INSERT INTO `m_token` (`id_user`, `token`) VALUES (''9'', ''hHVxuPl4sm8oLYCZwWFQkWCqfdiFTr46nTKCggIKDLNr8'')'),
('2017-02-22 13:10:30', 'INSERT INTO `m_token` (`id_user`, `token`) VALUES (''9'', ''8laNzcRhNG3C3EFr2tcPWXAoytkc3QnQ9rcs45LBx7ynL'')'),
('2017-02-23 06:53:41', 'INSERT INTO `m_token` (`id_user`, `token`) VALUES (''9'', ''8CGS2hS8CuSRuZ2AJ2aeXiDigZiIeSsYWaZ41xepwf214'')'),
('2017-02-23 06:54:01', 'INSERT INTO `m_schedule` (`shift_id`, `point_id`, `schedule_base`, `after`) VALUES (''3'', ''5'', ''-'', ''100'')'),
('2017-02-23 11:56:47', 'INSERT INTO `m_token` (`id_user`, `token`) VALUES (''9'', ''1PSICXIEiyKWCji6Isc3aIOh2iZLXU4X1NRPMFKSnKz3o'')');

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
  `valid_until` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `used_by` (`used_by`),
  KEY `for_company` (`for_company`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `m_device_key`
--

INSERT INTO `m_device_key` (`id`, `_enable`, `used_by`, `for_company`, `device_key`, `verified`, `valid_until`) VALUES
(1, 1, 7, 0, '12345678912345678911', 1, '2017-07-06 00:00:00');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `m_point`
--

INSERT INTO `m_point` (`id`, `_enable`, `point_name`, `point_lat`, `point_long`, `point_key`, `point_code`, `company_id`) VALUES
(1, 1, 'Pos A1', '0.0000', '0.0000', '12345678912345678911', 'POINT-r1FiarSTvua7dvY1ujhc4hyLaeLju', 0),
(2, 1, 'Pos B1', '0.0000', '0.0000', '', 'POINT-tvHtOyYFwzMzNn6KoknkthARNzctz', 0),
(3, 1, 'Pos C1', '0.0000', '0.0000', '', '', 0),
(4, 1, 'Pos D1', '0.0000', '0.0000', '', '', 0),
(5, 1, 'Center', '0.0000', '0.0000', NULL, '', 0);

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
  `valid_until` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `used_by` (`used_by`),
  KEY `for_company` (`for_company`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `m_point_key`
--

INSERT INTO `m_point_key` (`id`, `_enable`, `used_by`, `for_company`, `point_key`, `verified`, `valid_until`) VALUES
(1, 1, 1, 0, '12345678912345678911', 1, '0000-00-00 00:00:00');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

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
(14, 1, 2, 4, '-', 240),
(15, 0, 3, 5, '-', 100);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=139 ;

--
-- Dumping data for table `m_token`
--

INSERT INTO `m_token` (`id`, `id_user`, `token`) VALUES
(106, 8, 'KT6hrcKp3TcDEgfURXfIKf42WO1jvUXw3eg8E1I8VWHWX'),
(116, 4, 'hZnsJ1Fiy9EoOBcK76EPxRPAGB6uEyix2qKaUqllUhny5'),
(130, 7, 'VElowtrmKSAWkhhdussMVNBIT7HD6LcCKB3hzXKFMGhq6'),
(138, 9, '1PSICXIEiyKWCji6Isc3aIOh2iZLXU4X1NRPMFKSnKz3o');

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
  `fcm_token` varchar(255) NOT NULL,
  `last_active` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `company_id` (`company_id`),
  KEY `shift` (`shift`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `m_user`
--

INSERT INTO `m_user` (`id`, `_enable`, `user_activated`, `username`, `password`, `firstname`, `lastname`, `address`, `phone`, `email`, `shift`, `user_level`, `device_key`, `company_id`, `fcm_token`, `last_active`) VALUES
(4, 1, 1, 'exainsane22', 'd0e0dc6c50861bb6199eb3482c8e3a95', 'Ridwan', 'Nugroho', 'Nanggewer RT 01 RW 07', '+6287870980562', 'rnugraha305@gmail.com', 1, 8, '', 0, '', '2017-02-23 15:45:47'),
(7, 1, 1, 'exainsane', 'd0e0dc6c50861bb6199eb3482c8e3a95', 'Ridwan Achadi', 'Nugroho', 'Nanggewer RT 01 RW 07, Kp Tarikolot No 56', '87870980562', 'rnugraha305@gmail.com', 1, 8, '12345678912345678911', 0, 'ePcFrhI8wBg:APA91bFUCQlbMbgYMhXZ9Tqm-vaLm52ldvMn_o8OUTlRWjW-4Is0CKlkaS1u00cZ0PwepPUrJ7ny19PjzLdl7PJKYk-_9vtZI52mWLaAf-XbQOpdb98JWD75S7INj3AYvWbPkI1xzevt', '2017-02-23 15:45:44'),
(8, 1, 1, 'exairie', 'd0e0dc6c50861bb6199eb3482c8e3a95', 'Ridwan', 'Nugroho', 'Nanggewer RT 01 RW 07 No 56 Babakan Tarikolot, Cibinong', '087870980562', 'user@exainsane.com', 2, 0, '', 0, '', '2017-02-11 08:00:20'),
(9, 1, 1, 'administrator', 'd0e0dc6c50861bb6199eb3482c8e3a95', 'Marva Cipta', 'Admin', '-', '-', 'admin@exairie.net', 3, 999, '', 0, '', '2017-02-22 07:45:51');

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
  `checkout_time` datetime NOT NULL,
  `schedule_time` datetime NOT NULL,
  `point_name` varchar(255) NOT NULL,
  `point_lat` decimal(18,4) NOT NULL,
  `point_long` decimal(18,4) NOT NULL,
  `img` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `point_id` (`point_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `t_checkout`
--

INSERT INTO `t_checkout` (`id`, `_enable`, `point_id`, `user_id`, `checkout_time`, `schedule_time`, `point_name`, `point_lat`, `point_long`, `img`) VALUES
(2, 1, 1, 7, '2017-02-15 08:20:24', '2017-02-15 08:20:24', 'Pos A1', '0.0000', '0.0000', 'assets/images/uploads/148707311631jpg.jpg'),
(3, 1, 1, 7, '2017-02-15 08:21:27', '2017-02-15 08:23:27', 'Pos A1', '0.0000', '0.0000', 'assets/images/uploads/148707314587725jpg.jpg'),
(4, 1, 1, 7, '2017-02-15 12:31:34', '2017-02-15 12:36:34', 'Pos A1', '0.0000', '0.0000', 'assets/images/uploads/14871243386241jpg.jpg'),
(5, 1, 2, 7, '2017-02-23 09:22:27', '2017-02-23 09:12:27', 'Pos B1', '0.0000', '0.0000', 'assets/images/uploads/148712438545269jpg.jpg');

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
  `title` varchar(255) NOT NULL,
  `time` datetime NOT NULL,
  `point_name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `point_lat` decimal(18,4) NOT NULL,
  `point_long` decimal(18,4) NOT NULL,
  `img` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `t_event_report`
--

INSERT INTO `t_event_report` (`id`, `_enable`, `user_id`, `title`, `time`, `point_name`, `description`, `point_lat`, `point_long`, `img`) VALUES
(6, 1, 7, '', '2017-02-14 18:04:42', 'vsgs', 'hshs', '0.0000', '0.0000', 'assets/images/uploads/uploadimg.jpg'),
(7, 1, 7, '', '2017-02-14 18:05:11', 'vsgs', 'hshs', '0.0000', '0.0000', 'assets/images/uploads/uploadimg.jpg'),
(8, 1, 7, '', '2017-02-14 18:07:14', 'tttt', 't', '0.0000', '0.0000', 'assets/images/uploads/SCPEVENTREPORT-1487070414635.jpg'),
(9, 1, 7, '', '2017-02-14 18:09:34', '. ndhd', 'jfjr', '0.0000', '0.0000', 'assets/images/uploads/SCPEVENTREPORT-1487070554043.jpg'),
(10, 1, 7, '', '2017-02-14 18:11:32', '', '', '0.0000', '0.0000', 'assets/images/uploads/SCPEVENTREPORT-1487070674787.jpg'),
(11, 1, 7, '', '2017-02-14 18:16:52', '', '', '0.0000', '0.0000', 'assets/images/uploads/14870710126jpg.jpg'),
(12, 1, 7, '', '2017-02-14 18:17:41', '', '', '0.0000', '0.0000', 'assets/images/uploads/14870710616jpg.jpg'),
(13, 1, 7, '', '0000-00-00 00:00:00', 'hajaj', 'detil', '0.0000', '0.0000', 'assets/images/uploads/1487078322529853jpg.jpg'),
(14, 1, 7, 'ywihs72hz', '0000-00-00 00:00:00', 'vshusb', 'vshsu', '0.0000', '0.0000', NULL),
(15, 1, 7, '', '0000-00-00 00:00:00', '', '', '0.0000', '0.0000', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `t_message_broadcast`
--

CREATE TABLE IF NOT EXISTS `t_message_broadcast` (
  `id` bigint(255) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(255) NOT NULL,
  `time` datetime NOT NULL,
  `message` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=24 ;

--
-- Dumping data for table `t_message_broadcast`
--

INSERT INTO `t_message_broadcast` (`id`, `user_id`, `time`, `message`) VALUES
(18, 4, '0000-00-00 00:00:00', '1d'),
(19, 4, '0000-00-00 00:00:00', 'testmsgawdawdd'),
(20, 4, '0000-00-00 00:00:00', 'testmsgawdawd123'),
(21, 4, '0000-00-00 00:00:00', 'testmsgawdawdcaw'),
(22, 4, '0000-00-00 00:00:00', 'testmsgawdawd2'),
(23, 4, '0000-00-00 00:00:00', 'testmsgawdawd123');

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
-- Constraints for table `t_message_broadcast`
--
ALTER TABLE `t_message_broadcast`
  ADD CONSTRAINT `t_message_broadcast_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `m_user` (`id`);

--
-- Constraints for table `t_point_key_request`
--
ALTER TABLE `t_point_key_request`
  ADD CONSTRAINT `t_point_key_request_ibfk_1` FOREIGN KEY (`point_id`) REFERENCES `m_point` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
