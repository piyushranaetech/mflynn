<?php

$installer = $this;

$installer->startSetup();

$installer->run("

-- DROP TABLE IF EXISTS {$this->getTable('slider/slider')};
CREATE TABLE {$this->getTable('slider/slider')} (
  `slider_id` int(11) unsigned NOT NULL auto_increment,
  `title` varchar(255) NOT NULL default '',
  `filename` varchar(255) NOT NULL default '',
  `content` text NOT NULL default '',
  `status` smallint(6) NOT NULL default '0',
  `created_time` datetime NULL,
  `update_time` datetime NULL,
  PRIMARY KEY (`slider_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

    ");

$installer->run("

-- DROP TABLE IF EXISTS {$this->getTable('slider/slidermanager')};
CREATE TABLE {$this->getTable('slider/slidermanager')} (
  `slidermanager_id` int(11) unsigned NOT NULL auto_increment,
  `slider_display_page` varchar(255) NOT NULL default '',
  `slider_specific_display_page_cms` varchar(255) NOT NULL default '',
  `slider_specific_display_page_category` varchar(255) NOT NULL default '',
  `slider_specific_display_page_product` varchar(255) NOT NULL default '',
  `slider_position` varchar(255) NOT NULL default '',
  PRIMARY KEY (`slidermanager_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

    ");

$installer->endSetup();
