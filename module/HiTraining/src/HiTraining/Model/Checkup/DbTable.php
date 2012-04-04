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
use HiBase\Db\TableGateway\TableGateway;

/**
 *
 * Enter description here ...
 * @author MaX
 *
 */
class DbTable extends TableGateway
{
    /**
     *
     * Enter description here ...
     */
    public function setTableDefinition()
    {
        $this->setName('checkup');

        $this->setPrefix('c');
    }



//    public function getCheckup($id)
//    {
//        $id = (int) $id;
//        $row = $this->fetchRow('checkup_id = ' . $id);
//        if (!$row) {
//            throw new \Exception("Could not find row $id");
//        }
//        return $row;
//    }
//
//    public function addCheckup($values)
//    {
//        $this->insert($this->_normalizeValues($values));
//    }
//
//    public function updateCheckup($id, $values)
//    {
//        $this->update($this->_normalizeValues($values), 'checkup_id = ' . (int) $id);
//    }
//
//    public function deleteCheckup($id)
//    {
//        $this->delete('checkup_id =' . (int) $id);
//    }
//
//    protected function _normalizeValues(array $values)
//    {
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
//
//        return $values;
//    }


}
