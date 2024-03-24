-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 24, 2024 at 10:41 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `thezone_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `addressdetails`
--

CREATE TABLE `addressdetails` (
  `AddressID` int(11) NOT NULL,
  `AddressLine1` varchar(255) DEFAULT NULL,
  `City` varchar(255) DEFAULT NULL,
  `Postcode` varchar(100) DEFAULT NULL,
  `Country` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `CategoryID` int(11) NOT NULL,
  `CategoryName` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`CategoryID`, `CategoryName`) VALUES
(1, 'T-Shirt'),
(2, 'Jumper'),
(3, 'Hoodie'),
(4, 'Trainers'),
(5, 'Jeans');

-- --------------------------------------------------------

--
-- Table structure for table `contactrequests`
--

CREATE TABLE `contactrequests` (
  `RequestID` int(11) NOT NULL,
  `Name` varchar(255) DEFAULT NULL,
  `Email` varchar(255) DEFAULT NULL,
  `Message` varchar(1000) DEFAULT NULL,
  `RequestTime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contactrequests`
--

INSERT INTO `contactrequests` (`RequestID`, `Name`, `Email`, `Message`, `RequestTime`) VALUES
(1, 'Nadeem H', '220038500@aston.ac.uk', 'testing', '2023-12-09 09:50:44'),
(2, 'Nadeem H', '220038500@aston.ac.uk', 'testing if this still works, when i made some changes.', '2023-12-09 09:56:44'),
(3, 'Nadeem H', '220038500@aston.ac.uk', 'abc', '2023-12-13 09:38:47');

-- --------------------------------------------------------

--
-- Table structure for table `discount_codes`
--

CREATE TABLE `discount_codes` (
  `discount_id` int(11) NOT NULL,
  `discount_code` varchar(50) DEFAULT NULL,
  `discount_percentage` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `discount_codes`
--

INSERT INTO `discount_codes` (`discount_id`, `discount_code`, `discount_percentage`) VALUES
(4, 'SALE', 10);

-- --------------------------------------------------------

--
-- Table structure for table `genders`
--

CREATE TABLE `genders` (
  `GenderID` int(11) NOT NULL,
  `GenderType` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `genders`
--

INSERT INTO `genders` (`GenderID`, `GenderType`) VALUES
(1, 'Male'),
(2, 'Female');

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `ProductID` int(11) NOT NULL,
  `ProductName` varchar(255) DEFAULT NULL,
  `ProductDescription` varchar(1000) DEFAULT NULL,
  `Price` int(11) DEFAULT NULL,
  `ImageURL` varchar(500) DEFAULT NULL,
  `StockQuantity` int(11) DEFAULT NULL,
  `CategoryID` int(11) DEFAULT NULL,
  `GenderID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`ProductID`, `ProductName`, `ProductDescription`, `Price`, `ImageURL`, `StockQuantity`, `CategoryID`, `GenderID`) VALUES
