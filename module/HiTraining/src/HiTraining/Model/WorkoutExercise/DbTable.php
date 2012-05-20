<?php

namespace HiTraining\Model\WorkoutExercise;

use HiBase\Db\TableGateway\TableGateway,
    HiTraining\Model\WorkoutExercise\ResultSet,
    HiTraining\Model\WorkoutExercise\Row;

class DbTable extends TableGateway
{
    /**
     *
     * Enter description here ...
     */
    public function setTableDefinition()
    {
        $this->setName('workout_exercise');

        $this->setPrefix('we');

        $this->setPrimaryKey('exercise_id');

        $this->hasColumn(
            'exercise_id',
            'integer',
            11,
            array(
                'type'             => 'exercise_id',
                'length'           => '11',
                'primary'          => true,
                'autoincrement'    => true,
                'notnull'          => true,
            )
        );

        $this->hasColumn(
            'workout_id',
            'integer',
            11,
            array(
                'type'             => 'integer',
                'length'            => 11,
                'notnull'          => true,
                'default'          => '0',
            )
        );

        $this->hasColumn(
            'type_id',
            'integer',
            11,
            array(
                'type'             => 'integer',
                'length'            => 11,
                'notnull'          => true,
                'default'          => '0',
            )
        );

        $this->hasColumn(
            'order',
            'integer',
            11,
            array(
                'type'             => 'integer',
                'length'            => 11,
                'notnull'          => true,
                'default'          => '0',
            )
        );

        $this->hasColumn(
            'exercise_elapsed_time',
            'time',
            null,
            array(
                'type'             => 'time',
                'notnull'          => true,
                'default'          => '00:00:00',
            )
        );

        $this->hasColumn(
            'after_break_time',
            'time',
            null,
            array(
                'type'             => 'time',
                'notnull'          => true,
                'default'          => '00:00:00',
            )
        );


        $this->hasColumn(
            'speed',
            'decimal',
            10,
            array(
                'type'             => 'decimal',
                'scale'            => 3,
                'notnull'          => true,
                'default'          => '0.0',
            )
        );

        $this->hasColumn(
            'angle',
            'decimal',
            10,
            array(
                'type'             => 'decimal',
                'scale'            => 2,
                'notnull'          => true,
                'default'          => '0.0',
            )
        );

        $this->hasColumn(
            'level',
            'integer',
            11,
            array(
                'type'             => 'integer',
                'length'            => 11,
                'notnull'          => true,
                'default'          => '0',
            )
        );

        $this->hasColumn(
            'distance',
            'decimal',
            10,
            array(
                'type'             => 'decimal',
                'scale'            => 3,
                'notnull'          => true,
                'default'          => '0.0',
            )
        );

        $this->hasColumn(
            'avg_rpm',
            'decimal',
            10,
            array(
                'type'             => 'decimal',
                'scale'            => 2,
                'notnull'          => true,
                'default'          => '0.0',
            )
        );

        $this->hasColumn(
            'exercise_calories_burned',
            'integer',
            11,
            array(
                'type'             => 'integer',
                'length'            => 11,
                'notnull'          => true,
                'default'          => '0',
            )
        );

        $this->hasColumn(
            'avg_speed',
            'decimal',
            10,
            array(
                'type'             => 'decimal',
                'scale'            => 3,
                'notnull'          => true,
                'default'          => '0.0',
            )
        );

        $this->hasColumn(
            'hr_min',
            'integer',
            11,
            array(
                'type'             => 'integer',
                'length'            => 11,
                'notnull'          => true,
                'default'          => '0',
            )
        );

        $this->hasColumn(
            'hr_max',
            'integer',
            11,
            array(
                'type'             => 'integer',
                'length'            => 11,
                'notnull'          => true,
                'default'          => '0',
            )
        );

        $this->hasColumn(
            'hr_avg',
            'integer',
            11,
            array(
                'type'             => 'integer',
                'length'            => 11,
                'notnull'          => true,
                'default'          => '0',
            )
        );

        $this->hasColumn(
            'fat_loss',
            'decimal',
            10,
            array(
                'type'             => 'decimal',
                'scale'            => 4,
                'notnull'          => true,
                'default'          => '0.000',
            )
        );



        //lifting 1
        $this->hasColumn(
            'lifting_series_1_count',
            'integer',
            11,
            array(
                'type'             => 'integer',
                'length'            => 11,
                'notnull'          => true,
                'default'          => '0',
            )
        );

        $this->hasColumn(
            'lifting_series_1_break',
            'time',
            null,
            array(
                'type'             => 'time',
                'notnull'          => true,
                'default'          => '00:00:00',
            )
        );

        $this->hasColumn(
            'lifting_series_1_weight',
            'decimal',
            10,
            array(
                'type'             => 'decimal',
                'scale'            => 3,
                'notnull'          => true,
                'default'          => '0.0',
            )
        );


        //lifting 2
        $this->hasColumn(
            'lifting_series_2_count',
            'integer',
            11,
            array(
                'type'             => 'integer',
                'length'            => 11,
                'notnull'          => true,
                'default'          => '0',
            )
        );

        $this->hasColumn(
            'lifting_series_2_break',
            'time',
            null,
            array(
                'type'             => 'time',
                'notnull'          => true,
                'default'          => '00:00:00',
            )
        );

        $this->hasColumn(
            'lifting_series_2_weight',
            'decimal',
            10,
            array(
                'type'             => 'decimal',
                'scale'            => 3,
                'notnull'          => true,
                'default'          => '0.0',
            )
        );

        //lifting 3
        $this->hasColumn(
            'lifting_series_3_count',
            'integer',
            11,
            array(
                'type'             => 'integer',
                'length'            => 11,
                'notnull'          => true,
                'default'          => '0',
            )
        );

        $this->hasColumn(
            'lifting_series_3_break',
            'time',
            null,
            array(
                'type'             => 'time',
                'notnull'          => true,
                'default'          => '00:00:00',
            )
        );

        $this->hasColumn(
            'lifting_series_3_weight',
            'decimal',
            10,
            array(
                'type'             => 'decimal',
                'scale'            => 3,
                'notnull'          => true,
                'default'          => '0.0',
            )
        );


        //lifting 4
        $this->hasColumn(
            'lifting_series_4_count',
            'integer',
            11,
            array(
                'type'             => 'integer',
                'length'            => 11,
                'notnull'          => true,
                'default'          => '0',
            )
        );

        $this->hasColumn(
            'lifting_series_4_break',
            'time',
            null,
            array(
                'type'             => 'time',
                'notnull'          => true,
                'default'          => '00:00:00',
            )
        );

        $this->hasColumn(
            'lifting_series_4_weight',
            'decimal',
            10,
            array(
                'type'             => 'decimal',
                'scale'            => 3,
                'notnull'          => true,
                'default'          => '0.0',
            )
        );


        //lifting 5
        $this->hasColumn(
            'lifting_series_5_count',
            'integer',
            11,
            array(
                'type'             => 'integer',
                'length'            => 11,
                'notnull'          => true,
                'default'          => '0',
            )
        );

        $this->hasColumn(
            'lifting_series_5_break',
            'time',
            null,
            array(
                'type'             => 'time',
                'notnull'          => true,
                'default'          => '00:00:00',
            )
        );

        $this->hasColumn(
            'lifting_series_5_weight',
            'decimal',
            10,
            array(
                'type'             => 'decimal',
                'scale'            => 3,
                'notnull'          => true,
                'default'          => '0.0',
            )
        );


        //lifting 6
        $this->hasColumn(
            'lifting_series_6_count',
            'integer',
            11,
            array(
                'type'             => 'integer',
                'length'            => 11,
                'notnull'          => true,
                'default'          => '0',
            )
        );

        $this->hasColumn(
            'lifting_series_6_break',
            'time',
            null,
            array(
                'type'             => 'time',
                'notnull'          => true,
                'default'          => '00:00:00',
            )
        );

        $this->hasColumn(
            'lifting_series_6_weight',
            'decimal',
            10,
            array(
                'type'             => 'decimal',
                'scale'            => 3,
                'notnull'          => true,
                'default'          => '0.0',
            )
        );


        /**
         * HIIT
         */
        $this->hasColumn(
            'hiit_speed_low',
            'decimal',
            10,
            array(
                'type'             => 'decimal',
                'scale'            => 3,
                'notnull'          => true,
                'default'          => '0.0',
            )
        );

        $this->hasColumn(
            'hiit_speed_high',
            'decimal',
            10,
            array(
                'type'             => 'decimal',
                'scale'            => 3,
                'notnull'          => true,
                'default'          => '0.0',
            )
        );

        $this->hasColumn(
            'hiit_time_low',
            'time',
            null,
            array(
                'type'             => 'time',
                'notnull'          => true,
                'default'          => '00:00:00',
            )
        );

        $this->hasColumn(
            'hiit_time_high',
            'time',
            null,
            array(
                'type'             => 'time',
                'notnull'          => true,
                'default'          => '00:00:00',
            )
        );

        $this->hasColumn(
            'hiit_warmup_time',
            'time',
            null,
            array(
                'type'             => 'time',
                'notnull'          => true,
                'default'          => '00:00:00',
            )
        );

        $this->hasColumn(
            'hiit_interval_count',
            'integer',
            11,
            array(
                'type'             => 'integer',
                'length'            => 11,
                'notnull'          => true,
                'default'          => '0',
            )
        );

        /**
         * cooldown
         */
        $this->hasColumn(
            'cooldown_speed_start',
            'decimal',
            10,
            array(
                'type'             => 'decimal',
                'scale'            => 3,
                'notnull'          => true,
                'default'          => '0.0',
            )
        );
        $this->hasColumn(
            'cooldown_speed_end',
            'decimal',
            10,
            array(
                'type'             => 'decimal',
                'scale'            => 3,
                'notnull'          => true,
                'default'          => '0.0',
            )
        );
        $this->hasColumn(
            'cooldown_speed_interval',
            'decimal',
            10,
            array(
                'type'             => 'decimal',
                'scale'            => 3,
                'notnull'          => true,
                'default'          => '0.0',
            )
        );


        $this->hasColumn(
            'cooldown_interval_time',
            'time',
            null,
            array(
                'type'             => 'time',
                'notnull'          => true,
                'default'          => '00:00:00',
            )
        );

        $this->hasColumn(
            'cooldown_interval_count',
            'integer',
            11,
            array(
                'type'             => 'integer',
                'length'            => 11,
                'notnull'          => true,
                'default'          => '0',
            )
        );

        /**
         * lafay warmup
         */
        $this->hasColumn(
            'lafay_warmup_series_1_time',
            'time',
            null,
            array(
                'type'             => 'time',
                'notnull'          => true,
                'default'          => '00:00:00',
            )
        );

        $this->hasColumn(
            'lafay_warmup_series_1_count',
            'integer',
            10,
            array(
                'type'             => 'integer',
                'length'            => 10,
                'notnull'          => true,
                'default'          => '0',
            )
        );

        $this->hasColumn(
            'lafay_warmup_series_1_break',
            'time',
            null,
            array(
                'type'             => 'time',
                'notnull'          => true,
                'default'          => '00:00:00',
            )
        );
        $this->hasColumn(
            'lafay_warmup_series_2_time',
            'time',
            null,
            array(
                'type'             => 'time',
                'notnull'          => true,
                'default'          => '00:00:00',
            )
        );

        $this->hasColumn(
            'lafay_warmup_series_2_count',
            'integer',
            10,
            array(
                'type'             => 'integer',
                'length'            => 10,
                'notnull'          => true,
                'default'          => '0',
            )
        );

        $this->hasColumn(
            'lafay_warmup_series_2_break',
            'time',
            null,
            array(
                'type'             => 'time',
                'notnull'          => true,
                'default'          => '00:00:00',
            )
        );
        $this->hasColumn(
            'lafay_warmup_series_3_time',
            'time',
            null,
            array(
                'type'             => 'time',
                'notnull'          => true,
                'default'          => '00:00:00',
            )
        );

        $this->hasColumn(
            'lafay_warmup_series_3_count',
            'integer',
            10,
            array(
                'type'             => 'integer',
                'length'            => 10,
                'notnull'          => true,
                'default'          => '0',
            )
        );

        $this->hasColumn(
            'lafay_warmup_series_3_break',
            'time',
            null,
            array(
                'type'             => 'time',
                'notnull'          => true,
                'default'          => '00:00:00',
            )
        );

    }

    protected function setPrototypes()
    {
        $this->setSelectResultPrototype(
            new ResultSet(
                new Row(
                    $this->getPrimaryKey(), $this->getName(), $this->adapter
                )
            )
        );
    }


}
