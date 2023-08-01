<?php
require_once("inc/config.inc.php");
require_once("inc/Entity/Page.class.php");
require_once("inc/Entity/User.class.php");
require_once("inc/Entity/Recipe.class.php");
require_once("inc/Entity/Grocery.class.php");
require_once("inc/Entity/APIHelper.class.php");
require_once("inc/Utility/PDOAgent.class.php");
require_once("inc/Utility/UserDAO.class.php");
require_once("inc/Utility/RecipeDAO.class.php");
require_once("inc/Utility/GroceryDAO.class.php");
require_once("inc/Utility/LoginManager.class.php");

GroceryDAO::init();
if(isset($_POST['foodId'])){
    //Handle remove from favourite
    GroceryDAO::removeGrocery($_POST['foodId']);
}

//Load grocery list from db
$groceries = GroceryDAO::getGroceries();

// verify the login
if(LoginManager::verifyLogin()){
    //Display user profile for now. This page will be the home page later.
    UserDAO::init();
    $user = UserDAO::getUser($_SESSION['loggedin']);
    Page::header();
    Page::showNavBar();
    Page::showGroceries($groceries);
    Page::footer();
} else {
    header("Location: login.php");
}
?>