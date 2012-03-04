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
    <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
    <?=HeaderHelper::getHeader('Benutzerdaten')?>
    <div id="content">
<?=NavigationHelper::getSubnavigation()?>
<?php
# ist Benutzer eingeloggt?
if(isset($_SESSION['uid'])){
    $anbieterErr  = '';
    $anredeErr    = '';
    $nameErr      = '';
    $vornameErr   = '';
    $firmaErr     = '';
    $passwordErr  = '';
    $password2Err = '';
    $emailErr     = '';
    $postcodeErr  = '';
    $showForm     = TRUE;
    $keineFehler  = TRUE;
    $user         = new User();
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
        if($anbieter == 'haendler' && empty($firma)){
            $firmaErr = ' error';
            $keineFehler = FALSE;
        }
        $postcode = $user->getPostcode();
        if(empty($postcode) || !preg_match('/\d{5}/', $postcode)){
            $postcodeErr = ' error';
            $keineFehler = FALSE;
        }
        if($keineFehler){
            try{
                $user->updateInDatabase();
            }catch(Exception $e){
                print $e->getMessage();
            }
            $showForm = FALSE;
        }
    }else{
        $user->loadFromDatabase($_SESSION['uid']);
    }

    if($showForm){ ?>
        <form method="post" id="userdata">
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
            <div class="formField<?=$postcodeErr?>">
                <p class="error">Bitte geben Sie eine gültige Postleitzahl Adresse ein</p>
                <label>Postleitzahl</label><input type="text" name="postcode" value="<?=$user->getPostcode()?>" />
            </div>
            <div class="formField">
                <input class="submit" type="button" value="Senden" />
            </div>
        </form>
    <?
    } ?>
    <a class="txtLnk" href="location.php?pid=<?=$_SESSION['uid']?>">Ort auf Karte zeigen</a>
<?
} ?>
    </div>
    <?php include 'includes/footer.php'; ?>
</body>
</html>
