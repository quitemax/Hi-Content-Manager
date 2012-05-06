<?php
/**
 *
 * Enter description here ...
 * @author MaX
 *
 */
namespace HiCheckup\Model\CheckupProfile;

/**
 *
 */
use HiBase\Db\TableGateway\TableGateway,
    HiCheckup\Model\CheckupProfile\ResultSet,
    HiCheckup\Model\CheckupProfile\Row;

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
        $this->setName('checkup_profile');

        $this->setPrefix('cp');

        $this->setPrimaryKey('profile_id');

        $this->hasColumn(
            'profile_id',
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
            'name',
            'char',
            255,
            array(
                'type'             => 'char',
                'length'           => '255',
                'notnull'          => false,
            )
        );

        $this->hasColumn(
            'description',
            'text',
            null,
            array(
                'type'             => 'text',
                'notnull'          => false,
            )
        );

        $this->hasColumn(
            'default',
            'tinyint',
            1,
            array(
                'type'             => 'tinyint',
                'length'            => 1,
                'notnull'          => true,
                'default'          => '0',
            )
        );

        $this->hasColumn(
            'show_weight',
            'tinyint',
            1,
            array(
                'type'             => 'tinyint',
                'length'            => 1,
                'notnull'          => true,
                'default'          => '1',
            )
        );

        $this->hasColumn(
            'show_fat',
            'tinyint',
            1,
            array(
                'type'             => 'tinyint',
                'length'            => 1,
                'notnull'          => true,
                'default'          => '1',
            )
        );
        $this->hasColumn(
            'show_muscle',
            'tinyint',
            1,
            array(
                'type'             => 'tinyint',
                'length'            => 1,
                'notnull'          => true,
                'default'          => '1',
            )
        );
        $this->hasColumn(
            'show_water',
            'tinyint',
            1,
            array(
                'type'             => 'tinyint',
                'length'            => 1,
                'notnull'          => true,
                'default'          => '1',
            )
        );
        $this->hasColumn(
            'show_bone',
            'tinyint',
            1,
            array(
                'type'             => 'tinyint',
                'length'            => 1,
                'notnull'          => true,
                'default'          => '1',
            )
        );
        $this->hasColumn(
            'show_calories',
            'tinyint',
            1,
            array(
                'type'             => 'tinyint',
                'length'            => 1,
                'notnull'          => true,
                'default'          => '1',
            )
        );
        $this->hasColumn(
            'show_bmi',
            'tinyint',
            1,
            array(
                'type'             => 'tinyint',
                'length'            => 1,
                'notnull'          => true,
                'default'          => '1',
            )
        );
        $this->hasColumn(
            'show_circumference',
            'tinyint',
            1,
            array(
                'type'             => 'tinyint',
                'length'            => 1,
                'notnull'          => true,
                'default'          => '1',
            )
        );
        $this->hasColumn(
            'show_vo2',
            'tinyint',
            1,
            array(
                'type'             => 'tinyint',
                'length'            => 1,
                'notnull'          => true,
                'default'          => '1',
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
