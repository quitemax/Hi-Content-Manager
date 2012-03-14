<?php
class User_LogController extends User_Libs_Controller_Action
{
    function init() {
        parent::init();
        $this->view->headTitle('Log');
    }

    function inAction() {
    	//
        $this->view->headTitle('In');
        
//        HiZend_Debug::precho($this, 'this');
        $this->view->headLink()->appendStylesheet(
            $this->_skinUrl . '/css/log.css',
            'screen',
            true
        );

        //
        $loginForm = new User_Form_LogIn(
            array(
                'title'     =>  $this->view->translate('loginPanel'),
                'name'      => 'loginForm',
                'method'    => 'post',
                'view'      => $this->view,
            )
        );

        //
        $this->view->loginForm = $loginForm;

        //
        if ($this->_request->isPost()) {
            $post = $this->_request->getPost();
            Zend_Debug::dump($post);
            if (isset($post['header']['formId']) && $post['header']['formId'] == 'loginForm') {
                //
                if (isset($post['loginRow']['actions'])) {
                    //
                    $action = $post['loginRow']['actions'];
                    //
                    if (isset($action['submitLogin'])) {
                        //
                        $loginRow = $loginForm->getSubForm('loginRow');

                        //
                        if (!$loginRow->isValid($_POST)) {
                            $this->view->error = "Data provided is not valid";
                        } else {
                            $postLoginRow = $post['loginRow']['row'];
                            $users = new User_Model_DbTable_HicmsUsers();
                            $dbPassword = $users->getUserPassword($postLoginRow['username']);

//                            Zend_Debug::dump($users->getAdapter()->getProfiler());

                            if ($dbPassword === false) {
                                $this->view->error = "Login and password dont match";
                            } else {
                                if ($dbPassword != sha1(md5($postLoginRow['password']).'12345')) {
                                    $this->view->error = "Login and password dont match";
                                } else {
                                    $userData = $users->getUser($postLoginRow['username']);

                                    if (!$userData['superUser']) {
                                        $this->view->error = "You are not authorized to enter";
                                    } else {
                                        HiZend_Auth::getInstance()->getStorage()->write($userData);
                                        $this->_redirect(
                                            $this->_request->getPathInfo()
                                        );
                                    }
                                }
                            }
                        }
                    }
                }
            }
  		}

  		//
        $this->_helper->layout->setLayout('logIn');


    }

    function outAction() {
  	    //
  		HiZend_Auth::getInstance()->clearIdentity();

  		//
  		$this->_redirect('/');
  		$this->_helper->viewRenderer->setNoRender();
  	}
}
