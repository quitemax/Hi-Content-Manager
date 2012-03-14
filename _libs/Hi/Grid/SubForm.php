<?php
/**
 * Hi CMS
 *
 * @category   Hi
 * @package    Hi_Grid
 * @copyright  Copyright (c) 2010 Piotr Maxymilian Socha
 * @license
 */
namespace Hi\Grid;

use Zend\Form\SubForm as ZendSubForm;

/**
 * Hi_Record_Form
 *
 * @category   Hi
 * @package    Hi_Grid
 * @copyright  Copyright (c) 2010 Piotr Maxymilian Socha
 * @license
 * @version    2.0
 */
class SubForm extends ZendSubForm
{
    /**#@+
     * Form id template
     */
    const DEFAULT_ID = 'subFormDefaultId';
    /**#@-*/

    /**#@+
     * Form default partial decorator directory
     */
    const DEFAULT_PARTIALS_DIR = '_grid/_subform';
	/**#@-*/

    /**
     * Should we disable loading the default decorators?
     * @var bool
     */
    protected $_disableLoadDefaultDecorators = true;

    /**
     * Name
     *
     * @var string
     */
    protected $_name = '';

    /**
     * Title
     *
     * @var string
     */
    protected $_title = '';

    /**
     * Partial decorator directory
     *
     * @var string
     */
    protected $_partialsDir = self::DEFAULT_PARTIALS_DIR;

    /**
     * Set form state from options array
     *
     * @param  array $options
     * @return Form
     */
    public function setOptions(array $options)
    {

        //
        if (!isset($this->_name) || trim($this->_name) == '') {
            $this->_name = self::DEFAULT_ID . md5(microtime());

        }

        $this->setName($this->_name);

        //
        if (isset($options['view'])) {
            $this->setView($options['view']);
        }



        return parent::setOptions($options);
    }


}