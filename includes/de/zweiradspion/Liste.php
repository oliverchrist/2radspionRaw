<?php
namespace de\zweiradspion;
use de\zweiradspion\ScaleImage;

/**
 * Description of Liste
 *
 * @author oliver
 */
class Liste {
    protected $condition;
    protected $join;
    protected $order;
    protected $column;
    protected $dbObject;

    public function __construct() {
        $this->condition = array();
        $this->join      = array();
        $this->order     = array();
        $this->column    = array();
        $this->dbObject  = new DatabaseHelper();
    }

    public function getHeadline() {
        $headlines = array(
            'myOffers' => 'Meine Angebote',
            'allOffers' => 'Alle Angebote',
            'notepad' => 'Merkzettel',
            'newOffers' => 'Neue Angebote',
            'nearOffers' => 'Angebote in meiner Nähe');
        if(isset($_GET['filter']) && isset($headlines[$_GET['filter']])) {
            return $headlines[$_GET['filter']];
        }
        if(isset($_GET['filter'])) {
            return $_GET['filter'];
        }
        return 'Alle Angebote';
    }

    public function getFilter() {
        if(isset($_GET['filter'])) {
            return $_GET['filter'];
        }
        return FALSE;
    }


    public function printAreaSearch() {
        echo '<form class="search" method="post">';
        echo '<select name="area">';
        $areaDropdown = array('3' => 3, '10' => 10, '20' => 20, '50' => 50, '100' => 100, '200' => 200, '500' => 500, -1 => 'egal');
        foreach($areaDropdown as $key => $value){
            echo '<option value="' . $key . '"';
            if(isset($_POST['area'])) {
                if($key == $_POST['area']) {
                    echo ' selected="selected"';
                }
            }
            echo '>' . $value . ' km</option>';
        }
        echo '</select>';
        echo '<div class="clear"></div>';
        echo '<div class="control">';
        echo '<input type="reset" class="reset" value="Reset">';
        echo '<input type="submit" class="submit" value="Filtern">';
        echo '</div>';
        echo '</form>';

    }

    public function printTimeSearch() {
        echo '<form class="search" method="post">';
        echo '<select name="time">';
        $areaDropdown = array('1' => 1, '2' => 2, '3' => 3, '4' => 4, '5' => 5, '6' => 6, '12' => 12, -1 => 'egal');
        foreach($areaDropdown as $key => $value){
            echo '<option value="' . $key . '"';
            if(isset($_POST['time'])) {
                if($key == $_POST['time']) {
                    echo ' selected="selected"';
                }
            }
            echo '>' . $value . ' Monate</option>';
        }
        echo '</select>';
        echo '<div class="clear"></div>';
        echo '<div class="control">';
        echo '<input type="reset" class="reset" value="Reset">';
        echo '<input type="submit" class="submit" value="Filtern">';
        echo '</div>';
        echo '</form>';

    }

