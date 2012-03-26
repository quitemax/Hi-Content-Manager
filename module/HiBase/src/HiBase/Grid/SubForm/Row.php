<?php
/**
 * Hi CMS
 *
 * @category   Hi
 * @package    Hi_Grid
 * @copyright  Copyright (c) 2009 Piotr Maxymilian Socha
 * @license
 */

namespace Hi\Grid\SubForm;

use Hi\Grid\Element\CheckboxRow,
    Hi\Grid\SubForm as GridSubForm,
    Zend\Session\Container as SessionContainer,
    Hi\Paginator\Paginator,
    Hi\Grid\Element;

/**
 *Row
 *
 * @category   Hi
 * @package    Hi_Grid
 * @copyright  Copyright (c) 2009 Piotr Maxymilian Socha
 * @license
 * @version    2.0
 */
class Row extends GridSubForm
{
    /**#@+
     * Row id template
     */
	const DEFAULT_ID = 'rowUnsetId';
	/**#@-*/

	/**#@+
     * Rows default partial decorator directory
     */
	const DEFAULT_PARTIALS_DIR = '_grid/_row';
	/**#@-*/

	/**#@+
     * List default colspan ( when list is rendered using
     * <table>, <tr>, <td> i.e. )
     */
    const DEFAULT_COLSPAN = 2;
    /**#@-*/

	/**
	 * Partial decorator directory
	 *
     * @var string
     */
    protected $_partialsDir = self::DEFAULT_PARTIALS_DIR;



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
	 * Elements of a row
	 *
	 * @var array
	 */
    protected $_fields = array();

    /**
     * Row's actions
     *
     * @var array
     */
    protected $_actions = array();

    /**
     * colspan
     *
     *  @var int
     */
    protected $_colspan = self::DEFAULT_COLSPAN;

    /**
     * Primary key is the susbset of row's data that's going to be used as a means
     * to identificate the row
     *
     * @var string
     */
    protected $_primaryKey = null;

    /**
     * Row values data
     *
     * @var array
     */
    protected $_data = null;

    /**
     *
     *
     * @var int
     */
    protected $_dataPrimaryKeyValue = null;

    /**
     * Set form state from options array
     *
     * @param  array $options
     * @return Form
     */
    public function setOptions(array $options)
    {
        //
        if (isset($options['title'])) {
            $this->_title = $options['title'];
            unset($options['title']);
        }
//
//        //
//        if (!isset($options['name'])) {
//            $options['name'] = Hi_Record_SubForm_Row::DEFAULT_ID . md5(microtime());
//        }



//        if (!isset($this->_name) || trim($this->_name) == '') {
//            $this->_name = self::DEFAULT_ID . md5(microtime());
//        }


        return parent::setOptions($options);
    }

