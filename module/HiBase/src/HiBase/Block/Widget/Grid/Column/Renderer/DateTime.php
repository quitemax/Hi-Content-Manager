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
// * Adminhtml grid item renderer datetime
// *
// * @category   Mage
// * @package    Mage_Adminhtml
// * @author     Magento Core Team <core@magentocommerce.com>
// */
class DateTime extends AbstractRenderer
{
    /**
     * Date format string
     */
    protected static $_format = null;

    /**
     * Retrieve datetime format
     *
     * @return unknown
     */
    protected function _getFormat()
    {
        $format = $this->getColumn()->getFormat();
        if (!$format) {
            if (is_null(self::$_format)) {
//                try {
//                    self::$_format = Mage::app()->getLocale()->getDateTimeFormat(
//                        Mage_Core_Model_Locale::FORMAT_TYPE_MEDIUM
//                    );
//                }
//                catch (Exception $e) {
//                    Mage::logException($e);
//                }
            }
            $format = self::$_format;
        }
        return $format;
    }

    /**
     * Renders grid column
     *
     * @param   Varien_Object $row
     * @return  string
     */
    public function render(/*Varien_Object*/ $row)
    {
        if ($data = $this->_getValue($row)) {
            $format = $this->_getFormat();
//            \Zend\Debug::dump($format, '$format');
//            try {
//                $data = Mage::app()->getLocale()
//                    ->date($data, Varien_Date::DATETIME_INTERNAL_FORMAT)->toString($format);
//            }
//            catch (Exception $e)
//            {
//                $data = Mage::app()->getLocale()
//                    ->date($data, Varien_Date::DATETIME_INTERNAL_FORMAT)->toString($format);
//            }
            return $data;
        }
        return $this->getColumn()->getDefault();
    }
}
