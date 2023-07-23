-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 23, 2023 at 03:43 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `category_management`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `category_status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `parent_id`, `category_status`) VALUES
(1, 'Nhạc cụ', 0, 'working'),
(2, 'Thiết bị số', 0, 'working'),
(3, 'Phụ kiện', 0, 'working'),
(4, 'Thực phẩm', 0, 'working'),
(5, 'Option 5', 0, 'working'),
(6, 'Option 6', 0, 'working'),
(7, 'Option 7', 0, 'working'),
(8, 'Option 8', 0, 'working'),
(9, 'Option 9', 0, 'working'),
(10, 'Option 10', 0, 'working'),
(11, 'Option 11', 0, 'working'),
(12, 'Option 12', 11, 'working'),
(13, 'Đồ gia dụng', 0, 'working'),
(14, 'Thời Trang', 0, 'working'),
(15, 'Thẩm Mỹ', 0, 'working'),
(16, 'Option 16', 0, 'working'),
(17, 'Option 17', 16, 'working'),
(18, 'Option 18', 0, 'working'),
(19, 'Option 19', 0, 'working'),
(20, 'Option 20', 0, 'working'),
(21, 'Option 21', 0, 'working'),
(22, 'Option 22', 0, 'working');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
