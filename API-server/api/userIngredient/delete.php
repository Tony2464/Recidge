<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Access-Control-Allow-Methods,Content-Type,Authorization,X-Requested-With');

//initialize API
require_once __DIR__ . '/../../includes/api_initialize.php';

$userIngredient = new UserIngredient();

//get data
$data = json_decode(file_get_contents('php://input'));

if (isset($data->userId) && isset($data->ingredientId)) {
    if (!empty($data->userId) && !empty($data->ingredientId)) {
        $userIngredient->delete($data->userId, $data->ingredientId);
        http_response_code(200);
        echo json_encode(['message' => 'User\'s ingredient deleted successfully']);
    } else {
        http_response_code(400);
        echo json_encode(['message' => 'Empty data']);
    }
} else {
    http_response_code(400);
    echo json_encode(['message' => 'Unvalid key']);
}
