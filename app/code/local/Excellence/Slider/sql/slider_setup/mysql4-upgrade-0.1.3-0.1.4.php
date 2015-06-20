<?php

$installer = $this;


$installer->startSetup();

$installer->run("

ALTER TABLE {$this->getTable('slider/slidermanager')}
ADD COLUMN `slider_name` varchar(255) NULL UNIQUE  after `slidermanager_id`;

");

$installer->endSetup();
