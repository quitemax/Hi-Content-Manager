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
 * elements tree with root id as parent items list setup with langs:
 *  - list items action
 *  - delete item action
 *  - add item action
 *  - edit item action with its tree elements -  add, edit and children list
 *
 * @category   HiZend
 * @package    HiZend_Controller
 * @subpackage Hicms
 * @copyright  Copyright (c) 2009 Piotr Maxymilian Socha
 * @license
 */
class Hicms_NavigationController extends HiZend_Controller_Action
{
    /**#@+
     * Form default partial decorator directory
     */
    const URL_LIST = '/hicms/navigation/list';
    /**#@-*/

    /**#@+
     * Form default partial decorator directory
     */
    const URL_EDIT = '/hicms/navigation/edit';
    /**#@-*/

    /**#@+
     * Form default partial decorator directory
     */
    const URL_ADD = '/hicms/navigation/add';
    /**#@-*/

    /**#@+
     * Form default partial decorator directory
     */
    const URL_DELETE = '/hicms/navigation/delete';
    /**#@-*/

    /**#@+
     * Form default partial decorator directory
     */
    const PARAM_ITEM_ID = 'id';
    /**#@-*/

    /**#@+
     * Form default partial decorator directory
     */
    const PARAM_ELEMENT_ID = 'elementId';
    /**#@-*/

    /**#@+
     *  Main model table name
     */
    const LANGS_TABLE_NAME = 'Hicms_Model_DbTable_Langs';
    /**#@-*/

    /**#@+
     *  Main model table name
     */
    const MODEL_ITEMS_TABLE_NAME = 'Hicms_Model_DbTable_NavigationItems';
    /**#@-*/

    /**#@+
     * Model primary id
     */
    const MODEL_ITEMS_PRIMARY_ID = 'hnie_id';
    /**#@-*/
    
    /**#@+
     *  Main model table name
     */
    const SUBFORM_ITEMS_ELEMENTS_LIST_CLASS_NAME = 'Hicms_Form_SubForm_Navigation_ItemsElementsList';
    /**#@-*/

    /**#@+
     *  Main model table name
     */
    const MODEL_ITEM_ELEMENTS_TABLE_NAME = 'Hicms_Model_DbTable_NavigationItemsElements';
    /**#@-*/

    /**#@+
     * Model primary id
     */
    const MODEL_ITEM_ELEMENTS_PRIMARY_ID = 'hnie_id';
    /**#@-*/

    /**#@+
     *
     */
    const LIST_FORM_TITLE = 'hicmsNavigationPanel';
    /**#@-*/

    /**#@+
     *
     */
    const LIST_FORM_NAME = 'navigationListForm';
    /**#@-*/

    /**#@+
     *
     */
    const LIST_SUBFORM_TITLE = 'navigationItemsList';
    /**#@-*/

    /**#@+
     *
     */
    const LIST_SUBFORM_NAME = 'navigationList';
    /**#@-*/

    /**#@+
     *
     */
    const JS_LIST = 'hicms/navigation/list.js';
    /**#@-*/


    /**#@+
     * Form default partial decorator directory
     */
    const CACHE_DIR = '../hicmsAdmin/cache/';
    /**#@-*/

    /**
     *
     */
    function init() {
        parent::init();
        $this->view->headTitle('Hicms');
        $this->view->headTitle('Navigation Items');
    }

    /**
     *
     */
    function listAction()
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

        /*@var $itemsDbTable HiZend_Db_Table*/
        $classString = self::MODEL_ITEMS_TABLE_NAME;
        $itemsDbTable = new $classString();

        /**
         *
         */
        $this->view->deleteLink     = $this->_baseUrl . self::URL_DELETE . '/' . self::PARAM_ITEM_ID . '/';
        $this->view->editLink       = $this->_baseUrl . self::URL_EDIT . '/' . self::PARAM_ITEM_ID . '/';
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
         * RECORD FORM
         */
        $form = new Hi_Record_Form(
            array(
                'title'     => $this->view->translate(self::LIST_FORM_TITLE),
                'name'      => self::LIST_FORM_NAME,
                'method'    => 'post',
            )
        );

