<?php
class Hicms_Model_DbTable_NavigationItemsElements extends HiZend_Db_Table
{
    protected $_name   = 'hicms_navigation_items_elements';
    protected $_primary   = 'hnie_id';

    protected $_prfx = 'hnie';

    protected $_dependentTables = array(
        'Hicms_Model_DbTable_NavigationItemsElementsTranslations',
    );

    protected $_behaviours = array(
        'i18n' => array(
            'dbTable'       => array (
                'name'  => array(
                    'hniei18n'   =>  'hicms_navigation_items_elements_i18n',
                ),
                'class'                 =>  'Hicms_Model_DbTable_NavigationItemsElementsI18n',
                'primaryKey'            =>  'hniei18n_id',
                'langField'             =>  'hniei18n_lang',
                'foreignKey'            =>  'hniei18n_hnie_id',
                'basePrimaryKey'        =>  'hnie_id',
                'translationActive'     =>  'hniei18n_translation_is_active',
                'infoPlacement'         =>  HiZend_Db_Behaviour_I18n::INFO_PLACEMENT_APPEND,
            ),
            'connection'    =>  'hniei18n.hniei18n_hnie_id = hnie.hnie_id',
            'fields'        =>  array(
                'hnie_translation_is_active' => 'hniei18n_translation_is_active',
                'hnie_title'                 => 'hniei18n_title',
                'hnie_description'           => 'hniei18n_description',
            ),
        ),
        'nestedSet' => array(
            'basePrimaryKey'    => 'hnie_id',
            'left'              => 'hnie_tree_left',
            'right'             => 'hnie_tree_right',
            'level'             => 'hnie_tree_level',
            'order'             => 'hnie_tree_position',
            'parentId'          => 'hnie_tree_parent_id',
            'rootId'            => 'hnie_tree_root_id',
            'title'             => 'hnie_title',
            'path'              => 'hnie_tree_path',
        ),
    );
}