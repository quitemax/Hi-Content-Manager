<?php
class HiZend_Debug extends Zend_Debug
{
    public static function precho($var, $label=null, $echo=true)
    {   
        //   
        $debug_backtrace = debug_backtrace();
        
        //
        ob_start();
        
        //
        echo 'Debug called from :<br />';
        foreach ($debug_backtrace as $backtrace) {
            echo 'File: ' . $backtrace['file'] . '(line: '. $backtrace['line'] . ') <br />';
        }        
        
        //
        $trace = ob_get_clean();
        
        //
//        if ($label !== null) {
//            $label = 'Variable' . $label;
//        }
        $label = 'Variable: ' . $label;
        $variable = parent::dump($var, $label, false);

        //
        $output = '<pre>'
                . $trace
                . $variable
                . '</pre>';

        //
        if ($echo) {
            echo($output);
        }
        return $output;
    }
}