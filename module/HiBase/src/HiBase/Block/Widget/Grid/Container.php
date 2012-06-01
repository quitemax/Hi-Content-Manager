<?php

namespace HiBase\Block\Widget\Grid;

use HiBase\Block\Widget\Container as WidgetContainer;
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
class Container extends WidgetContainer
{
    protected $_addButtonLabel;
    protected $_backButtonLabel;
//    protected $_blockGroup = 'adminhtml';

    public function init()
    {
        if (is_null($this->_addButtonLabel)) {
            $this->_addButtonLabel = $this->__('Add New');
        }
        if(is_null($this->_backButtonLabel)) {
            $this->_backButtonLabel = $this->__('Back');
        }

        parent::init();
        $this->setTemplate('widget/grid/container.phtml');
    }
//
//    public function __construct()
//    {

//
//        parent::__construct();
//
//        $this->setTemplate('widget/grid/container.phtml');
//
//        $this->_addButton('add', array(
//            'label'     => $this->getAddButtonLabel(),
//            'onclick'   => 'setLocation(\'' . $this->getCreateUrl() .'\')',
//            'class'     => 'add',
//        ));
//    }
//
//    protected function _prepareLayout()
//    {
//        $this->setChild( 'grid',
//            $this->getLayout()->createBlock( $this->_blockGroup.'/' . $this->_controller . '_grid',
//            $this->_controller . '.grid')->setSaveParametersInSession(true) );
//        return parent::_prepareLayout();
//    }
//
//    public function getCreateUrl()
//    {
//        return $this->getUrl('*/*/new');
//    }
//
//    public function getGridHtml()
//    {
//        return $this->getChildHtml('grid');
//    }
//
//    protected function getAddButtonLabel()
//    {
//        return $this->_addButtonLabel;
//    }
//
//    protected function getBackButtonLabel()
//    {
//        return $this->_backButtonLabel;
//    }
//
//    protected function _addBackButton()
//    {
//        $this->_addButton('back', array(
//            'label'     => $this->getBackButtonLabel(),
//            'onclick'   => 'setLocation(\'' . $this->getBackUrl() .'\')',
//            'class'     => 'back',
//        ));
//    }
//
//    public function getHeaderCssClass()
//    {
//        return 'icon-head ' . parent::getHeaderCssClass();
//    }
//
    public function getHeaderWidth()
    {
        return 'width:50%;';
    }
}
