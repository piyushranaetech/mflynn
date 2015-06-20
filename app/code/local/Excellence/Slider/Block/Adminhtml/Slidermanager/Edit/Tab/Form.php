<?php

class Excellence_Slider_Block_Adminhtml_Slidermanager_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form {

    protected function _prepareForm() {
        $form = new Varien_Data_Form();
        $this->setForm($form);
        $fieldset = $form->addFieldset('slidermanager_form', array('legend' => Mage::helper('slider')->__('Configure Slider')));
        
        $fieldset->addField('slider_name', 'text', array(
            'label' => Mage::helper('slider')->__('Slider Name'),
            'required' => true,
            'name' => 'slider_name'
        ));

        $pages = Mage::getSingleton('slider/slides')->getPagesArray();
        $fieldset->addField('slider_display_page', 'select', array(
            'label' => Mage::helper('slider')->__('Show Slider on'),
            'required' => true,
            'onchange' => "showchilddropdown(slider_display_page);",
            'name' => 'slider_display_page',
            'values' => $pages
        ));

        $cms_pages = Mage::getSingleton('slider/slidermanager')->getCmsPages();
        $fieldset->addField('slider_specific_display_page_cms', 'select', array(
            'label' => Mage::helper('slider')->__('Specify Slider CMS Page'),
            'required' => true,
            'name' => 'slider_specific_display_page_cms',
            'values' => $cms_pages   
        ));
       
        $fieldset->addField('slider_specific_display_page_category', 'select', array(
            'label' => Mage::helper('slider')->__('Specify Slider Category Page'),
            'required' => true,
            'name' => 'slider_specific_display_page_category',
            'values' => ''
        ));
       
        $fieldset->addField('slider_specific_display_page_product', 'select', array(
            'label' => Mage::helper('slider')->__('Specify Slider Product Page'),
            'required' => true,
            'name' => 'slider_specific_display_page_product',
            'values' => ''   
        ));
        $slider_position = Mage::getSingleton('slider/slides')->getOptionArray();
        $fieldset->addField('slider_position', 'select', array(
            'label' => Mage::helper('slider')->__('Specify Slider Position'),
            'required' => true,
            'name' => 'slider_position',
            'values' => $slider_position   
        ));

        $fieldset->addField('status', 'select', array(
            'label' => Mage::helper('slider')->__('Status'),
            'name' => 'status',
            'values' => array(
                array(
                    'value' => 1,
                    'label' => Mage::helper('slider')->__('Enabled'),
                ),
                array(
                    'value' => 2,
                    'label' => Mage::helper('slider')->__('Disabled'),
                ),
            ),
        ));
        
        if (Mage::getSingleton('adminhtml/session')->getSliderData()) {
            $form->setValues(Mage::getSingleton('adminhtml/session')->getSliderData());
            Mage::getSingleton('adminhtml/session')->setSliderData(null);
        } elseif (Mage::registry('slider_data')) {
            $form->setValues(Mage::registry('slider_data')->getData());
        }
        return parent::_prepareForm();
    }

}
