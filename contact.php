<?php
use de\zweiradspion\HeaderHelper,
    de\zweiradspion\NavigationHelper,
    de\zweiradspion\Fahrrad,
    de\zweiradspion\Kontakt,
    de\zweiradspion\Mail,
    de\zweiradspion\Login;

include 'includes/init.php';

$nachricht    = '';
$nachrichtErr = '';
$name         = '';
$nameErr      = '';
$email        = '';
$emailErr     = '';
$cc           = '';
$kontakt      = null;
$showform     = TRUE;
$formValid    = TRUE;
$message      = '';
$pageClass    = 'contact';
try{
    $fahrrad      = new Fahrrad($_GET['uid']);
    $kontakt      = new Kontakt($fahrrad->getPid());
}catch (Exception $e) {
    $showform = FALSE;
    $message  = $e->getMessage();
}
if(isset($_GET['filter']) && $_GET['filter'] == 'dealer'){
    $dealerView = TRUE;
    $pageClass  = 'dealer';
}
if($_POST){
    # Validierung
    if(empty($_POST['email'])) {
        $emailErr  = ' error';
        $formValid = FALSE;
    }else{
        $email = $_POST['email'];
    }
    if(empty($_POST['name'])) {
        $nameErr   = ' error';
        $formValid = FALSE;
    }else{
        $name = $_POST['name'];
    }
    if(empty($_POST['nachricht'])) {
        $nachrichtErr = ' error';
        $formValid    = FALSE;
    }else{
        $nachricht = $_POST['nachricht'];
    }
    if(isset($_POST['cc'])) {
        $cc = ' checked="checked"';
    }
    if($formValid){
        $message = "http://" . DOMAIN . "/detail.php?uid=" . $_GET['uid'] . "\n
Name: {$_POST['name']}\n
Email: {$_POST['email']}\n
Nachricht: {$_POST['nachricht']}\n
\n
Das Team von zweiradspion.de";
        if(Mail::send($kontakt->getEmail(), 'Anfrage', $message)) {
            echo '<p>Ihre Email wurde versendet.</p>';
        }else{
            die('<span class="error">Mail konnte nicht verschickt werden</span><br>');
        }
        if($_POST['cc']){
            if(Mail::send($_POST['email'], 'Anfrage', $message)) {
                echo '<p>Ihre CC Email wurde versendet.</p>';
            }else{
                die('<span class="error">Mail konnte nicht verschickt werden</span><br>');
            }
        }
        $showform = FALSE;
    }
}

echo $twig->render('contact.html', array(
    'headline' => 'Detailansicht',
    'isLoggedIn' => Login::isLoggedIn(),
    'pageClass' => $pageClass,
    'dealerView' => $dealerView,
    'showform' => $showform,
    'message' => $message,
    'fahrrad' => $fahrrad,
    'kontakt' => $kontakt,
    'uid' => $_GET['uid'],
    'nachrichtErr' => $nachrichtErr,
    'nachricht' => $nachricht,
    'nameErr' => $nameErr,
    'name' => $name,
    'emailErr' => $emailErr,
    'email' => $email,
    'cc' => $cc
));
?>