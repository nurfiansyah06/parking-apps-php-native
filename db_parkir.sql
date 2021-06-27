-- Adminer 4.6.3 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `transportations`;
CREATE TABLE `transportations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(255) DEFAULT NULL,
  `user_id` int(4) NOT NULL,
  `name` varchar(255) NOT NULL,
  `vehicle_number` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `transportations_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `transportations` (`id`, `code`, `user_id`, `name`, `vehicle_number`, `type`, `created_at`, `updated_at`) VALUES
(12,	'CODE752',	1,	'Honda Beat',	'G 2000 GH',	'Motor',	'2021-06-27 04:43:44',	'2021-06-27 11:36:05'),
(13,	'CODE294',	1,	'Agya',	'B 2992 HP',	'Mobil',	'2021-06-27 05:41:09',	'2021-06-27 11:39:02'),
(14,	'CODE503',	1,	'Vixion',	'G 2412 GHS',	'Motor',	'2021-06-27 11:36:28',	'2021-06-27 11:39:36');

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `roles` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `users` (`id`, `username`, `password`, `roles`, `created_at`) VALUES
(1,	'operator',	'202cb962ac59075b964b07152d234b70',	'OPERATOR',	'2021-06-26 12:14:30');

-- 2021-06-27 17:26:22