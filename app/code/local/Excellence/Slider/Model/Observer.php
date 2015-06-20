<?php

class Excellence_Slider_Model_Observer {

    /*
     * This function dynamically sets the layouts of blocks and child blocks and 
     * inserting the slider on their specific position.
     * From there, the function is also setting the position and id of slider on their blocks file.
     */
    public function set_block($observer) {

        $sliderPosition = Mage::getSingleton('slider/slidermanager')->getSliderPos();
        $data = Mage::getSingleton('slider/slidermanager')->getCollection()->addFieldToSelect('slidermanager_id')->addFieldToSelect('status');
        $i = 0;
        foreach ($data as $row) {
            if ($row['status'] == Excellence_Slider_Model_Status::STATUS_ENABLED) {

                $template = Mage::helper('slider')->checkSliderTemplate($row['slidermanager_id']);

                if ($template) {
                    $spos = $sliderPosition[$i]['slider_position'];
                    $block = $observer->getEvent()->getAction()->getLayout()->createBlock('slider/slider')->setTemplate($template);

                    $modelSlide = Mage::getModel('slider/slider');
                    $sliderData = $modelSlide->getSlidesData($row['slidermanager_id']);
                    
                    if (count($sliderData) <= 1) {
                        $childBlock4 = $observer->getEvent()->getAction()->getLayout()->createBlock('slider/single_slider')->setTemplate('slider/singleslide/slider_single.phtml');
                        
                        $block->setChild('single_slider', $childBlock4);
                        
                        $childBlock4->setSliderData($spos, $row['slidermanager_id']);                  
                    } else {
                        $childBlock1 = $observer->getEvent()->getAction()->getLayout()->createBlock('slider/nivo_slider')->setTemplate('slider/nivo/slider_nivo.phtml');
                        $childBlock2 = $observer->getEvent()->getAction()->getLayout()->createBlock('slider/bxslider_slider')->setTemplate('slider/bxslider/slider_bxslider.phtml');
                        $childBlock3 = $observer->getEvent()->getAction()->getLayout()->createBlock('slider/iscroll_slider')->setTemplate('slider/iscroll/slider_iscroll.phtml');

                        $block->setChild('nivo_slider', $childBlock1);
                        $block->setChild('bxslider_slider', $childBlock2);
                        $block->setChild('iscroll_slider', $childBlock3);

                        $childBlock1->setSliderData($spos, $row['slidermanager_id']);
                        $childBlock2->setSliderData($spos, $row['slidermanager_id']);
                        $childBlock3->setSliderData($spos, $row['slidermanager_id']);
                    }
                    $block->setSliderData($spos, $row['slidermanager_id']);                  


                 
                    if ($spos == Excellence_Slider_Model_SliderPosition::TOP_LEFT || $spos == Excellence_Slider_Model_SliderPosition::BOTTOM_LEFT)
                        $container = 'left';
                    elseif ($spos == Excellence_Slider_Model_SliderPosition::TOP_CENTER || $spos == Excellence_Slider_Model_SliderPosition::BOTTOM_CENTER)
                        $container = "content_slider";
                    elseif ($spos == Excellence_Slider_Model_SliderPosition::TOP_RIGHT || $spos == Excellence_Slider_Model_SliderPosition::BOTTOM_RIGHT)
                        $container = 'footer_slider';

                    $layout = $observer->getEvent()->getAction()->getLayout();
                    $content = $layout->getBlock($container);

                    if ($content) {
                        $content->unsetChild('slider');
                        if ($spos == Excellence_Slider_Model_SliderPosition::TOP_LEFT || $spos == Excellence_Slider_Model_SliderPosition::TOP_CENTER || $spos == Excellence_Slider_Model_SliderPosition::TOP_RIGHT) {
                            $content->insert($block, '', false, 'slider');
                        } elseif ($spos == Excellence_Slider_Model_SliderPosition::BOTTOM_LEFT || $spos == Excellence_Slider_Model_SliderPosition::BOTTOM_CENTER || $spos == Excellence_Slider_Model_SliderPosition::BOTTOM_RIGHT) {
                            $content->insert($block, '', true, 'slider');
                        }
                    }
                }
            }
            $i++;
        }
    }
    
