-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 17, 2021 at 02:29 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `stamina`
--

-- --------------------------------------------------------

--
-- Table structure for table `class_service`
--

CREATE TABLE `class_service` (
  `id` int(11) NOT NULL,
  `title` varchar(24) NOT NULL,
  `type` enum('regular','yoga','pilates','cardio','bodybuilding') NOT NULL,
  `duration_month` int(11) NOT NULL,
  `duration_year` int(11) DEFAULT NULL,
  `schedule_class` varchar(54) DEFAULT NULL,
  `trainer_id` int(11) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `price` float DEFAULT NULL,
  `max_cap` int(11) NOT NULL,
  `num_ordered` int(11) NOT NULL,
  `date_created` date NOT NULL,
  `status` enum('active','deleted','expired') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `class_service`
--

INSERT INTO `class_service` (`id`, `title`, `type`, `duration_month`, `duration_year`, `schedule_class`, `trainer_id`, `description`, `price`, `max_cap`, `num_ordered`, `date_created`, `status`) VALUES
(5, 'Gym Membership Fee', 'regular', 3, 0, 'MWF - 10:30 am - 1:00 pm', 6, 'Lorem ipsum dolor sit amet, eam ea partiendo maiestatis. Duo illum albucius te. Mei illud audiam apeirian id, cu quodsi graecis pertinax mea. Eu abhorreant omittantur eam, graecis definiebas cu mea. Habeo tibique an sed, nec modo ponderum intellegat no.\r\n', 1200.99, 0, 1, '2021-05-10', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `id` int(11) NOT NULL,
  `fname` varchar(24) NOT NULL,
  `lname` varchar(24) NOT NULL,
  `birthdate` date NOT NULL,
  `contact_num` varchar(16) NOT NULL,
  `email` varchar(24) NOT NULL,
  `gender` enum('male','female') NOT NULL,
  `password` varchar(32) NOT NULL,
  `status` enum('active','blocked','deleted') NOT NULL,
  `type` enum('regular','admin','superadmin') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`id`, `fname`, `lname`, `birthdate`, `contact_num`, `email`, `gender`, `password`, `status`, `type`) VALUES
(11, 'admin', 'admin', '1997-01-01', '777-7777', 'admin', 'female', 'admin', 'active', 'superadmin'),
(21, 'Kean', 'Aton', '1998-10-10', '123-1223', 'keankang010@gmail.com', 'female', 'password', 'active', 'regular'),
(22, 'John', 'Doe', '1998-10-10', '123-1223', 'johndoe@gmail.com', 'male', 'qwerty', 'active', 'regular'),
(23, 'John Vincent', 'Tujan', '1998-05-12', '09457891456', 'jvtujan@gmail.com', 'male', 'pass', 'active', 'regular');

-- --------------------------------------------------------

--
-- Table structure for table `order_class`
--

CREATE TABLE `order_class` (
  `id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `total_price` float DEFAULT NULL,
  `isPaid` enum('paid','not') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `trainer`
--

CREATE TABLE `trainer` (
  `id` int(11) NOT NULL,
  `fname` varchar(24) DEFAULT NULL,
  `lname` varchar(24) DEFAULT NULL,
  `contact_num` varchar(16) DEFAULT NULL,
  `email` varchar(54) DEFAULT NULL,
  `trainer_type` enum('regular','cardio','yoga','pilates','bodybuilding') DEFAULT NULL,
  `gender` enum('male','female') DEFAULT NULL,
  `date_employed` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `trainer`
--

INSERT INTO `trainer` (`id`, `fname`, `lname`, `contact_num`, `email`, `trainer_type`, `gender`, `date_employed`) VALUES
(6, 'Maria Cristina', 'Rondina', '123-1223', 'mariarondina@gmail.com', 'regular', 'female', '2018-07-11'),
(7, 'Clive', 'Oil', '123-1234', 'cliveoil@gmail.com', 'pilates', 'male', '2018-07-11'),
(8, 'John', 'Foo', '123-1223', 'johndoo@gmail.com', 'cardio', 'female', '2018-07-11'),
(9, 'Cathy', 'Jane', '123-1223', 'cathyjane@gmail.com', 'bodybuilding', 'female', '2018-07-11'),
(11, 'Rain', 'Vee', '321-4321', 'rainvee@gmail.com', 'regular', 'female', '2018-07-11');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `class_service`
--
ALTER TABLE `class_service`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_trainer_id` (`trainer_id`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_class`
--
ALTER TABLE `order_class`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_class_id` (`class_id`),
  ADD KEY `fk_member_id` (`member_id`);

--
-- Indexes for table `trainer`
--
ALTER TABLE `trainer`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `class_service`
--
ALTER TABLE `class_service`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `order_class`
--
ALTER TABLE `order_class`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `trainer`
--
ALTER TABLE `trainer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `class_service`
--
ALTER TABLE `class_service`
  ADD CONSTRAINT `fk_trainer_id` FOREIGN KEY (`trainer_id`) REFERENCES `trainer` (`id`);

--
-- Constraints for table `order_class`
--
ALTER TABLE `order_class`
  ADD CONSTRAINT `fk_class_id` FOREIGN KEY (`class_id`) REFERENCES `class_service` (`id`),
  ADD CONSTRAINT `fk_member_id` FOREIGN KEY (`member_id`) REFERENCES `member` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
