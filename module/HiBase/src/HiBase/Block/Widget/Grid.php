<?php


namespace HiBase\Block\Widget;

use HiBase\Block\Widget;
use HiBase\Block\Widget\Button;
use HiBase\Block\Widget\Grid\Column;
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
class Grid extends Widget
{
    protected $_header;
    /**
     * Columns array
     *
     * array(
     *      'header'    => string,
     *      'width'     => int,
     *      'sortable'  => bool,
     *      'index'     => string,
     *      //'renderer'  => Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Interface,
     *      'format'    => string
     *      'total'     => string (sum, avg)
     * )
     * @var array
     */
    protected $_columns = array();

    protected $_lastColumnId;

//    /**
//     * Collection object
//     *
//     * @var Varien_Data_Collection
//     */
    protected $_collection = null;

    /**
     * Page and sorting var names
     *
     * @var string
     */
    protected $_varNameLimit    = 'limit';
    protected $_varNamePage     = 'page';
    protected $_varNameSort     = 'sort';
    protected $_varNameDir      = 'dir';
    protected $_varNameFilter   = 'filter';

    protected $_defaultLimit    = 20;
    protected $_defaultPage     = 1;
    protected $_defaultSort     = false;
    protected $_defaultDir      = 'desc';
    protected $_defaultFilter   = array();

//    /**
//     * Export flag
//     *
//     * @var bool
//     */
//    protected $_isExport = false;

    /**
     * Empty grid text
     *
     * @var sting|null
     */
    protected $_emptyText = 'No records found.';

     /**
     * Empty grid text CSS class
     *
     * @var sting|null
     */
    protected $_emptyTextCss    = 'a-center';

    /**
     * Pager visibility
     *
     * @var boolean
     */
    protected $_pagerVisibility = true;

    /**
     * Column headers visibility
     *
     * @var boolean
     */
    protected $_headersVisibility = true;

    /**
     * Filter visibility
     *
     * @var boolean
     */
    protected $_filterVisibility = true;

    /**
     * Massage block visibility
     *
     * @var boolean
     */
    protected $_messageBlockVisibility = false;

    protected $_saveParametersInSession = false;

//    /**
//     * Count totals
//     *
//     * @var boolean
//     */
//    protected $_countTotals = false;
//
//    /**
//     * Count subtotals
//     *
//     * @var boolean
//     */
//    protected $_countSubTotals = false;
//
//    /**
//     * Totals
//     *
//     * @var Varien_Object
//     */
//    protected $_varTotals;
//
//    /**
//     * SubTotals
//     *
//     * @var array
//     */
//    protected $_subtotals = array();

//    /**
//     * Grid export types
//     *
//     * @var array
//     */
//    protected $_exportTypes = array();

//    /**
//     * Rows per page for import
//     *
//     * @var int
//     */
//    protected $_exportPageSize = 1000;

    /**
     * Massaction row id field
     *
     * @var string
     */
    protected $_massactionIdField = null;

    /**
     * Massaction row id filter
     *
     * @var string
     */
    protected $_massactionIdFilter = null;

//    /**
//     * Massaction block name
//     *
//     * @var string
//     */
//    protected $_massactionBlockName = 'adminhtml/widget_grid_massaction';

//    /**
//    * RSS list
//    *
//    * @var array
//    */
//    protected $_rssLists = array();

    /**
     * Columns view order
     *
     * @var array
     */
    protected $_columnsOrder = array();

    /**
     * Columns to group by
     *
     * @var array
     */
    protected $_groupedColumn = array();

    /**
     * Label for empty cell
     *
     * @var string
     */
    protected $_emptyCellLabel = '';

    public function init()
    {
        parent::init();
        $this->setTemplate('widget/grid.phtml');
//        $this->setRowClickCallback('openGridRow');
//        $this->_emptyText = 'No records found.';

        //        $this->setChild('export_button',
//            $this->getLayout()->createBlock('adminhtml/widget_button')
//                ->setData(array(
//                    'label'     => Mage::helper('adminhtml')->__('Export'),
//                    'onclick'   => $this->getJsObjectName().'.doExport()',
//                    'class'   => 'task'
//                ))
//        );
//        $this->setChild('reset_filter_button',
//            $this->getLayout()->createBlock('adminhtml/widget_button')
//                ->setData(array(
//                    'label'     => Mage::helper('adminhtml')->__('Reset Filter'),
//                    'onclick'   => $this->getJsObjectName().'.resetFilter()',
//                ))
//        );
//        $this->setChild('search_button',
//            $this->getLayout()->createBlock('adminhtml/widget_button')
//                ->setData(array(
//                    'label'     => Mage::helper('adminhtml')->__('Search'),
//                    'onclick'   => $this->getJsObjectName().'.doFilter()',
//                    'class'   => 'task'
//                ))
//        );
    }

//    protected function _prepareLayout()
//    {
//
////        return parent::_prepareLayout();
//    }

