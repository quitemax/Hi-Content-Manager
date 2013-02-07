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

///**
// * @category   Zend
// * @package    Zend_View
// * @subpackage Model
// * @copyright  Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
// * @license    http://framework.zend.com/license/new-bsd     New BSD License
// */
class MassAction extends Checkbox
{
    protected $_defaultWidth = 20;

    /**
     * Render header of the row
     *
     * @return string
     */
    public function renderHeader()
    {
//        $html = '&nbsp;<input type="hidden" name="' . $this->getColumn()->getGrid()->getId() . '['. $this->getColumn()->getId() . '][rest]" ';
//        $html .= 'id="' . $this->getColumn()->getGrid()->getId() . '-' . $this->getColumn()->getId() . '-rest" ';
//        $html .= 'value="0" />';
        $html = '&nbsp;<input type="hidden" name="' . $this->getColumn()->getGrid()->getId() . '['. $this->getColumn()->getId() . '][all]" ';
        $html .= 'id="' . $this->getColumn()->getGrid()->getId() . '-' . $this->getColumn()->getId() . '-all" ';
        $html .= 'value="0" />';
        return $html;
//        return '&nbsp;';
    }

    /**
     * Render HTML properties
     *
     * @return string
     */
    public function renderProperty()
    {
        $out = parent::renderProperty();
        $out = preg_replace('/class=".*?"/i', '', $out);
        $out .= ' class="a-center"';
        return $out;
    }

//    /**
//     * Returns HTML of the object
//     *
//     * @param Varien_Object $row
//     * @return string
//     */
//    public function render(/*Varien_Object*/ $row)
//    {
////        if ($this->getColumn()->getGrid()->getMassactionIdFieldOnlyIndexValue()) {
////            $this->setNoObjectId(true);
////        }
//        return parent::render($row);
//    }

    /**
     * Returns HTML of the checkbox
     *
     * @param string $value
     * @param bool   $checked
     * @return string
     */
    protected function _getCheckboxHtml($value, $checked)
    {
        $html = '<input type="checkbox" name="' . $this->getColumn()->getGrid()->getId() . '['. $this->getColumn()->getId() . '][' . $value . ']" ';
        $html .= 'id="' . $this->getColumn()->getGrid()->getId() . '-' . $this->getColumn()->getId() . '-' . $value . '" ';
        $html .= 'value="' . $value . '" class="massaction-checkbox"' . $checked . '/>';
        $html .= '<input type="hidden" name="' . $this->getColumn()->getGrid()->getId() . '['. $this->getColumn()->getId() . '][' . $value . ']" ';
//        $html .= 'id="' . $this->getColumn()->getGrid()->getId() . '-' . $this->getColumn()->getId() . '-' . $value . '" ';
        $html .= 'value="0"' . '/>';
        return $html;
    }

}
