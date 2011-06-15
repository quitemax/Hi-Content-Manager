<?php
/**
 * Hi CMS
 *
 *
 * @category   HiZend
 * @package    HiZend_Controller
 * @copyright  Copyright (c) 2009 Piotr Maxymilian Socha
 * @license
 */

/** Zend_Controller_Action */
require_once 'Zend/Controller/Action.php';

/**
 * @category   HiZend
 * @package    HiZend_Controller
 * @copyright  Copyright (c) 2009 Piotr Maxymilian Socha
 * @license
 */
class HiZend_Controller_Action extends Zend_Controller_Action
{
    /**
    * User role in the system (taken from identity)
    * @var string
    */
    protected $_role = 'guest';

    /**
    * if user is a super user
    * @var bool
    */
    protected $_superUser = false;

    /**
    * User Identity if logged
    * @var array
    */
    protected $_identity = null;

    /**
    * Application base path
    * @var string
    */
    protected $_baseUrl;

    /**
    * Application base path
    * @var string
    */
    protected $_publicUrl;
    
    /**
    * Application skin path
    * @var string
    */
    protected $_skinUrl;

    /**
    * Zend_Auth object
    * @var Zend_Auth
    */
    protected $_auth;

    /**
     * lang
     * @var string
     */
    protected $_lang;

    /**
     * lang
     * @var string
     */
    public $layout;

    /**
    * Init routine.
    *
    * Initialize Controller with everything that is needed. Every descendant
    * has to call this method in their init().
    * @return void
    */
	function init()
	{
		//
        parent::init();

        $this->_baseUrl = $this->view->baseUrl;
        $this->_publicUrl = $this->view->publicUrl;
        $this->_skinUrl = $this->view->skinUrl;

        //
//	    $lang = new Zend_Session_Namespace('lang');
//        $this->_lang = $lang->lang;
//        $this->view->lang = $lang->lang;
//
//
//
//	    //auth
//        $this->_auth = Zend_Auth::getInstance();
//
//		//identity & role
//	   if ($this->_auth->hasIdentity()) {
//            $this->_identity = $this->_auth->getIdentity();
//            if (isset($this->_identity['role'])) {
//                $this->_role = $this->_identity['role'];
//            }
//            if (isset($this->_identity['superUser'])) {
//                $this->_superUser = $this->_identity['superUser'];
//            }
//
//        }
//
//        $this->view->identity = $this->_identity;
//        $this->view->role = $this->_role;
//        $this->view->superUser = $this->_superUser;

	}

	/**
     * Pre-dispatch routines
     *
     * Called before action method. If using class with
     * {@link Zend_Controller_Front}, it may modify the
     * {@link $_request Request object} and reset its dispatched flag in order
     * to skip processing the current action.
     *
     * @return void
     */
    public function preDispatch()
    {
    }

    /**
     * Post-dispatch routines
     *
     * Gets all the data and puts it in the view object for rendering
     *
     *
     * Common usages for postDispatch() include rendering content in a sitewide
     * template, link url correction, setting headers, etc.
     *
     * @return void
     */
  	public function postDispatch()
    {

    }
}
