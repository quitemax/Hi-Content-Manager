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
use Zend\Form\Form,
    Zend\Form\Element;

class CheckupForm extends Form
{
    public function init()
    {
        $this->setName('checkup');

        $id = new Element\Hidden('checkup_id');
        $id->addFilter('Int');

        $date = new Element\Text('date');
        $date->setLabel('date')
            ->setRequired(true)
            ->addFilter('StripTags')
            ->addFilter('StringTrim')
            ->addValidator('NotEmpty')
            ->setValue(date('Y-m-d H:i:s'));

        $weight = new Element\Text('weight');
        $weight->setLabel('weight')
            ->setRequired(true)
            ->addFilter('StripTags')
            ->addFilter('StringTrim')
            ->addValidator('NotEmpty')
            ->setValue(0);

        $height = new Element\Text('height');
        $height->setLabel('height')
            ->addFilter('StripTags')
            ->addFilter('StringTrim')
            ->setValue(0);

        $biceps_circumference = new Element\Text('biceps_circumference');
        $biceps_circumference->setLabel('biceps_circumference')
            ->addFilter('StripTags')
            ->addFilter('StringTrim')
            ->setValue(0);


        $img_front = new Element\File('img_front');
        $img_front->setLabel('img_front')
            ->addFilter('StripTags')
            ->addFilter('StringTrim');


        $img_side = new Element\File('img_side');
        $img_side->setLabel('img_side')
            ->addFilter('StripTags')
            ->addFilter('StringTrim');


        $waist_circumference = new Element\Text('waist_circumference');
        $waist_circumference->setLabel('waist_circumference')
            ->addFilter('StripTags')
            ->addFilter('StringTrim')
            ->setValue(0);


        $submit = new Element\Submit('submit');
        $submit->setAttrib('id', 'submitbutton');

        $this->addElements(
            array(
                $id,
                $date,
                $weight,
                $height,
                $biceps_circumference,
                $img_front,
                $img_side,
                $waist_circumference,
                $submit
            )
        );
    }
}

