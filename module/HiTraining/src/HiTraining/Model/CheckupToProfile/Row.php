<?php
/**
 *
 * Enter description here ...
 * @author MaX
 *
 */
namespace HiTraining\Model\CheckupToProfile;

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
//     * before save
//     *
//     * @return
//     */
//    protected function _beforeSave()
//    {
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
//    }
}
