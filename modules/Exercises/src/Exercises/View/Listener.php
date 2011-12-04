<?php

namespace Exercises\View;

use ArrayAccess,
    Zend\Di\Locator,
    Zend\EventManager\EventCollection,
    Zend\EventManager\ListenerAggregate,
    Zend\EventManager\StaticEventCollection,
    Zend\Http\Response,
    Zend\Mvc\Application,
    Zend\Mvc\MvcEvent,
    Zend\View\Renderer;

class Listener implements ListenerAggregate
{
    protected $config;
    protected $listeners = array();
    protected $staticListeners = array();
    protected $view;
    protected $displayExceptions = false;

    public function __construct(Renderer $renderer, $config)
    {
        $this->view   = $renderer;
        $this->config = $config;
    }

    public function setDisplayExceptionsFlag($flag)
    {
        $this->displayExceptions = (bool) $flag;
        return $this;
    }

    public function displayExceptions()
    {
        return $this->displayExceptions;
    }

    public function attach(EventCollection $events)
    {
//        echo 'attach';
//        echo get_class($events);
//        $this->listeners[] = $events->attach('dispatch', array($this, 'renderLayout'), -1000);
//        $this->listeners[] = $events->attach('dispatch', array($this, 'render404'), -80);
//        $this->listeners[] = $events->attach('dispatch.error', array($this, 'renderError'));

//        $this->listeners[] = $events->attach('dispatch', array($this, 'render404'), -80);
//
    }

    public function detach(EventCollection $events)
    {
//        echo 'detach';
//        foreach ($this->listeners as $key => $listener) {
//            $events->detach($listener);
//            unset($this->listeners[$key]);
//            unset($listener);
//        }
    }

    public function registerStaticListeners(StaticEventCollection $events, $locator)
    {
//        echo 'registerStaticListeners';
//        $ident   = 'Core\Controller\PageController';
//        $handler = $events->attach($ident, 'dispatch', array($this, 'renderPageController'), -50);
//        $this->staticListeners[] = array($ident, $handler);

//        $ident   = 'Zend\Mvc\Controller\ActionController';
//        $handler = $events->attach($ident, 'dispatch', array($this, 'renderView'), -50);
//        $this->staticListeners[] = array($ident, $handler);
    }

    public function detachStaticListeners(StaticEventCollection $events)
    {
//        echo 'detachStaticListeners';
//        foreach ($this->staticListeners as $i => $info) {
//            list($id, $handler) = $info;
//            $events->detach($id, $handler);
//            unset($this->staticListeners[$i]);
//        }
    }
}
