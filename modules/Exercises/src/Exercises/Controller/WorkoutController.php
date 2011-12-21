<?php

namespace Exercises\Controller;

use Hi\Grid\SubForm\Rowset\Db;

use Zend\Mvc\Controller\ActionController,
    Exercises\Model\Workout,
    Exercises\Form\WorkoutForm,
    Exercises\Form\WorkoutGridForm,
    Exercises\Form\WorkoutGridForm\WorkoutRowsetSubForm;

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

    public function indexAction()
    {
        /**
         * Grid FORM
         */
        $form = new WorkoutGridForm(
            array(
                'view' => $this->_view,
            )
        );

        /**
         * BUILDING LIST
         */
        $list = new WorkoutRowsetSubForm(
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

        //
        $this->_view->headScript()->appendScript(
            $this->_view->render(
                'exercises-workout/index.js',
                array(
                    'delete' => $this->url()->fromRoute('exercises-workout-delete/wildcard', array('workout_id' => '')),
                    'edit' => $this->url()->fromRoute('exercises-workout-edit/wildcard', array('workout_id' => '')),
                    'add' => $this->url()->fromRoute('exercises-workout-add'),
                    'exercises' => $this->url()->fromRoute('exercises-workout-exercise-home/wildcard', array('workout_id' => '')),
                    'addExercise' => $this->url()->fromRoute('exercises-workout-exercise-add/wildcard', array('workout_id' => '')),
                )
            )
        );

        /**
         * POST
         */
//        if ($this->_request->isPost()) {
//
//            if ($form->isValid($this->_request->getPost())) {
//                $filteredPost = $this->_request->getPost();
//                Zend_Debug::dump($filteredPost);
//
//                if (    isset($filteredPost['header']['formId'])
//                        && $filteredPost['header']['formId'] == 'navigationListForm') {
//                    //
//                    if (isset($filteredPost['navigationList']['actions'])) {
//                        //
//                        $action = $filteredPost['navigationList']['actions'];
//                        //
//                        if (isset($action['save'])) {
//                            $allBox = $filteredPost['navigationList']['header']['all'];
//                            $rows = $filteredPost['navigationList']['rows'];
//
////                            Zend_Debug::dump($rows);
//
//                            $ids = array();
//                            if ($allBox){
//                                $ids = array_keys($rows);
//                            } else {
//                                foreach ($rows as $key => $row) {
//                                    if ($row['id']) {
//                                      $ids[] = $key;
//                                    }
//                                }
//                            }
//
//                            if ($hicmsNavigationItemsDbTable->hasBehaviour('i18n')) {
//                                $i18nBehaviour = $hicmsNavigationItemsDbTable->getBehaviour('i18n');
//                                $i18nBehaviour->setLang($list->getLang());
//                            }
//
//                            foreach ($ids as $id) {
//                                $hicmsNavigationItemsDbTable->update(
//                                    $rows[$id]['row'],
//                                    'hni_id = ' . $id
//                                );
//                            }
//                            $this->_redirect('/hicms/navigation/list/');
//                        }
//
//                        //
//                        if (isset($action['cache'])) {
//                            $this->_redirect('/hicms/navigation/list/');
//
//                        }
//                    }
//                }
//            }
//        }


//        \HiZend\Debug\Debug::precho($this->_view);

        return array(
            'form' => $form,
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
                //
                $values = $form->getValues();
                $this->_workout->addWorkout($values);

//              // Redirect to list
                return $this->redirect()->toRoute('exercises-workout-home');
            }
        }
        return array('form' => $form);

    }

    public function editAction()
    {
        $request = $this->getRequest();

        $routeMatch = $this->getEvent()->getRouteMatch();
        $id     = $routeMatch->getParam('workout_id', 0);

        $form = new WorkoutForm();
        $form->submit->setLabel('Edit');


        if ($id > 0) {
            if ($workoutRow = $this->_workout->getWorkout($id)) {
                $form->populate($workoutRow->toArray());
            } else {
                return $this->redirect()->toRoute('exercises-workout-home');
            }

            if ($request->isPost()) {
                $formData = $request->post()->toArray();

                if ($form->isValid($formData)) {

                    $id = $form->getValue('workout_id');
                    $values = $form->getValues();

                    $workoutRow->setFromArray($values);
                    $workoutRow->save();

                    return $this->redirect()->toRoute('exercises-workout-home');
    //              // Redirect to list

                }
            }

            return array(
                'form' => $form,
                'workout' => $workoutRow,
            );
        } else {
            return $this->redirect()->toRoute('exercises-workout-home');
        }




    }

    public function deleteAction()
    {
        $request = $this->getRequest();



        if ($request->isPost()) {
            $del = $request->post()->get('del', 'No');
            if ($del == 'Yes') {
                $id = (int) $request->post()->get('workout_id');
                $workoutRow = $this->_workout->getWorkout($id);
                $workoutRow->delete();
            }
            // Redirect to list of albums
            return $this->redirect()->toRoute('exercises-workout-home');
        }

        $routeMatch = $this->getEvent()->getRouteMatch();
        $id     = $routeMatch->getParam('workout_id', 0);

        return array('workout' => $this->_workout->getWorkout($id));

    }



}