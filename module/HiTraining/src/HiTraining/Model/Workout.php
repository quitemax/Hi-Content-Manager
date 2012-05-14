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
    Zend\Db\Sql\Select,
    Zend\Db\Sql\Expression;

/**
 *
 * Enter description here ...
 * @author MaX
 *
 */
class Workout extends DbTable
{

    public function getWorkoutExercisesCountSqlExpression()
    {
        //
        $sqlSubSelect = new Select();

        //
        $sqlSubSelect->columns(
            array(
                new Expression(
                    'COUNT(*)'
                )
            ),
            false
        );

        //
        $sqlSubSelect->from('workout_exercise');

        //
        $sqlSubSelect->where('`workout_exercise`.`workout_id` = `' . $this->_name . '`.`workout_id`');

        //
        return new Expression(
            '( ' . $sqlSubSelect->getSqlString($this->adapter->getPlatform()) . ')'
        );
    }

}
