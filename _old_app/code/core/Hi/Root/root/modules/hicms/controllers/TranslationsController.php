<?php
/**
 * Hi CMS
 *
 * @category   HiZend
 * @package    HiZend_Controller
 * @copyright  Copyright (c) 2009 Piotr Maxymilian Socha
 * @license
 */

/** HiZend_Controller_Action */
//require_once 'HiZend/Controller/Action.php';

/**
 * Action controller.
 *
 * Simple table with langs: list action ,add action, delete action, edit action
 *
 * @category   HiZend
 * @package    HiZend_Controller
 * @subpackage Hicms
 * @copyright  Copyright (c) 2009 Piotr Maxymilian Socha
 * @license
 */
class Hicms_TranslationsController extends Hicms_Libs_Controller_Action
{
    /**#@+
     * Form default partial decorator directory
     */
    const URL_LIST = '/hicms/translations/list';
    /**#@-*/

    /**#@+
     * Form default partial decorator directory
     */
    const URL_EDIT = '/hicms/translations/edit';
    /**#@-*/

    /**#@+
     * Form default partial decorator directory
     */
    const URL_ADD = '/hicms/translations/add';
    /**#@-*/

    /**#@+
     * Form default partial decorator directory
     */
    const URL_DELETE = '/hicms/translations/delete';
    /**#@-*/

    /**#@+
     * Form default partial decorator directory
     */
    const PARAM_ID = 'id';
    /**#@-*/

    /**#@+
     *  Main model table name
     */
    const LANGS_TABLE_NAME = 'Hicms_Model_DbTable_Langs';
    /**#@-*/

    /**#@+
     *  Main model table name
     */
    const MODEL_TABLE_NAME = 'Hicms_Model_DbTable_TranslationsItems';
    /**#@-*/

    /**#@+
     * Model primary id
     */
    const MODEL_PRIMARY_ID = 'hti_id';
    /**#@-*/

    /**#@+
     *
     */
    const LIST_FORM_TITLE = 'hicmsTranslatePanel';
    /**#@-*/

    /**#@+
     *
     */
    const LIST_FORM_NAME = 'translationsListForm';
    /**#@-*/

    /**#@+
     *
     */
    const LIST_SUBFORM_TITLE = 'translationsItemsList';
    /**#@-*/

    /**#@+
     *
     */
    const LIST_SUBFORM_NAME = 'translationsList';
    /**#@-*/

    /**#@+
     *
     */
    const JS_LIST = 'hicms/translations/list.js';
    /**#@-*/



    /**#@+
     *
     */
    const EDIT_FORM_TITLE = 'hicmsTranslatePanel';
    /**#@-*/

    /**#@+
     *
     */
    const EDIT_FORM_NAME = 'editTranslationsItemForm';
    /**#@-*/

    /**#@+
     *
     */
    const EDIT_SUBFORM_TITLE = 'editTranslationsItem';
    /**#@-*/

    /**#@+
     *
     */
    const EDIT_SUBFORM_NAME = 'editTranslationsItemRow';
    /**#@-*/

    /**#@+
     *
     */
    const JS_EDIT = 'hicms/translations/edit.js';
    /**#@-*/


    /**#@+
     *
     */
    const ADD_FORM_TITLE = 'hicmsTranslatePanel';
    /**#@-*/

    /**#@+
     *
     */
    const ADD_FORM_NAME = 'addTranslationItemForm';
    /**#@-*/

    /**#@+
     *
     */
    const ADD_SUBFORM_TITLE = 'addTranslationItem';
    /**#@-*/

    /**#@+
     *
     */
    const ADD_SUBFORM_NAME = 'addTranslationItemRow';
    /**#@-*/

    /**#@+
     *
     */
    const JS_ADD = 'hicms/translations/add.js';
    /**#@-*/



    /**
     * Init
     *
     * Mainly init of parent class, etc...
     *
     */
    function init() {
        parent::init();
        $this->view->headTitle('Translations');
    }



