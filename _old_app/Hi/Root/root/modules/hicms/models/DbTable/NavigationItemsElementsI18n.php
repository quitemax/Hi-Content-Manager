<?php
class Hicms_Model_DbTable_NavigationItemsElementsI18n extends HiZend_Db_Table
{
    protected $_name   = 'hicms_navigation_items_elements_i18n';

    protected $_prfx   = 'hniei18n';

    protected $_referenceMap    = array(
        'Translations' => array(
            'columns'           => array('hniei18n_hnie_id'),
            'refTableClass'     => 'Hicms_Model_DbTable_NavigationItemsElements',
            'refColumns'        => array('hnie_id'),
        ),
    );
}