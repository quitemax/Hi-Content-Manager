<?php

namespace HiCheckup\Block\Checkup\Grid;

use HiBase\Block\Widget\Grid\Container as GridContainer;

class Container extends GridContainer
{
    protected $_headerText = 'Checkup List';

    protected $_id = 'CheckupGridContainer';

    public function getCreateUrl()
    {
        $url = $this->url('hi-checkup/checkup/add');

        return $url;

    }

//    public function _prepareLayout()
//    {
//        $this->_addBackButton();
//
//        parent::_prepareLayout();
//    }

}
