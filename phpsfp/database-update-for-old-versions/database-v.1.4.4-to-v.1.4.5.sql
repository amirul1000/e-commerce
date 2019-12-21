ALTER TABLE `settings` ADD `id_user` INT(10) NOT NULL AFTER `id`;
ALTER TABLE `settings` CHANGE `id` `id` INT(10) NOT NULL AUTO_INCREMENT;
UPDATE `settings` SET `id_user` = '1' WHERE `id` = 1;