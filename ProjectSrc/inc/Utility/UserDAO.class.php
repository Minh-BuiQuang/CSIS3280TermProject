<?php
class UserDAO   {
    private static $db;
    static function init()  {
        //Initialize the internal PDO Agent
        self::$db = new PDOAgent("User");    
    }    

    static function getUser(string $userName)  {        
        $query = "SELECT * FROM users WHERE username = :username;";
        self::$db->query($query);
        self::$db->bind(":username", $userName);
        self::$db->execute();
        return self::$db->singleResult();
    }

    static function getUsers()  {
        $query = "SELECT * FROM users";
        self::$db->query($query);
        self::$db->execute();
        return self::$db->getResultSet();
    }
}
?>