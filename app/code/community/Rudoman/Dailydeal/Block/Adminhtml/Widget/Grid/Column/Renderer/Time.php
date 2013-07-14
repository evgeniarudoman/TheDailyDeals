<?php

/**
 * Adminhtml Widget Grid Renderer Time Block
 * 
 * @category    Rudoman
 * @package     Rudoman_Dailydeal
 * @author      Evgenia Rudoman (evgenia.rudoman@gmail.com)
 */
class Rudoman_Dailydeal_Block_Adminhtml_Widget_Grid_Column_Renderer_Time extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{

    /**
     * Renders grid column
     *
     * @param   Varien_Object $row
     * @return  string
     */
    public function render(Varien_Object $row)
    {
        if ($data = $this->_getValue($row))
        {
            date_default_timezone_set(Rudoman_Dailydeal_Helper_Time::getTimezone());
            $format = Rudoman_Dailydeal_Helper_Time::CUSTOM_DATETIME_FULL_WITH_TIMEZONE;
            $data = Mage::app()->getLocale()
                            ->date($data, Varien_Date::DATETIME_INTERNAL_FORMAT, null, true)->toString($format);
            
            return $data;
        }
        return $this->getColumn()->getDefault();
    }


}
