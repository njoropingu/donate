-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 11, 2020 at 10:23 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `donate`
--

-- --------------------------------------------------------

--
-- Table structure for table `donors`
--

CREATE TABLE `donors` (
  `id` int(100) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `amount` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `donors`
--

INSERT INTO `donors` (`id`, `first_name`, `last_name`, `phone`, `amount`, `date`, `description`) VALUES
(60, 'cere', 'vipi', '0723829300', '1', '2020-08-11 08:15:24', 'bbeenn'),
(61, 'white', 'vipi', '0723829300', '2', '2020-08-11 08:19:39', 'bbeenn');

-- --------------------------------------------------------

--
-- Table structure for table `param`
--

CREATE TABLE `param` (
  `id` int(100) NOT NULL,
  `conkey` varchar(255) NOT NULL,
  `secret` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `param`
--

INSERT INTO `param` (`id`, `conkey`, `secret`) VALUES
(1, 'MYFar3WdmpU2bhjighVq+qcUkWSrA4Og', 'AZGIyTvbSui+V4S4xOfdZcQ+Kb4=');

-- --------------------------------------------------------

--
-- Table structure for table `pesapal_track`
--

CREATE TABLE `pesapal_track` (
  `track_id` bigint(40) NOT NULL,
  `reference_code` bigint(40) NOT NULL,
  `tracking_id` varchar(5000) COLLATE utf8_unicode_ci NOT NULL,
  `track_status` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `pesapal_track`
--

INSERT INTO `pesapal_track` (`track_id`, `reference_code`, `tracking_id`, `track_status`, `date`) VALUES
(31, 43, 'dede5af6-d013-4fe0-b329-812f149bc825', '', '2020-08-09 15:07:17'),
(32, 45, '21408657-062f-46fa-8e6f-c513401be95d', '', '2020-08-10 14:34:14'),
(33, 60, '6a59907b-d01b-4f78-b563-1d092110ad7e', '', '2020-08-11 08:16:14');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `donors`
--
ALTER TABLE `donors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `param`
--
ALTER TABLE `param`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pesapal_track`
--
ALTER TABLE `pesapal_track`
  ADD PRIMARY KEY (`track_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `donors`
--
ALTER TABLE `donors`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `param`
--
ALTER TABLE `param`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pesapal_track`
--
ALTER TABLE `pesapal_track`
  MODIFY `track_id` bigint(40) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
