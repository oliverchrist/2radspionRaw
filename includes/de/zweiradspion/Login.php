<?php
namespace de\zweiradspion;

require_once 'config/properties.php';

/**
 * Helferfunktionen
 *
 * @author christ
 */
class Login {
    public function isLoggedIn() {
        if($_SESSION['login']) {
            return $_SESSION['login'] == md5($_SESSION['email'] . SECRET_WORD);
        }
    }
}