<?php

/**
 * Adminhtml Widget Grid Renderer Status Block
 * 
 * @category    Rudoman
 * @package     Rudoman_Dailydeal
 * @author      Evgenia Rudoman (evgenia.rudoman@gmail.com)
 */
class Rudoman_Dailydeal_Block_Adminhtml_Widget_Grid_Column_Renderer_Status 
    extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Text
{

    /**
     * Renders grid column
     *
     * @param   Varien_Object $row
     * @return  string
     */
    public function render(Varien_Object $row)
    {
        $options = $this->getColumn()->getOptions();
        $showMissingOptionValues = (bool)$this->getColumn()->getShowMissingOptionValues();
        if (!empty($options) && is_array($options)) {
            $value = $row->getData('status');
            $differenceTime = Rudoman_Dailydeal_Helper_Time::getDifferenceTime($row->getDealsToDate());
            if (isset($options[$value]) && $value == $differenceTime) {
                if ($row->getIsActiveDeals())
                {
                    switch ($differenceTime)
                    {
                        case 1:
                            $span = '<span class="endingSoonDeal floatRight colorColumn">' . $this->escapeHtml($options[$value]) . '</span>';
                            break;
                        case 0:
                            $span = '<span class="endedDeal floatRight colorColumn">' . $this->escapeHtml($options[$value]) . '</span>';
                            break;
                        case 2:
                        default:
                            $span = 'Active';
                            break;
                    }
                }
                return $span;
            } elseif (in_array($value, $options)) {
                $a=$value;
                return $this->escapeHtml($value);
            }
//            else
//            {
//                $differenceTime = Rudoman_Dailydeal_Helper_Time::getDifferenceTime($row->getDealsToDate());
//                if ($row->getIsActiveDeals())
//                {
//                    switch ($differenceTime)
//                    {
//                        case 1:
//                            $span = '<span class="endingSoonDeal floatRight colorColumn">Ending soon</span>';
//                            break;
//                        case 0:
//                            $span = '<span class="endedDeal floatRight colorColumn">Deal has ended</span>';
//                            break;
//                        case 2:
//                        default:
//                            $span = '';
//                            break;
//                    }
//                }
//                return $span;
//            }
        }
    }


}
