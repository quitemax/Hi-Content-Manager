<?php


namespace HiBase\Block\Widget\Grid;

use HiBase\Block\Widget;
use HiBase\Block\Widget\Grid\Column\Renderer;
use HiBase\Block\Widget\Grid\Column\Filter;
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
class Column extends Widget
{
    protected $_grid;
    protected $_renderer;
    protected $_filter;
//    protected $_type;
//    protected $_cssClass=null;
//


    public function setGrid($grid)
    {
        //
        $this->_grid = $grid;

        // Init filter object
        $this->getFilter();

        //
        return $this;
    }

    public function getGrid()
    {
        return $this->_grid;
    }

    public function isLast()
    {
        return $this->getId() == $this->getGrid()->getLastColumnId();
    }

    public function getHtmlProperty()
    {
//        \Zend\Debug::dump($this->getVariables());
        return $this->getRenderer()->renderProperty();
    }

    public function getHeaderHtml()
    {
        return $this->getRenderer()->renderHeader();
    }

//    public function getCssClass()
//    {
//        if (is_null($this->_cssClass)) {
//            if ($this->getAlign()) {
//                $this->_cssClass .= 'a-'.$this->getAlign();
//            }
//            // Add a custom css class for column
//            if ($this->hasData('column_css_class')) {
//                $this->_cssClass .= ' '. $this->getData('column_css_class');
//            }
//            if ($this->getEditable()) {
//                $this->_cssClass .= ' editable';
//            }
//        }
//
//        return $this->_cssClass;
//    }

    public function getCssProperty()
    {
        return $this->getRenderer()->renderCss();
    }

    public function getHeaderCssClass()
    {

//        \Zend\Debug::dump(get_class($this->getGrid()));
        $class = $this->getVariable('header_css_class');
        if (($this->getSortable()===false) || ($this->getGrid()->getSortable()===false)) {
            $class .= ' no-link';
        }
        if ($this->isLast()) {
            $class .= ' last';
        }
        return $class;
    }

    public function getHeaderHtmlProperty()
    {
        $str =  $this->getHtmlProperty();

        $class = '';

//        if ($cssProp = $this->getCssProperty()) {
//            $class .= $cssProp;
//        }

        if ($cssProp = $this->getHeaderCssClass()) {
            $class .= $cssProp;
        }

        $str.= ' class="'.$class.'"';

        return $str;
    }

    /**
     * Retrieve row column field value for display
     *
     * @param   Varien_Object $row
     * @return  string
     */
    public function getRowField(/*Varien_Object*/ $row)
    {
        $renderedValue = $this->getRenderer()->render($row);
//        if ($this->getHtmlDecorators()) {
//            $renderedValue = $this->_applyDecorators($renderedValue, $this->getHtmlDecorators());
//        }

        /*
         * if column has determined callback for framing call
         * it before give away rendered value
         *
         * callback_function($renderedValue, $row, $column, $isExport)
         * should return new version of rendered value
         */
//        $frameCallback = $this->getFrameCallback();
//        if (is_array($frameCallback)) {
//            $renderedValue = call_user_func($frameCallback, $renderedValue, $row, $this, false);
//        }

        return $renderedValue;
    }
//
//    /**
//     * Retrieve row column field value for export
//     *
//     * @param   Varien_Object $row
//     * @return  string
//     */
//    public function getRowFieldExport(Varien_Object $row)
//    {
//        $renderedValue = $this->getRenderer()->renderExport($row);
//
//        /*
//         * if column has determined callback for framing call
//         * it before give away rendered value
//         *
//         * callback_function($renderedValue, $row, $column, $isExport)
//         * should return new version of rendered value
//         */
//        $frameCallback = $this->getFrameCallback();
//        if (is_array($frameCallback)) {
//            $renderedValue = call_user_func($frameCallback, $renderedValue, $row, $this, true);
//        }
//
//        return $renderedValue;
//    }
//
//    /**
//     * Decorate rendered cell value
//     *
//     * @param string $value
//     * @param array|string $decorators
//     * @return string
//     */
//    protected function &_applyDecorators($value, $decorators)
//    {
//        if (!is_array($decorators)) {
//            if (is_string($decorators)) {
//                $decorators = explode(' ', $decorators);
//            }
//        }
//        if ((!is_array($decorators)) || empty($decorators)) {
//            return $value;
//        }
//        switch (array_shift($decorators)) {
//            case 'nobr':
//                $value = '<span class="nobr">' . $value . '</span>';
//                break;
//        }
//        if (!empty($decorators)) {
//            return $this->_applyDecorators($value, $decorators);
//        }
//        return $value;
//    }

    public function setRenderer($renderer)
    {
        $this->_renderer = $renderer;
        return $this;
    }

