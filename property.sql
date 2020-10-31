SET NAMES utf8;

DROP TABLE IF EXISTS `properties`;

CREATE TABLE `properties` (
  `uuid` char(36) NOT NULL PRIMARY KEY,
  `county` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `town` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `address` varchar(255) NOT NULL,
  `image_full` varchar(255) NOT NULL,
  `image_thumbnail` varchar(255) NOT NULL,
  `image_local` varchar(255) NOT NULL,
  `latitude` decimal(9,6) NOT NULL,
  `longitude` decimal(9,6) NOT NULL,
  `num_bedrooms` tinyint(3) NOT NULL,
  `num_bathrooms` tinyint(3) NOT NULL,
  `price` decimal(12,2)NOT NULL,
  `type` varchar(255) NOT NULL,
  `saleorrent` varchar(255) NOT NULL,
  `localoronline` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL
) ENGINE=InnoDB;

