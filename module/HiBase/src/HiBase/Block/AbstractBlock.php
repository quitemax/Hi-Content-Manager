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

//use Zend\View\Model\ViewModel;
use Zend\View\Model\ModelInterface;

use Zend\View\Exception;

use Zend\View\Renderer\RendererInterface;
use Zend\View\Renderer\TreeRendererInterface;
use Zend\View\Resolver\ResolverInterface;
use Zend\View\Variables as ViewVariables;
use ArrayAccess;
use ArrayIterator;
use Traversable;
use Zend\Filter\FilterChain;
use Zend\View\Resolver\TemplatePathStack;
use Zend\ServiceManager\ServiceLocatorInterface;


///**
// * @category   Zend
// * @package    Zend_View
// * @subpackage Model
// * @copyright  Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
// * @license    http://framework.zend.com/license/new-bsd     New BSD License
// */
abstract class AbstractBlock implements ModelInterface
{
    /**
     *
     */
    const DEFAULT_CAPTURE_TO = 'content';

    /**
     * What variable a parent model should capture this model to
     *
     * @var string
     */
    protected $__captureTo = 'content';

    /**
     * Child models
     * @var array
     */
    protected $__children = array();

    /**
     * Renderer options
     * @var array
     */
    protected $__options = array();

    /**
     * Template to use when rendering this model
     *
     * @var string
     */
    protected $__template = '';

    /**
     * Is this a standalone, or terminal, model?
     *
     * @var bool
     */
    protected $__terminate = false;

    /**
     * View variables
     * @var array|ArrayAccess&Traversable
     */
    protected $__variables = array();


    /**
     * Is this append to child  with the same capture?
     *
     * @var bool
     */
    protected $__append = false;

    /**
     * @var \Zend\ServiceManager\ServiceManager
     */
    protected $__services;

    /**
     * Parent block
     *
     * @var Mage_Core_Block_Abstract
     */
    protected $__parentBlock;

    /**
     * Constructor
     *
     * @param  null|array|Traversable $variables
     * @param  array|Traversable $options
     */
    public function __construct($variables = null, $options = null)
    {
        if (null === $variables) {
            $variables = new ViewVariables();
        }

        // Initializing the __variables container
        $this->setVariables($variables, true);

        if (null !== $options) {
            $this->setOptions($options);
        }

        //
        $this->init();
    }

    /**
     *
     * init method
     */
    public function init()
    {

    }

    /**
     * Property overloading: set variable value
     *
     * @param  string $name
     * @param  mixed $value
     * @return void
     */
    public function __set($name, $value)
    {
        $this->setVariable($name, $value);
    }

    /**
     * Property overloading: get variable value
     *
     * @param  string $name
     * @return mixed
     */
    public function __get($name)
    {
        if (!$this->__isset($name)) {
            if ($child = $this->getChild($name)) {
                return $child->toHtml();
            }
            return null;
        }

        $variables = $this->getVariables();
        return $variables[$name];
    }



    /**
     * Property overloading: do we have the requested variable value?
     *
     * @param  string $name
     * @return bool
     */
    public function __isset($name)
    {
        $variables = $this->getVariables();
        return isset($variables[$name]);
    }

    /**
     * Property overloading: unset the requested variable
     *
     * @param  string $name
     * @return void
     */
    public function __unset($name)
    {
        if (!$this->__isset($name)) {
            return null;
        }

        $variables = $this->getVariables();
        unset($variables[$name]);
    }

    /**
     * Set a single option
     *
     * @param  string $name
     * @param  mixed $value
     * @return ViewModel
     */
    public function setOption($name, $value)
    {
        $this->__options[(string) $name] = $value;
        return $this;
    }

    /**
     * Get a single option
     *
     * @param  string       $name           The option to get.
     * @param  mixed|null   $default        (optional) A default value if the option is not yet set.
     * @return mixed
     */
    public function getOption($name, $default = null)
    {
        $name = (string)$name;
        return array_key_exists($name, $this->__options) ? $this->__options[$name] : $default;
    }

