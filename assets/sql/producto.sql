-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 08-06-2017 a las 01:47:55
-- Versión del servidor: 10.1.21-MariaDB
-- Versión de PHP: 7.0.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `pizhub`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `id` int(11) UNSIGNED NOT NULL,
  `nombre` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tipo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `precio` double DEFAULT NULL,
  `nref` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `descri` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `imgsrc` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`id`, `nombre`, `tipo`, `precio`, `nref`, `descri`, `imgsrc`) VALUES
(1, 'PERSONALIZADA', 'pizza', 12, 'pizpers', 'Crea la pizza a tu gusto.', 'pizza5.png'),
(2, 'MARGARITA', 'pizza', 12, 'pizmarg', 'La pizza más simple, y más barata.', 'pizza1.png'),
(3, 'COMPLETA', 'pizza', 18, 'pizcomp', '¿No te decides? Que sea con todo.', 'pizza2.png'),
(4, 'QUESERA', 'pizza', 15, 'pizques', 'La quesera... ¿Qué será?', 'pizza3.png'),
(5, 'VEGETARIANA', 'pizza', 16, 'pizvege', 'La pizza más saludable.', 'pizza4.png'),
(6, 'PEPERONI', 'pizza', 14, 'pizpepe', 'Todo un clásico, la que comía Vitto Corleone.', 'pizza6.png'),
(7, 'IBÉRICA', 'pizza', 16, 'piziber', 'El auténtico sabor de la tierra.', 'pizza7.png'),
(8, 'BARBACOA', 'pizza', 15, 'pizbarb', 'Delicioso combinado de carnes con una salsa única.', 'pizza8.png'),
(9, 'CARBONARA', 'pizza', 15, 'pizcarb', 'Pizza con sabor a pasta... ¿Qué más se puede pedir?', 'pizza9.png'),
(10, 'DIABOLICA', 'pizza', 666, 'pizdiab', 'ERROR 404. Inteligencia not found.', 'pizza10.png'),
(11, 'MIXTO', 'sandwich', 3.5, 'sanjamo', 'El clásico sándwich, jamón y queso.', 'dummy.png'),
(12, 'VEGETAL', 'sandwich', 3.2, 'sanvege', 'El sándwich más saludable.', 'dummy.png'),
(13, 'COMPLETO', 'sandwich', 4, 'sancomp', 'Para bocas grandes, todas es todas.', 'dummy.png'),
(14, 'COMPLETA', 'hamburguesa', 5.5, 'hamcomp', '¿Serás capaz de hincarle el diente? ¿Y a la hamburguesa también?', 'dummy.png'),
(15, 'POLLO CRUJIENTE', 'hamburguesa', 5, 'hampoll', 'Disfruta del crujiente pollo deshaciéndose en tu boca...', 'dummy.png'),
(16, 'DOBLE', 'hamburguesa', 7, 'hamdobl', '¿Eres un glotón? Esta es tu hamburguesa.', 'dummy.png'),
(17, 'VEGETAL', 'hamburguesa', 4, 'hamvege', '¿Te apetece cuidar la línea y comerte además una hamburguesa?', 'dummy.png'),
(18, 'BOLOGNESA', 'pasta', 8, 'pasbolo', 'Deliciosa pasta al dente, con una espectacular salsa bolognesa.', 'dummy.png'),
(19, 'CARBONARA', 'pasta', 7, 'pascarb', 'Descripcion de la pasta carbonara', 'dummy.png'),
(20, 'PESTO', 'pasta', 7.5, 'paspest', 'Descripcion de la pasta pesto', 'dummy.png');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
