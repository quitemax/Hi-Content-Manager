<?php


namespace HiBase\Block\Widget\Grid\Column\Renderer;

//use HiBase\Block\Widget\Grid\Column\Renderer\AbstractRenderer;
//use Zend\View\Renderer\RendererInterface;
//use Zend\View\Renderer\TreeRendererInterface;
//use Zend\View\Resolver\ResolverInterface;
//use Zend\View\Variables;
//use ArrayAccess;
//use Zend\Filter\FilterChain;
//use Zend\View\Resolver\TemplatePathStack;

/**
 * Adminhtml grid item renderer number
 *
 * @category   Mage
 * @package    Mage_Adminhtml
 * @author     Magento Core Team <core@magentocommerce.com>
// */
class Number extends AbstractRenderer
{
    protected $_defaultWidth = 100;

//    /**
//     * Returns value of the row
//     *
////     * @param Varien_Object $row
//     * @return mixed|string
//     */
    protected function _getValue(/*Varien_Object*/ $row)
    {
        $data = parent::_getValue($row);
        if (!is_null($data)) {
            $value = $data * 1;
            $sign = (bool)(int)$this->getColumn()->getShowNumberSign() && ($value > 0) ? '+' : '';
            if ($sign) {
                $value = $sign . $value;
            }
            return $value ? $value : '0'; // fixed for showing zero in grid
        }
        return $this->getColumn()->getDefault();
    }

    public function _getInputValueElement(/*Varien_Object*/ $row)
    {
        return  '<input type="text" class="input-text-number '
                . $this->getColumn()->getValidateClass()
                . '" name="' . $this->getColumn()->getId()
                . '" value="' . $this->_getInputValue($row) . '"/>';
    }

    /**
     * Renders CSS
     *
     * @return string
     */
    public function renderCss()
    {
        return parent::renderCss() . ' a-right';
    }

}
