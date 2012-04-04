<?php
/**
 * Hi CMS
 *
 * @category   Hi
 * @package    Hi_Grid
 * @copyright  Copyright (c) 2009 Piotr Maxymilian Socha
 * @license
 */

namespace HiBase\Grid\SubForm;

//use HiBase\Grid\Element\CheckboxRow,
use HiBase\Grid\SubForm as GridSubForm,
    HiBase\Grid\Element,
    Zend\Session\Container as SessionContainer;
//    Hi\Paginator\Paginator,
//    Hi\Grid\Element;
/**
 * Hi_Grid_Rowset
 *
 * @category   Hi
 * @package    Hi_Grid
 * @copyright  Copyright (c) 2009 Piotr Maxymilian Socha
 * @license
 * @version    2.0
 */
class ResultSet extends GridSubForm
{
    /**#@+
     * Rowset id template
     */
    const DEFAULT_ID = 'rowsetDefaultId';
    /**#@-*/

    /**#@+
     * Rowset default partial decorator directory
     */
    const DEFAULT_PARTIALS_DIR = '_grid/_resultSet';
    /**#@-*/

    /**#@+
     * Rowset default colspan (when rowset is rendered using
     * <table>, <tr>, <td> i.e.)
     */
    const DEFAULT_COLSPAN = 2;
    /**#@-*/

    /**#@+
     *
     */
    const DEFAULT_ACTIONS_TITLE = 'actions';
    /**#@-*/

    /**
     * Partial decorator directory
     *
     * @var string
     */
    protected $_partialsDir = self::DEFAULT_PARTIALS_DIR;



//
//    /**
//     * Langs in use
//     *
//     * @var array
//     */
//    protected $_langs = array();
//
//    /**
//     * Current lang
//     *
//     * @var string
//     */
//    protected $_lang = '';


    /**
     * Elements of a row in a rowset
     *
     * @var array
     */
    protected $_fields = array();

    /**
     *
     *
     * @var array
     */
    protected $_lastPosition = 10;



    /**
     * Row actions
     *
     * @var array
     */
    protected $_rowActions = array();

    /**
     * Whole rowset actions
     *
     * @var array
     */
    protected $_rowsetActions = array();

    /**
     * Whole rowset actions
     *
     * @var array
     */
    protected $_filterFields = array();

    /**
     * Rows values data
     *
     * @var array
     */
    protected $_data = null;

    /**
     *
     *
     * @var array
     */
    protected $_countData = null;

    /**
     * Primary key is the susbset of row's data that's going to be used as a means
     * to identificate the row
     *
     * @var string
     */
    protected $_primaryKey = null;

    /**
     * Session that's used to remember sorting options
     *
     * @var SessionContainer
     */
    protected $_rowsetSession = null;

    /**
     * Rowset colspan
     *
     * @var int
     */
    protected $_colspan = self::DEFAULT_COLSPAN;

    /**
     *
     *
     * @var int
     */
    protected $_paginationAvailablePerPage = null;

    /**
     *
     *
     * @var int
     */
    protected $_paginationAllElementsCount = null;

    /**
     *
     *
     * @var int
     */
    protected $_rowCheckBoxEnable = false;

    /**
     *
     *
     * @var int
     */
    protected $_currentRow = null;

    /**
     *
     *
     * @var int
     */
    protected $_currentRowIdValue = null;

    /**
     *
     *
     * @var array
     */
    protected $_defaultAvailablePerPage = array(
        '2'     =>  '2',
        '5'     =>  '5',
        '10'    =>  '10',
        '20'    =>  '20',
        '50'    =>  '50',
        '100'   =>  '100',
    );

	/**
     * Set form state from options array
     *
     * @param  array $options
     * @return Form
     */
    public function setOptions(array $options)
    {

        if (!isset($this->_name) || trim($this->_name) == '') {
            $this->_name = self::DEFAULT_ID . md5(microtime());
        }

        if (!isset($options['session'])) {
            $this->_rowsetSession = new SessionContainer($this->_name . 'RowsetSession');
        } else {

        }

        //
        if (!isset($this->_rowsetSession->page)){
            $this->_rowsetSession->page = 1;
        }

        //
        if (!isset($this->_rowsetSession->perPage)){
            $this->_rowsetSession->perPage = 10;
        }

        //
        if (!isset($this->_rowsetSession->sortField)){
            $this->_rowsetSession->sortField = null;
        }

        //
        if (!isset($this->_rowsetSession->sortFieldDirection)){
            $this->_rowsetSession->sortFieldDirection = null;
        }

        //
//        if (!isset($this->_rowsetSession->lang)){
//            if (!isset($this->_langs) || !is_array($this->_langs) || !count($this->_langs)) {
//                $langSess = new Zend_Session_Namespace('lang');
//                $this->_rowsetSession->lang = $langSess->lang;
//            } else {
//                $this->_rowsetSession->lang = $this->_langs[0];
//            }
//        }

        //
        $this->_paginationAvailablePerPage = $this->_defaultAvailablePerPage;

        return parent::setOptions($options);
    }
////    /**
////     * Constructor.
////     * Creates an instance of Hi_Record_SubForm_Rowset
////     *
////     * @param array $options
////     *
////     * @return void
////     */
////    public function __construct($options = null)
////    {
//
////        //
////        if (!isset($options['name'])) {
////            $options['name'] = Hi_Record_SubForm_Rowset::DEFAULT_ID . md5(microtime());
////        }
////
////        //
////        if (isset($options['langs']) && is_array($options['langs']) && count($options['langs'])) {
////            $this->_langs = $options['langs'];
////            unset($options['langs']);
////        }
////
////        //
////        if (isset($options['view']) && $options['view'] instanceof Zend_View) {
////            $this->setView($options['view']);
////            unset($options['view']);
////        }
////
////
////        //
//
////
////        //
////        if (!isset($this->_rowsetSession->page)){
////            $this->_rowsetSession->page = 1;
////        }
////
////        //
////        if (!isset($this->_rowsetSession->perPage)){
////            $this->_rowsetSession->perPage = 10;
////        }
////
////        //
////        if (!isset($this->_rowsetSession->sortField)){
////            $this->_rowsetSession->sortField = null;
////        }
////
////        //
////        if (!isset($this->_rowsetSession->sortFieldDirection)){
////            $this->_rowsetSession->sortFieldDirection = null;
////        }
////
////        //
////        if (!isset($this->_rowsetSession->lang)){
////            if (!isset($this->_langs) || !is_array($this->_langs) || !count($this->_langs)) {
////                $langSess = new Zend_Session_Namespace('lang');
////                $this->_rowsetSession->lang = $langSess->lang;
////            } else {
////                $this->_rowsetSession->lang = $this->_langs[0];
////            }
////        }
////
////        //
////        $this->_paginationAvailablePerPage = $this->_defaultAvailablePerPage;
////
////
////        $options['disableLoadDefaultDecorators'] = true;
////
////        parent::__construct($options);
////    }
//
    /**
     *
     *
     * @return
     */
    public function processRequest($request)
    {
////        \HiZend\Debug\Debug::dump($request);
////        \HiZend\Debug\Debug::dump($request->query());
////        \HiZend\Debug\Debug::dump(get_class($request));
////        \HiZend\Debug\Debug::dump(get_class_methods($request));
//        $query = $request->query();
//        if (!$request->isPost()) {
//            if (isset($query['form']) && $query['form'] == $this->getName()) {
//                foreach ($query as $name => $value) {
//                    switch($name) {
//                        case 'p':
//                            if ($value>=1) {
//                                $this->_rowsetSession->page = (int)$value;
//                            }
//                            break;
//                        case 'perPage':
//                            if (in_array($value, $this->_paginationAvailablePerPage)) {
//                                $this->_rowsetSession->perPage = (int)$value;
//                                $this->_rowsetSession->page = 1;
//                            }
//                            break;
////                        case 'lang':
////                            if (in_array($value, $this->_langs)) {
////                                $this->_rowsetSession->lang = $value;
////                                $this->_rowsetSession->page = 1;
////                            }
////                            break;
//                        case 'sort':
//                            if (!isset($this->_rowsetSession->sortField)) {
//                                $this->_rowsetSession->sortField = $value;
//                                $this->_rowsetSession->sortFieldDirection = 'asc';
//                            } else {
//                                if ($this->_rowsetSession->sortField == $value) {
//                                    if ($this->_rowsetSession->sortFieldDirection == 'asc') {
//                                        $this->_rowsetSession->sortFieldDirection = 'desc';
//                                    } else if ($this->_rowsetSession->sortFieldDirection == 'desc'){
//                                        $this->_rowsetSession->sortField = null;
//                                        $this->_rowsetSession->sortFieldDirection = null;
//                                    }
//                                } else {
//                                    $this->_rowsetSession->sortField = $value;
//                                    $this->_rowsetSession->sortFieldDirection = 'asc';
//                                }
//                            }
//                            break;
//                        default:
//                            break;
//                    }
//                }
//            }
//        } else {
////            $post = $request->getPost();
////            if (isset($post[$this->getName()]['filter'])) {
////                $filter = $post[$this->getName()]['filter'];
//////                Zend_Debug::dump($filter);
////
////                if (isset($filter['filterSubmit'])) {
////                    unset($filter['filterSubmit']);
////                    $this->_rowsetSession->filter = $filter;
////
////                } else if (isset($filter['filterReset'])) {
////                    $this->_rowsetSession->filter = null;
////                }
////            }
////
//        }
    }

