<?php
namespace HiTraining\Form\CheckupToProfile;

use HiBase\Grid\SubForm\ResultSet\DbTable as GridDbTableResultSet;

class ResultSet extends GridDbTableResultSet
{

    protected $_title = 'CheckupToProfileResultSet';
    protected $_name = 'CheckupToProfileResultSetSubForm';

    public function init()
    {
        //
        parent::init();

//        $this->setFieldType('name', 'text');
//        $this->setFieldType('default', 'text');
//        $this->setFieldOptions('default', array(
//            'values' => array(
//                '0' => 'No',
//                '1' => 'Yes',
//            ),
//
//        ));

        $this->setAllFieldType(
            'text'
        );

        $this->removeFields(
            array(
                'profile_id',
            )

        );

        /**
         * RECORD ACTIONS
         */

        $this->addRowAction(
            'delete',
            'submit',
            array(
                'label'     => 'delete',
                'image'     => BASE_URL . '/img/grid/icons/delete.png',
                'class'     => 'actionImage',
            )
        );


        /**
         * LIST ACTIONS
         */

        /**
         * LIST ACTIONS
         */
        $this->addResultSetAction(
            'massDelete',
            'submit',
            array(
                'label'     => 'mass delete',
                'class'     => 'actionImage',
                'image'     => BASE_URL . '/img/grid/icons/new.png',
                'onclick'   => 'massDelete();return false;',
            )
        );

    }
}