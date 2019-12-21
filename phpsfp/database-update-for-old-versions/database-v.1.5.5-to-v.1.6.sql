ALTER TABLE `cronjobs` ADD INDEX(`id_post`);
ALTER TABLE `cronjobs` ADD INDEX(`id_wall`);
ALTER TABLE `error_log` ADD INDEX(`id_cron`);
ALTER TABLE `groups` ADD INDEX(`id_user`);
ALTER TABLE `groups` ADD INDEX(`user_id`);
ALTER TABLE `groups_data` ADD INDEX(`id_user`);
ALTER TABLE `groups_data` ADD INDEX(`id_wall`);
ALTER TABLE `posts` ADD INDEX(`id_users`);
ALTER TABLE `posts` ADD INDEX(`user_id`);
ALTER TABLE `recover_password` ADD INDEX(`id_user`);
ALTER TABLE `settings` ADD INDEX(`id_user`);

ALTER TABLE `settings` ADD `app_default` ENUM('0','1') NOT NULL DEFAULT '1' AFTER `app_valid`;
ALTER TABLE `users` ADD `fb_id` BIGINT(25) NOT NULL AFTER `fb_user_id`;
ALTER TABLE `posts` ADD `type` SMALLINT( 5 ) NOT NULL DEFAULT '2' AFTER `access_token`;
ALTER TABLE `posts` ADD `timestamp_pause` VARCHAR( 30 ) NOT NULL AFTER `timestamp_repeat`;
ALTER TABLE `posts` CHANGE `message` `message` LONGBLOB NOT NULL;
ALTER TABLE `posts` CHANGE `name` `name` LONGBLOB NOT NULL;
ALTER TABLE `posts` CHANGE `description` `description` LONGBLOB NOT NULL;
ALTER TABLE `posts` ADD `delete` ENUM( '0', '1' ) NOT NULL DEFAULT '0' AFTER `status`;

CREATE TABLE IF NOT EXISTS `fbdata` (
  `user_id` bigint(10) NOT NULL,
  `data` longblob NOT NULL,
  UNIQUE KEY `user_id` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `settings_general` (
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `app_id` text NOT NULL,
  `app_secret` text NOT NULL,
  `app_token` text NOT NULL,
  `app_valid` enum('0','1') NOT NULL DEFAULT '0',
  `pages_limit` int(10) NOT NULL,
  `groups_limit` int(10) NOT NULL,
  `retry_limit` int(11) NOT NULL,
  `track_clicks` enum('0','1') NOT NULL DEFAULT '0',
  `post_admin` enum('0','1') NOT NULL DEFAULT '0',
  `role_auto` enum('0','1') NOT NULL DEFAULT '1',
  `upload_limit` smallint(5) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `settings_general`
--

INSERT INTO `settings_general` (`id`, `app_id`, `app_secret`, `app_token`, `app_valid`, `pages_limit`, `groups_limit`, `retry_limit`, `track_clicks`, `post_admin`, `role_auto`, `upload_limit`) VALUES (1, '', '', '', '0', 5000, 5000, 5, '0', '0', '1', 4);