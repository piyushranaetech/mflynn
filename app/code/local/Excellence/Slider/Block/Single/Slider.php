<?php

class Excellence_Slider_Block_Single_Slider extends Mage_Core_Block_Template {

    private $singlesliderPosition;
    private $singlesliderId;

    public function _construct() {
        parent::_construct();
    }

    public function _prepareLayout() {
        $head = $this->getLayout()->getBlock('root')->getChild('head');
        $head->addCss('css/slider/singleslider/singleslider.css');
        return parent::_prepareLayout();
    }
    
    /*
     * This function sets the position and id of single slider.
     */
    public function setSliderData($position, $slider_id) {
        $this->singlesliderPosition = $position;
        $this->singlesliderId = $slider_id;
    }
    
    /*
     * This function is used for getting the single slider position like 
     * whether the slider position is top-left of the page or bottom right and 
     * also you can get the unique slider id to fetch the data related to that slider id.
     */
    public function getSliderData() {
        $data = array("id" => $this->singlesliderId,
            "position" => $this->singlesliderPosition);
        return $data;
    }

}
