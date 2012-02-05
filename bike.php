<?php
include 'includes/head.php';
include 'includes/DatabaseHelper.php';
include 'includes/ScaleImage.php';
include 'includes/DebugHelper.php';
include 'includes/HeaderHelper.php';
include 'includes/NavigationHelper.php';
use de\zweiradspion\DatabaseHelper;
use de\zweiradspion\DebugHelper;
use de\zweiradspion\HeaderHelper;
use de\zweiradspion\NavigationHelper;
?>
<body id="std">
    <?
    $title = (isset($_GET['uid']))?'Angebot ändern':'Angebot hinzufügen';
    echo HeaderHelper::getHeader($title);
    ?>
	<div id="content">
        <?=NavigationHelper::getSubnavigation()?>
	    <?php
	    # ist Benutzer eingeloggt?
	    if(isset($_SESSION['uid'])){
            $uid = '';
            $herstellerErr = '';
            $hersteller = '';
            $modellErr = '';
            $modell = '';
            $preisErr = '';
            $preis = '';
            $showForm = true;
            $action = 'new';
            
            if($_POST){
                $uid = $_POST['uid'];
                $hersteller = $_POST['hersteller'];
                $modell = $_POST['modell'];
                $preis = $_POST['preis'];
                if(empty($hersteller)) $herstellerErr = ' error';
                if(empty($modell)) $modellErr = ' error';
                if(empty($preis)) $preisErr = ' error';
                # Wenn alle Eingaben ok sind
                if(
                    !empty($hersteller)
                    && !empty($modell)
                    && !empty($preis)
                ){
                    $dbObject = new DatabaseHelper();
                    # insert
                    if(empty($uid)){
                        $result = mysql_query("INSERT INTO bike (pid, hersteller, modell, preis, erstellt, geaendert) VALUES ('"
                            . $_SESSION['uid'] . "', '"
                            . mysql_real_escape_string(trim($hersteller)) . "', '"
                            . mysql_real_escape_string(trim($modell)) . "', '"
                            . mysql_real_escape_string(trim($preis))
                            . "', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)");
                        if(!$result){
                            die ('<span class="error">Fahrrad konnte nicht in die Datenbank bike geschrieben werden</span><br>');
                        }else{
                            echo 'Das Fahrrad wurde in die Datenbank bike geschrieben<br>';
                            $showForm = false;
                        }
                    # update
                    }else{
                        $result = mysql_query('UPDATE bike SET '
                            . 'hersteller="' . mysql_real_escape_string(trim($hersteller)) . '", '
                            . 'modell="' . mysql_real_escape_string(trim($modell)) . '", '
                            . 'preis="' . mysql_real_escape_string(trim($preis)) . '"'
                            . 'WHERE uid=' . mysql_real_escape_string(trim($uid)));
                        if(!$result){
                            die ('<span class="error">Fahrrad konnte nicht in der Datenbank bike upgedated werden</span><br>');
                        }else{
                            echo 'Das Fahrrad wurde in die Datenbank bike geschrieben<br>';
                            $showForm = false;
                        }
                    }
                }
            }elseif(isset($_GET['uid'])){
                $dbObject = new DatabaseHelper();
                $result = mysql_query("select * from bike where uid=" . mysql_real_escape_string($_GET['uid']) . " && pid=" . $_SESSION['uid']);
                $row = mysql_fetch_assoc($result);
                $uid = $row['uid'];
                $hersteller = $row['hersteller'];
                $modell = $row['modell'];
                $preis = $row['preis'];
            }
    
            if($showForm){
            ?>
            <form method="post" action="bike.php">
                <input type="hidden" name="uid" value="<?=$uid?>" />
                <div class="formField<?=$herstellerErr?>">
                    <p class="error">Bitte geben Sie einen Herrsteller ein</p>
                    <label>Hersteller</label><input type="text" name="hersteller" value="<?=$hersteller?>" />
                </div>
                <div class="formField<?=$modellErr?>">
                    <p class="error">Bitte geben Sie ein Modell ein</p>
                    <label>Modell</label><input type="text" name="modell" value="<?=$modell?>" />
                </div>
                <div class="formField<?=$preisErr?>">
                    <p class="error">Bitte geben Sie einen Preis ein</p>
                    <label>Preis</label><input type="text" name="preis" value="<?=$preis?>" />
                </div>
                <div class="formField">
                    <input class="submit" type="submit" value="<?=$action?>" />
                </div>
                <?php
                if(isset($uid)){
                ?>
                    <a class="txtLnk" href="addPicture.php?uid=<?=$uid?>">Bild hinzufügen</a>  
                    <a class="txtLnk" href="detail.php?uid=<?=$uid?>">Zurück</a>  
                <?php } ?>
            </form>
            <? }
        } ?>
    </div>
    <?php include 'includes/footer.php'; ?>
</body>
</html>
