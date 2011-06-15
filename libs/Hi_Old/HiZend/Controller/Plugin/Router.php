<?php
/**
 * Hi CMS
 *
 *
 * @category   TwsZend
 * @package    TwsZend_Controller
 * @copyright  Copyright (c) 2009 Piotr Maxymilian Socha
 * @license
 */

/** Zend_Controller_Plugin_Abstract */
//require_once 'Zend/Controller/Plugin/Abstract.php';

/**
 * @category   TwsZend
 * @package    TwsZend_Controller
 * @copyright  Copyright (c) 2009 Piotr Maxymilian Socha
 * @license
 */
class HiZend_Controller_Plugin_Router extends Zend_Controller_Plugin_Abstract
{
    /**
     *
     * @return void
     */
    public function routeStartup(Zend_Controller_Request_Abstract $request)
    {

    }


    /**
     *
     * @return void
     */
    public function routeShutdown(Zend_Controller_Request_Abstract $request)
    {
      //
//      $hash = $request->getControllerName();
//
//      //
//      $menus = new Default_Model_ServiceMenusStructure();
//      $params = new Default_Model_ServiceMenusStructureParams();
//      $registry = Zend_Registry::getInstance();
//
//      //
//      $route = $menus->getRouteData($hash);
//
//      //
//      if ($route) {
//        if ($route['sms_active']) {
//          $ok=false;
//          if ($route['sms_visible']) {
//            //
//            $ok = true;
//
//          } else {
//            //
//            $subRoute = $menus->getActiveSubRouteData($route['sms_tree_left'], $route['sms_tree_right']);
//
//            if ($subRoute) {
//              //
//              $frontController = Zend_Controller_Front::getInstance();
//              $response = $frontController->getResponse();
//              $response->setRedirect(BASE_PATH.$route['smst_hash']);
//              $response->sendResponse();
//            } else {
//              $ok = true;
//            }
//          }
//
//          if ($ok) {
//            $request->setModuleName( $route['sms_module'] );
//            $request->setControllerName( $route['sms_controller'] );
//            if (isset($route['sms_action']) && trim($route['sms_action'])!='') {
//              $request->setActionName( $route['sms_action'] );
//            }
//
//            //
//            $route['sms_params'] = $params->getParams($route['sms_id']);
//            $request->setParams($route['sms_params']);
//            $registry->set('route', $route);
//          }
//        }
//      }
    }
}