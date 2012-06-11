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

use HiBase\Block\AbstractBlock;
use Zend\View\Renderer\RendererInterface;
use Zend\View\Renderer\TreeRendererInterface;
use Zend\View\Resolver\ResolverInterface;
use Zend\View\Variables;
use Zend\View\Exception;
use ArrayAccess;
use Zend\Filter\FilterChain;
use Zend\View\Resolver\TemplatePathStack;
use Zend\Loader\Pluggable;
use Zend\View\HelperBroker;

///**
// * @category   Zend
// * @package    Zend_View
// * @subpackage Model
// * @copyright  Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
// * @license    http://framework.zend.com/license/new-bsd     New BSD License
// */
class Block extends AbstractBlock implements RendererInterface, Pluggable
{
    /**
     * Template resolver
     *
     * @var Resolver
     */
    private $__templateResolver;

    /**
     * @var string Rendered content
     */
    private $__content = '';

    /**
     * Template being rendered
     *
     * @var null|string
     */
    private $__template = null;

    /**
     * Queue of templates to render
     * @var array
     */
    private $__templates = array();

    /**
     * Script file name to execute
     *
     * @var string
     */
    private $__file = null;

    /**
     * @var Zend\Filter\FilterChain
     */
    private $__filterChain;
    /**
     * @var
     */
    private $__helperBroker;

//    /**
//     * @var ArrayAccess|array ArrayAccess or associative array representing available variables
//     */
//    private $__vars;

//    /**
//     * @var array Temporary variable stack; used when variables passed to render()
//     */
//    private $__varsCache = array();


    protected function _toHtml()
    {
        $children = $this->getChildren();

        foreach ($children as $child) {
            $child->setResolver($this->__templateResolver);
            $child->setServiceManager($this->getServiceManager());
            $child->setBroker($this->getBroker());
        }

        return $this->render();
    }

	/**
     *
     * Enter description here ...
     * @param unknown_type $template
     * @param unknown_type $values
     */
    public function render($template = null, $values = null)
    {
        if ($template !== null ) {
            if (is_string($template)) {
                // find the script file name using the parent private method
                $this->setTemplate($template);
            }

            unset($template); // remove $name from local scope
        }
//        $this->asdfasdfasdfasdf = 'asfdasdf';

//        $values = $this->getVariables();
//
//        // Give view model awareness via ViewModel helper
//        $helper = $this->plugin('view_model');
////            \Zend\Debug::dump($helper);
//        $helper->setCurrent($this);
//
//
//
//        $this->__varsCache[] = $this->vars();
//
//        if (null !== $values) {
//            $this->setVars($values);
//        }
//        unset($values);
//
//        // extract all assigned vars (pre-escaped), but not 'this'.
//        // assigns to a double-underscored variable, to prevent naming collisions
//        $__vars = $this->vars()->getArrayCopy();
//////        if (array_key_exists('this', $__vars)) {
//////            unset($__vars['this']);
//////        }
////
//        \Zend\Debug::dump((array)$this->getVariables());
//        \Zend\Debug::dump($this->getVariables());
//        \Zend\Debug::dump(array_keys((array)$this->getVariables()));
//        \Zend\Debug::dump(extract((array)$this->getVariables()));
//        extract((array)$this->getVariables());
//        unset($__vars); // remove $__vars from local scope

//        \Zend\Debug::dump($this->__templates);

//        while ($this->__template = array_pop($this->__templates)) {
            $this->__file = $this->resolver($this->template);
//            \Zend\Debug::dump($this->__file);
            if (!$this->__file) {
                throw new Exception\RuntimeException(sprintf(
                    '%s: Unable to render template "%s"; resolver could not resolve to a file',
                    __METHOD__,
                    $this->__template
                ));
            }
            ob_start();
            include $this->__file;
            $this->__content = ob_get_clean();
//        }

//        $this->setVars(array_pop($this->__varsCache));
        return $this->getFilterChain()->filter($this->__content); // filter output
    }

/**
     * Return the template engine object, if any
     *
     * If using a third-party template engine, such as Smarty, patTemplate,
     * phplib, etc, return the template engine object. Useful for calling
     * methods on these objects, such as for setting filters, modifiers, etc.
     *
     * @return mixed
     */
    public function getEngine()
    {
        return $this;
    }

    /**
     * Set script resolver
     *
     * @param  Resolver $resolver
     * @return PhpRenderer
     * @throws Exception\InvalidArgumentException
     */
    public function setResolver(ResolverInterface $resolver)
    {
//        \HiBase\Debug::precho($resolver, '$resolver');
        $this->__templateResolver = $resolver;
        return $this;
    }