    /**
     * Adds a field to record rowset
     *
     * @param $name string
     * @param $type string
     * @param $options array
     * @param $position int
     *
     * @return void
     */
    public function addField($name, $type, $options, $position = null)
    {
        if ($name === null || $name == '') {
            throw new Exception("You must provide the name of the element");
        }

        if ($type === null || $type == '') {
            throw new Exception("You must provide the type of the element");
        }

        $fieldTmp = array(
            'name'     => $name,
            'type'     => $type,
            'options'  => $options,
        );
        if ($position===null) {
            $position = $this->_lastPosition;
            $this->_lastPosition += 10;;
        }
        $this->_fields[$position] = $fieldTmp;
    }


    /**
     *
     *
     * @param $name string
     *
     * @return void
     */
    public function removeField($name)
    {
        if (!is_string($name)) {
            throw new Exception ('The $name param should be a string!');
        }

        foreach ($this->_fields as $key => $field) {
            if ($field['name'] == $name) {
                unset($this->_fields[$key]);
                break;
            }
        }
    }

    /**
     *
     *
     * @param $names array
     *
     * @return void
     */
    public function removeFields($names) {
        if (!is_array($names)) {
            throw new Exception ('The $names param should be an array!');
        }

        foreach ($this->_fields as $key => $field) {
            if (in_array($field['name'], $names)) {
                unset($this->_fields[$key]);
            }
        }
    }

    /**
     * Adds a rowset action to record rowset
     *
     * @param $name string
     * @param $type string
     * @param $options array
     * @param $position int
     *
     * @return void
     */
    public function addResultSetAction($name, $type, $options, $position = null)
    {
        if ($name === null || $name == '') {
            throw new Exception("You must provide the name of the rowset action");
        }

        if ($type === null || $type == '') {
            throw new Exception("You must provide the type of the rowset action");
        }

        $actionTmp = array(
            'name'     => $name,
            'type'     => $type,
            'options'  => $options,
        );
        if ($position===null) {
            $position = 10*(count($this->_rowsetActions)+1);
        }
        $this->_rowsetActions[$position] = $actionTmp;
    }

    /**
     * Adds a record action to record rowset
     *
     * @param $name string
     * @param $type string
     * @param $options array
     * @param $position int
     *
     * @return void
     */
    public function addRowAction($name, $type, $options, $position = null)
    {
        if ($name === null || $name == '') {
            throw new Exception("You must provide the name of the record action");
        }

        if ($type === null || $type == '') {
            throw new Exception("You must provide the type of the record action");
        }

        $actionTmp = array(
            'name'     => $name,
            'type'     => $type,
            'options'  => $options,
        );
        if ($position===null) {
            $position = 10*(count($this->_rowActions)+1);
        }
        $this->_rowActions[$position] = $actionTmp;
    }


////    /**
////     *
////     *
////     * @param $name string
////     * @param $type string
////     * @param $options array
////     * @param $position int
////     *
////     * @return void
////     */
////    public function addFilterField($name, $type, $options, $position = null)
////    {
////        if ($name === null || $name == '') {
////            throw new Exception("You must provide the name of the filter");
////        }
////
////        if ($type === null || $type == '') {
////            throw new Exception("You must provide the type of the filter");
////        }
////
////        $filterTmp = array(
////            'name'     => $name,
////            'type'     => $type,
////            'options'  => $options,
////        );
////        if ($position===null) {
////            $position = 10*(count($this->_filterFields)+1);
////        }
////        $this->_filterFields[$position] = $filterTmp;
////    }

    /**
     * Sets the rowset elements data
     *
     * @param $data array
     *
     * @return string
     */
    public function setData($data)
    {
        $this->_data = $data;
    }

    /**
     * Sets the primary key of the elements data
     *
     * @param $name string Primary key of the rowset items
     *
     * @return void
     */
    public function setPrimaryKey($name)
    {
        $this->_primaryKey = $name;
    }

    /**
     *
     *
     * @param $name string
     * @param $options array
     *
     * @return
     */
    public function setFieldOptions($name, $options) {
        if (!is_array($options)) {
            throw new Exception ('The options param in Hi_Record_Row->setFieldOptions() should be an array!');
        }

//        \HiZend\Debug\Debug::dump($this->_fields);
        foreach ($this->_fields as $key => $field) {
            if ($field['name'] == $name) {
                if (is_array($field['options'])) {
                    $this->_fields[$key]['options'] += $options;
                } else {
                    $this->_fields[$key]['options'] = $options;
                }
            }
        }
//        \HiZend\Debug\Debug::dump($this->_fields);
    }

	/**
     *
     *
     * @param $name string
     * @param $options string
     *
     * @return
     */
    public function setFieldType($name, $type) {

        foreach ($this->_fields as $key => $field) {
            if ($field['name'] == $name) {
                if (is_string($type)) {
                    $this->_fields[$key]['type'] = $type;
                }
            }
        }
    }

	/**
     *
     *
     * @param $name string
     * @param $options string
     *
     * @return
     */
    public function setAllFieldType($type) {

//        \HiZend\Debug\Debug::precho($this->_fields);
        foreach ($this->_fields as $key => $field) {
            if ($field['type'] != 'id') {
                if (is_string($type)) {
                    $this->_fields[$key]['type'] = $type;
                }
            }
        }
    }

