<?php

$installer = $this;


$installer->startSetup();

$installer->run("

ALTER TABLE {$this->getTable('slider/slider')}
ADD COLUMN `text_heading` LONGTEXT  NOT NULL default '';

");

$installer->run("

ALTER TABLE {$this->getTable('slider/slider')}
ADD COLUMN `slide_type` varchar(255)  NOT NULL default '';

");

$installer->endSetup();
