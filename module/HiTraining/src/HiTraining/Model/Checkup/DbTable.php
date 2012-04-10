<?php
/**
 *
 * Enter description here ...
 * @author MaX
 *
 */
namespace HiTraining\Model\Checkup;

/**
 *
 */
use HiBase\Db\TableGateway\TableGateway,
    HiTraining\Model\Checkup\ResultSet,
    HiTraining\Model\Checkup\Row;

/**
 *
 * Enter description here ...
 * @author MaX
 *
 */
class DbTable extends TableGateway
{
    /**
     *
     * Enter description here ...
     */
    public function setTableDefinition()
    {
        $this->setName('checkup');

        $this->setPrefix('c');

        $this->setPrimaryKey('checkup_id');

        $this->hasColumn(
            'checkup_id',
            'integer',
            11,
            array(
                'type'             => 'integer',
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
            'height',
            'decimal',
            10,
            array(
                'type'             => 'decimal',
                'scale'            => 1,
                'notnull'          => true,
                'default'          => '0.0',
            )
        );

        $this->hasColumn(
            'weight',
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
            'fat_percentage',
            'decimal',
            10,
            array(
                'type'             => 'decimal',
                'scale'            => 1,
                'notnull'          => true,
                'default'          => '0.0',
            )
        );

        $this->hasColumn(
            'water_percentage',
            'decimal',
            10,
            array(
                'type'             => 'decimal',
                'scale'            => 1,
                'notnull'          => true,
                'default'          => '0.0',
            )
        );

        $this->hasColumn(
            'muscle_percentage',
            'decimal',
            10,
            array(
                'type'             => 'decimal',
                'scale'            => 1,
                'notnull'          => true,
                'default'          => '0.0',
            )
        );

        $this->hasColumn(
            'bones_weight',
            'decimal',
            10,
            array(
                'type'             => 'decimal',
                'scale'            => 1,
                'notnull'          => true,
                'default'          => '0.0',
            )
        );
        $this->hasColumn(
            'calories_activeless',
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
            'calories_active',
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
            'neck_circumference',
            'decimal',
            10,
            array(
                'type'             => 'decimal',
                'scale'            => 1,
                'notnull'          => true,
                'default'          => '0.0',
            )
        );
        $this->hasColumn(
            'chest_circumference',
            'decimal',
            10,
            array(
                'type'             => 'decimal',
                'scale'            => 1,
                'notnull'          => true,
                'default'          => '0.0',
            )
        );
        $this->hasColumn(
            'waist_circumference',
            'decimal',
            10,
            array(
                'type'             => 'decimal',
                'scale'            => 1,
                'notnull'          => true,
                'default'          => '0.0',
            )
        );
        $this->hasColumn(
            'biceps_circumference',
            'decimal',
            10,
            array(
                'type'             => 'decimal',
                'scale'            => 1,
                'notnull'          => true,
                'default'          => '0.0',
            )
        );
    }

    protected function setPrototypes()
    {
        $this->setSelectResultPrototype(
            new ResultSet(
                new Row(
                    $this, $this->getPrimaryKey()
                )
            )
        );
    }

}
