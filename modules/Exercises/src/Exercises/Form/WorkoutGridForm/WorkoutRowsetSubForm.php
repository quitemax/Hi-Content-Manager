<?php
namespace Exercises\Form\WorkoutGridForm;

use Hi\Grid\SubForm\Rowset\DbTable as GridDbTableRowset;

class WorkoutRowsetSubForm extends GridDbTableRowset
{

    protected $_title = 'WorkoutRowset';
    protected $_name = 'WorkoutRowset';

    public function init()
    {
        $this->setName($this->_name);
        parent::init();



        /**
         * RECORD ACTIONS
         */
        $this->addRowAction(
            'edit',
            'image',
            array(
                'label'     => 'edit',
                'image'     => BASE_URL . '/img/grid/icons/edit.png',
                'class'     => 'actionImage',
                'onclick'   => 'editRow(__ID__);return false;',
            )
        );
        $this->addRowAction(
            'delete',
            'image',
            array(
                'label'     => 'delete',
                'image'     => BASE_URL . '/img/grid/icons/delete.png',
                'class'     => 'actionImage',
                'onclick'   => 'deleteRow(__ID__);return false;',
            )
        );
//        $this->addRecordAction(
//            'cache',
//            'image',
//            array(
//                'label'     => 'cache',
//                'image'     => $this->_publicUrl . '/img/admin/icons/record/cache.png',
//                'class'     => 'actionImage',
//                'onclick'   => '',
//            )
//        );

        /**
         * LIST ACTIONS
         */
        $this->addRowsetAction(
            'add',
            'image',
            array(
                'label'     => 'add',
                'class'     => 'actionImage',
                'image'     => BASE_URL . '/img/grid/icons/new.png',
                'onclick'   => 'addRow();return false;',
            )
        );

        //
        $this->addRowsetAction(
            'save',
            'image',
            array(
                'label'     => 'save',
                'class'     => 'actionImage',
                'image'     => BASE_URL . '/img/grid/icons/save.png',
            )
        );


    }
}