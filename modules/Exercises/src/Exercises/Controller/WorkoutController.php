<?php

namespace Exercises\Controller;

use Zend\Mvc\Controller\ActionController,
    Exercises\Model\Workout,
    Exercises\Form\WorkoutForm,
    Exercises\Form\WorkoutGridForm;

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
        $form = new WorkoutGridForm();
        $form->setView($this->_view);

        /**
         * BUILDING LIST
         */
//        $list = new Hi_Record_SubForm_List_Db(
//            array(
//                'title'     => $this->view->translate('navigationItemsList'),
//                'name'      => 'navigationList',
//                'langs'     => $hicmsLangsDbTable->getLangs(),
//                'model'     => $hicmsNavigationItemsDbTable,
//                'view'      => $this->view,
//            )
//        );


//    $list->processRequest($this->_request);
//
//        $this->view->headScript()->appendScript(
//            $this->view->render(
//                'navigation/list.js'
//            )
//        );
//
//        /**
//         * RECORD ACTIONS
//         */
//        $list->addRecordAction(
//            'edit',
//            'image',
//            array(
//                'label'     => $this->view->translate('edit'),
//                'image'     => $this->_publicUrl.'/img/admin/icons/record/edit.png',
//                'class'     => 'actionImage',
//                'onclick'   => 'editRow(__ID__);return false;',
//            )
//        );
//        $list->addRecordAction(
//            'delete',
//            'image',
//            array(
//                'label'     => $this->view->translate('delete'),
//                'image'     => $this->_publicUrl . '/img/admin/icons/record/delete.png',
//                'class'     => 'actionImage',
//                'onclick'   => 'deleteRow(__ID__);return false;',
//            )
//        );
//        $list->addRecordAction(
//            'cache',
//            'image',
//            array(
//                'label'     => $this->view->translate('cache'),
//                'image'     => $this->_publicUrl . '/img/admin/icons/record/cache.png',
//                'class'     => 'actionImage',
//                'onclick'   => '',
//            )
//        );
//
//        /**
//         * LIST ACTIONS
//         */
//        $list->addListAction(
//            'add',
//            'image',
//            array(
//                'label'     => $this->view->translate('add'),
//                'class'     => 'actionImage',
//                'image'     => $this->_publicUrl . '/img/admin/icons/record/new.png',
//                'onclick'   => 'addRow();return false;',
//            )
//        );
//
//        //
//        $list->addListAction(
//            'save',
//            'image',
//            array(
//                'label'     => $this->view->translate('save'),
//                'class'     => 'actionImage',
//                'image'     => $this->_publicUrl . '/img/admin/icons/record/save.png',
//            )
//        );
//
//
//        $list->build();
//        $form->addSubForm($list, $list->getName());
//
//        $this->view->list = $form;
//
//        /**
//         * POST
//         */
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

        $form = new WorkoutForm();
        $form->submit->setLabel('Edit');

        $id = $request->query()->get('workout_id', 0);
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

        $id = $request->query()->get('workout_id', 0);
        return array('workout' => $this->_workout->getWorkout($id));

    }



}