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