ALTER TABLE `product_master` ADD `status` ENUM('A','IA','D') NOT NULL COMMENT '\'A\' - Active, \'IA\'-Inactive,\'D\' -Delete' AFTER `price`;

INSERT INTO `farmer_master` (`farmer_id`, `company_id`, `farmer_code`, `farmer_name`, `farmer_address`, `farmer_city`, `farmer_district`, `farmer_state`, `farmer_country`, `status`) VALUES (NULL, '1', 'fc8596', 'Saro', 'No,22, mugalivakkam', 'chennai', 'chennai', 'tamil Nadu', 'India', 'A');

INSERT INTO `customer_master` (`customer_id`, `company_id`, `customer_code`, `customer_name`, `customer_email`, `customer_address`, `customer_city`, `customer_district`, `customer_state`, `customer_country`, `bank_account_number`, `bank_ifsc_code`, `phone_number`, `status`) VALUES ('', '1', 'VEN123', 'Venkat', 'venkat@gmail.com', 'No,22, west Street', 'Chennai', 'Chennai', 'Tamil Nadu', 'India', '61528656655541', 'INB23455', '95986858', 'A');

ALTER TABLE `customer_master` CHANGE `customer_id` `customer_id` INT(11) NOT NULL AUTO_INCREMENT;


