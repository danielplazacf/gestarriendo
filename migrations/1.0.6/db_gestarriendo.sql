ALTER TABLE `tbl_property_system` ADD `proveedor_agua` VARCHAR(150) NOT NULL AFTER `n_client_agua`;
ALTER TABLE `tbl_property_system` ADD `proveedor_luz` VARCHAR(150) NOT NULL AFTER `n_client_luz`;
ALTER TABLE `tbl_property_system` ADD `proveedor_gas` VARCHAR(150) NOT NULL AFTER `n_client_gas`;
UPDATE `tbl_users_system` SET `type_user` = 'administrador' WHERE `tbl_users_system`.`id_user_system` = 1;
UPDATE `tbl_users_system` SET `type_user` = 'administrador' WHERE `tbl_users_system`.`id_user_system` = 5;
UPDATE `tbl_users_system` SET `type_user` = 'administrador' WHERE `tbl_users_system`.`id_user_system` = 8;
INSERT INTO `tbl_users_system` (`id_user_system`, `user_system`, `pass_system`, `name_user_system`, `depto_user`, `type_user`) VALUES (NULL, 'observador', '5e884898da28047151d0e56f8dc6292773603d0d6aabbdd62a11ef721d1542d8', 'observador', 'administrativo', 'observador');