-- phpMyAdmin SQL Dump
-- version 4.2.10
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Mar 30, 2016 at 09:46 AM
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
  `upc` bigint(20) unsigned NOT NULL,
  `quantity` bigint(20) unsigned NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`customerid`, `upc`, `quantity`) VALUES
(41, 1, 1),
(41, 5, 2),
(41, 21, 200),
(41, 33, 400),
(42, 1, 40),
(42, 3, 50),
(42, 5, 1),
(42, 6, 60),
(42, 24, 500),
(49, 1, 60),
(49, 5, 0),
(49, 6, 4),
(49, 8, 1),
(49, 22, 10),
(49, 24, 7),
(49, 32, 2),
(56, 7, 0);

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
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customerid`, `name`, `password`, `email`, `address`, `city`) VALUES
(41, 'cosmas mallya', '72c24e6c1eff93bdbed6dbc0b682badb', 'kurwa3c@gmail.com', 'kigamboni', 'dar es salaam'),
(42, 'cosmas mallya', '72c24e6c1eff93bdbed6dbc0b682badb', 'cosmasmallya@rocketmail.com', 'kigamboni', 'dar es salaam'),
(49, 'jonace nkwabi', '7616c624d70998c1cb22c30e88362bb3', 'jonace@nkwabi.com', 'posta', 'dar es salaam'),
(50, 'twalibu bakari', 'c1d9ba3a1877b0f92707c6cbcd9441a0', 'twalibu@bakari.com', 'magomeni', 'dar es salaam'),
(51, 'cosmas kurwa', '72c24e6c1eff93bdbed6dbc0b682badb', 'cosmas@kurwa.com', 'kigamboni', 'dar es salaam'),
(52, 'issa tende', 'e4768111db29e2c687fbcd04fad67446', 'issa@tende.com', 'kigamboni', 'dar es salaam'),
(56, 'mwl ciphy', '391ab085a51d321a3ff29d492353a3b0', 'mwl@ciphy.com', 'posta', 'dar es salaam');

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE `item` (
`upc` bigint(20) unsigned NOT NULL,
  `title` varchar(30) NOT NULL DEFAULT '',
  `price` decimal(13,2) NOT NULL DEFAULT '0.00',
  `taxable` tinyint(1) NOT NULL DEFAULT '0',
  `store_name` varchar(20) NOT NULL DEFAULT '',
  `supplier_name` varchar(40) NOT NULL DEFAULT '',
  `type` enum('music','music_sheet','music_book') NOT NULL DEFAULT 'music',
  `quantity` bigint(20) unsigned NOT NULL DEFAULT '10'
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`upc`, `title`, `price`, `taxable`, `store_name`, `supplier_name`, `type`, `quantity`) VALUES
(1, 'number one', 5000.00, 1, 'cbe', 'cosmas', 'music', 60),
(2, 'free soul', 8000.00, 1, 'makumira', 'benedict', 'music', 80),
(3, 'kiuno', 4000.00, 0, 'ud', 'cosmas', 'music', 50),
(4, 'mdogo mdogo', 10000.00, 1, 'cbe', 'isa tende', 'music', 60),
(5, 'samboira', 8000.00, 1, 'ud', 'jonace', 'music', 70),
(6, 'closer', 7000.00, 0, 'makumira', 'twalibu bakari', 'music', 80),
(7, 'nikikupata', 6000.00, 1, 'ifm', 'jonace', 'music', 90),
(8, 'mvua ya mawe', 5900.00, 0, 'mzumbe', 'isa tende', 'music', 100),
(9, 'nimevurugwa', 0.00, 1, 'mzumbe', 'jonace', 'music', 110),
(10, 'number moja', 10000.00, 1, 'mzumbe', 'cosmas', 'music', 60),
(11, 'sugua gaga', 5000.00, 1, 'mzumbe', 'benedict', 'music_book', 65),
(12, 'mapozi', 3800.00, 1, 'ud', 'twalibu bakari', 'music_book', 70),
(13, 'mama ni mama', 5000.00, 1, 'ifm', 'cosmas', 'music_book', 75),
(14, 'zali la mentali', 5800.00, 1, 'makumira', 'benedict', 'music_book', 80),
(15, 'amerudi', 4500.00, 1, 'makumira', 'jonace', 'music', 85),
(16, 'nipe uvumilivu', 1200.00, 0, 'cbe', 'isa tende', 'music_sheet', 90),
(17, 'mwanza mwanza', 6200.00, 0, 'ifm', 'jonace', 'music_sheet', 95),
(18, 'uswazi take away', 3200.00, 1, 'mzumbe', 'twalibu bakari', 'music_sheet', 100),
(19, 'dar mpaka moro', 2600.00, 1, 'cbe', 'isa tende', 'music_sheet', 105),
(20, 'kigoma', 6500.00, 1, 'ud', 'isa tende', 'music_sheet', 10),
(21, 'young girls', 9000.00, 1, 'ifm', 'isa tende', 'music', 200),
(22, 'no flex zon', 12000.00, 0, 'cbe', 'cosmas', 'music', 2500),
(23, 'pompeii', 12000.00, 1, 'ifm', 'jonace', 'music', 150),
(24, 'cheating', 12000.00, 0, 'makumira', 'twalibu bakari', 'music', 500),
(25, 'am i wrong', 12000.00, 1, 'mzumbe', 'benedict', 'music', 30),
(26, 'heal the world', 12000.00, 1, 'ud', 'cosmas', 'music', 400),
(27, 'head up', 12000.00, 0, 'ifm', 'cosmas', 'music', 50),
(28, 'best song ever', 12000.00, 1, 'cbe', 'cosmas', 'music', 70),
(29, 'i know places', 5000.00, 1, 'makumira', 'cosmas', 'music', 400),
(30, 'ngololo', 50000.00, 0, 'mzumbe', 'isa tende', 'music', 300),
(31, 'uptown funk', 2000.00, 1, 'ifm', 'twalibu bakari', 'music', 800),
(32, 'wrong', 3000.00, 0, 'ud', 'jonace', 'music', 500),
(33, 'outside', 5000.00, 1, 'cbe', 'isa tende', 'music', 400),
(34, 'new romatics', 9000.00, 0, 'ifm', 'isa tende', 'music', 1500),
(35, 'bartender', 6000.00, 1, 'ifm', 'twalibu bakari', 'music_book', 800),
(36, 'rather be', 7000.00, 0, 'ud', 'jonace', 'music_book', 100),
(37, 'one night stand', 15000.00, 1, 'cbe', 'isa tende', 'music_book', 860),
(38, 'radioactive', 9000.00, 0, 'ifm', 'isa tende', 'music_book', 1500);

-- --------------------------------------------------------

--
-- Table structure for table `music`
--

CREATE TABLE `music` (
  `upc` bigint(20) unsigned NOT NULL,
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
(1, 'number one', 'diamond platinumz', 2014, 'wasafi', 'pop', 'audio'),
(2, 'free soul', 'grace matata', 2008, 'ifm records', 'classical', 'video'),
(3, 'kiuno', 'tid', 2010, 'topband', 'pop', 'audio'),
(4, 'mdogo mdogo', 'diamond platinumz', 2014, 'wasafi', 'pop', 'audio'),
(5, 'samboira', 'ben paul', 2013, 'mj records', 'pop', 'audio'),
(6, 'closer', 'vanessa mdee', 2013, 'mj records', 'pop', 'audio'),
(7, 'nikikupata', 'ben paul', 2010, 'combination', 'pop', 'audio'),
(8, 'mvua ya mawe', 'jua kali ', 2015, 'nonini live recording studio', 'rap', 'video'),
(9, 'nimevurugwa', 'snura', 2014, 'bongo records', 'pop', 'audio'),
(10, 'number moja', 'kidum', 2010, 'kenya', 'classical', 'audio'),
(21, 'young girls', 'bruno mars', 2012, 'may bac', 'pop', 'video'),
(22, 'no flex zon', 'rae sremmurd', 2014, 'may bac', 'rap', 'audio'),
(23, 'pompeii', 'bestle', 2014, 'cash money', 'rock', 'video'),
(24, 'cheating', 'john newman', 2014, 'cash money', 'new age', 'audio'),
(25, 'am i wrong', 'nico & vianz', 2014, '', 'pop', 'video'),
(26, 'heal the world', 'michael jackson', 2002, 'may bac', 'pop', 'video'),
(27, 'head up', 'anna kendrick', 2012, 'hollywood', 'pop', 'audio'),
(28, 'best song ever', 'one direction', 2013, 'cash money', 'new age', 'video'),
(29, 'i know places', 'taylor swift', 2014, 'cash money', 'new age', 'audio'),
(30, 'ngololo', 'diamond', 2014, 'wasafi', 'pop', 'audio'),
(31, 'uptown funk', 'bruno mars', 2015, 'cash money', 'pop', 'video'),
(32, 'wrong', 'robin schulz', 2014, 'may bac', 'new age', 'video'),
(33, 'outside', 'ellie gougling', 2014, 'cash money', 'pop', 'video'),
(34, 'new romantics', 'taylor swift', 2014, 'hollywood', 'pop', 'video');

-- --------------------------------------------------------

--
-- Table structure for table `music_book`
--

CREATE TABLE `music_book` (
  `upc` bigint(20) unsigned NOT NULL,
  `author` varchar(30) NOT NULL DEFAULT '',
  `year` year(4) NOT NULL DEFAULT '0000',
  `publisher` varchar(30) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `music_book`
--

INSERT INTO `music_book` (`upc`, `author`, `year`, `publisher`) VALUES
(11, 'shaa', 2014, 'shaa'),
(12, 'mr.blue', 2005, 'mr.blue'),
(13, 'christian bella', 2014, 'christian bella'),
(14, 'profesa jay', 2005, 'christian bella'),
(15, 'bele 9', 2015, 'mr.blue'),
(35, 'lady antebellum', 2014, 'lady antebellum'),
(36, 'rather be', 2014, 'clean bandit'),
(37, 'enrique eglesias', 2005, 'enrique eglesias'),
(38, 'imagine dragons', 2014, 'imagine dragons');

-- --------------------------------------------------------

--
-- Table structure for table `music_sheet`
--

CREATE TABLE `music_sheet` (
  `upc` bigint(20) unsigned NOT NULL,
  `p_company` varchar(30) NOT NULL DEFAULT '',
  `composer` varchar(40) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `music_sheet`
--

INSERT INTO `music_sheet` (`upc`, `p_company`, `composer`) VALUES
(16, 'sony', 'rose muhando'),
(17, 'mwanza records', 'jonace'),
(18, 'tip top connection', 'chege chigunda'),
(19, 'uswahilini records', 'chege chigunda'),
(20, 'kigoma records ', 'kigoma all stars');

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
MODIFY `customerid` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=57;
--
-- AUTO_INCREMENT for table `item`
--
ALTER TABLE `item`
MODIFY `upc` bigint(20) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=39;
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
