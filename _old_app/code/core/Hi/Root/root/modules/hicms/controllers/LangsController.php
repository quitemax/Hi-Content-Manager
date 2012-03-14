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
 * Simple table, list and add in one action
 *
 * @category   HiZend
 * @package    HiZend_Controller
 * @subpackage Hicms
 * @copyright  Copyright (c) 2009 Piotr Maxymilian Socha
 * @license
 */
class Hicms_LangsController extends Hicms_Libs_Controller_Action
{
    /**#@+
     *  Url for main action
     */
    const URL_LIST = '/hicms/langs/list';
    /**#@-*/

    /**#@+
     *  Url for main action
     */
    const URL_DELETE = '/hicms/langs/delete';
    /**#@-*/

    /**#@+
     *  Url for main action
     */
    const PARAM_ID = 'id';
    /**#@-*/

    /**#@+
     *  Main model table name
     */
    const MODEL_TABLE_NAME = 'Hicms_Model_DbTable_Langs';
    /**#@-*/

    /**#@+
     * Model primary id
     */
    const MODEL_PRIMARY_ID = 'hl_id';
    /**#@-*/

    /**#@+
     *
     */
    const FORM_TITLE = 'hicmsLangsPanel';
    /**#@-*/

    /**#@+
     *
     */
    const FORM_NAME = 'langsListForm';
    /**#@-*/

    /**#@+
     *
     */
    const SUBFORM_LIST_TITLE = 'langsList';
    /**#@-*/

    /**#@+
     *
     */
    const SUBFORM_LIST_NAME = 'langsList';
    /**#@-*/

    /**#@+
     *
     */
    const JS_LIST = 'hicms/langs/list.js';
    /**#@-*/

    /**#@+
     *
     */
    const SUBFORM_ADD_TITLE = 'addLang';
    /**#@-*/

    /**#@+
     *
     */
    const SUBFORM_ADD_NAME = 'addLangRow';
    /**#@-*/

    /**
     * Init
     *
     * Mainly init of parent class, etc...
     *
     */
    function init() {
        parent::init();
        $this->view->headTitle('Langs');
    }
    
    /**
     * Lists elements
     *
     */
    function listAction()
    {
        $this->view->headTitle('List');

        /*@var $dbTable HiZend_Db_Table*/
        $modelString = self::MODEL_TABLE_NAME;
        $dbTable = new $modelString();

        /**
         * Record Form
         */
        $form = new Hi_Record_Form(
            array(
                'title'     => $this->view->translate(self::FORM_TITLE),
                'name'      => self::FORM_NAME,
                'method'    => 'post',
            )
        );


        //
        $this->view->deleteLink = $this->_baseUrl . self::URL_DELETE . '/' . self::PARAM_ID . '/';

        //
        $this->view->headScript()->appendScript(
            $this->view->render(
                self::JS_LIST
            )
        );

        /**
         * Building list
         */
        /*@var $navigationList Hi_Record_List*/
        $list = new Hi_Record_SubForm_List_Db(
            array(
                'title'     => $this->view->translate(self::SUBFORM_LIST_TITLE),
                'name'      => self::SUBFORM_LIST_NAME,
                'model'     => $dbTable,
                'view'      => $this->view,
            )
        );

        //
        $list->processRequest($this->_request);

        //
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

        //
        $list->addListAction(
            'delete',
            'image',
            array(
                'label'     => $this->view->translate('delete'),
                'class'     => 'actionImage',
                'image'     => $this->_skinUrl . '/img/icons/record/delete.png',
                'onclick'   => 'return deleteList(); ',
            )
        );


        $list->build();
        $form->addSubForm($list, $list->getName());


        /**
         * Building add row
         */
        $addRow = new Hi_Record_SubForm_Row_Db(
            array(
                'title'     => $this->view->translate(self::SUBFORM_ADD_TITLE),
                'name'      => self::SUBFORM_ADD_NAME,
                'model'     => $dbTable,
                'view'      => $this->view,
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

        //
        $addRow->build();
        $form->addSubForm($addRow, $addRow->getName());


        $this->view->list = $form;

        /**
         * POST
         */
        if ($this->_request->isPost()) {

            $post = $this->_request->getPost();

            if ($form->isValid($post)) {
                $filteredPost = $this->_request->getPost();
                Zend_Debug::dump($filteredPost);

                if (    isset($filteredPost['header']['formId'])
                        && $filteredPost['header']['formId'] == self::FORM_NAME) {
                    /**
                     *
                     */
                    if (isset($filteredPost[self::SUBFORM_ADD_NAME]['actions'])) {
                        //
                        $action = $filteredPost[self::SUBFORM_ADD_NAME]['actions'];
                        //
                        if (isset($action['save'])) {
                            $dbTable->insert(
                                $filteredPost[self::SUBFORM_ADD_NAME]['row']
                            );
                            $this->_redirect(self::URL_LIST);
                        }
                    }

                    /**
                     *
                     */
                    if (isset($filteredPost[self::SUBFORM_LIST_NAME]['actions'])) {
                        //
                        $action = $filteredPost[self::SUBFORM_LIST_NAME]['actions'];
                        //
                        if (isset($action['delete'])) {
                            $allBox = $filteredPost[self::SUBFORM_LIST_NAME]['header']['all'];
                            $rows = $filteredPost[self::SUBFORM_LIST_NAME]['rows'];

                            foreach ($rows as $key => $row) {
                                if ($row['id'] || $allBox) {
                                    $dbTable->delete(
                                        self::MODEL_PRIMARY_ID . ' = ' . $key
                                    );
                                }
                            }

                            $this->_redirect(self::URL_LIST);
                        }

                        //
                        if (isset($action['save'])) {
                            $allBox = $filteredPost[self::SUBFORM_LIST_NAME]['header']['all'];
                            $rows = $filteredPost[self::SUBFORM_LIST_NAME]['rows'];

                            foreach ($rows as $key => $row) {
                                if ($row['id'] || $allBox) {
                                    $dbTable->update(
                                        $rows[$key]['row'],
                                        self::MODEL_PRIMARY_ID . ' = ' . $key
                                    );
                                }
                            }
                            $this->_redirect(self::URL_LIST);
                        }
                    }
                }
            }
        }
    }

    /**
     * Deletes an element.
     *
     *
     *
     */
    public function deleteAction()
    {
        $this->view->headTitle('Delete');
        $this->_helper->viewRenderer->setNoRender();

        /*@var $dbTable HiZend_Db_Table*/
        $modelString = self::MODEL_TABLE_NAME;
        $dbTable = new $modelString();

        $id = (int)$this->_request->getParam(self::PARAM_ID);

        $dbTable->delete(self::MODEL_PRIMARY_ID . ' = ' . $id);

        $this->_redirect(self::URL_LIST);
    }

    
}