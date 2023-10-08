CREATE TABLE IF NOT EXISTS `t_cal` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cal_name` text NOT NULL,
  `cal_url` text NOT NULL,
  `cal_date_start` date NOT NULL,
  `cal_date_end` date NOT NULL,
  `cal_location` text NOT NULL,
  `cal_v_sub` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
);

CREATE TABLE IF NOT EXISTS `t_cat_main` (
  `id` tinyint(11) NOT NULL AUTO_INCREMENT,
  `cat_main_id` int(11) NOT NULL DEFAULT '0',
  `cat_main_title` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
);

CREATE TABLE IF NOT EXISTS `t_cat_spec` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `cat_spec_id` int(3) NOT NULL,
  `cat_spec_sub_ref_sub_id` int(3) NOT NULL,
  `cat_spec_title` varchar(255) NOT NULL,
  `cat_spec_desc` varchar(255) NOT NULL,
  `cat_spec_title_short` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
);

CREATE TABLE IF NOT EXISTS `t_cat_sub` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `cat_sub_id` int(11) NOT NULL,
  `cat_sub_ref_main_id` int(3) NOT NULL,
  `cat_sub_title` varchar(255) DEFAULT NULL COMMENT 'was page_header',
  `cat_sub_desc` varchar(255) DEFAULT NULL COMMENT 'page_header',
  `cat_sub_title_short` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
);

CREATE TABLE IF NOT EXISTS `t_cfund` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cfund_name` text NOT NULL,
  `cfund_url` text NOT NULL,
  `cfund_date_start` date NOT NULL,
  `cfund_date_end` date NOT NULL,
  `cfund_active` tinyint(1) NOT NULL,
  `cfund_v_sub` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
);

CREATE TABLE IF NOT EXISTS `t_links` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `links_name` varchar(255) DEFAULT NULL,
  `links_url` varchar(150) DEFAULT NULL,
  `links_author` varchar(255) DEFAULT NULL,
  `links_email` varchar(255) DEFAULT NULL,
  `links_desc` text,
  `links_cat_1` int(3) DEFAULT '0',
  `links_cat_2` int(3) DEFAULT '0',
  `links_cat_3` int(3) DEFAULT '0',
  `links_cat_4` int(3) DEFAULT '0',
  `links_cat_5` int(3) DEFAULT '0',
  `links_cat_6` int(3) DEFAULT '0',
  `links_cat_7` int(3) DEFAULT '0',
  `links_cat_8` int(3) DEFAULT '0',
  `links_cat_9` int(3) DEFAULT '0',
  `links_cat_10` int(3) DEFAULT '0',
  `links_date_added` date DEFAULT '1970-01-02',
  `links_dead` tinyint(1) DEFAULT '0',
  `links_archived_url` varchar(150) DEFAULT NULL,
  `links_archived_date` date DEFAULT '1970-01-02',
  `links_date_verified` date NOT NULL DEFAULT '1970-01-02',
  `links_misc` varchar(255) DEFAULT NULL,
  `links_v_sub` int(1) NOT NULL DEFAULT '0',
  `links_active` tinyint(1) NOT NULL DEFAULT '1',
  `links_recommended` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
);

CREATE TABLE IF NOT EXISTS `t_mags_online` (
  `id` int(1) NOT NULL AUTO_INCREMENT,
  `online_name` text NOT NULL,
  `online_url` text NOT NULL,
  `online_issue` int(3) NOT NULL,
  PRIMARY KEY (`id`)
);

CREATE TABLE IF NOT EXISTS `t_mags_print` (
  `id` int(1) NOT NULL AUTO_INCREMENT,
  `print_name` text NOT NULL,
  `print_url` text NOT NULL,
  `print_issue` int(3) NOT NULL,
  PRIMARY KEY (`id`)
);

CREATE TABLE IF NOT EXISTS `t_news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `news_date` date NOT NULL,
  `news_story` mediumtext COMMENT 'The text to be displayed',
  `news_v_sub` tinyint(4) NOT NULL DEFAULT '0',
  `news_active` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Is the article live',
  PRIMARY KEY (`id`)
);

CREATE TABLE IF NOT EXISTS `t_repair` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `repair_name` text NOT NULL,
  `repair_url` text NOT NULL,
  `repair_country` text NOT NULL,
  PRIMARY KEY (`id`)
);

CREATE TABLE IF NOT EXISTS `t_top10` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `top10_name` text NOT NULL,
  `top10_url` text NOT NULL,
  `top10_order` int(11) NOT NULL,
  PRIMARY KEY (`id`)
);

CREATE TABLE IF NOT EXISTS `t_vendor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `vendor_name` text NOT NULL,
  `vendor_url` text NOT NULL,
  PRIMARY KEY (`id`)
);
