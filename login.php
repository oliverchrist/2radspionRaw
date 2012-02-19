<?php
include 'includes/init.php';
use de\zweiradspion\DatabaseHelper;
use de\zweiradspion\DebugHelper;
use de\zweiradspion\HeaderHelper;
use de\zweiradspion\NavigationHelper;

$showForm = true;
$showError = false;
$emailErr = '';
$passwordErr = '';
$email = '';
$password = '';
if($_POST){
    $email = $_POST['email'];
    $password = $_POST['password'];
    $dbObject = new DatabaseHelper();
    $mysqlQuerySelect = mysql_query("select * from user where email='" . mysql_real_escape_string(trim($email)) ."' and password='" . md5(trim($password)) . "'");
    if (mysql_num_rows($mysqlQuerySelect)==1){ 
        $row = mysql_fetch_assoc($mysqlQuerySelect);
        $showForm = false; 
        $_SESSION['uid'] = $row['uid'];
        $_SESSION['email'] = $row['email'];
        $_SESSION['lat'] = $row['lat'];
        $_SESSION['lng'] = $row['lng'];
        $showForm = false;
        Header("Location: list.php"); 
    } 
    else{
        $showError = true; 
    } 
}
include 'includes/head.php';
?>
<body id="std">
    <?=HeaderHelper::getHeader('Login')?>
	<div id="content">
        <?=NavigationHelper::getSubnavigation()?>
        <? if(isset($_SESSION['uid'])){
            $showForm = false;
        } ?>
	    <?php if($showForm){ ?>
            <?php if($showError){ ?>
                <span class=\"error\">Sie konnten nicht eingeloggt werden.<br>Email oder Passwort fehlerhaft.<br>
            <? } ?>
            <form method="post">
                <div class="formField<?=$emailErr?>">
                    <p class="error">Bitte geben Sie Ihre E-Mail-Adresse ein</p>
                    <label>E-Mail-Adresse</label><input type="text" name="email" value="<?=$email?>" />
                </div>
                <div class="formField<?=$passwordErr?>">
                    <p class="error">Bitte geben Sie das richtige Passwort ein</p>
                    <label>Passwort</label><input type="password" name="password" value="<?=$password?>" />
                </div>
                <div class="formField">
                    <input class="submit" type="submit" />
                </div>
            </form>	    
            <p><a href="passwordRequest.php" class="txtLnk">Passwort vergessen?</a></p>
        <? } ?>
    </div>
    <?php include 'includes/footer.php'; ?>
</body>
</html>
