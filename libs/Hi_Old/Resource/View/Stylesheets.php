<?php
class Hi_Resource_View_Stylesheets extends Zend_Application_Resource_ResourceAbstract
{
//    protected $_options = array (
//        'path'          =>  'utf-8',
//        'doctype'           =>  'XHTML1_STRICT',
//        'escape'            =>  'htmlentities',
//    );

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

        foreach ($options as $sheet) {
            $view->headLink()->appendStylesheet(
                $sheet,
                'screen',
                true
            );
        }

////        $view->headScript()->appendFile('http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.js', 'text/javascript');
////        $view->headScript()->appendFile('localGlobalData.js', 'text/javascript');
//
//        //
//        $view->setScriptPath(APPLICATION_PATH . '/views/scripts/');
//        $view->addBasePath(APPLICATION_PATH . '/modules/default/views/');
//
//        //
//        return $view;
    }
}