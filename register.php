<?php include 'includes/head.php'; ?>
<body id="std">
    <?php include 'includes/header.php'; ?>
	<div id="content">
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
            if(empty($password2)){
                $password2Err = ' error';
            }
            if(empty($email)){
                $emailErr = ' error';
            }
            if(
                !empty($username)
                && !empty($password)
                && !empty($password2)
                && !empty($email)
            ){
                # Prüfen ob Benutzer bereits existiert in Tabelle user und userunconfirmed
                $uniqueUser = true;
                include 'includes/dbConnect.php';
                $mysqlQuerySelect = mysql_query("select uid from user where username='" . mysql_real_escape_string($username) ."'");
                if(mysql_num_rows($mysqlQuerySelect) > 0){
                    echo '<span class="error">Diesen Benutzer gibt es bereits in der Tabelle user, bitte geben Sie einen anderen Benutzernamen ein.</span><br>';
                    $uniqueUser = false;
                }else{
                    echo 'Benutzer ist nicht in Tabelle user<br>';
                }
                $mysqlQuerySelect = mysql_query("select uid from userunconfirmed where username='" . mysql_real_escape_string($username) ."'");
                if(mysql_num_rows($mysqlQuerySelect) > 0){
                    echo '<span class="error">Diesen Benutzer gibt es bereits in der Tabelle userunconfirmed, bitte geben Sie einen anderen Benutzernamen ein.</span><br>';
                    $uniqueUser = false;
                }else{
                    echo 'Benutzer ist nicht in Tabelle userunconfirmed<br>';
                }
                
                # Wenn User unique ist
                if($uniqueUser){
                    # Eindeutigen Hash erstellen
                    $hash = hash_init('md5');
                    hash_update($hash, rand());
                    hash_update($hash, $email);
                    $hashFinal = hash_final($hash);
                    
                    # TODO CURDATE() ergänzen
                    $mysqlQueryInsert = mysql_query("INSERT INTO userunconfirmed (hash, username, password, email) VALUES ('"
                        . mysql_real_escape_string(trim($hashFinal)) . "', '"
                        . mysql_real_escape_string(trim($username)) . "', '"
                        . md5($password) . "', '"
                        . mysql_real_escape_string(trim($email)) . "')");
                    if(!$mysqlQueryInsert){
                        die ('<span class="error">User konnte nicht in Datenbank userunconfirmed geschrieben werden</span><br>');
                    }else{
                        echo 'User wurde in Datenbank useruncorfirmed geschrieben<br>';
                        $showForm = false;
                    }
                    
    
    
                    $header = 'From: webmaster@2radspion.de' . "\r\n" .
                        'Reply-To: webmaster@2radspion.de' . "\r\n" .
                        'X-Mailer: PHP/' . phpversion();
                    $message = 'Guten Tag ' . $username . ",\nklicken Sie bitte auf diesen Link: http://2radspionRaw.localhost/registerConfirm.php?x=" . $hashFinal;
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
                <label>Passwort</label><input type="text" name="password" value="<?=$password?>" />
            </div>
            <div class="formField<?=$passwordErr?>">
                <p class="error">Die Passwörter stimmen nicht überein</p>
                <label>Passwort wiederholen</label><input type="text" name="password2" value="<?=$password2?>" />
            </div>
            <div class="formField<?=$emailErr?>">
                <p class="error">Bitte geben Sie eine Email ein</p>
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
