<?php
/**
 *
 * Enter description here ...
 * @author MaX
 *
 */
namespace HiCheckup\Model;

/**
 *
 */
use HiCheckup\Model\Checkup\DbTable;

/**
 *
 * Enter description here ...
 * @author MaX
 *
 */
class Checkup extends DbTable
{
    /**
     *
     * Enter description here ...
     */
    protected function setBehaviours()
    {
//        $this->setBehaviour(
//            'img_front',
//            'image',
//            array(
//                'image' => 'img_front',
//                'path' => '/checkup',
//                'cache' => array(
//                    'dir' => '/checkup'
//                ),
//            )
//        );
//        $this->setBehaviour(
//            'img_side',
//            'image',
//            array(
//                'image' => 'img_side',
//                'path' => '/checkup',
//                'cache' => array(
//                    'dir' => '/checkup'
//                ),
//            )
//        );

    }

    /**
     *
     * Enter description here ...
     */
     public function setTableDefinition()
    {
        //
        parent::setTableDefinition();

//        $this->hasColumn(
//            'img_front',
//            'text',
//            null,
//            array(
//                'type'             => 'image',
//                'length'           => '',
//                'notnull'          => true,
//                'cache' => array(
//                    'dir' => '/checkup'
//                ),
//            )
//        );
//        $this->hasColumn(
//            'img_side',
//            'text',
//            null,
//            array(
//                'type'             => 'image',
//                'length'           => '',
//                'notnull'          => true,
//                'cache' => array(
//                    'dir' => '/checkup'
//                ),
//            )
//        );


    }
}
