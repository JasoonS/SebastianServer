ALTER TABLE `sb_hotel_child_services` ADD `service_type` ENUM('free','paid') NOT NULL DEFAULT 'free' ;
ALTER TABLE `sb_sub_child_services` ADD `service_type` ENUM('free','paid') NOT NULL DEFAULT 'free' ;
CREATE TABLE IF NOT EXISTS `sb_hotel_paid_services` (
`paid_service_id` bigint(20) NOT NULL,
  `sb_hotel_id` varchar(255) NOT NULL COMMENT 'FK sb_hotels',
  `service_table` enum('child','subchild') NOT NULL DEFAULT 'child' COMMENT 'child=sb_hotel_child_services table , subchild = sb_sub_child_services table',
  `service_id` varchar(255) NOT NULL COMMENT 'pk from service_table',
  `service_price` float NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `sb_hotel_paid_services`
--
ALTER TABLE `sb_hotel_paid_services`
 ADD PRIMARY KEY (`paid_service_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `sb_hotel_paid_services`
--
ALTER TABLE `sb_hotel_paid_services`
MODIFY `paid_service_id` bigint(20) NOT NULL AUTO_INCREMENT;
ALTER TABLE `sb_hotel_paid_services` ENGINE = MyISAM DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;