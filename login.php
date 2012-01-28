<?php include 'includes/head.php'; ?>
<body id="std">
    <?php include 'includes/header.php'; ?>
	<div id="content">
	    <?php
	    $showForm = true;
        if($_POST){
            $username = $_POST['username'];
            $password = $_POST['password'];
            include 'includes/dbConnect.php';
            $mysqlQuerySelect = mysql_query("select * from user where username='" . mysql_real_escape_string(trim($username)) ."' and password='" . md5(trim($password)) . "'");
            if (mysql_num_rows($mysqlQuerySelect)==1){ 
                $row = mysql_fetch_assoc($mysqlQuerySelect);
                echo "<h4>Willkommen ".$row['username']."</h4>\n"; 
                echo "Sie wurden erfolgreich eingeloggt.<br>\n";
                $showForm = false; 
                $_SESSION['uid'] = $row['uid'];
                $_SESSION['username'] = $row['username'];
                $_SESSION['email'] = $row['email'];
            } 
            else{ 
                 echo "<span class=\"error\">Sie konnten nicht eingeloggt werden.<br>Username oder Passwort fehlerhaft.<br>\n";
            } 
        

        }
        if($showForm){
	    ?>
        <form method="post">
            <div class="formField<?=$usernameErr?>">
                <p class="error">Bitte geben Sie einen Benutzernamen ein</p>
                <label>Benutzername</label><input type="text" name="username" value="<?=$username?>" />
            </div>
            <div class="formField<?=$passwordErr?>">
                <p class="error">Bitte geben Sie das richtige Passwort ein</p>
                <label>Passwort</label><input type="text" name="password" value="<?=$password?>" />
            </div>
            <div class="formField">
                <input class="submit" type="submit" />
            </div>
        </form>	    
        <p><a href="passwordRequest.php">Passwort vergessen?</a></p>
        <?}?>
    </div>
    <?php include 'includes/footer.php'; ?>
</body>
</html>
