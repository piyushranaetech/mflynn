<?php

class Excellence_Slider_Block_Adminhtml_Slider_Edit extends Mage_Adminhtml_Block_Widget_Form_Container {

    public function __construct() {
        parent::__construct();

        $this->_objectId = 'id';
        $this->_blockGroup = 'slider';
        $this->_controller = 'adminhtml_slider';

        $this->_updateButton('save', 'label', Mage::helper('slider')->__('Save Slide'));
        $this->_updateButton('delete', 'label', Mage::helper('slider')->__('Delete Slide'));

        $this->_addButton('saveandcontinue', array(
            'label' => Mage::helper('adminhtml')->__('Save And Continue Edit'),
            'onclick' => 'saveAndContinueEdit()',
            'class' => 'save',
                ), -100);

        $this->_formScripts[] = "
              element1 = document.getElementById('slide_type');
            subelement_file = document.getElementById('filename');
            subelement_textheading = document.getElementById('text_heading');
            
                $(subelement_file).up(1).hide();
                $(subelement_textheading).up(1).hide();
                
            if(element1.value > 0){
                showchilddropdowntype(element1);
            }  
            function toggleEditor() {
                if (tinyMCE.getInstanceById('slider_content') == null) {
                    tinyMCE.execCommand('mceAddControl', false, 'slider_content');
                } else {
                    tinyMCE.execCommand('mceRemoveControl', false, 'slider_content');
                }
            }

            function saveAndContinueEdit(){
                editForm.submit($('edit_form').action+'back/edit/');
            }
            
            function showchilddropdowntype(element){
                   
                $(subelement_file).up(1).hide();
                $(subelement_textheading).up(1).hide();
                
                 $(subelement_textheading).removeClassName('required-entry');
                 
                if(element.value == '1')
                {
               
                    $(subelement_file).up(1).show();
                   
                }else if(element.value == '2')
                {
                 $(subelement_textheading).addClassName('required-entry');
                    $(subelement_textheading).up(1).show();
                     
                }
            }
        ";
    }

    public function getHeaderText() {
        if (Mage::registry('slider_data') && Mage::registry('slider_data')->getId()) {
            return Mage::helper('slider')->__("Edit Slide '%s'", $this->htmlEscape(Mage::registry('slider_data')->getTitle()));
        } else {
            return Mage::helper('slider')->__('Add Slide');
        }
    }

}
