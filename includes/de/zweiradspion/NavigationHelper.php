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
        $subnavi .= '<a href="list.php?filter=allOffers">Alle Angebote</a>';
        # eingeloggt
        if(isset($_SESSION['uid'])){
            $subnavi .= '<a href="list.php?filter=nearOffers">Angebote in<br>meiner Nähe</a>';
        }
        $subnavi .= '<a href="list.php?filter=newOffers">Neuste Angebote</a>';
        $subnavi .= '<div class="spacer"></div>';
        # eingeloggt
        if(isset($_SESSION['uid'])){
            $subnavi .= '<a href="list.php?filter=myOffers">Meine Angebote</a>';
            $subnavi .= '<a href="bike.php?action=new">Neues Angebot</a>';
            $subnavi .= '<a href="list.php?filter=notepad">Merkzettel</a>';
        }
        $subnavi .= '</div>';
        return $subnavi;
    }
}