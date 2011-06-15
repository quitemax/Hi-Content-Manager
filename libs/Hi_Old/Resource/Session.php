<?php
class Hi_Resource_Session extends Zend_Application_Resource_ResourceAbstract
{
    public function init()
    {
        Zend_Session::start();
    }
}