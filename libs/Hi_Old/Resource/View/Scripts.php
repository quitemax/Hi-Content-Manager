<?php
class Hi_Resource_View_Scripts extends Zend_Application_Resource_ResourceAbstract
{
    public function  init()
    {
        //
        $options = $this->getOptions();

        //
        $bootstrap = $this->getBootstrap();
        $bootstrap->bootstrap('view');

        /*@var $view Zend_Layout */
        $view = $bootstrap->getResource('view');

//        Zend_Debug::dump($options);

        foreach ($options as $script) {
            $view->headScript()->appendFile(
                $script,
                'text/javascript'
            );
        }
    }
}