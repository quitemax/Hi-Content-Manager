<?php
class Root_Resource_Autoloader extends Zend_Application_Resource_ResourceAbstract
{
    public function  init()
    {

        $autoloader = new HiZend_Application_Module_Autoloader(
            array(
                'namespace' => 'Default',
                'basePath'  => APPLICATION_PATH . '/modules/default' ,
            )
        );
        


        $autoloader = new HiZend_Application_Module_Autoloader(
            array(
                'namespace' => 'Hicms',
                'basePath'  => APPLICATION_PATH . '/modules/hicms' ,
            )
        );


        $autoloader = new HiZend_Application_Module_Autoloader(
            array(
                'namespace' => 'Navigation',
                'basePath'  => APPLICATION_PATH . '/modules/navigation' ,
            )
        );


        $autoloader = new HiZend_Application_Module_Autoloader(
            array(
                'namespace' => 'Preload',
                'basePath'  => APPLICATION_PATH . '/modules/preload' ,
            )
        );


        $autoloader = new HiZend_Application_Module_Autoloader(
            array(
                'namespace' => 'User',
                'basePath'  => APPLICATION_PATH . '/modules/user' ,
            )
        );
        
        return $autoloader;
    }
}