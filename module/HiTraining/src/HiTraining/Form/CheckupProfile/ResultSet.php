<?php
namespace HiTraining\Form\CheckupProfile;

use HiBase\Grid\SubForm\ResultSet\DbTable as GridDbTableResultSet;

class ResultSet extends GridDbTableResultSet
{

    protected $_title = 'CheckupProfileResultSet';
    protected $_name = 'CheckupProfileResultSetSubForm';

    public function init()
    {
        //
        parent::init();

        $this->setFieldType('name', 'text');
        $this->setFieldType('default', 'text');
        $this->setFieldOptions('default', array(
            'values' => array(
                '0' => 'No',
                '1' => 'Yes',
            ),

        ));

//        $this->setAllFieldType(
//            'text'
//        );
//
//        $this->removeFields(
//            array(
//                'calories_activeless',
//                'calories_active',
//                'biceps_circumference',
//                'waist_circumference',
//                'chest_circumference',
//                'neck_circumference',
//            )
//
//        );
//
        /**
         * RECORD ACTIONS
         */
        $this->addRowAction(
            'edit',
            'submit',
            array(
                'label'     => 'edit',
                'image'     => BASE_URL . '/img/grid/icons/edit.png',
                'class'     => 'actionImage',
                'onclick'   => 'editRow(__ID__);return false;',
            )
        );
        $this->addRowAction(
            'delete',
            'submit',
            array(
                'label'     => 'delete',
                'image'     => BASE_URL . '/img/grid/icons/delete.png',
                'class'     => 'actionImage',
                'onclick'   => 'deleteRow(__ID__);return false;',
            )
        );


        /**
         * LIST ACTIONS
         */
        $this->addResultSetAction(
            'add',
            'submit',
            array(
                'label'     => 'add profile',
                'class'     => 'actionImage',
                'image'     => BASE_URL . '/img/grid/icons/new.png',
                'onclick'   => 'addRow();return false;',
            )
        );
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