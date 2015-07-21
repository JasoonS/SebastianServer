USE `sandbox_sebastian`;

CREATE TABLE IF NOT EXISTS `sb_guest_services` (
`sb_guest_services_id` int(11) NOT NULL,
  `service_type` enum('request','order') NOT NULL DEFAULT 'request',
  `sb_hotel_guest_booking_id` int(11) NOT NULL COMMENT 'FK (sb_hotel_guest_bookings)',
  `guest_room_number` int(11) NOT NULL,
  `service_message` varchar(255) NOT NULL,
  `sb_hotel_user_id` int(11) NOT NULL COMMENT 'fk (sb_hotel_users)',
  `service_status` enum('accepted','completed','rejected','pending') NOT NULL DEFAULT 'pending',
  `service_due_date` date NOT NULL,
  `service_due_time` time NOT NULL,
  `service_done_date` date NOT NULL,
  `service_done_time` time NOT NULL,
  `sb_hotel_id` int(11) NOT NULL COMMENT 'fk (sb_hotels)',
  `sb_staff_cat_id` int(11) NOT NULL COMMENT 'fk (sb_hotel_users)',
  `order_detail_id` int(11) NOT NULL COMMENT 'if req is order then this Id will contain all order',
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `sb_guest_services`
--
ALTER TABLE `sb_guest_services`
 ADD PRIMARY KEY (`sb_guest_services_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `sb_guest_services`
--
ALTER TABLE `sb_guest_services`
MODIFY `sb_guest_services_id` int(11) NOT NULL AUTO_INCREMENT;