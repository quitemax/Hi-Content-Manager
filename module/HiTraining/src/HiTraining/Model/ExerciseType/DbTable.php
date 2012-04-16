<?php
/**
 *
 * Enter description here ...
 * @author MaX
 *
 */
namespace HiTraining\Model\ExerciseType;

/**
 *
 */
use HiBase\Db\TableGateway\TableGateway,
    HiTraining\Model\ExerciseType\ResultSet,
    HiTraining\Model\ExerciseType\Row;

/**
 *
 * Enter description here ...
 * @author MaX
 *
 */
class DbTable extends TableGateway
{
    const FORM_TYPE_TREADMILL = 1;
    const FORM_TYPE_LIFTING = 2;
    const FORM_TYPE_HIIT_TREADMILL = 3;
    const FORM_TYPE_ORBITREK = 4;
    const FORM_TYPE_STRECHING = 5;
    const FORM_TYPE_BIKE = 6;

    const MECHANICS_TYPE_ISOLATION = 1;
    const MECHANICS_TYPE_COMPOUND = 2;
    const MECHANICS_TYPE_NA = 3;

    const FORCE_TYPE_PUSH = 1;
    const FORCE_TYPE_PULL = 2;
    const FORCE_TYPE_STAIC = 3;
    const FORCE_TYPE_NA = 4;

    const EQUIPMENT_TYPE_BANDS = 1;
    const EQUIPMENT_TYPE_BARBELL = 2;
    const EQUIPMENT_TYPE_BODYONLY = 3;
    const EQUIPMENT_TYPE_CABLE = 4;
    const EQUIPMENT_TYPE_DUMBBELL = 5;
    const EQUIPMENT_TYPE_EZCURLBAR = 6;
    const EQUIPMENT_TYPE_EXERCISEBALL = 7;
    const EQUIPMENT_TYPE_FOAMROLL = 8;
    const EQUIPMENT_TYPE_KETTLEBELLS = 9;
    const EQUIPMENT_TYPE_MACHINE = 10;
    const EQUIPMENT_TYPE_MEDICINEBALL = 11;
    const EQUIPMENT_TYPE_NONE = 12;
    const EQUIPMENT_TYPE_OTHER = 13;

    /**
     *
     * Enter description here ...
     */
    public function setTableDefinition()
    {
        $this->setName('exercise_type');

        $this->setPrefix('et');

        $this->setPrimaryKey('type_id');

        $this->hasColumn(
            'type_id',
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
            'varchar',
            255,
            array(
                'type'             => 'varchar',
                'length'           => '255',
                'notnull'          => true,
            )
        );

        $this->hasColumn(
            'tree_parent_id',
            'integer',
            11,
            array(
                'type'             => 'integer',
                'length'           => '11',
//                'notnull'          => true,
            )
        );

        $this->hasColumn(
            'tree_order',
            'integer',
            11,
            array(
                'type'             => 'integer',
                'length'           => '11',
//                'notnull'          => true,
            )
        );



        $this->hasColumn(
            'description',
            'text',
            null,
            array(
                'type'             => 'text',
//                'notnull'          => true,
            )
        );



        $this->hasColumn(
            'link',
            'text',
            null,
            array(
                'type'             => 'text',
//                'notnull'          => true,
            )
        );

        $this->hasColumn(
            'type_img',
            'text',
            null,
            array(
                'type'             => 'text',
//                'notnull'          => true,
            )
        );

        $this->hasColumn(
            'guide_img',
            'text',
            null,
            array(
                'type'             => 'text',
//                'notnull'          => true,
            )
        );

        $this->hasColumn(
            'form_type',
            'integer',
            11,
            array(
                'type'             => 'select',
                'length'           => '11',
//                'notnull'          => true,
                'values'          => array(
                    0 => '--',
                    self::FORM_TYPE_TREADMILL => 'treadmill',
                    self::FORM_TYPE_LIFTING => 'lifting',
                    self::FORM_TYPE_HIIT_TREADMILL => 'hiit_treadmill',
                    self::FORM_TYPE_ORBITREK => 'orbitrek',
                    self::FORM_TYPE_STRECHING => 'streching',
                    self::FORM_TYPE_BIKE => 'bike',
                ),
            )
        );

        $this->hasColumn(
            'mechanics_type',
            'integer',
            11,
            array(
                'type'             => 'select',
                'length'           => '11',
                'values'          => array(
                    0 => '--',
                    self::MECHANICS_TYPE_ISOLATION => 'isolation',
                    self::MECHANICS_TYPE_COMPOUND => 'compund',
                    self::MECHANICS_TYPE_NA => 'N/A',
                ),
            )
        );

        $this->hasColumn(
            'force_type',
            'integer',
            11,
            array(
                'type'             => 'select',
                'length'           => '11',
//                'notnull'          => true,
                'values'          => array(
                    0 => '--',
                    self::FORCE_TYPE_PUSH => 'push',
                    self::FORCE_TYPE_PULL => 'pull',
                    self::FORCE_TYPE_STAIC => 'staic',
                    self::FORCE_TYPE_NA => 'N/A',
                ),
            )
        );

        $this->hasColumn(
            'equipment',
            'integer',
            11,
            array(
                'type'             => 'select',
                'length'           => '11',
//                'notnull'          => true,
                'values'          => array(
                    0 => '--',
                    self::EQUIPMENT_TYPE_BANDS => 'bands',
                    self::EQUIPMENT_TYPE_BARBELL => 'barbell',
                    self::EQUIPMENT_TYPE_BODYONLY => 'body only',
                    self::EQUIPMENT_TYPE_CABLE => 'cable',
                    self::EQUIPMENT_TYPE_DUMBBELL => 'dumbbell',
                    self::EQUIPMENT_TYPE_EZCURLBAR => 'ez curlbar',
                    self::EQUIPMENT_TYPE_EXERCISEBALL => 'exercise ball',
                    self::EQUIPMENT_TYPE_FOAMROLL => 'foamroll',
                    self::EQUIPMENT_TYPE_KETTLEBELLS => 'kettlebells',
                    self::EQUIPMENT_TYPE_MACHINE => 'machine',
                    self::EQUIPMENT_TYPE_MEDICINEBALL => 'medicine ball',
                    self::EQUIPMENT_TYPE_NONE => 'none',
                    self::EQUIPMENT_TYPE_OTHER => 'other',
                ),
            )
        );

        $this->hasColumn(
            'rating',
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

	/**
     *
     * Enter description here ...
     */
    protected function setBehaviours()
    {
        $this->setBehaviour(
            'nestedSet',
            array(
                'left' => 'tree_left',
                'right' => 'tree_right',
                'level' => 'tree_level',
                'order' => 'tree_order',
                'parentId' => 'tree_parent_id',
                'basePrimaryKey' => 'type_id',
                'title' => 'name',
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
