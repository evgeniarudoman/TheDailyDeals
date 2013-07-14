<?php

/**
 * Time Helper
 * 
 * @category    Rudoman
 * @package     Rudoman_Dailydeal
 * @author      Evgenia Rudoman (evgenia.rudoman@gmail.com)
 */
class Rudoman_Dailydeal_Helper_Time
{
    const CONFIG_TIMEZONE = 'general/locale/timezone';
    
    const CUSTOM_DATETIME_FULL_WITH_TIMEZONE = 'MMMM dd, yyyy HH:mm z';
    const CUSTOM_DATETIME_MEDIUM = 'MM/dd/yyyy HH:mm';
    
    const DATETIME_FULL = 'M j, Y H:i:s';
    const DATETIME_MEDIUM = 'Y-m-d H:i:s';
    
    public static function getTimezone()
    {
        return Mage::app()->getStore()->getConfig(self::CONFIG_TIMEZONE);
    }
    
    public static function getDifferenceTime($dealsToDate, $difference = false)
    {
        date_default_timezone_set(self::getTimezone());
        $now = date_create(date(self::DATETIME_MEDIUM, Mage::app()->getLocale()->storeTimeStamp()));
        $dealsToDate = date_create($dealsToDate);
        $interval = date_diff($now, $dealsToDate);

        if ($difference)
            return $dealsToDate->format(self::DATETIME_FULL);
        else
        {
            if (!$interval->invert)
            {
                $leftDays = (int) $interval->format('%d');
                if ($leftDays == 0)
                    return 1;
            }
            else
                return 0;
            return 2;
        }
    }
    
    public static function getTimeOffset()
    {
        $offset = Mage::getModel('core/date')->calculateOffset(self::getTimezone());
        return ($offset < 0 ? '' : '+') . round($offset / 3600);
    }


}
