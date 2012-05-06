<?php


namespace HiUser\Controller;

use Zend\Mvc\Controller\ActionController,
    HiUser\Form\User\LogIn as LogInForm;

class LogController extends ActionController
{
    protected $_view;

    public function setView($view)
    {
        $this->_view = $view;
        return $this;
    }

    public function inAction()
    {

        $this->_view->headTitle('Log / In');

        $loginForm = new LogInForm(
            array(
                'view' => $this->_view,
            )
        );


        /**
         * POST
         */
        if ($this->getRequest()->isPost()) {

            $formData = $this->getRequest()->post()->toArray();

            \Zend\Debug::dump($formData);
//
//
//            if ($form->isValid($formData)) {
//                if (    isset($formData['header']['formId'])
//                        && $formData['header']['formId'] == 'ExerciseTypeGridForm') {
//
//                    if (isset($formData['ExerciseTypeRow']['actions']['save'])) {
//
//                        if (is_array($formData['ExerciseTypeRow']['row'])){
////                            \Zend\Debug::dump($formData);
//
//                            if ($id > 0) {
//                                $row = $this->_type->getRow(array('type_id' => $id));
//                            } else {
//                                $row = $this->_type->createRow();
//                            }
//
//                            //
//                            $formDescend = isset($formData['ExerciseTypeRow']['row']['descend_form_type']) ? $formData['ExerciseTypeRow']['row']['descend_form_type'] : 0;
//                            unset($formData['ExerciseTypeRow']['row']['descend_form_type']);
//
//                            //
//                            $row->populateCurrentData($formData['ExerciseTypeRow']['row']);
//
//                            $row->save();
//
//                            $this->_type->getBehaviour('nestedSet')->rebuildNestedSetFromAdjacencyModel();
//
////                            \Zend\Debug::dump($row->toArray());
//
//                            //
//                            if ($id > 0 && $formDescend) {
//
//                                $refreshedRow = $this->_type->getRow(array('type_id' => $id));
//
//                                $editResultSet = $this->_type->getResultSet(array('tree_parent_id' => $id));
//                                foreach ($editResultSet as $editRow) {
//                                    $editRow->populateCurrentData(
//                                        array(
//                                            'form_type' => $formData['ExerciseTypeRow']['row']['form_type'],
//                                        )
//                                    )->save();
//                                }
////                                \Zend\Debug::dump($editResultSet->toArray());
//                            }
//
//                            $wildcard = array();
//                            if ($id > 0) {
//                                $wildcard = array('type_id' =>  $id);
//                            } else {
//                                $wildcard = array('type_id' =>  $row->getId());
//                            }
//
//                            return $this->redirect()->toRoute('hi-training/exercise-type/edit-tree/wildcard', $wildcard);
//
//
//
//                        }
//                    }
//
//                    if (isset($formData['ExerciseTypeRow']['actions']['add'])) {
//
//                        return $this->redirect()->toRoute('hi-training/exercise-type/edit-tree');
//                    }
//
//                    if (isset($formData['ExerciseTypeRow']['actions']['delete'])) {
//
//                        if ($id > 0) {
//                            $editRow = $this->_type->getRow(array('type_id' => $id));
//                            $editRow->delete();
//                            $this->_type->getBehaviour('nestedSet')->rebuildNestedSetFromAdjacencyModel();
//                        }
//                        return $this->redirect()->toRoute('hi-training/exercise-type/edit-tree');
//                    }
//                }
//            }
        }


        return array(
            'loginForm' => $loginForm,
        );
    }

    public function outAction()
    {

        $this->_view->headTitle('Log / Out');



        return array();
    }
}

//
////        HiZend_Debug::precho($this, 'this');
//        $this->view->headLink()->appendStylesheet(
//            $this->_skinUrl . '/css/log.css',
//            'screen',
//            true
//        );
//
        //
//        $loginForm = new User_Form_LogIn(
//            array(
//                'title'     =>  $this->view->translate('loginPanel'),
//                'name'      => 'loginForm',
//                'method'    => 'post',
//                'view'      => $this->view,
//            )
//        );
//
//        //
//        $this->view->loginForm = $loginForm;
//
//        //
//        if ($this->_request->isPost()) {
//            $post = $this->_request->getPost();
//            Zend_Debug::dump($post);
//            if (isset($post['header']['formId']) && $post['header']['formId'] == 'loginForm') {
//                //
//                if (isset($post['loginRow']['actions'])) {
//                    //
//                    $action = $post['loginRow']['actions'];
//                    //
//                    if (isset($action['submitLogin'])) {
//                        //
//                        $loginRow = $loginForm->getSubForm('loginRow');
//
//                        //
//                        if (!$loginRow->isValid($_POST)) {
//                            $this->view->error = "Data provided is not valid";
//                        } else {
//                            $postLoginRow = $post['loginRow']['row'];
//                            $users = new User_Model_DbTable_HicmsUsers();
//                            $dbPassword = $users->getUserPassword($postLoginRow['username']);
//
////                            Zend_Debug::dump($users->getAdapter()->getProfiler());
//
//                            if ($dbPassword === false) {
//                                $this->view->error = "Login and password dont match";
//                            } else {
//                                if ($dbPassword != sha1(md5($postLoginRow['password']).'12345')) {
//                                    $this->view->error = "Login and password dont match";
//                                } else {
//                                    $userData = $users->getUser($postLoginRow['username']);
//
//                                    if (!$userData['superUser']) {
//                                        $this->view->error = "You are not authorized to enter";
//                                    } else {
//                                        HiZend_Auth::getInstance()->getStorage()->write($userData);
//                                        $this->_redirect(
//                                            $this->_request->getPathInfo()
//                                        );
//                                    }
//                                }
//                            }
//                        }
//                    }
//                }
//            }
//  		}
//
//  		//
//        $this->_helper->layout->setLayout('logIn');
//
//
//    }
//
//    function outAction() {
//  	    //
//  		HiZend_Auth::getInstance()->clearIdentity();
//
//  		//
//  		$this->_redirect('/');
//  		$this->_helper->viewRenderer->setNoRender();
//  	}
//}
