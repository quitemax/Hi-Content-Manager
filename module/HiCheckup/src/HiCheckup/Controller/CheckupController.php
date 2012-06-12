<?php

namespace HiCheckup\Controller;

use Zend\Mvc\Controller\ActionController;
use Zend\View\Model\ViewModel;
use HiCheckup\Model\Checkup;
use HiCheckup\Block\Checkup\Grid\Container as GridContainer;
use HiCheckup\Block\Checkup\Grid as CheckupGrid;
use HiCheckup\Block\Checkup\Edit\Container as EditContainer;
use HiCheckup\Block\Checkup\Edit as CheckupEdit;

class CheckupController extends ActionController
{
    /**
     *  INDEX
     *
     * Enter description here ...
     */
    public function indexAction()
    {
        return array(
        );
    }

    /**
     *  STATS
     *
     * Enter description here ...
     */
    public function statsAction()
    {
        //
        $request = $this->getRequest();

        $routeMatch = $this->getEvent()->getRouteMatch();
        $id     = $routeMatch->getParam('profile_id', 0);

        $currentProfile = $this->_profile->getRow(array('profile_id' => $id));
//        \Zend\Debug::dump($currentProfile->getId(), '$currentProfile->getId()');
//        \Zend\Debug::dump($currentProfile, '$currentProfile');
//        \Zend\Debug::dump($id);

        if (!$currentProfile->getId()) {
            $currentProfile = $this->_profile->getRow(array('default' => 1));
        }


//        \Zend\Debug::dump($currentProfile->getId());
//        \Zend\Debug::dump($currentProfile);
        $profileRows = $this->_checkupToProfile->getResultSet(
            array('profile_id' => $currentProfile->getId()),
            null,
            null,
            null,
            array('checkup_id')
        );

        $where = array();

        foreach ($profileRows as $row) {
            $where[] = $row['checkup_id'];
        }

        $checkups = array();
        if (count($where)) {
            $checkups = $this->_checkup->getResultSet('checkup_id in (' . implode(',', $where) . ')', array('date asc'));
        }

//        \Zend\Debug::dump($where);

        return array(
            'checkups' => $checkups,
            'profiles' => $this->_profile->getResultSet(),
            'currentProfile' => $currentProfile,
        );
    }


