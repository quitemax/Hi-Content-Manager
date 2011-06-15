<?php
/**
 * Default_StartController
 *
 * @author
 * @version
 */
class StartController extends HiZend_Controller_Action {

    function init() {
        parent::init();
        $this->view->headTitle('Default');
        $this->view->headTitle('Index');
    }

    function indexAction() {
        $this->view->headTitle('Start');
    }

}