    /**
     * Set renderer options/hints en masse
     *
     * @param array|\Traversable $options
     * @throws \Zend\View\Exception\InvalidArgumentException
     * @return ViewModel
     */
    public function setOptions($options)
    {
        // Assumption is that lowest common denominator for renderer configuration
        // is an array
        if ($options instanceof Traversable) {
            $options = ArrayUtils::iteratorToArray($options);
        }

        if (!is_array($options)) {
            throw new Exception\InvalidArgumentException(sprintf(
                '%s: expects an array, or Traversable argument; received "%s"',
                __METHOD__,
                (is_object($options) ? get_class($options) : gettype($options))
            ));
        }

        $this->__options = $options;
        return $this;
    }

    /**
     * Get renderer options/hints
     *
     * @return array
     */
    public function getOptions()
    {
        return $this->__options;
    }

    /**
     * Get a single view variable
     *
     * @param  string       $name
     * @param  mixed|null   $default (optional) default value if the variable is not present.
     * @return mixed
     */
    public function getVariable($name, $default = null)
    {
        $name = (string)$name;
        if (array_key_exists($name,$this->__variables)) {
            return $this->__variables[$name];
        } else {
            return $default;
        }
    }

    /**
     * Set view variable
     *
     * @param  string $name
     * @param  mixed $value
     * @return ViewModel
     */
    public function setVariable($name, $value)
    {
        $this->__variables[(string) $name] = $value;
        return $this;
    }

    /**
     * Set view __variables en masse
     *
     * Can be an array or a Traversable + ArrayAccess object.
     *
     * @param  array|ArrayAccess&Traversable $variables
     * @param  bool $overwrite Whether or not to overwrite the internal container with $variables
     * @return ViewModel
     */
    public function setVariables($variables, $overwrite = false)
    {
        if (!is_array($variables) && !$variables instanceof Traversable) {
            throw new Exception\InvalidArgumentException(sprintf(
                '%s: expects an array, or Traversable argument; received "%s"',
                __METHOD__,
                (is_object($variables) ? get_class($variables) : gettype($variables))
            ));
        }

        if ($overwrite) {
            if (is_object($variables) && !$variables instanceof ArrayAccess) {
                $variables = ArrayUtils::iteratorToArray($variables);
            }

            $this->__variables = $variables;
            return $this;
        }

        foreach ($variables as $key => $value) {
            $this->setVariable($key, $value);
        }

        return $this;
    }

    /**
     * Get view __variables
     *
     * @return array|ArrayAccess|Traversable
     */
    public function getVariables()
    {
        return $this->__variables;
    }

    /**
     * Set the template to be used by this model
     *
     * @param  string $template
     * @return ViewModel
     */
    public function setTemplate($template)
    {
        $this->__template = (string) $template;
        return $this;
    }

    /**
     * Get the template to be used by this model
     *
     * @return string
     */
    public function getTemplate()
    {
        return $this->__template;
    }

    /**
     * Add a child model
     *
     * @param  ModelInterface $child
     * @param  null|string $captureTo Optional; if specified, the "capture to" value to set on the child
     * @param  null|bool $append Optional; if specified, append to child  with the same capture
     * @return ViewModel
     */
    public function addChild(ModelInterface $child, $captureTo = null, $append = false)
    {
        if (!$child instanceof AbstractBlock) {
            throw new Exception('not an instance of AbstractBlock', 1);
        }

        $this->setChild($child, $captureTo, $append);

        return $this;
    }

    /**
     * Set child block
     *
     * @param   string $alias
     * @param   AbstractBlock $block
     * @return  AbstractBlock
     */
    public function setChild(AbstractBlock $block, $captureTo = null, $append = false)
    {
        //
        if ($captureTo === null) {
            $captureTo = self::DEFAULT_CAPTURE_TO;
        }

        //
        $block->setCaptureTo($captureTo);

        //
        $block->setParentBlock($this);

        //
        if (null !== $append) {
            $block->setAppend($append);
        }

        //
        $this->__children[$captureTo] = $block;

        return $this;
    }

/**
     * Unset child block
     *
     * @param  string $alias
     * @return Mage_Core_Block_Abstract
     */
    public function unsetChild($alias)
    {
        if (isset($this->__children[$alias])) {
            unset($this->__children[$alias]);
        }

        return $this;
    }

