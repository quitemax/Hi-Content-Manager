<?php

namespace HiBase\Block;

use HiBase\Block\Block;
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
class Widget extends Block
{
    protected $_id;
    /**
     *
     */
    public function getId()
    {
        if ($this->_id === null) {
            $this->_id = 'block-' . md5(microtime());
//            $this->setData('id', Mage::helper('core')->uniqHash('id_'));
        }
        return $this->_id;
    }

    public function getHtmlId()
    {
        return $this->getId();
    }

}