    public function listAction()
    {
        /**
         *
         */
        $this->view->headTitle('List');

        /**
         *
         */
        /*@var $langsDbTable HiZend_Db_Table*/
        $langsClassString = self::LANGS_TABLE_NAME;
        $langsDbTable = new $langsClassString();

        /*@var $dbTable HiZend_Db_Table*/
        $classString = self::MODEL_TABLE_NAME;
        $dbTable = new $classString();

        /**
         *
         */
        $this->view->deleteLink     = $this->_baseUrl . self::URL_DELETE . '/' . self::PARAM_ID . '/';
        $this->view->editLink       = $this->_baseUrl . self::URL_EDIT . '/' . self::PARAM_ID . '/';
        $this->view->addLink        = $this->_baseUrl . self::URL_ADD;

        /**
         *
         */
        $this->view->headScript()->appendScript(
            $this->view->render(
                self::JS_LIST
            )
        );

        /**
         * Record Form
         */
        $form = new Hi_Record_Form(
            array(
                'title'     => $this->view->translate(self::LIST_FORM_TITLE),
                'name'      => self::LIST_FORM_NAME,
                'method'    => 'post',
            )
        );

        /**
         * Building list
         */
        /*@var $navigationList Hi_Record_List*/
        $list = new Hi_Record_SubForm_List_Db(
            array(
                'title'     => $this->view->translate(self::LIST_SUBFORM_TITLE),
                'name'      => self::LIST_SUBFORM_NAME,
                'langs'     => $langsDbTable->getLangs(),
                'model'     => $dbTable,
                'view'      => $this->view,
            )
        );

        /**
         *
         */
        $list->processRequest($this->_request);

        /**
         *
         */
        $list->addRecordAction(
            'save',
            'image',
            array(
                'label'     => $this->view->translate('save'),
                'image'     => $this->_skinUrl . '/img/icons/record/save.png',
                'class'     => 'actionImage',
            )
        );
        $list->addRecordAction(
            'edit',
            'image',
            array(
                'label'     => $this->view->translate('edit'),
                'image'     => $this->_skinUrl . '/img/icons/record/edit.png',
                'class'     => 'actionImage',
                'onclick'   => 'return editRow(__ID__);',
            )
        );
        $list->addRecordAction(
            'delete',
            'image',
            array(
                'label'     => $this->view->translate('delete'),
                'image'     => $this->_skinUrl . '/img/icons/record/delete.png',
                'class'     => 'actionImage',
                'onclick'   => 'return deleteRow(__ID__);',
            )
        );

        /**
         *
         */
        $list->addListAction(
            'add',
            'image',
            array(
                'label'     => $this->view->translate('add'),
                'class'     => 'actionImage',
                'image'     => $this->_skinUrl . '/img/icons/record/new.png',
                'onclick'   => 'return addRow();',
            )
        );
        $list->addListAction(
            'save',
            'image',
            array(
                'label'     => $this->view->translate('save'),
                'class'     => 'actionImage',
                'image'     => $this->_skinUrl . '/img/icons/record/save.png',
            )
        );
        $list->addListAction(
            'delete',
            'image',
            array(
                'label'     => $this->view->translate('delete'),
                'class'     => 'actionImage',
                'image'     => $this->_skinUrl . '/img/icons/record/delete.png',
            )
        );

        /**
         *
         */
        $list->build();
        $form->addSubForm($list, $list->getName());

        /**
         *
         */
        $this->view->list = $form;

        /**
         * POST
         */
        if ($this->_request->isPost()) {
//            Zend_Debug::dump($this->_request->getPost());

            if ($form->isValid($this->_request->getPost())) {
                $filteredPost = $this->_request->getPost();
//                Zend_Debug::dump($filteredPost);

                if (    isset($filteredPost['header']['formId'])
                        && $filteredPost['header']['formId'] == self::LIST_FORM_NAME) {

                    //
                    if (isset($filteredPost[self::LIST_SUBFORM_NAME]['actions'])) {

                        //
                        $action = $filteredPost[self::LIST_SUBFORM_NAME]['actions'];

                        //
                        if (isset($action['save'])) {

                            //
                            $allBox = $filteredPost[self::LIST_SUBFORM_NAME]['header']['all'];
                            $rows = $filteredPost[self::LIST_SUBFORM_NAME]['rows'];

                            //
                            foreach ($rows as $key => $row) {
                                if ($row['id'] || $allBox) {
                                    $dbTable->update(
                                        $rows[$key]['row'],
                                        self::MODEL_PRIMARY_ID . ' = ' . $key
                                    );
                                }
                            }

                            //
                            $this->_redirect(self::URL_LIST);
                        }

                        //
                        if (isset($action['delete'])) {

                            //
                            $allBox = $filteredPost[self::LIST_SUBFORM_NAME]['header']['all'];
                            $rows = $filteredPost[self::LIST_SUBFORM_NAME]['rows'];

                            //
                            foreach ($rows as $key => $row) {
                                if ($row['id'] || $allBox) {
                                    $dbTable->delete(
                                        self::MODEL_PRIMARY_ID . ' = ' . $key
                                    );
                                }
                            }

                            //
                            $this->_redirect(self::URL_LIST);
                        }
                    }

                    if (isset($filteredPost[self::LIST_SUBFORM_NAME]['rows']) && is_array($filteredPost[self::LIST_SUBFORM_NAME]['rows'])) {
                        foreach ($filteredPost[self::LIST_SUBFORM_NAME]['rows'] as $key => $row) {
//                            Zend_Debug::dump($row);
                            if (isset($row['actions'])) {
                                $action = $row['actions'];
                                if (isset($action['save'])) {

                                    $dbTable->update(
                                        $row['row'],
                                        self::MODEL_PRIMARY_ID . ' = ' . $key
                                    );

                                    $this->_redirect(self::URL_LIST);
                                }
                            }
                        }
                    }
                }
            }
        }
    }