    /**
     *
     *
     * @param $name string
     * @param $position int
     *
     * @return void
     */
    public function setFieldPosition($name, $position) {
        //
        $position = (int) $position;

        //
        while (isset($this->_fields[$position])) {
            $position += 1;
        }

        //
        foreach ($this->_fields as $key => $field) {
            if ($field['name'] == $name) {
                unset($this->_fields[$key]);
                $this->_fields[$position] = $field;
            }
        }
    }


////    /**
////     *
////     *
////     *
////     * @return string
////     */
////    public function getLang() {
////        return $this->_rowsetSession->lang;
////    }
//
//    /**
//     *
//     *
//     *
//     * @return void
//     */
//    public function setSortField($sortField) {
//        $this->_rowsetSession->sortField = $sortField;
//    }
//
//    /**
//     *
//     *
//     *
//     * @return string
//     */
//    public function getSortField() {
//        return $this->_rowsetSession->sortField;
//    }
//
//    /**
//     *
//     *
//     *
//     * @return void
//     */
//    public function setSortDirection($sortDirection) {
//        $this->_rowsetSession->sortFieldDirection = $sortDirection;
//    }
//
//    /**
//     *
//     *
//     *
//     * @return string
//     */
//    public function getSortDirection() {
//        return $this->_rowsetSession->sortFieldDirection;
//    }
//
//    /**
//     * Set page number for pagination
//     *
//     * @param $page int
//     *
//     * @return void
//     */
//    public function setPage($page)
//    {
//        $this->_rowsetSession->page = $page;
//    }
//
//    /**
//     * Get page number for pagination
//     *
//     *
//     * @return int
//     */
//    public function getPage()
//    {
//        return $this->_rowsetSession->page;
//    }

    /**
     * Set elements count for pagination
     *
     * @param $field string Sort filed name
     * @param $direction string Directon of sorting (asc/desc)
     *
     * @return void
     */
    public function setAllElementsCount($count)
    {
        $this->_paginationAllElementsCount = $count;
    }

//    /**
//     * Sets the per page count for pagination
//     *
//     * @param $perPage int
//     *
//     * @return void
//     */
//    public function setPerPage($perPage)
//    {
//        $this->_rowsetSession->perPage = $perPage;
//    }
//
//    /**
//     * Gets the per page count for pagination
//     *
//     * @return int
//     */
//    public function getPerPage()
//    {
//        return $this->_rowsetSession->perPage;
//    }
////
////    /**
////     *
////     *
////     * @param $filter array
////     *
////     * @return void
////     */
////    public function setFilter($filter)
////    {
////        $this->_rowsetSession->filter = $filter;
////    }
////
////    /**
////     *
////     *
////     * @param $filter array
////     *
////     * @return void
////     */
////    public function addFilter($filter)
////    {
////        $tmpFilter = $this->_rowsetSession->filter;
////        $tmpFilter += $filter;
////        $this->_rowsetSession->filter = $filter;
////    }
////
////    /**
////     *
////     *
////     * @return array
////     */
////    public function getFilter()
////    {
////        if (!count($this->_filterFields)) {
////            $this->_rowsetSession->filter = null;
////        }
////        return $this->_rowsetSession->filter;
////    }
//
//    /**
//     * Sets the available per page options
//     *
//     * @param $perPage int
//     *
//     * @return void
//     */
//    public function setAvailablePerPage($availablePerPage = array())
//    {
//        $this->_paginationAvailablePerPage = $availablePerPage;
//    }
//
//    /**
//     *
//     *
//     *
//     * @return array
//     */
//    public function getAvailablePerPage() {
//        return $this->_paginationAvailablePerPage;
//    }
//
//    /**
//     * Sets the row checkboxes
//     *
//     * @param $set bool
//     *
//     * @return void
//     */
//    public function setActiveRowCheckbox($set = true)
//    {
//        $this->_rowCheckBoxEnable = $set;
//    }
//
//
//
    /**
     *
     *
     * @return void
     */
    public function init()
    {
        parent::init();

//        \Zend\Debug::dump($this->_view);
//        \Zend\Debug::dump($this);


        $this ->setDecorators(
            array(
                array('FormElements'),
                array(
                    'ViewScript',
                    array(
                        'viewScript'        => $this->_partialsDir . '/_subForm.phtml',
                        'placement'         => false,
                        'colspan'           => $this->_colspan,
                        'subFormName'       => $this->_title,
                        'subFormId'         => $this->getName(),
                    ),
                ),
            )
        );

//        \Zend\Debug::dump($this->_view);
        $this->_view->headScript()->appendScript(
            $this->_view->render(
                $this->_partialsDir . '/_subForm.js'
            )
        );
    }

