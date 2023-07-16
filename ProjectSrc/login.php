<?php
require_once("inc/config.inc.php");
require_once("inc/Entity/User.class.php");
require_once("inc/Entity/Page.class.php");
require_once("inc/Utility/LoginManager.class.php");
require_once("inc/Utility/PDOAgent.class.php");
require_once("inc/Utility/UserDAO.class.php");

//Initialize userDAO
UserDAO::init();

if(!empty($_POST['username'])){
    $user = UserDAO::getUser($_POST['username']);

    if($user && $user->verifyPassword($_POST['password'])){
        session_start();

        $_SESSION['loggedin'] = $user->getUserName();
    }
}

if(LoginManager::verifyLogin()){
    $user = UserDAO::getUser($_SESSION['loggedin']);

    // the user is logged in, redirect the user to the user profile
    header("Location: index.php");

    // after the call to header, make sure to exit
    exit;
}
else{
    Page::header();
    Page::showLogin();
    Page::footer();
}

?>
