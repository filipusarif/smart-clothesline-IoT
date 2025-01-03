-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 30, 2024 at 02:27 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_control`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_control`
--

CREATE TABLE `tb_control` (
  `id` int(11) NOT NULL,
  `jemur` int(11) NOT NULL,
  `posisi` int(11) NOT NULL,
  `posisiTutup` int(11) NOT NULL,
  `mode` int(11) NOT NULL,
  `cuaca` varchar(15) NOT NULL,
  `hujan` int(11) NOT NULL,
  `cahaya` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_control`
--

INSERT INTO `tb_control` (`id`, `jemur`, `posisi`, `posisiTutup`, `mode`, `cuaca`, `hujan`, `cahaya`) VALUES
(1, 0, 88, 99, 0, 'Mendung', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tb_riwayat`
--

CREATE TABLE `tb_riwayat` (
  `id` int(11) NOT NULL,
  `jemur` int(11) NOT NULL,
  `posisi` int(11) NOT NULL,
  `posisiTutup` int(11) NOT NULL,
  `mode` int(11) NOT NULL,
  `cuaca` int(11) NOT NULL,
  `hujan` int(11) NOT NULL,
  `cahaya` int(11) NOT NULL,
  `waktu` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_riwayat`
--

INSERT INTO `tb_riwayat` (`id`, `jemur`, `posisi`, `posisiTutup`, `mode`, `cuaca`, `hujan`, `cahaya`, `waktu`) VALUES
(1, 0, 88, 98, 0, 0, 0, 0, '2024-12-28 06:04:50'),
(2, 1, 88, 98, 0, 0, 0, 1, '2024-12-28 06:05:29'),
(3, 0, 88, 98, 0, 0, 0, 0, '2024-12-28 06:05:45'),
(4, 1, 81, 101, 0, 0, 0, 0, '2024-12-28 06:19:25'),
(5, 0, 81, 101, 0, 0, 0, 0, '2024-12-28 06:19:30'),
(6, 1, 81, 101, 0, 0, 0, 0, '2024-12-28 06:19:34'),
(7, 0, 81, 101, 0, 0, 0, 0, '2024-12-28 06:19:39'),
(8, 1, 0, 0, 0, 0, 0, 0, '2024-12-28 06:28:54'),
(9, 0, 0, 0, 0, 0, 0, 0, '2024-12-28 06:43:55'),
(10, 0, 0, 0, 0, 0, 0, 0, '2024-12-28 06:43:57'),
(11, 0, 0, 0, 0, 0, 0, 0, '2024-12-28 06:43:59'),
(12, 1, 77, 111, 0, 0, 0, 0, '2024-12-28 06:44:10'),
(13, 0, 77, 111, 0, 0, 0, 0, '2024-12-28 06:44:14'),
(14, 1, 77, 111, 0, 0, 0, 0, '2024-12-28 06:44:18'),
(15, 0, 77, 111, 0, 0, 0, 0, '2024-12-28 06:44:21'),
(16, 1, 77, 111, 0, 0, 0, 0, '2024-12-28 06:44:26'),
(17, 0, 77, 111, 0, 0, 0, 0, '2024-12-28 06:44:47'),
(18, 1, 77, 111, 0, 0, 0, 0, '2024-12-29 01:41:38'),
(19, 0, 77, 111, 0, 0, 0, 0, '2024-12-29 01:41:43'),
(20, 0, 77, 111, 0, 0, 0, 0, '2024-12-29 01:41:46'),
(21, 1, 77, 98, 0, 0, 0, 0, '2024-12-29 01:41:52'),
(22, 0, 77, 98, 0, 0, 0, 0, '2024-12-29 01:41:57'),
(23, 1, 77, 98, 0, 0, 0, 0, '2024-12-29 01:42:21'),
(24, 0, 77, 98, 0, 0, 0, 0, '2024-12-29 01:42:26'),
(25, 1, 77, 98, 0, 0, 0, 1, '2024-12-29 02:12:42'),
(26, 0, 77, 98, 0, 0, 0, 1, '2024-12-29 02:12:47'),
(27, 0, 77, 98, 0, 0, 0, 1, '2024-12-29 02:12:50'),
(28, 1, 77, 98, 0, 0, 0, 0, '2024-12-29 03:13:47'),
(29, 1, 77, 98, 0, 0, 0, 0, '2024-12-29 03:13:49'),
(30, 0, 77, 98, 0, 0, 0, 0, '2024-12-29 03:13:53'),
(31, 1, 61, 120, 0, 0, 0, 0, '2024-12-29 03:14:10'),
(32, 1, 61, 120, 0, 0, 0, 0, '2024-12-29 03:14:11'),
(33, 0, 61, 120, 0, 0, 0, 0, '2024-12-29 03:14:15'),
(34, 1, 61, 120, 0, 0, 0, 0, '2024-12-29 04:23:58'),
(35, 0, 61, 120, 0, 0, 0, 0, '2024-12-29 04:24:38'),
(36, 1, 61, 120, 0, 0, 0, 0, '2024-12-29 04:24:42'),
(37, 1, 61, 120, 0, 0, 0, 0, '2024-12-29 04:24:46'),
(38, 0, 61, 120, 0, 0, 0, 0, '2024-12-29 04:30:37'),
(39, 0, 61, 120, 0, 0, 0, 0, '2024-12-29 04:30:39'),
(40, 1, 61, 120, 0, 0, 0, 0, '2024-12-29 04:30:45'),
(41, 0, 61, 120, 0, 0, 0, 0, '2024-12-29 04:30:57'),
(42, 0, 61, 120, 0, 0, 0, 0, '2024-12-29 04:31:00'),
(43, 1, 61, 120, 0, 0, 0, 1, '2024-12-29 05:23:22'),
(44, 0, 61, 120, 0, 0, 0, 1, '2024-12-29 05:23:27'),
(45, 1, 61, 120, 0, 0, 0, 1, '2024-12-29 05:25:17'),
(46, 0, 61, 120, 0, 0, 0, 0, '2024-12-29 14:53:32'),
(47, 1, 61, 120, 0, 0, 0, 0, '2024-12-29 14:53:37'),
(48, 1, 61, 120, 0, 0, 0, 0, '2024-12-29 14:53:41'),
(49, 0, 61, 120, 0, 0, 0, 0, '2024-12-29 14:53:50'),
(50, 1, 61, 120, 0, 0, 0, 0, '2024-12-29 14:53:56'),
(51, 0, 61, 120, 0, 0, 0, 0, '2024-12-29 14:53:58'),
(52, 0, 61, 120, 0, 0, 0, 0, '2024-12-29 14:54:06'),
(53, 0, 61, 120, 0, 0, 0, 0, '2024-12-29 14:54:08'),
(54, 1, 61, 120, 0, 0, 0, 0, '2024-12-29 14:54:13'),
(55, 0, 61, 120, 0, 0, 0, 0, '2024-12-29 14:55:17'),
(56, 1, 61, 120, 0, 0, 0, 0, '2024-12-29 14:57:10'),
(57, 0, 61, 120, 0, 0, 0, 0, '2024-12-29 14:57:16'),
(58, 1, 61, 120, 0, 0, 0, 0, '2024-12-29 15:02:08'),
(59, 0, 61, 120, 0, 0, 0, 0, '2024-12-29 15:02:13'),
(60, 1, 61, 120, 0, 0, 0, 0, '2024-12-29 15:31:15'),
(61, 0, 61, 120, 0, 0, 0, 0, '2024-12-29 16:46:00'),
(62, 0, 61, 120, 0, 0, 0, 0, '2024-12-29 16:46:03'),
(63, 1, 61, 120, 0, 0, 0, 0, '2024-12-29 16:46:07'),
(64, 0, 61, 120, 0, 0, 0, 0, '2024-12-29 16:46:10'),
(65, 1, 61, 120, 0, 0, 0, 0, '2024-12-29 16:46:14'),
(66, 0, 88, 99, 0, 0, 0, 0, '2024-12-29 16:46:25'),
(67, 1, 88, 99, 0, 0, 0, 0, '2024-12-29 16:46:28'),
(68, 0, 88, 99, 0, 0, 0, 0, '2024-12-29 17:17:54'),
(69, 1, 88, 99, 0, 0, 0, 0, '2024-12-29 18:09:28'),
(70, 0, 88, 99, 0, 0, 0, 0, '2024-12-29 18:09:32'),
(71, 1, 88, 99, 0, 0, 0, 0, '2024-12-29 18:09:36'),
(72, 0, 88, 99, 0, 0, 0, 0, '2024-12-29 20:17:41');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(1, 'hello', '$2y$10$8x0XsWbbOyPnYAExBHSNtuObKu/o6iWuPxrQv8kgD0hgwnPrVQyAe'),
(2, 'admin', '$2y$10$qGfI1Xx/wDoGw5pupGhTL.UIOkpWDSlrTvfDiSx64gepRvrjGw0XS'),
(3, '', '$2y$10$uwJirAcEN.7ntYUwjm4NpubkjzzfJcnTdE8IwKPL8mWrvyM80XDxO'),
(4, 'coba', '$2y$10$tJOsk36IX17NUsKUOddWsuv6woGuEJRNce95sIqknverbvFX1JX4e');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_control`
--
ALTER TABLE `tb_control`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_riwayat`
--
ALTER TABLE `tb_riwayat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_control`
--
ALTER TABLE `tb_control`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_riwayat`
--
ALTER TABLE `tb_riwayat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
