<?php
/**
 * Hi CMS
 *
 * @category   Hi
 * @package    Hi_Record
 * @copyright  Copyright (c) 2009 Piotr Maxymilian Socha
 * @license
 */

/** @see Hi_Record_SubForm */
//require_once 'Hi/Record/SubForm.php';

/**
 * Hi_Record_List
 *
 * @category   Hi
 * @package    Hi_Record
 * @copyright  Copyright (c) 2009 Piotr Maxymilian Socha
 * @license
 * @version    2.0
 */
class Hi_Record_SubForm_List extends Hi_Record_SubForm
{
    /**#@+
     * List id template
     */
    const DEFAULT_ID = 'listDefaultId';
    /**#@-*/

    /**#@+
     * List default partial decorator directory
     */
    const DEFAULT_PARTIALS_DIR = 'record/list/';
    /**#@-*/

    /**#@+
     * List default colspan (when list is rendered using
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
    protected $_partialsDir = Hi_Record_SubForm_List::DEFAULT_PARTIALS_DIR;

    /**
     * Title
     *
     * @var string
     */
    protected $_title = '';

    /**
     * Langs in use
     *
     * @var array
     */
    protected $_langs = array();

    /**
     * Current lang
     *
     * @var string
     */
    protected $_lang = '';


    /**
     * Elements of a row in a list
     *
     * @var array
     */
    protected $_fields = array();

    /**
     * Row actions
     *
     * @var array
     */
    protected $_recordActions = array();

    /**
     * Whole list actions
     *
     * @var array
     */
    protected $_listActions = array();

    /**
     * Whole list actions
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
     * Primary key is the susbset of row's data that's going to be used as a means
     * to identificate the row
     *
     * @var string
     */
    protected $_primaryKey = null;

    /**
     * Session that's used to remember sorting options
     *
     * @var Zend_Session_Namespace
     */
    protected $_listSession = null;

    /**
     * List colspan
     *
     * @var int
     */
    protected $_colspan = Hi_Record_SubForm_List::DEFAULT_COLSPAN;

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
     * Constructor.
     * Creates an instance of Hi_Record_SubForm_List
     *
     * @param array $options
     *
     * @return void
     */
    public function __construct($options = null)
    {
        //
        if (isset($options['title'])) {
            $this->_title = $options['title'];
            unset($options['title']);
        }

        //
        if (!isset($options['name'])) {
            $options['name'] = Hi_Record_SubForm_List::DEFAULT_ID . md5(microtime());
        }

        //
        if (isset($options['langs']) && is_array($options['langs']) && count($options['langs'])) {
            $this->_langs = $options['langs'];
            unset($options['langs']);
        }

        //
        if (isset($options['view']) && $options['view'] instanceof Zend_View) {
            $this->setView($options['view']);
            unset($options['view']);
        }


        //
        $this->_listSession = new Zend_Session_Namespace($options['name'] . 'ListSession');

        //
        if (!isset($this->_listSession->page)){
            $this->_listSession->page = 1;
        }

        //
        if (!isset($this->_listSession->perPage)){
            $this->_listSession->perPage = 10;
        }

        //
        if (!isset($this->_listSession->sortField)){
            $this->_listSession->sortField = null;
        }

        //
        if (!isset($this->_listSession->sortFieldDirection)){
            $this->_listSession->sortFieldDirection = null;
        }

        //
        if (!isset($this->_listSession->lang)){
            if (!isset($this->_langs) || !is_array($this->_langs) || !count($this->_langs)) {
                $langSess = new Zend_Session_Namespace('lang');
                $this->_listSession->lang = $langSess->lang;
            } else {
                $this->_listSession->lang = $this->_langs[0];
            }
        }

        //
        $this->_paginationAvailablePerPage = $this->_defaultAvailablePerPage;


        $options['disableLoadDefaultDecorators'] = true;

        parent::__construct($options);
    }

    /**
     *
     *
     * @return
     */
    public function processRequest($request)
    {
        $query = $request->getQuery();
        if (!$request->isPost()) {
            if (isset($query['form']) && $query['form'] == $this->getName()) {
                foreach ($query as $name => $value) {
                    switch($name) {
                        case 'p':
                            if ($value>=1) {
                                $this->_listSession->page = (int)$value;
                            }
                            break;
                        case 'perPage':
                            if (in_array($value, $this->_paginationAvailablePerPage)) {
                                $this->_listSession->perPage = (int)$value;
                                $this->_listSession->page = 1;
                            }
                            break;
                        case 'lang':
                            if (in_array($value, $this->_langs)) {
                                $this->_listSession->lang = $value;
                                $this->_listSession->page = 1;
                            }
                            break;
                        case 'sort':
                            if (!isset($this->_listSession->sortField)) {
                                $this->_listSession->sortField = $value;
                                $this->_listSession->sortFieldDirection = 'asc';
                            } else {
                                if ($this->_listSession->sortField == $value) {
                                    if ($this->_listSession->sortFieldDirection == 'asc') {
                                        $this->_listSession->sortFieldDirection = 'desc';
                                    } else if ($this->_listSession->sortFieldDirection == 'desc'){
                                        $this->_listSession->sortField = null;
                                        $this->_listSession->sortFieldDirection = null;
                                    }
                                } else {
                                    $this->_listSession->sortField = $value;
                                    $this->_listSession->sortFieldDirection = 'asc';
                                }
                            }
                            break;
                        default:
                            break;
                    }
                }
            }
        } else {
            $post = $request->getPost();
            if (isset($post[$this->getName()]['filter'])) {
                $filter = $post[$this->getName()]['filter'];
//                Zend_Debug::dump($filter);

                if (isset($filter['filterSubmit'])) {
                    unset($filter['filterSubmit']);
                    $this->_listSession->filter = $filter;

                } else if (isset($filter['filterReset'])) {
                    $this->_listSession->filter = null;
                }
            }

        }
    }

