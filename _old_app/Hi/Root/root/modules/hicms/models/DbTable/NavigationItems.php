<?php
class Hicms_Model_DbTable_NavigationItems extends HiZend_Db_Table
{
    protected $_name   = 'hicms_navigation_items';
    protected $_primary   = 'hni_id';

    protected $_prfx = 'hni';

    protected $_dependentTables = array(
        'Hicms_Model_DbTable_NavigationItemsElements',
        'Hicms_Model_DbTable_NavigationItemsI18n',
    );

    protected $_behaviours = array(
        'i18n' => array(
            'dbTable'       => array (
                'name'  => array(
                    'hnii18n'   =>  'hicms_navigation_items_i18n',
                ),
                'class'                 =>  'Hicms_Model_DbTable_NavigationItemsI18n',
                'primaryKey'            =>  'hnii18n_id',
                'langField'             =>  'hnii18n_lang',
                'foreignKey'            =>  'hnii18n_hni_id',
                'basePrimaryKey'        =>  'hni_id',
                'translationActive'     =>  'hnii18n_translation_is_active',
                'infoPlacement'         =>  HiZend_Db_Behaviour_I18n::INFO_PLACEMENT_APPEND,
            ),
            'connection'    =>  'hnii18n.hnii18n_hni_id = hni.hni_id',
            'fields'        =>  array(
                'hni_translation_is_active' => 'hnii18n_translation_is_active',
                'hni_title'                 => 'hnii18n_title',
                'hni_description'           => 'hnii18n_description',
            ),
        ),
    );

}