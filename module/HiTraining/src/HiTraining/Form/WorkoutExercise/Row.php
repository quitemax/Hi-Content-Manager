<?php
namespace HiTraining\Form\WorkoutExercise;

use HiBase\Grid\SubForm\Row\DbTable as GridDbTableRow,
    HiTraining\Model\ExerciseType;

class Row extends GridDbTableRow
{
    protected $_title = 'WorkoutExerciseRow';
    protected $_name = 'WorkoutExerciseRow';

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
        $this->setFieldType('type_id', 'select');
        $this->addFieldOptions('type_id', array(
            'required' => true,
        ));

        //
        $this->setFieldType('workout_id', 'hidden');

        //
        $this->removeField('avg_speed');


        /**
         *
         */
//        $this->addFieldOptions('order', array(
//            'form_0'                                            => '1',
//            'form_' .  ExerciseType::FORM_TYPE_TREADMILL        => '1',
//            'form_' .  ExerciseType::FORM_TYPE_LIFTING          => '0',
//            'form_' .  ExerciseType::FORM_TYPE_HIIT_TREADMILL   => '0',
//            'form_' .  ExerciseType::FORM_TYPE_ORBITREK         => '0',
//            'form_' .  ExerciseType::FORM_TYPE_STRECHING        => '0',
//            'form_' .  ExerciseType::FORM_TYPE_BIKE             => '0',
//        ));
        $this->addFieldOptions('exercise_elapsed_time', array(
            'form_0'                                            => '1',
            'form_' .  ExerciseType::FORM_TYPE_TREADMILL        => '1',
            'form_' .  ExerciseType::FORM_TYPE_LIFTING          => '1',
            'form_' .  ExerciseType::FORM_TYPE_HIIT_TREADMILL   => '1',
            'form_' .  ExerciseType::FORM_TYPE_ORBITREK         => '1',
            'form_' .  ExerciseType::FORM_TYPE_STRECHING        => '1',
            'form_' .  ExerciseType::FORM_TYPE_BIKE             => '1',
        ));
        $this->addFieldOptions('after_break_time', array(
            'form_0'                                            => '1',
            'form_' .  ExerciseType::FORM_TYPE_TREADMILL        => '1',
            'form_' .  ExerciseType::FORM_TYPE_LIFTING          => '1',
            'form_' .  ExerciseType::FORM_TYPE_HIIT_TREADMILL   => '1',
            'form_' .  ExerciseType::FORM_TYPE_ORBITREK         => '1',
            'form_' .  ExerciseType::FORM_TYPE_STRECHING        => '1',
            'form_' .  ExerciseType::FORM_TYPE_BIKE             => '1',
        ));
        $this->addFieldOptions('speed', array(
            'form_0'                                            => '1',
            'form_' .  ExerciseType::FORM_TYPE_TREADMILL        => '1',
            'form_' .  ExerciseType::FORM_TYPE_LIFTING          => '0',
            'form_' .  ExerciseType::FORM_TYPE_HIIT_TREADMILL   => '0',
            'form_' .  ExerciseType::FORM_TYPE_ORBITREK         => '0',
            'form_' .  ExerciseType::FORM_TYPE_STRECHING        => '0',
            'form_' .  ExerciseType::FORM_TYPE_BIKE             => '0',
        ));
        $this->addFieldOptions('angle', array(
            'form_0'                                            => '1',
            'form_' .  ExerciseType::FORM_TYPE_TREADMILL        => '1',
            'form_' .  ExerciseType::FORM_TYPE_LIFTING          => '0',
            'form_' .  ExerciseType::FORM_TYPE_HIIT_TREADMILL   => '1',
            'form_' .  ExerciseType::FORM_TYPE_ORBITREK         => '0',
            'form_' .  ExerciseType::FORM_TYPE_STRECHING        => '0',
            'form_' .  ExerciseType::FORM_TYPE_BIKE             => '0',
        ));
        $this->addFieldOptions('distance', array(
            'form_0'                                            => '1',
            'form_' .  ExerciseType::FORM_TYPE_TREADMILL        => '1',
            'form_' .  ExerciseType::FORM_TYPE_LIFTING          => '0',
            'form_' .  ExerciseType::FORM_TYPE_HIIT_TREADMILL   => '1',
            'form_' .  ExerciseType::FORM_TYPE_ORBITREK         => '1',
            'form_' .  ExerciseType::FORM_TYPE_STRECHING        => '0',
            'form_' .  ExerciseType::FORM_TYPE_BIKE             => '1',
        ));
        $this->addFieldOptions('exercise_calories_burned', array(
            'form_0'                                            => '1',
            'form_' .  ExerciseType::FORM_TYPE_TREADMILL        => '1',
            'form_' .  ExerciseType::FORM_TYPE_LIFTING          => '1',
            'form_' .  ExerciseType::FORM_TYPE_HIIT_TREADMILL   => '1',
            'form_' .  ExerciseType::FORM_TYPE_ORBITREK         => '1',
            'form_' .  ExerciseType::FORM_TYPE_STRECHING        => '1',
            'form_' .  ExerciseType::FORM_TYPE_BIKE             => '1',
        ));
        $this->addFieldOptions('level', array(
            'form_0'                                            => '1',
            'form_' .  ExerciseType::FORM_TYPE_TREADMILL        => '1',
            'form_' .  ExerciseType::FORM_TYPE_LIFTING          => '0',
            'form_' .  ExerciseType::FORM_TYPE_HIIT_TREADMILL   => '0',
            'form_' .  ExerciseType::FORM_TYPE_ORBITREK         => '1',
            'form_' .  ExerciseType::FORM_TYPE_STRECHING        => '0',
            'form_' .  ExerciseType::FORM_TYPE_BIKE             => '1',
        ));
        $this->addFieldOptions('avg_rpm', array(
            'form_0'                                            => '1',
            'form_' .  ExerciseType::FORM_TYPE_TREADMILL        => '0',
            'form_' .  ExerciseType::FORM_TYPE_LIFTING          => '0',
            'form_' .  ExerciseType::FORM_TYPE_HIIT_TREADMILL   => '0',
            'form_' .  ExerciseType::FORM_TYPE_ORBITREK         => '0',
            'form_' .  ExerciseType::FORM_TYPE_STRECHING        => '0',
            'form_' .  ExerciseType::FORM_TYPE_BIKE             => '1',
        ));
        $this->addFieldOptions('avg_speed', array(
            'form_0'                                            => '1',
            'form_' .  ExerciseType::FORM_TYPE_TREADMILL        => '1',
            'form_' .  ExerciseType::FORM_TYPE_LIFTING          => '0',
            'form_' .  ExerciseType::FORM_TYPE_HIIT_TREADMILL   => '0',
            'form_' .  ExerciseType::FORM_TYPE_ORBITREK         => '0',
            'form_' .  ExerciseType::FORM_TYPE_STRECHING        => '0',
            'form_' .  ExerciseType::FORM_TYPE_BIKE             => '0',
        ));
        $this->addFieldOptions('hr_min', array(
            'form_0'                                            => '1',
            'form_' .  ExerciseType::FORM_TYPE_TREADMILL        => '1',
            'form_' .  ExerciseType::FORM_TYPE_LIFTING          => '1',
            'form_' .  ExerciseType::FORM_TYPE_HIIT_TREADMILL   => '1',
            'form_' .  ExerciseType::FORM_TYPE_ORBITREK         => '1',
            'form_' .  ExerciseType::FORM_TYPE_STRECHING        => '1',
            'form_' .  ExerciseType::FORM_TYPE_BIKE             => '1',
        ));
        $this->addFieldOptions('hr_max', array(
            'form_0'                                            => '1',
            'form_' .  ExerciseType::FORM_TYPE_TREADMILL        => '1',
            'form_' .  ExerciseType::FORM_TYPE_LIFTING          => '1',
            'form_' .  ExerciseType::FORM_TYPE_HIIT_TREADMILL   => '1',
            'form_' .  ExerciseType::FORM_TYPE_ORBITREK         => '1',
            'form_' .  ExerciseType::FORM_TYPE_STRECHING        => '1',
            'form_' .  ExerciseType::FORM_TYPE_BIKE             => '1',
        ));
        $this->addFieldOptions('hr_avg', array(
            'form_0'                                            => '1',
            'form_' .  ExerciseType::FORM_TYPE_TREADMILL        => '1',
            'form_' .  ExerciseType::FORM_TYPE_LIFTING          => '1',
            'form_' .  ExerciseType::FORM_TYPE_HIIT_TREADMILL   => '1',
            'form_' .  ExerciseType::FORM_TYPE_ORBITREK         => '1',
            'form_' .  ExerciseType::FORM_TYPE_STRECHING        => '1',
            'form_' .  ExerciseType::FORM_TYPE_BIKE             => '1',
        ));
        $this->addFieldOptions('fat_loss', array(
            'form_0'                                            => '1',
            'form_' .  ExerciseType::FORM_TYPE_TREADMILL        => '1',
            'form_' .  ExerciseType::FORM_TYPE_LIFTING          => '1',
            'form_' .  ExerciseType::FORM_TYPE_HIIT_TREADMILL   => '1',
            'form_' .  ExerciseType::FORM_TYPE_ORBITREK         => '1',
            'form_' .  ExerciseType::FORM_TYPE_STRECHING        => '1',
            'form_' .  ExerciseType::FORM_TYPE_BIKE             => '1',
        ));



