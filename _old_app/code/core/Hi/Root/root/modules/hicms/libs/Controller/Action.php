<?php 
class Hicms_Libs_Controller_Action extends Root_Controller_Action
{
    /**
     * Init
     *
     * Mainly init of parent class, etc...
     *
     */
    function init() {
        parent::init();
        $this->view->headTitle('Hicms');
    }
}