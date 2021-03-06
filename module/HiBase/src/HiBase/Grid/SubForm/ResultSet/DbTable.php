<?php
/**
 * Hi CMS
 *
 * @category   Hi
 * @package    Hi_Record
 * @copyright  Copyright (c) 2009 Piotr Maxymilian Socha
 * @license
 */

namespace HiBase\Grid\SubForm\ResultSet;

use HiBase\Grid\SubForm\ResultSet as GridResultSet,
    Zend\Db\Metadata\Metadata;
/**
 * Hi_Record_SubForm_List_Db
 *
 * @category   Hi
 * @package    Hi_Record
 * @copyright  Copyright (c) 2009 Piotr Maxymilian Socha
 * @license
 * @version    2.0
 */
class DbTable extends GridResultSet
{
    /**
     *
     *
     * @var HiBase\Db\Table\AbstractTable
     */
    protected $_model = null;

    /**
     *
     *
     * @var array
     */
    protected $_cols = null;

    /**
     *
     *
     * @var array
     */
    protected $_dbWhere = null;
    /**
     *
     *
     * @var array
     */
    protected $_dbOrder = null;
    /**
     *
     *
     * @var array
     */
    protected $_loadAll = null;


	/**
     * Set form state from options array
     *
     * @param  array $options
     * @return Form
     */
    public function setOptions(array $options)
    {
        //
        if (isset($options['model'])) {
            $this->_model = $options['model'];
            unset($options['model']);
        } else {
            throw new Exception("You must give an instance of HiBase\Db\TableGateway\TableGateway here.");
        }

        return parent::setOptions($options);
    }

    public function init()
    {
        parent::init();

        $this->_setup();
    }

