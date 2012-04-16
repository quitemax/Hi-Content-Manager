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

/**
 * Refited Zend_Db_Table class for use with HiCms
 *
 * @category   HiZend
 * @package    HiZend_Db
 * @subpackage Table
 * @copyright  Copyright (c) 2009 Piotr Maxymilian Socha
 * @license
 */
class RowGateway extends ZendRowGateway
{

///**
//     * Delete
//     *
//     * @return type
//     */
//    public function delete()
//    {
//        \Zend\Debug::dump('HiBase\Db\RowGateway\RowGateway::delete()', '', true);
////        parent::delete();
//        \Zend\Debug::dump('HiBase\Db\RowGateway\RowGateway::delete()/after', '', true);
//        if (is_array($this->primaryKey)) {
//            // @todo compound primary keys
//        }
//
//        \Zend\Debug::dump($this->primaryKey, '$this->primaryKey', true);
//        \Zend\Debug::dump($this->originalData[$this->primaryKey], '$this->originalData[$this->primaryKey]', true);
//
//        $where = array($this->primaryKey => $this->originalData[$this->primaryKey]);
////        \Zend\Debug::dump($where, '$where', true);
////        \Zend\Debug::dump($this->tableGateway, '$this->tableGateway', true);
////        \Zend\Debug::dump(get_call_stack(), '', true);
////        \Zend\Debug::dump(get_class_methods($this->tableGateway), '', true);
//        return $this->tableGateway->delete($where);
//    }

    public function getId()
    {
        if (isset($this->originalData[$this->primaryKey])) {
            return $this->originalData[$this->primaryKey];
        } else {
            return false;
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
    }

    /**
     * Save
     *
     * @return integer
     */
    public function _afterSave()
    {
    }

}