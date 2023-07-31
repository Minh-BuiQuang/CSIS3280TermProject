<?php
class Recipe{
    //Uri is the link to the recipe on the API. This is used as unique identifier
    private $uri;
    private $label;
    private $image;
    //Url is the link to the cooking instruction page. Recipes from this API are a collection of recipes from other sites.
    private $url;
    private $ingredient_lines;
    private $ingredients;
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
    public function getUrl(){
        return $this->url;
    }
    public function getIngredientLines(){
        return $this->ingredient_lines;
    }
    public function getCalories(){
        return $this->calories;
    }
    public function getIngredients(){
        return $this->ingredients;
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
    public function setUrl($url){
        $this->url = $url;
    }
    public function setIngredientLines($ingredient_lines){
        $this->ingredient_lines = $ingredient_lines;
    }
    public function setCalories($calories){
        $this->calories = $calories;
    }
    public function setIngredients($ingredients){
        $this->ingredients = $ingredients;
    }
}
?>