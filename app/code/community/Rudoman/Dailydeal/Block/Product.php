<?php

/**
 * Product Block
 * 
 * @category    Rudoman
 * @package     Rudoman_Dailydeal
 * @author      Evgenia Rudoman (evgenia.rudoman@gmail.com)
 */
class Rudoman_Dailydeal_Block_Product extends Mage_Catalog_Block_Product_Abstract
{
    protected $_priceBlockDefaultTemplate = 'dailydeals/catalog/product/price.phtml';
    
    public function _prepareLayout() 
    {
        $head = $this->getLayout()->getBlock('head');
        $head->setTitle(Rudoman_Dailydeal_Helper_Data::getMetaConfig('meta_title'));
        $head->setDescription(Rudoman_Dailydeal_Helper_Data::getMetaConfig('meta_description'));
        $head->setKeywords(Rudoman_Dailydeal_Helper_Data::getMetaConfig('meta_keywords'));
        parent::_prepareLayout();
    }

    /**
     * Get all deals for Daily Deal Page
     * 
     * @return Rudoman_Dailydeal_Model_Product
     */
    public function getAllDeals()
    {
        return Mage::getModel('rudoman_dailydeal/product')->getAllDeals();
    }


    /**
     * Get one daily deal
     * 
     * @return Rudoman_Dailydeal_Model_Product 
     */
    public function getDailyDealProduct()
    {
        return Mage::getModel('rudoman_dailydeal/product')->getDailyDealProduct();
    }


    /**
     * Set product for deal template
     * 
     * @param Mage_Catalog_Model_Product $product
     * @return type 
     */
    public function getDeal($product)
    {
        $this->setTemplate('dailydeals/deal.phtml');
        $this->setDealProduct($product);
        return $this->toHtml();
    }
    
    public function getBanner()
    {
       if ($banner = Rudoman_Dailydeal_Helper_Data::getDailyDealConfig('banner'))
            return Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_MEDIA) . 'theme/' . $banner;
    }
    
        /**
     * Returns product price block html
     *
     * @param Mage_Catalog_Model_Product $product
     * @param boolean $displayMinimalPrice
     * @param string $idSuffix
     * @return string
     */
    public function getPriceHtml($product, $displayMinimalPrice = false, $idSuffix = '')
    {
        $type_id = $product->getTypeId();
        if (Mage::helper('catalog')->canApplyMsrp($product)) {
            $realPriceHtml = $this->_preparePriceRenderer($type_id)
                ->setProduct($product)
                ->setDisplayMinimalPrice($displayMinimalPrice)
                ->setIdSuffix($idSuffix)
                ->toHtml();
            $product->setAddToCartUrl($this->getAddToCartUrl($product));
            $product->setRealPriceHtml($realPriceHtml);
            $type_id = $this->_mapRenderer;
        }

        return $this->_preparePriceRenderer($type_id)
            ->setProduct($product)
            ->setDisplayMinimalPrice($displayMinimalPrice)
            ->setIdSuffix($idSuffix)
            ->toHtml();
    }

     public function ifEquals($key)
    {
        $block = Rudoman_Dailydeal_Helper_Data::getDailyDealConfig('deal_block');
        if ($key != $block)
            return false;
        return true;
    }

}
