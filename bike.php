<?php
use de\zweiradspion\HeaderHelper,
    de\zweiradspion\NavigationHelper,
    de\zweiradspion\Fahrrad,
    de\zweiradspion\DatabaseHelper,
    de\zweiradspion\Login;

include 'includes/init.php';

# ist Benutzer eingeloggt?
if(isset($_SESSION['uid'])) {
    $markeErr        = '';
    $modellErr       = '';
    $preisErr        = '';
    $radgroesseErr   = '';
    $rahmenhoeheErr  = '';
    $laufleistungErr = '';
    $showForm        = TRUE;
    $keineFehler     = TRUE;
    $fahrrad         = new Fahrrad();

    # speichern
    if($_POST){
        $fahrrad->loadFromPost($_POST, $_SESSION['uid']);

        if($_POST['marke'] == -1 && empty($_POST['markeSonstige'])){
            $markeErr    = ' error';
            $keineFehler = FALSE;
        }
        if(empty($_POST['modell'])){
            $modellErr   = ' error';
            $keineFehler = FALSE;
        }
        if(empty($_POST['preis'])){
            $preisErr    = ' error';
            $keineFehler = FALSE;
        }
        if(empty($_POST['radgroesse'])){
            $radgroesseErr = ' error';
            $keineFehler   = FALSE;
        }
        if(empty($_POST['rahmenhoehe'])){
            $rahmenhoeheErr = ' error';
            $keineFehler    = FALSE;
        }
        if(empty($_POST['laufleistung'])){
            $laufleistungErr = ' error';
            $keineFehler     = FALSE;
        }
        # Wenn alle Eingaben ok sind
        if($keineFehler){
            # insert
            if(empty($_POST['uid'])){
                try{
                    $fahrrad->insertInDatabase();
                    echo 'Das Zweirad wurde erfolgreich gespeichert<br>';
                }catch(Exception $e){
                    print $e->getMessage();
                }
            }else{
                # update
                try{
                    $fahrrad->updateInDatabase();
                    echo 'Die Änderungen wurden erfolgreich gespeichert<br>';
                }catch(Exception $e){
                    print $e->getMessage();
                }
            }
            $showForm = FALSE;
        }
    }
    # DELETE
    elseif(isset($_GET['uid']) && isset($_GET['process']) && $_GET['process'] == 'delete'){
        $dbObject = new DatabaseHelper();
        $sql      = 'DELETE FROM bike WHERE uid = ' . $_GET['uid'] . ' and pid = ' . $_SESSION['uid'];
        $result   = mysql_query($sql);
        if($result){
            echo '<p>Das Angebot wurde erfolgreich gelöscht.</p>';
            # Bilder finden und sicher sein, daß dem User das Bike gehörte (session), deshalb im if Zweig
            $sql    = 'SELECT * FROM images WHERE pid = ' . $_GET['uid'];
            $result = mysql_query($sql);
            while($row = mysql_fetch_assoc($result)){
                $filename = 'images/' . $row['name'] . '.' . $row['extension'];
                if(!unlink($filename)){
                    echo '<p>' . $filename . ' konnte nicht gelöscht werden.</p>';
                }
            }
            $sql    = 'DELETE FROM images WHERE pid = ' . $_GET['uid'];
            $result = mysql_query($sql);
            if(!$result){
                echo "<p>Bilder mit der pid {$_GET['uid']} konnten nicht gelöscht werden</p>";
            }
        }else{
            echo '<p class="error">Angebot mit der uid ' . $_GET['uid'] . ' konnte nicht gelöscht werden.</p>';
        }

        $showForm = FALSE;
    }elseif(isset($_GET['uid'])){
        $fahrrad = new Fahrrad($_GET['uid']);
    }
}

echo $twig->render('bike.html', array(
    'headline' => (isset($_GET['uid']))?'Angebot ändern':'Angebot hinzufügen',
    'isLoggedIn' => Login::isLoggedIn(),
    'pageClass' => 'contact',
    'linkTarget' => '_top',
    'fahrrad' => $fahrrad,
    'uid' => (isset($_GET['uid']))? $_GET['uid'] : null
));

