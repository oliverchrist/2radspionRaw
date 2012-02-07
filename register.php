<?php
include 'includes/config/properties.php';
include 'includes/head.php';
include 'includes/DatabaseHelper.php';
include 'includes/ScaleImage.php';
include 'includes/DebugHelper.php';
include 'includes/HeaderHelper.php';
include 'includes/NavigationHelper.php';
include 'includes/FormHelper.php';
use de\zweiradspion\DatabaseHelper;
use de\zweiradspion\DebugHelper;
use de\zweiradspion\HeaderHelper;
use de\zweiradspion\NavigationHelper;
use de\zweiradspion\FormHelper;
?>
<body id="std">
    <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
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
        $postcode = '';
        $postcodeErr = '';
        $city = '';
        $cityErr = '';
        $showForm = true;
	    if($_POST){
    	    $username = $_POST['username'];
            $password = $_POST['password'];
            $password2 = $_POST['password2'];
            $email = $_POST['email'];
            $postcode = $_POST['postcode'];
            $city = $_POST['city'];
            $latlng = $_POST['latlng'];
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
            if(empty($postcode)){
                $postcodeErr = ' error';
            }
            if(empty($city)){
                $cityErr = ' error';
            }
            if(
                !empty($username)
                && !empty($password)
                && !empty($password2)
                && FormHelper::isEmail($email)
                && !empty($postcode)
                && !empty($city)
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
                    $sql = "INSERT INTO userunconfirmed (hash, username, password, email, postcode, city, latLng) VALUES ('"
                        . mysql_real_escape_string(trim($hashFinal)) . "', '"
                        . mysql_real_escape_string(trim($username)) . "', '"
                        . md5($password) . "', '"
                        . mysql_real_escape_string(trim($email)) . "', "
                        . mysql_real_escape_string(trim($postcode)) . ", '"
                        . mysql_real_escape_string(trim($city)) . "', '"
                        . mysql_real_escape_string(trim($latlng)) . "')";
                    $result = mysql_query($sql);
                    if(!$result){
                        die ('<span class="error">User konnte nicht in Datenbank userunconfirmed geschrieben werden</span><br>');
                    }else{
                        echo 'User wurde in Datenbank useruncorfirmed geschrieben<br>';
                        $showForm = false;
                    }
    
                    $header = 'From: webmaster@2radspion.de' . "\r\n" .
                        'Reply-To: webmaster@2radspion.de' . "\r\n" .
                        'X-Mailer: PHP/' . phpversion();
                    $message = 'Guten Tag ' . $username . ',' . "\n" . 'klicken Sie bitte auf diesen Link: http://' . de\zweiradspion\DOMAIN . '/registerConfirm.php?x=' . $hashFinal;
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
	    <form method="post" id="register">
	        <input type="hidden" name="latlng" />
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
            <div class="formField<?=$postcodeErr?>">
                <p class="error">Bitte geben Sie eine gültige Postleitzahl Adresse ein</p>
                <label>Postleitzahl</label><input type="text" name="postcode" value="<?=$postcode?>" />
            </div>
            <div class="formField<?=$cityErr?>">
                <p class="error">Bitte geben Sie einen gültigen Ort ein</p>
                <label>Ort</label><input type="text" name="city" value="<?=$city?>" />
            </div>
            <div class="formField">
                <input class="submit" type="button" value="Senden" />
            </div>
	    </form>
	    <? } ?>
    </div>
    <?php include 'includes/footer.php'; ?>
</body>
</html>
