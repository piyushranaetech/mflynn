<?php

class Excellence_Slider_Block_Adminhtml_Slidermanager_Renderer_Page extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract {

    /*
     * This function returns the name of the slider specific page according to its parent page 
     * like if the parent page is category page then it will return the name of specific category page to display it on grid
     */
    public function render(Varien_Object $row) {
        $id = $row->getId();
        $data = Mage::getModel('slider/slidermanager')->load($id);
        $model = Mage::getSingleton('slider/slidermanager');
        if ($data->getSliderDisplayPage() == Excellence_Slider_Model_Pages::CMS_PAGE) {
            if ($data->getSliderSpecificDisplayPageCms() > 0) {
                $label = $model->getCmsPages();
                $display_id = $data->getSliderSpecificDisplayPageCms();
                foreach ($label as $key => $value) {
                    if ($display_id == $key)
                        $display_name = $value;
                }
            }
        }elseif ($data->getSliderDisplayPage() == Excellence_Slider_Model_Pages::CATEGORY_PAGE) {
            if ($data->getSliderSpecificDisplayPageCategory() > 0) {
                $label = $model->getCategoryPages();
                $display_id = $data->getSliderSpecificDisplayPageCategory();
                foreach ($label as $value) {
                    if ($display_id == $value['value'])
                        $display_name = $value['label'];
                }
            }
        } elseif ($data->getSliderDisplayPage() == Excellence_Slider_Model_Pages::PRODUCT_PAGE) {
            if ($data->getSliderSpecificDisplayPageProduct() > 0) {
                $label = $model->getProductPages();
                $display_id = $data->getSliderSpecificDisplayPageProduct();
                foreach ($label as $key => $value) {
                    if ($display_id == $key)
                        $display_name = $value;
                }
            }
        }
        else {
            $display_name = '  -  ';
        }
        $values = $display_name;
        return $values;
    }

}
