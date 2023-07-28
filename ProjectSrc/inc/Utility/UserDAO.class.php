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
    static function createUser(User $user){
        $insert = "INSERT INTO users (full_name, username, email, password) VALUES (:full_name, :username, :email, :password);";
        self::$db->query($insert);
        self::$db->bind(":full_name", $user->getFullName());
        self::$db->bind(":username", $user->getUsername());
        self::$db->bind(":password", $user->getPassword());
        self::$db->bind(":email", $user->getEmail());
        self::$db->execute();
        return self::$db->lastInsertedId();
    }
}
?>