<?php

class Page  {

    public static $title = "GROCERecipe";

    static function header() { 
        ?>
        <!doctype html>
        <html lang="en">
        <head>
            <meta charset="utf-8">
            <!-- Bootstrap CSS -->
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">            
            <link href="css/styles.css" rel="stylesheet">  
            <title><?php echo self::$title; ?></title>
        </head>
        <body>
        <div class="container">
            <h1><?php echo self::$title; ?></h1>           
    <?php 
    }

    static function footer()    { 
    ?>
                </div>
            </body>
        </html>
    <?php 
    }

    static function showNavBar(){
        ?>
        <div class="container row p-1">
            <div class="col">
                <a class="btn btn-secondary btn-block" href="index.php" role="button">Home</a>
            </div>
            <div class="col">
                <a class="btn btn-secondary btn-block" href="myRecipes.php" role="button">My Recipes</a>
            </div>
            <div class="col">
                <a class="btn btn-secondary btn-block" href="myGroceries.php" role="button">My Groceries</a>
            </div>
        </div>
        <?php
    }

    static function showTopBar(User $u) { 
    ?>
    <div class="container">
        <div class="row">
            <form method="post" class="container col-md-6">
                <div class="input-group row">
                    <input type="text" class="form-control" name="keyword" placeholder="Search your recipe. Ex: salad, pasta, meat ball,...">
                    <span class="input-group-btn">
                        <input type="submit" name="search" value="Search">
                    </span>
                </div>
            </form>   
            <FORM class="col-md-4" ACTION="" METHOD="POST">
                <div class="form-group row">
                    <div class="row">
                    <a class="btn btn-primary" href="logout.php" role="button">Sign Out</a>
                    </div>
                </div>
                <div class="row">
                    Username: <?php echo $u->getUserName(); ?>
                </div>
                <div class="row">
                    Full Name: <?php echo $u->getFullName(); ?>
                </div>
                <div class="row">
                    Email: <?php echo $u->getEmail(); ?>
                </div>
            </div>
        </div>
    </div>
    <?php
    }

