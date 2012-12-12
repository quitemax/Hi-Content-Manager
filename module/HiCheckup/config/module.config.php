<?php
return array(
//    'hi-checkup' => array(
//        'ver'          => '0.0.1.0',
//        /**
//         * @todo ver @ 0.0.1.5
//         * -> update to beta4
//         *
//         * @todo ver @ 0.0.2.0
//         * -> 1. weekly, daily, monthly, yearly stats counting
//         * -> 2. how far back do we count stats
//         * -> 3. add event listeners to stats chart points to forward to checkup edit/stats url?
//         */
//    ),
    'service_manager' => array(
        'factories' => array(
            'CheckupModel'           => 'HiCheckup\Model\Checkup\Factory',
            'CheckupProfileModel'    => 'HiCheckup\Model\CheckupProfile\Factory',
            'CheckupToProfileModel'  => 'HiCheckup\Model\CheckupToProfile\Factory',
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'HiCheckup\Controller\HiCheckup' => 'HiCheckup\Controller\HiCheckupController',
            'HiCheckup\Controller\Checkup' => 'HiCheckup\Controller\CheckupController',
            'HiCheckup\Controller\CheckupProfile' => 'HiCheckup\Controller\CheckupProfileController',
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
                        'controller' => 'HiCheckup\Controller\HiCheckupController',
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
                                'controller' => 'HiCheckup\Controller\Checkup',
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
                                        'controller' => 'HiCheckup\Controller\Checkup',
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
                                        'controller' => 'HiCheckup\Controller\Checkup',
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
                                        'controller' => 'HiCheckup\Controller\Checkup',
                                        'action'     => 'add',
                                    ),
                                ),
                            ),
                            'edit' => array(
                                'type' => 'Literal',
                                'options' => array(
                                    'route' => '/edit',
                                    'defaults' => array(
                                        'controller' => 'HiCheckup\Controller\Checkup',
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
                                        'controller' => 'HiCheckup\Controller\Checkup',
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
                                'controller' => 'HiCheckup\Controller\CheckupProfile',
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
                                        'controller' => 'HiCheckup\Controller\CheckupProfile',
                                        'action'     => 'list',
                                    ),
                                ),
                            ),
                            'add' => array(
                                'type' => 'Literal',
                                'options' => array(
                                    'route' => '/add',
                                    'defaults' => array(
                                        'controller' => 'HiCheckup\Controller\CheckupProfile',
                                        'action'     => 'add',
                                    ),
                                ),
                            ),
                            'edit' => array(
                                'type' => 'Literal',
                                'options' => array(
                                    'route' => '/edit',
                                    'defaults' => array(
                                        'controller' => 'HiCheckup\Controller\CheckupProfile',
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
                                        'controller' => 'HiCheckup\Controller\CheckupProfile',
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
