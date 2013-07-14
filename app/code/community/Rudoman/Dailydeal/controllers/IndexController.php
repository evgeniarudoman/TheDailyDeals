<?php

/**
 * Dailydeal Controller
 * 
 * @category    Rudoman
 * @package     Rudoman_Dailydeal
 * @author      Evgenia Rudoman (evgenia.rudoman@gmail.com)
 */
class Rudoman_Dailydeal_IndexController extends Mage_Core_Controller_Front_Action
{

    /**
     * Display the daily deals
     * 
     */
    public function indexAction()
    {
        if (!Rudoman_Dailydeal_Helper_Data::getDailyDealConfig('display'))
            $this->_forward('defaultNoRoute');
        else
            $this->loadLayout()->renderLayout();
    }


}
