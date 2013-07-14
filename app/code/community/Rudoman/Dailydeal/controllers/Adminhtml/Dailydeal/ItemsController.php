<?php

/**
 * Adminhtml Dailydeal Item Controller
 * 
 * @category    Rudoman
 * @package     Rudoman_Dailydeal
 * @author      Evgenia Rudoman (evgenia.rudoman@gmail.com)
 */

class Rudoman_Dailydeal_Adminhtml_Dailydeal_ItemsController extends Mage_Adminhtml_Controller_Action
{

    protected function _initAction()
    {
        $this->_usedModuleName = 'rudoman_dailydeal';

        $this->loadLayout()
                ->_setActiveMenu('dailydeal/dailydeal')
                ->_addBreadcrumb($this->__('CMS'), $this->__('CMS'))
                ->_addBreadcrumb($this->__('Dailydeal'), $this->__('Daily Deal'));

        return $this;
    }


    /**
     * Display daily deals in grid
     * 
     */
    public function indexAction()
    {
        $this->_initAction()
                ->_addContent($this->getLayout()->createBlock('rudoman_dailydeal/adminhtml_item'))
                ->renderLayout();
    }


}
