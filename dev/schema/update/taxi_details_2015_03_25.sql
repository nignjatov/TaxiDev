ALTER TABLE `wp_taxi_details`
ADD `plate_fee` INT NOT NULL DEFAULT '0' AFTER `kilometres`,
ADD `network_fee` INT NOT NULL DEFAULT '0' AFTER `plate_fee`,
ADD `insurance_fee` INT NOT NULL DEFAULT '0' AFTER `network_fee`,
ADD `car_finance_fee` INT NOT NULL DEFAULT '0' AFTER `insurance_fee`,
ADD `registration_fee` INT NOT NULL DEFAULT '0' AFTER `car_finance_fee`;