    public function adminhtmlBlockHtmlBefore(Varien_Event_Observer $observer) {
        if (!($observer->getBlock() instanceof Mage_Adminhtml_Block_Page_Menu)) {
            return;
        }
        $config = Mage::getSingleton('admin/config')->getAdminhtmlConfig();
        $menu = $config->getNode('menu');
        $target = $menu->designer->children;
        $templateXml = '<items1 module="slider">
                        <title>_name_</title>
                        <sort_order>0</sort_order>
                        <children>
                            <submenu module="slider">
                                <title>Manage Slides</title>
                                <sort_order>0</sort_order>
                                <action>slider/adminhtml_slider</action>
                            </submenu>
                            <submenu1 module="slider">
                                <title>Manage Slider Pages</title>
                                <sort_order>1</sort_order>
                                <action>slider/adminhtml_slidermanager</action>
                            </submenu1>
                        </children>
                    </items1>';
        $child = simplexml_load_string(
                str_replace(
                        array('_name_'), array('Manage Slider'), $templateXml
                )
        );
        $target->appendChild($child);
    }

    public function handle_adminSystemConfigChangedSection() {
        $configValue = Mage::getStoreConfig(
                        'mycustom_section/mycustom_group1/putname', Mage::app()->getStore()
        );
        $id_path = "designer/";
        $target_path = "designer/index/authors";
        if ($configValue == '') {
            $configValue = $target_path;
            $request_path = "{$configValue}";
        } else {
            $request_path = "{$configValue}.html";
        }
        $mainUrlRewrite = Mage::getModel('core/url_rewrite')
                ->loadByIdPath($id_path);

        if (!$mainUrlRewrite->isObjectNew()) {
            $urlRewriteCollection = Mage::getModel('core/url_rewrite')->getCollection()
                    ->addFilter('target_path', $mainUrlRewrite->getRequestPath())
                    ->addFieldToFilter('url_rewrite_id', array('neq' => $mainUrlRewrite->getUrlRewriteId()))
                    ->load();

            foreach ($urlRewriteCollection as $urlRewrite) {
                if ($urlRewrite->getRequestPath() == $request_path) {
                    $urlRewrite->delete();
                } else {
                    $urlRewrite->setTargetPath($request_path)
                            ->setIsSystem(true)
                            ->setOptions('RP')
                            ->save();
                }
            }
        }

        $mainUrlRewrite->setIdPath($id_path)
                ->setRequestPath($request_path)
                ->setTargetPath($target_path)
                ->setIsSystem(true)
                ->save();
        $this->handle_adminSystemConfigChangedSectionBrand();
    }

    
    public function handle_adminSystemConfigChangedSectionBrand() {
        $configValue = Mage::getStoreConfig(
                        'mycustom_section/mycustom_group1_brand/putname_brand', Mage::app()->getStore()
        );
        $id_path = "designer/1/";
        $target_path = "designer/index/brand";
        if ($configValue == '') {
            $configValue = $target_path;
            $request_path = "{$configValue}";
        } else {
            $request_path = "{$configValue}.html";
        }
        $mainUrlRewrite = Mage::getModel('core/url_rewrite')
                ->loadByIdPath($id_path);

        if (!$mainUrlRewrite->isObjectNew()) {
            $urlRewriteCollection = Mage::getModel('core/url_rewrite')->getCollection()
                    ->addFilter('target_path', $mainUrlRewrite->getRequestPath())
                    ->addFieldToFilter('url_rewrite_id', array('neq' => $mainUrlRewrite->getUrlRewriteId()))
                    ->load();

            foreach ($urlRewriteCollection as $urlRewrite) {
                if ($urlRewrite->getRequestPath() == $request_path) {
                    $urlRewrite->delete();
                } else {
                    $urlRewrite->setTargetPath($request_path)
                            ->setIsSystem(true)
                            ->setOptions('RP')
                            ->save();
                }
            }
        }

        $mainUrlRewrite->setIdPath($id_path)
                ->setRequestPath($request_path)
                ->setTargetPath($target_path)
                ->setIsSystem(true)
                ->save();
    }
   
}