    static function showLogin($login_error_messages) { 
    ?>    
    <form class="form-signin" ACTION="" METHOD="POST" style="max-width: 330px">
        <h2 class="form-signin-heading">Sign in</h2>
        <div class="form-group">
            <label for="inputUserName" class="sr-only">Username</label>
            <input type="text" id="inputUserName" class="form-control" placeholder="User Name" required autofocus name="username">
        </div>

        <div class="form-group">
            <label for="inputPassword" class="sr-only">Password</label>
            <input type="password" id="inputPassword" class="form-control" placeholder="Password" required name=password>
        </div>

        <div class="form-group">
            <input type="hidden" name="action" value="signin">
            <button class="btn btn-lg btn-primary btn-block" type="submit">Log in</button>
        </div>
        <?php
        if(!empty($login_error_messages)) {
            echo "<div>";
            foreach($login_error_messages as $message){
                echo "<p class='text-danger'>$message</p>";
            }
            echo "</div>";
        }
        ?>
      </form>
    <?php 
    }
    static function showSignUp($error_messages, $messages){
        ?>    
        <form class="form-signup" ACTION="" METHOD="POST" style="max-width: 330px">
            <h2 class="form-signup-heading">Create a new account</h2>
            <div class="form-group">
                <label for="inputUserName" class="sr-only">Username</label>
                <input type="text" id="inputUserName" class="form-control" placeholder="New user name" required autofocus name="username">
            </div>
            <div class="form-group">
                <label for="inputFullName" class="sr-only">Username</label>
                <input type="text" id="inputFullName" class="form-control" placeholder="Full name" required autofocus name="fullname">
            </div>
            <div class="form-group">
                <label for="inputEmail" class="sr-only">Email</label>
                <input type="text" id="inputEmail" class="form-control" placeholder="Email" required autofocus name="email">
            </div>
    
            <div class="form-group">
                <label for="inputPassword" class="sr-only">Password</label>
                <input type="password" id="inputPassword" class="form-control" placeholder="Password" required name=password>
            </div>
    
            <div class="form-group">
                <input type="hidden" name="action" value="signup">
                <button class="btn btn-lg btn-primary btn-block" type="submit">Sign up</button>
            </div>
            <?php
            if(!empty($error_messages)) {
                echo "<div>";
                foreach($error_messages as $message){
                    echo "<p class='text-danger'>$message</p>";
                }
                echo "</div>";
            }
            if(!empty($messages)) {
                echo "<div>";
                foreach($messages as $message){
                    echo "<p class='text-success'>$message</p>";
                }
                echo "</div>";
            }
            ?>
          </form>
        <?php
    }
    //Takes in a list of recipes to be displayed and a list of recipes from database for validating if a recipe has been added to favourited by the user prior.
    static function showRecipes($recipes, $recipesFromDb) {
        echo "<div class=\"container \">";
        foreach($recipes as $recipe){
            ?>
                <div class="container p-4 m-4 bg-info rounded">
                    <div class="row pb-4">
                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-body">
                                    <h3 class="card-title"><?=$recipe->getLabel()?></h3>
                                    <?php
                                    $calories = number_format($recipe->getCalories(), 2);
                                    ?>
                                    <p class="card-text">Total Calories: <?=$calories?></p>
                                    <p class="card-text">Ingredients:</p>
                                    <?php
                                        foreach($recipe->getIngredientLines() as $ingredient){
                                            echo "<p class='card-text' style='line-height: 1;'>• $ingredient</p>";
                                        }
                                    ?>
                                </div>
                            </div>
                        </div>
                    <div class="col-md-4">
                        <img src="<?=$recipe->getImage()?>" class="card-img-top img-fluid" alt="Recipe Image" >
                        <div class="row p-2">
                            <a class="btn btn-primary btn-block" href="<?=$recipe->getUrl()?>" target="_blank" role="button">Go to cooking instruction</a>
                        </div>
                        <div class="row p-2">
                            <?php
                            $isFavourite = false;
                            foreach($recipesFromDb as $recipeFromDb){
                                if($recipeFromDb->getUri() == $recipe->getUri()){
                                    $isFavourite = true;
                                    break;
                                }
                            }
                            //Render Add to favourite button if the recipe is not in the database
                            if($isFavourite) {
                                echo '<FORM class="btn-block" ACTION="" METHOD="POST">';
                                echo '<input type="submit" name="unfavourite" class="btn btn-secondary btn-block" value="Remove from favourite">';
                                echo '<input type="hidden" name="uri" value="'.$recipe->getUri().'">';
                                echo '</FORM>';
                            } else {
                                echo '<FORM class="btn-block" ACTION="" METHOD="POST">';
                                echo '<input type="submit" name="favourite" class="btn btn-primary btn-block" value="Add to favourite">';
                                echo '<input type="hidden" name="uri" value="'.$recipe->getUri().'">';
                                echo '<input type="hidden" name="label" value="'.$recipe->getLabel().'">';
                                echo '<input type="hidden" name="image" value="'.$recipe->getImage().'">';
                                echo '<input type="hidden" name="url" value="'.$recipe->getUrl().'">';
                                echo '<input type="hidden" name="calories" value="<'.$recipe->getCalories().'">';
                                echo '<input type="hidden" name="keyword" value="'.$_POST['keyword'].'">';                            
                                echo '</FORM>';
                            }
                            echo '<FORM class="btn-block" ACTION="" METHOD="POST">';
                            echo '<input type="submit" name="addToGrocery" class="btn btn-secondary btn-block" value="Add to grocery list">';
                            echo '<input type="hidden" name="uri" value="'.$recipe->getUri().'">';
                            echo '</FORM>';
                            ?>
                            
                        </div>
                    </div>
                </div>
            <?php
        echo "</div>";
        }
    }
}