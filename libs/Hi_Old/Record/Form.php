<?php
/**
 * Hi CMS
 *
 * @category   Hi
 * @package    Hi_Record
 * @copyright  Copyright (c) 2010 Piotr Maxymilian Socha
 * @license
 */

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
class Hi_Record_Form extends Zend_Form
{
    /**#@+
     * Form default partial decorator directory
     */
    const HEADER_DEFAULT_PARTIALS_DIR = 'record/form/';
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
     * Partial decorator directory
     *
     * @var string
     */
    protected $_partialsDir = Hi_Record_Form::HEADER_DEFAULT_PARTIALS_DIR;

    /**
     * Constructor.
     *
     * @param string $title
     * @param Zend_View $view
     *
     * @return void
     */
    public function __construct($options = null)
    {
        if (is_array($options) && isset($options['title'])) {
            $this->_title = $options['title'];
            unset($options['title']);
        }

        if (is_array($options) && isset($options['view']) && $options['view'] instanceof Zend_View) {
            $this->setView($options['view']);
            unset($options['view']);
        }

        $options['disableLoadDefaultDecorators'] = true;

    	parent::__construct($options);
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

        //
        $this ->setDecorators(
           array(
               array(
                   'FormElements'
               ),
               array(
                   'Form'
               ),
               array(
                    'ViewScript',
                    array(
                        'viewScript'    => $this->_partialsDir.'_form.phtml',
                        'title'         => $this->_title,
                        'placement'     => false,
                        'formId'        => $formId,
                    ),
                ),

            )
        );


    	//
    	$this  ->setEnctype(Zend_Form::ENCTYPE_MULTIPART);

    	//
    	$subFormHeader = new Zend_Form_SubForm(
    	   array(
    	       'disableLoadDefaultDecorators' => true,
    	   )
    	);



    	$tmpElement = new Zend_Form_Element_Hidden('formId');
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
                        'viewScript'    => $this->_partialsDir.'_form_header.phtml',
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