<?php
class Hicms_Model_DbTable_TranslationsItemsI18n extends HiZend_Db_Table
{
    protected $_name   = 'hicms_translations_items_i18n';

    protected $_primary   = 'htii18n_id';

    protected $_prfx = 'htii18n';


    protected $_referenceMap    = array(
        'Translations' => array(
            'columns'           => array('htii18n_hti_id'),
            'refTableClass'     => 'Hicms_Model_DbTable_TranslationsItems',
            'refColumns'        => array('hti_id'),
        ),
    );

}