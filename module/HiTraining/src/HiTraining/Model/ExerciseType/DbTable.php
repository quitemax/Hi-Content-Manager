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
                'notnull'          => true,
            )
        );

        $this->hasColumn(
            'tree_order',
            'integer',
            11,
            array(
                'type'             => 'integer',
                'length'           => '11',
                'notnull'          => true,
            )
        );



        $this->hasColumn(
            'description',
            'text',
            null,
            array(
                'type'             => 'text',
            )
        );



        $this->hasColumn(
            'link',
            'text',
            null,
            array(
                'type'             => 'text',
            )
        );

        $this->hasColumn(
            'type_img',
            'text',
            null,
            array(
                'type'             => 'text',
            )
        );

        $this->hasColumn(
            'guide_img',
            'text',
            null,
            array(
                'type'             => 'text',
            )
        );

        $this->hasColumn(
            'form_type',
            'integer',
            11,
            array(
                'type'             => 'select',
                'length'           => '11',
                'notnull'          => true,
            )
        );

        $this->hasColumn(
            'mechanics_type',
            'integer',
            11,
            array(
                'type'             => 'select',
                'length'           => '11',
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
