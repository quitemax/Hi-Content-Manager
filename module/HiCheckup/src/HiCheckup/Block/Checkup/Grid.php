<?php

namespace HiCheckup\Block\Checkup;

use HiBase\Block\Widget\Grid as WidgetGrid;

class Grid extends WidgetGrid
{
    protected $_id = 'CheckupGrid';
    protected $_header = 'Checkup Header';

    protected function _prepareColumns()
    {
        $model = $this->getServiceManager()->get('CheckupModel');

        $columns = $model->getColumns();
//        \Zend\Debug::dump($columns);

        foreach ($columns as $id => $column) {
            $this->addColumn($id, $column);
        }

        parent::_prepareColumns();
    }


    protected function _prepareCollection()
    {
        $model = $this->getServiceManager()->get('CheckupModel');

//        \Zend\Debug::dump(get_class($model));

        $resultSet = $model->getResultSet();
//        \Zend\Debug::dump(get_class($resultSet), 'get_class($resultSet)');
//        \Zend\Debug::dump($resultSet);
//        $row = $model->getRow();
//        \Zend\Debug::dump(get_class($row), 'get_class($$row)');
//        \Zend\Debug::dump($row);
//
        $this->setCollection($resultSet);

        parent::_prepareCollection();
    }


//    /**
//     * Title
//     *
//     * @var string
//     */
//    protected $_title = 'CheckupGrid';
//
//    /**
//     * Title
//     *
//     * @var string
//     */
//    protected $_name = 'CheckupGridForm';
//
//    public function init()
//    {
//        parent::init();
//    }
}