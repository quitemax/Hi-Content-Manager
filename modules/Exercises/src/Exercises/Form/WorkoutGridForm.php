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

class WorkoutGridForm extends Form
{
    public function init()
    {
        $this->setTitle('WorkoutGrid');
        $this->setName('WorkoutGridForm');

        parent::init();
//        $this->setName('workout');
//
//        $id = new Element\Hidden('workout_id');
//        $id->addFilter('Int');
//
//        $date = new Element\Text('date');
//        $date->setLabel('date')
//            ->setRequired(true)
//            ->addFilter('StripTags')
//            ->addFilter('StringTrim')
//            ->addValidator('NotEmpty')
//            ->setValue(date('Y-m-d H:i:s'));
//
//        $calories_burned = new Element\Text('calories_burned');
//        $calories_burned->setLabel('calories_burned')
//            ->setRequired(true)
//            ->addFilter('StripTags')
//            ->addFilter('StringTrim')
//            ->addValidator('NotEmpty')
//            ->setValue(0);
//
//        $elapsed_time = new Element\Text('elapsed_time');
//        $elapsed_time->setLabel('elapsed_time')
//            ->addFilter('StripTags')
//            ->addFilter('StringTrim')
//            ->setValue(0);
//
//
//        $submit = new Element\Submit('submit');
//        $submit->setAttrib('id', 'submitbutton');
//
//        $this->addElements(
//            array(
//                $id,
//                $date,
//                $calories_burned,
//                $elapsed_time,
//                $submit
//            )
//        );
    }
}


//class Hicms_Form_SubForm_Navigation_ItemsElementsList extends Hi_Record_SubForm_List
//{
//
//}