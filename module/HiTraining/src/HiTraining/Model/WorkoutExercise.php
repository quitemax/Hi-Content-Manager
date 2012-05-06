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
use HiTraining\Model\WorkoutExercise\DbTable,
    Zend\Db\Sql\Select;

/**
 *
 * Enter description here ...
 * @author MaX
 *
 */
class WorkoutExercise extends DbTable
{

    public function getExercises($where = null, $order = null)
    {
        //prepare the sql
//        \Zend\Debug::dump($order);
        $sqlSelect = $this->prepareResultSetSql($where, $order/*, $count, $offset, $cols*/);

        $sqlSelect->join(
            'workout',
            'workout.workout_id = workout_exercise.workout_id',
            array(
                'workout_date' => 'date',
            ),
            Select::JOIN_LEFT
        );
        $sqlSelect->join(
            'exercise_type',
            'exercise_type.type_id = workout_exercise.type_id',
            array(
                'form_type' => 'form_type',
                'type_name' => 'name',
            ),
            Select::JOIN_LEFT
        );

//        \Zend\Debug::dump($sqlSelect);
//        \Zend\Debug::dump($sqlSelect->getSqlString());

        //save sql
        $this->_lastSql = $sqlSelect;

        $statement = $this->adapter->createStatement();
        $sqlSelect->prepareStatement($this->adapter, $statement);

//        \Zend\Debug::dump($sqlSelect, '$sqlSelect');
//        \Zend\Debug::dump($statement, '$statement');
        $result = $statement->execute();

        //
        $resultSet = clone $this->selectResultPrototype;
        $resultSet->setDataSource($result);
        return $resultSet;
    }



//    public function getAllFormTypeFields()
//    {
//        return array(
//            ExerciseType::FORM_TYPE_TREADMILL => array(
//                'order',
//                'exercise_elapsed_time',
//                'speed',
//                'angle',
//                'distance',
//                'exercise_calories_burned',
//            ),
//            ExerciseType::FORM_TYPE_LIFTING => array(
//                'order',
//                'lifting_series_1_count',
//                'lifting_series_2_count',
//                'lifting_series_3_count',
//                'lifting_series_4_count',
//                'lifting_series_5_count',
//                'lifting_series_6_count',
//                'lifting_series_1_break',
//                'lifting_series_2_break',
//                'lifting_series_3_break',
//                'lifting_series_4_break',
//                'lifting_series_5_break',
//                'lifting_series_6_break',
//                'lifting_series_1_weight',
//                'lifting_series_2_weight',
//                'lifting_series_3_weight',
//                'lifting_series_4_weight',
//                'lifting_series_5_weight',
//                'lifting_series_6_weight',
//                'exercise_calories_burned',
//            ),
//            ExerciseType::FORM_TYPE_HIIT_TREADMILL => array(
//                'order',
//                'exercise_elapsed_time',
//                'hiit_speed_low',
//                'hiit_speed_high',
//                'hiit_time_low',
//                'hiit_time_high',
//                'hiit_warmup_time',
//                'hiit_interval_count',
//                'exercise_calories_burned',
//                'distance',
//            ),
//            ExerciseType::FORM_TYPE_ORBITREK => array(
//                'order',
//                'exercise_elapsed_time',
//                'speed',
//                'level',
//                'exercise_calories_burned',
//                'distance',
//            ),
//            ExerciseType::FORM_TYPE_STRECHING => array(
//                'order',
//                'exercise_elapsed_time',
//                'exercise_calories_burned'
//            ),
//            ExerciseType::FORM_TYPE_BIKE => array(
//                'order',
//                'exercise_elapsed_time',
//                'avg_rpm',
//                'level',
//                'exercise_calories_burned',
//                'distance'
//            ),
//        );
//    }
}
