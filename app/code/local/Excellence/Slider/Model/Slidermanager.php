<?php

class Excellence_Slider_Model_Slidermanager extends Mage_Core_Model_Abstract {

    public function _construct() {
        parent::_construct();
        $this->_init('slider/slidermanager');
    }
    
    /*
     * This function is fetching the name of the CMS pages on that magento site.
     */
    public function getCmsPages() {
        $result = $this->getResource()->getCmsPage();
        $title = array();
        $title[0] = '----Please Select----';
        foreach ($result as $step) {
            $title[$step['page_id']] = $step['title'];
        }
        return $title;
    }
    
    /*
     * This function is fetching the name of the Product pages on that magento site.
     */
    public function getProductPages() {

        $result = $this->getResource()->getProductPage();
        $product = array();
        $model = Mage::getModel('catalog/product');
        $product[0] = '----Select Product----';
        foreach ($result as $step) {
            $_product = $model->load($step['entity_id']);
            $product[$step['entity_id']] = $step['sku'] . ' ' . $_product->getName();
        }
        return $product;
    }

    /*
     * This function is fetching the name of the Category pages on that magento site.
     */
    public function getCategoryPages() {

        $categoriesArray = Mage::getModel('catalog/category')
                ->getCollection()
                ->addAttributeToSelect('name')
                ->addAttributeToSort('path')
                ->load()
                ->toArray();

        $categories = array();
        $categories[0] = '----Select Category----';
        foreach ($categoriesArray as $categoryId => $category) {
            if (isset($category['name']) && isset($category['level']) && $category['level'] != 0) {
                $name = "";
                if ($category['level'] > 2) {
                    for ($i = 0; $i < $category['level']-2; $i++) {
                        $name = '....' . $name;
                    }
                }

                $name = $name . $category['name'];
                $categories[] = array(
                    'label' => $name,
                    'level' => $category['level'],
                    'value' => $categoryId
                );
            }
        }

        return $categories;
    }

    public function getSliderPos() {
        $sliderpos = $this->getResource()->getSliderPos();
        return $sliderpos;
    }

}
