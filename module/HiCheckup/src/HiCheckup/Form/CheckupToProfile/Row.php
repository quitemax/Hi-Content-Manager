<?php

namespace HiCheckup\Form\CheckupToProfile;

use HiBase\Grid\SubForm\Row\DbTable as GridDbTableRow;


class Row extends GridDbTableRow
{
    protected $_title = 'CheckupToProfileRow';
    protected $_name = 'CheckupToProfileRowSubForm';

    public function init()
    {
        //
        parent::init();



        $this->setFieldType('checkup_id', 'select');
        $this->setFieldType('profile_id', 'hidden');






        //
//        $this->addAction(
//            'back',
//            'submit',
//            array(
//                'label'     => 'back',
//                'class'     => 'actionImage',
////                'image'     => $this->_skinUrl . '/img/icons/record/back.png',
//                'onclick'   => 'goBack(); return false;',
//            )
//        );
        $this->addAction(
            'save',
            'submit',
            array(
                'label'     => 'save',
                'class'     => 'actionImage',
//                'image'     => $this->_skinUrl . '/img/icons/record/save.png',
            )
        );



    }
}

