<?php
/**
 * Hi
 *
 * LICENSE
 *
 *
 * @category   Hi
 * @package    Hi\Application
 * @subpackage Resource
 * @copyright
 * @license
 */

/**
 * @namespace
 */
namespace Hi\Application\Resource;

use Zend\Application\Resource\View as ResourceView;


/**
 * Resource for settings view options
 *
 * @category   Hi
 * @package    Hi\Application
 * @subpackage Resource
 * @copyright  Copyright (c) 2005-2011 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class View extends ResourceView
{
//class Hi_Resource_View extends Zend_Application_Resource_ResourceAbstract
//{
//    protected $_options = array (
//        'encoding'          =>  'utf-8',
//        'doctype'           =>  'XHTML1_STRICT',
//        'escape'            =>  'htmlentities',
//        'skin'              =>  'default',
//    );
//
    public function  init()
    {
        $view = parent::init();
        
        \Zend\Debug::dump($view);
        
        return $view;
        
        
//        //
//        $options = $this->getOptions();
//
//        $bootstrap = $this->getBootstrap();
//        $bootstrap->bootstrap('layout');
//
//        /*@var layout Zend_Layout */
//        $layout = $bootstrap->getResource('layout');
//
//        /* @var $view Zend_View */
//        $view = $layout->getView();
//
//        $view->setEncoding($options['encoding']);
//        $view->doctype($options['doctype']);
//        $view->setEscape($options['escape']);
//
//        $view->headTitle()->setSeparator(' :: ');
//        $view->headMeta()->appendHttpEquiv('Content-Type', 'text/html; charset=UTF-8');
//
//        if (!isset($options['baseUrl'])) {
//            $bootstrap = $this->getBootstrap();
//            $bootstrap->bootstrap('frontController');
//
//            /* @var $frontController Zend_Controller_Front*/
//            $frontController = $bootstrap->getResource('frontController');
//
//            $view->assign('baseUrl', $frontController->getBaseUrl());
//        } else {
//            $view->assign('baseUrl', $options['baseUrl']);
//        }
//
//        if (isset($options['publicUrl'])) {
//            $view->assign('publicUrl', $options['publicUrl']);
//        }
//        if (isset($options['skinUrl'])) {
//            $view->assign('skinUrl', $options['skinUrl'] . '/' . $options['skin']);
//        }
//
////        $view->headLink()->appendStylesheet(PROJECT_PATH.PUBLIC_PATH.'/hicmsAdmin/css/layout.css', 'screen',  true);
////        $view->headScript()->appendFile('http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.js', 'text/javascript');
////        $view->headScript()->appendFile('localGlobalData.js', 'text/javascript');
//
//        Zend_Controller_Action_HelperBroker::getStaticHelper('ViewRenderer')
//            ->setViewScriptPathSpec(':module/:controller/:action.:suffix');
//
//
//
//        //
//        $view->setScriptPath(APPLICATION_PATH . '/views/default/scripts/');
//        $view->addBasePath(APPLICATION_PATH . '/views/' . $options['skin'] . '/');
//
//        //
//        return $view;
    }
}