<?php
use de\zweiradspion\DatabaseHelper,
    de\zweiradspion\DebugHelper,
    de\zweiradspion\HeaderHelper,
    de\zweiradspion\NavigationHelper,
    de\zweiradspion\User,
    de\zweiradspion\Login;

include 'includes/init.php';

# ist Benutzer eingeloggt?
if(Login::isLoggedIn()){
    $anbieterErr  = '';
    $anredeErr    = '';
    $nameErr      = '';
    $vornameErr   = '';
    $firmaErr     = '';
    $passwordErr  = '';
    $password2Err = '';
    $emailErr     = '';
    $postcodeErr  = '';
    $showForm     = TRUE;
    $keineFehler  = TRUE;
    $user         = new User();
    $message      = '';
    if($_POST){
        $user->loadFromPost($_POST);
        $anbieter = $user->getAnbieter();
        if($anbieter == -1){
            $anbieterErr = ' error';
            $keineFehler = FALSE;
        }
        $anrede = $user->getAnrede();
        if(empty($anrede)){
            $anredeErr   = ' error';
            $keineFehler = FALSE;
        }
        $name = $user->getName();
        if(empty($name)){
            $nameErr     = ' error';
            $keineFehler = FALSE;
        }
        $vorname = $user->getVorname();
        if(empty($vorname)){
            $vornameErr  = ' error';
            $keineFehler = FALSE;
        }
        $firma = $user->getFirma();
        if($anbieter == 'haendler' && empty($firma)){
            $firmaErr    = ' error';
            $keineFehler = FALSE;
        }
        $postcode = $user->getPostcode();
        if(empty($postcode) || !preg_match('/\d{5}/', $postcode)){
            $postcodeErr = ' error';
            $keineFehler = FALSE;
        }
        if($keineFehler){
            try{
                $user->updateInDatabase();
                $message .= 'Änderungen wurden gespeichert.';
            }catch(Exception $e){
                $message .= $e->getMessage();
            }
            $showForm = FALSE;
        }
    }else{
        $user->loadFromDatabase($_SESSION['uid']);
    }

    echo $twig->render('user.html', array(
        'headline' => 'Benutzerdaten',
        'isLoggedIn' => Login::isLoggedIn(),
        'pageClass' => 'user',
        'linkTarget' => '_top',
        'showForm' => $showForm,
        'uid' => $_SESSION['uid'],
        'anbieterErr' => $anbieterErr,
        'user' => $user,
        'anredeErr' => $anredeErr,
        'nameErr' => $nameErr,
        'vornameErr' => $vornameErr,
        'firmaErr' => $firmaErr,
        'postcodeErr' => $postcodeErr,
        'message' => $message
    ));
} ?>

