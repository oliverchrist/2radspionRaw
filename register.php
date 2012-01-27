<?php include 'includes/head.php'; ?>
<body id="std">
    <?php include 'includes/header.php'; ?>
	<div id="content">
	    <?php
        $usernameErr = '';
        $passwordErr = '';
        $password2Err = '';
        $emailErr = '';
        $showForm = true;
	    if($_POST){
    	    $username = $_POST['username'];
            $password = $_POST['password'];
            $password2 = $_POST['password2'];
            $email = $_POST['email'];
            if(empty($username)){
                $usernameErr = ' error';
            }
            if(empty($password)){
                $passwordErr = ' error';
            }
            if(empty($password2)){
                $password2Err = ' error';
            }
            if(empty($email)){
                $emailErr = ' error';
            }
            if(
                !empty($username)
                && !empty($password)
                && !empty($password2)
                && !empty($email)
            ){
                echo '<p>Eine Email wurde an Sie versand, bitte bestätigen Sie diese</p>';
                $showForm = false;
                                
                include 'includes/dbConnect.php';
                
                $hash = hash_init('md5');
                hash_update($hash, 'aitrntrahoaonb35brn3');
                hash_update($hash, $email);
                $hashFinal = hash_final($hash);
                
                $mysqlQueryInsert = mysql_query("INSERT INTO userunconfirmed (hash, username, password, email) VALUES ('"
                    . $hashFinal . "', '"
                    . $username . "', '"
                    . $password . "', '"
                    . $email . "')");
                echo 'mysqlQueryInsert: ' . $mysqlQueryInsert . '<br>';
                


                $header = 'From: webmaster@2radspion.de' . "\r\n" .
                    'Reply-To: webmaster@2radspion.de' . "\r\n" .
                    'X-Mailer: PHP/' . phpversion();
                $message = 'Guten Tag ' . $username . ',
klicken Sie bitte auf diesen Link: http://2radspionRaw.localhost/registerConfirm.php?x=' . $hashFinal;
                mail('christ@mediaman.de', '2radspion Confirm', $message, $header);
            }
        }
        if($showForm){
	    ?>
	    <form method="post">
	        <div class="formField<?=$usernameErr?>">
                <p class="error">Bitte geben Sie einen Benutzernamen ein</p>
                <label>Benutzername</label><input type="text" name="username" />
            </div>
            <div class="formField<?=$passwordErr?>">
                <p class="error">Bitte geben Sie ein Passwort ein</p>
                <label>Passwort</label><input type="text" name="password" />
            </div>
            <div class="formField<?=$passwordErr?>">
                <p class="error">Die Passwörter stimmen nicht überein</p>
                <label>Passwort wiederholen</label><input type="text" name="password2" />
            </div>
            <div class="formField<?=$emailErr?>">
                <p class="error">Bitte geben Sie eine Email ein</p>
                <label>Email</label><input type="text" name="email" />
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
