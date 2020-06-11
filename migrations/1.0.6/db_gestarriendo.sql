ALTER TABLE `tbl_property_system` ADD `proveedor_agua` VARCHAR(150) NOT NULL AFTER `n_client_agua`;
ALTER TABLE `tbl_property_system` ADD `proveedor_luz` VARCHAR(150) NOT NULL AFTER `n_client_luz`;
ALTER TABLE `tbl_property_system` ADD `proveedor_gas` VARCHAR(150) NOT NULL AFTER `n_client_gas`;