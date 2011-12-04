<?php

namespace Exercises\Model;

use Zend\Db\Table\AbstractTable;
//    Zend\Di\Locator,
//    Zend\EventManager\EventCollection,
//    Zend\EventManager\ListenerAggregate,
//    Zend\EventManager\StaticEventCollection,
//    Zend\Http\Response,
//    Zend\Mvc\Application,
//    Zend\Mvc\MvcEvent,
//    Zend\View\Renderer;

class Workout extends AbstractTable
{
    protected $_name = 'workout';


    public function getWorkout($id)
    {
        $id = (int) $id;
        $row = $this->fetchRow('id = ' . $id);
        if (!$row) {
            throw new Exception("Could not find row $id");
        }
        return $row;
    }

    public function addWorkout($values)
    {
        $this->insert($this->_normalizeValues($values));
    }

    public function updateWorkout($id, $values)
    {
        $this->update($this->_normalizeValues($values), 'id = ' . (int) $id);
    }

    public function deleteWorkout($id)
    {
        $this->delete('id =' . (int) $id);
    }

    protected function _normalizeValues(array $values)
    {
//        if (isset($values['height']) && trim($values['height']) == '') {
//            $values['height'] = 0;
//        }
//        if (isset($values['biceps_circumference']) && trim($values['biceps_circumference']) == '') {
//            $values['biceps_circumference'] = 0;
//        }
//        if (isset($values['weight']) && trim($values['weight']) == '') {
//            $values['weight'] = 0;
//        }
//        if (isset($values['waist_circumference']) && trim($values['waist_circumference']) == '') {
//            $values['waist_circumference'] = 0;
//        }

        return $values;
    }


}
