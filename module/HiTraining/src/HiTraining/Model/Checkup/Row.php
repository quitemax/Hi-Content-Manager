<?php
/**
 *
 * Enter description here ...
 * @author MaX
 *
 */
namespace HiTraining\Model\Checkup;

/**
 *
 */
use HiBase\Db\RowGateway\RowGateway as HiRowGateway;

/**
 *
 * Enter description here ...
 * @author MaX
 *
 */
class Row extends HiRowGateway
{
//    protected $_name = 'workout';
//
//    public function getWorkout($id)
//    {
//        $id = (int) $id;
//        $row = $this->fetchRow('workout_id = ' . $id);
//        if (!$row) {
//            throw new \Exception("Could not find row $id");
//        }
//        return $row;
//    }
//
//    public function getWorkouts()
//    {
//
//        //
//        $sqlSubSelect = $this->_db->select();
//        $sqlSubSelect->from(
//            array( 'workout_exercise'),
//            'COUNT(*)'
//        );
//        $sqlSubSelect->where('workout_id = w.workout_id');
//
////        echo "<pre>" . '"$$sqlSubSelect" ';
////         print_r((string)$sqlSubSelect);
////        echo "</pre>";
//        //
//        $sqlSelect = $this->_db->select();
//
//        $sqlSelect->from(
//            array( 'w' => $this->_name),
//            array(
//                'w.*',
//                'exercises_count' => '(' . $sqlSubSelect . ')',
//            )
//        );
//
////        $sqlSelect->where('w.workout_id = ' . $id);
//
////        echo "<pre>" . '"$sqlSelect" ';
////         print_r((string)$sqlSelect);
////        echo "</pre>";
//
////        echo $sqlSelect;
//
//
//
//
//        $stmt = $this->_db->query($sqlSelect);
//        $rows = $stmt->fetchAll(\Zend\Db\Db::FETCH_ASSOC);
//
//        $data  = array(
//            'table'    => $this,
//            'data'     => $rows,
//            'rowClass' => $this->getRowClass(),
//            'stored'   => true
//        );
//
//        $rowsetClass = $this->getRowsetClass();
//        $rows =  new $rowsetClass($data);
//
//        if (!$rows) {
//            throw new Exception("Could not find workout $id rows");
//        }
//        return $rows;
//    }
//
//    public function addWorkout($values)
//    {
//        $this->insert($this->_normalizeValues($values));
//    }
//
//    public function updateWorkout($id, $values)
//    {
//        $this->update($this->_normalizeValues($values), 'workout_id = ' . (int) $id);
//    }
//
//    public function deleteWorkout($id)
//    {
//        $this->delete('workout_id =' . (int) $id);
//    }
//
//    protected function _normalizeValues(array $values)
//    {
////        if (isset($values['height']) && trim($values['height']) == '') {
////            $values['height'] = 0;
////        }
////        if (isset($values['biceps_circumference']) && trim($values['biceps_circumference']) == '') {
////            $values['biceps_circumference'] = 0;
////        }
////        if (isset($values['weight']) && trim($values['weight']) == '') {
////            $values['weight'] = 0;
////        }
////        if (isset($values['waist_circumference']) && trim($values['waist_circumference']) == '') {
////            $values['waist_circumference'] = 0;
////        }
//
//        return $values;
//    }


}
