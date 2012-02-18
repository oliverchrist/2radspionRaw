<?php
include 'includes/init.php';
include 'includes/head.php';
use de\zweiradspion\DatabaseHelper,
    de\zweiradspion\DebugHelper,
    de\zweiradspion\HeaderHelper,
    de\zweiradspion\NavigationHelper;
?>
<body id="std">
    <?
    $title = 'Alle Angebote';
    if(isset($_GET['filter'])){
        switch ($_GET['filter']) {
            case 'myOffers':
                $title = 'Meine Angebote';
                break;
            case 'notepad':
                $title = 'Merkzettel';
                break;
            default:
                $title = $_GET['filter'];
                break;
        }
    }
    echo HeaderHelper::getHeader($title);
    ?>
	<div id="content">
	    <?=NavigationHelper::getSubnavigation()?>
	    <?php
        echo '<form class="search" method="post">';
        $dbObject = new DatabaseHelper();
        $dbObject->generateFilterDropdown('marke', 'bike');
        $dbObject->generateFilterDropdown('modell', 'bike');
        $dbObject->generateFilterDropdown('radtyp', 'bike');
        $dbObject->generateFilterDropdown('geschlecht', 'bike');
        $dbObject->generateFilterDropdown('zustand', 'bike');
        $dbObject->generateFilterDropdown('farbe', 'bike');
        $dbObject->generateFilterDropdown('bremssystem', 'bike');
        $dbObject->generateFilterDropdown('schaltungstyp', 'bike');
        $dbObject->generateFilterDropdown('rahmenmaterial', 'bike');
        $dbObject->generateFilterDropdown('beleuchtungsart', 'bike');
        $dbObject->generateFilterDropdown('einsatzbereich', 'bike');
        $laufleistung = (isset($_POST['laufleistung'])) ? $_POST['laufleistung'] : '';
        $radgroesse = (isset($_POST['radgroesse'])) ? $_POST['radgroesse'] : '';
        $rahmenhoehe = (isset($_POST['rahmenhoehe'])) ? $_POST['rahmenhoehe'] : '';
        $preis = (isset($_POST['preis'])) ? $_POST['preis'] : '';
        
        echo "<div class=\"clear\"></div>";
        echo "<div class=\"inputField\"><label>Laufleistung max.</label><input name=\"laufleistung\" value=\"$laufleistung\"><span>km</span></div>";
        echo "<div class=\"inputField\"><label>Radgröße</label><input name=\"radgroesse\" value=\"$radgroesse\"><span>Zoll</span></div>";
        echo "<div class=\"inputField\"><label>Rahmenhöhe</label><input name=\"rahmenhoehe\" value=\"$rahmenhoehe\"><span>cm</span></div>";
        echo "<div class=\"inputField\"><label>Preis max.</label><input name=\"preis\" value=\"$preis\"><span>EUR</span></div>";

        echo "<div class=\"clear\"></div>";
        echo "<div class=\"checkboxField\">";
        $orderDistanceChecked = (isset($_POST['orderDistance'])) ? ' checked="checked"' : '';
        if(isset($_SESSION['lat']) && isset($_SESSION['lng'])){
            echo '<input name="orderDistance" type="checkbox"' . $orderDistanceChecked . '><label>Nahe Angebote zuerst</label>';
        }
        echo '</div>';
        
        echo '<div class="control">';
        echo '<input type="reset" class="reset" value="Reset">';
        echo '<input type="submit" class="submit" value="Filtern">';
        echo '</div>';
        echo '</form>';

        $condition = array();
        $join = array();
        $order = array();
        $column = array();
        if($_POST){
            $condition = $dbObject->generateCondition($condition, 'marke');
            $condition = $dbObject->generateCondition($condition, 'modell');
            $condition = $dbObject->generateCondition($condition, 'radtyp');
            $condition = $dbObject->generateCondition($condition, 'geschlecht');
            $condition = $dbObject->generateCondition($condition, 'zustand');
            $condition = $dbObject->generateCondition($condition, 'farbe');
            $condition = $dbObject->generateCondition($condition, 'bremssystem');
            $condition = $dbObject->generateCondition($condition, 'schaltungstyp');
            $condition = $dbObject->generateCondition($condition, 'rahmenmaterial');
            $condition = $dbObject->generateCondition($condition, 'beleuchtungsart');
            $condition = $dbObject->generateCondition($condition, 'einsatzbereich');
            
            $condition = $dbObject->generateCondition($condition, 'laufleistung', '<=');
            $condition = $dbObject->generateCondition($condition, 'radgroesse');
            $condition = $dbObject->generateCondition($condition, 'rahmenhoehe');
            $condition = $dbObject->generateCondition($condition, 'preis', '<=');
        }
        if(isset($_GET['filter']) && $_GET['filter'] == 'myOffers' && isset($_SESSION['uid'])){
            $condition[] = 'bike.pid = ' . $_SESSION['uid'];
        }
        if(isset($_GET['filter']) && $_GET['filter'] == 'notepad' && isset($_SESSION['uid'])){
            $join [] = 'right join notepad on bike.uid = notepad.id';
            $condition[] = 'notepad.pid=' . $_SESSION['uid'];
            $column[] = ', notepad.id, notepad.remark';
        }
        $sqlAdditionalCondition = '';
        $sqlAdditionalJoin = '';
        $sqlAdditionalColumn = '';
        $sqlOrder = (isset($_POST['orderDistance']) && isset($_SESSION['lat']) && isset($_SESSION['lng'])) ? 'distance ASC, ' : '';
        if(!empty($condition)) $sqlAdditionalCondition = 'where ' . implode(' and ', $condition);
        if(!empty($join)) $sqlAdditionalJoin = ' ' . implode(' ', $join);
        if(!empty($column)) $sqlAdditionalColumn = implode('', $column);
        $sql = "select bike.uid,bike.pid,marke,modell,preis,bike.erstellt,bike.geaendert"
            . ",name,extension,reihenfolge" . $sqlAdditionalColumn;
            if(isset($_SESSION['lat']) && isset($_SESSION['lng'])){
            $sql .= ",user.lat, user.lng, (111.3 * ({$_SESSION['lat']} - user.lat)) as dy, (71.5 * ({$_SESSION['lng']} - user.lng)) as dx"
                . ", sqrt( POW((71.5 * ({$_SESSION['lng']} - user.lng)),2) + POW((111.3 * ({$_SESSION['lat']} - user.lat)),2) ) as distance";
            }
            $sql .= " from bike LEFT JOIN images ON bike.uid = images.pid LEFT JOIN user ON user.uid = bike.pid {$sqlAdditionalJoin}"
            . " {$sqlAdditionalCondition} group by bike.uid order by {$sqlOrder}bike.erstellt";
        #echo $sql;
        $result = mysql_query($sql);
        if($result){
            while ($row = mysql_fetch_assoc($result)) { ?>
                <div class="bikeListElement">
                    <?php if($row['uid'] == NULL && isset($row['id'])){
                        echo 'Das Zweirad mit der ID: ' . $row['id'] . ' wurde gelöscht<br>';
                        echo 'Bemerkung: ' . $row['remark'];
                    }else{ ?>
                        <?php if(!empty($row['name'])){
                            $imageObj = new ScaleImage($row['name'], $row['extension'], 'images');
                            $imagePath = $imageObj->getImagePath(200, 'auto');
                            ?>
                            <a class="thumb" href="detail.php?uid=<?=$row['uid']?>">
                                <img alt="<?=$row['modell']?>" src="<?=$imagePath?>" width="200" />
                            </a>
                        <?php } ?>
                        <div class="cnt">
                            <? /*=DebugHelper::info('id: ' . $row['id'])?>
                            <?=DebugHelper::info('uid: ' . $row['uid'])?>
                            <?=DebugHelper::info('uid: ' . $row['uid'])?>
                            <?=DebugHelper::info('pid: ' . $row['pid'])?>
                            <?=DebugHelper::info('lat: ' . $row['lat'])?>
                            <?=DebugHelper::info('lng: ' . $row['lng'])?>
                            <?=DebugHelper::info('dx: ' . $row['dx'])?>
                            <?=DebugHelper::info('dy: ' . $row['dy'])?>
                            <?=DebugHelper::info('distance: ' . $row['distance']) */?>
                            <? if(isset($row['distance'])){ ?>
                            Entfernung: <?printf("%.2f", $row['distance']);?> km<br>
                            <? } ?>
                            marke: <?=$row['marke']?><br>
                            modell: <?=$row['modell']?><br>
                            preis: <?=$row['preis']?><br>
                            erstellt: <?=$row['erstellt']?><br>
                            geaendert: <?=$row['geaendert']?><br>
                        </div>
                        <div class="links">
                            <a class="txtLnk" href="detail.php?uid=<?=$row['uid']?>">Ansehen</a>
                        </div>
                        <div class="clear"></div>
                    <? } ?>
                </div>            
            <?php }
         }else{
             echo '<p class="error">Fehler in der Datenbankabfrage</p>';
         }
        
    ?>
    </div>
    <?php include 'includes/footer.php'; ?>
</body>
</html>
