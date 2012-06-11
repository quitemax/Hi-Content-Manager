<?php


namespace HiBase\Block\Widget;

use HiBase\Block\Widget;
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
class Button extends Widget
{
    protected $_type;
    protected $_onClick;
//    protected $_onClick;
//    protected $_onClick;

    public function getType()
    {
        return ($type = $this->_type) ? $type : 'button';
    }

//    public function getOnClick()
//    {
//        return $this->_onClick;
//    }

    public function setType($type)
    {
        $this->_type = $type;
        return $this;
    }

//    public function setOnClick($onClick)
//    {
//        $this->_onClick = $onClick;
//        return $this;
//    }

    protected function _toHtml()
    {
//        \Zend\Debug::dump(get_class_methods($this));
//        \Zend\Debug::dump($this->getVariables());
        $html = $this->getBeforeHtml()
            .'<button '
            . ($this->getId() ? ' id="' . $this->getId() . '"':'')
            . ($this->getElementName()?' name="'.$this->getElementName() . '"':'')
            . ' title="'
            . ($this->getTitle() ? $this->getTitle() : $this->getLabel())
            . '"'
            . ' type="'.$this->getType() . '"'
            . ' class="btn ' . $this->getClass() . ($this->getDisabled() ? ' disabled' : '') . '"' //scalable
            . ' onclick="'.$this->getOnclick().'"'
            . ' style="'.$this->getStyle() .'"'
            . ($this->getValue()?' value="'.$this->getValue() . '"':'')
            . ($this->getDisabled() ? ' disabled="disabled"' : '')
            . '>' . $this->getLabel() . '</button>' //. $this->label
            . $this->getAfterHtml();
//
        return $html;
    }
}
