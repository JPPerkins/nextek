-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 20, 2018 at 06:57 PM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.2.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nextek`
--

-- --------------------------------------------------------

--
-- Table structure for table `caltech`
--

CREATE TABLE `caltech` (
  `uid` int(11) NOT NULL,
  `uname` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `caltech`
--

INSERT INTO `caltech` (`uid`, `uname`) VALUES
(10, 'CJP'),
(11, 'SP'),
(12, '123'),
(13, 'CJP');

-- --------------------------------------------------------

--
-- Table structure for table `changehistory`
--

CREATE TABLE `changehistory` (
  `change_id` int(11) NOT NULL,
  `change_date` datetime NOT NULL,
  `change_type` varchar(255) NOT NULL,
  `change_uid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `conditionlist`
--

CREATE TABLE `conditionlist` (
  `cond_quality` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `conditionlist`
--

INSERT INTO `conditionlist` (`cond_quality`) VALUES
('Acceptable'),
('Not Acceptable');

-- --------------------------------------------------------

--
-- Table structure for table `equipmentlist`
--

CREATE TABLE `equipmentlist` (
  `eid` int(11) NOT NULL,
  `serial_number` varchar(255) NOT NULL,
  `model_number` varchar(255) NOT NULL,
  `equip_type` int(11) NOT NULL,
  `equip_location` int(11) NOT NULL,
  `equip_viscon` varchar(255) NOT NULL,
  `change_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `equipmentlist`
--

INSERT INTO `equipmentlist` (`eid`, `serial_number`, `model_number`, `equip_type`, `equip_location`, `equip_viscon`, `change_id`) VALUES
(1, 'Test 2', 'Test 3', 5, 5, 'Acceptable', 0),
(2, 'Test ', 'Test 2', 5, 5, 'Acceptable', 0),
(3, 'si', 'ri', 6, 5, 'Acceptable', 0),
(4, '2912A02188', 'HP8720B', 7, 5, 'Acceptable', 0);

-- --------------------------------------------------------

--
-- Table structure for table `equipstdlist`
--

CREATE TABLE `equipstdlist` (
  `equip_id` int(11) NOT NULL,
  `std_id` int(11) NOT NULL,
  `value` double NOT NULL,
  `change_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `equipstdlist`
--

INSERT INTO `equipstdlist` (`equip_id`, `std_id`, `value`, `change_id`) VALUES
(2, 4, 500, 0),
(2, 4, 420, 0),
(1, 4, 420, 0),
(2, 5, 14, 0),
(2, 5, 12.75, 0),
(3, 4, 420, 0),
(3, 5, 12.75, 0),
(3, 5, 12.7576, 0),
(4, 7, 1, 0),
(4, 7, 2, 0),
(4, 5, 12.7576, 0);

-- --------------------------------------------------------

--
-- Table structure for table `locationlist`
--

CREATE TABLE `locationlist` (
  `location_id` int(11) NOT NULL,
  `location_name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `locationlist`
--

INSERT INTO `locationlist` (`location_id`, `location_name`) VALUES
(5, 'NexTek'),
(6, 'China');

-- --------------------------------------------------------

--
-- Table structure for table `partdata`
--

CREATE TABLE `partdata` (
  `date_time` datetime NOT NULL,
  `caltech` varchar(255) NOT NULL,
  `parttype` varchar(255) NOT NULL,
  `eid` varchar(255) NOT NULL,
  `visasfound` varchar(255) NOT NULL,
  `asfound` varchar(255) NOT NULL,
  `asleft` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `partdata`
--

INSERT INTO `partdata` (`date_time`, `caltech`, `parttype`, `eid`, `visasfound`, `asfound`, `asleft`) VALUES
('2018-05-23 15:46:21', '', 'Caliper (Dial)', '1233221', '', '', ''),
('2018-05-23 15:32:45', '', 'Caliper (Dial)', '16919/02-A4534', '', '', ''),
('2018-05-23 18:26:33', 'GK', 'Scale', '412312', '', '', ''),
('2018-05-23 15:55:38', 'CJP', 'Caliper (Dial)', 'sirifood', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `partstandards`
--

CREATE TABLE `partstandards` (
  `eid` varchar(255) NOT NULL,
  `standard` varchar(255) NOT NULL,
  `requirement` varchar(255) NOT NULL,
  `asfound` double NOT NULL,
  `asleft` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `partstandards`
--

INSERT INTO `partstandards` (`eid`, `standard`, `requirement`, `asfound`, `asleft`) VALUES
('1233221', 'RF-11', '223', 2113, '541'),
('16919/02-A4534', 'RF-1', '123', 123, '123'),
('sirifood', 'RF-1B', '123', 123, '123'),
('sirifood', 'R630', '123', 123, '123'),
('sirifood', 'R630', '', 0, ''),
('412312', 'RF-1', '.991', 0, ''),
('412312', 'T3', '1321', 0, ''),
('412312', 'R630', '', 0, ''),
('412312', 'RF-3', '', 0, ''),
('412312', 'RF-3A', '', 0, ''),
('412312', 'R630', '', 0, ''),
('412312', 'R630', '', 0, ''),
('412312', 'R630', '', 0, ''),
('412312', 'R630', '', 0, ''),
('412312', 'R630', '', 0, ''),
('412312', 'R630', '', 0, ''),
('412312', 'R630', '', 0, ''),
('412312', 'R630', '', 0, ''),
('MY52220036', 'RF-1', '', 0, ''),
('MY52220036', 'RF-2', '', 223, '');

-- --------------------------------------------------------

--
-- Table structure for table `parttype`
--

CREATE TABLE `parttype` (
  `Name` varchar(255) NOT NULL,
  `typetol` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `parttype`
--

INSERT INTO `parttype` (`Name`, `typetol`) VALUES
('Caliper (Dial)', 0),
('Caliper (Digital)', 0),
('Capacitance Meter\r\n', 0),
('Current Clamp', 0),
('Digital Multimeter', 0),
('Digital Thermometer', 0),
('Drop Indicator', 0),
('DVM', 0),
('Gas Tube Tester', 0),
('High C/V Power Sup', 0),
('High Voltage Power Supply', 0),
('LC Meter', 0),
('LCR  Meter', 0),
('Micrometer – 1”', 0),
('Network Analyzer', 0),
('Oscilloscope', 0),
('Reflection Test Set', 0),
('RF Power Meter', 0),
('RF Power Sensor', 0),
('RLC Meter', 0.05),
('Scale', 0),
('Signal Generator', 0),
('Spectrum Analyzer', 0),
('Surge Generator', 0),
('Torque Wrench', 0),
('Waveform Module', 0);

-- --------------------------------------------------------

--
-- Table structure for table `standardlist`
--

CREATE TABLE `standardlist` (
  `std_id` int(11) NOT NULL,
  `std_name` varchar(255) NOT NULL,
  `std_type` int(11) NOT NULL,
  `std_value` double NOT NULL,
  `std_unit` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `standardlist`
--

INSERT INTO `standardlist` (`std_id`, `std_name`, `std_type`, `std_value`, `std_unit`) VALUES
(4, 'Test2', 8, 420, 4),
(5, 'Test', 10, 12.15, 5),
(6, 'RF 3B', 8, 4.23, 4),
(7, 'RF 1', 8, 0.991, 8),
(8, 'Plug Gage 1', 8, 0.625, 9);

-- --------------------------------------------------------

--
-- Table structure for table `standards`
--

CREATE TABLE `standards` (
  `stdid` varchar(255) NOT NULL,
  `stdtype` varchar(255) NOT NULL,
  `stdvalue` double NOT NULL,
  `stdunit` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `standards`
--

INSERT INTO `standards` (`stdid`, `stdtype`, `stdvalue`, `stdunit`) VALUES
('1231', 'Electrical', 123.2, 'MHz'),
('22113', 'Electrical', 231, '?'),
('R630', 'Electrical', 0, ''),
('RF-1', 'RF', 0, 'MHz'),
('RF-10', 'RF', 0, ''),
('RF-11', 'RF', 0, ''),
('RF-12', 'RF', 0, ''),
('RF-1A', 'RF', 0, ''),
('RF-1B', 'RF', 0, ''),
('RF-2', 'RF', 2220, 'GHz'),
('RF-3', 'RF', 0, ''),
('RF-3A', 'RF', 0, ''),
('RF-3B', 'RF', 0, ''),
('RF-5', 'RF', 0, ''),
('RF-6', 'RF', 0, ''),
('RF-7', 'RF', 0, ''),
('RF-8', 'RF', 0, ''),
('RF-9', 'RF', 0, ''),
('T1', 'Transient', 0, ''),
('T2', 'Transient', 0, ''),
('T3', 'Transient', 0, ''),
('T4', 'Transient', 0, ''),
('T5', 'Transient', 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `standardtypelist`
--

CREATE TABLE `standardtypelist` (
  `std_tid` int(11) NOT NULL,
  `std_type` varchar(255) NOT NULL,
  `std_desc` varchar(255) NOT NULL,
  `std_cal_cycle` int(11) NOT NULL,
  `std_loc` int(11) NOT NULL,
  `std_last_cal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `standardtypelist`
--

INSERT INTO `standardtypelist` (`std_tid`, `std_type`, `std_desc`, `std_cal_cycle`, `std_loc`, `std_last_cal`) VALUES
(8, 'RF & Transient', '8 frequency 5 transient', 10, 5, '2015-06-01'),
(9, 'Mechanical', '2 length, 3 weight', 10, 5, '2014-03-01'),
(10, 'Mechanical Pressure', 'Abs. Pressure Gauge', 10, 5, '2010-02-01'),
(11, 'Electrical', '2 length, 3 weight', 10, 5, '2014-06-01'),
(12, 'Mechanical', '2 length, 3 weight', 10, 5, '2010-06-01');

-- --------------------------------------------------------

--
-- Table structure for table `stdtype`
--

CREATE TABLE `stdtype` (
  `type` varchar(255) NOT NULL,
  `tolerance` double NOT NULL DEFAULT '0.015'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stdtype`
--

INSERT INTO `stdtype` (`type`, `tolerance`) VALUES
('Electrical', 0.015),
('RF', 0.05);

-- --------------------------------------------------------

--
-- Table structure for table `stdunit`
--

CREATE TABLE `stdunit` (
  `unit` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stdunit`
--

INSERT INTO `stdunit` (`unit`) VALUES
('?'),
('?C'),
('A'),
('GHz'),
('Hz'),
('k?'),
('MHz'),
('mV'),
('THz'),
('V');

-- --------------------------------------------------------

--
-- Table structure for table `typelist`
--

CREATE TABLE `typelist` (
  `type_id` int(11) NOT NULL,
  `type_name` text NOT NULL,
  `type_tolerance` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `typelist`
--

INSERT INTO `typelist` (`type_id`, `type_name`, `type_tolerance`) VALUES
(5, 'Network Analyzer', 0.05),
(6, 'Dial', 0.05123),
(7, 'capiler', 0.1),
(8, 'Surge Generator', 0.05);

-- --------------------------------------------------------

--
-- Table structure for table `unitlist`
--

CREATE TABLE `unitlist` (
  `unit_id` int(11) NOT NULL,
  `unit_name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `unitlist`
--

INSERT INTO `unitlist` (`unit_id`, `unit_name`) VALUES
(4, 'MHz'),
(5, 'Â°C'),
(7, 'Deg Cel'),
(8, 'GHz'),
(9, '\"');

-- --------------------------------------------------------

--
-- Table structure for table `userlist`
--

CREATE TABLE `userlist` (
  `user_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `userlist`
--

INSERT INTO `userlist` (`user_id`, `username`) VALUES
(6, 'SP'),
(7, 'GK');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `caltech`
--
ALTER TABLE `caltech`
  ADD PRIMARY KEY (`uid`);

--
-- Indexes for table `changehistory`
--
ALTER TABLE `changehistory`
  ADD PRIMARY KEY (`change_id`);

--
-- Indexes for table `conditionlist`
--
ALTER TABLE `conditionlist`
  ADD PRIMARY KEY (`cond_quality`);

--
-- Indexes for table `equipmentlist`
--
ALTER TABLE `equipmentlist`
  ADD PRIMARY KEY (`eid`);

--
-- Indexes for table `locationlist`
--
ALTER TABLE `locationlist`
  ADD PRIMARY KEY (`location_id`);

--
-- Indexes for table `partdata`
--
ALTER TABLE `partdata`
  ADD PRIMARY KEY (`eid`) USING BTREE;

--
-- Indexes for table `parttype`
--
ALTER TABLE `parttype`
  ADD PRIMARY KEY (`Name`);

--
-- Indexes for table `standardlist`
--
ALTER TABLE `standardlist`
  ADD PRIMARY KEY (`std_id`);

--
-- Indexes for table `standards`
--
ALTER TABLE `standards`
  ADD PRIMARY KEY (`stdid`);

--
-- Indexes for table `standardtypelist`
--
ALTER TABLE `standardtypelist`
  ADD PRIMARY KEY (`std_tid`);

--
-- Indexes for table `stdtype`
--
ALTER TABLE `stdtype`
  ADD PRIMARY KEY (`type`);

--
-- Indexes for table `stdunit`
--
ALTER TABLE `stdunit`
  ADD PRIMARY KEY (`unit`);

--
-- Indexes for table `typelist`
--
ALTER TABLE `typelist`
  ADD PRIMARY KEY (`type_id`);

--
-- Indexes for table `unitlist`
--
ALTER TABLE `unitlist`
  ADD PRIMARY KEY (`unit_id`);

--
-- Indexes for table `userlist`
--
ALTER TABLE `userlist`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `caltech`
--
ALTER TABLE `caltech`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `changehistory`
--
ALTER TABLE `changehistory`
  MODIFY `change_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `equipmentlist`
--
ALTER TABLE `equipmentlist`
  MODIFY `eid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `locationlist`
--
ALTER TABLE `locationlist`
  MODIFY `location_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `standardlist`
--
ALTER TABLE `standardlist`
  MODIFY `std_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `standardtypelist`
--
ALTER TABLE `standardtypelist`
  MODIFY `std_tid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `typelist`
--
ALTER TABLE `typelist`
  MODIFY `type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `unitlist`
--
ALTER TABLE `unitlist`
  MODIFY `unit_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `userlist`
--
ALTER TABLE `userlist`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
