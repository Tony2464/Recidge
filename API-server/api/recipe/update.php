<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Access-Control-Allow-Methods,Content-Type,Authorization,X-Requested-With');

//initialize API
require_once __DIR__ . '/../../includes/api_initialize.php';

$userRecipe = new Recipe();

//get data
$data = json_decode(file_get_contents('php://input'));

if (isset($data->userId) && isset($data->recipeId) && isset($data->name) && isset($data->person) && isset($data->cookingTime) && isset($data->preparationTime) && isset($data->difficulty) && isset($data->note)) {
    if (!empty($data->userId) && !empty($data->recipeId) && !empty($data->name) && !empty($data->person) && !empty($data->cookingTime) && !empty($data->preparationTime) && !empty($data->difficulty) && !empty($data->note)) {
        $userRecipe->update($data->recipeId, $data->name, $data->person, $data->cookingTime, $data->preparationTime, $data->difficulty, $data->note);
        http_response_code(200);
        echo json_encode(['message' => 'User\'s recipe updated successfully']);
    } else {
        http_response_code(400);
        echo json_encode(['message' => 'Empty data']);
    }
} else {
    http_response_code(400);
    echo json_encode(['message' => 'Unvalid key']);
}
