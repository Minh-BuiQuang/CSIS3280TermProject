<?php
require_once("inc/config.inc.php");
require_once("inc/Entity/Page.class.php");
require_once("inc/Entity/User.class.php");
require_once("inc/Entity/Recipe.class.php");
require_once("inc/Entity/APIHelper.class.php");
require_once("inc/Utility/PDOAgent.class.php");
require_once("inc/Utility/UserDAO.class.php");
require_once("inc/Utility/LoginManager.class.php");

session_start();
$searchResults = array();
if(isset($_POST['keyword'])){
    //Handle the search
    $searchResults = APIHelper::getRecipes($_POST['keyword']);
}

// verify the login
if(LoginManager::verifyLogin()){
    //Display user profile for now. This page will be the home page later.
    UserDAO::init();
    $user = UserDAO::getUser($_SESSION['loggedin']);
    Page::header();
    Page::showTopBar($user);
    if(!empty($searchResults)){
        Page::showSearchResults($searchResults);
    }
    Page::footer();
} else {
    header("Location: login.php");
}
?>