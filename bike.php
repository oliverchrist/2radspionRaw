<?php
include 'includes/head.php';
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
            $markeErr = '';
            $marke = '';
            $modellErr = '';
            $modell = '';
            $preisErr = '';
            $preis = '';
            $showForm = true;
            $action = 'new';
            
            if($_POST){
                $uid = $_POST['uid'];
                $marke = $_POST['marke'];
                $modell = $_POST['modell'];
                $preis = $_POST['preis'];
                if(empty($marke)) $markeErr = ' error';
                if(empty($modell)) $modellErr = ' error';
                if(empty($preis)) $preisErr = ' error';
                # Wenn alle Eingaben ok sind
                if(
                    !empty($marke)
                    && !empty($modell)
                    && !empty($preis)
                ){
                    $dbObject = new DatabaseHelper();
                    # insert
                    if(empty($uid)){
                        $result = mysql_query("INSERT INTO bike (pid, marke, modell, preis, erstellt, geaendert) VALUES ('"
                            . $_SESSION['uid'] . "', '"
                            . mysql_real_escape_string(trim($marke)) . "', '"
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
                            . 'marke="' . mysql_real_escape_string(trim($marke)) . '", '
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
                $dbObject = new DatabaseHelper();
                $result = mysql_query("select * from bike where uid=" . mysql_real_escape_string($_GET['uid']) . " && pid=" . $_SESSION['uid']);
                $row = mysql_fetch_assoc($result);
                $uid = $row['uid'];
                $marke = $row['marke'];
                $modell = $row['modell'];
                $preis = $row['preis'];
            }
    
            if($showForm){
            ?>
            <form method="post" action="bike.php">
                <input type="hidden" name="uid" value="<?=$uid?>" />
                <div class="formField<?=$markeErr?>">
                    <p class="error">Bitte geben Sie einen Herrsteller ein</p>
                    <label>Marke</label><input type="text" name="marke" value="<?=$marke?>" />
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
