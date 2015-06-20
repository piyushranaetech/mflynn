<?php

class Excellence_Slider_Model_Mysql4_Slider extends Mage_Core_Model_Mysql4_Abstract {

    public function _construct() {
        // Note that the slider_id refers to the key field in your database table.
        $this->_init('slider/slider', 'slider_id');
    }
    
    /*
     * This function is returning the Slides Data according to the Slider_Id passed.
     */
    public function getSlidesData($id) {

        $num = Excellence_Slider_Model_Status::STATUS_ENABLED;
        $table = $this->getMainTable();
        $wheree = $this->_getReadAdapter()->quoteInto("status = ? AND ", $num).$this->_getReadAdapter()->quoteInto("slider_name = ?", $id);
        $selectt = $this->_getReadAdapter()->select()->from($table)->where($wheree)->order('image_position');
        return $slidesData = $this->_getReadAdapter()->fetchAll($selectt);
    }

}