        $this->addFieldOptions('lifting_series_1_count', array(
            'form_0'                                            => '1',
            'form_' .  ExerciseType::FORM_TYPE_TREADMILL        => '0',
            'form_' .  ExerciseType::FORM_TYPE_LIFTING          => '1',
            'form_' .  ExerciseType::FORM_TYPE_HIIT_TREADMILL   => '0',
            'form_' .  ExerciseType::FORM_TYPE_ORBITREK         => '0',
            'form_' .  ExerciseType::FORM_TYPE_STRECHING        => '0',
            'form_' .  ExerciseType::FORM_TYPE_BIKE             => '0',
        ));
        $this->addFieldOptions('lifting_series_1_break', array(
            'form_0'                                            => '1',
            'form_' .  ExerciseType::FORM_TYPE_TREADMILL        => '0',
            'form_' .  ExerciseType::FORM_TYPE_LIFTING          => '1',
            'form_' .  ExerciseType::FORM_TYPE_HIIT_TREADMILL   => '0',
            'form_' .  ExerciseType::FORM_TYPE_ORBITREK         => '0',
            'form_' .  ExerciseType::FORM_TYPE_STRECHING        => '0',
            'form_' .  ExerciseType::FORM_TYPE_BIKE             => '0',
        ));
        $this->addFieldOptions('lifting_series_1_weight', array(
            'form_0'                                            => '1',
            'form_' .  ExerciseType::FORM_TYPE_TREADMILL        => '0',
            'form_' .  ExerciseType::FORM_TYPE_LIFTING          => '1',
            'form_' .  ExerciseType::FORM_TYPE_HIIT_TREADMILL   => '0',
            'form_' .  ExerciseType::FORM_TYPE_ORBITREK         => '0',
            'form_' .  ExerciseType::FORM_TYPE_STRECHING        => '0',
            'form_' .  ExerciseType::FORM_TYPE_BIKE             => '0',
        ));


