<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Access-Control-Allow-Methods,Content-Type,Authorization,X-Requested-With');

//initialize API
require_once __DIR__ . '/../../includes/api_initialize.php';

$ingredient = new Ingredient();

//get data
$data = json_decode(file_get_contents('php://input'));

if (isset($data->ingredientId)) {
    if (!empty($data->ingredientId)) {
        $ingredient->delete($data->ingredientId);
        http_response_code(200);
        echo json_encode(['message' => 'ingredient deleted successfully']);
    } else {
        http_response_code(400);
        echo json_encode(['message' => 'ingredientId empty']);
    }
} else {
    http_response_code(400);
    echo json_encode(['message' => 'Unvalid ingredientId key']);
}