        /**
         * BUILDING LIST
         */
        /*@var $navigationList Hi_Record_List*/
        $list = new Hi_Record_SubForm_List_Db(
            array(
                'title'     => $this->view->translate(self::LIST_SUBFORM_TITLE),
                'name'      => self::LIST_SUBFORM_NAME,
                'langs'     => $langsDbTable->getLangs(),
                'model'     => $itemsDbTable,
                'view'      => $this->view,
            )
        );

        $list->processRequest($this->_request);

        $this->view->headScript()->appendScript(
            $this->view->render(
                self::JS_LIST
            )
        );

        /**
         * RECORD ACTIONS
         */
        $list->addRecordAction(
            'edit',
            'image',
            array(
                'label'     => $this->view->translate('edit'),
                'image'     => $this->_skinUrl.'/img/icons/record/edit.png',
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
         * LIST ACTIONS
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

        //
        $list->addListAction(
            'save',
            'image',
            array(
                'label'     => $this->view->translate('save'),
                'class'     => 'actionImage',
                'image'     => $this->_skinUrl . '/img/icons/record/save.png',
            )
        );


        $list->build();
        $form->addSubForm($list, $list->getName());

        $this->view->list = $form;

        /**
         * POST
         */
        if ($this->_request->isPost()) {

            if ($form->isValid($this->_request->getPost())) {
                $filteredPost = $this->_request->getPost();
                Zend_Debug::dump($filteredPost);

                if (    isset($filteredPost['header']['formId'])
                        && $filteredPost['header']['formId'] == self::LIST_FORM_NAME) {
                    //
                    if (isset($filteredPost[self::LIST_SUBFORM_NAME]['actions'])) {
                        //
                        $action = $filteredPost[self::LIST_SUBFORM_NAME]['actions'];
                        //
                        if (isset($action['save'])) {
                            $allBox = $filteredPost[self::LIST_SUBFORM_NAME]['header']['all'];
                            $rows = $filteredPost[self::LIST_SUBFORM_NAME]['rows'];

//                            Zend_Debug::dump($rows);

                            $ids = array();
                            if ($allBox){
                                $ids = array_keys($rows);
                            } else {
                                foreach ($rows as $key => $row) {
                                    if ($row['id']) {
                                      $ids[] = $key;
                                    }
                                }
                            }

                            if ($itemsDbTable->hasBehaviour('i18n')) {
                                $i18nBehaviour = $itemsDbTable->getBehaviour('i18n');
                                $i18nBehaviour->setLang($list->getLang());
                            }

                            foreach ($ids as $id) {
                                $itemsDbTable->update(
                                    $rows[$id]['row'],
                                    self::MODEL_ITEMS_PRIMARY_ID . ' = ' . $id
                                );
                            }
                            $this->_redirect(self::URL_LIST);
                        }
                    }
                }
            }
        }
	}

	/**
     *
     */
    public function deleteAction()
    {
        $this->view->headTitle('Delete');
        $this->_helper->viewRenderer->setNoRender();

        /*@var $itemsDbTable HiZend_Db_Table*/
        $classString = self::MODEL_ITEMS_TABLE_NAME;
        $itemsDbTable = new $classString();

        $id = (int)$this->_request->getParam(self::PARAM_ITEM_ID);

        $itemsDbTable->delete(self::MODEL_ITEMS_PRIMARY_ID . ' = ' . $id);

        $this->_redirect(self::URL_LIST);
    }

    /**
     *
     */
    public function editAction()
    {
        $this->view->headTitle('Edit Item');

        /*@var $hicmsLangsDbTable HiZend_Db_Table*/
        $hicmsLangsDbTable = new Hicms_Model_DbTable_Langs();

        /*@var $hicmsLangsModel HiZend_Db_Table*/
        $hicmsNavigationItemsDbTable = new Hicms_Model_DbTable_NavigationItems();

        /*@var $hicmsLangsModel HiZend_Db_Tree_Translated*/
        $hicmsNavigationItemsElementsDbTable = new Hicms_Model_DbTable_NavigationItemsElements();

        $id         = (int)$this->_request->getParam(
            self::PARAM_ITEM_ID,
            0
        );
        $elementId  = (int)$this->_request->getParam(
            self::PARAM_ELEMENT_ID,
            0
        );

        //
        $editRowData = $hicmsNavigationItemsDbTable->getRow('hni_id = ' . $id);

        if (!$editRowData) {
            //
            $this->_redirect(self::URL_LIST);

        } else {

            /**
             * Record Form
             */
            $editForm = new Hi_Record_Form(
                array(
                    'title'     =>  $this->view->translate('navigationPanel'),
                    'name'      => 'eNIForm', //editNavigationItem
                    'method'    => 'post',
                )
            );

            /**
             * Building list
             */
            /*@var $editRow Hi_Record_SubForm_Row_Db*/
            $editRow = new Hi_Record_SubForm_Row_Db(
                array(
                    'title'     => $this->view->translate('navigationItem'),
                    'name'      => 'eNIR',
                    'langs'     => $hicmsLangsDbTable->getLangs(),
                    'model'     => $hicmsNavigationItemsDbTable,
                    'view'      => $this->view,
                )
            );

            $this->view->headScript()->appendScript(
                $this->view->render(
                    'navigation/edit.js'
                )
            );


            //
            $editRow->setRowId($id);

            //
            $editRow->setData($editRowData);

            //
            $editRow->addAction(
                'back',
                'image',
                array(
                    'label'     => $this->view->translate('back'),
                    'class'     => 'actionImage',
                    'image'     => $this->_skinUrl . '/img/icons/record/back.png',
                    'onclick'   => 'goBack();return false;',
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
                )
            );
            $editRow->addAction(
                'cache',
                'image',
                array(
                    'label'     => $this->view->translate('cache'),
                    'class'     => 'actionImage',
                    'image'     => $this->_skinUrl . '/img/icons/record/cache.png',
                )
            );

            //
            $editRow->build();
            $editForm->addSubForm($editRow, $editRow->getName());



            $itemElementsTreeData = null;

            if ($hicmsNavigationItemsElementsDbTable->hasBehaviour('nestedSet')) {
                $tree = $hicmsNavigationItemsElementsDbTable->getBehaviour('nestedSet');

                $langSess = new Zend_Session_Namespace('lang');

                /*@var $tree HiZend_Db_Table_Behaviour_NestedSet*/
                $tree->setLang($langSess->lang);
                $itemElementsTreeData = $tree->getTree(
                    'hnie_tree_root_id = ' . $id
                );
//                Zend_Debug::dump($itemElementsTreeData);
            }

            $treeValues = array();
            $treeValues[] = '';
            foreach ($itemElementsTreeData as $element) {
                $treeValues[$element['id']] =  str_repeat('--', $element['level']) . ' ' . $element['title'];
            }


            //
            $editElementRowData = $hicmsNavigationItemsElementsDbTable->getRow(
                'hnie_id = ' . $elementId
            );


            //if we have edit
            if ($editElementRowData) {

                /**
                 * edit element row
                 */
                /*@var $editElementRow Hi_Record_SubForm_Row_Db*/
                $editElementRow = new Hi_Record_SubForm_Row_Db(
                    array(
                        'title'     => $this->view->translate('editNavigationItemElement'),
                        'name'      => 'eNIER', //editNavigationItemElementRow
                        'langs'     => $hicmsLangsDbTable->getLangs(),
                        'model'     => $hicmsNavigationItemsElementsDbTable,
                        'view'      => $this->view,
                    )
                );

                //
                $editElementRow->setRowId($elementId);

                //
                $editElementRow->removeFields(
                    array(
                        'hnie_tree_left',
                        'hnie_tree_right',
                        'hnie_tree_level',
                    )
                );
                $editElementRow->setField(
                    'hnie_tree_root_id',
                    'hidden',
                    array(
                        'value'  => $id,
                    )
                );
                $editElementRow->setField(
                    'hnie_tree_position',
                    null,
                    array(
                        'size'  => 3,
                    )
                );

                $editElementRow->setField(
                    'hnie_tree_parent_id',
                    'select',
                    array(
                        'values'    => $treeValues,
//                        'value'     => 0,
                    )
                );

                //
                $editElementRow->addAction(
                    'back',
                    'image',
                    array(
                        'label'     => $this->view->translate('back'),
                        'class'     => 'actionImage',
                        'image'     => $this->_skinUrl . '/img/icons/record/back.png',
                        'onclick'   => 'goBack();return false;',
                    )
                );

                $editElementRow->addAction(
                    'save',
                    'image',
                    array(
                        'label'     => $this->view->translate('save'),
                        'class'     => 'actionImage',
                        'image'     => $this->_skinUrl . '/img/icons/record/save.png',
                    )
                );

                //
                $editElementRow->build();
                $editForm->addSubForm($editElementRow, $editElementRow->getName());

                /**
                 * Building list
                 */
                /*@var $editElementsList Hi_Record_SubForm_List_Db*/
                $editElementsList = new Hi_Record_SubForm_List_Db(
                    array(
                        'title'     => $this->view->translate('navigationItemsElementsList'),
                        'name'      => 'nIEL', //navigationItemsElementsList
                        'model'     => $hicmsNavigationItemsElementsDbTable,
                        'view'      => $this->view,
                        'langs'     => $hicmsLangsDbTable->getLangs(),
                    )
                );

                $editElementsList->processRequest($this->_request);

                $editElementsList->setDbWhere(
                    array(
                        'hnie_tree_root_id = ' . $id,
                        'hnie_tree_parent_id = ' . $editElementRowData['hnie_id'],
                    )
                );

                //
                $editElementsList->removeFields(
                    array(
                        'hnie_tree_left',
                        'hnie_tree_right',
                        'hnie_tree_level',
                        'hnie_tree_root_id',
                        'hnie_tree_parent_id',
                        'hnie_description',
                    )
                );

                //
                $editElementsList->setFieldPosition(
                    'hnie_title', 15
                );

                //
                $editElementsList->addRecordAction(
                    'edit',
                    'image',
                    array(
                        'label'     => $this->view->translate('edit'),
                        'image'     => $this->_skinUrl . '/img/icons/record/edit.png',
                        'class'     => 'actionImage',
                        'onclick'   => 'editRow(__ID__);return false;',
                    )
                );
                $editElementsList->addRecordAction(
                    'delete',
                    'image',
                    array(
                        'label'     => $this->view->translate('delete'),
                        'image'     => $this->_skinUrl . '/img/icons/record/delete.png',
                        'class'     => 'actionImage',
                        'onclick'   => 'deleteRow(__ID__);return false;',
                    )
                );

                $editElementsList->addListAction(
                    'save',
                    'image',
                    array(
                        'label'     => $this->view->translate('save'),
                        'class'     => 'actionImage',
                        'image'     => $this->_skinUrl . '/img/icons/record/save.png',
                    )
                );

                //
                $editElementsList->build();
                $editForm->addSubForm($editElementsList, $editElementsList->getName());
            }



            /**
             * edit element row
             */
            /*@var $editElementRow Hi_Record_SubForm_Row_Db*/
            $newElementRow = new Hi_Record_SubForm_Row_Db(
                array(
                    'title'     => $this->view->translate('addNavigationItemElement'),
                    'name'      => 'aNIER', //addNavigationItemElementRow
                    'langs'     => $hicmsLangsDbTable->getLangs(),
                    'model'     => $hicmsNavigationItemsElementsDbTable,
                    'view'      => $this->view,
                )
            );

            //
            $newElementRow->addAction(
                'back',
                'image',
                array(
                    'label'     => $this->view->translate('back'),
                    'class'     => 'actionImage',
                    'image'     => $this->_skinUrl . '/img/icons/record/back.png',
                    'onclick'   => 'goBack();return false;',
                )
            );

            $newElementRow->addAction(
                'save',
                'image',
                array(
                    'label'     => $this->view->translate('save'),
                    'class'     => 'actionImage',
                    'image'     => $this->_skinUrl . '/img/icons/record/save.png',
                )
            );


            //
            $newElementRow->removeFields(
                array(
                    'hnie_tree_left',
                    'hnie_tree_right',
                    'hnie_tree_level',
                )
            );
            $newElementRow->setField(
                'hnie_tree_root_id',
                'hidden',
                array(
                    'value'  => $id,
                )
            );
            $newElementRow->setField(
                'hnie_tree_position',
                null,
                array(
                    'size'  => 3,
                )
            );

            $newElementRow->setField(
                'hnie_tree_parent_id',
                'select',
                array(
                    'values'    => $treeValues,
                    'value'     => 0,
                )
            );


            //
            $newElementRow->build();
            $editForm->addSubForm($newElementRow, $newElementRow->getName());


            $itemElementsTree = new Hi_Record_Tree_Db(
                array(
                    'title'     => $this->view->translate('navigationElementTree'),
                    'name'      => 'eT', //editNavigationItemElementRow
                    'langs'     => $hicmsLangsDbTable->getLangs(),
                    'model'     => $hicmsNavigationItemsElementsDbTable,
                    'view'      => $this->view,
                )
            );

            $itemElementsTree->setSelectedId($elementId);
            $itemElementsTree->setPositionVisible(true);
            $itemElementsTree->setCookiePath(
                $this->_baseUrl
                . '/' . self::URL_EDIT . self::PARAM_ITEM_ID . '/' . $id . '/'
            );
            $itemElementsTree->setGlobalLink(
                $this->_baseUrl
                . '/' . self::URL_EDIT . self::PARAM_ITEM_ID . '/' . $id . '/' . self::PARAM_ELEMENT_ID . '/'
            );

            $itemElementsTree->setData($itemElementsTreeData);


            /**
             * POST
             */
            if ($this->_request->isPost()) {
                $post = $this->_request->getPost();
                if ($editForm->isValid($post)) {
                    $filteredPost = $editForm->getValues();
                    Zend_Debug::dump($post);


                    if (    isset($filteredPost['header']['formId'])
                            && $filteredPost['header']['formId'] == 'eNIForm') {
                        //
                        if (isset($filteredPost['eNIR']['actions'])) {
                            //
                            $action = $filteredPost['eNIR']['actions'];
                            //
                            if (isset($action['save'])) {
                                $hicmsNavigationItemsDbTable->update(
                                    $post['eNIR']['row'],
                                    'hni_id = ' . $id
                                );
                                $this->_redirect(self::URL_EDIT . self::PARAM_ITEM_ID . '/' . $id);
                            }

                            //
                            if (isset($action['cache'])) {
                                $this->_redirect(self::URL_EDIT . self::PARAM_ITEM_ID . '/' . $id);
                            }
                        }

                        //
                        if (isset($filteredPost['aNIER']['actions'])) {
                            //
                            $action = $filteredPost['aNIER']['actions'];
                            //
                            if (isset($action['save'])) {
                                $elementId = $hicmsNavigationItemsElementsDbTable->insert(
                                    $post['aNIER']['row']
                                );
                                if ($hicmsNavigationItemsElementsDbTable->hasBehaviour('nestedSet')) {
                                    $nestedSetBehaviour = $hicmsNavigationItemsElementsDbTable->getBehaviour('nestedSet');
                                    $nestedSetBehaviour->rebuildNestedSetFromAdjacencyModel();
                                }
                                $this->_redirect(
                                    self::URL_EDIT
                                    . self::PARAM_ITEM_ID . '/' . $id . '/'
                                    . self::PARAM_ELEMENT_ID . '/' . $elementId
                                );
                            }
                        }

                        //
                        if (isset($filteredPost['eNIER']['actions'])) {
                            //
                            $action = $filteredPost['eNIER']['actions'];
                            //
                            if (isset($action['save'])) {

                                if ($hicmsNavigationItemsElementsDbTable->hasBehaviour('i18n')) {
                                    $i18nBehaviour = $hicmsNavigationItemsElementsDbTable->getBehaviour('i18n');
                                    $i18nBehaviour->clearLang();
                                }

                                $hicmsNavigationItemsElementsDbTable->update(
                                    $post['eNIER']['row'],
                                    'hnie_id = ' . $elementId
                                );
                                if ($hicmsNavigationItemsElementsDbTable->hasBehaviour('nestedSet')) {
                                    $nestedSetBehaviour = $hicmsNavigationItemsElementsDbTable->getBehaviour('nestedSet');
                                    $nestedSetBehaviour->rebuildNestedSetFromAdjacencyModel();
                                }
                                $this->_redirect(
                                    self::URL_EDIT
                                    . self::PARAM_ITEM_ID . '/' . $id . '/'
                                    . self::PARAM_ELEMENT_ID . '/' . $elementId
                                );
                            }
                        }

                            //
                        if (isset($filteredPost['nIEL']['actions'])) {
                            //
                            $action = $filteredPost['nIEL']['actions'];
                            //
                            if (isset($action['save'])) {
                                $allBox = $filteredPost['nIEL']['header']['all'];
                                $rows = $post['nIEL']['rows'];

                                Zend_Debug::dump($rows);
                                Zend_Debug::dump(array_keys($rows));

                                $elementIds = array();
                                if ($allBox){
                                    $elementIds = array_keys($rows);
                                } else {
                                    foreach ($rows as $key => $row) {
                                        if ($row['id']) {
                                          $elementIds[] = $key;
                                        }
                                    }
                                }

                                if ($hicmsNavigationItemsElementsDbTable->hasBehaviour('i18n')) {
                                    $i18nBehaviour = $hicmsNavigationItemsElementsDbTable->getBehaviour('i18n');
                                    $i18nBehaviour->setLang($editElementsList->getLang());
                                }

                                Zend_Debug::dump($elementIds);

                                foreach ($elementIds as $elId) {
                                    $hicmsNavigationItemsElementsDbTable->update(
                                        $rows[$elId]['row'],
                                        'hnie_id = ' . $elId
                                    );
                                }

                                echo self::URL_EDIT
                                    . self::PARAM_ITEM_ID . '/' . $id . '/'
                                    . self::PARAM_ELEMENT_ID . '/' . $elementId;
//                                $this->_redirect(
//                                    self::URL_EDIT
//                                    . self::PARAM_ITEM_ID . '/' . $id . '/'
//                                    . self::PARAM_ELEMENT_ID . '/' . $elementId
//                                );
                            }
                        }
                    }
                }
            }

            //
            $this->view->edit = $editForm;
            $this->view->tree = $itemElementsTree->build();
        }

//        Zend_Debug::dump($this->view->getVars());
    }

    public function addAction()
    {
        //
        $this->view->headTitle('Add Item');

        //
        $navigationEditForm = new Hi_Record_Form(
            array(
                'title'     =>  $this->view->translate('navigationPanel'),
                'name'      => 'navigationListForm',
                'method'    => 'post',
                'view'      =>  $this->view
            )
        );
//        $navigationEditForm->setConfig(
//            array(
//                'id'            => 'navigationEditForm',
//                'method'        => 'post',
//                'action'        => '',
//            )
//        );

        $navigationEditRow = new Hi_Record_SubForm_Row_Db(
            'Edit Navigation Item',
            $this->view,
            'navigationEditRow'
        );
        $navigationEditRow->addField(
            'username',
            'username',
            array(
                'length' => 64,
                'label' => 'Username',
            )
        );
//        $navigationEditRow->addField(
//            'password',
//            'password',
//            array(
//                'length' => 64,
//                'label' => 'Password',
//            )
//        );
//        $navigationEditRow->addAction(
//            'submitLogin',
//            'submit',
//            array(
//                'label' => 'Submit',
//                'class' => 'actionSubmitClass',
//            )
//        );
//
//        //
//        $navigationEditForm->addElement($navigationEditRow);
//
//        $this->view->add = $navigationEditForm;
    }
}
