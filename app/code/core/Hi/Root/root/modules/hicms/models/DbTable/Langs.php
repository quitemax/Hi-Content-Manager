<?php
class Hicms_Model_DbTable_Langs extends HiZend_Db_Table
{
    protected $_name   = 'hicms_langs';
    protected $_primary   = 'hl_id';

    protected $_prfx = 'hl';

    protected $_dependentTables = array(
        'Hicms_Model_DbTable_NavigationItemsTranslations',
        'Hicms_Model_DbTable_NavigationItemsElementsTranslations',
    );

    /**#@+
     * Form default partial decorator directory
     */
    const CACHE_DIR = '/i18n';
    /**#@-*/

    static protected $_langs = null;

    public function getLangs() {

        if (self::$_langs === null) {
            //
            $cacheFilePath = APPLICATION_CACHE_PATH . self::CACHE_DIR . '/langs.php';

            if (is_readable($cacheFilePath)) {
                //
                $langs = include_once $cacheFilePath;

                //
                self::$_langs = $langs;

            } else {

                //
                $langs = $this->getCol(
                    'hl_is_active = 1',
                    'hl_position asc',
                    null,
                    null,
                    array(
                        'hl_lang',
                    )
                );

                //
                self::$_langs = $langs;
            }
        }

        return self::$_langs;
    }

}