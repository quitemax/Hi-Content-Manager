<?php
class User_Libs_Controller_Action extends Root_Controller_Action
{
    function init() {
        parent::init();
        $this->view->headTitle('User');
    }
}