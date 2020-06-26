CREATE TABLE `tbl_concepto_gasto` (
  `id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

CREATE TABLE `tbl_gastos` (
  `id` int(11) NOT NULL,
  `documentno` varchar(30) COLLATE utf8_spanish2_ci NOT NULL,
  `charge_to` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `concepto_gasto_id` int(11) NOT NULL,
  `amount` float NOT NULL,
  `description` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `url_file_doc` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `contrato_id` int(11) NOT NULL,
  `created_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

ALTER TABLE `tbl_concepto_gasto`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `tbl_gastos`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `tbl_concepto_gasto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `tbl_gastos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;