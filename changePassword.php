<?php
include 'includes/head.php';
use de\zweiradspion\DatabaseHelper;
use de\zweiradspion\DebugHelper;
use de\zweiradspion\HeaderHelper;
use de\zweiradspion\NavigationHelper;
?>
<body id="std">
    <?=HeaderHelper::getHeader('Passwort ändern')?>
	<div id="content">
        <?=NavigationHelper::getSubnavigation()?>
	    <?php
	    $password = '';
        $passwordErr = '';
        $password2 = '';
        $password2Err = '';
        $showForm = false;
        if(isset($_GET['x'])){
            $hash = $_GET['x'];
            if(!$hash) die ('Es wurde kein Hash übergeben<br>');
            echo '<p>Hash: ' . $hash . '</p>';
            
            include 'includes/dbConnect.php';
            $result = mysql_query("SELECT * FROM user WHERE password = '" . mysql_real_escape_string($hash) . "'");
                
            $row = mysql_fetch_assoc($result);
            if(!$row) die ('<span class="error">Could not find hash</span><br>');
            
            $uid = $row['uid'];
            $showForm = true;
        }
        if($_POST){
            $password = $_POST['password'];
            $password2 = $_POST['password2'];
            # Validierung
            if(
                empty($password)
            ) $passwordErr = ' error';
            if(
                empty($password2)
                || $password != $password2
            ) $passwordErr = ' error';
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
                    echo 'Passwort wurde in Tabelle user geschrieben.<br>';
                    $showForm = false;
                }
            }else{
                $showForm = true;
            }
        }
	    if($showForm){ ?>
            <form method="post">
                <input type="hidden" name="uid" value="<?=$uid?>" />
                <div class="formField<?=$passwordErr?>">
                    <p class="error">Bitte geben Sie ein Passwort ein</p>
                    <label>Passwort</label><input type="text" name="password" value="<?=$password?>" />
                </div>
                <div class="formField<?=$password2Err?>">
                    <p class="error">Die beiden Passwörter stimmen nicht überein</p>
                    <label>Passwort wiederholen</label><input type="text" name="password2" value="<?=$password2?>" />
                </div>
                <div class="formField">
                    <input class="submit" type="submit" />
                </div>
            </form>
       <? } ?>	    
    </div>
    <?php include 'includes/footer.php'; ?>
</body>
</html>