    public function getExportButtonHtml()
    {
        return $this->getChildHtml('export_button');
    }

    public function getResetFilterButtonHtml()
    {
        return $this->getChildHtml('reset_filter_button');
    }

    public function getSearchButtonHtml()
    {
        return $this->getChildHtml('search_button');
    }

    public function getMainButtonsHtml()
    {
//        $html = '';
//        if($this->getFilterVisibility()){
//            $html.= $this->getResetFilterButtonHtml();
//            $html.= $this->getSearchButtonHtml();
//        }
//        return $html;
    }

    public function canDisplayContainer()
    {
//        if ($this->getRequest()->getQuery('ajax')) {
//            return false;
//        }
        return true;
    }

    public function getGridHeader()
    {
        return $this->_header;
    }


    /**
     * Add column to grid
     *
     * @param   string $columnId
     * @param   array || Varien_Object $column
     * @return  Mage_Adminhtml_Block_Widget_Grid
     */
    public function addColumn($columnId, $column)
    {
        if (is_array($column)) {
//            \Zend\Debug::dump($column);
//            \Zend\Debug::dump(is_array($column));
            $this->_columns[$columnId] = new Column($column);
            $this->_columns[$columnId]->setGrid($this);
            $this->_columns[$columnId]->setId($columnId);
//            \Zend\Debug::dump($this->_columns[$columnId]);
//                ->setData($column)
//                ->setGrid($this);
        }
        /*elseif ($column instanceof Varien_Object) {
            $this->_columns[$columnId] = $column;
        }*/
        else {
            throw new Exception('Wrong column format.');
        }

        $this->_columns[$columnId]->setId($columnId);
        $this->_lastColumnId = $columnId;
        return $this;
    }

    /**
     * Remove existing column
     *
     * @param string $columnId
     * @return Mage_Adminhtml_Block_Widget_Grid
     */
    public function removeColumn($columnId)
    {
        if (isset($this->_columns[$columnId])) {
            unset($this->_columns[$columnId]);
            if ($this->_lastColumnId == $columnId) {
                $this->_lastColumnId = key($this->_columns);
            }
        }
        return $this;
    }

    /**
     * Add column to grid after specified column.
     *
     * @param   string $columnId
     * @param   array|Varien_Object $column
     * @param   string $after
     * @return  Mage_Adminhtml_Block_Widget_Grid
     */
    public function addColumnAfter($columnId, $column, $after)
    {
        $this->addColumn($columnId, $column);
        $this->addColumnsOrder($columnId, $after);
        return $this;
    }

    /**
     * Add column view order
     *
     * @param string $columnId
     * @param string $after
     * @return Mage_Adminhtml_Block_Widget_Grid
     */
    public function addColumnsOrder($columnId, $after)
    {
        $this->_columnsOrder[$columnId] = $after;
        return $this;
    }

    /**
     * Retrieve columns order
     *
     * @return array
     */
    public function getColumnsOrder()
    {
        return $this->_columnsOrder;
    }

    /**
     * Sort columns by predefined order
     *
     * @return Mage_Adminhtml_Block_Widget_Grid
     */
    public function sortColumnsByOrder()
    {
        $keys = array_keys($this->_columns);
        $values = array_values($this->_columns);

        foreach ($this->getColumnsOrder() as $columnId => $after) {
            if (array_search($after, $keys) !== false) {
                // Moving grid column
                $positionCurrent = array_search($columnId, $keys);

                $key = array_splice($keys, $positionCurrent, 1);
                $value = array_splice($values, $positionCurrent, 1);

                $positionTarget = array_search($after, $keys) + 1;

                array_splice($keys, $positionTarget, 0, $key);
                array_splice($values, $positionTarget, 0, $value);

                $this->_columns = array_combine($keys, $values);
            }
        }

        end($this->_columns);
        $this->_lastColumnId = key($this->_columns);
        return $this;
    }

    public function getLastColumnId()
    {
        return $this->_lastColumnId;
    }

