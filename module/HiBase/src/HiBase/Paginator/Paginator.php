<?php
/**
 * Hi CMS
 *
 * @category   Hi
 * @package    Hi_Paginator
 * @copyright  Copyright (c) 2009 Piotr Maxymilian Socha
 * @license
 */
namespace HiBase\Paginator;

//use Zend\Db\Table\AbstractRow as ZendAbstractRow;
/**
 * Hi_Paginator
 *
 * @category   Hi
 * @package    Hi_Paginator
 * @copyright  Copyright (c) 2009 Piotr Maxymilian Socha
 * @license
 * @version    2.0
 */
class Paginator
{
    /**#@+
     *
     */
    const DEFAULT_ITEMS_PER_PAGE = 10;
    /**#@-*/

    /**#@+
     *
     */
    const DEFAULT_WIDTH = 9;
    /**#@-*/

    /**
     *
     *
     * @var int
     */
    protected $_itemsPerPage;

    /**
     *
     *
     * @var int
     */
    protected $_paginatorWidth;

    /**
     *
     *
     * @var int
     */
    protected $_totalItems;

    /**
     *
     *
     * @var int
     */
    protected $_currentPage;

    /**
     *
     *
     * @var int
     */
    protected $_pageCount;

    /**
     *
     *
     * @var int
     */
    protected $_view = null;

    /**
     *
     *
     * @var int
     */
    protected $_template = null;

    /**
     *
     *
     * @var int
     */
    protected $_buildData = array();

    /**
     *
     *
     * @var int
     */
    protected $_link;

    /**
     *
     *
     * @var int
     */
    protected $_linkPageIdentifier;



    /**
     * Creates an instance of Hi_Record_List
     *
     *
     * @return void
     */
    public function __construct()
    {
        $this->_paginatorWidth = self::DEFAULT_WIDTH;
        $this->_itemsPerPage   = self::DEFAULT_ITEMS_PER_PAGE;
    }


    /**
     *
     *
     * @param $count int
     *
     * @return void
     */
    public function setItemsPerPage($count = null)
    {
        if ($count === null) {
            $this->_itemsPerPage = Hi_Paginator::DEFAULT_ITEMS_PER_PAGE;
        } else {
            $this->_itemsPerPage = (int)$count;
        }

    }

    /**
     *
     *
     * @param $width int
     *
     * @return void
     */
    public function setPaginatorWidth($width)
    {
        $this->_paginatorWidth = (int)$width;
    }

    /**
     *
     *
     * @param $total int
     *
     * @return void
     */
    public function setAllItemsCount($total)
    {
        $this->_totalItems = (int)$total;
    }

    /**
     *
     *
     * @param $page int
     *
     * @return void
     */
    public function setCurrentPage($page)
    {
        $this->_currentPage = (int)$page;
    }

    /**
     *
     *
     * @param $view Zend_View
     *
     * @return void
     */
    public function setView($view)
    {
        $this->_view = $view;
    }

    /**
     *
     *
     * @param $template string
     *
     * @return void
     */
    public function setTemplate($template)
    {
        $this->_template = $template;
    }

    /**
     *
     *
     * @param $link string
     * @param $pageIdentifier string
     *
     * @return void
     */
    public function setLink($link, $pageIdentifier)
    {
      $this->_link = $link;
      $this->_linkPageIdentifier = $pageIdentifier;
    }

    /**
     *
     *
     *
     * @return void
     */
    public function getBuildData()
    {
        return $this->_buildData();
    }

