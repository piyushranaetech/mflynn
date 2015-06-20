<?php

$installer = $this;


$installer->startSetup();

$installer->run("

ALTER TABLE {$this->getTable('slider/slider')}
ADD COLUMN `image_name` varchar(255) NULL  after `content`,
ADD COLUMN `image_position` varchar(255) NULL  after `image_name`,
ADD COLUMN `slider_name` varchar(255) NULL  after `image_position`;

");

$installer->endSetup();
