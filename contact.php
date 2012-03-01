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
<?=HeaderHelper::getHeader('Kontakt')?>
<div id="content">
<?=NavigationHelper::getSubnavigation()?>
<?php
if(isset($_GET['uid'])){
    $fahrrad      = new Fahrrad($_GET['uid']);
    $kontakt      = new Kontakt($fahrrad->getPid());
    $nachricht    = '';
    $nachrichtErr = '';
    $name         = '';
    $nameErr      = '';
    $email        = '';
    $emailErr     = '';
    $cc           = '';
    $showform     = TRUE;
    $formValid    = TRUE;
    if($_POST){
        # Validierung
        if(empty($_POST['email'])) {
            $emailErr  = ' error';
            $formValid = FALSE;
        }else{
            $email = $_POST['email'];
        }
        if(empty($_POST['name'])) {
            $nameErr   = ' error';
            $formValid = FALSE;
        }else{
            $name = $_POST['name'];
        }
        if(empty($_POST['nachricht'])) {
            $nachrichtErr = ' error';
            $formValid    = FALSE;
        }else{
            $nachricht = $_POST['nachricht'];
        }
        if(isset($_POST['cc'])) {
            $cc = ' checked="checked"';
        }
        if($formValid){
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
                    echo '<p>Ihre CC Email wurde versendet.</p>';
                }else{
                    die('<span class="error">Mail konnte nicht verschickt werden</span><br>');
                }
            }
            $showform = FALSE;
        }
    }
    if($showform){ ?>
        <div class="contact">
            <div class="address">
                Anbieter:<br>
                <?=$kontakt->getPostcode()?> <?=$kontakt->getCity()?>
            </div>
            <form method="post" action="contact.php?uid=<?=$_GET['uid']?>">
                <input type="hidden" name="uid" value="<?=$fahrrad->getUid()?>" />
                <input type="hidden" name="pid" value="<?=$kontakt->getUid()?>" />
                <div class="formField textarea<?=$nachrichtErr?>">
                    <p class="error">Bitte geben Sie Ihre Nachricht ein</p>
                    <label>Ihre Nachricht an den Anbieter:</label>
                    <textarea name="nachricht"><?=$nachricht?></textarea>
                    <div class="clear"></div>
                </div>
                <div class="formField<?=$nameErr?>">
                    <p class="error">Bitte geben Sie Ihren Namen ein</p>
                    <label>Ihr Name</label>
                    <input type="text" name="name" value="<?=$name?>" />
                </div>
                <div class="formField<?=$emailErr?>">
                    <p class="error">Bitte geben Sie Ihre E-Mail-Adresse ein</p>
                    <label>Ihre E-Mail-Adresse</label>
                    <input type="text" name="email" value="<?=$email?>" />
                </div>
                <div class="formField">
                    <label>Bitte schicken Sie eine Kopie dieser Nachricht an meine E-Mail-Adresse</label>
                    <input type="checkbox" name="cc"<?=$cc?> />
                </div>
                <div class="formField">
                    <input class="submit" type="submit" value="Senden" />
                </div>
            </form>
        </div>
    <?
    } ?>

<?
} ?>
    </div>
    <?php include 'includes/footer.php'; ?>
</body>
</html>
