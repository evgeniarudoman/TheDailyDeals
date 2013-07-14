<?php

/**
 * Varien data selector form element
 *
 * @category   Rudoman
 * @package    Rudoman_Dailydeal
 * @author     Evgenia Rudoman (evgenia.rudoman@gmail.com)
 */
class Rudoman_Dailydeal_Block_Varien_Data_Form_Element_Date extends Varien_Data_Form_Element_Date
{

    /**
     * Output the input field and assign calendar instance to it.
     * In order to output the date:
     * - the value must be instantiated (Zend_Date)
     * - output format must be set (compatible with Zend_Date)
     *
     * @return string
     */
    public function getElementHtml()
    {
        $this->addClass('input-text');
        $this->setTime(true);
        
        $outputFormat = Rudoman_Dailydeal_Helper_Time::CUSTOM_DATETIME_MEDIUM;
        
        $html = sprintf(
            '<input name="%s" id="%s" value="%s" %s style="width:150px !important;" />'
            .' <img src="%s" alt="" class="v-middle" id="%s_trig" title="%s" style="%s" />',
            $this->getName(), $this->getHtmlId(), $this->_escape($this->getValue($outputFormat)), $this->serialize($this->getHtmlAttributes()),
            $this->getImage(), $this->getHtmlId(), 'Select Date and Time', ($this->getDisabled() ? 'display:none;' : '')
        );
        
        if (empty($outputFormat)) {
            throw new Exception('Output format is not specified. Please, specify "format" key in constructor, or set it using setFormat().');
        }
        $displayFormat = Varien_Date::convertZendToStrFtime($outputFormat, true, (bool)$this->getTime());

        $html .= sprintf('
            <script type="text/javascript">
            //<![CDATA[
                Calendar.setup({
                    inputField: "%s",
                    ifFormat: "%s",
                    showsTime: %s,
                    button: "%s_trig",
                    align: "BR",
                    singleClick : false
                });
            //]]>
            </script>',
            $this->getHtmlId(), $displayFormat,
            $this->getTime() ? 'true' : 'false', $this->getHtmlId()
        );

        $html .= $this->getAfterElementHtml();

        return $html;
    }


}
