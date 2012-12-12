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
//use Zend\Loader\Pluggable;
use Zend\View\HelperPluginManager;
//use Zend\View\HelperBroker;

///**
// * @category   Zend
// * @package    Zend_View
// * @subpackage Model
// * @copyright  Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
// * @license    http://framework.zend.com/license/new-bsd     New BSD License
// */
class Block extends AbstractBlock implements RendererInterface
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
     * @var HelperPluginManager
     */
    private $__helpers;


//    /**
//     * @var array Temporary variable stack; used when variables passed to render()
//     */
//    private $__varsCache = array();

    /**
     *
     * @return string
     */
    protected function _toHtml()
    {
        $children = $this->getChildren();

        foreach ($children as $child) {
            $child->setResolver($this->__templateResolver);
            $child->setServiceManager($this->getServiceManager());
            $child->setHelperPluginManager($this->getHelperPluginManager());
        }

        return $this->render();
    }

    /**
     *
     *
     * @param string $template
     * @param array $values
     *
     * @return string
     */
    public function render($template = null, $values = null)
    {
//        if ($template !== null ) {
//            if (is_string($template)) {
//                // find the script file name using the parent private method
//                $this->setTemplate($template);
//            }

//            unset($template); // remove $name from local scope
//            unset($template); // remove $name from local scope
//        }
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

//        \Zend\Debug\Debug::dump($this->template);

//        while ($this->__template = array_pop($this->__templates)) {
            $this->__file = $this->resolver($this->__template);
//            \Zend\Debug\Debug::dump($this->__file);
            if (!$this->__file) {
                throw new Exception\RuntimeException(sprintf(
                    '%s: Unable to render template "%s"; resolver could not resolve to a file',
                    __METHOD__,
                    $this->template
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

//        if (null !== $name) {
            return $this->__templateResolver->resolve($name, $this);
//        }

//        return $this->__templateResolver;
    }

    /**
     * Set helper plugin manager instance
     *
     * @param  string|HelperPluginManager $helpers
     * @return PhpRenderer
     * @throws Exception\InvalidArgumentException
     */
    public function setHelperPluginManager($helpers)
    {
        if (is_string($helpers)) {
            if (!class_exists($helpers)) {
                throw new Exception\InvalidArgumentException(sprintf(
                    'Invalid helper helpers class provided (%s)',
                    $helpers
                ));
            }
            $helpers = new $helpers();
        }
        if (!$helpers instanceof HelperPluginManager) {
            throw new Exception\InvalidArgumentException(sprintf(
                'Helper helpers must extend Zend\View\HelperPluginManager; got type "%s" instead',
                (is_object($helpers) ? get_class($helpers) : gettype($helpers))
            ));
        }
        $helpers->setRenderer($this);
        $this->__helpers = $helpers;

        return $this;
    }

    /**
     * Get helper plugin manager instance
     *
     * @return HelperPluginManager
     */
    public function getHelperPluginManager()
    {
        if (null === $this->__helpers) {
            $this->setHelperPluginManager(new HelperPluginManager());
        }
        return $this->__helpers;
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
        return $this->getHelperPluginManager()->get($name, $options);
    }

    /**
     * Set child block
     *
     * @param   string $alias
     * @param   Mage_Core_Block_Abstract $block
     * @return  Mage_Core_Block_Abstract
     */
    public function setChild(AbstractBlock $block, $captureTo = null, $append = false)
    {
        //
        $block->setHelperPluginManager($this->getHelperPluginManager());

        //
        return parent::setChild($block, $captureTo, $append);
    }

    /**
     * Retrieve child block HTML
     *
     * @param   string $name
     * @param   boolean $useCache
     * @param   boolean $sorted
     * @return  string
     */
    public function getChildHtml($name = '', $useCache = true, $sorted = false)
    {
        if ($name === '') {
//            if ($sorted) {
//                $children = array();
//                foreach ($this->getSortedChildren() as $childName) {
//                    $children[$childName] = $this->getLayout()->getBlock($childName);
//                }
//            } else {
//                $children = $this->getChild();
//            }
//            $out = '';
//            foreach ($children as $child) {
//                $out .= $this->_getChildHtml($child->getBlockAlias(), $useCache);
//            }
//            return $out;
        } else {
            return $this->_getChildHtml($name, $useCache);
        }
    }

    /**
     * Retrieve child block HTML
     *
     * @param   string $name
     * @param   boolean $useCache
     * @return  string
     */
    protected function _getChildHtml($name, $useCache = true)
    {
        $child = $this->getChild($name);

        if (!$child) {
            $html = '';
        } else {
            $html = $child->toHtml();
        }

        return $html;
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
                    \Zend\Debug\Debug::dump($e->getMessage());
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
}