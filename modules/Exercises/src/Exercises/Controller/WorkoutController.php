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
        	'workouts' => $this->_workout->getWorkouts(),
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
                unset($values['workout_id']);

                $this->_workout->addWorkout($values);

//              // Redirect to list
                return $this->redirect()->toRoute('exercises-workout-home');
            }
        }
        return array('form' => $form);

    }

    public function editAction()
    {
        $form = new WorkoutForm();

        $form->submit->setLabel('Edit');

        $request = $this->getRequest();

        $workout = 0;

        if ($request->isPost()) {
            $formData = $request->post()->toArray();

            if ($form->isValid($formData)) {

                $id = $form->getValue('workout_id');

                $values = $form->getValues();

                unset($values['workout_id']);

                if ($this->_workout->getWorkout($id)) {
                    $this->_workout->updateWorkout($id, $values);
                }

//              // Redirect to list
                return $this->redirect()->toRoute('exercises-workout-home');
            }
        } else {
            $id = $request->query()->get('workout_id', 0);
            if ($id > 0) {
                $workout = $this->_workout->getWorkout($id);
                $form->populate($workout->toArray());

            }
        }
        return array(
            'form' => $form,
            'workout' => $workout,
        );

    }

    public function deleteAction()
    {
        $request = $this->getRequest();

        if ($request->isPost()) {
            $del = $request->post()->get('del', 'No');
            if ($del == 'Yes') {
                $id = (int) $request->post()->get('workout_id');
                $this->_workout->deleteWorkout($id);
            }
            // Redirect to list of albums
            return $this->redirect()->toRoute('exercises-workout-home');
        }

        $id = $request->query()->get('workout_id', 0);
        return array('workout' => $this->_workout->getWorkout($id));

    }



}