    public function printSearch() {
        echo '<form class="search" method="post">';

        $this->dbObject->generateFilterDropdown('marke', 'bike');
        $this->dbObject->generateFilterDropdown('modell', 'bike');
        $this->dbObject->generateFilterDropdown('radtyp', 'bike');
        $this->dbObject->generateFilterDropdown('geschlecht', 'bike');
        $this->dbObject->generateFilterDropdown('zustand', 'bike');
        $this->dbObject->generateFilterDropdown('farbe', 'bike');
        $this->dbObject->generateFilterDropdown('bremssystem', 'bike');
        $this->dbObject->generateFilterDropdown('schaltungstyp', 'bike');
        $this->dbObject->generateFilterDropdown('rahmenmaterial', 'bike');
        $this->dbObject->generateFilterDropdown('beleuchtungsart', 'bike');
        $this->dbObject->generateFilterDropdown('einsatzbereich', 'bike');
        $this->dbObject->generateFilterDropdown('radgroesse', 'bike');
        $laufleistungVon = FormHelper::getFromPost('laufleistungVon');
        $laufleistungBis = FormHelper::getFromPost('laufleistungBis');
        $rahmenhoeheVon  = FormHelper::getFromPost('rahmenhoeheVon');
        $rahmenhoeheBis  = FormHelper::getFromPost('rahmenhoeheBis');
        $preisVon        = FormHelper::getFromPost('preisVon');
        $preisBis        = FormHelper::getFromPost('preisBis');

        echo "<div class=\"clear\"></div>";
        echo "<div class=\"inputField\">
                <label>Laufleistung max.</label>
                <input type=\"text\" name=\"laufleistungVon\" value=\"$laufleistungVon\" placeholder=\"von\" maxlength=\"7\">
                <span>-</span>
                <input type=\"text\" name=\"laufleistungBis\" value=\"$laufleistungBis\" placeholder=\"bis\" maxlength=\"7\">
                <span>km</span>
              </div>";
        echo "<div class=\"inputField\">
                <label>Rahmenhöhe</label>
                <input type=\"text\" name=\"rahmenhoeheVon\" value=\"$rahmenhoeheVon\" placeholder=\"von\" maxlength=\"2\">
                <span>-</span>
                <input type=\"text\" name=\"rahmenhoeheBis\" value=\"$rahmenhoeheBis\" placeholder=\"bis\" maxlength=\"2\">
                <span>cm</span>
              </div>";
        echo "<div class=\"inputField\">
                <label>Preis</label>
                <input type=\"text\" name=\"preisVon\" value=\"$preisVon\" placeholder=\"von\" maxlength=\"7\">
                <span>-</span>
                <input type=\"text\" name=\"preisBis\" value=\"$preisBis\" placeholder=\"bis\" maxlength=\"7\">
                <span>EUR</span>
              </div>";

        echo "<div class=\"clear\"></div>";
        echo "<div class=\"checkboxField\">";
        $orderDistanceChecked = (isset($_POST['orderDistance'])) ? ' checked="checked"' : '';
        if(isset($_SESSION['lat']) && isset($_SESSION['lng'])){
            echo '<input name="orderDistance" type="checkbox"' . $orderDistanceChecked . '><label>Nahe Angebote zuerst</label>';
        }
        echo '</div>';
        #echo '<div class="saveForm">';
        #echo '<input name="save" type="text" placeholder="speichern als">';
        #echo '</div>';
        echo '<div class="control">';
        echo '<input type="reset" class="reset" value="Reset">';
        echo '<input type="submit" class="submit" value="Filtern">';
        echo '</div>';
        echo '</form>';
    }

    public function getSearch() {
        $html = '<form class="search" method="post">';

        $html .= $this->dbObject->getFilterDropdown('marke', 'bike');
        $html .= $this->dbObject->getFilterDropdown('modell', 'bike');
        $html .= $this->dbObject->getFilterDropdown('radtyp', 'bike');
        $html .= $this->dbObject->getFilterDropdown('geschlecht', 'bike');
        $html .= $this->dbObject->getFilterDropdown('zustand', 'bike');
        $html .= $this->dbObject->getFilterDropdown('farbe', 'bike');
        $html .= $this->dbObject->getFilterDropdown('bremssystem', 'bike');
        $html .= $this->dbObject->getFilterDropdown('schaltungstyp', 'bike');
        $html .= $this->dbObject->getFilterDropdown('rahmenmaterial', 'bike');
        $html .= $this->dbObject->getFilterDropdown('beleuchtungsart', 'bike');
        $html .= $this->dbObject->getFilterDropdown('einsatzbereich', 'bike');
        $html .= $this->dbObject->getFilterDropdown('radgroesse', 'bike');
        $laufleistungVon = FormHelper::getFromPost('laufleistungVon');
        $laufleistungBis = FormHelper::getFromPost('laufleistungBis');
        $rahmenhoeheVon  = FormHelper::getFromPost('rahmenhoeheVon');
        $rahmenhoeheBis  = FormHelper::getFromPost('rahmenhoeheBis');
        $preisVon        = FormHelper::getFromPost('preisVon');
        $preisBis        = FormHelper::getFromPost('preisBis');

        $html .= "<div class=\"clear\"></div>";
        $html .= "<div class=\"inputField\">
                <label>Laufleistung max.</label>
                <input type=\"text\" name=\"laufleistungVon\" value=\"$laufleistungVon\" placeholder=\"von\" maxlength=\"7\">
                <span>-</span>
                <input type=\"text\" name=\"laufleistungBis\" value=\"$laufleistungBis\" placeholder=\"bis\" maxlength=\"7\">
                <span>km</span>
              </div>";
        $html .= "<div class=\"inputField\">
                <label>Rahmenhöhe</label>
                <input type=\"text\" name=\"rahmenhoeheVon\" value=\"$rahmenhoeheVon\" placeholder=\"von\" maxlength=\"2\">
                <span>-</span>
                <input type=\"text\" name=\"rahmenhoeheBis\" value=\"$rahmenhoeheBis\" placeholder=\"bis\" maxlength=\"2\">
                <span>cm</span>
              </div>";
        $html .= "<div class=\"inputField\">
                <label>Preis</label>
                <input type=\"text\" name=\"preisVon\" value=\"$preisVon\" placeholder=\"von\" maxlength=\"7\">
                <span>-</span>
                <input type=\"text\" name=\"preisBis\" value=\"$preisBis\" placeholder=\"bis\" maxlength=\"7\">
                <span>EUR</span>
              </div>";

        $html .= "<div class=\"clear\"></div>";
        $html .= "<div class=\"checkboxField\">";
        $orderDistanceChecked = (isset($_POST['orderDistance'])) ? ' checked="checked"' : '';
        if(isset($_SESSION['lat']) && isset($_SESSION['lng'])){
            $html .= '<input name="orderDistance" type="checkbox"' . $orderDistanceChecked . '><label>Nahe Angebote zuerst</label>';
        }
        $html .= '</div>';
        #$html .= '<div class="saveForm">';
        #$html .= '<input name="save" type="text" placeholder="speichern als">';
        #$html .= '</div>';
        $html .= '<div class="control">';
        $html .= '<input type="reset" class="reset" value="Reset">';
        $html .= '<input type="submit" class="submit" value="Filtern">';
        $html .= '</div>';
        $html .= '</form>';
        return $html;
    }

