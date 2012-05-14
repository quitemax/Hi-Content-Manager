<?php
/**
 * Hi CMS
 *
 * @category   Hi
 * @package    Hi_Record_List
 * @copyright  Copyright (c) 2009 Piotr Maxymilian Socha
 * @license
 */

namespace HiBase\Grid\SubForm\Row;

use HiBase\Grid\SubForm\Row as GridRow;

/**
 * Db
 *
 * @category   Hi
 * @package    Hi_Grid
 * @copyright  Copyright (c) 2009 Piotr Maxymilian Socha
 * @license
 * @version    2.0
 */
class DbTable extends GridRow
{
    /**
     *
     *
     * @var HiZend_Db_Table
     */
    protected $_model = null;

//    /**
//     *
//     *
//     * @var array
//     */
//    protected $_cols = null;



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
            throw new Exception("You must give an instance of HiZend\Db\Table here.");
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
        $modelDefinition = $this->_model->getTableDefinition();
//        $modelInfo = $this->_model->info();
////        \HiZend\Debug\Debug::precho($modelInfo);
////        Zend_Debug::dump($modelInfo);
////
//////        if (!count($cols)) {
//////
//////        }
        foreach ($modelDefinition as $name => $fieldMetadata) {

//            \HiBase\Debug::dump($fieldMetadata);
            if (!empty($fieldMetadata['options']['primary']) && $fieldMetadata['options']['primary'] == true) {
                $this->setPrimaryKey($name);
                $this->addField(
                    $name,
                    'id',
                    array(
                        'label'     => $name,
                    )
                );
                continue;
            }
            if (empty($fieldMetadata['options']['TRANSLATED']) || (!empty($fieldMetadata['options']['TRANSLATED']) && !$fieldMetadata['options']['TRANSLATED'])) {
                switch($fieldMetadata['type']) {
                    case 'tinyint':
                        if ($fieldMetadata['length'] === 1) {
                            $this->addField(
                                $name,
                                'checkbox',
                                array(
                                    'label'     => $name,
                                )
                            );
                        }
                        break;
                    case 'smallint':
//                        if ($fieldMetadata['LENGTH'] === null) {
//                            $this->addField(
//                                $name,
//                                'input',
//                                array(
//                                    'label'     => $name,
//                                    'size'    => 3,
//                                )
//                            );
//                        }
                        break;
                    case 'integer':
                        if ($fieldMetadata['options']['type'] == 'select' && count($fieldMetadata['options']['values'])) {
                            $this->addField(
                                $name,
                                'select',
                                array(
                                    'label'         => $name,
                                    'defaultValue'  => '0',
                                    'values'        => $fieldMetadata['options']['values'],
                                )
                            );
                            break;
                        }

                        $this->addField(
                            $name,
                            'input',
                            array(
                                'label'         => $name,
                                'defaultValue'  => '0',
                            )
                        );
                        break;
                    case 'date':
//                        $this->addField(
//                            $name,
//                            'input',
//                            array(
//                                'label'     => $name,
//                                'defaultValue'  => '0000-00-00',
//                            )
//                        );
                        break;
                    case 'datetime':
                        $this->addField(
                            $name,
                            'input',
                            array(
                                'label'     => $name,
                                'defaultValue'  => '0000-00-00 00:00:00',
                            )
                        );
                        break;
                    case 'time':
                        $this->addField(
                            $name,
                            'input',
                            array(
                                'label'     => $name,
                                'defaultValue'  => '00:00:00',
                            )
                        );
                        break;
                    case 'decimal':
                        $this->addField(
                            $name,
                            'input',
                            array(
                                'label'     => $name,
                                'defaultValue'  => '0',
                                'size'    => 9,
                            )
                        );
                        break;
                    case 'float':
//                        $this->addField(
//                            $name,
//                            'input',
//                            array(
//                                'label'     => $name,
//                                'defaultValue'  => '0',
//                            )
//                        );
                        break;
                    case 'char':
                        $this->addField(
                            $name,
                            'input',
                            array(
                                'label'     => $name,
                                'size'      => (int)($fieldMetadata['length']/2.3),
                            )
                        );
                        break;
                    case 'varchar':
                        $this->addField(
                            $name,
                            'input',
                            array(
                                'label'     => $name,
                            )
                        );
                        break;
                    case 'text':
                        if ($fieldMetadata['options']['type'] == 'image') {
                            $this->addField(
                                $name,
                                'image',
                                array(
                                    'label'        => $name,
                                    'cache'        => $fieldMetadata['options']['cache'],
                                )
                            );
                            break;
                        }

                        $this->addField(
                            $name,
                            'textarea',
                            array(
                                'label'     => $name,
                                'cols'     => 40,
                                'rows'     => 5,
                            )
                        );
                        break;

                    default:
                        break;
                }
            } else {
////                switch($fieldMetadata['DATA_TYPE']) {
////                    case 'tinyint':
//////                        Zend_Debug::dump($metadata);
////                        $this->addField(
////                            $name,
////                            'multilangCheckbox',
////                            array(
////                                'label'     => $this->_view->translate($name),
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
////                            )
////                        );
////                        break;
////                    case 'char':
////                        $this->addField(
////                            $name,
////                            'multilangInput',
////                            array(
////                                'label'     => $this->_view->translate($name),
////                            )
////                        );
////                        break;
////                    case 'varchar':
////                        $this->addField(
////                            $name,
////                            'multilangInput',
////                            array(
////                                'label'     => $this->_view->translate($name),
////                            )
////                        );
////                        break;
////                    case 'text':
////                        $this->addField(
////                            $name,
////                            'multilangTextarea',
////                            array(
////                                'label'     => $this->_view->translate($name),
////                            )
////                        );
////                        break;
////                    default:
////                        break;
//                }
            }
        }

    }



    /**
     * Builds
     *
     * @return Zend_Form_SubForm
     */
    public function build()
    {
////        //
////        if ($this->_model->hasBehaviour('i18n')) {
//////            //
//////            $this->_model->getBehaviour('i18n')->setLang($this->_listSession->lang);
////        }
////
//        //
        if (isset($this->_dataPrimaryKeyValue) && !isset($this->_data)) {



            $dataRow = $this->_model -> getRow(
                $this->_primaryKey
                . ' = '
                . $this->_dataPrimaryKeyValue
            );

            //
            $this->_data = $dataRow->toArray();
        }

        return parent::build();
    }
}