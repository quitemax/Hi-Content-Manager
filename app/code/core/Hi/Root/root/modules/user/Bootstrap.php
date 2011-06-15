<?php
class User_Bootstrap extends Zend_Application_Module_Bootstrap
{
    
    public  function _initLibraryAutoloader()
    {
        Zend_Debug::dump('asdf');
        echo 'asdf';
        return $this->getResourceLoader()
                    ->addResourceType(
                        'libs',
                        'libs',
                        'User_Libs'
                    );
    }
    
    
}



