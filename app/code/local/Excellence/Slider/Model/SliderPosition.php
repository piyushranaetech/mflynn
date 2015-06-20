<?php

class Excellence_Slider_Model_SliderPosition extends Varien_Object {

    const TOP_LEFT = 1;
    const BOTTOM_LEFT = 2;
    const TOP_CENTER = 3;
    const BOTTOM_CENTER = 4;
    const TOP_RIGHT = 5;
    const BOTTOM_RIGHT = 6;

    static public function getOptionArray() {
        return array(
            self::TOP_LEFT => Mage::helper('slider')->__('Top Left'),
            self::BOTTOM_LEFT => Mage::helper('slider')->__('Bottom Left'),
            self::TOP_CENTER => Mage::helper('slider')->__('Top Center'),
            self::BOTTOM_CENTER => Mage::helper('slider')->__('Bottom Center'),
            self::TOP_RIGHT => Mage::helper('slider')->__('Top Right'),
            self::BOTTOM_RIGHT => Mage::helper('slider')->__('Bottom Right')
        );
    }

}
