<?php

class Excellence_Slider_Block_Adminhtml_Slidermanager_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs {

    public function __construct() {
        parent::__construct();
        $this->setId('slider_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(Mage::helper('slider')->__('Slider Manager'));
    }

    protected function _beforeToHtml() {
        $this->addTab('form_section', array(
            'label' => Mage::helper('slider')->__('Configure Slider'),
            'title' => Mage::helper('slider')->__('Configure Slider'),
            'content' => $this->getLayout()->createBlock('slider/adminhtml_slidermanager_edit_tab_form')->toHtml(),
        ));

        return parent::_beforeToHtml();
    }

}
