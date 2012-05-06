<?php
class User_AccountController extends User_Libs_Controller_Action
{
  function indexAction()
  {
    $this->view->headTitle('My Account');
//    $viewHelper = $this->_helper->getHelper('viewRenderer');
//    $viewHelper->setNoController(true);
//    $viewHelper->setScriptAction('error/error');
  }
}