    public function init()
    {
        parent::init();



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

//        $this->_setup();
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
//
//    /**
//     * Creates an instance of Hi_Record_SubForm_Row
//     *
//     * @param $options array
//     *
//     * @return null
//     */
//    public function __construct($options = null)
//    {
//
//
//        //
//        if (isset($options['langs']) && is_array($options['langs']) && count($options['langs'])) {
//            $this->_langs = $options['langs'];
//            unset($options['langs']);
//        }
//
//        //
//        if (isset($options['view']) && $options['view'] instanceof Zend_View) {
//            $this->setView($options['view']);
//            unset($options['view']);
//        }
//
//        parent::__construct($options);
//
//    }

    /**
     * Sets the primary key of the elements data
     *
     * @param $name string Primary key of the row
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
     * @param
     *
     * @return void
     */
    public function setRowId($id)
    {
        $this->_dataPrimaryKeyValue = $id;
    }

    /**
     * Adds a field to record item
     *
     * @param $name string
     * @param $type string
     * @param $options array
     * @param $position int
     *
     * @return
     */
    public function addField($name, $type, $options = null, $position = null) {
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
     * @param $options array
     *
     * @return
     */
    public function addFieldOptions($name, $options) {
        if (!is_array($options)) {
            throw new Exception ('The options param in Hi_Record_SubForm_Row->addFieldOptions() should be an array!');
        }
//\HiZend\Debug\Debug::precho($this->_fields);
        foreach ($this->_fields as $key => $field) {
            if ($field['name'] == $name) {
                if (is_array($field['options'])) {
                    $this->_fields[$key]['options'] += $options;
                } else {
                    $this->_fields[$key]['options'] = $options;
                }
            }
        }
//        \HiZend\Debug\Debug::precho($this->_fields);
    }

    /**
     *
     *
     * @param $name string
     * @param $options array
     *
     * @return
     */
    public function setField($name, $type = null, $options = null, $position = null) {
        if (!is_string($name)) {
            throw new Exception ('The $name param in Hi_Record_SubForm_Row->removeField() should be a string!');
        }

        foreach ($this->_fields as $key => $field) {
            if ($field['name'] == $name) {
                if ($type !== null) {
                    $this->_fields[$key]['type'] = $type;
                }

                if ($options !== null && is_array($options)) {
                    if (is_array($field['options'])) {
                        $this->_fields[$key]['options'] += $options;
                    } else {
                        $this->_fields[$key]['options'] = $options;
                    }
                }

                if ($position !== null) {
                    $tmpField = $this->_fields[$key];
                    unset($this->_fields[$key]);
                    $this->_fields[(int)$position] = $tmpField;
                }

                break;
            }
        }
    }

    /**
     *
     *
     * @param $name string
     *
     * @return void
     */
    public function removeField($name) {
        if (!is_string($name)) {
            throw new Exception ('The $name param in Hi_Record_SubForm_Row->removeField() should be a string!');
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
            throw new Exception ('The $names param in Hi_Record_SubForm_Row->removeFields() should be an array!');
        }

        foreach ($this->_fields as $key => $field) {
            if (in_array($field['name'], $names)) {
                unset($this->_fields[$key]);
            }
        }
    }

    /**
     * Adds a field to record item
     *
     * @param $name string
     * @param $type string
     * @param $options array
     * @param $position int
     *
     * @return
     */
    public function addAction($name, $type, $options, $position = null) {
        $actionTmp = array(
            'name'     => $name,
            'type'     => $type,
            'options'  => $options,
        );
        if ($position===null) {
            $position = 10*(count($this->_actions)+1);
        }
        $this->_actions[$position] = $actionTmp;
    }

    /**
     * Sets the row element data
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
     * Builds
     *
     * @return Zend_Form_SubForm
     */
    public function build()
    {



        /*
         * Fields subform
         */
        $rowSubform = new GridSubForm();
        $rowSubform ->setDecorators(
            array(
                array('FormElements'),
                array(
                    'ViewScript',
                    array(
                        'viewScript' => $this->_partialsDir . '/_subForm_row.phtml',
                        'placement' => false,
                    ),
                ),
            )
        );

        ksort($this->_fields);

        $i=0;
        foreach ($this->_fields as $key => $field) {
            //
            $dataEven = ($i%2);
            $field['options']['even'] = $dataEven;
//            \HiZend\Debug\Debug::dump($field['name']);
//            \HiZend\Debug\Debug::dump($this->_data[$field['name']]);
            //
            $value = null;
            if (isset($this->_data[$field['name']]) && $this->_data[$field['name']] !== null) {
                $value = $this->_data[$field['name']];
            } else if (isset($field['options']['value'])){
                $value = $field['options']['value'];
            } else if (isset($field['options']['defaultValue'])){
                $value = $field['options']['defaultValue'];
            }
//            \HiZend\Debug\Debug::dump($field['name']);
//            \HiZend\Debug\Debug::dump($value);
        	//
            switch ($field['type']) {
                case 'id':
                    if ($this->_dataPrimaryKeyValue) {
                        $rowSubform->addElement(
                            $this->_buildFieldId(
                                $field['name'],
                                $value,
                                $field['options']
                            )
                        );
                    }
                    break;
                case 'username':
//                    $rowSubform->addElement(
//                        $this->_buildFieldUsername(
//                            $field['name'],
//                            $value,
//                            $field['options']
//                        )
//                    );
                    break;
                case 'password':
//                    $rowSubform->addElement(
//                        $this->_buildFieldPassword(
//                            $field['name'],
//                            $value,
//                            $field['options']
//                        )
//                    );
                    break;
                case 'text':
//                    $rowSubform->addElement(
//                        $this->_buildFieldText(
//                            $field['name'],
//                            $value,
//                            $field['options']
//                        )
//                    );
                    break;
                case 'hidden':
                    $rowSubform->addElement(
                        $this->_buildFieldHidden(
                            $field['name'],
                            $value,
                            $field['options']
                        )
                    );
                    break;
                case 'checkbox':
//                    $rowSubform->addElement(
//                        $this->_buildFieldCheckbox(
//                            $field['name'],
//                            $value,
//                            $field['options']
//                        )
//                    );
                    break;
                case 'input':
                    $rowSubform->addElement(
                        $this->_buildFieldInput(
                            $field['name'],
                            $value,
                            $field['options']
                        )
                    );
                    break;
                case 'textarea':
//                    $rowSubform->addElement(
//                        $this->_buildFieldText(
//                            $field['name'],
//                            $value,
//                            $field['options']
//                        )
//                    );
                    break;
                case 'select':
                    $rowSubform->addElement(
                        $this->_buildFieldSelect(
                            $field['name'],
                            $value,
                            $field['options']
                        )
                    );
                    break;
                case 'multilangText':
//                    $rowSubform->addElement(
//                        $this->_buildFieldText(
//                            $field['name'],
//                            $value,
//                            $field['options']
//                        )
//                    );
                    break;
                case 'multilangCheckbox':
//                    $rowSubform->addSubForm(
//                        $this->_buildSubFormMultilangCheckbox(
//                            $field['name'],
//                            $value,
//                            $field['options']
//                        ),
//                        $field['name']
//                    );
                    break;
                case 'multilangInput':
//                    $rowSubform->addSubForm(
//                        $this->_buildSubFormMultilangInput(
//                            $field['name'],
//                            $value,
//                            $field['options']
//                        ),
//                        $field['name']
//                    );
                    break;
                case 'multilangTextarea':
//                    $rowSubform->addSubForm(
//                        $this->_buildSubFormMultilangTextarea(
//                            $field['name'],
//                            $value,
//                            $field['options']
//                        ),
//                        $field['name']
//                    );
//                    break;


                case 'tinyint':
                	break;
                default:
                	break;

            }
            $i++;
        }

        $this->addSubForm($rowSubform, 'row');


        /*
         * Actions subform
         */
        if (count($this->_actions)) {
        	//
        	$actionSubform = new GridSubForm();
            //$actionSubform->setDescription(isset($this->_actionsTitle)?$this->_actionsTitle:'Actions');
            $actionSubform ->setDecorators(
                array(
                    array('FormElements'),
                    array(
                        'ViewScript',
                        array(
                            'viewScript' => $this->_partialsDir . '/_subForm_actions.phtml',
                            'placement' => false,
//                            'options' => $options
                        ),
                    ),
                )
            );


	        foreach ($this->_actions as $key => $action) {
            //
	            switch ($action['type']) {
	                case 'submit':
	                    $actionSubform->addElement($this->_buildActionSubmit($action['name'], $value, $action['options']));
	                    break;
	                case 'image':
//                        $actionSubform->addElement($this->_buildActionImage($action['name'], $value, $action['options']));
                        break;
	                default:
	                    break;

	            }
	        }

	        $this->addSubForm($actionSubform, 'actions');

        }
    }

    /**
     *
     *
     */
    protected function _buildFieldId ($name, $value, $options)
    {
        $options['viewScript'] = $this->_partialsDir . '/_field_id.phtml';
        $options['description'] = $value;

//\HiZend\Debug\Debug::dump($options);

        $tmpElement = new Element\Text(
            $name,
            $options
        );
//        \HiZend\Debug\Debug::dump($tmpElement);
//        $tmpElement->setValue($value);

//        $tmpElement->setValue($value);
//
//        $even = 0;
//
//        if ($options) {
//            foreach ($options as $optionName => $option) {
//                switch ($optionName) {
//                    case 'label':
//                        $tmpElement->setLabel($option);
//                        break;
//                    case 'even':
//                        $even = $option;
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
//                array(
//                    'ViewScript',
//                    array(
//                        'viewScript'    => $this->_partialsDir.'_field_id.phtml',
//                        'placement'     => false,
//                        'options'       => $options,
//                        'value'         => $value,
//                        'even'          => $even,
//                    ),
//                ),
//            )
//        );

        return $tmpElement;
    }


//    /**
//     *
//     *
//     */
//    protected function _buildFieldPassword ($name, $value, $options)
//    {
//        $tmpElement = new Zend_Form_Element_Password(
//            $name,
//            array(
//                'disableLoadDefaultDecorators'  =>  true
//            )
//        );
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
//
//        $even = 0;
//
//        if ($options) {
//            foreach ($options as $optionName => $option) {
//                switch ($optionName) {
//                    case 'label':
//                        $tmpElement->setLabel($option);
//                        break;
//                    case 'even':
//                        $even = $option;
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
//                array(
//                    'ViewScript',
//                    array(
//                        'viewScript'    => $this->_partialsDir.'_field_password.phtml',
//                        'placement'     => false,
//                        'even'          => $even,
////                        'options'       => $options,
//                    ),
//                ),
//            )
//        );
//
//        return $tmpElement;
//    }
//
//    /**
//     *
//     *
//     */
//    protected function _buildFieldUsername ($name, $value, $options)
//    {
//        $tmpElement = new Zend_Form_Element_Text(
//            $name,
//            array(
//                'disableLoadDefaultDecorators'  =>  true
//            )
//        );
//        $tmpElement->setRequired(true);
//
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
//
//        $even = 0;
//
//        if ($options) {
//            foreach ($options as $optionName => $option) {
//                switch ($optionName) {
//                    case 'label':
//                        $tmpElement->setLabel($option);
//                        break;
//                    case 'length':
//                        $tmpElement->addValidators(
//                            array(
//                                array(
//                                    'stringLength',
//                                    false,
//                                    array(3, $option),
//                                ),
//                            )
//                        );
//                        $tmpElement->setAttrib('maxlength', $option);
//                        break;
//                    default:
//                        break;
//                }
//            }
//        }
//
//
////        $options = array(/*'colspan' => count($this->_actions), 'title'=> 'titleElement', 'value' => 'grey_10', "row"=>"rowElement"*/);
//        $tmpElement->setDecorators(
//            array(
//                array('ViewHelper'),
//                array(
//                    'ViewScript',
//                    array(
//                        'viewScript'    => $this->_partialsDir.'_field_username.phtml',
//                        'placement'     => false,
//                        'options'       => $options,
//                        'even'          => $even,
//                    ),
//                ),
//            )
//        );
////        $tmpElement = new Zend_Form_Element_Text($fieldName);
////                    $tmpElement->setValue(isset($rowData[$fieldName])?$rowData[$fieldName]:'');
////                    $tmpElement->setLabel(isset($this->_columnTitles[$fieldName])?$this->_columnTitles[$fieldName]:$fieldName);
////                    if (isset($this->_columnAttribs[$fieldName]) && is_array($this->_columnAttribs[$fieldName])) {
////                      $tmpElement->setAttribs($this->_columnAttribs[$fieldName]);
////                    }
////                    $tmpElement->setAttribs(array('size'=> (int)($fieldData['LENGTH']/2.3)));
////                    $options = array('colspan' => count($this->_actions), 'title'=> 'titleElement', 'value' => 'grey_10', "row"=>"rowElement");
////                    $tmpElement->setDecorators(array( array('ViewHelper'),
////                                                        array('ViewScript', array('viewScript' => $this->_partialDir.'_field_text.phtml', 'placement' => false, 'options' => $options))));
////
////                    $tmpSubform -> addElement($tmpElement);
////                    break;
//        return $tmpElement;
//    }
//

    /**
     *
     *
     */
    protected function _buildFieldHidden ($name, $value, $options)
    {
        $options['viewScript'] = $this->_partialsDir . '/_field_hidden.phtml';
        $options['value'] = $value;

        $tmpElement = new Element\Hidden(
            $name,
            $options
        );

//        \HiZend\Debug\Debug::precho($name);

//        $even = 0;
//
//        if ($options) {
//            foreach ($options as $optionName => $option) {
//                switch ($optionName) {
//                    case 'label':
//                        $tmpElement->setLabel($option);
//                        break;
//                    case 'even':
//                        $even = $option;
//                        break;
//                    case 'value':
//                        $value = $option;
//                        break;
//                    default:
//                        break;
//                }
//            }
//        }
//
//        $tmpElement->setValue($value);
//
//        $tmpElement->setDecorators(
//            array(
//                array('ViewHelper'),
//                array(
//                    'ViewScript',
//                    array(
//                        'viewScript'    => $this->_partialsDir.'_field_hidden.phtml',
//                        'placement'     => false,
//                        'options'       => $options,
//                        'value'         => $value,
//                        'even'          => $even,
//                    ),
//                ),
//            )
//        );



        return $tmpElement;
    }

    /**
     *
     *
     */
    protected function _buildFieldSelect ($name, $value, $options)
    {

        $options['viewScript'] = $this->_partialsDir . '/_field_select.phtml';
        $options['value'] = $value;

//        \HiZend\Debug\Debug::precho($options);

        $tmpElement = new Element\Select(
            $name,
            $options
        );
//\HiZend\Debug\Debug::precho($tmpElement);


//        $even = 0;
//
//        if ($options) {
//            foreach ($options as $optionName => $option) {
//                switch ($optionName) {
//                    case 'label':
//                        $tmpElement->setLabel($option);
//                        break;
//                    case 'even':
//                        $even = $option;
//                        break;
//                    case 'values':
//                        $tmpElement->setMultiOptions($option);
//                        break;
//                    case 'value':
//                        $value = $option;
//                        break;
////                    case 'alphanumericFilter':
////                        $tmpElement->addFilter(
////                            new Zend_Filter_Alnum()
////                        );
////                        break;
////                    case 'size':
////                        $tmpElement->setAttrib('size', $option);
////                        break;
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
//                    default:
//                        break;
//                }
//            }
//        }

        $tmpElement->setValue($value);


        return $tmpElement;
    }
//
//
//
//    /**
//     *
//     *
//     */
//    protected function _buildFieldText ($name, $value, $options)
//    {
//        $tmpElement = new Zend_Form_Element_Text(
//            $name,
//            array(
//                'disableLoadDefaultDecorators'  =>  true
//            )
//        );
//
//        $even = 0;
//
//        if ($options) {
//            foreach ($options as $optionName => $option) {
//                switch ($optionName) {
//                    case 'label':
//                        $tmpElement->setLabel($option);
//                        break;
//                    case 'even':
//                        $even = $option;
//                        break;
//                    case 'value':
//                        $value = $option;
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
//                array(
//                    'ViewScript',
//                    array(
//                        'viewScript'    => $this->_partialsDir.'_field_text.phtml',
//                        'placement'     => false,
//                        'options'       => $options,
//                        'value'         => $value,
//                        'even'          => $even,
//                    ),
//                ),
//            )
//        );
//
//        return $tmpElement;
//    }
//
//    /**
//     *
//     *
//     */
//    protected function _buildSubFormMultilangTextarea ($name, $value, $options)
//    {
//        /*
//         * main row subform
//         */
//        $subFormTmp = new Zend_Form_SubForm(
//            array('disableLoadDefaultDecorators' => true)
//        );
//
//        $even = 0;
//
//        if ($options) {
//            foreach ($options as $optionName => $option) {
//                switch ($optionName) {
//                    case 'even':
//                        $even = $option;
//                        break;
//                    default:
//                        break;
//                }
//            }
//        }
//
//        $subFormTmp ->setDecorators(
//            array(
//                array('FormElements'),
//                array(
//                    'ViewScript',
//                    array(
//                        'viewScript'        => $this->_partialsDir.'_subForm_multilang.phtml',
//                        'placement'         => false,
//                        'colspan'           => $this->_colspan,
//                        'subFormName'       => $this->_title,
//                        'subFormId'         => $this->getName(),
//                        'name'              => $name,
//                        'even'          => $even,
//                    ),
//                ),
//            )
//        );
//
//        foreach ($this->_langs as $lang) {
//            $tmpElement = new Zend_Form_Element_Textarea(
//                $lang,
//                array(
//                    'disableLoadDefaultDecorators'  =>  true
//                )
//            );
//            $tmpElement->setLabel($lang);
//            if (isset($value[$lang])) {
//                $tmpElement->setValue($value[$lang]);
//            }
//
//
//
//            $tmpElement->setAttrib('cols', 60);
//            $tmpElement->setAttrib('rows', 3);
//
//
//            $tmpElement->setDecorators(
//                array(
//                    array('ViewHelper'),
//                    array(
//                        'ViewScript',
//                        array(
//                            'viewScript'    => $this->_partialsDir.'_field_multilang_textarea.phtml',
//                            'placement'     => false,
//                            'options'       => $options,
//                            'value'         => $value,
//                            'even'          => $even,
//                        ),
//                    ),
//                )
//            );
//            $subFormTmp->addElement($tmpElement);
//        }
//
//        return $subFormTmp;
//    }
//
//    /**
//     *
//     *
//     */
//    protected function _buildSubFormMultilangInput ($name, $value, $options)
//    {
//        /*
//         * main row subform
//         */
//        $subFormTmp = new Zend_Form_SubForm(
//            array('disableLoadDefaultDecorators' => true)
//        );
//
//        $even = 0;
//
////            $tmpElement->setAttrib('cols', 60);
////            $tmpElement->setAttrib('rows', 3);
//
//        if ($options) {
//            foreach ($options as $optionName => $option) {
//                switch ($optionName) {
//                    case 'even':
//                        $even = $option;
//                        break;
//                    default:
//                        break;
//                }
//            }
//        }
//
//        $subFormTmp ->setDecorators(
//            array(
//                array('FormElements'),
//                array(
//                    'ViewScript',
//                    array(
//                        'viewScript'        => $this->_partialsDir.'_subForm_multilang.phtml',
//                        'placement'         => false,
//                        'colspan'           => $this->_colspan,
//                        'subFormName'       => $this->_title,
//                        'subFormId'         => $this->getName(),
//                        'name'              => $name,
//                        'even'          => $even,
//                    ),
//                ),
//            )
//        );
//
//        foreach ($this->_langs as $lang) {
//            $tmpElement = new Zend_Form_Element_Text(
//                $lang,
//                array(
//                    'disableLoadDefaultDecorators'  =>  true
//                )
//            );
//            $tmpElement->setLabel($lang);
//            if (isset($value[$lang])) {
//                $tmpElement->setValue($value[$lang]);
//            }
//
//
//
//            $tmpElement->setDecorators(
//                array(
//                    array('ViewHelper'),
//                    array(
//                        'ViewScript',
//                        array(
//                            'viewScript'    => $this->_partialsDir.'_field_multilang_input.phtml',
//                            'placement'     => false,
//                            'options'       => $options,
//                            'value'         => $value,
//                            'even'          => $even,
//                        ),
//                    ),
//                )
//            );
//            $subFormTmp->addElement($tmpElement);
//        }
//
//        return $subFormTmp;
//    }
//
//    /**
//     *
//     *
//     */
//    protected function _buildSubFormMultilangCheckbox ($name, $value, $options)
//    {
//        /*
//         * main row subform
//         */
//        $subFormTmp = new Zend_Form_SubForm(
//            array('disableLoadDefaultDecorators' => true)
//        );
//
//        $even = 0;
//
////            $tmpElement->setAttrib('cols', 60);
////            $tmpElement->setAttrib('rows', 3);
//
//        if ($options) {
//            foreach ($options as $optionName => $option) {
//                switch ($optionName) {
//                    case 'even':
//                        $even = $option;
//                        break;
//                    default:
//                        break;
//                }
//            }
//        }
//
//
//        $subFormTmp ->setDecorators(
//            array(
//                array('FormElements'),
//                array(
//                    'ViewScript',
//                    array(
//                        'viewScript'        => $this->_partialsDir.'_subForm_multilang.phtml',
//                        'placement'         => false,
//                        'colspan'           => $this->_colspan,
//                        'subFormName'       => $this->_title,
//                        'subFormId'         => $this->getName(),
//                        'name'              => $name,
//                        'even'          => $even,
//                    ),
//                ),
//            )
//        );
//
//
//
//        foreach ($this->_langs as $lang) {
////            Zend_Debug::dump($lang);
//            $tmpElement = new Zend_Form_Element_Checkbox(
//                $lang,
//                array(
//                    'disableLoadDefaultDecorators'  =>  true
//                )
//            );
//            $tmpElement->setLabel($lang);
//            if (isset($value[$lang])) {
//                $tmpElement->setValue($value[$lang]);
//            }
////            Zend_Debug::dump($tmpElement);
//
//
//
//            $tmpElement->setDecorators(
//                array(
//                    array('ViewHelper'),
//                    array(
//                        'ViewScript',
//                        array(
//                            'viewScript'    => $this->_partialsDir.'_field_multilang_checkbox.phtml',
//                            'placement'     => false,
////                            'options'       => $options,
//                            'value'         => $value,
//                            'even'          => $even,
//                        ),
//                    ),
//                )
//            );
//            $subFormTmp->addElement($tmpElement);
//        }
//
//        return $subFormTmp;
//    }
//
//    /**
//     *
//     *
//     */
//    protected function _buildFieldCheckbox ($name, $value, $options)
//    {
//        $tmpElement = new Zend_Form_Element_Checkbox(
//            $name,
//            array(
//                'disableLoadDefaultDecorators'  =>  true
//            )
//        );
////        $tmpElement->setRequired(true);
////
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
//
//        $tmpElement->setValue($value);
//
//        $even = 0;
//
//        if ($options) {
//            foreach ($options as $optionName => $option) {
//                switch ($optionName) {
//                    case 'label':
//                        $tmpElement->setLabel($option);
//                        break;
//                    case 'even':
//                        $even = $option;
//                        break;
//                    default:
//                        break;
//                }
//            }
//        }
//
//
//        $tmpElement->setDecorators(
//            array(
//                array('ViewHelper'),
//                array(
//                    'ViewScript',
//                    array(
//                        'viewScript'    => $this->_partialsDir.'_field_checkbox.phtml',
//                        'placement'     => false,
//                        'even'          => $even,
//                    ),
//                ),
//            )
//        );
//
//        return $tmpElement;
//    }

    /**
     *
     *
     */
    protected function _buildFieldInput ($name, $value, $options)
    {
        $options['viewScript'] = $this->_partialsDir . '/_field_input.phtml';
        $options['value'] = $value;


        $tmpElement = new Element\Input(
            $name,
            $options
        );
////        $tmpElement->setRequired(true);
////
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
//
//        $tmpElement->setValue($value);
//
//        $even = 0;
//
//        if ($options) {
//            foreach ($options as $optionName => $option) {
//                switch ($optionName) {
//                    case 'label':
//                        $tmpElement->setLabel($option);
//                        break;
//                    case 'even':
//                        $even = $option;
//                        break;
//                    case 'alphanumericFilter':
//                        $tmpElement->addFilter(
//                            new Zend_Filter_Alnum()
//                        );
//                        break;
//                    case 'size':
//                        $tmpElement->setAttrib('size', $option);
//                        break;
//                    case 'length':
//                        $tmpElement->addValidators(
//                            array(
//                                array(
//                                    'stringLength',
//                                    false,
//                                    array(1, $option),
//                                ),
//                            )
//                        );
//                        $tmpElement->setAttrib('maxlength', $option);
//                        break;
//                    default:
//                        break;
//                }
//            }
//        }
//
//
//        $tmpElement->setDecorators(
//            array(
//                array('ViewHelper'),
//                array(
//                    'ViewScript',
//                    array(
//                        'viewScript'    => $this->_partialsDir.'_field_input.phtml',
//                        'placement'     => false,
//                        'even'          => $even,
//                    ),
//                ),
//            )
//        );

        return $tmpElement;
    }

    /**
     *
     *
     */
    protected function _buildActionSubmit($name, $value, $options)
    {
//        $options['value'] = $value;

        $tmpElement = new Element\Submit(
            $name,
            $options
        );

        return $tmpElement;
    }

///**
//     *
//     *
//     * @return Zend_Form_Element_Submit
//     */
//    protected function _buildActionImage($name, $value, $options)
//    {
//        $tmpElement = new Zend_Form_Element_Image(
//            $name,
//            array(
//                'disableLoadDefaultDecorators'  =>  true
//            )
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
//                                $this->_dataPrimaryKeyValue,
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
//        $tmpElement->setDecorators(
//            array(
//                array('ViewHelper')
//            )
//        );
//
//        return $tmpElement;
//    }
}