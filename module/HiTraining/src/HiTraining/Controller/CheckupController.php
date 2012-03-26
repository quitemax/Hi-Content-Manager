<?php

namespace HiTraining\Controller;

use Zend\Mvc\Controller\ActionController,
    Zend\View\Model\ViewModel,
    HiTraining\Model\Checkup,
    HiTraining\Form\CheckupGrid,
    HiTraining\Form\CheckupGrid\CheckupResultSet;

class CheckupController extends ActionController
{
	/**
     *  checkup model
     *
     * Enter description here ...
     */
    protected $_checkup;

    public function setCheckup($checkup)
    {
        $this->_checkup = $checkup;
        return $this;
    }

    /**
     *  view renderer
     *
     * Enter description here ...
     */
    protected $_view;

    public function setView($view)
    {
        $this->_view = $view;
        return $this;
    }

    /**
     *  INDEX
     *
     * Enter description here ...
     */
    public function indexAction()
    {
        return array(
        	'checkups' => $this->_checkup->getResultSet(),
        );
    }


	/**
     *  LIST
     *
     * Enter description here ...
     */
    public function listAction()
    {
        /**
         * Grid FORM
         */
        $form = new CheckupGrid(
            array(
                'view' => $this->_view,
            )
        );

        /**
         * BUILDING LIST
         */
        $list = new CheckupResultSet(
            array(
                'model' => $this->_checkup,
                'view' => $this->_view,
            )
        );

        //
        $list->processRequest($this->getRequest());

        //
        $list->build();

        //
        $form->addSubForm($list, $list->getName());

//        //
//        $this->_view->headScript()->appendScript(
//            $this->_view->render(
//                'exercises-workout/index.js',
//                array(
//                    'delete' => $this->url()->fromRoute('exercises-workout-delete/wildcard', array('workout_id' => '')),
//                    'edit' => $this->url()->fromRoute('exercises-workout-edit/wildcard', array('workout_id' => '')),
//                    'add' => $this->url()->fromRoute('exercises-workout-add'),
//                    'exercises' => $this->url()->fromRoute('exercises-workout-exercise-home/wildcard', array('workout_id' => '')),
//                    'addExercise' => $this->url()->fromRoute('exercises-workout-exercise-add/wildcard', array('workout_id' => '')),
//                )
//            )
//        );
//
        return array(
            'form' => $form,
        );
    }

    public function addAction()
    {
//        $form = new CheckupForm();
//
//        $form->submit->setLabel('Add');
//
//        $request = $this->getRequest();
//
//        if ($request->isPost()) {
//            $formData = $request->post()->toArray();
//
//            if ($form->isValid($formData)) {
//
//                $values = $form->getValues();
//                unset($values['checkup_id']);
//
//                $this->_checkup->addCheckup($values);
//
////              // Redirect to list
//                return $this->redirect()->toRoute('exercises-checkup-home');
//            }
//        }
//        return array('form' => $form);

    }

    public function editAction()
    {
//        $form = new CheckupForm();
//
//        $form->submit->setLabel('Edit');
//
//        $request = $this->getRequest();
//
//        $checkup = 0;
//
//        if ($request->isPost()) {
//            $formData = $request->post()->toArray();
//
//            if ($form->isValid($formData)) {
//
//                $id = $form->getValue('checkup_id');
//
//                $values = $form->getValues();
//                unset($values['checkup_id']);
//
//                if ($this->_checkup->getCheckup($id)) {
//                    $this->_checkup->updateCheckup($id, $values);
//                }
//
////              // Redirect to list
//                return $this->redirect()->toRoute('exercises-checkup-home');
//            }
//        } else {
//            $id = $request->query()->get('checkup_id', 0);
//            if ($id > 0) {
//                $checkup = $this->_checkup->getCheckup($id);
//                $form->populate($checkup->toArray());
//
//            }
//        }
//        return array(
//            'form' => $form,
//            'checkup' => $checkup,
//        );

    }

    public function deleteAction()
    {
//        $request = $this->getRequest();
//
//        if ($request->isPost()) {
//            $del = $request->post()->get('del', 'No');
//            if ($del == 'Yes') {
//                $id = (int) $request->post()->get('checkup_id');
//                echo "<pre>" . '"$id" ';
//                 print_r($id);
//                echo "</pre>";
//
//                $this->_checkup->deleteCheckup($id);
//            }
//            // Redirect to list of albums
//            return $this->redirect()->toRoute('exercises-checkup-home');
//        }
//
//        $id = $request->query()->get('checkup_id', 0);
//        return array('checkup' => $this->_checkup->getCheckup($id));

    }



}
