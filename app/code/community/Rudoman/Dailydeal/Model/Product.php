<?php

/**
 * Product Model
 * 
 * @category    Rudoman
 * @package     Rudoman_Dailydeal
 * @author      Evgenia Rudoman (evgenia.rudoman@gmail.com)
 */
class Rudoman_DailyDeal_Model_Product extends Mage_Core_Model_Abstract
{
    /**
     * Get random daily deal product
     * 
     * @return boolean/Rudoman_Dailydeal_Model_Product
     */
    public function getDailyDealProduct()
    {
        $_collection = $this->_getDailyDealsCollection(true, 'RAND');
        $_collection->load();
        foreach ($_collection->getItems() as $product)
        {
            $stockItem = Mage::getModel('cataloginventory/stock_item')->loadByProduct($product);
            if ($stockItem->getManageStock())
                $product->setQty((int) $stockItem->getQty());
            return $product;
        }
        return false;
    }

    /**
     * Get all deals for adminhtml
     * 
     * @return Rudoman_Dailydeal_Model_Product
     */
    public function getDailyDeals()
    {
        return $this->_getDailyDealsCollection(false, 'ASC');
    }
    
    /**
     * Get all deals for Daily Deals Page
     * 
     * @return Rudoman_Dailydeal_Model_Product
     */
    public function getAllDeals()
    {
        return $this->_getDailyDealsCollection(true, 'ASC');
    }


    private function _getDailyDealsCollection($isActive = false, $sort = null)
    {
        date_default_timezone_set(Rudoman_Dailydeal_Helper_Time::getTimezone());
        $_collection = Mage::getModel('catalog/product')->getCollection()
                ->setStoreId(Mage::app()->getStore()->getId())
                ->addAttributeToSelect('*');
        
        if ($sort == 'ASC')
            $_collection->setOrder('deals_to_date', 'ASC');
        elseif ($sort == 'RAND')
            $_collection->getSelect()->order(new Zend_Db_Expr('RAND()'));

        if ($isActive)
            $_collection->addAttributeToFilter('is_active_deals', array('eq' => 1))
                        ->addAttributeToFilter('deals_to_date', array('gteq' => date('Y-m-d H:i:s')));
        else
            $_collection->addAttributeToFilter('deals_to_date', array('neq' => ''));
        
        foreach ($_collection as $_product)
        {
            $report = Mage::getResourceModel('reports/product_collection')
                    ->addOrderedQty()
                    ->addAttributeToFilter('sku', $_product->getSku())
                    ->load()
                    ->getFirstItem();
            $_product->setOrderedQty((int) $report->getOrderedQty());
        }
        
        return $_collection;
    }


}