    /**
     * Builds
     *
     * @return void
     */
    public function build()
    {
        //
        ksort($this->_fields);

        //
        $countRowActions = count($this->_rowActions);

        $this->_colspan = ($this->_rowCheckBoxEnable?1:0) + ($countRowActions?1:0) + count($this->_fields);

        $this->_countData = count($this->_data);



        /**
         * resultSet actions subform
         */
        $this->addSubForm($this->_buildSubFormResultSetActions(), 'actions');

//        /**
//         * info tab
//         */
//        $this->addSubForm($this->_buildSubFormInfo(), 'info');


//        /**
//         * filter tab
//         */
//        if (count ($this->_filterFields)) {
//            $this->addSubForm($this->_buildSubFormFilter(), 'filter');
//        }



        /**
         * rowset header
         */
        $this->addSubForm($this->_buildSubFormHeader(), 'header');








        /**
         * rows
         */
        $rowsetSubForm = new GridSubForm();
        $rowsetSubForm ->setDecorators(
            array(
                array('FormElements'),
            )
        );

        /**
         * DATA
         */
        if ($this->_countData) {
            for( $i = 0 ; $i < $this->_countData ; $i++ ) {

                $dataRow = array();
                if (isset($this->_data[$i])) {
                    $dataRow = $this->_data[$i];
                }

                $dataEven = ($i%2);

////                Zend_Debug::dump($this->_primaryKey);
////                Zend_Debug::dump($dataRow);
////                Zend_Debug::dump(isset($dataRow[$this->_primaryKey]));
////                Zend_Debug::dump((string)$dataRow[$this->_primaryKey]);
////                Zend_Debug::dump((string)($i+1));

                if (isset($dataRow[$this->_primaryKey])) {
                    $sequenceKey = (string)$dataRow[$this->_primaryKey];
                } else {
                    $sequenceKey = (string)($i+1);
                }
//                Zend_Debug::dump($sequenceKey);

                $this->_currentRow = $dataRow;
                $this->_currentRowIdValue = $sequenceKey;

                /**
                 * main row subform
                 */
                $gridRowSubForm = new GridSubForm();

                //
                $gridRowSubForm ->setDecorators(
                    array(
                        array('FormElements'),
                        array(
                            'ViewScript',
                            array(
                                'viewScript' => $this->_partialsDir . '/_subForm_row.phtml',
                                'placement' => false,
                                'even' => $dataEven,
                            ),
                        ),
                    )
                );

                /*
                 * every row has a checkbox to check
                 * when only particular row is needed
                 */
                if ($this->_rowCheckBoxEnable) {
                    $gridRowSubForm->addElement(
                        $this->_buildRowCheckbox(
                            $dataEven
                        )
                    );
                }



                /*
                 * item sub form (where actual elements will be)
                 */
                $gridRowItemSubForm = new GridSubForm();


                //
                $gridRowItemSubForm ->setDecorators(
                    array(
                        array('FormElements'),
                        array(
                            'ViewScript',
                            array(
                                'viewScript' => $this->_partialsDir . '/_subForm_row_item.phtml',
                                'placement' => false,
                            ),
                        ),
                    )
                );


                /*
                 * rowset elements (fields)
                 */
                if ($this->_fields) {
                    foreach ($this->_fields as $position => $field) {

                        if ($field['name'] == $this->_rowsetSession->sortField) {
                            $field['options']['sort'] = true;
                        } else {
                            $field['options']['sort'] = false;
                        }

                        $field['options']['even'] = $dataEven;

                        switch ($field['type']) {
                            case 'id':
                                $gridRowItemSubForm->addElement(
                                    $this->_buildRowIdField(
                                        $field['name'],
                                        isset($dataRow[$field['name']])
                                        ? $dataRow[$field['name']]
                                        : null,
                                        $field['options']
                                    )
                                );
                                break;
                            case 'text':
                                $gridRowItemSubForm->addElement(
                                    $this->_buildRowTextField(
                                        $field['name'],
                                        isset($dataRow[$field['name']])
                                        ? $dataRow[$field['name']]
                                        : null,
                                        $field['options']
                                    )
                                );
                                break;
                            case 'input':
                                $gridRowItemSubForm->addElement(
                                    $this->_buildRowInputField(
                                        $field['name'],
                                        isset($dataRow[$field['name']])
                                        ? $dataRow[$field['name']]
                                        : null,
                                        $field['options']
                                    )
                                );
                                break;
                            case 'multilangInput':
////                                $gridRowItemSubForm->addSubForm(
////                                    $this->_buildSubFormMultilangInput(
////                                        $field['name'],
////                                        isset($dataRow[$field['name']])
////                                        ? $dataRow[$field['name']]
////                                        : null,
////                                        $field['options']
////                                    ),
////                                    $field['name']
////                                );
                                break;
                            case 'textarea':
////                                $gridRowItemSubForm->addElement(
////                                    $this->_buildRowTextareaField(
////                                        $field['name'],
////                                        isset($dataRow[$field['name']])
////                                        ? $dataRow[$field['name']]
////                                        : null,
////                                        $field['options']
////                                    )
////                                );
                                break;
                            case 'multilangTextarea':
////                                $gridRowItemSubForm->addSubForm(
////                                    $this->_buildSubFormMultilangTextarea(
////                                        $field['name'],
////                                        isset($dataRow[$field['name']])
////                                        ? $dataRow[$field['name']]
////                                        : null,
////                                        $field['options']
////                                    ),
////                                    $field['name']
////                                );
                                break;
                            case 'checkbox':
////                                $gridRowItemSubForm->addElement(
////                                    $this->_buildRowCheckboxField(
////                                        $field['name'],
////                                        isset($dataRow[$field['name']])
////                                        ? $dataRow[$field['name']]
////                                        : null,
////                                        $field['options']
////                                    )
////                                );
                                break;
                            case 'multilangCheckbox':
////                                $gridRowItemSubForm->addSubForm(
////                                    $this->_buildSubFormMultilangCheckbox(
////                                        $field['name'],
////                                        isset($dataRow[$field['name']])
////                                        ? $dataRow[$field['name']]
////                                        : null,
////                                        $field['options']
////                                    ),
////                                    $field['name']
////                                );
                                break;
                            case 'custom':
//                                $gridRowItemSubForm->addElement(
//                                    $this->_buildRowCustomField(
//                                        $field['name'],
//                                        $dataRow,
//                                        $field['options']
//                                    )
//                                );
                                break;
                            default:
//                                $gridRowItemSubForm->addElement(
//                                    $this->_buildRowDefaultField(
//                                        $field['name'],
//                                        isset($dataRow[$field['name']])
//                                        ? $dataRow[$field['name']]
//                                        : null,
//                                        $field['options']
//                                    )
//                                );
                                break;
                        }
                    }
                }
//
//
                $gridRowSubForm->addSubForm($gridRowItemSubForm, 'row');



                /*
                 * row actions subform
                 */
                if (count($this->_rowActions)) {
                    $gridRowActionsSubForm = new GridSubForm();


                    //
                    $gridRowActionsSubForm ->setDecorators(
                        array(
                            array('FormElements'),
                            array(
                                'ViewScript',
                                array(
                                    'viewScript'    =>  $this->_partialsDir . '/_subForm_row_actions.phtml',
                                    'placement'     =>  false,
                                    'even'          =>  $dataEven,
                                ),
                            ),
                        )
                    );

                    /*
                     * row actions
                     */
                    if ($this->_rowActions && is_array($this->_rowActions)) {
                        foreach ($this->_rowActions as $key => $action) {
                            switch($action['type']) {
                                case 'submit':
                                    $gridRowActionsSubForm->addElement(
                                        $this->_buildRowActionSubmit(
                                            $action['name'],
                                            $action['options']
                                        )
                                    );
                                    break;
                                case 'image':
                                    $gridRowActionsSubForm->addElement(
                                        $this->_buildRowActionImage(
                                            $action['name'],
                                            $action['options']
                                        )
                                    );
                                    break;
                                default:
                                    break;
                            }
                        }
                    }

                    $gridRowSubForm->addSubForm($gridRowActionsSubForm, 'actions');
                }
//                Zend_Debug::dump($sequenceKey, 'seq');
                $rowsetSubForm->addSubForm($gridRowSubForm, $sequenceKey);
            }
        }

        $this->addSubForm($rowsetSubForm, 'rows');
//
//        /**
//         * rowset bottom paginator
//         */
//        $this->addSubForm($this->_buildSubFormBottomPaginator(), 'bottomPaginator');




    }



    /**
     * Return the rowset elements names (or their labels)
     *
     * @return array
     */
    protected function _getColumnTitles()
    {
        $columnTitles = array();
        if ($this->_fields) {
            foreach ($this->_fields as $field) {
                if (isset($field['options']['label'])) {
                    $columnTitles[$field['name']] = $field['options']['label'];
                } else {
                    $columnTitles[$field['name']] = $field['name'];
                }
            }
        }

        return $columnTitles;
    }