    /**
     *
     *
     * @return void
     */
    protected function _buildData() {

        $buildData = array();

        //
        $this->_pageCount = ceil($this->_totalItems/$this->_itemsPerPage);

//      if ($this->_currentPage>$this->_pageCount) {
//        $this->_currentPage=$this->_pageCount;
//      }
//
        //
        if ($this->_pageCount <= $this->_paginatorWidth) {
            //
            $start = 1;
            $end = $this->_pageCount;
        } else {
            //
            $tmpWidth = $this->_paginatorWidth;
            $halfWidth = ceil($tmpWidth/2)-1;
            $tmpStart = $this->_currentPage-$halfWidth;
            $tmpEnd = $this->_currentPage+$halfWidth;

            //
            if ($tmpStart<=0) {
                $start = 1;
                $end = $this->_paginatorWidth;
            } else if ($tmpEnd>$this->_pageCount) {
                $end = $this->_pageCount;
                $start = ($end-$this->_paginatorWidth)+1;
            } else {
                $start = $tmpStart;
                $end = $tmpEnd;
            }
        }
//
//
        $pages = array();
        for($i=$start;$i<=$end;$i++) {
            $page['number'] = $i;
            $page['link']   = $this->_link.$this->_linkPageIdentifier.$i;
            if ($this->_currentPage==$i) {
                $page['current'] = 'current';
            } else {
                $page['current'] = '';
            }
            $pages[] = $page;
        }
        $buildData['pages'] = $pages;


        //
        $numberBefore = 0;
        if ($start>1) {
            $numberBefore = $this->_currentPage-1;
        } else {
            if ($this->_currentPage>1) {
                $numberBefore = $this->_currentPage-1;
            } else {
                $numberBefore = 1;
            }
        }

        //
        $numberAfter = 0;
        if ($end<$this->_pageCount) {
            $numberAfter = $this->_currentPage+1;
        } else {
            if ($this->_currentPage<$this->_pageCount) {
                $numberAfter = $this->_currentPage+1;
            } else {
                $numberAfter = $this->_pageCount;
            }
        }


        //
        $firstPageButton['link'] = $this->_link.$this->_linkPageIdentifier.'1';
        $firstPageButton['number'] = '1';
        $firstPageButton['dots'] = ($start>1);
        $buildData['buttons']['first'] = $firstPageButton;



        $beforePageButton['link'] = $this->_link.$this->_linkPageIdentifier.$numberBefore;
        $beforePageButton['number'] = $numberBefore;
        $buildData['buttons']['before'] = $beforePageButton;


        $afterPageButton['link'] = $this->_link.$this->_linkPageIdentifier.$numberAfter;
        $afterPageButton['number'] = $numberAfter;
        $buildData['buttons']['after'] = $afterPageButton;

        //
        $lastPageButton['link'] = $this->_link.$this->_linkPageIdentifier.$this->_pageCount;
        $lastPageButton['number'] = $this->_pageCount;
        $lastPageButton['dots'] = ($end<$this->_pageCount);
        $buildData['buttons']['last'] = $lastPageButton;


        $buildData['currentPage'] = $this->_currentPage;
        $buildData['firstPage'] = 1;
        $buildData['lastPage'] = $this->_pageCount;


//        Zend_Debug::dump($this);
//        Zend_Debug::dump($buildData);
        return $buildData;
    }

    /**
     *
     *
     * @param $total int
     *
     * @return void
     */
    public function render()
    {
        return '';
////      $this->buildData();
////      $this->_view->paginatorPages = $this->_pages;
////      $this->_view->paginatorButtons = $this->_buttons;
////      if ($this->_template !== null)  {
////        return $this->_view->render($this->_template);
////      } else {
////        return '';
////      }
    }

    /**
     * Magic method implemented
     *
     * @return string
     */
    public function __toString()
    {
        return $this->render();
    }


//
//    public function getPagination() {
//      $this->_buildData();
//      $tmp['pages'] = $this->_pages;
//      $tmp['currentPage'] = $this->_currentPage;
//      $tmp['firstPage'] = 1;
//      $tmp['lastPage'] = $this->_pageCount;
//      $tmp['buttons'] = $this->_buttons;
//
//      return $tmp;
//    }
//
    /*<?if($pagination):?>
      <div class="pages2">



        <?if ($pagination['currentPage']==$pagination['firstPage']):?>
          <span class="blank">Poprzednia</span>
        <?else:?>
          <a class="pagenum" href="<?=$pagination['buttons']['before']['link']?>">Poprzednia</a>
        <?endif;?>

        <?if ($pagination['buttons']['first']['dots']):?>
          <a class="pagenum" href="<?=$pagination['buttons']['first']['link']?>">
            <?=$pagination['buttons']['first']['number']?>
          </a>
          <span class="pagenum">
            ...
          </span>
        <?endif;?>

        <?foreach($pagination['pages'] as $page):?>
          <?if ($page['active']=='selected'):?>
            <span class="pagenow"><?=$page['number']?></span>
          <?else:?>
            <a class="pagenum" href="<?=$page['link']?>"><?=$page['number']?></a>
          <?endif;?>
        <?endforeach;?>

        <?if ($pagination['buttons']['last']['dots']):?>
          <span class="pagenum">
            ...
          </span>
          <a class="pagenum" href="<?=$pagination['buttons']['last']['link']?>">
            <?=$pagination['buttons']['last']['number']?>
          </a>
        <?endif;?>

        <?if ($pagination['currentPage']==$pagination['lastPage']):?>
          <span class="blank">Następna</span>
        <?else:?>
          <a class="next" href="<?=$pagination['buttons']['after']['link']?>">Następna</a>
        <?endif;?>



      </div>
    <?endif;?>*/




}
