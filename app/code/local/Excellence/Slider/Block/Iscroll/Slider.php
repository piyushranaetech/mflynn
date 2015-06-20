<?php

class Excellence_Slider_Block_Iscroll_Slider extends Mage_Core_Block_Template {

    private $iscrollsliderPosition;
    private $iscrollsliderId;

    public function _prepareLayout() {
        $selectedSlider = Mage::helper('slider')->getSelectedSlider(); // This function is getting the name of the selected slider set in the System->Configuration.
        if ($selectedSlider == 'iscroll') {
            $head = $this->getLayout()->getBlock('root')->getChild('head');
           // $head->addJs('slider/iscroll/iscroll.js');
            $head->addCss('css/slider/iscroll/iscroll-slider.css');
        }
        return parent::_prepareLayout();
    }

    /*
     * This function sets the position and id of iscroll slider.
     */
    public function setSliderData($position, $slider_id) {
        $this->iscrollsliderPosition = $position;
        $this->iscrollsliderId = $slider_id;
    }
    
    /*
     * This function is used for getting the iscroll slider position like 
     * whether the slider position is top-right of the page or bottom content and 
     * also you can get the unique slider id to fetch the data related to that slider id.
     */
    public function getSliderData() {
        $data = array("id" => $this->iscrollsliderId,
            "position" => $this->iscrollsliderPosition);
        return $data;
    }

}
