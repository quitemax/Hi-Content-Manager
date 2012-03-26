<?php

namespace Exercises\Form;

//use Zend\Db\Table\AbstractTable;
//    Zend\Di\Locator,
//    Zend\EventManager\EventCollection,
//    Zend\EventManager\ListenerAggregate,
//    Zend\EventManager\StaticEventCollection,
//    Zend\Http\Response,
//    Zend\Mvc\Application,
//    Zend\Mvc\MvcEvent,
//    Zend\View\Renderer;

use Hi\Grid\Form;
//    Hi\Grid\Element;

//use Zend\Form\Form,
//    Zend\Form\Element;

class WorkoutGrid extends Form
{
    /**
     * Title
     *
     * @var string
     */
    protected $_title = 'WorkoutGrid';

    /**
     * Title
     *
     * @var string
     */
    protected $_name = 'WorkoutGridForm';

    public function init()
    {
        parent::init();
    }
}