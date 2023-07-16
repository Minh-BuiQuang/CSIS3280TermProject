<?php
class LoginManager  {
    static function verifyLogin()   {
        //Start session if not started
        if(session_id() == '' && !isset($_SESSION)){
            session_start();
        }
        //check if a user has logged in
        if(isset($_SESSION['loggedin'])){
            return true;
        }
        else {
            //destroy session
            session_destroy();
            return false;
        }        
    }
}
?>