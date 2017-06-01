-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 31, 2017 at 11:07 AM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pizhub`
--

-- --------------------------------------------------------

--
-- Table structure for table `producto`
--

CREATE TABLE `producto` (
  `id` int(11) UNSIGNED NOT NULL,
  `nombre` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tipo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `precio` double DEFAULT NULL,
  `referencia` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `imgsrc` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `producto`
--

INSERT INTO `producto` (`id`, `nombre`, `tipo`, `precio`, `referencia`, `imgsrc`) VALUES
(1, 'PERSONALIZADA', 'pizza', 12, 'pizpers', 'pizza5.png'),
(2, 'MARGARITA', 'pizza', 12, 'pizmarg', 'pizza1.png'),
(3, 'COMPLETA', 'pizza', 18, 'pizcomp', 'pizza2.png'),
(4, 'QUESERA', 'pizza', 15, 'pizques', 'pizza3.png'),
(5, 'VEGETARIANA', 'pizza', 16, 'pizvege', 'pizza4.png'),
(6, 'PEPERONI', 'pizza', 14, 'pizpepe', 'pizza6.png'),
(7, 'IBÉRICA', 'pizza', 16, 'piziber', 'pizza7.png'),
(8, 'BARBACOA', 'pizza', 15, 'pizbarb', 'pizza8.png'),
(9, 'CARBONARA', 'pizza', 15, 'pizcarb', 'pizza9.png'),
(10, 'DIABOLICA', 'pizza', 666, 'pizdiab', 'pizza10.png'),
(11, 'MIXTO', 'sandwich', 3.5, 'sanjamo', 'dummy.png'),
(12, 'VEGETAL', 'sandwich', 3.2, 'sanvege', 'dummy.png'),
(13, 'COMPLETO', 'sandwich', 4, 'sancomp', 'dummy.png'),
(14, 'COMPLETA', 'hamburguesa', 5.5, 'hamcomp', 'dummy.png'),
(15, 'POLLO', 'hamburguesa', 5, 'hampoll', 'dummy.png'),
(16, 'DOBLE', 'hamburguesa', 7, 'hamdobl', 'dummy.png'),
(17, 'VEGETAL', 'hamburguesa', 4, 'hamvege', 'dummy.png'),
(18, 'BOLOGNESA', 'pasta', 8, 'pasbolo', 'dummy.png'),
(19, 'CARBONARA', 'pasta', 7, 'pascarb', 'dummy.png'),
(20, 'PESTO', 'pasta', 7.5, 'paspest', 'dummy.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `producto`
--
ALTER TABLE `producto`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
