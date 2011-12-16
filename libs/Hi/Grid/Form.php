<?php
/**
 * Hi CMS
 *
 * @category   Hi
 * @package    Hi_Record
 * @copyright  Copyright (c) 2010 Piotr Maxymilian Socha
 * @license
 */

namespace Hi\Grid;

use Zend\Form\Form as ZendForm,
    Hi\Grid\SubForm,
    Zend\Form\Element;


/** @see Zend_Form */
//require_once 'Zend/Form.php'; //autoload

/**
 * Hi_Record_Form
 *
 * @category   Hi
 * @package    Hi_Record
 * @copyright  Copyright (c) 2010 Piotr Maxymilian Socha
 * @license
 * @version    2.0
 */
class Form extends ZendForm
{
    /**#@+
     * Form default partial decorator directory
     */
    const HEADER_DEFAULT_PARTIALS_DIR = '_grid/_form';
	/**#@-*/

    /**
     * Title
     *
     * @var string
     */
    protected $_title = '';

    /**
     * Langs in use
     *
     * @var array
     */
    protected $_langs = array();

    /**
     * Current lang
     *
     * @var string
     */
    protected $_lang = '';

    /**
     * Should we disable loading the default decorators?
     * @var bool
     */
    protected $_disableLoadDefaultDecorators = true;



    /**
     * Partial decorator directory
     *
     * @var string
     */
    protected $_partialsDir = self::HEADER_DEFAULT_PARTIALS_DIR;


	/**
     * Set form state from options array
     *
     * @param  array $options
     * @return Form
     */
    public function setOptions(array $options)
    {
        return parent::setOptions($options);
//        return $this;
    }

    /**
     * Sets title
     *
     * @param $title string
     *
     * @throws Exception
     *
     * @return void
     */
    public function setTitle($title = '') {
        if (is_string($title)) {
            $this->_title = $title;
        } else {
            throw new Exception("You must give a string here.");
        }
    }

    /**
     * Set langs
     *
     * @param $langs array
     *
     * @return void
     */
    public function setLangs($langs = array(), $lang = 'pl') {
        if (!is_array($langs)) {
            throw new Exception("The langs array you have provided is not an array.");
        }
        $this->_langs = $langs;

        if (!is_string($lang)) {
            throw new Exception("The lang  you have provided is not a string.");
        }
        $this->_lang = $lang;
    }

    /**
     * Set lang
     *
     * @param $lang string
     *
     * @return void
     */
    public function setLang($lang = 'pl') {
        if (!is_string($lang)) {
            throw new Exception("The lang  you have provided is not a string.");
        }
        $this->_lang = $lang;
    }

    /**
     * Builds the form from form elements and adds everything needed
     *
     * @return Zend_Form
     */
    public function init() {
        //
        $formId = $this->getName();

//        \HiZend\Debug\Debug::precho($this->getView());

        //
        $this ->setDecorators(
           array(
               array(
                   'FormElements'
               ),
               array(
                   'FormDecorator'
               ),
               array(
                    'ViewScript',
                    array(
                        'viewScript'    => $this->_partialsDir . '/_form.phtml',
                        'title'         => $this->_title,
                        'placement'     => false,
                        'formId'        => $formId,
                    ),
                ),

            )
        );


    	//
    	$this  ->setEnctype(ZendForm::ENCTYPE_MULTIPART);

    	//
    	$subFormHeader = new SubForm();


    	$tmpElement = new Element\Hidden('formId');
        $tmpElement->setValue($formId);
        $tmpElement->setDecorators(
            array(
                array('ViewHelper')
            )
        );
        $subFormHeader -> addElement($tmpElement);



        /**
         * @todo
         */
//        if (isset($this->_config['hashStorage'])) {
//        	$hashStorage = $this->_config['hashStorage'];
//        } else if (isset($this->_config['id'])) {
//        	$hashStorage = new Zend_Session_Namespace($this->_config['id']);
//        }
//        $tmpElement = new Zend_Form_Element_Hidden('hash');
//        $hash = time() . date('Y-m-d H:i:s') . Zend_Session::getId();
//        $tmpElement->setValue(
//            md5(
//                $hash
//            )
//        );
//        $hashStorage ->hash = $hash;
//        $tmpElement->setDecorators(
//            array(
//                array('ViewHelper')
//            )
//        );
//        $subFormHeader -> addElement($tmpElement);
//        break;



    	$subFormHeader ->setDecorators(
            array(
                array('FormElements'),
                array(
                    'ViewScript',
                    array(
                        'viewScript'    => $this->_partialsDir . '/_form_header.phtml',
                        'title'         => $this->_title,
                        'placement'     => false,
                        'formId'        => $formId,
                    ),
                ),
            )
        );

    	//
	    $this->addSubForm($subFormHeader, 'header');
    }
}