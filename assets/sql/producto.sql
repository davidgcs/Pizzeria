-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 14, 2017 at 11:50 PM
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

DROP TABLE IF EXISTS `producto`;
CREATE TABLE IF NOT EXISTS `producto` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nombre` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tipo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `precio` double DEFAULT NULL,
  `nref` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `descri` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `imgsrc` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `producto`
--

INSERT INTO `producto` (`id`, `nombre`, `tipo`, `precio`, `nref`, `descri`, `imgsrc`) VALUES
(1, 'PERSONALIZADA', 'pizza', 12, 'pizpers', 'Crea la pizza a tu gusto.', 'pizza5.png'),
(2, 'MARGARITA', 'pizza', 12, 'pizmarg', 'La pizza más simple, <br> y más barata.', 'pizza1.png'),
(3, 'COMPLETA', 'pizza', 18, 'pizcomp', '¿No te decides? <br>Que sea con todo.', 'pizza2.png'),
(4, 'QUESERA', 'pizza', 15, 'pizques', 'La quesera... ¿Qué será?', 'pizza3.png'),
(5, 'VEGETARIANA', 'pizza', 16, 'pizvege', 'La pizza más saludable.', 'pizza4.png'),
(6, 'PEPERONI', 'pizza', 14, 'pizpepe', 'Todo un clásico, <br>la que comía Vitto Corleone.', 'pizza6.png'),
(7, 'IBÉRICA', 'pizza', 16, 'piziber', 'El auténtico sabor de la tierra.', 'pizza7.png'),
(8, 'BARBACOA', 'pizza', 15, 'pizbarb', 'Delicioso combinado de carnes<br> con una salsa única.', 'pizza8.png'),
(9, 'CARBONARA', 'pizza', 15, 'pizcarb', 'Pizza con sabor a pasta...<br> ¿Qué más se puede pedir?', 'pizza9.png'),
(10, 'DIABOLICA', 'pizza', 666, 'pizdiab', 'ERROR 404. <br> Inteligencia not found.', 'pizza10.png'),
(11, 'MIXTO', 'sandwich', 3.5, 'sanmixt', 'El clásico sándwich, jamón y queso.', 'sandwichmixto.png'),
(12, 'VEGETAL', 'sandwich', 3.2, 'sanvege', 'El sándwich más saludable.', 'sandwichvegetal.png'),
(13, 'COMPLETO', 'sandwich', 4, 'sancomp', 'Para bocas grandes, todas es todas.', 'sandwichcompleto.png'),
(14, 'COMPLETA', 'hamburguesa', 5.5, 'hamcomp', '¿Serás capaz de hincarle el diente? ¿Y a la hamburguesa también?', 'hamburguesacompleta.png'),
(15, 'POLLO CRUJIENTE', 'hamburguesa', 5, 'hampoll', 'Disfruta del crujiente pollo deshaciéndose en tu boca...', 'hamburguesapollo.png'),
(16, 'DOBLE', 'hamburguesa', 7, 'hamdobl', '¿Eres un glotón? Esta es tu hamburguesa.', 'hamburguesadoble.png'),
(17, 'VEGETAL', 'hamburguesa', 4, 'hamvege', '¿Te apetece cuidar la línea y comerte además una hamburguesa?', 'hamburguesavegetal.png'),
(18, 'BOLOGNESA', 'pasta', 8, 'pasbolo', 'Deliciosa pasta al dente, con una espectacular salsa bolognesa.', 'pastabolognesa.png'),
(19, 'CARBONARA', 'pasta', 7, 'pascarb', 'Descripcion de la pasta carbonara', 'pastacarbonara.png'),
(20, 'PESTO', 'pasta', 7.5, 'paspest', 'Descripcion d ela pasta pesto', 'pastapesto.png');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
