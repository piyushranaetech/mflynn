<?php

class Excellence_Slider_Block_Nivo_Slider extends Mage_Core_Block_Template {

    private $nivosliderPosition;
    private $nivosliderId;

    public function _construct() {
        parent::_construct();
    }

    public function _prepareLayout() {
        $selectedSlider = Mage::helper('slider')->getSelectedSlider(); // This function is getting the name of the selected slider set in the System->Configuration.
        if ($selectedSlider == 'nivoslider') {
            $head = $this->getLayout()->getBlock('root')->getChild('head');
          //  $head->addJs('slider/nivo/jquery.nivo.slider.js');
            $head->addCss('css/slider/nivo/nivo-slider.css');
            $head->addCss('images/slider/nivo/default.css');
        }
        return parent::_prepareLayout();
    }

    /*
     * This function sets the position and id of nivo slider.
     */
    public function setSliderData($position, $slider_id) {
        $this->nivosliderPosition = $position;
        $this->nivosliderId = $slider_id;
    }

    /*
     * This function is used for getting the nivo slider position like 
     * whether the slider position is top-left of the page or bottom right and 
     * also you can get the unique slider id to fetch the data related to that slider id.
     */
    public function getSliderData() {
        $data = array("id" => $this->nivosliderId,
            "position" => $this->nivosliderPosition);
        return $data;
    }

}
