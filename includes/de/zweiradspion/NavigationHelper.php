<?php
namespace de\zweiradspion;

/**
 * Helferfunktionen
 *
 * @author christ
 */
class NavigationHelper {
    public static function getSubnavigation(){
        $subnavi = '<div class="subnavi">';
        # public
        $subnavi .= '<a href="list.php?filter=allOffers">Alle Angebote</a>';
        # eingeloggt
        if(isset($_SESSION['uid'])){
            $subnavi .= '<a href="list.php?filter=myOffers">Meine Angebote</a>';
            $subnavi .= '<a href="list.php?filter=notepad">Merkzettel</a>';
            $subnavi .= '<a href="bike.php?action=new">Neues Zweirad</a>';
            $subnavi .= '<a href="user.php">Benutzerdaten</a>';
        }
        $subnavi .= '</div>';
        return $subnavi;
    }
}