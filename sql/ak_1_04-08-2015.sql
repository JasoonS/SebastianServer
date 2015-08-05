ALTER TABLE `sb_hotel_child_services` ADD `is_service` ENUM('1','0') NOT NULL DEFAULT '1' ;

CREATE TABLE IF NOT EXISTS `sb_sub_child_services` (
`sub_child_services_id` int(11) NOT NULL,
  `sb_child_service_id` int(11) NOT NULL COMMENT 'FK (sb_hotel_child_services)',
  `sb_sub_child_service_name` varchar(250) NOT NULL,
  `sb_sub_child_service_image` varchar(250) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `sb_sub_child_services`
--
ALTER TABLE `sb_sub_child_services`
 ADD PRIMARY KEY (`sub_child_services_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `sb_sub_child_services`
--
ALTER TABLE `sb_sub_child_services`
MODIFY `sub_child_services_id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `sb_sub_child_services` ENGINE = MyISAM DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;

ALTER TABLE `sb_sub_child_services` ADD `sb_sub_child_service_details` VARCHAR(255) NOT NULL AFTER `sb_sub_child_service_name`;