<?php

class Excellence_Slider_Adminhtml_SlidermanagerController extends Mage_Adminhtml_Controller_action {

    protected function _initAction() {
        $this->loadLayout()
                ->_setActiveMenu('slider/items')
                ->_addBreadcrumb(Mage::helper('adminhtml')->__('Slider Manager'), Mage::helper('adminhtml')->__('Slider Manager'));

        return $this;
    }

    public function indexAction() {
        $this->_initAction()
                ->renderLayout();
    }

    public function getproductAction() {

        $currentUrl = Mage::app()->getRequest()->getServer('HTTP_REFERER');
        $id = explode('id/', $currentUrl);

        $id = explode('/', $id[1]);
        $model = Mage::getModel('slider/slidermanager')->load($id[0]);
        $option_selected = $model->getData("slider_specific_display_page_product");

        $array = "";
        $product_pages = Mage::getSingleton('slider/slidermanager')->getProductPages();
        foreach ($product_pages as $key => $value) {
            if ($key == $option_selected) {
                $array = $array . "<option value='" . $key . "' selected='selected'>" . $value . "</option>";
            } else {
                $array = $array . "<option value='" . $key . "'>" . $value . "</option>";
            }
        }
        $this->getResponse()->setBody($array);
        return;
    }

    public function getcategoryAction() {
        $currentUrl = Mage::app()->getRequest()->getServer('HTTP_REFERER');
        $id = explode('id/', $currentUrl);

        $id = explode('/', $id[1]);
        $model = Mage::getModel('slider/slidermanager')->load($id[0]);
        $option_selected = $model->getData("slider_specific_display_page_category");

        $array = "";
        $category_pages = Mage::getSingleton('slider/slidermanager')->getCategoryPages();

        foreach ($category_pages as $key => $value) {
            if (is_array($value)) {
                if ($value['value'] == $option_selected) {
                    $array = $array . "<option value='" . $value['value'] . "' selected='selected'>" . $value['label'] . "</option>";
                } else {
                    $array = $array . "<option value='" . $value['value'] . "'>" . $value['label'] . "</option>";
                }
            } else {
                $array = $array . "<option value='" . $key . "'>" . $value . "</option>";
            }
        }
        $this->getResponse()->setBody($array);
        return;
    }

