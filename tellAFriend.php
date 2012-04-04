<?php
use de\zweiradspion\HeaderHelper,
    de\zweiradspion\NavigationHelper,
    de\zweiradspion\Fahrrad,
    de\zweiradspion\Kontakt,
    de\zweiradspion\Mail,
    de\zweiradspion\Login;

include 'includes/init.php';
include 'includes/org/phpcaptcha/securimage/securimage.php';

if(isset($_GET['uid'])) {
    $fahrrad      = new Fahrrad($_GET['uid']);
    $nachricht    = '';
    $nachrichtErr = '';
    if(isset($_SESSION['uid'])) {
        $name = "{$_SESSION['vorname']} {$_SESSION['name']}";
    }else{
        $name = '';
    }
    $nameErr    = '';
    $email      = '';
    $emailErr   = '';
    $email2     = '';
    $email2Err  = '';
    $captchaErr = '';
    $cc         = '';
    $showForm   = TRUE;
    $formValid  = TRUE;
    $message = '';
    if($_POST) {
        # Validierung
        if(empty($_POST['email'])) {
            $emailErr  = ' error';
            $formValid = FALSE;
        }else{
            $email = $_POST['email'];
        }
        if(empty($_POST['email2'])) {
            $email2Err = ' error';
            $formValid = FALSE;
        }else{
            $email2 = $_POST['email2'];
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
            $message = "http://" . DOMAIN . "/detail.php?uid=" . $_GET['uid'] . "\n
Name: {$_POST['name']}\n
Email: {$_POST['email']}\n
Nachricht: {$_POST['nachricht']}\n
\n
Das Team von zweiradspion.de";
            # Email an Empfänger
            if(Mail::send($_POST['email'], 'Weiterleitung', $message, $_POST['email2'])) {
                $message .= '<p>Ihre Email wurde versendet.</p>';
            }else{
                die('<span class="error">Mail konnte nicht verschickt werden</span><br>');
            }
            # Email an Versender
            if($_POST['cc']){
                if(Mail::send($_POST['email2'], 'Anfrage', $message)) {
                    $message .= '<p>Ihre CC Email wurde versendet.</p>';
                }else{
                    die('<span class="error">Mail konnte nicht verschickt werden</span><br>');
                }
            }
            $showForm = FALSE;
        }
    }

    echo $twig->render('tellAFriend.html', array(
        'headline' => 'Weiterleiten',
        'isLoggedIn' => Login::isLoggedIn(),
        'pageClass' => 'tellAFriend',
        'linkTarget' => '_top',
        'showForm' => $showForm,
        'uid' => $fahrrad->getUid(),
        'nachrichtErr' => $nachrichtErr,
        'nachricht' => $nachricht,
        'nameErr' => $nameErr,
        'name' => $name,
        'emailErr' => $emailErr,
        'email' => $email,
        'fromEmail' => isset($_SESSION['email']) ? $_SESSION['email'] : NULL,
        'email2Err' => $email2Err,
        'email2' => $email2,
        'captchaErr' => $captchaErr,
        'cc' => $cc,
        'message' => $message
    ));
} ?>


