<?php

class Excellence_Slider_Model_Mysql4_Slidermanager extends Mage_Core_Model_Mysql4_Abstract {

    public function _construct() {
        // Note that the slider_id refers to the key field in your database table.
        $this->_init('slider/slidermanager', 'slidermanager_id');
    }
    
    /*
     * it is used for returning the array of title and id of all CMS pages.
     */
    public function getCmsPage(){
        $model = Mage::getResourceModel('cms/page');
        $table = $model->getTable('cms/page');
        $select = $model->_getReadAdapter()->select()->from($table,array('page_id','title'));
        return $results = $model->_getReadAdapter()->fetchAll($select);
        
    }
    
    
    /*
     * it is used for returning the array of entity_id and  sku of all Product pages.
     */
    public function getProductPage(){
        $model = Mage::getResourceModel('catalog/product');
        $table = $model->getTable('catalog/product');
        $select = $model->_getReadAdapter()->select()->from($table,array('entity_id','sku'));
        return $results = $model->_getReadAdapter()->fetchAll($select);
    }
        
    
    /*
     * it is used for returning the position of a slider.
     */
    public function getSliderPos(){
        
        $table = $this->getMainTable();
        $selectt = $this->_getReadAdapter()->select()->from($table,'slider_position');
        return $checkForList = $this->_getReadAdapter()->fetchAll($selectt);
    }
    
}
