<?php
use de\zweiradspion\DatabaseHelper;
use de\zweiradspion\DebugHelper;
use de\zweiradspion\HeaderHelper;
use de\zweiradspion\NavigationHelper,
    de\zweiradspion\Login;

include 'includes/init.php';

$email    = '';
$emailErr = '';
$showForm = TRUE;
$message  = '';
if($_POST){
    $email = $_POST['email'];
    if(empty($email)){
        $emailErr = ' error';
    }
    if(!empty($email)){
        $dbObject = new DatabaseHelper();
        $sql      = "select * from user where email='" . mysql_real_escape_string($_POST['email']) . "'";
        $result   = mysql_query($sql)
            or die('Email wurde nicht in Datenbank user gefunden.');
        if(mysql_num_rows($result) > 0){
            $row      = mysql_fetch_assoc($result);
            $password = $row['password'];
            $email    = $row['email'];
            $header   = 'From: webmaster@2radspion.de' . "\r\n" .
                'Reply-To: webmaster@2radspion.de' . "\r\n" .
                'X-Mailer: PHP/' . phpversion();
            $message  = "Guten Tag,\nSie haben eine Passwortanfrage geschickt. klicken Sie bitte auf diesen Link: http://" . DOMAIN . "/changePassword.php?x=" . $password;
            $mailSend = mail($email, '2radspion Confirm', $message, $header);
            if(!$mailSend){
                die('<span class="error">Mail konnte nicht verschickt werden</span><br>');
            }else{
                $message .= 'Mail wurde an den User geschickt<br>';
                $message .= '<p>Eine Email wurde an Sie versand.</p>';
            }
            $showForm = FALSE;
        }else{
            $message .= '<p class="error">Email unbekannt!</p>';
        }
    }
}

echo $twig->render('passwordRequest.html', array(
    'headline' => 'Passwort Anfrage',
    'isLoggedIn' => Login::isLoggedIn(),
    'pageClass' => 'passwordRequest',
    'linkTarget' => '_top',
    'showForm' => $showForm,
    'emailErr' => $emailErr,
    'email' => $email,
    'message' => $message
));
?>
