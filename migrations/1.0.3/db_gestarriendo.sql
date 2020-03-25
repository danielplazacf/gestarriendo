-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 25-03-2020 a las 23:26:55
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
-- Estructura de tabla para la tabla `tbl_pagos_property`
--

CREATE TABLE `tbl_pagos_property` (
  `id_pago_property` int(11) NOT NULL,
  `id_property` int(11) NOT NULL,
  `agent_designated` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `date_register` date NOT NULL,
  `desde_pago` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `hacia_pago` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `concepto_csimple` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `hidden_recurrent` int(11) NOT NULL,
  `amount_csimple` decimal(10,0) NOT NULL,
  `venc_csimple` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tbl_pagos_property`
--
ALTER TABLE `tbl_pagos_property`
  ADD PRIMARY KEY (`id_pago_property`),
  ADD KEY `id_property` (`id_property`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tbl_pagos_property`
--
ALTER TABLE `tbl_pagos_property`
  MODIFY `id_pago_property` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
