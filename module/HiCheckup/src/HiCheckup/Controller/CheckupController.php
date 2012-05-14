<?php

namespace HiCheckup\Controller;

use Zend\Mvc\Controller\ActionController,
    Zend\View\Model\ViewModel,
    HiCheckup\Model\Checkup,
    HiCheckup\Form\Checkup\Grid as CheckupGrid,
    HiCheckup\Form\Checkup\ResultSet as CheckupResultSet,
    HiCheckup\Form\Checkup\Row as CheckupRow;

class CheckupController extends ActionController
{
	/**
     *  checkup model
     *
     * Enter description here ...
     */
    protected $_profile;

    public function setProfile($profile)
    {
        $this->_profile = $profile;
        return $this;
    }

	/**
     *  checkup model
     *
     * Enter description here ...
     */
    protected $_checkup;

    public function setCheckup($checkup)
    {
        $this->_checkup = $checkup;
        return $this;
    }

  /**
     *  checkup model
     *
     * Enter description here ...
     */
    protected $_checkupToProfile;

    public function setCheckupToProfile($checkupToProfile)
    {
        $this->_checkupToProfile = $checkupToProfile;
        return $this;
    }

    /**
     *  view renderer
     *
     * Enter description here ...
     */
    protected $_view;

    public function setView($view)
    {
        $this->_view = $view;
        return $this;
    }

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
        /**
         * Grid FORM
         */
        $form = new CheckupGrid(
            array(
                'view' => $this->_view,
            )
        );

        /**
         * BUILDING LIST
         */
        $list = new CheckupResultSet(
            array(
                'model' => $this->_checkup,
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
                'checkup/list.js',
                array(
                    'delete' => $this->url()->fromRoute('hi-checkup/checkup/delete/wildcard', array('checkup_id' => '')),
                    'edit' => $this->url()->fromRoute('hi-checkup/checkup/edit/wildcard', array('checkup_id' => '')),
                    'add' => $this->url()->fromRoute('hi-checkup/checkup/add'),
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
                        && $formData['header']['formId'] == 'CheckupGridForm') {

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

                    if (isset($formData['CheckupResultSetSubForm']['actions']['massDelete'])) {

                        $allBox = $formData['CheckupResultSetSubForm']['header']['all'];
                        $rows = $formData['CheckupResultSetSubForm']['rows'];

                        foreach ($rows as $key => $row) {
                            if ($row['id'] || $allBox) {


                                $checkup = $this->_checkup->getRow(array('checkup_id' => $key));
                                if ($checkup) {
                                    $checkup->delete();
                                }

                                $checkupToProfiles = $this->_checkupToProfile->getResultSet(
                                    array('checkup_id' => $key),
                                    null,
                                    null,
                                    null,
                                    array('ctp_id')
                                );

                                foreach($checkupToProfiles as $checkupToProfile) {
                                    $checkupToProfile->delete();
                                }

                            }
                        }

                        return $this->redirect()->toRoute('hi-checkup/checkup/list');

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
        $form = new CheckupGrid(
            array(
                'view' => $this->_view,
            )
        );

        /**
         * BUILDING Row
         */
        $row = new CheckupRow(
            array(
                'model' => $this->_checkup,
                'view' => $this->_view,
            )
        );

        $profiles = $this->_profile->getResultSet();
        $values = array();

        foreach ($profiles as $profile) {
            $values[$profile['profile_id']] = $profile['name'];
        }

        $row->addField(
            'profile_id',
            'custom',
            array(
                'label' => 'profile_id',
                'values' => $values,
                'viewScript' => 'checkup/_field_profile.phtml',
            ),
            '25'
        );

        //
        $row->build();

        //
        $form->addSubForm($row, $row->getName());

//        //
        $this->_view->headScript()->appendScript(
            $this->_view->render(
                'checkup/add.js',
                array(
                    'back' => $this->url()->fromRoute('hi-checkup/checkup/list'),
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
                        && $formData['header']['formId'] == 'CheckupGridForm') {

                    if (isset($formData['CheckupRowSubForm']['actions']['save'])) {

                        if (is_array($formData['CheckupRowSubForm']['row'])){
//                            \Zend\Debug::dump($formData);

                            $newRow = $this->_checkup->createRow()->populate($formData['CheckupRowSubForm']['row']);
                            $newRow->save();
//                            \Zend\Debug::dump($newRow);

                            if ($newRow->getId()) {
                                if (is_array($formData['CheckupRowSubForm']['profile_ids'])) {
                                    foreach ($formData['CheckupRowSubForm']['profile_ids'] as $profileId) {
                                        $newProfileRow = $this->_checkupToProfile->createRow()->populate(
                                            array(
                                                'checkup_id' => $newRow->getId(),
                                                'profile_id' => $profileId,
                                            )
                                        );
                                        $newProfileRow->save();
                                    }
                                }
                            }

                            return $this->redirect()->toRoute('hi-checkup/checkup/list');
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
        $id     = $routeMatch->getParam('checkup_id', 0);

        if ($id <= 0) {
            return $this->redirect()->toRoute('hi-checkup/checkup/list');
        }

        /**
         * Grid FORM
         */
        $form = new CheckupGrid(
            array(
                'view' => $this->_view,
            )
        );

        /**
         * BUILDING Row
         */
        $row = new CheckupRow(
            array(
                'model' => $this->_checkup,
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
                'checkup/edit.js',
                array(
                    'delete' => $this->url()->fromRoute('hi-checkup/checkup/delete/wildcard', array('checkup_id' => '')),
                    'back' => $this->url()->fromRoute('hi-checkup/checkup/list'),
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
                        && $formData['header']['formId'] == 'CheckupGridForm') {


                    if (isset($formData['CheckupRowSubForm']['actions']['save'])) {

                        if (is_array($formData['CheckupRowSubForm']['row'])){

                            if ($updateRow = $this->_checkup->getRow(array('checkup_id' => $id))) {
                                $updateRow->populate($formData['CheckupRowSubForm']['row']);
                                $updateRow->save();
                            }

                            return $this->redirect()->toRoute('hi-checkup/checkup/list');
                        }
                    }

                    if (isset($formData['CheckupRowSubForm']['actions']['saveEdit'])) {

                        if (is_array($formData['CheckupRowSubForm']['row'])){

                            if ($updateRow = $this->_checkup->getRow(array('checkup_id' => $id))) {
                                $updateRow->populate($formData['CheckupRowSubForm']['row']);
                                $updateRow->save();
                            }


                            return $this->redirect()->toRoute('hi-checkup/checkup/edit/wildcard', array('checkup_id' => $updateRow->getId()));
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
