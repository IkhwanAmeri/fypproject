-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 05, 2020 at 05:18 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fyp1`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `cust_id` int(11) NOT NULL,
  `cust_name` varchar(50) NOT NULL,
  `cust_cont` text NOT NULL,
  `address` text NOT NULL,
  `city` varchar(50) NOT NULL,
  `state` varchar(50) NOT NULL,
  `poscode` text NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`cust_id`, `cust_name`, `cust_cont`, `address`, `city`, `state`, `poscode`, `user_id`) VALUES
(1, 'wan', '0194836310', '1G Lorong Teku Jalan Teku', 'Sibu', 'Sarawak', '96000', 2),
(2, 'wanzul', '01114560987', '5f Lorong Bachok Baru Jalan Bachok', 'Kuantan', 'Pahang', '25000', 2),
(3, 'Mizan', '0139870987', '3G Lorong 22J Jalan Desa Ilmu', 'Kota Samarahan', 'Kuching', '94300', 2),
(4, 'Izzat', '0129870987', '3G Lorong 22J Jalan Desa Ilmu', 'Kota Samarahan', 'Kuching', '94300', 2),
(5, 'Muz', '0114870981', '21E Lorong 22J Jalan Desa Ilmu', 'Kota Samarahan', 'Kuching', '94300', 2);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(50) NOT NULL,
  `product_price` decimal(10,2) NOT NULL,
  `product_qty` int(100) NOT NULL,
  `description` text NOT NULL,
  `supplier` varchar(50) NOT NULL,
  `prod_pic` varchar(300) NOT NULL DEFAULT 'default.gif',
  `user_id` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `product_name`, `product_price`, `product_qty`, `description`, `supplier`, `prod_pic`, `user_id`) VALUES
(1, 'Tone plus lite', '10.00', 30, 'Tone plus lite', 'Tone Wow HQ', 'default.gif', 2),
(2, 'Tone excel lite', '10.00', 30, 'Tone excel lite', 'Tone Wow HQ', 'default.gif', 2),
(3, 'Tone excel push', '25.00', 30, 'Tone excel push', 'Tone Wow HQ', 'default.gif', 2),
(4, 'Tone excel biz', '98.00', 29, 'Tone excel biz', 'Tone Wow HQ', 'default.gif', 2);

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `sales_id` int(11) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT 0,
  `cust_id` int(11) NOT NULL DEFAULT 0,
  `date_added` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`sales_id`, `total`, `user_id`, `cust_id`, `date_added`) VALUES
(1, '100.00', 2, 4, '2020-05-04 10:57:56'),
(2, '350.00', 2, 3, '2020-03-04 10:58:33'),
(3, '590.00', 2, 5, '2020-02-04 10:58:53'),
(4, '490.00', 2, 1, '2020-01-04 10:59:11'),
(5, '980.00', 2, 2, '2020-06-04 10:59:25'),
(6, '98.00', 2, 0, '2020-06-04 15:30:31'),
(7, '98.00', 2, 0, '2020-06-04 15:30:32');

-- --------------------------------------------------------

--
-- Table structure for table `sales_detail`
--

CREATE TABLE `sales_detail` (
  `sales_details_id` int(11) NOT NULL,
  `sales_id` int(11) NOT NULL DEFAULT 0,
  `product_id` int(11) NOT NULL DEFAULT 0,
  `price` decimal(10,2) NOT NULL,
  `qty` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sales_detail`
--

INSERT INTO `sales_detail` (`sales_details_id`, `sales_id`, `product_id`, `price`, `qty`) VALUES
(1, 1, 1, '100.00', 10),
(2, 2, 3, '250.00', 10),
(3, 2, 2, '100.00', 10),
(4, 3, 4, '490.00', 5),
(5, 3, 1, '100.00', 10),
(6, 4, 4, '490.00', 5),
(7, 5, 4, '980.00', 10),
(8, 6, 4, '98.00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `stockin`
--

CREATE TABLE `stockin` (
  `stockin_id` int(11) NOT NULL,
  `s_quantity` int(11) NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT 0,
  `product_id` int(11) NOT NULL DEFAULT 0,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `stockin`
--

INSERT INTO `stockin` (`stockin_id`, `s_quantity`, `user_id`, `product_id`, `date`) VALUES
(1, 20, 2, 4, '2020-06-04 11:02:41'),
(2, 10, 2, 2, '2020-06-04 11:02:51'),
(3, 10, 2, 3, '2020-06-04 11:03:06'),
(4, 20, 2, 1, '2020-06-04 11:03:12');

-- --------------------------------------------------------

--
-- Table structure for table `temp_trans`
--

CREATE TABLE `temp_trans` (
  `temp_trans_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL DEFAULT 0,
  `price` decimal(10,2) NOT NULL,
  `qty` int(100) NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `cont` text DEFAULT NULL,
  `pro_pic` varchar(300) DEFAULT 'default.gif',
  `status` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `name`, `password`, `cont`, `pro_pic`, `status`) VALUES
(1, 'admin', 'admin', '81dc9bdb52d04dc20036dbd8313ed055', '0134567890', 'default.gif', 'admin'),
(2, 'Isman', 'Isman S', '76d80224611fc919a5d54f0ff9fba446', '01298712342', 'default.gif', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`cust_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`sales_id`);

--
-- Indexes for table `sales_detail`
--
ALTER TABLE `sales_detail`
  ADD PRIMARY KEY (`sales_details_id`);

--
-- Indexes for table `stockin`
--
ALTER TABLE `stockin`
  ADD PRIMARY KEY (`stockin_id`);

--
-- Indexes for table `temp_trans`
--
ALTER TABLE `temp_trans`
  ADD PRIMARY KEY (`temp_trans_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `cust_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `sales_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `sales_detail`
--
ALTER TABLE `sales_detail`
  MODIFY `sales_details_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `stockin`
--
ALTER TABLE `stockin`
  MODIFY `stockin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `temp_trans`
--
ALTER TABLE `temp_trans`
  MODIFY `temp_trans_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