    public function deleteAction()
    {
        $this->view->headTitle('Delete');
        $this->_helper->viewRenderer->setNoRender();

        /*@var $dbTable HiZend_Db_Table*/
        $classString = self::MODEL_TABLE_NAME;
        $dbTable = new $classString();

        $id = (int)$this->_request->getParam(self::PARAM_ID);

        $dbTable->delete(self::MODEL_PRIMARY_ID . ' = ' . $id);

        $this->_redirect(self::URL_LIST);
    }

    public function editAction()
    {
        /**
         *
         */
        $this->view->headTitle('Edit Item');

        /**
         *
         */
        /*@var $langsDbTable HiZend_Db_Table*/
        $langsClassString = self::LANGS_TABLE_NAME;
        $langsDbTable = new $langsClassString();

        /*@var $dbTable HiZend_Db_Table*/
        $classString = self::MODEL_TABLE_NAME;
        $dbTable = new $classString();


        /**
         *
         */
        $this->view->deleteLink     = $this->_baseUrl . self::URL_DELETE . '/' . self::PARAM_ID . '/';
        $this->view->listLink       = $this->_baseUrl . self::URL_LIST;
        $this->view->addLink        = $this->_baseUrl . self::URL_ADD;

        /**
         *
         */
        $this->view->headScript()->appendScript(
            $this->view->render(
                self::JS_EDIT
            )
        );

        /**
         *
         */
        $id = (int)$this->_request->getParam(self::PARAM_ID, 0);


        /**
         *
         */
        $editForm = new Hi_Record_Form(
            array(
                'title'     => $this->view->translate(self::EDIT_FORM_TITLE),
                'name'      => self::EDIT_FORM_NAME,
                'method'    => 'post',
            )
        );


        /**
         *
         */
        $editRow = new Hi_Record_SubForm_Row_Db(
            array(
                'title'     => $this->view->translate(self::EDIT_SUBFORM_TITLE),
                'name'      => self::EDIT_SUBFORM_NAME,
                'langs'     => $langsDbTable->getLangs(),
                'model'     => $dbTable,
                'view'      => $this->view,
            )
        );

        /**
         *
         */
        $editRow->setRowId($id);

        /**
         *
         */
        $editRow->addAction(
            'back',
            'image',
            array(
                'label'     => $this->view->translate('back'),
                'class'     => 'actionImage',
                'image'     => $this->_skinUrl . '/img/icons/record/back.png',
                'onclick'   => 'return goBack();',
            )
        );
        $editRow->addAction(
            'save',
            'image',
            array(
                'label'     => $this->view->translate('save'),
                'class'     => 'actionImage',
                'image'     => $this->_skinUrl . '/img/icons/record/save.png',
            )
        );
        $editRow->addAction(
            'delete',
            'image',
            array(
                'label'     => $this->view->translate('delete'),
                'class'     => 'actionImage',
                'image'     => $this->_skinUrl . '/img/icons/record/delete.png',
                'onclick'   => 'return deleteRow(__ID__);',
            )
        );

        $editRow->addAction(
            'add',
            'image',
            array(
                'label'     => $this->view->translate('add'),
                'class'     => 'actionImage',
                'image'     => $this->_skinUrl . '/img/icons/record/new.png',
                'onclick'   => 'return add(__ID__);',
            )
        );

        /**
         *
         */
        $editRow->build();
        $editForm->addSubForm($editRow, $editRow->getName());

        /**
         * POST
         */
        if ($this->_request->isPost()) {
            if ($editForm->isValid($this->_request->getPost())) {
                $filteredPost = $editForm->getValues();
                Zend_Debug::dump($filteredPost);

                if (    isset($filteredPost['header']['formId'])
                        && $filteredPost['header']['formId'] == self::EDIT_FORM_NAME) {
                    //
                    if (isset($filteredPost[self::EDIT_SUBFORM_NAME]['actions'])) {
                        //
                        $action = $filteredPost[self::EDIT_SUBFORM_NAME]['actions'];
                        //
                        if (isset($action['save'])) {
                            $row = $filteredPost[self::EDIT_SUBFORM_NAME]['row'];
                            unset($row[self::MODEL_PRIMARY_ID]);
                            $dbTable->update(
                                $row,
                                self::MODEL_PRIMARY_ID . ' = ' . $id
                            );
                            $this->_redirect(self::URL_EDIT . '/' . self::PARAM_ID . '/' . $id);
                        }
                    }
                }
            }
        }

        /**
         *
         */
        $this->view->edit = $editForm;

    }

