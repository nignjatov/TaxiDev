
CREATE TABLE IF NOT EXISTS `wp_payment_history` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `subscription_id` int(11) NOT NULL,
  `stripe_id` varchar(64) NOT NULL,
  `payment_date` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `discount` int(11) NOT NULL,
  `currency` varchar(10) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;


CREATE TABLE IF NOT EXISTS `wp_user_subscription` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `subscription_id` int(11) NOT NULL,
  `activation_date` int(11) NOT NULL,
  `end_date` int(11) NOT NULL,
  `stripe_subscription_id` varchar(64) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

ALTER TABLE `wp_server_users` ADD `stripe_id` VARCHAR( 64 ) NULL AFTER `user_type` ;

ALTER TABLE `wp_taxi_ads` ADD `is_active` BOOLEAN NOT NULL DEFAULT TRUE ;

ALTER TABLE `wp_driver_ads` ADD `is_active` BOOLEAN NOT NULL DEFAULT TRUE ;