    public function getColumnCount()
    {
        return count($this->getColumns());
    }

    /**
     * Retrieve grid column by column id
     *
     * @param   string $columnId
     * @return  Varien_Object || false
     */
    public function getColumn($columnId)
    {
        if (!empty($this->_columns[$columnId])) {
            return $this->_columns[$columnId];
        }
        return false;
    }

    /**
     * Retrieve all grid columns
     *
     * @return array
     */
    public function getColumns()
    {
        return $this->_columns;
    }

//    protected function _setFilterValues($data)
//    {
////        foreach ($this->getColumns() as $columnId => $column) {
////            if (isset($data[$columnId])
////                && (!empty($data[$columnId]) || strlen($data[$columnId]) > 0)
////                && $column->getFilter()
////            ) {
////                $column->getFilter()->setValue($data[$columnId]);
////                $this->_addColumnFilterToCollection($column);
////            }
////        }
////        return $this;
//    }

//    protected function _addColumnFilterToCollection($column)
//    {
////        if ($this->getCollection()) {
////            $field = ( $column->getFilterIndex() ) ? $column->getFilterIndex() : $column->getIndex();
////            if ($column->getFilterConditionCallback()) {
////                call_user_func($column->getFilterConditionCallback(), $this->getCollection(), $column);
////            } else {
////                $cond = $column->getFilter()->getCondition();
////                if ($field && isset($cond)) {
////                    $this->getCollection()->addFieldToFilter($field , $cond);
////                }
////            }
////        }
////        return $this;
//    }

    /**
     * Sets sorting order by some column
     *
     * @param Mage_Adminhtml_Block_Widget_Grid_Column $column
     * @return Mage_Adminhtml_Block_Widget_Grid
     */
    protected function _setCollectionOrder($column)
    {
//        $collection = $this->getCollection();
//        if ($collection) {
//            $columnIndex = $column->getFilterIndex() ?
//                $column->getFilterIndex() : $column->getIndex();
//            $collection->setOrder($columnIndex, strtoupper($column->getDir()));
//        }
//        return $this;
    }

    /**
     * set collection object
     *
     * @param HiBase\Object\Collection $collection
     */
    //public function setCollection(HiBase\Object\Collection $collection)
    public function setCollection($collection)
    {
        $this->_collection = $collection;
    }

    /**
     * get collection object
     *
     * @return Varien_Data_Collection
     */
    public function getCollection()
    {
//        \Zend\Debug::dump('dadadada');
//        \Zend\Debug::dump($this->_collection, '$this->_collection');
        return $this->_collection;
    }

    /**
     * Prepare grid collection object
     *
     * @return this
     */
    protected function _prepareCollection()
    {

        if (!$this->getCollection()) {
            echo 'dadagetCollection';
//            \Zend\Debug::dump($this->getCollection(), '$this->getCollection()');
        }

//        if ($this->getCollection()) {
//
//            $this->_preparePage();
//
//            $columnId = $this->getParam($this->getVarNameSort(), $this->_defaultSort);
//            $dir      = $this->getParam($this->getVarNameDir(), $this->_defaultDir);
//            $filter   = $this->getParam($this->getVarNameFilter(), null);
//
//            if (is_null($filter)) {
//                $filter = $this->_defaultFilter;
//            }
//
//            if (is_string($filter)) {
//                $data = $this->helper('adminhtml')->prepareFilterString($filter);
//                $this->_setFilterValues($data);
//            }
//            else if ($filter && is_array($filter)) {
//                $this->_setFilterValues($filter);
//            }
//            else if(0 !== sizeof($this->_defaultFilter)) {
//                $this->_setFilterValues($this->_defaultFilter);
//            }
//
//            if (isset($this->_columns[$columnId]) && $this->_columns[$columnId]->getIndex()) {
//                $dir = (strtolower($dir)=='desc') ? 'desc' : 'asc';
//                $this->_columns[$columnId]->setDir($dir);
//                $this->_setCollectionOrder($this->_columns[$columnId]);
//            }
//
//            if (!$this->_isExport) {
//                $this->getCollection()->load();
//                $this->_afterLoadCollection();
//            }
//        }
//
//        return $this;
    }

    /**
     * Decode URL encoded filter value recursive callback method
     *
     * @var string $value
     */
    protected function _decodeFilter(&$value)
    {
//        $value = $this->helper('adminhtml')->decodeFilter($value);
    }

