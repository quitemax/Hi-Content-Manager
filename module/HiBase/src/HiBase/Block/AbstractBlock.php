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
use Zend\View\Model\ModelInterface;

use Zend\View\Exception;

use Zend\View\Renderer\RendererInterface;
use Zend\View\Renderer\TreeRendererInterface;
use Zend\View\Resolver\ResolverInterface;
use Zend\View\Variables;
use ArrayAccess;
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
abstract class AbstractBlock extends ViewModel
{
    /**
     * @var \Zend\ServiceManager\ServiceManager
     */
    protected $services;

    /**
     * Short alias of this block that was refered from parent
     *
     * @var string
     */
    protected $_alias;

    /**
     * Suffix for name of anonymous block
     *
     * @var string
     */
    protected $_anonSuffix;

    /**
     * Sorted children list
     *
     * @var array
     */
    protected $_sortedChildren              = array();

    /**
     * Children blocks HTML cache array
     *
     * @var array
     */
    protected $_childrenHtmlCache           = array();

    /**
     * Arbitrary groups of child blocks
     *
     * @var array
     */
    protected $_childGroups                 = array();

    /**
     * Request object
     *
     * @var Zend_Controller_Request_Http
     */
    protected $_request;

    /**
     * Messages block instance
     *
     * @var Mage_Core_Block_Messages
     */
    protected $_messagesBlock               = null;

//    /**
//     * Whether this block was not explicitly named
//     *
//     * @var boolean
//     */
//    protected $_isAnonymous                 = false;

    /**
     * Parent block
     *
     * @var Mage_Core_Block_Abstract
     */
    protected $_parentBlock;

//    /**
//     * Block html frame open tag
//     * @var string
//     */
//    protected $_frameOpenTag;
//
//    /**
//     * Block html frame close tag
//     * @var string
//     */
//    protected $_frameCloseTag;
//
//    /**
//     * Url object
//     *
//     * @var Mage_Core_Model_Url
//     */
//    protected static $_urlModel;
//
//    /**
//     * @var Varien_Object
//     */
//    private static $_transportObject;

    /**
     * Array of block sort priority instructions
     *
     * @var array
     */
    protected $_sortInstructions = array();

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
     * Add a child model
     *
     * @param  ModelInterface $child
     * @param  null|string $captureTo Optional; if specified, the "capture to" value to set on the child
     * @return ViewModel
     */
    public function addChild(ModelInterface $child, $captureTo = null)
    {
        if (!$child instanceof AbstractBlock) {
            throw new Exception('not an instance of AbstractBlock', 1);
        }

        $this->setChild($child, $captureTo);

        return $this;
    }

    /**
     * Set child block
     *
     * @param   string $alias
     * @param   Mage_Core_Block_Abstract $block
     * @return  Mage_Core_Block_Abstract
     */
    public function setChild(AbstractBlock $block, $alias = null)
    {
        //
        if ($alias === null) {
            $alias = 'content';
        }

        //
//        $block->setBroker($this->getBroker());


        $block->setParentBlock($this);


        $block->setBlockAlias($alias);



        $block->setCaptureTo($alias);

        $this->children[$alias] = $block;

//        \Zend\Debug::dump($this->children);

//        if ($block->getIsAnonymous()) {
//            $suffix = $block->getAnonSuffix();
//            if (empty($suffix)) {
//                $suffix = 'child' . sizeof($this->children);
//            }
//            $blockName = $this->getNameInLayout() . '.' . $suffix;
//
//            if ($this->getLayout()) {
//                $this->getLayout()->unsetBlock($block->getNameInLayout())
//                    ->setBlock($blockName, $block);
//            }
//
//            $block->setNameInLayout($blockName);
//            $block->setIsAnonymous(false);
//
//            if (empty($alias)) {
//                $alias = $blockName;
//            }
//        }


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
        if (isset($this->children[$alias])) {
            unset($this->children[$alias]);
            $key = array_search($name, $this->_sortedChildren);
            if ($key !== false) {
                unset($this->_sortedChildren[$key]);
            }
        }

        return $this;
    }

//    /**
//     * Call a child and unset it, if callback matched result
//     *
//     * $params will pass to child callback
//     * $params may be array, if called from layout with elements with same name, for example:
//     * ...<foo>value_1</foo><foo>value_2</foo><foo>value_3</foo>
//     *
//     * Or, if called like this:
//     * ...<foo>value_1</foo><bar>value_2</bar><baz>value_3</baz>
//     * - then it will be $params1, $params2, $params3
//     *
//     * It is no difference anyway, because they will be transformed in appropriate way.
//     *
//     * @param string $alias
//     * @param string $callback
//     * @param mixed $result
//     * @param array $params
//     * @return Mage_Core_Block_Abstract
//     */
//    public function unsetCallChild($alias, $callback, $result, $params)
//    {
//        $child = $this->getChild($alias);
//        if ($child) {
//            $args     = func_get_args();
//            $alias    = array_shift($args);
//            $callback = array_shift($args);
//            $result   = (string)array_shift($args);
//            if (!is_array($params)) {
//                $params = $args;
//            }
//
//            if ($result == call_user_func_array(array(&$child, $callback), $params)) {
//                $this->unsetChild($alias);
//            }
//        }
//        return $this;
//    }

