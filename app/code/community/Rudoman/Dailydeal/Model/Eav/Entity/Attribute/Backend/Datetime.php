<?php

/**
 * Entity Attribute Backend Datetime Model
 * 
 * @category    Rudoman
 * @package     Rudoman_Dailydeal
 * @author      Evgenia Rudoman (evgenia.rudoman@gmail.com)
 */
class Rudoman_Dailydeal_Model_Eav_Entity_Attribute_Backend_Datetime extends Mage_Eav_Model_Entity_Attribute_Backend_Datetime
{

    /**
     * Prepare date for save in DB
     *
     * string format used from input fields (all date input fields need apply locale settings)
     * int value can be declared in code (this meen whot we use valid date)
     *
     * @param   string | int $date
     * @return  string
     */
    public function formatDate($date)
    {
        if (empty($date)) {
            return null;
        }
        // unix timestamp given - simply instantiate date object
        if (preg_match('/^[0-9]+$/', $date)) {
            $date = new Zend_Date((int)$date);
        }
        // parse this date in current locale, do not apply GMT offset
        else {
            $date = Mage::app()->getLocale()->date($date, null, null, false);
        }
        
        return $date->toString(Rudoman_Dailydeal_Helper_Time::CUSTOM_DATETIME_FULL_WITH_TIMEZONE);
    }


}
