<?php
class GroceryDAO {
    private static $db;
    static function init()  {
        //Initialize the internal PDO Agent
        self::$db = new PDOAgent("Grocery");    
    } 

    static function getGroceries(){
        $query = "SELECT * FROM grocery";
        self::$db->query($query);
        self::$db->execute();
        return self::$db->getResultSet();
    }

    static function addOrUpdateGrocery($grocery){
        //Get the grocery from database by food_id
        $query = "SELECT * FROM grocery WHERE food_id = :food_id";
        self::$db->query($query);
        self::$db->bind(":food_id", $grocery->getFoodId());
        self::$db->execute();
        $result = self::$db->singleResult();
        //If the grocery exists, increase quantity
        if($result){            
            $quantity = $result->getQuantity() + $grocery->getQuantity();
            $update = "UPDATE grocery SET quantity = :quantity, measure = :measure, food = :food WHERE food_id = :food_id";
            self::$db->query($update);
            self::$db->bind(":food_id", $grocery->getFoodId());
            self::$db->bind(":quantity", $quantity);
            self::$db->bind(":measure", $grocery->getMeasure());
            self::$db->bind(":food", $grocery->getFood());
            self::$db->execute();
        } else {
            //If the grocery does not exist, add it
            $insert = "INSERT INTO grocery (food_id, quantity, measure, food) VALUES (:food_id, :quantity, :measure, :food);";
            self::$db->query($insert);
            self::$db->bind(":food_id", $grocery->getFoodId());
            self::$db->bind(":quantity", $grocery->getQuantity());
            self::$db->bind(":measure", $grocery->getMeasure());
            self::$db->bind(":food", $grocery->getFood());
            self::$db->execute();
        }
    }

    static function removeGrocery($foodId) {
        $remove = "DELETE FROM grocery WHERE food_id = :food_id";
        try{
            self::$db->query($remove);
            self::$db->bind(":food_id", $foodId);
            self::$db->execute();
            if(self::$db->rowCount() != 1){
                throw new Exception("Problem while removing grocery {$foodId}");
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