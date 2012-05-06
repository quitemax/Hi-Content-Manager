<?php
namespace HiTraining\Form\Workout;

use HiBase\Grid\SubForm\ResultSet\DbTable as GridDbTableResultSet;

class ResultSet extends GridDbTableResultSet
{

    protected $_title = 'WorkoutResultSet';
    protected $_name = 'WorkoutResultSet';

    public function init()
    {
        //
        parent::init();


        $this->addField(
            'exercises_count',
            'text',
            array(
                'label'     => 'exercises_count',
                'sortable'  => true,
                'sql'    => '(' . $this->_model->getWorkoutExercisesCountSql() . ')',
            )
        );

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
        $this->addRowAction(
            'exercises',
            'submit',
            array(
                'label'     => 'exercises',
                'image'     => BASE_URL . '/img/grid/icons/delete.png',
                'class'     => 'actionImage',
                'onclick'   => 'exercises(__ID__);return false;',
            )
        );
//        $this->addRowAction(
//            'add-exercise',
//            'submit',
//            array(
//                'label'     => 'add exercise',
//                'image'     => BASE_URL . '/img/grid/icons/delete.png',
//                'class'     => 'actionImage',
//                'onclick'   => 'addExercise(__ID__);return false;',
//            )
//        );



        /**
         * LIST ACTIONS
         */
        $this->addResultSetAction(
            'add',
            'submit',
            array(
                'label'     => 'add workout',
                'class'     => 'actionImage',
                'image'     => BASE_URL . '/img/grid/icons/new.png',
                'onclick'   => 'addRow();return false;',
            )
        );

        $this->addResultSetAction(
            'massRecount',
            'submit',
            array(
                'label'     => 'mass recount',
                'image'     => BASE_URL . '/img/grid/icons/delete.png',
                'class'     => 'actionImage',
                'onclick'   => 'recount(__ID__);return false;',
            )
        );

        //
        $this->addResultSetAction(
            'massDelete',
            'submit',
            array(
                'label'     => 'mass delete',
                'class'     => 'actionImage',
                'image'     => BASE_URL . '/img/grid/icons/save.png',
            )
        );


    }
}