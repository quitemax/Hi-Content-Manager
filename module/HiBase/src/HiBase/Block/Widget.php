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
        }
        return $this->_id;
    }

    /**
     *
     */
    public function setId($id)
    {
        if ($id !== null) {
            $this->_id = $id;
        }
        return $this;
    }

    public function getHtmlId()
    {
        return $this->getId();
    }

/**
     * Set child block
     *
     * @param   string $alias
     * @param   Mage_Core_Block_Abstract $block
     * @return  Mage_Core_Block_Abstract
     */
    public function setChild(Widget $block, $alias = null)
    {
        if ($alias !== null && strpos($block->getId(), 'block-') !== false) {
            $block->setId($alias);
        }

        return parent::setChild($block, $alias);;
    }

}
