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

session_start();
$searchResults = array();
if(isset($_POST['keyword'])){
    //Handle the search
    $searchResults = APIHelper::getRecipes($_POST['keyword']);
}
if(isset($_POST['favourite'])) {
    //Handle add to favourite
    $recipe = new Recipe();
    $recipe->setUri($_POST['uri']);
    $recipe->setLabel($_POST['label']);
    $recipe->setImage($_POST['image']);
    $recipe->setUrl($_POST['url']);
    $recipe->setCalories($_POST['calories']);
    RecipeDAO::init();
    RecipeDAO::insert($recipe);
}
if(isset($_POST['unfavourite'])){
    //Handle remove from favourite
    RecipeDAO::init();
    RecipeDAO::remove($_POST['uri']);
}

// verify the login
if(LoginManager::verifyLogin()){
    //Display user profile for now. This page will be the home page later.
    UserDAO::init();
    $user = UserDAO::getUser($_SESSION['loggedin']);
    RecipeDAO::init();
    $recipesFromDb = RecipeDAO::getRecipes();
    Page::header();
    Page::showNavBar();
    Page::showTopBar($user);
    if(!empty($searchResults)){
        Page::showRecipes($searchResults, $recipesFromDb);
    }
    Page::footer();
} else {
    header("Location: login.php");
}
?>