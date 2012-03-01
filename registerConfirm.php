<?php
include 'includes/init.php';
include 'includes/head.php';
use de\zweiradspion\DatabaseHelper,
    de\zweiradspion\DebugHelper,
    de\zweiradspion\HeaderHelper,
    de\zweiradspion\NavigationHelper,
    de\zweiradspion\User;
?>
<body id="std">
    <?=HeaderHelper::getHeader('Registrierungsbestätigung')?>
    <div id="content">
<?=NavigationHelper::getSubnavigation()?>
<?php
if(isset($_GET['x'])){
    # Hash aus Url holen
    $hash = $_GET['x'];
    if(!$hash) { die ('Es wurde kein Hash übergeben<br>'); }
    #echo '<p>Hash: ' . $hash . '</p>';

    # Prüfen ob User schon confirmed wurde
    $dbObject = new DatabaseHelper();
    if($dbObject->valueInTable($hash,'hash','user')){
        die('<span class="error">Dieser Benutzer wurde bereits bestätigt.</span>');
    }

    $user = new User();
    $user->loadFromDatabase($hash, 'hash', 'userunconfirmed');
    $user->insertInDatabase();

    # User in Tabelle userunconfirmed löschen
    $result = mysql_query("DELETE FROM userunconfirmed WHERE hash = '" . mysql_real_escape_string($hash) . "'");
    if(!$result){
        die('<span class="error">User mit Hash' . $hash . ' konnte nicht gelöscht werden</span><br>');
    }else{
        #echo 'User mit Hash ' . $hash . ' wurde in Tabelle userunconfirmed gelöscht.<br>';
    }
    echo '<p>Vielen Dank, die Anmeldung ist abgeschlossen. Sie können sich jetzt mit Ihrer E-Mail-Adresse und dem gewählten Passwort einloggen.</p>';
}
?>
        <p><a class="txtLnk" href="login.php">Login</a></p>
    </div>
    <?php include 'includes/footer.php'; ?>
</body>
</html>
