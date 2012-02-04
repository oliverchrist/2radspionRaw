<?php
namespace de\zweiradspion;

/**
 * Helferfunktionen
 *
 * @author christ
 */
class HeaderHelper {
    static public function printHeader($headline){
        $header = '
        <div id="header">
            <img src="resources/images/logo_folgeseiten.png" id="imgLogo" />';
            # Session Daten anzeigen, wenn Benutzer eingeloggt ist        
            if($_SESSION){
                $header .= '<div class="sessionData">uid: ' . $_SESSION['uid'] . ', username: ' . $_SESSION['username'] . ', email: ' . $_SESSION['email'] . '</div>';
            }
            $header .= '<div id="mainnavi"><h1>' . $headline . '</h1>
            <ul>';
            # egal ob eingeloggt oder nicht
            $header .= '<li><a href="list.php">Alle bikes</a></li>';
            # eingeloggt
            if(isset($_SESSION['uid'])){
                $header .= '<li class="hi"><a href="bike.php?action=new">Add Bike</a></li>';
                $header .= '<li class="hi"><a href="logout.php">Logout</a></li>';
            # nicht eingeloggt    
            }else{
                $header .= '<li><a href="login.php">Login</a></li>';
                $header .= '<li><a href="register.php">Registrieren</a></li>';
            }
           $header .= '</ul>
        </div></div>';
        return $header;
    }
}
?>
