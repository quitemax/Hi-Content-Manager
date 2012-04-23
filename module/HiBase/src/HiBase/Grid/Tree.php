<?php
/**
 * Hi CMS
 *
 * @category   Hi
 * @package    Hi_Grid
 * @copyright  Copyright (c) 2012 Piotr Maxymilian Socha
 * @license
 */
namespace HiBase\Grid;

//use Zend\Form\SubForm as ZendSubForm;

/**
 * Hi_Grid_Tree
 *
 * @category   Hi
 * @package    Hi_Grid
 * @copyright  Copyright (c) 2012 Piotr Maxymilian Socha
 * @license
 * @version    2.0
 */

class Tree
{
    /**#@+
     * Row id template
     */
    const DEFAULT_ID = 'treeUnsetId';
    /**#@-*/

    /**#@+
     * Rows default partial decorator directory
     */
    const DEFAULT_PARTIALS_DIR = '_grid/_tree/';
    /**#@-*/

    /**
     * Partial decorator directory
     *
     * @var string
     */
    protected $_partialsDir = self::DEFAULT_PARTIALS_DIR;

    /**
     *
     *
     * @var string
     */
    protected $_name;

    /**
     * Title
     *
     * @var string
     */
    protected $_title = '';
//
//    /**
//     * Langs in use
//     *
//     * @var array
//     */
//    protected $_langs = array();
//
//    /**
//     * Current lang
//     *
//     * @var string
//     */
//    protected $_lang = '';

    /**
     *
     *
     * @var string
     */
    protected $_selectedElement = 0;

    /**
     *
     *
     * @var array
     */
    protected $_treeElements = array();

    /**
     *
     *
     * @var array
     */
    protected $_treeGlobalLink = array();

    /**
     *
     *
     * @var array
     */
    protected $_treeCookiePath = '';

    /**
     *
     *
     * @var array
     */
    protected $_visiblePosition = false;

    /**
     *
     *
     * @var
     */
    protected $_view;



    /**
     * Creates an instance of Hi_Record_Item
     *
     * @param $view Zend_View
     * @param $title string
     *
     * @return null
     */
    public function __construct( $options = null ) {
//
        //
        if (isset($options['title'])) {
            $this->_title = $options['title'];
            unset($options['title']);
        }

        //
        if (!isset($options['name'])) {
            $this->_name = self::DEFAULT_ID . md5(microtime());
        } else {
            $this->_name = $options['name'];
        }

        //
        if (isset($options['langs']) && is_array($options['langs']) && count($options['langs'])) {
            $this->_langs = $options['langs'];
            unset($options['langs']);
        }

        //
        if (isset($options['view']))/* && $options['view'] instanceof Zend_View_Interface)*/ {
            $this->setView($options['view']);
            unset($options['view']);
        }
    }

    /**
     * Set view object
     *
     * @param   $view
     * @return
     */
    public function setView($view = null)
    {
        $this->_view = $view;
        return $this;
    }

    /**
     * Retrieve view object
     *
     * If none registered, attempts to pull from ViewRenderer.
     *
     * @return |null
     */
    public function getView()
    {
        if (null === $this->_view) {
//            $viewRenderer = Zend_Controller_Action_HelperBroker::getStaticHelper('viewRenderer');
//            $this->setView($viewRenderer->view);
        }

        return $this->_view;
    }


    /**
     *
     *
     * @param $filter array|string
     *
     * @return $this
     */
    public function setGlobalLink($globalLink = null) {
        if (is_string($globalLink)) {
            $this->_treeGlobalLink = $globalLink;
        }
        return $this;
    }

    /**
     *
     *
     * @param $filter array|string
     *
     * @return $this
     */
    public function setCookiePath($cookiePath = null) {
        if (is_string($cookiePath)) {
            $this->_treeCookiePath = $cookiePath;
        }
        return $this;
    }

    /**
     *
     *
     * @param $filter array|string
     *
     * @return $this
     */
    public function setSelectedId($id = null) {
        if ((int)$id) {
            $this->_selectedElement = $id;
        }
        return $this;
    }

    /**
     *
     *
     * @param $filter array|string
     *
     * @return $this
     */
    public function setPositionVisible($bool = null) {
        if ((bool)$bool) {
            $this->_visiblePosition = (bool)$bool;
        }
        return $this;
    }

//    /**
//     *
//     *
//     * @param $filter array|string
//     *
//     * @return $this
//     */
//    public function addData($data = null) {
//        if (is_array($data) && count($data)) {
//            foreach ($data as $element) {
//                $this->_treeElements = $data;
//            }
//        }
//        return $this;
//    }
//
//    /**
//     *
//     *
//     * @param $filter array|string
//     *
//     * @return $this
//     */
//    public function setData($data = null) {
//        if (is_array($data) && count($data)) {
//            $this->_treeElements = $data;
//        }
//        return $this;
//    }
//
//    /**
//     * Fetches rendered Record List (implementation of abstract parent method)
//     *
//     * @return string Fetched list.
//     */
//    public function render()
//    {
//        return $this->build();
//    }


    /**
     * Builds
     *
     * @return mixed Zend_Form | Zend_Form_SubForm
     */
    public function build()
    {
        $this->_view->headScript()->appendFile(
            $this->_view->basePath() . '/js/jsTree/jquery.jstree.js'
        );
        $this->_view->headScript()->appendFile(
            $this->_view->basePath() . '/js/jsTree/_lib/jquery.cookie.new.js'
        );


//        $this->_view->treeCookiePath = BASE_PATH .
//
        $treeData = array();
        $treeData['title']              = $this->_title;
        $treeData['elements']           = $this->_treeElements;
        $treeData['selectedElement']    = $this->_selectedElement;
        $treeData['globalLink']         = $this->_treeGlobalLink;
        $treeData['visiblePosition']    = $this->_visiblePosition;
        $treeData['cookiePath']         = $this->_treeCookiePath;


        $this->_view->treeData = $treeData;

        $tmp = $this->_view->render(
            $this->_partialsDir . '_tree_main.phtml'
        );
        $this->_view->headScript()->appendScript(
            $this->_view->render(
                $this->_partialsDir . '_tree_main.js'
            )
        );

        return $tmp;
    }
}