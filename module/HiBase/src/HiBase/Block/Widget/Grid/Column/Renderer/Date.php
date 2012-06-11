<?php


namespace HiBase\Block\Widget\Grid\Column\Renderer;

//use HiBase\Block\AbstractBlock;
//use HiBase\Block\Widget\Grid\Column\Renderer\ColumnRendererInterface;
//use Zend\View\Renderer\TreeRendererInterface;
//use Zend\View\Resolver\ResolverInterface;
//use Zend\View\Variables;
//use ArrayAccess;
//use Zend\Filter\FilterChain;
//use Zend\View\Resolver\TemplatePathStack;

///**
// * Adminhtml grid item renderer date
// *
// * @category   Mage
// * @package    Mage_Adminhtml
// * @author     Magento Core Team <core@magentocommerce.com>
// */
class Date extends AbstractRenderer
{
    protected $_defaultWidth = 160;
    /**
     * Date format string
     */
    protected static $_format = null;

//    /**
//     * Retrieve date format
//     *
//     * @return string
//     */
//    protected function _getFormat()
//    {
//        $format = $this->getColumn()->getFormat();
//        if (!$format) {
//            if (is_null(self::$_format)) {
//                try {
//                    self::$_format = Mage::app()->getLocale()->getDateFormat(
//                        Mage_Core_Model_Locale::FORMAT_TYPE_MEDIUM
//                    );
//                }
//                catch (Exception $e) {
//                    Mage::logException($e);
//                }
//            }
//            $format = self::$_format;
//        }
//        return $format;
//    }

    /**
     * Renders grid column
     *
     * @param   Varien_Object $row
     * @return  string
     */
    public function render(/*Varien_Object*/ $row)
    {
//        \Zend\Debug::dump($this->getColumn()->getIndex());
//        \Zend\Debug::dump($row->getVariable($this->getColumn()->getIndex()));
        if ($data = $row->getVariable($this->getColumn()->getIndex())) {
//            $format = $this->_getFormat();
//            try {
//                if($this->getColumn()->getGmtoffset()) {
//                    $data = Mage::app()->getLocale()
//                        ->date($data, Varien_Date::DATETIME_INTERNAL_FORMAT)->toString($format);
//                } else {
//                    $data = Mage::getSingleton('core/locale')
//                        ->date($data, Zend_Date::ISO_8601, null, false)->toString($format);
//                }
//            }
//            catch (Exception $e)
//            {
//                if($this->getColumn()->getTimezone()) {
//                    $data = Mage::app()->getLocale()
//                        ->date($data, Varien_Date::DATETIME_INTERNAL_FORMAT)->toString($format);
//                } else {
//                    $data = Mage::getSingleton('core/locale')->date($data, null, null, false)->toString($format);
//                }
//            }
            return $data;
        }
        return $this->getColumn()->getDefault();
    }
}
