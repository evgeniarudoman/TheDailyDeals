<?php

/**
 * Adminhtml Item Block
 * 
 * @category    Rudoman
 * @package     Rudoman_Dailydeal
 * @author      Evgenia Rudoman (evgenia.rudoman@gmail.com)
 */
class Rudoman_Dailydeal_Block_Adminhtml_Item extends Mage_Adminhtml_Block_Widget_Grid_Container
{

    public function __construct()
    {
        $this->_blockGroup = 'rudoman_dailydeal';
        $this->_controller = 'adminhtml_item';
        $this->_headerText = $this->__('Manage Daily Deals');
        parent::__construct();
        $this->_removeButton('add');
    }
}
