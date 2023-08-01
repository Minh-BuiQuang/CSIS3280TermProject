<?php
class Grocery{
    private $food_id;
    private $quantity;
    private $measure;
    private $food;

    //getter
    public function getFoodId(){
        return $this->food_id;
    }
    public function getQuantity(){
        return $this->quantity;
    }
    public function getMeasure(){
        return $this->measure;
    }
    public function getFood(){
        return $this->food;
    }
    //Setter
    public function setFoodId($food_id){
        $this->food_id = $food_id;
    }
    public function setQuantity($quantity){
        $this->quantity = $quantity;
    }
    public function setMeasure($measure){
        $this->measure = $measure;
    }
    public function setFood($food){
        $this->food = $food;
    }
}
?>