    protected function _preparePage()
    {
//        $this->getCollection()->setPageSize((int) $this->getParam($this->getVarNameLimit(), $this->_defaultLimit));
//        $this->getCollection()->setCurPage((int) $this->getParam($this->getVarNamePage(), $this->_defaultPage));
    }

    protected function _beforeToHtml()
    {
        $this->_prepareGrid();
        return parent::_beforeToHtml();
    }

    protected function _prepareGrid()
    {
        $this->_prepareColumns();
        $this->_prepareMassactionBlock();
        $this->_prepareCollection();
        return $this;
    }



    protected function _prepareColumns()
    {
        $this->sortColumnsByOrder();
        return $this;
    }

    /**
     * Prepare grid massaction block
     *
     * @return Mage_Adminhtml_Block_Widget_Grid
     */
    protected function _prepareMassactionBlock()
    {
//        $this->setChild('massaction', $this->getLayout()->createBlock($this->getMassactionBlockName()));
        $this->_prepareMassaction();
//        if($this->getMassactionBlock()->isAvailable()) {
//            $this->_prepareMassactionColumn();
//        }
        return $this;
    }

    /**
     * Prepare grid massaction actions
     *
     * @return Mage_Adminhtml_Block_Widget_Grid
     */
    protected function _prepareMassaction()
    {

        return $this;
    }

    /**
     * Prepare grid massaction column
     *
     * @return unknown
     */
    protected function _prepareMassactionColumn()
    {
//        $columnId = 'massaction';
//        $massactionColumn = $this->getLayout()->createBlock('adminhtml/widget_grid_column')
//                ->setData(array(
//                    'index'        => $this->getMassactionIdField(),
//                    'filter_index' => $this->getMassactionIdFilter(),
//                    'type'         => 'massaction',
//                    'name'         => $this->getMassactionBlock()->getFormFieldName(),
//                    'align'        => 'center',
//                    'is_system'    => true
//                ));
//
//        if ($this->getNoFilterMassactionColumn()) {
//            $massactionColumn->setData('filter', false);
//        }
//
//        $massactionColumn->setSelected($this->getMassactionBlock()->getSelected())
//            ->setGrid($this)
//            ->setId($columnId);
//
//        $oldColumns = $this->_columns;
//        $this->_columns = array();
//        $this->_columns[$columnId] = $massactionColumn;
//        $this->_columns = array_merge($this->_columns, $oldColumns);
//        return $this;
    }

    protected function _afterLoadCollection()
    {
        return $this;
    }

    public function getVarNameLimit()
    {
        return $this->_varNameLimit;
    }

    public function getVarNamePage()
    {
        return $this->_varNamePage;
    }

    public function getVarNameSort()
    {
        return $this->_varNameSort;
    }

    public function getVarNameDir()
    {
        return $this->_varNameDir;
    }

    public function getVarNameFilter()
    {
        return $this->_varNameFilter;
    }

    public function setVarNameLimit($name)
    {
        return $this->_varNameLimit = $name;
    }

    public function setVarNamePage($name)
    {
        return $this->_varNamePage = $name;
    }

    public function setVarNameSort($name)
    {
        return $this->_varNameSort = $name;
    }

    public function setVarNameDir($name)
    {
        return $this->_varNameDir = $name;
    }

    public function setVarNameFilter($name)
    {
        return $this->_varNameFilter = $name;
    }

    /**
     * Set visibility of column headers
     *
     * @param boolean $visible
     */
    public function setHeadersVisibility($visible=true)
    {
        $this->_headersVisibility = $visible;
    }

    /**
     * Return visibility of column headers
     *
     * @return boolean
     */
    public function getHeadersVisibility()
    {
        return $this->_headersVisibility;
    }

    /**
     * Set visibility of pager
     *
     * @param boolean $visible
     */
    public function setPagerVisibility($visible=true)
    {
        $this->_pagerVisibility = $visible;
    }

    /**
     * Return visibility of pager
     *
     * @return boolean
     */
    public function getPagerVisibility()
    {
        return $this->_pagerVisibility;
    }

    /**
     * Set visibility of filter
     *
     * @param boolean $visible
     */
    public function setFilterVisibility($visible=true)
    {
        $this->_filterVisibility = $visible;
    }

    /**
     * Return visibility of filter
     *
     * @return boolean
     */
    public function getFilterVisibility()
    {
        return $this->_filterVisibility;
    }

