CREATE DATABASE `dice`;


CREATE TABLE `dice`.`players` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `age` varchar(255) DEFAULT NULL,
  `is_online` enum('yes','no') DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;



CREATE TABLE `dice`.`scores` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `p1_id` int(11) NOT NULL,
  `p2_id` int(11) NOT NULL,
  `p1_score` int(11) NOT NULL,
  `p2_score` int(11) NOT NULL,
  `p1_status` enum('Win','Lose','Playing','Done') NOT NULL,
  `p2_status` enum('Win','Lose','Playing','Done') NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;

