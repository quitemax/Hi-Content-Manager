<?php

namespace HiTraining\Form\Workout;


use HiBase\Grid\SubForm\Row\DbTable as GridDbTableRow;

class Row extends GridDbTableRow
{
    protected $_title = 'WorkoutRow';
    protected $_name = 'WorkoutRow';

    public function init()
    {
        //
        parent::init();


        $this->addFieldOptions('date', array('value' => date('Y-m-d H:00:00')));


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

