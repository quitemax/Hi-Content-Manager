<?php


namespace HiBase\Block\Widget\Grid\Column\Renderer;

use HiBase\Block\AbstractBlock;
use HiBase\Block\Widget\Grid\Column\Renderer\ColumnRendererInterface;
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
class AbstractRenderer extends AbstractBlock implements ColumnRendererInterface
{
//abstract class Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
//    extends Mage_Adminhtml_Block_Abstract implements Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Interface
//{
    protected $_defaultWidth;
    protected $_column;
    protected $_row;

    public function setColumn($column)
    {
        $this->_column = $column;
        return $this;
    }

    public function getColumn()
    {
        return $this->_column;
    }
    public function setRow($row)
    {
        $this->_row = $row;
        return $this;
    }

    public function getRow()
    {
        return $this->_row;
    }

    /**
     * Renders grid column
     *
     * @param   Varien_Object $row
     * @return  string
     */
    public function render( $row)
    {
//        if ($this->getColumn()->getEditable()) {
//            $value = $this->_getValue($row);
//            return $value
//                   . ($this->getColumn()->getEditOnly() ? '' : ($value != '' ? '' : '&nbsp;'))
//                   . $this->_getInputValueElement($row);
//        }
//        return $this->_getValue($row);
        return 'row';
    }

//    /**
//     * Render column for export
//     *
//     * @param Varien_Object $row
//     * @return string
//     */
//    public function renderExport(Varien_Object $row)
//    {
//        return $this->render($row);
//    }
//
//    protected function _getValue(Varien_Object $row)
//    {
//        if ($getter = $this->getColumn()->getGetter()) {
//            if (is_string($getter)) {
//                return $row->$getter();
//            } elseif (is_callable($getter)) {
//                return call_user_func($getter, $row);
//            }
//            return '';
//        }
//        return $row->getData($this->getColumn()->getIndex());
//    }
//
//    public function _getInputValueElement(Varien_Object $row)
//    {
//        return  '<input type="text" class="input-text '
//                . $this->getColumn()->getValidateClass()
//                . '" name="' . $this->getColumn()->getId()
//                . '" value="' . $this->_getInputValue($row) . '"/>';
//    }
//
//    protected function _getInputValue(Varien_Object $row)
//    {
//        return $this->_getValue($row);
//    }
//
    public function renderHeader()
    {
        $out = '';
        if (/*false !== $this->getColumn()->getGrid()->getSortable() &&*/ false !== $this->getColumn()->getSortable()) {
            $className = 'not-sort';
            $dir = 'asc';//strtolower($this->getColumn()->getDir());
            $nDir = ($dir=='asc') ? 'desc' : 'asc';
//            if ($this->getColumn()->getDir()) {
                $className = 'sort-arrow-' . $dir;
//            }
            $out = '<a href="#" name="' . $this->getColumn()->getId() . '" title="' . $nDir
                   . '" class="' . $className . '"><span class="sort-title">'
                   . $this->getColumn()->getId().'</span></a>';
        } else {
            $out = $this->getColumn()->getId();
        }
//    \Zend\Debug::dump($this->getColumn());
        return $out;
    }

    public function renderProperty()
    {
        $out = '';
        $width = $this->_defaultWidth;

//        \Zend\Debug::dump($this->getColumn()->getVariables());

        if ($this->getColumn()->hasWidth()) {
            $customWidth = $this->getColumn()->getWidth();
            if ((null === $customWidth) || (preg_match('/^[0-9]+%?$/', $customWidth))) {
                $width = $customWidth;
            }
            elseif (preg_match('/^([0-9]+)px$/', $customWidth, $matches)) {
                $width = (int)$matches[1];
            }
        }

        if (null !== $width) {
            $out .= ' width="' . $width . '"';
        }
//
        return $out;
    }

//    public function renderCss()
//    {
//        return $this->getColumn()->getCssClass();
//    }
//
}