    public function generateSqlAllOffers() {
        $dbObject        = new DatabaseHelper();
        $this->condition = $dbObject->generateCondition($this->condition, 'marke');
        $this->condition = $dbObject->generateCondition($this->condition, 'modell');
        $this->condition = $dbObject->generateCondition($this->condition, 'radtyp');
        $this->condition = $dbObject->generateCondition($this->condition, 'geschlecht');
        $this->condition = $dbObject->generateCondition($this->condition, 'zustand');
        $this->condition = $dbObject->generateCondition($this->condition, 'farbe');
        $this->condition = $dbObject->generateCondition($this->condition, 'bremssystem');
        $this->condition = $dbObject->generateCondition($this->condition, 'schaltungstyp');
        $this->condition = $dbObject->generateCondition($this->condition, 'rahmenmaterial');
        $this->condition = $dbObject->generateCondition($this->condition, 'beleuchtungsart');
        $this->condition = $dbObject->generateCondition($this->condition, 'einsatzbereich');
        $this->condition = $dbObject->generateCondition($this->condition, 'radgroesse');

        $this->condition = $dbObject->generateCondition($this->condition, 'laufleistung', '>=', 'laufleistungVon');
        $this->condition = $dbObject->generateCondition($this->condition, 'laufleistung', '<=', 'laufleistungBis');
        $this->condition = $dbObject->generateCondition($this->condition, 'rahmenhoehe', '>=', 'rahmenhoeheVon');
        $this->condition = $dbObject->generateCondition($this->condition, 'rahmenhoehe', '<=', 'rahmenhoeheBis');
        $this->condition = $dbObject->generateCondition($this->condition, 'preis', '>=', 'preisVon');
        $this->condition = $dbObject->generateCondition($this->condition, 'preis', '<=', 'preisBis');
    }

    public function initAllOffers() {
        if(isset($_SESSION['uid'])) {
            $this->join[]   = 'left join notepad on (bike.uid = notepad.id and notepad.pid = ' . $_SESSION['uid'] . ')';
            $this->column[] = 'notepad.uid as nuid';
        }
        $this->condition[] = 'aktiv = 1';
    }

    public function initMyOffers() {
        $this->condition[] = 'bike.pid = ' . $_SESSION['uid'];
    }

    public function initDealer($pid) {
        $this->condition[] = 'bike.pid = ' . $pid;
    }

    public function initNotepad() {
        $this->join[]      = 'right join notepad on bike.uid = notepad.id';
        $this->condition[] = 'notepad.pid=' . $_SESSION['uid'];
        $this->column[]    = 'notepad.uid as nuid, notepad.remark';
        $this->column[] = 'notepad.id as id';
    }

    public function initNewOffers() {
        $time = 1;
        if(isset($_POST['time']) && $_POST['time'] != -1) {
            $time = $_POST['time'];
        }
        if(isset($_POST['time']) && $_POST['time'] == -1) {
            $time = NULL;
        }
        if($time) {
            $now = new \DateTime;
            $now->modify( '-' . $time . ' month' );
            $this->condition[] = 'bike.erstellt > "' . $now->format( 'Y-m-d' ) . '"';
        }
        if(isset($_SESSION['uid'])) {
            $this->join[]   = 'left join notepad on (bike.uid = notepad.id and notepad.pid = ' . $_SESSION['uid'] . ')';
            $this->column[] = 'notepad.uid as nuid';
        }
        $this->condition[] = 'aktiv = 1';
    }

