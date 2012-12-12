<?php

namespace HiCheckup\Block\Checkup;

use HiBase\Block\Widget\Grid as WidgetGrid;

class Grid extends WidgetGrid
{
    protected $_id                      = 'CheckupGrid';
    protected $_header                  = 'Checkup Header';
    protected $_defaultSort             = 'checkup_id';
    protected $_defaultDir              = 'asc';
    protected $_massactionIdField       = 'checkup_id';



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

        $this->addColumn('action',
            array(
                'label'    => $this->__('Action'),
                'width'     => '52px',
                'type'      => 'action',
                'getter'     => 'getId',
                'actions'   => array(
                    array(
                        'label' => '<i class="icon-edit"></i>',
                        'title' => $this->__('Edit'),
                        'url'     => $this->url(
                            'hi-checkup/checkup/edit/wildcard',
                            array(
                                'checkup_id' => '',
                            )
                        ),
                        'field'   => 'checkup_id'
                    ),
                    array(
                        'label' => '<i class="icon-remove"></i>',
                        'title' => $this->__('Delete'),
                        'url' => $this->url(
                            'hi-checkup/checkup/delete/wildcard',
                            array(
                                'checkup_id' => '',
                            )
                        ),
                        'field'   => 'checkup_id'
                    )
                ),
                'filter'    => false,
                'sortable'  => false,
//                'index'     => 'stores',
        ));

        //always at the end
        parent::_prepareColumns();
    }

    protected function _prepareMassaction()
    {
//        \Zend\Debug::dump(get_class($this->getMassactionBlock()));
        $this->getMassactionBlock()->addItem(
            'delete',
            array(
                'label' => 'Delete',
//                'index' => 'checkup_id',
            )
        );
//        //
//        $model = $this->getServiceManager()->get('CheckupModel');
//
//        //
//        $columns = $model->getColumns();
////        \Zend\Debug::dump($columns);
//
//        //
//        foreach ($columns as $id => $column) {
//            $this->addColumn($id, $column);
//        }

        //always at the end
         return parent::_prepareMassaction();
    }


    protected function _prepareCollection()
    {
        $model = $this->getServiceManager()->get('CheckupModel');

        $pager = $this->getPager();

//        \Zend\Debug::dump($this->getVarNameSort(), '$this->getVarNameSort()');
//        \Zend\Debug::dump($this->getVarNameDir(), '$this->getVarNameDir()');
//        \Zend\Debug::dump($this->getParam($this->getVarNameSort()), '$this->getParam($this->getVarNameSort())');
//        \Zend\Debug::dump($this->getParam($this->getVarNameDir()), '$this->getParam($this->getVarNameDir())');

//        $this->getFilterValues();
        \Zend\Debug\Debug::dump($this->getFilterValues());

        $where = null;//filter

        foreach ($this->getFilterValues() as $filter) {
            if (isset($filter['type'])) {

                switch($filter['type']) {
                    case 'range':
                    case 'decimal':
                    case 'integer':
                    case 'id':
                    case 'date':
                    case 'datetime':
                        if (isset($filter['values']['from'])) {
                            $where[$filter['field'] . " >= ?"] = $filter['values']['from'] ;
                        }
                        if (isset($filter['values']['to'])) {
                            $where[$filter['field'] . " <= ?"] = $filter['values']['to'] ;
                        }
                        break;
                    case 'text':
                    default:
                        $where[$filter['field'] . " like ?"] = '%' . $filter['values'] . '%' ;

                }
            }
        }

//        $where = array(
//
////            'fat_percentage' => 'asdf',
////            'weight' => 'asdf2'
//        );


        $order = $this->getSort();
        $limit = $pager->getLimit();
        $offset = $pager->getOffset();
        $cols = null;//getColumns
        $joins = null; // ?

        $resultSet = $model->getResultSet(
            $where,
            $order,
            $limit,
            $offset,
            $cols,
            $joins
        );

//        \Zend\Debug\Debug::dump($resultSet);

        $pager->setSize($model->getCountLastSql());

        $this->setCollection($resultSet);

        parent::_prepareCollection();
    }
}