    /**
     * Unset all children blocks
     *
     * @return Mage_Core_Block_Abstract
     */
    public function unsetChildren()
    {
        $this->__children       = array();
        return $this;
    }

    /**
     * Retrieve child block by name
     *
     * @param  string $name
     * @return mixed
     */
    public function getChild($name = '')
    {
        if ($name === '') {
            return $this->__children;
        } elseif (isset($this->__children[$name])) {
            return $this->__children[$name];
        }
        return false;
    }

    /**
     * Return all children.
     *
     * Return specifies an array, but may be any iterable object.
     *
     * @return array
     */
    public function getChildren()
    {
        return $this->__children;
    }

    /**
     * Does the model have any children?
     *
     * @return bool
     */
    public function hasChildren()
    {
        return (0 < count($this->__children));
    }

    /**
     * Set the name of the variable to capture this model to, if it is a child model
     *
     * @param  string $capture
     * @return ViewModel
     */
    public function setCaptureTo($capture)
    {
        $this->__captureTo = (string) $capture;
        return $this;
    }

    /**
     * Get the name of the variable to which to capture this model
     *
     * @return string
     */
    public function captureTo()
    {
        return $this->__captureTo;
    }

    /**
     * Set flag indicating whether or not this is considered a terminal or standalone model
     *
     * @param  bool $terminate
     * @return ViewModel
     */
    public function setTerminal($terminate)
    {
        $this->__terminate = (bool) $terminate;
        return $this;
    }

    /**
     * Is this considered a terminal or standalone model?
     *
     * @return bool
     */
    public function terminate()
    {
        return $this->__terminate;
    }

    /**
     * Set flag indicating whether or not append to child  with the same capture
     *
     * @param  bool $append
     * @return ViewModel
     */
    public function setAppend($append)
    {
        $this->__append = (bool) $append;
        return $this;
    }

    /**
     * Is this append to child  with the same capture?
     *
     * @return bool
     */
    public function isAppend()
    {
        return $this->__append;
    }

    /**
     * Return count of children
     *
     * @return int
     */
    public function count()
    {
        return count($this->__children);
    }

    /**
     * Get iterator of children
     *
     * @return ArrayIterator
     */
    public function getIterator()
    {
        return new ArrayIterator($this->__children);
    }

    /**
     * Set the service manager
     *
     * @param  ServiceLocatorInterface $sm
     * @return $this
     */
    public function setServiceManager(ServiceLocatorInterface $sm)
    {
        $this->__services = $sm;
        return $this;
    }


    /**
     * Retrieve the service manager
     *
     * @return ServiceManager
     */
    public function getServiceManager()
    {
        return $this->__services;
    }

    /**
     * Retrieve parent block
     *
     * @return AbstractBlock
     */
    public function getParentBlock()
    {
        return $this->_parentBlock;
    }

    /**
     * Set parent block
     *
     * @param   AbstractBlock $block
     * @return  AbstractBlock
     */
    public function setParentBlock(AbstractBlock $block)
    {
        $this->__parentBlock = $block;
        return $this;
    }



    /**
     *
     *
     * @return string
     */
    public function toHtml()
    {
        $html = '';

        $this->_prepareLayout();

        $html .= $this->_beforeToHtml();
        $html .= $this->_toHtml();
        $html = $this->_afterToHtml($html);

        return $html;
    }

    /**
     *
     *
     * @return $this
     */
    protected function _prepareLayout()
    {
        return $this;
    }

    /**
     *
     *
     * @return string
     */
    protected function _beforeToHtml()
    {
        return '';
    }

    /**
     *
     *
     * @return string
     */
    protected function _toHtml()
    {
        return '';
    }

