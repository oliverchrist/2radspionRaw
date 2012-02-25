<?php
include 'includes/init.php';
include 'includes/head.php';
use de\zweiradspion\DatabaseHelper;
use de\zweiradspion\DebugHelper;
use de\zweiradspion\HeaderHelper;
use de\zweiradspion\NavigationHelper;
use de\zweiradspion\FormHelper,
    de\zweiradspion\Mail;
?>
<body id="std">
    <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
    <?=HeaderHelper::getHeader('Registrierung')?>
    <div id="content">
        <?=NavigationHelper::getSubnavigation()?>
        <?php
        $password     = '';
        $passwordErr  = '';
        $password2    = '';
        $password2Err = '';
        $email        = '';
        $emailErr     = '';
        $postcode     = '';
        $postcodeErr  = '';
        $city         = '';
        $cityErr      = '';
        $showForm     = TRUE;
        if($_POST){
            $password  = $_POST['password'];
            $password2 = $_POST['password2'];
            $email     = $_POST['email'];
            $postcode  = $_POST['postcode'];
            $city      = $_POST['city'];
            $latlng    = $_POST['latlng'];
            $lat       = $_POST['lat'];
            $lng       = $_POST['lng'];
            if(empty($password)){
                $passwordErr = ' error';
            }
            if(empty($password2) || $password != $password2){
                $password2Err = ' error';
            }
            if(empty($email) || !FormHelper::isEmail($email)){
                $emailErr = ' error';
            }
            if(empty($postcode) || !preg_match('/\d{5}/', $postcode)){
                $postcodeErr = ' error';
            }
            if(empty($city)){
                $cityErr = ' error';
            }
            if(
                !empty($password)
                && !empty($password2)
                && FormHelper::isEmail($email)
                && !empty($postcode)
                && !empty($city)
            ){
                # Prüfen ob Benutzer bereits existiert in Tabelle user und userunconfirmed
                $uniqueUser = TRUE;
                $dbObject = new DatabaseHelper();
                # Prüfen ob email bereits existiert in Tabelle user und userunconfirmed
                if($dbObject->valueInTable($email,'email','user') || $dbObject->valueInTable($email,'email','userunconfirmed')){
                    echo '<p class="error">Diese Email-Adresse gibt es bereits.</p><br>';
                    $uniqueUser = FALSE;
                }

                # Wenn User unique ist
                if($uniqueUser){
                    # Eindeutigen Hash erstellen
                    $hash = hash_init('md5');
                    hash_update($hash, rand());
                    hash_update($hash, $email);
                    $hashFinal = hash_final($hash);

                    # TODO CURDATE() ergänzen
                    $sql = 'INSERT INTO userunconfirmed (hash, password, email, postcode, city, latLng, lat, lng) VALUES ('
                        . '"' . mysql_real_escape_string(trim($hashFinal)) . '", '
                        . '"' . md5($password) . '", '
                        . '"' . mysql_real_escape_string(trim($email)) . '", '
                        . mysql_real_escape_string(trim($postcode)) . ', '
                        . '"' . mysql_real_escape_string(trim($city)) . '", '
                        . '"' . mysql_real_escape_string(trim($latlng)) . '", '
                        . mysql_real_escape_string(trim($lat)) . ', '
                        . mysql_real_escape_string(trim($lng)) . ')';
                    #echo $sql;
                    $result = mysql_query($sql);
                    if(!$result){
                        die ('<span class="error">User konnte nicht in Datenbank userunconfirmed geschrieben werden</span><br>');
                    }else{
                        $showForm = false;
                    }

                    $message = "Guten Tag,\n
vielen Dank für Ihre Anmeldung bei zweiradspion.de.\n
Um die Anmeldung abzuschließen klicken Sie folgenden Link, oder kopieren diesen in die Adresszeile Ihres Browser:\n
http://" . de\zweiradspion\DOMAIN . "/registerConfirm.php?x=" . $hashFinal . "\n
\n
Sollten Sie sich nicht bei zweiradspion angemeldet haben ignorieren Sie diese Email einfach.\n
\n
Mit freundlichen Grüßen\n
\n
Das Team von zweiradspion.de";
                    if(Mail::send($email, '2radspion Confirm', $message)) {
                        echo '<p>Wir haben Ihnen eine Email zur Überprufung gesendet, bitte sehen Sie in Ihrem Posteingang nach und schließen Sie die Anmeldung ab.</p>';
                    }else{
                        die('<span class="error">Mail konnte nicht verschickt werden</span><br>');
                    }
                }
            }
        }
        if($showForm){
        ?>
        <form method="post" id="register">
            <input type="hidden" name="latlng" />
            <input type="hidden" name="lat" />
            <input type="hidden" name="lng" />
            <div class="formField<?=$emailErr?>">
                <p class="error">Bitte geben Sie eine gültige Email Adresse ein</p>
                <label>Email</label><input type="text" name="email" value="<?=$email?>" />
            </div>
            <div class="formField<?=$passwordErr?>">
                <p class="error">Bitte geben Sie ein Passwort ein</p>
                <label>Passwort</label><input type="password" name="password" value="<?=$password?>" />
            </div>
            <div class="formField<?=$password2Err?>">
                <p class="error">Die Passwörter stimmen nicht überein</p>
                <label>Passwort wiederholen</label><input type="password" name="password2" value="<?=$password2?>" />
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
