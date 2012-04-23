<?php
/**
 *
 * Enter description here ...
 * @author MaX
 *
 */
namespace HiTraining\Model;

/**
 *
 */
use HiTraining\Model\Workout\DbTable,
    Zend\Db\Sql\Select;

/**
 *
 * Enter description here ...
 * @author MaX
 *
 */
class Workout extends DbTable
{

    public function getWorkoutExercisesCountSql()
    {
        //
        $sqlSubSelect = new Select();
        $sqlSubSelect->columns(
            array('COUNT(*)'),
            true
        );

        $sqlSubSelect->from('workout_exercise', $this->schema);

//        $sqlSubSelect->from(
//            array( 'workout_exercise'),
//            'COUNT(*)'
//        );
        $sqlSubSelect->where('workout_exercise.workout_id = ' . $this->_name . '.workout_id');
//        \Zend\Debug::dump($sqlSubSelect->getSqlString());
        return $sqlSubSelect->getSqlString();
    }

}
