<?php

namespace Exercises\Controller;

use Zend\Mvc\Controller\ActionController,
    Exercises\Model\Workout,
    Exercises\Form\WorkoutForm;

class WorkoutController extends ActionController
{
    protected $_workout;

    public function setWorkout($workout)
    {
        $this->_workout = $workout;
        return $this;
    }

    public function indexAction()
    {
        return array(
        	'workouts' => $this->_workout->fetchAll(),
        );
    }

    public function addAction() {

        $form = new WorkoutForm();

        $form->submit->setLabel('Add');

        $request = $this->getRequest();

        if ($request->isPost()) {
            $formData = $request->post()->toArray();

            if ($form->isValid($formData)) {

                $values = $form->getValues();
                unset($values['id']);

                $this->_workout->addWorkout($values);

//              // Redirect to list
                return $this->redirect()->toRoute('exercises-workout');
            }
        }
        return array('form' => $form);

    }

    public function editAction()
    {
        $form = new WorkoutForm();

        $form->submit->setLabel('Edit');

        $request = $this->getRequest();

        if ($request->isPost()) {
            $formData = $request->post()->toArray();

            if ($form->isValid($formData)) {

                $id = $form->getValue('id');

                $values = $form->getValues();

                unset($values['id']);

                if ($this->_workout->getWorkout($id)) {
                    $this->_workout->updateWorkout($id, $values);
                }

//              // Redirect to list
                return $this->redirect()->toRoute('exercises-workout');
            }
        } else {
            $id = $request->query()->get('id', 0);
            if ($id > 0) {
                $form->populate($this->_workout->getWorkout($id));
            }
        }
        return array('form' => $form);

    }

    public function deleteAction()
    {
        $request = $this->getRequest();

        if ($request->isPost()) {
            $del = $request->post()->get('del', 'No');
            if ($del == 'Yes') {
                $id = (int) $request->post()->get('id');
                $this->_workout->deleteWorkout($id);
            }
            // Redirect to list of albums
            return $this->redirect()->toRoute('exercises-workout');
        }

        $id = $request->query()->get('id', 0);
        return array('workout' => $this->_workout->getWorkout($id));

    }



}