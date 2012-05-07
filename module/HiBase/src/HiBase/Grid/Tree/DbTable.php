<?php
/**
 * Hi CMS
 *
 * @category   Hi
 * @package    Hi_Grid
 * @copyright  Copyright (c) 2009 Piotr Maxymilian Socha
 * @license
 */

namespace HiBase\Grid\Tree;

use HiBase\Grid\Tree as GridTree;
//Hi\Grid\Element\CheckboxRow,
//    ,
//    Zend\Session\Container as SessionContainer,
//    Hi\Paginator\Paginator,
//    Hi\Grid\Element;
/**
 * Hi_Grid_Tree_DbTable
 *
 * @category   Hi
 * @package    Hi_Grid
 * @copyright  Copyright (c) 2009 Piotr Maxymilian Socha
 * @license
 * @version    2.0
 */
class DbTable extends GridTree
{
    /**
     *
     *
     * @var HiZend_Db_Table
     */
    protected $_model = null;

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

    }

    /**
     * Builds
     *
     * @return Zend_Form_SubForm
     */
    public function build()
    {
        if (!$this->_treeElements) {
            //
            if ($this->_model->hasBehaviour('nestedSet')) {
                //
                $nestedSetBehaviour = $this->_model->getBehaviour('nestedSet');

                $this->_treeElements = $nestedSetBehaviour->getTree($where = null);

            } else {
                throw new Exception('Model has no nested set behaviour.');
            }
        }

        return parent::build();
    }


}