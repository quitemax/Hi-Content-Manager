<?php

namespace HiTraining\Controller;

use Zend\Mvc\Controller\ActionController,
    Zend\View\Model\ViewModel,
    HiTraining\Model\Workout,
    HiTraining\Form\Workout\Grid as WorkoutGrid,
    HiTraining\Form\Workout\ResultSet as WorkoutResultSet,
    HiTraining\Form\Workout\Row as WorkoutRow;

class WorkoutController extends ActionController
{
    protected $_workout;
    protected $_exercise;
    protected $_view;

    public function setView($view)
    {
        $this->_view = $view;
        return $this;
    }

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
    public function statsAction()
    {
        return array(
            'workouts' => $this->_workout->getResultset(),
        );
    }


    /**
     *  INDEX
     *
     * Enter description here ...
     */
    public function listAction()
    {
        /**
         * Grid FORM
         */
        $form = new WorkoutGrid(
            array(
                'view' => $this->_view,
            )
        );

        /**
         * BUILDING LIST
         */
        $list = new WorkoutResultSet(
            array(
                'model' => $this->_workout,
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
        $this->_view->headScript()->appendScript(
            $this->_view->render(
                'workout/list.js',
                array(
                    'delete' => $this->url()->fromRoute('hi-training/workout/delete/wildcard', array('workout_id' => '')),
                    'edit' => $this->url()->fromRoute('hi-training/workout/edit/wildcard', array('workout_id' => '')),
                    'add' => $this->url()->fromRoute('hi-training/workout/add'),
                    'exercises' => $this->url()->fromRoute('hi-training/workout-exercise/list/wildcard', array('workout_id' => '')),
                    'addExercise' => $this->url()->fromRoute('hi-training/workout-exercise/add/wildcard', array('workout_id' => '')),
                )
            )
        );

        /**
         * POST
         */
        if ($this->getRequest()->isPost()) {

            $formData = $this->getRequest()->post()->toArray();


            if ($form->isValid($formData)) {
//                \Zend\Debug::dump($formData);
                if (    isset($formData['header']['formId'])
                        && $formData['header']['formId'] == 'WorkoutGridForm') {

                    if (isset($formData['WorkoutResultSet']['actions']['massRecount'])) {
                        $allBox = $formData['WorkoutResultSet']['header']['all'];
                        $rows = $formData['WorkoutResultSet']['rows'];

                        foreach ($rows as $key => $row) {
//                            \Zend\Debug::dump($row);
//                            if (isset($row['actions']['recount'])) {
                                if ($row['id'] || $allBox) {

                                    $workout = $this->_workout->getRow(array('workout_id' => $key));

                                    $exercises = $this->_exercise->getResultSet(array('workout_id' => $key));

                                    $workout['fat_loss'] = 0;
                                    $workout['hr_max'] = 0;
                                    $workout['calories_burned'] = 0;
                                    $workout['elapsed_time'] = 0;

//                                    \Zend\Debug::dump($workout['elapsed_time']);

                                    foreach ($exercises as $exercise) {
                                        //
                                        $workout['fat_loss'] += $exercise['fat_loss'];
                                        //
                                        if ($exercise['hr_max'] > $workout['hr_max']) {
                                            $workout['hr_max'] = $exercise['hr_max'];
                                        }

                                        //
                                        $workout['calories_burned'] += $exercise['exercise_calories_burned'];

                                        //
                                        $timeArray = explode(':', $exercise['exercise_elapsed_time']);
                                        $workout['elapsed_time'] += ($timeArray[0] * 3600 + $timeArray[1] * 60 + $timeArray[2] * 1);

//                                        \Zend\Debug::dump($workout['elapsed_time']);

                                        $timeArray = explode(':', $exercise['after_break_time']);
                                        $workout['elapsed_time'] += ($timeArray[0] * 3600 + $timeArray[1] * 60 + $timeArray[2] * 1);

//                                        \Zend\Debug::dump($workout['elapsed_time']);
                                    }

//                                    \Zend\Debug::dump($workout['elapsed_time']);
//                                    \Zend\Debug::dump(date('H:i:s', 0));

                                    $h = (int)($workout['elapsed_time'] / 3600);
                                    $m = (int)(($workout['elapsed_time'] % 3600)/60);
                                    $s = $workout['elapsed_time'] - ($h * 3600 + $m * 60);
                                    $workout['elapsed_time'] = $h . ':' . $m . ':' . $s;

//                                    \Zend\Debug::dump($workout);


                                    $workout->save();
//                                }
//
                            }
                        }

                        return $this->redirect()->toRoute('hi-training/workout/list');
                    }


                    if (isset($formData['WorkoutResultSet']['actions']['massDelete'])) {
                        $allBox = $formData['WorkoutResultSet']['header']['all'];
                        $rows = $formData['WorkoutResultSet']['rows'];

                        foreach ($rows as $key => $row) {
//                            \Zend\Debug::dump($row);
                            if ($row['id'] || $allBox) {
                                $workout = $this->_workout->getRow(array('workout_id' => $key));
                                $workout->delete();
                            }
                        }

                        return $this->redirect()->toRoute('hi-training/workout/list');
                    }
                }
            }
        }

        return array(
            'form' => $form,
        );
    }

    /**
     *  ADD
     *
     * Enter description here ...
     */
    public function addAction()
    {

        /**
         * Grid FORM
         */
        $form = new WorkoutGrid(
            array(
                'view' => $this->_view,
            )
        );

        /**
         * BUILDING Row
         */
        $row = new WorkoutRow(
            array(
                'model' => $this->_workout,
                'view' => $this->_view,
            )
        );

        $row->addAction(
            'saveAdd',
            'submit',
            array(
                'label'     => 'save and add exercise',
                'class'     => 'actionImage',
//                'image'     => $this->_skinUrl . '/img/icons/record/save.png',
            )
        );
//
        //
        $row->build();

        //
        $form->addSubForm($row, $row->getName());

        //
        $this->_view->headScript()->appendScript(
            $this->_view->render(
                'workout/add.js',
                array(
                    'back' => $this->url()->fromRoute('hi-training/workout/list'),
                )
            )
        );

        /**
         * POST
         */
        if ($this->getRequest()->isPost()) {

            $formData = $this->getRequest()->post()->toArray();
//            \Zend\Debug::dump($formData);
            if ($form->isValid($formData)) {
                if (    isset($formData['header']['formId'])
                        && $formData['header']['formId'] == 'WorkoutGridForm') {


                    if (isset($formData['WorkoutRow']['actions']['save']) || isset($formData['WorkoutRow']['actions']['saveAdd'])) {

                        if (is_array($formData['WorkoutRow']['row'])){
                            $newRow = $this->_workout->createRow()->populate($formData['WorkoutRow']['row']);
                            $newRow->save();

                            if(isset($formData['WorkoutRow']['actions']['saveAdd'])) {
                                return $this->redirect()->toRoute('hi-training/workout-exercise/add/wildcard', array('workout_id' => $newRow->getId()));
                            }
                            return $this->redirect()->toRoute('hi-training/workout/list');
                        }

                    }
                }
            }
        }




        return array('form' => $form);

    }

    /**
     *  EDIT
     *
     * Enter description here ...
     */
    public function editAction()
    {
        $request = $this->getRequest();

        $routeMatch = $this->getEvent()->getRouteMatch();
        $id     = $routeMatch->getParam('workout_id', 0);

        if ($id <= 0) {
            return $this->redirect()->toRoute('hi-training/workout/list');
        }

        /**
         * Grid FORM
         */
        $form = new WorkoutGrid(
            array(
                'view' => $this->_view,
            )
        );

        /**
         * BUILDING Row
         */
        $row = new WorkoutRow(
            array(
                'model' => $this->_workout,
                'view' => $this->_view,
            )
        );

        $row->setRowId($id);
//
        //
        $row->build();

        //
        $form->addSubForm($row, $row->getName());

        //
        $this->_view->headScript()->appendScript(
            $this->_view->render(
                'workout/edit.js',
                array(
                    'delete' => $this->url()->fromRoute('hi-training/workout/delete/wildcard', array('workout_id' => '')),
                    'back' => $this->url()->fromRoute('hi-training/workout/list'),
                )
            )
        );

        /**
         * POST
         */
        if ($this->getRequest()->isPost()) {

            $formData = $this->getRequest()->post()->toArray();
//            \HiZend\Debug\Debug::precho($formData);
            if ($form->isValid($formData)) {
                if (    isset($formData['header']['formId'])
                        && $formData['header']['formId'] == 'WorkoutGridForm') {

                    if (isset($formData['WorkoutRow']['actions']['save'])) {
//
                        if (is_array($formData['WorkoutRow']['row'])){

                            if ($updateRow = $this->_workout->getRow(array('workout_id' => $id))) {
                                $updateRow->populate($formData['WorkoutRow']['row']);
                                $updateRow->save();
                            }
//
                            return $this->redirect()->toRoute('hi-training/workout/list');
                        }
                    }
                }
            }
        }

        return array(
            'form' => $form,
            'id' => $id,
        );

    }

    /**
     *  DELETE
     *
     * Enter description here ...
     */
    public function deleteAction()
    {
        $request = $this->getRequest();

        $routeMatch = $this->getEvent()->getRouteMatch();
        $id     = $routeMatch->getParam('workout_id', 0);

        $deleteRow = $this->_workout->getRow(array('workout_id' => $id));
        if ($deleteRow) {
            $deleteRow->delete();
        }

        // Redirect to list of albums
        return $this->redirect()->toRoute('hi-training/workout/list');

    }



}