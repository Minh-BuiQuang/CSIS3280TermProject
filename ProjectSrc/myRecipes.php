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

if(isset($_POST['unfavourite'])){
    //Handle remove from favourite
    RecipeDAO::init();
    RecipeDAO::remove($_POST['uri']);
}
if(isset($_POST['addToGrocery'])){
    //Handle add to grocery//Handle add to grocery
    $recipe = new Recipe();
    $recipe->setUri($_POST['uri']);
    $recipes = array($recipe);
    $fullRecipe = APIHelper::getRecipesByUris($recipes)[0];
    GroceryDAO::init();
    //Add each of the ingredient in ingredient array to database
    //Increase quantity if the ingredient already exists
    foreach($fullRecipe->getIngredients() as $ingredient){
        $grocery = new Grocery();
        $grocery->setFoodId($ingredient['foodId']);
        $grocery->setQuantity($ingredient['quantity']);
        $grocery->setMeasure($ingredient['measure']);
        $grocery->setFood($ingredient['food']);

        GroceryDAO::addOrUpdateGrocery($grocery);
    }
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