<?php
return array(
    'hi-checkup' => array(
        'ver'          => '0.0.1.0',
        /**
         * @todo ver @ 0.0.1.5
         * -> update to beta4
         *
         * @todo ver @ 0.0.2.0
         * -> 1. weekly, daily, monthly, yearly stats counting
         * -> 2. how far back do we count stats
         * -> 3. add event listeners to stats chart points to forward to checkup edit/stats url?
         */
    ),
    'service_manager' => array(
        'factories' => array(
            'CheckupModel'           => 'HiCheckup\Model\Checkup\Factory',
            'CheckupProfileModel'    => 'HiCheckup\Model\CheckupProfile\Factory',
            'CheckupToProfileModel'  => 'HiCheckup\Model\CheckupToProfile\Factory',
        ),
    ),
//    'controller' => array(
//        'classes' => array(
//            'hicheckup/checkup' => 'HiCheckup\Controller\CheckupController'
////            'hicheckup/checkup-profile' => 'HiCheckup\Controller\CheckupProfileController'
//        ),
//    ),
    'view_manager' => array(
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
    'controller' => array(
        'classes' => array(
            'hicheckup/hicheckup' => 'HiCheckup\Controller\HiCheckupController',
            'hicheckup/checkup' => 'HiCheckup\Controller\CheckupController',
            'hicheckup/checkup-profile' => 'HiCheckup\Controller\CheckupProfileController',
        ),
    ),
    'router' => array(
        'routes' => array(
            'hi-checkup' => array(
                'type' => 'Literal',
                'priority' => 1000,
                'options' => array(
                    'route' => '/hi-checkup',
                    'defaults' => array(
                        'controller' => 'hicheckup/hicheckup',
                        'action'     => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'checkup' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route' => '/checkup',
                            'defaults' => array(
                                'controller' => 'hicheckup/checkup',
                                'action'     => 'index',
                            ),
                        ),
                        'may_terminate' => true,
                        'child_routes' => array(
                            'stats' => array(
                                'type' => 'Literal',
                                'options' => array(
                                    'route' => '/stats',
                                    'defaults' => array(
                                        'controller' => 'hicheckup/checkup',
                                        'action'     => 'stats',
                                    ),
                                ),
                                'may_terminate' => true,
                                'child_routes'  => array(
                                    'wildcard' => array(
                                        'type'    => 'wildcard',
                                    ),
                                ),
                            ),
                            'list' => array(
                                'type' => 'Literal',
                                'options' => array(
                                    'route' => '/list',
                                    'defaults' => array(
                                        'controller' => 'hicheckup/checkup',
                                        'action'     => 'list',
                                    ),
                                ),
                                'may_terminate' => true,
                                'child_routes'  => array(
                                    'wildcard' => array(
                                        'type'    => 'wildcard',
                                    ),
                                ),
                            ),
                            'add' => array(
                                'type' => 'Literal',
                                'options' => array(
                                    'route' => '/add',
                                    'defaults' => array(
                                        'controller' => 'hicheckup/checkup',
                                        'action'     => 'add',
                                    ),
                                ),
                            ),
                            'edit' => array(
                                'type' => 'Literal',
                                'options' => array(
                                    'route' => '/edit',
                                    'defaults' => array(
                                        'controller' => 'hicheckup/checkup',
                                        'action'     => 'edit',
                                    ),
                                ),
                                'may_terminate' => true,
                                'child_routes'  => array(
                                    'wildcard' => array(
                                        'type'    => 'wildcard',
                                    ),
                                ),
                            ),
                            'delete' => array(
                                'type' => 'Literal',
                                'options' => array(
                                    'route' => '/delete',
                                    'defaults' => array(
                                        'controller' => 'hicheckup/checkup',
                                        'action'     => 'delete',
                                    ),
                                ),
                                'may_terminate' => true,
                                'child_routes'  => array(
                                    'wildcard' => array(
                                        'type'    => 'wildcard',
                                    ),
                                ),
                            ),
                        ),
                    ),
                    'checkup-profile' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route' => '/checkup-profile',
                            'defaults' => array(
                                'controller' => 'hicheckup/checkup-profile',
                                'action'     => 'index',
                            ),
                        ),
                        'may_terminate' => true,
                        'child_routes' => array(
                            'list' => array(
                                'type' => 'Literal',
                                'options' => array(
                                    'route' => '/list',
                                    'defaults' => array(
                                        'controller' => 'hicheckup/checkup-profile',
                                        'action'     => 'list',
                                    ),
                                ),
                            ),
                            'add' => array(
                                'type' => 'Literal',
                                'options' => array(
                                    'route' => '/add',
                                    'defaults' => array(
                                        'controller' => 'hicheckup/checkup-profile',
                                        'action'     => 'add',
                                    ),
                                ),
                            ),
                            'edit' => array(
                                'type' => 'Literal',
                                'options' => array(
                                    'route' => '/edit',
                                    'defaults' => array(
                                        'controller' => 'hicheckup/checkup-profile',
                                        'action'     => 'edit',
                                    ),
                                ),
                                'may_terminate' => true,
                                'child_routes'  => array(
                                    'wildcard' => array(
                                        'type'    => 'wildcard',
                                    ),
                                ),
                            ),
                            'delete' => array(
                                'type' => 'Literal',
                                'options' => array(
                                    'route' => '/delete',
                                    'defaults' => array(
                                        'controller' => 'hicheckup/checkup-profile',
                                        'action'     => 'delete',
                                    ),
                                ),
                                'may_terminate' => true,
                                'child_routes'  => array(
                                    'wildcard' => array(
                                        'type'    => 'wildcard',
                                    ),
                                ),
                            ),
                        ),
                    ),
                ),
            ),
        ),
    ),
);
