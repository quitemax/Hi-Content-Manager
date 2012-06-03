<?php


namespace HiBase\Block\Widget\Grid\Column\Renderer;

//use HiBase\Block\Widget;
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
interface ColumnRendererInterface
{

//interface Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Interface
//{
    /**
     * Set column for renderer
     *
     * @abstract
     * @param $column
     * @return void
     */
    public function setColumn($column);

    /**
     * Returns row associated with the renderer
     *
     * @abstract
     * @return void
     */
    public function getColumn();

    /**
     * Renders grid column
     *
     * @param Varien_Object $row
     */
    public function render(/*Varien_Object*/ $row);
}
