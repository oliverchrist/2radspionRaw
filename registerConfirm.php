<?php
include 'includes/init.php';
include 'includes/head.php';
use de\zweiradspion\DatabaseHelper;
use de\zweiradspion\DebugHelper;
use de\zweiradspion\HeaderHelper;
use de\zweiradspion\NavigationHelper;
?>
<body id="std">
    <?=HeaderHelper::getHeader('Registrierungsbestätigung')?>
	<div id="content">
        <?=NavigationHelper::getSubnavigation()?>
	    <?php
	    if(isset($_GET['x'])){
            # Hash aus Url holen
            $hash = $_GET['x'];
            if(!$hash) die ('Es wurde kein Hash übergeben<br>');
            #echo '<p>Hash: ' . $hash . '</p>';
            
            $dbObject = new DatabaseHelper();
            
            # Prüfen ob User schon confirmed wurde
            if($dbObject->valueInTable($hash,'hash','user')){
                die('<span class="error">Dieser Benutzer wurde bereits bestätigt.</span>');
            }
            
            # User aus userunconfirmed Tabelle holen
            $sql = 'SELECT * FROM userunconfirmed WHERE hash = "' . mysql_real_escape_string($hash) . '"';
            $result = mysql_query($sql);
            $row = mysql_fetch_assoc($result);
            if(!$row) die ('<span class="error">Konnte Hash nicht in Tabelle userunconfirmed finden</span><br>');
            
            $uid = $row['uid'];
            $hash = $row['hash'];
            $password = $row['password'];
            $email = $row['email'];
            $postcode = $row['postcode'];
            $city = $row['city'];
            $latlng = $row['latLng'];
            $lat = $row['lat'];
            $lng = $row['lng'];
            
            # User in Tabelle user übertragen
            $result = mysql_query("INSERT INTO user (hash, password, email, postcode, city, latLng, lat, lng) VALUES ('"
                    . $hash . "', '"
                    . $password . "', '"
                    . $email . "', "
                    . $postcode . ", '"
                    . $city . "', '"
                    . $latlng . "', "
                    . $lat . ", "
                    . $lng . ")");
            if(!$result){
                die('<span class="error">Could not write to table user</span><br>');
            }else{
                #echo 'User wurde in bestätigte Tabelle geschrieben.<br>';
            }
            
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