        $this->addFieldOptions('lifting_series_2_count', array(
            'form_0'                                            => '1',
            'form_' .  ExerciseType::FORM_TYPE_TREADMILL        => '0',
            'form_' .  ExerciseType::FORM_TYPE_LIFTING          => '1',
            'form_' .  ExerciseType::FORM_TYPE_HIIT_TREADMILL   => '0',
            'form_' .  ExerciseType::FORM_TYPE_ORBITREK         => '0',
            'form_' .  ExerciseType::FORM_TYPE_STRECHING        => '0',
            'form_' .  ExerciseType::FORM_TYPE_BIKE             => '0',
        ));
        $this->addFieldOptions('lifting_series_2_break', array(
            'form_0'                                            => '1',
            'form_' .  ExerciseType::FORM_TYPE_TREADMILL        => '0',
            'form_' .  ExerciseType::FORM_TYPE_LIFTING          => '1',
            'form_' .  ExerciseType::FORM_TYPE_HIIT_TREADMILL   => '0',
            'form_' .  ExerciseType::FORM_TYPE_ORBITREK         => '0',
            'form_' .  ExerciseType::FORM_TYPE_STRECHING        => '0',
            'form_' .  ExerciseType::FORM_TYPE_BIKE             => '0',
        ));
        $this->addFieldOptions('lifting_series_2_weight', array(
            'form_0'                                            => '1',
            'form_' .  ExerciseType::FORM_TYPE_TREADMILL        => '0',
            'form_' .  ExerciseType::FORM_TYPE_LIFTING          => '1',
            'form_' .  ExerciseType::FORM_TYPE_HIIT_TREADMILL   => '0',
            'form_' .  ExerciseType::FORM_TYPE_ORBITREK         => '0',
            'form_' .  ExerciseType::FORM_TYPE_STRECHING        => '0',
            'form_' .  ExerciseType::FORM_TYPE_BIKE             => '0',
        ));


