<?php
namespace HiTraining\Form\Checkup;

use HiBase\Grid\SubForm\ResultSet\DbTable as GridDbTableResultSet;

class ResultSet extends GridDbTableResultSet
{

    protected $_title = 'CheckupResultSet';
    protected $_name = 'CheckupResultSetSubForm';

    public function init()
    {
        //
        parent::init();

        $this->setAllFieldType(
            'text'
        );

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
                'label'     => 'add checkup',
                'class'     => 'actionImage',
                'image'     => BASE_URL . '/img/grid/icons/new.png',
                'onclick'   => 'addRow();return false;',
            )
        );
        /**
         * LIST ACTIONS
         */
        $this->addResultSetAction(
            'mass-delete',
            'submit',
            array(
                'label'     => 'mass delete',
                'class'     => 'actionImage',
                'image'     => BASE_URL . '/img/grid/icons/new.png',
                'onclick'   => 'deleteSelected();return false;',
            )
        );

    }
}