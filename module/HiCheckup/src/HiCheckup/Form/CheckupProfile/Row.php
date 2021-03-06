<?php

namespace HiCheckup\Form\CheckupProfile;

use HiBase\Grid\SubForm\Row\DbTable as GridDbTableRow;


class Row extends GridDbTableRow
{
    protected $_title = 'CheckupProfileRow';
    protected $_name = 'CheckupProfileRowSubForm';

    public function init()
    {
        //
        parent::init();


//        $this->addFieldOptions('date', array('value' => date('Y-m-d H:i:s')));




        //
        $this->addAction(
            'back',
            'submit',
            array(
                'label'     => 'back',
                'class'     => 'actionImage',
//                'image'     => $this->_skinUrl . '/img/icons/record/back.png',
                'onclick'   => 'goBack(); return false;',
            )
        );
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

