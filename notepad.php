<?php
use de\zweiradspion\DatabaseHelper;
use de\zweiradspion\DebugHelper;
use de\zweiradspion\HeaderHelper;
use de\zweiradspion\NavigationHelper,
    de\zweiradspion\Login;

include 'includes/init.php';

$message = '';
# bike merken
if(isset($_GET['uid'])){
    $dbObject = new DatabaseHelper();
    $sql = "insert into notepad (pid,id) values ({$_SESSION['uid']},{$_GET['uid']})";
    $result = mysql_query($sql);
    if($result){
        $message .= 'Zweirad auf Merkzettel gespeichert';
    }else{
        $message .= 'Zweirad konnte nicht auf Merkzettel gespeichert werden';
    }
}

echo $twig->render('notepad.html', array(
    'headline' => 'Merkzettel',
    'isLoggedIn' => Login::isLoggedIn(),
    'pageClass' => 'notepad',
    'uid' => $_GET['uid'],
    'message' => $message
));
?>