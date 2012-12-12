<?php

/**
 * Default_ErrorController
 *
 * @author
 * @version
 */

class ErrorController extends HiZend_Controller_Action {

	/**
	 * The default action - handle the error
	 */
	public function indexAction() {
		$errors = $this->_getParam('error_handler');
		$exception = $errors->exception;
		$error = array();



//		Zend_Debug::dump($errors);

		switch ($errors->type) {
        	case Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_ROUTE:
            case Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_CONTROLLER:
            case Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_ACTION:
            	// 404 error -- controller or action not found
                $this	->_response
                		->setRawHeader('HTTP/1.1 404 Not Found')
                		->appendBody('HTTP/1.1 404 Not Found');
                break;
            default:
            	Zend_Debug::dump($errors->exception);
//                $log = new Zend_Log(
//	                new Zend_Log_Writer_Stream(
//    	                '/tmp/applicationException.log'
//                    )
//                );
//                $log->debug(
//                	$exception->getMessage() . "\n" .
//                    $exception->getTraceAsString()
//                );
                break;
    	}
	}
}