    /**
     *
     *
     *
     * @return void
     */
    protected function _setup()
    {

        $model = $this->_model;

        $modelDefinition = $model->getTableDefinition();


//        \Zend\Debug::dump($modelDefinition);

        foreach ($modelDefinition as $name => $fieldMetadata) {
            if (!empty($fieldMetadata['options']['primary']) && $fieldMetadata['options']['primary'] == true) {
                $this->setPrimaryKey($name);
                $this->addField(
                    $name,
                    'id',
                    array(
                        'label'     => $name,
                        'sortable'  => true,
                    )
                );
                continue;
            }
//
            if (empty($fieldMetadata['options']['TRANSLATED']) || (!empty($fieldMetadata['options']['TRANSLATED']) && !$fieldMetadata['options']['TRANSLATED'])) {

                //non-translated fields
                switch($fieldMetadata['type']) {
                    case 'tinyint':
	                    if ($fieldMetadata['length'] === 1) {
	                        $this->addField(
	                            $name,
	                            'checkbox',
	                            array(
	                                'label'     => $name,
	                                'sortable'  => true,
	                            )
	                        );
	                    }
                        break;
                    case 'smallint':
//	                    if ($fieldMetadata['LENGTH'] === null) {
//	                        $this->addField(
//	                            $name,
//	                            'input',
//	                            array(
//	                                'label'     => $name,
//	                                'sortable'  => true,
//	                                'size'    => 5,
//	                            )
//	                        );
//	                    }
                        break;
                    case 'integer':
	                    $this->addField(
	                        $name,
	                        'input',
	                        array(
	                            'label'     => $name,
	                            'sortable'  => true,
	                            'size'    => 7,
	                        )
	                    );
                        break;
                    case 'decimal':
	                    $this->addField(
	                        $name,
	                        'input',
	                        array(
	                            'label'     => $name,
	                            'sortable'  => true,
	                            'size'    => 9,
	                        )
	                    );
                        break;
                    case 'char':
	                    $size = 22;
	                    if ($fieldMetadata['length'] > 20 ) {
	                      $size = (int)($fieldMetadata['length']/4);
	                    }
	                    $this->addField(
	                        $name,
	                        'input',
	                        array(
	                            'label'     => $name,
	                            'sortable'  => true,
	                            'size'      => $size,
	                        )
	                    );
                        break;
                    case 'text':
//                        \Zend\Debug::dump($fieldMetadata);
//                        \Zend\Debug::dump($fieldMetadata['options']['type']);
//                        \Zend\Debug::dump($fieldMetadata['options']['type'] == 'image');
                        if ($fieldMetadata['options']['type'] == 'image') {

//                            \Zend\Debug::dump($name);
//                        \Zend\Debug::dump($fieldMetadata['options']['type']);
//                        \Zend\Debug::dump($fieldMetadata['options']['type'] == 'image');
                            $this->addField(
                                $name,
                                'image',
                                array(
                                    'label'         => $name,
                                    'cache'        => $fieldMetadata['options']['cache'],
                                )
                            );
//                            \Zend\Debug::dump($this->_fields);
                            break;
                        }

	                    $this->addField(
	                        $name,
	                        'text',
	                        array(
	                            'label'     => $name,
	                            'sortable'  => true,
//	                            'rows'      => 3,
//	                            'cols'      => 40,
	                        )
	                    );
                        break;
                    case 'date':
//	                    $this->addField(
//	                        $name,
//	                        'input',
//	                        array(
//	                            'label'     => $name,
//	                            'sortable'  => true,
//	                        )
//	                    );
                        break;
                    case 'datetime':
	                    $this->addField(
	                        $name,
	                        'input',
	                        array(
	                            'label'     => $name,
	                            'sortable'  => true,
	                        )
	                    );
                        break;
                    case 'time':
	                    $this->addField(
	                        $name,
	                        'input',
	                        array(
	                            'label'     => $name,
	                            'sortable'  => true,
	                            'size'    => 10,
	                        )
	                    );
                        break;
                    default:
                        break;
                }
            } else {

                //translated fields
////                switch($fieldMetadata['DATA_TYPE']) {
////                    case 'tinyint':
//////                        Zend_Debug::dump($metadata);
////                        $this->addField(
////                            $name,
////                            'multilangCheckbox',
////                            array(
////                                'label'     => $this->_view->translate($name),
////                                'sortable'  => true,
////                            )
////                        );
////                        break;
////                    case 'int':
//////                        Zend_Debug::dump($metadata);
////                        $this->addField(
////                            $name,
////                            'multilangInput',
////                            array(
////                                'label'     => $this->_view->translate($name),
////                                'sortable'  => true,
////                            )
////                        );
////                        break;
////                    case 'char':
////                        $size = 22;
////                        if ($fieldMetadata['LENGTH'] > 20 ) {
////                          $size = (int)($fieldMetadata['LENGTH']/4);
////                        }
////                        $this->addField(
////                            $name,
////                            'multilangInput',
////                            array(
////                                'label'     => $this->_view->translate($name),
////                                'sortable'  => true,
////                                'size'      => $size,
////                            )
////                        );
////                        break;
////                    case 'varchar':
////                        $this->addField(
////                            $name,
////                            'multilangInput',
////                            array(
////                                'label'     => $this->_view->translate($name),
////                                'sortable'  => true,
////                            )
////                        );
////                        break;
////                    case 'text':
////                        $this->addField(
////                            $name,
////                            'multilangTextarea',
////                            array(
////                                'label'     => $this->_view->translate($name),
////                                'sortable'  => true,
////                                'rows'      => 3,
////                                'cols'      => 40,
////                            )
////                        );
////                        break;
////                    default:
////                        break;
////                }
            }
        }

        //$this->setActiveRowCheckbox();
        $this->_rowCheckBoxEnable = true;

    }

    /**
     *
     *
     *
     * @return int
     */
    public function setDbWhere($where = null)
    {
        if ($where !== null) {
            $this->_dbWhere = $where;
        }
    }

