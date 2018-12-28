-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 28, 2018 at 11:31 AM
-- Server version: 5.7.16
-- PHP Version: 7.1.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

create database phonebook;
use phonebook;

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `phonebook`
--

-- --------------------------------------------------------

--
-- Table structure for table `contactGroups`
--

CREATE TABLE `contactGroups` (
  `id` int(11) NOT NULL,
  `id_contact` int(11) NOT NULL,
  `id_group` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `contactGroups`
--

INSERT INTO `contactGroups` (`id`, `id_contact`, `id_group`) VALUES
(1, 1, 1),
(2, 1, 2),
(10, 23, 1),
(11, 24, 2),
(12, 24, 3),
(13, 25, 4),
(14, 26, 1),
(15, 26, 2),
(16, 26, 4),
(17, 27, 1),
(18, 27, 2),
(19, 27, 3),
(20, 27, 4),
(21, 29, 2),
(22, 29, 4),
(23, 30, 5),
(24, 31, 4),
(25, 31, 5),
(26, 32, 2),
(27, 32, 4);

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `surname` varchar(50) DEFAULT NULL,
  `phone` varchar(20) NOT NULL,
  `email` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `name`, `surname`, `phone`, `email`) VALUES
(1, 'Peter', 'Gady', '+420654321000', 'halmo@inqool.cz'),
(2, 'Zuzka', 'Kišová', '+420654321010', 'kisova@inqool.cz'),
(23, 'Martin', 'Skopal', '+420654321001', 'skopal@inqool.cz'),
(24, 'Martin', 'Bokša', '+420654321001', 'boksa@inqool.cz'),
(25, 'Patrik', 'Majerčík', '+420123000456', 'majercik@inqool.cz'),
(26, 'Tomáš', 'Kučera', '+420777507912', ''),
(27, 'Vojtěch', 'Horák', '+420345298736', 'horak@gmail.cz'),
(29, 'Jozef', 'Tokarčík', '+420128723000', 'tokarcik@yandex.ua'),
(30, 'Natalya', 'Lemeshchuk', '+380674844516', 'nvlem@gmail.com'),
(31, 'Yan', 'Gorshkov', '+380123875429', 'someone@special.com'),
(32, 'Alexei', 'Halochkin', '+380123875429', 'someone@someone.com');

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`) VALUES
(1, 'inQool'),
(2, 'Brno'),
(3, 'Bratislava'),
(4, 'Stredná škola'),
(5, 'Odessa');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contactGroups`
--
ALTER TABLE `contactGroups`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_contact` (`id_contact`),
  ADD KEY `id_group` (`id_group`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contactGroups`
--
ALTER TABLE `contactGroups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `contactGroups`
--
ALTER TABLE `contactGroups`
  ADD CONSTRAINT `contactgroups_ibfk_1` FOREIGN KEY (`id_contact`) REFERENCES `contacts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `contactgroups_ibfk_2` FOREIGN KEY (`id_group`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
