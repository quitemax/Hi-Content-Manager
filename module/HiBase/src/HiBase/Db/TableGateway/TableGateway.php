<?php

namespace HiBase\Db\TableGateway;
/**
 * Hi CMS
 *
 * @category   HiZend
 * @package    HiZend_Db
 * @copyright  Copyright (c) 2009 Piotr Maxymilian Socha
 * @license
 */

use Zend\Db\TableGateway\TableGateway as ZendTableGateway,
    Zend\Db\Adapter\Adapter,
    Zend\Db\ResultSet\ResultSet,
    Zend\Db\Sql\Insert,
    Zend\Db\Sql\Update,
    Zend\Db\Sql\Delete,
    Zend\Db\Sql\Select,
    HiBase\Db\Behaviour\NestedSet;

/**
 * Refited Zend_Db_Table class for use with HiCms
 *
 * @category   HiZend
 * @package    HiZend_Db
 * @subpackage Table
 * @copyright  Copyright (c) 2009 Piotr Maxymilian Socha
 * @license
 */
class TableGateway extends ZendTableGateway
{
    /**
     *
     *
     * @var Zend\Db\Sql\Select contains last sql statement
     */
    protected $_lastSql;

	/**
     *
     *
     * @var string
     */
    protected $_name = null;

    /**
     *
     *
     * @var string
     */
    protected $_prefix = null;

    /**
     *
     *
     * @var string
     */
    protected $_columns = array();

    /**
     *
     *
     * @var string
     */
    protected $_primaryKey = null;

    /**
     *
     *
     * @var array
     */
    protected $_behaviours = array();

//    /**
//     *
//     *
//     * @var array
//     */
//    protected $_behaviourObjects = array();

	/**
     * Constructor
     *
     * @param string $tableName
     * @param Adapter $adapter
     * @param string $schema
     * @param ResultSet $selectResultPrototype
     */
    public function __construct($tableName, Adapter $adapter, $schema = null, ResultSet $selectResultPrototype = null)
    {
        parent::__construct($tableName, $adapter, $schema, $selectResultPrototype);

        $this->init();
    }

    /**
     *
     * Enter description here ...
     */
    protected function init()
    {
        $this->setTableDefinition();
        $this->setPrototypes();
        $this->setBehaviours();
    }

    /**
     *
     * Enter description here ...
     */
    protected function setBehaviours()
    {
    }

    /**
     *
     * Enter description here ...
     */
    protected function setPrototypes()
    {
    }

    /**
     *
     * Enter description here ...
     */
    public function setTableDefinition()
    {
    }

    /**
     *
     * Enter description here ...
     */
    public function getTableDefinition()
    {
        return $this->_columns;
    }


    /**
     *
     * Enter description here ...
     */
    public function createRow()
    {

        return clone $this->getSelectResultPrototype()->getRowObjectPrototype();
    }

    /**
     * Get table name (Hi use)
     *
     * @return string
     */
    public function getName() {
        return $this->_name;
    }

	/**
     * Get table name (Hi use)
     *
     * @return string
     */
    public function setName($name) {
        $this->_name = $name;;
    }

    /**
     * Get prefix name (Hi use)
     *
     * @return string
     */
    public function getPrefix() {
        return $this->_prefix;
    }

    /**
     * Get prefix name (Hi use)
     *
     * @return string
     */
    public function setPrefix($prefix) {
        $this->_prefix = $prefix;
    }

    /**
     * Get prefix name (Hi use)
     *
     * @return string
     */
    public function getPrimaryKey() {
        return $this->_primaryKey;
    }

    /**
     * Get prefix name (Hi use)
     *
     * @return string
     */
    public function setPrimaryKey($primaryKey) {
        $this->_primaryKey = $primaryKey;
    }


    /**
     *
     *
     * @return
     */
    public function hasColumn($columnName, $type, $length, $options)
    {

        $this->_columns[$columnName] = array(
            'type'      => $type,
            'length'    => $length,
            'options'   => $options,
        );

    }