        $this->addFieldOptions('lifting_series_3_count', array(
            'form_0'                                            => '1',
            'form_' .  ExerciseType::FORM_TYPE_TREADMILL        => '0',
            'form_' .  ExerciseType::FORM_TYPE_LIFTING          => '1',
            'form_' .  ExerciseType::FORM_TYPE_HIIT_TREADMILL   => '0',
            'form_' .  ExerciseType::FORM_TYPE_ORBITREK         => '0',
            'form_' .  ExerciseType::FORM_TYPE_STRECHING        => '0',
            'form_' .  ExerciseType::FORM_TYPE_BIKE             => '0',
        ));
        $this->addFieldOptions('lifting_series_3_break', array(
            'form_0'                                            => '1',
            'form_' .  ExerciseType::FORM_TYPE_TREADMILL        => '0',
            'form_' .  ExerciseType::FORM_TYPE_LIFTING          => '1',
            'form_' .  ExerciseType::FORM_TYPE_HIIT_TREADMILL   => '0',
            'form_' .  ExerciseType::FORM_TYPE_ORBITREK         => '0',
            'form_' .  ExerciseType::FORM_TYPE_STRECHING        => '0',
            'form_' .  ExerciseType::FORM_TYPE_BIKE             => '0',
        ));
        $this->addFieldOptions('lifting_series_3_weight', array(
            'form_0'                                            => '1',
            'form_' .  ExerciseType::FORM_TYPE_TREADMILL        => '0',
            'form_' .  ExerciseType::FORM_TYPE_LIFTING          => '1',
            'form_' .  ExerciseType::FORM_TYPE_HIIT_TREADMILL   => '0',
            'form_' .  ExerciseType::FORM_TYPE_ORBITREK         => '0',
            'form_' .  ExerciseType::FORM_TYPE_STRECHING        => '0',
            'form_' .  ExerciseType::FORM_TYPE_BIKE             => '0',
        ));


        $this->addFieldOptions('lifting_series_4_count', array(
            'form_0'                                            => '1',
            'form_' .  ExerciseType::FORM_TYPE_TREADMILL        => '0',
            'form_' .  ExerciseType::FORM_TYPE_LIFTING          => '1',
            'form_' .  ExerciseType::FORM_TYPE_HIIT_TREADMILL   => '0',
            'form_' .  ExerciseType::FORM_TYPE_ORBITREK         => '0',
            'form_' .  ExerciseType::FORM_TYPE_STRECHING        => '0',
            'form_' .  ExerciseType::FORM_TYPE_BIKE             => '0',
        ));
        $this->addFieldOptions('lifting_series_4_break', array(
            'form_0'                                            => '1',
            'form_' .  ExerciseType::FORM_TYPE_TREADMILL        => '0',
            'form_' .  ExerciseType::FORM_TYPE_LIFTING          => '1',
            'form_' .  ExerciseType::FORM_TYPE_HIIT_TREADMILL   => '0',
            'form_' .  ExerciseType::FORM_TYPE_ORBITREK         => '0',
            'form_' .  ExerciseType::FORM_TYPE_STRECHING        => '0',
            'form_' .  ExerciseType::FORM_TYPE_BIKE             => '0',
        ));
        $this->addFieldOptions('lifting_series_4_weight', array(
            'form_0'                                            => '1',
            'form_' .  ExerciseType::FORM_TYPE_TREADMILL        => '0',
            'form_' .  ExerciseType::FORM_TYPE_LIFTING          => '1',
            'form_' .  ExerciseType::FORM_TYPE_HIIT_TREADMILL   => '0',
            'form_' .  ExerciseType::FORM_TYPE_ORBITREK         => '0',
            'form_' .  ExerciseType::FORM_TYPE_STRECHING        => '0',
            'form_' .  ExerciseType::FORM_TYPE_BIKE             => '0',
        ));


