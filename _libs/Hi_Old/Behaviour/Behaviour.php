<?php
/**
 * Hi CMS
 *
 * @category   HiZend_Db
 * @package    HiZend_Db
 * @copyright  Copyright (c) 2009 Piotr Maxymilian Socha
 * @license
 */

/** Zend_Db_Table */
require_once 'Zend/Db/Table.php';

/**
 * Refited Zend_Db_Table class for use with HiCms
 *
 * @category   HiZend_Db
 * @package    HiZend_Db
 * @subpackage HiZend_Db_Behaviour
 * @copyright  Copyright (c) 2009 Piotr Maxymilian Socha
 * @license
 */
class HiZend_Db_Behaviour
{
    protected $_parentTable;

    /**
     *
     *
     * @var Zend_Db
     */
    protected $_db;


    /**
     *
     *
     * @return void
     */
    public function __construct($dbTable = null, $config = array())
    {

        $this->_parentTable = $dbTable;

        $this->_db = $dbTable->getAdapter();

    }

    /**
     *
     *
     * @return void
     */
    public function applyBehaviourToSql(
        Zend_Db_Select $sqlSelect = null,
        &$where = null,
        &$order = null,
        &$count = null,
        &$offset = null,
        &$cols = null
    )
    {
        return $sqlSelect;
    }

    /**
     *
     *
     * @return array
     */
    public function modifyResults(
        $results = null,
        $where = null,
        $order = null,
        $count = null,
        $offset = null,
        $cols = null
    )
    {
        return $results;

    }

    /**
     *
     *
     * @return array
     */
    public function modifyInfo($info = null)
    {
        return $info;
    }

    /**
     *
     *
     * @return int
     */
    public function modifyUpdate(&$data = null, &$where = null)
    {
        return 0;
    }

    /**
     *
     *
     * @return void
     */
    public function prepareInsert(&$data = null)
    {

    }

    /**
     *
     *
     * @return void
     */
    public function applyInsert(&$data = null)
    {

    }

}