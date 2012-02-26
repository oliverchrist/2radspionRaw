<?php
require_once ("Mail.php");
require_once ("Mail/mime.php");
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
    <?=HeaderHelper::getHeader('Mail Test')?>
    <div id="content">
    <?php
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
    ?>
    </div>
    <?php include 'includes/footer.php'; ?>
</body>
</html>
