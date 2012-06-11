<?php
namespace HiBase\Block\Widget\Grid\Column\Filter;

///**
// * Grid column filter interface
// *
// * @category   Mage
// * @package    Mage_Adminhtml
// * @author      Magento Core Team <core@magentocommerce.com>
// */
interface ColumnFilterInterface
{
    public function getColumn();
    public function setColumn($column);
    public function getHtml();
}