	/**
     *
     *
     * @return
     */
    public function getColumn($columnName)
    {
        if (isset($this->_columns[$columnName])) {
            return $this->_columns[$columnName];
        }

        return false;
    }

    /**
     *
     *
     * @param $name string
     * @param $options array
     *
     * @return
     */
    public function setColumnOptions($columnName, $columnOptions) {
        //
        if (!is_array($columnOptions)) {
            throw new \Exception ('The options param in should be an array!');
        }

        //
        if (!empty($this->_columns[$columnName])) {
            if (is_array($this->_columns[$columnName]['options'])) {
                $this->_columns[$columnName]['options'] = array_merge($this->_columns[$columnName]['options'], $columnOptions);
            } else {
                $this->_columns[$columnName]['options'] = $columnOptions;
            }
        }

        return $this;
    }

    /**
     * Get all sql statement
     *
     * @return string
     */
    public function prepareResultSetSql($where = null, $order = null, $count = null, $offset  = null, $cols = null)
    {

//        /*@var $sqlSelect Zend_Db_Select*/
//        $sqlSelect = $this->_db->select();

        $sqlSelect = new Select();

//        $fromCols = array();
//        if ($cols !== null && is_array($cols) && count($cols)) {
//            $fromCols = $cols;
//        } else {
//            $fromCols[] =  $this->_prfx . '.*';
//        }
//
//        //from
//        $sqlSelect->columns(
//            array (
//                $this->_prfx => $this->_name,
//            ),
//            $fromCols
//        );

        $fromCols = array();
        if ($cols !== null && is_array($cols) && count($cols)) {
            $fromCols = $cols;
        } else {
            $fromCols[] =  '*';
        }

        //from
        $sqlSelect->columns(
            $fromCols,
            true
        );

        $sqlSelect->from($this->tableName, $this->schema);







//
//////        foreach ($this->_behaviourObjects as $behaviourObject) {
//////            $sqlSelect = $behaviourObject->applyBehaviourToSql(
//////                $sqlSelect,
//////                $where,
//////                $order,
//////                $count,
//////                $offset,
//////                $cols
//////            );
//////        }
////
//
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

        if ($where instanceof \Closure) {
            $where($select);
        } elseif ($where !== null) {
            $sqlSelect->where($where);
        }


        //limit
//        $sqlSelect->limit($count, $offset);

        //order
        $sqlSelect->order($order);
//        \Zend\Debug::dump($sqlSelect->getSqlString());
//        echo $sqlSelect->getSqlString();

        return $sqlSelect;
    }



    /**
     * Get all refited (Hi use)
     *
     * @return string
     */
    public function getResultSet($where = null, $order = null, $count = null, $offset  = null, $cols = null)
    {
        //prepare the sql
//        \Zend\Debug::dump($order);
        $sqlSelect = $this->prepareResultSetSql($where, $order, $count, $offset, $cols);

        \Zend\Debug::dump($sqlSelect);
        \Zend\Debug::dump($sqlSelect->getSqlString());
        echo $sqlSelect->getSqlString();

        //save sql
        $this->_lastSql = $sqlSelect;

        $statement = $this->adapter->createStatement();
        $sqlSelect->prepareStatement($this->adapter, $statement);

//        \Zend\Debug::dump($sqlSelect, '$sqlSelect');
//        \Zend\Debug::dump($statement, '$statement');
        $result = $statement->execute();

        //
        $resultSet = clone $this->selectResultPrototype;
        $resultSet->setDataSource($result);

//        \Zend\Debug::dump($resultSet);
//        \Zend\Debug::dump($resultSet->toArray());
//        foreach ($resultSet as $key => $row) {
////            \Zend\Debug::dump($key);
////            \Zend\Debug::dump($row);
////            \Zend\Debug::dump($row->toArray());
////            \Zend\Debug::dump($row->toArray());
//
//        }

        return $resultSet;

//        \HiZend\Debug\Debug::dump($sqlSelect->__toString());

//        \Zend\Debug::dump($sqlSelect);
//        \Zend\Debug::dump($result);




//        $stmt = $this->_db->query($sqlSelect);
//        $rows = $stmt->fetchAll(\Zend\Db\Db::FETCH_ASSOC);
//
//        $data  = array(
//            'table'    => $this,
//            'data'     => $rows,
////            'readOnly' => $sqlSelect->isReadOnly(),
//            'rowClass' => $this->getRowClass(),
//            'stored'   => true
//        );
//
//        $rowsetClass = $this->getRowsetClass();
//        $rowSet =  new $rowsetClass($data);
//
//        if (!$rowSet) {
//            return false;
//        }
//
////        \HiZend\Debug\Debug::precho($rows, '$rows');
//
//
////
////
////        foreach ($this->_behaviourObjects as $behaviourObject) {
////            $allItems = $behaviourObject->modifyResults(
////                $allItems,
////                $where,
////                $order,
////                $count,
////                $offset,
////                $cols
////            );
////        }
////
////        //
//        return $rowSet;
    }

