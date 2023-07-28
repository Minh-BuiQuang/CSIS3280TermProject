<?php
require_once("inc/config.inc.php");
require_once("inc/Entity/User.class.php");
require_once("inc/Entity/Page.class.php");
require_once("inc/Utility/LoginManager.class.php");
require_once("inc/Utility/PDOAgent.class.php");
require_once("inc/Utility/UserDAO.class.php");

//Initialize userDAO
$messages = array();
$error_messages = array();
$login_error_messages = array();
UserDAO::init();
if(!empty($_POST['username'])){
    $user = UserDAO::getUser($_POST['username']);
    if($_POST['action'] == 'signin') {
        if($user && $user->verifyPassword($_POST['password'])){
            session_start();
            $_SESSION['loggedin'] = $user->getUserName();
        } else {
            //Show error message
            $login_error_messages[] = "Invalid username or password";
        }
    } else if($_POST['action'] == 'signup'){
        if($user == null) {
            //Create a new user
            $user = new User();
            $user->setUserName($_POST['username']);
            $options = ['cost' => 12];
            $user->setPassword(password_hash($_POST['password'], PASSWORD_BCRYPT, $options));
            $user->setFullName($_POST['fullname']);
            $user->setEmail($_POST['email']);
            UserDAO::createUser($user);
            $messages[] = "User created";
        } else {
            //Show error message
            $error_messages[] = "Username already exists";
        }
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
    Page::showLogin($login_error_messages);
    Page::showSignup($error_messages, $messages);
    Page::footer();
}
?>
