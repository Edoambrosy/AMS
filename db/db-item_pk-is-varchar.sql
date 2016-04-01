-- phpMyAdmin SQL Dump
-- version 4.2.10
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Jan 20, 2015 at 05:09 AM
-- Server version: 5.5.38
-- PHP Version: 5.6.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `ams`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `customerid` int(10) unsigned NOT NULL,
  `upc` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
`customerid` int(10) unsigned NOT NULL,
  `name` varchar(40) NOT NULL DEFAULT '',
  `password` varchar(32) NOT NULL DEFAULT '',
  `email` varchar(40) NOT NULL DEFAULT '',
  `address` varchar(20) NOT NULL DEFAULT '',
  `city` varchar(20) NOT NULL DEFAULT ''
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customerid`, `name`, `password`, `email`, `address`, `city`) VALUES
(1, 'nguvu kazi', '123456', 'nguvukazi@ams.com', 'p.o box  2910', 'posta'),
(2, 'James Rodriguez', '1234jr', 'jr@madrid.com', '515 BERNABEU', 'Madrid'),
(41, 'cosmas mallya', '72c24e6c1eff93bdbed6dbc0b682badb', 'kurwa3c@gmail.com', 'kigamboni', 'dar es salaam'),
(42, 'cosmas mallya', '72c24e6c1eff93bdbed6dbc0b682badb', 'cosmasmallya@rocketmail.com', 'kigamboni', 'dar es salaam');

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE `item` (
  `upc` varchar(30) NOT NULL DEFAULT '',
  `title` varchar(30) NOT NULL DEFAULT '',
  `price` decimal(13,2) NOT NULL DEFAULT '0.00',
  `taxable` tinyint(1) NOT NULL DEFAULT '0',
  `store_name` varchar(20) NOT NULL DEFAULT '',
  `supplier_name` varchar(40) NOT NULL DEFAULT '',
  `type` enum('music','music_sheet','music_book') NOT NULL DEFAULT 'music'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`upc`, `title`, `price`, `taxable`, `store_name`, `supplier_name`, `type`) VALUES
('1', 'number one', 5000.00, 1, 'cbe', 'cosmas', 'music'),
('10', 'number moja', 10000.00, 1, 'mzumbe', 'cosmas', 'music'),
('11', 'sugua gaga', 5000.00, 1, 'mzumbe', 'benedict', 'music_book'),
('12', 'mapozi', 3800.00, 1, 'ud', 'twalibu bakari', 'music_book'),
('13', 'mama ni mama', 5000.00, 1, 'ifm', 'cosmas', 'music_book'),
('14', 'zali la mentali', 5800.00, 1, 'makumira', 'benedict', 'music_book'),
('15', 'amerudi', 4500.00, 1, 'makumira', 'jonace', 'music'),
('16', 'nipe uvumilivu', 1200.00, 0, 'cbe', 'isa tende', 'music_sheet'),
('17', 'mwanza mwanza', 6200.00, 0, 'ifm', 'jonace', 'music_sheet'),
('18', 'uswazi take away', 3200.00, 1, 'mzumbe', 'twalibu bakari', 'music_sheet'),
('19', 'dar mpaka moro', 2600.00, 1, 'cbe', 'isa tende', 'music_sheet'),
('2', 'free soul', 8000.00, 1, 'makumira', 'benedict', 'music'),
('20', 'kigoma', 6500.00, 1, 'ud', 'isa tende', 'music_sheet'),
('3', 'kiuno', 4000.00, 0, 'ud', 'cosmas', 'music'),
('4', 'mdogo mdogo', 10000.00, 1, 'cbe', 'isa tende', 'music'),
('5', 'samboira', 8000.00, 1, 'ud', 'jonace', 'music'),
('6', 'closer', 7000.00, 0, 'makumira', 'twalibu bakari', 'music'),
('7', 'nikikupata', 6000.00, 1, 'ifm', 'jonace', 'music'),
('8', 'mvua ya mawe', 5900.00, 0, 'mzumbe', 'isa tende', 'music'),
('9', 'nimevurugwa', 0.00, 1, 'mzumbe', 'jonace', 'music');

-- --------------------------------------------------------

--
-- Table structure for table `music`
--

CREATE TABLE `music` (
  `upc` varchar(30) NOT NULL DEFAULT '',
  `title_song` varchar(30) NOT NULL DEFAULT '',
  `leading_singer` varchar(30) NOT NULL DEFAULT '',
  `year` year(4) NOT NULL DEFAULT '0000',
  `p_company` varchar(30) NOT NULL DEFAULT '',
  `category` enum('rock','pop','country','classical','new age','rap','instrumental') NOT NULL DEFAULT 'rock',
  `type` enum('audio','video') NOT NULL DEFAULT 'audio'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `music`
--

INSERT INTO `music` (`upc`, `title_song`, `leading_singer`, `year`, `p_company`, `category`, `type`) VALUES
('1', 'number one', 'diamond platinumz', 2014, 'wasafi', 'pop', 'audio'),
('10', 'number moja', 'kidum', 2010, 'kenya', 'classical', 'audio'),
('2', 'free soul', 'grace matata', 2008, 'ifm records', 'classical', 'video'),
('3', 'kiuno', 'tid', 2010, 'topband', 'pop', 'audio'),
('4', 'mdogo mdogo', 'diamond platinumz', 2014, 'wasafi', 'pop', 'audio'),
('5', 'samboira', 'ben paul', 2013, 'mj records', 'pop', 'audio'),
('6', 'closer', 'vanessa mdee', 2013, 'mj records', 'pop', 'audio'),
('7', 'nikikupata', 'ben paul', 2010, 'combination', 'pop', 'audio'),
('8', 'mvua ya mawe', 'jua kali ', 2015, 'nonini live recording studio', 'rap', 'video'),
('9', 'nimevurugwa', 'snura', 2014, 'bongo records', 'pop', 'audio');

-- --------------------------------------------------------

--
-- Table structure for table `music_book`
--

CREATE TABLE `music_book` (
  `upc` varchar(30) NOT NULL DEFAULT '',
  `author` varchar(30) NOT NULL DEFAULT '',
  `year` year(4) NOT NULL DEFAULT '0000',
  `publisher` varchar(30) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `music_book`
--

INSERT INTO `music_book` (`upc`, `author`, `year`, `publisher`) VALUES
('11', 'shaa', 2014, 'shaa'),
('12', 'mr.blue', 2005, 'mr.blue'),
('13', 'christian bella', 2014, 'christian bella'),
('14', 'profesa jay', 2005, 'christian bella'),
('15', 'bele 9', 2015, 'mr.blue');

-- --------------------------------------------------------

--
-- Table structure for table `music_sheet`
--

CREATE TABLE `music_sheet` (
  `upc` varchar(30) NOT NULL DEFAULT '',
  `p_company` varchar(30) NOT NULL DEFAULT '',
  `composer` varchar(40) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `music_sheet`
--

INSERT INTO `music_sheet` (`upc`, `p_company`, `composer`) VALUES
('16', 'sony', 'rose muhando'),
('17', 'mwanza records', 'jonace'),
('18', 'tip top connection', 'chege chigunda'),
('19', 'uswahilini records', 'chege chigunda'),
('20', 'kigoma records ', 'kigoma all stars');

-- --------------------------------------------------------

--
-- Table structure for table `store`
--

CREATE TABLE `store` (
  `name` varchar(40) NOT NULL DEFAULT '',
  `address` varchar(40) NOT NULL DEFAULT '',
  `city` varchar(20) NOT NULL DEFAULT '',
  `phone` varchar(20) NOT NULL DEFAULT '',
  `store_type` enum('warehouse','regular') NOT NULL DEFAULT 'warehouse'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `store`
--

INSERT INTO `store` (`name`, `address`, `city`, `phone`, `store_type`) VALUES
('cbe', '764', 'dar es salaam', '0754333322', 'warehouse'),
('ifm', '2764', 'dar es salaam', '0715789034', 'warehouse'),
('makumira', '894', 'arusha', '0753233433', 'warehouse'),
('mzumbe', '8944', 'morogoro', '0754332233', 'warehouse'),
('ud', '457', 'dar es salaam', '0758764533', 'warehouse');

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `sname` varchar(40) NOT NULL DEFAULT '',
  `address` varchar(40) NOT NULL DEFAULT '',
  `city` varchar(20) NOT NULL DEFAULT '',
  `status` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`sname`, `address`, `city`, `status`) VALUES
('benedict', '560 arusha', 'arusha', 1),
('cosmas', '450kigambon', 'dar es salaam', 1),
('isa tende', '123', 'dodoma', 1),
('jonace', '350mwenge', 'dar es salaam', 1),
('twalibu bakari', '234 klm', 'kilimanjaro', 1);

-- --------------------------------------------------------

--
-- Table structure for table `warehouse`
--

CREATE TABLE `warehouse` (
  `store_name` varchar(40) NOT NULL DEFAULT '',
  `quantity` bigint(20) unsigned NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
 ADD PRIMARY KEY (`customerid`,`upc`), ADD KEY `upc` (`upc`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
 ADD PRIMARY KEY (`customerid`);

--
-- Indexes for table `item`
--
ALTER TABLE `item`
 ADD PRIMARY KEY (`upc`), ADD KEY `supplier_name` (`supplier_name`), ADD KEY `store_name` (`store_name`);

--
-- Indexes for table `music`
--
ALTER TABLE `music`
 ADD PRIMARY KEY (`upc`);

--
-- Indexes for table `music_book`
--
ALTER TABLE `music_book`
 ADD PRIMARY KEY (`upc`);

--
-- Indexes for table `music_sheet`
--
ALTER TABLE `music_sheet`
 ADD PRIMARY KEY (`upc`);

--
-- Indexes for table `store`
--
ALTER TABLE `store`
 ADD PRIMARY KEY (`name`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
 ADD PRIMARY KEY (`sname`);

--
-- Indexes for table `warehouse`
--
ALTER TABLE `warehouse`
 ADD PRIMARY KEY (`store_name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
MODIFY `customerid` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=43;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`upc`) REFERENCES `item` (`upc`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`customerid`) REFERENCES `customer` (`customerid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `item`
--
ALTER TABLE `item`
ADD CONSTRAINT `item_ibfk_1` FOREIGN KEY (`store_name`) REFERENCES `store` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `item_ibfk_2` FOREIGN KEY (`supplier_name`) REFERENCES `supplier` (`sname`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `music`
--
ALTER TABLE `music`
ADD CONSTRAINT `music_ibfk_1` FOREIGN KEY (`upc`) REFERENCES `item` (`upc`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `music_book`
--
ALTER TABLE `music_book`
ADD CONSTRAINT `music_book_ibfk_1` FOREIGN KEY (`upc`) REFERENCES `item` (`upc`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `music_sheet`
--
ALTER TABLE `music_sheet`
ADD CONSTRAINT `music_sheet_ibfk_1` FOREIGN KEY (`upc`) REFERENCES `item` (`upc`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `warehouse`
--
ALTER TABLE `warehouse`
ADD CONSTRAINT `warehouse_ibfk_1` FOREIGN KEY (`store_name`) REFERENCES `store` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;
