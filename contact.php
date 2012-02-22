<?php
include 'includes/init.php';
include 'includes/head.php';
use de\zweiradspion\HeaderHelper,
    de\zweiradspion\NavigationHelper,
    de\zweiradspion\Fahrrad,
    de\zweiradspion\Kontakt,
    de\zweiradspion\Mail;
?>
<body id="std">
    <?=HeaderHelper::getHeader('Detailansicht')?>
	<div id="content">
    <?=NavigationHelper::getSubnavigation()?>
	<?php
        if(isset($_GET['uid'])){
            $fahrrad = new Fahrrad($_GET['uid']);
            $kontakt = new Kontakt($fahrrad->getPid());
            $nameErr  = '';
            $emailErr = '';
            if($_POST){
                if(!empty($_POST['email'])
                    && !empty($_POST['name'])
                    == !empty($_POST['nachricht'])
                ){
                    $message = "http://" . de\zweiradspion\DOMAIN . "/detail.php?uid=" . $_GET['uid'] . "\n
Name: {$_POST['name']}\n
Email: {$_POST['email']}\n
Nachricht: {$_POST['nachricht']}\n
\n
Das Team von zweiradspion.de";
                    if(Mail::send($kontakt->getEmail(), 'Anfrage', $message)) {
                        echo '<p>Ihre Email wurde versendet.</p>';
                    }else{
                        die('<span class="error">Mail konnte nicht verschickt werden</span><br>');
                    }
                    if($_POST['cc']){
                        if(Mail::send($_POST['email'], 'Anfrage', $message)) {
                            echo '<p>Ihre Email wurde versendet.</p>';
                        }else{
                            die('<span class="error">Mail konnte nicht verschickt werden</span><br>');
                        }
                    }
                    
                }else{
                    echo 'error';
                }
            }
            ?>
            <div class="contact">
                <div class="address">
                    Anbieter:<br>
                    <?=$kontakt->getPostcode()?> <?=$kontakt->getCity()?>
                </div>
                <form method="post" action="contact.php?uid=<?=$_GET['uid']?>">
                    <input type="hidden" name="uid" value="<?=$fahrrad->getUid()?>" />
                    <input type="hidden" name="pid" value="<?=$kontakt->getUid()?>" />
                    <div class="formField textarea">
                        <label>Ihre Nachricht an den Anbieter:</label>
                        <textarea name="nachricht"></textarea>
                        <div class="clear"></div>
                    </div>
                    <div class="formField<?=$nameErr?>">
                        <p class="error">Bitte geben Sie Ihren Namen ein</p>
                        <label>Ihr Name</label>
                        <input type="text" name="name" value="" />
                    </div>
                    <div class="formField<?=$emailErr?>">
                        <p class="error">Bitte geben Sie Ihre E-Mail-Adresse ein</p>
                        <label>Ihre E-Mail-Adresse</label>
                        <input type="text" name="email" value="" />
                    </div>
                    <div class="formField">
                        <label>Bitte schicken Sie eine Kopie dieser Nachricht an meine E-Mail-Adresse</label>
                        <input type="checkbox" name="cc" value="" />
                    </div>
                    <div class="formField">
                        <input class="submit" type="submit" value="Senden" />
                    </div>
                </form>                
            </div>

        <? } ?>
    </div>          
    <?php include 'includes/footer.php'; ?>
</body>
</html>
