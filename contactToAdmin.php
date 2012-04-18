<?php
use de\zweiradspion\HeaderHelper,
    de\zweiradspion\NavigationHelper,
    de\zweiradspion\Fahrrad,
    de\zweiradspion\Kontakt,
    de\zweiradspion\Mail,
    de\zweiradspion\Login;

include 'includes/init.php';
include 'includes/org/phpcaptcha/securimage/securimage.php';

$grund        = '';
$nachricht    = '';
$nachrichtErr = '';
$name         = '';
$nameErr      = '';
$email        = '';
$emailErr     = '';
$captchaErr   = '';
$cc           = '';
$kontakt      = null;
$showform     = TRUE;
$formValid    = TRUE;
$message      = '';
$emailBody    = '';
$pageClass    = 'contact';
$dealerView   = FALSE;

if(isset($_GET['filter']) && $_GET['filter'] == 'dealer'){
    $dealerView = TRUE;
    $pageClass  = 'dealer';
}
if($_POST){
    # Validierung
    if(empty($_POST['grund'])) {
        #$emailErr  = ' error';
        #$formValid = FALSE;
    }else{
        $grund = $_POST['grund'];
    }
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
    if(!isset($_SESSION['email'])) {
        $securimage = new \Securimage();
        if ($securimage->check($_POST['captcha_code']) == FALSE) {
            $captchaErr = ' error';
            $formValid  = FALSE;
        }
    }
    if(isset($_POST['cc'])) {
        $cc = ' checked="checked"';
    }
    if($formValid){
        $emailBody = "Name: {$_POST['name']}\n
Email: {$_POST['email']}\n
Grund: {$_POST['grund']}\n
Nachricht: {$_POST['nachricht']}";
        if(Mail::send('oliver.christ@web.de,t.renkel@me.com', 'Anfrage', $emailBody, $_POST['email'])) {
            $message .= 'Ihre Email wurde versendet.';
        }else{
            $message .= 'Mail konnte nicht verschickt werden';
        }
        if($_POST['cc']){
            if(Mail::send($_POST['email'], 'Anfrage', $emailBody)) {
                #$message .= 'Ihre CC Email wurde versendet.';
            }else{
                $message .= 'Mail konnte nicht verschickt werden';
            }
        }
        $showform = FALSE;
    }
}

echo $twig->render('contactToAdmin.html', array(
    'headline' => 'Detailansicht',
    'isLoggedIn' => Login::isLoggedIn(),
    'pageClass' => $pageClass,
    'dealerView' => $dealerView,
    'showform' => $showform,
    'message' => $message,
    'grund' => $grund,
    'nachrichtErr' => $nachrichtErr,
    'nachricht' => $nachricht,
    'nameErr' => $nameErr,
    'name' => $name,
    'emailErr' => $emailErr,
    'email' => $email,
    'fromEmail' => isset($_SESSION['email']) ? $_SESSION['email'] : NULL,
    'captchaErr' => $captchaErr,
    'cc' => $cc
));
?>