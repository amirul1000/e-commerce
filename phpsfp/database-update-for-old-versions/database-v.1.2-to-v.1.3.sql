ALTER TABLE `error_log` ADD `id_cron` INT( 10 ) NOT NULL AFTER `id` ;
ALTER TABLE `settings` ADD `post_admin` ENUM( '0', '1' ) NOT NULL DEFAULT '0' AFTER `retry_limit` ;