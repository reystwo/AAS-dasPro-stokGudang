-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 11, 2026 at 05:59 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `stok_gudang`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id` int NOT NULL,
  `nama_barang` varchar(100) NOT NULL,
  `jumlah` int NOT NULL,
  `block_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id`, `nama_barang`, `jumlah`, `block_id`) VALUES
(7, 'A06', 4, 1),
(8, 'A07', 10, 1),
(9, 'A17', 6, 1),
(10, 'A17 5G', 3, 1),
(11, 'A26 5G', 2, 1),
(12, 'A36 5G', 5, 2),
(13, 'A56 5G', 3, 2),
(14, 'S25 FE', 2, 2),
(15, 'S25', 2, 2),
(16, 'S25+', 2, 2),
(17, 'S25 Ultra', 1, 2),
(18, 'A5 Pro 5G', 3, 3),
(19, 'A6', 10, 3),
(20, 'A6x', 5, 3),
(21, 'A6 Pro 4G', 5, 3),
(22, 'A6 Pro 5G', 2, 3),
(23, 'Reno 13F 4G', 2, 4),
(24, '17', 2, 17),
(25, '17 Pro', 2, 17),
(26, '17 Pro Max', 2, 17),
(27, '16', 3, 17),
(28, 'Reno 13 5G', 3, 4),
(29, 'Reno 14F 5G', 5, 4),
(30, 'Reno 14 5G', 5, 4),
(31, 'Reno 14 Pro 5G', 3, 4),
(32, 'Find X9', 2, 4),
(33, 'Find X9 Pro', 1, 4),
(34, 'Y04s', 5, 5),
(35, 'Y19s', 7, 5),
(36, 'Y21d', 5, 5),
(37, 'Y29', 5, 5),
(38, 'Y400', 3, 5),
(39, 'Y400', 2, 6),
(40, 'V50 5G', 3, 6),
(42, 'V60 Lite 5G', 5, 6),
(43, 'V60 5G', 5, 6),
(44, 'X300', 2, 6),
(45, 'X300 Pro', 1, 6),
(46, 'Note 60', 3, 7),
(47, 'Note 60x', 5, 7),
(48, 'Note 70', 5, 7),
(49, 'C71', 3, 7),
(50, 'C85', 3, 7),
(51, 'P3 5G', 4, 7),
(52, '13 5G', 2, 7),
(53, '13 5G', 1, 8),
(54, '14 5G', 3, 8),
(55, '15 5G', 3, 8),
(56, '15T 5G', 2, 8),
(57, '15 Pro 5G', 2, 8),
(58, 'GT6', 1, 8),
(59, 'GT7', 1, 8),
(60, 'Redmi A5', 3, 9),
(62, 'Redmi 15C', 4, 9),
(63, 'Redmi 15', 4, 9),
(64, 'Redmi Note 14', 5, 9),
(65, 'Redmi Note 14 5G', 3, 9),
(66, 'Redmi Note 14 Pro 5G', 3, 9),
(67, '14T', 1, 10),
(68, '14T Pro', 1, 10),
(69, '15T', 2, 10),
(70, '15T Pro', 1, 10),
(71, '15', 1, 10),
(72, '15 Ultra', 1, 10),
(73, 'C71', 5, 11),
(74, 'C75', 3, 11),
(75, 'C85', 2, 11),
(76, 'M7', 3, 11),
(77, 'M7 Pro 5G', 2, 11),
(78, 'X7 5G', 2, 11),
(79, 'X7 Pro 5G', 2, 11),
(80, 'F7', 2, 11),
(81, 'F7 Pro', 2, 11),
(82, 'F7 Ultra', 1, 11),
(83, 'Smart 10', 5, 13),
(84, 'Smart 10 Plus', 5, 13),
(85, 'HOT 50 5G', 1, 13),
(86, 'HOT 60i', 3, 13),
(87, 'HOT 60 Pro', 2, 13),
(88, 'HOT 60 Pro Plus', 2, 13),
(89, 'Note 50', 2, 13),
(90, 'Note 50 Pro', 1, 13),
(91, 'GT 30', 2, 13),
(92, 'GT 30 Pro', 1, 13),
(94, 'SPARK GO 2', 3, 15),
(95, 'SPARK 30C', 2, 15),
(96, 'SPARK 30 Pro', 2, 15),
(97, 'SPARK 40', 4, 15),
(98, 'SPARK 40 Pro', 3, 15),
(99, 'POVA 7', 2, 15),
(100, 'POVA 7 5G', 2, 15),
(101, 'POVA 7 Ultra 5G', 2, 15),
(102, 'CAMON 40', 1, 15),
(103, 'CAMON 40 Pro 5G', 1, 15),
(104, 'P65', 2, 16),
(105, 'Power 70', 3, 16),
(106, 'RS4', 1, 16),
(107, 'A90', 5, 16),
(108, 'A100C', 3, 16),
(109, 'CITY 100', 1, 16),
(110, 'Moto G06', 3, 18),
(112, 'Moto G67', 4, 18),
(113, 'Moto G57 5G', 3, 18),
(114, 'Moto G86 5G', 2, 18),
(115, 'Moto 60 Edge Pro', 2, 18);

-- --------------------------------------------------------

--
-- Table structure for table `blocks`
--

CREATE TABLE `blocks` (
  `id` int NOT NULL,
  `nama_block` varchar(10) NOT NULL,
  `kapasitas_max` int NOT NULL DEFAULT '25',
  `alamat_block` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `blocks`
--

INSERT INTO `blocks` (`id`, `nama_block`, `kapasitas_max`, `alamat_block`) VALUES
(1, 'Samsung', 25, 'A1'),
(2, 'Samsung', 25, 'A2'),
(3, 'OPPO', 25, 'A3'),
(4, 'OPPO', 25, 'A4'),
(5, 'VIVO', 25, 'B1'),
(6, 'VIVO', 25, 'B2'),
(7, 'Realme', 25, 'B3'),
(8, 'Realme', 25, 'B4'),
(9, 'Xiaomi', 25, 'C1'),
(10, 'Xiaomi', 25, 'C2'),
(11, 'POCO', 25, 'C3'),
(12, '-', 25, 'C4'),
(13, 'Infinix', 25, 'D1'),
(14, '-', 25, 'D2'),
(15, 'Tecno', 25, 'D3'),
(16, 'iTel', 25, 'D4'),
(17, 'iPhone', 25, 'E1'),
(18, 'Motorola', 25, 'E2'),
(19, '-', 25, 'E3'),
(20, '-', 25, 'E4');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `block_id` (`block_id`);

--
-- Indexes for table `blocks`
--
ALTER TABLE `blocks`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=116;

--
-- AUTO_INCREMENT for table `blocks`
--
ALTER TABLE `blocks`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `barang`
--
ALTER TABLE `barang`
  ADD CONSTRAINT `barang_ibfk_1` FOREIGN KEY (`block_id`) REFERENCES `blocks` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
