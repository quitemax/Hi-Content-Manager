<?php

namespace HiBase\Block\Widget\Grid;

use HiBase\Block\Widget;
use HiBase\Block\Widget\Grid\MassAction\Item;
use HiBase\Block\Widget\Button;

///**
// * Grid widget massaction block
// *
// * @method Mage_Sales_Model_Quote setHideFormElement(boolean $value) Hide Form element to prevent IE errors
// * @method boolean getHideFormElement()
// * @category   Mage
// * @package    Mage_Adminhtml
// * @author      Magento Core Team <core@magentocommerce.com>
// */
class MassAction extends Widget
{
    /**
     * Massaction items
     *
     * @var array
     */
    protected $_items = array();

    protected $_grid;



    public function setGrid($grid)
    {
        //
        $this->_grid = $grid;


        //
        return $this;
    }

    public function getGrid()
    {
        return $this->_grid;
    }

    /**
     * Sets Massaction template
     */
    public function init()
    {
        parent::init();
        $this->setTemplate('widget/grid/massaction.phtml');
//        $this->setErrorText(Mage::helper('catalog')->jsQuoteEscape(Mage::helper('catalog')->__('Please select items.')));
    }

//    /**
//     * Add new massaction item
//     *
//     * $item = array(
//     *      'label'    => string,
//     *      'complete' => string, // Only for ajax enabled grid (optional)
//     *      'url'      => string,
//     *      'confirm'  => string, // text of confirmation of this action (optional)
//     *      'additional' => string|array|Mage_Core_Block_Abstract // (optional)
//     * );
//     *
//     * @param string $itemId
//     * @param array $item
//     * @return Mage_Adminhtml_Block_Widget_Grid_Massaction_Abstract
//     */
    public function addItem($itemId, array $item)
    {
        $item =  new Item($item);
////            ->setData($item)
        $item->setMassaction($this);
        $item->setId($itemId);
//
        $this->_items[$itemId] = $item;
//
//        if($this->_items[$itemId]->getAdditional()) {
//            $this->_items[$itemId]->setAdditionalActionBlock($this->_items[$itemId]->getAdditional());
//            $this->_items[$itemId]->unsAdditional();
//        }

        return $this;
    }

//    /**
//     * Retrieve massaction item with id $itemId
//     *
//     * @param string $itemId
//     * @return Mage_Adminhtml_Block_Widget_Grid_Massaction_Item
//     */
    public function getItem($itemId)
    {
        if(isset($this->_items[$itemId])) {
            return $this->_items[$itemId];
        }

        return null;
    }

    /**
     * Retrieve massaction items
     *
     * @return array
     */
    public function getItems()
    {
        return $this->_items;
    }

//    /**
//     * Retrieve massaction items JSON
//     *
//     * @return string
//     */
//    public function getItemsJson()
//    {
//        $result = array();
//        foreach ($this->getItems() as $itemId=>$item) {
//            $result[$itemId] = $item->toArray();
//        }
//
//        return Mage::helper('core')->jsonEncode($result);
//    }

    /**
     * Retrieve massaction items count
     *
     * @return integer
     */
    public function getCount()
    {
        return sizeof($this->_items);
    }

    /**
     * Checks are massactions available
     *
     * @return boolean
     */
    public function isAvailable()
    {
        return $this->getCount() > 0;// && $this->getParentBlock()->getMassactionIdField();
    }

//    /**
//     * Retrieve global form field name for all massaction items
//     *
//     * @return string
//     */
//    public function getFormFieldName()
//    {
//        return ($this->getData('form_field_name') ? $this->getData('form_field_name') : 'massaction');
//    }
//
//    /**
//     * Retrieve form field name for internal use. Based on $this->getFormFieldName()
//     *
//     * @return string
//     */
//    public function getFormFieldNameInternal()
//    {
//        return  'internal_' . $this->getFormFieldName();
//    }
//
    /**
     * Retrieve massaction block js object name
     *
     * @return string
     */
    public function getJsObjectName()
    {
        return $this->getHtmlId() . 'JsObject';
    }

