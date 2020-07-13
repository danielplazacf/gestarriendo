CREATE TABLE `tbl_abonos` (
  `id` int(11) NOT NULL,
  `tipo` enum('pago','cobro') COLLATE utf8_spanish2_ci NOT NULL,
  `descripcion` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `monto` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

ALTER TABLE `tbl_abonos`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `tbl_abonos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

ALTER TABLE `tbl_abonos` ADD `fecha` DATE NOT NULL AFTER `monto`;
ALTER TABLE `tbl_abonos` ADD `id_element` INT NOT NULL AFTER `fecha`;