    /**
     * Retrieve template name or template resolver
     *
     * @param  null|string $name
     * @return string|Resolver
     */
    public function resolver($name = null)
    {
        if (null === $this->__templateResolver) {
            $this->setResolver(new TemplatePathStack());
        }

        if (null !== $name) {
            return $this->__templateResolver->resolve($name, $this);
        }

        return $this->__templateResolver;
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
//        \HiBase\Debug::precho('dada');;
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
     * Set child block
     *
     * @param   string $alias
     * @param   Mage_Core_Block_Abstract $block
     * @return  Mage_Core_Block_Abstract
     */
    public function setChild(Block $block, $alias = null)
    {
        $block->setBroker($this->getBroker());
//        $block->setResolver($this->getResolver());

        parent::setChild($block, $alias);

        return $this;
    }

    /**
     * Add a template to the stack
     *
     * @param  string $template
     * @return PhpRenderer
     */
    public function addTemplate($template)
    {
        $this->__templates[] = $template;
        return $this;
    }

///**
//     * Set variable storage
//     *
//     * Expects either an array, or an object implementing ArrayAccess.
//     *
//     * @param  array|ArrayAccess $variables
//     * @return PhpRenderer
//     * @throws Exception\InvalidArgumentException
//     */
//    public function setVars($variables)
//    {

//
//        if (!is_array($variables) && !$variables instanceof ArrayAccess) {
//            throw new Exception\InvalidArgumentException(sprintf(
//                'Expected array or ArrayAccess object; received "%s"',
//                (is_object($variables) ? get_class($variables) : gettype($variables))
//            ));
//        }
//
//        // Enforce a Variables container
//        if (!$variables instanceof Variables) {
//            $variablesAsArray = array();
//            foreach ($variables as $key => $value) {
//                $variablesAsArray[$key] = $value;
//            }
//            $variables = new Variables($variablesAsArray);
//        }
//
//        $this->__vars = $variables;
//        return $this;
//    }

//    /**
//     * Get a single variable, or all variables
//     *
//     * @param  mixed $key
//     * @return mixed
//     */
//    public function vars($key = null)
//    {
//        if (null === $this->__vars) {
//            $this->setVars(new Variables());
//        }
//
//        if (null === $key) {
//            return $this->__vars;
//        }
//        return $this->__vars[$key];
//    }
//
//    /**
//     * Get a single variable
//     *
//     * @param  mixed $key
//     * @return mixed
//     */
//    public function get($key)
//    {
////        \Zend\Debug::dump('dada');
//        if (null === $this->__vars) {
//            $this->setVars(new Variables());
//        }
//
//        return $this->__vars[$key];
//    }
//
//    /**
//     * Overloading: proxy to Variables container
//     *
//     * @param  string $name
//     * @return mixed
//     */
//    public function __get($name)
//    {
////        \Zend\Debug::dump('dada');
//        $vars = $this->vars();
//        return $vars[$name];
//    }
//
//    /**
//     * Overloading: proxy to Variables container
//     *
//     * @param  string $name
//     * @param  mixed $value
//     * @return void
//     */
//    public function __set($name, $value)
//    {
////        \Zend\Debug::dump('dada');
//        $vars = $this->vars();
//        $vars[$name] = $value;
//    }
//
//    /**
//     * Overloading: proxy to Variables container
//     *
//     * @param  string $name
//     * @return bool
//     */
//    public function __isset($name)
//    {
//        $vars = $this->vars();
//        return isset($vars[$name]);
//    }
//
//    /**
//     * Overloading: proxy to Variables container
//     *
//     * @param  string $name
//     * @return void
//     */
//    public function __unset($name)
//    {
//        $vars = $this->vars();
//        if (!isset($vars[$name])) {
//            return;
//        }
//        unset($vars[$name]);
//    }


//    /**
//     * Property overloading: get variable value
//     *
//     * @param  string $name
//     * @return mixed
//     */
    public function __get($name)
    {
//        \Zend\Debug::dump($name);
        if (!$this->__isset($name)) {
            if ($child = $this->getChild($name)) {
                return $child->toHtml();
            }
            return null;
        }
//
        $variables = $this->getVariables();
        return $variables[$name];
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
//        \Zend\Debug::dump('asddefesdefs');
//        \Zend\Debug::dump($method, '$method');
//        \Zend\Debug::dump($argv, '$argv');
        switch (substr($method, 0, 3)) {
            case 'get' :
            case 'set' :
            case 'uns' :
            case 'has' :
                return parent::__call($method, $argv);

            default:
                $helper = null;
                try {
                    $helper = $this->plugin($method);
//                    \Zend\Debug::dump(is_callable($helper), 'is_callable($helper)');
//                    \Zend\Debug::dump(call_user_func_array($helper, $argv), 'call_user_func_array($helper, $argv)');
                    if (is_callable($helper)) {
//                        \Zend\Debug::dump(call_user_func_array($helper, $argv), 'call_user_func_array($helper, $argv)');
                        return call_user_func_array($helper, $argv);
                    }
                }
                catch (\Exception $e) {
                    \Zend\Debug::dump($e->getMessage());
                }
                return $helper;
        }
    }

    /**
     * Set filter chain
     *
     * @param  FilterChain $filters
     * @return PhpRenderer
     */
    public function setFilterChain(FilterChain $filters)
    {
        $this->__filterChain = $filters;
        return $this;
    }

    /**
     * Retrieve filter chain for post-filtering script content
     *
     * @return FilterChain
     */
    public function getFilterChain()
    {
        if (null === $this->__filterChain) {
            $this->setFilterChain(new FilterChain());
        }
        return $this->__filterChain;
    }

/**
     * Make sure View variables are cloned when the view is cloned.
     *
     * @return PhpRenderer
     */
    public function __clone()
    {
        $this->__vars = clone $this->vars();
    }
}