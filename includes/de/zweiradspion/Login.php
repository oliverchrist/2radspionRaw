<?php
namespace de\zweiradspion;

/**
 * Helferfunktionen
 *
 * @author christ
 */
class Login {
    public static function isLoggedIn() {
        if(isset($_SESSION['login'])) {
            return $_SESSION['login'] == md5($_SESSION['email'] . SECRET_WORD);
        }
        return FALSE;
    }
}