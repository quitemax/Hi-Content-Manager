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
 * Simple table: list action ,add action, delete action, edit action
 *
 * @category   HiZend
 * @package    HiZend_Controller
 * @subpackage Hicms
 * @copyright  Copyright (c) 2009 Piotr Maxymilian Socha
 * @license
 */
class Hicms_TranslationsCacheController extends Kicms_Libs_Controller_Action
{
    /**#@+
     *  Main model table name
     */
    const LANGS_TABLE_NAME = 'Hicms_Model_DbTable_Langs';
    /**#@-*/

    /**#@+
     *  Main model table name
     */
    const MODEL_TABLE_NAME = 'Hicms_Model_DbTable_TranslationsItems';
    /**#@-*/

    /**#@+
     * Model primary id
     */
    const MODEL_PRIMARY_ID = 'hti_id';
    /**#@-*/

    static protected $_arrayTextFilter;

    /**
     * Init
     *
     * Mainly init of parent class, etc...
     *
     */
    function init() {
        parent::init();
        $this->view->headTitle('Hicms');
        $this->view->headTitle('Translations Cache');
    }

    /**
     * Dump translations to cache
     *
     */
    public function dumpAction()
    {
        /**
         *
         */
        $this->view->headTitle('Dump Translations To Cache File');

        /**
         *
         */
        /*@var $langsDbTable HiZend_Db_Table*/
        $langsClassString = self::LANGS_TABLE_NAME;
        $langsDbTable = new $langsClassString();

        /*@var $dbTable HiZend_Db_Table*/
        $classString = self::MODEL_TABLE_NAME;
        $dbTable = new $classString();

        /**
         *
         */
        $applications = array(
            'root',
            'admin',
        );

        /**
         *
         */
        $langs = $langsDbTable->getLangs();
//        Zend_Debug::dump($langs);

        $translations = $dbTable->getAll();
//        Zend_Debug::dump($translations);

        echo '<h3>Dump Translations To Cache File</h3> <br />';

        /**
         *
         */
        $translationsFileArray = array();
        foreach ($translations as $translation) {
            foreach ($langs as $lang) {
//                Zend_Debug::dump($translation);
                if ($translation['hti_translation_is_active'][$lang]) {
                    $translationsFileArray[$lang][$translation['hti_key']] = $translation['hti_value'][$lang];
                }
            }
        }


        /**
         *
         */
        foreach ($applications as $app) {

            $appCache = APPLICATION_CACHE_PATH;

            $appCache = str_replace('root', $app, $appCache);

            foreach ($translationsFileArray as $lang => $file) {



                $writer = new Zend_Config_Writer_Array();
                $writer->write(
                    $appCache . '/i18n/i18n.' . $lang . '.php',
                    new Zend_Config($file)
                );
            }

            echo 'Langs Cache written for application: ' . $app . '<br /><br />';
        }

        Zend_Debug::dump($translationsFileArray, 'translations');

        $this->_helper->viewRenderer->setNoRender();
    }

    /**
     * View translations cache file
     *
     */
    function viewAction()
    {
        /**
         *
         */
        $this->view->headTitle('Cache View');

        /**
         *
         */
        /*@var $langsDbTable HiZend_Db_Table*/
        $langsClassString = self::LANGS_TABLE_NAME;
        $langsDbTable = new $langsClassString();

        /*@var $dbTable HiZend_Db_Table*/
        $classString = self::MODEL_TABLE_NAME;
        $dbTable = new $classString();


        /**
         * Record Form
         */
        $form = new Hi_Record_Form(
            array(
                'title'     =>  $this->view->translate('hicmsTranslatePanel'),
                'name'      => 'translationsCacheForm',
                'method'    => 'post',
            )
        );

        /**
         * Building list
         */
        /*@var $navigationList Hi_Record_List*/
        $list = new Hi_Record_SubForm_List(
            array(
                'title'     => $this->view->translate('translationsCacheItemsList'),
                'name'      => 'translationsCacheList',
                'langs'     => $langsDbTable->getLangs(),
                'view'      => $this->view,
            )
        );

        $list->processRequest($this->_request);

        $currentLang = $list->getLang();

        $cacheFilePath = APPLICATION_CACHE_PATH . '/i18n/i18n.' . $currentLang . '.php';

        if (is_readable($cacheFilePath)){

            $list->addField(
                'translationKey',
                'text',
                array(
                    'sortable'  => true,
                    'label'     =>  $this->view->translate('translationKey'),
                )
            );
            $list->addField(
                'translationValue',
                'text',
                array(
                    'sortable'  => true,
                    'label'     =>  $this->view->translate('translationValue'),
                )
            );
//            $list->setActiveRowCheckbox();

            $list->addFilterField(
                'translationKey',
                'input',
                array(
                    'label'     =>  $this->view->translate('translationKey'),
                )
            );

            $list->addFilterField(
                'translationValue',
                'input',
                array(
                    'label'     =>  $this->view->translate('translationValue'),
                )
            );





            $list->setPrimaryKey('translationKey');

            //
            $tmpLangTranslations = include $cacheFilePath;

//            Zend_Debug::dump($tmpLangTranslations);

            $langTranslations = array();
            foreach ($tmpLangTranslations as $transKey => $transValue) {
                $tmpTranslation['translationKey'] = $transKey;
                $tmpTranslation['translationValue'] = $transValue;
                $langTranslations[] = $tmpTranslation;
            }

//            Zend_Debug::dump($langTranslations);

//            Zend_Debug::dump($list->getFilter());

            if ($list->getFilter() && $langTranslations) {
                $filter = $list->getFilter();
                if ($filter && is_array($filter)) {
                    foreach ($filter as $name => $value) {
                        if ($value !== '') {

                            self::$_arrayTextFilter = array(
                                $name  =>  $value,
                            );
                            $langTranslations = array_filter(
                                $langTranslations,
                                'Hicms_TranslationsCacheController::arrayTextFilter'
                            );
                        }
                    }
                }
            }

            //sorting
            if ($list->getSortField() && $langTranslations) {
                foreach ($langTranslations as $trans) {
                    $key[] = $trans[$list->getSortField()];
                }
                array_multisort(
                    $key,
                    $list->getSortDirection()=='asc'? SORT_ASC : SORT_DESC,
                    $langTranslations
                );
            }



//            Zend_Debug::dump($langTranslations);
            $list->setData(
                array_slice(
                    $langTranslations,
                    $list->getPerPage() * ( $list->getPage() - 1 ),
                    $list->getPerPage(),
                    false
                )
            );
            $list->setAllElementsCount(count($langTranslations));

            //
            $list->build();


            $form->addSubForm($list, $list->getName());

            $this->view->list = $form;
        } else {
            $this->view->list = "Cache file does not exist!";
        }
    }

    static public function arrayTextFilter($variable) {

        //
        $filter = self::$_arrayTextFilter;

        //
        $return = false;

        //
        foreach ($filter as $field => $value) {
            if (strpos($variable[$field], $value)!==false) {
                $return = true;
                break;
            }
        }

        return $return;
    }
}
