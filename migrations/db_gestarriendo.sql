-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 23-03-2020 a las 09:40:55
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
-- Estructura de tabla para la tabla `tbl_account_bank`
--

CREATE TABLE `tbl_account_bank` (
  `id_account_bank` int(11) NOT NULL,
  `titular_account` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `rut_account` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `bank_account` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `type_account` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `number_account` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `email_account` varchar(255) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `tbl_account_bank`
--

INSERT INTO `tbl_account_bank` (`id_account_bank`, `titular_account`, `rut_account`, `bank_account`, `type_account`, `number_account`, `email_account`) VALUES
(2, 'Gestarriendo', '18.921.578-9', 'BANCO FALABELLA', 'Cuenta Corriente', '4047123456', 'mail@confirmacion.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_bank_system`
--

CREATE TABLE `tbl_bank_system` (
  `id_bank_system` int(11) NOT NULL,
  `name_bank` varchar(255) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `tbl_bank_system`
--

INSERT INTO `tbl_bank_system` (`id_bank_system`, `name_bank`) VALUES
(1, 'BANCO ESTADO'),
(2, 'BANCO DE CHILE'),
(3, 'BANCO INTERNACIONAL'),
(4, 'BANCO SCOTIABANK CHILE'),
(5, 'BANCO DE CRÉDITO E INVERSIONES'),
(6, 'BANCO BICE'),
(7, 'BANCO HSBC BANK'),
(8, 'BANCO SANTANDER'),
(9, 'BANCO ITAÚ-CORPBANCA'),
(10, 'BANCO SECURITY'),
(11, 'BANCO FALABELLA'),
(12, 'BANCO RIPLEY'),
(13, 'BANCO CONSORCIO'),
(14, 'BANCO SCOTIABANK AZUL (ex BBVA)'),
(15, 'BANCO BTG PACTUAL CHILE');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_comunas_system`
--

CREATE TABLE `tbl_comunas_system` (
  `id_comunas` int(10) UNSIGNED NOT NULL,
  `name_comuna` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `region_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `tbl_comunas_system`
--

INSERT INTO `tbl_comunas_system` (`id_comunas`, `name_comuna`, `region_id`) VALUES
(1, 'Arica', 1),
(2, 'Camarones', 1),
(3, 'General Lagos', 1),
(4, 'Putre', 1),
(5, 'Alto Hospicio', 2),
(6, 'Iquique', 2),
(7, 'Camiña', 2),
(8, 'Colchane', 2),
(9, 'Huara', 2),
(10, 'Pica', 2),
(11, 'Pozo Almonte', 2),
(12, 'Antofagasta', 3),
(13, 'Mejillones', 3),
(14, 'Sierra Gorda', 3),
(15, 'Taltal', 3),
(16, 'Calama', 3),
(17, 'Ollague', 3),
(18, 'San Pedro de Atacama', 3),
(19, 'María Elena', 3),
(20, 'Tocopilla', 3),
(21, 'Chañaral', 4),
(22, 'Diego de Almagro', 4),
(23, 'Caldera', 4),
(24, 'Copiapó', 4),
(25, 'Tierra Amarilla', 4),
(26, 'Alto del Carmen', 4),
(27, 'Freirina', 4),
(28, 'Huasco', 4),
(29, 'Vallenar', 4),
(30, 'Canela', 5),
(31, 'Illapel', 5),
(32, 'Los Vilos', 5),
(33, 'Salamanca', 5),
(34, 'Andacollo', 5),
(35, 'Coquimbo', 5),
(36, 'La Higuera', 5),
(37, 'La Serena', 5),
(38, 'Paihuaco', 5),
(39, 'Vicuña', 5),
(40, 'Combarbalá', 5),
(41, 'Monte Patria', 5),
(42, 'Ovalle', 5),
(43, 'Punitaqui', 5),
(44, 'Río Hurtado', 5),
(45, 'Isla de Pascua', 6),
(46, 'Calle Larga', 6),
(47, 'Los Andes', 6),
(48, 'Rinconada', 6),
(49, 'San Esteban', 6),
(50, 'La Ligua', 6),
(51, 'Papudo', 6),
(52, 'Petorca', 6),
(53, 'Zapallar', 6),
(54, 'Hijuelas', 6),
(55, 'La Calera', 6),
(56, 'La Cruz', 6),
(57, 'Limache', 6),
(58, 'Nogales', 6),
(59, 'Olmué', 6),
(60, 'Quillota', 6),
(61, 'Algarrobo', 6),
(62, 'Cartagena', 6),
(63, 'El Quisco', 6),
(64, 'El Tabo', 6),
(65, 'San Antonio', 6),
(66, 'Santo Domingo', 6),
(67, 'Catemu', 6),
(68, 'Llaillay', 6),
(69, 'Panquehue', 6),
(70, 'Putaendo', 6),
(71, 'San Felipe', 6),
(72, 'Santa María', 6),
(73, 'Casablanca', 6),
(74, 'Concón', 6),
(75, 'Juan Fernández', 6),
(76, 'Puchuncaví', 6),
(77, 'Quilpué', 6),
(78, 'Quintero', 6),
(79, 'Valparaíso', 6),
(80, 'Villa Alemana', 6),
(81, 'Viña del Mar', 6),
(82, 'Colina', 7),
(83, 'Lampa', 7),
(84, 'Tiltil', 7),
(85, 'Pirque', 7),
(86, 'Puente Alto', 7),
(87, 'San José de Maipo', 7),
(88, 'Buin', 7),
(89, 'Calera de Tango', 7),
(90, 'Paine', 7),
(91, 'San Bernardo', 7),
(92, 'Alhué', 7),
(93, 'Curacaví', 7),
(94, 'María Pinto', 7),
(95, 'Melipilla', 7),
(96, 'San Pedro', 7),
(97, 'Cerrillos', 7),
(98, 'Cerro Navia', 7),
(99, 'Conchalí', 7),
(100, 'El Bosque', 7),
(101, 'Estación Central', 7),
(102, 'Huechuraba', 7),
(103, 'Independencia', 7),
(104, 'La Cisterna', 7),
(105, 'La Granja', 7),
(106, 'La Florida', 7),
(107, 'La Pintana', 7),
(108, 'La Reina', 7),
(109, 'Las Condes', 7),
(110, 'Lo Barnechea', 7),
(111, 'Lo Espejo', 7),
(112, 'Lo Prado', 7),
(113, 'Macul', 7),
(114, 'Maipú', 7),
(115, 'Ñuñoa', 7),
(116, 'Pedro Aguirre Cerda', 7),
(117, 'Peñalolén', 7),
(118, 'Providencia', 7),
(119, 'Pudahuel', 7),
(120, 'Quilicura', 7),
(121, 'Quinta Normal', 7),
(122, 'Recoleta', 7),
(123, 'Renca', 7),
(124, 'San Miguel', 7),
(125, 'San Joaquín', 7),
(126, 'San Ramón', 7),
(127, 'Santiago', 7),
(128, 'Vitacura', 7),
(129, 'El Monte', 7),
(130, 'Isla de Maipo', 7),
(131, 'Padre Hurtado', 7),
(132, 'Peñaflor', 7),
(133, 'Talagante', 7),
(134, 'Codegua', 8),
(135, 'Coínco', 8),
(136, 'Coltauco', 8),
(137, 'Doñihue', 8),
(138, 'Graneros', 8),
(139, 'Las Cabras', 8),
(140, 'Machalí', 8),
(141, 'Malloa', 8),
(142, 'Mostazal', 8),
(143, 'Olivar', 8),
(144, 'Peumo', 8),
(145, 'Pichidegua', 8),
(146, 'Quinta de Tilcoco', 8),
(147, 'Rancagua', 8),
(148, 'Rengo', 8),
(149, 'Requínoa', 8),
(150, 'San Vicente de Tagua Tagua', 8),
(151, 'La Estrella', 8),
(152, 'Litueche', 8),
(153, 'Marchihue', 8),
(154, 'Navidad', 8),
(155, 'Peredones', 8),
(156, 'Pichilemu', 8),
(157, 'Chépica', 8),
(158, 'Chimbarongo', 8),
(159, 'Lolol', 8),
(160, 'Nancagua', 8),
(161, 'Palmilla', 8),
(162, 'Peralillo', 8),
(163, 'Placilla', 8),
(164, 'Pumanque', 8),
(165, 'San Fernando', 8),
(166, 'Santa Cruz', 8),
(167, 'Cauquenes', 9),
(168, 'Chanco', 9),
(169, 'Pelluhue', 9),
(170, 'Curicó', 9),
(171, 'Hualañé', 9),
(172, 'Licantén', 9),
(173, 'Molina', 9),
(174, 'Rauco', 9),
(175, 'Romeral', 9),
(176, 'Sagrada Familia', 9),
(177, 'Teno', 9),
(178, 'Vichuquén', 9),
(179, 'Colbún', 9),
(180, 'Linares', 9),
(181, 'Longaví', 9),
(182, 'Parral', 9),
(183, 'Retiro', 9),
(184, 'San Javier', 9),
(185, 'Villa Alegre', 9),
(186, 'Yerbas Buenas', 9),
(187, 'Constitución', 9),
(188, 'Curepto', 9),
(189, 'Empedrado', 9),
(190, 'Maule', 9),
(191, 'Pelarco', 9),
(192, 'Pencahue', 9),
(193, 'Río Claro', 9),
(194, 'San Clemente', 9),
(195, 'San Rafael', 9),
(196, 'Talca', 9),
(197, 'Bulnes', 10),
(198, 'Chillán', 10),
(199, 'Chillán Viejo', 10),
(200, 'Cobquecura', 10),
(201, 'Coelemu', 10),
(202, 'Coihueco', 10),
(203, 'El Carmen', 10),
(204, 'Ninhue', 10),
(205, 'Ñiquen', 10),
(206, 'Pemuco', 10),
(207, 'Pinto', 10),
(208, 'Portezuelo', 10),
(209, 'Quirihue', 10),
(210, 'Ránquil', 10),
(211, 'Treguaco', 10),
(212, 'Quillón', 10),
(213, 'San Carlos', 10),
(214, 'San Fabián', 10),
(215, 'San Ignacio', 10),
(216, 'San Nicolás', 10),
(217, 'Yungay', 10),
(218, 'Arauco', 11),
(219, 'Cañete', 11),
(220, 'Contulmo', 11),
(221, 'Curanilahue', 11),
(222, 'Lebu', 11),
(223, 'Los Álamos', 11),
(224, 'Tirúa', 11),
(225, 'Alto Biobío', 11),
(226, 'Antuco', 11),
(227, 'Cabrero', 11),
(228, 'Laja', 11),
(229, 'Los Ángeles', 11),
(230, 'Mulchén', 11),
(231, 'Nacimiento', 11),
(232, 'Negrete', 11),
(233, 'Quilaco', 11),
(234, 'Quilleco', 11),
(235, 'San Rosendo', 11),
(236, 'Santa Bárbara', 11),
(237, 'Tucapel', 11),
(238, 'Yumbel', 11),
(239, 'Chiguayante', 11),
(240, 'Concepción', 11),
(241, 'Coronel', 11),
(242, 'Florida', 11),
(243, 'Hualpén', 11),
(244, 'Hualqui', 11),
(245, 'Lota', 11),
(246, 'Penco', 11),
(247, 'San Pedro de La Paz', 11),
(248, 'Santa Juana', 11),
(249, 'Talcahuano', 11),
(250, 'Tomé', 11),
(251, 'Carahue', 12),
(252, 'Cholchol', 12),
(253, 'Cunco', 12),
(254, 'Curarrehue', 12),
(255, 'Freire', 12),
(256, 'Galvarino', 12),
(257, 'Gorbea', 12),
(258, 'Lautaro', 12),
(259, 'Loncoche', 12),
(260, 'Melipeuco', 12),
(261, 'Nueva Imperial', 12),
(262, 'Padre Las Casas', 12),
(263, 'Perquenco', 12),
(264, 'Pitrufquén', 12),
(265, 'Pucón', 12),
(266, 'Saavedra', 12),
(267, 'Temuco', 12),
(268, 'Teodoro Schmidt', 12),
(269, 'Toltén', 12),
(270, 'Vilcún', 12),
(271, 'Villarrica', 12),
(272, 'Angol', 12),
(273, 'Collipulli', 12),
(274, 'Curacautín', 12),
(275, 'Ercilla', 12),
(276, 'Lonquimay', 12),
(277, 'Los Sauces', 12),
(278, 'Lumaco', 12),
(279, 'Purén', 12),
(280, 'Renaico', 12),
(281, 'Traiguén', 12),
(282, 'Victoria', 12),
(283, 'Corral', 13),
(284, 'Lanco', 13),
(285, 'Los Lagos', 13),
(286, 'Máfil', 13),
(287, 'Mariquina', 13),
(288, 'Paillaco', 13),
(289, 'Panguipulli', 13),
(290, 'Valdivia', 13),
(291, 'Futrono', 13),
(292, 'La Unión', 13),
(293, 'Lago Ranco', 13),
(294, 'Río Bueno', 13),
(295, 'Ancud', 14),
(296, 'Castro', 14),
(297, 'Chonchi', 14),
(298, 'Curaco de Vélez', 14),
(299, 'Dalcahue', 14),
(300, 'Puqueldón', 14),
(301, 'Queilén', 14),
(302, 'Quemchi', 14),
(303, 'Quellón', 14),
(304, 'Quinchao', 14),
(305, 'Calbuco', 14),
(306, 'Cochamó', 14),
(307, 'Fresia', 14),
(308, 'Frutillar', 14),
(309, 'Llanquihue', 14),
(310, 'Los Muermos', 14),
(311, 'Maullín', 14),
(312, 'Puerto Montt', 14),
(313, 'Puerto Varas', 14),
(314, 'Osorno', 14),
(315, 'Puero Octay', 14),
(316, 'Purranque', 14),
(317, 'Puyehue', 14),
(318, 'Río Negro', 14),
(319, 'San Juan de la Costa', 14),
(320, 'San Pablo', 14),
(321, 'Chaitén', 14),
(322, 'Futaleufú', 14),
(323, 'Hualaihué', 14),
(324, 'Palena', 14),
(325, 'Aisén', 15),
(326, 'Cisnes', 15),
(327, 'Guaitecas', 15),
(328, 'Cochrane', 15),
(329, 'O\'higgins', 15),
(330, 'Tortel', 15),
(331, 'Coihaique', 15),
(332, 'Lago Verde', 15),
(333, 'Chile Chico', 15),
(334, 'Río Ibáñez', 15),
(335, 'Antártica', 16),
(336, 'Cabo de Hornos', 16),
(337, 'Laguna Blanca', 16),
(338, 'Punta Arenas', 16),
(339, 'Río Verde', 16),
(340, 'San Gregorio', 16),
(341, 'Porvenir', 16),
(342, 'Primavera', 16),
(343, 'Timaukel', 16),
(344, 'Natales', 16),
(345, 'Torres del Paine', 16),
(346, 'Cabildo', 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_leaser_system`
--

CREATE TABLE `tbl_leaser_system` (
  `id_leaser_system` int(11) NOT NULL,
  `agent_designated` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `date_register` date NOT NULL,
  `name_leaser` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `rut_leaser` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `email_leaser` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `phone_one_leaser` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `phone_two_leaser` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `last_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `tbl_leaser_system`
--

INSERT INTO `tbl_leaser_system` (`id_leaser_system`, `agent_designated`, `date_register`, `name_leaser`, `rut_leaser`, `email_leaser`, `phone_one_leaser`, `phone_two_leaser`, `last_date`) VALUES
(4, 'Nombre Agente', '2020-03-23', 'Camila Cerda Alegria', '18.680.623-9', 'cmissgreen@gmail.com', '948850131', '948992070', '2020-03-23');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_owner_system`
--

CREATE TABLE `tbl_owner_system` (
  `id_owner_system` int(11) NOT NULL,
  `agent_designated` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `date_register` date NOT NULL,
  `name_owner` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `rut_owner` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `email_owner` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `phone_owner` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `last_date` date NOT NULL,
  `titular_account` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `rut_account` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `bank_account` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `type_account` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `number_account` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `email_account` varchar(255) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `tbl_owner_system`
--

INSERT INTO `tbl_owner_system` (`id_owner_system`, `agent_designated`, `date_register`, `name_owner`, `rut_owner`, `email_owner`, `phone_owner`, `last_date`, `titular_account`, `rut_account`, `bank_account`, `type_account`, `number_account`, `email_account`) VALUES
(8, 'Nombre Agente', '2020-03-22', 'Paz Piraino Fuentes', '12.345.678-9', 'mail@cuentacorreo.cl', '948992070', '2020-03-22', 'Jesus Caballero Peralta', '18.827.816-7', 'BANCO DE CHILE', 'Cuenta de Ahorro', '4047123456', 'uebeats@gmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_property_system`
--

CREATE TABLE `tbl_property_system` (
  `id_property` int(11) NOT NULL,
  `agent_designated` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `date_register` date NOT NULL,
  `type_property` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `address_property` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `region_property` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `comuna_property` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `n_client_agua` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `n_client_luz` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `n_client_gas` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `last_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `tbl_property_system`
--

INSERT INTO `tbl_property_system` (`id_property`, `agent_designated`, `date_register`, `type_property`, `address_property`, `region_property`, `comuna_property`, `n_client_agua`, `n_client_luz`, `n_client_gas`, `last_date`) VALUES
(1, 'Nombre Agente', '2020-03-18', 'Casa', 'Calle Sin Salida #123', 'Región de La Araucanía', 'Perquenco', '12345', '54321', '67890', '2020-03-23');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_regiones_system`
--

CREATE TABLE `tbl_regiones_system` (
  `id_region` int(10) UNSIGNED NOT NULL,
  `name_region` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ordinal_symbol` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `tbl_regiones_system`
--

INSERT INTO `tbl_regiones_system` (`id_region`, `name_region`, `ordinal_symbol`, `order`) VALUES
(1, 'Región de Arica y Parinacota', 'XV', 1),
(2, 'Región de Tarapacá', 'I', 2),
(3, 'Región de Antofagasta', 'II', 3),
(4, 'Región de Atacama', 'III', 4),
(5, 'Región de Coquimbo', 'IV', 5),
(6, 'Región de Valparaiso', 'V', 6),
(7, 'Metropolitana de Santiago', 'RM', 7),
(8, 'Región de O\'Higgins', 'VI', 8),
(9, 'Región de Maule', 'VII', 9),
(10, 'Región de Ñuble', 'XVI', 10),
(11, 'Región del  Biobío', 'VIII', 11),
(12, 'Región de La Araucanía', 'IX', 12),
(13, 'Región de Los Ríos', 'XIV', 13),
(14, 'Región de Los Lagos', 'X', 14),
(15, 'Región Carlos I. del Campo', 'XI', 15),
(16, 'Magallanes y de la A. Chilena', 'XII', 16);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_type_bank`
--

CREATE TABLE `tbl_type_bank` (
  `id_type_bank` int(11) NOT NULL,
  `type_bank` varchar(50) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `tbl_type_bank`
--

INSERT INTO `tbl_type_bank` (`id_type_bank`, `type_bank`) VALUES
(1, 'Cuenta Corriente'),
(2, 'Cuenta Vista'),
(3, 'Chequera Electrónica'),
(4, 'Cuenta de Ahorro');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_users_system`
--

CREATE TABLE `tbl_users_system` (
  `id_user_system` int(11) NOT NULL,
  `user_system` varchar(60) COLLATE utf8_spanish2_ci NOT NULL,
  `pass_system` varchar(256) COLLATE utf8_spanish2_ci NOT NULL,
  `name_user_system` varchar(60) COLLATE utf8_spanish2_ci NOT NULL,
  `depto_user` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `type_user` varchar(60) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `tbl_users_system`
--

INSERT INTO `tbl_users_system` (`id_user_system`, `user_system`, `pass_system`, `name_user_system`, `depto_user`, `type_user`) VALUES
(1, 'admin', 'd74ff0ee8da3b9806b18c877dbf29bbde50b5bd8e4dad7a3a725000feb82e8f1', 'Nombre Agente', 'administrativo', ''),
(5, 'gestarriendos', 'fd81a19c5f1cbc4b5a7324f03fc09a09bd4ac4dddee63982c861e55a53217b43', 'Daniel Plaza', 'administrativo', '');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tbl_account_bank`
--
ALTER TABLE `tbl_account_bank`
  ADD PRIMARY KEY (`id_account_bank`);

--
-- Indices de la tabla `tbl_bank_system`
--
ALTER TABLE `tbl_bank_system`
  ADD PRIMARY KEY (`id_bank_system`);

--
-- Indices de la tabla `tbl_comunas_system`
--
ALTER TABLE `tbl_comunas_system`
  ADD PRIMARY KEY (`id_comunas`),
  ADD KEY `communes_region_id_foreign` (`region_id`);

--
-- Indices de la tabla `tbl_leaser_system`
--
ALTER TABLE `tbl_leaser_system`
  ADD PRIMARY KEY (`id_leaser_system`);

--
-- Indices de la tabla `tbl_owner_system`
--
ALTER TABLE `tbl_owner_system`
  ADD PRIMARY KEY (`id_owner_system`);

--
-- Indices de la tabla `tbl_property_system`
--
ALTER TABLE `tbl_property_system`
  ADD PRIMARY KEY (`id_property`);

--
-- Indices de la tabla `tbl_regiones_system`
--
ALTER TABLE `tbl_regiones_system`
  ADD PRIMARY KEY (`id_region`);

--
-- Indices de la tabla `tbl_type_bank`
--
ALTER TABLE `tbl_type_bank`
  ADD PRIMARY KEY (`id_type_bank`);

--
-- Indices de la tabla `tbl_users_system`
--
ALTER TABLE `tbl_users_system`
  ADD PRIMARY KEY (`id_user_system`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tbl_account_bank`
--
ALTER TABLE `tbl_account_bank`
  MODIFY `id_account_bank` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tbl_bank_system`
--
ALTER TABLE `tbl_bank_system`
  MODIFY `id_bank_system` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `tbl_comunas_system`
--
ALTER TABLE `tbl_comunas_system`
  MODIFY `id_comunas` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=347;

--
-- AUTO_INCREMENT de la tabla `tbl_leaser_system`
--
ALTER TABLE `tbl_leaser_system`
  MODIFY `id_leaser_system` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `tbl_owner_system`
--
ALTER TABLE `tbl_owner_system`
  MODIFY `id_owner_system` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `tbl_property_system`
--
ALTER TABLE `tbl_property_system`
  MODIFY `id_property` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `tbl_regiones_system`
--
ALTER TABLE `tbl_regiones_system`
  MODIFY `id_region` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `tbl_type_bank`
--
ALTER TABLE `tbl_type_bank`
  MODIFY `id_type_bank` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `tbl_users_system`
--
ALTER TABLE `tbl_users_system`
  MODIFY `id_user_system` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `tbl_comunas_system`
--
ALTER TABLE `tbl_comunas_system`
  ADD CONSTRAINT `communes_region_id_foreign` FOREIGN KEY (`region_id`) REFERENCES `tbl_regiones_system` (`id_region`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
