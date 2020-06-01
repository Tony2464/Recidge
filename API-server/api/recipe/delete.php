<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Access-Control-Allow-Methods,Content-Type,Authorization,X-Requested-With');

//initialize API
require_once __DIR__ . '/../../includes/api_initialize.php';

$recipe = new recipe();

//get data
$data = json_decode(file_get_contents('php://input'));

if (isset($data->recipeId) && isset($data->userId)) {
    if (!empty($data->recipeId) && !empty($data->userId)) {
        $recipe->delete($data->userId,$data->recipeId);
        http_response_code(200);
        echo json_encode(['message' => 'Recipe deleted successfully']);
    } else {
        http_response_code(400);
        echo json_encode(['message' => 'RecipeId or userId empty']);
    }
} else {
    http_response_code(400);
    echo json_encode(['message' => 'Unvalid recipeId or userId key']);
}