    /**
     *
     *
     *
     * @return int
     */
    public function getDbWhere()
    {
        return $this->_dbWhere;
    }
    /**
     *
     *
     *
     * @return int
     */
    public function setLoadAll($load = false)
    {
        $this->_loadAll = $load;
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
    public function getFieldsNames()
    {
        $fieldTmp = array();

        if ($this->_loadAll) {
//            $modelInfo = $this->_model->info();
////            \HiZend\Debug\Debug::dump($modelInfo);
//            $fieldTmp = $modelInfo['cols'];
        } else {
            foreach ($this->_fields as $key => $field) {
//    //            \HiZend\Debug\Debug::dump($key);
//    //            \HiZend\Debug\Debug::dump($field);
                if ($field['type'] == 'custom') {
                    continue;
                }
//
                if (isset($field['options']['sql'])) {
                    $fieldTmp[$field['name']] =  $field['options']['sql'];
                } else {
                    $fieldTmp[] = $field['name'];
                }
            }
        }


//        \Zend\Debug::precho($fieldTmp);
        return $fieldTmp;
    }


    /**
     *
     *
     *
     * @return string
     */
    public function getDbOrder()
    {
        if (!isset($this->_dbOrder)) {
            if ($this->_session->sortField === null) {
                if ($this->_dbOrder !== null) {
                return $this->_dbOrder;
                } else {
                    return null;
                }
            } else {
                return  $this->_session->sortField
                        . ' '
                        . $this->_session->sortFieldDirection;
            }
        } else {
            if ($this->_session->sortField === null) {
                return $this->_dbOrder;
            } else {
                $order = array(
                    $this->_session->sortField
                    . ' '
                    . $this->_session->sortFieldDirection
                );
                $order += $this->_dbOrder;
                return  $this->_session->sortField
                        . ' '
                        . $this->_session->sortFieldDirection;
            }
        }
    }

    /**
     *
     *
     *
     * @return string
     */
    public function setDbOrder($dbOrder)
    {
        $this->_dbOrder = $dbOrder;
        return $this;

    }

    /**
     *
     *
     *
     * @return int
     */
    public function addDbOrder($order = null, $direction = null)
    {
        if ($order !== null && $direction !== null) {
            if (!is_array($this->_dbOrder)) {
                $this->_dbOrder = array();
            }
////            \HiZend\Debug\Debug::dump($order);
////            \HiZend\Debug\Debug::dump($direction);
////            \HiZend\Debug\Debug::dump($order . ' ' . $direction);
////            \HiZend\Debug\Debug::dump($this->_dbOrder);
            $this->_dbOrder = $order . ' ' . $direction;
//////            $this->_rowsetSession->sortFieldDirection = $direction;
        }
    }

    /**
     *
     *
     *
     * @return int
     */
    public function getDbLimit()
    {
        return $this->_session->perPage;
    }

    /**
     *
     *
     *
     * @return int
     */
    public function getDbOffset()
    {
        if ($this->_session->page > 1) {
            return ($this->_session->page - 1) * $this->_session->perPage;
        } else {
            return 0;
        }

    }

    /**
     * Builds
     *
     * @return Zend_Form_SubForm
     */
    public function build()
    {
////        if ($this->_model->hasBehaviour('i18n')) {
////
////            //
////            $this->_model->getBehaviour('i18n')->setLang($this->_rowsetSession->lang);
////        }
//\HiBase\Debug::dump($this->getDbLimit());
//\HiBase\Debug::dump($this->getDbOffset());
        //
        $resultSet = $this-> _model -> getResultSet(
            $this->getDbWhere(),
            $this->getDbOrder(),
            $this->getDbLimit(),
            $this->getDbOffset(),
            $this->getFieldsNames()
        );


////    \HiZend\Debug\Debug::dump($rowset->toArray());
////    \HiZend\Debug\Debug::dump($this);
////    \HiZend\Debug\Debug::dump($this->getDbWhere());
////    \HiZend\Debug\Debug::dump($this->getDbOrder());
////    \HiZend\Debug\Debug::dump($this->getDbLimit());
////    \HiZend\Debug\Debug::dump($this->getDbOffset());
////    \HiZend\Debug\Debug::dump($this->_model -> getCountLastSql());


//        \Zend\Debug::dump($resultSet->toArray());


        //
        $resultSetCount = $this->_model -> getCountLastSql();
//        $resultSetCount = count($resultSet);

//        \HiBase\Debug::dump($resultSetCount);

////        if ($this->_model->hasBehaviour('i18n')) {
////
////            //
////            $this->_model->getBehaviour('i18n')->clearLang();
////        }

        //
        $this->setData($resultSet->toArray());
        $this->setAllElementsCount($resultSetCount);

        //
        return parent::build();
    }
}