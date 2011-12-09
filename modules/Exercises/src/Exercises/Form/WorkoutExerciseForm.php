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

class WorkoutExerciseForm extends Form
{
    public function init()
    {
        $this->setName('workout');

        $id = new Element\Hidden('exercise_id');
        $id->addFilter('Int');

        $workout_id = new Element\Hidden('workout_id');
        $workout_id->addFilter('Int')
            ->setRequired(true)
            ->addValidator('NotEmpty')
            ->addValidator('Int');

        $type_id = new Element\Select('type_id');
        $type_id->setLabel('type_id')
            ->setRequired(true)
            ->addValidator('NotEmpty');

        $order = new Element\Text('order');
        $order->setLabel('order')
            ->addFilter('Int')
            ->setValue(0);

        $elapsed_time = new Element\Text('elapsed_time');
        $elapsed_time->setLabel('elapsed_time')
            ->addFilter('StripTags')
            ->addFilter('StringTrim')
            ->setValue('00:00:00');

        $speed = new Element\Text('speed');
        $speed->setLabel('speed')
            ->setValue('0');


        $angle = new Element\Text('angle');
        $angle->setLabel('angle')
            ->setValue('0');

        $level = new Element\Text('level');
        $level->setLabel('level')
            ->addFilter('Int')
            ->setValue(0);

        $lifting_series_1_weight = new Element\Text('lifting_series_1_weight');
        $lifting_series_1_weight->setLabel('lifting_series_1_weight')
            ->setValue('0');
        $lifting_series_1_count = new Element\Text('lifting_series_1_count');
        $lifting_series_1_count->setLabel('lifting_series_1_count')
            ->addFilter('Int')
            ->setValue(0);
        $lifting_series_1_break = new Element\Text('lifting_series_1_break');
        $lifting_series_1_break->setLabel('lifting_series_1_break')
            ->addFilter('StripTags')
            ->addFilter('StringTrim')
            ->setValue('00:00:00');


        $lifting_series_2_weight = new Element\Text('lifting_series_2_weight');
        $lifting_series_2_weight->setLabel('lifting_series_2_weight')
            ->setValue('0');
        $lifting_series_2_count = new Element\Text('lifting_series_2_count');
        $lifting_series_2_count->setLabel('lifting_series_2_count')
            ->addFilter('Int')
            ->setValue(0);
        $lifting_series_2_break = new Element\Text('lifting_series_2_break');
        $lifting_series_2_break->setLabel('lifting_series_2_break')
            ->addFilter('StripTags')
            ->addFilter('StringTrim')
            ->setValue('00:00:00');

        $lifting_series_3_weight = new Element\Text('lifting_series_3_weight');
        $lifting_series_3_weight->setLabel('lifting_series_3_weight')
            ->setValue('0');
        $lifting_series_3_count = new Element\Text('lifting_series_3_count');
        $lifting_series_3_count->setLabel('lifting_series_3_count')
            ->addFilter('Int')
            ->setValue(0);
        $lifting_series_3_break = new Element\Text('lifting_series_3_break');
        $lifting_series_3_break->setLabel('lifting_series_3_break')
            ->addFilter('StripTags')
            ->addFilter('StringTrim')
            ->setValue('00:00:00');

        $lifting_series_4_weight = new Element\Text('lifting_series_4_weight');
        $lifting_series_4_weight->setLabel('lifting_series_4_weight')
            ->setValue('0');
        $lifting_series_4_count = new Element\Text('lifting_series_4_count');
        $lifting_series_4_count->setLabel('lifting_series_4_count')
            ->addFilter('Int')
            ->setValue(0);
        $lifting_series_4_break = new Element\Text('lifting_series_4_break');
        $lifting_series_4_break->setLabel('lifting_series_4_break')
            ->addFilter('StripTags')
            ->addFilter('StringTrim')
            ->setValue('00:00:00');


        $lifting_series_5_weight = new Element\Text('lifting_series_5_weight');
        $lifting_series_5_weight->setLabel('lifting_series_5_weight')
            ->setValue('0');
        $lifting_series_5_count = new Element\Text('lifting_series_5_count');
        $lifting_series_5_count->setLabel('lifting_series_5_count')
            ->addFilter('Int')
            ->setValue(0);
        $lifting_series_5_break = new Element\Text('lifting_series_5_break');
        $lifting_series_5_break->setLabel('lifting_series_5_break')
            ->addFilter('StripTags')
            ->addFilter('StringTrim')
            ->setValue('00:00:00');


        $lifting_series_6_weight = new Element\Text('lifting_series_6_weight');
        $lifting_series_6_weight->setLabel('lifting_series_6_weight')
            ->setValue('0');
        $lifting_series_6_count = new Element\Text('lifting_series_6_count');
        $lifting_series_6_count->setLabel('lifting_series_6_count')
            ->addFilter('Int')
            ->setValue(0);
        $lifting_series_6_break = new Element\Text('lifting_series_6_break');
        $lifting_series_6_break->setLabel('lifting_series_6_break')
            ->addFilter('StripTags')
            ->addFilter('StringTrim')
            ->setValue('00:00:00');


        $submit = new Element\Submit('submit');
        $submit->setAttrib('id', 'submitbutton');

        $this->addElements(
            array(
                $id,
                $workout_id,
                $type_id,
                $order,
                $elapsed_time,
                $speed,
                $angle,
                $level,
                $lifting_series_1_weight,
                $lifting_series_1_count,
                $lifting_series_1_break,
                $lifting_series_2_weight,
                $lifting_series_2_count,
                $lifting_series_2_break,
                $lifting_series_3_weight,
                $lifting_series_3_count,
                $lifting_series_3_break,
                $lifting_series_4_weight,
                $lifting_series_4_count,
                $lifting_series_4_break,
                $lifting_series_5_weight,
                $lifting_series_5_count,
                $lifting_series_5_break,
                $lifting_series_6_weight,
                $lifting_series_6_count,
                $lifting_series_6_break,
                $submit
            )
        );
    }
}

