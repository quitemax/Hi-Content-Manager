<?php
class Hi_Navigation
{
	protected $_view;
	protected $_template;
	protected $_width;
	protected $_link;
	protected $_model;
	protected $_count;

	public function __construct($view = null, $width=5, $link = null)
	{
    $this->_view = $view;
    $this->_link = $link;
    $this->_width = $width;
	}

	public function setModel(HiZend_Db_Table $model){
    $this->_model = $model;
	}

	public function setCount( $count){
    $this->_count = (int) $count;
	}

	public function render($objects_per_page, $current_page, $template)
	{
//    $view = new Hi_View_SmartyInterface();
//    $view->setScriptPath($this->_viewPath);
//
//    if ($this->_model instanceof Hi_Zend_Db_TableX) {
//	    $_paramas['navigation']['allObjects'] = $this->_model->adminCountAllRecordsFromLastSql();
//    }
//    else if ($this->_count) {
//      $_paramas['navigation']['allObjects'] = $this->_count;
//    }
//    $_paramas['navigation']['currentPage'] = $current_page;
//    $_paramas['navigation']['objectsPerPage'] = $objects_per_page;
//    $_paramas['navigation']['allPages'] = ceil($_paramas['navigation']['allObjects']/$objects_per_page);
//    $_paramas['navigation']['width'] = $this->_width;
//    $_paramas['navigation']['halfWidth'] = ceil($this->_width/2);
//    $_paramas['navigation']['ceilHalfWidth'] = ceil($this->_width/2);
//    $_paramas['navigation']['floorHalfWidth'] = floor($this->_width/2);
//    $_paramas['navigation']['widthFromEnd'] = $_paramas['navigation']['allPages'] - $this->_width;
//    $_paramas['navigation']['ceilHalfWidthFromEnd'] = $_paramas['navigation']['allPages'] - ceil($this->_width/2);
//    $_paramas['navigation']['link'] = $this->_link;
//
//    $this->_view->navi = $_paramas['navigation'];
//    return $this->_view->render($template);
	}
}