(2, 'Champion X Coca Cola Cardigan Top 220192 Sweater (hlg/loy)', 'Elevate your style with this classic jumper, featuring a comfortable fit and timeless design for everyday casual wear.', 85, 'https://static.super-shop.com/1448614-champion-x-coca-cola-cardigan-top-220192-sweater-hlg-loy.jpg?w=1920', 100, 2, 2),
(7, 'Champion X Coca Cola Hooded Sweatshirt 220180 Hoodie (nbk)', 'Elevate your style with this classic hoodie, featuring a comfortable fit and timeless design for everyday casual wear.', 69, 'https://static.super-shop.com/1448594-champion-x-coca-cola-hooded-sweatshirt-220180-hoodie-nbk.jpg?w=1920', 100, 3, 1),
(8, 'Champion X Coca Cola Crewneck T-Shirt 220184 T-shirt (dox)', 'Elevate your style with this classic t-shirt, featuring a comfortable fit and timeless design for everyday casual wear.', 30, 'https://static.super-shop.com/1448606-champion-x-coca-cola-crewneck-tshirt-220184-tshirt-dox.jpg?w=19200', 100, 1, 2),
(9, 'Champion X Coca Cola Crewneck T-Shirt 220184 T-shirt (hlg)', 'Elevate your style with this classic t-shirt, featuring a comfortable fit and timeless design for everyday casual wear.', 30, 'https://static.super-shop.com/1448605-champion-x-coca-cola-crewneck-tshirt-220184-tshirt-hlg.jpg?w=1920', 100, 1, 2),
(10, 'Champion X Coca Cola Crewneck T-Shirt 220183 T-shirt (vapy)', 'Elevate your style with this classic t-shirt, featuring a comfortable fit and timeless design for everyday casual wear.', 30, 'https://static.super-shop.com/1448602-champion-x-coca-cola-crewneck-tshirt-220183-tshirt-vapy.jpg?w=1920', 100, 1, 1),
(11, 'Champion X Coca Cola Crewneck T-Shirt 220183 T-shirt (nbk)', 'Elevate your style with this classic t-shirt, featuring a comfortable fit and timeless design for everyday casual wear.', 30, 'https://static.super-shop.com/1448603-champion-x-coca-cola-crewneck-tshirt-220183-tshirt-nbk.jpg?w=1920', 100, 1, 1),
(12, 'Thrasher Hoodie Flame HD Wmn (black)', 'Elevate your style with this classic hoodie, featuring a comfortable fit and timeless design for everyday casual wear.', 65, 'https://static.super-shop.com/1238796-thrasher-hoodie-flame-hd-wmn-black.jpg?w=1920', 100, 3, 2),
(14, 'Champion X Coca Cola Hooded Sweatshirt 220180 Hoodie (hlg)', 'Elevate your style with this classic hoodie, featuring a comfortable fit and timeless design for everyday casual wear.', 69, 'https://static.super-shop.com/1448593-champion-x-coca-cola-hooded-sweatshirt-220180-hoodie-hlg.jpg?w=1920', 100, 3, 1),
(15, 'Method Tech Riding HD Hoodie (black)', 'Elevate your style with this classic hoodie, featuring a comfortable fit and timeless design for everyday casual wear.', 100, 'https://static.super-shop.com/1445496-method-tech-riding-hd-hoodie-black.jpg?w=1920', 100, 3, 2),
(16, 'Champion X Coca Cola Crewneck Jumper 220181  (bwb)', 'Elevate your style with this classic Jumper, featuring a comfortable fit and timeless design for everyday casual wear.', 100, 'https://static.super-shop.com/1448595-champion-x-coca-cola-crewneck-sweatshirt-220181-sweatshirt-bwb.jpg?w=1920', 100, 2, 1),
(17, 'Thrasher Jumper Skate Mag Crew (black)', 'Elevate your style with this classic Jumper, featuring a comfortable fit and timeless design for everyday casual wear.', 50, 'https://static.super-shop.com/1228413-thrasher-sweatshirt-skate-mag-crew-black.jpg?w=1920', 100, 2, 2),
(18, 'Carhartt WIP DeadKebab Knock Knock Sweatshirt (black)', 'Elevate your style with this classic Jumper, featuring a comfortable fit and timeless design for everyday casual wear.', 112, 'https://static.super-shop.com/1433227-carhartt-wip-deadkebab-knock-knock-sweatshirt-black.jpg?w=1920', 100, 2, 1),
(20, 'Es trainers Accel Og (brw/gum)', 'Elevate your style with these classic trainers, featuring a comfortable fit and timeless design for everyday casual wear.', 65, 'https://static.super-shop.com/1411563-es-shoes-accel-og-brw-gum.jpg?w=1920', 100, 4, 1),
(21, 'Etnies trainers Barge Ls (green/gum)', 'Elevate your style with these classic trainers, featuring a comfortable fit and timeless design for everyday casual wear.', 68, 'https://static.super-shop.com/968053-etnies-shoes-barge-ls-green-gum.jpg?w=1920', 100, 4, 1),
(22, 'Vans Sk8 Hi Shoes (pig suede douglas fir)', 'Elevate your style with these classic trainers, featuring a comfortable fit and timeless design for everyday casual wear.', 26, 'https://static.super-shop.com/1415123-vans-sk8-hi-shoes-pig-suede-douglas-fir.jpg?w=1920', 100, 4, 1),
(23, 'MassDnm Slang Jeans Baggi Fit Pants (Light Blue Stone Wash)', 'Elevate your style with these classic jeans, featuring a comfortable fit and timeless design for everyday casual wear.', 52, 'https://static.super-shop.com/1434553-massdnm-slang-jeans-baggi-fit-pants-light-blue-stone-wash.jpg?w=1920', 100, 5, 1),
(24, 'MassDnm Pants Base Jeans Regular Fit (blue)', 'Elevate your style with these classic jeans, featuring a comfortable fit and timeless design for everyday casual wear.', 48, 'https://static.super-shop.com/1434271-massdnm-pants-base-jeans-regular-fit-blue.jpg?w=1920', 100, 5, 1),
(25, 'Malita Jeans Log Sl Pants (elastic blue)', 'Elevate your style with these classic jeans, featuring a comfortable fit and timeless design for everyday casual wear.', 48, 'https://static.super-shop.com/1367045-malita-jeans-log-sl-pants-elastic-blue.jpg?w=1920', 100, 5, 2),
(26, 'MassDnm Craft Jeans Baggy Fit Pants (black washed)', 'Elevate your style with these classic jeans, featuring a comfortable fit and timeless design for everyday casual wear.', 52, 'https://static.super-shop.com/1367047-massdnm-craft-jeans-baggy-fit-pants-black-washed.jpg?w=1920', 100, 5, 2);

