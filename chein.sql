-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 29-11-2023 a las 18:53:48
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

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
-- Estructura de tabla para la tabla `carrito`
--

CREATE TABLE `carrito` (
  `ID_Usuario` int(11) DEFAULT NULL,
  `ID_Producto` int(11) DEFAULT NULL,
  `Cantidad` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `carrito`
--

INSERT INTO `carrito` (`ID_Usuario`, `ID_Producto`, `Cantidad`) VALUES
(1, 1, 2),
(2, 3, 1),
(3, 2, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `ID_Producto` int(11) NOT NULL,
  `Nombre_P` varchar(50) DEFAULT NULL,
  `Descripcion_P` varchar(150) DEFAULT NULL,
  `Categoria_P` varchar(20) DEFAULT NULL,
  `Existencias_P` int(11) DEFAULT NULL,
  `Esta_Agotado_P` tinyint(1) DEFAULT NULL,
  `Precio_P` decimal(8,2) DEFAULT NULL,
  `Imagen_P` varchar(100) DEFAULT NULL,
  `Tiene_Descuento_P` tinyint(1) DEFAULT NULL,
  `Descuento_P` decimal(8,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`ID_Producto`, `Nombre_P`, `Descripcion_P`, `Categoria_P`, `Existencias_P`, `Esta_Agotado_P`, `Precio_P`, `Imagen_P`, `Tiene_Descuento_P`, `Descuento_P`) VALUES
(1, 'Camiseta básica', 'Camiseta de algodón de manga corta', 'Ropa', 100, 0, 12.99, 'camiseta_basica.jpg', 0, 0.00),
(2, 'Jeans ajustados', 'Jeans de estilo ajustado y tiro alto', 'Ropa', 80, 0, 29.99, 'jeans_ajustados.jpg', 1, 5.00),
(3, 'Zapatillas deportivas', 'Zapatillas cómodas y ligeras', 'Calzado', 50, 0, 24.99, 'zapatillas_deportivas.jpg', 0, 0.00),
(4, 'Vestido floral', 'Vestido corto con estampado floral', 'Ropa', 60, 0, 19.99, 'vestido_floral.jpg', 1, 3.50),
(5, 'Gorra de béisbol', 'Gorra clásica con visera curva', 'Accesorio', 120, 0, 9.99, 'gorra_beisbol.jpg', 0, 0.00),
(6, 'Suéter de punto', 'Suéter cálido de punto para el invierno', 'Ropa', 40, 0, 39.99, 'sueter_punto.jpg', 1, 7.00),
(7, 'Bolso de mano', 'Bolso de mano elegante y espacioso', 'Accesorio', 30, 0, 49.99, 'bolso_mano.jpg', 0, 0.00),
(8, 'Pantalones cortos deportivos', 'Pantalones cortos ideales para hacer ejercicio', 'Ropa', 70, 0, 14.99, 'pantalones_cortos_deportivos.jpg', 1, 2.00),
(9, 'Zapatos de tacón', 'Zapatos de tacón alto y elegante', 'Calzado', 25, 0, 34.99, 'zapatos_tacon.jpg', 1, 6.50),
(10, 'Sudadera con capucha', 'Sudadera cómoda con capucha ajustable', 'Ropa', 55, 0, 27.99, 'sudadera_capucha.jpg', 0, 0.00),
(11, 'Bufanda de lana', 'Bufanda suave y abrigada para el invierno', 'Accesorio', 90, 0, 16.99, 'bufanda_lana.jpg', 1, 1.50),
(12, 'Pantalones de vestir', 'Pantalones de vestir elegantes para ocasiones formales', 'Ropa', 35, 0, 44.99, 'pantalones_vestir.jpg', 0, 0.00),
(13, 'Reloj de pulsera', 'Reloj de pulsera con correa de cuero', 'Accesorio', 15, 0, 59.99, 'reloj_pulsera.jpg', 1, 8.00),
(14, 'Blusa estampada', 'Blusa ligera con estampado moderno', 'Ropa', 75, 0, 22.99, 'blusa_estampada.jpg', 0, 0.00),
(15, 'Cinturón de cuero', 'Cinturón de cuero genuino con hebilla elegante', 'Accesorio', 45, 0, 18.99, 'cinturon_cuero.jpg', 1, 4.00),
(16, 'Gafas de sol', 'Gafas de sol con protección UV', 'Accesorio', 20, 0, 32.99, 'gafas_sol.jpg', 0, 0.00);

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
  `Rango_U` int(11) DEFAULT NULL,
  `Esta_Bloqueada` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`ID_Usuario`, `Nombre_U`, `Cuenta_U`, `Correo_U`, `Contrasena_U`, `Contrasena_Seg_U`, `Rango_U`, `Esta_Bloqueada`) VALUES
(1, 'Usuario1', 'Cuenta1', 'usuario1@example.com', 'contrasena1', 'seguridad1', 1, 0),
(2, 'Usuario2', 'Cuenta2', 'usuario2@example.com', 'contrasena2', 'seguridad2', 2, 0),
(3, 'Usuario3', 'Cuenta3', 'usuario3@example.com', 'contrasena3', 'seguridad3', 3, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `carrito`
--
ALTER TABLE `carrito`
  ADD KEY `ID_Usuario` (`ID_Usuario`),
  ADD KEY `ID_Producto` (`ID_Producto`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`ID_Producto`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`ID_Usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `ID_Producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `ID_Usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `carrito`
--
ALTER TABLE `carrito`
  ADD CONSTRAINT `carrito_ibfk_1` FOREIGN KEY (`ID_Usuario`) REFERENCES `usuario` (`ID_Usuario`),
  ADD CONSTRAINT `carrito_ibfk_2` FOREIGN KEY (`ID_Producto`) REFERENCES `producto` (`ID_Producto`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
