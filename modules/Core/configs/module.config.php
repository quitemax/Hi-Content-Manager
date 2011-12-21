<?php
$config = array();

/**
 * PRODUCTION
 */
$config['production'] = array(
    'display_exceptions' => true,
    'view' => array(
        'layout' => 'layouts/layout.phtml',
    ),
    'di' => array(
        'instance' => array(
            'alias' => array(
                'index' => 'Core\Controller\IndexController',
                'error' => 'Core\Controller\ErrorController',
                'view'              => 'Zend\View\PhpRenderer',
                'view-resolver'     => 'Zend\View\TemplatePathStack',
            ),
            'view' => array(
                'parameters' => array(
                    'resolver' => 'view-resolver',
                    'options'  => array(
                        'script_paths' => array(
                            'Core' => __DIR__ . '/../views',
                        ),
                    ),
                ),
            ),
            'view-resolver' => array(
                'parameters' => array(
                    'paths' => array(
                        'Core' => __DIR__ . '/../views',
                    ),
                )
            ),
            'Zend\Db\Adapter\Mysqli' => array(
                'parameters' => array(
                    'config' => array(
                        'host' => 'localhost',
                        'username' => 'root',
                        'password' => '',
                        'dbname' => 'exercises',
                    ),
                ),
            ),
        ),
    ),
    'routes' => array(
        'default' => array(
            'type' => 'Regex',
            'options' => array(
                'regex' => '/.*',
                'defaults' => array(
                    'controller' => 'error',
                    'action'     => 'error',
                ),
                'spec' => '404',
            ),
        ),
        'home' => array(
            'type'    => 'Literal',
            'options' => array(
                'route' => '/',
                'defaults' => array(
                    'controller' => 'index',
                    'action'     => 'index',
                ),
            ),
        ),
    ),
);

/**
 * staging
 */
$config['staging']     = $config['production'];

/**
 * testing
 */
$config['testing']     = $config['production'];
$config['testing']['display_exceptions']    = true;

/**
 * development
 */
$config['development'] = $config['production'];
$config['development']['display_exceptions']    = true;
return $config;