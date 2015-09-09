CREATE TABLE IF NOT EXISTS `sb_forum` (
`forum_id` bigint(20) NOT NULL,
  `sb_hotel_id` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `sb_hotel_guest_booking_id` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `forum_msg` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sender_type` enum('hotel','customer') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'hotel',
  `read_status` enum('0','1') COLLATE utf8_unicode_ci NOT NULL DEFAULT '0' COMMENT '0= unread, 1= read',
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `sb_forum`
--
ALTER TABLE `sb_forum`
 ADD PRIMARY KEY (`forum_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `sb_forum`
--
ALTER TABLE `sb_forum`
MODIFY `forum_id` bigint(20) NOT NULL AUTO_INCREMENT;