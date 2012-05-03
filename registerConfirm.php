<?php
use de\zweiradspion\DatabaseHelper,
    de\zweiradspion\DebugHelper,
    de\zweiradspion\HeaderHelper,
    de\zweiradspion\NavigationHelper,
    de\zweiradspion\User,
    de\zweiradspion\Login;

include 'includes/init.php';

$message = '';
if(isset($_GET['x'])){
    # Hash aus Url holen
    $hash = $_GET['x'];
    if(!$hash) {
        $message .= 'Es wurde kein Hash übergeben';
    }else{
    #echo '<p>Hash: ' . $hash . '</p>';

        # Prüfen ob User schon confirmed wurde
        $dbObject = new DatabaseHelper();
        if($dbObject->valueInTable($hash,'hash','user')){
            die('<span class="error">Dieser Benutzer wurde bereits bestätigt.</span>');
        }

        $user = new User();
        if( $user->loadFromDatabase($hash, 'hash', 'userunconfirmed')) {
            $user->insertInDatabase();

            # User in Tabelle userunconfirmed löschen
            $result = mysql_query("DELETE FROM userunconfirmed WHERE hash = '" . mysql_real_escape_string($hash) . "'");
            if(!$result){
                die('<span class="error">User mit Hash' . $hash . ' konnte nicht gelöscht werden</span><br>');
            }else{
                #echo 'User mit Hash ' . $hash . ' wurde in Tabelle userunconfirmed gelöscht.<br>';
            }
            $message .= '<p>Vielen Dank, die Anmeldung ist abgeschlossen. Sie können sich jetzt mit Ihrer E-Mail-Adresse und dem gewählten Passwort einloggen.</p>';
        } else {
            $message .= "Hash $hash ist unbekannt.";
        }
    }
}

echo $twig->render('registerConfirm.html', array(
    'headline' => 'Weiterleiten',
    'isLoggedIn' => Login::isLoggedIn(),
    'pageClass' => 'tellAFriend',
    'linkTarget' => '_top',
    'message' => $message
));