<?php
namespace HiBase\Block\Widget\Grid\Column\Filter;

//use HiBase\Block\AbstractBlock;

///**
// * Text grid column filter
// *
// * @category   Mage
// * @package    Mage_Adminhtml
// * @author      Magento Core Team <core@magentocommerce.com>
// */
class Text extends AbstractFilter
{
    public function getHtml()
    {
//        $html = 'AbstractFilter/Text';

        $html = '<input type="text" name="' . $this->_getHtmlName() . '" id="' . $this->_getHtmlId(). '" value="' . $this->getEscapedValue() . '" class="" onkeypress="' . $this->getColumn()->getGrid()->getJsObjectName() . '.doFilter(this, event);"/>';
        return $html;
    }
}