    /**
     * Retrieve grid block js object name
     *
     * @return string
     */
    public function getGridJsObjectName()
    {
        return $this->getGrid()->getJsObjectName();
    }

//    /**
//     * Retrieve JSON string of selected checkboxes
//     *
//     * @return string
//     */
//    public function getSelectedJson()
//    {
//        if($selected = $this->getRequest()->getParam($this->getFormFieldNameInternal())) {
//            $selected = explode(',', $selected);
//            return join(',', $selected);
//        } else {
//            return '';
//        }
//    }
//
//    /**
//     * Retrieve array of selected checkboxes
//     *
//     * @return array
//     */
//    public function getSelected()
//    {
//        if($selected = $this->getRequest()->getParam($this->getFormFieldNameInternal())) {
//            $selected = explode(',', $selected);
//            return $selected;
//        } else {
//            return array();
//        }
//    }

    /**
     * Retrieve apply button html
     *
     * @return string
     */
    public function getApplyButtonHtml()
    {
        $this->setChild(
            new Button(
                array(
//                    'name'      => $this->__('submit'),
//                    'type'      => 'submit',
                    'label'     => $this->__('Submit'),
                    'onclick'   => $this->getGridJsObjectName() . '.submitForm()',
                    'class'   => 'pull-left'
                )
            ),
            'submit_button'
        );
        return $this->getChildHtml('submit_button');
    }

    protected function _beforeToHtml()
    {
        $this->_prepareJs();
        $return = parent::_beforeToHtml();
        return $return;
    }

    protected function _prepareJs()
    {
        $basePath = $this->basePath();

        $this->headScript()->appendFile(
            $basePath . '/js/js.js',
            'text/javascript'
        );
        $this->headScript()->appendFile(
            $basePath . '/js/grid.js',
            'text/javascript'
        );


//
//        $pager = $this->getGrid()->getPager();
        $jsObjectName = $this->getJsObjectName();


        $script = <<<HTML
var {$jsObjectName} = new HiGridMassActionWidget('{$this->getId()}', '{$this->getGridUrl()}');
HTML;


        $this->inlineScript()->appendScript(
            $script,
            'text/javascript'
        );//,

        return $this;

    }

//    public function getJavaScript()
//    {
//        return " var {$this->getJsObjectName()} = new varienGridMassaction('{$this->getHtmlId()}', "
//                . "{$this->getGridJsObjectName()}, '{$this->getSelectedJson()}'"
//                . ", '{$this->getFormFieldNameInternal()}', '{$this->getFormFieldName()}');"
//                . "{$this->getJsObjectName()}.setItems({$this->getItemsJson()}); "
//                . "{$this->getJsObjectName()}.setGridIds('{$this->getGridIdsJson()}');"
//                . ($this->getUseAjax() ? "{$this->getJsObjectName()}.setUseAjax(true);" : '')
//                . ($this->getUseSelectAll() ? "{$this->getJsObjectName()}.setUseSelectAll(true);" : '')
//                . "{$this->getJsObjectName()}.errorText = '{$this->getErrorText()}';";
//    }

//    public function getGridIdsJson()
//    {
//        if (!$this->getUseSelectAll()) {
//            return '';
//        }
//
//        $gridIds = $this->getParentBlock()->getCollection()->getAllIds();
//
//        if(!empty($gridIds)) {
//            return join(",", $gridIds);
//        }
//        return '';
//    }
//
//    public function getHtmlId()
//    {
//        return $this->getParentBlock()->getHtmlId() . '_massaction';
//    }

    /**
     * Remove existing massaction item by its id
     *
     * @param string $itemId
     * @return Mage_Adminhtml_Block_Widget_Grid_Massaction_Abstract
     */
    public function removeItem($itemId)
    {
        if (isset($this->_items[$itemId])) {
            unset($this->_items[$itemId]);
        }

        return $this;
    }

//    /**
//     * Retrieve select all functionality flag check
//     *
//     * @return boolean
//     */
//    public function getUseSelectAll()
//    {
//        return $this->_getData('use_select_all') === null || $this->_getData('use_select_all');
//    }
//
//    /**
//     * Retrieve select all functionality flag check
//     *
//     * @param boolean $flag
//     * @return Mage_Adminhtml_Block_Widget_Grid_Massaction_Abstract
//     */
//    public function setUseSelectAll($flag)
//    {
//        $this->setData('use_select_all', (bool) $flag);
//        return $this;
//    }
}
