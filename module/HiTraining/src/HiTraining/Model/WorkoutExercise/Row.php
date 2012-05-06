<?php

namespace HiTraining\Model\WorkoutExercise;

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
    /**
     * before save
     *
     * @return
     */
    protected function _beforeSave()
    {

        if ($this['distance'] > 0 && $this['exercise_elapsed_time'] !== '00:00:00') {

            $timeArray = explode(':', $this['exercise_elapsed_time']);
            $time += ($timeArray[0] * 3600 + $timeArray[1] * 60 + $timeArray[2] * 1);

            $distance = $this['distance'] * 1000;

            if ($time > 0) {
                $this['avg_speed'] = ($distance / $time) * (36/10);
            }
        }
    }
}
