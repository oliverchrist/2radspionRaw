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
        $subnavi .= '<a href="list.php">Alle Angebote</a>';
        # eingeloggt
        if(isset($_SESSION['uid'])){
            $subnavi .= '<a href="list.php?filter=myOffers">Meine Angebote</a>';
            $subnavi .= '<a href="bike.php?action=new">Add Bike</a>';
        }
        $subnavi .= '</div>';
        return $subnavi;
    }
}