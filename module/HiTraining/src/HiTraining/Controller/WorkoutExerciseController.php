<?php

namespace HiTraining\Controller;

use Zend\Mvc\Controller\ActionController,
    Zend\View\Model\ViewModel,
    HiTraining\Model\WorkoutExercise,
    HiTraining\Form\WorkoutExercise\Grid as WorkoutExerciseGrid,
    HiTraining\Form\WorkoutExercise\ResultSet as WorkoutExerciseResultSet,
    HiTraining\Form\WorkoutExercise\Row as WorkoutExerciseRow;

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

    /**
     *  INDEX
     *
     * Enter description here ...
     */
    public function indexAction()
    {
        return array();
    }

    /**
     *  INDEX
     *
     * Enter description here ...
     */
    public function listAction()
    {
//
        $request = $this->getRequest();

        $routeMatch = $this->getEvent()->getRouteMatch();
        $id     = $routeMatch->getParam('workout_id', 0);

        if ($id <= 0) {
            return $this->redirect()->toRoute('hi-training/workout/list');
        }

        /**
         * Grid FORM
         */
        $form = new WorkoutExerciseGrid(
            array(
                'view' => $this->_view,
            )
        );

        /**
         * BUILDING LIST
         */
        $list = new WorkoutExerciseResultSet(
            array(
                'model' => $this->_exercise,
                'view' => $this->_view,
            )
        );

        $list->setFieldOptions('type_id', array(
            'values' => $types = $this->_exerciseType->getBehaviour('nestedSet')->getResultSetForText(),
        ));

        $typesTemp = $this->_exerciseType->getResultSet()->toArray();
        $types = array();
        foreach ( $typesTemp as $key => $type) {
            $types[$type['type_id']] = $type;
        }


        $list->addField(
            'results',
            'custom',
            array(
                'label' => 'results',
                'sortable' => false,
                'values' => $types,
                'viewScript' => 'workout-exercise/_field_result.phtml',
            )
        );

        $list->setDbWhere('workout_id = ' . (int)$id);

        //
        $list->processRequest($this->getRequest());

        //
        $list->build();

        //
        $form->addSubForm($list, $list->getName());

//        //
//        $this->_view->headScript()->appendScript(
//            $this->_view->render(
//                'exercises-workout-exercise/index.js',
//                array(
//                    'back' => $this->url()->fromRoute('exercises-workout-home'),
//                    'delete' => $this->url()->fromRoute('exercises-workout-exercise-delete/wildcard', array('exercise_id' => '')),
//                    'edit' => $this->url()->fromRoute('exercises-workout-exercise-edit/wildcard', array('exercise_id' => '')),
//                    'add' => $this->url()->fromRoute('exercises-workout-exercise-add/wildcard', array('workout_id' => $id)),
//                )
//            )
//        );

        /**
         * POST
         */
        if ($this->getRequest()->isPost()) {

            $formData = $this->getRequest()->post()->toArray();


//            if ($form->isValid($formData)) {
////                \HiZend\Debug\Debug::dump($formData);
//                if (    isset($formData['header']['formId'])
//                        && $formData['header']['formId'] == 'WorkoutExerciseGridForm') {
//
//                    if (isset($formData['WorkoutExerciseRowset']['actions']['saveSelected'])) {
//                        $allBox = $formData['WorkoutExerciseRowset']['header']['all'];
//                        $rows = $formData['WorkoutExerciseRowset']['rows'];
//
//                        foreach ($rows as $key => $row) {
//                            if ($row['id'] || $allBox) {
////                                \HiZend\Debug\Debug::dump($row['row']);
////                                \HiZend\Debug\Debug::dump($key);
//
//                                $exercise = $this->_exercise->getWorkoutExercise($key);
//                                $exercise->setFromArray($row['row']);
//                                $exercise->save();
//
//                            }
//                        }
//
//                        return $this->redirect()->toRoute('exercises-workout-exercise-home/wildcard', array('workout_id' => $id));
//                    }
//
//                    if (isset($formData['WorkoutExerciseRowset']['actions']['deleteSelected'])) {
////\HiZend\Debug\Debug::dump($formData);
//                        $allBox = $formData['WorkoutExerciseRowset']['header']['all'];
//                        $rows = $formData['WorkoutExerciseRowset']['rows'];
//
//                        foreach ($rows as $key => $row) {
//                            if ($row['id'] || $allBox) {
////                                \HiZend\Debug\Debug::dump($row['row']);
//
//                                $exercise = $this->_exercise->getWorkoutExercise($key);
//                                $exercise->delete();
//
//                            }
//                        }
//
//                        return $this->redirect()->toRoute('exercises-workout-exercise-home/wildcard', array('workout_id' => $id));
//
//                    }
//                }
//            }
        }

        return array(
            'form' => $form,
            'workout'   => $this->_workout->getRow(array('workout_id'=>$id)),
        );

    }

    /**
     *  ADD
     *
     * Enter description here ...
     */
    public function addAction()
    {
        $request = $this->getRequest();

        $routeMatch = $this->getEvent()->getRouteMatch();
        $id     = $routeMatch->getParam('workout_id', 0);

        if ($id <= 0) {
            return $this->redirect()->toRoute('hi-training/workout/list');
        }

        $workout = $this->_workout->getRow(array('workout_id' => $id));
//
        if (!$workout) {
            return $this->redirect()->toRoute('hi-training/workout/list');
        }

        /**
         * Grid FORM
         */
        $form = new WorkoutExerciseGrid(
            array(
                'view' => $this->_view,
            )
        );

        /**
         * BUILDING Row
         */
        $row = new WorkoutExerciseRow(
            array(
                'model' => $this->_exercise,
                'view' => $this->_view,
            )
        );
//
//        $row->setFieldOptions('type_id', array(
//            'values' => $this->_exerciseType->getAllForSelect(),
//            'onchange' => 'exerciseType(this);',
//        ));
//        $row->setFieldOptions('workout_id', array(
//            'value' => $id,
//        ));
        //
        $row->build();

        //
        $form->addSubForm($row, $row->getName());

        //
//        $this->_view->headScript()->appendScript(
//            $this->_view->render(
//                'exercises-workout-exercise/add.js',
//                array(
//                    'back' => $this->url()->fromRoute('exercises-workout-exercise-home/wildcard', array('workout_id' => $id)),
//                    'formTypesData' => $this->_exerciseType->getRowset()->toArray(),
//                    'lastOfTypeData' => $this->_exerciseType->getLastOfTypes(),
//                )
//            )
//        );


        /**
         * POST
         */
        if ($this->getRequest()->isPost()) {

            $formData = $this->getRequest()->post()->toArray();

            if ($form->isValid($formData)) {

//                if (    isset($formData['header']['formId'])
//                        && $formData['header']['formId'] == 'WorkoutExerciseGridForm') {
//
//                    if (isset($formData['WorkoutExerciseRow']['actions']['save'])) {
//
//                        if (is_array($formData['WorkoutExerciseRow']['row'])){
//                            $newRow = $this->_exercise->createRow($formData['WorkoutExerciseRow']['row']);
//                            $newRow->save();
////
//                            return $this->redirect()->toRoute('exercises-workout-exercise-home/wildcard', array('workout_id' => $id));
//                        }
//
//                    }
//
//                    if (isset($formData['WorkoutExerciseRow']['actions']['saveAdd'])) {
//
//                        if (is_array($formData['WorkoutExerciseRow']['row'])){
//                            $newRow = $this->_exercise->createRow($formData['WorkoutExerciseRow']['row']);
//                            $newRow->save();
////
//                            return $this->redirect()->toRoute('exercises-workout-exercise-add/wildcard', array('workout_id' => $id));
//                        }
//
//                    }
//                }
            }
        }

        //
        return array(
            'form'        => $form,
            'workout'     => $workout,
        );

    }

    /**
     *  EDIT
     *
     * Enter description here ...
     */
    public function editAction()
    {

//        $request = $this->getRequest();
//
//        $routeMatch = $this->getEvent()->getRouteMatch();
//        $id     = $routeMatch->getParam('exercise_id', 0);
//
//        if ($id <= 0) {
//            return $this->redirect()->toRoute('exercises-workout-home');
//        }
//
//        $exercise = $this->_exercise->getWorkoutExercise($id);
//
//        if (!$exercise) {
//            return $this->redirect()->toRoute('exercises-workout-home');
//        }
//
//        $workoutId = $exercise->workout_id;
//
//        $workout = $this->_workout->getWorkout($workoutId);
//
//        if (!$workout) {
//            return $this->redirect()->toRoute('exercises-workout-home');
//        }
//
//        /**
//         * Grid FORM
//         */
//        $form = new WorkoutExerciseGrid(
//            array(
//                'view' => $this->_view,
//            )
//        );
//
//        /**
//         * BUILDING Row
//         */
//        $row = new ExerciseRow(
//            array(
//                'model' => $this->_exercise,
//                'view' => $this->_view,
//            )
//        );
//
//        //
//        $row->setRowId($id);
//
//        $row->setFieldOptions('type_id', array(
//            'values' => $this->_exerciseType->getAllForSelect(),
//            'onchange' => 'exerciseType(this);',
//        ));
//        $row->setFieldOptions('workout_id', array(
//            'value' => $id,
//        ));
//
//        //
//        $row->build();
//
//        //
//        $form->addSubForm($row, $row->getName());
//
//        //
//        $this->_view->headScript()->appendScript(
//            $this->_view->render(
//                'exercises-workout-exercise/edit.js',
//                array(
//                    'back' => $this->url()->fromRoute('exercises-workout-exercise-home/wildcard', array('workout_id' => $workoutId)),
//                    'formTypesData' => $this->_exerciseType->getRowset()->toArray(),
//                )
//            )
//        );
//
//
//        /**
//         * POST
//         */
//        if ($this->getRequest()->isPost()) {
//
//            $formData = $this->getRequest()->post()->toArray();
//
//            if ($form->isValid($formData)) {
//
//                if (    isset($formData['header']['formId'])
//                        && $formData['header']['formId'] == 'WorkoutExerciseGridForm') {
//
//                    if (isset($formData['WorkoutExerciseRow']['actions']['save'])) {
//
//                        if (is_array($formData['WorkoutExerciseRow']['row'])){
//                            \HiZend\Debug\Debug::precho($formData['WorkoutExerciseRow']['row']);
//
//                            $exercise->setFromArray($formData['WorkoutExerciseRow']['row']);
//                            $exercise->save();
//
//                            return $this->redirect()->toRoute('exercises-workout-exercise-home/wildcard', array('workout_id' => $workoutId));
//                        }
//
//                    }
//                }
//            }
//        }
//
//        return array(
//            'form'        => $form,
//            'workout'     => $workout,
//        );
    }

    /**
     *  DELETE
     *
     * Enter description here ...
     */
    public function deleteAction()
    {
//        $request = $this->getRequest();
//
//        $routeMatch = $this->getEvent()->getRouteMatch();
//        $id     = $routeMatch->getParam('exercise_id', 0);
//
//        if ($id <= 0) {
//            return $this->redirect()->toRoute('exercises-workout-home');
//        }
//
//        $exercise = $this->_exercise->getWorkoutExercise($id);
//
//        if (!$exercise) {
//            return $this->redirect()->toRoute('exercises-workout-home');
//        }
//
//        $workoutId = $exercise->workout_id;
//
//        $exercise->delete();
//
//
//        return $this->redirect()->toRoute('exercises-workout-exercise-home/wildcard', array('workout_id' => $workoutId));

    }



}