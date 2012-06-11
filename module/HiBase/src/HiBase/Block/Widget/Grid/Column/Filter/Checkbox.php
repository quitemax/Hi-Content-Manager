<?php
namespace HiBase\Block\Widget\Grid\Column\Filter;

//use HiBase\Block\AbstractBlock;

///**
// * Checkbox grid column filter
// *
// * @category   Mage
// * @package    Mage_Adminhtml
// * @author      Magento Core Team <core@magentocommerce.com>
// */
class Checkbox extends Select
{
//    public function getHtml()
//    {
//        return '<span class="head-massaction">' . parent::getHtml() . '</span>';
//    }
//
//    protected function _getOptions()
//    {
//        return array(
//            array(
//                'label' => Mage::helper('adminhtml')->__('Any'),
//                'value' => ''
//            ),
//            array(
//                'label' => Mage::helper('adminhtml')->__('Yes'),
//                'value' => 1
//            ),
//            array(
//                'label' => Mage::helper('adminhtml')->__('No'),
//                'value' => 0
//            ),
//        );
//    }

    public function getCondition()
    {
//        if ($this->getValue()) {
//            return $this->getColumn()->getValue();
//        }
//        else {
//            return array(
//                array('neq'=>$this->getColumn()->getValue()),
//                array('is'=>new Zend_Db_Expr('NULL'))
//            );
//        }
        //return array('like'=>'%'.$this->getValue().'%');
    }
}
