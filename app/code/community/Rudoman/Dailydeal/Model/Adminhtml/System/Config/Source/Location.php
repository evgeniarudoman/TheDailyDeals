<?php

/**
 * Adminhtml System Config Source Location Model
 * 
 * @category    Rudoman
 * @package     Rudoman_Dailydeal
 * @author      Evgenia Rudoman (evgenia.rudoman@gmail.com)
 */
class Rudoman_Dailydeal_Model_Adminhtml_System_Config_Source_Location
{
    public function toOptionArray()
    {
        return array(
            array(
                'value'=> 'left', 
                'label'=>Mage::helper('adminhtml')->__('Left')
            ),
            array(
                'value'=> 'right', 
                'label'=>Mage::helper('adminhtml')->__('Right')
            ),
        );
    }
}
