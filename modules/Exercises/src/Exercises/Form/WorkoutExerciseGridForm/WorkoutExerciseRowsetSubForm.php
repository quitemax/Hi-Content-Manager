<?php
namespace Exercises\Form\WorkoutExerciseGridForm;

use Hi\Grid\SubForm\Rowset\DbTable as GridDbTableRowset;

class WorkoutExerciseRowsetSubForm extends GridDbTableRowset
{

    protected $_title = 'WorkoutExerciseRowset';
    protected $_name = 'WorkoutExerciseRowset';

    public function init()
    {
        //
        parent::init();

        $this->removeFields(array(
            'workout_id',
            'elapsed_time',
            'speed',
            'angle',
            'level',
            'lifting_series_1_count',
            'lifting_series_2_count',
            'lifting_series_3_count',
            'lifting_series_4_count',
            'lifting_series_5_count',
            'lifting_series_6_count',
            'lifting_series_1_break',
            'lifting_series_2_break',
            'lifting_series_3_break',
            'lifting_series_4_break',
            'lifting_series_5_break',
            'lifting_series_6_break',
            'lifting_series_1_weight',
            'lifting_series_2_weight',
            'lifting_series_3_weight',
            'lifting_series_4_weight',
            'lifting_series_5_weight',
            'lifting_series_6_weight',
            'distance',
        ));

        $this->setLoadAll(true);

        $this->setFieldType('type_id', 'text');

        $this->addDbOrder('order', 'asc');

        /**
         * RECORD ACTIONS
         */
        $this->addRowAction(
            'edit',
            'submit',
            array(
                'label'     => 'edit',
//                'image'     => BASE_URL . '/img/grid/icons/edit.png',
                'class'     => 'actionImage',
                'onclick'   => 'editRow(__ID__);return false;',
            )
        );
        $this->addRowAction(
            'delete',
            'submit',
            array(
                'label'     => 'delete',
//                'image'     => BASE_URL . '/img/grid/icons/delete.png',
                'class'     => 'actionImage',
                'onclick'   => 'deleteRow(__ID__);return false;',
            )
        );



        /**
         * LIST ACTIONS
         */
        //
        $this->addRowsetAction(
            'back',
            'submit',
            array(
                'label'     => 'back',
                'class'     => 'actionImage',
                'image'     => BASE_URL . '/img/grid/icons/save.png',
                'onclick'   => 'addRow();return false;',
            )
        );

        $this->addRowsetAction(
            'add',
            'submit',
            array(
                'label'     => 'add exercise',
                'class'     => 'actionImage',
                'image'     => BASE_URL . '/img/grid/icons/new.png',
                'onclick'   => 'addRow();return false;',
            )
        );

        //
        $this->addRowsetAction(
            'save',
            'submit',
            array(
                'label'     => 'save selected',
                'class'     => 'actionImage',
                'image'     => BASE_URL . '/img/grid/icons/save.png',
            )
        );

        //
        $this->addRowsetAction(
            'delete',
            'submit',
            array(
                'label'     => 'delete selected',
                'class'     => 'actionImage',
                'image'     => BASE_URL . '/img/grid/icons/save.png',
                'onclick'   => 'addRow();return false;',
            )
        );




    }
}