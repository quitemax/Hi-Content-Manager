<?php

namespace Application;

use Zend\ModuleManager\ModuleManager;
//    Zend\EventManager\StaticEventManager,
//    Zend\Module\Consumer\AutoloaderProvider;

class Module //implements AutoloaderProvider
{
//    public function init(ModuleManager $moduleManager)
//    {
//
//        $events       = $moduleManager->events();
//        $sharedEvents = $events->getSharedManager();
//
//
//        $sharedEvents->attach('bootstrap', 'bootstrap', array($this, 'initializeDispatchListener'), 100);
//    }
//
//    public function initializeDispatchListener($e)
//    {
//        // Register a dispatch event
//        $app = $e->getParam('application');
//        $app->events()->attach('dispatch', array($this, 'setLayoutVars'), -100);
//    }
//
//    public function setLayoutVars($e)
//    {
//        $matches    = $e->getRouteMatch();
//        $controller = $matches->getParam('controller');
//
//        // Set the layout template
//        $viewModel = $e->getViewModel();
//        $viewModel->setVariable('controller', $controller);
//    }




//    public function initializeView($e)
//    {
//        $app          = $e->getParam('application');
//        $basePath     = $app->getRequest()->getBasePath();
//        $locator      = $app->getLocator();
//        $renderer     = $locator->get('Zend\View\Renderer\PhpRenderer');
//        $renderer->plugin('basePath')->setBasePath($basePath);
//        $renderer->headScript()->appendFile('http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.js', 'text/javascript');
//        $renderer->headScript()->appendFile('https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/jquery-ui.js', 'text/javascript');
//        $renderer->headLink()->appendStylesheet('http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/themes/base/jquery-ui.css', 'screen');
//
//    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\ClassMapAutoloader' => array(
                __DIR__ . '/autoload_classmap.php',
            ),
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }



}
