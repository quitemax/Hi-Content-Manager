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
class Checkbox extends AbstractRenderer
{
    protected $_defaultWidth = 55;
    protected $_values;

    /**
     * Returns values of the column
     *
     * @return array
     */
    public function getValues()
    {
//        if (is_null($this->_values)) {
//            $this->_values = $this->getColumn()->getData('values') ? $this->getColumn()->getData('values') : array();
//        }
        return $this->_values;
    }
//    /**
//     * Renders grid column
//     *
//     * @param   Varien_Object $row
//     * @return  string
//     */
    public function render(/*Varien_Object*/ $row)
    {

        $values = $this->getColumn()->getValues();
        $rowId = $this->getColumn()->getId();
        $index = $this->getColumn()->getIndex();
//        \Zend\Debug::dump($index);
        $rowValue  = isset($row[$rowId]) ? $row[$rowId] : null;
        $idValue = isset($row[$index]) ? $row[$index] : null;
//        \Zend\Debug::dump($rowValue, '$rowValue');
//        \Zend\Debug::dump($idValue, '$idValue');

        if (!$rowValue) {
            $rowValue = $idValue;
        }
        if (is_array($values)) {
            $checked = in_array($rowValue, $values) ? ' checked="checked"' : '';
        }
        else {
            $checked = ($rowValue === $this->getColumn()->getValue()) ? ' checked="checked"' : '';
        }



//        \Zend\Debug::dump($rowValue);
//        \Zend\Debug::dump($values);
//        $disabledValues = $this->getColumn()->getDisabledValues();
//        if (is_array($disabledValues)) {
//            $disabled = in_array($value, $disabledValues) ? ' disabled="disabled"' : '';
//        }
//        else {
//            $disabled = ($value === $this->getColumn()->getDisabledValue()) ? ' disabled="disabled"' : '';
//        }
//
//        $this->setDisabled($disabled);
//
//        if ($this->getNoObjectId() || $this->getColumn()->getUseIndex()){
//            $v = $value;
//        } else {
//            $v = ($row->getId() != "") ? $row->getId():$value;
//        }

        return $this->_getCheckboxHtml(/*$v*/$rowValue, $checked);
    }

    /**
     * @param string $value   Value of the element
     * @param bool   $checked Whether it is checked
     * @return string
     */
    protected function _getCheckboxHtml($value, $checked)
    {
        $html = '<input type="checkbox" ';
        $html .= 'name="' . $this->getColumn()->getFieldName() . '" ';
        $html .= 'value="' . $value . '" ';//$this->escapeHtml(
        $html .= 'class="'. ($this->getColumn()->getInlineCss() ? $this->getColumn()->getInlineCss() : 'checkbox') .'"';
        $html .= $checked . $this->getDisabled() . '/>';
        return $html;
    }

    /**
     * Renders header of the column
     *
     * @return string
     */
    public function renderHeader()
    {
//        if($this->getColumn()->getHeader()) {
//            return parent::renderHeader();
//        }
//
//        $checked = '';
//        if ($filter = $this->getColumn()->getFilter()) {
//            $checked = $filter->getValue() ? ' checked="checked"' : '';
//        }
//
//        $disabled = '';
//        if ($this->getColumn()->getDisabled()) {
//            $disabled = ' disabled="disabled"';
//        }
//        $html = '<input type="checkbox" ';
//        $html .= 'name="' . $this->getColumn()->getFieldName() . '" ';
//        $html .= 'onclick="' . $this->getColumn()->getGrid()->getJsObjectName() . '.checkCheckboxes(this)" ';
//        $html .= 'class="checkbox"' . $checked . $disabled . ' ';
//        $html .= 'title="'.Mage::helper('adminhtml')->__('Select All') . '"/>';
        return '';//$html;
    }
}
