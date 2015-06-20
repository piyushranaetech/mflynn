<?php

class Excellence_Slider_Model_Pages extends Varien_Object {

    const ALL_PAGES = 1;
    const CMS_PAGE = 2;
    const CATEGORY_PAGE = 3;
    const PRODUCT_PAGE = 4;
    const CHECKOUT_PAGE = 5;
    const CART_PAGE = 6;

    static public function getOptionArray() {
        return array(
             self::ALL_PAGES => Mage::helper('slider')->__('All Pages'),
            self::CMS_PAGE => Mage::helper('slider')->__('CMS Page'),
            self::CATEGORY_PAGE => Mage::helper('slider')->__('Category Page'),
            self::PRODUCT_PAGE => Mage::helper('slider')->__('Product Page'),
            self::CHECKOUT_PAGE => Mage::helper('slider')->__('Checkout Page'),
            self::CART_PAGE => Mage::helper('slider')->__('Cart Page')
        );
    }

}
