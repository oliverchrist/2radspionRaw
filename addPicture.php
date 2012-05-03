<?php
use de\zweiradspion\DatabaseHelper;
use de\zweiradspion\DebugHelper;
use de\zweiradspion\HeaderHelper;
use de\zweiradspion\NavigationHelper,
	de\zweiradspion\Login;

include 'includes/init.php';

function getExtension($str) {
    $i = strrpos($str,".");
    if (!$i) { return ""; }
    $l   = strlen($str) - $i;
    $ext = substr($str,$i+1,$l);
    return strtolower($ext);
}

$dbObject = new DatabaseHelper();
$uid      = mysql_real_escape_string($_GET['uid']);
$message  = '';
$result   = mysql_query("select * from bike where uid=" . $uid . " && pid=" . $_SESSION['uid']);
# sollte unique sein
if(mysql_num_rows($result) == 1) {
    $image = '';
    if($_POST){
        $uid       = $_POST['uid'];
        $filename  = stripslashes($_FILES['image']['name']);
        $extension = getExtension($filename);
        $imageName = time();
        $copied    = copy($_FILES['image']['tmp_name'], 'images/' . $imageName . '.' . $extension);
        if (!$copied)
        {
            $message .= '<h1>Copy unsuccessfull!</h1>';
        }else{
            $message .= 'Bild wurde hochgeladen.';
            $sql    = "INSERT INTO images (pid, name, extension) VALUES ('" . $uid . "','" . $imageName . "','" . $extension . "')";
            $result = mysql_query($sql);
            if($result){
                $message .= 'Bild wurde der Datenbank hinzugefügt<br>';
            }else{
                $message .= '<p class="error">Das Bild konnte der Datenbank nicht hinzugefügt werden.</p>';
            }
        }
    }
}
echo $twig->render('addPicture.html', array(
        'headline' => 'Bild hinzufügen',
        'isLoggedIn' => Login::isLoggedIn(),
        'pageClass' => 'addPicture',
        'linkTarget' => '_top',
        'post' => $_POST,
        'uid' => $uid,
        'image' => $image,
        'message' => $message
    ));
?>