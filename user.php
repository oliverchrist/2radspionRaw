<?php
include 'includes/head.php';
use de\zweiradspion\DatabaseHelper;
use de\zweiradspion\DebugHelper;
use de\zweiradspion\HeaderHelper;
use de\zweiradspion\NavigationHelper;
?>
<body id="std">
    <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
    <?=HeaderHelper::getHeader('Userdaten')?>
	<div id="content">
        <?=NavigationHelper::getSubnavigation()?>
	    <?php
	    # ist Benutzer eingeloggt?
	    if(isset($_SESSION['uid'])){
            $username = '';
            $usernameErr = '';
            $password = '';
            $passwordErr = '';
            $password2 = '';
            $password2Err = '';
            $email = '';
            $emailErr = '';
            $postcode = '';
            $postcodeErr = '';
            $city = '';
            $cityErr = '';
            $showForm = true;
            
            if($_POST){
                /*
                $username = $_POST['username'];
                $password = $_POST['password'];
                $password2 = $_POST['password2'];
                $email = $_POST['email'];
                */
                $postcode = $_POST['postcode'];
                $city = $_POST['city'];
                $latlng = $_POST['latlng'];
                $lat = $_POST['lat'];
                $lng = $_POST['lng'];
                if(empty($username)){
                    $usernameErr = ' error';
                }
                if(empty($password)){
                    $passwordErr = ' error';
                }
                if(empty($password2) || $password != $password2){
                    $password2Err = ' error';
                }
                if(empty($email) || !FormHelper::isEmail($email)){
                    $emailErr = ' error';
                }
                if(empty($postcode)){
                    $postcodeErr = ' error';
                }
                if(empty($city)){
                    $cityErr = ' error';
                }
                if(
                    !empty($postcode)
                    && !empty($city)
                ){
                    $dbObject = new DatabaseHelper();
                    $sql = 'UPDATE user SET '
                            . 'postcode="' . mysql_real_escape_string(trim($postcode)) . '", '
                            . 'city="' . mysql_real_escape_string(trim($city)) . '", '
                            . 'latLng="' . mysql_real_escape_string(trim($latlng)) . '", '
                            . 'lat="' . mysql_real_escape_string(trim($lat)) . '", '
                            . 'lng="' . mysql_real_escape_string(trim($lng)) . '" '
                            . 'WHERE uid=' . $_SESSION['uid'];
                    $result = mysql_query($sql);
                    if(!$result){
                        die ('<span class="error">User konnte nicht aktualisiert werden</span><br>');
                    }else{
                        echo 'User wurde aktualisiert<br>';
                        $showForm = false;
                    }
                }
            }else{
                $dbObject = new DatabaseHelper();
                $sql = "select * from user where uid=" . $_SESSION['uid'];
                $result = mysql_query($sql);
                $row = mysql_fetch_assoc($result);
                if(!$row) die ('<span class="error">Konnte Benutzer nicht finden</span><br>');
                
                $uid = $row['uid'];
                $hash = $row['hash'];
                $username = $row['username'];
                $password = $row['password'];
                $email = $row['email'];
                $postcode = $row['postcode'];
                $city = $row['city'];
                $latlng = $row['latLng'];
            }
    
            if($showForm){
            ?>
            <form method="post" id="userdata">
                <input type="hidden" name="latlng" />
                <input type="hidden" name="lat" />
                <input type="hidden" name="lng" />
                <div class="formField<?=$postcodeErr?>">
                    <p class="error">Bitte geben Sie eine gültige Postleitzahl Adresse ein</p>
                    <label>Postleitzahl</label><input type="text" name="postcode" value="<?=$postcode?>" />
                </div>
                <div class="formField<?=$cityErr?>">
                    <p class="error">Bitte geben Sie einen gültigen Ort ein</p>
                    <label>Ort</label><input type="text" name="city" value="<?=$city?>" />
                </div>
                <div class="formField">
                    <input class="submit" type="button" value="Senden" />
                </div>
            </form>          
            <? } ?>
            <a class="txtLnk" href="location.php?pid=<?=$_SESSION['uid']?>">Ort auf Karte zeigen</a>
        <? } ?>
    </div>
    <?php include 'includes/footer.php'; ?>
</body>
</html>
