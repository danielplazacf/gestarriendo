
CREATE TABLE `tbl_ipc_config` (
  `id` int(11) NOT NULL,
  `id_contrato` int(11) NOT NULL,
  `recurrencia` int(11) NOT NULL,
  `fecha_inicio` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

ALTER TABLE `tbl_ipc_config`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `tbl_ipc_config`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;
