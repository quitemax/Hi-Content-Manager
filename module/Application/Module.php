<?php
namespace Application;

use Zend\ModuleManager\ModuleManager;

class Module
{
    public function onBootstrap($e)
    {
        // Register a dispatch event
        $app = $e->getParam('application');
        $app->events()->attach('dispatch', array($this, 'setLayoutVars'), -100);
    }

    public function setLayoutVars($e)
    {
        $matches    = $e->getRouteMatch();
        $controller = $matches->getParam('controller');

        // Set the layout template
        $viewModel = $e->getViewModel();
        $viewModel->setVariable('controller', $controller);
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

}
