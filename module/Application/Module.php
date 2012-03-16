<?php

namespace Application;

use Zend\Module\Manager,
    Zend\EventManager\StaticEventManager,
    Zend\Module\Consumer\AutoloaderProvider;

class Module implements AutoloaderProvider
{
    public function init(Manager $moduleManager)
    {
        $events = StaticEventManager::getInstance();
        $events->attach('bootstrap', 'bootstrap', array($this, 'initializeView'), 100);

//        $events->attach('bootstrap', 'bootstrap', array($this, 'initializeDispatchListener'), 100);
    }

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

    public function initializeView($e)
    {
        $app          = $e->getParam('application');
        $basePath     = $app->getRequest()->getBasePath();
        $locator      = $app->getLocator();
        $renderer     = $locator->get('Zend\View\Renderer\PhpRenderer');
        $renderer->plugin('basePath')->setBasePath($basePath);
    }

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
}