    /**
     * Return the rowset elements that are sortable
     *
     * @return array
     */
    protected function _getColumnSortable()
    {
        $columnSortable = array();
        if ($this->_fields) {
            foreach ($this->_fields as $field) {
                if (isset($field['options']['sortable'])) {
                    $columnSortable[$field['name']] = $field['options']['sortable'];
                }
            }
        }

        return $columnSortable;
    }

////    /**
////     *
////     *
////     * @return Zend_Form_SubForm
////     */
////    protected function _buildSubFormFilter()
////    {
////        $rowsetFilterSubForm = new Zend_Form_SubForm(
////            array('disableLoadDefaultDecorators' => true)
////        );
////
////        $countFilters = count($this->_filterFields);
////
////
////        $rowsetFilterSubForm ->setDecorators(
////            array(
////                array('FormElements'),
////                array(
////                    'ViewScript',
////                    array(
////                        'viewScript'        => $this->_partialsDir.'_subForm_filter.phtml',
////                        'placement'         => false,
////                        'subFormId'         => $this->getName(),
////                        'colspan'           => $this->_colspan,
////                        'filterCount'       => $countFilters,
////
////                    ),
////                ),
////            )
////        );
////
////
////
////        /**
////         * filter fields
////         */
////        if ($countFilters) {
////            ksort($this->_filterFields);
////            $sessFilter = $this->_rowsetSession->filter;
////            foreach( $this->_filterFields as $position => $filter ) {
////                $value = null;
////                if (isset($sessFilter[$filter['name']])) {
////                    $value = $sessFilter[$filter['name']];
////                }
//////                Zend_Debug::dump($filter, '$filter');
//////                        if ($field['name'] == $this->_rowsetSession->sortField) {
//////                            $field['options']['sort'] = true;
//////                        }
//////                        $field['options']['even'] = $dataEven;
////
////                switch ($filter['type']) {
//////                            case 'id':
//////                                $gridRowItemSubForm->addElement(
//////                                    $this->_buildRowIdField(
//////                                        $field['name'],
//////                                        $dataRow[$field['name']],
//////                                        $field['options']
//////                                    )
//////                                );
//////                                break;
//////                            case 'text':
//////                                $gridRowItemSubForm->addElement(
//////                                    $this->_buildRowTextField(
//////                                        $field['name'],
//////                                        $dataRow[$field['name']],
//////                                        $field['options']
//////                                    )
//////                                );
//////                                break;
//////                            case 'input':
//////                                $gridRowItemSubForm->addElement(
//////                                    $this->_buildRowInputField(
//////                                        $field['name'],
//////                                        $dataRow[$field['name']],
//////                                        $field['options']
//////                                    )
//////                                );
//////                                break;
////                    default:
////                        $rowsetFilterSubForm->addElement(
////                            $this->_buildFilterDefaultField(
////                                $filter['name'],
////                                $value,
////                                $filter['options']
////                            )
////                        );
////                        break;
////                }
////            }
////        }
////
////        $rowsetFilterSubForm->addElement(
////            $this->_buildFilterActionSubmit(
////                'filterSubmit',
////                array(
////                    'class' => 'actionSubmit',
////                    'label' => $this->_view->translate('filterSubmit'),
////                )
////            )
////        );
////
////        $rowsetFilterSubForm->addElement(
////            $this->_buildFilterActionReset(
////                'filterReset',
////                array(
////                    'class' => 'actionSubmit',
////                    'label' => $this->_view->translate('filterReset'),
////                )
////            )
////        );
////
////        return $rowsetFilterSubForm;
////    }
////
////
////    /**
////     *
////     *
////     * @return Zend_Form_Element_Text
////     */
////    protected function _buildFilterDefaultField ($name, $value, $options)
////    {
////        $tmpElement = new Zend_Form_Element_Text(
////            $name,
////            array(
////                'disableLoadDefaultDecorators'  =>  true
////            )
////        );
////
////        //
////        $tmpElement->setValue($value);
////
////
////        //
////        if ($options) {
////            foreach ($options as $optionName => $option) {
////                switch ($optionName) {
////                    case 'label':
////                        $tmpElement->setLabel($option);
////                        break;
////                    default:
////                        break;
////                }
////            }
////        }
////
////        $tmpElement->setDecorators(
////            array(
////                array('ViewHelper'),
////                array(
////                    'ViewScript',
////                    array(
////                        'viewScript'    => $this->_partialsDir.'_filter_default.phtml',
////                        'placement'     => false,
////                    ),
////                ),
////            )
////        );
////
////        return $tmpElement;
////    }
////
////    /**
////     *
////     *
////     * @return Zend_Form_Element_Submit
////     */
////    protected function _buildFilterActionSubmit($name, $options = array())
////    {
////        $tmpElement = new Zend_Form_Element_Submit(
////            $name,
////            array(
////                'disableLoadDefaultDecorators'  =>  true
////            )
////        );
////
////        if ($options) {
////            foreach ($options as $optionName => $option) {
////                switch ($optionName) {
////                    case 'label':
////                        $tmpElement->setLabel($option);
////                        break;
////                    case 'class':
////                        $tmpElement->setAttrib('class', $option);
////                        break;
////                    default:
////                        break;
////                }
////            }
////        }
////
////        $tmpElement->setDecorators(
////            array(
////                array('ViewHelper'),
////                array(
////                    'ViewScript',
////                    array(
////                        'viewScript'    => $this->_partialsDir.'_filter_action.phtml',
////                        'placement'     => false,
////                    ),
////                ),
////            )
////        );
////
////        return $tmpElement;
////    }
////
////    /**
////     *
////     *
////     * @return Zend_Form_Element_Submit
////     */
////    protected function _buildFilterActionReset($name, $options = array())
////    {
////        $tmpElement = new Zend_Form_Element_Submit(
////            $name,
////            array(
////                'disableLoadDefaultDecorators'  =>  true
////            )
////        );
////
////        if ($options) {
////            foreach ($options as $optionName => $option) {
////                switch ($optionName) {
////                    case 'label':
////                        $tmpElement->setLabel($option);
////                        break;
////                    case 'class':
////                        $tmpElement->setAttrib('class', $option);
////                        break;
////                    default:
////                        break;
////                }
////            }
////        }
////
////        $tmpElement->setDecorators(
////            array(
////                array('ViewHelper'),
////                array(
////                    'ViewScript',
////                    array(
////                        'viewScript'    => $this->_partialsDir.'_filter_action.phtml',
////                        'placement'     => false,
////                    ),
////                ),
////            )
////        );
////
////        return $tmpElement;
////    }
////
//    /**
//     *
//     *
//     * @return Zend_Form_SubForm
//     */
//    protected function _buildSubFormInfo()
//    {
//        //
//        $paginator = new Paginator();
//        $paginator->setCurrentPage($this->_rowsetSession->page);
//        $paginator->setAllItemsCount($this->_paginationAllElementsCount);
//        $paginator->setItemsPerPage($this->_rowsetSession->perPage);
//        $paginator->setLink('', '?form=' . $this->getName() . '&p=');
//
//
//        $rowsetInfoSubForm = new GridSubForm();
//        $rowsetInfoSubForm ->setDecorators(
//            array(
//                array('FormElements'),
//                array(
//                    'ViewScript',
//                    array(
//                        'viewScript'        => $this->_partialsDir . '/_subForm_info.phtml',
//                        'placement'         => false,
//                        'subFormId'         => $this->getName(),
//                        'colspan'           => $this->_colspan,
//                        'actionsTitle'      => self::DEFAULT_ACTIONS_TITLE,
//                        'elementsCount'     => $this->_countData,
//                        'elementsAllCount'  => $this->_paginationAllElementsCount,
//                        'elementsFrom'      => $this->_rowsetSession->perPage * ($this->_rowsetSession->page - 1) + 1,
//                        'elementsTo'        => ($this->_rowsetSession->perPage * ($this->_rowsetSession->page - 1)) + $this->_countData,
//                        'perPage'           => $this->_rowsetSession->perPage,
//                        'availablePerPage'  => $this->_paginationAvailablePerPage,
//                        'paginatorData'     => $paginator->getBuildData(),
//                    ),
//                ),
//            )
//        );
//
//        return $rowsetInfoSubForm;
//    }

