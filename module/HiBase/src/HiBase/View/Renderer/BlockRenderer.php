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
// * @subpackage Renderer
// * @copyright  Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
// * @license    http://framework.zend.com/license/new-bsd     New BSD License
// */

namespace HiBase\View\Renderer;

use ArrayAccess;
use Zend\View\Variables;
use Zend\View\Exception;
//use JsonSerializable,
//    Traversable,
//    Zend\Json\Json,
//    Zend\Stdlib\ArrayUtils,
//    Zend\View\Exception,
use Zend\View\Model\ModelInterface as Model;
//    Zend\View\Model\ViewModel;
use Zend\Filter\FilterChain;
//    Zend\Loader\Pluggable,
use Zend\View\HelperPluginManager;
use HiBase\Block\Block;
use Zend\View\Resolver\TemplatePathStack;
//    Zend\View\Renderer\RendererInterface as Renderer,
//    Zend\View\Resolver\ResolverInterface as Resolver,
//use Zend\Loader\Pluggable;
use Zend\View\Renderer\RendererInterface;
use Zend\View\Renderer\TreeRendererInterface;
use Zend\View\Resolver\ResolverInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

///**
// * JSON renderer
// *
// * @category   Zend
// * @package    Zend_View
// * @subpackage Renderer
// * @copyright  Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
// * @license    http://framework.zend.com/license/new-bsd     New BSD License
// */
class BlockRenderer implements RendererInterface, TreeRendererInterface
{
    /**
     * @var \Zend\ServiceManager\ServiceManager
     */
    protected $services;

    /**
     * @var bool Whether or not to render trees of view models
     */
    private $renderTrees = true;

    /**
     * Template resolver
     *
     * @var Resolver
     */
    private $templateResolver;

    /**
     * Helper broker
     *
     * @var HelperBroker
     */
    private $helpers;

///**
//     * Set script resolver
//     *
//     * @param  Resolver $resolver
//     * @return PhpRenderer
//     * @throws Exception\InvalidArgumentException
//     */
    public function setServiceManager(ServiceLocatorInterface $sm)
    {
//        \HiBase\Debug::precho($resolver, '$resolver');
        $this->services = $sm;
        return $this;
    }

///**
//     * Set script resolver
//     *
//     * @param  Resolver $resolver
//     * @return PhpRenderer
//     * @throws Exception\InvalidArgumentException
//     */
    public function getServiceManager()
    {
        return $this->services;
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
        $this->templateResolver = $resolver;
        return $this;
    }

    /**
     *
     *
     * @param Block $block
     * @param unknown_type $values
     */
    public function render($block, $values = null)
    {
        //
        if ($block instanceof Block) {

            //
            $block->setHelperPluginManager($this->getHelperPluginManager());

            //
            $block->setResolver($this->templateResolver);

            //
            $block->setServiceManager($this->services);

            //
            $return = $block->toHtml();

            //
            return $return;
        }

        //
        return '';
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
        $this->helpers = $helpers;

        return $this;
    }

    /**
     * Get helper plugin manager instance
     *
     * @return HelperPluginManager
     */
    public function getHelperPluginManager()
    {
        if (null === $this->helpers) {
            $this->setHelperPluginManager(new HelperPluginManager());
        }
        return $this->helpers;
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
     * Set flag indicating whether or not we should render trees of view models
     *
     * If set to true, the View instance will not attempt to render children
     * separately, but instead pass the root view model directly to the PhpRenderer.
     * It is then up to the developer to render the children from within the
     * view script.
     *
     * @param  bool $renderTrees
     * @return PhpRenderer
     */
    public function setCanRenderTrees($renderTrees)
    {
        $this->renderTrees = (bool) $renderTrees;
        return $this;
    }

    /**
     * Can we render trees, or are we configured to do so?
     *
     * @return bool
     */
    public function canRenderTrees()
    {
        return $this->renderTrees;
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
        $helper = $this->plugin($method);
        if (is_callable($helper)) {
            return call_user_func_array($helper, $argv);
        }
        return $helper;
    }


}
