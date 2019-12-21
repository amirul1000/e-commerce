ALTER TABLE `posts` ADD `interval` int(10) NOT NULL AFTER `status`;
ALTER TABLE `posts` ADD `timestamp_repeat` VARCHAR(30) NOT NULL AFTER `timestamp`;