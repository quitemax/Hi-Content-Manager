<?php
/**
 * Hi CMS
 *
 * @category   Hi
 * @package    Hi_Record_Tree
 * @copyright  Copyright (c) 2009 Piotr Maxymilian Socha
 * @license
 */

/** @see Hi_Record_Tree */
require_once 'Hi/Record/Tree.php';

/**
 * Hi_Record_Tree_Db
 *
 * @category   Hi
 * @package    Hi_Record
 * @copyright  Copyright (c) 2009 Piotr Maxymilian Socha
 * @license
 * @version    2.0
 */
class Hi_Record_Tree_Db extends Hi_Record_Tree
{
    /**
     *
     *
     * @var HiZend_Db_Table
     */
    protected $_model = null;

    /**
     *
     *
     * @var array
     */
    protected $_cols = null;



    /**
     * Creates an instance of Hi_Record_Row_Db
     *
     * @param $options array
     *
     * @return
     */
    public function __construct($options = null) {
        //
        if (isset($options['model'])) {
            $this->_model = $options['model'];
            unset($options['model']);
        } else {
            throw new Exception("You must give an instance of HiZend_Db_Table here.");
        }

        //
        parent::__construct($options);

        //
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
//        $model = $this->_model;

//        $modelInfo = $model->info();
//        Zend_Debug::dump($modelInfo);

//        if (!count($cols)) {
//
//        }
//        foreach ($modelInfo['metadata'] as $name => $fieldMetadata) {
//            if ($fieldMetadata['PRIMARY']) {
//                $this->setPrimaryKey($name);
//                $this->addField(
//                    $name,
//                    'id',
//                    array(
//                        'label'     => $this->_view->translate($name),
//                    )
//                );
//                continue;
//            }
//            if (!isset($fieldMetadata['TRANSLATED']) || (isset($fieldMetadata['TRANSLATED']) && !$fieldMetadata['TRANSLATED'])) {
//                switch($fieldMetadata['DATA_TYPE']) {
//                    case 'tinyint':
//                        if ($fieldMetadata['LENGTH'] === null) {
//                            $this->addField(
//                                $name,
//                                'checkbox',
//                                array(
//                                    'label'     => $this->_view->translate($name),
//                                    'sortable'  => true,
//                                )
//                            );
//                        }
//                        break;
//                    case 'smallint':
//                        if ($fieldMetadata['LENGTH'] === null) {
//                            $this->addField(
//                                $name,
//                                'input',
//                                array(
//                                    'label'     => $this->_view->translate($name),
//                                    'sortable'  => true,
//                                    'size'    => 5,
//                                )
//                            );
//                        }
//                        break;
//                    case 'int':
//                        $this->addField(
//                            $name,
//                            'input',
//                            array(
//                                'label'     => $this->_view->translate($name),
//                            )
//                        );
//                        break;
//                    case 'char':
//                        $this->addField(
//                            $name,
//                            'input',
//                            array(
//                                'label'     => $this->_view->translate($name),
//                                'size'      => (int)($fieldMetadata['LENGTH']/2.3),
//                            )
//                        );
//                        break;
//                    case 'varchar':
//                        $this->addField(
//                            $name,
//                            'input',
//                            array(
//                                'label'     => $this->_view->translate($name),
//                            )
//                        );
//                        break;
//                    case 'text':
//                        $this->addField(
//                            $name,
//                            'text',
//                            array(
//                                'label'     => $this->_view->translate($name),
//                            )
//                        );
//                        break;
//                    default:
//                        break;
//                }
//            } else {
//                switch($fieldMetadata['DATA_TYPE']) {
//                    case 'tinyint':
////                        Zend_Debug::dump($metadata);
//                        $this->addField(
//                            $name,
//                            'multilangCheckbox',
//                            array(
//                                'label'     => $this->_view->translate($name),
//                            )
//                        );
//                        break;
//                    case 'int':
////                        Zend_Debug::dump($metadata);
//                        $this->addField(
//                            $name,
//                            'multilangInput',
//                            array(
//                                'label'     => $this->_view->translate($name),
//                            )
//                        );
//                        break;
//                    case 'char':
//                        $this->addField(
//                            $name,
//                            'multilangInput',
//                            array(
//                                'label'     => $this->_view->translate($name),
//                            )
//                        );
//                        break;
//                    case 'varchar':
//                        $this->addField(
//                            $name,
//                            'multilangInput',
//                            array(
//                                'label'     => $this->_view->translate($name),
//                            )
//                        );
//                        break;
//                    case 'text':
//                        $this->addField(
//                            $name,
//                            'multilangTextarea',
//                            array(
//                                'label'     => $this->_view->translate($name),
//                            )
//                        );
//                        break;
//                    default:
//                        break;
//                }
//            }
//        }
    }



    /**
     * Builds
     *
     * @return Zend_Form_SubForm
     */
    public function build()
    {
        //
        if ($this->_model->hasBehaviour('nestedSet')) {
            //
            $nestedSetBehaviour = $this->_model->getBehaviour('nestedSet');

            if (!$this->_treeElements) {

                $tree = $nestedSetBehaviour->getTree($where = null);
                Zend_Debug::dump($tree);
            }


        } else {
            throw new Exception('Model has no nested set behaviour.');
        }
//        if (isset($this->_dataRowIdValue)) {
//            $model = $this->_model;
//
//            $dataRow = $model -> getRow(
//                $this->_primaryKey
//                . ' = '
//                . $this->_dataRowIdValue
//            );
////            Zend_Debug::dump($dataRow);
//            $this->_data = $dataRow;
//        }
//
        return parent::build();
    }


}