<?php include 'includes/head.php'; ?>
<body id="std">
    <?php include 'includes/header.php'; ?>
	<div id="content">
	    <?php
	    # ist Benutzer eingeloggt?
	    if(isset($_SESSION['uid'])){
            $showForm = true;
            $action = 'new';
            
            if($_POST){
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
                    # TODO CURDATE() ergänzen
                    include 'includes/dbConnect.php';
                    $mysqlQueryInsert = mysql_query("INSERT INTO bike (pid, hersteller, modell, preis, erstellt) VALUES ('"
                        . $_SESSION['uid'] . "', '"
                        . mysql_real_escape_string(trim($hersteller)) . "', '"
                        . mysql_real_escape_string(trim($modell)) . "', '"
                        . mysql_real_escape_string(trim($preis))
                        . "', 'CURRENT_TIMESTAMP')");
                    if(!$mysqlQueryInsert){
                        die ('<span class="error">Fahrrad konnte nicht in die Datenbank bike geschrieben werden</span><br>');
                    }else{
                        echo 'Das Fahrrad wurde in die Datenbank bike geschrieben<br>';
                        $showForm = false;
                    }
                }
            }
    
            if($showForm){
            ?>
            <form method="post" action="bike.php">
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
            </form>
            <? }
        } ?>
    </div>
    <?php include 'includes/footer.php'; ?>
</body>
</html>
