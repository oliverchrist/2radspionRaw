<?php
use de\zweiradspion\Login;

include 'includes/init.php';

echo $twig->render('agbPage.html', array(
    'headline' => 'AGB',
    'isLoggedIn' => Login::isLoggedIn(),
    'pageClass' => 'datenschutz'
));
?>