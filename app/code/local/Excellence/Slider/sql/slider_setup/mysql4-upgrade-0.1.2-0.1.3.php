<?php

$installer = $this;


$installer->startSetup();

$installer->run("

ALTER TABLE {$this->getTable('slider/slidermanager')}
ADD COLUMN `status` smallint(6) NOT NULL default '0' after `slider_specific_display_page_product`;

");

$installer->endSetup();
