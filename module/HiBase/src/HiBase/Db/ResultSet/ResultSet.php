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
use HiBase\Object\CollectionInterface as HiBaseCollectionInterface;

/**
 * Refited Zend\Db\Table class for use with Hi
 *
 * @category   HiZend
 * @package    HiZend_Db
 * @subpackage Table
 * @copyright  Copyright (c) 2009 Piotr Maxymilian Socha
 * @license
 */
class ResultSet extends ZendResultSet implements HiBaseCollectionInterface
{
    public function getData()
    {

    }
}