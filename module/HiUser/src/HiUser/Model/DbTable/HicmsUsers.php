<?php
class User_Model_DbTable_HicmsUsers extends HiZend_Db_Table
{
    //
    protected   $_name      =   'hicms_users';
    protected   $_priamry   =   'hu_id';

    //
    protected $_prfx = 'hu';

    //
    protected $_username = 'hu_username';
    protected $_password = 'hu_password';

    protected $_referenceMap    = array(
        'Groups' => array(
            'columns'           => array('hu_hug_id'),
            'refTableClass'     => 'User_Model_DbTable_HicmsUsersGroups',
            'refColumns'        => array('hug_id'),
        ),
    );

    protected $_hiReferenceMap    = array(
        'Groups' => array(
            'refTable'      => array(
                'hug'  =>  'hicms_users_groups',
            ),
            'refConnection' => 'hu.hu_hug_id = hug.hug_id',
        ),
    );






    public function getUserPassword($username) {
        /* @var $sqlSelect Zend_Db_Select */
        $sqlSelect = $this->_db->select();
        $sqlSelect->from(
            array(
  	            $this->_prfx => $this->_name
  	        ),
  	        array(
  	            $this->_password
  	        )
  	    );

  	    //
  	    $sqlSelect->where(
            $this->_username . ' = ' . $this->_db->quote($username)
  	    );

        //
        $this->_lastSql = $sqlSelect;
        $tmpPassword = $this->_db->fetchOne($sqlSelect);
        return $tmpPassword;
    }

    public function getUser($username) {
        /* @var $sqlSelect Zend_Db_Select */
        $sqlSelect = $this->_db->select();

        //
        $sqlSelect->from(
            array(
                $this->_prfx => $this->_name
            ),
            array('*')
        );

        //
        $sqlSelect->joinLeft(
            $this->_hiReferenceMap['Groups']['refTable'],
            $this->_hiReferenceMap['Groups']['refConnection'],
            array('*')
        );

        //
        $sqlSelect->where(
            $this->_username . ' = ' . $this->_db->quote($username)
        );

        $this->_lastSql = $sqlSelect;
        $tmpUser = $this->_db->fetchRow($sqlSelect);

        $tmpUser['role'] = $tmpUser['hug_sys_name'];
        $tmpUser['superUser'] = $tmpUser['hu_is_super_user'];

        return $tmpUser;
    }
}