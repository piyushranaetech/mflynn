<?php

class Excellence_Slider_Model_Slides extends Varien_Object {

    const TOP_LEFT = "Top Left";
    const BOTTOM_LEFT = "Bottom Left";
    const TOP_CENTER = "Top Center";
    const BOTTOM_CENTER = "Bottom Center";
    const TOP_RIGHT = "Top Right";
    const BOTTOM_RIGHT = "Bottom Right";
    
    const SELECT = "---Select Page---";
    const ALL_PAGES = "All Pages";
    const CMS = "CMS Page";
    const PRODUCT_PAGE = "Product Page";
    const CATEGORY_PAGE = "Category Page";
    const CHECKOUT_PAGE = "Checkout Page";
    const CART_PAGE = "Shopping Cart Page";
    
    const SELECT_TYPE = "---Select Slide Type---";
    const FILE = "File";
    const HEADING = "Text";

    static public function getOptionArray() {
        return array(
            1 => self::TOP_LEFT,
            2 => self::BOTTOM_LEFT,
            3 => self::TOP_CENTER,
            4 => self::BOTTOM_CENTER,
            5 => self::TOP_RIGHT,
            6 => self::BOTTOM_RIGHT
        );
    }
    
    static public function getPagesArray() {
        return array(
            0 => self::SELECT,
            1 => self::ALL_PAGES,
            2 => self::CMS,
            3 => self::CATEGORY_PAGE,
            4 => self::PRODUCT_PAGE,
            5 => self::CHECKOUT_PAGE,
            6 => self::CART_PAGE
        );
    }
    
     static public function getTypeArray() {
        return array(
            '' => self::SELECT_TYPE,
            1 => self::FILE,
            2 => self::HEADING,
            
        );
    }

}
