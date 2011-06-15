<?php
class Root_Controller_Action extends HiZend_Controller_Action
{
    /**
     * Init
     *
     * Mainly init of parent class, etc...
     *
     */
    function init() {
        parent::init();
        $this->view->headTitle('Root');
    }
}