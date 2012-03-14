<?php
class Hicms_Model_DbTable_TranslationsItems extends HiZend_Db_Table
{
    protected $_name   = 'hicms_translations_items';
    protected $_primary   = 'hti_id';

    protected $_prfx = 'hti';

    protected $_dependentTables = array(
        'Hicms_Model_DbTable_TranslationsItemsI18n',
    );

    protected $_behaviours = array(
        'i18n' => array(
            'dbTable'       => array (
                'name'  => array(
                    'htii18n'   =>  'hicms_translations_items_i18n',
                ),
                'class'                 =>  'Hicms_Model_DbTable_TranslationsItemsI18n',
                'primaryKey'            =>  'htii18n_id',
                'langField'             =>  'htii18n_lang',
                'foreignKey'            =>  'htii18n_hti_id',
                'basePrimaryKey'        =>  'hti_id',
                'translationActive'     =>  'htii18n_translation_is_active',
                'infoPlacement'         =>  HiZend_Db_Behaviour_I18n::INFO_PLACEMENT_APPEND,
            ),
            'connection'    =>  'htii18n.htii18n_hti_id = hti.hti_id',
            'fields'        =>  array(
                'hti_value'                 => 'htii18n_value',
                'hti_translation_is_active' => 'htii18n_translation_is_active',
            ),
        ),
    );
}