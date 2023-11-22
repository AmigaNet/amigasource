CREATE TABLE IF NOT EXISTS `link_ratings` (
  `user_id` int(11) NOT NULL,
  `link_id` int(11) NOT NULL,
  `rating` int(2) NOT NULL,
  `date_added` DATETIME DEFAULT CURRENT_TIMESTAMP,
  `date_updated` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`user_id`, `link_id`)
);
