<?php


namespace HiBase\Block\Widget\Grid\Column\Renderer;

//use HiBase\Block\Widget\Grid\Column\Renderer\AbstractRenderer;
//use Zend\View\Renderer\RendererInterface;
//use Zend\View\Renderer\TreeRendererInterface;
//use Zend\View\Resolver\ResolverInterface;
//use Zend\View\Variables;
//use ArrayAccess;
//use Zend\Filter\FilterChain;
//use Zend\View\Resolver\TemplatePathStack;

///**
// * @category   Zend
// * @package    Zend_View
// * @subpackage Model
// * @copyright  Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
// * @license    http://framework.zend.com/license/new-bsd     New BSD License
// */
class Text extends AbstractRenderer
{
//class Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Text
//    extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
//{
//    /**
//     * Format variables pattern
//     *
//     * @var string
//     */
//    protected $_variablePattern = '/\\$([a-z0-9_]+)/i';
//
//    /**
//     * Renders grid column
//     *
//     * @param Varien_Object $row
//     * @return mixed
//     */
//    public function _getValue(Varien_Object $row)
//    {
//        $format = ( $this->getColumn()->getFormat() ) ? $this->getColumn()->getFormat() : null;
//        $defaultValue = $this->getColumn()->getDefault();
//        if (is_null($format)) {
//            // If no format and it column not filtered specified return data as is.
//            $data = parent::_getValue($row);
//            $string = is_null($data) ? $defaultValue : $data;
//            return $this->escapeHtml($string);
//        }
//        elseif (preg_match_all($this->_variablePattern, $format, $matches)) {
//            // Parsing of format string
//            $formattedString = $format;
//            foreach ($matches[0] as $matchIndex=>$match) {
//                $value = $row->getData($matches[1][$matchIndex]);
//                $formattedString = str_replace($match, $value, $formattedString);
//            }
//            return $formattedString;
//        } else {
//            return $this->escapeHtml($format);
//        }
//    }
}
