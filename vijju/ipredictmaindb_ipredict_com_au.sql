-- phpMyAdmin SQL Dump
-- version 3.5.0
-- http://www.phpmyadmin.net
--
-- Host: MYSQL-2.servers.netregistry.net
-- Generation Time: May 12, 2016 at 03:24 PM
-- Server version: 5.5.32-31.0-log
-- PHP Version: 5.3.29

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ipredictmaindb_ipredict_com_au`
--

-- --------------------------------------------------------

--
-- Table structure for table `IP_PROPERTY_TABLE`
--

CREATE TABLE IF NOT EXISTS `IP_PROPERTY_TABLE` (
  `PT_OUID` int(255) NOT NULL AUTO_INCREMENT,
  `PT_VFUID1` varchar(300) NOT NULL,
  `PT_VFUID2` varchar(300) NOT NULL,
  `PT_VFUID3` varchar(300) NOT NULL,
  `PT_TYPE` varchar(50) NOT NULL,
  `PT_CAT1` tinyint(1) NOT NULL,
  `PT_CAT2` tinyint(1) NOT NULL,
  `PT_CAT3` tinyint(1) NOT NULL,
  `PT_STREET1` varchar(300) NOT NULL,
  `PT_STREET2` varchar(300) NOT NULL,
  `PT_SUBURB` varchar(300) NOT NULL,
  `PT_POSTCODE` varchar(100) NOT NULL,
  `PT_MAP1` varchar(300) NOT NULL,
  `PT_MAP2` varchar(300) NOT NULL,
  `PT_MAP3` varchar(300) NOT NULL,
  `PT_NOBED` int(255) NOT NULL,
  `PT_NOCAR` int(255) NOT NULL,
  `PT_NOBATH` int(255) NOT NULL,
  `PT_LISTADDLONG` varchar(300) NOT NULL,
  `PT_LISTADDSHRT` varchar(300) NOT NULL,
  `PT_AUCDATE` date NOT NULL,
  `PT_AUCLOW` int(255) NOT NULL,
  `PT_AUCHIGH` int(255) NOT NULL,
  PRIMARY KEY (`PT_OUID`),
  UNIQUE KEY `PT_OUID` (`PT_OUID`,`PT_VFUID1`,`PT_VFUID2`,`PT_VFUID3`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Main Property Table' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `IP_USER_TABLE`
--

CREATE TABLE IF NOT EXISTS `IP_USER_TABLE` (
  `UT_UID` int(255) NOT NULL,
  `UT_FNAME` varchar(300) NOT NULL,
  `UT_LNAME` varchar(300) NOT NULL,
  `UT_GENDER` varchar(1) NOT NULL,
  `UT_DOB` date NOT NULL,
  `UT_EMAIL` varchar(300) NOT NULL,
  `UT_PUBLICNAME1` varchar(300) NOT NULL,
  `UT_PUBLICNAME2` varchar(300) NOT NULL,
  `UT_FLAGAGENT` tinyint(1) NOT NULL,
  `UT_FLAGHIDE` tinyint(1) NOT NULL,
  `UT_FLAGPREM` tinyint(1) NOT NULL,
  `UT_SUBURB` varchar(300) NOT NULL,
  `UT_POSTCODE` varchar(100) NOT NULL,
  PRIMARY KEY (`UT_UID`),
  UNIQUE KEY `UT_UID` (`UT_UID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Main User Table';

-- --------------------------------------------------------

--
-- Table structure for table `IP_VENDORFOREIGN_TABLE`
--

