<?php
include 'includes/init.php';
include 'includes/head.php';
use de\zweiradspion\DatabaseHelper;
use de\zweiradspion\DebugHelper;
use de\zweiradspion\HeaderHelper;
use de\zweiradspion\NavigationHelper;
?>
<body id="std" onload="initialize();">
    <?=HeaderHelper::getHeader('Merkzettel')?>
	<div id="content">
	    <?=NavigationHelper::getSubnavigation()?>
	    <?php
	        # bike merken
            if(isset($_GET['uid'])){
                $dbObject = new DatabaseHelper();
                $sql = "insert into notepad (pid,id) values ({$_SESSION['uid']},{$_GET['uid']})";
                $result = mysql_query($sql);
                if($result){
                    echo 'Bike auf Merkzettel gespeichert<br>';
                }else{
                    echo 'Bike konnte nicht auf Merkzettel gespeichert werden<br>';
                }
                echo '<a class="txtLnk" href="detail.php?uid="'.$_GET['uid'].'">Zurück</a>';
            }
        ?>
    </div>
    <?php include 'includes/footer.php'; ?>
</body>
</html>
