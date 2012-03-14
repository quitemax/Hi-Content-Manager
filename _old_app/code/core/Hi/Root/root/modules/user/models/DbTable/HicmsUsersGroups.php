<?php
class User_Model_DbTable_HicmsUsersGroups extends HiZend_Db_Table
{
    //
    protected   $_name      =   'hicms_users_groups';
    protected   $_priamry   =   'hug_id';

    protected $_dependentTables = array('User_Model_DbTable_HicmsUsers');

    //
    protected $_prfx = 'hug';





}