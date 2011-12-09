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

class WorkoutExerciseType extends AbstractTable
{
    protected $_name = 'workout_exercise_type';
    protected $_all;

    const FORM_TYPE_CLOCK = '0';
    const FORM_TYPE_LIFTING = '1';


    public function getAllForSelect()
    {
        $array = array(
            ''    => ' -- ',
        );

        $sqlSelect = $this->_db->select();

        $sqlSelect->from(
            array( 'wet' => $this->_name ),
            array(
            	'wet.type_id',
            	'wet.name',
            )
        );

        $sqlSelect->order('wet.group_id', 'asc');
//        $sqlSelect->joinLeft(
//            array('wet' => 'workout_exercise_type'),
//            'we.workout_exercise_type_id = wet.id',
//            'wet.*'
//        );


        $stmt = $this->_db->query($sqlSelect);
        $rows = $stmt->fetchAll(\Zend\Db\Db::FETCH_ASSOC);

        foreach ($rows as $row) {
            $array[$row['type_id']] = $row['name'];
        }

        return $array;
    }


    public function getWorkoutExerciseType($id)
    {
        $id = (int) $id;
        $row = $this->fetchRow('type_id = ' . $id);
        if (!$row) {
            throw new Exception("Could not find row $id");
        }
        return $row->toArray();
    }

    public function addWorkoutExerciseType($values)
    {
        $this->insert($this->_normalizeValues($values));
    }

    public function updateWorkoutExerciseType($id, $values)
    {
        $this->update($this->_normalizeValues($values), 'type_id = ' . (int) $id);
    }

    public function deleteWorkoutExerciseType($id)
    {
        $this->delete('type_id =' . (int) $id);
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
