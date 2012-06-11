<?php


namespace HiBase\Block\Widget\Grid\Column\Renderer;

//use HiBase\Block\Widget\Grid\Column\Renderer\AbstractRenderer;
use HiBase\Block\Widget\Button;
//use Zend\View\Renderer\RendererInterface;
//use Zend\View\Renderer\TreeRendererInterface;
//use Zend\View\Resolver\ResolverInterface;
//use Zend\View\Variables;
//use ArrayAccess;
//use Zend\Filter\FilterChain;
//use Zend\View\Resolver\TemplatePathStack;

///**
// * Grid column widget for rendering action grid cells
// *
// * @category   Mage
// * @package    Mage_Adminhtml
// * @author     Magento Core Team <core@magentocommerce.com>
// */
class Action extends Text
{

    /**
     * Renders column
     *
     * @param Varien_Object $row
     * @return string
     */
    public function render(/*Varien_Object*/ $row)
    {
        $actions = $this->getColumn()->getActions();
        if ( empty($actions) || !is_array($actions) ) {
            return '&nbsp;';
        }

//        \Zend\Debug::dump($actions);

         $out = '';
//
//        if(sizeof($actions)==1 && !$this->getColumn()->getNoLink()) {
            foreach ($actions as $action) {
                if (isset($action['url'])/* && is_array($action['url'])*/) {

                    $url = $action['url'];
                    $urlId = '';

                    if (isset($action['field'])/* && is_array($action['url'])*/) {
                        $field = $action['field'];
                        $urlId = $row->$field;
                    }

                    $url .= $urlId;


//
//                    \Zend\Debug::dump($urlRoute);
//                    \Zend\Debug::dump($urlParams);
//                    \Zend\Debug::dump($this->url($urlRoute, $urlParams));
//
                    if (isset($action['onclick'])) {
                        $action['onclick'] .= 'setLocation(\'' . $url . '\');';
                    } else {
                        $action['onclick'] = 'setLocation(\'' . $url . '\');';
                    }
                }


                $button = new Button($action);
                $out .= $button->toHtml();
            }
//        }
//
//        $out = '<select class="action-select" onchange="varienGridAction.execute(this);">'
//             . '<option value=""></option>';
//        $i = 0;
//        foreach ($actions as $action){
//            $i++;
//            if ( is_array($action) ) {
//                $out .= $this->_toOptionHtml($action, $row);
//            }
//        }
//        $out .= '</select>';
        return $out;
    }

    /**
     * Render single action as dropdown option html
     *
     * @param unknown_type $action
     * @param Varien_Object $row
     * @return string
     */
    protected function _toOptionHtml($action, /*Varien_Object */$row)
    {
//        $actionAttributes = new Varien_Object();
//
//        $actionCaption = '';
//        $this->_transformActionData($action, $actionCaption, $row);
//
//        $htmlAttibutes = array('value'=>$this->escapeHtml(Mage::helper('core')->jsonEncode($action)));
//        $actionAttributes->setData($htmlAttibutes);
//        return '<option ' . $actionAttributes->serialize() . '>' . $actionCaption . '</option>';
    }

    /**
     * Render single action as link html
     *
     * @param array $action
     * @param Varien_Object $row
     * @return string
     */
    protected function _toLinkHtml($action, /*Varien_Object*/ $row)
    {
//        $actionAttributes = new Varien_Object();
//
//        $actionCaption = '';
//        $this->_transformActionData($action, $actionCaption, $row);
//
//        if(isset($action['confirm'])) {
//            $action['onclick'] = 'return window.confirm(\''
//                               . addslashes($this->escapeHtml($action['confirm']))
//                               . '\')';
//            unset($action['confirm']);
//        }
//
//        $actionAttributes->setData($action);
//        return '<a ' . $actionAttributes->serialize() . '>' . $actionCaption . '</a>';
    }

    /**
     * Prepares action data for html render
     *
     * @param array $action
     * @param string $actionCaption
     * @param Varien_Object $row
     * @return Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Action
     */
    protected function _transformActionData(&$action, &$actionCaption, /*Varien_Object*/ $row)
    {
//        foreach ( $action as $attribute => $value ) {
//            if(isset($action[$attribute]) && !is_array($action[$attribute])) {
//                $this->getColumn()->setFormat($action[$attribute]);
//                $action[$attribute] = parent::render($row);
//            } else {
//                $this->getColumn()->setFormat(null);
//            }
//
//            switch ($attribute) {
//                case 'caption':
//                    $actionCaption = $action['caption'];
//                    unset($action['caption']);
//                       break;
//
//                case 'url':
//                    if(is_array($action['url'])) {
//                        $params = array($action['field']=>$this->_getValue($row));
//                        if(isset($action['url']['params'])) {
//                            $params = array_merge($action['url']['params'], $params);
//                        }
//                        $action['href'] = $this->getUrl($action['url']['base'], $params);
//                        unset($action['field']);
//                    } else {
//                        $action['href'] = $action['url'];
//                    }
//                    unset($action['url']);
//                       break;
//
//                case 'popup':
//                    $action['onclick'] =
//                        'popWin(this.href,\'_blank\',\'width=800,height=700,resizable=1,scrollbars=1\');return false;';
//                    break;
//
//            }
//        }
//        return $this;
    }
}
