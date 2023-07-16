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
        </div>
        <div class="form-group row">
            <div class="col-md-6">
            <a class="btn btn-primary" href="logout.php" role="button">Logout</a>
            </div>
        </div>
        </div>
    <?php
    }

    static function showLogin() { 
    ?>    
    <form class="form-signin" ACTION="" METHOD="POST" style="max-width: 330px">
        <h2 class="form-signin-heading">Please sign in</h2>
        <div class="form-group">
            <label for="inputUserName" class="sr-only">Username</label>
            <input type="text" id="inputUserName" class="form-control" placeholder="User Name" required autofocus name="username">
        </div>

        <div class="form-group">
            <label for="inputPassword" class="sr-only">Password</label>
            <input type="password" id="inputPassword" class="form-control" placeholder="Password" required name=password>
        </div>

        <div class="form-group">
            <button class="btn btn-lg btn-primary btn-block" type="submit">Log in</button>
        </div>
      </form>
    <?php 
    }
}