    /**
     *
     *
     * @return Zend_Form_SubForm
     */
    protected function _buildSubFormHeader()
    {
        $rowsetHeaderSubForm = new GridSubForm();

        $countRowActions = count($this->_rowActions);

        $rowsetHeaderSubForm ->setDecorators(
            array(
                array('FormElements'),
                array(
                    'ViewScript',
                    array(
                        'viewScript'        => $this->_partialsDir . '/_subForm_header.phtml',
                        'placement'         => false,
                        'subFormId'         => $this->getName(),
                        'checkboxEnable'    => $this->_rowCheckBoxEnable,
                        'columnTitles'      => $this->_getColumnTitles(),
                        'columnSortable'    => $this->_getColumnSortable(),
                        'sortField'         => $this->_rowsetSession->sortField,
                        'sortFieldDirection'=> $this->_rowsetSession->sortFieldDirection,
                        'actions'           => $countRowActions,
                        'actionsTitle'      => self::DEFAULT_ACTIONS_TITLE,
                    ),
                ),
            )
        );

        if ($this->_rowCheckBoxEnable) {
            $rowsetHeaderSubForm->addElement($this->_buildAllCheckbox());
        }

        return $rowsetHeaderSubForm;
    }
//
//    /**
//     *
//     *
//     * @return Zend_Form_SubForm
//     */
//    protected function _buildSubFormBottomPaginator()
//    {
//        $gridRowsetPaginatorLangsSubForm = new GridSubForm();
//
//        //
//        $paginator = new Paginator();
//        $paginator->setCurrentPage($this->_rowsetSession->page);
//        $paginator->setAllItemsCount($this->_paginationAllElementsCount);
//        $paginator->setItemsPerPage($this->_rowsetSession->perPage);
//        $paginator->setLink('', '?form=' . $this->getName() . '&p=');
//
//        //
//        $gridRowsetPaginatorLangsSubForm ->setDecorators(
//            array(
//                array('FormElements'),
//                array(
//                    'ViewScript',
//                    array(
//                        'viewScript'    => $this->_partialsDir . '/_subForm_bottom_pagination.phtml',
//                        'placement'     => false,
//                        'colspan'       => $this->_colspan,
//                        'paginatorData' => $paginator->getBuildData(),
//                    ),
//                ),
//            )
//        );
//
//        return $gridRowsetPaginatorLangsSubForm;
//    }

    /**
     *
     *
     * @return Zend_Form_SubForm
     */
    protected function _buildSubFormResultSetActions()
    {
        //
        $gridRowsetActionsSubForm = new GridSubForm();

        //
        $gridRowsetActionsSubForm ->setDecorators(
            array(
                array('FormElements'),
                array(
                    'ViewScript',
                    array(
                        'viewScript'    => $this->_partialsDir . '/_subForm_actions_and_langs.phtml',
                        'placement'     => false,
                        'colspan'       => $this->_colspan,
//                        'subFormId'     => $this->getName(),
//                        'langs'         => $this->_langs,
//                        'lang'          => $this->_rowsetSession->lang,
                    ),
                ),
            )
        );

        /**
         * rowset actions
         */
        if ($this->_rowsetActions && is_array($this->_rowsetActions)) {
            foreach ($this->_rowsetActions as $key => $action) {
                switch($action['type']) {
                    case 'submit':
                        $gridRowsetActionsSubForm->addElement(
                            $this->_buildResultSetActionSubmit(
                                $action['name'],
                                $action['options']
                            )
                        );
                        break;
                    case 'image':
                        $gridRowsetActionsSubForm->addElement(
                            $this->_buildResultSetActionImage(
                                $action['name'],
                                $action['options']
                            )
                        );
                        break;
                    default:
                        break;
                }
            }
        }

        return $gridRowsetActionsSubForm;
    }

    /**
     *
     *
     * @return Zend_Form_Element_Checkbox
     */
    protected function _buildAllCheckbox()
    {
        //
        $tmpElement = new Element\CheckboxAll(
            'all',
            array(
                'viewScript'    => $this->_partialsDir . '/_field_checkbox_all.phtml',
                'onclick'       => 'checkAll(\'' . $this->getName() . '\');'
            )
        );

        return $tmpElement;
    }

    /**
     *
     *
     * @return Zend_Form_Element_Checkbox
     */
    protected function _buildRowCheckbox($even)
    {
        //
        $tmpElement = new Element\CheckboxRow(
            'id',
            array(
                'even'          =>  $even,
                'viewScript'    =>  $this->_partialsDir . '/_field_checkbox_row.phtml',
            )
        );

        return $tmpElement;
    }

//    /**
//     *
//     *
//     * @return Zend_Form_Element_Text
//     */
//    protected function _buildRowDefaultField ($name, $value, $options)
//    {
//
//        $options['viewScript'] = $this->_partialsDir . '/_field_default.phtml';
//        $options['label'] = $value;
//
//        $tmpElement = new Element\Text(
//            $name,
//            $options
//        );
//    }

    /**
     *
     *
     * @return Zend_Form_Element_Text
     */
    protected function _buildRowIdField ($name, $value, $options)
    {
        $options['viewScript'] = $this->_partialsDir . '/_field_id.phtml';
        $options['label'] = $value;


        $tmpElement = new Element\Text(
            $name,
            $options
        );

        return $tmpElement;
    }

    /**
     *
     *
     * @return Zend_Form_Element_Text
     */
    protected function _buildRowTextField ($name, $value, $options)
    {

        $options['viewScript'] = $this->_partialsDir . '/_field_text.phtml';
        $options['description'] = $value;

        $tmpElement = new Element\Text(
            $name,
            $options
        );

        return $tmpElement;
    }

//    /**
//     *
//     *
//     * @return Zend_Form_Element_Text
//     */
//    protected function _buildRowCustomField ($name, $values, $options)
//    {
//
//
//        if (!isset($options['viewScript'])) {
//            $options['viewScript'] = $this->_partialsDir . '/_field_custom.phtml';
//        }
//        $options['row'] = $values;
////        \HiZend\Debug\Debug::precho($options);
//
////        \HiZend\Debug\Debug::precho($options);
//
//        $tmpElement = new Element\Custom(
//            $name,
//            $options
//        );
////        $tmpElement->setRequired(true);
////
////        $tmpElement->addFilter(
////            new Zend_Filter_StripTags()
////        );
////        $tmpElement->addFilter(
////            new Zend_Filter_StringTrim()
////        );
////        $tmpElement->addFilter(
////            new Zend_Filter_Alnum()
////        );
////        $tmpElement->addFilter(
////            new Zend_Filter_StringToLower(
////                array(
////                    'encoding' => 'UTF-8',
////                )
////            )
////        );
////        $tmpElement->setDescription($value);
//
////        //
////        $sort = null;
//
//        //
////        if ($options) {
////            foreach ($options as $optionName => $option) {
////                switch ($optionName) {
////                    case 'sort':
////                        $sort = $option;
////                        break;
////                    case 'even':
////                        $even = $option;
////                        break;
////                    default:
////                        break;
////                }
////            }
////        }
//
////        $tmpElement->setDecorators(
////            array(
////                array(
////                    'ViewScript',
////                    array(
////                        'viewScript'    => $this->_partialsDir . '/_field_text.phtml',
////                        'placement'     => false,
////                        'sort'          => $sort,
////                        'even'          =>  $even,
////                    ),
////                ),
////            )
////        );
//
//        return $tmpElement;
//    }




