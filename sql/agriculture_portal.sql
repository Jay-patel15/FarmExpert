-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 11, 2025 at 07:22 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `agriculture_portal`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `cropname` varchar(50) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `crops`
--

CREATE TABLE `crops` (
  `Crop_id` int(11) NOT NULL,
  `Crop_name` varchar(255) NOT NULL,
  `N_value` double NOT NULL,
  `P_value` double NOT NULL,
  `K_value` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `custlogin`
--

CREATE TABLE `custlogin` (
  `cust_id` int(11) NOT NULL,
  `cust_name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `pincode` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `phone_no` varchar(255) NOT NULL,
  `otp` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `farmerlogin`
--

CREATE TABLE `farmerlogin` (
  `farmer_id` int(11) NOT NULL,
  `farmer_name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone_no` varchar(50) NOT NULL,
  `F_gender` varchar(255) NOT NULL,
  `F_birthday` varchar(255) NOT NULL,
  `F_State` varchar(255) NOT NULL,
  `F_District` varchar(255) NOT NULL,
  `F_Location` varchar(255) NOT NULL,
  `F_AadharNo` varchar(255) NOT NULL,
  `F_AadharNo_file` varchar(255) NOT NULL,
  `F_Photo_Id_file` varchar(255) NOT NULL,
  `otp` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `farmerlogin`
--

INSERT INTO `farmerlogin` (`farmer_id`, `farmer_name`, `password`, `email`, `phone_no`, `F_gender`, `F_birthday`, `F_State`, `F_District`, `F_Location`, `F_AadharNo`, `F_AadharNo_file`, `F_Photo_Id_file`, `otp`) VALUES
(3, 'prathmesh', 'f7c3bc1d808e04732adf679965ccc34ca7ae3441', 'pjayp@gmail.com', '9892007108', 'Male', '2002-01-15', 'Gujarat', ' Bayad ', 'dhansura', '234526548761', 'icon1.png', 'icon1.png', 0);

-- --------------------------------------------------------

--
-- Table structure for table `farmer_crops_trade`
--

CREATE TABLE `farmer_crops_trade` (
  `trade_id` int(11) NOT NULL,
  `farmer_fkid` int(11) NOT NULL,
  `Trade_crop` varchar(255) NOT NULL,
  `Crop_quantity` double NOT NULL,
  `costperkg` int(11) NOT NULL,
  `msp` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `farmer_crops_trade`
--

INSERT INTO `farmer_crops_trade` (`trade_id`, `farmer_fkid`, `Trade_crop`, `Crop_quantity`, `costperkg`, `msp`) VALUES
(1, 3, 'barley', 56, 10, 15);

-- --------------------------------------------------------

--
-- Table structure for table `farmer_history`
--

CREATE TABLE `farmer_history` (
  `History_id` int(11) NOT NULL,
  `farmer_id` int(11) NOT NULL,
  `farmer_crop` varchar(255) NOT NULL,
  `farmer_quantity` int(11) NOT NULL,
  `farmer_price` int(11) NOT NULL,
  `date` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `governmentlogin`
--

CREATE TABLE `governmentlogin` (
  `GId` int(11) NOT NULL,
  `Admin_name` varchar(255) NOT NULL,
  `Admin_password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------
INSERT INTO 'governmentlogin' (GId, Admin_name, Admin_password)  
VALUES (1, 'Admin', '123');



CREATE TABLE news (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(500),
    description TEXT,
    url VARCHAR(500),
    image VARCHAR(500),
    author VARCHAR(255),
    category VARCHAR(100),
    publishedAt DATETIME,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
-- --------------------------------------------------------

--
-- Table structure for table `production_approx`
--

CREATE TABLE `production_approx` (
  `crop` varchar(20) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cropname` (`cropname`);

--
-- Indexes for table `crops`
--
ALTER TABLE `crops`
  ADD PRIMARY KEY (`Crop_id`);

--
-- Indexes for table `custlogin`
--
ALTER TABLE `custlogin`
  ADD PRIMARY KEY (`cust_id`);

--
-- Indexes for table `farmerlogin`
--
ALTER TABLE `farmerlogin`
  ADD PRIMARY KEY (`farmer_id`);

--
-- Indexes for table `farmer_crops_trade`
--
ALTER TABLE `farmer_crops_trade`
  ADD PRIMARY KEY (`trade_id`),
  ADD KEY `farmer_fkid` (`farmer_fkid`);

--
-- Indexes for table `farmer_history`
--
ALTER TABLE `farmer_history`
  ADD PRIMARY KEY (`History_id`);

--
-- Indexes for table `governmentlogin`
--
ALTER TABLE `governmentlogin`
  ADD PRIMARY KEY (`GId`);

--
-- Indexes for table `production_approx`
--
ALTER TABLE `production_approx`
  ADD PRIMARY KEY (`crop`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `crops`
--
ALTER TABLE `crops`
  MODIFY `Crop_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `custlogin`
--
ALTER TABLE `custlogin`
  MODIFY `cust_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `farmerlogin`
--
ALTER TABLE `farmerlogin`
  MODIFY `farmer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `farmer_crops_trade`
--
ALTER TABLE `farmer_crops_trade`
  MODIFY `trade_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `farmer_history`
--
ALTER TABLE `farmer_history`
  MODIFY `History_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `governmentlogin`
--
ALTER TABLE `governmentlogin`
  MODIFY `GId` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `farmer_crops_trade`
--
ALTER TABLE `farmer_crops_trade`
  ADD CONSTRAINT `farmer_crops_trade_ibfk_1` FOREIGN KEY (`farmer_fkid`) REFERENCES `farmerlogin` (`farmer_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
