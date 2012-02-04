<?php
echo '<div id="header">
        <img src="resources/images/logo_folgeseiten.png" id="imgLogo" />';
# Session Daten anzeigen, wenn Benutzer eingeloggt ist        
if($_SESSION){
    echo '<div class="sessionData">uid: ' . $_SESSION['uid'] . ', username: ' . $_SESSION['username'] . ', email: ' . $_SESSION['email'] . '</div>';
}
echo '  <div id="mainnavi">
            <ul>';
            # egal ob eingeloggt oder nicht
            echo '<li><a href="list.php">Alle bikes</a></li>';
            # eingeloggt
            if(isset($_SESSION['uid'])){
                echo '<li class="hi"><a href="bike.php?action=new">Add Bike</a></li>';
                echo '<li class="hi"><a href="logout.php">Logout</a></li>';
            # nicht eingeloggt    
            }else{
                echo '<li><a href="login.php">Login</a></li>';
                echo '<li><a href="register.php">Registrieren</a></li>';
            }
echo       '</ul>
        </div>
    </div>';
?>
