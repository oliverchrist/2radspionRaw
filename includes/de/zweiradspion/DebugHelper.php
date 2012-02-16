<?php
namespace de\zweiradspion;

/**
 * Helferfunktionen
 *
 * @author christ
 */
class DebugHelper {
    static public function info($str){
        if(DEBUG){
            echo $str . '<br>' . "\n";
        }
    }
}
?>