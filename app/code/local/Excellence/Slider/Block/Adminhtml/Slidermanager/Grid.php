<?php

class Excellence_Slider_Block_Adminhtml_Slidermanager_Grid extends Mage_Adminhtml_Block_Widget_Grid {

    public function __construct() {
        parent::__construct();
        $this->setId('sliderGrid');
        $this->setDefaultSort('slidermanager_id');
        $this->setDefaultDir('ASC');
        $this->setSaveParametersInSession(true);
    }

    protected function _prepareCollection() {
        $collection = Mage::getModel('slider/slidermanager')->getCollection();
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    protected function _prepareColumns() {
        $this->addColumn('slidermanager_id', array(
            'header' => Mage::helper('slider')->__('ID'),
            'align' => 'right',
            'width' => '50px',
            'index' => 'slidermanager_id',
        ));
        
        $this->addColumn('slider_name', array(
            'header' => Mage::helper('slider')->__('Slider Name'),
            'align' => 'left',
            'index' => 'slider_name'
        ));
        
        $pages = Mage::getSingleton('slider/slides')->getPagesArray();
        $this->addColumn('slider_display_page', array(
            'header' => Mage::helper('slider')->__('Show Slider on'),
            'align' => 'left',
            'index' => 'slider_display_page',
            'type' => 'options',
            'options' => $pages,
        ));
        
        $this->addColumn('slider_specific_page', array(
            'header' => Mage::helper('slider')->__('Slider Specific Page'),
            'align' => 'left',
            'index' => 'slider_specific_page',
            'renderer'  => 'slider/adminhtml_slidermanager_renderer_page'
        ));
        
        $slider_position = Mage::getSingleton('slider/slides')->getOptionArray();
        $this->addColumn('slider_position', array(
            'header' => Mage::helper('slider')->__('Slider Position'),
            'align' => 'left',
            'index' => 'slider_position',
            'type' => 'options',
            'options' => $slider_position,
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
        $this->setMassactionIdField('slidermanager_id');
        $this->getMassactionBlock()->setFormFieldName('slidermanager');

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