        $this->addFieldOptions('lifting_series_5_count', array(
            'form_0'                                            => '1',
            'form_' .  ExerciseType::FORM_TYPE_TREADMILL        => '0',
            'form_' .  ExerciseType::FORM_TYPE_LIFTING          => '1',
            'form_' .  ExerciseType::FORM_TYPE_HIIT_TREADMILL   => '0',
            'form_' .  ExerciseType::FORM_TYPE_ORBITREK         => '0',
            'form_' .  ExerciseType::FORM_TYPE_STRECHING        => '0',
            'form_' .  ExerciseType::FORM_TYPE_BIKE             => '0',
        ));
        $this->addFieldOptions('lifting_series_5_break', array(
            'form_0'                                            => '1',
            'form_' .  ExerciseType::FORM_TYPE_TREADMILL        => '0',
            'form_' .  ExerciseType::FORM_TYPE_LIFTING          => '1',
            'form_' .  ExerciseType::FORM_TYPE_HIIT_TREADMILL   => '0',
            'form_' .  ExerciseType::FORM_TYPE_ORBITREK         => '0',
            'form_' .  ExerciseType::FORM_TYPE_STRECHING        => '0',
            'form_' .  ExerciseType::FORM_TYPE_BIKE             => '0',
        ));
        $this->addFieldOptions('lifting_series_5_weight', array(
            'form_0'                                            => '1',
            'form_' .  ExerciseType::FORM_TYPE_TREADMILL        => '0',
            'form_' .  ExerciseType::FORM_TYPE_LIFTING          => '1',
            'form_' .  ExerciseType::FORM_TYPE_HIIT_TREADMILL   => '0',
            'form_' .  ExerciseType::FORM_TYPE_ORBITREK         => '0',
            'form_' .  ExerciseType::FORM_TYPE_STRECHING        => '0',
            'form_' .  ExerciseType::FORM_TYPE_BIKE             => '0',
        ));


        $this->addFieldOptions('lifting_series_6_count', array(
            'form_0'                                            => '1',
            'form_' .  ExerciseType::FORM_TYPE_TREADMILL        => '0',
            'form_' .  ExerciseType::FORM_TYPE_LIFTING          => '1',
            'form_' .  ExerciseType::FORM_TYPE_HIIT_TREADMILL   => '0',
            'form_' .  ExerciseType::FORM_TYPE_ORBITREK         => '0',
            'form_' .  ExerciseType::FORM_TYPE_STRECHING        => '0',
            'form_' .  ExerciseType::FORM_TYPE_BIKE             => '0',
        ));
        $this->addFieldOptions('lifting_series_6_break', array(
            'form_0'                                            => '1',
            'form_' .  ExerciseType::FORM_TYPE_TREADMILL        => '0',
            'form_' .  ExerciseType::FORM_TYPE_LIFTING          => '1',
            'form_' .  ExerciseType::FORM_TYPE_HIIT_TREADMILL   => '0',
            'form_' .  ExerciseType::FORM_TYPE_ORBITREK         => '0',
            'form_' .  ExerciseType::FORM_TYPE_STRECHING        => '0',
            'form_' .  ExerciseType::FORM_TYPE_BIKE             => '0',
        ));
        $this->addFieldOptions('lifting_series_6_weight', array(
            'form_0'                                            => '1',
            'form_' .  ExerciseType::FORM_TYPE_TREADMILL        => '0',
            'form_' .  ExerciseType::FORM_TYPE_LIFTING          => '1',
            'form_' .  ExerciseType::FORM_TYPE_HIIT_TREADMILL   => '0',
            'form_' .  ExerciseType::FORM_TYPE_ORBITREK         => '0',
            'form_' .  ExerciseType::FORM_TYPE_STRECHING        => '0',
            'form_' .  ExerciseType::FORM_TYPE_BIKE             => '0',
        ));


