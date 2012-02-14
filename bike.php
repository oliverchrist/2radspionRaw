<?php
include 'includes/init.php';
include 'includes/head.php';
use de\zweiradspion\HeaderHelper,
    de\zweiradspion\NavigationHelper,
    de\zweiradspion\Fahrrad,
    de\zweiradspion\DatabaseHelper;
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
	        
            $markeErr = '';
            $modellErr = '';
            $preisErr = '';
            $laufleistungErr = '';
            $showForm = true;
            $keineFehler = true;
            $fahrrad = new Fahrrad();
            
            if($_POST){
                $fahrrad->loadFromPost($_POST);
                /*
                if($_POST['marke'] == -1 && empty($_POST['markeSonstige'])){
                    $markeErr = ' error';
                    $keineFehler = false;
                }
                if(empty($_POST['modell'])){
                    $modellErr = ' error';
                    $keineFehler = false;
                }
                if(empty($_POST['preis'])){
                    $preisErr = ' error';
                    $keineFehler = false;
                }
                # Wenn alle Eingaben ok sind
                if($keineFehler){
                    # insert
                    if(empty($uid)){
                        try{
                            $fahrrad->insertInDatabase();
                            echo 'Das Fahrrad wurde neu in die Datenbank bike geschrieben<br>';
                        }catch(Exception $e){
                            print $e->getMessage();
                        }
                        $showForm = false;
                    # update
                    }else{
                        try{
                            $fahrrad->updateInDatabase();
                            echo 'Das Fahrrad wurde in die Datenbank bike geschrieben<br>';
                        }catch(Exception $e){
                            print $e->getMessage();
                        }
                        $showForm = false;
                    }
                }*/
            }
            # DELETE
            elseif(isset($_GET['uid']) && isset($_GET['process']) && $_GET['process'] == 'delete'){
                $dbObject = new DatabaseHelper();
                $sql = 'DELETE FROM bike WHERE uid = ' . $_GET['uid'] . ' and pid = ' . $_SESSION['uid'];
                $result = mysql_query($sql);
                if($result){
                    echo 'Angebot mit der uid ' . $_GET['uid'] . ' erfolgreich gelöscht.';
                    # Bilder finden und sicher sein, daß dem User das Bike gehörte (session), deshalb im if Zweig
                    $sql = 'SELECT * FROM images WHERE pid = ' . $_GET['uid'];
                    $result = mysql_query($sql);
                    while($row = mysql_fetch_assoc($result)){
                        $filename = 'images/' . $row['name'] . '.' . $row['extension'];
                        if(unlink($filename)){
                            echo '<p>' . $filename . ' wurde gelöscht.</p>';
                        }else{
                            echo '<p>' . $filename . ' konnte nicht gelöscht werden.</p>';
                        }
                    }
                    $sql = 'DELETE FROM images WHERE pid = ' . $_GET['uid'];
                    $result = mysql_query($sql);
                    if($result){
                        echo "<p>Bilder mit der pid {$_GET['uid']} erfolgreich gelöscht</p>";
                    }else{
                        echo "<p>Bilder mit der pid {$_GET['uid']} konnten nicht gelöscht werden</p>";
                    }
                }else{
                    echo '<p class="error">Angebot mit der uid ' . $_GET['uid'] . ' konnte nicht gelöscht werden.</p>';
                }
                
                $showForm = false;
            }elseif(isset($_GET['uid'])){
                $fahrrad = new Fahrrad($_GET['uid']);
                $uid = $fahrrad->getUid();
                $marke = $fahrrad->getMarke();
                $modell = $fahrrad->getModell();
                $preis = $fahrrad->getPreis();
            }
    
            if($showForm){
            ?>
            <form method="post" action="bike.php">
                <div class="formField<?=$markeErr?>">
                    <p class="error">Bitte geben Sie einen Herrsteller ein</p>
                    <label>Marke</label>
                    <?=$fahrrad->getMarke()->getDropdown()?>
                </div>
                <div class="formField<?=$modellErr?>">
                    <p class="error">Bitte geben Sie ein Modell ein</p>
                    <label>Modell</label>
                    <input type="text" name="modell" value="<?=$fahrrad->getModell()?>" />
                </div>
                <div class="formField<?=$preisErr?>">
                    <p class="error">Bitte geben Sie einen Preis ein</p>
                    <label>Preis</label>
                    <input type="text" name="preis" value="<?=$fahrrad->getPreis()?>" />
                </div>
                <div class="formField">
                    <label>Radtyp</label>
                    <?=$fahrrad->getRadtyp()->getDropdown()?>
                </div>
                <div class="formField">
                    <label>Geschlecht</label>
                    <?=$fahrrad->getGeschlecht()->getDropdown()?>
                </div>
                <div class="formField">
                    <label>Zustand</label>
                    <?=$fahrrad->getZustand()->getDropdown()?>
                </div>
                <div class="formField<?=$laufleistungErr?>">
                    <p class="error">Bitte geben Sie eine Laufleistung ein</p>
                    <label>Laufleistung</label>
                    <input type="text" name="laufleistung" value="<?=$fahrrad->getLaufleistung()?>" />
                </div>
                <div class="formField">
                    <label>Radgroesse</label>
                    <?=$fahrrad->getRadgroesse()->getDropdown()?>
                </div>
                <div class="formField">
                    <label>Rahmenhoehe</label>
                    <?=$fahrrad->getRahmenhoehe()->getDropdown()?>
                </div>
                <div class="formField">
                    <label>Farbe</label>
                    <?=$fahrrad->getFarbe()->getDropdown()?>
                </div>
                <div class="formField">
                    <label>Bremssystem</label>
                    <?=$fahrrad->getBremssystem()->getDropdown()?>
                </div>
                <div class="formField">
                    <label>Schaltungstyp</label>
                    <?=$fahrrad->getSchaltungstyp()->getDropdown()?>
                </div>
                <div class="formField">
                    <label>Rahmenmaterial</label>
                    <?=$fahrrad->getRahmenmaterial()->getDropdown()?>
                </div>
                <div class="formField">
                    <label>Beleuchtungsart</label>
                    <?=$fahrrad->getBeleuchtungsart()->getDropdown()?>
                </div>
                <div class="formField">
                    <label>Einsatzbereich</label>
                    <?=$fahrrad->getEinsatzbereich()->getDropdown()?>
                </div>
                <div class="formField">
                    <input class="submit" type="submit" value="Senden" />
                </div>
            </form>
            <?php
            if(isset($uid)){
            ?>
                <a class="txtLnk" href="addPicture.php?uid=<?=$uid?>">Bild hinzufügen</a>  
                <a class="txtLnk delete" href="bike.php?uid=<?=$uid?>&process=delete">Löschen</a>  
                <a class="txtLnk" href="detail.php?uid=<?=$uid?>">Zurück</a>  
            <?php } ?>            
            <? }
        } ?>
    </div>
    <?php include 'includes/footer.php'; ?>
</body>
</html>
