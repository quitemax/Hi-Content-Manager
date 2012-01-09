<?php

namespace Exercises\Form\WorkoutExerciseGrid;

use Hi\Grid\SubForm\Row\DbTable as GridDbTableRow;

class ExerciseRow extends GridDbTableRow
{
    protected $_title = 'WorkoutExerciseRow';
    protected $_name = 'WorkoutExerciseRow';

    public function init()
    {
        //
        parent::init();

//        $this->setFieldPosition('lifting_series_1_weight', 105);
//        $this->setFieldPosition('lifting_series_2_weight', 125);
//        $this->setFieldPosition('lifting_series_3_weight', 145);
//        $this->setFieldPosition('lifting_series_4_weight', 165);
//        $this->setFieldPosition('lifting_series_5_weight', 185);
//        $this->setFieldPosition('lifting_series_6_weight', 205);


        //
        $this->setFieldType('type_id', 'select');
        $this->addFieldOptions('type_id', array(
            'required' => true,
        ));

        //
        $this->setFieldType('workout_id', 'hidden');


//        \HiZend\Debug\Debug::precho($this->_fields);


        //
        $this->addAction(
            'back',
            'submit',
            array(
                'label'     => 'back',
                'class'     => 'actionImage',
//                'image'     => $this->_skinUrl . '/img/icons/record/back.png',
                'onclick'   => 'goBack(); return false;',
            )
        );
        $this->addAction(
            'save',
            'submit',
            array(
                'label'     => 'save',
                'class'     => 'actionImage',
//                'image'     => $this->_skinUrl . '/img/icons/record/save.png',
            )
        );

    }
}

