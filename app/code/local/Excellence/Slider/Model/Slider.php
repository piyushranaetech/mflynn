<?php

class Excellence_Slider_Model_Slider extends Mage_Core_Model_Abstract {

    public function _construct() {
        parent::_construct();
        $this->_init('slider/slider');
    }

    /*
     * this function is getting the slides data used for setting 
     * slides according to the sliderid passed on that function.
     */
    public function getSlidesData($id) {

        $slidesData = $this->getResource()->getSlidesData($id);
        return $slidesData;
    }
}
