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
    <?=HeaderHelper::getHeader('Bild hinzufügen')?>
	<div id="content">
        <?=NavigationHelper::getSubnavigation()?>
	    <?
        function getExtension($str) {
            $i = strrpos($str,".");
            if (!$i) { return ""; }
            $l = strlen($str) - $i;
            $ext = substr($str,$i+1,$l);
            return strtolower($ext);
        }
        	    
	    $dbObject = new DatabaseHelper();
        $result = mysql_query("select * from bike where uid=" . mysql_real_escape_string($_GET['uid']) . " && pid=" . $_SESSION['uid']);
        # sollte unique sein
	    if(mysql_num_rows($result) == 1){
	        $image = '';
            if($_POST){
                $uid = $_POST['uid'];
                $filename = stripslashes($_FILES['image']['name']);
                $extension = getExtension($filename);
                $imageName= time();
                $copied = copy($_FILES['image']['tmp_name'], 'images/' . $imageName . '.' . $extension);
                if (!$copied) 
                {
                    echo '<h1>Copy unsuccessfull!</h1>';
                }else{
                    echo 'Bild wurde hochgeladen.';
                    $sql = "INSERT INTO images (pid, name, extension) VALUES ('" . $uid . "','" . $imageName . "','" . $extension . "')";
                    $result = mysql_query($sql);
                    if($result){
                        echo 'Bild wurde der Datenbank hinzugefügt<br>';
                    }else{
                        echo '<p class="error">Das Bild konnte der Datenbank nicht hinzugefügt werden.</p>';
                    }
                }
            }
    	    ?>
            <form method="post" enctype="multipart/form-data">
                <input type="hidden" name="uid" value="<?=$_GET['uid']?>" />
                <div class="formField">
                    <p class="error">Bitte wählen Sie einen Bild aus</p>
                    <label>Bild</label><input type="file" name="image" value="<?=$image?>" />
                </div>
                <div class="formField">
                    <input class="submit" type="submit" />
                </div>
            </form>
        <? } ?>             
    </div>
    <?php include 'includes/footer.php'; ?>
</body>
</html>
