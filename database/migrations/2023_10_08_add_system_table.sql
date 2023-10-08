CREATE TABLE IF NOT EXISTS `system` (
  `name` varchar(255) NOT NULL UNIQUE,
  `value` varchar(255) NOT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `system` (`name`, `value`) VALUES ('validating', 'false'), ('validation_last_start', '1970-01-01'), ('validation_last_end', '1970-01-01');
