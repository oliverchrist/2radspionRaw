<?php
use de\zweiradspion\Login;

include 'includes/init.php';

echo $twig->render('datenschutzPage.html', array(
    'headline' => 'Datenschutzhinweis',
    'isLoggedIn' => Login::isLoggedIn(),
    'pageClass' => 'datenschutz'
));