    /**
     *
     *
     * @param  string $html
     * @return string
     */
    protected function _afterToHtml($html = '')
    {
        return $html;
    }





    /**
     * Overloading: proxy to variables
     *
//     * Proxies to the attached plugin broker to retrieve, return, and potentially
//     * execute helpers.
     *
//     * * If the helper does not define __invoke, it will be returned
//     * * If the helper does define __invoke, it will be called as a functor
     *
     * @param  string $method
     * @param  array $argv
     * @return mixed
     */
    public function __call($method, $argv)
    {
//        \Zend\Debug::dump('asddefesdefs');
//        \Zend\Debug::dump($method, '$method');
//        \Zend\Debug::dump($argv, '$$argv');
        switch (substr($method, 0, 3)) {
            case 'get' :
                $key = $this->_underscore(substr($method,3));
                if (isset($this->__variables[$key])) {
                    $data = $this->__variables[$key];

//                    ($key == 'value') ? \Zend\Debug::dump($argv, '$$argv'):null;
                    $arg = array_shift($argv);
//                    ($key == 'value') ? \Zend\Debug::dump($argv, '$$argv'):null;
//                    ($key == 'value') ? \Zend\Debug::dump($arg, '$arg'):null;
//                    ($key == 'value') ? \Zend\Debug::dump($data[$arg], '$data[$arg]'):null;
//
                    if (is_string($arg) && isset($data[$arg])) {
                        return $data[$arg];
                    } else {
                        $default = array_shift($argv);
                        if ($default !== null) {
//                            \Zend\Debug::dump($default, '$default');
                            return $default;
//                        } else {
//                            return null;
                        }
                    }

                    return $data;
                }
                return null;

            case 'set' :
                $key = $this->_underscore(substr($method,3));
                $this->__variables[$key] = isset($argv[0]) ? $argv[0] : null;
                return $this;

            case 'uns' :
                $key = $this->_underscore(substr($method,3));
                unset($this->__variables[$key]);
                return $this;

            case 'has' :
                $key = $this->_underscore(substr($method,3));
                return isset($this->__variables[$key]);

            default:
                return null;
        }
    }

    /**
     * Setter/Getter underscore transformation cache
     *
     * @var array
     */
    protected static $_underscoreCache = array();

    /**
     * Converts field names for setters and geters
     *
     * $this->setMyField($value) === $this->setData('my_field', $value)
     * Uses cache to eliminate unneccessary preg_replace
     *
     * @param string $name
     * @return string
     */
    protected function _underscore($name)
    {
        if (isset(self::$_underscoreCache[$name])) {
            return self::$_underscoreCache[$name];
        }

        $result = strtolower(preg_replace('/(.)([A-Z])/', "$1_$2", $name));

        self::$_underscoreCache[$name] = $result;
        return $result;
    }

    protected function _camelize($name)
    {
        return uc_words($name, '');
    }



//    /**
//     * Request object
//     *
//     * @var Zend_Controller_Request_Http
//     */
//    protected $_request;
//
//    /**
//     * Messages block instance
//     *
//     * @var Mage_Core_Block_Messages
//     */
//    protected $_messagesBlock               = null;
//
//
//
//    /**
//     * Array of block sort priority instructions
//     *
//     * @var array
//     */
//    protected $_sortInstructions = array();



    /**
     * Translate block sentence
     *
     * @return string
     */
    public function __()
    {
        $args = func_get_args();

        $expr = array_shift($args);
//        \Zend\Debug::dump($expr);
//        \Zend\Debug::dump($args);
//        $expr = new Mage_Core_Model_Translate_Expr(array_shift($args), $this->getModuleName());
//        array_unshift($args, $expr);
//        return Mage::app()->getTranslator()->translate($args);
        return vsprintf($expr, $args);
    }



//    /**
//     * Get a value from child block by specified key
//     *
//     * @param string $alias
//     * @param string $key
//     * @return mixed
//     */
//    public function getChildData($alias, $key = '')
//    {
//        $child = $this->getChild($alias);
//        if ($child) {
//            return $child->getData($key);
//        }
//    }

}
