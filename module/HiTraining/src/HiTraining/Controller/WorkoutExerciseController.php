<?php

namespace HiTraining\Controller;

use Zend\Mvc\Controller\ActionController,
    Zend\View\Model\ViewModel,
    HiTraining\Model\WorkoutExercise,
    HiTraining\Form\WorkoutExercise\Grid as WorkoutExerciseGrid,
    HiTraining\Form\WorkoutExercise\ResultSet as WorkoutExerciseResultSet,
    HiTraining\Form\WorkoutExercise\Row as WorkoutExerciseRow,
    Zend\View\Model\JsonModel;

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

    public function ajaxLastOfTypeAction()
    {
        $request = $this->getRequest();

        $routeMatch = $this->getEvent()->getRouteMatch();
        $id     = $routeMatch->getParam('type_id', 0);

        $type = $this->_exerciseType->getRow(array('type_id' => $id))->toArray();

        $exercise = $this->_exercise->getRow(array('type_id' => $id), array('workout_id desc'))->toArray();

        return new JsonModel(array(
            'exercise' => $exercise,
        ));
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
        $this->_view->headScript()->appendScript(
            $this->_view->render(
                'workout-exercise/list.js',
                array(
                    'back' => $this->url()->fromRoute('hi-training/workout/list'),
                    'delete' => $this->url()->fromRoute('hi-training/workout-exercise/delete/wildcard', array('exercise_id' => '')),
                    'edit' => $this->url()->fromRoute('hi-training/workout-exercise/edit/wildcard', array('exercise_id' => '')),
                    'add' => $this->url()->fromRoute('hi-training/workout-exercise/add/wildcard', array('workout_id' => $id)),
                )
            )
        );

        /**
         * POST
         */
        if ($this->getRequest()->isPost()) {

            $formData = $this->getRequest()->post()->toArray();


            if ($form->isValid($formData)) {
                \Zend\Debug::dump($formData);
                if (    isset($formData['header']['formId'])
                        && $formData['header']['formId'] == 'WorkoutExerciseGridForm') {

                    if (isset($formData['WorkoutExerciseResultSet']['actions']['saveSelected'])) {
                        $allBox = $formData['WorkoutExerciseResultSet']['header']['all'];
                        $rows = $formData['WorkoutExerciseResultSet']['rows'];

                        foreach ($rows as $key => $row) {
                            if ($row['id'] || $allBox) {
                                $exercise = $this->_exercise->getRow(array('exercise_id' => $key));
                                $exercise->populate($row['row']);
                                $exercise->save();

                            }
                        }

                        return $this->redirect()->toRoute('hi-training/workout-exercise/list/wildcard', array('workout_id' => $id));
                    }

                    if (isset($formData['WorkoutExerciseResultSet']['actions']['deleteSelected'])) {

                        $allBox = $formData['WorkoutExerciseResultSet']['header']['all'];
                        $rows = $formData['WorkoutExerciseResultSet']['rows'];

                        foreach ($rows as $key => $row) {
                            if ($row['id'] || $allBox) {

                                $exercise = $this->_exercise->getRow(array('exercise_id' => $key));
                                $exercise->delete();

                            }
                        }

                        return $this->redirect()->toRoute('hi-training/workout-exercise/list/wildcard', array('workout_id' => $id));
//
                    }
                }
            }
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

        $row->setFieldOptions('type_id', array(
            'values' => $this->_exerciseType->getBehaviour('nestedSet')->getResultSetForSelect(),
            'onchange' => 'exerciseType(this);',
        ));
        $row->setFieldOptions('workout_id', array(
            'value' => $id,
        ));

        //



        //
        $row->build();

        //
        $form->addSubForm($row, $row->getName());

        //
        $this->_view->headScript()->appendScript(
            $this->_view->render(
                'workout-exercise/add.js',
                array(
                    'currentFormType'     => 0,
                    'back'                => $this->url()->fromRoute(
                        'hi-training/workout-exercise/list/wildcard',
                        array('workout_id' => $id)
                    ),
                    'ajaxFormType' => $this->url()->fromRoute(
                        'hi-training/exercise-type/ajax-form-type/wildcard',
                        array('type_id' => '')
                    ),
                    'ajaxLastOfType' => $this->url()->fromRoute(
                        'hi-training/workout-exercise/ajax-last-of-type/wildcard',
                        array('type_id' => '')
                    ),
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
                        && $formData['header']['formId'] == 'WorkoutExerciseGridForm') {

                    if (isset($formData['WorkoutExerciseRow']['actions']['save'])) {

                        if (is_array($formData['WorkoutExerciseRow']['row'])){
                            $newRow = $this->_exercise->createRow()->populate($formData['WorkoutExerciseRow']['row']);
                            $newRow->save();

                            return $this->redirect()->toRoute('hi-training/workout-exercise/list/wildcard', array('workout_id' => $id));
                        }

                    }

                    if (isset($formData['WorkoutExerciseRow']['actions']['saveAdd'])) {

                        if (is_array($formData['WorkoutExerciseRow']['row'])){
                            $newRow = $this->_exercise->createRow()->populate($formData['WorkoutExerciseRow']['row']);
                            $newRow->save();

                            return $this->redirect()->toRoute('hi-training/workout-exercise/add/wildcard', array('workout_id' => $id));
                        }

                    }
                }
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

        $request = $this->getRequest();

        $routeMatch = $this->getEvent()->getRouteMatch();
        $id     = $routeMatch->getParam('exercise_id', 0);

        if ($id <= 0) {
            return $this->redirect()->toRoute('hi-training/workout/list');
        }

        $exercise = $this->_exercise->getRow(array('exercise_id' => $id));

        if (!$exercise) {
            return $this->redirect()->toRoute('hi-training/workout/list');
        }

        $workoutId = $exercise->workout_id;

        $workout = $this->_workout->getRow(array('workout_id' => $workoutId));

        if (!$workout) {
            return $this->redirect()->toRoute('hi-training/workout/list');
        }

        $typeId = $exercise->type_id;

        $type = $this->_exerciseType->getRow(array('type_id' => $typeId));

//        if (!$type) {
//            return $this->redirect()->toRoute('hi-training/workout/list');
//        }

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
        $row->setRowId($id);



        $row->setFieldOptions('type_id', array(
            'values' => $this->_exerciseType->getBehaviour('nestedSet')->getResultSetForSelect(),
            'onchange' => 'exerciseType(this);',
        ));
        $row->setFieldOptions('workout_id', array(
            'value' => $workoutId,
        ));

        $row->addAction(
            'saveEdit',
            'submit',
            array(
                'label'     => 'save and continue editing',
                'class'     => 'actionImage',
//                'image'     => $this->_skinUrl . '/img/icons/record/save.png',
            )
        );

        //
        $row->build();

        //
        $form->addSubForm($row, $row->getName());

        //
        $this->_view->headScript()->appendScript(
            $this->_view->render(
                'workout-exercise/edit.js',
                array(
                    'currentFormType'     => $type['form_type'],
                    'back' => $this->url()->fromRoute('hi-training/workout-exercise/list/wildcard', array('workout_id' => $workoutId)),
                    'ajaxFormType' => $this->url()->fromRoute(
                        'hi-training/exercise-type/ajax-form-type/wildcard',
                        array('type_id' => '')
                    ),
                    'ajaxLastOfType' => $this->url()->fromRoute(
                        'hi-training/workout-exercise/ajax-last-of-type/wildcard',
                        array('type_id' => '')
                    ),
                )
            )
        );


        /**
         * POST
         */
        if ($this->getRequest()->isPost()) {

            $formData = $this->getRequest()->post()->toArray();

            if ($form->isValid($formData)) {

                if (    isset($formData['header']['formId'])
                        && $formData['header']['formId'] == 'WorkoutExerciseGridForm') {

                    if (isset($formData['WorkoutExerciseRow']['actions']['save'])) {

                        if (is_array($formData['WorkoutExerciseRow']['row'])){
                            $row = $this->_exercise->getRow(array('exercise_id' => $id))
                                ->populate($formData['WorkoutExerciseRow']['row']);
                            $row->save();

                            return $this->redirect()->toRoute(
                                'hi-training/workout-exercise/list/wildcard',
                                array('workout_id' => $workoutId)
                            );
                        }

                    }

                    if (isset($formData['WorkoutExerciseRow']['actions']['saveAdd'])) {

                        if (is_array($formData['WorkoutExerciseRow']['row'])){
                            $row = $this->_exercise->getRow(array('exercise_id' => $id))
                                ->populate($formData['WorkoutExerciseRow']['row']);
                            $row->save();

                            return $this->redirect()->toRoute(
                                'hi-training/workout-exercise/add/wildcard',
                                array('workout_id' => $workoutId)
                            );
                        }

                    }

                    if (isset($formData['WorkoutExerciseRow']['actions']['saveEdit'])) {

                        if (is_array($formData['WorkoutExerciseRow']['row'])){
                            $row = $this->_exercise->getRow(array('exercise_id' => $id))
                                ->populate($formData['WorkoutExerciseRow']['row']);
                            $row->save();

                            return $this->redirect()->toRoute(
                                'hi-training/workout-exercise/edit/wildcard',
                                array('exercise_id' => $id)
                            );
                        }

                    }
                }
            }
        }

        return array(
            'form'        => $form,
            'workout'     => $workout,
            'exercise'    => $exercise,
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
        $id     = $routeMatch->getParam('exercise_id', 0);

        if ($id <= 0) {
            return $this->redirect()->toRoute('hi-training/workout/list');
        }

        $exercise = $this->_exercise->getRow(array('exercise_id' => $id));

        if (!$exercise) {
            return $this->redirect()->toRoute('hi-training/workout/list');
        }

        $workoutId = $exercise->workout_id;

        $exercise->delete();

        return $this->redirect()->toRoute('hi-training/workout-exercise/list/wildcard', array('workout_id' => $workoutId));

    }
}