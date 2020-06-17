ALTER TABLE `tbl_property_system` ADD `hasParking` VARCHAR(1) NOT NULL AFTER `last_date`;
ALTER TABLE `tbl_property_system` ADD `numberParking` INT NOT NULL AFTER `hasParking`;
ALTER TABLE `tbl_property_system` ADD `hasWarehouse` VARCHAR(1) NOT NULL AFTER `numberParking`;
ALTER TABLE `tbl_property_system` ADD `numberWarehouse` INT NOT NULL AFTER `hasWarehouse`;
ALTER TABLE `tbl_property_system` CHANGE `hasParking` `hasParking` VARCHAR(1) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL DEFAULT 'N';
ALTER TABLE `tbl_property_system` CHANGE `hasWarehouse` `hasWarehouse` VARCHAR(1) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL DEFAULT 'N';
ALTER TABLE `tbl_property_system` CHANGE `numberParking` `numberParking` INT(11) NULL;
ALTER TABLE `tbl_property_system` CHANGE `numberWarehouse` `numberWarehouse` INT(11) NULL;