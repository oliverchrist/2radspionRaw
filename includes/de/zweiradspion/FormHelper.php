<?php
namespace de\zweiradspion;

/**
 * Helferfunktionen
 *
 * @author christ
 */
class FormHelper {
    public static function isEmail($str) {
        return preg_match('/[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}/', $str);
    }

    public static function getFromPost($name) {
        if(isset($_POST[$name])) {
            return $_POST[$name];
        }
        return '';
    }
}
?>