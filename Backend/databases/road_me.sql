-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 30, 2015 at 09:21 PM
-- Server version: 5.5.44-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `road.me`
--
CREATE DATABASE IF NOT EXISTS `road.me` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `road.me`;

-- --------------------------------------------------------

--
-- Table structure for table `incidente`
--

CREATE TABLE IF NOT EXISTS `incidente` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `descripcion` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `lat` double NOT NULL,
  `lng` double NOT NULL,
  `tipo_incidente` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `estado` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `punto`
--

CREATE TABLE IF NOT EXISTS `punto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lat` double NOT NULL,
  `lng` double NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=109 ;

--
-- Dumping data for table `punto`
--

INSERT INTO `punto` (`id`, `lat`, `lng`) VALUES
(1, -41.994186, -65.293776),
(2, -42.744073, -65.110995),
(3, -43.232959, -65.300974),
(4, -44.688028, -66.626453),
(5, -45.90681, -67.57932),
(6, -41.173627, -71.33576),
(7, -41.994845, -71.530009),
(8, -42.290875, -71.354119),
(9, -42.946941, -71.212882),
(10, -42.947197, -71.215124),
(11, -43.504092, -70.808453),
(12, -44.058801, -70.554672),
(13, -45.447302, -69.820189),
(14, -45.59983, -69.070221),
(15, -45.452627, -69.816408),
(16, -45.672756, -70.247443),
(17, -45.934749, -70.409118),
(18, -42.948871, -71.216329),
(19, -43.078286, -71.463446),
(20, -43.239984, -65.322534),
(21, -43.696692, -67.293522),
(22, -43.890974, -68.402711),
(23, -43.85837, -69.022868),
(24, -43.50964, -70.802803),
(25, -42.205217, -71.386513),
(26, -42.157112, -71.177881),
(27, -42.055033, -71.163183),
(28, -42.291828, -65.196283),
(29, -42.872292, -65.141701),
(30, -43.640733, -65.600105),
(31, -45.015349, -67.093748),
(32, -45.943173, -67.598826),
(33, -41.372796, -71.508162),
(34, -42.081571, -71.49977),
(35, -42.318621, -71.135643),
(36, -42.937577, -71.242735),
(37, -43.13687, -70.856702),
(38, -43.780473, -70.932075),
(39, -44.455656, -70.44771),
(40, -45.523929, -69.277956),
(41, -45.776789, -68.719612),
(42, -45.460599, -70.058501),
(43, -45.767534, -70.299699),
(44, -45.892708, -70.792903),
(45, -42.900603, -71.298726),
(46, -43.134453, -71.435412),
(47, -43.296242, -65.790856),
(48, -43.818553, -67.717701),
(49, -43.815373, -68.627651),
(50, -43.753702, -69.544076),
(51, -43.143207, -70.840133),
(52, -42.170731, -71.329762),
(53, -42.122599, -71.172573),
(54, -42.031989, -71.147668),
(55, -42.532994, -65.112029),
(56, -43.107432, -65.253176),
(57, -44.2806, -66.176865),
(58, -45.570553, -67.630179),
(59, -45.971921, -67.576199),
(60, -41.806954, -71.430139),
(61, -42.215736, -71.369567),
(62, -42.697672, -71.009853),
(63, -42.900407, -71.295699),
(64, -43.3572, -70.882682),
(65, -43.996089, -70.816602),
(66, -44.906218, -70.096323),
(67, -45.523929, -69.277956),
(68, -45.781407, -68.061975),
(69, -45.562564, -70.162432),
(70, -45.875655, -70.360124),
(71, -45.927933, -71.204451),
(72, -42.9917, -71.403328),
(73, -43.200428, -71.566349),
(74, -43.603806, -66.52091),
(75, -43.845065, -68.073911),
(76, -43.862491, -68.826892),
(77, -43.727004, -70.040638),
(78, -43.038254, -70.995503),
(79, -42.16135, -71.281176),
(80, -42.083826, -71.169715),
(81, -42.011364, -71.134195),
(82, -42.744073, -65.110995),
(83, -43.232959, -65.300974),
(84, -44.688028, -66.626453),
(85, -45.90681, -67.57932),
(86, -45.993066, -67.598046),
(87, -41.994845, -71.530009),
(88, -42.290875, -71.354119),
(89, -42.946941, -71.212882),
(90, -42.923449, -71.329466),
(91, -43.504092, -70.808453),
(92, -44.058801, -70.554672),
(93, -45.447302, -69.820189),
(94, -45.59983, -69.070221),
(95, -45.907465, -67.585299),
(96, -45.672756, -70.247443),
(97, -45.99151, -70.435248),
(98, -45.913164, -71.645396),
(99, -43.078286, -71.463446),
(100, -43.173828, -71.753759),
(101, -43.696692, -67.293522),
(102, -43.890974, -68.402711),
(103, -43.85837, -69.022868),
(104, -43.50964, -70.802803),
(105, -42.950182, -71.216906),
(106, -42.15681, -71.177881),
(107, -42.055639, -71.162774),
(108, -41.994374, -71.125212);

-- --------------------------------------------------------

--
-- Table structure for table `tramo`
--