    /**
     * Adds a field to record list
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
            $position = 10*(count($this->_fields)+1);
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
            throw new Exception ('The $name param in Hi_Record_SubForm_List->removeField() should be a string!');
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
            throw new Exception ('The $names param in Hi_Record_SubForm_List->removeFields() should be an array!');
        }

        foreach ($this->_fields as $key => $field) {
            if (in_array($field['name'], $names)) {
                unset($this->_fields[$key]);
            }
        }
    }

    /**
     * Adds a list action to record list
     *
     * @param $name string
     * @param $type string
     * @param $options array
     * @param $position int
     *
     * @return void
     */
    public function addListAction($name, $type, $options, $position = null)
    {
        if ($name === null || $name == '') {
            throw new Exception("You must provide the name of the list action");
        }

        if ($type === null || $type == '') {
            throw new Exception("You must provide the type of the list action");
        }

        $actionTmp = array(
            'name'     => $name,
            'type'     => $type,
            'options'  => $options,
        );
        if ($position===null) {
            $position = 10*(count($this->_listActions)+1);
        }
        $this->_listActions[$position] = $actionTmp;
    }

    /**
     * Adds a record action to record list
     *
     * @param $name string
     * @param $type string
     * @param $options array
     * @param $position int
     *
     * @return void
     */
    public function addRecordAction($name, $type, $options, $position = null)
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
            $position = 10*(count($this->_recordActions)+1);
        }
        $this->_recordActions[$position] = $actionTmp;
    }


    /**
     *
     *
     * @param $name string
     * @param $type string
     * @param $options array
     * @param $position int
     *
     * @return void
     */
    public function addFilterField($name, $type, $options, $position = null)
    {
        if ($name === null || $name == '') {
            throw new Exception("You must provide the name of the filter");
        }

        if ($type === null || $type == '') {
            throw new Exception("You must provide the type of the filter");
        }

        $filterTmp = array(
            'name'     => $name,
            'type'     => $type,
            'options'  => $options,
        );
        if ($position===null) {
            $position = 10*(count($this->_filterFields)+1);
        }
        $this->_filterFields[$position] = $filterTmp;
    }

    /**
     * Sets the list elements data
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
     * @param $name string Primary key of the list items
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

        foreach ($this->_fields as $key => $field) {
            if ($field['name'] == $name) {
                if (is_array($field['options'])) {
                    $this->_fields[$key]['options'] += $options;
                } else {
                    $this->_fields[$key]['options'] = $options;
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


    /**
     *
     *
     *
     * @return string
     */
    public function getLang() {
        return $this->_listSession->lang;
    }

    /**
     *
     *
     *
     * @return void
     */
    public function setSortField($sortField) {
        $this->_listSession->sortField = $sortField;
    }

    /**
     *
     *
     *
     * @return string
     */
    public function getSortField() {
        return $this->_listSession->sortField;
    }

    /**
     *
     *
     *
     * @return void
     */
    public function setSortDirection($sortDirection) {
        $this->_listSession->sortFieldDirection = $sortDirection;
    }

    /**
     *
     *
     *
     * @return string
     */
    public function getSortDirection() {
        return $this->_listSession->sortFieldDirection;
    }

    /**
     * Set page number for pagination
     *
     * @param $page int
     *
     * @return void
     */
    public function setPage($page)
    {
        $this->_listSession->page = $page;
    }

    /**
     * Get page number for pagination
     *
     *
     * @return int
     */
    public function getPage()
    {
        return $this->_listSession->page;
    }

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

    /**
     * Sets the per page count for pagination
     *
     * @param $perPage int
     *
     * @return void
     */
    public function setPerPage($perPage)
    {
        $this->_listSession->perPage = $perPage;
    }

    /**
     * Gets the per page count for pagination
     *
     * @return int
     */
    public function getPerPage()
    {
        return $this->_listSession->perPage;
    }

    /**
     *
     *
     * @param $filter array
     *
     * @return void
     */
    public function setFilter($filter)
    {
        $this->_listSession->filter = $filter;
    }

    /**
     *
     *
     * @param $filter array
     *
     * @return void
     */
    public function addFilter($filter)
    {
        $tmpFilter = $this->_listSession->filter;
        $tmpFilter += $filter;
        $this->_listSession->filter = $filter;
    }

    /**
     *
     *
     * @return array
     */
    public function getFilter()
    {
        if (!count($this->_filterFields)) {
            $this->_listSession->filter = null;
        }
        return $this->_listSession->filter;
    }

    /**
     * Sets the available per page options
     *
     * @param $perPage int
     *
     * @return void
     */
    public function setAvailablePerPage($availablePerPage = array())
    {
        $this->_paginationAvailablePerPage = $availablePerPage;
    }

    /**
     *
     *
     *
     * @return array
     */
    public function getAvailablePerPage() {
        return $this->_paginationAvailablePerPage;
    }

    /**
     * Sets the row checkboxes
     *
     * @param $set bool
     *
     * @return void
     */
    public function setActiveRowCheckbox($set = true)
    {
        $this->_rowCheckBoxEnable = $set;
    }



    /**
     *
     *
     * @return void
     */
    public function init()
    {
        $this ->setDecorators(
            array(
                array('FormElements'),
                array(
                    'ViewScript',
                    array(
                        'viewScript'        => $this->_partialsDir.'_subForm.phtml',
                        'placement'         => false,
                        'colspan'           => $this->_colspan,
                        'subFormName'       => $this->_title,
                        'subFormId'         => $this->getName(),
                    ),
                ),
            )
        );

        $this->_view->headScript()->appendScript(
            $this->_view->render(
                $this->_partialsDir.'_subForm.js'
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
        $countRecordActions = count($this->_recordActions);

        $this->_colspan = ($this->_rowCheckBoxEnable?1:0) + ($countRecordActions?1:0) + count($this->_fields);

        $countDataRows = count($this->_data);

//        Zend_Debug::dump($this->_fields);

        /**
         * filter tab
         */
        if (count ($this->_filterFields)) {
            $this->addSubForm($this->_buildSubFormFilter(), 'filter');
        }

        /**
         * info tab
         */
        $this->addSubForm($this->_buildSubFormInfo(), 'info');

        /**
         * list header
         */
        $this->addSubForm($this->_buildSubFormHeader(), 'header');







        /**
         * rows
         */
        $listSubFormRows = new Zend_Form_SubForm(
            array('disableLoadDefaultDecorators' => true)
        );
        $listSubFormRows ->setDecorators(
            array(
                array('FormElements'),
            )
        );



        if ($countDataRows) {
            for( $i = 0 ; $i < $countDataRows ; $i++ ) {
                $dataRow = array();
                if (isset($this->_data[$i]))
                $dataRow = $this->_data[$i];
                $dataEven = ($i%2);
//                Zend_Debug::dump($this->_primaryKey);
//                Zend_Debug::dump($dataRow);
//                Zend_Debug::dump(isset($dataRow[$this->_primaryKey]));
//                Zend_Debug::dump((string)$dataRow[$this->_primaryKey]);
//                Zend_Debug::dump((string)($i+1));

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
                $recordRowSubForm = new Zend_Form_SubForm(
                    array('disableLoadDefaultDecorators' => true)
                );

                //
                $recordRowSubForm ->setDecorators(
                    array(
                        array('FormElements'),
                        array(
                            'ViewScript',
                            array(
                                'viewScript' => $this->_partialsDir . '_subForm_row.phtml',
                                'placement' => false,
                            ),
                        ),
                    )
                );

                /*
                 * every row has a checkbox to check
                 * when only particular row is needed
                 */
                if ($this->_rowCheckBoxEnable) {
                    $recordRowSubForm->addElement(
                        $this->_buildRowCheckbox(
                            $dataEven
                        )
                    );
                }



                /*
                 * item sub form (where actual elements will be)
                 */
                $recordRowItemSubForm = new Zend_Form_SubForm(
                    array('disableLoadDefaultDecorators' => true)
                );


                //
                $recordRowItemSubForm ->setDecorators(
                    array(
                        array('FormElements'),
                        array(
                            'ViewScript',
                            array(
                                'viewScript' => $this->_partialsDir.'_subForm_row_item.phtml',
                                'placement' => false,
                            ),
                        ),
                    )
                );


                /*
                 * list elements (fields)
                 */
                if ($this->_fields) {
                    foreach ($this->_fields as $position => $field) {
//                        Zend_Debug::dump($dataRow, '$dataRow');
//                        Zend_Debug::dump($field, 'field');
                        if ($field['name'] == $this->_listSession->sortField) {
                            $field['options']['sort'] = true;
                        }
                        $field['options']['even'] = $dataEven;

                        switch ($field['type']) {
                            case 'id':
                                $recordRowItemSubForm->addElement(
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
                                $recordRowItemSubForm->addElement(
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
                                $recordRowItemSubForm->addElement(
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
                                $recordRowItemSubForm->addSubForm(
                                    $this->_buildSubFormMultilangInput(
                                        $field['name'],
                                        isset($dataRow[$field['name']])
                                        ? $dataRow[$field['name']]
                                        : null,
                                        $field['options']
                                    ),
                                    $field['name']
                                );
                                break;
                            case 'textarea':
                                $recordRowItemSubForm->addElement(
                                    $this->_buildRowTextareaField(
                                        $field['name'],
                                        isset($dataRow[$field['name']])
                                        ? $dataRow[$field['name']]
                                        : null,
                                        $field['options']
                                    )
                                );
                                break;
                            case 'multilangTextarea':
                                $recordRowItemSubForm->addSubForm(
                                    $this->_buildSubFormMultilangTextarea(
                                        $field['name'],
                                        isset($dataRow[$field['name']])
                                        ? $dataRow[$field['name']]
                                        : null,
                                        $field['options']
                                    ),
                                    $field['name']
                                );
                                break;
                            case 'checkbox':
                                $recordRowItemSubForm->addElement(
                                    $this->_buildRowCheckboxField(
                                        $field['name'],
                                        isset($dataRow[$field['name']])
                                        ? $dataRow[$field['name']]
                                        : null,
                                        $field['options']
                                    )
                                );
                                break;
                            case 'multilangCheckbox':
                                $recordRowItemSubForm->addSubForm(
                                    $this->_buildSubFormMultilangCheckbox(
                                        $field['name'],
                                        isset($dataRow[$field['name']])
                                        ? $dataRow[$field['name']]
                                        : null,
                                        $field['options']
                                    ),
                                    $field['name']
                                );
                                break;
                            default:
                                $recordRowItemSubForm->addElement(
                                    $this->_buildRowDefaultField(
                                        $field['name'],
                                        isset($dataRow[$field['name']])
                                        ? $dataRow[$field['name']]
                                        : null,
                                        $field['options']
                                    )
                                );
                                break;
                        }
                    }
                }


                $recordRowSubForm->addSubForm($recordRowItemSubForm, 'row');



                /*
                 * row actions subform
                 */
                if (count($this->_recordActions)) {
                    $recordRowActionsSubForm = new Zend_Form_SubForm(
                        array('disableLoadDefaultDecorators' => true)
                    );


                    //
                    $recordRowActionsSubForm ->setDecorators(
                        array(
                            array('FormElements'),
                            array(
                                'ViewScript',
                                array(
                                    'viewScript'    =>  $this->_partialsDir.'_subForm_row_actions.phtml',
                                    'placement'     =>  false,
                                    'even'          =>  $dataEven,
                                ),
                            ),
                        )
                    );

                    /*
                     * row actions
                     */
                    if ($this->_recordActions && is_array($this->_recordActions)) {
                        foreach ($this->_recordActions as $key => $action) {
                            switch($action['type']) {
                                case 'submit':
                                    $recordRowActionsSubForm->addElement(
                                        $this->_buildRowActionSubmit(
                                            $action['name'],
                                            $action['options']
                                        )
                                    );
                                    break;
                                case 'image':
                                    $recordRowActionsSubForm->addElement(
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

                    $recordRowSubForm->addSubForm($recordRowActionsSubForm, 'actions');
                }
//                Zend_Debug::dump($sequenceKey, 'seq');
                $listSubFormRows->addSubForm($recordRowSubForm, $sequenceKey);
            }
        }

        $this->addSubForm($listSubFormRows, 'rows');


        /**
         * list paginator and langs
         */
        $this->addSubForm($this->_buildSubFormPaginatorAndLangs(), 'paginatorLangs');


        /**
         * list actions subform
         */
        $this->addSubForm($this->_buildSubFormListActions(), 'actions');

    }



    /**
     * Return the list elements names (or their labels)
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
     * Return the list elements that are sortable
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

    /**
     *
     *
     * @return Zend_Form_SubForm
     */
    protected function _buildSubFormFilter()
    {
        $listFilterSubForm = new Zend_Form_SubForm(
            array('disableLoadDefaultDecorators' => true)
        );

        $countFilters = count($this->_filterFields);


        $listFilterSubForm ->setDecorators(
            array(
                array('FormElements'),
                array(
                    'ViewScript',
                    array(
                        'viewScript'        => $this->_partialsDir.'_subForm_filter.phtml',
                        'placement'         => false,
                        'subFormId'         => $this->getName(),
                        'colspan'           => $this->_colspan,
                        'filterCount'       => $countFilters,

                    ),
                ),
            )
        );



        /**
         * filter fields
         */
        if ($countFilters) {
            ksort($this->_filterFields);
            $sessFilter = $this->_listSession->filter;
            foreach( $this->_filterFields as $position => $filter ) {
                $value = null;
                if (isset($sessFilter[$filter['name']])) {
                    $value = $sessFilter[$filter['name']];
                }
//                Zend_Debug::dump($filter, '$filter');
//                        if ($field['name'] == $this->_listSession->sortField) {
//                            $field['options']['sort'] = true;
//                        }
//                        $field['options']['even'] = $dataEven;

                switch ($filter['type']) {
//                            case 'id':
//                                $recordRowItemSubForm->addElement(
//                                    $this->_buildRowIdField(
//                                        $field['name'],
//                                        $dataRow[$field['name']],
//                                        $field['options']
//                                    )
//                                );
//                                break;
//                            case 'text':
//                                $recordRowItemSubForm->addElement(
//                                    $this->_buildRowTextField(
//                                        $field['name'],
//                                        $dataRow[$field['name']],
//                                        $field['options']
//                                    )
//                                );
//                                break;
//                            case 'input':
//                                $recordRowItemSubForm->addElement(
//                                    $this->_buildRowInputField(
//                                        $field['name'],
//                                        $dataRow[$field['name']],
//                                        $field['options']
//                                    )
//                                );
//                                break;
                    default:
                        $listFilterSubForm->addElement(
                            $this->_buildFilterDefaultField(
                                $filter['name'],
                                $value,
                                $filter['options']
                            )
                        );
                        break;
                }
            }
        }

        $listFilterSubForm->addElement(
            $this->_buildFilterActionSubmit(
                'filterSubmit',
                array(
                    'class' => 'actionSubmit',
                    'label' => $this->_view->translate('filterSubmit'),
                )
            )
        );

        $listFilterSubForm->addElement(
            $this->_buildFilterActionReset(
                'filterReset',
                array(
                    'class' => 'actionSubmit',
                    'label' => $this->_view->translate('filterReset'),
                )
            )
        );

        return $listFilterSubForm;
    }


    /**
     *
     *
     * @return Zend_Form_Element_Text
     */
    protected function _buildFilterDefaultField ($name, $value, $options)
    {
        $tmpElement = new Zend_Form_Element_Text(
            $name,
            array(
                'disableLoadDefaultDecorators'  =>  true
            )
        );

        //
        $tmpElement->setValue($value);


        //
        if ($options) {
            foreach ($options as $optionName => $option) {
                switch ($optionName) {
                    case 'label':
                        $tmpElement->setLabel($option);
                        break;
                    default:
                        break;
                }
            }
        }

        $tmpElement->setDecorators(
            array(
                array('ViewHelper'),
                array(
                    'ViewScript',
                    array(
                        'viewScript'    => $this->_partialsDir.'_filter_default.phtml',
                        'placement'     => false,
                    ),
                ),
            )
        );

        return $tmpElement;
    }

    /**
     *
     *
     * @return Zend_Form_Element_Submit
     */
    protected function _buildFilterActionSubmit($name, $options = array())
    {
        $tmpElement = new Zend_Form_Element_Submit(
            $name,
            array(
                'disableLoadDefaultDecorators'  =>  true
            )
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
                    default:
                        break;
                }
            }
        }

        $tmpElement->setDecorators(
            array(
                array('ViewHelper'),
                array(
                    'ViewScript',
                    array(
                        'viewScript'    => $this->_partialsDir.'_filter_action.phtml',
                        'placement'     => false,
                    ),
                ),
            )
        );

        return $tmpElement;
    }

    /**
     *
     *
     * @return Zend_Form_Element_Submit
     */
    protected function _buildFilterActionReset($name, $options = array())
    {
        $tmpElement = new Zend_Form_Element_Submit(
            $name,
            array(
                'disableLoadDefaultDecorators'  =>  true
            )
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
                    default:
                        break;
                }
            }
        }

        $tmpElement->setDecorators(
            array(
                array('ViewHelper'),
                array(
                    'ViewScript',
                    array(
                        'viewScript'    => $this->_partialsDir.'_filter_action.phtml',
                        'placement'     => false,
                    ),
                ),
            )
        );

        return $tmpElement;
    }

    /**
     *
     *
     * @return Zend_Form_SubForm
     */
    protected function _buildSubFormInfo()
    {
        $listInfoSubForm = new Zend_Form_SubForm(
            array('disableLoadDefaultDecorators' => true)
        );

        $countDataRows = count($this->_data);

        $listInfoSubForm ->setDecorators(
            array(
                array('FormElements'),
                array(
                    'ViewScript',
                    array(
                        'viewScript'        => $this->_partialsDir.'_subForm_info.phtml',
                        'placement'         => false,
                        'subFormId'         => $this->getName(),
                        'colspan'           => $this->_colspan,
                        'actionsTitle'      => Hi_Record_SubForm_List::DEFAULT_ACTIONS_TITLE,
                        'elementsCount'     => $countDataRows,
                        'elementsAllCount'  => $this->_paginationAllElementsCount,
                        'elementsFrom'      => $this->_listSession->perPage * ($this->_listSession->page - 1) + 1,
                        'elementsTo'        => ($this->_listSession->perPage * ($this->_listSession->page - 1)) + $countDataRows,
                        'perPage'           => $this->_listSession->perPage,
                        'availablePerPage'  => $this->_paginationAvailablePerPage,
                    ),
                ),
            )
        );

        return $listInfoSubForm;
    }

    /**
     *
     *
     * @return Zend_Form_SubForm
     */
    protected function _buildSubFormHeader()
    {
        $listHeaderSubForm = new Zend_Form_SubForm(
            array('disableLoadDefaultDecorators' => true)
        );

        $countRecordActions = count($this->_recordActions);

        $listHeaderSubForm ->setDecorators(
            array(
                array('FormElements'),
                array(
                    'ViewScript',
                    array(
                        'viewScript'        => $this->_partialsDir.'_subForm_header.phtml',
                        'placement'         => false,
                        'subFormId'         => $this->getName(),
                        'checkboxEnable'    => $this->_rowCheckBoxEnable,
                        'columnTitles'      => $this->_getColumnTitles(),
                        'columnSortable'    => $this->_getColumnSortable(),
                        'sortField'         => $this->_listSession->sortField,
                        'sortFieldDirection'=> $this->_listSession->sortFieldDirection,
                        'actions'           => $countRecordActions,
                        'actionsTitle'      => Hi_Record_SubForm_List::DEFAULT_ACTIONS_TITLE,
                    ),
                ),
            )
        );

        if ($this->_rowCheckBoxEnable) {
            $listHeaderSubForm->addElement($this->_buildAllCheckbox());
        }

        return $listHeaderSubForm;
    }

    /**
     *
     *
     * @return Zend_Form_SubForm
     */
    protected function _buildSubFormPaginatorAndLangs()
    {
        $recordListPaginatorLangsSubForm = new Zend_Form_SubForm(
            array('disableLoadDefaultDecorators' => true)
        );

        //
        $paginator = new Hi_Paginator();
        $paginator->setCurrentPage($this->_listSession->page);
        $paginator->setAllItemsCount($this->_paginationAllElementsCount);
        $paginator->setItemsPerPage($this->_listSession->perPage);
        $paginator->setLink('', '?form=' . $this->getName() . '&p=');

        //
        $recordListPaginatorLangsSubForm ->setDecorators(
            array(
                array('FormElements'),
                array(
                    'ViewScript',
                    array(
                        'viewScript'    => $this->_partialsDir.'_subForm_pagination_and_langs.phtml',
                        'placement'     => false,
                        'colspan'       => $this->_colspan,
                        'paginatorData' => $paginator->getBuildData(),
                        'subFormId'     => $this->getName(),
                        'langs'         => $this->_langs,
                        'lang'          => $this->_listSession->lang,
                    ),
                ),
            )
        );

        return $recordListPaginatorLangsSubForm;
    }

    /**
     *
     *
     * @return Zend_Form_SubForm
     */
    protected function _buildSubFormListActions()
    {
        $recordListActionsSubForm = new Zend_Form_SubForm(
            array('disableLoadDefaultDecorators' => true)
        );

        //
        $recordListActionsSubForm ->setDecorators(
            array(
                array('FormElements'),
                array(
                    'ViewScript',
                    array(
                        'viewScript'    => $this->_partialsDir.'_subForm_actions.phtml',
                        'placement'     => false,
                        'colspan'       => $this->_colspan,
                    ),
                ),
            )
        );

        /**
         * list actions
         */
        if ($this->_listActions && is_array($this->_listActions)) {
            foreach ($this->_listActions as $key => $action) {
                switch($action['type']) {
                    case 'submit':
                        $recordListActionsSubForm->addElement(
                            $this->_buildListActionSubmit(
                                $action['name'],
                                $action['options']
                            )
                        );
                        break;
                    case 'image':
                        $recordListActionsSubForm->addElement(
                            $this->_buildListActionImage(
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

        return $recordListActionsSubForm;
    }

    /**
     *
     *
     * @return Zend_Form_Element_Checkbox
     */
    protected function _buildAllCheckbox()
    {
        //
        $tmpElement = new Zend_Form_Element_Checkbox(
            'all',
            array(
                'disableLoadDefaultDecorators'  =>  true
            )
        );
        $tmpElement->setDecorators(
            array(
                array('ViewHelper'),
                array(
                    'ViewScript',
                    array(
                        'viewScript'    => $this->_partialsDir.'_field_checkbox_all.phtml',
                        'placement'     => false,
                    ),
                ),
            )
        );

        $tmpElement->setAttrib('onclick', 'checkAll(\'' . $this->getName() . '\');');
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
        $tmpElement = new Zend_Form_Element_Checkbox(
            'id',
            array(
                'disableLoadDefaultDecorators'  =>  true
            )
        );
        $tmpElement->setDecorators(
            array(
                array('ViewHelper'),
                array(
                    'ViewScript',
                    array(
                        'viewScript'    =>  $this->_partialsDir.'_field_checkbox_row.phtml',
                        'placement'     =>  false,
                        'even'          =>  $even,
                    ),
                ),
            )
        );

        return $tmpElement;
    }

    /**
     *
     *
     * @return Zend_Form_Element_Text
     */
    protected function _buildRowDefaultField ($name, $value, $options)
    {
        $tmpElement = new Zend_Form_Element_Text(
            $name,
            array(
                'disableLoadDefaultDecorators'  =>  true
            )
        );

        //
        $tmpElement->setLabel($value);

        //
        $sort = null;

        //
        if ($options) {
            foreach ($options as $optionName => $option) {
                switch ($optionName) {
                    case 'sort':
                        $sort = $option;
                        break;
                    case 'even':
                        $even = $option;
                        break;
                    default:
                        break;
                }
            }
        }

        $tmpElement->setDecorators(
            array(
                array(
                    'ViewScript',
                    array(
                        'viewScript'    => $this->_partialsDir.'_field_default.phtml',
                        'placement'     => false,
                        'sort'          => $sort,
                        'even'          =>  $even,
                    ),
                ),
            )
        );

        return $tmpElement;
    }

    /**
     *
     *
     * @return Zend_Form_Element_Text
     */
    protected function _buildRowIdField ($name, $value, $options)
    {
        $tmpElement = new Zend_Form_Element_Text(
            $name,
            array(
                'disableLoadDefaultDecorators'  =>  true
            )
        );

        //
        $tmpElement->setLabel($value);

        //
        $sort = null;

        //
        if ($options) {
            foreach ($options as $optionName => $option) {
                switch ($optionName) {
                    case 'sort':
                        $sort = $option;
                        break;
                    case 'even':
                        $even = $option;
                        break;
                    default:
                        break;
                }
            }
        }

        $tmpElement->setDecorators(
            array(
                array(
                    'ViewScript',
                    array(
                        'viewScript'    => $this->_partialsDir.'_field_id.phtml',
                        'placement'     => false,
                        'sort'          => $sort,
                        'even'          =>  $even,
                    ),
                ),
            )
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
        $tmpElement = new Zend_Form_Element_Text(
            $name,
            array(
                'disableLoadDefaultDecorators'  =>  true
            )
        );
//        $tmpElement->setRequired(true);
//
//        $tmpElement->addFilter(
//            new Zend_Filter_StripTags()
//        );
//        $tmpElement->addFilter(
//            new Zend_Filter_StringTrim()
//        );
//        $tmpElement->addFilter(
//            new Zend_Filter_Alnum()
//        );
//        $tmpElement->addFilter(
//            new Zend_Filter_StringToLower(
//                array(
//                    'encoding' => 'UTF-8',
//                )
//            )
//        );
        $tmpElement->setDescription($value);

        //
        $sort = null;

        //
        if ($options) {
            foreach ($options as $optionName => $option) {
                switch ($optionName) {
                    case 'sort':
                        $sort = $option;
                        break;
                    case 'even':
                        $even = $option;
                        break;
                    default:
                        break;
                }
            }
        }

        $tmpElement->setDecorators(
            array(
                array(
                    'ViewScript',
                    array(
                        'viewScript'    => $this->_partialsDir.'_field_text.phtml',
                        'placement'     => false,
                        'sort'          => $sort,
                        'even'          =>  $even,
                    ),
                ),
            )
        );

        return $tmpElement;
    }




    /**
     *
     *
     * @return Zend_Form_Element_Text
     */
    protected function _buildRowInputField ($name, $value, $options)
    {
        $tmpElement = new Zend_Form_Element_Text(
            $name,
            array(
                'disableLoadDefaultDecorators'  =>  true
            )
        );


//        $tmpElement->setRequired(true);
//
//        $tmpElement->addFilter(
//            new Zend_Filter_StripTags()
//        );
//        $tmpElement->addFilter(
//            new Zend_Filter_StringTrim()
//        );
//        $tmpElement->addFilter(
//            new Zend_Filter_Alnum()
//        );
//        $tmpElement->addFilter(
//            new Zend_Filter_StringToLower(
//                array(
//                    'encoding' => 'UTF-8',
//                )
//            )
//        );
        $tmpElement->setValue($value);

        //
        $sort = null;

        //
        if ($options) {
            foreach ($options as $optionName => $option) {
                switch ($optionName) {
                    case 'sort':
                        $sort = $option;
                        break;
                    case 'even':
                        $even = $option;
                        break;
                    case 'alphanumericFilter':
                        $tmpElement->addFilter(
                            new Zend_Filter_Alnum()
                        );
                        break;
                    case 'size':
                        $tmpElement->setAttrib('size', $option);
                        break;
                    case 'length':
                        $tmpElement->addValidators(
                            array(
                                array(
                                    'stringLength',
                                    false,
                                    array(1, $option),
                                ),
                            )
                        );
                        $tmpElement->setAttrib('maxlength', $option);
                        break;
                    default:
                        break;
                }
            }
        }

        $tmpElement->setDecorators(
            array(
                array('ViewHelper'),
                array(
                    'ViewScript',
                    array(
                        'viewScript'    => $this->_partialsDir.'_field_input.phtml',
                        'placement'     => false,
                        'sort'          => $sort,
                        'even'          => $even,
                    ),
                ),
            )
        );

        return $tmpElement;
    }


    /**
     *
     *
     */
    protected function _buildSubFormMultilangTextarea ($name, $value, $options)
    {
        /*
         * main row subform
         */
        $subFormTmp = new Zend_Form_SubForm(
            array('disableLoadDefaultDecorators' => true)
        );

        $even = 0;

        if ($options) {
            foreach ($options as $optionName => $option) {
                switch ($optionName) {
                    case 'sort':
                        $sort = $option;
                        break;
                    case 'even':
                        $even = $option;
                        break;
                    default:
                        break;
                }
            }
        }

        $subFormTmp ->setDecorators(
            array(
                array('FormElements'),
                array(
                    'ViewScript',
                    array(
                        'viewScript'        => $this->_partialsDir.'_subForm_multilang.phtml',
                        'placement'         => false,
                        'colspan'           => $this->_colspan,
                        'subFormName'       => $this->_title,
                        'subFormId'         => $this->getName(),
                        'name'              => $name,
                        'even'          => $even,
                    ),
                ),
            )
        );


        foreach ($this->_langs as $lang) {

        	//
        	if ($lang == $this->_listSession->lang) {

        		//
	            $tmpElement = new Zend_Form_Element_Textarea(
	                $lang,
	                array(
	                    'disableLoadDefaultDecorators'  =>  true
	                )
	            );

	            $tmpElement->setLabel($lang);

	            if (isset($value)) {
	            	if (is_array($value) && isset($value[$lang])) {
	                   $tmpElement->setValue($value[$lang]);
	            	} else {
	            		$tmpElement->setValue($value);
	            	}
	            }



	            $tmpElement->setAttrib('cols', 60);
	            $tmpElement->setAttrib('rows', 3);


	            $tmpElement->setDecorators(
	                array(
	                    array('ViewHelper'),
	                    array(
	                        'ViewScript',
	                        array(
	                            'viewScript'    => $this->_partialsDir . '_field_multilang_textarea.phtml',
	                            'placement'     => false,
	                            'options'       => $options,
	                            'value'         => $value,
	                            'even'          => $even,
	                        ),
	                    ),
	                )
	            );
	            $subFormTmp->addElement($tmpElement);
        	}
        }

        return $subFormTmp;
    }

    /**
     *
     *
     */
    protected function _buildSubFormMultilangInput ($name, $value, $options)
    {
        /*
         * main row subform
         */
        $subFormTmp = new Zend_Form_SubForm(
            array('disableLoadDefaultDecorators' => true)
        );

        $even = 0;

//            $tmpElement->setAttrib('cols', 60);
//            $tmpElement->setAttrib('rows', 3);

        if ($options) {
            foreach ($options as $optionName => $option) {
                switch ($optionName) {
                    case 'sort':
                        $sort = $option;
                        break;
                    case 'even':
                        $even = $option;
                        break;
                    default:
                        break;
                }
            }
        }

        $subFormTmp ->setDecorators(
            array(
                array('FormElements'),
                array(
                    'ViewScript',
                    array(
                        'viewScript'        => $this->_partialsDir.'_subForm_multilang.phtml',
                        'placement'         => false,
                        'colspan'           => $this->_colspan,
                        'subFormName'       => $this->_title,
                        'subFormId'         => $this->getName(),
                        'name'              => $name,
                        'even'          => $even,
                    ),
                ),
            )
        );

        foreach ($this->_langs as $lang) {

        	//
            if ($lang == $this->_listSession->lang) {

	            $tmpElement = new Zend_Form_Element_Text(
	                $lang,
	                array(
	                    'disableLoadDefaultDecorators'  =>  true
	                )
	            );
	            $tmpElement->setLabel($lang);

                if (isset($value)) {
                    if (is_array($value) && isset($value[$lang])) {
                       $tmpElement->setValue($value[$lang]);
                    } else {
                        $tmpElement->setValue($value);
                    }
                }



	            $tmpElement->setDecorators(
	                array(
	                    array('ViewHelper'),
	                    array(
	                        'ViewScript',
	                        array(
	                            'viewScript'    => $this->_partialsDir.'_field_multilang_input.phtml',
	                            'placement'     => false,
	                            'options'       => $options,
	                            'value'         => $value,
	                            'even'          => $even,
	                        ),
	                    ),
	                )
	            );
	            $subFormTmp->addElement($tmpElement);
            }
        }

        return $subFormTmp;
    }

    /**
     *
     *
     */
    protected function _buildSubFormMultilangCheckbox ($name, $value, $options)
    {
        /*
         * main row subform
         */
        $subFormTmp = new Zend_Form_SubForm(
            array('disableLoadDefaultDecorators' => true)
        );

        $even = 0;

//            $tmpElement->setAttrib('cols', 60);
//            $tmpElement->setAttrib('rows', 3);

        if ($options) {
            foreach ($options as $optionName => $option) {
                switch ($optionName) {
                    case 'sort':
                        $sort = $option;
                        break;
                    case 'even':
                        $even = $option;
                        break;
                    default:
                        break;
                }
            }
        }


        $subFormTmp ->setDecorators(
            array(
                array('FormElements'),
                array(
                    'ViewScript',
                    array(
                        'viewScript'        => $this->_partialsDir.'_subForm_multilang.phtml',
                        'placement'         => false,
                        'colspan'           => $this->_colspan,
                        'subFormName'       => $this->_title,
                        'subFormId'         => $this->getName(),
                        'name'              => $name,
                        'even'              => $even,
                    ),
                ),
            )
        );



        foreach ($this->_langs as $lang) {
//            Zend_Debug::dump($lang);

        	//
            if ($lang == $this->_listSession->lang) {

	            $tmpElement = new Zend_Form_Element_Checkbox(
	                $lang,
	                array(
	                    'disableLoadDefaultDecorators'  =>  true
	                )
	            );
	            $tmpElement->setLabel($lang);

                if (isset($value)) {
                    if (is_array($value) && isset($value[$lang])) {
                       $tmpElement->setValue($value[$lang]);
                    } else {
                        $tmpElement->setValue($value);
                    }
                }
	//            Zend_Debug::dump($tmpElement);



	            $tmpElement->setDecorators(
	                array(
	                    array('ViewHelper'),
	                    array(
	                        'ViewScript',
	                        array(
	                            'viewScript'    => $this->_partialsDir.'_field_multilang_checkbox.phtml',
	                            'placement'     => false,
	//                            'options'       => $options,
	                            'value'         => $value,
	                            'even'          => $even,
	                        ),
	                    ),
	                )
	            );
	            $subFormTmp->addElement($tmpElement);
            }
        }

        return $subFormTmp;
    }


    /**
     *
     *
     * @return Zend_Form_Element_Text
     */
    protected function _buildRowTextareaField ($name, $value, $options)
    {
        $tmpElement = new Zend_Form_Element_Textarea(
            $name,
            array(
                'disableLoadDefaultDecorators'  =>  true
            )
        );


//        $tmpElement->setRequired(true);
//
//        $tmpElement->addFilter(
//            new Zend_Filter_StripTags()
//        );
//        $tmpElement->addFilter(
//            new Zend_Filter_StringTrim()
//        );
//        $tmpElement->addFilter(
//            new Zend_Filter_Alnum()
//        );
//        $tmpElement->addFilter(
//            new Zend_Filter_StringToLower(
//                array(
//                    'encoding' => 'UTF-8',
//                )
//            )
//        );
        $tmpElement->setValue($value);

        //
        $sort = null;

        //
        if ($options) {
            foreach ($options as $optionName => $option) {
                switch ($optionName) {
                    case 'sort':
                        $sort = $option;
                        break;
                    case 'even':
                        $even = $option;
                        break;
                    case 'rows':
                        $tmpElement->setAttrib('rows', $option);
                        break;
                    case 'cols':
                        $tmpElement->setAttrib('cols', $option);
                        break;
                    case 'alphanumericFilter':
                        $tmpElement->addFilter(
                            new Zend_Filter_Alnum()
                        );
                        break;
//                    case 'size':
//                        $tmpElement->setAttrib('size', $option);
//                        break;
                    case 'length':
                        $tmpElement->addValidators(
                            array(
                                array(
                                    'stringLength',
                                    false,
                                    array(1, $option),
                                ),
                            )
                        );
                        $tmpElement->setAttrib('maxlength', $option);
                        break;
                    default:
                        break;
                }
            }
        }

        $tmpElement->setDecorators(
            array(
                array('ViewHelper'),
                array(
                    'ViewScript',
                    array(
                        'viewScript'    => $this->_partialsDir.'_field_textarea.phtml',
                        'placement'     => false,
                        'sort'          => $sort,
                        'even'          => $even,
                    ),
                ),
            )
        );

        return $tmpElement;
    }


    /**
     *
     *
     * @return Zend_Form_Element_Checkbox
     */
    protected function _buildRowCheckboxField($name, $value, $options)
    {
        //
        $tmpElement = new Zend_Form_Element_Checkbox(
            $name,
            array(
                'disableLoadDefaultDecorators'  =>  true
            )
        );

        $tmpElement->setValue($value);

        //
        $sort = null;
        $even = null;

        //
        if ($options) {
            foreach ($options as $optionName => $option) {
                switch ($optionName) {
                    case 'sort':
                        $sort = $option;
                        break;
                    case 'even':
                        $even = $option;
                        break;
                    default:
                        break;
                }
            }
        }


        $tmpElement->setDecorators(
            array(
                array('ViewHelper'),
                array(
                    'ViewScript',
                    array(
                        'viewScript'    =>  $this->_partialsDir.'_field_checkbox.phtml',
                        'placement'     =>  false,
                        'even'          =>  $even,
                        'sort'          =>  $sort,
                    ),
                ),
            )
        );

        return $tmpElement;
    }

    /**
     *
     *
     * @return Zend_Form_Element_Submit
     */
    protected function _buildRowActionSubmit($name, $options = array())
    {
        $tmpElement = new Zend_Form_Element_Submit(
            $name,
            array(
                'disableLoadDefaultDecorators'  =>  true
            )
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
                    default:
                        break;
                }
            }
        }

        $tmpElement->setDecorators(
            array(
                array('ViewHelper')
            )
        );

        return $tmpElement;
    }

    /**
     *
     *
     * @return Zend_Form_Element_Submit
     */
    protected function _buildRowActionImage($name, $options = array())
    {
        $tmpElement = new Zend_Form_Element_Image(
            $name,
            array(
                'disableLoadDefaultDecorators'  =>  true
            )
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

        $tmpElement->setDecorators(
            array(
                array('ViewHelper')
            )
        );

        return $tmpElement;
    }

    /**
     *
     *
     * @return Zend_Form_Element_Submit
     */
    protected function _buildListActionSubmit($name, $options = array())
    {
        $tmpElement = new Zend_Form_Element_Submit(
            $name,
            array(
                'disableLoadDefaultDecorators'  =>  true
            )
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
                    default:
                        break;
                }
            }
        }

        $tmpElement->setDecorators(
            array(
                array('ViewHelper'),
            )
        );

        return $tmpElement;
    }

    /**
     *
     *
     * @return Zend_Form_Element_Submit
     */
    protected function _buildListActionImage($name, $options = array())
    {
        $tmpElement = new Zend_Form_Element_Image(
            $name,
            array(
                'disableLoadDefaultDecorators'  =>  true
            )
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

        $tmpElement->setDecorators(
            array(
                array('ViewHelper')
            )
        );

        return $tmpElement;
    }
}