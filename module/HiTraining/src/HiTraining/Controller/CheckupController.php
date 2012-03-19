<?php

namespace HiTraining\Controller;

use Zend\Mvc\Controller\ActionController,
    Exercises\Model\Checkup,
    Exercises\Form\CheckupForm;

class CheckupController extends ActionController
{
    protected $_checkup;

    public function setCheckup($checkup)
    {
        $this->_checkup = $checkup;
        return $this;
    }

    public function indexAction()
    {
        return array(
        	'checkups' => $this->_checkup->getResultSet(),
        );
    }

    public function listAction()
    {
        return array(
        	'checkups' => $this->_checkup->fetchAll(),
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
