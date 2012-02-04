<?php
namespace de\zweiradspion;

require_once 'config/properties.php';

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