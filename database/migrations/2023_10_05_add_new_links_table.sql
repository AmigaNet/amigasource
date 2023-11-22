CREATE TABLE IF NOT EXISTS `links` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT '',
  `url` varchar(150) DEFAULT '',
  `author` varchar(255) DEFAULT '',
  `email` varchar(255) DEFAULT '',
  `description` text,
  `rating` int(11) NOT NULL DEFAULT 0,
  `date_added` DATETIME DEFAULT CURRENT_TIMESTAMP,
  `date_updated` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `date_verified` DATETIME DEFAULT '1970-01-02',
  `is_dead` tinyint(1) DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `is_recommended` tinyint(1) NOT NULL DEFAULT 0,
  `submitter_id` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
);

CREATE TABLE IF NOT EXISTS `links_categories` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `link_id` INT UNSIGNED NOT NULL DEFAULT 0,
  `category_id` INT UNSIGNED NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
);

CREATE TABLE IF NOT EXISTS `categories` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT '',
  `description` text,
  `bg_color` varchar(7) DEFAULT '#000000',
  `text_color` varchar(7) DEFAULT '#ffffff',
  `date_added` DATETIME DEFAULT CURRENT_TIMESTAMP,
  `date_updated` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `parent_id` INT UNSIGNED NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
);

INSERT INTO `categories` (`id`, `name`) SELECT cat_main_id, cat_main_title FROM t_cat_main;
INSERT INTO `categories` (`id`, `name`, `description`, `parent_id`) SELECT id + 50, cat_sub_title, cat_sub_desc, cat_sub_ref_main_id FROM t_cat_sub;
INSERT INTO `links` (`id`, `name`, `url`, `author`, `email`, `description`, `date_added`, `date_verified`, `is_dead`, `is_active`, `is_recommended`) 
SELECT id, links_name, links_url, links_author, links_email, links_desc, links_date_added, links_date_verified, links_dead, links_active, links_recommended FROM t_links;
INSERT INTO `links_categories` (`link_id`, `category_id`) SELECT id, links_cat_1 + 50 FROM t_links WHERE t_links.links_cat_1 != 0;
INSERT INTO `links_categories` (`link_id`, `category_id`) SELECT id, links_cat_2 + 50 FROM t_links WHERE t_links.links_cat_2 != 0;
INSERT INTO `links_categories` (`link_id`, `category_id`) SELECT id, links_cat_3 + 50 FROM t_links WHERE t_links.links_cat_3 != 0;
INSERT INTO `links_categories` (`link_id`, `category_id`) SELECT id, links_cat_4 + 50 FROM t_links WHERE t_links.links_cat_4 != 0;
INSERT INTO `links_categories` (`link_id`, `category_id`) SELECT id, links_cat_5 + 50 FROM t_links WHERE t_links.links_cat_5 != 0;
INSERT INTO `links_categories` (`link_id`, `category_id`) SELECT id, links_cat_6 + 50 FROM t_links WHERE t_links.links_cat_6 != 0;
INSERT INTO `links_categories` (`link_id`, `category_id`) SELECT id, links_cat_7 + 50 FROM t_links WHERE t_links.links_cat_7 != 0;
INSERT INTO `links_categories` (`link_id`, `category_id`) SELECT id, links_cat_8 + 50 FROM t_links WHERE t_links.links_cat_8 != 0;
INSERT INTO `links_categories` (`link_id`, `category_id`) SELECT id, links_cat_9 + 50 FROM t_links WHERE t_links.links_cat_9 != 0;
INSERT INTO `links_categories` (`link_id`, `category_id`) SELECT id, links_cat_10 + 50 FROM t_links WHERE t_links.links_cat_10 != 0;