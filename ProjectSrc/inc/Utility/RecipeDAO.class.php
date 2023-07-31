<?php
class RecipeDAO {
    private static $db;
    static function init()  {
        //Initialize the internal PDO Agent
        self::$db = new PDOAgent("Recipe");    
    }    
    static function insert(Recipe $recipe) {
        $insert = "INSERT INTO recipe (uri, label, image, url, calories) VALUES (:uri, :label, :image, :url, :calories);";
        self::$db->query($insert);
        self::$db->bind(":uri", $recipe->getUri());
        self::$db->bind(":label", $recipe->getLabel());
        self::$db->bind(":image", $recipe->getImage());
        self::$db->bind(":url", $recipe->getUrl());
        self::$db->bind(":calories", $recipe->getCalories());
        self::$db->execute();
        return self::$db->lastInsertedId();        
    }

    static function getRecipes(){
        $query = "SELECT * FROM recipe";
        self::$db->query($query);
        self::$db->execute();
        return self::$db->getResultSet();
    }

    static function remove($uri){
        $remove = "DELETE FROM recipe WHERE uri = :uri";
        try{
            self::$db->query($remove);
            self::$db->bind(":uri", $uri);
            self::$db->execute();
            if(self::$db->rowCount() != 1){
                throw new Exception("Problem while removing recipe {$uri}");
            }   
        } catch(Exception $ex){
            echo $ex->getMessage();
            self::$db->debugDumpParams(); 
            return false;
        }
        return true;
    }
}    

?>