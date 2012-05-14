<?php

namespace HiTraining\Model\Workout;

use HiBase\Db\TableGateway\TableGateway,
    HiTraining\Model\Workout\ResultSet,
    HiTraining\Model\Workout\Row;

class DbTable extends TableGateway
{
/**
     *
     * Enter description here ...
     */
    public function setTableDefinition()
    {
        $this->setName('workout');

        $this->setPrefix('w');

        $this->setPrimaryKey('workout_id');

        $this->hasColumn(
            'workout_id',
            'integer',
            11,
            array(
                'type'             => 'workout_id',
                'length'           => '11',
                'primary'          => true,
                'autoincrement'    => true,
                'notnull'          => true,
            )
        );

        $this->hasColumn(
            'date',
            'datetime',
            null,
            array(
                'type'             => 'datetime',
                'notnull'          => true,
                'default'          => '0000-00-00 00:00:00',
            )
        );

        $this->hasColumn(
            'elapsed_time',
            'time',
            null,
            array(
                'type'             => 'time',
                'notnull'          => true,
                'default'          => '00:00:00',
            )
        );

        $this->hasColumn(
            'calories_burned',
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
                'scale'            => 3,
                'notnull'          => true,
                'default'          => '0.0',
            )
        );

//        $this->hasColumn(
//            'weight',
//            'decimal',
//            10,
//            array(
//                'type'             => 'decimal',
//                'scale'            => 3,
//                'notnull'          => true,
//                'default'          => '0.0',
//            )
//        );
//
//        $this->hasColumn(
//            'fat_percentage',
//            'decimal',
//            10,
//            array(
//                'type'             => 'decimal',
//                'scale'            => 1,
//                'notnull'          => true,
//                'default'          => '0.0',
//            )
//        );
//
//        $this->hasColumn(
//            'water_percentage',
//            'decimal',
//            10,
//            array(
//                'type'             => 'decimal',
//                'scale'            => 1,
//                'notnull'          => true,
//                'default'          => '0.0',
//            )
//        );
//
//        $this->hasColumn(
//            'muscle_percentage',
//            'decimal',
//            10,
//            array(
//                'type'             => 'decimal',
//                'scale'            => 1,
//                'notnull'          => true,
//                'default'          => '0.0',
//            )
//        );
//
//        $this->hasColumn(
//            'bones_weight',
//            'decimal',
//            10,
//            array(
//                'type'             => 'decimal',
//                'scale'            => 1,
//                'notnull'          => true,
//                'default'          => '0.0',
//            )
//        );
//        $this->hasColumn(
//            'calories_activeless',
//            'integer',
//            11,
//            array(
//                'type'             => 'integer',
//                'length'            => 11,
//                'notnull'          => true,
//                'default'          => '0',
//            )
//        );
//        $this->hasColumn(
//            'calories_active',
//            'integer',
//            11,
//            array(
//                'type'             => 'integer',
//                'length'            => 11,
//                'notnull'          => true,
//                'default'          => '0',
//            )
//        );
//
//        $this->hasColumn(
//            'neck_circumference',
//            'decimal',
//            10,
//            array(
//                'type'             => 'decimal',
//                'scale'            => 1,
//                'notnull'          => true,
//                'default'          => '0.0',
//            )
//        );
//        $this->hasColumn(
//            'chest_circumference',
//            'decimal',
//            10,
//            array(
//                'type'             => 'decimal',
//                'scale'            => 1,
//                'notnull'          => true,
//                'default'          => '0.0',
//            )
//        );
//        $this->hasColumn(
//            'waist_circumference',
//            'decimal',
//            10,
//            array(
//                'type'             => 'decimal',
//                'scale'            => 1,
//                'notnull'          => true,
//                'default'          => '0.0',
//            )
//        );
//        $this->hasColumn(
//            'biceps_circumference',
//            'decimal',
//            10,
//            array(
//                'type'             => 'decimal',
//                'scale'            => 1,
//                'notnull'          => true,
//                'default'          => '0.0',
//            )
//        );
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
