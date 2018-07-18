-- phpMyAdmin SQL Dump
-- version 4.2.7
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 07, 2015 at 06:33 PM
-- Server version: 5.5.38-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `sk_paypal4method`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_Payment_details`
--

CREATE TABLE IF NOT EXISTS `tbl_Payment_details` (
`id` int(11) NOT NULL,
  `AccessToken` varchar(255) NOT NULL,
  `transactionId` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `intent` varchar(255) NOT NULL,
  `amount` float NOT NULL,
  `currency` varchar(255) NOT NULL,
  `authorizationId` varchar(255) NOT NULL,
  `captureURL` varchar(255) NOT NULL,
  `refundURL` varchar(255) NOT NULL,
  `paymentMethod` varchar(255) NOT NULL,
  `firstName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `createdTime` datetime NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=95 ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_Payment_details`
--
ALTER TABLE `tbl_Payment_details`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_Payment_details`
--
ALTER TABLE `tbl_Payment_details`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=95;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
