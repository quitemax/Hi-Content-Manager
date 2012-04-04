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
use HiBase\Db\TableGateway\TableGateway;

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
                'scale'            => 2,
                'notnull'          => true,
                'default'          => '0.0',
            )
        );
    }

}
