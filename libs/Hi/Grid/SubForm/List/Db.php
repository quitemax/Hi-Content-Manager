<?php
/**
 * Hi CMS
 *
 * @category   Hi
 * @package    Hi_Record
 * @copyright  Copyright (c) 2009 Piotr Maxymilian Socha
 * @license
 */

/** @see Hi_Record_SubForm_List */
//require_once 'Hi/Record/SubForm/List.php';

/**
 * Hi_Record_SubForm_List_Db
 *
 * @category   Hi
 * @package    Hi_Record
 * @copyright  Copyright (c) 2009 Piotr Maxymilian Socha
 * @license
 * @version    2.0
 */
class Hi_Record_SubForm_List_Db extends Hi_Record_SubForm_List
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
     *
     *
     * @var array
     */
    protected $_where = null;


    /**
     * Creates an instance of Hi_Record_SubForm_List_Db
     *
     * @param $title string

     *
     * @return void
     */
    public function __construct( $options = null )
    {
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

        $modelInfo = $this->_model->info();
//        Zend_Debug::dump($modelInfo);

        foreach ($modelInfo['metadata'] as $name => $fieldMetadata) {
            if ($fieldMetadata['PRIMARY']) {
                $this->setPrimaryKey($name);
                $this->addField(
                    $name,
                    'id',
                    array(
                        'label'     => $this->_view->translate($name),
                        'sortable'  => true,
                    )
                );
                continue;
            }

            if (!isset($fieldMetadata['TRANSLATED']) || (isset($fieldMetadata['TRANSLATED']) && !$fieldMetadata['TRANSLATED'])) {
	            switch($fieldMetadata['DATA_TYPE']) {
	                case 'tinyint':
	                    if ($fieldMetadata['LENGTH'] === null) {
	                        $this->addField(
	                            $name,
	                            'checkbox',
	                            array(
	                                'label'     => $this->_view->translate($name),
	                                'sortable'  => true,
	                            )
	                        );
	                    }
	                    break;
	                case 'smallint':
	                    if ($fieldMetadata['LENGTH'] === null) {
	                        $this->addField(
	                            $name,
	                            'input',
	                            array(
	                                'label'     => $this->_view->translate($name),
	                                'sortable'  => true,
	                                'size'    => 5,
	                            )
	                        );
	                    }
	                    break;
	                case 'int':
	                    $this->addField(
	                        $name,
	                        'input',
	                        array(
	                            'label'     => $this->_view->translate($name),
	                            'sortable'  => true,
	                        )
	                    );
	                    break;
	                case 'char':
	                    $size = 22;
	                    if ($fieldMetadata['LENGTH'] > 20 ) {
	                      $size = (int)($fieldMetadata['LENGTH']/4);
	                    }
	                    $this->addField(
	                        $name,
	                        'input',
	                        array(
	                            'label'     => $this->_view->translate($name),
	                            'sortable'  => true,
	                            'size'      => $size,
	                        )
	                    );
	                    break;
	                case 'text':
	                    $this->addField(
	                        $name,
	                        'textarea',
	                        array(
	                            'label'     => $this->_view->translate($name),
	                            'sortable'  => true,
	                            'rows'      => 3,
	                            'cols'      => 40,
	                        )
	                    );
	                    break;
	                default:
	                    break;
	            }
            } else {
                switch($fieldMetadata['DATA_TYPE']) {
                    case 'tinyint':
//                        Zend_Debug::dump($metadata);
                        $this->addField(
                            $name,
                            'multilangCheckbox',
                            array(
                                'label'     => $this->_view->translate($name),
                                'sortable'  => true,
                            )
                        );
                        break;
                    case 'int':
//                        Zend_Debug::dump($metadata);
                        $this->addField(
                            $name,
                            'multilangInput',
                            array(
                                'label'     => $this->_view->translate($name),
                                'sortable'  => true,
                            )
                        );
                        break;
                    case 'char':
                        $size = 22;
                        if ($fieldMetadata['LENGTH'] > 20 ) {
                          $size = (int)($fieldMetadata['LENGTH']/4);
                        }
                        $this->addField(
                            $name,
                            'multilangInput',
                            array(
                                'label'     => $this->_view->translate($name),
                                'sortable'  => true,
                                'size'      => $size,
                            )
                        );
                        break;
                    case 'varchar':
                        $this->addField(
                            $name,
                            'multilangInput',
                            array(
                                'label'     => $this->_view->translate($name),
                                'sortable'  => true,
                            )
                        );
                        break;
                    case 'text':
                        $this->addField(
                            $name,
                            'multilangTextarea',
                            array(
                                'label'     => $this->_view->translate($name),
                                'sortable'  => true,
                                'rows'      => 3,
                                'cols'      => 40,
                            )
                        );
                        break;
                    default:
                        break;
                }
            }
        }

        //$this->setActiveRowCheckbox();
        $this->_rowCheckBoxEnable = true;


//         $navigationList->addField(
//            'hni_id',
//            'id',
//            array(
//                'label' => 'Id',
//            )
//        );
//        $navigationList->setPrimaryKey(
//            'hni_id'
//        );
//
//        $navigationList->addField(
//            'hni_sys_name',
//            'text',
//            array(
//                'label' => 'System name',
//            )
//        );
//        $navigationList->addField(
//            'hni_title',
//            'input',
//            array(
//                'label' => 'Title',
//            )
//        );
//        $navigationList->addField(
//            'hni_description',
//            'text',
//            array(
//                'label' => 'Description',
//            )
//        );
//        $navigationList->addRecordAction(
//            'delete',
//            'image',
//            array(
//                'label' => 'Delete',
//                'image' => $this->_publicUrl.'hicmsAdmin/img/delete.png',
//                'class' => 'actionSubmitClass',
//            )
//        );
//
//        $navigationList->addListAction(
//            'add',
//            'submit',
//            array(
//                'label' => 'Add new',
//                'class' => 'actionSubmitClass',
//            )
//        );
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
            $this->_where = $where;
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
        return $this->_where;
    }

    /**
     *
     *
     *
     * @return string
     */
    public function getDbOrder()
    {
        if ($this->_listSession->sortField === null) {
            return null;
        } else {
            return  $this->_listSession->sortField
                    . ' '
                    . $this->_listSession->sortFieldDirection;
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
        return $this->_listSession->perPage;
    }

    /**
     *
     *
     *
     * @return int
     */
    public function getDbOffset()
    {
        if ($this->_listSession->page>1) {
            return ($this->_listSession->page-1)*$this->_listSession->perPage;
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
        //
        if ($this->_model->hasBehaviour('i18n')) {

            //
            $this->_model->getBehaviour('i18n')->setLang($this->_listSession->lang);
        }

        //
        $items = $this-> _model -> getAll(
            $this->_where,
            $this->getDbOrder(),
            $this->_listSession->perPage,
            $this->getDbOffset(),
            null
        );
//        Zend_Debug::dump($items);
        $itemsCount = $this->_model -> getCountLastSql();

        if ($this->_model->hasBehaviour('i18n')) {

            //
            $this->_model->getBehaviour('i18n')->clearLang();
        }

        //
        $this->setData($items);
        $this->setAllElementsCount($itemsCount);

        //
        return parent::build();
    }
}