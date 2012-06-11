<?php
/**
 *
 * Enter description here ...
 * @author MaX
 *
 */
namespace HiCheckup\Model\Checkup;

/**
 *
 */
use HiBase\Db\TableGateway\TableGateway,
    HiCheckup\Model\Checkup\ResultSet,
    HiCheckup\Model\Checkup\Row;

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
                'type'             => 'id',
                'length'           => '11',
                'primary'          => true,
                'autoincrement'    => true,
                'notnull'          => true,
                'grid'             => true,
                'width'            => '80',
                'sortable'         => true,
                'filterable'       => true,
                'label'            => 'ID',
//                'renderer'      => 'text',//override
//                'filter'      => 'text',//override
//                'header_css_class'      => 'number',//override
            )
        );

        $this->hasColumn(
            'date',
            'datetime',
            null,
            array(
//                'type'             => 'datetime',
                'notnull'          => true,
                'default'          => '0000-00-00 00:00:00',
                'grid'             => true,
                'width'            => 100,
                'sortable'         => true,
                'filterable'       => true,
                'label'            => 'Date',
            )
        );

        $this->hasColumn(
            'height',
            'decimal',
            10,
            array(
//                'type'             => 'decimal',
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
//                'type'             => 'decimal',
                'scale'            => 3,
                'notnull'          => true,
                'default'          => '0.0',
                'grid'          => true,
                'width'             => 80,
                'sortable'             => true,
                'label'             => 'Weight',
                'after_html'             => ' kg',
            )
        );

        $this->hasColumn(
            'fat_percentage',
            'decimal',
            10,
            array(
//                'type'             => 'decimal',
                'scale'            => 1,
                'notnull'          => true,
                'default'          => '0.0',
                'grid'          => true,
                'width'             => 80,
                'sortable'             => true,
                'label'             => 'Fat',
                'after_html'             => ' %',
            )
        );

        $this->hasColumn(
            'water_percentage',
            'decimal',
            10,
            array(
//                'type'             => 'decimal',
                'scale'            => 1,
                'notnull'          => true,
                'default'          => '0.0',
                'grid'          => true,
                'editable'          => true,
                'width'             => 80,
                'sortable'             => true,
                'label'             => 'Water',
                'after_html'             => ' %',
            )
        );

        $this->hasColumn(
            'muscle_percentage',
            'decimal',
            10,
            array(
//                'type'             => 'decimal',
                'scale'            => 1,
                'notnull'          => true,
                'default'          => '0.0',
                'grid'          => true,
                'width'             => 80,
                'sortable'             => true,
                'label'             => 'Muscle',
                'after_html'             => ' %',
            )
        );

        $this->hasColumn(
            'bones_weight',
            'decimal',
            10,
            array(
//                'type'             => 'decimal',
                'scale'            => 1,
                'notnull'          => true,
                'default'          => '0.0',
                'grid'          => true,
                'width'             => 80,
                'sortable'             => true,
                'label'             => 'Bones',
                'after_html'             => ' kg',
            )
        );
        $this->hasColumn(
            'calories_activeless',
            'integer',
            11,
            array(
//                'type'             => 'integer',
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
//                'type'             => 'integer',
                'length'            => 11,
                'notnull'          => true,
                'default'          => '0',
            )
        );

        $this->hasColumn(
            'activity_level',
            'integer',
            11,
            array(
//                'type'             => 'integer',
                'length'            => 11,
                'notnull'          => true,
                'default'          => '0',
                'grid'          => true,
                'width'             => 80,
                'sortable'             => false,
                'label'             => 'Level',
            )
        );

        $this->hasColumn(
            'vo2_max',
            'decimal',
            10,
            array(
//                'type'             => 'decimal',
                'scale'            => 1,
                'notnull'          => true,
                'default'          => '0.0',
            )
        );

        $this->hasColumn(
            'neck_circumference',
            'decimal',
            10,
            array(
//                'type'             => 'decimal',
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
//                'type'             => 'decimal',
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
//                'type'             => 'decimal',
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
//                'type'             => 'decimal',
                'scale'            => 1,
                'notnull'          => true,
                'default'          => '0.0',
            )
        );
        $this->hasColumn(
            'hip_circumference',
            'decimal',
            10,
            array(
//                'type'             => 'decimal',
                'scale'            => 1,
                'notnull'          => true,
                'default'          => '0.0',
            )
        );
        $this->hasColumn(
            'leg_circumference',
            'decimal',
            10,
            array(
//                'type'             => 'decimal',
                'scale'            => 1,
                'notnull'          => true,
                'default'          => '0.0',
            )
        );
    }

}
