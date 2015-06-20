<?php

class Excellence_Slider_Helper_Data extends Mage_Core_Helper_Abstract {

    /* 
     * This funtion is used for getting the name of selected slider by the admin
     * in Slider Setting of System->Configuration.
     */
    public function getSelectedSlider() {
        $selectedSlider = Mage::getStoreConfig(
                        'testsection/caption/leftup', Mage::app()->getStore()
        );
        return $selectedSlider;
    }

    /*
     * This function used for checking each page of magento whether that page has a slider to set.
     * If yes, then it sets the template on that page.
     */
    public function checkSliderTemplate($id) {
        $sliderManagerData = Mage::getSingleton('slider/slidermanager')->load($id);
        $slider_display_page = $sliderManagerData->getSliderDisplayPage();
        
        if ($sliderManagerData->getSliderSpecificDisplayPageCms() > 0) {
            $display_id = $sliderManagerData->getSliderSpecificDisplayPageCms();
        } elseif ($sliderManagerData->getSliderSpecificDisplayPageCategory() > 0) {
            $display_id = $sliderManagerData->getSliderSpecificDisplayPageCategory();
        } elseif ($sliderManagerData->getSliderSpecificDisplayPageProduct() > 0) {
            $display_id = $sliderManagerData->getSliderSpecificDisplayPageProduct();
        }
        if ($slider_display_page == Excellence_Slider_Model_Pages::CMS_PAGE) {
            $dynamicpageid = Mage::getSingleton('cms/page')->getPageId();
            if ($display_id == $dynamicpageid) {
                $template = 'slider/slider.phtml';
            }
        } elseif ($slider_display_page == Excellence_Slider_Model_Pages::CATEGORY_PAGE && !Mage::registry('current_product') && Mage::registry('current_category')) {
            if (isset($_REQUEST['cat'])) {
                if ($_REQUEST['cat'] == $display_id) {
                    $template = 'slider/slider.phtml';
                }
            } elseif (Mage::getSingleton('catalog/layer')) {
                $layer = Mage::getSingleton('catalog/layer');
                $_category = $layer->getCurrentCategory();
                $currentCategoryId = $_category->getId();
                if ($display_id == $currentCategoryId) {
                    $template = 'slider/slider.phtml';
                }
            }
        } elseif ($slider_display_page == Excellence_Slider_Model_Pages::PRODUCT_PAGE) {
            if (Mage::registry('current_product')) {
                $currentproduct = Mage::registry('current_product');
                $currentproductId = $currentproduct->getId();
                if ($display_id == $currentproductId) {
                    $template = 'slider/slider.phtml';
                }
            }
        } elseif ($slider_display_page == Excellence_Slider_Model_Pages::CHECKOUT_PAGE) {
            if (Mage::helper('core/url')->getCurrentUrl() == Mage::getURL('checkout/onepage')) {
                $template = 'slider/slider.phtml';
            }
        } elseif ($slider_display_page == Excellence_Slider_Model_Pages::CART_PAGE) {
            if (Mage::helper('core/url')->getCurrentUrl() == Mage::getURL('checkout/cart')) {
                $template = 'slider/slider.phtml';
            }
        }elseif ($slider_display_page == Excellence_Slider_Model_Pages::ALL_PAGES) {
            $template = 'slider/slider.phtml';
            
        }
        return $template;
    }

    /*
     * This function is returning the array of slider id as key and slidername as value.
     */
    public function getSliderName() {
        $sliderManagerData = Mage::getSingleton('slider/slidermanager')->getCollection()->addFieldToSelect('slider_name')->addFieldToSelect('slidermanager_id');
        $slider_name = array();
        foreach ($sliderManagerData as $field) {
            $slider_name[$field['slidermanager_id']] = $field['slider_name'];
        }
        return $slider_name;
    }

}
