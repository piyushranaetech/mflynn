<?php

class Excellence_Slider_Block_Adminhtml_Slider_Renderer_Image extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract {

    public function render(Varien_Object $row) {
        $url = Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_MEDIA);
        $html = '<img ';
        $html .= 'id="' . $this->getColumn()->getId() . '" ';
        $html .= 'src="' . $url . $row->getData($this->getColumn()->getIndex()) . '"';
        $html .= 'style="height:100px;width:100px;" class="grid-image ' . $this->getColumn()->getInlineCss() . '"/>';
        return $html;
    }

}