    public function initNearOffers() {
        $area = 3;
        if(isset($_POST['area']) && $_POST['area'] != -1) {
            $area = $_POST['area'];
        }
        if(isset($_POST['area']) && $_POST['area'] == -1) {
            $area = NULL;
        }
        if($area) {
            $this->condition[] = 'sqrt( POW((71.5 * (8.11974639999994 - user.lng)),2) + POW((111.3 * (50.1250784 - user.lat)),2) ) < ' .$area;
        }
        /*
        if(isset($_SESSION['uid'])) {
            $this->join[]   = 'left join notepad on (bike.uid = notepad.id and notepad.pid = ' . $_SESSION['uid'] . ')';
            $this->column[] = 'notepad.uid as nuid';
        }
         */
        $this->condition[] = 'aktiv = 1';
    }

    public function printList($linkTarget = '_top') {
        $sqlAdditionalCondition = '';
        $sqlAdditionalJoin      = '';
        $sqlAdditionalColumn    = '';
        $sqlOrder               = (isset($_POST['orderDistance']) && isset($_SESSION['lat']) && isset($_SESSION['lng'])) ? 'distance ASC, ' : '';
        if(!empty($this->condition)) {
             $sqlAdditionalCondition = 'where ' . implode(' and ', $this->condition);
        }
        if(!empty($this->join)) {
            $sqlAdditionalJoin = ' ' . implode(' ', $this->join);
        }
        if(!empty($this->column)) {
            $sqlAdditionalColumn = ', ' . implode(', ', $this->column);
        }
        $sql = "select bike.uid,bike.pid,marke,modell,preis,bike.erstellt,bike.geaendert,aktiv"
            . ",images.name,extension,reihenfolge" . $sqlAdditionalColumn;
        if(isset($_SESSION['lat']) && isset($_SESSION['lng'])){
            $sql .= ",user.lat, user.lng, (111.3 * ({$_SESSION['lat']} - user.lat)) as dy, (71.5 * ({$_SESSION['lng']} - user.lng)) as dx"
                . ", sqrt( POW((71.5 * ({$_SESSION['lng']} - user.lng)),2) + POW((111.3 * ({$_SESSION['lat']} - user.lat)),2) ) as distance";
        }
        $sql .= " from bike LEFT JOIN images ON bike.uid = images.pid LEFT JOIN user ON user.uid = bike.pid {$sqlAdditionalJoin}"
            . " {$sqlAdditionalCondition} group by bike.uid order by {$sqlOrder}bike.erstellt";

        #echo $sql;
        $result = mysql_query($sql);
        if($result){
            while ($row = mysql_fetch_assoc($result)) {
                echo "<div class=\"bikeListElement" . (($row['aktiv']) ? '' : ' inactive') . "\">";
                if($row['uid'] == NULL && isset($row['nuid'])){
                    echo 'Das Zweirad mit der ID: ' . $row['nuid'] . ' wurde gelöscht<br>';
                    echo 'Bemerkung: ' . $row['remark'] . '<br>';
                    if(isset($row['nuid'])) {
                        echo "<a class=\"txtLnk ajaxNotepadDelete\" href=\"notepadAjax.php?uid={$row['nuid']}&process=delete\">Vom Merkzettel löschen</a><br>";
                    }
                }else{
                    if(!empty($row['name'])){
                        $imageObj  = new ScaleImage($row['name'], $row['extension'], 'images');
                        $imagePath = $imageObj->getImagePath(200, 'auto');
                        if($imagePath) {
                            echo "<a class=\"thumb\" href=\"detail.php?uid={$row['uid']}\" target=\"$linkTarget\">";
                                echo "<img alt=\"{$row['modell']}\" src=\"$imagePath\" width=\"200\" />";
                            echo "</a>";
                        }
                    }
                    echo '<div class="cnt">';
                    if(isset($row['distance'])){
                        echo 'Entfernung: ';
                        printf("%.2f", $row['distance']);
                        echo 'km<br>';
                    }
                    echo "marke: {$row['marke']}<br>";
                    echo "modell: {$row['modell']}<br>";
                    echo "preis: {$row['preis']}<br>";
                    echo "erstellt: {$row['erstellt']}<br>";
                    echo "geaendert: {$row['geaendert']}<br>";
                    echo "</div>";
                    echo '<div class="links">';
                    echo "<a class=\"txtLnk\" href=\"detail.php?uid={$row['uid']}\" target=\"$linkTarget\">Ansehen</a><br>";
                    if(isset($row['nuid'])) {
                        echo "<a class=\"txtLnk ajaxNotepadDelete\" href=\"notepadAjax.php?uid={$row['nuid']}&process=delete\">Vom Merkzettel löschen</a><br>";
                    }
                    if(isset($_SESSION['uid']) && $row['pid'] == $_SESSION['uid']){
                        echo "<a class=\"txtLnk ajaxDelete\" href=\"bikeAjax.php?uid={$row['uid']}&process=delete\">Angebot löschen</a><br>";
                    }
                    echo '</div>';
                    echo '<div class="clear"></div>';
                }
                echo '</div>';
            }
            if(mysql_num_rows($result) == 0) {
                echo '<p>Keine Einträge vorhanden!</p>';
            }
        }else{
            echo '<p class="error">Fehler in der Datenbankabfrage</p>';
        }
    }

