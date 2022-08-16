ALTER TABLE `tbl_pagos_property` ADD `bankaccount` INT NOT NULL AFTER `venc_csimple`;
ALTER TABLE `tbl_pagos_property` ADD `estatus` ENUM('pendiente','vencido','pagado','') NOT NULL AFTER `bankaccount`;
ALTER TABLE `tbl_pagos_property` CHANGE `estatus` `estatus` ENUM('pendiente','vencido','pagado','') CHARACTER SET utf8 COLLATE utf8_spanish2_ci NULL DEFAULT NULL;
ALTER TABLE `tbl_pagos_property` ADD `unique_id` VARCHAR(8) NOT NULL AFTER `estatus`;
ALTER TABLE `tbl_pagos_property` CHANGE `agent_designated` `agent_designated` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NULL;
ALTER TABLE `tbl_pagos_property` CHANGE `venc_csimple` `venc_csimple` INT(2) NULL;
ALTER TABLE `tbl_pagos_property` CHANGE `bankaccount` `bankaccount` INT(11) NULL;
ALTER TABLE `tbl_pagos_property` CHANGE `unique_id` `unique_id` VARCHAR(8) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL DEFAULT '0';