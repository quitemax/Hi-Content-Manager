<?php

namespace HiCheckup\Controller;

use Zend\Mvc\Controller\ActionController,
    Zend\View\Model\ViewModel,
    HiCheckup\Model\Checkup,
    HiCheckup\Form\CheckupProfile\Grid as ProfileGrid,
    HiCheckup\Form\CheckupProfile\ResultSet as ProfileResultSet,
    HiCheckup\Form\CheckupProfile\Row as ProfileRow,
    HiCheckup\Form\CheckupToProfile\Grid as CheckupToProfileGrid,
    HiCheckup\Form\CheckupToProfile\ResultSet as CheckupToProfileResultSet,
    HiCheckup\Form\CheckupToProfile\Row as CheckupToProfileRow;

class CheckupProfileController extends ActionController
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
     *  LIST
     *
     * Enter description here ...
     */
    public function listAction()
    {
        /**
         * Grid FORM
         */
        $form = new ProfileGrid(
            array(
                'view' => $this->_view,
            )
        );

        /**
         * BUILDING LIST
         */
        $list = new ProfileResultSet(
            array(
                'model' => $this->_profile,
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
                'checkup/list.js',
                array(
                    'delete' => $this->url()->fromRoute('hi-checkup/checkup-profile/delete/wildcard', array('profile_id' => '')),
                    'edit' => $this->url()->fromRoute('hi-checkup/checkup-profile/edit/wildcard', array('profile_id' => '')),
                    'add' => $this->url()->fromRoute('hi-checkup/checkup-profile/add'),
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
                        && $formData['header']['formId'] == 'CheckupProfileGridForm') {

                    if (isset($formData['CheckupProfileResultSetSubForm']['actions']['massDelete'])) {

                        $allBox = $formData['CheckupProfileResultSetSubForm']['header']['all'];
                        $rows = $formData['CheckupProfileResultSetSubForm']['rows'];

                        foreach ($rows as $key => $row) {
                            if ($row['id'] || $allBox) {

                                $checkup = $this->_profile->getRow(array('profile_id' => $key));
                                $checkup->delete();

                            }
                        }

                        return $this->redirect()->toRoute('hi-checkup/checkup-profile/list');

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
        $form = new ProfileGrid(
            array(
                'view' => $this->_view,
            )
        );

        /**
         * BUILDING Row
         */
        $row = new ProfileRow(
            array(
                'model' => $this->_profile,
                'view' => $this->_view,
            )
        );

        //
        $row->addAction(
            'saveAndContinue',
            'submit',
            array(
                'label'     => 'save and continue editing',
                'class'     => 'actionImage',
//                'image'     => $this->_skinUrl . '/img/icons/record/back.png',
//                'onclick'   => 'goBack(); return false;',
            )
        );


        //
        $row->build();

        //
        $form->addSubForm($row, $row->getName());

        //
        $this->_view->headScript()->appendScript(
            $this->_view->render(
                'checkup-profile/add.js',
                array(
                    'back' => $this->url()->fromRoute('hi-checkup/checkup-profile/list'),
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
                        && $formData['header']['formId'] == 'CheckupProfileGridForm') {

                    if (isset($formData['CheckupProfileRowSubForm']['actions']['save']) || isset($formData['CheckupProfileRowSubForm']['actions']['saveAndContinue'])) {

                        if (is_array($formData['CheckupProfileRowSubForm']['row'])){

                            $newRow = $this->_profile->createRow()->populateOriginalData($formData['CheckupProfileRowSubForm']['row']);
                            $newRow->save();

                            if (isset($formData['CheckupProfileRowSubForm']['actions']['save'])) {

                                return $this->redirect()->toRoute('hi-checkup/checkup-profile/list');

                            } else if (isset($formData['CheckupProfileRowSubForm']['actions']['saveAndContinue'])) {

                                return $this->redirect()->toRoute('hi-checkup/checkup-profile/edit/wildcard', array('profile_id' => $newRow->getId()));


                            }


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
        $id     = $routeMatch->getParam('profile_id', 0);

        if ($id <= 0) {
            return $this->redirect()->toRoute('hi-checkup/checkup-profile/list');
        }

        /**
         * Grid FORM
         */
        $form = new ProfileGrid(
            array(
                'view' => $this->_view,
            )
        );

        /**
         * BUILDING Row
         */
        $row = new ProfileRow(
            array(
                'model' => $this->_profile,
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
                    'delete' => $this->url()->fromRoute('hi-checkup/checkup-profile/delete/wildcard', array('profile_id' => '')),
                    'back' => $this->url()->fromRoute('hi-checkup/checkup-profile/list'),
                )
            )
        );

        //
        $checkups = $this->_checkup->getResultSet(null, null, null, null, array('checkup_id', 'date'))->toArray();
        $checkupsValues = array();
        foreach ($checkups as $checkup) {
            $checkupsValues[$checkup['checkup_id']] = $checkup['date'] . ' ' . date('l', strtotime($checkup['date']) );
        }

        /**
         * BUILDING LIST
         */
        $list = new CheckupToProfileResultSet(
            array(
                'model' => $this->_checkupToProfile,
                'view' => $this->_view,
            )
        );

        $list->setFieldOptions(
            'checkup_id',
            array(
                'values' => $checkupsValues,
            )
        );

        $list->setDbWhere(array('profile_id' => $id));

        //
        $list->processRequest($this->getRequest());

        //
        $list->build();

        //
        $form->addSubForm($list, $list->getName());

        /**
         * BUILDING Row
         */
        $row = new CheckupToProfileRow(
            array(
                'model' => $this->_checkupToProfile,
                'view' => $this->_view,
            )
        );



        //
        $row->addFieldOptions(
            'checkup_id',
            array(
                'values' => $checkupsValues,
            )
        );

        //
        $row->addFieldOptions(
            'profile_id',
            array(
                'value' => $id,
            )
        );


        //
        $row->build();

        //
        $form->addSubForm($row, $row->getName());


        /**
         * POST
         */
        if ($this->getRequest()->isPost()) {

            $formData = $this->getRequest()->post()->toArray();
//\Zend\Debug::dump($formData);
            if ($form->isValid($formData)) {
                if (    isset($formData['header']['formId'])
                        && $formData['header']['formId'] == 'CheckupProfileGridForm') {


                    /*
                     *
                     */
                    if (isset($formData['CheckupProfileRowSubForm']['actions']['save'])) {

                        if (is_array($formData['CheckupProfileRowSubForm']['row'])){

                            if ($updateRow = $this->_profile->getRow(array('profile_id' => $id))) {
                                $updateRow->populateCurrentData($formData['CheckupProfileRowSubForm']['row']);
                                $updateRow->save();
                            }

                            return $this->redirect()->toRoute('hi-checkup/checkup-profile/list');
                        }
                    }

                    /*
                     *
                     */
                    if (isset($formData['CheckupToProfileRowSubForm']['actions']['save'])) {


                        if (is_array($formData['CheckupToProfileRowSubForm']['row'])){

                            $newRow = $this->_checkupToProfile->createRow()->populateOriginalData($formData['CheckupToProfileRowSubForm']['row']);
                            $newRow->save();

                            return $this->redirect()->toRoute('hi-checkup/checkup-profile/edit/wildcard', array('profile_id' => $id));
                        }
                    }


                    /*
                     *
                     */
                    if (isset($formData['CheckupToProfileResultSetSubForm']['actions']['massDelete'])) {

                        $allBox = $formData['CheckupToProfileResultSetSubForm']['header']['all'];
                        $rows = $formData['CheckupToProfileResultSetSubForm']['rows'];

                        foreach ($rows as $key => $row) {
                            if ($row['id'] || $allBox) {

                                $checkup = $this->_checkupToProfile->getRow(array('ctp_id' => $key));
                                $checkup->delete();

                            }
                        }

                        return $this->redirect()->toRoute('hi-checkup/checkup-profile/edit/wildcard', array('profile_id' => $id));

                    }

                    /*
                     *
                     */
                    if (!isset($formData['CheckupToProfileResultSetSubForm']['actions'])) {

//                        $allBox = $formData['CheckupToProfileResultSetSubForm']['header']['all'];
                        $rows = $formData['CheckupToProfileResultSetSubForm']['rows'];

                        foreach ($rows as $key => $row) {
                            if (isset($row['actions']['delete'])) {

                                $checkup = $this->_checkupToProfile->getRow(array('ctp_id' => $key));
                                $checkup->delete();

                            }
                        }

                        return $this->redirect()->toRoute('hi-checkup/checkup-profile/edit/wildcard', array('profile_id' => $id));

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
        $id     = $routeMatch->getParam('profile_id', 0);

        $deleteRow = $this->_profile->getRow(array('profile_id' => $id));
        if ($deleteRow) {
            $deleteRow->delete();
        }


        $checkupToProfiles = $this->_checkupToProfile->getResultSet(
            array('profile_id' => $id),
            null,
            null,
            null,
            array('ctp_id')
        );

        foreach($checkupToProfiles as $checkupToProfile) {
            $checkupToProfile->delete();
        }

        // Redirect to list of albums
        return $this->redirect()->toRoute('hi-checkup/checkup-profile/list');

    }
}