    public function getList($linkTarget = '_top') {
        $bikeListElements = array();
        $bikeListElement = array();
        $sqlAdditionalCondition = '';
        $sqlAdditionalJoin      = '';
        $sqlAdditionalColumn    = '';
        $sqlOrder               = (isset($_POST['orderDistance']) && isset($_SESSION['lat']) && isset($_SESSION['lng'])) ? 'distance ASC, ' : '';
        if(!empty($this->condition)) {
             $sqlAdditionalCondition = 'where ' . implode(' and ', $this->condition);
        }
        if(!empty($this->join)) {
            $sqlAdditionalJoin = ' ' . implode(' ', $this->join);
        }
        if(!empty($this->column)) {
            $sqlAdditionalColumn = ', ' . implode(', ', $this->column);
        }
        $sql = "select bike.uid,bike.pid,marke,modell,preis,bike.erstellt,bike.geaendert,aktiv"
            . ",images.name,extension,reihenfolge" . $sqlAdditionalColumn;
        if(isset($_SESSION['lat']) && isset($_SESSION['lng'])){
            $sql .= ",user.lat, user.lng, (111.3 * ({$_SESSION['lat']} - user.lat)) as dy, (71.5 * ({$_SESSION['lng']} - user.lng)) as dx"
                . ", sqrt( POW((71.5 * ({$_SESSION['lng']} - user.lng)),2) + POW((111.3 * ({$_SESSION['lat']} - user.lat)),2) ) as distance";
        }
        $sql .= " from bike LEFT JOIN images ON bike.uid = images.pid LEFT JOIN user ON user.uid = bike.pid {$sqlAdditionalJoin}"
            . " {$sqlAdditionalCondition} group by bike.uid order by {$sqlOrder}bike.erstellt";
        #echo $sql;
        $result = mysql_query($sql);
        if($result){
            while ($row = mysql_fetch_assoc($result)) {
                unset($bikeListElement);
                $bikeListElement['aktiv'] = (($row['aktiv']) ? '' : ' inactive');
                if(isset($_SESSION['uid']) && $row['pid'] == $_SESSION['uid']){
                    $bikeListElement['isOwnBike'] = TRUE;
                }
                if(isset($row['id'])) {
                    $bikeListElement['isOnNotepad'] = TRUE;
                    $bikeListElement['nuid'] = $row['nuid'];
                    $bikeListElement['id'] = $row['id'];
                }else{
                    $bikeListElement['isOnNotepad'] = FALSE;
                }
                if($row['uid'] == NULL && isset($row['id'])){
                    $bikeListElement['deleted'] = TRUE;
                    $bikeListElement['remark'] = $row['remark'];
                }else{
                    if(!empty($row['name'])){
                        $imageObj  = new ScaleImage($row['name'], $row['extension'], 'images');
                        $imagePath = $imageObj->getImagePath(200, 'auto');
                        if($imagePath) {
                            $bikeListElement['imagePath'] = $imagePath;
                        }
                    }
                    if(isset($row['distance'])){
                        $bikeListElement['distance'] = $row['distance'];
                    }
                    $bikeListElement['uid'] = $row['uid'];
                    $bikeListElement['marke'] = $row['marke'];
                    $bikeListElement['modell'] = $row['modell'];
                    $bikeListElement['preis'] = $row['preis'];
                    $bikeListElement['erstellt'] = $row['erstellt'];
                    $bikeListElement['geaendert'] = $row['geaendert'];
                }
                $bikeListElements[] = $bikeListElement;
            }
        }
        return $bikeListElements;
    }
}

?>
