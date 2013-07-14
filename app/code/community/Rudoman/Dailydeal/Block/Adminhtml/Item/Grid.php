<?php

/**
 * Adminhtml Item Grid Block
 * 
 * @category    Rudoman
 * @package     Rudoman_Dailydeal
 * @author      Evgenia Rudoman (evgenia.rudoman@gmail.com)
 */
class Rudoman_Dailydeal_Block_Adminhtml_Item_Grid extends Mage_Adminhtml_Block_Widget_Grid {

    public function __construct() {
        parent::__construct();
        $this->setId('dailydeal_grid');
        $this->setUseAjax(false);
        $this->setDefaultSort('deals_to_date');
        $this->setDefaultDir('ASC');
        $this->setSaveParametersInSession(true);
    }

    protected function _getStore()
    {
        $storeId = (int) $this->getRequest()->getParam('store', 0);
        return Mage::app()->getStore($storeId);
    }

    /**
     * Prepare grid collection object
     *
     * @return Mage_Adminhtml_Block_Widget_Grid
     */
    protected function _prepareCollection() {
        $collection = Mage::getModel('rudoman_dailydeal/product')->getDailyDeals();
        $this->setCollection($collection);
        $store = $this->_getStore();
        if ($store->getId())
            $this->getCollection()->addStoreFilter($store->getId());

        return parent::_prepareCollection();
    }

    /**
     * Prepare grid columns object
     *
     * @return Mage_Adminhtml_Block_Widget_Grid
     */

    protected function _prepareColumns() {
        $this->addColumn('product_name', array(
            'header' => Mage::helper('rudoman_dailydeal')->__('Product Name'),
            'width' => '20%',
            'index' => 'name'));
        
        $this->addColumn('sku', array(
            'header' => Mage::helper('rudoman_dailydeal')->__('Sku'),
            'width' => '20%',
            'index' => 'sku'));

        $this->addColumn(
                'deals_price', array(
            'header' => Mage::helper('rudoman_dailydeal')->__('Deal (Special) Price'),
            'width' => '2%',
            'index' => 'special_price',
            'type' => 'price',
            'currency_code' => Mage::app()->getStore()->getBaseCurrency()->getCode(),
                )
        );

        $this->addColumn(
                'deals_from_date', array(
            'header' => Mage::helper('rudoman_dailydeal')->__('Start date and time'),
            'width' => '16%',
            'align' => 'center',
            'index' => 'deals_from_date',
            'type' => 'datetime',
            'renderer' => 'rudoman_dailydeal/adminhtml_widget_grid_column_renderer_time',
                )
        );

        $this->addColumn(
                'deals_to_date', array(
            'header' => Mage::helper('rudoman_dailydeal')->__('End date and time'),
            'width' => '16%',
            'align' => 'center',
            'index' => 'deals_to_date',
            'type' => 'datetime',
            'renderer' => 'rudoman_dailydeal/adminhtml_widget_grid_column_renderer_time',
                )
        );

        $this->addColumn(
                'ordered_qty', array(
            'header' => Mage::helper('rudoman_dailydeal')->__('Ordered Qty'),
            'width' => '2%',
            'align' => 'right',
            'filter' => false,
            'index' => 'ordered_qty',
                )
        );
                
        $this->addColumn(
                'status', array(
            'header' => Mage::helper('rudoman_dailydeal')->__('Status'),
            'width' => '10%',
            'type' => 'options',
            //'filter' => false,
            'renderer' => 'rudoman_dailydeal/adminhtml_widget_grid_column_renderer_status',
            'options' => array(
                0 => Mage::helper('rudoman_dailydeal')->__('Deal has ended'),
                1 => Mage::helper('rudoman_dailydeal')->__('Ending soon'),
                2 => Mage::helper('rudoman_dailydeal')->__('Active')))
        );

        $this->addColumn('is_active', array(
            'header' => Mage::helper('rudoman_dailydeal')->__('Active'),
            'index' => 'is_active_deals',
            'type' => 'options',
            'width' => '10%',
            'renderer' => 'rudoman_dailydeal/adminhtml_widget_grid_column_renderer_active',
            'options' => array(
                0 => Mage::helper('rudoman_dailydeal')->__('Disabled'),
                1 => Mage::helper('rudoman_dailydeal')->__('Enabled'))));

        return parent::_prepareColumns();
    }
    
    public function getRowUrl($item) 
    {
        return $url = Mage::helper("adminhtml")->getUrl("adminhtml/catalog_product/edit/", array("id" => $item->getId()));
    }

}
