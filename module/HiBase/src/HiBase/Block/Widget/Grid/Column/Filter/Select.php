<?php
namespace HiBase\Block\Widget\Grid\Column\Filter;

//use HiBase\Block\AbstractBlock;

///**
// * Select grid column filter
// *
// * @category   Mage
// * @package    Mage_Adminhtml
// * @author      Magento Core Team <core@magentocommerce.com>
// */
class Select extends AbstractFilter
{

    protected function _getOptions()
    {
//        $emptyOption = array('value' => null, 'label' => '');
//
//        $optionGroups = $this->getColumn()->getOptionGroups();
//        if ($optionGroups) {
//            array_unshift($optionGroups, $emptyOption);
//            return $optionGroups;
//        }
//
//        $colOptions = $this->getColumn()->getOptions();
//        if (!empty($colOptions) && is_array($colOptions) ) {
//            $options = array($emptyOption);
//            foreach ($colOptions as $value => $label) {
//                $options[] = array('value' => $value, 'label' => $label);
//            }
//            return $options;
//        }
        return array();
    }

    /**
     * Render an option with selected value
     *
     * @param array $option
     * @param string $value
     * @return string
     */
    protected function _renderOption($option, $value)
    {
//        $selected = (($option['value'] == $value && (!is_null($value))) ? ' selected="selected"' : '' );
//        return '<option value="'. $this->escapeHtml($option['value']).'"'.$selected.'>'.$this->escapeHtml($option['label']).'</option>';
    }

    public function getHtml()
    {
//        $html = '<select name="'.$this->_getHtmlName().'" id="'.$this->_getHtmlId().'" class="no-changes">';
//        $value = $this->getValue();
//        foreach ($this->_getOptions() as $option){
//            if (is_array($option['value'])) {
//                $html .= '<optgroup label="' . $this->escapeHtml($option['label']) . '">';
//                foreach ($option['value'] as $subOption) {
//                    $html .= $this->_renderOption($subOption, $value);
//                }
//                $html .= '</optgroup>';
//            } else {
//                $html .= $this->_renderOption($option, $value);
//            }
//        }
//        $html.='</select>';
//        return $html;
    }

    public function getCondition()
    {
//        if (is_null($this->getValue())) {
//            return null;
//        }
//        return array('eq' => $this->getValue());
    }

}
