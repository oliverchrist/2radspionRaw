<?php
use de\zweiradspion\DatabaseHelper,
    de\zweiradspion\DebugHelper,
    de\zweiradspion\HeaderHelper,
    de\zweiradspion\NavigationHelper,
    de\zweiradspion\FormHelper,
    de\zweiradspion\Mail,
    de\zweiradspion\User,
    de\zweiradspion\Login;

include 'includes/init.php';

$anbieterErr    = '';
$anredeErr      = '';
$nameErr        = '';
$vornameErr     = '';
$firmaErr       = '';
$passwordErr    = '';
$password2Err   = '';
$emailErr       = '';
$postcodeErr    = '';
$agbErr         = '';
$datenschutzErr = '';
$showForm       = TRUE;
$keineFehler    = TRUE;
$user           = new User();
$message        = '';
if($_POST){
    $user->loadFromPost($_POST);
    $anbieter = $user->getAnbieter();
    if($anbieter == -1){
        $anbieterErr = ' error';
        $keineFehler = FALSE;
    }
    $anrede = $user->getAnrede();
    if(empty($anrede)){
        $anredeErr   = ' error';
        $keineFehler = FALSE;
    }
    $name = $user->getName();
    if(empty($name)){
        $nameErr     = ' error';
        $keineFehler = FALSE;
    }
    $vorname = $user->getVorname();
    if(empty($vorname)){
        $vornameErr  = ' error';
        $keineFehler = FALSE;
    }
    $firma = $user->getFirma();
    if($anbieter == 'haendler' && empty($firma)){
        $firmaErr    = ' error';
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
        $keineFehler  = FALSE;
    }
    $email = $user->getEmail();
    if(empty($email) || !FormHelper::isEmail($email)){
        $emailErr    = ' error';
        $keineFehler = FALSE;
    }
    $postcode = $user->getPostcode();
    if(empty($postcode) || !preg_match('/\d{5}/', $postcode)){
        $postcodeErr = ' error';
        $keineFehler = FALSE;
    }
    $agb = $user->getAgb();
    if(empty($agb)){
        $agbErr      = ' error';
        $keineFehler = FALSE;
    }
    $datenschutz = $user->getDatenschutz();
    if(empty($datenschutz)){
        $datenschutzErr = ' error';
        $keineFehler    = FALSE;
    }
    if($keineFehler){
        # Prüfen ob Benutzer bereits existiert in Tabelle user und userunconfirmed
        $uniqueUser = TRUE;
        $dbObject   = new DatabaseHelper();
        # Prüfen ob email bereits existiert in Tabelle user und userunconfirmed
        if($dbObject->valueInTable($email,'email','user') || $dbObject->valueInTable($email,'email','userunconfirmed')){
            $message .= '<p class="error">Diese Email-Adresse gibt es bereits.</p><br>';
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
                $user->setPassword2(NULL);
                $user->setPassword(md5($user->getPassword()));
                $user->insertInDatabase('userunconfirmed');
            }catch(Exception $e){
                print $e->getMessage();
            }

            $showForm = FALSE;

            $message = "Guten Tag,\n
vielen Dank für Ihre Anmeldung bei zweiradspion.de.\n
Um die Anmeldung abzuschließen klicken Sie folgenden Link, oder kopieren diesen in die Adresszeile Ihres Browser:\n
http://" . DOMAIN . "/registerConfirm.php?x=" . $hashFinal . "\n
\n
Sollten Sie sich nicht bei zweiradspion angemeldet haben ignorieren Sie diese Email einfach.\n
\n
Mit freundlichen Grüßen\n
\n
Das Team von zweiradspion.de";
            if(Mail::send($email, '2radspion Confirm', $message)) {
                $message .= 'Wir haben Ihnen eine Email zur Überprufung gesendet, bitte sehen Sie in Ihrem Posteingang nach und schließen Sie die Anmeldung ab.';
            }else{
                die('<span class="error">Mail konnte nicht verschickt werden</span><br>');
            }
        }
    }
}
echo $twig->render('register.html', array(
    'headline' => 'Registrierung',
    'isLoggedIn' => Login::isLoggedIn(),
    'pageClass' => 'user',
    'linkTarget' => '_top',
    'showForm' => $showForm,
    'anbieterErr' => $anbieterErr,
    'user' => $user,
    'anredeErr' => $anredeErr,
    'nameErr' => $nameErr,
    'vornameErr' => $vornameErr,
    'firmaErr' => $firmaErr,
    'postcodeErr' => $postcodeErr,
    'emailErr' => $emailErr,
    'passwordErr' => $passwordErr,
    'password2Err' => $password2Err,
    'agbErr' => $agbErr,
    'datenschutzErr' => $datenschutzErr,
    'message' => $message
));