    protected function _createRenderer($type)
    {
//        $type = strtolower($this->getType());
//        \Zend\Debug::dump($);
//        $renderers = $this->getGrid()->getColumnRenderers();
//
//        if (is_array($renderers) && isset($renderers[$type])) {
//            return $renderers[$type];
//        }
//
        switch ($type) {
            case 'date':
                $renderer = new Renderer\Date();
                $rendererClass = 'adminhtml/widget_grid_column_renderer_date';
                break;
            case 'datetime':
                $renderer = new Renderer\DateTime();
                $rendererClass = 'adminhtml/widget_grid_column_renderer_datetime';
                break;
            case 'number':
            case 'integer':
            case 'decimal':
                $renderer = new Renderer\Number();
//                $rendererClass = 'adminhtml/widget_grid_column_renderer_number';
                break;
            case 'id':
                $renderer = new Renderer\Id();
//                $rendererClass = 'adminhtml/widget_grid_column_renderer_number';
                break;
//            case 'currency':
//                $rendererClass = 'adminhtml/widget_grid_column_renderer_currency';
//                break;
//            case 'price':
//                $rendererClass = 'adminhtml/widget_grid_column_renderer_price';
//                break;
//            case 'country':
//                $rendererClass = 'adminhtml/widget_grid_column_renderer_country';
//                break;
//            case 'concat':
//                $rendererClass = 'adminhtml/widget_grid_column_renderer_concat';
//                break;
            case 'action':
                $renderer = new Renderer\Action();
//                $rendererClass = 'adminhtml/widget_grid_column_renderer_action';
                break;
//            case 'options':
//                $rendererClass = 'adminhtml/widget_grid_column_renderer_options';
//                break;
//            case 'checkbox':
//                $rendererClass = 'adminhtml/widget_grid_column_renderer_checkbox';
//                break;
            case 'massaction':
                $renderer = new Renderer\MassAction();
                break;
//            case 'radio':
//                $rendererClass = 'adminhtml/widget_grid_column_renderer_radio';
//                break;
//            case 'input':
//                $rendererClass = 'adminhtml/widget_grid_column_renderer_input';
//                break;
//            case 'select':
//                $rendererClass = 'adminhtml/widget_grid_column_renderer_select';
//                break;
//            case 'text':
//                $rendererClass = 'adminhtml/widget_grid_column_renderer_longtext';
//                break;
//            case 'store':
//                $rendererClass = 'adminhtml/widget_grid_column_renderer_store';
//                break;
//            case 'wrapline':
//                $rendererClass = 'adminhtml/widget_grid_column_renderer_wrapline';
//                break;
//            case 'theme':
//                $rendererClass = 'adminhtml/widget_grid_column_renderer_theme';
//                break;
            default:
                $renderer = new Renderer\Text();

                break;
        }
        return $renderer;
    }

    /**
     * Retrieve column renderer
     *
     * @return Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
     */
    public function getRenderer()
    {
        if (!$this->_renderer) {
            $renderer = $this->renderer;
            if (!$renderer) {
                $renderer = strtolower($this->getType());
            }
//            \Zend\Debug::dump($renderer);
            $this->_renderer = $this->_createRenderer($renderer)
                ->setColumn($this);
//                \Zend\Debug::dump(get_class($this->_renderer));
        }
        return $this->_renderer;
    }

//    public function setFilter($filterClass)
//    {
//        $this->_filter = $this->getLayout()->createBlock($filterClass)
//                ->setColumn($this);
//    }

    protected function _createFilter($type)
    {
//        $type = strtolower($this->getType());
//        $filters = $this->getGrid()->getColumnFilters();
//        if (is_array($filters) && isset($filters[$type])) {
//            return $filters[$type];
//        }
//
        switch ($type) {
            case 'datetime':
                $filter = new Filter\DateTime();
                break;
            case 'date':
                $filter = new Filter\Date();
                break;
            case 'range':
            case 'number':
            case 'decimal':
            case 'integer':
//            case 'currency':
                $filter = new Filter\Range();
                break;
            case 'id':
//            case 'currency':
                $filter = new Filter\Id();
                break;
//            case 'price':
//                $filterClass = 'adminhtml/widget_grid_column_filter_price';
//                break;
//            case 'country':
//                $filterClass = 'adminhtml/widget_grid_column_filter_country';
//                break;
//            case 'options':
//                $filterClass = 'adminhtml/widget_grid_column_filter_select';
//                break;
//
//            case 'massaction':
//                $filterClass = 'adminhtml/widget_grid_column_filter_massaction';
//                break;
//
//            case 'checkbox':
//                $filterClass = 'adminhtml/widget_grid_column_filter_checkbox';
//                break;
//
//            case 'radio':
//                $filterClass = 'adminhtml/widget_grid_column_filter_radio';
//                break;
//            case 'store':
//                $filterClass = 'adminhtml/widget_grid_column_filter_store';
//                break;
//            case 'theme':
//                $filterClass = 'adminhtml/widget_grid_column_filter_theme';
//                break;
            default:
                $filter = new Filter\AbstractFilter();

                break;
        }
        return $filter;
    }

    public function getFilter()
    {
        if (!$this->_filter) {

            $filter = $this->filter;
            if (!$filter) {
                $filter = strtolower($this->getType());
            }
//            \Zend\Debug::dump($filter);

            $filter = $this->_createFilter($filter);
            if ($filter) {
                $filter->setColumn($this);
                $this->_filter = $filter;
            }
        }

        return $this->_filter;
    }

    public function getFilterHtml()
    {
        if ($this->getFilter()) {
            return $this->getFilter()->getHtml();
        } else {
            return '&nbsp;';
        }
        return null;
    }

//    /**
//     * Retrieve Header Name for Export
//     *
//     * @return string
//     */
//    public function getExportHeader()
//    {
//        if ($this->getHeaderExport()) {
//            return $this->getHeaderExport();
//        }
//        return $this->getHeader();
//    }
}
