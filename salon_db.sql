-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 13, 2022 at 09:47 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `salon_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `service_id` int(11) DEFAULT NULL,
  `staff_id` int(11) DEFAULT 0,
  `date` date DEFAULT NULL,
  `time_slot` varchar(25) DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `booked_on` date DEFAULT NULL,
  `amount` double DEFAULT NULL,
  `payment_status` int(11) DEFAULT 0,
  `status` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`id`, `customer_id`, `service_id`, `staff_id`, `date`, `time_slot`, `notes`, `booked_on`, `amount`, `payment_status`, `status`) VALUES
(3, 1, 2, 0, '2022-07-05', '12 PM - 1 PM', 'g', '2022-07-16', NULL, 0, 2),
(4, 1, 2, 0, '2022-07-13', '11 AM - 12 PM', 'dafsdaf', '2022-07-16', NULL, 0, 4),
(5, 1, 2, 0, '2022-07-16', '11 AM - 12 PM', '', '2022-07-16', NULL, 0, 4),
(6, 1, 2, 0, '2022-10-04', '10 AM - 11 AM', 'Test', '2022-10-13', NULL, 0, 1),
(7, 1, 2, 0, '2022-10-12', '10 AM - 11 AM', 'Test', '2022-10-13', NULL, 0, 1),
(8, 1, 2, 0, '2022-10-12', '10 AM - 11 AM', 'Test', '2022-10-13', NULL, 0, 1),
(9, 1, 2, 0, '2022-10-12', '10 AM - 11 AM', 'Test', '2022-10-13', NULL, 0, 1),
(10, 1, 2, 0, '2022-10-12', '10 AM - 11 AM', 'Test', '2022-10-13', 150, 0, 1),
(11, 1, 2, 0, '2022-10-12', '10 AM - 11 AM', 'Test', '2022-10-13', 150, 0, 1),
(12, 1, 2, 0, '2022-10-13', '11 AM - 12 PM', 'sdsad', '2022-10-13', 150, 0, 1),
(13, 1, 2, 0, '2022-10-05', '10 AM - 11 AM', 'fafasffasf', '2022-10-13', 150, 0, 1),
(14, 1, 2, 0, '2022-10-14', '10 AM - 11 AM', 'fdgfd', '2022-10-13', 150, 0, 1),
(15, 1, 2, 0, '2022-10-11', '9 AM - 10 AM', '', '2022-10-13', 150, 0, 1),
(16, 2, 2, 0, '2022-09-28', '10 AM - 11 AM', 'sadsa', '2022-10-13', 150, 0, 1),
(17, 2, 2, 0, '2022-10-11', '9 AM - 10 AM', 'sdfsdf', '2022-10-13', 150, 0, 1),
(18, 2, 2, 0, '2022-10-11', '9 AM - 10 AM', 'sdfsdf', '2022-10-13', 150, 0, 1),
(19, 2, 2, 0, '2022-10-11', '9 AM - 10 AM', 'sdfsdf', '2022-10-13', 150, 0, 1),
(20, 2, 2, 1, '2022-10-09', '11 AM - 12 PM', 'fghf', '2022-10-13', 150, 0, 1),
(21, 2, 2, 1, '2022-09-27', '10 AM - 11 AM', 'xzvzxdfsd', '2022-10-13', 150, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` text DEFAULT NULL,
  `phone` varchar(55) DEFAULT NULL,
  `email` varchar(125) DEFAULT NULL,
  `gender` varchar(55) DEFAULT NULL,
  `proof` varchar(255) DEFAULT NULL,
  `reg_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `user_id`, `name`, `address`, `phone`, `email`, `gender`, `proof`, `reg_date`) VALUES
(1, 10, 'Santhosh MS', 'madathumpady H', '9745399690', 'santhoshms01@salon.com', 'Male', NULL, '2022-10-13'),
(2, 11, 'rwrertwet', 'wetwet', '9745399690', 'shan@salon.com', 'Male', '', '2022-10-13'),
(3, 12, 'Santhosh MS', 'sgdsdgsdg', '9745399690', 'san@salon.com', 'Male', 'uploads/proofs/206.jpg', '2022-10-13');

-- --------------------------------------------------------

--
-- Table structure for table `enquiries`
--

CREATE TABLE `enquiries` (
  `id` int(11) NOT NULL,
  `name` varchar(55) DEFAULT NULL,
  `mobile` varchar(25) DEFAULT NULL,
  `service_id` int(11) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `enquiries`
--

INSERT INTO `enquiries` (`id`, `name`, `mobile`, `service_id`, `message`, `status`, `date`) VALUES
(1, 'dfh', 'dfhfdh', 2, 'dfhfdh', 1, '2022-07-16');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` int(11) NOT NULL,
  `name` varchar(125) NOT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `amount` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `name`, `description`, `image`, `amount`) VALUES