        /**
         * HIIT
         */
        $this->addFieldOptions('hiit_speed_low', array(
            'form_0'                                            => '1',
            'form_' .  ExerciseType::FORM_TYPE_TREADMILL        => '0',
            'form_' .  ExerciseType::FORM_TYPE_LIFTING          => '0',
            'form_' .  ExerciseType::FORM_TYPE_HIIT_TREADMILL   => '1',
            'form_' .  ExerciseType::FORM_TYPE_ORBITREK         => '0',
            'form_' .  ExerciseType::FORM_TYPE_STRECHING        => '0',
            'form_' .  ExerciseType::FORM_TYPE_BIKE             => '0',
        ));
        $this->addFieldOptions('hiit_speed_high', array(
            'form_0'                                            => '1',
            'form_' .  ExerciseType::FORM_TYPE_TREADMILL        => '0',
            'form_' .  ExerciseType::FORM_TYPE_LIFTING          => '0',
            'form_' .  ExerciseType::FORM_TYPE_HIIT_TREADMILL   => '1',
            'form_' .  ExerciseType::FORM_TYPE_ORBITREK         => '0',
            'form_' .  ExerciseType::FORM_TYPE_STRECHING        => '0',
            'form_' .  ExerciseType::FORM_TYPE_BIKE             => '0',
        ));
        $this->addFieldOptions('hiit_time_low', array(
            'form_0'                                            => '1',
            'form_' .  ExerciseType::FORM_TYPE_TREADMILL        => '0',
            'form_' .  ExerciseType::FORM_TYPE_LIFTING          => '0',
            'form_' .  ExerciseType::FORM_TYPE_HIIT_TREADMILL   => '1',
            'form_' .  ExerciseType::FORM_TYPE_ORBITREK         => '0',
            'form_' .  ExerciseType::FORM_TYPE_STRECHING        => '0',
            'form_' .  ExerciseType::FORM_TYPE_BIKE             => '0',
        ));
        $this->addFieldOptions('hiit_time_high', array(
            'form_0'                                            => '1',
            'form_' .  ExerciseType::FORM_TYPE_TREADMILL        => '0',
            'form_' .  ExerciseType::FORM_TYPE_LIFTING          => '0',
            'form_' .  ExerciseType::FORM_TYPE_HIIT_TREADMILL   => '1',
            'form_' .  ExerciseType::FORM_TYPE_ORBITREK         => '0',
            'form_' .  ExerciseType::FORM_TYPE_STRECHING        => '0',
            'form_' .  ExerciseType::FORM_TYPE_BIKE             => '0',
        ));
        $this->addFieldOptions('hiit_warmup_time', array(
            'form_0'                                            => '1',
            'form_' .  ExerciseType::FORM_TYPE_TREADMILL        => '0',
            'form_' .  ExerciseType::FORM_TYPE_LIFTING          => '0',
            'form_' .  ExerciseType::FORM_TYPE_HIIT_TREADMILL   => '1',
            'form_' .  ExerciseType::FORM_TYPE_ORBITREK         => '0',
            'form_' .  ExerciseType::FORM_TYPE_STRECHING        => '0',
            'form_' .  ExerciseType::FORM_TYPE_BIKE             => '0',
        ));
        $this->addFieldOptions('hiit_interval_count', array(
            'form_0'                                            => '1',
            'form_' .  ExerciseType::FORM_TYPE_TREADMILL        => '0',
            'form_' .  ExerciseType::FORM_TYPE_LIFTING          => '0',
            'form_' .  ExerciseType::FORM_TYPE_HIIT_TREADMILL   => '1',
            'form_' .  ExerciseType::FORM_TYPE_ORBITREK         => '0',
            'form_' .  ExerciseType::FORM_TYPE_STRECHING        => '0',
            'form_' .  ExerciseType::FORM_TYPE_BIKE             => '0',
        ));
        $this->addFieldOptions('cooldown_speed_start', array(
            'form_0'                                            => '1',
            'form_' .  ExerciseType::FORM_TYPE_TREADMILL        => '1',
            'form_' .  ExerciseType::FORM_TYPE_LIFTING          => '0',
            'form_' .  ExerciseType::FORM_TYPE_HIIT_TREADMILL   => '1',
            'form_' .  ExerciseType::FORM_TYPE_ORBITREK         => '1',
            'form_' .  ExerciseType::FORM_TYPE_STRECHING        => '0',
            'form_' .  ExerciseType::FORM_TYPE_BIKE             => '1',
        ));
        $this->addFieldOptions('cooldown_speed_end', array(
            'form_0'                                            => '1',
            'form_' .  ExerciseType::FORM_TYPE_TREADMILL        => '1',
            'form_' .  ExerciseType::FORM_TYPE_LIFTING          => '0',
            'form_' .  ExerciseType::FORM_TYPE_HIIT_TREADMILL   => '1',
            'form_' .  ExerciseType::FORM_TYPE_ORBITREK         => '1',
            'form_' .  ExerciseType::FORM_TYPE_STRECHING        => '0',
            'form_' .  ExerciseType::FORM_TYPE_BIKE             => '1',
        ));
        $this->addFieldOptions('cooldown_speed_interval', array(
            'form_0'                                            => '1',
            'form_' .  ExerciseType::FORM_TYPE_TREADMILL        => '1',
            'form_' .  ExerciseType::FORM_TYPE_LIFTING          => '0',
            'form_' .  ExerciseType::FORM_TYPE_HIIT_TREADMILL   => '1',
            'form_' .  ExerciseType::FORM_TYPE_ORBITREK         => '1',
            'form_' .  ExerciseType::FORM_TYPE_STRECHING        => '0',
            'form_' .  ExerciseType::FORM_TYPE_BIKE             => '1',
        ));
        $this->addFieldOptions('cooldown_interval_time', array(
            'form_0'                                            => '1',
            'form_' .  ExerciseType::FORM_TYPE_TREADMILL        => '1',
            'form_' .  ExerciseType::FORM_TYPE_LIFTING          => '0',
            'form_' .  ExerciseType::FORM_TYPE_HIIT_TREADMILL   => '1',
            'form_' .  ExerciseType::FORM_TYPE_ORBITREK         => '1',
            'form_' .  ExerciseType::FORM_TYPE_STRECHING        => '0',
            'form_' .  ExerciseType::FORM_TYPE_BIKE             => '1',
        ));
        $this->addFieldOptions('cooldown_interval_count', array(
            'form_0'                                            => '1',
            'form_' .  ExerciseType::FORM_TYPE_TREADMILL        => '1',
            'form_' .  ExerciseType::FORM_TYPE_LIFTING          => '0',
            'form_' .  ExerciseType::FORM_TYPE_HIIT_TREADMILL   => '1',
            'form_' .  ExerciseType::FORM_TYPE_ORBITREK         => '1',
            'form_' .  ExerciseType::FORM_TYPE_STRECHING        => '0',
            'form_' .  ExerciseType::FORM_TYPE_BIKE             => '1',
        ));



        /**
         *
         */
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
        $this->addAction(
            'saveAdd',
            'submit',
            array(
                'label'     => 'save and continue adding',
                'class'     => 'actionImage',
//                'image'     => $this->_skinUrl . '/img/icons/record/save.png',
            )
        );
        $this->addAction(
            'copy',
            'submit',
            array(
                'label'     => 'copy from last of type',
                'class'     => 'actionImage',
                'onclick'   => 'copy(); return false;',
//                'image'     => $this->_skinUrl . '/img/icons/record/save.png',
            )
        );

    }
}

