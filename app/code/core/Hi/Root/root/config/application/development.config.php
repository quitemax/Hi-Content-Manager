<?php
return array(
    'resources' => array(
        'frontController'   => array(
        ),

        'Hi_Resource_FrontController_Plugin_ErrorHandler'   => array(
        ),

        'Hi_Resource_FrontController_Plugin_LoggedIn'   => array(
        ),

        'Root_Resource_Autoloader'   => array(
        ),

        'db'   => array(
            'params'    =>  array(
                'host'                      => 'localhost',
                'username'                  => 'root',
                'password'                  => '',
                'dbname'                    => 'hi',
                'port'                      => 3306,
            ),
        ),

        'Hi_Resource_Db_Profiler'       => array(
        ),


        'Hi_Resource_View' => array(
            'encoding'          =>  'utf-8',
            'doctype'           =>  'XHTML1_STRICT',
            'escape'            =>  'htmlentities',
            'publicUrl'         =>  PUBLIC_URL,
            'skinUrl'           =>  SKIN_URL,
            'skin'              =>  'default',
        ),
        'Hi_Resource_View_Scripts'       => array(
            'http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.js'
        ),
        'Hi_Resource_View_Stylesheets'   => array(
            SKIN_URL . '/default/css/layout.css'
        ),
        'Hi_Resource_Layout'       => array(
            'layout'        =>  'default',
            'skin'          =>  'default',
            'layoutPath'    =>  APPLICATION_PATH . '/views/',
        ),
        'Hi_Resource_Session'       => array(
        ),
        'Hi_Resource_Langs'       => array(
            'lang'          => 'pl',
        ),
        'Hi_Resource_FrontController_Plugin_Translations'       => array(
        ),
        
        'Hi_Resource_FrontController_Plugin_ZFDebug'       => array(
            'plugins' => array(
                'Variables',
                'Html', 
                'File' => array(
                    'base_path' => APPLICATION_PATH . '/../',
                ),
                'Memory', 
                'Time', 
                'Registry', 
                'Exception'
            )
        ),
    ),
);