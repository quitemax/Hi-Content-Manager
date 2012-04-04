<?php

namespace HiBase\Db\ResultSet;
/**
 * Hi CMS
 *
 * @category   HiZend
 * @package    HiZend\Db
 * @copyright  Copyright (c) 2009 Piotr Maxymilian Socha
 * @license
 */

use Zend\Db\ResultSet\ResultSet as ZendResultSet;

/**
 * Refited Zend\Db\Table class for use with Hi
 *
 * @category   HiZend
 * @package    HiZend_Db
 * @subpackage Table
 * @copyright  Copyright (c) 2009 Piotr Maxymilian Socha
 * @license
 */
class ResultSet extends ZendResultSet
{
//    /**
//     *
//     *
//     * @var Zend_Db_Select contains last sql statement
//     */
//    protected $_lastSql;
//
//    /**
//     *
//     *
//     * @var string
//     */
//    protected $_prfx = null;
//
//    /**
//     *
//     *
//     * @var string
//     */
//    protected $_primaryKey = null;
//
//    /**
//     *
//     *
//     * @var array
//     */
//    protected $_behaviours = array();
//
//    /**
//     *
//     *
//     * @var array
//     */
//    protected $_behaviourObjects = array();
//
//
//    /**
//     *
//     *
//     * @return void
//     */
//    public function __construct($config = array(), $definition = null)
//    {
//        parent::__construct($config, $definition);
//
//        //
//        if ($this->_primaryKey == null) {
//            if (is_array($this->_primary)) {
//                $this->_primaryKey = $this->_primary[1];
//            } else {
//                $this->_primaryKey = $this->_primary;
//            }
//        }
//
//        //
//        if (($this->_prfx===null)) {
//            throw new Exception('You have not definied a prfx field for this class.');
//        }
//
//        foreach ($this->_behaviours as $behaviourName => $behaviourOptions) {
//            switch ($behaviourName) {
//                case 'i18n':
//                    $behaviourObject = new HiZend_Db_Behaviour_I18n(
//                        $this,
//                        $behaviourOptions
//                    );
//                    $this->_behaviourObjects[$behaviourName] = $behaviourObject;
//                    break;
//                case 'nestedSet':
//                    $behaviourObject = new HiZend_Db_Behaviour_NestedSet(
//                        $this,
//                        $behaviourOptions
//                    );
//                    $this->_behaviourObjects[$behaviourName] = $behaviourObject;
//                    break;
//                default:
//                    break;
//            }
//
//
//
//        }
//    }
//
//    /**
//     * Get table name (Hi use)
//     *
//     * @return string
//     */
//    public function getName() {
//        return $this->_name;
//    }
//
//    /**
//     * Get all sql statement
//     *
//     * @return string
//     */
//    public function prepareGetAllSql($where = null, $order = null, $count = null, $offset  = null, $cols = null)
//    {
//        /*@var $sqlSelect Zend_Db_Select*/
//        $sqlSelect = $this->_db->select();
//
//        foreach ($this->_behaviourObjects as $behaviourObject) {
//            $sqlSelect = $behaviourObject->applyBehaviourToSql(
//                $sqlSelect,
//                $where,
//                $order,
//                $count,
//                $offset,
//                $cols
//            );
//        }
//
//        $fromCols = array();
//        if ($cols !== null && is_array($cols) && count($cols)) {
//            $fromCols = $cols;
//        } else {
//            $fromCols[] =  $this->_prfx . '.*';
//        }
//
//        //from
//        $sqlSelect->from(
//            array (
//                $this->_prfx => $this->_name,
//            ),
//            $fromCols
//        );
//
//        //where
//        if ($where!==null) {
//            if (is_array($where)) {
//                foreach ($where as $w) {
//                    $sqlSelect->where($w);
//                }
//            } else {
//                $sqlSelect->where($where);
//            }
//        }
//
//        //limit
//        $sqlSelect->limit($count, $offset);
//
//        //order
//        $sqlSelect->order($order);
////        echo $sqlSelect;
//
//        return $sqlSelect;
//    }
//
//
//
//    /**
//     * Get all refited (Hi use)
//     *
//     * @return string
//     */
//    public function getAll($where = null, $order = null, $count = null, $offset  = null, $cols = null)
//    {
//        //prepare the sql
//        $sqlSelect = $this->prepareGetAllSql($where, $order, $count, $offset, $cols);
//
//        Zend_Debug::dump($sqlSelect->__toString());
//
//        //save sql
//        $this->_lastSql = $sqlSelect;
//
//        //
//        $allItems = $this->_db->fetchAll($sqlSelect);
//
//
//        foreach ($this->_behaviourObjects as $behaviourObject) {
//            $allItems = $behaviourObject->modifyResults(
//                $allItems,
//                $where,
//                $order,
//                $count,
//                $offset,
//                $cols
//            );
//        }
//
//        //
//        return $allItems;
//    }
//
//    /**
//     * Get row
//     *
//     * @return array
//     */
//    public function getRow($where = null, $order = null, $offset = null, $cols = null)
//    {
//        //prepare the sql
//        $sqlSelect = $this->prepareGetAllSql($where, $order, 1, $offset, $cols);
//        Zend_Debug::dump($sqlSelect->__toString());
//
//        //
//        $this->_lastSql = $sqlSelect;
//
//        //
//        $item = $this->_db->fetchAll($sqlSelect);
//
//        //
//        if (count($item)) {
//            foreach ($this->_behaviourObjects as $behaviourObject) {
//                $item = $behaviourObject->modifyResults(
//                    $item,
//                    $where,
//                    $order,
//                    1,
//                    $offset,
//                    $cols
//                );
//            }
//
//            $item = array_pop($item);
//        } else {
//            $item = false;
//        }
//        return $item;
//
//    }
//
//    /**
//     * Get row
//     *
//     * @return array
//     */
//    public function getCol($where = null, $order = null, $count = null, $offset  = null, $col = null)
//    {
//        //prepare the sql
//        $sqlSelect = $this->prepareGetAllSql($where, $order, $count, $offset, $col);
//        echo $sqlSelect;
//
//        //
//        $this->_lastSql = $sqlSelect;
//
//        //
//        $items = $this->_db->fetchCol($sqlSelect);
//
//        //
//
//        foreach ($this->_behaviourObjects as $behaviourObject) {
//            $items = $behaviourObject->modifyResults(
//                $items,
//                $where,
//                $order,
//                $count,
//                $offset,
//                $col
//            );
//        }
//
//        return $items;
//
//    }
//
//    public function info($key = null) {
//        //
//        $info = parent::info($key);
//
//
//        //
//        foreach ($this->_behaviourObjects as $behaviourObject) {
//            $info = $behaviourObject->modifyInfo(
//                $info
//            );
//        }
//
//        //
//        return $info;
//    }
//
//    /**
//     * Get count
//     *
//     * @return array
//     */
//    public function getCount($where = null)
//    {
//        //prepare the sql
//        $sqlSelect = $this->prepareGetAllSql(
//            $where,
//            null,
//            null,
//            null,
//            array(
//                'count' => 'COUNT(*)',
//            )
//        );
////        echo $sqlSelect;
//
//        //
//        $this->_lastSql = $sqlSelect;
//
//        //
//        return $this->_db->fetchOne($sqlSelect);
//    }
//
//    public function getCountLastSql()
//    {
//        if ($this->_lastSql instanceof Zend_Db_Select) {
//
//            //
//            $lastSql = $this->_lastSql;
//
//            $lastSql->reset(Zend_Db_Select::COLUMNS);
//            $lastSql->reset(Zend_Db_Select::GROUP);
//            $lastSql->reset(Zend_Db_Select::ORDER);
//            $lastSql->reset(Zend_Db_Select::LIMIT_COUNT);
//            $lastSql->reset(Zend_Db_Select::LIMIT_OFFSET);
//
//            $lastSql->columns('COUNT(*) as count');
//
////            echo $lastSql;
//            return $this->_db->fetchOne($lastSql);
//        } else {
//          return false;
//        }
//    }
//
//    /**
//     * Get table name (Hi use)
//     *
//     * @return string
//     */
//    public function hasBehaviour($behaviour = null) {
//        return isset($this->_behaviourObjects[$behaviour]);
//    }
//
//    /**
//     * Get table name (Hi use)
//     *
//     * @return string
//     */
//    public function getBehaviour($behaviour = null) {
//
//        if (isset($this->_behaviourObjects[$behaviour])) {
//            return $this->_behaviourObjects[$behaviour];
//        }
//
//        return false;
//    }
//
//    /**
//     * Get table name (Hi use)
//     *
//     * @return string
//     */
//    public function setBehaviour($behaviour = null, $options = null) {
////    if (isset($this->_behaviourObjects[$behaviour])) {
////            return $this->_behaviourObjects[$behaviour];
////        }
//    }
//
//
//    public function update($data = null, $where = null) {
////        Zend_Debug::dump($data);
////        Zend_Debug::dump($where);
//        foreach ($this->_behaviourObjects as $behaviourObject) {
//            $behaviourObject->modifyUpdate(
//                $data,
//                $where
//            );
////            Zend_Debug::dump($data);
////            Zend_Debug::dump($where);
//        }
//
//        parent::update($data, $where);
//    }
//
//    public function insert($data = null) {
//
////        Zend_Debug::dump($data);
//
//        //
//        foreach ($this->_behaviourObjects as $behaviour => $behaviourObject) {
//            $behaviourObject->prepareInsert(
//                $data
//            );
////            Zend_Debug::dump($data, 'Data after prepareInsert ' . $behaviour);
//        }
//
//        //
////        Zend_Debug::dump($data, 'insertData');
//        $newId = parent::insert($data);
//
//        //
//        foreach ($this->_behaviourObjects as $behaviourObject) {
//            $behaviourObject->applyInsert(
//                $newId
//            );
//        }
//
//        return $newId;
//    }


}