    public function editAction() {
        $id = $this->getRequest()->getParam('id');
        $model = Mage::getModel('slider/slidermanager')->load($id);

        if ($model->getId() || $id == 0) {
            $data = Mage::getSingleton('adminhtml/session')->getFormData(true);
            if (!empty($data)) {
                $model->setData($data);
            }

            Mage::register('slider_data', $model);

            $this->loadLayout();
            $this->_setActiveMenu('slider/items');

            $this->_addBreadcrumb(Mage::helper('adminhtml')->__('Slider Manager'), Mage::helper('adminhtml')->__('Slider Manager'));
            $this->_addBreadcrumb(Mage::helper('adminhtml')->__('Item News'), Mage::helper('adminhtml')->__('Item News'));

            $this->getLayout()->getBlock('head')->setCanLoadExtJs(true);

            $this->_addContent($this->getLayout()->createBlock('slider/adminhtml_slidermanager_edit'))
                    ->_addLeft($this->getLayout()->createBlock('slider/adminhtml_slidermanager_edit_tabs'));

            $this->renderLayout();
        } else {
            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('slider')->__('Item does not exist'));
            $this->_redirect('*/*/');
        }
    }

    public function newAction() {
        $this->_forward('edit');
    }

    public function saveAction() {
        if ($data = $this->getRequest()->getPost()) {

            if ($data) {
                $model = Mage::getModel('slider/slidermanager');
                $model->setData($data)
                        ->setId($this->getRequest()->getParam('id'));

                try {
                    if ($model->getCreatedTime == NULL || $model->getUpdateTime() == NULL) {
                        $model->setCreatedTime(now())
                                ->setUpdateTime(now());
                    } else {
                        $model->setUpdateTime(now());
                    }

                    $model->save();
                    Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('slider')->__('Item was successfully saved'));
                    Mage::getSingleton('adminhtml/session')->setFormData(false);

                    if ($this->getRequest()->getParam('back')) {
                        $this->_redirect('*/*/edit', array('id' => $model->getId()));
                        return;
                    }
                    $this->_redirect('*/*/');
                    return;
                } catch (Exception $e) {
                    Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                    Mage::getSingleton('adminhtml/session')->setFormData($data);
                    $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
                    return;
                }
            } else {
                Mage::getSingleton('adminhtml/session')->addError(Mage::helper('slider')->__('Unable to find file'));
            }
        }
        Mage::getSingleton('adminhtml/session')->addError(Mage::helper('slider')->__('Unable to find item to save'));
        $this->_redirect('*/*/');
    }

    public function deleteAction() {
        if ($this->getRequest()->getParam('id') > 0) {
            try {
                $model = Mage::getModel('slider/slidermanager');

                $model->setId($this->getRequest()->getParam('id'))
                        ->delete();

                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('adminhtml')->__('Item was successfully deleted'));
                $this->_redirect('*/*/');
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
            }
        }
        $this->_redirect('*/*/');
    }

    public function massDeleteAction() {
        $sliderIds = $this->getRequest()->getParam('slidermanager');
        if (!is_array($sliderIds)) {
            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('adminhtml')->__('Please select item(s)'));
        } else {
            try {
                foreach ($sliderIds as $sliderId) {
                    $slider = Mage::getModel('slider/slidermanager')->load($sliderId);
                    $slider->delete();
                }
                Mage::getSingleton('adminhtml/session')->addSuccess(
                        Mage::helper('adminhtml')->__(
                                'Total of %d record(s) were successfully deleted', count($sliderIds)
                        )
                );
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            }
        }
        $this->_redirect('*/*/index');
    }

    public function massStatusAction() {
        $sliderIds = $this->getRequest()->getParam('slidermanager');
        if (!is_array($sliderIds)) {
            Mage::getSingleton('adminhtml/session')->addError($this->__('Please select item(s)'));
        } else {
            try {
                foreach ($sliderIds as $sliderId) {
                    $slider = Mage::getSingleton('slider/slidermanager')
                            ->load($sliderId)
                            ->setStatus($this->getRequest()->getParam('status'))
                            ->setIsMassupdate(true)
                            ->save();
                }
                $this->_getSession()->addSuccess(
                        $this->__('Total of %d record(s) were successfully updated', count($sliderIds))
                );
            } catch (Exception $e) {
                $this->_getSession()->addError($e->getMessage());
            }
        }
        $this->_redirect('*/*/index');
    }

    public function exportCsvAction() {
        $fileName = 'slidermanager.csv';
        $content = $this->getLayout()->createBlock('slider/adminhtml_slidermanager_grid')
                ->getCsv();

        $this->_sendUploadResponse($fileName, $content);
    }

    public function exportXmlAction() {
        $fileName = 'slidermanager.xml';
        $content = $this->getLayout()->createBlock('slider/adminhtml_slidermanager_grid')
                ->getXml();

        $this->_sendUploadResponse($fileName, $content);
    }

    protected function _sendUploadResponse($fileName, $content, $contentType = 'application/octet-stream') {
        $response = $this->getResponse();
        $response->setHeader('HTTP/1.1 200 OK', '');
        $response->setHeader('Pragma', 'public', true);
        $response->setHeader('Cache-Control', 'must-revalidate, post-check=0, pre-check=0', true);
        $response->setHeader('Content-Disposition', 'attachment; filename=' . $fileName);
        $response->setHeader('Last-Modified', date('r'));
        $response->setHeader('Accept-Ranges', 'bytes');
        $response->setHeader('Content-Length', strlen($content));
        $response->setHeader('Content-type', $contentType);
        $response->setBody($content);
        $response->sendResponse();
        die;
    }

}
