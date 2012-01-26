<?php

namespace Exercises\Controller;

use Zend\Mvc\Controller\ActionController,
    Exercises\Model\DbTable\Workout,
    Exercises\Model\DbTable\WorkoutExercise,
    Exercises\Model\DbTable\WorkoutExerciseType;

class WorkoutExerciseTypeController extends ActionController
{
//    protected $_workout;
//    protected $_exercise;
    protected $_type;

//    public function setWorkout($workout)
//    {
//        $this->_workout = $workout;
//        return $this;
//    }
//
//    public function setExercise($exercise)
//    {
//        $this->_exercise = $exercise;
//        return $this;
//    }

    public function setView($view)
    {
        $this->_view = $view;
    }

    public function setType($type)
    {
        $this->_type = $type;
        return $this;
    }





    public function indexAction()
    {
//        $returnArray = array();
//
//        $request = $this->getRequest();
//
//        $id = $request->query()->get('id', 0);
//
//        if ($id > 0) {
//            $returnArray['workout'] = $this->_workout->getWorkout($id);
//            $returnArray['exercises'] = $this->_exercise->getWorkoutExercises($id);
//        }
//
//
//        return $returnArray;
    }

    public function addAction() {

        $form = new WorkoutExerciseForm();

        $form->submit->setLabel('Add');

        $request = $this->getRequest();

        if ($request->isPost()) {
            $formData = $request->post()->toArray();

            if ($form->isValid($formData)) {

                $values = $form->getValues();
                unset($values['id']);

                $this->_exercise->addWorkoutExercise($values);

//              // Redirect to list
                return $this->redirect()->toRoute('exercises-workout');
            }
        }
        return array('form' => $form);

    }

    public function editAction()
    {
        $form = new WorkoutExerciseForm();

        $form->submit->setLabel('Edit');

        $request = $this->getRequest();

        if ($request->isPost()) {
            $formData = $request->post()->toArray();

            if ($form->isValid($formData)) {

                $id = $form->getValue('id');

                $values = $form->getValues();

                unset($values['id']);

                if ($this->_exercise->getWorkoutExercise($id)) {
                    $this->_exercise->updateWorkoutExercise($id, $values);
                }

//              // Redirect to list
                return $this->redirect()->toRoute('exercises-workout');
            }
        } else {
            $id = $request->query()->get('id', 0);
            if ($id > 0) {
                $form->populate($this->_exercise->getWorkoutExercise($id));
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
                $this->_exercise->deleteWorkoutExercise($id);
            }
            // Redirect to list of albums
            return $this->redirect()->toRoute('exercises-workout');
        }

        $id = $request->query()->get('id', 0);
        return array('workout' => $this->_exercise->getWorkoutExercise($id));

    }



}