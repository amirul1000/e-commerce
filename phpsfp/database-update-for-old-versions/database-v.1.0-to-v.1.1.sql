ALTER TABLE `cronjobs` ADD `retry` SMALLINT( 3 ) NOT NULL AFTER `error_log`;
ALTER TABLE `settings` ADD `pages_limit` INT( 10 ) NOT NULL AFTER `app_valid`, 
ADD `groups_limit` INT( 10 ) NOT NULL AFTER `pages_limit`, 
ADD `retry_limit` INT( 10 ) NOT NULL AFTER `groups_limit`;
ALTER TABLE `users` ADD `fb_user_id` BIGINT( 25 ) NOT NULL AFTER `username`;