<?php
use de\zweiradspion\DatabaseHelper,
    de\zweiradspion\DebugHelper,
    de\zweiradspion\HeaderHelper,
    de\zweiradspion\NavigationHelper,
    de\zweiradspion\Login;

include 'includes/init.php';

$password     = '';
$passwordErr  = '';
$password2    = '';
$password2Err = '';
$showForm     = FALSE;
$message      = '';
if(isset($_GET['x'])){
    $hash = $_GET['x'];
    if(!$hash) {
        die ('Es wurde kein Hash übergeben<br>');
    }
    $message .= '<p>Hash: ' . $hash . '</p>';

    $dbObject = new DatabaseHelper();
    $result   = mysql_query("SELECT * FROM user WHERE password = '" . mysql_real_escape_string($hash) . "'");
    $row      = mysql_fetch_assoc($result);
    if(!$row) { die ('<span class="error">Could not find hash</span><br>'); }

    $uid      = $row['uid'];
    $showForm = TRUE;
}
if($_POST){
    $password  = $_POST['password'];
    $password2 = $_POST['password2'];
    # Validierung
    if(
        empty($password)
    ) { $passwordErr = ' error'; }
    if(
        empty($password2)
        || $password != $password2
    ) { $passwordErr = ' error'; }
    if(
        !empty($password)
        && !empty($password2)
        && $password == $password2
    ){
        $result = mysql_query('UPDATE user SET '
            . 'password="' . md5(trim($password)) . '" '
            . 'WHERE uid=' . mysql_real_escape_string(trim($uid)));

        if(!$result){
            die('<span class="error">Could not write to table user</span><br>');
        }else{
            $message .= 'Passwort wurde in Tabelle user geschrieben.<br>';
            $showForm = FALSE;
        }
    }else{
        $showForm = FALSE;
    }
}

echo $twig->render('changePassword.html', array(
        'headline' => 'Passwort ändern',
        'isLoggedIn' => Login::isLoggedIn(),
        'showForm' => $showForm,
        'pageClass' => 'addPicture',
        'linkTarget' => '_top',
        'post' => $_POST,
        'uid' => $uid,
        'image' => $image,
        'message' => $message
    ));
