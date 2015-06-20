<?php

class Excellence_Slider_Block_Adminhtml_Slider_Grid extends Mage_Adminhtml_Block_Widget_Grid {

    public function __construct() {
        parent::__construct();
        $this->setId('sliderGrid');
        $this->setDefaultSort('slider_id');
        $this->setDefaultDir('ASC');
        $this->setSaveParametersInSession(true);
    }

    protected function _prepareCollection() {
        $collection = Mage::getModel('slider/slider')->getCollection();
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    protected function _prepareColumns() {
        $this->addColumn('slider_id', array(
            'header' => Mage::helper('slider')->__('ID'),
            'align' => 'right',
            'width' => '50px',
            'index' => 'slider_id',
        ));
        
        $this->addColumn('image_name', array(
            'header' => Mage::helper('slider')->__('Image Name'),
            'align' => 'left',
            'width' => '50px',
            'index' => 'image_name',
        ));
        
        $this->addColumn('slider_ida', array(
            'header' => Mage::helper('slider')->__('Slider Image'),
            'align' => 'left',
            'index' => 'filename',
            'renderer' => 'slider/adminhtml_slider_renderer_image'
        ));
        
        $this->addColumn('title', array(
            'header' => Mage::helper('slider')->__('Caption'),
            'align' => 'left',
            'index' => 'title',
        ));
        
        $slider = Mage::helper('slider')->getSliderName();
        $this->addColumn('slider_name', array(
            'header' => Mage::helper('slider')->__('Show Slides on'),
            'align' => 'left',
            'index' => 'slider_name',
            'type' => 'options',
            'options' => $slider
        ));
        
        $this->addColumn('image_position', array(
            'header' => Mage::helper('slider')->__('Image Position'),
            'align' => 'center',
            'width' => '50px',
            'index' => 'image_position',
        ));

        $this->addColumn('status', array(
            'header' => Mage::helper('slider')->__('Status'),
            'align' => 'left',
            'width' => '80px',
            'index' => 'status',
            'type' => 'options',
            'options' => array(
                1 => 'Enabled',
                2 => 'Disabled',
            ),
        ));

        $this->addColumn('action', array(
            'header' => Mage::helper('slider')->__('Action'),
            'width' => '100',
            'type' => 'action',
            'getter' => 'getId',
            'actions' => array(
                array(
                    'caption' => Mage::helper('slider')->__('Edit'),
                    'url' => array('base' => '*/*/edit'),
                    'field' => 'id'
                )
            ),
            'filter' => false,
            'sortable' => false,
            'index' => 'stores',
            'is_system' => true,
        ));



        return parent::_prepareColumns();
    }

    protected function _prepareMassaction() {
        $this->setMassactionIdField('slider_id');
        $this->getMassactionBlock()->setFormFieldName('slider');

        $this->getMassactionBlock()->addItem('delete', array(
            'label' => Mage::helper('slider')->__('Delete'),
            'url' => $this->getUrl('*/*/massDelete'),
            'confirm' => Mage::helper('slider')->__('Are you sure?')
        ));

        $statuses = Mage::getSingleton('slider/status')->getOptionArray();

        array_unshift($statuses, array('label' => '', 'value' => ''));
        $this->getMassactionBlock()->addItem('status', array(
            'label' => Mage::helper('slider')->__('Change status'),
            'url' => $this->getUrl('*/*/massStatus', array('_current' => true)),
            'additional' => array(
                'visibility' => array(
                    'name' => 'status',
                    'type' => 'select',
                    'class' => 'required-entry',
                    'label' => Mage::helper('slider')->__('Status'),
                    'values' => $statuses
                )
            )
        ));
        return $this;
    }

    public function getRowUrl($row) {
        return $this->getUrl('*/*/edit', array('id' => $row->getId()));
    }

}
