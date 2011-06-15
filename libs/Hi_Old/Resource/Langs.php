<?php
class Hi_Resource_Langs extends Zend_Application_Resource_ResourceAbstract
{
    protected $_options = array (
        'lang'          =>  'pl',
    );

    public function  init()
    {
        $bootstrap = $this->getBootstrap();
        $bootstrap->bootstrap('session');
        
        //
        $options = $this->getOptions();
        
        //
        $lang = new Zend_Session_Namespace('lang');
        if (!isset($lang->lang)) {
            $lang->lang = $options['lang'];
        }
        
        return $lang;
    }
}