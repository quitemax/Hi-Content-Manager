<?php

namespace Exercises\Form\WorkoutGrid;

//use Zend\Db\Table\AbstractTable;
//    Zend\Di\Locator,
//    Zend\EventManager\EventCollection,
//    Zend\EventManager\ListenerAggregate,
//    Zend\EventManager\StaticEventCollection,
//    Zend\Http\Response,
//    Zend\Mvc\Application,
//    Zend\Mvc\MvcEvent,
//    Zend\View\Renderer;
//use Zend\Form\Form,
//    Zend\Form\Element;

use Hi\Grid\SubForm\Row\DbTable as GridDbTableRow;

class WorkoutRow extends GridDbTableRow
{
    protected $_title = 'WorkoutRow';
    protected $_name = 'WorkoutRow';

    public function init()
    {
        //
        parent::init();


        $this->addFieldOptions('date', array('value' => date('Y-m-d H:i:s')));


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