    /**
     * Set visibility of filter
     *
     * @param boolean $visible
     */
    public function setMessageBlockVisibility($visible=true)
    {
        $this->_messageBlockVisibility = $visible;
    }

    /**
     * Return visibility of filter
     *
     * @return boolean
     */
    public function getMessageBlockVisibility()
    {
        return $this->_messageBlockVisibility;
    }

    public function setDefaultLimit($limit)
    {
        $this->_defaultLimit = $limit;
        return $this;
    }

    public function setDefaultPage($page)
    {
        $this->_defaultPage = $page;
        return $this;
    }

    public function setDefaultSort($sort)
    {
        $this->_defaultSort = $sort;
        return $this;
    }

    public function setDefaultDir($dir)
    {
        $this->_defaultDir = $dir;
        return $this;
    }

    public function setDefaultFilter($filter)
    {
        $this->_defaultFilter = $filter;
        return $this;
    }

    /**
     * Retrieve grid
     *
     * @param   string $paramName
     * @param   mixed $default
     * @return  mixed
     */
    public function getParam($paramName, $default=null)
    {
//        $session = Mage::getSingleton('adminhtml/session');
//        $sessionParamName = $this->getId().$paramName;
//        if ($this->getRequest()->has($paramName)) {
//            $param = $this->getRequest()->getParam($paramName);
//            if ($this->_saveParametersInSession) {
//                $session->setData($sessionParamName, $param);
//            }
//            return $param;
//        }
//        elseif ($this->_saveParametersInSession && ($param = $session->getData($sessionParamName)))
//        {
//            return $param;
//        }
//
//        return $default;
    }

    /**
     * Retrieve grid HTML
     *
     * @return string
     */
    public function getHtml()
    {
        return $this->toHtml();
    }

    public function setSaveParametersInSession($flag)
    {
        $this->_saveParametersInSession = $flag;
        return $this;
    }

    public function getJsObjectName()
    {
        return $this->getId().'JsObject';
    }

/**
     * Retrieve massaction row identifier field
     *
     * @return string
     */
    public function getMassactionIdField()
    {
        return $this->_massactionIdField;
    }

    /**
     * Set massaction row identifier field
     *
     * @param  string    $idField
     * @return Mage_Adminhtml_Block_Widget_Grid
     */
    public function setMassactionIdField($idField)
    {
        $this->_massactionIdField = $idField;
        return $this;
    }

    /**
     * Retrieve massaction row identifier filter
     *
     * @return string
     */
    public function getMassactionIdFilter()
    {
        return $this->_massactionIdFilter;
    }

    /**
     * Set massaction row identifier filter
     *
     * @param string $idFilter
     * @return Mage_Adminhtml_Block_Widget_Grid
     */
    public function setMassactionIdFilter($idFilter)
    {
        $this->_massactionIdFilter = $idFilter;
        return $this;
    }

/**
     * Set empty text for grid
     *
     * @param string $text
     * @return Mage_Adminhtml_Block_Widget_Grid
     */
    public function setEmptyText($text)
    {
        $this->_emptyText = $text;
        return $this;
    }

    /**
     * Return empty text for grid
     *
     * @return string
     */
    public function getEmptyText()
    {
        return $this->_emptyText;
    }

    /**
     * Set empty text CSS class
     *
     * @param string $cssClass
     * @return Mage_Adminhtml_Block_Widget_Grid
     */
    public function setEmptyTextClass($cssClass)
    {
        $this->_emptyTextCss = $cssClass;
        return $this;
    }

    /**
     * Return empty text CSS class
     *
     * @return string
     */
    public function getEmptyTextClass()
    {
        return $this->_emptyTextCss;
    }

/**
     * Retrieve rowspan number
     *
     * @param Varien_Object $item
     * @param Mage_Adminhtml_Block_Widget_Grid_Column $column
     * @return integer|boolean
     */
    public function getRowspan($item, $column)
    {
        if ($this->isColumnGrouped($column)) {
            return count($this->getMultipleRows($item)) + count($this->_groupedColumn);
        }
        return false;
    }

    /**
     * Enter description here...
     *
     * @param string|object $column
     * @param string $value
     * @return boolean|Mage_Adminhtml_Block_Widget_Grid
     */
    public function isColumnGrouped($column, $value = null)
    {
        if (null === $value) {
            if (is_object($column)) {
                return in_array($column->getIndex(), $this->_groupedColumn);
            }
            return in_array($column, $this->_groupedColumn);
        }
        $this->_groupedColumn[] = $column;
        return $this;
    }
}