-- --------------------------------------------------------

--
-- Table structure for table `orderitems`
--

CREATE TABLE `orderitems` (
  `OrderItemID` int(11) NOT NULL,
  `OrderID` int(11) DEFAULT NULL,
  `ProductID` int(11) DEFAULT NULL,
  `Quantity` int(11) DEFAULT NULL,
  `SubTotal` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orderitems`
--

INSERT INTO `orderitems` (`OrderItemID`, `OrderID`, `ProductID`, `Quantity`, `SubTotal`) VALUES
(1, 11, 2, 1, NULL),
(3, 13, 7, 1, 69.00);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `OrderID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `OrderTime` datetime NOT NULL,
  `OrderStatus` varchar(255) NOT NULL,
  `TotalAmount` int(11) NOT NULL,
  `PaymentID` int(11) DEFAULT NULL,
  `AddressID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`OrderID`, `UserID`, `OrderTime`, `OrderStatus`, `TotalAmount`, `PaymentID`, `AddressID`) VALUES
(11, 0, '2024-03-08 15:22:18', 'Shipped', 88, NULL, NULL),
(12, 4, '2024-03-19 15:36:50', 'Pending', 48, NULL, NULL),
(13, 7, '2024-03-24 22:26:44', 'Pending', 62, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `paymentdetails`
--

CREATE TABLE `paymentdetails` (
  `PaymentID` int(11) NOT NULL,
  `CardholderName` varchar(300) DEFAULT NULL,
  `CardNumber` varchar(255) DEFAULT NULL,
  `ExpiryDate` date DEFAULT NULL,
  `CVV` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `ReviewID` int(11) NOT NULL,
  `ProductID` int(11) DEFAULT NULL,
  `Rating` int(11) DEFAULT NULL,
  `Description` varchar(500) DEFAULT NULL,
  `UserID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sizes_table`
--

CREATE TABLE `sizes_table` (
  `SizeID` int(11) NOT NULL,
  `SizeName` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sizes_table`
--

INSERT INTO `sizes_table` (`SizeID`, `SizeName`) VALUES
(1, 'XS'),
(2, 'S'),
(3, 'M'),
(4, 'L'),
(5, 'XL'),
(6, '0'),
(7, '0.5'),
(8, '1'),
(9, '1.5'),
(10, '2'),
(11, '2.5'),
(12, '3'),
(13, '3.5'),
(14, '4'),
(15, '4.5'),
(16, '5'),
(17, '5.5'),
(18, '6'),
(19, '6.5'),
(20, '7'),
(21, '7.5'),
(22, '8'),
(23, '8.5'),
(24, '9'),
(25, '9.5'),
(26, '10'),
(27, '10.5'),
(28, '11'),
(29, '11.5'),
(30, '12'),
(31, '12.5'),
(32, '13');

-- --------------------------------------------------------

--
-- Table structure for table `stock_table`
--

CREATE TABLE `stock_table` (
  `StockID` int(11) NOT NULL,
  `ProductID` int(11) DEFAULT NULL,
  `SizeID` int(11) DEFAULT NULL,
  `Quantity` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stock_table`
--

INSERT INTO `stock_table` (`StockID`, `ProductID`, `SizeID`, `Quantity`) VALUES
(6, 2, 1, 90),
(7, 2, 2, 96),
(8, 2, 3, 101),
(9, 2, 4, 50),
(10, 2, 5, 10),
(11, 3, 1, 50),
(12, 3, 2, 100),
(13, 3, 3, 100),
(14, 3, 4, 50),
(15, 3, 5, 10),
(45, 7, 1, 50),
(46, 7, 2, 100),
(47, 7, 3, 100),
(48, 7, 4, 49),
(49, 7, 5, 10),
(50, 8, 1, 50),
(51, 8, 2, 100),
(52, 8, 3, 100),
(53, 8, 4, 50),
(54, 8, 5, 10),
(55, 9, 1, 50),
(56, 9, 2, 100),
(57, 9, 3, 100),
(58, 9, 4, 50),
(59, 9, 5, 10),
(60, 10, 1, 50),
(61, 10, 2, 100),
(62, 10, 3, 100),
(63, 10, 4, 50),
(64, 10, 5, 10),
(65, 11, 1, 50),
(66, 11, 2, 100),
(67, 11, 3, 100),
(68, 11, 4, 50),
(69, 11, 5, 10),
(70, 12, 1, 50),
(71, 12, 2, 100),
(72, 12, 3, 100),
(73, 12, 4, 50),
(74, 12, 5, 10),
(75, 14, 1, 50),
(76, 14, 2, 100),
(77, 14, 3, 100),
(78, 14, 4, 50),
(79, 14, 1, 50),
(80, 14, 5, 10),
(81, 14, 2, 100),
(82, 14, 3, 100),
(83, 14, 4, 50),
(84, 14, 5, 10),
(85, 15, 1, 50),
(86, 15, 2, 100),
(87, 15, 3, 100),
(88, 15, 4, 50),
(89, 15, 5, 10),
(90, 16, 1, 50),
(91, 16, 2, 100),
(92, 16, 3, 100),
(93, 16, 4, 50),
(94, 16, 5, 10),
(95, 17, 1, 50),
(96, 17, 2, 100),
(97, 17, 3, 100),
(98, 17, 4, 50),
(99, 17, 5, 10),
(100, 18, 1, 50),
(101, 18, 2, 100),
(102, 18, 3, 100),
(103, 18, 4, 50),
(104, 18, 5, 10),
(131, 20, 6, 42),
(132, 20, 7, 100),
(133, 20, 8, 10),
(134, 20, 9, 50),
(135, 20, 10, 10),
(136, 20, 11, 150),
(137, 20, 12, 200),
(138, 20, 13, 75),
(139, 20, 14, 25),
(140, 20, 15, 88),
(141, 20, 16, 120),
(142, 20, 17, 60),
(143, 20, 18, 80),
(144, 20, 19, 110),
(145, 20, 20, 40),
(146, 20, 21, 95),
(147, 20, 22, 150),
(148, 20, 23, 200),
(149, 20, 24, 60),
(150, 20, 25, 80),
(151, 20, 26, 110),
(152, 20, 27, 40),
(153, 20, 28, 90),
(154, 20, 29, 130),
(155, 20, 30, 130),
(156, 20, 31, 130),
(157, 20, 32, 130),
(158, 21, 6, 502),
(159, 21, 7, 1001),
(160, 21, 8, 100),
(161, 21, 9, 50),
(162, 21, 10, 10),
(163, 21, 11, 150),
(164, 21, 12, 200),
(165, 21, 13, 75),
(166, 21, 14, 25),
(167, 21, 15, 88),
(168, 21, 16, 120),
(169, 21, 17, 60),
(170, 21, 18, 80),
(171, 21, 19, 110),
(172, 21, 20, 40),
(173, 21, 21, 95),
(174, 21, 22, 150),
(175, 21, 23, 200),
(176, 21, 24, 60),
(177, 21, 25, 80),
(178, 21, 26, 110),
(179, 21, 27, 40),
(180, 21, 28, 90),
(181, 21, 29, 130),
(182, 21, 30, 130),
(183, 21, 31, 130),
(184, 21, 32, 130),
(185, 22, 6, 18),
(186, 22, 7, 100),
(187, 22, 8, 100),
(188, 22, 9, 50),
(189, 22, 10, 10),
(190, 22, 11, 150),
(191, 22, 12, 200),
(192, 22, 13, 75),
(193, 22, 14, 25),
(194, 22, 15, 88),
(195, 22, 16, 120),
(196, 22, 17, 60),
(197, 22, 18, 80),
(198, 22, 19, 110),
(199, 22, 20, 40),
(200, 22, 21, 95),
(201, 22, 22, 150),
(202, 22, 23, 200),
(203, 22, 24, 60),
(204, 22, 25, 80),
(205, 22, 26, 110),
(206, 22, 27, 40),
(207, 22, 28, 90),
(208, 22, 29, 130),
(209, 22, 30, 130),
(210, 22, 31, 130),
(211, 22, 32, 130),
(212, 23, 1, 50),
(213, 23, 2, 100),
(214, 23, 3, 100),
(215, 23, 4, 50),
(216, 23, 5, 10),
(217, 24, 1, 50),
(218, 24, 2, 100),
(219, 24, 3, 100),
(220, 24, 4, 50),
(221, 24, 5, 10),
(222, 25, 1, 545),
(223, 25, 2, 100),
(224, 25, 3, 100),
(225, 25, 4, 50),
(226, 25, 5, 10),
(227, 26, 1, 50),
(228, 26, 2, 100),
(229, 26, 3, 100),
(230, 26, 4, 50),
(231, 26, 5, 10),
(234, 30, 1, 0),
(235, 30, 2, 0),
(236, 30, 3, 0),
(237, 30, 4, 0),
(238, 30, 5, 0),
(239, 31, 1, 0),
(240, 31, 2, 0),
(241, 31, 3, 0),
(242, 31, 4, 0),
(243, 31, 5, 0),
(246, 32, 1, 0),
(247, 32, 2, 0),
(248, 32, 3, 0),
(249, 32, 4, 0),
(250, 32, 5, 0),
(252, 33, 1, 0),
(253, 33, 2, 0),
(254, 33, 3, 0),
(255, 33, 4, 0),
(256, 33, 5, 0),
(257, 34, 1, 0),
(258, 34, 2, 0),
(259, 34, 3, 0),
(260, 34, 4, 0),
(261, 34, 5, 0),
(264, 35, 1, 0),
(265, 35, 2, 0),
(266, 35, 3, 0),
(267, 35, 4, 0),
(268, 35, 5, 0),
(270, 36, 1, 0),
(271, 36, 2, 0),
(272, 36, 3, 0),
(273, 36, 4, 0),
(274, 36, 5, 0),
(275, 37, 6, 34),
(276, 37, 7, 0),
(277, 37, 8, 2),
(278, 37, 9, 0),
(279, 37, 10, 0),
(280, 37, 11, 0),
(281, 37, 12, 0),
(282, 37, 13, 0),
(283, 37, 14, 0),
(284, 37, 15, 0),
(285, 37, 16, 0),
(286, 37, 17, 0),
(287, 37, 18, 0),
(288, 37, 19, 0),
(289, 37, 20, 0),
(290, 37, 21, 0),
(291, 37, 22, 0),
(292, 37, 24, 0),
(293, 37, 25, 0),
(294, 37, 26, 0),
(295, 37, 27, 0),
(296, 37, 28, 0),
(297, 37, 29, 0),
(298, 37, 30, 0),
(299, 37, 31, 0),
(300, 37, 32, 0),
(301, 37, 6, 34),
(302, 37, 7, 0),
(303, 37, 8, 2),
(304, 37, 9, 0),
(305, 37, 10, 0),
(306, 37, 11, 0),
(307, 37, 12, 0),
(308, 37, 13, 0),
(309, 37, 14, 0),
(310, 37, 15, 0),
(311, 37, 16, 0),
(312, 37, 17, 0),
(313, 37, 18, 0),
(314, 37, 19, 0),
(315, 37, 20, 0),
(316, 37, 21, 0),
(317, 37, 22, 0),
(318, 37, 24, 0),
(319, 37, 25, 0),
(320, 37, 26, 0),
(321, 37, 27, 0),
(322, 37, 28, 0),
(323, 37, 29, 0),
(324, 37, 30, 0),
(325, 37, 31, 0),
(326, 37, 32, 0),
(327, 38, 1, 4),
(328, 38, 2, 332),
(329, 38, 3, 0),
(330, 38, 4, 33),
(331, 38, 5, 0),
(332, 39, 6, 0),
(333, 39, 7, 45),
(334, 39, 8, 0),
(335, 39, 9, 0),
(336, 39, 10, 0),
(337, 39, 11, 0),
(338, 39, 12, 0),
(339, 39, 13, 0),
(340, 39, 14, 0),
(341, 39, 15, 0),
(342, 39, 16, 0),
(343, 39, 17, 0),
(344, 39, 18, 0),
(345, 39, 19, 0),
(346, 39, 20, 0),
(347, 39, 21, 0),
(348, 39, 22, 0),
(349, 39, 24, 0),
(350, 39, 25, 0),
(351, 39, 26, 0),
(352, 39, 27, 0),
(353, 39, 28, 0),
(354, 39, 29, 0),
(355, 39, 30, 0),
(356, 39, 31, 0),
(357, 39, 32, 0),
(358, 40, 1, 10),
(359, 40, 2, 0),
(360, 40, 3, 0),
(361, 40, 4, 0),
(362, 40, 5, 0),
(363, 41, 1, 1),
(364, 41, 2, 0),
(365, 41, 3, 0),
(366, 41, 4, 0),
(367, 41, 5, 5),
(368, 42, 6, 6),
(369, 42, 7, 2),
(370, 42, 8, 4),
(371, 42, 9, 0),
(372, 42, 10, 0),
(373, 42, 11, 0),
(374, 42, 12, 0),
(375, 42, 13, 0),
(376, 42, 14, 0),
(377, 42, 15, 0),
(378, 42, 16, 0),
(379, 42, 17, 0),
(380, 42, 18, 0),
(381, 42, 19, 0),
(382, 42, 20, 0),
(383, 42, 21, 0),
(384, 42, 22, 0),
(385, 42, 24, 0),
(386, 42, 25, 0),
(387, 42, 26, 0),
(388, 42, 27, 0),
(389, 42, 28, 0),
(390, 42, 29, 0),
(391, 42, 30, 0),
(392, 42, 31, 0),
(393, 42, 32, 0),
(394, 43, 6, 0),
(395, 43, 7, 0),
(396, 43, 8, 0),
(397, 43, 9, 0),
(398, 43, 10, 0),
(399, 43, 11, 0),
(400, 43, 12, 0),
(401, 43, 13, 0),
(402, 43, 14, 0),
(403, 43, 15, 0),
(404, 43, 16, 0),
(405, 43, 17, 0),
(406, 43, 18, 0),
(407, 43, 19, 0),
(408, 43, 20, 0),
(409, 43, 21, 0),
(410, 43, 22, 0),
(411, 43, 24, 0),
(412, 43, 25, 0),
(413, 43, 26, 0),
(414, 43, 27, 0),
(415, 43, 28, 0),
(416, 43, 29, 0),
(417, 43, 30, 0),
(418, 43, 31, 0),
(419, 43, 32, 0),
(420, 27, 6, 2),
(421, 27, 7, 0),
(422, 27, 8, 0),
(423, 27, 9, 0),
(424, 27, 10, 0),
(425, 27, 11, 0),
(426, 27, 12, 0),
(427, 27, 13, 0),
(428, 27, 14, 0),
(429, 27, 15, 0),
(430, 27, 16, 0),
(431, 27, 17, 0),
(432, 27, 18, 0),
(433, 27, 19, 0),
(434, 27, 20, 0),
(435, 27, 21, 0),
(436, 27, 22, 0),
(437, 27, 24, 0),
(438, 27, 25, 0),
(439, 27, 26, 0),
(440, 27, 27, 0),
(441, 27, 28, 0),
(442, 27, 29, 0),
(443, 27, 30, 0),
(444, 27, 31, 0),
(445, 27, 32, 0);

-- --------------------------------------------------------

--
-- Table structure for table `useraccounts`
--

CREATE TABLE `useraccounts` (
  `UserID` int(11) NOT NULL,
  `Firstname` varchar(255) DEFAULT NULL,
  `Lastname` varchar(255) DEFAULT NULL,
  `Email` varchar(255) DEFAULT NULL,
  `Pass` varchar(255) DEFAULT NULL,
  `isAdmin` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `useraccounts`
--

INSERT INTO `useraccounts` (`UserID`, `Firstname`, `Lastname`, `Email`, `Pass`, `isAdmin`) VALUES
(1, 'Nadeem', 'H', '2200385050@aston.ac.uk', '$2y$10$wlIfuobBWDepRKfKJCMohetNxuXjF3qG8jcDaNB2N2p2t/YBqMqTC', 0),
(2, 'a', 'a', 'a@gmail.com', '$2y$10$a2hMCvyk.sZvnSUBdEFF8.91r4z4ejTH74AujYD2LnjE89ILU18LS', 0),
(3, 'b', 'b', 'B@gmail.com', '$2y$10$ZW5q9yZ5whGJuX92pZMhheTswphUQ0DNqWrN8pUGJ3uqtGSjMApa6', 1),
(4, 'admin', 'Nadeem', 'adminNadeem@gmail.com', '$2y$10$7Ae4sVxX1esldw4RMG6KDuu2suw5lhI08rkObLOYuTh9/qAs43vpu', 1),
(5, 'test', 'test-admin', 'test12@gmail.com', '$2y$10$GdmIwSj23YYKxwAA9y0m0O3u7zY3.h5UlTLrAX4m9uFlp7NwoyGsa', 1),
(6, 'test', 'plan', 'testplan@gmail.com', '$2y$10$dI67Yl5omOEV3UNyMd04B.XygRfX6sdkJvbdotBiuwwOVDIFB8TL2', 0),
(7, 'customer', 'shoppper', 'customer1@gmail.com', '$2y$10$5DgUAKCm7MJwjdLizX2/6e2tdkTur/qHhFClJ0JR.TLpHqv5S3ux.', 0),
(8, 'customer', 'shoppper2', 'customer2@gmail.com', '$2y$10$Xr.EQa5YtOmpLd3bqjFEIeW75HoFddVyLEKTSZvgxcjWkQkD0/EDq', 0),
(9, 'Customer3', 'shopper', 'Customer3@gmail.com', '$2y$10$T5s9QfaRrF6Kk8CkIIpjT./Djx0KroRR03hswD9eJGv54jNem2Vxq', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `addressdetails`
--
ALTER TABLE `addressdetails`
  ADD PRIMARY KEY (`AddressID`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`CategoryID`);

--
-- Indexes for table `contactrequests`
--
ALTER TABLE `contactrequests`
  ADD PRIMARY KEY (`RequestID`);

--
-- Indexes for table `discount_codes`
--
ALTER TABLE `discount_codes`
  ADD PRIMARY KEY (`discount_id`);

--
-- Indexes for table `genders`
--
ALTER TABLE `genders`
  ADD PRIMARY KEY (`GenderID`);

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`ProductID`),
  ADD KEY `CategoryID` (`CategoryID`),
  ADD KEY `GenderID` (`GenderID`);

--
-- Indexes for table `orderitems`
--
ALTER TABLE `orderitems`
  ADD PRIMARY KEY (`OrderItemID`),
  ADD KEY `OrderID` (`OrderID`),
  ADD KEY `ProductID` (`ProductID`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`OrderID`),
  ADD KEY `AddressID` (`AddressID`);

--
-- Indexes for table `paymentdetails`
--
ALTER TABLE `paymentdetails`
  ADD PRIMARY KEY (`PaymentID`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`ReviewID`),
  ADD KEY `ProductID` (`ProductID`),
  ADD KEY `UserID` (`UserID`);

--
-- Indexes for table `sizes_table`
--
ALTER TABLE `sizes_table`
  ADD PRIMARY KEY (`SizeID`);

--
-- Indexes for table `stock_table`
--
ALTER TABLE `stock_table`
  ADD PRIMARY KEY (`StockID`),
  ADD KEY `ProductID` (`ProductID`),
  ADD KEY `SizeID` (`SizeID`);

--
-- Indexes for table `useraccounts`
--
ALTER TABLE `useraccounts`
  ADD PRIMARY KEY (`UserID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `addressdetails`
--
ALTER TABLE `addressdetails`
  MODIFY `AddressID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `CategoryID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `contactrequests`
--
ALTER TABLE `contactrequests`
  MODIFY `RequestID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `discount_codes`
--
ALTER TABLE `discount_codes`
  MODIFY `discount_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `genders`
--
ALTER TABLE `genders`
  MODIFY `GenderID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `ProductID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `orderitems`
--
ALTER TABLE `orderitems`
  MODIFY `OrderItemID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `OrderID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `paymentdetails`
--
ALTER TABLE `paymentdetails`
  MODIFY `PaymentID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `ReviewID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sizes_table`
--
ALTER TABLE `sizes_table`
  MODIFY `SizeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `stock_table`
--
ALTER TABLE `stock_table`
  MODIFY `StockID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=446;

--
-- AUTO_INCREMENT for table `useraccounts`
--
ALTER TABLE `useraccounts`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `inventory`
--
ALTER TABLE `inventory`
  ADD CONSTRAINT `inventory_ibfk_1` FOREIGN KEY (`CategoryID`) REFERENCES `category` (`CategoryID`),
  ADD CONSTRAINT `inventory_ibfk_2` FOREIGN KEY (`GenderID`) REFERENCES `genders` (`GenderID`);

--
-- Constraints for table `orderitems`
--
ALTER TABLE `orderitems`
  ADD CONSTRAINT `fk_product` FOREIGN KEY (`ProductID`) REFERENCES `inventory` (`ProductID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `orderitems_ibfk_1` FOREIGN KEY (`OrderID`) REFERENCES `orders` (`OrderID`),
  ADD CONSTRAINT `orderitems_ibfk_2` FOREIGN KEY (`ProductID`) REFERENCES `inventory` (`ProductID`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`AddressID`) REFERENCES `addressdetails` (`AddressID`);

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`ProductID`) REFERENCES `inventory` (`ProductID`),
  ADD CONSTRAINT `reviews_ibfk_2` FOREIGN KEY (`UserID`) REFERENCES `useraccounts` (`UserID`);

--
-- Constraints for table `stock_table`
--
ALTER TABLE `stock_table`
  ADD CONSTRAINT `stock_table_ibfk_2` FOREIGN KEY (`SizeID`) REFERENCES `sizes_table` (`SizeID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
