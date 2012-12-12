<?php

/**
 * path definitions
 *
 */
define('DS', DIRECTORY_SEPARATOR);
define('PS', PATH_SEPARATOR);

//
define('BASE_PATH',     dirname(dirname(__FILE__)));
define('MODULES_PATH',  BASE_PATH . DS . 'modules');
define('VENDOR_PATH',   BASE_PATH . DS . 'vendor');
define('ZF2_PATH',      BASE_PATH . DS . /*'..' . DS .*/ 'zend' . DS . 'library');
define('PUBLIC_PATH',   BASE_PATH . DS . 'public');
define('SKIN_PATH',     PUBLIC_PATH . DS . 'skin');
define('MEDIA_PATH',    PUBLIC_PATH . DS . 'media');

//
define('BASE_URL',  '/sohi/Hi-Content-Manager/public');
define('MEDIA_URL', '/media');
define('SKIN_URL',  '/skin');


/*
 * Ensure libraries are on include_path
 */
set_include_path(implode(PS, array(
    realpath(ZF2_PATH),
    realpath(VENDOR_PATH),
    get_include_path(),
)));