    /**
     * Unset all children blocks
     *
     * @return Mage_Core_Block_Abstract
     */
    public function unsetChildren()
    {
        $this->children       = array();
        $this->_sortedChildren = array();
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
            return $this->children;
        } elseif (isset($this->children[$name])) {
            return $this->children[$name];
        }
        return false;
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

//    /**
//     * @param string $name          Parent block name
//     * @param string $childName     OPTIONAL Child block name
//     * @param bool $useCache        OPTIONAL Use cache flag
//     * @param bool $sorted          OPTIONAL @see getChildHtml()
//     * @return string
//     */
//    public function getChildChildHtml($name, $childName = '', $useCache = true, $sorted = false)
//    {
//        if (empty($name)) {
//            return '';
//        }
//        $child = $this->getChild($name);
//        if (!$child) {
//            return '';
//        }
//        return $child->getChildHtml($childName, $useCache, $sorted);
//    }
//
//    /**
//     * Obtain sorted child blocks
//     *
//     * @return array
//     */
//    public function getSortedChildBlocks()
//    {
//        $children = array();
//        foreach ($this->getSortedChildren() as $childName) {
//            $children[$childName] = $this->getLayout()->getBlock($childName);
//        }
//        return $children;
//    }

    /**
     * Retrieve child block HTML
     *
     * @param   string $name
     * @param   boolean $useCache
     * @return  string
     */
    protected function _getChildHtml($name, $useCache = true)
    {
        if ($useCache && isset($this->_childrenHtmlCache[$name])) {
            return $this->_childrenHtmlCache[$name];
        }

        $child = $this->getChild($name);

        if (!$child) {
            $html = '';
        } else {
//            $this->_beforeChildToHtml($name, $child);
            $html = $child->toHtml();
        }

        $this->_childrenHtmlCache[$name] = $html;
        return $html;
    }

//    /**
//     * Prepare child block before generate html
//     *
//     * @param   string $name
//     * @param   Mage_Core_Block_Abstract $child
//     */
//    protected function _beforeChildToHtml($name, $child)
//    {
//    }
//
//    /**
//     * Retrieve block html
//     *
//     * @param   string $name
//     * @return  string
//     */
//    public function getBlockHtml($name)
//    {
//        if (!($layout = $this->getLayout()) && !($layout = $this->getAction()->getLayout())) {
//            return '';
//        }
//        if (!($block = $layout->getBlock($name))) {
//            return '';
//        }
//        return $block->toHtml();
//    }

    /**
     * Insert child block
     *
     * @param   Mage_Core_Block_Abstract|string $block
     * @param   string $siblingName
     * @param   boolean $after
     * @param   string $alias
     * @return  object $this
     */
    public function insert($block, $siblingName = '', $after = false, $alias = '')
    {
//        if (is_string($block)) {
//            $block = $this->getLayout()->getBlock($block);
//        }
//        if (!$block) {
//            /*
//             * if we don't have block - don't throw exception because
//             * block can simply removed using layout method remove
//             */
//            //Mage::throwException(Mage::helper('core')->__('Invalid block name to set child %s: %s', $alias, $block));
//            return $this;
//        }
//        if ($block->getIsAnonymous()) {
//            $this->setChild('', $block);
//            $name = $block->getNameInLayout();
//        } elseif ('' != $alias) {
//            $this->setChild($alias, $block);
//            $name = $block->getNameInLayout();
//        } else {
//            $name = $block->getNameInLayout();
//            $this->setChild($name, $block);
//        }
//
//        if ($siblingName === '') {
//            if ($after) {
//                array_push($this->_sortedChildren, $name);
//            } else {
//                array_unshift($this->_sortedChildren, $name);
//            }
//        } else {
//            $key = array_search($siblingName, $this->_sortedChildren);
//            if (false !== $key) {
//                if ($after) {
//                    $key++;
//                }
//                array_splice($this->_sortedChildren, $key, 0, $name);
//            } else {
//                if ($after) {
//                    array_push($this->_sortedChildren, $name);
//                } else {
//                    array_unshift($this->_sortedChildren, $name);
//                }
//            }
//
//            $this->_sortInstructions[$name] = array($siblingName, (bool)$after, false !== $key);
//        }

        return $this;
    }