CREATE TABLE IF NOT EXISTS `tramo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `estado` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=28 ;

--
-- Dumping data for table `tramo`
--

INSERT INTO `tramo` (`id`, `nombre`, `estado`) VALUES
(1, 'Aº VERDE - PTO. MADRYN', 'TP'),
(2, 'PTO. MADRYN - TRELEW', 'TP'),
(3, 'TRELEW - GARAYALDE', 'TP'),
(4, 'GARAYALDE - C.RIVADAVIA', 'TEP'),
(5, 'C.RIVADAVIA - LTE.STA.CRUZ', 'TP'),
(6, 'S.C. de BARILOCHE - EL BOLSON', 'TEP'),
(7, 'EL BOLSON - ACC. CHOLILA', 'TP'),
(8, 'ACC. CHOLILA - EMP. RNNº259', 'TP'),
(9, 'EMP. RNNº40 - ESQUEL', 'TP'),
(10, 'EMP.RNNº259 - TECKA', 'TP'),
(11, 'TECKA - GOB. COSTA', 'TP'),
(12, 'GOB.COSTA - EMP. RNNº26', 'TP'),
(13, 'EMP.RNNº40 - SARMIENTO', 'TEP'),
(14, 'SARMIENTO - CRO. RIVADAVIA', 'TEP'),
(15, 'EMP.RNNº26 - RÍO MAYO', 'TEP'),
(16, 'RÍO MAYO - LTE.STA.CRUZ', 'TP'),
(17, 'EMP.R.N.Nª40 - LTE. CON CHILE', 'TEP'),
(18, 'ESQUEL - TREVELIN', 'TEP'),
(19, 'TREVELIN - LTE. CON CHILE', 'TP'),
(20, 'RAWSON - LAS PLUMAS', 'TP'),
(21, 'LAS PLUMAS - LOS ALTARES', 'TP'),
(22, 'LOS ALTARES - PASO DE INDIOS', 'TP'),
(23, 'PASO DE INDIOS - TECKA', 'TP'),
(24, 'TECKA - ESQUEL', 'TP'),
(25, 'EMP. RNNº40 - EMP. RPNº70', 'TP'),
(26, 'EMP. RPNº70 - EL MAITEN', 'TP'),
(27, 'EL MAITEN - LTE. CON RIO NEGRO', 'TP');

-- --------------------------------------------------------

--
-- Table structure for table `tramo_puntos`
--

CREATE TABLE IF NOT EXISTS `tramo_puntos` (
  `tramo_id` int(11) NOT NULL,
  `punto_id` int(11) NOT NULL,
  PRIMARY KEY (`tramo_id`,`punto_id`),
  KEY `IDX_2CF0C00E6E801575` (`tramo_id`),
  KEY `IDX_2CF0C00EB3CB6227` (`punto_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tramo_puntos`
--

INSERT INTO `tramo_puntos` (`tramo_id`, `punto_id`) VALUES
(1, 1),
(1, 28),
(1, 55),
(1, 82),
(2, 2),
(2, 29),
(2, 56),
(2, 83),
(3, 3),
(3, 30),
(3, 57),
(3, 84),
(4, 4),
(4, 31),
(4, 58),
(4, 85),
(5, 5),
(5, 32),
(5, 59),
(5, 86),
(6, 6),
(6, 33),
(6, 60),
(6, 87),
(7, 7),
(7, 34),
(7, 61),
(7, 88),
(8, 8),
(8, 35),
(8, 62),
(8, 89),
(9, 9),
(9, 36),
(9, 63),
(9, 90),
(10, 10),
(10, 37),
(10, 64),
(10, 91),
(11, 11),
(11, 38),
(11, 65),
(11, 92),
(12, 12),
(12, 39),
(12, 66),
(12, 93),
(13, 13),
(13, 40),
(13, 67),
(13, 94),
(14, 14),
(14, 41),
(14, 68),
(14, 95),
(15, 15),
(15, 42),
(15, 69),
(15, 96),
(16, 16),
(16, 43),
(16, 70),
(16, 97),
(17, 17),
(17, 44),
(17, 71),
(17, 98),
(18, 18),
(18, 45),
(18, 72),
(18, 99),
(19, 19),
(19, 46),
(19, 73),
(19, 100),
(20, 20),
(20, 47),
(20, 74),
(20, 101),
(21, 21),
(21, 48),
(21, 75),
(21, 102),
(22, 22),
(22, 49),
(22, 76),
(22, 103),
(23, 23),
(23, 50),
(23, 77),
(23, 104),
(24, 24),
(24, 51),
(24, 78),
(24, 105),
(25, 25),
(25, 52),
(25, 79),
(25, 106),
(26, 26),
(26, 53),
(26, 80),
(26, 107),
(27, 27),
(27, 54),
(27, 81),
(27, 108);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tramo_puntos`
--
ALTER TABLE `tramo_puntos`
  ADD CONSTRAINT `FK_2CF0C00EB3CB6227` FOREIGN KEY (`punto_id`) REFERENCES `punto` (`id`),
  ADD CONSTRAINT `FK_2CF0C00E6E801575` FOREIGN KEY (`tramo_id`) REFERENCES `tramo` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
