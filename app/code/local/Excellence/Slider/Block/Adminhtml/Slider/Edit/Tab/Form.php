<?php

class Excellence_Slider_Block_Adminhtml_Slider_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form {

    protected function _prepareForm() {
        $form = new Varien_Data_Form();
        $this->setForm($form);
        $fieldset = $form->addFieldset('slider_form', array('legend' => Mage::helper('slider')->__('Slide information')));
        
        $fieldset->addField('image_name', 'text', array(
            'label' => Mage::helper('slider')->__('Image Name'),
            'class' => 'required-entry',
            'required' => true,
            'name' => 'image_name',
        ));
        
        $fieldset->addField('title', 'text', array(
            'label' => Mage::helper('slider')->__('Caption'),
            'class' => 'required-entry',
            'required' => true,
            'name' => 'title',
        ));

          $slide_type = Mage::getSingleton('slider/slides')->getTypeArray();
          
          $fieldset->addField('slide_type', 'select', array(
            'label' => Mage::helper('slider')->__('Select Slide Type'),
            'required' => true,
            'onchange' => "showchilddropdowntype(slide_type);",
            'class' => 'required-entry',
            'name' => 'slide_type',
            'values'=> $slide_type
        ));
          
        $fieldset->addField('filename', 'image', array(
            'label' => Mage::helper('slider')->__('File'),
            'required' => true,
            'class' => 'required-entry',
            'name' => 'filename',
        ));
                       
        $fieldset->addField('text_heading', 'editor', array(
            'name' => 'text_heading',
            'label' => Mage::helper('slider')->__('Text Heading'),
            'title' => Mage::helper('slider')->__('Text Heading'),
            'style' => 'width:275px; height:100px;',
           
            'wysiwyg' => true,
            'required' => true,
        ));
        
        $fieldset->addField('image_position', 'text', array(
            'label' => Mage::helper('slider')->__('Position'),
            'required' => true,
            'class' => 'required-entry',
            'name' => 'image_position',
        ));
        
        
        $slider = Mage::helper('slider')->getSliderName();
        $fieldset->addField('slider_name', 'select', array(
            'label' => Mage::helper('slider')->__('Show Slides on'),
            'name' => 'slider_name',
            'values' => $slider
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

        $fieldset->addField('content', 'text', array(
            'name' => 'content',
            'label' => Mage::helper('slider')->__('Url'),
            'title' => Mage::helper('slider')->__('Url'),
            'wysiwyg' => false,
            'required' => false,
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