    /**
     * Sort block's children
     *
     * @param boolean $force force re-sort all children
     * @return Mage_Core_Block_Abstract
     */
    public function sortChildren($force = false)
    {
//        foreach ($this->_sortInstructions as $name => $list) {
//            list($siblingName, $after, $exists) = $list;
//            if ($exists && !$force) {
//                continue;
//            }
//            $this->_sortInstructions[$name][2] = true;
//
//            $index      = array_search($name, $this->_sortedChildren);
//            $siblingKey = array_search($siblingName, $this->_sortedChildren);
//
//            if ($index === false || $siblingKey === false) {
//                continue;
//            }
//
//            if ($after) {
//                // insert after block
//                if ($index == $siblingKey + 1) {
//                    continue;
//                }
//                // remove sibling from array
//                array_splice($this->_sortedChildren, $index, 1, array());
//                // insert sibling after
//                array_splice($this->_sortedChildren, $siblingKey + 1, 0, array($name));
//            } else {
//                // insert before block
//                if ($index == $siblingKey - 1) {
//                    continue;
//                }
//                // remove sibling from array
//                array_splice($this->_sortedChildren, $index, 1, array());
//                // insert sibling after
//                array_splice($this->_sortedChildren, $siblingKey, 0, array($name));
//            }
//        }

        return $this;
    }

    /**
     * Append child block
     *
     * @param   Mage_Core_Block_Abstract|string $block
     * @param   string $alias
     * @return  Mage_Core_Block_Abstract
     */
    public function append($block, $alias = '')
    {
        $this->insert($block, '', true, $alias);
        return $this;
    }

//    /**
//     * Make sure specified block will be registered in the specified child groups
//     *
//     * @param string $groupName
//     * @param Mage_Core_Block_Abstract $child
//     */
//    public function addToChildGroup($groupName, Mage_Core_Block_Abstract $child)
//    {
//        if (!isset($this->_childGroups[$groupName])) {
//            $this->_childGroups[$groupName] = array();
//        }
//        if (!in_array($child->getBlockAlias(), $this->_childGroups[$groupName])) {
//            $this->_childGroups[$groupName][] = $child->getBlockAlias();
//        }
//    }
//
//    /**
//     * Add self to the specified group of parent block
//     *
//     * @param string $groupName
//     * @return Mage_Core_Block_Abstract
//     */
//    public function addToParentGroup($groupName)
//    {
//        $this->getParentBlock()->addToChildGroup($groupName, $this);
//        return $this;
//    }
//
//    /**
//     * Get a group of child blocks
//     *
//     * Returns an array of <alias> => <block>
//     * or an array of <alias> => <callback_result>
//     * The callback currently supports only $this methods and passes the alias as parameter
//     *
//     * @param string $groupName
//     * @param string $callback
//     * @param bool $skipEmptyResults
//     * @return array
//     */
//    public function getChildGroup($groupName, $callback = null, $skipEmptyResults = true)
//    {
//        $result = array();
//        if (!isset($this->_childGroups[$groupName])) {
//            return $result;
//        }
//        foreach ($this->getSortedChildBlocks() as $block) {
//            $alias = $block->getBlockAlias();
//            if (in_array($alias, $this->_childGroups[$groupName])) {
//                if ($callback) {
//                    $row = $this->$callback($alias);
//                    if (!$skipEmptyResults || $row) {
//                        $result[$alias] = $row;
//                    }
//                } else {
//                    $result[$alias] = $block;
//                }
//
//            }
//        }
//        return $result;
//    }
//
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




    /**
     * Returns block alias
     *
     * @return string
     */
    public function getBlockAlias()
    {
        return $this->_alias;
    }

    /**
     * Set block alias
     *
     * @param string $alias
     * @return Mage_Core_Block_Abstract
     */
    public function setBlockAlias($alias)
    {
        $this->_alias = $alias;
        return $this;
    }

    /**
     * Retrieve parent block
     *
     * @return Mage_Core_Block_Abstract
     */
    public function getParentBlock()
    {
        return $this->_parentBlock;
    }

    /**
     * Set parent block
     *
     * @param   Mage_Core_Block_Abstract $block
     * @return  Mage_Core_Block_Abstract
     */
    public function setParentBlock(AbstractBlock $block)
    {
        $this->_parentBlock = $block;
        return $this;
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
//        \Zend\Debug::dump($argv, '$$argv');
        switch (substr($method, 0, 3)) {
            case 'get' :
                $key = $this->_underscore(substr($method,3));
                if (isset($this->variables[$key])) {
                    $data = $this->variables[$key];
                    return $data;
                }
                return null;

            case 'set' :
                $key = $this->_underscore(substr($method,3));
                $this->variables[$key] = isset($args[0]) ? $args[0] : null;
                return $this;

            case 'uns' :
                $key = $this->_underscore(substr($method,3));
                unset($this->variables[$key]);
                return $this;

            case 'has' :
                $key = $this->_underscore(substr($method,3));
                return isset($this->variables[$key]);

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
}
