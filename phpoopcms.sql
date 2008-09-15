create database if not exists `swap`;

USE `swap`;

/*Table structure for table `cats` */

CREATE TABLE `cats` (
  `cat_id` int(11) NOT NULL auto_increment,
  `cat_name` varchar(15) default NULL,
  `cat_desc` text,
  `cat_created` datetime default NULL,
  `cat_modified` datetime NOT NULL,
  PRIMARY KEY  (`cat_id`),
  UNIQUE KEY `UNIQUE` (`cat_name`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Table structure for table `comments` */

CREATE TABLE `comments` (
  `comment_id` int(11) NOT NULL auto_increment,
  `post_id` int(11) default NULL,
  `comment_name` varchar(50) default NULL,
  `comment_email` varchar(125) default NULL,
  `comment_url` varchar(125) default NULL,
  `comment` text,
  `comment_date` datetime default NULL,
  PRIMARY KEY  (`comment_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Table structure for table `config` */

CREATE TABLE `config` (
  `var_id` int(11) NOT NULL auto_increment,
  `var_name` varchar(25) NOT NULL,
  `var_value` text NOT NULL,
  `var_created` datetime NOT NULL,
  `var_modified` datetime NOT NULL,
  PRIMARY KEY  (`var_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Table structure for table `events` */

CREATE TABLE `events` (
  `event_id` int(11) NOT NULL auto_increment,
  `event_name` varchar(50) default NULL,
  `event_desc` text,
  `event_datetime` datetime default NULL,
  `event_created` datetime default NULL,
  `event_modified` datetime default NULL,
  PRIMARY KEY  (`event_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Table structure for table `feedback` */

CREATE TABLE `feedback` (
  `feedback_id` int(11) NOT NULL auto_increment,
  `feedback_name` varchar(50) default NULL,
  `feedback_email` varchar(125) default NULL,
  `feedback_url` varchar(125) default NULL,
  `feedback` text,
  `feedback_date` datetime default NULL,
  PRIMARY KEY  (`feedback_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Table structure for table `post_to_cat` */

CREATE TABLE `post_to_cat` (
  `post_id` int(11) default NULL,
  `cat_id` int(11) default NULL,
  UNIQUE KEY `post_cat` (`post_id`,`cat_id`),
  KEY `post_id` (`post_id`),
  KEY `cat_id` (`cat_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Table structure for table `post_to_tag` */

CREATE TABLE `post_to_tag` (
  `post_id` int(11) default NULL,
  `tag_id` int(11) default NULL,
  UNIQUE KEY `post_tag` (`post_id`,`tag_id`),
  KEY `tag_id` (`tag_id`),
  KEY `post_id` (`post_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Table structure for table `posts` */

CREATE TABLE `posts` (
  `post_id` int(11) NOT NULL auto_increment,
  `post_h1` varchar(100) default NULL,
  `post_link` varchar(104) default NULL,
  `post_h2` text,
  `post_ps` text,
  `post_delete` tinyint(1) NOT NULL default '1',
  `post_created` datetime default NULL,
  `post_modified` datetime NOT NULL,
  PRIMARY KEY  (`post_id`),
  UNIQUE KEY `UNIQUE` (`post_h1`),
  UNIQUE KEY `UNIQUE2` (`post_link`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Table structure for table `stats` */

CREATE TABLE `stats` (
  `id` int(11) NOT NULL auto_increment,
  `url` varchar(255) default NULL,
  `referrer` varchar(255) default NULL,
  `browser` varchar(255) default NULL,
  `ip` varchar(15) default NULL,
  `received` datetime default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Table structure for table `tags` */

CREATE TABLE `tags` (
  `tag_id` int(11) NOT NULL auto_increment,
  `tag_name` varchar(15) default NULL,
  `tag_created` datetime default NULL,
  `tag_modified` datetime NOT NULL,
  PRIMARY KEY  (`tag_id`),
  UNIQUE KEY `UNIQUE` (`tag_name`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;