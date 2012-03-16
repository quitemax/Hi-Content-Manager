<?php

namespace Exercises\Model\DbTable;

//use Zend\Db\Table\AbstractTable;
use HiZend\Db\Table\AbstractTable;
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
    protected $_prfx = 'w';

    protected $_dependentTables = array(
        'Exercises\Model\DbTable\WorkoutExercise',
    );

    protected $_rowClass = 'Exercises\Model\WorkoutRow';
    protected $_rowsetClass = 'Exercises\Model\WorkoutRowset';

    public function getWorkout($id)
    {
        $row = $this->getRow('workout_id = ' . (int) $id);
        if (!$row) {
            throw new \Exception("Could not find row $id");
        }
        return $row;
    }

    public function getWorkoutExercisesCountSql()
    {
        //
        $sqlSubSelect = $this->_db->select();
        $sqlSubSelect->from(
            array( 'workout_exercise'),
            'COUNT(*)'
        );
        $sqlSubSelect->where('workout_id = ' . $this->_prfx . '.workout_id');
        return $sqlSubSelect;
    }

    public function getWorkouts()
    {
        //
        $sqlSubSelect = $this->_db->select();
        $sqlSubSelect->from(
            array( 'workout_exercise'),
            'COUNT(*)'
        );
        $sqlSubSelect->where('workout_id = ' . $this->_prfx . '.workout_id');

        //
        $rows = $this->getRowset(null, null, null, null, array(
            $this->_prfx . '.*',
            'exercises_count' => '(' . $sqlSubSelect . ')',
        ));

        return $rows;
    }

    public function addWorkout($values)
    {
       if (isset($values['workout_id'])){
           unset($values['workout_id']);
       }

        $workoutRow = $this->createRow();
        $workoutRow->setFromArray($this->_normalizeValues($values));
        $workoutRow->save();

        return $workoutRow;
    }

    public function updateWorkout($id, $values)
    {
        $workoutRow = $this->getRow('workout_id = ' . (int) $id);
        $workoutRow->setFromArray($this->_normalizeValues($values));
        $workoutRow->save();
//        $this->update($this->_normalizeValues($values), 'workout_id = ' . (int) $id);
    }

    protected function _normalizeValues(array $values)
    {

        return $values;
    }


}
