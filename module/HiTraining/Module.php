<?php

namespace HiTraining;

use Zend\Module\Consumer\AutoloaderProvider,
    Zend\Module\Manager,
    Zend\EventManager\StaticEventManager,
    Zend\EventManager\Event;

class Module implements AutoloaderProvider
{
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

    public function init(Manager $moduleManager)
    {
        $events = StaticEventManager::getInstance();
        $events->attach('bootstrap', 'bootstrap',
            array($this, 'onBootstrap'));
    }

    public function onBootstrap(Event $e)
    {
        $application  = $e->getParam('application');
        /* @var $application \Zend\Mvc\Application */
        $locator      = $application->getLocator();
        $view         = $locator->get('Zend\View\View');
        $jsonStrategy = $locator->get('Zend\View\Strategy\JsonStrategy');
        $view->events()->attach($jsonStrategy, 100);

    }
}