    /**
     * Get row
     *
     * @return array
     */
    public function getRow($where = null, $order = null, $offset = null, $cols = null)
    {
        //prepare the sql
        $sqlSelect = $this->prepareResultSetSql($where, $order, 1, $offset, $cols);
////        Zend_Debug::dump($sqlSelect->__toString());
//
        //
        $this->_lastSql = $sqlSelect;

        $statement = $this->adapter->createStatement();
        $sqlSelect->prepareStatement($this->adapter, $statement);

//        \Zend\Debug::dump($sqlSelect, '', true);

        $result = $statement->execute();
//        \Zend\Debug::dump($result, '$result', true);
//        \Zend\Debug::dump($result->current(), '$result->current()', true);

        $row = clone $this->selectResultPrototype->getRowObjectPrototype();
        $row->exchangeArray($result->current());
//        \Zend\Debug::dump($row, '', true);
        //
//        $resultSet = clone $this->selectResultPrototype;
//        $resultSet->setDataSource($result);
//        return $result->current();
        return $row;



//
//        //
//        $stmt = $this->_db->query($sqlSelect);
//        $rows = $stmt->fetchAll(\Zend\Db\Db::FETCH_ASSOC);
//
//        if (count($rows) == 0) {
//            return null;
//        }
//
//        $data = array(
//            'table'   => $this,
//            'data'     => $rows[0],
////            'readOnly' => $sqlSelect->isReadOnly(),
//            'stored'  => true
//        );
//
//        $rowClass = $this->getRowClass();
//        return new $rowClass($data);
////
////        //
////        if (count($item)) {
////            foreach ($this->_behaviourObjects as $behaviourObject) {
////                $item = $behaviourObject->modifyResults(
////                    $item,
////                    $where,
////                    $order,
////                    1,
////                    $offset,
////                    $cols
////                );
////            }
////
////            $item = array_pop($item);
////        } else {
////            $item = false;
////        }
////        return $item;
////
    }

//    /**
//     * Get row
//     *
//     * @return array
//     */
//    public function getCol($where = null, $order = null, $count = null, $offset  = null, $col = null)
//    {
////        //prepare the sql
////        $sqlSelect = $this->prepareGetAllSql($where, $order, $count, $offset, $col);
////        echo $sqlSelect;
////
////        //
////        $this->_lastSql = $sqlSelect;
////
////        //
////        $items = $this->_db->fetchCol($sqlSelect);
////
////        //
////
////        foreach ($this->_behaviourObjects as $behaviourObject) {
////            $items = $behaviourObject->modifyResults(
////                $items,
////                $where,
////                $order,
////                $count,
////                $offset,
////                $col
////            );
////        }
////
////        return $items;
////
//    }
////
//    public function info($key = null) {
//        //
//        $info = parent::info($key);
//
//
////        //
////        foreach ($this->_behaviourObjects as $behaviourObject) {
////            $info = $behaviourObject->modifyInfo(
////                $info
////            );
////        }
////
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
////        //prepare the sql
////        $sqlSelect = $this->prepareGetAllSql(
////            $where,
////            null,
////            null,
////            null,
////            array(
////                'count' => 'COUNT(*)',
////            )
////        );
//////        echo $sqlSelect;
////
////        //
////        $this->_lastSql = $sqlSelect;
////
////        //
////        return $this->_db->fetchOne($sqlSelect);
//    }
//
//    public function getCountLastSql()
//    {
//        if ($this->_lastSql instanceof Select) {
////
////            //
//            $lastSql = $this->_lastSql;
//
//            $lastSql->reset(Select::COLUMNS);
//            $lastSql->reset(Select::GROUP);
//            $lastSql->reset(Select::ORDER);
//            $lastSql->reset(Select::LIMIT_COUNT);
//            $lastSql->reset(Select::LIMIT_OFFSET);
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
    /*
     * Get table name (Hi use)
     *
     * @return string
     */
    public function hasBehaviour($behaviour = null) {
        return isset($this->_behaviours[$behaviour]);
    }

