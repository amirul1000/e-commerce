ALTER TABLE `users` CHANGE `gmt_zone` `gmt_zone` VARCHAR( 255 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'Europe/London';
UPDATE `users` SET `gmt_zone` = 'Europe/London';

CREATE TABLE IF NOT EXISTS `groups` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `id_user` int(10) NOT NULL,
  `user_id` bigint(10) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `access_token` text NOT NULL,
  `name` varchar(255) NOT NULL,
  `timestamp` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS `groups_data` (
  `id_group` int(10) NOT NULL,
  `id_user` int(10) NOT NULL,
  `id_wall` bigint(10) NOT NULL,
  `page_access_token` text NOT NULL,
  `name` varchar(255) NOT NULL,
  `type` enum('1','2','3') NOT NULL,
  KEY `id_group` (`id_group`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;