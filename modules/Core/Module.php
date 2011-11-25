<?php

namespace Core;

use Zend\Module\Manager,
    InvalidArgumentException,
    Zend\Config\Config,
    Zend\Di\Locator,
    Zend\Dojo\View\HelperLoader as DojoLoader,
    Zend\EventManager\EventCollection,
    Zend\EventManager\StaticEventCollection,
    Zend\EventManager\StaticEventManager,
    Zend\Module\Consumer\AutoloaderProvider;

class Module implements AutoloaderProvider
{
    protected $view;
    protected $viewListener;

    public function init(Manager $moduleManager)
    {
        $events = StaticEventManager::getInstance();
//        $events->attach('bootstrap', 'bootstrap', array($this, 'initializeView'));
        $events->attach('bootstrap', 'bootstrap', array($this, 'initView'));
        $events->attach('bootstrap', 'bootstrap', array($this, 'registerApplicationListeners'), -10);
        $events->attach('bootstrap', 'bootstrap', array($this, 'registerStaticListeners'), -10);
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

    public function getConfig($env = null)
    {
//        echo "<pre>" . '"$env" ';
//        print_r($env);
//        echo "</pre>";
        $config = include __DIR__ . '/configs/module.config.php';
        if (null === $env) {
            return $config;
        }

        if (!isset($config[$env])) {
            throw new InvalidArgumentException(sprintf(
                'Unrecognized environment "%s" provided to %s',
                $env,
                __METHOD__
            ));
        }

        return $config[$env];
    }

//    public function initializeView($e)
//    {
//        $app          = $e->getParam('application');
//        $locator      = $app->getLocator();
//        $config       = $e->getParam('config');
//        $view         = $this->getView($app);
//        $viewListener = $this->getViewListener($view, $config);
//        $app->events()->attachAggregate($viewListener);
//        $events       = StaticEventManager::getInstance();
//        $viewListener->registerStaticListeners($events, $locator);
//    }
//
//    protected function getViewListener($view, $config)
//    {
//        if ($this->viewListener instanceof View\Listener) {
//            return $this->viewListener;
//        }
//
//        $viewListener       = new View\Listener($view, $config);
//        $viewListener->setDisplayExceptionsFlag($config->display_exceptions);
//
//        $this->viewListener = $viewListener;
//        return $viewListener;
//    }
//
//    protected function getView($app)
//    {
//        if ($this->view) {
//            return $this->view;
//        }
//
//        $di     = $app->getLocator();
//        $view   = $di->get('view');
//        $url    = $view->plugin('url');
//        $url->setRouter($app->getRouter());
//
//        $view->plugin('headTitle')->setSeparator(' - ')
//                                  ->setAutoEscape(false)
//                                  ->append('Core ');
//        $this->view = $view;
//        return $view;
//    }


    public function initView($e)
    {
        $app     = $e->getParam('application');
        $config  = $e->getParam('config');
        $locator = $app->getLocator();
        $router  = $app->getRouter();
        $view    = $locator->get('view');
        $url     = $view->plugin('url');
        $url->setRouter($router);

        if ($config->disqus) {
            // Ensure disqus plugin is configured
            $disqus = $view->plugin('disqus', $config->disqus->toArray());
        }

        $persistent = $view->placeholder('layout');
        foreach ($config->view as $var => $value) {
            if ($value instanceof Config) {
                $value = new Config($value->toArray(), true);
            }
            $persistent->{$var} = $value;
        }

        $view->doctype('HTML5');
        $view->getBroker()->getClassLoader()->registerPlugins(new DojoLoader());
        $view->headTitle()->setSeparator(' :: ')
                          ->setAutoEscape(false)
                          ->append('core');
        $view->headLink(array(
            'rel'  => 'shortcut icon',
            'type' => 'image/vnd.microsoft.icon',
            'href' => '/images/Application/favicon.ico',
        ));
        $dojo = $view->plugin('dojo');
        $dojo->setCdnVersion('1.6')
             ->setDjConfig(array(
                 'isDebug'     => true,
                 'parseOnLoad' => true,
             ));
        $this->view = $view;
    }

    public function registerApplicationListeners($e)
    {
        $app          = $e->getParam('application');
        $config       = $e->getParam('config');
        $viewListener = $this->getViewListener($this->view, $config);
        $app->events()->attachAggregate($viewListener);
    }

    public function registerStaticListeners($e)
    {
        $locator      = $e->getParam('application')->getLocator();
        $config       = $e->getParam('config');
        $events       = StaticEventManager::getInstance();
        $viewListener = $this->getViewListener($this->view, $config);
        $viewListener->registerStaticListeners($events, $locator);
    }

    protected function getViewListener($view, $config)
    {
        if ($this->viewListener instanceof View\Listener) {
            return $this->viewListener;
        }

        $viewListener       = new View\Listener($view, $config);
        $viewListener->setDisplayExceptionsFlag($config->display_exceptions);

        $this->viewListener = $viewListener;
        return $viewListener;
    }
}
