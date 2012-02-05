<?php
include 'includes/head.php';
include 'includes/DatabaseHelper.php';
include 'includes/ScaleImage.php';
include 'includes/DebugHelper.php';
include 'includes/HeaderHelper.php';
include 'includes/NavigationHelper.php';
use de\zweiradspion\DatabaseHelper;
use de\zweiradspion\DebugHelper;
use de\zweiradspion\HeaderHelper;
use de\zweiradspion\NavigationHelper;
?>
<body id="std">
    <?=HeaderHelper::getHeader('Registrierung')?>
	<div id="content">
        <?=NavigationHelper::getSubnavigation()?>
	    <?php
	    $username = '';
        $usernameErr = '';
        $password = '';
        $passwordErr = '';
        $password2 = '';
        $password2Err = '';
        $email = '';
        $emailErr = '';
        $showForm = true;
	    if($_POST){
    	    $username = $_POST['username'];
            $password = $_POST['password'];
            $password2 = $_POST['password2'];
            $email = $_POST['email'];
            if(empty($username)){
                $usernameErr = ' error';
            }
            if(empty($password)){
                $passwordErr = ' error';
            }
            if(empty($password2) || $password != $password2){
                $password2Err = ' error';
            }
            if(empty($email) || !FormHelper::isEmail($email)){
                $emailErr = ' error';
            }
            if(
                !empty($username)
                && !empty($password)
                && !empty($password2)
                && FormHelper::isEmail($email)
            ){
                # Prüfen ob Benutzer bereits existiert in Tabelle user und userunconfirmed
                $uniqueUser = true;
                $dbObject = new DatabaseHelper();
                if($dbObject->valueInTable($username,'username','user') || $dbObject->valueInTable($username,'username','userunconfirmed')){
                    echo '<span class="error">Diesen Benutzer gibt es bereits, bitte geben Sie einen anderen Benutzernamen ein.</span><br>';
                    $uniqueUser = false;
                }else{
                    echo 'Benutzer ist nicht in Tabelle user oder userunconfirmed<br>';
                }
                # Prüfen ob email bereits existiert in Tabelle user und userunconfirmed
                if($dbObject->valueInTable($username,'email','user') || $dbObject->valueInTable($username,'email','userunconfirmed')){
                    echo '<span class="error">Diese Email-Adresse gibt es bereits.</span><br>';
                    $uniqueUser = false;
                }else{
                    echo 'Email ist nicht in Tabelle user oder userunconfirmed<br>';
                }
                
                # Wenn User unique ist
                if($uniqueUser){
                    # Eindeutigen Hash erstellen
                    $hash = hash_init('md5');
                    hash_update($hash, rand());
                    hash_update($hash, $email);
                    $hashFinal = hash_final($hash);
                    
                    # TODO CURDATE() ergänzen
                    $result = mysql_query("INSERT INTO userunconfirmed (hash, username, password, email) VALUES ('"
                        . mysql_real_escape_string(trim($hashFinal)) . "', '"
                        . mysql_real_escape_string(trim($username)) . "', '"
                        . md5($password) . "', '"
                        . mysql_real_escape_string(trim($email)) . "')");
                    if(!$result){
                        die ('<span class="error">User konnte nicht in Datenbank userunconfirmed geschrieben werden</span><br>');
                    }else{
                        echo 'User wurde in Datenbank useruncorfirmed geschrieben<br>';
                        $showForm = false;
                    }
    
                    $header = 'From: webmaster@2radspion.de' . "\r\n" .
                        'Reply-To: webmaster@2radspion.de' . "\r\n" .
                        'X-Mailer: PHP/' . phpversion();
                    $message = 'Guten Tag ' . $username . ',' . "\n" . 'klicken Sie bitte auf diesen Link: http://' . DB_DOMAIN . '/registerConfirm.php?x=' . $hashFinal;
                    $mailSend = mail($email, '2radspion Confirm', $message, $header);
                    if(!$mailSend){
                        die('<span class="error">Mail konnte nicht verschickt werden</span><br>');
                    }else{
                        echo 'Mail wurde an den User zur Überprüfung geschickt<br>';
                        echo '<p>Eine Email wurde an Sie versand, bitte bestätigen Sie diese</p>';
                    }
                }
            }
        }
        if($showForm){
	    ?>
	    <form method="post">
	        <div class="formField<?=$usernameErr?>">
                <p class="error">Bitte geben Sie einen Benutzernamen ein</p>
                <label>Benutzername</label><input type="text" name="username" value="<?=$username?>" />
            </div>
            <div class="formField<?=$passwordErr?>">
                <p class="error">Bitte geben Sie ein Passwort ein</p>
                <label>Passwort</label><input type="password" name="password" value="<?=$password?>" />
            </div>
            <div class="formField<?=$password2Err?>">
                <p class="error">Die Passwörter stimmen nicht überein</p>
                <label>Passwort wiederholen</label><input type="password" name="password2" value="<?=$password2?>" />
            </div>
            <div class="formField<?=$emailErr?>">
                <p class="error">Bitte geben Sie eine gültige Email Adresse ein</p>
                <label>Email</label><input type="text" name="email" value="<?=$email?>" />
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
