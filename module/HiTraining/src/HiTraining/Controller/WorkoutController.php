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
//                    'exercises' => $this->url()->fromRoute('exercises-workout-exercise-home/wildcard', array('workout_id' => '')),
//                    'addExercise' => $this->url()->fromRoute('exercises-workout-exercise-add/wildcard', array('workout_id' => '')),
                )
            )
        );

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
                            $newRow = $this->_workout->createRow()->populateOriginalData($formData['WorkoutRow']['row']);
                            $newRow->save();

//                            if(isset($formData['WorkoutRow']['actions']['saveAdd'])) {
//                                return $this->redirect()->toRoute('exercises-workout-exercise-add/wildcard', array('workout_id' => $newRow->workout_id));
//                            }
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
                                $updateRow->populateCurrentData($formData['WorkoutRow']['row']);
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