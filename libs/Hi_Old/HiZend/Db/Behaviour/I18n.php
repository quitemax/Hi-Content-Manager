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
require_once 'HiZend/Db/Behaviour.php';

/**
 * Refited Zend_Db_Table class for use with HiCms
 *
 * @category   HiZend
 * @package    HiZend_Db
 * @subpackage Table
 * @copyright  Copyright (c) 2009 Piotr Maxymilian Socha
 * @license
 */
class HiZend_Db_Behaviour_I18n extends HiZend_Db_Behaviour
{
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


    protected $_dbTable;
    protected $_connection;
    protected $_fields;
    protected $_lang;
    protected $_langs;
    protected $_behaviourWhere;
    protected $_behaviourColumns;
    protected $_behaviourInsertData;


//    'dbTable'       => array (
//        'name'  => array(
//            'hti'   =>  'hicms_test_i18n',
//        ),
//        'class'                 =>  'Test_Model_DbTable_TestI18n',
//        'primaryKey'               =>  'hti_id',
//        'langField'             =>  'hti_hl_lang',
//        'foreignKey'            =>  'hti_ht_id',
//        'translationActive'     =>  'hti_translation_is_active',
//        'basePrimaryKey'        =>  'ht_id',
//        'infoPlacement'    =>  HiZend_Db_Table::TABLE_INFO_PLACEMENT_APPEND,
//    ),
//    'connection'    =>  'hti.hti_ht_id = ht.ht_id',
//    'fields'        =>  array(
//        'ht_title'         => 'hti_title',
//        'ht_description'   => 'hti_description',
//    ),

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
                case 'dbTable':
                    $this->_dbTable = $option;
                    break;
                case 'connection':
                    $this->_connection = $option;
                    break;
                case 'fields':
                    $this->_fields = $option;
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
    public function clearLang()
    {
        unset($this->_lang);
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
    public function applyBehaviourToSql(
        Zend_Db_Select $sqlSelect = null,
        &$where = null,
        &$order = null,
        &$count = null,
        &$offset = null,
        &$cols = null
    )
    {
        if ($sqlSelect !== null) {

            //
            $translatedFieldsKeys    = array_keys($this->_fields);

            if (isset($this->_lang) && $this->_lang != '') {
                /**
                 *
                 * COLUMNS
                 *
                 */
                $joinCols = array();
                $fromCols = array();

                if ($cols !== null && is_array($cols) && count($cols)) {
                    foreach ($cols as $alias => $col) {
                        if (!in_array($col, $translatedFieldsKeys)){
                            if (is_string($alias)) {
                                $fromCols[$alias] = $col;
                            } else {
                                $fromCols[$col] = $col;
                            }

                        } else {
                            if (is_string($alias)) {
                                $joinCols[$alias] = $this->_fields[$col];
                            } else {
                                $joinCols[$col] = $this->_fields[$col];
                            }

                        }
                    }

                    //
                    $cols = $fromCols;

                } else { //$cols === null
                    //
                    $joinCols = $this->_fields;
                }

                /**
                 *
                 * WHERE
                 *
                 */
                //where
                if ($where!==null) {
                    if (is_array($where)) {
                        foreach ($where as $keyWhere => $w) {
                            foreach ($this->_fields as $fieldKey => $fieldName) {
                                if (strpos($w, $fieldKey) !== false) {
                                    $where[$keyWhere] = str_replace($fieldKey, $fieldName, $w);
                                    break;
                                }
                            }
                        }
                    } else {
                        foreach ($this->_fields as $fieldKey => $fieldName) {
                            if (strpos($where, $fieldKey) !== false) {
                                $where = str_replace($fieldKey, $fieldName, $where);
                                break;
                            }
                        }
                    }
                }

                /**
                 *
                 * JOIN
                 *
                 */
                $sqlSelect->joinLeft(
                    $this->_dbTable['name'],
                    $this->_connection,
                    $joinCols
                );

                $sqlSelect->where(
                    $this->_dbTable['langField'] . ' = ' . $this->_db->quote($this->_lang)
                );

            } else { //lang is not set
                /**
                 *
                 * COLUMNS
                 *
                 */
                $fromCols = array();
                $joinCols = array();

                //
                $langField      = $this->_dbTable['langField'];
                $foreignKey     = $this->_dbTable['foreignKey'];
                $basePrimaryKey = $this->_dbTable['basePrimaryKey'];
                $classString    = $this->_dbTable['class'];

                if ($cols !== null && is_array($cols) && count($cols)) {

                    foreach ($cols as $alias => $col) {
                        if (!in_array($col, $translatedFieldsKeys)){
                            if (is_string($alias)) {
                                $fromCols[$alias] = $col;
                            } else {
                                $fromCols[$col] = $col;
                            }

                        } else {
                            if (is_string($alias)) {
                                $joinCols[$alias] = $this->_fields[$col];
                            } else {
                                $joinCols[$col] = $this->_fields[$col];
                            }

                        }
                    }


                    if (!in_array($basePrimaryKey, $fromCols)) {
                        $fromCols[$basePrimaryKey] = $basePrimaryKey;
                    }



                } else {

                    //
                    $joinCols = $this->_fields;
                }
//                Zend_Debug::dump($joinCols);

                if (count($joinCols)) {
                    //
                    if (!in_array($foreignKey, $joinCols)) {
                        $joinCols[$foreignKey] = $foreignKey;
                    }
                    if (!in_array($langField, $joinCols)) {
                        $joinCols[$langField] = $langField;
                    }
                }

                //
                $cols = $fromCols;

                $this->_behaviourColumns = $joinCols;
//                Zend_Debug::dump($fromCols);
//                Zend_Debug::dump($joinCols);


                /**
                 *
                 * WHERE
                 *
                 */
                $joinWhere = array();

                if ($where!==null) {

                    if (is_array($where)) {
                        foreach ($where as $keyWhere => $w) {
                            foreach ($this->_fields as $fieldKey => $fieldName) {
                                if (strpos($w, $fieldKey) !== false) {
                                    $joinWhere[] = str_replace($fieldKey, $fieldName, $w);;
                                    unset($where[$keyWhere]);
                                    break;
                                }
                            }
                        }
                    } else {
                        foreach ($this->_fields as $fieldKey => $fieldName) {
                            if (strpos($where, $fieldKey) !== false) {
                                $joinWhere[] = str_replace($fieldKey, $fieldName, $where);
                                unset($where);
                                break;
                            }
                        }
                    }
                }

                //
                $this->_behaviourWhere = $joinWhere;

                if (count($this->_behaviourWhere)) {
                    //
                    $translateClass = new $classString();

                    if (!($translateClass instanceof HiZend_Db_Table)) {
                        throw new Exception('Wrong transaltion table type (Should be HiZend_Db_Table)');
                    }

                    $translationSql = $translateClass->prepareGetAllSql(
                        $this->_behaviourWhere,
                        null,
                        null,
                        null,
                        array(
                            $foreignKey
                        )
                    );

                    $where[] = $basePrimaryKey . ' in ( ' . $translationSql . ' ) ';

                }
            }
        }

        return $sqlSelect;
    }

    /**
     *
     *
     * @return array
     */
    public function modifyResults(
        $results = null,
        $where = null,
        $order = null,
        $count = null,
        $offset = null,
        $cols = null
    )
    {
//        Zend_Debug::dump($cols);

        if (count($results)) {

            if (isset($this->_lang) && $this->_lang != '') {


            } else {

                if (count($this->_behaviourColumns)) {

                    $langField      = $this->_dbTable['langField'];
                    $foreignKey     = $this->_dbTable['foreignKey'];
                    $basePrimaryKey = $this->_dbTable['basePrimaryKey'];
                    $classString    = $this->_dbTable['class'];


                    $basePrimaryKeyAlias = $basePrimaryKey;
                    if (is_array($cols)) {
                        if (in_array($basePrimaryKey, $cols)) {
                            $flip = array_flip($cols);
                            $basePrimaryKeyAlias = $flip[$basePrimaryKey];
                        }
                    }

//                    Zend_Debug::dump($basePrimaryKeyAlias);
                    $allItemsIds = array();
                    foreach ($results as $item) {
                        if (isset($item[$basePrimaryKeyAlias])) {
                            $allItemsIds[] = $item[$basePrimaryKeyAlias];
                        }
                    }

//                    Zend_Debug::dump($basePrimaryKeyAlias);


                    //
                    if (count($allItemsIds)) {

                        $translateClass = new $classString();

                        if (!($translateClass instanceof HiZend_Db_Table)) {
                            throw new Exception('Wrong transaltion table type (Should be HiZend_Db_Table)');
                        }


                        //tableForeignKey
                        $translationsWhere = $foreignKey.' in ( '.implode(',',$allItemsIds).' )';
                        $translations = $translateClass->getAll(
                            $translationsWhere,
                            null,
                            null,
                            null,
                            $this->_behaviourColumns
                        );
//                        echo '<pre>';
//                        print_r($translations->__toString());
//                        echo '</pre>';



                        foreach ($results as $key => $item) {

                            foreach ($translations as $transKey => $translation) {

                                if ($item[$basePrimaryKeyAlias] == $translation[$foreignKey]) {

                                    //map translations on to results item
                                    foreach ($this->_behaviourColumns as $fieldAlias => $fieldName) {
                                        if (in_array($fieldName, $this->_fields )) {
                                            if (!isset($results[$key][$fieldAlias]) || !is_array($results[$key][$fieldAlias])) {
                                                $results[$key][$fieldAlias] = array();
                                            }
                                            $results[$key][$fieldAlias][$translation[$langField]] = $translation[$fieldAlias];
                                        }
                                    }

                                    //we dont need that translation anymore
                                    unset($translations[$transKey]);
                                }
                            }
                            if (is_array($cols) && !in_array($basePrimaryKey, $cols)) {
                                unset($results[$key][$basePrimaryKey]);
                            }
                        }
                    }
                }
            }
        }

        return $results;

    }


    public function modifyInfo($info = null)
    {
        if ($info) {

            $infoPlacement     = $this->_dbTable['infoPlacement'];


            //
            $classString = $this->_dbTable['class'];
            $translateClass = new $classString();

            if (!($translateClass instanceof HiZend_Db_Table)) {
                throw new Exception('Wrong transaltion table type (Should be HiZend_Db_Table)');
            }

            //
            $translateInfo  = $translateClass->info();

            //
            $translatedFieldsFlip   = array_flip($this->_fields);


            if ($infoPlacement == HiZend_Db_Behaviour_I18n::INFO_PLACEMENT_PREPEND) {

                //
                $newMetadata = array();
                $newMetadata[$info['primary'][1]] = $info['metadata'][$info['primary'][1]];
                foreach ($translateInfo['metadata'] as $name => $column) {
                    //
                    if (in_array($name, $this->_fields)){
                        $column['TRANSLATED'] = 1;
                        $newMetadata[$translatedFieldsFlip[$name]] = $column;
                    }
                }

                //
                $info['metadata']   = $newMetadata + $info['metadata'];

            } else {
                foreach ($translateInfo['metadata'] as $name => $column) {
                    //
                    if (in_array($name, $this->_fields)){
                        $column['TRANSLATED'] = 1;
                        $info['metadata'][$translatedFieldsFlip[$name]] = $column;
                    }
                }

                //

            }

            $info['cols']       = array_keys($info['metadata']);
        }

        return $info;
    }

    /**
     *
     *
     * @return array
     */
    public function prepareInsert(&$data = null)
    {
//        Zend_Debug::dump($this, 'prepare insert i18n object');
        //
        if ($data !== null) {
            //
            $translateData = array();

            //
            $translatedFieldsKeys   = array_keys($this->_fields );
            $langField              = $this->_dbTable['langField'];

            //
            foreach ($data as $field => $value) {
                if ( in_array($field, $translatedFieldsKeys) ) {
                    //if the lang is set
                    if (isset($this->_lang) && $this->_lang !== null) {
                        if (!is_array($value)) {
                            $translateData[$this->_lang][$this->_fields[$field]] = $value;
                            $translateData[$this->_lang][$langField] = $this->_lang;
                        }
                    //if it isnt
                    } else {
                        if (is_array($value)) {
                            foreach($value as $transLang => $transVal) {
                                $translateData[$transLang][$this->_fields[$field]] = $transVal;
                                $translateData[$transLang][$langField] = $transLang;
                            }
                        }

                    }

                    //
                    unset($data[$field]);
                }
            }


            //
            $this->_behaviourInsertData = $translateData;
//            Zend_Debug::dump($this->_behaviourInsertData, 'behaviourInsertData');
        }
    }

    /**
     *
     *
     * @return void
     */
    public function applyInsert($id = null)
    {
        //
        if ($id !== null) {

            //
            if (count($this->_behaviourInsertData)) {

                //
                $classString = $this->_dbTable['class'];
                $translateClass = new $classString();

                //
                $foreignKey             = $this->_dbTable['foreignKey'];

                //
                foreach($this->_behaviourInsertData as $tData) {
                    $tData[$foreignKey] = $id;
                    $translateClass->insert($tData);
                }
            }
        }
    }

    /**
     *
     *
     * @return array
     */
    public function modifyUpdate(&$data = null, &$where = null)
    {
//        Zend_Debug::dump($data, 'I18n - moduifyUpdate data');
//        Zend_Debug::dump($where, 'I18n - moduifyUpdate where');
//        Zend_Debug::dump($this->_lang, '$this->_lang');
        //
        $updatedRowsCount = false;

        if ($data!==null && is_array($data)) {
            //
            $updatedRowsCount = 0;
            $translateData = array();

            //
            $translatedFieldsKeys   = array_keys($this->_fields );
            $langField              = $this->_dbTable['langField'];
            $primaryKey             = $this->_dbTable['primaryKey'];
            $foreignKey             = $this->_dbTable['foreignKey'];
            $basePrimaryKey         = $this->_dbTable['basePrimaryKey'];


            //
            $classString = $this->_dbTable['class'];
            $translateClass = new $classString();

            if (isset($this->_lang) && $this->_lang !== null) {
                foreach ($data as $field => $value) {
                    if ( in_array($field, $translatedFieldsKeys) ) {
                        if (!is_array($value)) {
                            $translateData[$this->_lang][$this->_fields[$field]] = $value;
                            $translateData[$this->_lang][$langField] = $this->_lang;
                        } else if (isset($value[$this->_lang])) {
                        	$translateData[$this->_lang][$this->_fields[$field]] = $value[$this->_lang];
                            $translateData[$this->_lang][$langField] = $this->_lang;
                        }
                        unset($data[$field]);
                    }
                }

                if (count($translateData)) {

                    //
                    $idsForUpdateSql = $this->_parentTable->prepareGetAllSql(
                            $where,
                            null,
                            null,
                            null,
                            array(
                                $basePrimaryKey,
                            )
                        );

                    //
                    $updates = $translateClass->getAll(
                        $foreignKey . ' in ( ' . $idsForUpdateSql . ' )'
                        . ' and '
                        . $langField . ' = ' . $this->_db->quote($this->_lang),
                        null,
                        null,
                        null,
                        array(
                            'primaryKey'    => $primaryKey,
                            'langField'     => $langField,
                            'foreignKey'    => $foreignKey,
                        )
                    );

                    if ($updates) {
                        //update the data
                        foreach($translateData as $tLang => $tData) {
                            foreach ($updates as $key => $update) {
                                if ($update['langField'] == $tLang) {

                                    //prepare data
                                    $tData[$foreignKey] = $update['foreignKey'];
                                    $updateWhere = $primaryKey . ' = ' . $update['primaryKey'];

                                    //delete update as we will no loger need it
                                    unset($updates[$key]);

                                    //update
                                    $updatedRowsCount += $translateClass->update($tData, $updateWhere);
                                }
                            }
                        }
                    } else {
                      // @TODO when ther is no translation and we have to insert a new one
                    }
                }
            } else {
                //
                foreach ($data as $field => $value) {
                    if ( in_array($field, $translatedFieldsKeys) ) {
                        if (is_array($value)) {
                            foreach($value as $transLang => $transVal) {
                                $translateData[$transLang][$this->_fields[$field]] = $transVal;
                                $translateData[$transLang][$langField] = $transLang;
                            }
                        }
                        unset($data[$field]);
                    }
                }

//                Zend_Debug::dump($translateData);

                if (count($translateData)) {

                    //
                    $idsForUpdateSql = $this->_parentTable->prepareGetAllSql(
                            $where,
                            null,
                            null,
                            null,
                            array(
                                $basePrimaryKey,
                            )
                        );

                    //
                    $updates = $translateClass->getAll(
                        $foreignKey . ' in ( ' . $idsForUpdateSql . ' )',
                        null,
                        null,
                        null,
                        array(
                            'primaryKey'    => $primaryKey,
                            'langField'     => $langField,
                            'foreignKey'    => $foreignKey,
                        )
                    );


//                    Zend_Debug::dump($updates);

                    //
                    $translatedRows = array();

                    //
                    foreach($translateData as $tLang => $tData) {
                        foreach ($updates as $key => $update) {
                            if ($update['langField'] == $tLang) {

                                $translatedRows[$update['foreignKey']][$update['primaryKey']] = $update['langField'];

                                $updateRow = $tData;
                                $updateRow[$foreignKey] = $update['foreignKey'];
                                $updateWhere = $primaryKey . ' = ' . $update['primaryKey'];

                                unset($updates[$key]);

                                $updatedRowsCount += $translateClass->update($updateRow, $updateWhere);
                            }
                        }
                    }
//                    Zend_Debug::dump($updates);
//                    Zend_Debug::dump($translatedRows);
//

                    //if there are rows which we didnt update we must insert them
                    foreach ($translatedRows as $foreignKeyValue => $transRow) {
                        $tmpTransData = $translateData;
                        foreach ($transRow as $transLang) {
                            unset($tmpTransData[$transLang]);
                        }

                        foreach($tmpTransData as $tLang => $tData) {
                            $newRow = $tData;
                            $newRow[$foreignKey] = $foreignKeyValue;
//                            Zend_Debug::dump($newRow);
                            $translateClass->insert($newRow);
                        }
                    }
                }
            }
        }

        return $updatedRowsCount;
    }


}