-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 10, 2023 at 06:12 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

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
(2, 'Nadeem H', '220038500@aston.ac.uk', 'testing if this still works, when i made some changes.', '2023-12-09 09:56:44');

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
(1, 'Champion X Coca Cola Crewneck T-Shirt 220184 T-shirt (bwb)', 'Elevate your style with this classic crewneck T-shirt, featuring a comfortable fit and timeless design for everyday casual wear.', 30, 'https://static.super-shop.com/1448604-champion-x-coca-cola-crewneck-tshirt-220184-tshirt-bwb.jpg?w=1920', 100, 1, 1),
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
  `Quantity` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `OrderID` int(11) NOT NULL,
  `UserID` int(11) DEFAULT NULL,
  `OrderTime` datetime DEFAULT NULL,
  `OrderStatus` varchar(255) DEFAULT NULL,
  `TotalAmount` int(11) DEFAULT NULL,
  `PaymentID` int(11) DEFAULT NULL,
  `AddressID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
-- Table structure for table `useraccounts`
--

CREATE TABLE `useraccounts` (
  `UserID` int(11) NOT NULL,
  `Firstname` varchar(255) DEFAULT NULL,
  `Lastname` varchar(255) DEFAULT NULL,
  `Email` varchar(255) DEFAULT NULL,
  `Pass` varchar(255) DEFAULT NULL,
  `isAdmin` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  MODIFY `RequestID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
  MODIFY `OrderItemID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `OrderID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

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
-- AUTO_INCREMENT for table `useraccounts`
--
ALTER TABLE `useraccounts`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
