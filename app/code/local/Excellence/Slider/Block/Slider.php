<?php

class Excellence_Slider_Block_Slider extends Mage_Core_Block_Template {
    
    private $sliderPosition;  
    private $sliderId;          
    
    public function _construct() {
        parent::_construct();
    }

    public function _prepareLayout() {
        $this->getLayout()->getBlock('head')->addJs('slider/jquery/jquery-2.1.1.min.js');
        $this->getLayout()->getBlock('head')->addJs('slider/jquery/noconflict.js');
        return parent::_prepareLayout();
    }

    public function getSlider() {
        if (!$this->hasData('slider')) {
            $this->setData('slider', Mage::registry('slider'));
        }
        return $this->getData('slider');
    }
    
    /*
     * This function sets the position and id of specific slider.
     */
    public function setSliderData($position, $slider_id) {
        $this->sliderPosition = $position;
        $this->sliderId = $slider_id;
    }
    
    /*
     * This function is used for getting the slider position like 
     * whether the slider is on the top-left of the page or bottom right and 
     * also you can get the unique slider id to fetch the data related to that slider id.
     */
    public function getSliderData() {
        $data = array("id" => $this->sliderId,
            "position" => $this->sliderPosition);
        return $data;
    }

}
