<?php

class Excellence_Slider_Block_Bxslider_Slider extends Mage_Core_Block_Template {

    private $bxsliderPosition;
    private $bxsliderId;

    public function _prepareLayout() {
        $selectedSlider = Mage::helper('slider')->getSelectedSlider(); // This function is getting the name of the selected slider set in the System->Configuration. 
        if ($selectedSlider == 'bxslider') {             
            $head = $this->getLayout()->getBlock('root')->getChild('head');
          //  $head->addJs('slider/bxslider/jquery.bxslider.js');
            $head->addCss('css/slider/bxslider/jquery.bxslider.css');
        }
        return parent::_prepareLayout();
    }

    /*
     * This function sets the position and id of bxslider.
     */
    public function setSliderData($position, $slider_id) {
        $this->bxsliderPosition = $position;
        $this->bxsliderId = $slider_id;
    }
    
    /*
     * This function is used for getting the bxslider position like 
     * whether the slider position is top-left of the page or bottom right and 
     * also you can get the unique slider id to fetch the data related to that slider id.
     */
    public function getSliderData() {
        $data = array("id" => $this->bxsliderId,
            "position" => $this->bxsliderPosition);
        return $data;
    }

}