    public function addAction()
    {
        /**
         *
         */
        $this->view->headTitle('Add Item');

        /**
         *
         */
        /*@var $langsDbTable HiZend_Db_Table*/
        $langsClassString = self::LANGS_TABLE_NAME;
        $langsDbTable = new $langsClassString();

        /*@var $dbTable HiZend_Db_Table*/
        $classString = self::MODEL_TABLE_NAME;
        $dbTable = new $classString();

        /**
         *
         */
        $this->view->listLink       = $this->_baseUrl . self::URL_LIST;

        /**
         *
         */
        $this->view->headScript()->appendScript(
            $this->view->render(
                self::JS_ADD
            )
        );

        /**
         *
         */
        $addForm = new Hi_Record_Form(
            array(
                'title'     => $this->view->translate(self::ADD_FORM_TITLE),
                'name'      => self::ADD_FORM_NAME,
                'method'    => 'post',
            )
        );


        /**
         *
         */
        $addRow = new Hi_Record_SubForm_Row_Db(
            array(
                'title'     => $this->view->translate(self::ADD_SUBFORM_TITLE),
                'name'      => self::ADD_SUBFORM_NAME,
                'langs'     => $langsDbTable->getLangs(),
                'model'     => $dbTable,
                'view'      => $this->view,
            )
        );



        /**
         *
         */
        $addRow->addAction(
            'back',
            'image',
            array(
                'label'     => $this->view->translate('back'),
                'class'     => 'actionImage',
                'image'     => $this->_skinUrl . '/img/icons/record/back.png',
                'onclick'   => 'return goBack();',
            )
        );
        $addRow->addAction(
            'save',
            'image',
            array(
                'label'     => $this->view->translate('save'),
                'class'     => 'actionImage',
                'image'     => $this->_skinUrl . '/img/icons/record/save.png',
            )
        );

        /**
         *
         */
        $addRow->build();
        $addForm->addSubForm($addRow, $addRow->getName());

        /**
         * POST
         */
        if ($this->_request->isPost()) {
            $post = $this->_request->getPost();
            if ($addForm->isValid($post)) {
                $filteredPost = $addForm->getValues();
                Zend_Debug::dump($post);

                if (    isset($filteredPost['header']['formId'])
                        && $filteredPost['header']['formId'] == self::ADD_FORM_NAME) {
                    //
                    if (isset($filteredPost[self::ADD_SUBFORM_NAME]['actions'])) {
                        //
                        $action = $filteredPost[self::ADD_SUBFORM_NAME]['actions'];
                        //
                        if (isset($action['save'])) {
                            $id = $dbTable->insert(
                                $post[self::ADD_SUBFORM_NAME]['row']
                            );
                            $this->_redirect(self::URL_EDIT . '/' . self::PARAM_ID . '/' . $id);
                        }
                    }
                }
            }
        }

        /**
         *
         */
        $this->view->add = $addForm;
    }
}
