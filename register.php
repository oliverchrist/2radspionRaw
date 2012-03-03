<?php
include 'includes/init.php';
include 'includes/head.php';
use de\zweiradspion\DatabaseHelper,
    de\zweiradspion\DebugHelper,
    de\zweiradspion\HeaderHelper,
    de\zweiradspion\NavigationHelper,
    de\zweiradspion\FormHelper,
    de\zweiradspion\Mail,
    de\zweiradspion\User;
?>
<body id="std">
    <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
    <?=HeaderHelper::getHeader('Registrierung')?>
    <div id="content">
<?=NavigationHelper::getSubnavigation()?>
<?php
$anbieterErr    = '';
$anredeErr      = '';
$nameErr        = '';
$vornameErr     = '';
$firmaErr       = '';
$passwordErr    = '';
$password2Err   = '';
$emailErr       = '';
$postcodeErr    = '';
$cityErr        = '';
$agbErr         = '';
$datenschutzErr = '';
$showForm       = TRUE;
$keineFehler    = TRUE;
$user           = new User();
if($_POST){
    $user->loadFromPost($_POST);
    $anbieter = $user->getAnbieter();
    if($anbieter == -1){
        $anbieterErr = ' error';
        $keineFehler = FALSE;
    }
    $anrede = $user->getAnrede();
    if(empty($anrede)){
        $anredeErr = ' error';
        $keineFehler = FALSE;
    }
    $name = $user->getName();
    if(empty($name)){
        $nameErr = ' error';
        $keineFehler = FALSE;
    }
    $vorname = $user->getVorname();
    if(empty($vorname)){
        $vornameErr = ' error';
        $keineFehler = FALSE;
    }
    $firma = $user->getFirma();
    if(empty($firma)){
        $firmaErr = ' error';
        $keineFehler = FALSE;
    }
    $password  = $user->getPassword();
    $password2 = $user->getPassword2();
    if(empty($password)){
        $passwordErr = ' error';
        $keineFehler = FALSE;
    }
    if(empty($password) || $password != $password2){
        $password2Err = ' error';
        $keineFehler = FALSE;
    }
    $email = $user->getEmail();
    if(empty($email) || !FormHelper::isEmail($email)){
        $emailErr = ' error';
        $keineFehler = FALSE;
    }
    $postcode = $user->getPostcode();
    if(empty($postcode) || !preg_match('/\d{5}/', $postcode)){
        $postcodeErr = ' error';
        $keineFehler = FALSE;
    }
    $city = $user->getCity();
    if(empty($city)){
        $cityErr = ' error';
        $keineFehler = FALSE;
    }
    $agb = $user->getAgb();
    if(empty($agb)){
        $agbErr = ' error';
        $keineFehler = FALSE;
    }
    $datenschutz = $user->getDatenschutz();
    if(empty($datenschutz)){
        $datenschutzErr = ' error';
        $keineFehler = FALSE;
    }
    if($keineFehler){
        # Prüfen ob Benutzer bereits existiert in Tabelle user und userunconfirmed
        $uniqueUser = TRUE;
        $dbObject   = new DatabaseHelper();
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
            $user->setHash($hashFinal);

            # insert

            try{
                $user->setPassword2(null);
                $user->setPassword(md5($user->getPassword()));
                $user->insertInDatabase('userunconfirmed');
            }catch(Exception $e){
                print $e->getMessage();
            }

            $showForm = FALSE;

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
if($showForm){ ?>
    <form method="post" id="register">
        <input type="hidden" name="lat" />
        <input type="hidden" name="lng" />
        <div class="formField<?=$anbieterErr?>">
            <p class="error">Bitte geben Sie ein ob Sie Privatanbieter oder Händler sind</p>
            <label>Privatanbieter/Händler</label>
            <select name="anbieter">
                <option value="-1">Bitte wählen</option>
                <option value="privat"<?if($user->getAnbieter() == 'privat'){?> selected="selected"<?}?>>Privatanbieter</option>
                <option value="haendler"<?if($user->getHaendler() == 'privat'){?> selected="selected"<?}?>>Händler</option>
            </select>
        </div>
        <div class="formField radio<?=$anredeErr?>">
            <p class="error">Bitte geben Sie Ihre Anrede an</p>
            <label class="desc">Anrede</label>
            <input type="radio" name="anrede" value="frau" <?if($user->getAnrede() == 'frau'){?> checked="checked"<?}?> />
            <label>Frau</label>
            <input type="radio" name="anrede" value="herr" <?if($user->getAnrede() == 'herr'){?> checked="checked"<?}?> />
            <label>Herr</label>
        </div>
        <div class="formField<?=$nameErr?>">
            <p class="error">Bitte geben Sie Ihren Namen ein</p>
            <label>Name</label><input type="text" name="name" value="<?=$user->getName()?>" />
        </div>
        <div class="formField<?=$vornameErr?>">
            <p class="error">Bitte geben Sie Ihren Vornamen ein</p>
            <label>Vorname</label><input type="text" name="vorname" value="<?=$user->getVorname()?>" />
        </div>
        <div class="formField<?=$firmaErr?>">
            <p class="error">Bitte geben Sie Ihren Firmennamen ein</p>
            <label>Firma</label><input type="text" name="firma" value="<?=$user->getFirma()?>" />
        </div>
        <div class="formField<?=$emailErr?>">
            <p class="error">Bitte geben Sie eine gültige Email Adresse ein</p>
            <label>Email</label><input type="text" name="email" value="<?=$user->getEmail()?>" />
        </div>
        <div class="formField<?=$passwordErr?>">
            <p class="error">Bitte geben Sie ein Passwort ein</p>
            <label>Passwort</label><input type="password" name="password" value="<?=$user->getPassword()?>" />
        </div>
        <div class="formField<?=$password2Err?>">
            <p class="error">Die Passwörter stimmen nicht überein</p>
            <label>Passwort wiederholen</label><input type="password" name="password2" value="<?=$user->getPassword2()?>" />
        </div>
        <div class="formField<?=$postcodeErr?>">
            <p class="error">Bitte geben Sie eine gültige Postleitzahl Adresse ein</p>
            <label>Postleitzahl</label><input type="text" name="postcode" value="<?=$user->getPostcode()?>" />
        </div>
        <div class="formField<?=$cityErr?>">
            <p class="error">Bitte geben Sie einen gültigen Ort ein</p>
            <label>Ort</label><input type="text" name="city" value="<?=$user->getCity()?>" />
        </div>
        <div class="formField checkbox<?=$agbErr?>">
            <p class="error">Bitte stimmen Sie den allgemeinen Geschäftsbedingungen zu</p>
            <input type="checkbox" name="agb" value="1"<?=($user->getAgb()) ? 'checked="checked"' : ''?> />
            <label>Ja, ich stimme den <a href="agb.php" target="_blank">Allgemeinen Geschäftsbedingungen</a> von zweiradspion.de zu.</label>
        </div>
        <div class="formField checkbox<?=$datenschutzErr?>">
            <p class="error">Bitte stimmen Sie den Datenschutzbedingungen zu</p>
            <input type="checkbox" name="datenschutz" value="1"<?=($user->getDatenschutz()) ? 'checked="checked"' : ''?> />
            <label>Ja, ich willige in die Nutzung meiner Daten gemäß der <a href="datenschutz.php" target="_blank">Datenschutz-Erklärung</a> von zweiradspion.de ein.
                Diese Einwilligung betrifft u. a. die Verwendung Ihrer Daten für Marketingzwecke (z. B. Zusendung von eMails).
                Nach Ihrer Anmeldung können Sie die Benachrichtigungseinstellungen jederzeit in ihrem Profil ändern.
            </label>
        </div>
        <div class="formField">
            <input class="submit" type="button" value="Senden" />
        </div>
    </form>
<?
} ?>
    </div>
    <?php include 'includes/footer.php'; ?>
</body>
</html>
