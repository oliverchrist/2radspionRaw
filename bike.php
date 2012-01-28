<?php include 'includes/head.php'; ?>
<body id="std">
    <?php include 'includes/header.php'; ?>
	<div id="content">
	    <?php
        $showForm = true;
        $action = 'new';
        
        if($_POST){
            $hersteller = $_POST['hersteller'];
            $modell = $_POST['modell'];
            $preis = $_POST['preis'];
            if(empty($hersteller)) $herstellerErr = ' error';
            if(empty($modell)) $modellErr = ' error';
            if(empty($preis)) $preisErr = ' error';
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
        <? } ?>
    </div>
    <?php include 'includes/footer.php'; ?>
</body>
</html>
