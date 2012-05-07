<?php
/**
 * Hi CMS
 *
 * @category   HiZend
 * @package    HiZend_Db
 * @copyright  Copyright (c) 2009 Piotr Maxymilian Socha
 * @license
 */

namespace HiBase\Db\Behaviour;


use HiBase\Db\Behaviour\Behaviour;

/**
 *
 *
 * @category   HiZend
 * @package    HiZend_Db
 * @subpackage Table
 * @copyright  Copyright (c) 2009 Piotr Maxymilian Socha
 * @license
 */
class NestedSet extends Behaviour
{
    protected $_left;
    protected $_right;
    protected $_level;
    protected $_order;
    protected $_parentId;
    protected $_rootId;
    protected $_basePrimaryKey;
    protected $_titleColumn;

    /**#@+
     * List id template
     */
    const INFO_PLACEMENT_APPEND = 1;
    /**#@-*/

    /**#@+
     * List id template
     */
    const INFO_PLACEMENT_PREPEND = 2;
    /**#@-*/


    /**
     *
     *
     * @return void
     */
    public function __construct($dbTable = null, $config = array())
    {
        parent::__construct($dbTable, $config);

        foreach ($config as $optionName => $option) {
            switch($optionName) {
                case 'left':
                    $this->_left = $option;
                    break;
                case 'right':
                    $this->_right = $option;
                    break;
                case 'level':
                    $this->_level = $option;
                    break;
                case 'order':
                    $this->_order = $option;
                    break;
                case 'parentId':
                    $this->_parentId = $option;
                    break;
                case 'rootId':
                    $this->_rootId = $option;
                    break;
                case 'basePrimaryKey':
                    $this->_basePrimaryKey = $option;
                    break;
                case 'title':
                    $this->_titleColumn = $option;
                    break;
                default:
                    break;
            }
        }
//        $this->_lang = 'pl';


    }

//    /**
//     *
//     *
//     * @return void
//     */
//    public function setLang($lang = 'pl')
//    {
//        $this->_lang = $lang;
//    }
//
//    /**
//     *
//     *
//     * @return void
//     */
//    public function getLang()
//    {
//        return $this->_lang;
//    }
//
//    /**
//     *
//     *
//     * @return void
//     */
//    public function setLangs($langs = null)
//    {
//        if (is_array($langs)) {
//            $this->_langs = $langs;
//        }
//    }
//
//    /**
//     *
//     *
//     * @return void
//     */
//    public function getLangs()
//    {
//        return $this->_langs;
//    }

    /**
     *
     *
     * @return void
     */
    public function getTree($where = null, $order = null, $count= null, $offset = null, $cols = null)
    {
        //
        $returnTree = array();

        //
        $order = array('`left`');

        //
        $count = null;

        //
        $offset = null;

        //
        $cols = array(
            'id'        =>  $this->_basePrimaryKey,
            'parent'    =>  $this->_parentId,
            'level'     =>  $this->_level,
            'title'     =>  $this->_titleColumn,
            'position'  =>  $this->_order,
            'left'      =>  $this->_left,
        );


//        //
//        /*@var $parentTable HiZend_Db_Table*/
//        $parentTable = $this->_parentTable;
//
//        if ($this->_lang && $parentTable->hasBehaviour('i18n')) {
//            $i18nBehaviour = $parentTable->getBehaviour('i18n');
//            $i18nBehaviour->setLang($this->_lang);
//
//        }
//
//
//
        $returnTree = $this->_parentTable->getResultSet(
            $where,
            $order,
            $count,
            $offset,
            $cols
        );
//        \Zend\Debug::dump($returnTree->toArray());
//
//        if ($this->_lang && $parentTable->hasBehaviour('i18n')) {
//            $i18nBehaviour = $parentTable->getBehaviour('i18n');
//            $i18nBehaviour->clearLang();
//
//        }


        //
        return $returnTree;
    }

    /**
     *
     *
     * @return array | false
     */
    public function insertAfterNode($id = null, $data = null) {

    }

    /**
     *
     *
     * @return array | false
     */
    public function insertBeforeNode($id = null, $data = null) {

    }


