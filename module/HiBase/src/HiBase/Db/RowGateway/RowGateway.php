<?php

namespace HiBase\Db\RowGateway;
/**
 * Hi CMS
 *
 * @category   HiZend
 * @package    HiZend_Db
 * @copyright  Copyright (c) 2009 Piotr Maxymilian Socha
 * @license
 */

use Zend\Db\RowGateway\RowGateway as ZendRowGateway;
use Zend\Db\Adapter\Adapter;
use Zend\Db\TableGateway\TableGateway;
use Zend\Db\ResultSet\Row;
use Zend\Db\ResultSet\RowObjectInterface;
use Zend\Db\Sql;
use HiBase\Object\ObjectInterface as HiBaseObjectInterface;

/**
 * Refited Zend_Db_Table class for use with HiCms
 *
 * @category   HiZend
 * @package    HiZend_Db
 * @subpackage Table
 * @copyright  Copyright (c) 2009 Piotr Maxymilian Socha
 * @license
 */
class RowGateway extends ZendRowGateway implements HiBaseObjectInterface
{

    protected $_tableGateway = null;

	/**
     * Constructor
     *
     * @param string $tableGateway
     * @param string|Sql\TableIdentifier $table
     * @param Adapter $adapter
     * @param Sql\Sql $sql
     * @param TableGateway $tableGateway
     */
    public function __construct($primaryKey, $table, Adapter $adapter = null, Sql\Sql $sql = null, TableGateway $tableGateway = null)
    {
        parent::__construct($primaryKey, $table, $adapter, $sql);

        $this->_tableGateway = $tableGateway;
    }

    public function getData()
    {

    }

    /**
     * Delete
     *
     * @return type
     */
    public function delete()
    {

        if (is_array($this->primaryKey)) {
            // @todo compound primary keys
        }

        $where = array($this->primaryKey => $this->originalData[$this->primaryKey]);

        $delete = $this->sql->delete();
        $delete->where($where);

        $statement = $this->sql->prepareStatementFromSqlObject($delete);

        $result = $statement->execute();
        return $result->getAffectedRows();
    }

    public function getId()
    {
        if (isset($this->originalData[$this->primaryKey])) {
            return $this->originalData[$this->primaryKey];
        } else {
            return false;
        }
    }

    public function getOriginalData($index = null)
    {
        if ($index === null) {
            return $this->originalData;
        } else if (isset($this->originalData[$index])) {
            return $this->originalData[$index];
        } else {
            return null;
        }
    }

    /**
     * Save
     *
     * @return integer
     */
    public function save()
    {
        $this->_beforeSave();

        parent::save();

        $this->_afterSave();


    }

    /**
     * Save
     *
     * @return integer
     */
    protected function _beforeSave()
    {

//        if ( $this->_tableGateway instanceof TableGateway) {
////            \Zend\Debug::dump($this->_tableGateway->getBehaviours(), 'beforesave');
//            $behaviours = $this->_tableGateway->getBehaviours();
//            if (is_array($behaviours) && count($behaviours)) {
//                foreach ($behaviours as $behaviour) {
//                    $behaviour->beforeSave($this);
//                }
//            }
//        }
    }

    /**
     * Save
     *
     * @return integer
     */
    protected function _afterSave()
    {
//        if ( $this->_tableGateway instanceof TableGateway) {
////            \Zend\Debug::dump($this->_tableGateway->getBehaviours(), 'beforesave');
//            $behaviours = $this->_tableGateway->getBehaviours();
//            if (is_array($behaviours) && count($behaviours)) {
//                foreach ($behaviours as $behaviour) {
////                    \Zend\Debug::dump(get_class($this), '_afterSave');
////                    \Zend\Debug::dump(get_class($behaviour), '_afterSave');
//                    $behaviour->afterSave($this);
//                }
//            }
//        }
    }

    /**
     * Save
     *
     * @return integer
     */
    protected function _afterLoad()
    {

    }

    /**
     * Save
     *
     * @return integer
     */
    protected function _beforeLoad()
    {
    }

    /**
     *
     *
     * @return
     */
    public function populate(array $rowData, $isOriginal = null)
    {
        $this->_beforeLoad();

        $return = parent::populate($rowData, $isOriginal);

        $this->_afterLoad();

        return $return;

    }

}