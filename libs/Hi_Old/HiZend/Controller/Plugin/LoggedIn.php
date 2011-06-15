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

/** Zend_Controller_Plugin_Abstract */
//require_once 'Zend/Controller/Plugin/Abstract.php';

/**
 * @category   HiZend
 * @package    HiZend_Controller
 * @copyright  Copyright (c) 2009 Piotr Maxymilian Socha
 * @license
 */
class HiZend_Controller_Plugin_LoggedIn extends Zend_Controller_Plugin_Abstract
{
    protected $_module = 'user';
    protected $_controller = 'log';
    protected $_action = 'in';

    /**
     * Constructor
     *
     * Options may include:
     *
     * @param  Array $options
     * @return void
     */
    public function __construct(Array $options = array())
    {
        $this->setLoginAction($options);
    }

    /**
     * setErrorHandler() - setup the error handling options
     *
     * @param  array $options
     * @return Zend_Controller_Plugin_ErrorHandler
     */
    public function setLoginAction(Array $options = array())
    {
        if (isset($options['module'])) {
            $this->_module = (string) $options['module'];
        }
        if (isset($options['controller'])) {
            $this->_controller = (string) $options['controller'];
        }
        if (isset($options['action'])) {
            $this->_action = (string) $options['action'];
        }
        return $this;
    }


    /**
     *
     * @return void
     */
    public function preDispatch( Zend_Controller_Request_Abstract $request )
    {
        $auth = HiZend_Auth::getInstance();
        //
        if (!$auth->hasIdentity()) {
            $request->setModuleName( $this->_module );
            $request->setControllerName( $this->_controller );
            $request->setActionName( $this->_action );
        }
    }
}