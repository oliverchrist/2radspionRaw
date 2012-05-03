<?php
use de\zweiradspion\DatabaseHelper,
    de\zweiradspion\DebugHelper,
    de\zweiradspion\HeaderHelper,
    de\zweiradspion\NavigationHelper,
    de\zweiradspion\Login;

include 'includes/init.php';

$showForm    = TRUE;
$showError   = FALSE;
$emailErr    = '';
$passwordErr = '';
$email       = '';
$password    = '';
if($_POST){
    $email            = $_POST['email'];
    $password         = $_POST['password'];
    $dbObject         = new DatabaseHelper();
    $mysqlQuerySelect = mysql_query("select * from user where email='" . mysql_real_escape_string(trim($email)) ."' and password='" . md5(trim($password)) . "'");
    if (mysql_num_rows($mysqlQuerySelect)==1){
        $row                 = mysql_fetch_assoc($mysqlQuerySelect);
        $showForm            = FALSE;
        $_SESSION['uid']     = $row['uid'];
        $_SESSION['name']    = $row['name'];
        $_SESSION['vorname'] = $row['vorname'];
        $_SESSION['email']   = $row['email'];
        $_SESSION['lat']     = $row['lat'];
        $_SESSION['lng']     = $row['lng'];
        $_SESSION['login']   = md5($row['email'] . SECRET_WORD);
        $showForm            = FALSE;
        Header("Location: list.php");
    }
    else{
        $showError = TRUE;
    }
}

if(isset($_SESSION['uid'])){
    $showForm = FALSE;
}

echo $twig->render('login.html', array(
        'headline' => 'Login',
        'isLoggedIn' => Login::isLoggedIn(),
        'pageClass' => 'login',
        'linkTarget' => '_top',
        'showError' => $showError,
        'emailErr' => $emailErr,
        'email' => $email,
        'passwordErr' => $passwordErr,
        'password' => $password
    ));
?>