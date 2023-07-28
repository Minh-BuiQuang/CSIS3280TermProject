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

    static function showUserDetails(User $u) { 
    ?>
    <FORM ACTION="" METHOD="POST">
        <div class="form-group row">
            <div class="col-md-6">
                Username: <?php echo $u->getUserName(); ?>
            </div>
            <div class="col-md-6">
                Full Name: <?php echo $u->getFullName(); ?>
            </div>
            <div class="col-md-6">
                Email: <?php echo $u->getEmail(); ?>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-6">
            <a class="btn btn-primary" href="logout.php" role="button">Logout</a>
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

    static function showSearchBar() {
        ?>
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="input-group">
                        <input type="text" class="form-control" name="keyword" placeholder="Search your recipe. Ex: salad, pasta, meat ball,...">
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="button">Go!</button>
                        </span>
                    </div>
                </div>
            </div>
        </div>            
        <?php
    }
}