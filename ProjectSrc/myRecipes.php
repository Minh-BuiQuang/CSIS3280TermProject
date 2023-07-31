<?php
require_once("inc/config.inc.php");
require_once("inc/Entity/Page.class.php");
require_once("inc/Entity/User.class.php");
require_once("inc/Entity/Recipe.class.php");
require_once("inc/Entity/APIHelper.class.php");
require_once("inc/Utility/PDOAgent.class.php");
require_once("inc/Utility/UserDAO.class.php");
require_once("inc/Utility/RecipeDAO.class.php");
require_once("inc/Utility/LoginManager.class.php");

if(isset($_POST['unfavourite'])){
    //Handle remove from favourite
    RecipeDAO::init();
    RecipeDAO::remove($_POST['uri']);
}
if(isset($_POST['addToGrocery'])){
    //Handle add to grocery
}

// verify the login
if(LoginManager::verifyLogin()){
    //Display user profile for now. This page will be the home page later.
    UserDAO::init();
    $user = UserDAO::getUser($_SESSION['loggedin']);
    RecipeDAO::init();
    $recipes = RecipeDAO::getRecipes();
    $fullRecipes = APIHelper::getRecipesByUris($recipes);
    Page::header();
    Page::showNavBar();    
    if(!empty($fullRecipes)) {
        Page::showRecipes($fullRecipes, $fullRecipes);
    }
    Page::footer();
} else {
    header("Location: login.php");
}
?>