<?php
if($_GET['action'] == 'logout'){
    session_destroy();
}else{
    session_start();
}
echo '<div id="header">
        <img src="resources/images/logo_folgeseiten.png" id="imgLogo" />
        <div class="sessionData">uid: ' . $_SESSION['uid'] . ', username: ' . $_SESSION['username'] . ', email: ' . $_SESSION['email'] . '</div>
        <div id="mainnavi">
            <ul>';
            if(isset($_SESSION['uid'])){
                echo '<li class="hi"><a href="#">Add Bike</a></li>';
                echo '<li class="hi"><a href="logout.php?action=logout">Logout</a></li>';
            }else{
                echo '<li><a href="login.php">Login</a></li>';
                echo '<li><a href="register.php">Registrieren</a></li>';
            }
echo       '</ul>
        </div>
    </div>';
?>
