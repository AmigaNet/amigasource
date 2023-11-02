CREATE TABLE IF NOT EXISTS `news_articles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `story` mediumtext COMMENT 'The text to be displayed',
  `title` varchar(255) NOT NULL DEFAULT '' COMMENT 'The title of the article',
  `date_added` DATETIME DEFAULT CURRENT_TIMESTAMP,
  `date_updated` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `is_active` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Is the article live',
  PRIMARY KEY (`id`)
);

INSERT INTO `news_articles` (story, title, date_added) SELECT news_story, '', news_date FROM `t_news`;