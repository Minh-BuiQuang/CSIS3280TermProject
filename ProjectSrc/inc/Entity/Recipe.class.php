<?php
class Recipe{
    private $uri;
    private $label;
    private $image;
    private $ingredient_lines;
    private $calories;

    //getter
    public function getUri(){
        return $this->uri;
    }
    public function getLabel(){
        return $this->label;
    }
    public function getImage(){
        return $this->image;
    }
    public function getIngredientLines(){
        return $this->ingredient_lines;
    }
    public function getCalories(){
        return $this->calories;
    }
    //Setter
    public function setUri($uri){
        $this->uri = $uri;
    }
    public function setLabel($label){
        $this->label = $label;
    }
    public function setImage($image){
        $this->image = $image;
    }
    public function setIngredientLines($ingredient_lines){
        $this->ingredient_lines = $ingredient_lines;
    }
    public function setCalories($calories){
        $this->calories = $calories;
    }
    
}
?>