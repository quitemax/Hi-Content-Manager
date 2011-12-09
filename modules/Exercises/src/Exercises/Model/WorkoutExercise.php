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

        //
        $sqlSelect = $this->_db->select();

        $sqlSelect->from(
            array( 'we' => $this->_name),
            'we.*'
        );

        $sqlSelect->where('we.workout_id = ' . $id);
        $sqlSelect->order('we.order', 'asc');
        $sqlSelect->joinLeft(
            array('wet' => 'workout_exercise_type'),
            'we.type_id = wet.type_id',
            'wet.*'
        );

        $stmt = $this->_db->query($sqlSelect);
        $rows = $stmt->fetchAll(\Zend\Db\Db::FETCH_ASSOC);

        $data  = array(
            'table'    => $this,
            'data'     => $rows,
            'rowClass' => $this->getRowClass(),
            'stored'   => true
        );

        $rowsetClass = $this->getRowsetClass();
        $rows =  new $rowsetClass($data);

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
