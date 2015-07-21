USE `sandbox_sebastian`;

ALTER TABLE `sb_hotel_guest_bookings` ADD `sb_guest_firstName` VARCHAR(150) NOT NULL AFTER `sb_guest_reservation_code`, ADD `sb_guest_lastName` VARCHAR(150) NOT NULL AFTER `sb_guest_firstName`, ADD `sb_guest_email` VARCHAR(150) NOT NULL AFTER `sb_guest_lastName`, ADD `sb_guest_contact_no` VARCHAR(10) NOT NULL AFTER `sb_guest_email`;

ALTER TABLE `sb_hotel_guest_reservation_attributes`
  DROP `sb_guest_firstName`,
  DROP `sb_guest_lastName`,
  DROP `sb_guest_email`,
  DROP `sb_guest_contact_no`;

