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
class HiZend_Controller_Plugin_Error404 extends Zend_Controller_Plugin_Abstract
{
  /**
   * Method checks if the current specified module/controller/action
   * is a valid one in the system. If not - changes the request object
   * so that it points to an error controller.
   *
   * @return void
   */
  public function preDispatch( Zend_Controller_Request_Abstract $request )
  {
    $frontController = Zend_Controller_Front::getInstance();
    $dispatcher = $frontController->getDispatcher();
    $moduleName = $request->getModuleName();
    $methodName = $request->getActionName();

    $classExists=false;
    $className = $dispatcher->getControllerClass($request);
    $finalClass = ($moduleName=='default')?$className:$dispatcher->formatClassName($moduleName, $className);
    $finalMethod = $dispatcher->formatActionName($methodName);
//    echo $finalClass;echo $className;
    if ($className ) {
      if (class_exists($finalClass, false)) {
        $classExists=true;
      }
      else {
        $dispatchDir = $dispatcher->getDispatchDirectory();
        $loadFile    = $dispatchDir . DIRECTORY_SEPARATOR . $dispatcher->classToFilename($className);
        $dir         = dirname($loadFile);
        $file        = basename($loadFile);
        try {
          $path = $dir.'/'.$className;
//          include($path.'.php');
          @Zend_Loader::loadClass($path);
        } catch (Zend_Exception $e) {
          //error: Cannot load controller class
        }
        if (!class_exists($finalClass, false)) {
          //error: Invalid controller class
        }
        else {
          $classExists=true;
        }
      }
    }
    else {
      //error: the dispatcher has no class defined (and it should by now)
    }
//    echo "<pre>";
//    print_r($classExists);
//    echo "</pre>";


    if ($classExists) {
      $class = new ReflectionClass($finalClass);

      if( $class->hasMethod( $finalMethod ) ) {
        return;
      }
    }
    $request->setModuleName( 'default' );
    $request->setControllerName( 'error' );
    $request->setActionName( 'page' );
    //$request->setDispatched( true );
  }
}