CREATE TABLE IF NOT EXISTS `IP_VENDORFOREIGN_TABLE` (
  `VF_OUID` int(255) NOT NULL,
  `VF_VUID1` int(255) NOT NULL,
  `VF_VUID2` int(255) NOT NULL,
  `VF_VUID3` int(255) NOT NULL,
  `VF_VURL1` text NOT NULL,
  `VF_VURL2` text NOT NULL,
  `VF_VURL3` text NOT NULL,
  `VF_VNAME` text NOT NULL,
  `VF_VSHORT` text NOT NULL,
  PRIMARY KEY (`VF_OUID`),
  UNIQUE KEY `VF_VUID1` (`VF_VUID1`,`VF_VUID2`,`VF_VUID3`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `PE2_PROPERTY`
--

CREATE TABLE IF NOT EXISTS `PE2_PROPERTY` (
  `PT_ID` int(20) NOT NULL AUTO_INCREMENT,
  `PT_EXTERNAL_ID` varchar(255) NOT NULL,
  `PT_VFUID1` varchar(255) NOT NULL,
  `PT_VFUID2` varchar(255) NOT NULL,
  `PT_VFUID3` varchar(255) NOT NULL,
  `PT_PROP_FROM` int(20) NOT NULL COMMENT '1 = Our Own, 2 = RealEstate, 3 = Domain, 4 = Core Logic, 5= Others ',
  `PT_TYPE` varchar(255) NOT NULL,
  `PT_CAT1` int(20) NOT NULL COMMENT '1=mywish, 2=facebook, 3= trend, 4=public',
  `PT_CAT2` int(20) NOT NULL,
  `PT_CAT3` int(20) NOT NULL,
  `PT_STREET1` varchar(255) NOT NULL,
  `PT_STREET2` varchar(255) NOT NULL,
  `PT_SUBURB` varchar(255) NOT NULL,
  `PT_POSTCODE` varchar(255) NOT NULL,
  `PT_LAT` varchar(255) NOT NULL,
  `PT_LNG` varchar(255) NOT NULL,
  `PT_NO_BED` int(11) NOT NULL,
  `PT_NO_CAR` int(11) NOT NULL,
  `PT_NO_BATH` int(11) NOT NULL,
  `PT_AUC_DATE` varchar(255) NOT NULL,
  `PT_AUC_HIGH` varchar(255) NOT NULL,
  `PT_AUC_LOW` varchar(255) NOT NULL,
  `PT_ADDRESS_LONG` text NOT NULL,
  `PT_ADDRESS_SHORT` varchar(255) NOT NULL,
  `PT_AGENT_ID` int(20) NOT NULL,
  `PT_AGENT_IMAGE` varchar(255) NOT NULL,
  `PT_AGENT_NAME` varchar(255) NOT NULL,
  `PT_IMAGE_MAIN` varchar(255) NOT NULL,
  `PT_IMAGE_FREE1` varchar(255) NOT NULL,
  `PT_IMAGE_FREE2` varchar(255) NOT NULL,
  `PT_IMAGE_FREE3` varchar(255) NOT NULL,
  `PT_IMAGE_FREE4` varchar(255) NOT NULL,
  `PT_IMAGE_FREE5` varchar(255) NOT NULL,
  `PT_TOTAL_PREDICTS` int(30) NOT NULL DEFAULT '0',
  `PT_AVERAGE_PREDICTION` int(30) NOT NULL DEFAULT '0',
  `PT_IS_TRENDING` int(10) NOT NULL DEFAULT '0',
  `PT_IS_PUBLIC` int(10) NOT NULL DEFAULT '0',
  `PT_IS_MY_WISHLIST` int(10) NOT NULL DEFAULT '0',
  `PT_IS_FACEBOOK` int(10) NOT NULL DEFAULT '0',
  `PT_ADDED_BY` int(20) NOT NULL,
  `PT_STATUS` varchar(255) NOT NULL DEFAULT '0' COMMENT '1= Normal (running), 2= sold out, 3= value',
  `PT_SOLD_PRICE` int(30) NOT NULL DEFAULT '0',
  `PT_SOLD_DATE` varchar(255) NOT NULL,
  `PT_IS_FLAGGED` int(11) NOT NULL DEFAULT '0',
  `PT_CREATED_AT` varchar(255) NOT NULL,
  `PT_UPDATED_AT` varchar(255) NOT NULL,
  PRIMARY KEY (`PT_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=30 ;

--
-- Dumping data for table `PE2_PROPERTY`
--

INSERT INTO `PE2_PROPERTY` (`PT_ID`, `PT_EXTERNAL_ID`, `PT_VFUID1`, `PT_VFUID2`, `PT_VFUID3`, `PT_PROP_FROM`, `PT_TYPE`, `PT_CAT1`, `PT_CAT2`, `PT_CAT3`, `PT_STREET1`, `PT_STREET2`, `PT_SUBURB`, `PT_POSTCODE`, `PT_LAT`, `PT_LNG`, `PT_NO_BED`, `PT_NO_CAR`, `PT_NO_BATH`, `PT_AUC_DATE`, `PT_AUC_HIGH`, `PT_AUC_LOW`, `PT_ADDRESS_LONG`, `PT_ADDRESS_SHORT`, `PT_AGENT_ID`, `PT_AGENT_IMAGE`, `PT_AGENT_NAME`, `PT_IMAGE_MAIN`, `PT_IMAGE_FREE1`, `PT_IMAGE_FREE2`, `PT_IMAGE_FREE3`, `PT_IMAGE_FREE4`, `PT_IMAGE_FREE5`, `PT_TOTAL_PREDICTS`, `PT_AVERAGE_PREDICTION`, `PT_IS_TRENDING`, `PT_IS_PUBLIC`, `PT_IS_MY_WISHLIST`, `PT_IS_FACEBOOK`, `PT_ADDED_BY`, `PT_STATUS`, `PT_SOLD_PRICE`, `PT_SOLD_DATE`, `PT_IS_FLAGGED`, `PT_CREATED_AT`, `PT_UPDATED_AT`) VALUES
(1, '', 'http://www.domain.com.au/15-clive-street-revesby-nsw-2212-2012695095', 'http://www.domain.com.au/15-clive-street-revesby-nsw-2212-2012695095', 'https://www.mcgrath.com.au/buy/house/nsw/canterbury-bankstown/revesby/304405', 3, 'House', 0, 0, 0, '15 Clive Street', '', 'Revesby', '2212', '-33.963988', '151.013622', 4, 2, 2, '27/04/16 5:30PM', '1150000', '1050000', '15 Clive Street, Revesby, NSW, 2212', 'Revesby, NSW', 1, 'Images/1Agent.jpeg', 'Lush Pillay', 'Images/1Main.jpeg', 'Images/1Free1.jpeg', 'Images/1Free2.jpeg', 'Images/1Free3.jpeg', 'Images/1Free4.jpeg', 'Images/1Free5.jpeg', 3, 3297785, 1, 1, 0, 0, 0, '1', 0, '', 0, '2016-05-03 13:04:43', '2016-05-09 12:49:57'),
(2, '', 'http://www.domain.com.au/43b-ferndale-road-revesby-nsw-2212-2012722296', 'http://www.domain.com.au/15-clive-street-revesby-nsw-2212-2012695095', 'https://www.mcgrath.com.au/buy/house/nsw/canterbury-bankstown/revesby/304405', 3, 'House', 0, 0, 0, '43B Ferndale Road', '', 'Revesby', '2212', '-33.962422', '151.010471', 4, 1, 3, 'TBD', '', '?', '43B Ferndale Road, Revesby, NSW, 2212', 'Revesby, NSW', 1, 'Images/1Agent.jpeg', 'Carol Annis', 'Images/2Main.jpeg', 'Images/2Free1.jpeg', 'Images/2Free2.jpeg', 'Images/2Free3.jpeg', 'Images/2Free4.jpeg', 'Images/2Free5.jpeg', 2, 60000, 1, 0, 1, 0, 0, '2', 65000, '2016-05-05 13:04:43', 0, '2016-05-03 13:04:43', '2016-05-06 10:05:35'),
(3, '', 'http://www.domain.com.au/16-phillip-street-panania-nsw-2213-2012744677', 'http://www.domain.com.au/15-clive-street-revesby-nsw-2212-2012695095', 'https://www.mcgrath.com.au/buy/house/nsw/canterbury-bankstown/revesby/304405', 3, 'House', 0, 0, 0, '16 Phillip Street', '', 'Panania', '2213', '-33.963325', '150.999401', 4, 3, 1, '18/05/16 5:30PM', '920000', '890000', '16 Phillip Street, Panania, NSW, 2213', 'Panania, NSW', 1, 'Images/1Agent.jpeg', 'Sally Gayed', 'Images/1Main.jpeg', 'Images/1Free1.jpeg', 'Images/1Free2.jpeg', 'Images/1Free3.jpeg', 'Images/1Free4.jpeg', 'Images/1Free5.jpeg', 2, 4955000, 1, 1, 1, 1, 0, '2', 700000, '', 0, '2016-05-03 13:04:43', '2016-05-06 23:25:45'),
(4, '', 'http://www.domain.com.au/97-ramsay-road-picnic-point-nsw-2213-2012743429', 'http://www.domain.com.au/15-clive-street-revesby-nsw-2212-2012695095', 'https://www.mcgrath.com.au/buy/house/nsw/canterbury-bankstown/revesby/304405', 3, 'House', 0, 0, 0, '97 Ramsay Road', '', 'Picnic Point', '2213', '-33.969149', '151.003842', 5, 2, 3, '14/05/16 12:30PM', '965000', '?935000', '97 Ramsay Road, Picnic Point, NSW, 2213', 'Picnic Point, NSW', 1, 'Images/1Agent.jpeg', 'Michael Sleiman', 'Images/4Main.jpeg', 'Images/4Free1.jpeg', 'Images/4Free2.jpeg', 'Images/4Free3.jpeg', 'Images/4Free4.jpeg', 'Images/4Free5.jpeg', 1, 3000000, 0, 0, 0, 1, 0, '2', 800000, '', 0, '2016-05-03 13:04:43', '2016-05-05 14:44:46'),
(5, '', 'http://www.domain.com.au/97-ramsay-road-picnic-point-nsw-2213-2012743429', 'http://www.domain.com.au/15-clive-street-revesby-nsw-2212-2012695095', 'https://www.mcgrath.com.au/buy/house/nsw/canterbury-bankstown/revesby/304405', 3, 'House', 0, 0, 0, '117 Ramsay Road', '', 'Sydney', '2000', '-33.867487', '151.20699', 5, 2, 3, '28/05/16 12:30PM', '', '?', '97 Ramsay Road, Picnic Point, NSW, 2213', 'Picnic Point, NSW', 1, 'Images/1Agent.jpeg', 'Michael Sleiman', 'Images/4Main.jpeg', 'Images/4Free1.jpeg', 'Images/4Free2.jpeg', 'Images/4Free3.jpeg', 'Images/4Free4.jpeg', 'Images/4Free5.jpeg', 2, 1900000, 0, 1, 0, 1, 0, '1', 0, '', 0, '2016-05-03 13:04:43', '2016-05-09 07:29:51'),
(13, '6173728', 'http://www.domain.com.au/15-clive-street-revesby-nsw-2212-2012695095', 'http://www.domain.com.au/15-clive-street-revesby-nsw-2212-2012695095', 'https://www.mcgrath.com.au/buy/house/nsw/canterbury-bankstown/revesby/304405', 4, 'HOUSE', 0, 0, 0, '', '', 'Seven Hills', '2147', '-33.79540296', '150.92475356', 3, 2, 1, '', '', '', '4 Zermatt Avenue Seven Hills NSW 2147', '4 Zermatt Avenue Seven Hills NSW 2147', 0, '', '', 'https://static.rpdata.com/rpdaAU/photo/listsale/768x512/05/02/21/NSW01126B/308.JPG', '', '', '', '', '', 1, 1200000, 0, 0, 0, 0, 3, '1', 0, '', 0, '2016-05-05 12:59:16', '2016-05-06 22:31:29'),
(14, '6887904', 'http://www.domain.com.au/15-clive-street-revesby-nsw-2212-2012695095', 'http://www.domain.com.au/15-clive-street-revesby-nsw-2212-2012695095', 'https://www.mcgrath.com.au/buy/house/nsw/canterbury-bankstown/revesby/304405', 4, 'HOUSE', 0, 0, 0, '', '', 'Seven Hills', '2147', '-33.7967233', '150.92650444', 3, 1, 1, '', '', '', '141 Ellam Drive Seven Hills NSW 2147', '141 Ellam Drive Seven Hills NSW 2147', 0, '', '', 'https://static.rpdata.com/rpdaAU/photo/listsale/768x512/15/09/29/26093556/26093556_1.JPG', '', '', '', '', '', 2, 545000, 0, 0, 0, 0, 3, '1', 0, '', 0, '2016-05-05 13:26:57', '2016-05-06 23:26:10'),
(15, '6173753', 'http://www.domain.com.au/15-clive-street-revesby-nsw-2212-2012695095', 'http://www.domain.com.au/15-clive-street-revesby-nsw-2212-2012695095', 'https://www.mcgrath.com.au/buy/house/nsw/canterbury-bankstown/revesby/304405', 4, 'HOUSE', 0, 0, 0, '', '', 'Seven Hills', '2147', '-33.79467564', '150.92561571', 0, 0, 0, '', '', '', '14 Zermatt Avenue Seven Hills NSW 2147', '14 Zermatt Avenue Seven Hills NSW 2147', 0, '', '', 'https://static.rpdata.com/rpdaAU/photo/listsale/768x512/05/02/21/NSW01126B/312.JPG', '', '', '', '', '', 1, 2000000, 0, 0, 0, 0, 3, '1', 0, '', 0, '2016-05-05 14:33:01', '2016-05-08 15:46:38'),
(16, '17278783', 'http://www.domain.com.au/15-clive-street-revesby-nsw-2212-2012695095', 'http://www.domain.com.au/15-clive-street-revesby-nsw-2212-2012695095', 'https://www.mcgrath.com.au/buy/house/nsw/canterbury-bankstown/revesby/304405', 4, 'HOUSE', 0, 0, 0, '', '', 'Seven Hills', '2147', '-33.79482598', '150.92633296', 1, 0, 1, '', '', '', '1/120 Ellam Drive Seven Hills NSW 2147', '1/120 Ellam Drive Seven Hills NSW 2147', 0, '', '', 'https://static.rpdata.com/rpdaAU/photo/listsale/768x512/15/08/05/25863244/25863244_1.JPG', '', '', '', '', '', 1, 1600000, 0, 0, 0, 0, 3, '1', 0, '', 0, '2016-05-05 14:33:24', '2016-05-08 02:39:45'),
(17, '17460921', 'http://www.domain.com.au/15-clive-street-revesby-nsw-2212-2012695095', 'http://www.domain.com.au/15-clive-street-revesby-nsw-2212-2012695095', 'https://www.mcgrath.com.au/buy/house/nsw/canterbury-bankstown/revesby/304405', 4, 'UNIT', 0, 0, 0, '', '', 'Seven Hills', '2147', '-33.79482598', '150.92567397', 0, 0, 1, '', '', '', '12A Zermatt Avenue Seven Hills NSW 2147', '12A Zermatt Avenue Seven Hills NSW 2147', 0, '', '', 'https://static.rpdata.com/rpdaAU/photo/listsale/768x512/16/01/13/23123840/23123840_1.JPG', '', '', '', '', '', 1, 900000, 0, 0, 0, 0, 3, '1', 0, '', 0, '2016-05-05 14:42:58', '2016-05-06 22:31:41'),
(18, '6887902', 'http://www.domain.com.au/15-clive-street-revesby-nsw-2212-2012695095', 'http://www.domain.com.au/15-clive-street-revesby-nsw-2212-2012695095', 'https://www.mcgrath.com.au/buy/house/nsw/canterbury-bankstown/revesby/304405', 4, 'HOUSE', 0, 0, 0, '', '', 'Seven Hills', '2147', '-33.79660674', '150.9265285', 3, 0, 1, '', '', '', '139 Ellam Drive Seven Hills NSW 2147', '139 Ellam Drive Seven Hills NSW 2147', 0, '', '', 'https://static.rpdata.com/rpdaAU/photo/listsale/768x512/05/03/03/NSW01140F/796.JPG', '', '', '', '', '', 1, 455000, 0, 0, 0, 0, 3, '1', 0, '', 0, '2016-05-05 15:50:51', '2016-05-05 15:50:51'),
(19, '6887899', 'http://www.domain.com.au/15-clive-street-revesby-nsw-2212-2012695095', 'http://www.domain.com.au/15-clive-street-revesby-nsw-2212-2012695095', 'https://www.mcgrath.com.au/buy/house/nsw/canterbury-bankstown/revesby/304405', 4, 'UNIT', 0, 0, 0, '', '', 'Seven Hills', '2147', '-33.79642965', '150.92670168', 1, 1, 1, '', '', '', '1/137 Ellam Drive Seven Hills NSW 2147', '1/137 Ellam Drive Seven Hills NSW 2147', 0, '', '', 'https://static.rpdata.com/rpdaAU/photo/listsale/768x512/16/03/29/26856950/26856950_1.JPG', '', '', '', '', '', 1, 2600000, 0, 0, 0, 0, 3, '1', 0, '', 0, '2016-05-05 15:51:02', '2016-05-05 15:51:02'),
(20, '6173731', 'http://www.domain.com.au/15-clive-street-revesby-nsw-2212-2012695095', 'http://www.domain.com.au/15-clive-street-revesby-nsw-2212-2012695095', 'https://www.mcgrath.com.au/buy/house/nsw/canterbury-bankstown/revesby/304405', 3, 'HOUSE', 0, 0, 0, '', '', 'Seven Hills', '2147', '-33.79516662', '150.92440575', 0, 0, 0, '', '', '', '5 Zermatt Avenue Seven Hills NSW 2147', '5 Zermatt Avenue Seven Hills NSW 2147', 0, '', '', 'https://static.rpdata.com/rpdaAU/photo/listsale/768x512/05/02/21/NSW01126B/326.JPG', '', '', '', '', '', 2, 1268562, 0, 0, 0, 0, 3, '1', 0, '', 0, '2016-05-05 15:51:15', '2016-05-06 10:56:35'),
(21, '6173757', 'http://www.domain.com.au/15-clive-street-revesby-nsw-2212-2012695095', 'http://www.domain.com.au/15-clive-street-revesby-nsw-2212-2012695095', 'https://www.mcgrath.com.au/buy/house/nsw/canterbury-bankstown/revesby/304405', 4, 'HOUSE', 0, 0, 0, '', '', 'Seven Hills', '2147', '-33.79454216', '150.92560242', 3, 1, 1, '', '', '', '16 Zermatt Avenue Seven Hills NSW 2147', '16 Zermatt Avenue Seven Hills NSW 2147', 0, '', '', 'https://static.rpdata.com/rpdaAU/photo/listsale/768x512/15/11/24/26357525/26357525_1.JPG', '', '', '', '', '', 2, 28950000, 0, 0, 0, 0, 3, '1', 0, '', 0, '2016-05-05 15:53:54', '2016-05-09 12:52:08'),
(22, '15798683', 'http://www.domain.com.au/15-clive-street-revesby-nsw-2212-2012695095', 'http://www.domain.com.au/15-clive-street-revesby-nsw-2212-2012695095', 'https://www.mcgrath.com.au/buy/house/nsw/canterbury-bankstown/revesby/304405', 4, 'HOUSE', 0, 0, 0, '', '', 'Seven Hills', '2147', '-33.79481484', '150.92613661', 4, 3, 2, '', '', '', '120A Ellam Drive Seven Hills NSW 2147', '120A Ellam Drive Seven Hills NSW 2147', 0, '', '', 'https://static.rpdata.com/rpdaAU/photo/listsale/768x512/13/10/01/23020628/23020628_1.JPG', '', '', '', '', '', 2, 942500, 0, 0, 0, 0, 5, '1', 0, '', 0, '2016-05-07 01:06:48', '2016-05-07 21:11:37'),
(23, '6173747', 'http://www.domain.com.au/15-clive-street-revesby-nsw-2212-2012695095', 'http://www.domain.com.au/15-clive-street-revesby-nsw-2212-2012695095', 'https://www.mcgrath.com.au/buy/house/nsw/canterbury-bankstown/revesby/304405', 4, 'UNIT', 0, 0, 0, '', '', 'Seven Hills', '2147', '-33.79480795', '150.92552009', 0, 0, 1, '', '', '', '43/12 Zermatt Avenue Seven Hills NSW 2147', '43/12 Zermatt Avenue Seven Hills NSW 2147', 0, '', '', 'https://static.rpdata.com/rpdaAU/photo/listsale/768x512/13/10/22/23123840/23123840_1.JPG', '', '', '', '', '', 2, 1750000, 0, 0, 0, 0, 3, '1', 0, '', 0, '2016-05-07 06:47:23', '2016-05-09 07:30:16'),
(24, '16561736', 'http://www.domain.com.au/15-clive-street-revesby-nsw-2212-2012695095', 'http://www.domain.com.au/15-clive-street-revesby-nsw-2212-2012695095', 'https://www.mcgrath.com.au/buy/house/nsw/canterbury-bankstown/revesby/304405', 4, 'HOUSE', 0, 0, 0, '', '', 'Seven Hills', '2147', '-33.79483699', '150.92609899', 3, 2, 1, '', '', '', '1/120A Ellam Drive Seven Hills NSW 2147', '1/120A Ellam Drive Seven Hills NSW 2147', 0, '', '', 'https://static.rpdata.com/rpdaAU/photo/listsale/768x512/13/11/07/23198655/23198655_1.JPG', '', '', '', '', '', 1, 750000, 0, 0, 0, 0, 3, '1', 0, '', 0, '2016-05-09 12:46:37', '2016-05-09 12:46:37'),
(25, '6173619', 'http://www.domain.com.au/15-clive-street-revesby-nsw-2212-2012695095', 'http://www.domain.com.au/15-clive-street-revesby-nsw-2212-2012695095', 'https://www.mcgrath.com.au/buy/house/nsw/canterbury-bankstown/revesby/304405', 4, 'HOUSE', 0, 0, 0, '', '', 'Seven Hills', '2147', '-33.79136025', '150.93475751', 0, 0, 0, '', '', '', 'Zambesi Road Seven Hills NSW 2147', 'Zambesi Road Seven Hills NSW 2147', 0, '', '', 'https://static.rpdata.com/rpdaAU/photo/listsale/768x512/06/11/02/mapnsw/145/098/0048098145', '', '', '', '', '', 1, 2000000, 0, 0, 0, 0, 3, '1', 0, '', 0, '2016-05-09 13:50:17', '2016-05-09 13:50:17'),
(26, '6173734', 'http://www.domain.com.au/15-clive-street-revesby-nsw-2212-2012695095', 'http://www.domain.com.au/15-clive-street-revesby-nsw-2212-2012695095', 'https://www.mcgrath.com.au/buy/house/nsw/canterbury-bankstown/revesby/304405', 4, 'HOUSE', 0, 0, 0, '', '', '', '', '-33.79534582', '150.92492063', 0, 0, 0, '', '', '', '6 Zermatt Avenue Seven Hills NSW 2147', '6 Zermatt Avenue Seven Hills NSW 2147', 0, '', '', 'https://static.rpdata.com/rpdaAU/photo/listsale/768x512/05/02/21/NSW01126B/309.JPG', '', '', '', '', '', 1, 555555, 0, 0, 0, 0, 2, '3', 0, '', 0, '2016-05-10 13:09:00', '2016-05-10 13:09:00'),
(27, '15906295', 'http://www.domain.com.au/15-clive-street-revesby-nsw-2212-2012695095', 'http://www.domain.com.au/15-clive-street-revesby-nsw-2212-2012695095', 'https://www.mcgrath.com.au/buy/house/nsw/canterbury-bankstown/revesby/304405', 4, 'HOUSE', 0, 0, 0, '', '', '', '', '-33.79152372', '150.93496499', 4, 2, 2, '', '', '', '53 Lucretia Road Seven Hills NSW 2147', '53 Lucretia Road Seven Hills NSW 2147', 0, '', '', 'https://static.rpdata.com/rpdaAU/photo/listsale/768x512/15/08/26/25951525/25951525_1.JPG', '', '', '', '', '', 1, 666666, 0, 0, 0, 0, 2, '3', 0, '', 0, '2016-05-10 13:11:10', '2016-05-10 13:11:10'),
(28, '6173736', 'http://www.domain.com.au/15-clive-street-revesby-nsw-2212-2012695095', 'http://www.domain.com.au/15-clive-street-revesby-nsw-2212-2012695095', 'https://www.mcgrath.com.au/buy/house/nsw/canterbury-bankstown/revesby/304405', 4, 'HOUSE', 0, 0, 0, '', '', '', '', '-33.79500464', '150.92448817', 4, 1, 2, '', '', '', '7 Zermatt Avenue Seven Hills NSW 2147', '7 Zermatt Avenue Seven Hills NSW 2147', 0, '', '', 'https://static.rpdata.com/rpdaAU/photo/listsale/768x512/05/02/21/NSW01126B/325.JPG', '', '', '', '', '', 1, 1000000, 0, 0, 0, 0, 3, '3', 0, '', 0, '2016-05-10 23:09:15', '2016-05-10 23:09:15'),
(29, '6173717', 'http://www.domain.com.au/15-clive-street-revesby-nsw-2212-2012695095', 'http://www.domain.com.au/15-clive-street-revesby-nsw-2212-2012695095', 'https://www.mcgrath.com.au/buy/house/nsw/canterbury-bankstown/revesby/304405', 4, 'HOUSE', 0, 0, 0, '', '', '', '', '-33.79147019', '150.93430547', 4, 4, 2, '', '', '', '52 Zambesi Road Seven Hills NSW 2147', '52 Zambesi Road Seven Hills NSW 2147', 0, '', '', 'https://static.rpdata.com/rpdaAU/photo/listsale/768x512/16/02/21/26699494/26699494_1.JPG', '', '', '', '', '', 1, 4000000, 0, 0, 0, 0, 3, '3', 0, '', 0, '2016-05-10 23:09:33', '2016-05-10 23:09:33');

-- --------------------------------------------------------

--
-- Table structure for table `PE_PROPERTY`
--

CREATE TABLE IF NOT EXISTS `PE_PROPERTY` (
  `PT_ID` int(20) NOT NULL AUTO_INCREMENT,
  `PT_EXTERNAL_ID` varchar(255) NOT NULL,
  `PT_VFUID1` varchar(255) NOT NULL,
  `PT_VFUID2` varchar(255) NOT NULL,
  `PT_VFUID3` varchar(255) NOT NULL,
  `PT_PROP_FROM` int(20) NOT NULL COMMENT '1 = Our Own, 2 = RealEstate, 3 = Domain, 4 = Core Logic, 5= Others ',
  `PT_TYPE` varchar(255) NOT NULL,
  `PT_CAT1` int(20) NOT NULL COMMENT '1=mywish, 2=facebook, 3= trend, 4=public',
  `PT_CAT2` int(20) NOT NULL,
  `PT_CAT3` int(20) NOT NULL,
  `PT_STREET1` varchar(255) NOT NULL,
  `PT_STREET2` varchar(255) NOT NULL,
  `PT_SUBURB` varchar(255) NOT NULL,
  `PT_POSTCODE` varchar(255) NOT NULL,
  `PT_LAT` varchar(255) NOT NULL,
  `PT_LNG` varchar(255) NOT NULL,
  `PT_NO_BED` int(11) NOT NULL,
  `PT_NO_CAR` int(11) NOT NULL,
  `PT_NO_BATH` int(11) NOT NULL,
  `PT_AUC_DATE` varchar(255) NOT NULL,
  `PT_AUC_HIGH` varchar(255) NOT NULL,
  `PT_AUC_LOW` varchar(255) NOT NULL,
  `PT_ADDRESS_LONG` text NOT NULL,
  `PT_ADDRESS_SHORT` varchar(255) NOT NULL,
  `PT_AGENT_ID` int(20) NOT NULL,
  `PT_AGENT_IMAGE` varchar(255) NOT NULL,
  `PT_AGENT_NAME` varchar(255) NOT NULL,
  `PT_IMAGE_MAIN` varchar(255) NOT NULL,
  `PT_IMAGE_FREE1` varchar(255) NOT NULL,
  `PT_IMAGE_FREE2` varchar(255) NOT NULL,
  `PT_IMAGE_FREE3` varchar(255) NOT NULL,
  `PT_IMAGE_FREE4` varchar(255) NOT NULL,
  `PT_IMAGE_FREE5` varchar(255) NOT NULL,
  `PT_TOTAL_PREDICTS` int(30) NOT NULL DEFAULT '0',
  `PT_AVERAGE_PREDICTION` int(30) NOT NULL DEFAULT '0',
  `PT_IS_TRENDING` int(10) NOT NULL DEFAULT '0',
  `PT_IS_PUBLIC` int(10) NOT NULL DEFAULT '0',
  `PT_IS_MY_WISHLIST` int(10) NOT NULL DEFAULT '0',
  `PT_IS_FACEBOOK` int(10) NOT NULL DEFAULT '0',
  `PT_ADDED_BY` int(20) NOT NULL,
  `PT_STATUS` varchar(255) NOT NULL DEFAULT '0' COMMENT '1= Normal (running), 2= sold out, 3= value',
  `PT_SOLD_PRICE` int(30) NOT NULL DEFAULT '0',
  `PT_SOLD_DATE` varchar(255) NOT NULL,
  `PT_IS_FLAGGED` int(11) NOT NULL DEFAULT '0',
  `PT_CREATED_AT` varchar(255) NOT NULL,
  `PT_UPDATED_AT` varchar(255) NOT NULL,
  PRIMARY KEY (`PT_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=30 ;

--
-- Dumping data for table `PE_PROPERTY`
--

INSERT INTO `PE_PROPERTY` (`PT_ID`, `PT_EXTERNAL_ID`, `PT_VFUID1`, `PT_VFUID2`, `PT_VFUID3`, `PT_PROP_FROM`, `PT_TYPE`, `PT_CAT1`, `PT_CAT2`, `PT_CAT3`, `PT_STREET1`, `PT_STREET2`, `PT_SUBURB`, `PT_POSTCODE`, `PT_LAT`, `PT_LNG`, `PT_NO_BED`, `PT_NO_CAR`, `PT_NO_BATH`, `PT_AUC_DATE`, `PT_AUC_HIGH`, `PT_AUC_LOW`, `PT_ADDRESS_LONG`, `PT_ADDRESS_SHORT`, `PT_AGENT_ID`, `PT_AGENT_IMAGE`, `PT_AGENT_NAME`, `PT_IMAGE_MAIN`, `PT_IMAGE_FREE1`, `PT_IMAGE_FREE2`, `PT_IMAGE_FREE3`, `PT_IMAGE_FREE4`, `PT_IMAGE_FREE5`, `PT_TOTAL_PREDICTS`, `PT_AVERAGE_PREDICTION`, `PT_IS_TRENDING`, `PT_IS_PUBLIC`, `PT_IS_MY_WISHLIST`, `PT_IS_FACEBOOK`, `PT_ADDED_BY`, `PT_STATUS`, `PT_SOLD_PRICE`, `PT_SOLD_DATE`, `PT_IS_FLAGGED`, `PT_CREATED_AT`, `PT_UPDATED_AT`) VALUES
(1, '', 'http://www.domain.com.au/15-clive-street-revesby-nsw-2212-2012695095', 'http://www.domain.com.au/15-clive-street-revesby-nsw-2212-2012695095', 'https://www.mcgrath.com.au/buy/house/nsw/canterbury-bankstown/revesby/304405', 3, 'House', 0, 0, 0, '15 Clive Street', '', 'Revesby', '2212', '-33.963988', '151.013622', 4, 2, 2, '27/04/16 5:30PM', '1150000', '1050000', '15 Clive Street, Revesby, NSW, 2212', 'Revesby, NSW', 1, 'Images/1Agent.jpeg', 'Lush Pillay', 'Images/1Main.jpeg', 'Images/1Free1.jpeg', 'Images/1Free2.jpeg', 'Images/1Free3.jpeg', 'Images/1Free4.jpeg', 'Images/1Free5.jpeg', 4, 2848339, 1, 1, 0, 0, 0, '1', 0, '', 0, '2016-05-03 13:04:43', '2016-05-11 01:48:08'),
(2, '', 'http://www.domain.com.au/43b-ferndale-road-revesby-nsw-2212-2012722296', 'http://www.domain.com.au/15-clive-street-revesby-nsw-2212-2012695095', 'https://www.mcgrath.com.au/buy/house/nsw/canterbury-bankstown/revesby/304405', 3, 'House', 0, 0, 0, '43B Ferndale Road', '', 'Revesby', '2212', '-33.962422', '151.010471', 4, 1, 3, 'TBD', '', '?', '43B Ferndale Road, Revesby, NSW, 2212', 'Revesby, NSW', 1, 'Images/1Agent.jpeg', 'Carol Annis', 'Images/2Main.jpeg', 'Images/2Free1.jpeg', 'Images/2Free2.jpeg', 'Images/2Free3.jpeg', 'Images/2Free4.jpeg', 'Images/2Free5.jpeg', 3, 333333, 1, 0, 0, 0, 0, '1', 0, '2016-05-05 13:04:43', 0, '2016-05-03 13:04:43', '2016-05-11 13:35:38'),
(3, '', 'http://www.domain.com.au/16-phillip-street-panania-nsw-2213-2012744677', 'http://www.domain.com.au/15-clive-street-revesby-nsw-2212-2012695095', 'https://www.mcgrath.com.au/buy/house/nsw/canterbury-bankstown/revesby/304405', 3, 'House', 0, 0, 0, '16 Phillip Street', '', 'Panania', '2213', '-33.963325', '150.999401', 4, 3, 1, '18/05/16 5:30PM', '920000', '890000', '16 Phillip Street, Panania, NSW, 2213', 'Panania, NSW', 1, 'Images/1Agent.jpeg', 'Sally Gayed', 'Images/1Main.jpeg', 'Images/1Free1.jpeg', 'Images/1Free2.jpeg', 'Images/1Free3.jpeg', 'Images/1Free4.jpeg', 'Images/1Free5.jpeg', 3, 260000, 1, 1, 0, 0, 0, '1', 0, '', 0, '2016-05-03 13:04:43', '2016-05-11 02:02:22'),
(4, '', 'http://www.domain.com.au/97-ramsay-road-picnic-point-nsw-2213-2012743429', 'http://www.domain.com.au/15-clive-street-revesby-nsw-2212-2012695095', 'https://www.mcgrath.com.au/buy/house/nsw/canterbury-bankstown/revesby/304405', 3, 'House', 0, 0, 0, '97 Ramsay Road', '', 'Picnic Point', '2213', '-33.969149', '151.003842', 5, 2, 3, '14/05/16 12:30PM', '965000', '935000', '97 Ramsay Road, Picnic Point, NSW, 2213', 'Picnic Point, NSW', 1, 'Images/1Agent.jpeg', 'Michael Sleiman', 'Images/4Main.jpeg', 'Images/4Free1.jpeg', 'Images/4Free2.jpeg', 'Images/4Free3.jpeg', 'Images/4Free4.jpeg', 'Images/4Free5.jpeg', 2, 750000, 1, 0, 0, 0, 0, '1', 0, '', 0, '2016-05-03 13:04:43', '2016-05-11 13:35:11'),
(13, '6173728', 'http://www.domain.com.au/15-clive-street-revesby-nsw-2212-2012695095', 'http://www.domain.com.au/15-clive-street-revesby-nsw-2212-2012695095', 'https://www.mcgrath.com.au/buy/house/nsw/canterbury-bankstown/revesby/304405', 4, 'HOUSE', 0, 0, 0, '', '', 'Seven Hills', '2147', '-33.79540296', '150.92475356', 3, 2, 1, '', '', '', '4 Zermatt Avenue Seven Hills NSW 2147', '4 Zermatt Avenue Seven Hills NSW 2147', 0, '', '', 'https://static.rpdata.com/rpdaAU/photo/listsale/768x512/05/02/21/NSW01126B/308.JPG', 'Images/4Free1.jpeg', '', '', '', '', 1, 0, 1, 0, 0, 0, 3, '1', 0, '', 0, '2016-05-05 12:59:16', '2016-05-06 22:31:29'),
(14, '6887904', 'http://www.domain.com.au/15-clive-street-revesby-nsw-2212-2012695095', 'http://www.domain.com.au/15-clive-street-revesby-nsw-2212-2012695095', 'https://www.mcgrath.com.au/buy/house/nsw/canterbury-bankstown/revesby/304405', 4, 'HOUSE', 0, 0, 0, '', '', 'Seven Hills', '2147', '-33.7967233', '150.92650444', 3, 1, 1, '', '', '', '141 Ellam Drive Seven Hills NSW 2147', '141 Ellam Drive Seven Hills NSW 2147', 0, '', '', 'https://static.rpdata.com/rpdaAU/photo/listsale/768x512/15/09/29/26093556/26093556_1.JPG', 'Images/4Free1.jpeg', '', '', '', '', 3, 433333, 1, 0, 0, 0, 3, '1', 0, '', 0, '2016-05-05 13:26:57', '2016-05-11 11:20:54'),
(15, '6173753', 'http://www.domain.com.au/15-clive-street-revesby-nsw-2212-2012695095', 'http://www.domain.com.au/15-clive-street-revesby-nsw-2212-2012695095', 'https://www.mcgrath.com.au/buy/house/nsw/canterbury-bankstown/revesby/304405', 4, 'HOUSE', 0, 0, 0, '', '', 'Seven Hills', '2147', '-33.79467564', '150.92561571', 0, 0, 0, '', '', '', '14 Zermatt Avenue Seven Hills NSW 2147', '14 Zermatt Avenue Seven Hills NSW 2147', 0, '', '', 'https://static.rpdata.com/rpdaAU/photo/listsale/768x512/05/02/21/NSW01126B/312.JPG', 'Images/4Free1.jpeg', '', '', '', '', 2, 600000, 0, 0, 0, 0, 3, '1', 0, '', 0, '2016-05-05 14:33:01', '2016-05-12 02:19:29'),
(16, '17278783', 'http://www.domain.com.au/15-clive-street-revesby-nsw-2212-2012695095', 'http://www.domain.com.au/15-clive-street-revesby-nsw-2212-2012695095', 'https://www.mcgrath.com.au/buy/house/nsw/canterbury-bankstown/revesby/304405', 4, 'HOUSE', 0, 0, 0, '', '', 'Seven Hills', '2147', '-33.79482598', '150.92633296', 1, 0, 1, '', '', '', '1/120 Ellam Drive Seven Hills NSW 2147', '1/120 Ellam Drive Seven Hills NSW 2147', 0, '', '', 'https://static.rpdata.com/rpdaAU/photo/listsale/768x512/15/08/05/25863244/25863244_1.JPG', 'Images/4Free1.jpeg', '', '', '', '', 1, 0, 0, 0, 0, 0, 3, '1', 0, '', 0, '2016-05-05 14:33:24', '2016-05-08 02:39:45'),
(17, '17460921', 'http://www.domain.com.au/15-clive-street-revesby-nsw-2212-2012695095', 'http://www.domain.com.au/15-clive-street-revesby-nsw-2212-2012695095', 'https://www.mcgrath.com.au/buy/house/nsw/canterbury-bankstown/revesby/304405', 4, 'UNIT', 0, 0, 0, '', '', 'Seven Hills', '2147', '-33.79482598', '150.92567397', 0, 0, 1, '', '', '', '12A Zermatt Avenue Seven Hills NSW 2147', '12A Zermatt Avenue Seven Hills NSW 2147', 0, '', '', 'https://static.rpdata.com/rpdaAU/photo/listsale/768x512/16/01/13/23123840/23123840_1.JPG', 'Images/4Free1.jpeg', '', '', '', '', 1, 0, 0, 0, 0, 0, 3, '1', 0, '', 0, '2016-05-05 14:42:58', '2016-05-06 22:31:41'),
(18, '6887902', 'http://www.domain.com.au/15-clive-street-revesby-nsw-2212-2012695095', 'http://www.domain.com.au/15-clive-street-revesby-nsw-2212-2012695095', 'https://www.mcgrath.com.au/buy/house/nsw/canterbury-bankstown/revesby/304405', 4, 'HOUSE', 0, 0, 0, '', '', 'Seven Hills', '2147', '-33.79660674', '150.9265285', 3, 0, 1, '', '', '', '139 Ellam Drive Seven Hills NSW 2147', '139 Ellam Drive Seven Hills NSW 2147', 0, '', '', 'https://static.rpdata.com/rpdaAU/photo/listsale/768x512/05/03/03/NSW01140F/796.JPG', 'Images/4Free1.jpeg', '', '', '', '', 1, 0, 0, 0, 0, 0, 3, '1', 0, '', 0, '2016-05-05 15:50:51', '2016-05-05 15:50:51'),
(19, '6887899', 'http://www.domain.com.au/15-clive-street-revesby-nsw-2212-2012695095', 'http://www.domain.com.au/15-clive-street-revesby-nsw-2212-2012695095', 'https://www.mcgrath.com.au/buy/house/nsw/canterbury-bankstown/revesby/304405', 4, 'UNIT', 0, 0, 0, '', '', 'Seven Hills', '2147', '-33.79642965', '150.92670168', 1, 1, 1, '', '', '', '1/137 Ellam Drive Seven Hills NSW 2147', '1/137 Ellam Drive Seven Hills NSW 2147', 0, '', '', 'https://static.rpdata.com/rpdaAU/photo/listsale/768x512/16/03/29/26856950/26856950_1.JPG', 'Images/4Free1.jpeg', '', '', '', '', 1, 0, 0, 0, 0, 0, 3, '1', 0, '', 0, '2016-05-05 15:51:02', '2016-05-05 15:51:02'),
(20, '6173731', 'http://www.domain.com.au/15-clive-street-revesby-nsw-2212-2012695095', 'http://www.domain.com.au/15-clive-street-revesby-nsw-2212-2012695095', 'https://www.mcgrath.com.au/buy/house/nsw/canterbury-bankstown/revesby/304405', 3, 'HOUSE', 0, 0, 0, '', '', 'Seven Hills', '2147', '-33.79516662', '150.92440575', 0, 0, 0, '', '', '', '5 Zermatt Avenue Seven Hills NSW 2147', '5 Zermatt Avenue Seven Hills NSW 2147', 0, '', '', 'https://static.rpdata.com/rpdaAU/photo/listsale/768x512/05/02/21/NSW01126B/326.JPG', 'Images/4Free1.jpeg', '', '', '', '', 2, 0, 0, 0, 0, 0, 3, '1', 0, '', 0, '2016-05-05 15:51:15', '2016-05-06 10:56:35'),
(21, '6173757', 'http://www.domain.com.au/15-clive-street-revesby-nsw-2212-2012695095', 'http://www.domain.com.au/15-clive-street-revesby-nsw-2212-2012695095', 'https://www.mcgrath.com.au/buy/house/nsw/canterbury-bankstown/revesby/304405', 4, 'HOUSE', 0, 0, 0, '', '', 'Seven Hills', '2147', '-33.79454216', '150.92560242', 3, 1, 1, '', '', '', '16 Zermatt Avenue Seven Hills NSW 2147', '16 Zermatt Avenue Seven Hills NSW 2147', 0, '', '', 'https://static.rpdata.com/rpdaAU/photo/listsale/768x512/15/11/24/26357525/26357525_1.JPG', 'Images/4Free1.jpeg', '', '', '', '', 3, 333333, 0, 0, 0, 0, 3, '1', 0, '', 0, '2016-05-05 15:53:54', '2016-05-10 23:49:35'),
(22, '15798683', 'http://www.domain.com.au/15-clive-street-revesby-nsw-2212-2012695095', 'http://www.domain.com.au/15-clive-street-revesby-nsw-2212-2012695095', 'https://www.mcgrath.com.au/buy/house/nsw/canterbury-bankstown/revesby/304405', 4, 'HOUSE', 0, 0, 0, '', '', 'Seven Hills', '2147', '-33.79481484', '150.92613661', 4, 3, 2, '', '', '', '120A Ellam Drive Seven Hills NSW 2147', '120A Ellam Drive Seven Hills NSW 2147', 0, '', '', 'https://static.rpdata.com/rpdaAU/photo/listsale/768x512/13/10/01/23020628/23020628_1.JPG', 'Images/4Free1.jpeg', '', '', '', '', 2, 0, 0, 0, 0, 0, 5, '1', 0, '', 0, '2016-05-07 01:06:48', '2016-05-07 21:11:37'),
(23, '6173747', 'http://www.domain.com.au/15-clive-street-revesby-nsw-2212-2012695095', 'http://www.domain.com.au/15-clive-street-revesby-nsw-2212-2012695095', 'https://www.mcgrath.com.au/buy/house/nsw/canterbury-bankstown/revesby/304405', 4, 'UNIT', 0, 0, 0, '', '', 'Seven Hills', '2147', '-33.79480795', '150.92552009', 0, 0, 1, '', '', '', '43/12 Zermatt Avenue Seven Hills NSW 2147', '43/12 Zermatt Avenue Seven Hills NSW 2147', 0, '', '', 'https://static.rpdata.com/rpdaAU/photo/listsale/768x512/13/10/22/23123840/23123840_1.JPG', 'Images/4Free1.jpeg', '', '', '', '', 3, 466667, 0, 0, 0, 0, 3, '3', 0, '', 0, '2016-05-07 06:47:23', '2016-05-11 11:19:25'),
(24, '16561736', 'http://www.domain.com.au/15-clive-street-revesby-nsw-2212-2012695095', 'http://www.domain.com.au/15-clive-street-revesby-nsw-2212-2012695095', 'https://www.mcgrath.com.au/buy/house/nsw/canterbury-bankstown/revesby/304405', 4, 'HOUSE', 0, 0, 0, '', '', 'Seven Hills', '2147', '-33.79483699', '150.92609899', 3, 2, 1, '', '', '', '1/120A Ellam Drive Seven Hills NSW 2147', '1/120A Ellam Drive Seven Hills NSW 2147', 0, '', '', 'https://static.rpdata.com/rpdaAU/photo/listsale/768x512/13/11/07/23198655/23198655_1.JPG', 'Images/4Free1.jpeg', '', '', '', '', 1, 0, 0, 0, 0, 0, 3, '3', 0, '', 0, '2016-05-09 12:46:37', '2016-05-09 12:46:37'),
(25, '6173619', 'http://www.domain.com.au/15-clive-street-revesby-nsw-2212-2012695095', 'http://www.domain.com.au/15-clive-street-revesby-nsw-2212-2012695095', 'https://www.mcgrath.com.au/buy/house/nsw/canterbury-bankstown/revesby/304405', 4, 'HOUSE', 0, 0, 0, '', '', 'Seven Hills', '2147', '-33.79136025', '150.93475751', 0, 0, 0, '', '', '', 'Zambesi Road Seven Hills NSW 2147', 'Zambesi Road Seven Hills NSW 2147', 0, '', '', 'https://static.rpdata.com/rpdaAU/photo/listsale/768x512/06/11/02/mapnsw/145/098/0048098145', 'Images/4Free1.jpeg', '', '', '', '', 1, 0, 0, 0, 0, 0, 3, '2', 800000, '', 0, '2016-05-09 13:50:17', '2016-05-09 13:50:17'),
(26, '6173734', 'http://www.domain.com.au/15-clive-street-revesby-nsw-2212-2012695095', 'http://www.domain.com.au/15-clive-street-revesby-nsw-2212-2012695095', 'https://www.mcgrath.com.au/buy/house/nsw/canterbury-bankstown/revesby/304405', 4, 'HOUSE', 0, 0, 0, '', '', 'Revesby', '2212', '-33.79534582', '150.92492063', 0, 0, 0, '', '', '', '6 Zermatt Avenue Seven Hills NSW 2147', '6 Zermatt Avenue Seven Hills NSW 2147', 0, '', '', 'https://static.rpdata.com/rpdaAU/photo/listsale/768x512/05/02/21/NSW01126B/309.JPG', 'Images/4Free1.jpeg', '', '', '', '', 1, 0, 0, 0, 0, 0, 2, '3', 0, '', 0, '2016-05-10 13:09:00', '2016-05-10 13:09:00'),
(27, '15906295', 'http://www.domain.com.au/15-clive-street-revesby-nsw-2212-2012695095', 'http://www.domain.com.au/15-clive-street-revesby-nsw-2212-2012695095', 'https://www.mcgrath.com.au/buy/house/nsw/canterbury-bankstown/revesby/304405', 4, 'HOUSE', 0, 0, 0, '', '', 'Revesby', '2212', '-33.79152372', '150.93496499', 4, 2, 2, '', '', '', '53 Lucretia Road Seven Hills NSW 2147', '53 Lucretia Road Seven Hills NSW 2147', 0, '', '', 'https://static.rpdata.com/rpdaAU/photo/listsale/768x512/15/08/26/25951525/25951525_1.JPG', 'Images/4Free1.jpeg', '', '', '', '', 1, 0, 0, 0, 0, 0, 2, '3', 0, '', 0, '2016-05-10 13:11:10', '2016-05-10 13:11:10'),
(28, '6173736', 'http://www.domain.com.au/15-clive-street-revesby-nsw-2212-2012695095', 'http://www.domain.com.au/15-clive-street-revesby-nsw-2212-2012695095', 'https://www.mcgrath.com.au/buy/house/nsw/canterbury-bankstown/revesby/304405', 4, 'HOUSE', 0, 0, 0, '', '', 'Revesby', '2212', '-33.79500464', '150.92448817', 4, 1, 2, '', '', '', '7 Zermatt Avenue Seven Hills NSW 2147', '7 Zermatt Avenue Seven Hills NSW 2147', 0, '', '', 'https://static.rpdata.com/rpdaAU/photo/listsale/768x512/05/02/21/NSW01126B/325.JPG', 'Images/4Free1.jpeg', '', '', '', '', 1, 0, 0, 0, 0, 0, 3, '2', 1200000, '', 0, '2016-05-10 23:09:15', '2016-05-10 23:09:15');

-- --------------------------------------------------------

--
-- Table structure for table `PE_PROPERTYUSER`
--

CREATE TABLE IF NOT EXISTS `PE_PROPERTYUSER` (
  `PU_PT_ID` int(20) NOT NULL AUTO_INCREMENT,
  `PT_ID` int(20) NOT NULL,
  `PU_ID` int(20) NOT NULL,
  `PT_CURRENT_PRED` varchar(255) NOT NULL,
  `PT_CURRENT_PRED_DATE` varchar(255) NOT NULL,
  `PU_PT_PRED1` varchar(255) NOT NULL,
  `PU_PT_PRED2` varchar(255) NOT NULL,
  `PU_PT_PRED3` varchar(255) NOT NULL,
  `PU_PT_PRED1_DATE` varchar(255) NOT NULL,
  `PU_PT_PRED2_DATE` varchar(255) NOT NULL,
  `PU_PT_PRED3_DATE` varchar(255) NOT NULL,
  `PU_PT_WHAT_I_PAY` varchar(255) NOT NULL,
  `PU_PT_NOTES` text NOT NULL,
  `PU_PT_WHAT_I_PAY_NOTES` text NOT NULL,
  `PU_PT_TOTAL_PREDICTIONS` varchar(255) NOT NULL,
  `PU_PT_CREATED_AT` varchar(255) NOT NULL,
  `PU_PT_UPDATED_AT` varchar(255) NOT NULL,
  PRIMARY KEY (`PU_PT_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=62 ;

--
-- Dumping data for table `PE_PROPERTYUSER`
--

INSERT INTO `PE_PROPERTYUSER` (`PU_PT_ID`, `PT_ID`, `PU_ID`, `PT_CURRENT_PRED`, `PT_CURRENT_PRED_DATE`, `PU_PT_PRED1`, `PU_PT_PRED2`, `PU_PT_PRED3`, `PU_PT_PRED1_DATE`, `PU_PT_PRED2_DATE`, `PU_PT_PRED3_DATE`, `PU_PT_WHAT_I_PAY`, `PU_PT_NOTES`, `PU_PT_WHAT_I_PAY_NOTES`, `PU_PT_TOTAL_PREDICTIONS`, `PU_PT_CREATED_AT`, `PU_PT_UPDATED_AT`) VALUES
(34, 2, 2, '845000', '2016-05-06 10:05:35', '845000', '0', '0', '2016-05-06 10:05:35', '', '', '', 'Very high priced ', '', '1', '2016-05-06 10:05:35', '2016-05-06 10:05:35'),
(35, 1, 2, '920000', '2016-05-06 10:56:28', '900000', '920000', '0', '2016-05-06 10:56:09', '2016-05-06 10:56:28', '', '', 'Very high priced ', '', '2', '2016-05-06 10:56:09', '2016-05-06 10:56:28'),
(36, 20, 2, '765000', '2016-05-06 10:56:35', '765000', '0', '0', '2016-05-06 10:56:35', '', '', '', 'Very high priced ', '', '1', '2016-05-06 10:56:35', '2016-05-06 10:56:35'),
(39, 3, 5, '910000', '2016-05-06 23:25:45', '910000', '0', '0', '2016-05-06 23:25:45', '', '', '', 'Very high priced ', '', '1', '2016-05-06 23:25:45', '2016-05-06 23:25:45'),
(40, 14, 5, '890000', '2016-05-06 23:26:10', '890000', '0', '0', '2016-05-06 23:26:10', '', '', '', 'Very high priced ', '', '1', '2016-05-06 23:26:10', '2016-05-06 23:26:10'),
(41, 21, 5, '900000', '2016-05-06 23:26:50', '900000', '0', '0', '2016-05-06 23:26:50', '', '', '', 'Very high priced ', '', '1', '2016-05-06 23:26:50', '2016-05-06 23:26:50'),
(42, 1, 5, '2750000', '2016-05-07 00:01:36', '275000', '2500000', '2750000', '2016-05-07 00:01:13', '2016-05-07 00:01:28', '2016-05-07 00:01:36', '', 'Very high priced ', '', '3', '2016-05-07 00:01:13', '2016-05-07 00:01:36'),
(43, 22, 5, '685000', '2016-05-07 01:06:48', '685000', '0', '0', '2016-05-07 01:06:48', '', '', '', 'Very high priced ', '', '1', '2016-05-07 01:06:48', '2016-05-07 01:06:48'),
(45, 22, 3, '1200000', '2016-05-07 21:11:37', '200000', '1200000', '0', '2016-05-07 21:11:19', '2016-05-07 21:11:37', '', '', 'Very high priced ', '', '2', '2016-05-07 21:11:19', '2016-05-07 21:11:37'),
(47, 23, 5, '1000000', '2016-05-09 07:30:16', '100000', '0', '0', '2016-05-09 07:30:16', '', '', '', 'Very high priced ', '', '1', '2016-05-09 07:30:16', '2016-05-09 07:30:16'),
(50, 26, 2, '865000', '2016-05-10 13:09:00', '865000', '0', '0', '2016-05-10 13:09:00', '', '', '', 'Very high priced ', '', '1', '2016-05-10 13:09:00', '2016-05-10 13:09:00'),
(51, 27, 2, '645000', '2016-05-10 13:11:10', '645000', '0', '0', '2016-05-10 13:11:10', '', '', '', 'Very high priced ', '', '1', '2016-05-10 13:11:10', '2016-05-10 13:11:10'),
(54, 21, 3, '1000000', '2016-05-10 23:49:35', '1000000', '0', '0', '2016-05-10 23:49:35', '', '', '', 'Very high priced ', '', '1', '2016-05-10 23:49:35', '2016-05-10 23:49:35'),
(55, 23, 3, '1400000', '2016-05-11 11:19:25', '5000000', '1400000', '0', '2016-05-10 23:50:42', '2016-05-11 11:19:25', '', '', '', '', '2', '2016-05-10 23:50:42', '2016-05-11 11:19:25'),
(56, 1, 3, '1500000', '2016-05-11 01:48:08', '214444', '1500000', '0', '2016-05-11 01:47:10', '2016-05-11 01:48:08', '', '', '', '', '2', '2016-05-11 01:47:10', '2016-05-11 01:48:08'),
(57, 3, 3, '780000', '2016-05-11 02:02:22', '780000', '0', '0', '2016-05-11 02:02:22', '', '', '', '', '', '1', '2016-05-11 02:02:22', '2016-05-11 02:02:22'),
(58, 14, 3, '1300000', '2016-05-11 11:20:54', '1300000', '0', '0', '2016-05-11 11:20:54', '', '', '', '', '', '1', '2016-05-11 11:20:54', '2016-05-11 11:20:54'),
(59, 4, 3, '1500000', '2016-05-11 13:35:11', '1500000', '0', '0', '2016-05-11 13:35:11', '', '', '', '', '', '1', '2016-05-11 13:35:11', '2016-05-11 13:35:11'),
(60, 2, 3, '1000000', '2016-05-11 13:35:38', '1000000', '0', '0', '2016-05-11 13:35:38', '', '', '', '', '', '1', '2016-05-11 13:35:38', '2016-05-11 13:35:38'),
(61, 15, 3, '1200000', '2016-05-12 02:19:29', '1200000', '0', '0', '2016-05-12 02:19:29', '', '', '', '', '', '1', '2016-05-12 02:19:29', '2016-05-12 02:19:29');

-- --------------------------------------------------------

--
-- Table structure for table `PE_PROPTYPE`
--

CREATE TABLE IF NOT EXISTS `PE_PROPTYPE` (
  `PT_TP_ID` int(20) NOT NULL AUTO_INCREMENT,
  `PT_TP_TYPE` varchar(255) NOT NULL,
  `PT_TP_CREATED_AT` varchar(255) NOT NULL,
  `PT_TP_UPDATED_AT` varchar(255) NOT NULL,
  PRIMARY KEY (`PT_TP_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `PE_PROPTYPE`
--

INSERT INTO `PE_PROPTYPE` (`PT_TP_ID`, `PT_TP_TYPE`, `PT_TP_CREATED_AT`, `PT_TP_UPDATED_AT`) VALUES
(1, 'House', '', ''),
(2, 'Unit', '', ''),
(3, 'Land', '', ''),
(4, 'Rural', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `PE_SUBURB`
--

CREATE TABLE IF NOT EXISTS `PE_SUBURB` (
  `PS_ID` int(20) NOT NULL AUTO_INCREMENT,
  `PS_SUBURB` varchar(255) NOT NULL,
  `PS_POSTCODE` varchar(255) NOT NULL,
  `PS_CREATED_AT` varchar(255) NOT NULL,
  `PS_UPDATED_AT` varchar(255) NOT NULL,
  PRIMARY KEY (`PS_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `PE_USER`
--

CREATE TABLE IF NOT EXISTS `PE_USER` (
  `PU_ID` int(11) NOT NULL AUTO_INCREMENT,
  `PU_SOCIAL_ID` varchar(255) NOT NULL,
  `PU_SOCIAL_TYPE` varchar(255) NOT NULL COMMENT '0 = normal, 1= facebook, 2= google, 3= linked in',
  `PU_FIRST_NAME` varchar(255) NOT NULL,
  `PU_LAST_NAME` varchar(255) NOT NULL,
  `PU_EMAIL` varchar(255) NOT NULL,
  `PU_DESIGNATION` varchar(255) NOT NULL,
  `PU_GENDER` varchar(255) NOT NULL COMMENT '1= male, 2=female',
  `PU_BIRTH` varchar(255) NOT NULL,
  `PU_IMAGE` varchar(255) NOT NULL,
  `PU_LAT` varchar(255) NOT NULL,
  `PU_LNG` varchar(255) NOT NULL,
  `PU_SUBURB` varchar(255) NOT NULL,
  `PU_POSTCODE` varchar(255) NOT NULL,
  `PU_IS_PAID` int(11) NOT NULL DEFAULT '0',
  `PU_RELN` varchar(255) NOT NULL,
  `PU_PRIVACY` int(11) NOT NULL DEFAULT '0',
  `PU_SHOW_NAME` int(11) NOT NULL DEFAULT '1',
  `PU_SHOW_AGE` int(11) NOT NULL DEFAULT '1',
  `PU_SHOW_GENDER` int(11) NOT NULL DEFAULT '1',
  `PU_SHOW_PROFESSION` int(11) NOT NULL DEFAULT '1',
  `PU_IS_FLAGGED` int(11) NOT NULL DEFAULT '0',
  `PU_CREATED_AT` varchar(255) NOT NULL,
  `PU_UPDATED_AT` varchar(255) NOT NULL,
  PRIMARY KEY (`PU_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `PE_USER`
--

INSERT INTO `PE_USER` (`PU_ID`, `PU_SOCIAL_ID`, `PU_SOCIAL_TYPE`, `PU_FIRST_NAME`, `PU_LAST_NAME`, `PU_EMAIL`, `PU_DESIGNATION`, `PU_GENDER`, `PU_BIRTH`, `PU_IMAGE`, `PU_LAT`, `PU_LNG`, `PU_SUBURB`, `PU_POSTCODE`, `PU_IS_PAID`, `PU_RELN`, `PU_PRIVACY`, `PU_SHOW_NAME`, `PU_SHOW_AGE`, `PU_SHOW_GENDER`, `PU_SHOW_PROFESSION`, `PU_IS_FLAGGED`, `PU_CREATED_AT`, `PU_UPDATED_AT`) VALUES
(2, '872179096261601', '1', 'Daxesh Avinashi', '', '', '', '', '', 'https://graph.facebook.com/872179096261601/picture?type=large', '19.017614', '72.856163', '', '', 0, '', 0, 1, 1, 1, 1, 0, '2016-04-26 15:58:48', '2016-05-12 05:10:16'),
(3, '10153444496036496', '1', 'Ambrish Narayan', '', '', '', '', '', 'https://graph.facebook.com/10153444496036496/picture?type=large', '-33.945786', '151.008545', 'Revesby', '2212', 0, '', 0, 1, 1, 1, 1, 0, '2016-04-26 21:20:31', '2016-05-12 03:23:24'),
(4, '606113109538727', '1', 'Shahid Patel', '', '', '', '', '', 'https://graph.facebook.com/606113109538727/picture?type=large', '37.332333', '-122.031219', '', '', 0, '', 0, 1, 1, 1, 1, 0, '2016-04-28 18:22:08', '2016-04-28 18:31:17'),
(5, '10209341218717591', '1', 'Nazia Buksh', '', '', '', '', '', 'https://graph.facebook.com/10209341218717591/picture?type=large', '-33.943604', '151.067703', '', '', 0, '', 0, 1, 1, 1, 1, 0, '2016-05-06 23:24:52', '2016-05-07 01:09:40'),
(6, '872179096261601', '1', 'Bot1F', 'Bot1L', '', '', '', '', 'https://graph.facebook.com/872179096261601/picture?type=large', '19.017614', '72.856163', '', '', 0, '', 0, 1, 1, 1, 1, 0, '2016-04-26 15:58:48', '2016-05-10 13:12:47'),
(7, '872179096261601', '1', 'Bot2F', 'Bot2L', '', '', '', '', 'https://graph.facebook.com/872179096261601/picture?type=large', '19.017614', '72.856163', '', '', 0, '', 0, 1, 1, 1, 1, 0, '2016-04-26 15:58:48', '2016-05-10 13:12:47'),
(8, '872179096261601', '1', 'Bot2F', 'Bot2L', '', '', '', '', 'https://graph.facebook.com/872179096261601/picture?type=large', '19.017614', '72.856163', '', '', 0, '', 0, 1, 1, 1, 1, 0, '2016-04-26 15:58:48', '2016-05-10 13:12:47'),
(9, '872179096261601', '1', 'Bot2F', 'Bot2L', '', '', '', '', 'https://graph.facebook.com/872179096261601/picture?type=large', '19.017614', '72.856163', '', '', 0, '', 0, 1, 1, 1, 1, 0, '2016-04-26 15:58:48', '2016-05-10 13:12:47'),
(10, '872179096261601', '1', 'Bot2F', 'Bot2L', '', '', '', '', 'https://graph.facebook.com/872179096261601/picture?type=large', '19.017614', '72.856163', '', '', 0, '', 0, 1, 1, 1, 1, 0, '2016-04-26 15:58:48', '2016-05-10 13:12:47'),
(11, '872179096261601', '1', 'Bot2F', 'Bot2L', '', '', '', '', 'https://graph.facebook.com/872179096261601/picture?type=large', '19.017614', '72.856163', '', '', 0, '', 0, 1, 1, 1, 1, 0, '2016-04-26 15:58:48', '2016-05-10 13:12:47'),
(12, '872179096261601', '1', 'Bot2F', 'Bot2L', '', '', '', '', 'https://graph.facebook.com/872179096261601/picture?type=large', '19.017614', '72.856163', '', '', 0, '', 0, 1, 1, 1, 1, 0, '2016-04-26 15:58:48', '2016-05-10 13:12:47');

-- --------------------------------------------------------

--
-- Table structure for table `PE_USERNOTIFICATION`
--

CREATE TABLE IF NOT EXISTS `PE_USERNOTIFICATION` (
  `PU_PN_ID` int(20) NOT NULL AUTO_INCREMENT,
  `PU_ID` int(20) NOT NULL,
  `PN_PLATFORM` varchar(255) NOT NULL COMMENT 'iOS, Android',
  `PN_DEVICE_TOKEN` varchar(255) NOT NULL,
  `PN_IS_PRODUCTION` int(11) NOT NULL COMMENT '0= DEV, 1=LIVE',
  `PN_DREATED_AT` varchar(255) NOT NULL,
  `PN_UPDATED_AT` varchar(255) NOT NULL,
  PRIMARY KEY (`PU_PN_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `PE_USER_FACEBOOK`
--

CREATE TABLE IF NOT EXISTS `PE_USER_FACEBOOK` (
  `PU_FB_ID` int(11) NOT NULL AUTO_INCREMENT,
  `PU_ID` varchar(255) NOT NULL,
  `PT_ID` varchar(255) NOT NULL,
  `PU_FB_STATUS` int(10) NOT NULL DEFAULT '1' COMMENT '1= normal',
  `PU_FB_CREATED_AT` varchar(255) NOT NULL,
  `PU_FB_UPDATED_AT` varchar(255) NOT NULL,
  PRIMARY KEY (`PU_FB_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `PE_USER_FACEBOOK`
--

INSERT INTO `PE_USER_FACEBOOK` (`PU_FB_ID`, `PU_ID`, `PT_ID`, `PU_FB_STATUS`, `PU_FB_CREATED_AT`, `PU_FB_UPDATED_AT`) VALUES
(1, '2', '14', 1, '2016-05-09 07:29:51', '2016-05-09 07:29:51'),
(2, '2', '16', 1, '2016-05-09 07:29:51', '2016-05-09 07:29:51'),
(12, '3', '5', 1, '2016-05-09 12:55:22', '2016-05-09 12:55:22'),
(13, '3', '15', 1, '2016-05-09 13:51:04', '2016-05-09 13:51:04'),
(15, '3', '25', 1, '2016-05-10 21:22:30', '2016-05-10 21:22:30'),
(17, '3', '20', 1, '2016-05-10 21:22:37', '2016-05-10 21:22:37'),
(19, '3', '1', 1, '2016-05-11 01:48:14', '2016-05-11 01:48:14');

-- --------------------------------------------------------

--
-- Table structure for table `PE_USER_WISHLIST`
--

CREATE TABLE IF NOT EXISTS `PE_USER_WISHLIST` (
  `PU_WL_ID` int(30) NOT NULL AUTO_INCREMENT,
  `PU_ID` varchar(255) NOT NULL,
  `PT_ID` varchar(255) NOT NULL,
  `PU_WL_STATUS` int(10) NOT NULL DEFAULT '1' COMMENT '1= normal',
  `PU_WL_CREATED_AT` varchar(255) NOT NULL,
  `PU_WL_UPDATED_AT` varchar(255) NOT NULL,
  PRIMARY KEY (`PU_WL_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=26 ;

--
-- Dumping data for table `PE_USER_WISHLIST`
--

INSERT INTO `PE_USER_WISHLIST` (`PU_WL_ID`, `PU_ID`, `PT_ID`, `PU_WL_STATUS`, `PU_WL_CREATED_AT`, `PU_WL_UPDATED_AT`) VALUES
(5, '2', '5', 1, '2016-05-09 11:44:28', '2016-05-09 11:44:28'),
(6, '2', '13', 1, '2016-05-09 11:45:38', '2016-05-09 11:45:38'),
(8, '2', '16', 1, '2016-05-09 11:52:49', '2016-05-09 11:52:49'),
(9, '2', '14', 1, '2016-05-09 11:52:55', '2016-05-09 11:52:55'),
(12, '3', '15', 1, '2016-05-09 13:50:47', '2016-05-09 13:50:47'),
(18, '3', '23', 1, '2016-05-10 22:28:46', '2016-05-10 22:28:46'),
(21, '3', '25', 1, '2016-05-10 22:54:01', '2016-05-10 22:54:01'),
(23, '3', '17', 1, '2016-05-11 14:51:25', '2016-05-11 14:51:25'),
(25, '3', '4', 1, '2016-05-12 03:21:30', '2016-05-12 03:21:30');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `IP_PROPERTY_TABLE`
--
ALTER TABLE `IP_PROPERTY_TABLE`
  ADD CONSTRAINT `IP_PROPERTY_TABLE_ibfk_1` FOREIGN KEY (`PT_OUID`) REFERENCES `IP_PROPERTY_TABLE` (`PT_OUID`);

--
-- Constraints for table `IP_USER_TABLE`
--
ALTER TABLE `IP_USER_TABLE`
  ADD CONSTRAINT `IP_USER_TABLE_ibfk_1` FOREIGN KEY (`UT_UID`) REFERENCES `IP_USER_TABLE` (`UT_UID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
