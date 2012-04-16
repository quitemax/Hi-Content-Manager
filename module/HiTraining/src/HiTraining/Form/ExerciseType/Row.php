<?php

namespace HiTraining\Form\ExerciseType;

use HiBase\Grid\SubForm\Row\DbTable as GridDbTableRow;

class Row extends GridDbTableRow
{
    protected $_title = 'ExerciseTypeRow';
    protected $_name = 'ExerciseTypeRow';

    public function init()
    {
        //
        parent::init();

//        \HiZend\Debug\Debug::precho($this->_fields);
//        $this->setFieldPosition('lifting_series_1_break', 100);
//        $this->setFieldPosition('lifting_series_2_break', 105);
//        $this->setFieldPosition('lifting_series_3_break', 110);
//        $this->setFieldPosition('lifting_series_4_break', 115);
//        $this->setFieldPosition('lifting_series_5_break', 120);
//        $this->setFieldPosition('lifting_series_6_break', 125);
//
//        $this->setFieldPosition('lifting_series_1_weight', 101);
//        $this->setFieldPosition('lifting_series_2_weight', 106);
//        $this->setFieldPosition('lifting_series_3_weight', 111);
//        $this->setFieldPosition('lifting_series_4_weight', 116);
//        $this->setFieldPosition('lifting_series_5_weight', 121);
//        $this->setFieldPosition('lifting_series_6_weight', 126);
//
//        $this->setFieldPosition('lifting_series_1_count', 102);
//        $this->setFieldPosition('lifting_series_2_count', 107);
//        $this->setFieldPosition('lifting_series_3_count', 112);
//        $this->setFieldPosition('lifting_series_4_count', 117);
//        $this->setFieldPosition('lifting_series_5_count', 122);
//        $this->setFieldPosition('lifting_series_6_count', 127);
//
//
//
////        \HiZend\Debug\Debug::precho($this->_fields);
//
//
//
//
//        //
//        $this->setFieldType('type_id', 'select');
//        $this->addFieldOptions('type_id', array(
//            'required' => true,
//        ));
//
//        //
//        $this->setFieldType('workout_id', 'hidden');


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

