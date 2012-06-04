<?php

namespace HiCheckup\Block\Checkup;

use HiBase\Block\Widget\Grid as WidgetGrid;

class Grid extends WidgetGrid
{
    protected $_id = 'CheckupGrid';
    protected $_header = 'Checkup Header';

    protected function _prepareColumns()
    {
        //
        $model = $this->getServiceManager()->get('CheckupModel');

        //
        $columns = $model->getColumns();
//        \Zend\Debug::dump($columns);

        //
        foreach ($columns as $id => $column) {
            $this->addColumn($id, $column);
        }

        //always at the end
        parent::_prepareColumns();
    }


    protected function _prepareCollection()
    {
        $model = $this->getServiceManager()->get('CheckupModel');

        $pager = $this->getPager();

        $where = null;
        $order = null;
        $limit = $pager->getLimit();
        $offset = $pager->getOffset();
        $cols = null;
        $joins = null;

        $resultSet = $model->getResultSet(
            $where,
            $order,
            $limit,
            $offset,
            $cols,
            $joins
        );

        $pager->setSize($model->getCountLastSql());

        $this->setCollection($resultSet);

        parent::_prepareCollection();
    }
}