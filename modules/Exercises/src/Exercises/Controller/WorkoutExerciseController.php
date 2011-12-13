<?php

namespace Exercises\Controller;

use Zend\Mvc\Controller\ActionController,
    Exercises\Model\WorkoutExercise,
    Exercises\Form\WorkoutExerciseForm;

class WorkoutExerciseController extends ActionController
{
    protected $_workout;
    protected $_exercise;
    protected $_exerciseType;

    public function setWorkout($workout)
    {
        $this->_workout = $workout;
        return $this;
    }

    public function setExercise($exercise)
    {
        $this->_exercise = $exercise;
        return $this;
    }

    public function setType($type)
    {
        $this->_exerciseType = $type;
        return $this;
    }

    public function indexAction()
    {
        $returnArray = array();

        $request = $this->getRequest();

        $id = $request->query()->get('workout_id', 0);

        if ($id <= 0) {
            return $this->redirect()->toRoute('exercises-workout-home');
        }



        return array(
            'workout'   => $this->_workout->getWorkout($id),
            'exercises' => $this->_exercise->getWorkoutExercises($id),
        );

    }

    public function addAction()
    {
        $request = $this->getRequest();

        $id = $request->query()->get('workout_id', 0);

        if ($id <= 0) {
            return $this->redirect()->toRoute('exercises-workout-home');
        }

        $workout = $this->_workout->getWorkout($id);

        if (!$workout) {
            return $this->redirect()->toRoute('exercises-workout-home');
        }

        $form = new WorkoutExerciseForm();

        $form->submit->setLabel('Add');
        $form->workout_id->setValue($id);
        $form->type_id->setMultiOptions($this->_exerciseType->getAllForSelect());

        $request = $this->getRequest();

        if ($request->isPost()) {
            $formData = $request->post()->toArray();

            if ($form->isValid($formData)) {
                $values = $form->getValues();

                unset($values['exercise_id']);

                $this->_exercise->addWorkoutExercise($values);

//              // Redirect to list
                return $this->redirect()->toUrl(
                    $this->url()->fromRoute(
                        'exercises-workout-exercise-home'
                    ) . '?workout_id=' . $workout->workout_id
                );

            }
        }
        return array(
            'form'        => $form,
            'workout'     => $workout,
        );

    }

    public function editAction()
    {

        $request = $this->getRequest();

        $id = $request->query()->get('exercise_id', 0);
        if ($id <= 0) {
            return $this->redirect()->toRoute('exercises-workout-home');
        }

        $exercise = $this->_exercise->getWorkoutExercise($id);

        if (!$exercise) {
            return $this->redirect()->toRoute('exercises-workout-home');
        }

        $form = new WorkoutExerciseForm();

        $form->submit->setLabel('Edit');
        $form->type_id->setMultiOptions($this->_exerciseType->getAllForSelect());



        $workout = 0;



        if ($request->isPost()) {
            $formData = $request->post()->toArray();

            if ($form->isValid($formData)) {

                $id = $form->getValue('exercise_id');

                $values = $form->getValues();

                unset($values['exercise_id']);

                    $this->_exercise->updateWorkoutExercise($id, $values);
                    $exercise = $this->_exercise->getWorkoutExercise($id);

//              // Redirect to list
                return $this->redirect()->toUrl(
                    $this->url()->fromRoute(
                        'exercises-workout-exercise-home'
                    ) . '?workout_id=' . $exercise->workout_id
                );
            }
        } else {

                $form->populate($exercise->toArray());

        }
        //return array('form' => $form);
        return array(
            'form' => $form,
//            'workout' => $workout,
            'exercise' => $exercise,
        );

    }

    public function deleteAction()
    {
        $request = $this->getRequest();

        $id = $request->query()->get('exercise_id', 0);
        if ($id <= 0) {
            return $this->redirect()->toRoute('exercises-workout-home');
        }

        $exercise = $this->_exercise->getWorkoutExercise($id);

        if (!$exercise) {
            return $this->redirect()->toRoute('exercises-workout-home');
        }


        if ($request->isPost()) {
            $del = $request->post()->get('del', 'No');
            if ($del == 'Yes') {
                $id = (int) $request->post()->get('exercise_id');
                $this->_exercise->deleteWorkoutExercise($id);
            }
            // Redirect to list of albums
            return $this->redirect()->toUrl(
                    $this->url()->fromRoute(
                        'exercises-workout-exercise-home'
                    ) . '?workout_id=' . $exercise->workout_id
            );
        }

        $id = $request->query()->get('exercise_id', 0);
        return array('exercise' => $this->_exercise->getWorkoutExercise($id));

    }



}