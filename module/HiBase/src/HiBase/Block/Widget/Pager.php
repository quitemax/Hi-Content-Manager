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
class Pager extends Widget
{
//    protected $_addButtonLabel  = 'Add New';
//    protected $_backButtonLabel = 'Back';
    protected $_limit;
    protected $_page;
    protected $_pageCount;
    protected $_size;
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
        //
        return $this->_grid;
    }
    public function setSize($size)
    {
        //
        $this->_size = $size;

        //
        return $this;
    }

    public function getSize()
    {
        //
        return $this->_size;
    }

    public function setLimit( $limit)
    {
        //
        $this->_limit = $limit;

        //
        return $this;
    }

    public function getLimit()
    {
        //
        return $this->_limit;
    }

    public function getPageSize()
    {
        //
        return $this->getLimit();
    }

    public function getOffset()
    {
        //
        return $this->_limit * ($this->_page - 1);
    }



    public function setPage( $page)
    {
        //
        $this->_page = $page;

        //
        return $this;
    }

    public function getPage()
    {
        //
        return (int) $this->_page;
    }

    public function getCurPage()
    {
        //
        return (int) $this->_page;
    }

    public function setPageCount( $pageCount)
    {
        //
        $this->_pageCount = $pageCount;

        //
        return $this;
    }

    public function getPageCount()
    {
        if (!$this->_pageCount) {
            if ($this->_size && $this->_limit && $this->_limit > 0) {
                $this->_pageCount = ceil($this->_size / $this->_limit);
            }
        }
        //
        return (int) $this->_pageCount;
    }

    public function getLastPageNumber()
    {
        //
        return $this->getPageCount();
    }

    public function init()
    {
        parent::init();
        $this->setTemplate('widget/pager.phtml');
    }

}