    /**
     *
     *
     * @return Zend_Form_Element_Text
     */
    protected function _buildRowInputField ($name, $value, $options)
    {

        $options['viewScript'] = $this->_partialsDir . '/_field_input.phtml';
        $options['value'] = $value;


        $tmpElement = new Element\Input(
            $name,
            $options
        );

        return $tmpElement;
    }


////    /**
////     *
////     *
////     */
////    protected function _buildSubFormMultilangTextarea ($name, $value, $options)
////    {
////        /*
////         * main row subform
////         */
////        $subFormTmp = new Zend_Form_SubForm(
////            array('disableLoadDefaultDecorators' => true)
////        );
////
////        $even = 0;
////
////        if ($options) {
////            foreach ($options as $optionName => $option) {
////                switch ($optionName) {
////                    case 'sort':
////                        $sort = $option;
////                        break;
////                    case 'even':
////                        $even = $option;
////                        break;
////                    default:
////                        break;
////                }
////            }
////        }
////
////        $subFormTmp ->setDecorators(
////            array(
////                array('FormElements'),
////                array(
////                    'ViewScript',
////                    array(
////                        'viewScript'        => $this->_partialsDir.'_subForm_multilang.phtml',
////                        'placement'         => false,
////                        'colspan'           => $this->_colspan,
////                        'subFormName'       => $this->_title,
////                        'subFormId'         => $this->getName(),
////                        'name'              => $name,
////                        'even'          => $even,
////                    ),
////                ),
////            )
////        );
////
////
////        foreach ($this->_langs as $lang) {
////
////        	//
////        	if ($lang == $this->_rowsetSession->lang) {
////
////        		//
////	            $tmpElement = new Zend_Form_Element_Textarea(
////	                $lang,
////	                array(
////	                    'disableLoadDefaultDecorators'  =>  true
////	                )
////	            );
////
////	            $tmpElement->setLabel($lang);
////
////	            if (isset($value)) {
////	            	if (is_array($value) && isset($value[$lang])) {
////	                   $tmpElement->setValue($value[$lang]);
////	            	} else {
////	            		$tmpElement->setValue($value);
////	            	}
////	            }
////
////
////
////	            $tmpElement->setAttrib('cols', 60);
////	            $tmpElement->setAttrib('rows', 3);
////
////
////	            $tmpElement->setDecorators(
////	                array(
////	                    array('ViewHelper'),
////	                    array(
////	                        'ViewScript',
////	                        array(
////	                            'viewScript'    => $this->_partialsDir . '_field_multilang_textarea.phtml',
////	                            'placement'     => false,
////	                            'options'       => $options,
////	                            'value'         => $value,
////	                            'even'          => $even,
////	                        ),
////	                    ),
////	                )
////	            );
////	            $subFormTmp->addElement($tmpElement);
////        	}
////        }
////
////        return $subFormTmp;
////    }
////
////    /**
////     *
////     *
////     */
////    protected function _buildSubFormMultilangInput ($name, $value, $options)
////    {
////        /*
////         * main row subform
////         */
////        $subFormTmp = new Zend_Form_SubForm(
////            array('disableLoadDefaultDecorators' => true)
////        );
////
////        $even = 0;
////
//////            $tmpElement->setAttrib('cols', 60);
//////            $tmpElement->setAttrib('rows', 3);
////
////        if ($options) {
////            foreach ($options as $optionName => $option) {
////                switch ($optionName) {
////                    case 'sort':
////                        $sort = $option;
////                        break;
////                    case 'even':
////                        $even = $option;
////                        break;
////                    default:
////                        break;
////                }
////            }
////        }
////
////        $subFormTmp ->setDecorators(
////            array(
////                array('FormElements'),
////                array(
////                    'ViewScript',
////                    array(
////                        'viewScript'        => $this->_partialsDir.'_subForm_multilang.phtml',
////                        'placement'         => false,
////                        'colspan'           => $this->_colspan,
////                        'subFormName'       => $this->_title,
////                        'subFormId'         => $this->getName(),
////                        'name'              => $name,
////                        'even'          => $even,
////                    ),
////                ),
////            )
////        );
////
////        foreach ($this->_langs as $lang) {
////
////        	//
////            if ($lang == $this->_rowsetSession->lang) {
////
////	            $tmpElement = new Zend_Form_Element_Text(
////	                $lang,
////	                array(
////	                    'disableLoadDefaultDecorators'  =>  true
////	                )
////	            );
////	            $tmpElement->setLabel($lang);
////
////                if (isset($value)) {
////                    if (is_array($value) && isset($value[$lang])) {
////                       $tmpElement->setValue($value[$lang]);
////                    } else {
////                        $tmpElement->setValue($value);
////                    }
////                }
////
////
////
////	            $tmpElement->setDecorators(
////	                array(
////	                    array('ViewHelper'),
////	                    array(
////	                        'ViewScript',
////	                        array(
////	                            'viewScript'    => $this->_partialsDir.'_field_multilang_input.phtml',
////	                            'placement'     => false,
////	                            'options'       => $options,
////	                            'value'         => $value,
////	                            'even'          => $even,
////	                        ),
////	                    ),
////	                )
////	            );
////	            $subFormTmp->addElement($tmpElement);
////            }
////        }
////
////        return $subFormTmp;
////    }
////
////    /**
////     *
////     *
////     */
////    protected function _buildSubFormMultilangCheckbox ($name, $value, $options)
////    {
////        /*
////         * main row subform
////         */
////        $subFormTmp = new Zend_Form_SubForm(
////            array('disableLoadDefaultDecorators' => true)
////        );
////
////        $even = 0;
////
//////            $tmpElement->setAttrib('cols', 60);
//////            $tmpElement->setAttrib('rows', 3);
////
////        if ($options) {
////            foreach ($options as $optionName => $option) {
////                switch ($optionName) {
////                    case 'sort':
////                        $sort = $option;
////                        break;
////                    case 'even':
////                        $even = $option;
////                        break;
////                    default:
////                        break;
////                }
////            }
////        }
////
////
////        $subFormTmp ->setDecorators(
////            array(
////                array('FormElements'),
////                array(
////                    'ViewScript',
////                    array(
////                        'viewScript'        => $this->_partialsDir.'_subForm_multilang.phtml',
////                        'placement'         => false,
////                        'colspan'           => $this->_colspan,
////                        'subFormName'       => $this->_title,
////                        'subFormId'         => $this->getName(),
////                        'name'              => $name,
////                        'even'              => $even,
////                    ),
////                ),
////            )
////        );
////
////
////
////        foreach ($this->_langs as $lang) {
//////            Zend_Debug::dump($lang);
////
////        	//
////            if ($lang == $this->_rowsetSession->lang) {
////
////	            $tmpElement = new Zend_Form_Element_Checkbox(
////	                $lang,
////	                array(
////	                    'disableLoadDefaultDecorators'  =>  true
////	                )
////	            );
////	            $tmpElement->setLabel($lang);
////
////                if (isset($value)) {
////                    if (is_array($value) && isset($value[$lang])) {
////                       $tmpElement->setValue($value[$lang]);
////                    } else {
////                        $tmpElement->setValue($value);
////                    }
////                }
////	//            Zend_Debug::dump($tmpElement);
////
////
////
////	            $tmpElement->setDecorators(
////	                array(
////	                    array('ViewHelper'),
////	                    array(
////	                        'ViewScript',
////	                        array(
////	                            'viewScript'    => $this->_partialsDir.'_field_multilang_checkbox.phtml',
////	                            'placement'     => false,
////	//                            'options'       => $options,
////	                            'value'         => $value,
////	                            'even'          => $even,
////	                        ),
////	                    ),
////	                )
////	            );
////	            $subFormTmp->addElement($tmpElement);
////            }
////        }
////
////        return $subFormTmp;
////    }
////
////
////    /**
////     *
////     *
////     * @return Zend_Form_Element_Text
////     */
////    protected function _buildRowTextareaField ($name, $value, $options)
////    {
////        $tmpElement = new Zend_Form_Element_Textarea(
////            $name,
////            array(
////                'disableLoadDefaultDecorators'  =>  true
////            )
////        );
////
////
//////        $tmpElement->setRequired(true);
//////
//////        $tmpElement->addFilter(
//////            new Zend_Filter_StripTags()
//////        );
//////        $tmpElement->addFilter(
//////            new Zend_Filter_StringTrim()
//////        );
//////        $tmpElement->addFilter(
//////            new Zend_Filter_Alnum()
//////        );
//////        $tmpElement->addFilter(
//////            new Zend_Filter_StringToLower(
//////                array(
//////                    'encoding' => 'UTF-8',
//////                )
//////            )
//////        );
////        $tmpElement->setValue($value);
////
////        //
////        $sort = null;
////
////        //
////        if ($options) {
////            foreach ($options as $optionName => $option) {
////                switch ($optionName) {
////                    case 'sort':
////                        $sort = $option;
////                        break;
////                    case 'even':
////                        $even = $option;
////                        break;
////                    case 'rows':
////                        $tmpElement->setAttrib('rows', $option);
////                        break;
////                    case 'cols':
////                        $tmpElement->setAttrib('cols', $option);
////                        break;
////                    case 'alphanumericFilter':
////                        $tmpElement->addFilter(
////                            new Zend_Filter_Alnum()
////                        );
////                        break;
//////                    case 'size':
//////                        $tmpElement->setAttrib('size', $option);
//////                        break;
////                    case 'length':
////                        $tmpElement->addValidators(
////                            array(
////                                array(
////                                    'stringLength',
////                                    false,
////                                    array(1, $option),
////                                ),
////                            )
////                        );
////                        $tmpElement->setAttrib('maxlength', $option);
////                        break;
////                    default:
////                        break;
////                }
////            }
////        }
////
////        $tmpElement->setDecorators(
////            array(
////                array('ViewHelper'),
////                array(
////                    'ViewScript',
////                    array(
////                        'viewScript'    => $this->_partialsDir.'_field_textarea.phtml',
////                        'placement'     => false,
////                        'sort'          => $sort,
////                        'even'          => $even,
////                    ),
////                ),
////            )
////        );
////
////        return $tmpElement;
////    }
////
////
////    /**
////     *
////     *
////     * @return Zend_Form_Element_Checkbox
////     */
////    protected function _buildRowCheckboxField($name, $value, $options)
////    {
////        //
////        $tmpElement = new Zend_Form_Element_Checkbox(
////            $name,
////            array(
////                'disableLoadDefaultDecorators'  =>  true
////            )
////        );
////
////        $tmpElement->setValue($value);
////
////        //
////        $sort = null;
////        $even = null;
////
////        //
////        if ($options) {
////            foreach ($options as $optionName => $option) {
////                switch ($optionName) {
////                    case 'sort':
////                        $sort = $option;
////                        break;
////                    case 'even':
////                        $even = $option;
////                        break;
////                    default:
////                        break;
////                }
////            }
////        }
////
////
////        $tmpElement->setDecorators(
////            array(
////                array('ViewHelper'),
////                array(
////                    'ViewScript',
////                    array(
////                        'viewScript'    =>  $this->_partialsDir.'_field_checkbox.phtml',
////                        'placement'     =>  false,
////                        'even'          =>  $even,
////                        'sort'          =>  $sort,
////                    ),
////                ),
////            )
////        );
////
////        return $tmpElement;
////    }

