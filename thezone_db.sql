-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 22, 2024 at 07:28 PM
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
(1, 'Champion X Coca Cola Crewneck T-Shirt 220184 T-shirt (bwb)', 'Elevate your style with this classic crewneck T-shirt, featuring a comfortable fit and timeless design for everyday casual wear.', 30, 'https://static.super-shop.com/1448604-champion-x-coca-cola-crewneck-tshirt-220184-tshirt-bwb.jpg?w=1920', 19, 1, 1),
(2, 'Champion X Coca Cola Cardigan Top 220192 Sweater (hlg/loy)', 'Elevate your style with this classic jumper, featuring a comfortable fit and timeless design for everyday casual wear.', 88, 'https://static.super-shop.com/1448614-champion-x-coca-cola-cardigan-top-220192-sweater-hlg-loy.jpg?w=1920', 100, 2, 2),
(3, 'Prosto Yezz Jumper (black)', 'Elevate your style with this classic Jumper, featuring a comfortable fit and timeless design for everyday casual wear.', 48, 'https://static.super-shop.com/1439438-prosto-yezz-sweatshirt-black.jpg?w=1920', 100, 2, 1),
(4, 'Converse Chuck Taylor All Star Lift Hi Shoes Wmn (black)', 'Elevate your style with these sneakers, featuring a comfortable fit and timeless design for everyday casual wear.', 79, 'https://static.super-shop.com/1212146-converse-chuck-taylor-all-star-lift-hi-shoes-wmn-black.jpg?w=1920', 100, 4, 1),
(6, 'Prosto Jeans Regular Pocklog Pants (blue)', 'Elevate your style with these Jeans, featuring a comfortable fit and timeless design for everyday casual wear.', 46, 'https://static.super-shop.com/1212146-converse-chuck-taylor-all-star-lift-hi-shoes-wmn-black.jpg?w=1920', 100, 5, 1),
(7, 'Champion X Coca Cola Hooded Sweatshirt 220180 Hoodie (nbk)', 'Elevate your style with this classic hoodie, featuring a comfortable fit and timeless design for everyday casual wear.', 69, 'https://static.super-shop.com/1448594-champion-x-coca-cola-hooded-sweatshirt-220180-hoodie-nbk.jpg?w=1920', 100, 3, 1),
(8, 'Champion X Coca Cola Crewneck T-Shirt 220184 T-shirt (dox)', 'Elevate your style with this classic t-shirt, featuring a comfortable fit and timeless design for everyday casual wear.', 30, 'https://static.super-shop.com/1448606-champion-x-coca-cola-crewneck-tshirt-220184-tshirt-dox.jpg?w=19200', 100, 1, 2),
(9, 'Champion X Coca Cola Crewneck T-Shirt 220184 T-shirt (hlg)', 'Elevate your style with this classic t-shirt, featuring a comfortable fit and timeless design for everyday casual wear.', 30, 'https://static.super-shop.com/1448605-champion-x-coca-cola-crewneck-tshirt-220184-tshirt-hlg.jpg?w=1920', 100, 1, 2),
(10, 'Champion X Coca Cola Crewneck T-Shirt 220183 T-shirt (vapy)', 'Elevate your style with this classic t-shirt, featuring a comfortable fit and timeless design for everyday casual wear.', 30, 'https://static.super-shop.com/1448602-champion-x-coca-cola-crewneck-tshirt-220183-tshirt-vapy.jpg?w=1920', 100, 1, 1),
(11, 'Champion X Coca Cola Crewneck T-Shirt 220183 T-shirt (nbk)', 'Elevate your style with this classic t-shirt, featuring a comfortable fit and timeless design for everyday casual wear.', 30, 'https://static.super-shop.com/1448603-champion-x-coca-cola-crewneck-tshirt-220183-tshirt-nbk.jpg?w=1920', 100, 1, 1),
(12, 'Thrasher Hoodie Flame HD Wmn (black)', 'Elevate your style with this classic hoodie, featuring a comfortable fit and timeless design for everyday casual wear.', 65, 'https://static.super-shop.com/1238796-thrasher-hoodie-flame-hd-wmn-black.jpg?w=1920', 100, 3, 2),
(13, 'Burton Mountain HD Hoodie (true black)', 'Elevate your style with this classic hoodie, featuring a comfortable fit and timeless design for everyday casual wear.', 83, 'https://static.super-shop.com/1069874-burton-mountain-hd-hoodie-true-black.jpg?w=1920', 100, 3, 1),
(14, 'Champion X Coca Cola Hooded Sweatshirt 220180 Hoodie (hlg)', 'Elevate your style with this classic hoodie, featuring a comfortable fit and timeless design for everyday casual wear.', 69, 'https://static.super-shop.com/1448593-champion-x-coca-cola-hooded-sweatshirt-220180-hoodie-hlg.jpg?w=1920', 100, 3, 1),
(15, 'Method Tech Riding HD Hoodie (black)', 'Elevate your style with this classic hoodie, featuring a comfortable fit and timeless design for everyday casual wear.', 100, 'https://static.super-shop.com/1445496-method-tech-riding-hd-hoodie-black.jpg?w=1920', 100, 3, 2),
(16, 'Champion X Coca Cola Crewneck Jumper 220181  (bwb)', 'Elevate your style with this classic Jumper, featuring a comfortable fit and timeless design for everyday casual wear.', 100, 'https://static.super-shop.com/1448595-champion-x-coca-cola-crewneck-sweatshirt-220181-sweatshirt-bwb.jpg?w=1920', 100, 2, 1),
(17, 'Thrasher Jumper Skate Mag Crew (black)', 'Elevate your style with this classic Jumper, featuring a comfortable fit and timeless design for everyday casual wear.', 50, 'https://static.super-shop.com/1228413-thrasher-sweatshirt-skate-mag-crew-black.jpg?w=1920', 100, 2, 2),
(18, 'Carhartt WIP DeadKebab Knock Knock Sweatshirt (black)', 'Elevate your style with this classic Jumper, featuring a comfortable fit and timeless design for everyday casual wear.', 112, 'https://static.super-shop.com/1433227-carhartt-wip-deadkebab-knock-knock-sweatshirt-black.jpg?w=1920', 100, 2, 1),
(19, 'Vans Old Skool trainers', 'Elevate your style with these classic trainers, featuring a comfortable fit and timeless design for everyday casual wear.', 63, 'https://static.super-shop.com/1183275-vans-old-skool-shoes-flame-black-black-true-white.jpg?w=1920', 100, 4, 2),
(20, 'Es trainers Accel Og (brw/gum)', 'Elevate your style with these classic trainers, featuring a comfortable fit and timeless design for everyday casual wear.', 65, 'https://static.super-shop.com/1411563-es-shoes-accel-og-brw-gum.jpg?w=1920', 100, 4, 1),
(21, 'Etnies trainers Barge Ls (green/gum)', 'Elevate your style with these classic trainers, featuring a comfortable fit and timeless design for everyday casual wear.', 68, 'https://static.super-shop.com/968053-etnies-shoes-barge-ls-green-gum.jpg?w=1920', 100, 4, 1),
(22, 'Vans Sk8 Hi Shoes (pig suede douglas fir)', 'Elevate your style with these classic trainers, featuring a comfortable fit and timeless design for everyday casual wear.', 90, 'https://static.super-shop.com/1415123-vans-sk8-hi-shoes-pig-suede-douglas-fir.jpg?w=1920', 100, 4, 1),
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
(2, 12, 3, 1, NULL);

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
(12, 4, '2024-03-19 15:36:50', 'Pending', 48, NULL, NULL);

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
(27, '11'),
(28, '12'),
(29, '13');

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
(3, 1, 1, 50),
(4, 1, 2, 100),
(5, 1, 3, 100),
(6, 1, 4, 50),
(7, 1, 5, 10),
(8, 2, 1, 50),
(9, 2, 2, 100),
(10, 2, 3, 100),
(11, 2, 4, 50),
(12, 2, 5, 10),
(13, 3, 1, 50),
(14, 3, 2, 100),
(15, 3, 3, 100),
(16, 3, 4, 50),
(17, 3, 5, 10),
(18, 4, 6, 50),
(19, 4, 7, 100),
(20, 4, 8, 100),
(21, 4, 9, 50),
(22, 4, 10, 10),
(23, 4, 11, 150),
(24, 4, 12, 200),
(25, 4, 13, 75),
(26, 4, 14, 25),
(27, 4, 15, 88),
(28, 4, 16, 120),
(29, 4, 17, 60),
(30, 4, 18, 80),
(31, 4, 19, 110),
(32, 4, 20, 40),
(33, 4, 21, 95),
(34, 4, 22, 150),
(35, 4, 23, 200),
(36, 4, 24, 60),
(37, 4, 25, 80),
(38, 4, 26, 110),
(39, 4, 27, 40),
(40, 4, 28, 90),
(41, 4, 29, 130),
(42, 6, 1, 50),
(43, 6, 2, 100),
(44, 6, 3, 100),
(45, 6, 4, 50),
(46, 6, 5, 10),
(47, 7, 1, 50),
(48, 7, 2, 100),
(49, 7, 3, 100),
(50, 7, 4, 50),
(51, 7, 5, 10),
(52, 8, 1, 50),
(53, 8, 2, 100),
(54, 8, 3, 100),
(55, 8, 4, 50),
(56, 8, 5, 10),
(57, 9, 1, 50),
(58, 9, 2, 100),
(59, 9, 3, 100),
(60, 9, 4, 50),
(61, 9, 5, 10),
(62, 10, 1, 50),
(63, 10, 2, 100),
(64, 10, 3, 100),
(65, 10, 4, 50),
(66, 10, 5, 10),
(67, 11, 1, 50),
(68, 11, 2, 100),
(69, 11, 3, 100),
(70, 11, 4, 50),
(71, 11, 5, 10),
(72, 12, 1, 50),
(73, 12, 2, 100),
(74, 12, 3, 100),
(75, 12, 4, 50),
(76, 12, 5, 10),
(77, 14, 1, 50),
(78, 14, 2, 100),
(79, 14, 3, 100),
(80, 14, 4, 50),
(81, 14, 1, 50),
(82, 14, 5, 10),
(83, 14, 2, 100),
(84, 14, 3, 100),
(85, 14, 4, 50),
(86, 14, 5, 10),
(87, 15, 1, 50),
(88, 15, 2, 100),
(89, 15, 3, 100),
(90, 15, 4, 50),
(91, 15, 5, 10),
(92, 16, 1, 50),
(93, 16, 2, 100),
(94, 16, 3, 100),
(95, 16, 4, 50),
(96, 16, 5, 10),
(97, 17, 1, 50),
(98, 17, 2, 100),
(99, 17, 3, 100),
(100, 17, 4, 50),
(101, 17, 5, 10),
(102, 18, 1, 50),
(103, 18, 2, 100),
(104, 18, 3, 100),
(105, 18, 4, 50),
(106, 18, 5, 10),
(107, 19, 6, 50),
(108, 19, 7, 100),
(109, 19, 8, 100),
(110, 19, 9, 50),
(111, 19, 10, 10),
(112, 19, 11, 150),
(113, 19, 12, 200),
(114, 19, 13, 75),
(115, 19, 14, 25),
(116, 19, 15, 88),
(117, 19, 16, 120),
(118, 19, 17, 60),
(119, 19, 18, 80),
(120, 19, 19, 110),
(121, 19, 20, 40),
(122, 19, 21, 95),
(123, 19, 22, 150),
(124, 19, 23, 200),
(125, 19, 24, 60),
(126, 19, 25, 80),
(127, 19, 26, 110),
(128, 19, 27, 40),
(129, 19, 28, 90),
(130, 19, 29, 130),
(131, 20, 6, 50),
(132, 20, 7, 100),
(133, 20, 8, 100),
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
(155, 21, 6, 50),
(156, 21, 7, 100),
(157, 21, 8, 100),
(158, 21, 9, 50),
(159, 21, 10, 10),
(160, 21, 11, 150),
(161, 21, 12, 200),
(162, 21, 13, 75),
(163, 21, 14, 25),
(164, 21, 15, 88),
(165, 21, 16, 120),
(166, 21, 17, 60),
(167, 21, 18, 80),
(168, 21, 19, 110),
(169, 21, 20, 40),
(170, 21, 21, 95),
(171, 21, 22, 150),
(172, 21, 23, 200),
(173, 21, 24, 60),
(174, 21, 25, 80),
(175, 21, 26, 110),
(176, 21, 27, 40),
(177, 21, 28, 90),
(178, 21, 29, 130),
(179, 22, 6, 50),
(180, 22, 7, 100),
(181, 22, 8, 100),
(182, 22, 9, 50),
(183, 22, 10, 10),
(184, 22, 11, 150),
(185, 22, 12, 200),
(186, 22, 13, 75),
(187, 22, 14, 25),
(188, 22, 15, 88),
(189, 22, 16, 120),
(190, 22, 17, 60),
(191, 22, 18, 80),
(192, 22, 19, 110),
(193, 22, 20, 40),
(194, 22, 21, 95),
(195, 22, 22, 150),
(196, 22, 23, 200),
(197, 22, 24, 60),
(198, 22, 25, 80),
(199, 22, 26, 110),
(200, 22, 27, 40),
(201, 22, 28, 90),
(202, 22, 29, 130),
(203, 23, 1, 50),
(204, 23, 2, 100),
(205, 23, 3, 100),
(206, 23, 4, 50),
(207, 23, 5, 10),
(208, 24, 1, 50),
(209, 24, 2, 100),
(210, 24, 3, 100),
(211, 24, 4, 50),
(212, 24, 5, 10),
(213, 25, 1, 50),
(214, 25, 2, 100),
(215, 25, 3, 100),
(216, 25, 4, 50),
(217, 25, 5, 10),
(218, 26, 1, 50),
(219, 26, 2, 100),
(220, 26, 3, 100),
(221, 26, 4, 50),
(222, 26, 5, 10);

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
(6, 'test', 'plan', 'testplan@gmail.com', '$2y$10$dI67Yl5omOEV3UNyMd04B.XygRfX6sdkJvbdotBiuwwOVDIFB8TL2', 0);

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
  MODIFY `ProductID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `orderitems`
--
ALTER TABLE `orderitems`
  MODIFY `OrderItemID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `OrderID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

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
  MODIFY `SizeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `stock_table`
--
ALTER TABLE `stock_table`
  MODIFY `StockID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=223;

--
-- AUTO_INCREMENT for table `useraccounts`
--
ALTER TABLE `useraccounts`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

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
  ADD CONSTRAINT `stock_table_ibfk_1` FOREIGN KEY (`ProductID`) REFERENCES `inventory` (`ProductID`),
  ADD CONSTRAINT `stock_table_ibfk_2` FOREIGN KEY (`SizeID`) REFERENCES `sizes_table` (`SizeID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
