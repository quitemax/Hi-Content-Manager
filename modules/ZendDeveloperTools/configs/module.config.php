<?php
return array(
    'zend_developer_tools' => array(
        'layout' => 'layouts/developer-toolbar.phtml',
    ),
    'di' => array(
        'instance' => array(
            'Zend\View\PhpRenderer' => array(
                'parameters' => array(
                    'resolver' => 'Zend\View\TemplatePathStack',
                    'options'  => array(
                        'script_paths' => array(
                            'ZendDeveloperTools' => __DIR__ . '/../views',
                        ),
                    ),
                ),
            ),
            'Zend\View\TemplatePathStack' => array(
                'parameters' => array(
                    'paths' => array(
                        'ZendDeveloperTools' => __DIR__ . '/../views',
                    ),
                )
            ),
        ),
    ),
);
