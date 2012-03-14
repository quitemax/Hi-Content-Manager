<?php
class Navigation_IndexController extends HiZend_Controller_Action
{
    function init() {
        parent::init();
        $this->view->headTitle('Navigation');
        $this->view->headTitle('Index');
    }

    function indexAction() {
        $this->view->headTitle('Index');

//        /*@var $menus HiZend_Db_Table_Translated*/
//        $naviItemsModel = new Hicms_Model_NavigationItems();
    }

}
