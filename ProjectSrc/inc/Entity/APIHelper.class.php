<?php

class APIHelper {
    //Method to call an api and parse the result into Recipe class
    static function getRecipes($keyword) {
        // Build headers
        $headers = [
            'Edamam-Account-User: minh1806',
            'Accept: application/json',
            'Accept-Language: en',
        ];        
        // Build parameters
        $params = [
            'type' => 'public',
            'app_id' => '419ca9bc',
            'app_key' => '9a5c7a063153a0ace918f9f443dd4e81',
            'q' => $keyword,
        ];
        // Build context options
        $contextOptions = [
            'http' => [
                'method' => 'GET',
                'header' => implode("\r\n", $headers),
            ],
        ];
        $apiUrl = "https://api.edamam.com/api/recipes/v2";
        // Build api url
        $apiUrl .= '?' . http_build_query($params);
        $response = file_get_contents($apiUrl, false, stream_context_create($contextOptions));
        // Parse the JSON response
        $data = json_decode($response, true);
        $recipes = $data['hits'];
        $results = array();
        foreach ($recipes as $recipe) {
            $recipeObj = new Recipe();
            $recipeObj->setUri($recipe['recipe']['uri']);
            $recipeObj->setLabel($recipe['recipe']['label']);
            $recipeObj->setImage($recipe['recipe']['image']);
            $recipeObj->setIngredientLines($recipe['recipe']['ingredientLines']);
            $recipeObj->setCalories($recipe['recipe']['calories']);
            $results[] = $recipeObj;
        }
        return $results;
    }
}
?>