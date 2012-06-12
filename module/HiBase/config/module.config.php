<?php
return array(
//    'module-config' => {
    'hi-base' => array(
        'ver'          => '0.0.5.0',
/**
 * @todo ver @ 0.0.6.0
 * -> 0. (przesiadka na service managera)
 * -> 0. (przesiadka na nowy form)
 * -> 0. (Block i reszta jako ViewModel + BlockRendererStrategy i etc.. )
 * -> 1. showImage jako thumb + powiekszenie js
 * -> 2
 *
 * @todo ver @ 0.0.7.0
 * -> 1.workout stats profiles
 */
        'showimage_cache_path'          => '/',

    ),
    'view_manager' => array(
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
//        'helper_map' => array(
////            'zfcUserIdentity' => 'ZfcUser\View\Helper\ZfcUserIdentity',
////            'zfcUserLoginWidget' => 'ZfcUser\View\Helper\ZfcUserLoginWidget'
//        )
    ),
    'service_manager' => array(
        'factories' => array(
            'DbAdapter'            => 'HiBase\Mvc\Service\DbAdapterFactory',
            'ViewBlockRenderer'    => 'HiBase\Mvc\Service\ViewBlockRendererFactory',
            'ViewBlockStrategy'    => 'HiBase\Mvc\Service\ViewBlockStrategyFactory',
        ),
    ),
);
