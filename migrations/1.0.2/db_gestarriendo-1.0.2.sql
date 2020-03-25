-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 25-03-2020 a las 09:13:11
-- Versión del servidor: 10.4.11-MariaDB
-- Versión de PHP: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `db_gestarriendo`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_cobros_property`
--

CREATE TABLE `tbl_cobros_property` (
  `id_cobro_property` int(11) NOT NULL,
  `id_property` int(11) NOT NULL,
  `agent_designated` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `date_register` date NOT NULL,
  `desde_cobro` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `hacia_cobro` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `concepto_csimple` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `hidden_recurrent` int(11) NOT NULL,
  `amount_csimple` decimal(10,0) NOT NULL,
  `venc_csimple` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_concepto_cobro`
--

CREATE TABLE `tbl_concepto_cobro` (
  `id_concepto_cobro` int(11) NOT NULL,
  `concepto_cobro` varchar(255) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `tbl_concepto_cobro`
--

INSERT INTO `tbl_concepto_cobro` (`id_concepto_cobro`, `concepto_cobro`) VALUES
(1, 'Canon de arriendo'),
(2, 'Gastos Comunes'),
(3, 'Estacionamiento'),
(4, 'Cobro mantenimiento'),
(5, 'Pago Agua'),
(6, 'Pago Luz'),
(7, 'Pago Gas'),
(8, 'Otro'),
(9, 'Comisión por Administración');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_contrato_system`
--

CREATE TABLE `tbl_contrato_system` (
  `id_contrato` int(11) NOT NULL,
  `id_property` int(11) NOT NULL,
  `status_contrato` tinyint(1) NOT NULL,
  `agent_designated` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `date_register` date NOT NULL,
  `name_owner` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `name_leaser` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_termino` date NOT NULL,
  `garantia_contrato` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `receptor_garantia` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `tipo_contrato` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tbl_cobros_property`
--
ALTER TABLE `tbl_cobros_property`
  ADD PRIMARY KEY (`id_cobro_property`),
  ADD KEY `id_property` (`id_property`);

--
-- Indices de la tabla `tbl_concepto_cobro`
--
ALTER TABLE `tbl_concepto_cobro`
  ADD PRIMARY KEY (`id_concepto_cobro`);

--
-- Indices de la tabla `tbl_contrato_system`
--
ALTER TABLE `tbl_contrato_system`
  ADD PRIMARY KEY (`id_contrato`),
  ADD KEY `id_property` (`id_property`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tbl_cobros_property`
--
ALTER TABLE `tbl_cobros_property`
  MODIFY `id_cobro_property` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_concepto_cobro`
--
ALTER TABLE `tbl_concepto_cobro`
  MODIFY `id_concepto_cobro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `tbl_contrato_system`
--
ALTER TABLE `tbl_contrato_system`
  MODIFY `id_contrato` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
