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
        if ($this->getColumn()->getEditable()) {
            $value = $this->_getValue($row);
            return $this->_getInputValueElement($row) . $this->getColumn()->getAfterHtml();
        }
        return $this->_getValue($row) . $this->getColumn()->getAfterHtml();
//        return 'row';
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

//    protected function _getIndexValue(/*Varien_Object*/ $row)
//    {
//        $index = $this->getColumn()->getIndex();
//        $value = isset($row[$index]) ? $row[$index] : '';
//
//        \Zend\Debug::dump($row->getId());
//
//        return $value ;
//    }

    protected function _getValue(/*Varien_Object*/ $row)
    {
        $id = $this->getColumn()->getId();
        $value = isset($row[$id]) ? $row[$id] : '';
//        \Zend\Debug::dump($value);
//        \Zend\Debug::dump($this->getAfterHtml());
//        \Zend\Debug::dump((array)$this->getColumn()->getAfterHtml());
//        \Zend\Debug::dump($row);
//        \Zend\Debug::dump($this->getColumn()->getId());
//        if ($getter = $this->getColumn()->getGetter()) {
//            if (is_string($getter)) {
//                return $row->$getter();
//            } elseif (is_callable($getter)) {
//                return call_user_func($getter, $row);
//            }
//            return '';
//        }
//        return $row->getData($this->getColumn()->getIndex());
        return $value ;
    }

    public function _getInputValueElement(/*Varien_Object*/ $row)
    {
        return  '<input type="text" class="input-text '
                . $this->getColumn()->getValidateClass()
                . '" name="' . $this->getColumn()->getGrid()->getId() . '[rows][' . $row->getId() . '][' . $this->getColumn()->getId() . ']'
                . '" value="' . $this->_getInputValue($row) . '"/>';
    }

    protected function _getInputValue(/*Varien_Object*/ $row)
    {
        return $this->_getValue($row);
    }

    public function renderHeader()
    {
        $out = '';
        $title = $this->getColumn()->getLabel();
        if (!$title) {
            $title = $this->getColumn()->getId();
        }
        if (/*false !== $this->getColumn()->getGrid()->getSortable() &&*/ false !== $this->getColumn()->getSortable()) {
            $className = 'not-sort';
//            \Zend\Debug::dump($this->getColumn()->getDir());
            $dir = strtolower($this->getColumn()->getDir());
            $nDir = ($dir != 'desc') ? 'desc' : 'asc';
            $beforeArrow = '';
            $afterArrow = '';
            if ($this->getColumn()->getDir()) {
                if ($dir == 'asc') {
                    $beforeArrow = '<i class="icon-arrow-up pull-right" title=""></i>';
                    $afterArrow = '<i class="icon-arrow-up pull-left" title=""></i>';
                } else {
                    $beforeArrow = '<i class="icon-arrow-down pull-right" title=""></i>';
                    $afterArrow = '<i class="icon-arrow-down pull-left" title=""></i>';
                }
                $className = 'sort-arrow-' . $dir;
            }
            $out = $beforeArrow . '<a href="#" name="' . $this->getColumn()->getId() . '" id="' . $this->getColumn()->getId() . '"title="' . $nDir
                   . '" class="' . $className . '" '
                   . 'onclick="' . $this->getColumn()->getGrid()->getJsObjectName() . '.sort(this)"' . '>'
                   . $title . '</a>'
                   . $afterArrow;
        } else {
            $out = $title;
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
