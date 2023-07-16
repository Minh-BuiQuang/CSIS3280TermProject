<?php
require_once("inc/config.inc.php");
require_once("inc/Entity/Page.class.php");
require_once("inc/Entity/User.class.php");
require_once("inc/Utility/PDOAgent.class.php");
require_once("inc/Utility/UserDAO.class.php");
require_once("inc/Utility/LoginManager.class.php");

session_start();

// verify the login
if(LoginManager::verifyLogin()){
    //Display user profile for now. This page will be the home page later.
    UserDAO::init();
    $user = UserDAO::getUser($_SESSION['loggedin']);
    Page::header();
    Page::showUserDetails($user);
    Page::footer();
} else {
    header("Location: login.php");
}
?>