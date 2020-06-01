<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Access-Control-Allow-Methods,Content-Type,Authorization,X-Requested-With');

//initialize API
require_once __DIR__ . '/../../includes/api_initialize.php';

$recipeIngredient = new RecipeIngredient();

//get data
$data = json_decode(file_get_contents('php://input'));

if (isset($data->recipeId) && isset($data->ingredientId) && isset($data->quantity)) {
    if (!empty($data->recipeId) && !empty($data->ingredientId) && !empty($data->quantity)) {
        $recipeIngredient->update($data->recipeId, $data->ingredientId, $data->quantity);
        http_response_code(200);
        echo json_encode(['message' => 'User\'s ingredient updated successfully']);
    } else {
        http_response_code(400);
        echo json_encode(['message' => 'Empty data']);
    }
} else {
    http_response_code(400);
    echo json_encode(['message' => 'Unvalid key']);
}
