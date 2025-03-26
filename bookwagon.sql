-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 12, 2024 at 09:12 PM
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
-- Database: `bookwagon`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `Id` int(200) NOT NULL,
  `emailAddress` varchar(200) NOT NULL,
  `adminPassword` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`Id`, `emailAddress`, `adminPassword`) VALUES
(1, 'jude@gmail.com', '12345');

-- --------------------------------------------------------

--
-- Table structure for table `manage`
--

CREATE TABLE `manage` (
  `Id` int(11) NOT NULL,
  `fullName` varchar(200) NOT NULL,
  `emailAddress` varchar(200) NOT NULL,
  `status` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `notifId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `type` varchar(50) NOT NULL,
  `message` text NOT NULL,
  `isRead` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`notifId`, `userId`, `type`, `message`, `isRead`, `created_at`) VALUES
(1, 13, 'seller_approval', 'Your application has been approved. You can start selling now.', 0, '2024-08-12 01:24:17'),
(2, 17, 'seller_approval', 'Your application has been approved. You can start selling now.', 0, '2024-08-12 02:51:02'),
(3, 18, 'seller_approval', 'Your application has been approved. You can start selling now.', 0, '2024-08-12 03:16:09'),
(4, 19, 'seller_approval', 'Your application has been approved. You can start selling now.', 0, '2024-08-12 09:01:11'),
(6, 21, 'seller_approval', 'Your application has been approved. You can start listing your items now.', 0, '2024-08-12 17:59:05'),
(7, 23, 'seller_approval', 'Your application has been approved. You can start listing your items now.', 0, '2024-08-12 18:48:43');

-- --------------------------------------------------------

--
-- Table structure for table `renter`
--

CREATE TABLE `renter` (
  `RenterId` int(11) NOT NULL,
  `UserId` int(11) DEFAULT NULL,
  `FullName` varchar(200) DEFAULT NULL,
  `IdType` varchar(200) DEFAULT NULL,
  `ValidID` varchar(200) DEFAULT NULL,
  `SelfieID` varchar(200) DEFAULT NULL,
  `SocialLink` varchar(200) DEFAULT NULL,
  `Country` varchar(200) DEFAULT NULL,
  `City` varchar(200) DEFAULT NULL,
  `Barangay` varchar(200) DEFAULT NULL,
  `StreetAddress` varchar(200) DEFAULT NULL,
  `PhoneNumber` varchar(200) DEFAULT NULL,
  `EmailAddress` varchar(200) DEFAULT NULL,
  `Status` enum('Pending','Approved','Rejected') DEFAULT 'Pending',
  `AdminNotes` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `renter`
--

INSERT INTO `renter` (`RenterId`, `UserId`, `FullName`, `IdType`, `ValidID`, `SelfieID`, `SocialLink`, `Country`, `City`, `Barangay`, `StreetAddress`, `PhoneNumber`, `EmailAddress`, `Status`, `AdminNotes`) VALUES
(4, 5, 'hahaha', 'Employee’s ID / Office ID', 'watch.jpg', 'gin.jpg', 'twitter.com', 'Philippines', 'Davao City', 'Bantol', 'wala', '09789852741', 'wala@gmail.com', '', ''),
(5, 5, 'wala wala', 'Employee’s ID / Office ID', 'LIVEFORMS.jpg', 'OVERVIEW.txt', 'twitter.com', 'Philippines', 'Davao City', 'Balengaeng', 'wala', '09789852741', 'wala@gmail.com', 'Approved', ''),
(6, 5, 'wala wala', 'COMELEC / Voter’s ID / COMELEC Registration Form', 'Letter.docx', 'Memorandum.docx', 'twitter.com', 'Philippines', 'Davao City', 'Bantol', 'Wala', '09789852741', 'jude@gmail.com', '', ''),
(7, 5, 'wala wala', 'Employee’s ID / Office ID', 'Profile1.jpg', 'watch.jpg', 'twitter.com', 'Philippines', 'Davao City', 'Balengaeng', 'Wala', '09789852741', 'jude@gmail.com', '', 'hi'),
(8, 5, 'wala wala', 'National ID', 'OVERVIEW.txt', 'LIVEFORMS.jpg', 'twitter.com', 'Philippines', 'Davao City', 'Alambre', 'Wala', '09789852741', 'jude@gmail.com', '', 'mali imong id '),
(9, 5, 'wala wala', 'Employee’s ID / Office ID', 'Memorandum.docx', 'Letter.docx', 'twitter.com', 'Philippines', 'Davao City', 'Bantol', 'Wala', '09789852741', 'jude@gmail.com', 'Rejected', 'mali imong id'),
(10, 5, 'wala wala', 'COMELEC / Voter’s ID / COMELEC Registration Form', 'Profile1.jpg', 'LIVEFORMS.jpg', 'twitter.com', 'Philippines', 'Davao City', 'Baracatan', 'Wala', '09789852741', 'jude@gmail.com', 'Approved', ''),
(11, 6, 'hi hi', 'COMELEC / Voter’s ID / COMELEC Registration Form', 'Profile1.jpg', 'watch.jpg', 'twitter.com', 'Philippines', 'Davao City', 'Bantol', 'aws', '09789564123', 'al@gmail.com', 'Approved', ''),
(12, 6, 'hi hi', 'COMELEC / Voter’s ID / COMELEC Registration Form', 'watch.jpg', 'gin.jpg', 'twitter.com', 'Philippines', 'Davao City', 'Sulop', 'Wala', '09789564123', 'al@gmail.com', 'Approved', 'nice one'),
(13, 9, 'a m', 'Barangay ID', 'OVERVIEW.txt', 'Profile1.jpg', 'twitter.com', 'Philippines', 'Davao City', 'Bangkas Heights', 'wa', '09852741963', 'a@gmail.com', 'Approved', '');

-- --------------------------------------------------------

--
-- Table structure for table `seller`
--

CREATE TABLE `seller` (
  `sellerID` int(11) NOT NULL,
  `userID` int(11) DEFAULT NULL,
  `fullName` varchar(200) DEFAULT NULL,
  `businessName` varchar(200) DEFAULT NULL,
  `idType` varchar(200) DEFAULT NULL,
  `validID` varchar(200) DEFAULT NULL,
  `selfieID` varchar(200) DEFAULT NULL,
  `socialLink` varchar(200) DEFAULT NULL,
  `country` varchar(200) DEFAULT NULL,
  `city` varchar(200) DEFAULT NULL,
  `barangay` varchar(200) DEFAULT NULL,
  `streetAddress` varchar(200) DEFAULT NULL,
  `phoneNumber` varchar(200) DEFAULT NULL,
  `emailAddress` varchar(200) DEFAULT NULL,
  `status` enum('Pending','Approved','Rejected') DEFAULT 'Pending',
  `AdminNotes` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `seller`
--

INSERT INTO `seller` (`sellerID`, `userID`, `fullName`, `businessName`, `idType`, `validID`, `selfieID`, `socialLink`, `country`, `city`, `barangay`, `streetAddress`, `phoneNumber`, `emailAddress`, `status`, `AdminNotes`) VALUES
(1, 2, 'black nigga', 'Davao Central College Rasay Campus Library', 'COMELEC / Voter’s ID / COMELEC Registration Form', 'LIVEFORMS.jpg', 'gin.jpg', 'facebook.com', 'PH', 'Davao City', 'Toril', 'Ilocano Village', '09456789123', 'nigga@gmail.com', 'Rejected', 'mali imong id or blurred'),
(2, 3, 'yo yo', 'National Bookstore', 'National ID', 'Profile1.jpg', 'watch.jpg', 'facebook.com', 'PH', 'Davao City', 'Barangay 10-A', 'wala', '09789456123', 'yo@gmail.com', 'Approved', ''),
(3, 1, 'hola bro hi', 'Store', 'National ID', 'Profile1.jpg', 'LIVEFORMS.jpg', 'facebook.com', 'Philippines', 'Davao City', 'Toril', 'Mcleod', '09123456789', '123@gmail.com', 'Approved', 'nice one '),
(4, 7, 'aq aq', 'Bookstore', 'National ID', 'Profile1.jpg', 'watch.jpg', 'facebook.com', 'Philippines', 'Davao City', 'Bago Gallera', '123', '09789456963', 'aq@gmail.com', 'Approved', 'nice one'),
(5, 8, 'alaws alaws', 'dasd', 'Employee’s ID / Office ID', 'Profile1.jpg', 'LIVEFORMS.jpg', 'facebook.com', 'Philippines', 'Davao City', 'Bangkas Heights', 'aws', '09987654321', 'alaws@gmail.com', 'Approved', ''),
(6, 10, 'jude larroza', 'Library', 'National ID', 'LIVEFORMS.jpg', 'Profile1.jpg', 'facebook.com', 'Philippines', 'Davao City', 'Santo Tomas', 'wala', '09789456963', 'jude@gmail.com', 'Approved', ''),
(7, 10, 'jude larroza', 'aws', 'Barangay ID', 'OVERVIEW.txt', 'NAV BAR HEADER WITH SELLING.txt', 'facebook.com', 'Philippines', 'Davao City', 'Barangay 10-A', 'Ilocano Village', '09789456963', 'jude@gmail.com', 'Approved', ''),
(8, 10, 'jude larroza', 'Davao Central College Rasay Campus Library', 'Barangay ID', 'Profile1.jpg', 'LIVEFORMS.jpg', 'facebook.com', 'Philippines', 'Davao City', 'Barangay 11-B', '123', '09789456963', 'jude@gmail.com', 'Approved', ''),
(9, 10, 'jude larroza', 'Store', 'Barangay ID', 'NAV BAR HEADER WITH SELLING.txt', 'Profile1.jpg', 'facebook.com', 'Philippines', 'Davao City', 'Bangkas Heights', 'wala', '09789456963', 'jude@gmail.com', 'Approved', ''),
(10, 11, 'lala lala', 'Davao Central College Rasay Campus Library', 'Barangay ID', 'LIVEFORMS.jpg', 'gin.jpg', 'facebook.com', 'Philippines', 'Davao City', 'Barangay 10-A', '123', '09789654321', 'lala@gmail.com', 'Approved', ''),
(11, 12, 'hahahaha wa', 'Dangrey Store', 'Barangay ID', 'LIVEFORMS.jpg', 'LIVEFORMS.jpg', 'facebook.com', 'Philippines', 'Davao City', 'Baliok', 'aws', '09789456123', 'wa@gmail.com', 'Approved', 'hola'),
(12, 12, 'hahahaha wa', 'dasd', 'Employee’s ID / Office ID', 'LIVEFORMS.jpg', 'LIVEFORMS.jpg', 'facebook.com', 'Philippines', 'Davao City', 'Bago Aplaya', '123', '09789456123', 'wa@gmail.com', 'Approved', 'ambut nmo'),
(13, 12, 'hahahaha wa', 'National Bookstore', 'Philippine Postal ID', 'LIVEFORMS.jpg', 'LIVEFORMS.jpg', 'face@gmail.com', 'Philippines', 'Davao City', 'Acacia', 'asd', '09789456123', 'wa@gmail.com', 'Approved', 'wahahaha'),
(14, 12, 'hahahaha wa', 'wahahaha', 'COMELEC / Voter’s ID / COMELEC Registration Form', 'LIVEFORMS.jpg', 'LIVEFORMS.jpg', 'aws', 'Philippines', 'Davao City', 'Alejandra Navarro', '123', '09789456123', 'wa@gmail.com', 'Approved', 'nc 1 '),
(15, 13, '123 123', '123', 'Barangay ID', 'LIVEFORMS.jpg', 'LIVEFORMS.jpg', '123@gmail.com', 'Philippines', 'Davao City', 'Barangay 10-A', '123', '09987654123', '123@gmail.com', 'Approved', ''),
(16, 17, 'kristian wala', 'Davao Central College Rasay Campus Library', 'Employee’s ID / Office ID', 'LIVEFORMS.jpg', 'LIVEFORMS.jpg', 'asd@gmail.com', 'Philippines', 'Davao City', 'Bantol', 'as', '09123451234', 'kristian@gmail.com', 'Approved', ''),
(17, 18, 'try try', '123', 'Employee’s ID / Office ID', 'LIVEFORMS.jpg', 'LIVEFORMS.jpg', '123W@gmail.com', 'Philippines', 'Davao City', 'Barangay 13-B', 'asd', '09789456123', 'aa@gmail.com', 'Approved', ''),
(18, 17, 'kristian wala', 'new', 'Barangay ID', 'Memorandum.docx', 'OVERVIEW.txt', '123@gmail.com', 'Philippines', 'Davao City', 'Barangay 27-C', '123', '09123451234', 'kristian@gmail.com', 'Approved', ''),
(19, 19, 'inaka tanginamo', 'burat', 'Barangay ID', 'LIVEFORMS.jpg', 'LIVEFORMS.jpg', 'aws@gmail.com', 'Philippines', 'Davao City', 'Tagum', 'aws', '09123456789', 'ina@gmail.com', 'Approved', ''),
(20, 19, 'inaka tanginamo', '123', 'COMELEC / Voter’s ID / COMELEC Registration Form', 'LIVEFORMS.jpg', 'LIVEFORMS.jpg', '123@gmail.com', 'Philippines', 'Davao City', 'Bangkas Heights', 'aws', '09123456789', 'ina@gmail.com', 'Approved', ''),
(21, 20, 'az az', 'Davao Central College Rasay Campus Library', 'National ID', 'ID.png', 'ID.png', '123@gmail.com', 'Philippines', 'Davao City', 'Bantol', '123', '09789456123', 'az@gmail.com', 'Approved', ''),
(24, 21, 'bb bb', 'asd', 'Barangay ID', 'ID.png', 'LIVEFORMS.jpg', '123@gmail.com', 'Philippines', 'Davao City', 'Baracatan', '123', '09789456123', 'bb@gmail.com', 'Approved', ''),
(25, 23, 'dd dd', 'kiray', 'Barangay ID', 'watch.jpg', 'gin.jpg', '123@gmail.com', 'Philippines', 'Davao City', 'Bangkas Heights', 'Ilocano Village', '09789456123', 'dd@gmail.com', 'Approved', '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userId` int(20) NOT NULL,
  `lastName` varchar(200) NOT NULL,
  `firstName` varchar(200) NOT NULL,
  `emailAddress` varchar(200) NOT NULL,
  `phoneNumber` varchar(11) NOT NULL,
  `createPassword` varchar(200) NOT NULL,
  `confirmPassword` varchar(200) NOT NULL,
  `statusType` varchar(200) NOT NULL,
  `profileImage` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userId`, `lastName`, `firstName`, `emailAddress`, `phoneNumber`, `createPassword`, `confirmPassword`, `statusType`, `profileImage`) VALUES
(1, 'hi', 'hola bro', '12345@gmail.com', '09123456789', '123', '123', 'NewCustomer', 'gin.jpg'),
(2, 'nigga', 'black', 'nigga@gmail.com', '09456789123', '123', '123', 'NewCustomer', NULL),
(3, 'yo', 'yo', 'yo@gmail.com', '09789456123', '123', '123', 'NewCustomer', NULL),
(4, 'book', 'renter', 'rent@gmail.com', '09789654321', '123', '123', 'NewCustomer', 'gin.jpg'),
(5, 'wala', 'wala', 'wala@gmail.com', '09789852741', '123', '123', 'NewCustomer', NULL),
(6, 'hi', 'hi', 'al@gmail.com', '09789564123', '123', '123', 'renter', NULL),
(7, 'aq', 'aq', 'aq@gmail.com', '09789456963', '123', '123', 'seller', NULL),
(8, 'alaws', 'alaws', 'alaws@gmail.com', '09987654321', '123', '123', 'seller', NULL),
(9, 'm', 'a', 'a@gmail.com', '09852741963', '123', '123', 'renter', NULL),
(10, 'larroza', 'jude', 'jude@gmail.com', '09789456963', '123', '123', 'seller', NULL),
(11, 'lala', 'lala', 'lala@gmail.com', '09789654321', '123', '123', 'seller', NULL),
(12, 'wa', 'hahahaha', 'wa@gmail.com', '09789456123', '123', '123', 'seller', 'LIVEFORMS.jpg'),
(13, '123', '123', '123@gmail.com', '09987654123', '123', '123', 'NewCustomer', NULL),
(14, 'hola', 'aws', 'aws@gmail.com', '09789456123', '123', '123', 'NewCustomer', NULL),
(15, 'ka', 'ka', 'ka@gmail.com', '09123123123', '123', '123', 'NewCustomer', NULL),
(16, 'zxc', 'zxc', 'zxc@gmail.com', '09789456123', '123', '123', 'NewCustomer', NULL),
(17, 'wala', 'kristian', 'kristian@gmail.com', '09123451234', '123', '123', 'seller', NULL),
(18, 'try', 'try', 'aa@gmail.com', '09789456123', '123', '123', 'NewCustomer', 'LIVEFORMS.jpg'),
(19, 'tanginamo', 'inaka', 'ina@gmail.com', '09123456789', '123', '123', 'seller', NULL),
(20, 'az', 'az', 'az@gmail.com', '09789456123', '123', '123', 'seller', NULL),
(21, 'bb', 'bb', 'bb@gmail.com', '09789456123', '123', '123', 'seller', 'ID.png'),
(22, 'cc', 'cc', 'cc@gmail.com', '09123456789', '123', '123', 'NewCustomer', NULL),
(23, 'dd', 'dd', 'dd@gmail.com', '09963852741', '123', '123', 'seller', 'gin.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `manage`
--
ALTER TABLE `manage`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`notifId`),
  ADD KEY `userId` (`userId`);

--
-- Indexes for table `renter`
--
ALTER TABLE `renter`
  ADD PRIMARY KEY (`RenterId`),
  ADD KEY `UserId` (`UserId`);

--
-- Indexes for table `seller`
--
ALTER TABLE `seller`
  ADD PRIMARY KEY (`sellerID`),
  ADD KEY `userID` (`userID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `Id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `manage`
--
ALTER TABLE `manage`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `notifId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `renter`
--
ALTER TABLE `renter`
  MODIFY `RenterId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `seller`
--
ALTER TABLE `seller`
  MODIFY `sellerID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userId` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `users` (`userId`);

--
-- Constraints for table `renter`
--
ALTER TABLE `renter`
  ADD CONSTRAINT `renter_ibfk_1` FOREIGN KEY (`UserId`) REFERENCES `users` (`userId`) ON DELETE CASCADE;

--
-- Constraints for table `seller`
--
ALTER TABLE `seller`
  ADD CONSTRAINT `seller_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `users` (`userId`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
