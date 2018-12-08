-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 22, 2018 at 02:03 PM
-- Server version: 5.6.41
-- PHP Version: 5.5.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `petitions_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `petitions`
--

CREATE TABLE `petitions` (
  `id` int(11) NOT NULL,
  `id_autor` varchar(64) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `body` varchar(1000) NOT NULL,
  `active` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `petitions`
--

INSERT INTO `petitions` (`id`, `id_autor`, `subject`, `body`, `active`) VALUES
(5, '88af91d7cf4ebfe6adcce8825f223a9fb847c1c2787d809c7eaeae84a97e9b54', 'First', 'laksntlkrn\r\nkalaksdt', 1),
(8, '5763adf2adc36151fe070114db25120cde4132c199cbb7611fb6d2bf68d2d7ab', 'second', 'second petition', 1),
(9, '88af91d7cf4ebfe6adcce8825f223a9fb847c1c2787d809c7eaeae84a97e9b54', 'threed', 'artlklknds', 1),
(10, 'ee096b06e6a1e3a477bed67f30e78c706455808604ea6bde35ed148a7202be12', 'Fours', 'kajslktrlkn lkjf salkrt', 1),
(11, '88af91d7cf4ebfe6adcce8825f223a9fb847c1c2787d809c7eaeae84a97e9b54', 'fives', 'alkdjltrkej sdlfkjlkjr lkdjfl123123', 1),
(12, '88af91d7cf4ebfe6adcce8825f223a9fb847c1c2787d809c7eaeae84a97e9b54', 'number 6', '6666666666666', 1),
(13, 'ffadf547cb0e41f96f9a516a46bf9672331d75be4220d24c556cb61cd7b6b8d8', '7', 'sdferter', 1),
(14, '5d5c86d445c78fc38242b80f1567e946af8ac59413e27471359f6305cf30c318', '8', 'r324123', 1),
(15, 'ffadf547cb0e41f96f9a516a46bf9672331d75be4220d24c556cb61cd7b6b8d8', '9', '123123', 1),
(16, '88af91d7cf4ebfe6adcce8825f223a9fb847c1c2787d809c7eaeae84a97e9b54', '10', '412421', 1);

-- --------------------------------------------------------

--
-- Table structure for table `signatures`
--

CREATE TABLE `signatures` (
  `id` int(11) NOT NULL,
  `id_user` varchar(64) NOT NULL,
  `id_petition` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `signatures`
--

INSERT INTO `signatures` (`id`, `id_user`, `id_petition`) VALUES
(2, '5763adf2adc36151fe070114db25120cde4132c199cbb7611fb6d2bf68d2d7ab', 5),
(3, '88af91d7cf4ebfe6adcce8825f223a9fb847c1c2787d809c7eaeae84a97e9b54', 5),
(4, '88af91d7cf4ebfe6adcce8825f223a9fb847c1c2787d809c7eaeae84a97e9b54', 8),
(5, 'ffadf547cb0e41f96f9a516a46bf9672331d75be4220d24c556cb61cd7b6b8d8', 8),
(6, 'ee096b06e6a1e3a477bed67f30e78c706455808604ea6bde35ed148a7202be12', 9),
(7, 'ee096b06e6a1e3a477bed67f30e78c706455808604ea6bde35ed148a7202be12', 10),
(8, '88af91d7cf4ebfe6adcce8825f223a9fb847c1c2787d809c7eaeae84a97e9b54', 10),
(9, '5d5c86d445c78fc38242b80f1567e946af8ac59413e27471359f6305cf30c318', 5),
(10, '5763adf2adc36151fe070114db25120cde4132c199cbb7611fb6d2bf68d2d7ab', 16),
(11, '7abebcbffd3d6aa0fe9c53fad324f67e8c6388d7456385dd390899ca84b2ffc6', 16);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` varchar(64) NOT NULL,
  `email` varchar(255) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `active`) VALUES
('5763adf2adc36151fe070114db25120cde4132c199cbb7611fb6d2bf68d2d7ab', 'kostya@gmail.com', 1),
('5d5c86d445c78fc38242b80f1567e946af8ac59413e27471359f6305cf30c318', 'email2@email.com', 1),
('7abebcbffd3d6aa0fe9c53fad324f67e8c6388d7456385dd390899ca84b2ffc6', 'ter@dsk.rr', 1),
('88af91d7cf4ebfe6adcce8825f223a9fb847c1c2787d809c7eaeae84a97e9b54', 'tretyak1c@gmail.com', 1),
('ee096b06e6a1e3a477bed67f30e78c706455808604ea6bde35ed148a7202be12', 'bestofthebest@gmail.com', 1),
('ffadf547cb0e41f96f9a516a46bf9672331d75be4220d24c556cb61cd7b6b8d8', 'tretyak1c@ukr.net', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `petitions`
--
ALTER TABLE `petitions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `signatures`
--
ALTER TABLE `signatures`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `petitions`
--
ALTER TABLE `petitions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `signatures`
--
ALTER TABLE `signatures`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
