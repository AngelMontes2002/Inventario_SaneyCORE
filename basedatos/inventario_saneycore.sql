-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 11-04-2025 a las 23:02:35
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
-- Estructura de tabla para la tabla `detalle_retiro`
--

CREATE TABLE `detalle_retiro` (
  `id` int(11) NOT NULL,
  `retiro_id` int(11) NOT NULL,
  `producto_codigo` int(11) NOT NULL,
  `cantidad_retirada` int(11) NOT NULL,
  `stock_restante` int(11) NOT NULL
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
-- Estructura de tabla para la tabla `retiros`
--

CREATE TABLE `retiros` (
  `id` int(11) NOT NULL,
  `numero_orden` varchar(20) NOT NULL,
  `usuario_id` varchar(50) NOT NULL,
  `fecha` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Disparadores `retiros`
--
DELIMITER $$
CREATE TRIGGER `before_insert_retiro` BEFORE INSERT ON `retiros` FOR EACH ROW BEGIN
  DECLARE next_id INT;
  SELECT AUTO_INCREMENT INTO next_id
  FROM INFORMATION_SCHEMA.TABLES
  WHERE TABLE_NAME='retiros' AND TABLE_SCHEMA=DATABASE();
  SET NEW.numero_orden = CONCAT('SAN', LPAD(next_id, 6, '0'));
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_use` varchar(20) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `contraseña` varchar(255) NOT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `fecha_registro` timestamp NOT NULL DEFAULT current_timestamp(),
  `rol` enum('admin','supervisor','empleado') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_use`, `nombre`, `contraseña`, `telefono`, `fecha_registro`, `rol`) VALUES
('admin', 'admin', '$2y$10$kg2KUDOcD.ODP2Y1yek7g.gx/t.KWbLVyRsz.FEBb6OCMMvRBPWOa', '', '2025-04-11 21:01:20', 'admin');

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
-- Indices de la tabla `detalle_retiro`
--
ALTER TABLE `detalle_retiro`
  ADD PRIMARY KEY (`id`),
  ADD KEY `retiro_id` (`retiro_id`),
  ADD KEY `producto_codigo` (`producto_codigo`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`Codigo_pro`),
  ADD KEY `identi_cliente` (`identi_cliente`),
  ADD KEY `idx_producto_categoria` (`categoria`);

--
-- Indices de la tabla `retiros`
--
ALTER TABLE `retiros`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_usuario_retiro` (`usuario_id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_use`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `identi_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2147483648;

--
-- AUTO_INCREMENT de la tabla `detalle_retiro`
--
ALTER TABLE `detalle_retiro`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `Codigo_pro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `retiros`
--
ALTER TABLE `retiros`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `detalle_retiro`
--
ALTER TABLE `detalle_retiro`
  ADD CONSTRAINT `detalle_retiro_ibfk_1` FOREIGN KEY (`retiro_id`) REFERENCES `retiros` (`id`),
  ADD CONSTRAINT `detalle_retiro_ibfk_2` FOREIGN KEY (`producto_codigo`) REFERENCES `producto` (`Codigo_pro`);

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `producto_ibfk_1` FOREIGN KEY (`identi_cliente`) REFERENCES `cliente` (`identi_cliente`) ON DELETE SET NULL;

--
-- Filtros para la tabla `retiros`
--
ALTER TABLE `retiros`
  ADD CONSTRAINT `fk_usuario_retiro` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id_use`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
