<?php
class Hicms_Model_DbTable_NavigationItemsI18n extends HiZend_Db_Table
{
    protected $_name   = 'hicms_navigation_items_i18n';

    protected $_prfx   = 'hnii18n';

    protected $_primary   = 'hnii18n_id';

    protected $_referenceMap    = array(
        'Translations' => array(
            'columns'           => array('hnii18n_hni_id'),
            'refTableClass'     => 'Hicms_Model_DbTable_NavigationItems',
            'refColumns'        => array('hni_id'),
        ),
    );
}