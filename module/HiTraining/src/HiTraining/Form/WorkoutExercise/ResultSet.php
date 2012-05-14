<?php
namespace HiTraining\Form\WorkoutExercise;

use HiBase\Grid\SubForm\ResultSet\DbTable as GridDbTableResultSet;

class ResultSet extends GridDbTableResultSet
{


    protected $_title = 'WorkoutExerciseResultSet';
    protected $_name = 'WorkoutExerciseResultSet';

    public function init()
    {
        //
        parent::init();

//        $this->setAllFieldType(
//            'text'
//        );

        //
        $this->setFieldType('hr_min', 'text');
        $this->setFieldType('hr_max', 'text');
        $this->setFieldType('hr_avg', 'text');
        $this->setFieldType('fat_loss', 'text');
        $this->setFieldType('type_id', 'text');
        $this->setFieldType('exercise_calories_burned', 'text');


        $this->removeFields(array(
            'workout_id',
            'exercise_elapsed_time',
            'after_break_time',
            'speed',
            'angle',
            'level',
            'distance',
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
            'hiit_speed_low',
            'hiit_speed_high',
            'hiit_time_low',
            'hiit_time_high',
            'hiit_warmup_time',
            'hiit_interval_count',
            'cooldown_speed_start',
            'cooldown_speed_end',
            'cooldown_speed_interval',
            'cooldown_interval_time',
            'cooldown_interval_count',
            'avg_rpm',
            'avg_speed',
//            'hr_min',
//            'hr_max',
//            'hr_avg',
//            'fat_loss',
        ));

        $this->setFieldOptions('exercise_calories_burned', array(
            'label' => 'calories',
        ));
        $this->setFieldOptions('order', array(
            'style' => 'width:40px;',
        ));

        $this->setLoadAll(true);

        $this->setDbOrder(array('order asc'));

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
        $this->addResultSetAction(
            'back',
            'submit',
            array(
                'label'     => 'back',
                'class'     => 'actionImage',
                'image'     => BASE_URL . '/img/grid/icons/save.png',
                'onclick'   => 'goBack();return false;',
            )
        );

        $this->addResultSetAction(
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
        $this->addResultSetAction(
            'saveSelected',
            'submit',
            array(
                'label'     => 'save selected',
                'class'     => 'actionImage',
                'image'     => BASE_URL . '/img/grid/icons/save.png',
            )
        );

        //
        $this->addResultSetAction(
            'deleteSelected',
            'submit',
            array(
                'label'     => 'delete selected',
                'class'     => 'actionImage',
                'image'     => BASE_URL . '/img/grid/icons/save.png',
            )
        );




    }
}