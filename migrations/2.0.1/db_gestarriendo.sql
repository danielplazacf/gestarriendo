ALTER TABLE `tbl_pagos_property` CHANGE `estatus` `estatus` ENUM('pendiente','vencido','pagado','cancelado') CHARACTER SET utf8 COLLATE utf8_spanish2_ci NULL DEFAULT NULL;
ALTER TABLE `tbl_cobros_property` ADD `estatus` ENUM('pendiente','pagado','vencido','cancelado') NULL AFTER `venc_csimple`, ADD `unique_id` VARCHAR(8) NULL AFTER `estatus`;
ALTER TABLE `tbl_cobros_property` CHANGE `agent_designated` `agent_designated` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NULL;
ALTER TABLE `tbl_cobros_property` CHANGE `venc_csimple` `venc_csimple` INT(2) NULL;