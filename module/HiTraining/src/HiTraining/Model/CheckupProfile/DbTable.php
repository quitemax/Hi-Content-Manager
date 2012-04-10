<?php
/**
 *
 * Enter description here ...
 * @author MaX
 *
 */
namespace HiTraining\Model\CheckupProfile;

/**
 *
 */
use HiBase\Db\TableGateway\TableGateway,
    HiTraining\Model\CheckupProfile\ResultSet,
    HiTraining\Model\CheckupProfile\Row;

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
