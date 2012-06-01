<?php
///**
// * Zend Framework
// *
// * LICENSE
// *
// * This source file is subject to the new BSD license that is bundled
// * with this package in the file LICENSE.txt.
// * It is also available through the world-wide-web at this URL:
// * http://framework.zend.com/license/new-bsd
// * If you did not receive a copy of the license and are unable to
// * obtain it through the world-wide-web, please send an email
// * to license@zend.com so we can send you a copy immediately.
// *
// * @category   Zend
// * @package    Zend_View
// * @subpackage Model
// * @copyright  Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
// * @license    http://framework.zend.com/license/new-bsd     New BSD License
// */

namespace HiBase\Block;

use Zend\View\Model\ViewModel;
use Zend\Loader\Pluggable;
use Zend\View\Exception;
use Zend\View\HelperBroker;
use Zend\View\Renderer\RendererInterface;
use Zend\View\Renderer\TreeRendererInterface;
use Zend\View\Resolver\ResolverInterface;
use Zend\View\Variables;
use ArrayAccess;
use Zend\Filter\FilterChain;
use Zend\View\Resolver\TemplatePathStack;


///**
// * @category   Zend
// * @package    Zend_View
// * @subpackage Model
// * @copyright  Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
// * @license    http://framework.zend.com/license/new-bsd     New BSD License
// */
abstract class AbstractBlock extends ViewModel implements Pluggable
{


    /**
     * Constructor
     *
     * @param  null|array|Traversable $variables
     * @param  array|Traversable $options
     * @return void
     */
    public function __construct($variables = null, $options = null)
    {
        parent::__construct($variables, $options);

        $this->init();
    }

    /**
     *
     * Enter description here ...
     */
    public function init()
    {

    }


    public function toHtml()
    {
//        Mage::dispatchEvent('core_block_abstract_to_html_before', array('block' => $this));
//        if (Mage::getStoreConfig('advanced/modules_disable_output/' . $this->getModuleName())) {
//            return '';
//        }
//        $html = $this->_loadCache();
//        if ($html === false) {
//            $translate = Mage::getSingleton('core/translate');
//            /** @var $translate Mage_Core_Model_Translate */
//            if ($this->hasData('translate_inline')) {
//                $translate->setTranslateInline($this->getData('translate_inline'));
//            }
//
//            $this->_beforeToHtml();
//            $html = $this->_toHtml();
//            $this->_saveCache($html);
//
//            if ($this->hasData('translate_inline')) {
//                $translate->setTranslateInline(true);
//            }
//        }
//        $html = $this->_afterToHtml($html);
//
//        /**
//         * Check framing options
//         */
//        if ($this->_frameOpenTag) {
//            $html = '<'.$this->_frameOpenTag.'>'.$html.'<'.$this->_frameCloseTag.'>';
//        }
//
//        /**
//         * Use single transport object instance for all blocks
//         */
//        if (self::$_transportObject === null) {
//            self::$_transportObject = new Varien_Object;
//        }
//        self::$_transportObject->setHtml($html);
//        Mage::dispatchEvent('core_block_abstract_to_html_after',
//                array('block' => $this, 'transport' => self::$_transportObject));
//        $html = self::$_transportObject->getHtml();
//
//        return $html;

        $html = '';

        $html .= $this->_beforeToHtml();
        $html .= $this->_toHtml();
        $html = $this->_afterToHtml($html);

        return $html;
    }

    protected function _beforeToHtml()
    {
        return '';
    }

    protected function _toHtml()
    {
        return '';
    }


    protected function _afterToHtml($html = '')
    {
        return $html;
    }


    /**
     * Set plugin broker instance
     *
     * @param  string|HelperBroker $broker
     * @return void
     * @throws Exception\InvalidArgumentException
     */
    public function setBroker($broker)
    {
        if (is_string($broker)) {
            if (!class_exists($broker)) {
                throw new Exception\InvalidArgumentException(sprintf(
                    'Invalid helper broker class provided (%s)',
                    $broker
                ));
            }
            $broker = new $broker();
        }
        if (!$broker instanceof HelperBroker) {
            throw new Exception\InvalidArgumentException(sprintf(
                'Helper broker must extend Zend\View\HelperBroker; got type "%s" instead',
                (is_object($broker) ? get_class($broker) : gettype($broker))
            ));
        }
        $broker->setView($this);
        $this->__helperBroker = $broker;
    }

    /**
     * Get plugin broker instance
     *
     * @return HelperBroker
     */
    public function getBroker()
    {
        if (null === $this->__helperBroker) {
            $this->setBroker(new HelperBroker());
        }
        return $this->__helperBroker;
    }

    /**
     * Get plugin instance
     *
     * @param  string     $plugin  Name of plugin to return
     * @param  null|array $options Options to pass to plugin constructor (if not already instantiated)
     * @return Helper
     */
    public function plugin($name, array $options = null)
    {
        return $this->getBroker()->load($name, $options);
    }

    /**
     * Overloading: proxy to helpers
     *
     * Proxies to the attached plugin broker to retrieve, return, and potentially
     * execute helpers.
     *
     * * If the helper does not define __invoke, it will be returned
     * * If the helper does define __invoke, it will be called as a functor
     *
     * @param  string $method
     * @param  array $argv
     * @return mixed
     */
    public function __call($method, $argv)
    {
        $helper = null;
        try {
            $helper = $this->plugin($method);
            if (is_callable($helper)) {
                return call_user_func_array($helper, $argv);
            }
        }
        catch (\Exception $e) {

        }
        return $helper;
    }
}
