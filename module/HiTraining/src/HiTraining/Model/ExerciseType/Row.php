<?php
/**
 *
 * Enter description here ...
 * @author MaX
 *
 */
namespace HiTraining\Model\ExerciseType;

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
//    /**
//     * Delete
//     *
//     * @return type
//     */
//    public function delete()
//    {
//        \Zend\Debug::dump('HiTraining\Model\CheckupToProfile\Row::delete()', '', true);
//        \Zend\Debug::dump($this->tableGateway, '$this->tableGateway', true);
//        parent::delete();
////        if (is_array($this->primaryKey)) {
////            // @todo compound primary keys
////        }
////
////        $where = array($this->primaryKey => $this->originalData[$this->primaryKey]);
////        return $this->tableGateway->delete($where);
//    }
    /**
     * before save
     *
     * @return
     */
    protected function _afterLoad()
    {
        if ($this->currentData && $this->count()) {
            if (!empty($this['type_img'])){
                $this['type_img'] = explode(',', $this['type_img']);
            }
        }
//
    }


    /**
     * before save
     *
     * @return
     */
    protected function _beforeSave()
    {

        if (isset($this['type_img']) && is_array($this['type_img'])){
//            \Zend\Debug::dump($this['type_img']);
            $this['type_img'] = implode(',', $this['type_img']);
        }
//
//        $this['fat_weight'] = ($this['fat_percentage']/100) * $this['weight'];
//        $this['fat_weight_range_top'] = ( ($this['fat_percentage'] + 0.1)/100 ) * ($this['weight'] + 0.1);
//        $this['fat_weight_range_bottom'] = ( ($this['fat_percentage'] - 0.1)/100 ) * ($this['weight'] - 0.1);
//
//        $this['water_weight'] = ($this['water_percentage']/100) * $this['weight'];
//        $this['water_weight_range_top'] = ( ($this['water_percentage'] + 0.1)/100 ) * ($this['weight'] + 0.1);
//        $this['water_weight_range_bottom'] = ( ($this['water_percentage'] - 0.1)/100 ) * ($this['weight'] - 0.1);
//
//        $this['muscle_weight'] = ($this['muscle_percentage']/100) * $this['weight'];
//        $this['muscle_weight_range_top'] = ( ($this['muscle_percentage'] + 0.1)/100 ) * ($this['weight'] + 0.1);
//        $this['muscle_weight_range_bottom'] = ( ($this['muscle_percentage'] - 0.1)/100 ) * ($this['weight'] - 0.1);
//
//        $this['bones_percentage'] = ($this['bones_weight'] / $this['weight']) * 100.0;
//        $this['bones_percentage_range_top'] = ( ($this['bones_weight'] + 0.1) / ($this['weight'] - 0.1) ) * 100.0;
//        $this['bones_percentage_range_bottom'] = ( ($this['bones_weight'] - 0.1) / ($this['weight'] + 0.1) ) * 100.0;
//
//
//        $this['bmi'] = $this['weight'] / ($this['height'] * $this['height']);
//
    }
}
