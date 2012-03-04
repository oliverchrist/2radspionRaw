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
        echo '<div class="saveForm">';
        echo '<input name="save" type="text" placeholder="speichern als">';
        echo '</div>';
        echo '<div class="control">';
        echo '<input type="reset" class="reset" value="Reset">';
        echo '<input type="submit" class="submit" value="Filtern">';
        echo '</div>';
        echo '</form>';
    }

    public function generateSqlAllOffers() {
        $dbObject = new DatabaseHelper();
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
        $this->condition[] = 'aktiv = 1';
    }

    public function initMyOffers() {
        $this->condition[] = 'bike.pid = ' . $_SESSION['uid'];
    }

    public function initNotepad() {
        $this->join[]     = 'right join notepad on bike.uid = notepad.id';
        $this->condition[] = 'notepad.pid=' . $_SESSION['uid'];
        $this->column[]    = ', notepad.id, notepad.remark';
    }

    public function initNewOffers() {
        $now   = new \DateTime;
        $now->modify( '-1 month' );
        $this->condition[] = 'bike.erstellt > "' . $now->format( 'Y-m-d' ) . '"';
    }

    public function initNearOffers() {
        $this->condition[] = 'sqrt( POW((71.5 * (8.11974639999994 - user.lng)),2) + POW((111.3 * (50.1250784 - user.lat)),2) ) < 50';
    }

    public function printList() {
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
            $sqlAdditionalColumn = implode('', $this->column);
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
                if($row['uid'] == NULL && isset($row['id'])){
                    echo 'Das Zweirad mit der ID: ' . $row['id'] . ' wurde gelöscht<br>';
                    echo 'Bemerkung: ' . $row['remark'];
                }else{
                    if(!empty($row['name'])){
                        $imageObj  = new ScaleImage($row['name'], $row['extension'], 'images');
                        $imagePath = $imageObj->getImagePath(200, 'auto');
                        echo "<a class=\"thumb\" href=\"detail.php?uid={$row['uid']}\">";
                            echo "<img alt=\"{$row['modell']}\" src=\"$imagePath\" width=\"200\" />";
                        echo "</a>";
                    }
                    echo '<div class="cnt">';
                    if(isset($row['distance'])){
                        echo 'Entfernung: ' . printf("%.2f", $row['distance']) . 'km<br>';
                    }
                    echo "marke: {$row['marke']}<br>";
                    echo "modell: {$row['modell']}<br>";
                    echo "preis: {$row['preis']}<br>";
                    echo "erstellt: {$row['erstellt']}<br>";
                    echo "geaendert: {$row['geaendert']}<br>";
                    echo "</div>";
                    echo '<div class="links">';
                    echo "<a class=\"txtLnk\" href=\"detail.php?uid={$row['uid']}\">Ansehen</a><br>";
                    if(isset($_SESSION['uid']) && $row['pid'] == $_SESSION['uid']){
                        echo "<a class=\"txtLnk ajaxDelete\" href=\"bikeAjax.php?uid={$row['uid']}&process=delete\">Löschen</a><br>";
                    }
                    echo '</div>';
                    echo '<div class="clear"></div>';
                }
                echo '</div>';
            }
        }else{
            echo '<p class="error">Fehler in der Datenbankabfrage</p>';
        }
    }
}

?>
