<?php

class Excellence_Slider_Model_Adminhtml_Config_Comment extends Mage_Core_Model_Config_Data
{
    /*
     * It is showing comments below the selected slider in System->Configuration
     */
    public function getCommentText(Mage_Core_Model_Config_Element $element, $currentValue)
    {
        if($currentValue == 'nivoslider'){
            $result = 'Nivo Slider : <a href="http://demo.dev7studios.com/nivo-slider/">http://demo.dev7studios.com/nivo-slider/</a>';
        }elseif($currentValue == 'bxslider'){
            $result = 'BxSlider : <a href="http://www.bxslider.com/">http://www.bxslider.com/</a>';
        }elseif($currentValue == 'iscroll'){
            $result = 'IScroll : <a href="http://www.cubiq.org/iscroll-5">http://www.cubiq.org/iscroll-5</a>';
        }else{
            $result = '';
        }
        return $result;
    }
}