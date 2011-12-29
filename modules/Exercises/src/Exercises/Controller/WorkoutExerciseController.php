<?php

namespace Exercises\Controller;

use Zend\Mvc\Controller\ActionController,
    Exercises\Model\DbTable\Workout,
    Exercises\Model\DbTable\WorkoutExercise,
    Exercises\Model\DbTable\WorkoutExerciseType,
    Exercises\Form\WorkoutExerciseGridForm,
    Exercises\Form\WorkoutExerciseGridForm\WorkoutExerciseRowsetSubForm,
    Exercises\Form\WorkoutExerciseGridForm\WorkoutExerciseRowSubForm;

class WorkoutExerciseController extends ActionController
{
    protected $_workout;
    protected $_exercise;
    protected $_exerciseType;
    protected $_view;

    public function setWorkout($workout)
    {
        $this->_workout = $workout;
        return $this;
    }

    public function setView($view)
    {
        $this->_view = $view;
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

        $request = $this->getRequest();

        $routeMatch = $this->getEvent()->getRouteMatch();
        $id     = $routeMatch->getParam('workout_id', 0);

        if ($id <= 0) {
            return $this->redirect()->toRoute('exercises-workout-home');
        }

        /**
         * Grid FORM
         */
        $form = new WorkoutExerciseGridForm(
            array(
                'view' => $this->_view,
            )
        );

        /**
         * BUILDING LIST
         */
        $list = new WorkoutExerciseRowsetSubForm(
            array(
                'model' => $this->_exercise,
                'view' => $this->_view,
            )
        );
//
//        \HiZend\Debug\Debug::precho($this->_exerciseType->getAllForSelect());
        $list->setFieldOptions('type_id', array(
            'values' => $this->_exerciseType->getAllForSelect(),
        ));

//        $list->setFieldOptions('result', array(
//            'values' => $this->_exerciseType->getRowset()->toArray(),
//            'viewScript' => 'exercises-workout-exercise/_field_result.phtml',
//        ));

        $list->addField(
            'results',
            'custom',
            array(
                'label' => 'results',
                'sortable' => false,
                'values' => $this->_exerciseType->getRowset()->toArray(),
                'viewScript' => 'exercises-workout-exercise/_field_result.phtml',
            )
        );

        $list->setDbWhere('we.workout_id = ' . (int)$id);

        //
        $list->processRequest($this->getRequest());

        //
        $list->build();

        //
        $form->addSubForm($list, $list->getName());

        //
        $this->_view->headScript()->appendScript(
            $this->_view->render(
                'exercises-workout-exercise/index.js',
                array(
//                    'delete' => $this->url()->fromRoute('exercises-workout-delete/wildcard', array('workout_id' => '')),
//                    'edit' => $this->url()->fromRoute('exercises-workout-edit/wildcard', array('workout_id' => '')),
//                    'add' => $this->url()->fromRoute('exercises-workout-add'),
//                    'exercises' => $this->url()->fromRoute('exercises-workout-exercise-home/wildcard', array('workout_id' => '')),
//                    'addExercise' => $this->url()->fromRoute('exercises-workout-exercise-add/wildcard', array('workout_id' => '')),
                )
            )
        );
//
//        return array(
//            'form' => $form,
//        );
//        $returnArray = array();





        return array(
            'form' => $form,
            'workout'   => $this->_workout->getWorkout($id),
//            'exercises' => $this->_exercise->getWorkoutExercises($id),
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