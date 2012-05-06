<?php
/**
 *
 * Enter description here ...
 * @author MaX
 *
 */
namespace HiCheckup\Model\CheckupToProfile;

/**
 *
 */
use HiBase\Db\TableGateway\TableGateway,
    HiCheckup\Model\CheckupToProfile\ResultSet,
    HiCheckup\Model\CheckupToProfile\Row;

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
        $this->setName('checkup_to_profile');

        $this->setPrefix('ctp');

        $this->setPrimaryKey('ctp_id');

        $this->hasColumn(
            'ctp_id',
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
            'profile_id',
            'integer',
            11,
            array(
                'type'             => 'integer',
                'length'           => '11',
                'notnull'          => true,
            )
        );

        $this->hasColumn(
            'checkup_id',
            'integer',
            11,
            array(
                'type'             => 'integer',
                'length'           => '11',
                'notnull'          => true,
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
