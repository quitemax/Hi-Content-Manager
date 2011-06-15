<?php

namespace Hi\Application;

use Zend\Application\ResourceLoader as Loader;

/**
 * Hi Plugin Class Loader implementation for bootstrap resources.
 *
 * @category   Hi
 * @package    Hi\Application
 * @copyright
 * @license
 */
class ResourceLoader extends Loader
{
    /**
     * @var array Hi Pre-aliased bootstrap resources
     */
    protected $plugins = array(
        'cachemanager'    => 'Zend\Application\Resource\CacheManager',
        'db'              => 'Zend\Application\Resource\Db',
        'dojo'            => 'Zend\Application\Resource\Dojo',
        'frontcontroller' => 'Zend\Application\Resource\FrontController',
        'layout'          => 'Zend\Application\Resource\Layout',
        'locale'          => 'Zend\Application\Resource\Locale',
        'log'             => 'Zend\Application\Resource\Log',
        'mail'            => 'Zend\Application\Resource\Mail',
        'modules'         => 'Zend\Application\Resource\Modules',
        'multidb'         => 'Zend\Application\Resource\MultiDb',
        'navigation'      => 'Zend\Application\Resource\Navigation',
        'router'          => 'Zend\Application\Resource\Router',
        'session'         => 'Zend\Application\Resource\Session',
        'translate'       => 'Zend\Application\Resource\Translate',
        'view'            => 'Hi\Application\Resource\View',
    );
}