    /**
     * Get table name (Hi use)
     *
     * @return string
     */
    public function getBehaviour($behaviour = null) {

        if (isset($this->_behaviours[$behaviour])) {
            return $this->_behaviours[$behaviour];
        }

        return false;
    }

    /**
     * Get table name (Hi use)
     *
     * @return string
     */
    public function setBehaviour($behaviour = null, $options = null) {

//        foreach ($this->_behaviours as $behaviourName => $behaviourOptions) {
            switch ($behaviour) {
//                case 'i18n':
//                    $behaviourObject = new I18n(
//                        $this,
//                        $options
//                    );
//                    $this->_behaviours[$behaviour] = $behaviourObject;
//                    break;
                case 'nestedSet':
                    $behaviourObject = new NestedSet(
                        $this,
                        $options
                    );
                    $this->_behaviours[$behaviour] = $behaviourObject;
                    break;
                default:
                    break;
            }



//            }
//    if (isset($this->_behaviourObjects[$behaviour])) {
//            return $this->_behaviourObjects[$behaviour];
//        }
    }
////
////
////    public function update($data = null, $where = null) {
//////        Zend_Debug::dump($data);
//////        Zend_Debug::dump($where);
////        foreach ($this->_behaviourObjects as $behaviourObject) {
////            $behaviourObject->modifyUpdate(
////                $data,
////                $where
////            );
//////            Zend_Debug::dump($data);
//////            Zend_Debug::dump($where);
////        }
////
////        parent::update($data, $where);
////    }
////
////    public function insert($data = null) {
////
//////        Zend_Debug::dump($data);
////
////        //
////        foreach ($this->_behaviourObjects as $behaviour => $behaviourObject) {
////            $behaviourObject->prepareInsert(
////                $data
////            );
//////            Zend_Debug::dump($data, 'Data after prepareInsert ' . $behaviour);
////        }
////
////        //
//////        Zend_Debug::dump($data, 'insertData');
////        $newId = parent::insert($data);
////
////        //
////        foreach ($this->_behaviourObjects as $behaviourObject) {
////            $behaviourObject->applyInsert(
////                $newId
////            );
////        }
////
////        return $newId;
////    }
//

    /**
     * Delete
     *
     * @param  Closure $where
     * @return type
     */
    public function delete($where)
    {
        $delete = new Delete($this->tableName, $this->schema);;
//        $delete->from($this->tableName, $this->schema);
        if ($where instanceof \Closure) {
            $where($delete);
        } else {
            $delete->where($where);
        }

        $statement = $this->adapter->createStatement();
        $delete->prepareStatement($this->adapter, $statement);

        $result = $statement->execute();
        return $result->getAffectedRows();
    }

    /**
     * Update
     *
     * @param  array $set
     * @param  string|array|closure $where
     * @return int
     */
    public function update($set, $where = null)
    {
        $update = new Update($this->tableName, $this->schema);
//        $update->table($this->tableName, $this->schema);
        $update->set($set);
        $update->where($where);

        $statement = $this->adapter->createStatement();
        $update->prepareStatement($this->adapter, $statement);

        $result = $statement->execute();
        return $result->getAffectedRows();
    }

}