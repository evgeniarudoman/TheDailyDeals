<?php

/**
 * Data Helper
 * 
 * @category    Rudoman
 * @package     Rudoman_Dailydeal
 * @author      Evgenia Rudoman (evgenia.rudoman@gmail.com)
 */
class Rudoman_Dailydeal_Helper_Data extends Mage_Core_Helper_Abstract
{    
    const CONFIG_DAILYDEAL_COLUMNS = 'rudoman_dailydeal/columns/' ;
    const CONFIG_DAILYDEAL_META = 'rudoman_dailydeal/meta/' ;
    
    public static function getDailyDealConfig($field)
    {
        return Mage::getStoreConfig(self::CONFIG_DAILYDEAL_COLUMNS . $field);
    }

    public static function getMetaConfig($field)
    {
        return Mage::getStoreConfig(self::CONFIG_DAILYDEAL_META . $field);
    }
    
    public static function getProductQty($product)
    {
        $stockItem = Mage::getModel('cataloginventory/stock_item')->loadByProduct($product);
        if ($stockItem->getManageStock())
            return (int) $stockItem->getQty();
        return false;
    }


    public static function getTemplate()
    {
        $layoutCode = self::getDailyDealConfig('layout');
        $template = Mage::getSingleton('page/config')->getPageLayout($layoutCode);
        return $template->getTemplate();
    }


}
