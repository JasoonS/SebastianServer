CREATE TABLE IF NOT EXISTS `sb_hotel_rooms` (
`sb_room_id` int(11) NOT NULL COMMENT 'primary key',
  `sb_hotel_id` int(11) NOT NULL COMMENT 'Hotel ID  ',
  `sb_room_number` varchar(255) NOT NULL COMMENT 'room name',
  `sb_room_created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'room created on',
  `sb_room_is_deleted` enum('0','1') NOT NULL DEFAULT '0' COMMENT '0: Not Deleted, 1: Deleted'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


