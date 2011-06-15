<?php
return array_merge_recursive(
    array(
        'phpSettings' => array(
            'display_startup_errors'    => true,
            'display_errors'            => true,
            'error_reporting'           => E_ALL,
            'date.timezone'             => 'Europe/Paris'
        ),
//        'includePaths' => array(
//            'library'   =>  APPLICATION_PATH . '/../../libs',
//        ),
//        'pluginPaths'   => array(
////            'Hi_Resource'   =>  'Hi/Resource',
//            'view'   =>  'Hi/Application/Resource/View',
//        ),
//        'registerPlugins'   => array(
//            'view'   =>  'Hi/Application/Resource/View',
//        ),
        'resources'   => array(
            'frontController'   => array(
//                'controllerDirectory'       => array(
//                    'default'	=> APPLICATION_PATH . '/code/core/Hi/Default',
//					'core'		=> APPLICATION_PATH . '/code/core/Hi/Core',
//                ),
                'baseUrl'                   => BASE_URL,
                'env'                       => APPLICATION_ENV,
            ),
//            'db'   => array(
//                'adapter'   => 'PDO_MYSQL',
//                'params'    =>  array(
//                    'charset'                   => 'utf8',
//                ),
//                'isDefaultTableAdapter '    => true,
//            ),
//        'router' => array(
//            'routes' => include dirname(__FILE__) . '/routes.config.php'
//        ),
        ),
    ),
    include dirname(__FILE__) . DS . 'default.php'
);