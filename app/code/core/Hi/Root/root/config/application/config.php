<?php
return array_merge_recursive(
    array(
        'phpSettings' => array(
            'display_startup_errors'    => true,
            'display_errors'            => true,
            'error_reporting'           => E_ALL,
            'date.timezone'             => 'Europe/Paris'
        ),
        'includePaths' => array(
            'library'   =>  APPLICATION_PATH . '/../../libs',
        ),
        'pluginPaths'   => array(
            'Hi_Resource'   =>  'Hi/Resource',
        ),
        'resources'   => array(
            'frontController'   => array(
                'moduleDirectory'           => APPLICATION_PATH . '/modules',
                'throwExceptions'           => false,
                'baseUrl'                   => BASE_URL,
                'env'                       => APPLICATION_ENV,
                'defaultModule'             => 'default',
                'defaultControllerName'     => 'index',
                'defaultAction'             => 'index',
            ),
            'db'   => array(
                'adapter'   => 'PDO_MYSQL',
                'params'    =>  array(
                    'charset'                   => 'utf8',
                ),
                'isDefaultTableAdapter '    => true,
            ),
//        'router' => array(
//            'routes' => include dirname(__FILE__) . '/routes.config.php'
//        ),
        ),
        'modules'       => array(
        ),
    ),
    include dirname(__FILE__) . '/' . APPLICATION_ENV . '.config.php'
);