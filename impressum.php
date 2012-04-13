<?php
use de\zweiradspion\Login;

include 'includes/init.php';

echo $twig->render('impressum.html', array(
    'headline' => 'Impressum',
    'isLoggedIn' => Login::isLoggedIn(),
    'pageClass' => 'impressum'
));
