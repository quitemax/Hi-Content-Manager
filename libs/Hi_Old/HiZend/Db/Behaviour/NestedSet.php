<?php
/**
 * Hi CMS
 *
 * @category   HiZend
 * @package    HiZend_Db
 * @copyright  Copyright (c) 2009 Piotr Maxymilian Socha
 * @license
 */

/** HiZend_Db_Behaviour */
//require_once 'HiZend/Db/Behaviour.php';

/**
 *
 *
 * @category   HiZend
 * @package    HiZend_Db
 * @subpackage Table
 * @copyright  Copyright (c) 2009 Piotr Maxymilian Socha
 * @license
 */
class HiZend_Db_Behaviour_NestedSet extends HiZend_Db_Behaviour
{
    protected $_left;
    protected $_right;
    protected $_level;
    protected $_order;
    protected $_parentId;
    protected $_rootId;
    protected $_basePrimaryKey;
    protected $_titleColumn;
//    /**#@+
//     * List id template
//     */
//    const INFO_PLACEMENT_APPEND = 1;
//    /**#@-*/
//
//    /**#@+
//     * List id template
//     */
//    const INFO_PLACEMENT_PREPEND = 2;
//    /**#@-*/


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

    /**
     *
     *
     * @return void
     */
    public function setLang($lang = 'pl')
    {
        $this->_lang = $lang;
    }

    /**
     *
     *
     * @return void
     */
    public function getLang()
    {
        return $this->_lang;
    }

    /**
     *
     *
     * @return void
     */
    public function setLangs($langs = null)
    {
        if (is_array($langs)) {
            $this->_langs = $langs;
        }
    }

    /**
     *
     *
     * @return void
     */
    public function getLangs()
    {
        return $this->_langs;
    }

    /**
     *
     *
     * @return void
     */
    public function getTree($where = null)
    {
        //
        $returnTree = array();

        //
        $order = $this->_left;

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
        );


        //
        /*@var $parentTable HiZend_Db_Table*/
        $parentTable = $this->_parentTable;

        if ($this->_lang && $parentTable->hasBehaviour('i18n')) {
            $i18nBehaviour = $parentTable->getBehaviour('i18n');
            $i18nBehaviour->setLang($this->_lang);

        }



        $returnTree = $parentTable->getAll(
            $where,
            $order,
            $count,
            $offset,
            $cols
        );
//        Zend_Debug::dump($returnTree->__toString());

        if ($this->_lang && $parentTable->hasBehaviour('i18n')) {
            $i18nBehaviour = $parentTable->getBehaviour('i18n');
            $i18nBehaviour->clearLang();

        }


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
    public function rebuildNestedSetFromAdjacencyModel() {
        /*@var $parentTable HiZend_Db_Table*/
        $parentTable = $this->_parentTable;

        $modelInfo = $parentTable->info();

//        Zend_Debug::dump($modelInfo);

        $treeElements = $parentTable->getAll(
            null,
            array(
                'root_id',
                'parent_id',
                'position',
                'id'
            ),
            null,
            null,
            array(
                'id'        => $this->_basePrimaryKey,
                'parent_id' => $this->_parentId,
                'position'  => $this->_order,
                'root_id'   => $this->_rootId
            )
        );

//        Zend_Debug::dump($treeElements);
        $resultTree = array();
        $this->_getTreeList($treeElements, $resultTree);


        /*@var $dbAdapter Zend_Db_Adapter_Abstract*/
        $dbAdapter = $this->_db;

        $dbAdapter->beginTransaction();

        foreach ($resultTree as $node) {
            $updateFields = array(
                $this->_left    => $node['left'],
                $this->_right   => $node['right'],
                $this->_level   => $node['level'],
            );

            $where = $this->_basePrimaryKey . ' = ' . $node['id'];

//            Zend_Debug::dump($updateFields);
//            Zend_Debug::dump($where);

            $parentTable->update(
                $updateFields,
                $where
            );
        }

        $dbAdapter->commit();


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