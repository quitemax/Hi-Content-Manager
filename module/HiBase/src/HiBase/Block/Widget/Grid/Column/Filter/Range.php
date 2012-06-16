<?php
namespace HiBase\Block\Widget\Grid\Column\Filter;

//use HiBase\Block\AbstractBlock;

///**
// * Range grid column filter
// *
// * @category   Mage
// * @package    Mage_Adminhtml
// * @author      Magento Core Team <core@magentocommerce.com>
// */
class Range extends AbstractFilter
{
    public function getHtml()
    {
        $html = '<div class="range"><div class="range-line"><span class="label">' . $this->__('From').':</span> <input type="text" name="'.$this->getColumn()->getGrid()->getHtmlId().'[filter]['.$this->_getHtmlName().'][from]" id="'.$this->_getHtmlId().'_from" value="'.$this->getEscapedValue('from').'" onkeypress="' . $this->getColumn()->getGrid()->getJsObjectName() . '.doFilter(this, event);" class="input-text no-changes"/></div>';
        $html .= '<div class="range-line"><span class="label">' . $this->__('To').':</span> <input type="text" name="'.$this->getColumn()->getGrid()->getHtmlId().'[filter]['.$this->_getHtmlName().'][to]" id="'.$this->_getHtmlId().'_to" value="'.$this->getEscapedValue('to').'" onkeypress="' . $this->getColumn()->getGrid()->getJsObjectName() . '.doFilter(this, event);" class="input-text no-changes"/></div></div>';
        return $html;
    }

    /**
     * Retrieve escaped value
     *
     * @param mixed $index
     * @return string
     */
//    public function getEscapedValue($index = null)
//    {
//        return htmlspecialchars($this->getValue($index, ''));
//    }

    public function getValue($index=null)
    {
        if ($index) {
            return $this->getVariable('value', $index);
        }
        $value = $this->getVariable('value');
        if ((isset($value['from']) && strlen($value['from']) > 0) || (isset($value['to']) && strlen($value['to']) > 0)) {
            return $value;
        }
        return null;
    }
//
//
//    public function getCondition()
//    {
//        $value = $this->getValue();
//        return $value;
//    }

}
