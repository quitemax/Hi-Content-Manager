<?php

namespace HiZend\Debug;


class Debug
{

    /**
     * @var string
     */
    protected static $_sapi = null;

    /**
     * Get the current value of the debug output environment.
     * This defaults to the value of PHP_SAPI.
     *
     * @return string;
     */
    public static function getSapi()
    {
        if (self::$_sapi === null) {
            self::$_sapi = PHP_SAPI;
        }
        return self::$_sapi;
    }

    /**
     * Set the debug ouput environment.
     * Setting a value of null causes Zend_Debug to use PHP_SAPI.
     *
     * @param string $sapi
     * @return void;
     */
    public static function setSapi($sapi)
    {
        self::$_sapi = $sapi;
    }


    public static function precho($var, $label=null, $echo=true)
    {
        //
        $debug_backtrace = debug_backtrace();

        //
        ob_start();

        //
        echo 'Debug called from :<br />';
        foreach ($debug_backtrace as $backtrace) {
            echo 'File: ' . (isset($backtrace['file'])?$backtrace['file']:'') . '(line: '. (isset($backtrace['line'])?$backtrace['line']:'') . ') <br />';
        }

        //
        $trace = ob_get_clean();

        //
//        if ($label !== null) {
//            $label = 'Variable' . $label;
//        }
        $label = 'Variable: ' . $label;
//        $variable =
        $variable = self::dump($var, $label, false);

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



     /**
     * Debug helper function.  This is a wrapper for var_dump() that adds
     * the <pre /> tags, cleans up newlines and indents, and runs
     * htmlentities() before output.
     *
     * @param  mixed  $var   The variable to dump.
     * @param  string $label OPTIONAL Label to prepend to output.
     * @param  bool   $echo  OPTIONAL Echo output if true.
     * @return string
     */
    public static function dump($var, $label=null, $echo=true)
    {
        // format the label
        $label = ($label===null) ? '' : rtrim($label) . ' ';

        // var_dump the variable into a buffer and keep the output
        ob_start();
        var_dump($var);
        $output = ob_get_clean();

        // neaten the newlines and indents
        $output = preg_replace("/\]\=\>\n(\s+)/m", "] => ", $output);
        if (self::getSapi() == 'cli') {
            $output = PHP_EOL . $label
                    . PHP_EOL . $output
                    . PHP_EOL;
        } else {
            if(!extension_loaded('xdebug')) {
                $output = htmlspecialchars($output, ENT_QUOTES);
            }

            $output = '<pre>'
                    . $label
                    . $output
                    . '</pre>';
        }

        if ($echo) {
            echo($output);
        }
        return $output;
    }

}