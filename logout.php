<?php
use de\zweiradspion\DatabaseHelper;
use de\zweiradspion\DebugHelper;
use de\zweiradspion\HeaderHelper;
use de\zweiradspion\NavigationHelper,
    de\zweiradspion\Login;

include 'includes/init.php';

$_SESSION = array();
if (isset($_COOKIE[session_name()])) {
    setcookie(session_name(), '', time()-86400, '/');
}
session_destroy();

echo $twig->render('logout.html', array(
    'headline' => 'AGB',
    'isLoggedIn' => Login::isLoggedIn(),
    'pageClass' => 'datenschutz'
));