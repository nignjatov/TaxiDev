CREATE TABLE IF NOT EXISTS `wp_user_detail` (
  `user_id` int(11) NOT NULL,
  `mobile_1` varchar(20) DEFAULT NULL,
  `mobile_2` varchar(20) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `fax` varchar(20) DEFAULT NULL,
  `street_number` varchar(20) DEFAULT NULL,
  `street_name` varchar(50) DEFAULT NULL,
  `suburb` varchar(20) DEFAULT NULL,
  `postcode` varchar(10) DEFAULT NULL,
  `state` varchar(40) DEFAULT NULL,
  `comment` TEXT NULL,
  UNIQUE KEY `wud_user_id` (`user_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 ;

ALTER TABLE `wp_drivers` CHANGE `UID` `user_id` INT(11) NOT NULL;

ALTER TABLE `wp_drivers` ADD `is_active` BOOLEAN NOT NULL DEFAULT TRUE ;

insert into `wp_user_detail` (select `user_id`, `mobile_1`, `mobile_2`, `phone`, `fax`, `street_number`, `street_name`, `suburb`, `postcode`, `state` from `wp_operators`);
insert into `wp_user_detail` (select `user_id`, `mobile_1`, `mobile_2`, `phone`, `fax`, `street_number`, `street_name`, `suburb`, `postcode`, `state` from `wp_drivers`);

ALTER TABLE `wp_drivers`
  DROP `mobile_1`,
  DROP `mobile_2`,
  DROP `phone`,
  DROP `fax`,
  DROP `street_number`,
  DROP `street_name`,
  DROP `suburb`,
  DROP `postcode`,
  DROP `state`;

ALTER TABLE `wp_operators`
  DROP `mobile_1`,
  DROP `mobile_2`,
  DROP `phone`,
  DROP `fax`,
  DROP `street_number`,
  DROP `street_name`,
  DROP `suburb`,
  DROP `postcode`,
  DROP `state`;