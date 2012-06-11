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
    protected $_addButtonLabel  = 'Add New';
    protected $_backButtonLabel = 'Back';
//    protected $_blockGroup = 'adminhtml';

    public function init()
    {
        parent::init();

        $this->setTemplate('widget/grid/container.phtml');

    }


    protected function _prepareLayout()
    {
        if (is_null($this->_addButtonLabel)) {
            $this->_addButtonLabel = 'Add New';
        }
        if(is_null($this->_backButtonLabel)) {
            $this->_backButtonLabel = 'Back';
        }

        $this->_addButton('add', array(
            'label'     => $this->getAddButtonLabel(),
            'onclick'   => 'setLocation(\'' . $this->getCreateUrl() .'\')',
            'class'     => 'add',
        ));
    }

    public function getCreateUrl()
    {
        return '';
    }
    public function getBackUrl()
    {
        return '';
    }

    protected function getAddButtonLabel()
    {
        return $this->_addButtonLabel;
    }

    protected function getBackButtonLabel()
    {
        return $this->_backButtonLabel;
    }


    protected function _addBackButton()
    {
        $this->_addButton('back', array(
            'label'     => $this->getBackButtonLabel(),
            'onclick'   => 'setLocation(\'' . $this->getBackUrl() .'\')',
            'class'     => 'back',
        ));
    }

//    public function getHeaderCssClass()
//    {
//        return 'icon-head ' . parent::getHeaderCssClass();
//    }

    public function getHeaderWidth()
    {
        return 'width:50%;';
    }
}
