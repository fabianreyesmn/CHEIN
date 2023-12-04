-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3307
-- Tiempo de generación: 04-12-2023 a las 21:13:13
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `chein`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `ID_Usuario` int(11) NOT NULL,
  `Nombre_U` varchar(50) DEFAULT NULL,
  `Cuenta_U` varchar(20) DEFAULT NULL,
  `Correo_U` varchar(40) DEFAULT NULL,
  `Contrasena_U` varchar(256) DEFAULT NULL,
  `Contrasena_Seg_U` varchar(256) DEFAULT NULL,
  `Pregunta_Seg_U` varchar(50) DEFAULT NULL,
  `Rango_U` int(11) DEFAULT NULL,
  `Esta_Bloqueada` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`ID_Usuario`, `Nombre_U`, `Cuenta_U`, `Correo_U`, `Contrasena_U`, `Contrasena_Seg_U`, `Pregunta_Seg_U`, `Rango_U`, `Esta_Bloqueada`) VALUES
(1, 'admin', 'admin', 'admin@gmail.com', '$2y$10$G1/jWv.oxkeJ.wbDHkbGP.rD5t.MCWjPgen4IzqE764DLqOyeL8eG', '$2y$10$TBnhbC4NMOAzujwMgi/uyuMSXPMdlxks3O4Ol/SPh36PhThAF2Xe.', 'Deporte', 1, 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`ID_Usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `ID_Usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
