-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 06-04-2020 a las 02:20:48
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
-- Estructura de tabla para la tabla `tbl_datos_empresa`
--

CREATE TABLE `tbl_datos_empresa` (
  `id_dempresa` int(11) NOT NULL,
  `name_empresa` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `rut_empresa` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `giro_empresa` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `address_empresa` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `telefono_empresa` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `correo_empresa` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `ruta_logo_empresa` text COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `tbl_datos_empresa`
--

INSERT INTO `tbl_datos_empresa` (`id_dempresa`, `name_empresa`, `rut_empresa`, `giro_empresa`, `address_empresa`, `telefono_empresa`, `correo_empresa`, `ruta_logo_empresa`) VALUES
(27, 'Gestarriendos SPA', '18.827.816-7', 'Empresa de servicios inmobiliarios', 'Calle Sin Salida #123', '948992070', 'uebeats@gmail.com', 'model/images/logo-gestarriendos-spa.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_movement_property`
--

CREATE TABLE `tbl_movement_property` (
  `id_mov_property` int(11) NOT NULL,
  `id_property` int(11) NOT NULL,
  `agent_movement` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `date_movement` date NOT NULL,
  `type_movement` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `txt_movement` text COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tbl_datos_empresa`
--
ALTER TABLE `tbl_datos_empresa`
  ADD PRIMARY KEY (`id_dempresa`);

--
-- Indices de la tabla `tbl_movement_property`
--
ALTER TABLE `tbl_movement_property`
  ADD PRIMARY KEY (`id_mov_property`),
  ADD KEY `id_property` (`id_property`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tbl_datos_empresa`
--
ALTER TABLE `tbl_datos_empresa`
  MODIFY `id_dempresa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de la tabla `tbl_movement_property`
--
ALTER TABLE `tbl_movement_property`
  MODIFY `id_mov_property` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