    /**
     *
     *
     * @return array | false
     */
    public function getResultSetForSelect($where = null, $order = null, $count= null, $offset = null, $cols = null) {
        $treeElements = $this->_parentTable->getResultSet(
            null,
            array(
//                'root_id',
                '`left`',
//                'position',
//                'id'
            ),
            null,
            null,
            array(
                'id'        => $this->_basePrimaryKey,
                'left'      => $this->_left,
                'level'     => $this->_level,
                'title'     => $this->_titleColumn,
//                'root_id'   => $this->_rootId
            )
        )->toArray();

        $resultTree = array('0'=>'--');
        foreach ($treeElements as $element) {
            $resultTree[$element['id']] = str_repeat('--', $element['level']) . $element['title'];
        }
//
//        \Zend\Debug::dump($treeElements->toArray());
//        $resultTree = array();
//        $this->_getTreeList($treeElements, $resultTree);
        return $resultTree;
    }

/**
     *
     *
     * @return array | false
     */
    public function getResultSetForText($where = null, $order = null, $count= null, $offset = null, $cols = null) {
        $treeElements = $this->_parentTable->getResultSet(
            null,
            array(
//                'root_id',
                '`left`',
//                'position',
//                'id'
            ),
            null,
            null,
            array(
                'id'        => $this->_basePrimaryKey,
                'left'      => $this->_left,
                'level'     => $this->_level,
                'title'     => $this->_titleColumn,
                'parent'    => $this->_parentId,
//                'root_id'   => $this->_rootId
            )
        )->toArray();

        $resultTree = array('0'=>'--');

        $treeElementsTemp = array();
        foreach ($treeElements as $element) {
            $treeElementsTemp[(int)$element['id']] = $element;
        }

        foreach ($treeElementsTemp as $element) {

            $title = array();
            array_unshift($title, $element['title']);
            $parent = isset($element['parent']) ? (int) $element['parent']: 0 ;

            if  ( $parent > 0 ) {

                while ($parent > 0) {

                    if (isset($treeElementsTemp[$parent])) {
                        array_unshift($title, $treeElementsTemp[$parent]['title']);
                        $parent = (int) $treeElementsTemp[$parent]['parent'];
                    }

                }

            }


            $resultTree[$element['id']] = implode(' / ', $title);
        }

        return $resultTree;
    }

    /**
     *
     *
     * @return array | false
     */
    public function rebuildNestedSetFromAdjacencyModel() {
//        /*@var $parentTable HiZend_Db_Table*/
//        $parentTable = $this->_parentTable;
//
//        $modelInfo = $parentTable->info();
//
////        Zend_Debug::dump($modelInfo);
//
//\Zend\Debug::dump(array(
//                'root_id',
//                'parent_id',
//                'position',
//                'id'
//            ));
//\Zend\Debug::dump(array(
//                'id'        => $this->_basePrimaryKey,
//                'parent_id' => $this->_parentId,
//                'position'  => $this->_order,
//                'root_id'   => $this->_rootId
//            ));
        $treeElements = $this->_parentTable->getResultSet(
            null,
//            array(
////                'root_id',
//                'parent_id',
//                'position',
//                'id'
//            ),
            array(
//                'root_id',
                '`parent_id` asc, `position` asc, `id` asc',
//                'position',
//                'id'
            ),
            null,
            null,
            array(
                'id'        => $this->_basePrimaryKey,
                'parent_id' => $this->_parentId,
                'position'  => $this->_order,
//                'root_id'   => $this->_rootId
            )
        )->toArray();
//
//        \Zend\Debug::dump($treeElements);
        $resultTree = array();
        $this->_getTreeList($treeElements, $resultTree);
//        \Zend\Debug::dump($resultTree);
//
//
//        /*@var $dbAdapter Zend_Db_Adapter_Abstract*/
        $adapter = $this->_parentTable->getAdapter();
        $connection = $adapter->getDriver()->getConnection();
//        \Zend\Debug::dump($adapter);
//        \Zend\Debug::dump($connection);

        $connection->beginTransaction();

        foreach ($resultTree as $node) {
            $updateFields = array(
                $this->_left    => $node['left'],
                $this->_right   => $node['right'],
                $this->_level   => $node['level'],
            );

            $where = $this->_basePrimaryKey . ' = ' . $node['id'];

//            \Zend\Debug::dump($updateFields);
//            \Zend\Debug::dump($where);

            $this->_parentTable->update(
                $updateFields,
                $where
            );
        }

        $connection->commit();


        return $this;
    }

    private function _getTreeList(&$cats, &$list, $parent_id = 0, $level = 0, $nested = 1){
        //$order = 10;
        if ( isset($cats) && is_array($cats) && count($cats)>0 && is_array($list) ) {
            foreach ($cats as $key => $cat) {
                if ($cat['parent_id'] == $parent_id) {
                    $cats[$key]['level'] = $level;
                    $cats[$key]['left'] = $nested++;
          //          $cats[$key]['order'] = $order;
          //          $order += 10;
                    $list[] = &$cats[$key];
                    $nested = $this->_getTreeList(
                        $cats,
                        $list,
                        $cat['id'],
                        $level + 1,
                        $nested
                    );
                    $cats[$key]['right'] = $nested++;
                }
            }
        }
        return $nested;
    }
}