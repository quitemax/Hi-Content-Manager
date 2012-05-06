<?php
/**
 *
 * Enter description here ...
 * @author MaX
 *
 */
namespace HiTraining\Model;

/**
 *
 */
use HiTraining\Model\ExerciseType\DbTable;

/**
 *
 * Enter description here ...
 * @author MaX
 *
 */
class ExerciseType extends DbTable
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

    public function setTableDefinition()
    {
        parent::setTableDefinition();

//        $this->setColumnOptions(
//            'form_type',
//            array(
//                'type'             => 'select',
//                'length'           => '11',
//                'notnull'          => true,
//                'values'          => array(
//                    0 => '--',
//                    self::FORM_TYPE_TREADMILL => 'treadmill',
//                    self::FORM_TYPE_LIFTING => 'lifting',
//                    self::FORM_TYPE_HIIT_TREADMILL => 'hiit_treadmill',
//                    self::FORM_TYPE_ORBITREK => 'orbitrek',
//                    self::FORM_TYPE_STRECHING => 'streching',
//                    self::FORM_TYPE_BIKE => 'bike',
//                ),
//            )
//        );

        $this->hasColumn(
            'form_type',
            'integer',
            11,
            array(
                'type'             => 'select',
                'length'           => '11',
                'notnull'          => true,
                'values'          => array(
                    0 => '--',
                    self::FORM_TYPE_TREADMILL       => 'treadmill',
                    self::FORM_TYPE_LIFTING         => 'lifting',
                    self::FORM_TYPE_HIIT_TREADMILL  => 'hiit_treadmill',
                    self::FORM_TYPE_ORBITREK        => 'orbitrek',
                    self::FORM_TYPE_STRECHING       => 'streching',
                    self::FORM_TYPE_BIKE            => 'bike',
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
                    self::MECHANICS_TYPE_COMPOUND  => 'compund',
                    self::MECHANICS_TYPE_NA        => 'N/A',
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
                'notnull'          => true,
                'values'          => array(
                    0 => '--',
                    self::FORCE_TYPE_PUSH  => 'push',
                    self::FORCE_TYPE_PULL  => 'pull',
                    self::FORCE_TYPE_STAIC => 'staic',
                    self::FORCE_TYPE_NA    => 'N/A',
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
                'notnull'          => true,
                'values'          => array(
                    0 => '--',
                    self::EQUIPMENT_TYPE_BANDS         => 'bands',
                    self::EQUIPMENT_TYPE_BARBELL       => 'barbell',
                    self::EQUIPMENT_TYPE_BODYONLY      => 'body only',
                    self::EQUIPMENT_TYPE_CABLE         => 'cable',
                    self::EQUIPMENT_TYPE_DUMBBELL      => 'dumbbell',
                    self::EQUIPMENT_TYPE_EZCURLBAR     => 'ez curlbar',
                    self::EQUIPMENT_TYPE_EXERCISEBALL  => 'exercise ball',
                    self::EQUIPMENT_TYPE_FOAMROLL      => 'foamroll',
                    self::EQUIPMENT_TYPE_KETTLEBELLS   => 'kettlebells',
                    self::EQUIPMENT_TYPE_MACHINE       => 'machine',
                    self::EQUIPMENT_TYPE_MEDICINEBALL  => 'medicine ball',
                    self::EQUIPMENT_TYPE_NONE          => 'none',
                    self::EQUIPMENT_TYPE_OTHER         => 'other',
                ),
            )
        );
    }

}