    /**
     *
     *
     * @return Zend_Form_Element_Submit
     */
    protected function _buildRowActionSubmit($name, $options = array())
    {
        $tmpElement = new Element\Submit(
            $name
        );

        if ($options) {
            foreach ($options as $optionName => $option) {
                switch ($optionName) {
                    case 'label':
                        $tmpElement->setLabel($option);
                        break;
                    case 'class':
                        $tmpElement->setAttrib('class', $option);
                        break;
                    case 'onclick':
                        if (strpos($option, '__ID__') !== false) {
                            $option = str_replace(
                                '__ID__',
                                $this->_currentRowIdValue,
                                $option
                            );
                        }
                        $tmpElement->setAttrib('onclick', $option);
                        break;
                    default:
                        break;
                }
            }
        }
//
//        $tmpElement->setDecorators(
//            array(
//                array('ViewHelper')
//            )
//        );

        return $tmpElement;
    }

//    /**
//     *
//     *
//     * @return Zend_Form_Element_Submit
//     */
//    protected function _buildRowActionImage($name, $options = array())
//    {
//
//        $tmpElement = new Element\Image(
//            $name
//        );
//
//        if ($options) {
//            foreach ($options as $optionName => $option) {
//                switch ($optionName) {
//                    case 'label':
//                        $tmpElement->setAttrib('title', $option);
//                        break;
//                    case 'class':
//                        $tmpElement->setAttrib('class', $option);
//                        break;
//                    case 'image':
//                        $tmpElement->setImage($option);
//                        break;
//                    case 'onclick':
//                        if (strpos($option, '__ID__') !== false) {
//                            $option = str_replace(
//                                '__ID__',
//                                $this->_currentRowIdValue,
//                                $option
//                            );
//                        }
//                        $tmpElement->setAttrib('onclick', $option);
//                        break;
//                    default:
//                        break;
//                }
//            }
//        }
//
////        $tmpElement->setDecorators(
////            array(
////                array('ViewHelper')
////            )
////        );
//
//        return $tmpElement;
//    }

    /**
     *
     *
     * @return Zend_Form_Element_Submit
     */
    protected function _buildResultSetActionSubmit($name, $options = array())
    {
        $tmpElement = new Element\Submit(
            $name,
            $options
        );

//        if ($options) {
//            foreach ($options as $optionName => $option) {
//                switch ($optionName) {
//                    case 'label':
//                        $tmpElement->setLabel($option);
//                        break;
//                    case 'class':
//                        $tmpElement->setAttrib('class', $option);
//                        break;
//                    default:
//                        break;
//                }
//            }
//        }
//
//        $tmpElement->setDecorators(
//            array(
//                array('ViewHelper'),
//            )
//        );

        return $tmpElement;
    }

    /**
     *
     *
     * @return Zend_Form_Element_Submit
     */
    protected function _buildResultSetActionImage($name, $options = array())
    {


        $tmpElement = new Element\Image(
            $name
        );

        if ($options) {
            foreach ($options as $optionName => $option) {
                switch ($optionName) {
                    case 'label':
                        $tmpElement->setAttrib('title', $option);
                        break;
                    case 'class':
                        $tmpElement->setAttrib('class', $option);
                        break;
                    case 'image':
                        $tmpElement->setImage($option);
                        break;
                    case 'onclick':
                        $tmpElement->setAttrib('onclick', $option);
                        break;
                    default:
                        break;
                }
            }
        }



        return $tmpElement;
    }
}