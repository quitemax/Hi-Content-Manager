<?php

namespace HiBase\View\Strategy;

use Zend\EventManager\EventManagerInterface;
use Zend\EventManager\ListenerAggregateInterface;
use Zend\Http\Request as HttpRequest;
use Zend\Http\Response as HttpResponse;
use Zend\View\Model;
use HiBase\View\Renderer\BlockRenderer;
use Zend\View\ViewEvent;
use HiBase\View\Block\Block;

/**
 * @category   Zend
 * @package    Zend_View
 * @subpackage Strategy
 * @copyright  Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class BlockStrategy implements ListenerAggregateInterface
{
    /**
     * @var \Zend\Stdlib\CallbackHandler[]
     */
    protected $listeners = array();

    /**
     * @var BlockRenderer
     */
    protected $renderer;

    /**
     * Constructor
     *
     * @param  JsonRenderer $renderer
     * @return void
     */
    public function __construct(BlockRenderer $renderer)
    {
        $this->renderer = $renderer;
    }

    /**
     * Attach the aggregate to the specified event manager
     *
     * @param  EventManagerInterface $events
     * @param  int $priority
     * @return void
     */
    public function attach(EventManagerInterface $events, $priority = 1)
    {
        $this->listeners[] = $events->attach(ViewEvent::EVENT_RENDERER, array($this, 'selectRenderer'), $priority);
//        $this->listeners[] = $events->attach(ViewEvent::EVENT_RESPONSE, array($this, 'injectResponse'), $priority);
    }

    /**
     * Detach aggregate listeners from the specified event manager
     *
     * @param  EventManagerInterface $events
     * @return void
     */
    public function detach(EventManagerInterface $events)
    {
        foreach ($this->listeners as $index => $listener) {
            if ($events->detach($listener)) {
                unset($this->listeners[$index]);
            }
        }
    }

    /**
     * Detect if we should use the JsonRenderer based on model type and/or
     * Accept header
     *
     * @param  ViewEvent $e
     * @return null|JsonRenderer
     */
    public function selectRenderer(ViewEvent $e)
    {
        $model = $e->getModel();

//        \Zend\Debug::dump('selectRenderer(ViewEvent $e)');
//        return;
//
        if ($model instanceof Block) {
            // JsonModel found
            return $this->renderer;
        }
//
//        $request = $e->getRequest();
//        if (!$request instanceof HttpRequest) {
//            // Not an HTTP request; cannot autodetermine
//            return;
//        }
//
//        $headers = $request->headers();
//        if ($headers->has('accept')) {
//            $accept  = $headers->get('Accept');
//            foreach ($accept->getPrioritized() as $mediaType) {
//                if (0 === strpos($mediaType, 'application/json')) {
//                    // application/json Accept header found
//                    return $this->renderer;
//                }
//            }
//        }
//
        // Not matched!
        return;
    }

//    /**
//     * Inject the response with the JSON payload and appropriate Content-Type header
//     *
//     * @param  ViewEvent $e
//     * @return void
//     */
//    public function injectResponse(ViewEvent $e)
//    {
//        $renderer = $e->getRenderer();
//        if ($renderer !== $this->renderer) {
//            // Discovered renderer is not ours; do nothing
//            return;
//        }
//
//        $result   = $e->getResult();
//        if (!is_string($result)) {
//            // We don't have a string, and thus, no JSON
//            return;
//        }
//
//        // Populate response
//        $response = $e->getResponse();
//        $response->setContent($result);
//        $headers = $response->headers();
//        $headers->addHeaderLine('content-type', 'application/json');
//    }
}
