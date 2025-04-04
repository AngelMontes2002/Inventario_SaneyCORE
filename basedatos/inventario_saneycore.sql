-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 04-04-2025 a las 04:18:42
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `inventario_saneycore`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `identi_cliente` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `direccion` varchar(255) DEFAULT NULL,
  `n_identi` int(11) DEFAULT NULL,
  `correo` varchar(100) NOT NULL,
  `numero` bigint(15) NOT NULL,
  `tipoDoc` enum('CC','CE','TI','Pasaporte') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`identi_cliente`, `nombre`, `direccion`, `n_identi`, `correo`, `numero`, `tipoDoc`) VALUES
(753, 'William', 'car 53', NULL, 'wall@gmail.com', 12345, 'CC'),
(453453, 'Nohelys', 'CLL 34 SA 88', NULL, 'angelmon.652@gmail.com', 5646456, 'CC'),
(51561561, 'Angel', 'CLL 34 SA 88', NULL, 'angel@gmail.com', 5646456, 'CC'),
(123456789, 'Nohelys', 'CLL 34 SA 88', NULL, 'nohelis@gmail.com', 5646456, 'CC'),
(123456888, 'sebastian', 'CLL 34 SA 88', NULL, 'Sebastian@gmail.com', 3023323158, 'CC'),
(2147483647, 'Angel', 'CLL 34 SA 88 sdfd', NULL, 'angemonl@gmail.com', 5646456, 'CC');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleado`
--

CREATE TABLE `empleado` (
  `n_identi` int(11) NOT NULL,
  `nombre_emp` varchar(50) NOT NULL,
  `fe_nacimiento` date NOT NULL,
  `direccion` varchar(255) DEFAULT NULL,
  `tipoDocu` enum('CC','CE','TI','Pasaporte') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `Codigo_pro` int(11) NOT NULL,
  `Nombre_pro` varchar(50) NOT NULL,
  `Describir` text DEFAULT NULL,
  `unidad` int(11) NOT NULL,
  `identi_cliente` int(11) DEFAULT NULL,
  `categoria` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedor`
--

CREATE TABLE `proveedor` (
  `nit` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `direccion` varchar(255) DEFAULT NULL,
  `codigo` int(11) DEFAULT NULL,
  `n_identidad` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `useradmin`
--

CREATE TABLE `useradmin` (
  `Usuario` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `useradmin`
--

INSERT INTO `useradmin` (`Usuario`, `password`, `nombre`, `apellido`) VALUES
('admin', '$2y$10$hEagyvYkjbZCrGGZcEtIT.y2KvBYf2dShvabzMoqdPbvc5c3DCGKu', 'admin', 'admin'),
('Nohelis', '$2y$10$R0.Hqfi/qGNMOH3Z24uPPed7VPCfyyOiMN9.r0t6NAKWW/hSv70MK', 'Nohelys', 'Ariza');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `Usuario` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`Usuario`, `password`, `nombre`, `apellido`) VALUES
('andy', '$2y$10$QwwkaIJjw6h5AnPx3IQxQeaZXTcqidKuCLr11890hBuNToRU0SQvK', 'andrea', 'saavedra');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`identi_cliente`),
  ADD UNIQUE KEY `correo` (`correo`),
  ADD KEY `idx_cliente_correo` (`correo`);

--
-- Indices de la tabla `empleado`
--
ALTER TABLE `empleado`
  ADD PRIMARY KEY (`n_identi`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`Codigo_pro`),
  ADD KEY `identi_cliente` (`identi_cliente`),
  ADD KEY `idx_producto_categoria` (`categoria`);

--
-- Indices de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  ADD PRIMARY KEY (`nit`);

--
-- Indices de la tabla `useradmin`
--
ALTER TABLE `useradmin`
  ADD PRIMARY KEY (`Usuario`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`Usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `identi_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2147483648;

--
-- AUTO_INCREMENT de la tabla `empleado`
--
ALTER TABLE `empleado`
  MODIFY `n_identi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88885556;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `Codigo_pro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=124;

--
-- AUTO_INCREMENT de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  MODIFY `nit` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `producto_ibfk_1` FOREIGN KEY (`identi_cliente`) REFERENCES `cliente` (`identi_cliente`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
