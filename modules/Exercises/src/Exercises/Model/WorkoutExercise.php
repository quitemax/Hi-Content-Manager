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

class WorkoutExercise extends AbstractTable
{
    protected $_name = 'workout_exercise';


    public function getWorkoutExercises($id)
    {
        $id = (int) $id;
        $rows = $this->fetchAll('workout_id = ' . $id);
        if (!$rows) {
            throw new Exception("Could not find workout $id rows");
        }
        return $rows;
    }

    public function addWorkoutExercise($values)
    {
        $this->insert($this->_normalizeValues($values));
    }

    public function updateWorkoutExercise($id, $values)
    {
        $this->update($this->_normalizeValues($values), 'id = ' . (int) $id);
    }

    public function deleteWorkoutExercise($id)
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
