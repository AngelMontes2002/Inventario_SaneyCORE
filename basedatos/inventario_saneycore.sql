-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 14-03-2025 a las 19:35:02
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

--
-- Volcado de datos para la tabla `empleado`
--

INSERT INTO `empleado` (`n_identi`, `nombre_emp`, `fe_nacimiento`, `direccion`, `tipoDocu`) VALUES
(788999, 'william alexis', '1322-05-28', 'CLL 34 SA 88', 'CC'),
(8794616, 'sebastian', '1985-10-25', 'CLL 34 SA 88', 'CC'),
(88885555, 'sebastian', '1985-10-25', 'CLL 34 SA 88', 'CC');

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
('Amontes', '123456789', 'Angel', 'Montes'),
('donsebastian', '$2y$10$5IoIfETBVdBVyxKGmMslTeKbgbGhF74Lby6JmPwQAYhPkWBZVzFbS', 'sebastian', 'torres'),
('PRUEBA', '$2y$10$qx61INCkLgUwYjaenSYp7.MkZNuFEEaQYRIaVC4gXxY1QoTDHNd5e', 'Gustavo', 'Millan'),
('sistemas', '$2y$10$QYW8zdJcOEd.hXNrDoIATegZPT0a9n1z4u002R02Sm2jTYJCHd5Ru', 'Angel', 'Montes');

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
  MODIFY `identi_cliente` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `empleado`
--
ALTER TABLE `empleado`
  MODIFY `n_identi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88885556;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `Codigo_pro` int(11) NOT NULL AUTO_INCREMENT;

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