	/**
     *  LIST
     *
     * Enter description here ...
     */
    public function listAction()
    {
//        $locator = $this->getServiceLocator();

        /**
         * Grid FORM Container
         */
        $gridContainer = new GridContainer();

        /**
         * BUILDING Grid
         */
        $grid = new CheckupGrid();

        //
        $gridContainer->addChild($grid, 'grid');

        /**
         * POST
         */
        if ($this->getRequest()->isPost()) {

            $formData = $this->getRequest()->post()->toArray();
            \Zend\Debug::dump($formData);
//
//            if ($form->isValid($formData)) {

//                if (    isset($formData['header']['formId'])
//                        && $formData['header']['formId'] == 'CheckupGridForm') {
//
////                    if (isset($formData['WorkoutExerciseRowset']['actions']['saveSelected'])) {
////                        $allBox = $formData['WorkoutExerciseRowset']['header']['all'];
////                        $rows = $formData['WorkoutExerciseRowset']['rows'];
////
////                        foreach ($rows as $key => $row) {
////                            if ($row['id'] || $allBox) {
//////                                \HiZend\Debug\Debug::dump($row['row']);
//////                                \HiZend\Debug\Debug::dump($key);
////
////                                $exercise = $this->_exercise->getWorkoutExercise($key);
////                                $exercise->setFromArray($row['row']);
////                                $exercise->save();
////
////                            }
////                        }
////
////                        return $this->redirect()->toRoute('exercises-workout-exercise-home/wildcard', array('workout_id' => $id));
////                    }
//
//                    if (isset($formData['CheckupResultSetSubForm']['actions']['massDelete'])) {
//
//                        $allBox = $formData['CheckupResultSetSubForm']['header']['all'];
//                        $rows = $formData['CheckupResultSetSubForm']['rows'];
//
//                        foreach ($rows as $key => $row) {
//                            if ($row['id'] || $allBox) {
//
//
//                                $checkup = $this->_checkup->getRow(array('checkup_id' => $key));
//                                if ($checkup) {
//                                    $checkup->delete();
//                                }
//
//                                $checkupToProfiles = $this->_checkupToProfile->getResultSet(
//                                    array('checkup_id' => $key),
//                                    null,
//                                    null,
//                                    null,
//                                    array('ctp_id')
//                                );
//
//                                foreach($checkupToProfiles as $checkupToProfile) {
//                                    $checkupToProfile->delete();
//                                }
//
//                            }
//                        }
//
//                        return $this->redirect()->toRoute('hi-checkup/checkup/list');
//
//                    }
//                }
//            }
        }

        $view = new ViewModel();

        $view->addChild($gridContainer, 'gridContainer');

        return $view;
    }

/**
     *  ADD
     *
     * Enter description here ...
     */
    public function addAction()
    {

//        /**
//         * Grid FORM
//         */
//        $form = new CheckupGrid(
//            array(
//                'view' => $this->_view,
//            )
//        );
//
//        /**
//         * BUILDING Row
//         */
//        $row = new CheckupRow(
//            array(
//                'model' => $this->_checkup,
//                'view' => $this->_view,
//            )
//        );
//
//        $profiles = $this->_profile->getResultSet();
//        $values = array();
//
//        foreach ($profiles as $profile) {
//            $values[(int)$profile['profile_id']] = $profile['name'];
//        }
//
//        $row->addField(
//            'profile_id',
//            'custom',
//            array(
//                'label' => 'profile_id',
//                'values' => $values,
//                'viewScript' => 'checkup/_field_profile.phtml',
//            ),
//            '25'
//        );
//
//        //
//        $row->build();
//
//        //
//        $form->addSubForm($row, $row->getName());
//
////        //
//        $this->_view->headScript()->appendScript(
//            $this->_view->render(
//                'checkup/add.js',
//                array(
//                    'back' => $this->url()->fromRoute('hi-checkup/checkup/list'),
//                )
//            )
//        );
//
//        /**
//         * POST
//         */
//        if ($this->getRequest()->isPost()) {
//
//            $formData = $this->getRequest()->post()->toArray();
//
////            \Zend\Debug::dump($formData);
//
//
//
//
//            if ($form->isValid($formData)) {
//                if (    isset($formData['header']['formId'])
//                        && $formData['header']['formId'] == 'CheckupGridForm') {
//
//                    if (isset($formData['CheckupRowSubForm']['actions']['save'])) {
//
//                        if (is_array($formData['CheckupRowSubForm']['row'])){
////                            \Zend\Debug::dump($formData);
//
//                            $newRow = $this->_checkup->createRow()->populate($formData['CheckupRowSubForm']['row']);
//                            $newRow->save();
////                            \Zend\Debug::dump($newRow);
//
//                            if ($newRow->getId()) {
//                                if (is_array($formData['CheckupRowSubForm']['profile_ids'])) {
//                                    foreach ($formData['CheckupRowSubForm']['profile_ids'] as $profileId) {
//                                        $newProfileRow = $this->_checkupToProfile->createRow()->populate(
//                                            array(
//                                                'checkup_id' => $newRow->getId(),
//                                                'profile_id' => $profileId,
//                                            )
//                                        );
//                                        $newProfileRow->save();
//                                    }
//                                }
//                            }
//
//                            return $this->redirect()->toRoute('hi-checkup/checkup/list');
//                        }
//                    }
//                }
//            }
//        }
//
//        return array('form' => $form);

        $view = new ViewModel();

        $view->addChild($editContainer, 'editContainer');

        return $view;
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
        $id     = $routeMatch->getParam('checkup_id', 0);

        if ($id <= 0) {
            return $this->redirect()->toRoute('hi-checkup/checkup/list');
        }


//        $locator = $this->getServiceLocator();

        /**
         * Edit FORM Container
         */
        $editContainer = new EditContainer();

        /**
         * BUILDING Edit
         */
        $edit = new CheckupEdit();

        //
        $editContainer->addChild($edit, 'edit');
//
//        /**
//         * Grid FORM
//         */
//        $form = new CheckupGrid(
//            array(
//                'view' => $this->_view,
//            )
//        );
//
//        /**
//         * BUILDING Row
//         */
//        $row = new CheckupRow(
//            array(
//                'model' => $this->_checkup,
//                'view' => $this->_view,
//            )
//        );
//
//        //
//        $profiles = $this->_profile->getResultSet();
//        $values = array();
//
//        foreach ($profiles as $profile) {
//            $values[(int)$profile['profile_id']] = $profile['name'];
//        }
//
//        //
//        $checkupProfiles = $this->_checkupToProfile->getResultSet(
//            array(
//                'checkup_id' => $id,
//            )
//        )->toArray();
//
//
//        $row->addField(
//            'profile_id',
//            'custom',
//            array(
//                'label' => 'profile_id',
//                'values' => $values,
//                'profiles' => $checkupProfiles,
//                'viewScript' => 'checkup/_field_profile.phtml',
//            ),
//            '25'
//        );
//
//        $row->setRowId($id);
////
//        //
//        $row->build();
//
//        //
//        $form->addSubForm($row, $row->getName());
//
//        //
//        $this->_view->headScript()->appendScript(
//            $this->_view->render(
//                'checkup/edit.js',
//                array(
//                    'delete' => $this->url()->fromRoute('hi-checkup/checkup/delete/wildcard', array('checkup_id' => '')),
//                    'back' => $this->url()->fromRoute('hi-checkup/checkup/list'),
//                )
//            )
//        );
//
//        /**
//         * POST
//         */
//        if ($this->getRequest()->isPost()) {
//
//            $formData = $this->getRequest()->post()->toArray();
//            \Zend\Debug::dump($formData);
//
//            if ($form->isValid($formData)) {
//                if (    isset($formData['header']['formId'])
//                        && $formData['header']['formId'] == 'CheckupGridForm') {
//
//
//                    if (isset($formData['CheckupRowSubForm']['actions']['save'])) {
//
//                        if (is_array($formData['CheckupRowSubForm']['row'])){
//
//                            if ($updateRow = $this->_checkup->getRow(array('checkup_id' => $id))) {
//                                $updateRow->populate($formData['CheckupRowSubForm']['row']);
//                                $updateRow->save();
//
//
//                                $deleteProfiles = array();
//                                $newProfiles = array();
//                                if (is_array($formData['CheckupRowSubForm']['profile_ids'])) {
//
//                                    //
//                                    $deleteProfiles = $checkupProfiles;
//
//                                    //
//                                    foreach ($formData['CheckupRowSubForm']['profile_ids'] as $profileId) {
//
//                                        //
//                                        $newId = $profileId;
//
//                                        //
//                                        foreach($checkupProfiles as $key => $profile) {
//
//                                            //
//                                            if ($profile['profile_id'] == $profileId) {
////                                                \Zend\Debug::dump($deleteProfiles[$key], '$deleteProfiles[$key]');
//                                                unset($deleteProfiles[$key]);
//                                                $newId = null;
//                                            }
//
//                                        }
//
//                                        if ($newId === $profileId) {
//                                            $newProfiles[] = $newId;
//                                        }
////
//
//                                    }
//
//                                    foreach ($deleteProfiles as $deleteProfile) {
//                                        $deleteProfileRow = $this->_checkupToProfile->getRow(
//                                            array(
//                                                'ctp_id' => $deleteProfile['ctp_id'],
//                                            )
//                                        );
//                                        $deleteProfileRow->delete();
//                                    }
//
//                                    foreach ($newProfiles as $newProfile) {
//                                        $newProfileRow = $this->_checkupToProfile->createRow()->populate(
//                                            array(
//                                                'checkup_id' => $updateRow->getId(),
//                                                'profile_id' => $newProfile,
//                                            )
//                                        );
//                                        $newProfileRow->save();
//                                    }
//
////                                    \Zend\Debug::dump($deleteProfiles);
////                                    \Zend\Debug::dump($newProfiles);
//                                }
//                            }
//
//                            return $this->redirect()->toRoute('hi-checkup/checkup/list');
//                        }
//                    }
//
//                    if (isset($formData['CheckupRowSubForm']['actions']['saveEdit'])) {
//
//                        if (is_array($formData['CheckupRowSubForm']['row'])){
//
//                            if ($updateRow = $this->_checkup->getRow(array('checkup_id' => $id))) {
//                                $updateRow->populate($formData['CheckupRowSubForm']['row']);
//                                $updateRow->save();
//
//                                $deleteProfiles = array();
//                                $newProfiles = array();
//                                if (is_array($formData['CheckupRowSubForm']['profile_ids'])) {
//
//                                    //
//                                    $deleteProfiles = $checkupProfiles;
//
//                                    //
//                                    foreach ($formData['CheckupRowSubForm']['profile_ids'] as $profileId) {
//
//                                        //
//                                        $newId = $profileId;
//
//                                        //
//                                        foreach($checkupProfiles as $key => $profile) {
//
//                                            //
//                                            if ($profile['profile_id'] == $profileId) {
////                                                \Zend\Debug::dump($deleteProfiles[$key], '$deleteProfiles[$key]');
//                                                unset($deleteProfiles[$key]);
//                                                $newId = null;
//                                            }
//
//                                        }
//
//                                        if ($newId === $profileId) {
//                                            $newProfiles[] = $newId;
//                                        }
////
//
//                                    }
//
//                                    foreach ($deleteProfiles as $deleteProfile) {
//                                        $deleteProfileRow = $this->_checkupToProfile->getRow(
//                                            array(
//                                                'ctp_id' => $deleteProfile['ctp_id'],
//                                            )
//                                        );
//                                        $deleteProfileRow->delete();
//                                    }
//
//                                    foreach ($newProfiles as $newProfile) {
//                                        $newProfileRow = $this->_checkupToProfile->createRow()->populate(
//                                            array(
//                                                'checkup_id' => $updateRow->getId(),
//                                                'profile_id' => $newProfile,
//                                            )
//                                        );
//                                        $newProfileRow->save();
//                                    }
//
////                                    \Zend\Debug::dump($deleteProfiles);
////                                    \Zend\Debug::dump($newProfiles);
//                                }
//
//                            }
//
//
//                            return $this->redirect()->toRoute('hi-checkup/checkup/edit/wildcard', array('checkup_id' => $updateRow->getId()));
//                        }
//                    }
//                }
//            }
//        }
//
//
//
//
//        return array(
//            'form' => $form,
//            'id' => $id,
//        );

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
        $id     = $routeMatch->getParam('checkup_id', 0);

        $deleteRow = $this->_checkup->getRow(array('checkup_id' => $id));
        if ($deleteRow) {
            $deleteRow->delete();
        }

        $checkupToProfiles = $this->_checkupToProfile->getResultSet(
            array('checkup_id' => $id),
            null,
            null,
            null,
            array('ctp_id')
        );

        foreach($checkupToProfiles as $checkupToProfile) {
            $checkupToProfile->delete();
        }


        // Redirect to list of albums
        return $this->redirect()->toRoute('hi-checkup/checkup/list');

    }



}
