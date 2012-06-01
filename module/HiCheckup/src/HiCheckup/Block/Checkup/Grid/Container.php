<?php

namespace HiCheckup\Block\Checkup\Grid;

use HiBase\Block\Widget\Grid\Container as GridContainer;

class Container extends GridContainer
{
    /**
     * Title
     *
     * @var string
     */
    protected $_headerText = 'CheckupContainer';

    protected $_id = 'CheckupGridContainer';

    public function init()
    {
        parent::init();
    }
}