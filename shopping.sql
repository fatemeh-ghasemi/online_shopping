-- phpMyAdmin SQL Dump
-- version 3.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 23, 2016 at 12:13 AM
-- Server version: 5.5.25a
-- PHP Version: 5.4.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `shopping`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) COLLATE utf8_persian_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci AUTO_INCREMENT=9 ;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
(1, 'bracelet'),
(4, 'ring'),
(6, 'brooch'),
(7, 'earring'),
(8, 'necklace');

-- --------------------------------------------------------

--
-- Table structure for table `like`
--

CREATE TABLE IF NOT EXISTS `like` (
  `user_id` int(20) NOT NULL,
  `product_id` int(20) NOT NULL,
  PRIMARY KEY (`user_id`,`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

--
-- Dumping data for table `like`
--

INSERT INTO `like` (`user_id`, `product_id`) VALUES
(8, 60),
(8, 61),
(8, 63);

-- --------------------------------------------------------

--
-- Table structure for table `order1`
--

CREATE TABLE IF NOT EXISTS `order1` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `user_id` int(20) NOT NULL,
  `date` date NOT NULL,
  `status` enum('waiting','confirmed','preparing','posted') COLLATE utf8_persian_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci AUTO_INCREMENT=11 ;

--
-- Dumping data for table `order1`
--

INSERT INTO `order1` (`id`, `user_id`, `date`, `status`) VALUES
(1, 8, '0000-00-00', 'waiting'),
(2, 8, '0000-00-00', 'waiting'),
(3, 8, '0000-00-00', 'waiting'),
(4, 8, '0000-00-00', 'waiting'),
(5, 8, '0000-00-00', 'waiting'),
(6, 8, '0000-00-00', 'waiting'),
(7, 8, '0000-00-00', 'waiting'),
(8, 8, '0000-00-00', 'waiting'),
(9, 8, '0000-00-00', 'waiting'),
(10, 8, '0000-00-00', 'waiting');

-- --------------------------------------------------------

--
-- Table structure for table `order_item`
--

CREATE TABLE IF NOT EXISTS `order_item` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `order_id` int(20) NOT NULL,
  `count` int(20) NOT NULL,
  `price` double NOT NULL,
  `product_id` int(20) NOT NULL,
  `returned` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci AUTO_INCREMENT=8 ;

--
-- Dumping data for table `order_item`
--

INSERT INTO `order_item` (`id`, `order_id`, `count`, `price`, `product_id`, `returned`) VALUES
(1, 2, 1, 2300, 55, 0),
(2, 3, 1, 2300, 55, 0),
(3, 4, 1, 2300, 55, 0),
(4, 5, 1, 2300, 55, 0),
(5, 9, 0, 1000, 54, 0),
(6, 9, 1, 2300, 55, 0),
(7, 10, 1, 4300, 60, 0);

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE IF NOT EXISTS `payment` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `user_id` int(20) NOT NULL,
  `price` float NOT NULL,
  `situation` varchar(50) COLLATE utf8_persian_ci NOT NULL,
  `bank` varchar(50) COLLATE utf8_persian_ci NOT NULL,
  `order_id` int(20) NOT NULL,
  `accountnumber` int(50) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `accountnumber` (`accountnumber`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE IF NOT EXISTS `product` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8_persian_ci NOT NULL,
  `price` double NOT NULL,
  `quantity` int(20) NOT NULL,
  `serialnumber` varchar(50) COLLATE utf8_persian_ci NOT NULL,
  `describtion` text COLLATE utf8_persian_ci NOT NULL,
  `category_id` int(20) NOT NULL,
  `status` set('visible','invisible') COLLATE utf8_persian_ci NOT NULL,
  `visit_count` int(50) NOT NULL DEFAULT '0',
  `like_count` int(50) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`,`serialnumber`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci AUTO_INCREMENT=81 ;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `name`, `price`, `quantity`, `serialnumber`, `describtion`, `category_id`, `status`, `visit_count`, `like_count`) VALUES
(58, 'bracelet_1', 3200, 4, '2147483647', 'sdfghjkl;.l,knjbhgcfdsafgtyhjkl,.mjnbhgfdsgchbkjm', 1, 'visible', 1, 0),
(60, 'neck_2', 4300, 6, '2147483647', 'hjlm,nbgcxfgfhgkjnm', 8, 'visible', 21, 1),
(61, 'ring-3', 1000, 3, '234', 'smdfsnfps;n;psn', 4, 'visible', 3, 1),
(62, 'brooch', 230, 4, '0', 'jnwsfbwalobfckilsafbcislkfbisfgbisefgrbi', 6, 'visible', 0, 0),
(63, 'earring', 1300, 2, '23', 'sdvfefdesfgedvesarfewgrrgtvsrg', 7, 'visible', 6, 1),
(65, 'ring-3', 230, 2, '3f4r345g3v4545', 'jhgfdsfghjklokjhmg vdcfghyklkjmhgbvdfcgbhj', 4, 'visible', 0, 0),
(66, 'ring-4', 140, 4, '3453465345erfwr23', 'frgthyjuilo;plkj mnhgbfvdcsdfvtghyjukl;lkjmhngcbfxvdsdfrgthyjukijuyhgtfd', 4, 'visible', 0, 0),
(67, 'ring-5', 2500, 1, '346457657', 'fdgsedrhgtrkyyjukmdtgdesrtfhgresthytgjgyfjfhkmfghjkghuj', 4, 'visible', 0, 0),
(68, 'ring_6', 220, 5, '324567hgbfd34', 'sdfgrthyjukilkjhgvfdcsdfgbhjklkjhg bfvcdxdvfghjkhgfv', 4, 'visible', 0, 0),
(69, 'earring-2', 2400, 3, '234567', 'sdfghjlkjhgfdsdfghjkljhgfdcxscdfvghf', 7, 'visible', 0, 0),
(70, 'earring-3', 3200, 4, '2345678ujhgfds', 'dfghjuhgfdsadfrgthyjukjhgfdghjkjhgfdvghjk,jhgtfrdeswfrgthj', 7, 'visible', 0, 0),
(71, 'bracelet_2', 3400, 3, '3456tgfv', 'sdfrgtjhgfdsaszdfrgthyjkjmhngbfvdcsxdfghjkngbfvd', 1, 'visible', 10, 0),
(72, 'bracelet_3', 2700, 3, '2345gfd', 'ssdfrgtjhgfdsaszdfrgthyjkjmhngbfvdcsxdfghjkngbfvd', 1, 'visible', 1, 0),
(73, 'bracelet_4', 3400, 2, '3456gfds3', 'dfrtghygbcvfxsdfrgtjhgfdsaszdfrgthyjkjmhngbfvdcsxdfghjkngbfvd', 1, 'visible', 0, 0),
(74, 'brooch-2', 120, 6, '32w3ewfs453', 'julkimhgnbcvfdxzsdfrgtjhgfdsaszdfrgthyjkjmhngbfvdcsxdfghjkngbfvd', 6, 'visible', 0, 0),
(75, 'brooch-3', 160, 4, '34rg56tgr', 'hyjklijmhgnbfvdcxsdfrgtjhgfdsaszdfrgthyjkjmhngbfvdcsxdfghjkngbfvd', 6, 'visible', 1, 0),
(76, 'brooch-4', 360, 1, '7654fghn', 'kijhgnfbvdssdfrgtjhgfdsaszdfrgthyjkjmhngbfvdcsxdfghjkngbfvd', 6, 'visible', 2, 0),
(78, 'brooch-6', 220, 4, '3456709876yt', 'sdfrgtjhgfdsaszdfrgthyjkjmhngbfvdcsxdfghjkngbfvd', 6, 'visible', 2, 0),
(79, 'neck_3', 3400, 2, '3456098765', 'sdfrgtjhgfdsaszdfrgthyjkjmhngbfvdcsxdfghjkngbfvd', 8, 'visible', 0, 0),
(80, 'neck_4', 4300, 3, '23456ghyt', 'sdfrgtjhgfdsaszdfrgthyjkjmhngbfvdcsxdfghjkngbfvd', 8, 'visible', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `product_comment`
--

CREATE TABLE IF NOT EXISTS `product_comment` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `user_id` int(20) NOT NULL,
  `product_id` int(20) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `body` text COLLATE utf8_persian_ci NOT NULL,
  `status` enum('waiting','approved','reject') COLLATE utf8_persian_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci AUTO_INCREMENT=12 ;

--
-- Dumping data for table `product_comment`
--

INSERT INTO `product_comment` (`id`, `user_id`, `product_id`, `create_at`, `body`, `status`) VALUES
(8, 8, 63, '2016-07-19 14:54:07', 'sadfvcsdfvsdf', 'approved'),
(9, 8, 60, '2016-07-19 14:57:21', 'gfdvbgdxsgbdrsfgnbhtdgnjy', 'approved'),
(10, 8, 60, '2016-07-22 21:46:07', 'dfgcbhnjkm,nbhgvcfdgthyjkl,mjnbhg', 'waiting'),
(11, 8, 63, '2016-07-22 21:46:07', 'dxfgchjkl,kjmnbhgfdrsertgyhjkioljhgytfred', 'waiting');

-- --------------------------------------------------------

--
-- Table structure for table `product_picture`
--

CREATE TABLE IF NOT EXISTS `product_picture` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(80) COLLATE utf8_persian_ci NOT NULL,
  `product_id` int(20) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci AUTO_INCREMENT=64 ;

--
-- Dumping data for table `product_picture`
--

INSERT INTO `product_picture` (`id`, `name`, `product_id`) VALUES
(42, '1468937668.jpg', 58),
(44, '1468937771.jpg', 60),
(45, '1468937815.jpg', 61),
(46, '1468937857.jpg', 62),
(47, '1468937902.jpg', 63),
(48, '1469004191.jpg', 65),
(49, '1469004232.jpg', 66),
(50, '1469004284.jpg', 67),
(51, '1469004328.jpg', 68),
(52, '1469004383.jpg', 69),
(53, '1469004438.jpg', 70),
(54, '1469004490.jpg', 71),
(55, '1469004521.jpg', 72),
(56, '1469004550.jpg', 73),
(57, '1469004618.jpg', 74),
(58, '1469004653.jpg', 75),
(59, '1469004694.jpg', 76),
(61, '1469004773.jpg', 78),
(62, '1469004938.jpg', 79),
(63, '1469005125.jpg', 80);

-- --------------------------------------------------------

--
-- Table structure for table `product_pin`
--

CREATE TABLE IF NOT EXISTS `product_pin` (
  `product_id` int(20) NOT NULL,
  `user_id` int(20) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`product_id`,`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) COLLATE utf8_persian_ci NOT NULL,
  `password` varchar(40) COLLATE utf8_persian_ci NOT NULL,
  `firstname` varchar(255) COLLATE utf8_persian_ci NOT NULL,
  `lastname` varchar(255) COLLATE utf8_persian_ci NOT NULL,
  `role` enum('user','admin') COLLATE utf8_persian_ci DEFAULT NULL,
  PRIMARY KEY (`id`,`password`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci AUTO_INCREMENT=17 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `email`, `password`, `firstname`, `lastname`, `role`) VALUES
(2, 'maryam@gmail.com', '31a5371f27e0b475c0d967fa82861327908bdbb1', 'maryam', 'zare', 'user'),
(5, 'ali@gmail.com', '639abb375a04b7169478ef538803d646', 'ali', 'ahmadi', 'user'),
(6, 'neda@gmail.com', '4b27cdd4df5a9dbcea0da019bb22aa39b6e58da8', 'neda', 'rangbar', 'user'),
(7, 'amir@gmail.com', 'cf65c72c109ab969c3056beb9ddb2307', 'امیر', 'مهدوی', 'user'),
(8, 'm@gmail.com', 'c41c9c09776d60a26aa26287d5155d2e', 'mmm', 'lllll', 'admin'),
(9, 'neda1@gmail.com', '6e17d15f21f17c8a6de60e67687db1cb', 'neda', 'zare', NULL),
(11, 'a@gmail.com', 'aa698440b0ea958544d76515e6b180e2', 'a', 'm', NULL),
(13, 'sdxc@gmail', '86a57c17394232d1427f6ac036bb0510', 'dfg', '345', NULL),
(15, 'aa@gmail.com', '4946e9862a2c776fae9f65e0273ea440', 'jhgfd', 'jhgfd', NULL),
(16, 'mj@gmail.com', '47a637adb2692b067300fff1adfcdc91', 'm', 'j', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_token`
--

CREATE TABLE IF NOT EXISTS `user_token` (
  `user_id` int(20) NOT NULL,
  `token` int(40) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

--
-- Dumping data for table `user_token`
--

INSERT INTO `user_token` (`user_id`, `token`, `create_at`) VALUES
(7, 6, '2016-06-30 10:11:10'),
(8, 54, '2016-07-16 20:35:25'),
(5, 0, '2016-07-16 20:43:17'),
(5, 3, '2016-07-16 20:43:21'),
(5, 0, '2016-07-16 20:46:03'),
(5, 0, '2016-07-16 20:46:10'),
(5, 0, '2016-07-16 20:47:30'),
(5, 7, '2016-07-16 20:47:35'),
(5, 0, '2016-07-16 20:48:09'),
(5, 0, '2016-07-16 20:49:29'),
(5, 0, '2016-07-16 20:49:37'),
(5, 9, '2016-07-16 20:50:09'),
(5, 0, '2016-07-16 20:50:28'),
(5, 3, '2016-07-16 20:52:52'),
(5, 0, '2016-07-16 20:53:30'),
(8, 83, '2016-07-16 20:54:02'),
(8, 969, '2016-07-16 20:54:10'),
(5, 0, '2016-07-16 20:56:35'),
(8, 1, '2016-07-20 09:08:12'),
(8, 9, '2016-07-20 09:10:15');

-- --------------------------------------------------------

--
-- Table structure for table `view`
--

CREATE TABLE IF NOT EXISTS `view` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `product_id` int(20) NOT NULL,
  `user_id` int(20) NOT NULL,
  `date` date NOT NULL,
  `body` text COLLATE utf8_persian_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
