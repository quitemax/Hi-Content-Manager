<?php
/**
 * Hi CMS
 *
 * @category   HiZend
 * @package    HiZend_Controller
 * @copyright  Copyright (c) 2009 Piotr Maxymilian Socha
 * @license
 */

/** HiZend_Controller_Action */
//require_once 'HiZend/Controller/Action.php';

/**
 * Action controller.
 *
 * Simple table, list and add in one action
 *
 * @category   HiZend
 * @package    HiZend_Controller
 * @subpackage Hicms
 * @copyright  Copyright (c) 2009 Piotr Maxymilian Socha
 * @license
 */
class Hicms_LangsCacheController extends Hicms_Libs_Controller_Action
{
    /**#@+
     *  Url for main action
     */
    const URL_LIST = 'hicms/langs/list/';
    /**#@-*/

    /**#@+
     *  Url for main action
     */
    const URL_DELETE = 'hicms/langs/delete/';
    /**#@-*/

    /**#@+
     *  Url for main action
     */
    const PARAM_ID = 'id';
    /**#@-*/

    /**#@+
     *  Main model table name
     */
    const MODEL_TABLE_NAME = 'Hicms_Model_DbTable_Langs';
    /**#@-*/

    /**#@+
     * Model primary id
     */
    const MODEL_PRIMARY_ID = 'hl_id';
    /**#@-*/

    /**
     * Init
     *
     * Mainly init of parent class, etc...
     *
     */
    function init() {
        parent::init();
        $this->view->headTitle('Langs Cache');
    }

    /**
     * Cache dump action.
     *
     * Creates php cache file for langs in admin apps
     *
     */
    public function dumpAction()
    {
        $this->view->headTitle('Dump Langs To Cache File');

        /*@var $dbTable HiZend_Db_Table*/
        $modelString = self::MODEL_TABLE_NAME;
        $dbTable = new $modelString();

        $applications = array(
            'root',
            'admin',
        );

        //
        $langs = $dbTable->getCol(
            'hl_is_active = 1',
            'hl_position asc',
            null,
            null,
            array(
                'hl_lang',
            )
        );

        echo '<h3>Dump Langs To Cache File</h3> <br />';

        Zend_Debug::dump($langs, '$langs');

        foreach ($applications as $app) {

            $appCache = APPLICATION_CACHE_PATH;

            $appCache = str_replace('root', $app, $appCache);

            $writer = new Zend_Config_Writer_Array();
            $writer->write(
                $appCache . '/i18n/langs.php',
                new Zend_Config($langs)
            );

            echo 'Langs Cache written for application: ' . $app . '<br /><br />';
        }

        $this->_helper->viewRenderer->setNoRender();
    }
}