(2, 'Hair styles, Haircuts for men', 'Short Hair Cuts, Short Hair Styles, Look 2015, Barbers Cut, Boy Hairstyles ... hair style, hairstyle, haircut, hair color, slick back, men&#039;s hair trends', 'uploads/services/haircut-1.jpg', 150),
(3, 'Facial Treatment', 'What does facial do?\r\nThis being said, a facial is a set of skin care treatments for your face with the goal of exfoliating your skin, removing impurities, and dead skin.', '', 2000);

-- --------------------------------------------------------

--
-- Table structure for table `staffs`
--

CREATE TABLE `staffs` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `staffs`
--

INSERT INTO `staffs` (`id`, `user_id`, `name`, `photo`, `description`, `email`, `password`) VALUES
(1, 9, 'Shan MK', 'uploads/staffs/209.jpg', 'Stylist', 'shan@salon.com', '1234');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `role` int(11) NOT NULL,
  `name` varchar(125) NOT NULL,
  `email` varchar(55) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role`, `name`, `email`, `password`, `status`) VALUES
(1, 1, 'Admin', 'admin@salon.com', '1234', 1),
(8, 2, 'dfg', 'abcd@gmail.com', '1234', 1),
(9, 3, 'Shan MK', 'shan@salon.com', '123', 1),
(10, 2, 'Santhosh MS', 'santhoshms01@salon.com', '1234', 1),
(11, 2, 'rwrertwet', 'shan@salon.com', '1234', 1),
(12, 2, 'Santhosh MS', 'san@salon.com', '1234', 1);

-- --------------------------------------------------------

--
-- Table structure for table `web_contents`
--

CREATE TABLE `web_contents` (
  `id` int(11) NOT NULL,
  `ref_key` varchar(125) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `breaf` text DEFAULT NULL,
  `details` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `web_contents`
--

INSERT INTO `web_contents` (`id`, `ref_key`, `title`, `image`, `breaf`, `details`) VALUES
(1, 'ABOUT', 'About Us', 'uploads/web_contents/saloon-images.jpg', 'Salonist is the leading salon appointment scheduling &amp; booking software that offers a diverse range of functions for businesses of all sizes. This salon software is fitted with everything you need to boost revenue, save time, enhance brand visibility, and make smart decisions in the beauty industry. Explore the features of this most loved tool and get ready to make your business better.', 'Salonist is the leading salon appointment scheduling &amp; booking software that offers a diverse range of functions for businesses of all sizes. This salon software is fitted with everything you need to boost revenue, save time, enhance brand visibility, and make smart decisions in the beauty industry. Explore the features of this most loved tool and get ready to make your business better.Using the smart Salonist Online booking software, your customers can schedule, reschedule, or cancel appointments anywhere they are. We have both website and app capabilities that can be integrated with Facebook and Instagram social media handles. With this, the overall booking process is completely automated. No double bookings. Goodbye to no-shows with the Salonist.');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `enquiries`
--
ALTER TABLE `enquiries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `staffs`
--
ALTER TABLE `staffs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `web_contents`
--
ALTER TABLE `web_contents`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `enquiries`
--
ALTER TABLE `enquiries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `staffs`
--
ALTER TABLE `staffs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `web_contents`
--
ALTER TABLE `web_contents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
