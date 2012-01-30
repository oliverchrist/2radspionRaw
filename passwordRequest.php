<?php include 'includes/head.php'; ?>
<body id="std">
    <?php include 'includes/header.php'; ?>
	<div id="content">
        <?php
        $email = '';
        $emailErr = '';
        $showForm = true;
        if($_POST){
            $email = $_POST['email'];
            if(empty($email)){
                $emailErr = ' error';
            }
            if(!empty($email)){
                include 'includes/dbConnect.php';
                $sql = "select * from user where email='" . mysql_real_escape_string($_POST['email']) . "'";
                $result = mysql_query($sql)
                    or die('Email wurde nicht in Datenbank user gefunden.');
                if(mysql_num_rows($result) > 0){
                    $row = mysql_fetch_assoc($result);
                    $username = $row['username'];
                    $password = $row['password'];
                    $email = $row['email'];
                    $header = 'From: webmaster@2radspion.de' . "\r\n" .
                        'Reply-To: webmaster@2radspion.de' . "\r\n" .
                        'X-Mailer: PHP/' . phpversion();
                    $message = 'Guten Tag ' . $username . ",\nSie haben eine Passwortanfrage geschickt. klicken Sie bitte auf diesen Link: http://2radspionRaw.localhost/changePassword.php?x=" . $password;
                    $mailSend = mail($email, '2radspion Confirm', $message, $header);
                    if(!$mailSend){
                        die('<span class="error">Mail konnte nicht verschickt werden</span><br>');
                    }else{
                        echo 'Mail wurde an den User geschickt<br>';
                        echo '<p>Eine Email wurde an Sie versand.</p>';
                    }  
                    $showForm = false;                  
                }else{
                    echo '<p class="error">Email unbekannt!</p>';
                }
            }
        }
        if($showForm){
        ?>
	    <form method="post">
            <div class="formField<?=$emailErr?>">
                <p class="error">Bitte geben Sie eine Email ein</p>
                <label>Email</label><input type="text" name="email" value="<?=$email?>" />
            </div>
            <div class="formField">
                <input class="submit" type="submit" />
            </div>
	    </form>
        <? } ?>
    </div>
    <?php include 'includes/footer.php'; ?>
</body>
</html>
